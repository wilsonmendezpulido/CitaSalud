<?php

$error = isset($error) ? $error : null;

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
        content="CitaSalud - Sistema de Gestión de Citas Médicas">

    <title>
        Iniciar sesión - CitaSalud
    </title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- CSS global -->

    <link
        rel="stylesheet"
        href="<?= APP_URL ?>/css/citasalud.css">


    <style>

        body {

            min-height: 90vh;

            background:
                linear-gradient(
                    135deg,
                    #eef6ff 0%,
                    #f8fbff 50%,
                    #eaf7f3 90%
                );

        }


        .login-container {

            min-height: 90vh;

            padding-top: 10px;

            padding-bottom: 10px;

        }


        .login-card {

            border: none;

            border-radius: 10px;

            overflow: hidden;

            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.10);

        }


        .login-header {

            background: #0d6efd;

            color: white;

            padding: 22px 15px;

            text-align: center;

        }


        .logo-icon {

            width: 50px;

            height: 50px;

            margin: 0 auto 15px;

            border-radius: 18px;

            background: rgba(255, 255, 255, 0.18);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 34px;

        }


        .login-header h1 {

            font-size: 1.7rem;

            margin-bottom: 5px;

        }


        .login-header p {

            margin-bottom: 0;

            opacity: 0.9;

            font-size: 0.95rem;

        }


        .login-body {

            padding: 32px;

            background: white;

        }


        .form-label {

            font-weight: 500;

            color: #343a40;

        }


        .input-group-text {

            background: #f8f9fa;

            border-right: none;

            color: #6c757d;

        }


        .form-control {

            border-left: none;

            padding: 11px 12px;

        }


        .form-control:focus {

            box-shadow: none;

            border-color: #86b7fe;

        }


        .input-group:focus-within
        .input-group-text {

            border-color: #86b7fe;

            color: #0d6efd;

        }


        .password-toggle {

            cursor: pointer;

            border-left: none;

            background: white;

        }


        .password-toggle:hover {

            color: #0d6efd;

        }


        .btn-login {

            padding: 10px;

            font-weight: 500;

            border-radius: 10px;

            transition: all 0.2s ease;

        }


        .btn-login:hover {

            transform: translateY(-1px);

        }


        .security-message {

            font-size: 0.8rem;

            color: #6c757d;

        }


        .security-message i {

            color: #198754;

        }


        .footer-text {

            font-size: 0.8rem;

            color: #6c757d;

            text-align: center;

            margin-top: 20px;

        }


        .spinner-border {

            width: 1rem;

            height: 1rem;

        }


        /* =================================================
           Mensajes
        ================================================= */

        .login-message {

            display: none;

            align-items: flex-start;

            gap: 12px;

            padding: 13px 15px;

            margin-bottom: 20px;

            border-radius: 12px;

            font-size: 0.9rem;

            animation: messageIn 0.25s ease;

        }


        .login-message.show {

            display: flex;

        }


        .login-message.error {

            background: #fff1f2;

            border: 1px solid #fecdd3;

            color: #b42318;

        }


        .login-message.success {

            background: #ecfdf3;

            border: 1px solid #abefc6;

            color: #067647;

        }


        .login-message.warning {

            background: #fffaeb;

            border: 1px solid #fedf89;

            color: #b54708;

        }


        .login-message-icon {

            font-size: 1.15rem;

            line-height: 1;

            margin-top: 2px;

        }


        .login-message-content {

            flex: 1;

        }


        .login-message-title {

            display: block;

            font-weight: 600;

            margin-bottom: 2px;

        }


        .login-message-text {

            margin: 0;

            line-height: 1.4;

        }


        @keyframes messageIn {

            from {

                opacity: 0;

                transform: translateY(-5px);

            }

            to {

                opacity: 1;

                transform: translateY(0);

            }

        }


        /* =================================================
           Responsive
        ================================================= */

        @media (max-width: 575.98px) {

            .login-container {

                padding-left: 10px;

                padding-right: 10px;

            }


            .login-body {

                padding: 24px 20px;

            }


            .login-header {

                padding: 25px 20px;

            }


            .logo-icon {

                width: 60px;

                height: 60px;

                font-size: 29px;

            }


            .login-header h1 {

                font-size: 1.45rem;

            }

        }

    </style>

</head>


<body>


<div class="container login-container">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">


            <div class="card login-card">


                <!-- =========================================
                     Encabezado
                ========================================== -->

                <div class="login-header">

                    <div class="logo-icon">

                        <i
                            class="bi bi-heart-pulse"
                            aria-hidden="true">
                        </i>

                    </div>


                    <h1 class="fw-bold">

                        CitaSalud

                    </h1>


                    <p>

                        Sistema de Gestión de Citas Médicas

                    </p>

                </div>


                <!-- =========================================
                     Formulario
                ========================================== -->

                <div class="login-body">


                    <div class="text-center mb-4">

                        <h2 class="h5 fw-bold">

                            Iniciar sesión

                        </h2>


                        <p class="text-muted mb-0">

                            Acceda a su cuenta para continuar

                        </p>

                    </div>


                    <!-- Mensaje PHP -->

                    <?php if ($error): ?>

                        <div
                            class="login-message show error"
                            role="alert"
                            aria-live="polite">

                            <i
                                class="bi bi-exclamation-circle-fill login-message-icon"
                                aria-hidden="true">
                            </i>

                            <div class="login-message-content">

                                <span class="login-message-title">

                                    No fue posible iniciar sesión

                                </span>

                                <p class="login-message-text">

                                    <?= htmlspecialchars($error) ?>

                                </p>

                            </div>

                        </div>

                    <?php endif; ?>


                    <!-- Mensaje JavaScript -->

                    <div
                        id="loginMessage"
                        class="login-message"
                        role="alert"
                        aria-live="polite">

                        <i
                            id="loginMessageIcon"
                            class="login-message-icon bi"
                            aria-hidden="true">
                        </i>


                        <div class="login-message-content">

                            <span
                                id="loginMessageTitle"
                                class="login-message-title">
                            </span>


                            <p
                                id="loginMessageText"
                                class="login-message-text">
                            </p>

                        </div>

                    </div>


                    <form
                        method="POST"
                        action="<?= APP_URL ?>/login"
                        id="loginForm"
                        novalidate>

                        <?php echo Security::csrfField(); ?>


                        <!-- =================================
                             Correo
                        ================================== -->

                        <div class="mb-3">

                            <label
                                for="email"
                                class="form-label">

                                Correo electrónico

                            </label>


                            <div class="input-group">

                                <span class="input-group-text">

                                    <i
                                        class="bi bi-envelope"
                                        aria-hidden="true">
                                    </i>

                                </span>


                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="correo@ejemplo.com"
                                    required
                                    autocomplete="email">


                            </div>

                        </div>


                        <!-- =================================
                             Contraseña
                        ================================== -->

                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label">

                                Contraseña

                            </label>


                            <div class="input-group">

                                <span class="input-group-text">

                                    <i
                                        class="bi bi-lock"
                                        aria-hidden="true">
                                    </i>

                                </span>


                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="Ingrese su contraseña"
                                    required
                                    autocomplete="current-password">


                                <button
                                    type="button"
                                    class="input-group-text password-toggle"
                                    id="togglePassword"
                                    aria-label="Mostrar contraseña">

                                    <i
                                        class="bi bi-eye"
                                        id="togglePasswordIcon"
                                        aria-hidden="true">
                                    </i>

                                </button>

                            </div>

                        </div>


                        <!-- =================================
                             Botón
                        ================================== -->

                        <div class="d-grid mt-4">

                            <button
                                type="submit"
                                class="btn btn-primary btn-login"
                                id="loginButton">

                                <span id="loginButtonContent">

                                    <i
                                        class="bi bi-box-arrow-in-right me-2"
                                        aria-hidden="true">
                                    </i>

                                    Ingresar

                                </span>

                            </button>

                        </div>


                        <!-- Seguridad -->

                        <div
                            class="security-message text-center mt-4">

                            <i
                                class="bi bi-shield-check me-1"
                                aria-hidden="true">
                            </i>

                            Acceso protegido mediante autenticación segura

                        </div>


                    </form>


                    <div class="footer-text">

                        © <?= date('Y') ?> CitaSalud

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>


<!-- Bootstrap JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<!-- API -->

<script
    src="<?= APP_URL ?>/js/api.js">
</script>


<script>

    /* =====================================================
       Mostrar / ocultar contraseña
    ====================================================== */

    document
        .getElementById('togglePassword')
        .addEventListener('click', function () {

            const password =
                document.getElementById('password');

            const icon =
                document.getElementById('togglePasswordIcon');


            if (password.type === 'password') {

                password.type = 'text';

                icon.classList.remove('bi-eye');

                icon.classList.add('bi-eye-slash');

                this.setAttribute(
                    'aria-label',
                    'Ocultar contraseña'
                );

            } else {

                password.type = 'password';

                icon.classList.remove('bi-eye-slash');

                icon.classList.add('bi-eye');

                this.setAttribute(
                    'aria-label',
                    'Mostrar contraseña'
                );

            }

        });


    /* =====================================================
       Elementos de mensaje
    ====================================================== */

    const loginMessage =
        document.getElementById('loginMessage');

    const loginMessageIcon =
        document.getElementById('loginMessageIcon');

    const loginMessageTitle =
        document.getElementById('loginMessageTitle');

    const loginMessageText =
        document.getElementById('loginMessageText');


    /* =====================================================
       Mostrar mensaje
    ====================================================== */

    function showLoginMessage(
        type,
        title,
        message
    ) {

        loginMessage.className =
            'login-message show ' + type;


        loginMessageTitle.textContent =
            title;


        loginMessageText.textContent =
            message;


        loginMessageIcon.className =
            'login-message-icon bi';


        if (type === 'error') {

            loginMessageIcon.classList.add(
                'bi-exclamation-circle-fill'
            );

        } else if (type === 'success') {

            loginMessageIcon.classList.add(
                'bi-check-circle-fill'
            );

        } else {

            loginMessageIcon.classList.add(
                'bi-exclamation-triangle-fill'
            );

        }

    }


    /* =====================================================
       Ocultar mensaje
    ====================================================== */

    function hideLoginMessage() {

        loginMessage.classList.remove('show');

    }


    /* =====================================================
       Login
    ====================================================== */

    document
        .getElementById('loginForm')
        .addEventListener(
            'submit',
            async function(event) {

                event.preventDefault();


                const form = this;


                const email =
                    form
                        .querySelector('[name="email"]')
                        .value
                        .trim();


                const password =
                    form
                        .querySelector('[name="password"]')
                        .value;


                const button =
                    document.getElementById(
                        'loginButton'
                    );


                const buttonContent =
                    document.getElementById(
                        'loginButtonContent'
                    );


                /*
                 * Validación básica
                 */

                if (!email || !password) {

                    showLoginMessage(
                        'warning',
                        'Datos incompletos',
                        'Ingrese su correo electrónico y contraseña.'
                    );

                    return;

                }


                /*
                 * Ocultar mensaje anterior
                 */

                hideLoginMessage();


                /*
                 * Estado de carga
                 */

                button.disabled = true;


                buttonContent.innerHTML = `

                    <span
                        class="spinner-border spinner-border-sm me-2"
                        role="status"
                        aria-hidden="true">
                    </span>

                    Autenticando...

                `;


                try {


                    /*
                     * Autenticación API
                     */

                    await CitaSaludAPI.login(
                        email,
                        password
                    );


                    /*
                     * Autenticación API correcta
                     */

                    showLoginMessage(
                        'success',
                        'Autenticación exitosa',
                        'Verificando su acceso al sistema...'
                    );


                    /*
                     * Continuar con autenticación MVC
                     */

                    setTimeout(
                        function () {

                            form.submit();

                        },
                        400
                    );


                } catch (error) {


                    /*
                     * Restaurar botón
                     */

                    button.disabled = false;


                    buttonContent.innerHTML = `

                        <i
                            class="bi bi-box-arrow-in-right me-2"
                            aria-hidden="true">
                        </i>

                        Ingresar

                    `;


                    /*
                     * Mostrar error
                     */

                    showLoginMessage(
                        'error',
                        'No fue posible iniciar sesión',
                        error.message ||
                        'Verifique sus credenciales e inténtelo nuevamente.'
                    );


                    /*
                     * Enfocar contraseña
                     */

                    document
                        .getElementById('password')
                        .focus();

                }

            }
        );

</script>


</body>

</html>