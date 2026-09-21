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

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">

        <div class="container">
            <a
                class="navbar-brand fw-bold"
                href="<?= APP_URL ?>/dashboard">
                CitaSalud
            </a>

        </div>

    </nav>

    <main>

        <?php
        if (isset($titulo)) {
            echo '<div class="container pt-4">';
            echo '<h2>' . htmlspecialchars($titulo) . '</h2>';
            echo '</div>';
        }
        ?>

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>