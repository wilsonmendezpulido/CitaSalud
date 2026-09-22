<?php

class AuthController extends Controller
{
    public function loginForm()
    {
        $this->view('auth/login');
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        Security::verifyCsrf();

        $email = isset($_POST['email'])
            ? trim($_POST['email'])
            : '';

        $password = isset($_POST['password'])
            ? $_POST['password']
            : '';

        if ($email === '' || $password === '') {

            $this->view('auth/login', array(
                'error' => 'Debe ingresar correo y contraseña.'
            ));

            return;
        }

        require_once BASE_PATH . '/app/Models/Usuario.php';

        $usuarioModel = new Usuario();

        $usuario = $usuarioModel->findByEmail($email);

        if (!$usuario) {

            $this->view('auth/login', array(
                'error' => 'Las credenciales ingresadas no son válidas.'
            ));

            return;
        }

        if ((int)$usuario['estado'] !== 1) {

            $this->view('auth/login', array(
                'error' => 'El usuario se encuentra inactivo.'
            ));

            return;
        }

        if (!password_verify($password, $usuario['password'])) {

            $this->view('auth/login', array(
                'error' => 'Las credenciales ingresadas no son válidas.'
            ));

            return;
        }

        session_regenerate_id(true);

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['rol'] = $usuario['rol'];

        header('Location: ' . APP_URL . '/dashboard');

        exit;
    }

    public function logout()
    {
        /*
     * Asegurar que la sesión esté iniciada
     */
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
     * Obtener el usuario antes de destruir la sesión
     */
        $usuarioId = isset($_SESSION['usuario_id'])
            ? (int) $_SESSION['usuario_id']
            : null;


        /*
     * Revocar todos los tokens API
     * asociados al usuario
     */
        if ($usuarioId) {

            require_once BASE_PATH . '/app/Models/ApiToken.php';

            try {

                $apiTokenModel = new ApiToken();

                $apiTokenModel->deleteByUsuarioId(
                    $usuarioId
                );
            } catch (Exception $e) {

                /*
             * No detener el logout si existe
             * un problema al revocar tokens.
             *
             * Para producción sería recomendable
             * registrar el error en logs.
             */

                error_log(
                    'Error al revocar tokens API del usuario ' .
                        $usuarioId .
                        ': ' .
                        $e->getMessage()
                );
            }
        }


        /*
     * Limpiar variables de sesión
     */
        $_SESSION = array();


        /*
     * Eliminar cookie de sesión
     */
        if (ini_get('session.use_cookies')) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }


        /*
     * Destruir sesión
     */
        session_destroy();


        /*
     * Regresar al login
     */
        header(
            'Location: ' .
                APP_URL .
                '/login'
        );

        exit;
    }
}
