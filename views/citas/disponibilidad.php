<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>Disponibilidad médica</h2>

            <p class="text-muted mb-0">

                Médico:
                <strong>
                    <?php
                    echo htmlspecialchars(
                        $medico['nombre'] . ' ' . $medico['apellido']
                    );
                    ?>
                </strong>

                <br>

                Especialidad:
                <strong>
                    <?php
                    echo htmlspecialchars(
                        $medico['especialidad']
                    );
                    ?>
                </strong>

            </p>

        </div>

        <a
            href="<?php echo APP_URL; ?>/citas/medicos?especialidad_id=<?php echo (int)$medico['especialidad_id']; ?>"
            class="btn btn-outline-secondary">

            ← Cambiar médico

        </a>

    </div>


    <div class="card shadow-sm">

        <div class="card-body">

            <h5 class="card-title mb-4">
                3. Seleccione una fecha
            </h5>


            <?php if (empty($fechas)): ?>

                <div class="alert alert-warning">

                    Actualmente no hay fechas disponibles
                    para este médico.

                </div>

            <?php else: ?>

                <div class="row">

                    <?php foreach ($fechas as $fecha): ?>

                        <?php
                        $fechaValor = $fecha['fecha'];

                        $fechaFormateada = date(
                            'd/m/Y',
                            strtotime($fechaValor)
                        );

                        $diaSemana = date(
                            'l',
                            strtotime($fechaValor)
                        );

                        $dias = array(
                            'Monday' => 'Lunes',
                            'Tuesday' => 'Martes',
                            'Wednesday' => 'Miércoles',
                            'Thursday' => 'Jueves',
                            'Friday' => 'Viernes',
                            'Saturday' => 'Sábado',
                            'Sunday' => 'Domingo'
                        );

                        $dia = isset($dias[$diaSemana])
                            ? $dias[$diaSemana]
                            : $diaSemana;
                        ?>

                        <div class="col-md-4 col-lg-3 mb-3">

                            <a
                                href="<?php echo APP_URL; ?>/citas/disponibilidad?medico_id=<?php echo (int)$medico['id']; ?>&fecha=<?php echo urlencode($fechaValor); ?>"
                                class="text-decoration-none">

                                <div
                                    class="card h-100
                                    <?php
                                    echo (
                                        $fechaSeleccionada === $fechaValor
                                    )
                                        ? 'border-primary bg-light'
                                        : '';
                                    ?>">

                                    <div class="card-body text-center">

                                        <div class="text-primary mb-2">
                                            📅
                                        </div>

                                        <h6>
                                            <?php echo $dia; ?>
                                        </h6>

                                        <strong>
                                            <?php
                                            echo $fechaFormateada;
                                            ?>
                                        </strong>

                                    </div>

                                </div>

                            </a>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>


            <?php if (!empty($fechaSeleccionada)): ?>

                <hr class="my-4">

                <h5 class="mb-4">
                    4. Seleccione una hora
                </h5>


                <?php if (empty($horarios)): ?>

                    <div class="alert alert-warning">

                        No hay horarios disponibles para
                        la fecha seleccionada.

                    </div>

                <?php else: ?>

                    <div class="row">

                        <?php foreach ($horarios as $horario): ?>

                            <div class="col-md-3 mb-3">

                                <a
                                    href="<?php echo APP_URL; ?>/citas/confirmar?disponibilidad_id=<?php echo (int)$horario['id']; ?>"
                                    class="btn btn-outline-primary w-100">

                                    🕐

                                    <?php
                                    echo date(
                                        'H:i',
                                        strtotime(
                                            $horario['hora_inicio']
                                        )
                                    );
                                    ?>

                                    -

                                    <?php
                                    echo date(
                                        'H:i',
                                        strtotime(
                                            $horario['hora_fin']
                                        )
                                    );
                                    ?>

                                </a>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

            <?php endif; ?>

        </div>

    </div>

</div>