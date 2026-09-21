<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Editar paciente</h2>
            <p class="text-muted mb-0">
                Actualiza la información del paciente.
            </p>
        </div>

        <a href="<?php echo APP_URL; ?>/pacientes"
            class="btn btn-secondary">
            ← Volver
        </a>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST"
                action="<?php echo APP_URL; ?>/pacientes/update?id=<?php echo (int)$paciente['id']; ?>">

                <div class="row">

                    <!-- Usuario -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Usuario ID
                        </label>

                        <input
                            type="number"
                            name="usuario_id"
                            class="form-control"
                            value="<?php echo htmlspecialchars($paciente['usuario_id']); ?>"
                            required>
                    </div>

                    <!-- Documento -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Documento
                        </label>

                        <input
                            type="text"
                            name="documento"
                            class="form-control"
                            value="<?php echo htmlspecialchars($paciente['documento']); ?>"
                            required>
                    </div>

                    <!-- Nombre -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Nombre
                        </label>

                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            value="<?php echo htmlspecialchars($paciente['nombre']); ?>"
                            required>
                    </div>

                    <!-- Apellido -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Apellido
                        </label>

                        <input
                            type="text"
                            name="apellido"
                            class="form-control"
                            value="<?php echo htmlspecialchars($paciente['apellido']); ?>"
                            required>
                    </div>

                    <!-- Fecha nacimiento -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Fecha de nacimiento
                        </label>

                        <input
                            type="date"
                            name="fecha_nacimiento"
                            class="form-control"
                            value="<?php echo htmlspecialchars($paciente['fecha_nacimiento']); ?>">
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Teléfono
                        </label>

                        <input
                            type="text"
                            name="telefono"
                            class="form-control"
                            value="<?php echo htmlspecialchars($paciente['telefono']); ?>">
                    </div>

                    <!-- Dirección -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Dirección
                        </label>

                        <input
                            type="text"
                            name="direccion"
                            class="form-control"
                            value="<?php echo htmlspecialchars($paciente['direccion']); ?>">
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="<?php echo htmlspecialchars($paciente['email']); ?>"
                            required>
                    </div>

                    <!-- EPS -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            EPS
                        </label>

                        <input
                            type="text"
                            name="eps"
                            class="form-control"
                            value="<?php echo htmlspecialchars($paciente['eps']); ?>">
                    </div>

                    <!-- Sexo -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Sexo
                        </label>

                        <select name="sexo" class="form-select">

                            <option value="">
                                Seleccione
                            </option>

                            <option value="M"
                                <?php echo ($paciente['sexo'] === 'M') ? 'selected' : ''; ?>>
                                Masculino
                            </option>

                            <option value="F"
                                <?php echo ($paciente['sexo'] === 'F') ? 'selected' : ''; ?>>
                                Femenino
                            </option>

                            <option value="OTRO"
                                <?php echo ($paciente['sexo'] === 'OTRO') ? 'selected' : ''; ?>>
                                Otro
                            </option>

                            <option value="NO_INFORMA"
                                <?php echo ($paciente['sexo'] === 'NO_INFORMA') ? 'selected' : ''; ?>>
                                Prefiero no informar
                            </option>

                        </select>
                    </div>

                    <!-- Discapacidad -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Discapacidad
                        </label>

                        <select name="discapacidad" class="form-select">

                            <option value="0"
                                <?php echo ((int)$paciente['discapacidad'] === 0) ? 'selected' : ''; ?>>
                                No
                            </option>

                            <option value="1"
                                <?php echo ((int)$paciente['discapacidad'] === 1) ? 'selected' : ''; ?>>
                                Sí
                            </option>

                        </select>
                    </div>

                </div>

                <hr>

                <div class="d-flex justify-content-end gap-2">

                    <a href="<?php echo APP_URL; ?>/pacientes"
                        class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                    <button type="submit"
                        class="btn btn-primary">
                        Guardar cambios
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>