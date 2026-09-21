<?php

$usuario = isset($usuario) ? $usuario : '';
$rol = isset($rol) ? $rol : '';

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Dashboard - CitaSalud</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

        <div class="container">

            <span class="navbar-brand fw-bold">
                CitaSalud
            </span>

            <div class="d-flex align-items-center">

                <span class="text-white me-3">
                    <?= htmlspecialchars($usuario) ?>
                </span>

                <a
                    href="<?= APP_URL ?>/logout"
                    class="btn btn-light btn-sm">
                    Cerrar sesión
                </a>

            </div>

        </div>

    </nav>

    <div class="container py-5">

        <div class="mb-4">

            <h1 class="h3">
                Bienvenido a CitaSalud
            </h1>

            <p class="text-muted">
                Panel principal del sistema.
            </p>

        </div>

        <div class="row g-4">

            <div class="row mt-4">

                <div class="col-md-6 mb-3">

                    <div class="card shadow-sm h-100">

                        <div class="card-body">

                            <h5 class="card-title">
                                🩺 Programar cita
                            </h5>

                            <p class="card-text text-muted">
                                Seleccione una especialidad, médico,
                                fecha y horario disponible.
                            </p>

                            <a
                                href="<?php echo APP_URL; ?>/citas/create"
                                class="btn btn-primary">

                                Programar cita

                            </a>

                        </div>

                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <div class="card shadow-sm h-100">

                        <div class="card-body">

                            <h5 class="card-title">
                                📅 Mis citas
                            </h5>

                            <p class="card-text text-muted">
                                Consulte sus próximas citas y su historial.
                            </p>

                            <a
                                href="<?php echo APP_URL; ?>/citas/mis-citas"
                                class="btn btn-outline-primary">

                                Ver mis citas

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body">

                        <h5 class="card-title">
                            Especialidades
                        </h5>

                        <p class="card-text text-muted">
                            Consulte las especialidades disponibles.
                        </p>

                        <a
                            href="<?= APP_URL ?>/especialidades"
                            class="btn btn-primary">
                            Ver especialidades
                        </a>

                    </div>

                </div>

            </div>

            <div class="col-md-4 mb-3">

                <div class="card shadow-sm h-100">

                    <div class="card-body">

                        <h5 class="card-title">
                            👤 Mi perfil
                        </h5>

                        <p class="card-text text-muted">
                            Consulte y actualice su información personal.
                        </p>

                        <a
                            href="<?php echo APP_URL; ?>/perfil"
                            class="btn btn-outline-primary">

                            Ver perfil

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>