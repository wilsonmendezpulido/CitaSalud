<?php

$error = isset($error) ? $error : null;

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Iniciar sesión - CitaSalud</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container">

        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-md-5 col-lg-4">

                <div class="card shadow-sm border-0">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">

                            <h1 class="h3 fw-bold text-primary">
                                CitaSalud
                            </h1>

                            <p class="text-muted">
                                Sistema de Gestión de Citas Médicas
                            </p>

                        </div>

                        <?php if ($error): ?>

                            <div
                                class="alert alert-danger"
                                role="alert">
                                <?= htmlspecialchars($error) ?>
                            </div>

                        <?php endif; ?>

                        <form
                            method="POST"
                            action="<?= APP_URL ?>/login">
                            <?php echo Security::csrfField(); ?>
                            <div class="mb-3">

                                <label
                                    for="email"
                                    class="form-label">
                                    Correo electrónico
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    required
                                    autocomplete="email">

                            </div>

                            <div class="mb-3">

                                <label
                                    for="password"
                                    class="form-label">
                                    Contraseña
                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="current-password">

                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100">
                                Ingresar
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>