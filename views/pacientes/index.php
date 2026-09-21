<?php

$pacientes = isset($pacientes)
    ? $pacientes
    : array();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Pacientes - CitaSalud</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary">

        <div class="container">

            <a
                href="<?= APP_URL ?>/dashboard"
                class="navbar-brand fw-bold">
                CitaSalud
            </a>

            <a
                href="<?= APP_URL ?>/logout"
                class="btn btn-light btn-sm">
                Cerrar sesión
            </a>

        </div>

    </nav>

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h1 class="h3 mb-1">
                    Gestión de pacientes
                </h1>

                <p class="text-muted mb-0">
                    Administración de información de pacientes.
                </p>

            </div>

            <a
                href="<?= APP_URL ?>/pacientes/create"
                class="btn btn-primary">
                + Nuevo paciente
            </a>

        </div>

        <?php if (isset($_GET['success'])): ?>

            <div class="alert alert-success">

                <?php if ($_GET['success'] === 'created'): ?>

                    Paciente registrado correctamente.

                <?php elseif ($_GET['success'] === 'updated'): ?>

                    Paciente actualizado correctamente.

                <?php elseif ($_GET['success'] === 'deleted'): ?>

                    Paciente desactivado correctamente.

                <?php endif; ?>

            </div>

        <?php endif; ?>

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>Documento</th>

                                <th>Paciente</th>

                                <th>Teléfono</th>

                                <th>Correo</th>

                                <th>EPS</th>

                                <th class="text-end">
                                    Acciones
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (empty($pacientes)): ?>

                                <tr>

                                    <td
                                        colspan="6"
                                        class="text-center text-muted py-4">
                                        No existen pacientes registrados.
                                    </td>

                                </tr>

                            <?php else: ?>

                                <?php foreach ($pacientes as $paciente): ?>

                                    <tr>

                                        <td>
                                            <?= htmlspecialchars($paciente['documento']) ?>
                                        </td>

                                        <td>

                                            <strong>
                                                <?= htmlspecialchars(
                                                    $paciente['nombre'] . ' ' .
                                                        $paciente['apellido']
                                                ) ?>
                                            </strong>

                                        </td>

                                        <td>
                                            <?= htmlspecialchars($paciente['telefono']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($paciente['email']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($paciente['eps']) ?>
                                        </td>

                                        <td class="text-end">

                                            <a
                                                href="<?= APP_URL ?>/pacientes/show?id=<?= $paciente['id'] ?>"
                                                class="btn btn-sm btn-outline-primary">
                                                Ver
                                            </a>

                                            <a
                                                href="<?= APP_URL ?>/pacientes/edit?id=<?= $paciente['id'] ?>"
                                                class="btn btn-sm btn-outline-secondary">
                                                Editar
                                            </a>

                                            <a
                                                href="<?= APP_URL ?>/pacientes/delete?id=<?= $paciente['id'] ?>"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('¿Desea desactivar este paciente?');">
                                                Desactivar
                                            </a>
                                            

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</body>

</html>