<?php

class PacienteController extends Controller
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

    /**
     * Listado de pacientes.
     */
    public function index()
    {
        $this->requireAuth();

        require_once BASE_PATH . '/app/Models/Paciente.php';

        $model = new Paciente();

        $pacientes = $model->getAll();

        $this->view(
            'pacientes/index',
            array(
                'pacientes' => $pacientes
            )
        );
    }

    /**
     * Formulario de creación.
     */
    public function create()
    {
        $this->requireAuth();

        $this->view('pacientes/create');
    }

    /**
     * Guardar paciente.
     */
    public function store()
    {
        $this->requireAuth();
        Security::verifyCsrf();

        require_once BASE_PATH . '/app/Models/Paciente.php';

        $data = $this->getFormData();

        $errors = $this->validate($data);

        if (!empty($errors)) {

            $this->view(
                'pacientes/create',
                array(
                    'errors' => $errors,
                    'data' => $data
                )
            );

            return;
        }

        $model = new Paciente();

        try {

            $model->create($data);

            header(
                'Location: ' .
                    APP_URL .
                    '/pacientes?success=created'
            );

            exit;
        } catch (PDOException $e) {

            $this->view(
                'pacientes/create',
                array(
                    'errors' => array(
                        'No fue posible registrar el paciente. Verifique que el documento no esté registrado.'
                    ),
                    'data' => $data
                )
            );
        }
    }

    /**
     * Ver paciente.
     */
    public function show()
    {
        $this->requireAuth();

        $id = isset($_GET['id'])
            ? (int) $_GET['id']
            : 0;

        if ($id <= 0) {
            http_response_code(400);
            echo 'ID de paciente no válido.';
            return;
        }

        require_once BASE_PATH . '/app/Models/Paciente.php';

        $model = new Paciente();

        $paciente = $model->find($id);

        if (!$paciente) {
            http_response_code(404);
            echo 'Paciente no encontrado.';
            return;
        }

        $this->view(
            'pacientes/show',
            array(
                'paciente' => $paciente
            )
        );
    }

    /**
     * Formulario de edición.
     */
    public function edit()
    {
        $this->requireAuth();

        $id = isset($_GET['id'])
            ? (int) $_GET['id']
            : 0;

        if ($id <= 0) {
            http_response_code(400);
            echo 'ID de paciente no válido.';
            return;
        }

        require_once BASE_PATH . '/app/Models/Paciente.php';

        $model = new Paciente();

        $paciente = $model->find($id);

        if (!$paciente) {
            http_response_code(404);
            echo 'Paciente no encontrado.';
            return;
        }
        Security::verifyCsrf();

        $this->view(
            'pacientes/edit',
            array(
                'paciente' => $paciente
            )
        );
    }

    /**
     * Actualizar paciente.
     */
    public function update()
    {
        $this->requireAuth();
        Security::verifyCsrf();

        $id = isset($_GET['id'])
            ? (int) $_GET['id']
            : 0;

        if ($id <= 0) {
            http_response_code(400);
            echo 'ID de paciente no válido.';
            return;
        }

        require_once BASE_PATH . '/app/Models/Paciente.php';

        $data = $this->getFormData();

        $errors = $this->validate($data);

        if (!empty($errors)) {

            $data['id'] = $id;

            $this->view(
                'pacientes/edit',
                array(
                    'errors' => $errors,
                    'paciente' => $data
                )
            );

            return;
        }

        $model = new Paciente();

        try {

            $model->update($id, $data);

            header(
                'Location: ' .
                    APP_URL .
                    '/pacientes?success=updated'
            );

            exit;
        } catch (PDOException $e) {

            $this->view(
                'pacientes/edit',
                array(
                    'errors' => array(
                        'No fue posible actualizar el paciente.'
                    ),
                    'paciente' => $data
                )
            );
        }
    }

    /**
     * Desactivar paciente.
     */
    public function delete()
    {
        $this->requireAuth();

        $id = isset($_GET['id'])
            ? (int) $_GET['id']
            : 0;

        if ($id <= 0) {
            http_response_code(400);
            echo 'ID de paciente no válido.';
            return;
        }

        require_once BASE_PATH . '/app/Models/Paciente.php';

        $model = new Paciente();

        $model->delete($id);

        header(
            'Location: ' .
                APP_URL .
                '/pacientes?success=deleted'
        );

        exit;
    }

    /**
     * Obtener datos enviados por formulario.
     */
    private function getFormData()
    {
        return array(
            'usuario_id' => isset($_POST['usuario_id'])
                ? (int) $_POST['usuario_id']
                : null,

            'documento' => isset($_POST['documento'])
                ? trim($_POST['documento'])
                : '',

            'nombre' => isset($_POST['nombre'])
                ? trim($_POST['nombre'])
                : '',

            'apellido' => isset($_POST['apellido'])
                ? trim($_POST['apellido'])
                : '',

            'fecha_nacimiento' => isset($_POST['fecha_nacimiento'])
                ? $_POST['fecha_nacimiento']
                : null,

            'telefono' => isset($_POST['telefono'])
                ? trim($_POST['telefono'])
                : '',

            'direccion' => isset($_POST['direccion'])
                ? trim($_POST['direccion'])
                : '',

            'email' => isset($_POST['email'])
                ? trim($_POST['email'])
                : '',

            'eps' => isset($_POST['eps'])
                ? trim($_POST['eps'])
                : '',

            'sexo' => isset($_POST['sexo'])
                ? $_POST['sexo']
                : 'NO_INFORMA',

            'discapacidad' => isset($_POST['discapacidad'])
                ? trim($_POST['discapacidad'])
                : ''
        );
    }

    /**
     * Validaciones.
     */
    private function validate($data)
    {
        $errors = array();

        if ($data['usuario_id'] === null) {
            $errors[] = 'Debe asociar un usuario al paciente.';
        }

        if ($data['documento'] === '') {
            $errors[] = 'El documento es obligatorio.';
        }

        if ($data['nombre'] === '') {
            $errors[] = 'El nombre es obligatorio.';
        }

        if ($data['apellido'] === '') {
            $errors[] = 'El apellido es obligatorio.';
        }

        if ($data['email'] === '') {
            $errors[] = 'El correo electrónico es obligatorio.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'El correo electrónico no tiene un formato válido.';
        }

        return $errors;
    }
}
