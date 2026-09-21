<?php

class DashboardController extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {

            header('Location: ' . APP_URL . '/login');

            exit;
        }

        $this->view('dashboard/index', array(
            'usuario' => $_SESSION['nombre_usuario'],
            'rol' => $_SESSION['rol']
        ));
    }
}