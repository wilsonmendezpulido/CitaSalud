<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container mt-4">

    <div class="mb-4">

        <h2>Programar cita médica</h2>

        <p class="text-muted">
            Seleccione la especialidad médica que necesita.
        </p>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <h5 class="card-title mb-4">
                1. Seleccione una especialidad
            </h5>

            <div class="row">

                <?php foreach ($especialidades as $especialidad): ?>

                    <div class="col-md-4 mb-3">

                        <div class="card h-100 border">

                            <div class="card-body text-center">

                                <div class="mb-3">
                                    <span style="font-size: 40px;">
                                        🩺
                                    </span>
                                </div>

                                <h5>
                                    <?php
                                    echo htmlspecialchars(
                                        $especialidad['nombre']
                                    );
                                    ?>
                                </h5>

                                <p class="text-muted">

                                    <?php
                                    echo !empty($especialidad['descripcion'])
                                        ? htmlspecialchars(
                                            $especialidad['descripcion']
                                        )
                                        : 'Consulta médica especializada.';
                                    ?>

                                </p>

                                <a
                                    href="<?php echo APP_URL; ?>/citas/medicos?especialidad_id=<?php echo (int)$especialidad['id']; ?>"
                                    class="btn btn-primary">

                                    Seleccionar

                                </a>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</div>