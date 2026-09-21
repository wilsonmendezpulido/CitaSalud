<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Mis citas</h2>

            <p class="text-muted mb-0">
                Consulte sus próximas citas y su historial médico.
            </p>
        </div>

        <a
            href="<?php echo APP_URL; ?>/citas/create"
            class="btn btn-primary">

            + Programar cita

        </a>

    </div>

    <?php if (isset($_GET['success'])): ?>

        <?php if ($_GET['success'] === 'cancelled'): ?>

            <div class="alert alert-success alert-dismissible fade show">

                La cita fue cancelada correctamente.

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        <?php endif; ?>

    <?php endif; ?>

    <!-- PRÓXIMAS CITAS -->

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <strong>
                Próximas citas
            </strong>

        </div>


        <div class="card-body">

            <?php if (empty($proximas)): ?>

                <div class="alert alert-info mb-0">

                    No tiene citas próximas programadas.

                </div>

            <?php else: ?>

                <div class="row">

                    <?php foreach ($proximas as $cita): ?>

                        <div class="col-md-6 mb-3">

                            <div class="card h-100 border">

                                <div class="card-body">

                                    <div class="d-flex justify-content-between">

                                        <h5>
                                            <?php
                                            echo htmlspecialchars(
                                                $cita['especialidad']
                                            );
                                            ?>
                                        </h5>

                                        <span class="badge bg-success">

                                            <?php
                                            echo htmlspecialchars(
                                                $cita['estado']
                                            );
                                            ?>

                                        </span>

                                    </div>


                                    <hr>


                                    <p>
                                        <strong>Médico:</strong>

                                        <?php
                                        echo htmlspecialchars(
                                            $cita['medico_nombre'] .
                                                ' ' .
                                                $cita['medico_apellido']
                                        );
                                        ?>
                                    </p>


                                    <p>
                                        <strong>Fecha:</strong>

                                        <?php
                                        echo date(
                                            'd/m/Y',
                                            strtotime($cita['fecha'])
                                        );
                                        ?>
                                    </p>


                                    <p>
                                        <strong>Hora:</strong>

                                        <?php
                                        echo date(
                                            'H:i',
                                            strtotime($cita['hora'])
                                        );
                                        ?>
                                    </p>


                                    <?php if (!empty($cita['motivo'])): ?>

                                        <p>
                                            <strong>Motivo:</strong>

                                            <?php
                                            echo htmlspecialchars(
                                                $cita['motivo']
                                            );
                                            ?>
                                        </p>

                                    <?php endif; ?>


                                    <div class="d-flex gap-2 mt-3">

                                        <a
                                            href="<?php echo APP_URL; ?>/citas/detalle?id=<?php echo (int)$cita['id']; ?>"
                                            class="btn btn-outline-primary btn-sm">

                                            Ver detalle

                                        </a>
                                        <form method="POST"
                                            action="<?php echo APP_URL; ?>/citas/cancelar"
                                            class="d-inline"
                                            onsubmit="return confirm('¿Está seguro de cancelar esta cita?');">

                                            <input type="hidden"
                                                name="id"
                                                value="<?php echo (int)$cita['id']; ?>">

                                            <?php echo Security::csrfField(); ?>

                                            <button type="submit"
                                                class="btn btn-outline-danger btn-sm">
                                                Cancelar
                                            </button>

                                        </form>


                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </div>


    <!-- HISTORIAL -->

    <div class="card shadow-sm">

        <div class="card-header">

            <strong>
                Historial de citas
            </strong>

        </div>


        <div class="card-body">

            <?php if (empty($historial)): ?>

                <p class="text-muted mb-0">
                    No existen citas en el historial.
                </p>

            <?php else: ?>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th>Fecha</th>
                                <th>Especialidad</th>
                                <th>Médico</th>
                                <th>Estado</th>
                                <th>Acción</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php foreach ($historial as $cita): ?>

                                <tr>

                                    <td>

                                        <?php
                                        echo date(
                                            'd/m/Y',
                                            strtotime($cita['fecha'])
                                        );
                                        ?>

                                    </td>


                                    <td>

                                        <?php
                                        echo htmlspecialchars(
                                            $cita['especialidad']
                                        );
                                        ?>

                                    </td>


                                    <td>

                                        <?php
                                        echo htmlspecialchars(
                                            $cita['medico_nombre'] .
                                                ' ' .
                                                $cita['medico_apellido']
                                        );
                                        ?>

                                    </td>


                                    <td>

                                        <?php

                                        $badge = 'secondary';

                                        if ($cita['estado'] === 'ATENDIDA') {
                                            $badge = 'success';
                                        }

                                        if ($cita['estado'] === 'CANCELADA') {
                                            $badge = 'danger';
                                        }

                                        if ($cita['estado'] === 'NO_ASISTIO') {
                                            $badge = 'warning';
                                        }

                                        ?>

                                        <span
                                            class="badge bg-<?php echo $badge; ?>">

                                            <?php
                                            echo htmlspecialchars(
                                                $cita['estado']
                                            );
                                            ?>

                                        </span>

                                    </td>


                                    <td>

                                        <a
                                            href="<?php echo APP_URL; ?>/citas/detalle?id=<?php echo (int)$cita['id']; ?>"
                                            class="btn btn-sm btn-outline-primary">

                                            Ver

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>