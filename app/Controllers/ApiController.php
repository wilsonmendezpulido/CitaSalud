<?php

require_once BASE_PATH . '/app/Models/Usuario.php';
require_once BASE_PATH . '/app/Models/ApiToken.php';
require_once BASE_PATH . '/app/Models/Especialidad.php';
require_once BASE_PATH . '/app/Models/Medico.php';
require_once BASE_PATH . '/app/Models/Disponibilidad.php';

class ApiController extends Controller
{
    /**
     * POST /api/login
     */
    public function login()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!is_array($input)) {
            $input = $_POST;
        }

        $email = isset($input['email'])
            ? trim($input['email'])
            : '';

        $password = isset($input['password'])
            ? $input['password']
            : '';

        if ($email === '' || $password === '') {
            $this->json(array(
                'success' => false,
                'message' => 'El correo y la contraseña son obligatorios.'
            ), 422);

            return;
        }

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->findByEmail($email);

        if (!$usuario || !password_verify($password, $usuario['password'])) {
            $this->json(array(
                'success' => false,
                'message' => 'Credenciales inválidas.'
            ), 401);

            return;
        }

        if ((int) $usuario['estado'] !== 1) {
            $this->json(array(
                'success' => false,
                'message' => 'El usuario se encuentra inactivo.'
            ), 403);

            return;
        }

        $tokenModel = new ApiToken();

        $token = $tokenModel->create(
            $usuario['id'],
            'CitaSalud API',
            7
        );

        $this->json(array(
            'success' => true,
            'message' => 'Autenticación exitosa.',
            'data' => array(
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_in_days' => 7,
                'usuario' => array(
                    'id' => (int) $usuario['id'],
                    'nombre_usuario' => $usuario['nombre_usuario'],
                    'email' => $usuario['email'],
                    'rol' => $usuario['rol']
                )
            )
        ), 200);
    }

    /**
     * GET /api/especialidades
     */
    public function especialidades()
    {
        $usuario = $this->authenticate();

        if (!$usuario) {
            return;
        }

        $model = new Especialidad();
        $especialidades = $model->getAll();

        $this->json(array(
            'success' => true,
            'data' => $especialidades
        ));
    }

    /**
     * GET /api/medicos?especialidad_id=1
     */
    public function medicos()
    {
        $usuario = $this->authenticate();

        if (!$usuario) {
            return;
        }

        $especialidadId = isset($_GET['especialidad_id'])
            ? (int) $_GET['especialidad_id']
            : 0;

        if ($especialidadId <= 0) {
            $this->json(array(
                'success' => false,
                'message' => 'El parámetro especialidad_id es obligatorio.'
            ), 422);

            return;
        }

        $model = new Medico();

        $medicos = $model->getByEspecialidad($especialidadId);

        $this->json(array(
            'success' => true,
            'data' => $medicos
        ));
    }

    /**
     * GET /api/disponibilidad?medico_id=1&fecha=2026-10-01
     */
    public function disponibilidad()
    {
        $usuario = $this->authenticate();

        if (!$usuario) {
            return;
        }

        $medicoId = isset($_GET['medico_id'])
            ? (int) $_GET['medico_id']
            : 0;

        $fecha = isset($_GET['fecha'])
            ? trim($_GET['fecha'])
            : '';

        if ($medicoId <= 0) {
            $this->json(array(
                'success' => false,
                'message' => 'El parámetro medico_id es obligatorio.'
            ), 422);

            return;
        }

        if (!$this->validDate($fecha)) {
            $this->json(array(
                'success' => false,
                'message' => 'La fecha debe tener formato YYYY-MM-DD.'
            ), 422);

            return;
        }

        $model = new Disponibilidad();

        $horarios = $model->getHorariosDisponibles(
            $medicoId,
            $fecha
        );

        $this->json(array(
            'success' => true,
            'data' => $horarios
        ));
    }

    /**
     * Autenticación mediante Bearer Token
     */
    private function authenticate()
    {
        $headers = $this->getAuthorizationHeader();

        if (!$headers) {
            $this->json(array(
                'success' => false,
                'message' => 'Token de autenticación requerido.'
            ), 401);

            return false;
        }

        if (stripos($headers, 'Bearer ') !== 0) {
            $this->json(array(
                'success' => false,
                'message' => 'Formato de autenticación inválido.'
            ), 401);

            return false;
        }

        $token = trim(substr($headers, 7));

        if ($token === '') {
            $this->json(array(
                'success' => false,
                'message' => 'Token de autenticación inválido.'
            ), 401);

            return false;
        }

        $tokenModel = new ApiToken();

        $usuario = $tokenModel->findUserByToken($token);

        if (!$usuario) {
            $this->json(array(
                'success' => false,
                'message' => 'Token inválido o expirado.'
            ), 401);

            return false;
        }

        return $usuario;
    }

    /**
     * Obtiene Authorization de forma compatible con Apache/XAMPP
     */
    private function getAuthorizationHeader()
    {
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            return $_SERVER['HTTP_AUTHORIZATION'];
        }

        if (function_exists('getallheaders')) {
            $headers = getallheaders();

            foreach ($headers as $key => $value) {
                if (strtolower($key) === 'authorization') {
                    return $value;
                }
            }
        }

        return null;
    }

    /**
     * Validar fecha YYYY-MM-DD
     */
    private function validDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);

        return $d &&
            $d->format('Y-m-d') === $date;
    }

    /**
     * GET /api/citas
     */
    public function citas()
    {
        $usuario = $this->authenticate();

        if (!$usuario) {
            return;
        }

        require_once BASE_PATH . '/app/Models/Paciente.php';
        require_once BASE_PATH . '/app/Models/Cita.php';

        try {

            $pacienteModel = new Paciente();

            $paciente = $pacienteModel->findByUsuarioId(
                $usuario['id']
            );

            if (!$paciente) {

                $this->json(array(
                    'success' => false,
                    'message' => 'No existe un paciente asociado al usuario.'
                ), 404);

                return;
            }

            $citaModel = new Cita();

            $proximas =
                $citaModel->getProximasByPaciente(
                    $paciente['id']
                );

            $historial =
                $citaModel->getHistorialByPaciente(
                    $paciente['id']
                );

            $this->json(array(
                'success' => true,
                'message' => 'Citas obtenidas correctamente.',
                'data' => array(
                    'proximas' => $proximas,
                    'historial' => $historial
                )
            ));
        } catch (Exception $e) {

            $this->json(array(
                'success' => false,
                'message' => 'No fue posible obtener las citas.',
                'error' => $e->getMessage()
            ), 500);
        }
    }

    /**
     * GET /api/citas/detalle?id=1
     */
    public function detalleCita()
    {
        $usuario = $this->authenticate();

        if (!$usuario) {
            return;
        }

        require_once BASE_PATH . '/app/Models/Paciente.php';
        require_once BASE_PATH . '/app/Models/Cita.php';

        $id = isset($_GET['id'])
            ? (int)$_GET['id']
            : 0;

        if ($id <= 0) {

            $this->json(array(
                'success' => false,
                'message' => 'El parámetro id es obligatorio.'
            ), 422);

            return;
        }

        try {

            $pacienteModel = new Paciente();

            $paciente = $pacienteModel->findByUsuarioId(
                $usuario['id']
            );

            if (!$paciente) {

                $this->json(array(
                    'success' => false,
                    'message' => 'No existe un paciente asociado al usuario.'
                ), 404);

                return;
            }

            $citaModel = new Cita();

            $cita = $citaModel->getDetalleByPaciente(
                $id,
                $paciente['id']
            );

            if (!$cita) {

                $this->json(array(
                    'success' => false,
                    'message' => 'La cita no existe o no pertenece al usuario.'
                ), 404);

                return;
            }

            $this->json(array(
                'success' => true,
                'message' => 'Detalle de la cita obtenido correctamente.',
                'data' => $cita
            ));
        } catch (Exception $e) {

            $this->json(array(
                'success' => false,
                'message' => 'No fue posible obtener el detalle de la cita.',
                'error' => $e->getMessage()
            ), 500);
        }
    }
}
