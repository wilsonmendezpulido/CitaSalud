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

                    Seleccione una especialidad.

                </p>


                <!-- Paso actual -->

                <div class="d-flex flex-wrap align-items-center gap-2">

                    <span class="badge bg-primary rounded-pill px-3 py-2">

                        <i class="bi bi-1-circle me-1"></i>

                        Paso 1 de 4

                    </span>


                    <span class="text-muted small">

                        Selección de especialidad

                    </span>

                </div>

            </div>


            <!-- Especialidad seleccionada -->

            <div class="specialty-summary">

                <a
                    href="<?php echo APP_URL; ?>/dashboard"
                    class="btn btn-outline-secondary btn-icon">

                    <i class="bi bi-arrow-left"></i>

                    <span>
                        Volver a Dashboard
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

                        <div class="step-circle active">

                            <i class="bi bi-person-vcard"></i>

                        </div>

                        <div>

                            <div class="fw-semibold">
                                Especialidad
                            </div>

                            <small class="text-primary">
                                Paso actual
                            </small>

                        </div>

                    </div>

                </div>


                <!-- Paso 2 -->

                <div class="col-12 col-md-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="step-circle">

                            <i class="bi bi-calendar-event"></i>

                        </div>

                        <div>

                            <div class="fw-semibold text-muted">
                                Profesional
                            </div>

                            <small class="text-muted">
                                Pendiente
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


    <!-- Contenido principal -->
    <div class="card border-0 shadow-sm citasalud-card">

        <div class="card-body p-4 p-md-5">

            <!-- Título sección -->
            <div class="d-flex align-items-start gap-3 mb-4">

                <div class="selection-icon">
                    <i class="bi bi-hospital"></i>
                </div>

                <div>
                    <h2 class="h5 fw-semibold mb-1">
                        Seleccione una especialidad
                    </h2>

                    <p class="text-muted mb-0">
                        Elija el área médica que corresponde a su necesidad de atención.
                    </p>
                </div>

            </div>


            <!-- Estado de carga -->
            <div
                id="estadoEspecialidades"
                class="loading-state">

                <div class="loading-spinner">

                    <div
                        class="spinner-border text-primary"
                        role="status"
                        aria-hidden="true">
                    </div>

                </div>

                <h3 class="h6 fw-semibold mt-3 mb-1">
                    Cargando especialidades
                </h3>

                <p class="text-muted mb-0">
                    Estamos consultando las especialidades disponibles.
                </p>

            </div>


            <!-- Mensaje de error -->
            <div
                id="errorEspecialidades"
                class="alert alert-danger d-none border-0 shadow-sm"
                role="alert">

                <div class="d-flex align-items-start gap-3">

                    <div class="error-icon">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>

                    <div class="flex-grow-1">

                        <h3 class="h6 fw-semibold mb-1">
                            No fue posible cargar las especialidades
                        </h3>

                        <div
                            id="textoErrorEspecialidades"
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


            <!-- Contenedor de especialidades -->
            <div
                id="contenedorEspecialidades"
                class="row g-4 d-none">
            </div>

        </div>

    </div>

</div>


<style>
    /* =========================================================
   PROGRAMAR CITA - ESPECIALIDADES
   ========================================================= */
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

    .specialty-summary {

        min-width: 245px;

        padding: 18px 20px;

        border: 1px solid #e9ecef;

        border-radius: 14px;

        background: #ffffff;

        box-shadow: 0 4px 12px rgba(0, 0, 0, .04);

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

        transition:
            background-color .2s ease,
            color .2s ease,
            transform .2s ease;

    }

    .step-circle.active {

        background: #e7f1ff;

        color: #0d6efd;

        box-shadow:
            0 0 0 5px rgba(13, 110, 253, .08);

    }


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


    /* Tarjetas de especialidades */

    .specialty-card {

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


    .specialty-card:hover {

        transform: translateY(-4px);

        border-color: rgba(13, 110, 253, .25);

        box-shadow:
            0 12px 28px rgba(0, 0, 0, .08);

    }


    .specialty-card-body {

        height: 100%;

        display: flex;

        flex-direction: column;

        padding: 25px;

    }


    .specialty-icon {

        width: 64px;
        height: 64px;

        margin-bottom: 20px;

        border-radius: 16px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #e7f1ff;

        color: #0d6efd;

        font-size: 29px;

    }


    .specialty-title {

        font-size: 1.08rem;

        font-weight: 600;

        color: #212529;

        margin-bottom: 9px;

    }


    .specialty-description {

        flex-grow: 1;

        color: #6c757d;

        font-size: .93rem;

        line-height: 1.55;

        margin-bottom: 22px;

    }


    .btn-specialty {

        width: 100%;

        min-height: 44px;

        border-radius: 9px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

    }


    /* Estado vacío */

    .empty-specialties {

        padding: 55px 20px;

        text-align: center;

        border: 1px dashed #dee2e6;

        border-radius: 16px;

        background: #fafbfc;

    }


    .empty-specialties-icon {

        width: 64px;
        height: 64px;

        margin: 0 auto 18px;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #e8f6fa;

        color: #0dcaf0;

        font-size: 27px;

    }


    /* Responsive */

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

        .specialty-card-body {

            padding: 21px;

        }

        .loading-state,
        .empty-specialties {

            padding: 40px 16px;

        }

    }
</style>


<script src="<?php echo APP_URL; ?>/js/api.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        cargarEspecialidades();

    });


    /**
     * Consulta las especialidades mediante la API REST.
     */
    async function cargarEspecialidades() {

        const contenedor =
            document.getElementById(
                'contenedorEspecialidades'
            );

        const estado =
            document.getElementById(
                'estadoEspecialidades'
            );

        const error =
            document.getElementById(
                'errorEspecialidades'
            );

        const textoError =
            document.getElementById(
                'textoErrorEspecialidades'
            );

        try {

            // Restaurar estados
            estado.classList.remove('d-none');

            error.classList.add('d-none');

            contenedor.classList.add('d-none');

            contenedor.innerHTML = '';

            console.log(
                'Consultando especialidades mediante API REST...'
            );


            const respuesta =
                await CitaSaludAPI.getEspecialidades();


            console.log(
                'Respuesta de API:',
                respuesta
            );


            /*
             * Validar estructura de respuesta.
             */
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


            // Ocultar estado de carga
            estado.classList.add('d-none');


            /*
             * Sin especialidades.
             */
            if (
                respuesta.data.length === 0
            ) {

                contenedor.innerHTML = `

                <div class="col-12">

                    <div class="empty-specialties">

                        <div class="empty-specialties-icon">

                            <i class="bi bi-hospital"></i>

                        </div>

                        <h3 class="h6 fw-semibold mb-2">
                            No hay especialidades disponibles
                        </h3>

                        <p class="text-muted mb-0">
                            Actualmente no existen especialidades
                            disponibles para programar una cita.
                        </p>

                    </div>

                </div>

            `;

                contenedor.classList.remove(
                    'd-none'
                );

                return;

            }


            /*
             * Crear tarjetas.
             */
            respuesta.data.forEach(
                function(especialidad) {

                    const columna =
                        document.createElement(
                            'div'
                        );

                    columna.className =
                        'col-12 col-md-6 col-lg-4';


                    const nombre =
                        escapeHtml(
                            especialidad.nombre
                        );


                    const descripcion =
                        especialidad.descripcion ?
                        escapeHtml(
                            especialidad.descripcion
                        ) :
                        'Consulta médica especializada.';


                    columna.innerHTML = `

                    <article class="specialty-card">

                        <div class="specialty-card-body">

                            <div class="specialty-icon"
                                 aria-hidden="true">

                                <i class="bi bi-heart-pulse"></i>

                            </div>


                            <h3 class="specialty-title">
                                ${nombre}
                            </h3>


                            <p class="specialty-description">
                                ${descripcion}
                            </p>


                            <button
                                type="button"
                                class="btn btn-primary btn-specialty btn-seleccionar"
                                data-id="${escapeHtml(
                                    especialidad.id
                                )}"
                                data-nombre="${nombre}"
                                aria-label="Seleccionar especialidad ${nombre}">

                                <i class="bi bi-arrow-right-circle"></i>

                                <span>
                                    Seleccionar
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
             * Mostrar resultados.
             */
            contenedor.classList.remove(
                'd-none'
            );


            /*
             * Eventos de selección.
             */
            document
                .querySelectorAll(
                    '.btn-seleccionar'
                )
                .forEach(
                    function(boton) {

                        boton.addEventListener(
                            'click',
                            seleccionarEspecialidad
                        );

                    }
                );


        } catch (exception) {

            console.error(
                'Error al consultar especialidades:',
                exception
            );


            estado.classList.add(
                'd-none'
            );


            contenedor.classList.add(
                'd-none'
            );


            textoError.textContent =
                exception.message ||
                'Se produjo un error al consultar la información.';


            error.classList.remove(
                'd-none'
            );

        }

    }


    /**
     * Selecciona una especialidad y continúa
     * con el proceso de programación.
     */
    function seleccionarEspecialidad(event) {

        const boton =
            event.currentTarget;


        const especialidadId =
            boton.dataset.id;


        if (!especialidadId) {

            console.error(
                'No se recibió el identificador de la especialidad.'
            );

            return;

        }


        /*
         * Evitar múltiples clics.
         */
        boton.disabled = true;


        const textoOriginal =
            boton.innerHTML;


        boton.innerHTML = `

        <span
            class="spinner-border spinner-border-sm"
            aria-hidden="true">
        </span>

        <span>
            Cargando...
        </span>

    `;


        /*
         * Continuar al listado de médicos.
         */
        window.location.href =
            '<?php echo APP_URL; ?>/citas/medicos?especialidad_id=' +
            encodeURIComponent(
                especialidadId
            );

    }


    /**
     * Escapa contenido antes de insertarlo
     * dinámicamente en el DOM.
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


    /*
     * Reintentar consulta cuando ocurre un error.
     */
    document.addEventListener(
        'click',
        function(event) {

            if (
                event.target.closest(
                    '#btnReintentar'
                )
            ) {

                cargarEspecialidades();

            }

        }
    );
</script>