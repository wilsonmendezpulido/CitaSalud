<?php

$usuario = isset($usuario) ? $usuario : '';
$rol = isset($rol) ? $rol : '';

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="CitaSalud - Panel principal">

    <title>
        Dashboard - CitaSalud
    </title>


    <!-- =====================================================
         Bootstrap
    ====================================================== -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- =====================================================
         Bootstrap Icons
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- =====================================================
         CSS global CitaSalud
    ====================================================== -->

    <link
        rel="stylesheet"
        href="<?= APP_URL ?>/css/citasalud.css">


    <style>
        .dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-title {
            font-weight: 700;
            margin-bottom: 6px;
        }

        .dashboard-card {
            height: 100%;
        }

        .dashboard-card .card-body {
            display: flex;
            flex-direction: column;
        }

        .dashboard-card .card-text {
            flex-grow: 1;
        }

        .dashboard-user {
            white-space: nowrap;
        }

        .dashboard-documentacion {
            white-space: nowrap;
        }

        .documentacion-modal .modal-header {
            background: #0d6efd;
            color: #fff;
            border-bottom: 0;
        }

        .documentacion-modal .modal-header .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .documentacion-video-wrapper {
            background: #111827;
            border-radius: 12px;
            overflow: hidden;
        }

        .documentacion-video {
            display: block;
            width: 100%;
            max-height: 460px;
            background: #111827;
        }

        .guia-uso-link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 16px;
            transition: all .2s ease;
        }

        .guia-uso-link:hover {
            background: #f8fafc;
            border-color: #0d6efd;
            transform: translateY(-1px);
        }

        .guia-uso-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff1f2;
            color: #dc3545;
            font-size: 1.35rem;
            flex-shrink: 0;
        }

        .guia-uso-text {
            min-width: 0;
        }

        .guia-uso-text strong {
            display: block;
            color: #212529;
        }

        .guia-uso-text small {
            color: #6c757d;
        }



        .dashboard-accessibility {
            white-space: nowrap;
        }

        .accessibility-modal .modal-header {
            background: #0d6efd;
            color: #fff;
            border-bottom: 0;
        }

        .accessibility-modal .modal-header .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .accessibility-section {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .accessibility-section-title {
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .accessibility-control-group {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .accessibility-control {
            min-height: 44px;
        }

        /* =================================================
           Preferencias de accesibilidad
        ================================================= */

        /* El tamaño se aplica al documento completo, incluyendo Bootstrap */
        html.a11y-font-large {
            font-size: 110%;
        }

        html.a11y-font-xlarge {
            font-size: 122%;
        }

        /* Modo oscuro */
        body.a11y-dark {
            background: #121212 !important;
            color: #f1f1f1 !important;
        }

        body.a11y-dark main {
            background: #121212 !important;
        }

        body.a11y-dark .card,
        body.a11y-dark .citasalud-card,
        body.a11y-dark .modal-content,
        body.a11y-dark .accessibility-section {
            background: #1e1e1e !important;
            color: #f1f1f1 !important;
            border-color: #444 !important;
        }

        body.a11y-dark .card-title,
        body.a11y-dark .dashboard-title,
        body.a11y-dark h1,
        body.a11y-dark h2,
        body.a11y-dark h3,
        body.a11y-dark h4,
        body.a11y-dark h5,
        body.a11y-dark h6 {
            color: #fff !important;
        }

        body.a11y-dark .text-muted,
        body.a11y-dark .page-subtitle {
            color: #d0d0d0 !important;
        }

        body.a11y-dark .form-control,
        body.a11y-dark .form-select {
            background: #2a2a2a !important;
            color: #fff !important;
            border-color: #555 !important;
        }

        body.a11y-dark .form-control::placeholder {
            color: #bdbdbd !important;
        }

        /* Alto contraste */
        body.a11y-high-contrast {
            background: #000 !important;
            color: #fff !important;
        }

        body.a11y-high-contrast main {
            background: #000 !important;
        }

        body.a11y-high-contrast .card,
        body.a11y-high-contrast .citasalud-card,
        body.a11y-high-contrast .modal-content,
        body.a11y-high-contrast .accessibility-section {
            background: #000 !important;
            color: #fff !important;
            border: 2px solid #fff !important;
        }

        body.a11y-high-contrast .card-title,
        body.a11y-high-contrast .dashboard-title,
        body.a11y-high-contrast .text-muted,
        body.a11y-high-contrast .page-subtitle {
            color: #fff !important;
        }

        body.a11y-high-contrast a,
        body.a11y-high-contrast button {
            outline-offset: 3px;
        }

        /* Resaltar enlaces y botones */
        body.a11y-highlight-links a {
            text-decoration: underline !important;
            text-decoration-thickness: 2px;
        }

        body.a11y-highlight-links .btn,
        body.a11y-highlight-links button {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .30);
        }

        /* Reducir movimiento */
        body.a11y-reduce-motion *,
        body.a11y-reduce-motion *::before,
        body.a11y-reduce-motion *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
            scroll-behavior: auto !important;
        }

        /* Estado activo de los controles */
        .accessibility-control.active {
            background-color: #0d6efd !important;
            color: #fff !important;
            border-color: #0d6efd !important;
        }

        /* =================================================
           Responsive Navbar
        ================================================= */

        @media (max-width: 575.98px) {

            .dashboard-navbar-content {
                align-items: flex-start !important;
                gap: 10px;
            }

            .dashboard-user {
                max-width: 140px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .dashboard-logout {
                white-space: nowrap;
            }

        }
    </style>

</head>


<body>


    <!-- =====================================================
         Navbar
    ====================================================== -->

    <nav
        class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm"
        aria-label="Navegación principal">

        <div
            class="container dashboard-navbar-content d-flex justify-content-between">


            <!-- Logo -->

            <a
                href="<?= APP_URL ?>/dashboard"
                class="navbar-brand fw-bold d-flex align-items-center">

                <i
                    class="bi bi-heart-pulse me-2"
                    aria-hidden="true">
                </i>

                <span>
                    CitaSalud
                </span>

            </a>


            <!-- Usuario / Logout -->

            <div
                class="d-flex align-items-center gap-2">


                <span
                    class="text-white dashboard-user d-flex align-items-center"
                    title="<?= htmlspecialchars($usuario) ?>">

                    <i
                        class="bi bi-person-circle me-1"
                        aria-hidden="true">
                    </i>

                    <span>
                        <?= htmlspecialchars($usuario) ?>
                    </span>

                </span>


                <button
                    type="button"
                    class="btn btn-outline-light dashboard-accessibility"
                    data-bs-toggle="modal"
                    data-bs-target="#modalAccesibilidad"
                    aria-label="Abrir opciones de accesibilidad">
                    <i class="bi bi-universal-access me-1" aria-hidden="true"></i>
                    Accesibilidad
                </button>

                <button
                    type="button"
                    class="btn btn-outline-light dashboard-documentacion"
                    data-bs-toggle="modal"
                    data-bs-target="#modalDocumentacion">
                    <i class="bi bi-journal-text me-1" aria-hidden="true"></i>
                    Documentación y guías de uso
                </button>

                <a href="<?php echo APP_URL; ?>/logout" class="btn btn-outline-light dashboard-logout">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    Cerrar sesión
                </a>
            </div>

        </div>

    </nav>


    <!-- =====================================================
         Contenido principal
    ====================================================== -->

    <main>

        <div class="container main-container">


            <!-- Encabezado -->

            <div class="dashboard-header">

                <h1 class="dashboard-title h3">

                    Bienvenido a CitaSalud

                </h1>

                <p class="page-subtitle">

                    Gestione sus citas y consulte su información personal.

                </p>

            </div>


            <!-- =================================================
                 Opciones principales
            ================================================== -->

            <div class="row g-4">


                <!-- =============================================
                     Programar cita
                ============================================== -->

                <div class="col-12 col-md-6">

                    <div
                        class="card citasalud-card dashboard-card shadow-sm">

                        <div class="card-body p-4">


                            <div
                                class="dashboard-icon icon-primary mb-3">

                                <i
                                    class="bi bi-calendar2-plus"
                                    aria-hidden="true">
                                </i>

                            </div>


                            <h2 class="card-title h5">

                                Programar cita

                            </h2>


                            <p class="card-text text-muted">

                                Seleccione una especialidad, médico,
                                fecha y horario disponible.

                            </p>


                            <a
                                href="<?= APP_URL ?>/citas/create"
                                class="btn btn-primary btn-icon">

                                <i
                                    class="bi bi-calendar-plus"
                                    aria-hidden="true">
                                </i>

                                Programar cita

                            </a>

                        </div>

                    </div>

                </div>


                <!-- =============================================
                     Mis citas
                ============================================== -->

                <div class="col-12 col-md-6">

                    <div
                        class="card citasalud-card dashboard-card shadow-sm">

                        <div class="card-body p-4">


                            <div
                                class="dashboard-icon icon-success mb-3">

                                <i
                                    class="bi bi-calendar-check"
                                    aria-hidden="true">
                                </i>

                            </div>


                            <h2 class="card-title h5">

                                Mis citas

                            </h2>


                            <p class="card-text text-muted">

                                Consulte sus próximas citas y su historial
                                de atención médica.

                            </p>


                            <a
                                href="<?= APP_URL ?>/citas/mis-citas"
                                class="btn btn-outline-success btn-icon">

                                <i
                                    class="bi bi-calendar3"
                                    aria-hidden="true">
                                </i>

                                Ver mis citas

                            </a>

                        </div>

                    </div>

                </div>


                <!-- =============================================
                     Mi perfil
                ============================================== -->

                <div class="col-12 col-md-6">

                    <div
                        class="card citasalud-card dashboard-card shadow-sm">

                        <div class="card-body p-4">


                            <div
                                class="dashboard-icon icon-info mb-3">

                                <i
                                    class="bi bi-person-vcard"
                                    aria-hidden="true">
                                </i>

                            </div>


                            <h2 class="card-title h5">

                                Mi perfil

                            </h2>


                            <p class="card-text text-muted">

                                Consulte y actualice su información
                                personal y de contacto.

                            </p>


                            <a
                                href="<?= APP_URL ?>/perfil"
                                class="btn btn-outline-info btn-icon">

                                <i
                                    class="bi bi-person-lines-fill"
                                    aria-hidden="true">
                                </i>

                                Ver perfil

                            </a>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </main>



    <!-- =====================================================
         Modal - Accesibilidad
    ====================================================== -->

    <div class="modal fade accessibility-modal"
         id="modalAccesibilidad"
         tabindex="-1"
         aria-labelledby="modalAccesibilidadLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">

                <div class="modal-header">
                    <div>
                        <h2 class="modal-title h5 mb-1" id="modalAccesibilidadLabel">
                            <i class="bi bi-universal-access me-2"></i>
                            Accesibilidad
                        </h2>
                        <p class="mb-0 small text-white-50">
                            Personalice la visualización de CitaSalud según sus necesidades.
                        </p>
                    </div>

                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body p-4">

                    <section class="accessibility-section">
                        <div class="accessibility-section-title">
                            <i class="bi bi-fonts text-primary"></i>
                            Tamaño del texto
                        </div>

                        <div class="accessibility-control-group">
                            <button type="button" class="btn btn-outline-secondary accessibility-control"
                                    data-a11y-action="font-normal">A</button>
                            <button type="button" class="btn btn-outline-secondary accessibility-control"
                                    data-a11y-action="font-large">A+</button>
                            <button type="button" class="btn btn-outline-secondary accessibility-control"
                                    data-a11y-action="font-xlarge">A++</button>
                        </div>
                    </section>

                    <section class="accessibility-section">
                        <div class="accessibility-section-title">
                            <i class="bi bi-palette text-primary"></i>
                            Colores y contraste
                        </div>

                        <div class="accessibility-control-group">
                            <button type="button" class="btn btn-outline-secondary accessibility-control"
                                    data-a11y-action="theme-normal">
                                <i class="bi bi-brightness-high me-1"></i> Normal
                            </button>

                            <button type="button" class="btn btn-outline-secondary accessibility-control"
                                    data-a11y-action="theme-dark">
                                <i class="bi bi-moon-stars me-1"></i> Oscuro
                            </button>

                            <button type="button" class="btn btn-dark accessibility-control"
                                    data-a11y-action="theme-contrast">
                                <i class="bi bi-circle-half me-1"></i> Alto contraste
                            </button>
                        </div>
                    </section>

                    <section class="accessibility-section">
                        <div class="accessibility-section-title">
                            <i class="bi bi-universal-access text-primary"></i>
                            Lectura y navegación
                        </div>

                        <div class="d-grid gap-2">

                            <button type="button"
                                    class="btn btn-outline-primary text-start accessibility-control"
                                    data-a11y-action="highlight-links"
                                    aria-pressed="false">
                                <i class="bi bi-link-45deg me-2"></i>
                                Resaltar enlaces y botones
                            </button>

                            <button type="button"
                                    class="btn btn-outline-primary text-start accessibility-control"
                                    data-a11y-action="reduce-motion"
                                    aria-pressed="false">
                                <i class="bi bi-pause-circle me-2"></i>
                                Reducir animaciones y movimiento
                            </button>

                        </div>
                    </section>

                    <div class="alert alert-info mb-0" role="note">
                        <i class="bi bi-info-circle me-2"></i>
                        Las preferencias se guardan en este dispositivo.
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-outline-danger"
                            data-a11y-action="reset">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Restablecer accesibilidad
                    </button>

                    <button type="button"
                            class="btn btn-primary"
                            id="btnGuardarAccesibilidad"
                            data-bs-dismiss="modal">
                        <i class="bi bi-check-lg me-1"></i>
                        Guardar configuración
                    </button>

                </div>
            </div>
        </div>
    </div>


    <!-- =====================================================
         Modal - Documentación y guías de uso
    ====================================================== -->

    <div
        class="modal fade documentacion-modal"
        id="modalDocumentacion"
        tabindex="-1"
        aria-labelledby="modalDocumentacionLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg">

                <div class="modal-header">

                    <div>
                        <h2 class="modal-title h5 mb-1" id="modalDocumentacionLabel">
                            <i class="bi bi-journal-text me-2" aria-hidden="true"></i>
                            Documentación y guías de uso
                        </h2>

                        <p class="mb-0 small text-white-50">
                            Consulte el video de orientación y la guía de uso de CitaSalud.
                        </p>
                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Cerrar">
                    </button>

                </div>

                <div class="modal-body p-4">

                    <div class="documentacion-video-wrapper mb-4">

                        <video
                            id="videoGuiaUso"
                            class="documentacion-video"
                            controls
                            preload="metadata">

                            <source
                                src="<?= APP_URL ?>/videos/guia-citasalud.mp4"
                                type="video/mp4">

                            Su navegador no admite la reproducción de video HTML5.

                        </video>

                    </div>

                    <div>

                        <h3 class="h6 fw-bold mb-3">
                            Recursos de ayuda
                        </h3>

                        <a
                            href="<?= APP_URL ?>/docs/Guia_de_Uso_CitaSalud.pdf"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="guia-uso-link">

                            <span class="guia-uso-icon" aria-hidden="true">
                                <i class="bi bi-file-earmark-pdf-fill"></i>
                            </span>

                            <span class="guia-uso-text">
                                <strong>Guía de Uso</strong>
                                <small>
                                    Consulte o descargue el manual de usuario de CitaSalud en formato PDF.
                                </small>
                            </span>

                            <i class="bi bi-box-arrow-up-right ms-auto text-muted" aria-hidden="true"></i>

                        </a>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">

                        <i class="bi bi-x-lg me-1" aria-hidden="true"></i>
                        Cerrar

                    </button>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         Bootstrap JS
    ====================================================== -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    <script>
        (function () {

            const storageKey = 'citasalud_accessibility';

            const defaults = {
                font: 'normal',
                theme: 'normal',
                highlightLinks: false,
                reduceMotion: false
            };

            function loadSettings() {
                try {
                    const saved = JSON.parse(
                        localStorage.getItem(storageKey)
                    );

                    return Object.assign({}, defaults, saved || {});

                } catch (error) {
                    return Object.assign({}, defaults);
                }
            }

            function saveSettings(settings) {
                localStorage.setItem(
                    storageKey,
                    JSON.stringify(settings)
                );
            }

            function applySettings(settings) {

                /* Tamaño */
                document.documentElement.classList.remove(
                    'a11y-font-large',
                    'a11y-font-xlarge'
                );

                if (settings.font === 'large') {
                    document.documentElement.classList.add(
                        'a11y-font-large'
                    );
                }

                if (settings.font === 'xlarge') {
                    document.documentElement.classList.add(
                        'a11y-font-xlarge'
                    );
                }

                /* Tema */
                document.body.classList.remove(
                    'a11y-dark',
                    'a11y-high-contrast'
                );

                if (settings.theme === 'dark') {
                    document.body.classList.add('a11y-dark');
                }

                if (settings.theme === 'contrast') {
                    document.body.classList.add(
                        'a11y-high-contrast'
                    );
                }

                /* Navegación */
                document.body.classList.toggle(
                    'a11y-highlight-links',
                    settings.highlightLinks
                );

                document.body.classList.toggle(
                    'a11y-reduce-motion',
                    settings.reduceMotion
                );

                /* Estado visual de los botones */
                document.querySelectorAll(
                    '[data-a11y-action]'
                ).forEach(function (button) {

                    const action =
                        button.getAttribute('data-a11y-action');

                    if (action === 'highlight-links') {
                        button.classList.toggle(
                            'active',
                            settings.highlightLinks
                        );

                        button.setAttribute(
                            'aria-pressed',
                            settings.highlightLinks
                                ? 'true'
                                : 'false'
                        );
                    }

                    if (action === 'reduce-motion') {
                        button.classList.toggle(
                            'active',
                            settings.reduceMotion
                        );

                        button.setAttribute(
                            'aria-pressed',
                            settings.reduceMotion
                                ? 'true'
                                : 'false'
                        );
                    }
                });
            }

            function resetSettings() {

                return Object.assign(
                    {},
                    defaults
                );
            }

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    let settings = loadSettings();

                    /* Aplica inmediatamente la configuración guardada */
                    applySettings(settings);

                    document.querySelectorAll(
                        '[data-a11y-action]'
                    ).forEach(function (button) {

                        button.addEventListener(
                            'click',
                            function () {

                                const action =
                                    button.getAttribute(
                                        'data-a11y-action'
                                    );

                                switch (action) {

                                    case 'font-normal':
                                        settings.font = 'normal';
                                        break;

                                    case 'font-large':
                                        settings.font = 'large';
                                        break;

                                    case 'font-xlarge':
                                        settings.font = 'xlarge';
                                        break;

                                    case 'theme-normal':
                                        settings.theme = 'normal';
                                        break;

                                    case 'theme-dark':
                                        settings.theme = 'dark';
                                        break;

                                    case 'theme-contrast':
                                        settings.theme = 'contrast';
                                        break;

                                    case 'highlight-links':
                                        settings.highlightLinks =
                                            !settings.highlightLinks;
                                        break;

                                    case 'reduce-motion':
                                        settings.reduceMotion =
                                            !settings.reduceMotion;
                                        break;

                                    case 'reset':
                                        settings = resetSettings();
                                        break;
                                }

                                /*
                                 * El usuario ve el cambio inmediatamente.
                                 * También queda guardado en el navegador.
                                 */
                                applySettings(settings);
                                saveSettings(settings);
                            }
                        );
                    });

                    const btnGuardar =
                        document.getElementById(
                            'btnGuardarAccesibilidad'
                        );

                    if (btnGuardar) {

                        btnGuardar.addEventListener(
                            'click',
                            function () {

                                saveSettings(settings);
                                applySettings(settings);

                            }
                        );
                    }

                }
            );

        })();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const modalDocumentacion = document.getElementById('modalDocumentacion');
            const videoGuiaUso = document.getElementById('videoGuiaUso');

            if (!modalDocumentacion || !videoGuiaUso) {
                return;
            }

            modalDocumentacion.addEventListener('shown.bs.modal', function () {
                videoGuiaUso.currentTime = 0;
            });

            modalDocumentacion.addEventListener('hidden.bs.modal', function () {
                videoGuiaUso.pause();
                videoGuiaUso.currentTime = 0;
            });

        });
    </script>

</body>

</html>