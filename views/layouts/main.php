<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?= APP_NAME ?>
    </title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        .navbar-brand {
            letter-spacing: 0.2px;
        }

        .navbar-brand i {
            font-size: 1.25rem;
            vertical-align: -1px;
        }

        .page-title {
            font-weight: 600;
            color: #212529;
        }

        .page-header {
            margin-bottom: 1.5rem;
        }

    </style>

</head>

<body>

    <!-- Barra de navegación -->

    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm">

        <div class="container">

            <a
                class="navbar-brand fw-bold"
                href="<?= APP_URL ?>/dashboard">

                <i class="bi bi-heart-pulse me-2"></i>

                <?= APP_NAME ?>

            </a>

        </div>

    </nav>


    <!-- Contenido -->

    <main>

        <?php

        if (isset($titulo)) {

            echo '<div class="container pt-4 page-header">';

            echo '<h2 class="page-title">';

            echo '<i class="bi bi-grid-1x2 me-2 text-primary"></i>';

            echo htmlspecialchars($titulo);

            echo '</h2>';

            echo '</div>';
        }

        ?>

    </main>


    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- CitaSalud API -->

    <script src="<?php echo APP_URL; ?>/js/api.js"></script>

</body>

</html>