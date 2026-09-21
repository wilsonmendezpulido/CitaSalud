<?php

$data = isset($data)
    ? $data
    : array();

$errors = isset($errors)
    ? $errors
    : array();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Nuevo paciente - CitaSalud</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<div class="container py-4">

    <div class="mb-4">

        <a
            href="<?= APP_URL ?>/pacientes"
            class="text-decoration-none"
        >
            ← Volver a pacientes
        </a>

        <h1 class="h3 mt-3">
            Registrar paciente
        </h1>

    </div>

    <?php if (!empty($errors)): ?>

        <div class="alert alert-danger">

            <strong>
                Revise la información:
            </strong>

            <ul class="mb-0 mt-2">

                <?php foreach ($errors as $error): ?>

                    <li>
                        <?= htmlspecialchars($error) ?>
                    </li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>

    <div class="card shadow-sm border-0">

        <div class="card-body p-4">

            <form
                method="POST"
                action="<?= APP_URL ?>/pacientes/store"
                <?php echo Security::csrfField(); ?>
            >

                <div class="row g-3">

                    <div class="col-md-6">

                        <label
                            for="usuario_id"
                            class="form-label"
                        >
                            ID de usuario
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="usuario_id"
                            name="usuario_id"
                            value="<?= htmlspecialchars(
                                isset($data['usuario_id'])
                                    ? $data['usuario_id']
                                    : ''
                            ) ?>"
                            required
                        >

                        <div class="form-text">
                            Usuario previamente registrado en CitaSalud.
                        </div>

                    </div>

                    <div class="col-md-6">

                        <label
                            for="documento"
                            class="form-label"
                        >
                            Documento
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="documento"
                            name="documento"
                            required
                            value="<?= htmlspecialchars(
                                isset($data['documento'])
                                    ? $data['documento']
                                    : ''
                            ) ?>"
                        >

                    </div>

                    <div class="col-md-6">

                        <label
                            for="nombre"
                            class="form-label"
                        >
                            Nombre
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            required
                            value="<?= htmlspecialchars(
                                isset($data['nombre'])
                                    ? $data['nombre']
                                    : ''
                            ) ?>"
                        >

                    </div>

                    <div class="col-md-6">

                        <label
                            for="apellido"
                            class="form-label"
                        >
                            Apellido
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="apellido"
                            name="apellido"
                            required
                            value="<?= htmlspecialchars(
                                isset($data['apellido'])
                                    ? $data['apellido']
                                    : ''
                            ) ?>"
                        >

                    </div>

                    <div class="col-md-4">

                        <label
                            for="fecha_nacimiento"
                            class="form-label"
                        >
                            Fecha de nacimiento
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            id="fecha_nacimiento"
                            name="fecha_nacimiento"
                            value="<?= htmlspecialchars(
                                isset($data['fecha_nacimiento'])
                                    ? $data['fecha_nacimiento']
                                    : ''
                            ) ?>"
                        >

                    </div>

                    <div class="col-md-4">

                        <label
                            for="telefono"
                            class="form-label"
                        >
                            Teléfono
                        </label>

                        <input
                            type="tel"
                            class="form-control"
                            id="telefono"
                            name="telefono"
                            value="<?= htmlspecialchars(
                                isset($data['telefono'])
                                    ? $data['telefono']
                                    : ''
                            ) ?>"
                        >

                    </div>

                    <div class="col-md-4">

                        <label
                            for="email"
                            class="form-label"
                        >
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            required
                            value="<?= htmlspecialchars(
                                isset($data['email'])
                                    ? $data['email']
                                    : ''
                            ) ?>"
                        >

                    </div>

                    <div class="col-12">

                        <label
                            for="direccion"
                            class="form-label"
                        >
                            Dirección
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="direccion"
                            name="direccion"
                            value="<?= htmlspecialchars(
                                isset($data['direccion'])
                                    ? $data['direccion']
                                    : ''
                            ) ?>"
                        >

                    </div>

                    <div class="col-md-6">

                        <label
                            for="eps"
                            class="form-label"
                        >
                            EPS
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="eps"
                            name="eps"
                            value="<?= htmlspecialchars(
                                isset($data['eps'])
                                    ? $data['eps']
                                    : ''
                            ) ?>"
                        >

                    </div>

                    <div class="col-md-6">

                        <label
                            for="sexo"
                            class="form-label"
                        >
                            Sexo
                        </label>

                        <select
                            class="form-select"
                            id="sexo"
                            name="sexo"
                        >

                            <option value="NO_INFORMA">
                                Prefiero no informar
                            </option>

                            <option value="F">
                                Femenino
                            </option>

                            <option value="M">
                                Masculino
                            </option>

                            <option value="OTRO">
                                Otro
                            </option>

                        </select>

                    </div>

                    <div class="col-12">

                        <label
                            for="discapacidad"
                            class="form-label"
                        >
                            Información de discapacidad
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="discapacidad"
                            name="discapacidad"
                            placeholder="Opcional"
                            value="<?= htmlspecialchars(
                                isset($data['discapacidad'])
                                    ? $data['discapacidad']
                                    : ''
                            ) ?>"
                        >

                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="<?= APP_URL ?>/pacientes"
                        class="btn btn-outline-secondary"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Guardar paciente
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>

</html>