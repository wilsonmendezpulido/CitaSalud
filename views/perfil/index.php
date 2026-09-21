<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container mt-4">

    <?php if (isset($_GET['success'])): ?>

        <?php if ($_GET['success'] === 'updated'): ?>

            <div class="alert alert-success alert-dismissible fade show">

                Perfil actualizado correctamente.

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        <?php endif; ?>

    <?php endif; ?>


    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>Mi perfil</h2>

            <p class="text-muted mb-0">
                Consulte y actualice su información personal.
            </p>

        </div>

        <a
            href="<?php echo APP_URL; ?>/perfil/edit"
            class="btn btn-primary">

            Editar información

        </a>

    </div>


    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">

            <strong>
                Información personal
            </strong>

        </div>


        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Documento
                    </label>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $paciente['documento']
                        );
                        ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Nombre completo
                    </label>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $paciente['nombre'] .
                                ' ' .
                                $paciente['apellido']
                        );
                        ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Fecha de nacimiento
                    </label>

                    <div>
                        <?php
                        echo !empty($paciente['fecha_nacimiento'])
                            ? htmlspecialchars(
                                $paciente['fecha_nacimiento']
                            )
                            : 'No registrada';
                        ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Teléfono
                    </label>

                    <div>
                        <?php
                        echo !empty($paciente['telefono'])
                            ? htmlspecialchars(
                                $paciente['telefono']
                            )
                            : 'No registrado';
                        ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Dirección
                    </label>

                    <div>
                        <?php
                        echo !empty($paciente['direccion'])
                            ? htmlspecialchars(
                                $paciente['direccion']
                            )
                            : 'No registrada';
                        ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Correo electrónico
                    </label>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $paciente['email']
                        );
                        ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        EPS
                    </label>

                    <div>
                        <?php
                        echo !empty($paciente['eps'])
                            ? htmlspecialchars(
                                $paciente['eps']
                            )
                            : 'No registrada';
                        ?>
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Sexo
                    </label>

                    <div>

                        <?php

                        switch ($paciente['sexo']) {

                            case 'M':
                                echo 'Masculino';
                                break;

                            case 'F':
                                echo 'Femenino';
                                break;

                            case 'OTRO':
                                echo 'Otro';
                                break;

                            case 'NO_INFORMA':
                                echo 'Prefiero no informar';
                                break;

                            default:
                                echo 'No registrado';
                                break;
                        }

                        ?>

                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="fw-bold">
                        Discapacidad
                    </label>

                    <div>

                        <?php if (
                            (int)$paciente['discapacidad'] === 1
                        ): ?>

                            <span class="badge bg-info">
                                Sí
                            </span>

                        <?php else: ?>

                            <span class="badge bg-secondary">
                                No
                            </span>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>