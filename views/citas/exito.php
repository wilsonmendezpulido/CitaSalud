<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container mt-5">

    <div class="card shadow-sm">

        <div class="card-body text-center p-5">

            <h2 class="text-success">
                ¡Cita programada correctamente!
            </h2>


            <p class="text-muted">
                Su cita médica ha sido registrada.
            </p>


            <div class="card mt-4">

                <div class="card-body text-start">

                    <p>
                        <strong>Paciente:</strong>

                        <?php
                        echo htmlspecialchars(
                            $cita['paciente_nombre'] .
                                ' ' .
                                $cita['paciente_apellido']
                        );
                        ?>
                    </p>


                    <p>
                        <strong>Especialidad:</strong>

                        <?php
                        echo htmlspecialchars(
                            $cita['especialidad']
                        );
                        ?>
                    </p>


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


                    <p>
                        <strong>Estado:</strong>

                        <span class="badge bg-success">
                            <?php
                            echo htmlspecialchars(
                                $cita['estado']
                            );
                            ?>
                        </span>

                    </p>

                </div>

            </div>


            <div class="mt-4">

                <a
                    href="<?php echo APP_URL; ?>/dashboard"
                    class="btn btn-primary">
                    Ir al dashboard
                </a>


                <a
                    href="<?php echo APP_URL; ?>/citas/create"
                    class="btn btn-outline-primary">
                    Programar otra cita
                </a>

            </div>

        </div>

    </div>

</div>