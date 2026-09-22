<?php

class Security
{
    public static function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {

            session_start();

        }
    }


    public static function csrfToken()
    {
        self::startSession();

        if (
            !isset($_SESSION['csrf_token']) ||
            empty($_SESSION['csrf_token'])
        ) {

            $_SESSION['csrf_token'] =
                bin2hex(random_bytes(32));

        }

        return $_SESSION['csrf_token'];
    }


    public static function csrfField()
    {
        $token = self::csrfToken();

        return
            '<input type="hidden" name="csrf_token" value="' .
            htmlspecialchars(
                $token,
                ENT_QUOTES,
                'UTF-8'
            ) .
            '">';
    }


    public static function verifyCsrf()
    {
        self::startSession();

        $token = isset($_POST['csrf_token'])
            ? $_POST['csrf_token']
            : '';

        $sessionToken = isset($_SESSION['csrf_token'])
            ? $_SESSION['csrf_token']
            : '';


        if (
            empty($token) ||
            empty($sessionToken) ||
            !hash_equals(
                $sessionToken,
                $token
            )
        ) {

            http_response_code(419);

            echo 'Solicitud no válida. El token de seguridad no coincide.';

            exit;
        }

        return true;
    }
}