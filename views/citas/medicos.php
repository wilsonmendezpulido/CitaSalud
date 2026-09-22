<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container main-container">
    <!-- =====================================================
     ENCABEZADO - PASO 2
     ===================================================== -->

    <div class="page-header">

        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">

            <!-- Información principal -->

            <div class="flex-grow-1">

                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">

                    <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">

                        <i class="bi bi-calendar-plus me-1"></i>

                        Nueva cita

                    </span>


                    <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">

                        <i class="bi bi-cloud-check me-1"></i>

                        API REST

                    </span>

                </div>


                <!-- Título general -->

                <h1 class="page-title mb-2">

                    Programar cita médica

                </h1>


                <!-- Descripción correspondiente al paso actual -->

                <p class="page-subtitle mb-3">

                    Seleccione el profesional médico con quien desea realizar su consulta.

                </p>


                <!-- Paso actual -->

                <div class="d-flex flex-wrap align-items-center gap-2">

                    <span class="badge bg-primary rounded-pill px-3 py-2">

                        <i class="bi bi-2-circle me-1"></i>

                        Paso 2 de 4

                    </span>


                    <span class="text-muted small">

                        Selección del profesional médico

                    </span>

                </div>

            </div>


            <!-- Especialidad seleccionada -->

            <div class="specialty-summary">

                <div class="small text-muted mb-1">

                    Especialidad seleccionada

                </div>


                <div class="specialty-selected-name mb-3">

                    <i class="bi bi-heart-pulse me-1"></i>

                    <span id="nombreEspecialidad">

                        Cargando...

                    </span>

                </div>


                <a
                    href="<?php echo APP_URL; ?>/citas/create"
                    class="btn btn-outline-secondary btn-icon">

                    <i class="bi bi-arrow-left"></i>

                    <span>
                        Cambiar especialidad
                    </span>

                </a>

            </div>

        </div>

    </div>


    <!-- =====================================================
         INDICADOR DE PROGRESO
         ===================================================== -->

    <div class="card border-0 shadow-sm citasalud-card mb-4">

        <div class="card-body p-3 p-md-4">

            <div class="row g-3 align-items-center">

                <!-- Paso 1 -->

                <div class="col-12 col-md-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="step-circle completed">

                            <i class="bi bi-check-lg"></i>

                        </div>

                        <div>

                            <div class="fw-semibold">
                                Especialidad
                            </div>

                            <small class="text-success">
                                Completado
                            </small>

                        </div>

                    </div>

                </div>


                <!-- Paso 2 -->

                <div class="col-12 col-md-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="step-circle active">

                            <i class="bi bi-person-vcard"></i>

                        </div>

                        <div>

                            <div class="fw-semibold">
                                Profesional
                            </div>

                            <small class="text-primary">
                                Paso actual
                            </small>

                        </div>

                    </div>

                </div>


                <!-- Paso 3 -->

                <div class="col-12 col-md-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="step-circle">

                            <i class="bi bi-calendar-event"></i>

                        </div>

                        <div>

                            <div class="fw-semibold text-muted">
                                Fecha y hora
                            </div>

                            <small class="text-muted">
                                Pendiente
                            </small>

                        </div>

                    </div>

                </div>


                <!-- Paso 4 -->

                <div class="col-12 col-md-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="step-circle">

                            <i class="bi bi-check2-circle"></i>

                        </div>

                        <div>

                            <div class="fw-semibold text-muted">
                                Confirmación
                            </div>

                            <small class="text-muted">
                                Pendiente
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         CONTENIDO PRINCIPAL
         ===================================================== -->

    <div class="card border-0 shadow-sm citasalud-card">

        <div class="card-body p-4 p-md-5">


            <!-- Encabezado -->

            <div class="d-flex align-items-start gap-3 mb-4">

                <div class="selection-icon">

                    <i class="bi bi-person-vcard"></i>

                </div>

                <div>

                    <h2 class="h5 fw-semibold mb-1">
                        Seleccione un médico
                    </h2>

                    <p class="text-muted mb-0">
                        Seleccione el profesional con quien desea realizar su consulta.
                    </p>

                </div>

            </div>


            <!-- =================================================
                 ESTADO DE CARGA
                 ================================================= -->

            <div
                id="estadoMedicos"
                class="loading-state">

                <div class="loading-spinner">

                    <div
                        class="spinner-border text-primary"
                        role="status"
                        aria-hidden="true">
                    </div>

                </div>

                <h3 class="h6 fw-semibold mt-3 mb-1">
                    Cargando profesionales
                </h3>

                <p class="text-muted mb-0">
                    Estamos consultando los médicos disponibles.
                </p>

            </div>


            <!-- =================================================
                 ERROR
                 ================================================= -->

            <div
                id="errorMedicos"
                class="alert alert-danger d-none border-0 shadow-sm"
                role="alert">

                <div class="d-flex align-items-start gap-3">

                    <div class="error-icon">

                        <i class="bi bi-exclamation-triangle"></i>

                    </div>

                    <div class="flex-grow-1">

                        <h3 class="h6 fw-semibold mb-1">
                            No fue posible cargar los médicos
                        </h3>

                        <div
                            id="textoErrorMedicos"
                            class="small">
                        </div>

                        <button
                            type="button"
                            id="btnReintentar"
                            class="btn btn-outline-danger btn-sm mt-3">

                            <i class="bi bi-arrow-clockwise me-1"></i>

                            Reintentar

                        </button>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 ESPECIALIDAD NO VÁLIDA
                 ================================================= -->

            <div
                id="especialidadInvalida"
                class="alert alert-warning d-none border-0"
                role="alert">

                <div class="d-flex align-items-start gap-3">

                    <i class="bi bi-info-circle fs-4"></i>

                    <div>

                        <h3 class="h6 fw-semibold mb-1">
                            Especialidad no válida
                        </h3>

                        <p class="small mb-3">
                            No fue posible identificar la especialidad seleccionada.
                        </p>

                        <a
                            href="<?php echo APP_URL; ?>/citas/create"
                            class="btn btn-warning btn-sm">

                            <i class="bi bi-arrow-left me-1"></i>

                            Seleccionar especialidad

                        </a>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 SIN MÉDICOS
                 ================================================= -->

            <div
                id="sinMedicos"
                class="empty-doctors d-none">

                <div class="empty-doctors-icon">

                    <i class="bi bi-person-x"></i>

                </div>

                <h3 class="h6 fw-semibold mb-2">
                    No hay médicos disponibles
                </h3>

                <p class="text-muted mb-3">

                    Actualmente no encontramos médicos disponibles
                    para la especialidad seleccionada.

                </p>

                <a
                    href="<?php echo APP_URL; ?>/citas/create"
                    class="btn btn-outline-primary">

                    <i class="bi bi-arrow-left me-1"></i>

                    Cambiar especialidad

                </a>

            </div>


            <!-- =================================================
                 CONTENEDOR MÉDICOS
                 ================================================= -->

            <div
                id="contenedorMedicos"
                class="row g-4 d-none">
            </div>

        </div>

    </div>

</div>


<style>
    /* =========================================================
   PASOS DEL PROCESO
   ========================================================= */

    .step-circle {

        width: 42px;
        height: 42px;

        min-width: 42px;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #f1f3f5;

        color: #6c757d;

        font-size: 17px;

    }


    .step-circle.active {

        background: #e7f1ff;

        color: #0d6efd;

        box-shadow:
            0 0 0 5px rgba(13, 110, 253, .08);

    }


    .step-circle.completed {

        background: #e8f7ef;

        color: #198754;

    }


    /* =========================================================
   ICONO DE SECCIÓN
   ========================================================= */

    .selection-icon {

        width: 52px;
        height: 52px;

        min-width: 52px;

        border-radius: 14px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #e7f1ff;

        color: #0d6efd;

        font-size: 23px;

    }


    /* =========================================================
   LOADING
   ========================================================= */

    .loading-state {

        text-align: center;

        padding: 55px 20px;

        border: 1px dashed #dee2e6;

        border-radius: 16px;

        background: #fafbfc;

    }


    .loading-spinner {

        width: 58px;
        height: 58px;

        margin: 0 auto;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #e7f1ff;

        border-radius: 50%;

    }


    .loading-spinner .spinner-border {

        width: 28px;
        height: 28px;

    }


    /* =========================================================
   ERROR
   ========================================================= */

    .error-icon {

        width: 44px;
        height: 44px;

        min-width: 44px;

        border-radius: 12px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: rgba(220, 53, 69, .1);

        color: #dc3545;

        font-size: 20px;

    }


    /* =========================================================
   TARJETA MÉDICO
   ========================================================= */

    .doctor-card {

        height: 100%;

        border: 1px solid #e9ecef;

        border-radius: 16px;

        background: #fff;

        overflow: hidden;

        transition:
            transform .2s ease,
            box-shadow .2s ease,
            border-color .2s ease;

    }


    .doctor-card:hover {

        transform: translateY(-4px);

        border-color: rgba(13, 110, 253, .25);

        box-shadow:
            0 12px 28px rgba(0, 0, 0, .08);

    }


    .doctor-card-body {

        height: 100%;

        display: flex;

        flex-direction: column;

        padding: 25px;

    }


    /* =========================================================
   AVATAR
   ========================================================= */

    .doctor-avatar {

        width: 78px;
        height: 78px;

        margin: 0 auto 18px;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #e7f1ff;

        color: #0d6efd;

        font-size: 32px;

        border: 5px solid #f5f9ff;

    }


    .doctor-name {

        font-size: 1.08rem;

        font-weight: 600;

        text-align: center;

        color: #212529;

        margin-bottom: 5px;

    }


    .doctor-specialty {

        text-align: center;

        color: #0d6efd;

        font-size: .9rem;

        font-weight: 500;

        margin-bottom: 18px;

    }


    /* =========================================================
   INFORMACIÓN MÉDICO
   ========================================================= */

    .doctor-info {

        border-top: 1px solid #f0f1f2;

        padding-top: 16px;

        margin-top: auto;

    }


    .doctor-info-item {

        display: flex;

        align-items: flex-start;

        gap: 10px;

        margin-bottom: 11px;

        color: #6c757d;

        font-size: .88rem;

    }

    /* =========================================================
   RESUMEN DE ESPECIALIDAD
   ========================================================= */

    .specialty-summary {

        min-width: 245px;

        padding: 18px 20px;

        border: 1px solid #e9ecef;

        border-radius: 14px;

        background: #ffffff;

        box-shadow: 0 4px 12px rgba(0, 0, 0, .04);

    }


    .specialty-selected-name {

        color: #0d6efd;

        font-weight: 600;

        font-size: 1rem;

    }


    .specialty-selected-name i {

        font-size: .95rem;

    }


    @media (max-width: 991.98px) {

        .specialty-summary {

            width: 100%;

        }

    }

    .doctor-info-item:last-child {

        margin-bottom: 0;

    }


    .doctor-info-item i {

        color: #0d6efd;

        margin-top: 2px;

    }


    .doctor-profile {

        color: #6c757d;

        font-size: .9rem;

        line-height: 1.55;

        margin-bottom: 18px;

    }


    /* =========================================================
   BOTÓN
   ========================================================= */

    .btn-doctor {

        width: 100%;

        min-height: 44px;

        margin-top: 20px;

        border-radius: 9px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

    }


    /* =========================================================
   ESTADO VACÍO
   ========================================================= */

    .empty-doctors {

        text-align: center;

        padding: 55px 20px;

        border: 1px dashed #dee2e6;

        border-radius: 16px;

        background: #fafbfc;

    }


    .empty-doctors-icon {

        width: 68px;
        height: 68px;

        margin: 0 auto 18px;

        border-radius: 50%;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #fff3cd;

        color: #997404;

        font-size: 28px;

    }


    /* =========================================================
   RESPONSIVE
   ========================================================= */

    @media (max-width: 767.98px) {

        .step-circle {

            width: 38px;
            height: 38px;

            min-width: 38px;

            font-size: 15px;

        }

        .selection-icon {

            width: 46px;
            height: 46px;

            min-width: 46px;

            font-size: 20px;

        }

        .doctor-card-body {

            padding: 21px;

        }

        .loading-state,
        .empty-doctors {

            padding: 40px 16px;

        }

    }
</style>


<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            cargarMedicos();

        }
    );


    /**
     * Carga la información de la especialidad
     * y posteriormente los médicos disponibles.
     */
    async function cargarMedicos() {

        const params =
            new URLSearchParams(
                window.location.search
            );


        const especialidadId =
            params.get(
                'especialidad_id'
            );


        const nombreEspecialidad =
            document.getElementById(
                'nombreEspecialidad'
            );


        const estado =
            document.getElementById(
                'estadoMedicos'
            );


        const error =
            document.getElementById(
                'errorMedicos'
            );


        const textoError =
            document.getElementById(
                'textoErrorMedicos'
            );


        const sinMedicos =
            document.getElementById(
                'sinMedicos'
            );


        const especialidadInvalida =
            document.getElementById(
                'especialidadInvalida'
            );


        const contenedor =
            document.getElementById(
                'contenedorMedicos'
            );


        /*
         * Restaurar estados.
         */

        estado.classList.remove(
            'd-none'
        );

        error.classList.add(
            'd-none'
        );

        sinMedicos.classList.add(
            'd-none'
        );

        especialidadInvalida.classList.add(
            'd-none'
        );

        contenedor.classList.add(
            'd-none'
        );


        /*
         * Validar parámetro.
         */

        if (
            !especialidadId ||
            !/^\d+$/.test(
                especialidadId
            )
        ) {

            estado.classList.add(
                'd-none'
            );

            especialidadInvalida.classList.remove(
                'd-none'
            );

            nombreEspecialidad.textContent =
                'No seleccionada';

            return;

        }


        try {

            console.log(
                'Consultando especialidades mediante API REST...'
            );


            /*
             * Obtener nombre de la especialidad.
             */

            const respuestaEspecialidades =
                await CitaSaludAPI.getEspecialidades();



            if (
                respuestaEspecialidades.success &&
                Array.isArray(
                    respuestaEspecialidades.data
                )
            ) {

                const especialidad =
                    respuestaEspecialidades.data.find(
                        function(item) {

                            return String(item.id) ===
                                String(especialidadId);

                        }
                    );


                if (especialidad) {

                    nombreEspecialidad.textContent =
                        especialidad.nombre;

                } else {

                    nombreEspecialidad.textContent =
                        'Especialidad no encontrada';

                }

            }


            /*
             * Consultar médicos.
             */

            console.log(
                'Consultando médicos mediante API REST...'
            );


            const respuesta =
                await CitaSaludAPI.getMedicos(
                    especialidadId
                );


            console.log(
                'Médicos obtenidos desde API:',
                respuesta
            );


            if (
                !respuesta ||
                !respuesta.success ||
                !Array.isArray(
                    respuesta.data
                )
            ) {

                throw new Error(
                    'La respuesta de la API no tiene el formato esperado.'
                );

            }


            /*
             * Ocultar loading.
             */

            estado.classList.add(
                'd-none'
            );


            /*
             * No existen médicos.
             */

            if (
                respuesta.data.length === 0
            ) {

                sinMedicos.classList.remove(
                    'd-none'
                );

                return;

            }


            /*
             * Crear tarjetas.
             */

            contenedor.innerHTML = '';


            respuesta.data.forEach(
                function(medico) {

                    const columna =
                        document.createElement(
                            'div'
                        );


                    columna.className =
                        'col-12 col-md-6 col-lg-4';


                    const nombreCompleto =
                        (
                            (medico.nombre || '') +
                            ' ' +
                            (medico.apellido || '')
                        ).trim();


                    const nombre =
                        escapeHtml(
                            nombreCompleto ||
                            'Profesional médico'
                        );


                    const especialidad =
                        escapeHtml(
                            medico.especialidad ||
                            'Especialidad médica'
                        );


                    const perfil =
                        medico.perfil ?
                        escapeHtml(
                            medico.perfil
                        ) :
                        'Profesional disponible para atención médica.';


                    const registro =
                        medico.registro_medico ?
                        escapeHtml(
                            medico.registro_medico
                        ) :
                        'No disponible';


                    columna.innerHTML = `

                    <article class="doctor-card">

                        <div class="doctor-card-body">


                            <!-- Avatar -->

                            <div
                                class="doctor-avatar"
                                aria-hidden="true">

                                <i class="bi bi-person-badge"></i>

                            </div>


                            <!-- Nombre -->

                            <h3 class="doctor-name">

                                ${nombre}

                            </h3>


                            <!-- Especialidad -->

                            <div class="doctor-specialty">

                                <i class="bi bi-heart-pulse me-1"></i>

                                ${especialidad}

                            </div>


                            <!-- Perfil -->

                            <p class="doctor-profile">

                                ${perfil}

                            </p>


                            <!-- Información -->

                            <div class="doctor-info">


                                <div class="doctor-info-item">

                                    <i class="bi bi-card-text"></i>

                                    <div>

                                        <strong class="d-block text-dark">
                                            Registro médico
                                        </strong>

                                        <span>
                                            ${registro}
                                        </span>

                                    </div>

                                </div>


                            </div>


                            <!-- Acción -->

                            <button
                                type="button"
                                class="btn btn-primary btn-doctor btn-seleccionar-medico"
                                data-id="${escapeHtml(
                                    medico.id
                                )}"
                                data-nombre="${nombre}"
                                aria-label="Seleccionar médico ${nombre}">

                                <i class="bi bi-calendar-check"></i>

                                <span>
                                    Seleccionar médico
                                </span>

                            </button>


                        </div>

                    </article>

                `;


                    contenedor.appendChild(
                        columna
                    );

                }
            );


            /*
             * Mostrar médicos.
             */

            contenedor.classList.remove(
                'd-none'
            );


            /*
             * Eventos.
             */

            document
                .querySelectorAll(
                    '.btn-seleccionar-medico'
                )
                .forEach(
                    function(boton) {

                        boton.addEventListener(
                            'click',
                            seleccionarMedico
                        );

                    }
                );


        } catch (exception) {

            console.error(
                'Error consultando médicos:',
                exception
            );


            estado.classList.add(
                'd-none'
            );


            textoError.textContent =
                exception.message ||
                'Se produjo un error al consultar los médicos.';


            error.classList.remove(
                'd-none'
            );

        }

    }


    /**
     * Seleccionar médico.
     */
    function seleccionarMedico(event) {

        const boton =
            event.currentTarget;


        const medicoId =
            boton.dataset.id;


        if (
            !medicoId ||
            !/^\d+$/.test(
                medicoId
            )
        ) {

            console.error(
                'No se recibió un identificador válido del médico.'
            );

            return;

        }


        /*
         * Evitar doble clic.
         */

        boton.disabled = true;


        boton.innerHTML = `

        <span
            class="spinner-border spinner-border-sm"
            aria-hidden="true">
        </span>

        <span>
            Consultando disponibilidad...
        </span>

    `;


        /*
         * Continuar al siguiente paso.
         */

        window.location.href =
            '<?php echo APP_URL; ?>/citas/disponibilidad?medico_id=' +
            encodeURIComponent(
                medicoId
            );

    }


    /**
     * Escapa contenido proveniente de la API.
     */
    function escapeHtml(texto) {

        const div =
            document.createElement(
                'div'
            );


        div.textContent =
            texto === null ||
            texto === undefined ?
            '' :
            String(texto);


        return div.innerHTML;

    }


    /**
     * Reintentar consulta.
     */
    document.addEventListener(
        'click',
        function(event) {

            if (
                event.target.closest(
                    '#btnReintentar'
                )
            ) {

                cargarMedicos();

            }

        }
    );
</script>