<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container main-container">

    <!-- Encabezado -->
    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

        <div>
            <div class="d-flex align-items-center gap-2 mb-2">
                <div class="profile-header-icon">
                    <i class="bi bi-person-vcard"></i>
                </div>

                <h1 class="page-title mb-0">
                    Mi información
                </h1>
            </div>

            <p class="page-subtitle">
                Mantén actualizados tus datos personales y de contacto.
            </p>
        </div>

        <a
            href="<?= APP_URL ?>/perfil"
            class="btn btn-outline-secondary btn-icon">

            <i class="bi bi-arrow-left"></i>
            Volver al perfil

        </a>

    </div>


    <!-- Errores generales -->
    <?php if (!empty($errors)): ?>

        <div
            class="alert alert-danger alert-dismissible fade show shadow-sm"
            role="alert">

            <div class="d-flex align-items-start gap-3">

                <i class="bi bi-exclamation-triangle-fill fs-4"></i>

                <div>
                    <strong>Hay información que debes revisar.</strong>

                    <ul class="mb-0 mt-2">

                        <?php foreach ($errors as $error): ?>

                            <li>
                                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>
                </div>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <form
        method="POST"
        action="<?= APP_URL ?>/perfil/update"
        id="perfilForm"
        novalidate>

        <?= Security::csrfField(); ?>


        <!-- INFORMACIÓN PERSONAL -->
        <div class="card profile-card shadow-sm mb-4">

            <div class="card-header profile-card-header">

                <div class="d-flex align-items-center gap-3">

                    <div class="section-icon section-icon-primary">
                        <i class="bi bi-person"></i>
                    </div>

                    <div>
                        <h5 class="mb-1">
                            Información personal
                        </h5>

                        <small class="text-muted">
                            Datos básicos del paciente
                        </small>
                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">


                    <!-- Documento -->
                    <div class="col-12 col-md-6">

                        <label
                            for="documento"
                            class="form-label">

                            Documento

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-card-text"></i>
                            </span>

                            <input
                                type="text"
                                id="documento"
                                class="form-control bg-light"
                                value="<?= htmlspecialchars(
                                    $paciente['documento'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>"
                                readonly>

                        </div>

                        <div class="form-text">
                            <i class="bi bi-lock-fill me-1"></i>
                            El documento no puede modificarse.
                        </div>

                    </div>


                    <!-- Nombre -->
                    <div class="col-12 col-md-6">

                        <label
                            for="nombre"
                            class="form-label">

                            Nombre
                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>

                            <input
                                type="text"
                                id="nombre"
                                name="nombre"
                                class="form-control"
                                value="<?= htmlspecialchars(
                                    $paciente['nombre'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>"
                                maxlength="60"
                                autocomplete="given-name"
                                required>

                        </div>

                        <div
                            class="invalid-feedback"
                            id="nombreError">
                        </div>

                    </div>


                    <!-- Apellido -->
                    <div class="col-12 col-md-6">

                        <label
                            for="apellido"
                            class="form-label">

                            Apellido
                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>

                            <input
                                type="text"
                                id="apellido"
                                name="apellido"
                                class="form-control"
                                value="<?= htmlspecialchars(
                                    $paciente['apellido'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>"
                                maxlength="60"
                                autocomplete="family-name"
                                required>

                        </div>

                        <div
                            class="invalid-feedback"
                            id="apellidoError">
                        </div>

                    </div>


                    <!-- Fecha nacimiento -->
                    <div class="col-12 col-md-6">

                        <label
                            for="fecha_nacimiento"
                            class="form-label">

                            Fecha de nacimiento

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-calendar3"></i>
                            </span>

                            <input
                                type="date"
                                id="fecha_nacimiento"
                                name="fecha_nacimiento"
                                class="form-control"
                                value="<?= htmlspecialchars(
                                    $paciente['fecha_nacimiento'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>"
                                max="<?= date('Y-m-d') ?>">

                        </div>

                        <div
                            class="invalid-feedback"
                            id="fechaError">
                        </div>

                    </div>


                    <!-- Sexo -->
                    <div class="col-12 col-md-6">

                        <label
                            for="sexo"
                            class="form-label">

                            Sexo

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-gender-ambiguous"></i>
                            </span>

                            <select
                                id="sexo"
                                name="sexo"
                                class="form-select">

                                <option value="">
                                    Seleccione una opción
                                </option>

                                <option
                                    value="M"
                                    <?= ($paciente['sexo'] ?? '') === 'M'
                                        ? 'selected'
                                        : '' ?>>

                                    Masculino

                                </option>

                                <option
                                    value="F"
                                    <?= ($paciente['sexo'] ?? '') === 'F'
                                        ? 'selected'
                                        : '' ?>>

                                    Femenino

                                </option>

                                <option
                                    value="OTRO"
                                    <?= ($paciente['sexo'] ?? '') === 'OTRO'
                                        ? 'selected'
                                        : '' ?>>

                                    Otro

                                </option>

                                <option
                                    value="NO_INFORMA"
                                    <?= ($paciente['sexo'] ?? '') === 'NO_INFORMA'
                                        ? 'selected'
                                        : '' ?>>

                                    Prefiero no informar

                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- Discapacidad -->
                    <div class="col-12 col-md-6">

                        <label
                            for="discapacidad"
                            class="form-label">

                            ¿Tiene alguna discapacidad?

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-universal-access"></i>
                            </span>

                            <select
                                id="discapacidad"
                                name="discapacidad"
                                class="form-select">

                                <option
                                    value="0"
                                    <?= (int)($paciente['discapacidad'] ?? 0) === 0
                                        ? 'selected'
                                        : '' ?>>

                                    No

                                </option>

                                <option
                                    value="1"
                                    <?= (int)($paciente['discapacidad'] ?? 0) === 1
                                        ? 'selected'
                                        : '' ?>>

                                    Sí

                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- INFORMACIÓN DE CONTACTO -->
        <div class="card profile-card shadow-sm mb-4">

            <div class="card-header profile-card-header">

                <div class="d-flex align-items-center gap-3">

                    <div class="section-icon section-icon-success">
                        <i class="bi bi-telephone"></i>
                    </div>

                    <div>

                        <h5 class="mb-1">
                            Información de contacto
                        </h5>

                        <small class="text-muted">
                            Datos para mantener tu información actualizada
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">


                    <!-- Email -->
                    <div class="col-12 col-md-6">

                        <label
                            for="email"
                            class="form-label">

                            Correo electrónico
                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="<?= htmlspecialchars(
                                    $paciente['email'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>"
                                maxlength="150"
                                autocomplete="email"
                                required>

                        </div>

                        <div
                            class="invalid-feedback"
                            id="emailError">
                        </div>

                    </div>


                    <!-- Teléfono -->
                    <div class="col-12 col-md-6">

                        <label
                            for="telefono"
                            class="form-label">

                            Teléfono

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-phone"></i>
                            </span>

                            <input
                                type="tel"
                                id="telefono"
                                name="telefono"
                                class="form-control"
                                value="<?= htmlspecialchars(
                                    $paciente['telefono'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>"
                                maxlength="15"
                                inputmode="numeric"
                                autocomplete="tel"
                                placeholder="Ej. 3001234567">

                        </div>

                        <div
                            class="invalid-feedback"
                            id="telefonoError">
                        </div>

                    </div>


                    <!-- Dirección -->
                    <div class="col-12">

                        <label
                            for="direccion"
                            class="form-label">

                            Dirección

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-geo-alt"></i>
                            </span>

                            <input
                                type="text"
                                id="direccion"
                                name="direccion"
                                class="form-control"
                                value="<?= htmlspecialchars(
                                    $paciente['direccion'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>"
                                maxlength="200"
                                autocomplete="street-address"
                                placeholder="Ingrese su dirección">

                        </div>

                        <div class="d-flex justify-content-end">
                            <small
                                class="text-muted"
                                id="direccionCounter">
                                0/200
                            </small>
                        </div>

                    </div>


                    <!-- EPS -->
                    <div class="col-12 col-md-6">

                        <label
                            for="eps"
                            class="form-label">

                            EPS

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-hospital"></i>
                            </span>

                            <input
                                type="text"
                                id="eps"
                                name="eps"
                                class="form-control"
                                value="<?= htmlspecialchars(
                                    $paciente['eps'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>"
                                maxlength="100"
                                placeholder="Nombre de la EPS">

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- ACCIONES -->
        <div class="profile-actions">

            <a
                href="<?= APP_URL ?>/perfil"
                class="btn btn-outline-secondary btn-icon">

                <i class="bi bi-x-lg"></i>
                Cancelar

            </a>

            <button
                type="submit"
                class="btn btn-primary btn-icon px-4"
                id="btnGuardar">

                <i class="bi bi-check-lg"></i>

                <span id="btnGuardarText">
                    Guardar cambios
                </span>

                <span
                    id="btnGuardarSpinner"
                    class="spinner-border spinner-border-sm d-none"
                    role="status">
                </span>

            </button>

        </div>

    </form>

</div>


<style>

.profile-header-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: #e7f1ff;
    color: #0d6efd;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.profile-card {
    border: 0;
    border-radius: 16px;
    overflow: hidden;
}

.profile-card-header {
    background: #fff;
    border-bottom: 1px solid #edf0f2;
    padding: 20px 24px;
}

.section-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.section-icon-primary {
    background: #e7f1ff;
    color: #0d6efd;
}

.section-icon-success {
    background: #e8f7ef;
    color: #198754;
}

.input-group-text {
    background: #f8f9fa;
    border-color: #dee2e6;
    color: #6c757d;
    min-width: 44px;
    justify-content: center;
}

.form-control,
.form-select {
    min-height: 46px;
}

.form-control:focus,
.form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .12);
}

.form-control.is-valid,
.form-select.is-valid {
    border-color: #198754;
    background-image: none;
}

.form-control.is-invalid,
.form-select.is-invalid {
    background-image: none;
}

.invalid-feedback {
    font-size: .82rem;
}

.profile-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding: 4px 0 30px;
}

@media (max-width: 575.98px) {

    .profile-card-header {
        padding: 18px;
    }

    .profile-card .card-body {
        padding: 18px !important;
    }

    .profile-actions {
        flex-direction: column-reverse;
    }

    .profile-actions .btn {
        width: 100%;
    }

}

</style>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('perfilForm');

    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    const email = document.getElementById('email');
    const telefono = document.getElementById('telefono');
    const fecha = document.getElementById('fecha_nacimiento');
    const direccion = document.getElementById('direccion');

    const btnGuardar = document.getElementById('btnGuardar');
    const btnText = document.getElementById('btnGuardarText');
    const spinner = document.getElementById('btnGuardarSpinner');

    const nombreError = document.getElementById('nombreError');
    const apellidoError = document.getElementById('apellidoError');
    const emailError = document.getElementById('emailError');
    const telefonoError = document.getElementById('telefonoError');
    const fechaError = document.getElementById('fechaError');


    function limpiarCampo(campo, mensaje) {

        campo.classList.remove('is-valid');
        campo.classList.remove('is-invalid');

        const error = document.getElementById(
            campo.id + 'Error'
        );

        if (error) {
            error.textContent = '';
        }

    }


    function validarNombre(campo, errorElement, texto) {

        const valor = campo.value.trim();

        campo.value = valor;

        if (valor === '') {

            campo.classList.add('is-invalid');
            errorElement.textContent =
                texto + ' es obligatorio.';

            return false;
        }

        if (valor.length < 2) {

            campo.classList.add('is-invalid');
            errorElement.textContent =
                texto + ' debe tener al menos 2 caracteres.';

            return false;
        }

        if (!/^[\p{L}\s'-]+$/u.test(valor)) {

            campo.classList.add('is-invalid');
            errorElement.textContent =
                texto + ' contiene caracteres no válidos.';

            return false;
        }

        campo.classList.add('is-valid');

        return true;
    }


    function validarEmail() {

        const valor = email.value.trim();

        email.value = valor;

        if (valor === '') {

            email.classList.add('is-invalid');
            emailError.textContent =
                'El correo electrónico es obligatorio.';

            return false;
        }

        const regex =
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!regex.test(valor)) {

            email.classList.add('is-invalid');
            emailError.textContent =
                'Ingrese un correo electrónico válido.';

            return false;
        }

        email.classList.add('is-valid');

        return true;
    }


    function validarTelefono() {

        const valor = telefono.value.trim();

        telefono.value = valor;

        if (valor === '') {

            telefono.classList.remove('is-invalid');
            telefono.classList.remove('is-valid');

            return true;
        }

        if (!/^\d{7,15}$/.test(valor)) {

            telefono.classList.add('is-invalid');
            telefonoError.textContent =
                'Ingrese entre 7 y 15 dígitos.';

            return false;
        }

        telefono.classList.add('is-valid');

        return true;
    }


    function validarFecha() {

        const valor = fecha.value;

        if (valor === '') {
            return true;
        }

        const seleccionada =
            new Date(valor + 'T00:00:00');

        const hoy = new Date();

        hoy.setHours(0, 0, 0, 0);

        if (seleccionada > hoy) {

            fecha.classList.add('is-invalid');

            fechaError.textContent =
                'La fecha no puede ser futura.';

            return false;
        }

        fecha.classList.add('is-valid');

        return true;
    }


    function validarFormulario() {

        let valido = true;

        if (
            !validarNombre(
                nombre,
                nombreError,
                'El nombre'
            )
        ) {
            valido = false;
        }

        if (
            !validarNombre(
                apellido,
                apellidoError,
                'El apellido'
            )
        ) {
            valido = false;
        }

        if (!validarEmail()) {
            valido = false;
        }

        if (!validarTelefono()) {
            valido = false;
        }

        if (!validarFecha()) {
            valido = false;
        }

        return valido;
    }


    nombre.addEventListener('blur', function () {

        validarNombre(
            nombre,
            nombreError,
            'El nombre'
        );

    });


    apellido.addEventListener('blur', function () {

        validarNombre(
            apellido,
            apellidoError,
            'El apellido'
        );

    });


    email.addEventListener('blur', function () {

        validarEmail();

    });


    telefono.addEventListener('input', function () {

        this.value =
            this.value.replace(/\D/g, '');

    });


    telefono.addEventListener('blur', function () {

        validarTelefono();

    });


    fecha.addEventListener('change', function () {

        validarFecha();

    });


    direccion.addEventListener('input', function () {

        const counter =
            document.getElementById(
                'direccionCounter'
            );

        counter.textContent =
            this.value.length + '/200';

    });


    // Inicializar contador
    direccion.dispatchEvent(
        new Event('input')
    );


    form.addEventListener('submit', function (event) {

        event.preventDefault();

        if (!validarFormulario()) {

            const primerError =
                form.querySelector('.is-invalid');

            if (primerError) {
                primerError.focus();
            }

            return;
        }


        btnGuardar.disabled = true;

        btnText.textContent =
            'Guardando...';

        spinner.classList.remove('d-none');


        // Enviar formulario después
        // de completar las validaciones.

        form.submit();

    });

});

</script>