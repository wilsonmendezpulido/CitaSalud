<?php

class CitaController extends Controller
{
    private function requireAuth()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . APP_URL . '/login');
            exit;
        }
    }

    public function create()
    {
        $this->requireAuth();

        require_once BASE_PATH . '/app/Models/Especialidad.php';

        $model = new Especialidad();

        $especialidades = $model->getAll();

        $this->view(
            'citas/create',
            array(
                'especialidades' => $especialidades
            )
        );
    }

    public function medicos()
    {
        $this->requireAuth();

        $especialidadId = isset($_GET['especialidad_id'])
            ? (int) $_GET['especialidad_id']
            : 0;

        if ($especialidadId <= 0) {
            http_response_code(400);
            echo 'Especialidad no válida.';
            return;
        }

        require_once BASE_PATH . '/app/Models/Especialidad.php';
        require_once BASE_PATH . '/app/Models/Medico.php';

        $especialidadModel = new Especialidad();
        $medicoModel = new Medico();

        $especialidad = $especialidadModel->find($especialidadId);

        if (!$especialidad) {
            http_response_code(404);
            echo 'Especialidad no encontrada.';
            return;
        }

        $medicos = $medicoModel->getByEspecialidad($especialidadId);

        $this->view(
            'citas/medicos',
            array(
                'especialidad' => $especialidad,
                'medicos' => $medicos
            )
        );
    }

    public function disponibilidad()
    {
        $this->requireAuth();

        $medicoId = isset($_GET['medico_id'])
            ? (int) $_GET['medico_id']
            : 0;

        if ($medicoId <= 0) {
            http_response_code(400);
            echo 'Médico no válido.';
            return;
        }

        require_once BASE_PATH . '/app/Models/Medico.php';
        require_once BASE_PATH . '/app/Models/Disponibilidad.php';

        $medicoModel = new Medico();
        $disponibilidadModel = new Disponibilidad();

        $medico = $medicoModel->find($medicoId);

        if (!$medico) {
            http_response_code(404);
            echo 'Médico no encontrado.';
            return;
        }

        $fechas = $disponibilidadModel
            ->getFechasDisponibles($medicoId);

        $fechaSeleccionada = isset($_GET['fecha'])
            ? $_GET['fecha']
            : '';

        $horarios = array();

        if (!empty($fechaSeleccionada)) {

            $horarios = $disponibilidadModel
                ->getHorariosDisponibles(
                    $medicoId,
                    $fechaSeleccionada
                );
        }

        $this->view(
            'citas/disponibilidad',
            array(
                'medico' => $medico,
                'fechas' => $fechas,
                'fechaSeleccionada' => $fechaSeleccionada,
                'horarios' => $horarios
            )
        );
    }

    public function confirmar()
    {
        $this->requireAuth();

        $disponibilidadId = isset($_GET['disponibilidad_id'])
            ? (int) $_GET['disponibilidad_id']
            : 0;

        if ($disponibilidadId <= 0) {
            http_response_code(400);
            echo 'Horario no válido.';
            return;
        }

        require_once BASE_PATH . '/app/Models/Cita.php';

        $model = new Cita();

        $detalle =
            $model->getDisponibilidadDetalle(
                $disponibilidadId
            );

        if (!$detalle) {
            http_response_code(404);
            echo 'Horario no encontrado.';
            return;
        }

        if ($detalle['estado'] !== 'DISPONIBLE') {
            http_response_code(409);
            echo 'El horario seleccionado ya no está disponible.';
            return;
        }

        $this->view(
            'citas/confirmar',
            array(
                'detalle' => $detalle
            )
        );
    }

    public function store()
    {
        $this->requireAuth();
        Security::verifyCsrf();

        $disponibilidadId = isset($_POST['disponibilidad_id'])
            ? (int) $_POST['disponibilidad_id']
            : 0;

        $motivo = isset($_POST['motivo'])
            ? trim($_POST['motivo'])
            : '';

        if ($disponibilidadId <= 0) {
            http_response_code(400);
            echo 'Horario no válido.';
            return;
        }

        if ($motivo === '') {
            http_response_code(400);
            echo 'Debe indicar el motivo de la consulta.';
            return;
        }

        /*
     * Por ahora utilizamos el paciente asociado
     * al usuario autenticado.
     */
        require_once BASE_PATH . '/app/Models/Paciente.php';
        require_once BASE_PATH . '/app/Models/Cita.php';

        $pacienteModel = new Paciente();

        $paciente = $pacienteModel
            ->findByUsuarioId($_SESSION['usuario_id']);

        if (!$paciente) {
            http_response_code(404);

            echo 'No existe un perfil de paciente asociado
              al usuario actual.';

            return;
        }

        $citaModel = new Cita();

        $detalle =
            $citaModel->getDisponibilidadDetalle(
                $disponibilidadId
            );

        if (!$detalle) {
            http_response_code(404);
            echo 'Horario no encontrado.';
            return;
        }

        try {

            $citaId = $citaModel->registrar(
                $paciente['id'],
                $detalle['medico_id'],
                $disponibilidadId,
                $detalle['fecha'],
                $detalle['hora_inicio'],
                $motivo
            );

            header(
                'Location: ' .
                    APP_URL .
                    '/citas/exito?id=' .
                    $citaId
            );

            exit;
        } catch (Exception $e) {

            http_response_code(409);

            echo 'No fue posible registrar la cita: ' .
                htmlspecialchars($e->getMessage());
        }
    }

    public function exito()
    {
        $this->requireAuth();

        $id = isset($_GET['id'])
            ? (int) $_GET['id']
            : 0;

        if ($id <= 0) {
            http_response_code(400);
            echo 'Cita no válida.';
            return;
        }

        require_once BASE_PATH . '/app/Models/Cita.php';

        $model = new Cita();

        $cita = $model->find($id);

        if (!$cita) {
            http_response_code(404);
            echo 'Cita no encontrada.';
            return;
        }

        $this->view(
            'citas/exito',
            array(
                'cita' => $cita
            )
        );
    }

    public function misCitas()
    {
        $this->requireAuth();

        require_once BASE_PATH . '/app/Models/Paciente.php';
        require_once BASE_PATH . '/app/Models/Cita.php';

        $pacienteModel = new Paciente();

        $paciente = $pacienteModel
            ->findByUsuarioId($_SESSION['usuario_id']);

        if (!$paciente) {

            http_response_code(404);

            echo 'No existe un perfil de paciente asociado
              al usuario actual.';

            return;
        }

        $citaModel = new Cita();

        $proximas = $citaModel
            ->getProximasByPaciente($paciente['id']);

        $historial = $citaModel
            ->getHistorialByPaciente($paciente['id']);

        $this->view(
            'citas/mis-citas',
            array(
                'paciente' => $paciente,
                'proximas' => $proximas,
                'historial' => $historial
            )
        );
    }

    public function detalle()
    {
        $this->requireAuth();

        $id = isset($_GET['id'])
            ? (int) $_GET['id']
            : 0;

        if ($id <= 0) {
            http_response_code(400);
            echo 'ID de cita no válido.';
            return;
        }

        require_once BASE_PATH . '/app/Models/Paciente.php';
        require_once BASE_PATH . '/app/Models/Cita.php';

        $pacienteModel = new Paciente();

        $paciente = $pacienteModel
            ->findByUsuarioId($_SESSION['usuario_id']);

        if (!$paciente) {
            http_response_code(404);
            echo 'Paciente no encontrado.';
            return;
        }

        $citaModel = new Cita();

        $cita = $citaModel->getDetalleByPaciente(
            $id,
            $paciente['id']
        );

        if (!$cita) {
            http_response_code(404);
            echo 'Cita no encontrada.';
            return;
        }

        $this->view(
            'citas/detalle',
            array(
                'cita' => $cita
            )
        );
    }

    public function cancelar()
    {
        $this->requireAuth();
        Security::verifyCsrf();

        $id = isset($_POST['id'])
            ? (int) $_POST['id']
            : 0;

        if ($id <= 0) {
            http_response_code(400);
            echo 'ID de cita no válido.';
            return;
        }

        require_once BASE_PATH . '/app/Models/Paciente.php';
        require_once BASE_PATH . '/app/Models/Cita.php';

        $pacienteModel = new Paciente();

        $paciente = $pacienteModel
            ->findByUsuarioId($_SESSION['usuario_id']);

        if (!$paciente) {
            http_response_code(404);
            echo 'Paciente no encontrado.';
            return;
        }

        try {

            $citaModel = new Cita();

            $citaModel->cancelar(
                $id,
                $paciente['id']
            );

            header(
                'Location: ' .
                    APP_URL .
                    '/citas/mis-citas?success=cancelled'
            );

            exit;
        } catch (Exception $e) {

            http_response_code(409);

            echo 'No fue posible cancelar la cita: ' .
                htmlspecialchars(
                    $e->getMessage()
                );
        }
    }
}
