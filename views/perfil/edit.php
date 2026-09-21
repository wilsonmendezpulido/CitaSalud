<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>Editar mi información</h2>

            <p class="text-muted mb-0">
                Actualice sus datos personales.
            </p>

        </div>

        <a
            href="<?php echo APP_URL; ?>/perfil"
            class="btn btn-outline-secondary">

            ← Volver

        </a>

    </div>


    <?php if (!empty($errors)): ?>

        <div class="alert alert-danger">

            <strong>
                Revise la información:
            </strong>

            <ul class="mb-0">

                <?php foreach ($errors as $error): ?>

                    <li>
                        <?php
                        echo htmlspecialchars($error);
                        ?>
                    </li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>


    <div class="card shadow-sm">

        <div class="card-body">

            <form
                method="POST"
                action="<?php echo APP_URL; ?>/perfil/update">

                <?php echo Security::csrfField(); ?>
                <div class="row">

                    <!-- Documento -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Documento
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?php
                                    echo htmlspecialchars(
                                        $paciente['documento']
                                    );
                                    ?>"
                            readonly>

                        <div class="form-text">
                            El documento no puede modificarse.
                        </div>

                    </div>


                    <!-- Nombre -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="nombre"
                            class="form-label">
                            Nombre *
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="form-control"
                            value="<?php
                                    echo htmlspecialchars(
                                        $paciente['nombre']
                                    );
                                    ?>"
                            required>

                    </div>


                    <!-- Apellido -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="apellido"
                            class="form-label">
                            Apellido *
                        </label>

                        <input
                            type="text"
                            id="apellido"
                            name="apellido"
                            class="form-control"
                            value="<?php
                                    echo htmlspecialchars(
                                        $paciente['apellido']
                                    );
                                    ?>"
                            required>

                    </div>


                    <!-- Fecha nacimiento -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="fecha_nacimiento"
                            class="form-label">
                            Fecha de nacimiento
                        </label>

                        <input
                            type="date"
                            id="fecha_nacimiento"
                            name="fecha_nacimiento"
                            class="form-control"
                            value="<?php
                                    echo htmlspecialchars(
                                        $paciente['fecha_nacimiento']
                                    );
                                    ?>">

                    </div>


                    <!-- Teléfono -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="telefono"
                            class="form-label">
                            Teléfono
                        </label>

                        <input
                            type="text"
                            id="telefono"
                            name="telefono"
                            class="form-control"
                            value="<?php
                                    echo htmlspecialchars(
                                        $paciente['telefono']
                                    );
                                    ?>">

                    </div>


                    <!-- Dirección -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="direccion"
                            class="form-label">
                            Dirección
                        </label>

                        <input
                            type="text"
                            id="direccion"
                            name="direccion"
                            class="form-control"
                            value="<?php
                                    echo htmlspecialchars(
                                        $paciente['direccion']
                                    );
                                    ?>">

                    </div>


                    <!-- Email -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="email"
                            class="form-label">
                            Correo electrónico *
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="<?php
                                    echo htmlspecialchars(
                                        $paciente['email']
                                    );
                                    ?>"
                            required>

                    </div>


                    <!-- EPS -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="eps"
                            class="form-label">
                            EPS
                        </label>

                        <input
                            type="text"
                            id="eps"
                            name="eps"
                            class="form-control"
                            value="<?php
                                    echo htmlspecialchars(
                                        $paciente['eps']
                                    );
                                    ?>">

                    </div>


                    <!-- Sexo -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="sexo"
                            class="form-label">
                            Sexo
                        </label>

                        <select
                            id="sexo"
                            name="sexo"
                            class="form-select">

                            <option value="">
                                Seleccione
                            </option>

                            <option
                                value="M"
                                <?php
                                echo $paciente['sexo'] === 'M'
                                    ? 'selected'
                                    : '';
                                ?>>
                                Masculino
                            </option>

                            <option
                                value="F"
                                <?php
                                echo $paciente['sexo'] === 'F'
                                    ? 'selected'
                                    : '';
                                ?>>
                                Femenino
                            </option>

                            <option
                                value="OTRO"
                                <?php
                                echo $paciente['sexo'] === 'OTRO'
                                    ? 'selected'
                                    : '';
                                ?>>
                                Otro
                            </option>

                            <option
                                value="NO_INFORMA"
                                <?php
                                echo $paciente['sexo'] === 'NO_INFORMA'
                                    ? 'selected'
                                    : '';
                                ?>>
                                Prefiero no informar
                            </option>

                        </select>

                    </div>


                    <!-- Discapacidad -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="discapacidad"
                            class="form-label">
                            Discapacidad
                        </label>

                        <select
                            id="discapacidad"
                            name="discapacidad"
                            class="form-select">

                            <option
                                value="0"
                                <?php
                                echo (int)$paciente['discapacidad'] === 0
                                    ? 'selected'
                                    : '';
                                ?>>
                                No
                            </option>

                            <option
                                value="1"
                                <?php
                                echo (int)$paciente['discapacidad'] === 1
                                    ? 'selected'
                                    : '';
                                ?>>
                                Sí
                            </option>

                        </select>

                    </div>

                </div>


                <hr class="my-4">


                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="<?php echo APP_URL; ?>/perfil"
                        class="btn btn-outline-secondary">

                        Cancelar

                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary">

                        Guardar cambios

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>