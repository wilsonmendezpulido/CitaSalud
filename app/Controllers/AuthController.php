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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = array();

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

        session_destroy();

        header('Location: ' . APP_URL . '/login');

        exit;
    }
}
