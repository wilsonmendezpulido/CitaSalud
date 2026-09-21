<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container mt-4">

    <div class="mb-4">

        <h2>Confirmar cita médica</h2>

        <p class="text-muted">
            Revise la información antes de confirmar.
        </p>

    </div>


    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">

            <strong>
                Resumen de la cita
            </strong>

        </div>


        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="fw-bold">
                        Médico
                    </label>

                    <div>

                        <?php
                        echo htmlspecialchars(
                            $detalle['medico_nombre'] .
                                ' ' .
                                $detalle['medico_apellido']
                        );
                        ?>

                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="fw-bold">
                        Especialidad
                    </label>

                    <div>

                        <?php
                        echo htmlspecialchars(
                            $detalle['especialidad']
                        );
                        ?>

                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="fw-bold">
                        Fecha
                    </label>

                    <div>

                        <?php
                        echo date(
                            'd/m/Y',
                            strtotime($detalle['fecha'])
                        );
                        ?>

                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="fw-bold">
                        Horario
                    </label>

                    <div>

                        <?php

                        echo date(
                            'H:i',
                            strtotime(
                                $detalle['hora_inicio']
                            )
                        );

                        echo ' - ';

                        echo date(
                            'H:i',
                            strtotime(
                                $detalle['hora_fin']
                            )
                        );

                        ?>

                    </div>

                </div>

            </div>


            <hr>


            <form
                method="POST"
                action="<?php echo APP_URL; ?>/citas/store">

                <?php echo Security::csrfField(); ?>

                <input
                    type="hidden"
                    name="disponibilidad_id"
                    value="<?php echo (int)$detalle['disponibilidad_id']; ?>">


                <div class="mb-4">

                    <label
                        for="motivo"
                        class="form-label fw-bold">
                        Motivo de consulta
                    </label>

                    <textarea
                        id="motivo"
                        name="motivo"
                        class="form-control"
                        rows="4"
                        maxlength="500"
                        required
                        placeholder="Describa brevemente el motivo de su consulta..."></textarea>

                </div>


                <div class="alert alert-info">

                    <strong>Importante:</strong>

                    Una vez confirmada la cita,
                    este horario será reservado.

                </div>


                <div class="d-flex justify-content-between">

                    <a
                        href="<?php echo APP_URL; ?>/citas/disponibilidad?medico_id=<?php echo (int)$detalle['medico_id']; ?>&fecha=<?php echo urlencode($detalle['fecha']); ?>"
                        class="btn btn-outline-secondary">

                        ← Regresar

                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary">

                        ✓ Confirmar cita

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>