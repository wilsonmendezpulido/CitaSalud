<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Detalle de la cita</h2>

            <p class="text-muted mb-0">
                Información completa de la cita médica.
            </p>
        </div>

        <a
            href="<?php echo APP_URL; ?>/citas/mis-citas"
            class="btn btn-outline-secondary">

            ← Mis citas

        </a>

    </div>


    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">

            <strong>
                Información de la cita
            </strong>

        </div>


        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Paciente
                    </label>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $cita['paciente_nombre'] .
                                ' ' .
                                $cita['paciente_apellido']
                        );
                        ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Documento
                    </label>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $cita['paciente_documento']
                        );
                        ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Especialidad
                    </label>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $cita['especialidad']
                        );
                        ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Médico
                    </label>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $cita['medico_nombre'] .
                                ' ' .
                                $cita['medico_apellido']
                        );
                        ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Fecha
                    </label>

                    <div>
                        <?php
                        echo date(
                            'd/m/Y',
                            strtotime($cita['fecha'])
                        );
                        ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Hora
                    </label>

                    <div>
                        <?php
                        echo date(
                            'H:i',
                            strtotime($cita['hora'])
                        );
                        ?>
                    </div>

                </div>


                <div class="col-md-12 mb-4">

                    <label class="fw-bold">
                        Motivo de consulta
                    </label>

                    <div class="border rounded p-3 bg-light">

                        <?php
                        echo nl2br(
                            htmlspecialchars(
                                $cita['motivo']
                            )
                        );
                        ?>

                    </div>

                </div>


                <?php if (!empty($cita['observaciones'])): ?>

                    <div class="col-md-12 mb-4">

                        <label class="fw-bold">
                            Observaciones
                        </label>

                        <div class="border rounded p-3 bg-light">

                            <?php
                            echo nl2br(
                                htmlspecialchars(
                                    $cita['observaciones']
                                )
                            );
                            ?>

                        </div>

                    </div>

                <?php endif; ?>


                <div class="col-md-6">

                    <label class="fw-bold">
                        Estado
                    </label>

                    <div>

                        <?php

                        $badge = 'secondary';

                        if ($cita['estado'] === 'PROGRAMADA') {
                            $badge = 'primary';
                        }

                        if ($cita['estado'] === 'CONFIRMADA') {
                            $badge = 'success';
                        }

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

                    </div>

                </div>

            </div>


            <?php
            $puedeCancelar =
                in_array(
                    $cita['estado'],
                    array(
                        'PROGRAMADA',
                        'CONFIRMADA'
                    )
                );
            ?>


            <?php if ($puedeCancelar): ?>

                <hr class="my-4">


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

            <?php endif; ?>

        </div>

    </div>

</div>