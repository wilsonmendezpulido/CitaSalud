<?php

require_once __DIR__ . '/../config/config.php';

require_once BASE_PATH . '/app/Core/Security.php';
require_once BASE_PATH . '/app/Core/Router.php';
require_once BASE_PATH . '/app/Core/Controller.php';
require_once BASE_PATH . '/app/Core/Model.php';


/*
 * Iniciar sesión antes de cualquier salida
 */

Security::startSession();


require_once BASE_PATH . '/routes/web.php';


$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);