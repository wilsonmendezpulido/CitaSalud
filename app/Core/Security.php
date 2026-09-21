<?php

class Security
{
    /**
     * Inicia la sesión si todavía no está iniciada.
     */
    public static function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }


    /**
     * Genera un token CSRF.
     */
    public static function csrfToken()
    {
        self::startSession();

        if (empty($_SESSION['csrf_token'])) {

            $_SESSION['csrf_token'] =
                bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }


    /**
     * Genera el campo HTML hidden.
     */
    public static function csrfField()
    {
        $token = self::csrfToken();

        return
            '<input type="hidden" ' .
            'name="csrf_token" ' .
            'value="' .
            htmlspecialchars($token, ENT_QUOTES, 'UTF-8') .
            '">';
    }


    /**
     * Valida el token recibido.
     */
    public static function verifyCsrf()
    {
        self::startSession();

        $token = isset($_POST['csrf_token'])
            ? $_POST['csrf_token']
            : '';

        if (
            empty($token) ||
            empty($_SESSION['csrf_token']) ||
            !hash_equals(
                $_SESSION['csrf_token'],
                $token
            )
        ) {

            http_response_code(419);

            echo 'Solicitud no válida. ' .
                'El token de seguridad no coincide.';

            exit;
        }

        return true;
    }
}
