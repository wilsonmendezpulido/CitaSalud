<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Detalle del paciente</h2>
            <p class="text-muted mb-0">
                Información registrada del paciente.
            </p>
        </div>

        <div>
            <a href="<?php echo APP_URL; ?>/pacientes"
                class="btn btn-secondary">
                ← Volver
            </a>

            <a href="<?php echo APP_URL; ?>/pacientes/edit?id=<?php echo (int)$paciente['id']; ?>"
                class="btn btn-primary">
                Editar
            </a>
        </div>
    </div>


    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <strong>Información personal</strong>
        </div>

        <div class="card-body">

            <div class="row">

                <!-- ID -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">ID</label>
                    <div>
                        <?php echo (int)$paciente['id']; ?>
                    </div>
                </div>

                <!-- Usuario -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Usuario ID</label>
                    <div>
                        <?php echo htmlspecialchars($paciente['usuario_id']); ?>
                    </div>
                </div>

                <!-- Documento -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Documento</label>
                    <div>
                        <?php echo htmlspecialchars($paciente['documento']); ?>
                    </div>
                </div>

                <!-- Nombre -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Nombre completo</label>
                    <div>
                        <?php
                        echo htmlspecialchars(
                            $paciente['nombre'] . ' ' . $paciente['apellido']
                        );
                        ?>
                    </div>
                </div>

                <!-- Fecha nacimiento -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Fecha de nacimiento</label>
                    <div>
                        <?php
                        echo !empty($paciente['fecha_nacimiento'])
                            ? htmlspecialchars($paciente['fecha_nacimiento'])
                            : 'No registrada';
                        ?>
                    </div>
                </div>

                <!-- Teléfono -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Teléfono</label>
                    <div>
                        <?php
                        echo !empty($paciente['telefono'])
                            ? htmlspecialchars($paciente['telefono'])
                            : 'No registrado';
                        ?>
                    </div>
                </div>

                <!-- Dirección -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Dirección</label>
                    <div>
                        <?php
                        echo !empty($paciente['direccion'])
                            ? htmlspecialchars($paciente['direccion'])
                            : 'No registrada';
                        ?>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Correo electrónico</label>
                    <div>
                        <?php
                        echo !empty($paciente['email'])
                            ? htmlspecialchars($paciente['email'])
                            : 'No registrado';
                        ?>
                    </div>
                </div>

                <!-- EPS -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">EPS</label>
                    <div>
                        <?php
                        echo !empty($paciente['eps'])
                            ? htmlspecialchars($paciente['eps'])
                            : 'No registrada';
                        ?>
                    </div>
                </div>

                <!-- Sexo -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Sexo</label>
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

                <!-- Discapacidad -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Discapacidad</label>
                    <div>

                        <?php if ((int)$paciente['discapacidad'] === 1): ?>

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

                <!-- Estado -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Estado</label>
                    <div>

                        <?php if ((int)$paciente['estado'] === 1): ?>

                            <span class="badge bg-success">
                                Activo
                            </span>

                        <?php else: ?>

                            <span class="badge bg-danger">
                                Inactivo
                            </span>

                        <?php endif; ?>

                    </div>
                </div>

                <!-- Fecha creación -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Fecha de creación</label>
                    <div>
                        <?php
                        echo !empty($paciente['created_at'])
                            ? htmlspecialchars($paciente['created_at'])
                            : 'No disponible';
                        ?>
                    </div>
                </div>

                <!-- Fecha actualización -->
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Última actualización</label>
                    <div>
                        <?php
                        echo !empty($paciente['updated_at'])
                            ? htmlspecialchars($paciente['updated_at'])
                            : 'No disponible';
                        ?>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>