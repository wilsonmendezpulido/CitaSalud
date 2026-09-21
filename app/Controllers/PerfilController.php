<?php

class PerfilController extends Controller
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
     * Mostrar perfil.
     */
    public function index()
    {
        $this->requireAuth();

        require_once BASE_PATH . '/app/Models/Paciente.php';

        $model = new Paciente();

        $paciente = $model->findByUsuarioId(
            $_SESSION['usuario_id']
        );

        if (!$paciente) {
            http_response_code(404);

            echo 'No existe un perfil de paciente asociado
                  al usuario actual.';

            return;
        }

        $this->view(
            'perfil/index',
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

        require_once BASE_PATH . '/app/Models/Paciente.php';

        $model = new Paciente();

        $paciente = $model->findByUsuarioId(
            $_SESSION['usuario_id']
        );

        if (!$paciente) {
            http_response_code(404);

            echo 'No existe un perfil de paciente asociado
                  al usuario actual.';

            return;
        }

        $this->view(
            'perfil/edit',
            array(
                'paciente' => $paciente
            )
        );
    }


    /**
     * Actualizar perfil.
     */
    public function update()
    {
        $this->requireAuth();
        Security::verifyCsrf();

        require_once BASE_PATH . '/app/Models/Paciente.php';

        $model = new Paciente();

        $paciente = $model->findByUsuarioId(
            $_SESSION['usuario_id']
        );

        if (!$paciente) {
            http_response_code(404);

            echo 'No existe un perfil de paciente asociado
                  al usuario actual.';

            return;
        }


        $data = array(
            'nombre' => isset($_POST['nombre'])
                ? trim($_POST['nombre'])
                : '',

            'apellido' => isset($_POST['apellido'])
                ? trim($_POST['apellido'])
                : '',

            'fecha_nacimiento' => isset($_POST['fecha_nacimiento'])
                ? trim($_POST['fecha_nacimiento'])
                : '',

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
                ? trim($_POST['sexo'])
                : '',

            'discapacidad' => isset($_POST['discapacidad'])
                ? (int) $_POST['discapacidad']
                : 0
        );


        /*
         * Validaciones.
         */

        $errors = array();


        if ($data['nombre'] === '') {
            $errors[] = 'El nombre es obligatorio.';
        }


        if ($data['apellido'] === '') {
            $errors[] = 'El apellido es obligatorio.';
        }


        if ($data['email'] === '') {

            $errors[] =
                'El correo electrónico es obligatorio.';
        } elseif (!filter_var(
            $data['email'],
            FILTER_VALIDATE_EMAIL
        )) {

            $errors[] =
                'El correo electrónico no es válido.';
        }


        if (!empty($errors)) {

            $this->view(
                'perfil/edit',
                array(
                    'paciente' => array_merge(
                        $paciente,
                        $data
                    ),
                    'errors' => $errors
                )
            );

            return;
        }


        try {

            $model->updatePerfil(
                $paciente['id'],
                $data
            );

            header(
                'Location: ' .
                    APP_URL .
                    '/perfil?success=updated'
            );

            exit;
        } catch (PDOException $e) {

            http_response_code(500);

            echo 'Error al actualizar el perfil: ' .
                htmlspecialchars(
                    $e->getMessage()
                );
        }
    }
}
