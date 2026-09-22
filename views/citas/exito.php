<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container container mt-5">

    <div class="card shadow-sm">

        <div class="card-body text-center p-5">

            <!-- Icono de éxito -->

            <div
                class="mb-4"
                style="
                    width: 90px;
                    height: 90px;
                    margin: auto;
                    border-radius: 50%;
                    background: #d1e7dd;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 48px;
                ">

                ✓

            </div>


            <h2 class="text-success">
                ¡Cita programada correctamente!
            </h2>


            <p class="text-muted">
                Su cita médica ha sido registrada exitosamente.
            </p>


            <!-- Indicador de operación -->

            <div class="mb-4">

                <span class="badge bg-success">

                    ✓ Cita registrada

                </span>

            </div>


            <!-- Resumen -->

            <div class="card mt-4">

                <div class="card-header text-start">

                    <strong>
                        Resumen de la cita
                    </strong>

                </div>


                <div class="card-body text-start">


                    <div class="row">

                        <!-- Paciente -->

                        <div class="col-md-6 mb-3">

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


                        <!-- Especialidad -->

                        <div class="col-md-6 mb-3">

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


                        <!-- Médico -->

                        <div class="col-md-6 mb-3">

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


                        <!-- Fecha -->

                        <div class="col-md-3 mb-3">

                            <label class="fw-bold">
                                Fecha
                            </label>

                            <div>

                                <?php
                                echo date(
                                    'd/m/Y',
                                    strtotime(
                                        $cita['fecha']
                                    )
                                );
                                ?>

                            </div>

                        </div>


                        <!-- Hora -->

                        <div class="col-md-3 mb-3">

                            <label class="fw-bold">
                                Hora
                            </label>

                            <div>

                                <?php
                                echo date(
                                    'H:i',
                                    strtotime(
                                        $cita['hora']
                                    )
                                );
                                ?>

                            </div>

                        </div>


                        <!-- Estado -->

                        <div class="col-md-12">

                            <label class="fw-bold">
                                Estado
                            </label>

                            <div>

                                <span class="badge bg-success">

                                    <?php
                                    echo htmlspecialchars(
                                        $cita['estado']
                                    );
                                    ?>

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Mensaje informativo -->

            <div class="alert alert-success text-start mt-4">

                <strong>¡Listo!</strong>

                Su cita ha quedado registrada en el sistema.
                Puede consultar sus citas programadas desde
                la opción <strong>Mis citas</strong>.

            </div>


            <!-- Acciones -->

            <div class="mt-4">

                <a
                    href="<?php echo APP_URL; ?>/dashboard"
                    class="btn btn-primary me-2">

                    Ir al dashboard

                </a>


                <a
                    href="<?php echo APP_URL; ?>/citas/mis-citas"
                    class="btn btn-outline-primary me-2">

                    Ver mis citas

                </a>


                <a
                    href="<?php echo APP_URL; ?>/citas/create"
                    class="btn btn-outline-secondary">

                    Programar otra cita

                </a>

            </div>

        </div>

    </div>

</div>