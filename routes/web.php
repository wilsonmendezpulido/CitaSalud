<?php

$router = new Router();

require_once BASE_PATH . '/app/Controllers/HomeController.php';
require_once BASE_PATH . '/app/Controllers/EspecialidadController.php';
require_once BASE_PATH . '/app/Controllers/AuthController.php';
require_once BASE_PATH . '/app/Controllers/DashboardController.php';
require_once BASE_PATH . '/app/Controllers/PacienteController.php';
require_once BASE_PATH . '/app/Controllers/CitaController.php';
require_once BASE_PATH . '/app/Controllers/PerfilController.php';

$router->get(
    '/',
    array(HomeController::class, 'index')
);

$router->get(
    '/especialidades',
    array(EspecialidadController::class, 'index')
);

$router->get(
    '/login',
    array(AuthController::class, 'loginForm')
);

$router->post(
    '/login',
    array(AuthController::class, 'login')
);

$router->get(
    '/logout',
    array(AuthController::class, 'logout')
);

$router->get(
    '/dashboard',
    array(DashboardController::class, 'index')
);

//PACIENTES

$router->get(
    '/pacientes',
    array(PacienteController::class, 'index')
);

$router->get(
    '/pacientes/create',
    array(PacienteController::class, 'create')
);

$router->post(
    '/pacientes/store',
    array(PacienteController::class, 'store')
);

$router->get(
    '/pacientes/show',
    array(PacienteController::class, 'show')
);

$router->get(
    '/pacientes/edit',
    array(PacienteController::class, 'edit')
);

$router->post(
    '/pacientes/update',
    array(PacienteController::class, 'update')
);

$router->get(
    '/pacientes/delete',
    array(PacienteController::class, 'delete')
);

//CITAS
$router->get(
    '/citas/create',
    array(CitaController::class, 'create')
);

$router->get(
    '/citas/medicos',
    array(CitaController::class, 'medicos')
);

$router->get(
    '/citas/disponibilidad',
    array(CitaController::class, 'disponibilidad')
);

$router->get(
    '/citas/confirmar',
    array(CitaController::class, 'confirmar')
);

$router->post(
    '/citas/store',
    array(CitaController::class, 'store')
);

$router->get(
    '/citas/exito',
    array(CitaController::class, 'exito')
);

$router->get(
    '/citas/mis-citas',
    array(CitaController::class, 'misCitas')
);

$router->get(
    '/citas/detalle',
    array(CitaController::class, 'detalle')
);

$router->post(
    '/citas/cancelar',
    array(CitaController::class, 'cancelar')
);

//PERFIL
$router->get(
    '/perfil',
    array(PerfilController::class, 'index')
);

$router->get(
    '/perfil/edit',
    array(PerfilController::class, 'edit')
);

$router->post(
    '/perfil/update',
    array(PerfilController::class, 'update')
);