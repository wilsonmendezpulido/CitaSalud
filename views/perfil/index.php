<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container main-container">

    <!-- Mensaje de actualización -->
    <?php if (
        isset($_GET['success']) &&
        $_GET['success'] === 'updated'
    ): ?>

        <div
            class="alert alert-success alert-dismissible fade show shadow-sm profile-success-alert"
            role="alert">

            <div class="d-flex align-items-center gap-3">

                <div class="success-icon">
                    <i class="bi bi-check-lg"></i>
                </div>

                <div>
                    <strong>Perfil actualizado</strong>

                    <div class="small">
                        Tus datos fueron actualizados correctamente.
                    </div>
                </div>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Cerrar">
            </button>

        </div>

    <?php endif; ?>


    <!-- ENCABEZADO -->
    <div class="profile-header mb-4">

        <div class="profile-header-content">

            <div class="profile-avatar">

                <i class="bi bi-person-fill"></i>

            </div>


            <div class="profile-header-info">

                <h1 class="profile-name">

                    <?= htmlspecialchars(
                        $paciente['nombre'] . ' ' .
                        $paciente['apellido'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>

                </h1>

                <p class="profile-description">

                    <i class="bi bi-person-vcard me-1"></i>

                    Información personal y datos de contacto

                </p>

                <div class="profile-document">

                    <i class="bi bi-card-text me-1"></i>

                    Documento:

                    <strong>
                        <?= htmlspecialchars(
                            $paciente['documento'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </strong>

                </div>

            </div>


            <div class="profile-header-action">

                <a
                    href="<?= APP_URL ?>/perfil/edit"
                    class="btn btn-primary btn-icon">

                    <i class="bi bi-pencil-square"></i>

                    Actualizar datos

                </a>

            </div>

        </div>

    </div>


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
                        Datos básicos registrados en CitaSalud
                    </small>

                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="row g-4">


                <!-- Documento -->
                <div class="col-12 col-md-6">

                    <div class="profile-data">

                        <div class="data-icon">

                            <i class="bi bi-card-text"></i>

                        </div>

                        <div class="data-content">

                            <span class="data-label">
                                Documento
                            </span>

                            <span class="data-value">

                                <?= htmlspecialchars(
                                    $paciente['documento'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </span>

                        </div>

                        <span
                            class="data-status status-locked"
                            title="Dato no editable">

                            <i class="bi bi-lock-fill"></i>

                        </span>

                    </div>

                </div>


                <!-- Nombre completo -->
                <div class="col-12 col-md-6">

                    <div class="profile-data">

                        <div class="data-icon">

                            <i class="bi bi-person"></i>

                        </div>

                        <div class="data-content">

                            <span class="data-label">
                                Nombre completo
                            </span>

                            <span class="data-value">

                                <?= htmlspecialchars(
                                    $paciente['nombre'] . ' ' .
                                    $paciente['apellido'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </span>

                        </div>

                    </div>

                </div>


                <!-- Fecha nacimiento -->
                <div class="col-12 col-md-6">

                    <div class="profile-data">

                        <div class="data-icon">

                            <i class="bi bi-calendar3"></i>

                        </div>

                        <div class="data-content">

                            <span class="data-label">
                                Fecha de nacimiento
                            </span>

                            <span class="data-value">

                                <?php if (
                                    !empty(
                                        $paciente['fecha_nacimiento']
                                    )
                                ): ?>

                                    <?= htmlspecialchars(
                                        $paciente[
                                            'fecha_nacimiento'
                                        ],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>

                                <?php else: ?>

                                    <span class="text-muted">
                                        No registrada
                                    </span>

                                <?php endif; ?>

                            </span>

                        </div>

                    </div>

                </div>


                <!-- Sexo -->
                <div class="col-12 col-md-6">

                    <div class="profile-data">

                        <div class="data-icon">

                            <i class="bi bi-gender-ambiguous"></i>

                        </div>

                        <div class="data-content">

                            <span class="data-label">
                                Sexo
                            </span>

                            <span class="data-value">

                                <?php

                                switch ($paciente['sexo'] ?? '') {

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
                                        echo '<span class="text-muted">
                                                No registrado
                                              </span>';
                                        break;
                                }

                                ?>

                            </span>

                        </div>

                    </div>

                </div>


                <!-- Discapacidad -->
                <div class="col-12 col-md-6">

                    <div class="profile-data">

                        <div class="data-icon">

                            <i class="bi bi-universal-access"></i>

                        </div>

                        <div class="data-content">

                            <span class="data-label">
                                Discapacidad
                            </span>

                            <span class="data-value">

                                <?php if (
                                    (int)$paciente[
                                        'discapacidad'
                                    ] === 1
                                ): ?>

                                    <span class="badge profile-badge badge-yes">

                                        <i class="bi bi-check-circle me-1"></i>

                                        Sí

                                    </span>

                                <?php else: ?>

                                    <span class="badge profile-badge badge-no">

                                        <i class="bi bi-dash-circle me-1"></i>

                                        No

                                    </span>

                                <?php endif; ?>

                            </span>

                        </div>

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
                        Información utilizada para comunicación
                    </small>

                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="row g-4">


                <!-- Email -->
                <div class="col-12 col-md-6">

                    <div class="profile-data">

                        <div class="data-icon data-icon-success">

                            <i class="bi bi-envelope"></i>

                        </div>

                        <div class="data-content">

                            <span class="data-label">
                                Correo electrónico
                            </span>

                            <span class="data-value">

                                <?= htmlspecialchars(
                                    $paciente['email'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </span>

                        </div>

                    </div>

                </div>


                <!-- Teléfono -->
                <div class="col-12 col-md-6">

                    <div class="profile-data">

                        <div class="data-icon data-icon-success">

                            <i class="bi bi-phone"></i>

                        </div>

                        <div class="data-content">

                            <span class="data-label">
                                Teléfono
                            </span>

                            <span class="data-value">

                                <?php if (
                                    !empty(
                                        $paciente['telefono']
                                    )
                                ): ?>

                                    <?= htmlspecialchars(
                                        $paciente['telefono'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>

                                <?php else: ?>

                                    <span class="text-muted">
                                        No registrado
                                    </span>

                                <?php endif; ?>

                            </span>

                        </div>

                    </div>

                </div>


                <!-- Dirección -->
                <div class="col-12 col-md-6">

                    <div class="profile-data">

                        <div class="data-icon data-icon-success">

                            <i class="bi bi-geo-alt"></i>

                        </div>

                        <div class="data-content">

                            <span class="data-label">
                                Dirección
                            </span>

                            <span class="data-value">

                                <?php if (
                                    !empty(
                                        $paciente['direccion']
                                    )
                                ): ?>

                                    <?= htmlspecialchars(
                                        $paciente['direccion'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>

                                <?php else: ?>

                                    <span class="text-muted">
                                        No registrada
                                    </span>

                                <?php endif; ?>

                            </span>

                        </div>

                    </div>

                </div>


                <!-- EPS -->
                <div class="col-12 col-md-6">

                    <div class="profile-data">

                        <div class="data-icon data-icon-success">

                            <i class="bi bi-hospital"></i>

                        </div>

                        <div class="data-content">

                            <span class="data-label">
                                EPS
                            </span>

                            <span class="data-value">

                                <?php if (
                                    !empty(
                                        $paciente['eps']
                                    )
                                ): ?>

                                    <?= htmlspecialchars(
                                        $paciente['eps'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>

                                <?php else: ?>

                                    <span class="text-muted">
                                        No registrada
                                    </span>

                                <?php endif; ?>

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- PIE -->
    <div class="profile-footer mb-4">

        <div class="d-flex align-items-center gap-2 text-muted">

            <i class="bi bi-shield-check"></i>

            <small>
                Mantén tu información actualizada para facilitar
                la gestión de tus citas médicas.
            </small>

        </div>

        <a
            href="<?= APP_URL ?>/perfil/edit"
            class="btn btn-outline-primary btn-icon btn-sm">

            <i class="bi bi-pencil"></i>

            Actualizar datos

        </a>

    </div>

</div>


<style>

.profile-success-alert {
    border: 0;
    border-left: 4px solid #198754;
    border-radius: 12px;
}

.success-icon {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #d1e7dd;
    color: #198754;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}


/* =========================
   HEADER
========================= */

.profile-header {
    background: linear-gradient(
        135deg,
        #ffffff 0%,
        #f5f9ff 100%
    );

    border: 1px solid #e9ecef;
    border-radius: 18px;
    padding: 28px;

    box-shadow:
        0 4px 16px rgba(0, 0, 0, .04);
}

.profile-header-content {
    display: flex;
    align-items: center;
    gap: 22px;
}

.profile-avatar {
    width: 82px;
    height: 82px;

    border-radius: 22px;

    background: linear-gradient(
        135deg,
        #0d6efd,
        #4dabf7
    );

    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 38px;

    flex-shrink: 0;

    box-shadow:
        0 8px 20px rgba(13, 110, 253, .20);
}

.profile-header-info {
    flex: 1;
    min-width: 0;
}

.profile-name {
    font-size: 1.7rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.profile-description {
    color: #6c757d;
    margin-bottom: 8px;
}

.profile-document {
    color: #495057;
    font-size: .9rem;
}

.profile-header-action {
    flex-shrink: 0;
}


/* =========================
   CARDS
========================= */

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


/* =========================
   DATA
========================= */

.profile-data {
    display: flex;
    align-items: center;
    gap: 14px;

    min-height: 72px;

    padding: 14px;

    border: 1px solid #edf0f2;

    border-radius: 12px;

    background: #fff;

    transition:
        border-color .2s ease,
        background-color .2s ease,
        transform .2s ease;
}

.profile-data:hover {
    background: #f8fbff;
    border-color: #dbe7f5;
    transform: translateY(-1px);
}

.data-icon {
    width: 42px;
    height: 42px;

    border-radius: 11px;

    background: #e7f1ff;
    color: #0d6efd;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    font-size: 18px;
}

.data-icon-success {
    background: #e8f7ef;
    color: #198754;
}

.data-content {
    min-width: 0;
    flex: 1;
}

.data-label {
    display: block;

    font-size: .78rem;

    font-weight: 600;

    color: #6c757d;

    margin-bottom: 3px;

    text-transform: uppercase;

    letter-spacing: .02em;
}

.data-value {
    display: block;

    color: #212529;

    font-weight: 500;

    word-break: break-word;
}

.data-status {
    width: 28px;
    height: 28px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    flex-shrink: 0;
}

.status-locked {
    background: #f1f3f5;
    color: #6c757d;
}


/* =========================
   BADGES
========================= */

.profile-badge {
    padding: 6px 10px;
    font-weight: 500;
    border-radius: 8px;
}

.badge-yes {
    background: #d1e7dd;
    color: #146c43;
}

.badge-no {
    background: #e9ecef;
    color: #495057;
}


/* =========================
   FOOTER
========================= */

.profile-footer {
    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 15px;

    padding: 5px 2px 25px;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 767.98px) {

    .profile-header {
        padding: 20px;
    }

    .profile-header-content {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .profile-avatar {
        width: 64px;
        height: 64px;
        border-radius: 17px;
        font-size: 30px;
    }

    .profile-name {
        font-size: 1.35rem;
    }

    .profile-header-action {
        width: 100%;
        margin-top: 5px;
    }

    .profile-header-action .btn {
        width: 100%;
    }

    .profile-card-header {
        padding: 18px;
    }

    .profile-card .card-body {
        padding: 18px !important;
    }

    .profile-footer {
        flex-direction: column;
        align-items: stretch;
    }

    .profile-footer .btn {
        width: 100%;
    }

}


@media (max-width: 575.98px) {

    .profile-header-content {
        gap: 15px;
    }

    .profile-avatar {
        width: 56px;
        height: 56px;
        font-size: 26px;
    }

    .profile-name {
        font-size: 1.2rem;
    }

    .profile-description {
        font-size: .85rem;
    }

    .profile-document {
        font-size: .82rem;
    }

    .profile-data {
        min-height: 65px;
        padding: 11px;
    }

    .data-icon {
        width: 38px;
        height: 38px;
        font-size: 16px;
    }

    .data-label {
        font-size: .72rem;
    }

    .data-value {
        font-size: .9rem;
    }

}

</style>