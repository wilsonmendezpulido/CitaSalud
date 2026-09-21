<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Seleccionar médico</h2>

            <p class="text-muted mb-0">
                Especialidad seleccionada:
                <strong>
                    <?php echo htmlspecialchars($especialidad['nombre']); ?>
                </strong>
            </p>
        </div>

        <a
            href="<?php echo APP_URL; ?>/citas/create"
            class="btn btn-outline-secondary">

            ← Cambiar especialidad

        </a>

    </div>


    <div class="card shadow-sm">

        <div class="card-body">

            <h5 class="card-title mb-4">
                2. Seleccione un médico
            </h5>


            <?php if (empty($medicos)): ?>

                <div class="alert alert-warning">

                    No hay médicos disponibles para esta especialidad.

                </div>

            <?php else: ?>

                <div class="row">

                    <?php foreach ($medicos as $medico): ?>

                        <div class="col-md-6 col-lg-4 mb-4">

                            <div class="card h-100">

                                <div class="card-body">

                                    <div class="text-center mb-3">

                                        <div
                                            style="
                                                width: 80px;
                                                height: 80px;
                                                margin: auto;
                                                border-radius: 50%;
                                                background: #e8f1f8;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                font-size: 40px;
                                            ">

                                            👨‍⚕️

                                        </div>

                                    </div>


                                    <h5 class="text-center">

                                        <?php

                                        echo htmlspecialchars(
                                            $medico['nombre'] .
                                                ' ' .
                                                $medico['apellido']
                                        );

                                        ?>

                                    </h5>


                                    <p class="text-center text-muted">

                                        <?php
                                        echo htmlspecialchars(
                                            $medico['especialidad']
                                        );
                                        ?>

                                    </p>


                                    <?php if (!empty($medico['perfil'])): ?>

                                        <p class="small text-muted">

                                            <?php
                                            echo htmlspecialchars(
                                                $medico['perfil']
                                            );
                                            ?>

                                        </p>

                                    <?php endif; ?>


                                    <?php if (!empty($medico['registro_medico'])): ?>

                                        <p class="small">

                                            <strong>
                                                Registro:
                                            </strong>

                                            <?php
                                            echo htmlspecialchars(
                                                $medico['registro_medico']
                                            );
                                            ?>

                                        </p>

                                    <?php endif; ?>


                                    <div class="d-grid">

                                        <a
                                            href="<?php echo APP_URL; ?>/citas/disponibilidad?medico_id=<?php echo (int)$medico['id']; ?>"
                                            class="btn btn-primary">

                                            Seleccionar médico

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>