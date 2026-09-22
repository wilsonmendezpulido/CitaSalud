<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container main-container disponibilidad-page">

    <!-- =====================================================
     ENCABEZADO - PASO 3
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

                    Seleccione una fecha y un horario disponible para continuar con la programación.

                </p>


                <!-- Paso actual -->

                <div class="d-flex flex-wrap align-items-center gap-2">

                    <span class="badge bg-primary rounded-pill px-3 py-2">

                        <i class="bi bi-3-circle me-1"></i>

                        Paso 3 de 4

                    </span>


                    <span class="text-muted small">

                        Selección de fecha y hora

                    </span>

                </div>

            </div>


            <!-- Especialidad seleccionada -->

            <div class="specialty-summary">

                <div class="summary-icon">
                    <i class="bi bi-person-badge"></i>
                </div>

                <div class="summary-content">

                    <span class="summary-label">
                        Profesional seleccionado
                    </span>

                    <strong id="nombreMedico">
                        Cargando...
                    </strong>

                    <span class="summary-specialty">
                        <i class="bi bi-heart-pulse me-1"></i>
                        <span id="nombreEspecialidad">
                            Cargando...
                        </span>
                    </span>

                </div>

                <a
                    id="btnCambiarMedico"
                    href="<?php echo APP_URL; ?>/citas/medicos"
                    class="btn btn-outline-primary btn-icon">

                    <i class="bi bi-arrow-left"></i>

                    <span>
                        Cambiar médico
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

                        <div class="step-circle completed">

                            <i class="bi bi-check-lg"></i>

                        </div>

                        <div>

                            <div class="fw-semibold">
                                Profesional
                            </div>

                            <small class="text-success">
                                Completado
                            </small>

                        </div>

                    </div>

                </div>


                <!-- Paso 3 -->

                <div class="col-12 col-md-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="step-circle active">

                            <i class="bi bi-calendar-event"></i>

                        </div>

                        <div>

                            <div class="fw-semibold text-primary">
                                Fecha y hora
                            </div>

                            <small class="text-primary">
                                Paso actual
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


    <div class="card shadow-sm">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <span class="section-kicker">Paso 3</span>
                    <h2 class="card-title mb-1">Seleccione fecha y hora</h2>
                    <p class="text-muted mb-0">
                        Elija una fecha disponible y posteriormente uno de los horarios habilitados.
                    </p>
                </div>

                <span class="badge bg-success">
                    API REST
                </span>

            </div>


            <!-- Cargando fechas -->

            <div
                id="estadoFechas"
                class="text-center py-4">

                <div
                    class="spinner-border text-primary"
                    role="status">

                    <span class="visually-hidden">
                        Cargando...
                    </span>

                </div>

                <p class="text-muted mt-2 mb-0">
                    Consultando disponibilidad...
                </p>

            </div>


            <!-- Error -->

            <div
                id="errorDisponibilidad"
                class="alert alert-danger d-none"
                role="alert">
            </div>


            <!-- Sin fechas -->

            <div
                id="sinFechas"
                class="alert alert-warning d-none">

                Actualmente no hay fechas disponibles
                para este médico.

            </div>


            <!-- Fechas -->

            <div
                id="contenedorFechas"
                class="row d-none">
            </div>


            <!-- Horarios -->

            <div
                id="seccionHorarios"
                class="d-none">

                <hr class="my-4">

                <div class="mb-4">
                    <span class="section-kicker">Horario</span>
                    <h3 class="h5 mb-1">Seleccione una hora</h3>
                    <p class="text-muted mb-0">
                        Seleccione uno de los horarios disponibles para la fecha elegida.
                    </p>
                </div>


                <div
                    id="estadoHorarios"
                    class="text-center py-3 d-none">

                    <div
                        class="spinner-border text-primary"
                        role="status">

                        <span class="visually-hidden">
                            Cargando...
                        </span>

                    </div>

                    <p class="text-muted mt-2">
                        Consultando horarios...
                    </p>

                </div>


                <div
                    id="sinHorarios"
                    class="alert alert-warning d-none">

                    No hay horarios disponibles para
                    la fecha seleccionada.

                </div>


                <div
                    id="contenedorHorarios"
                    class="row">
                </div>

            </div>

        </div>

    </div>

</div>




<style>
    .disponibilidad-page {
        padding-top: 1rem;
        padding-bottom: 3rem
    }

    .appointment-progress {
        display: flex;
        align-items: center;
        width: 100%;
        overflow-x: auto;
        padding-bottom: .25rem
    }

    .progress-step {
        display: flex;
        align-items: center;
        gap: .65rem;
        min-width: 150px;
        flex-shrink: 0
    }

    .progress-step-circle {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        color: #64748b;
        border: 2px solid #e2e8f0;
        font-weight: 700;
        flex-shrink: 0
    }

    .progress-step-content {
        display: flex;
        flex-direction: column;
        line-height: 1.2
    }

    .progress-step-content strong {
        font-size: .9rem;
        color: #334155
    }

    .progress-step-content small {
        color: #94a3b8;
        margin-top: .2rem
    }

    .progress-step.completed .progress-step-circle {
        background: #198754;
        border-color: #198754;
        color: #fff
    }

    .progress-step.active .progress-step-circle {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .12)
    }

    .progress-step.active .progress-step-content strong {
        color: #0d6efd
    }

    .progress-line {
        height: 2px;
        background: #e2e8f0;
        flex: 1;
        min-width: 35px;
        margin: 0 .75rem
    }

    .progress-line.completed,
    .progress-line.active {
        background: #0d6efd
    }

    .specialty-summary {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.15rem 1.25rem;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        box-shadow: 0 .25rem 1rem rgba(15, 23, 42, .05)
    }

    .summary-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e7f1ff;
        color: #0d6efd;
        font-size: 1.35rem;
        flex-shrink: 0
    }

    .summary-content {
        display: flex;
        flex-direction: column;
        flex: 1;
        min-width: 0
    }

    .summary-label {
        font-size: .78rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: .15rem
    }

    .summary-content strong {
        color: #1e293b;
        font-size: 1.05rem
    }

    .summary-specialty {
        color: #64748b;
        font-size: .9rem;
        margin-top: .15rem
    }

    .section-kicker {
        display: block;
        font-size: .75rem;
        font-weight: 700;
        color: #0d6efd;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: .25rem
    }

    .btn-fecha {
        border: 0;
        background: transparent;
        transition: transform .2s ease
    }

    .btn-fecha:hover {
        transform: translateY(-2px)
    }

    .btn-fecha .card {
        border: 1px solid #e2e8f0;
        border-radius: .9rem;
        transition: all .2s ease
    }

    .btn-fecha:hover .card {
        border-color: #0d6efd;
        box-shadow: 0 .4rem 1rem rgba(15, 23, 42, .08)
    }

    .btn-horario {
        min-height: 48px;
        border-radius: .75rem;
        font-weight: 600
    }

    #estadoFechas,
    #estadoHorarios {
        padding: 2rem 1rem !important
    }

    @media (max-width:767.98px) {
        .appointment-progress {
            align-items: flex-start
        }

        .progress-step {
            min-width: 125px
        }

        .progress-step-content {
            display: none
        }

        .specialty-summary {
            align-items: flex-start;
            flex-wrap: wrap
        }

        .specialty-summary .btn {
            width: 100%
        }
    }

    @media (prefers-reduced-motion:reduce) {

        .btn-fecha,
        .btn-fecha .card {
            transition: none
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', async function() {

        /*
         * Obtener parámetros de la URL
         */

        const params =
            new URLSearchParams(
                window.location.search
            );

        const medicoId =
            params.get('medico_id');

        const especialidadId =
            params.get('especialidad_id');

        const fechaSeleccionada =
            params.get('fecha');


        /*
         * Elementos de interfaz
         */

        const nombreMedico =
            document.getElementById(
                'nombreMedico'
            );

        const nombreEspecialidad =
            document.getElementById(
                'nombreEspecialidad'
            );

        const btnCambiarMedico =
            document.getElementById(
                'btnCambiarMedico'
            );

        const estadoFechas =
            document.getElementById(
                'estadoFechas'
            );

        const errorDisponibilidad =
            document.getElementById(
                'errorDisponibilidad'
            );

        const sinFechas =
            document.getElementById(
                'sinFechas'
            );

        const contenedorFechas =
            document.getElementById(
                'contenedorFechas'
            );

        const seccionHorarios =
            document.getElementById(
                'seccionHorarios'
            );

        const estadoHorarios =
            document.getElementById(
                'estadoHorarios'
            );

        const sinHorarios =
            document.getElementById(
                'sinHorarios'
            );

        const contenedorHorarios =
            document.getElementById(
                'contenedorHorarios'
            );


        /*
         * Validar médico
         */

        if (!medicoId) {

            estadoFechas.classList.add(
                'd-none'
            );

            errorDisponibilidad.classList.remove(
                'd-none'
            );

            errorDisponibilidad.innerHTML =
                'No se recibió un médico válido.';

            return;

        }




        try {

            console.log(
                'Consultando disponibilidad mediante API REST...'
            );

            console.log(
                'Médico ID:',
                medicoId
            );


            /*
             * Obtener información del médico
             *
             * El endpoint actual de médicos
             * permite recuperar sus datos.
             */

            const medico =
                await obtenerMedico(
                    medicoId
                );


            if (medico) {

                nombreMedico.textContent =
                    (
                        medico.nombre || ''
                    ) +
                    ' ' +
                    (
                        medico.apellido || ''
                    );

                nombreEspecialidad.textContent =
                    medico.especialidad || '';

                if (
                    medico.especialidad_id &&
                    !especialidadId
                ) {

                    btnCambiarMedico.href =
                        '<?php echo APP_URL; ?>/citas/medicos?especialidad_id=' +
                        encodeURIComponent(
                            medico.especialidad_id
                        );

                }

                /*
                 * Configurar enlace para volver al paso anterior.
                 *
                 * Se conserva la especialidad seleccionada:
                 * /citas/medicos?especialidad_id=X
                 */

                if (
                    especialidadId &&
                    /^\d+$/.test(
                        especialidadId
                    )
                ) {

                    btnCambiarMedico.href =
                        '<?php echo APP_URL; ?>/citas/medicos?especialidad_id=' +
                        encodeURIComponent(
                            medico.especialidad_id
                        );

                } else {

                    btnCambiarMedico.href =
                        '<?php echo APP_URL; ?>/citas/medicos?especialidad_id=' +
                        encodeURIComponent(
                            medico.especialidad_id
                        );

                }

            }


            /*
             * Consultar fechas disponibles
             */

            let respuesta;


            /*
             * Si existe una fecha seleccionada,
             * consultamos directamente esa fecha.
             *
             * Si no existe, obtenemos las fechas
             * disponibles usando la lógica del backend.
             */

            if (fechaSeleccionada) {

                respuesta =
                    await CitaSaludAPI.getDisponibilidad(
                        medicoId,
                        fechaSeleccionada
                    );

            } else {

                respuesta =
                    await obtenerFechasDisponibles(
                        medicoId
                    );

            }


            console.log(
                'Respuesta de disponibilidad:',
                respuesta
            );


            if (
                !respuesta.success ||
                !Array.isArray(respuesta.data)
            ) {

                throw new Error(
                    'La respuesta de la API no tiene el formato esperado.'
                );

            }


            estadoFechas.classList.add(
                'd-none'
            );


            /*
             * Mostrar fechas
             */

            if (respuesta.data.length === 0) {

                sinFechas.classList.remove(
                    'd-none'
                );

            } else {

                contenedorFechas.classList.remove(
                    'd-none'
                );

                construirFechas(
                    respuesta.data,
                    medicoId,
                    fechaSeleccionada
                );

            }


            /*
             * Si existe fecha seleccionada,
             * mostrar horarios.
             */

            if (fechaSeleccionada) {

                await cargarHorarios(
                    medicoId,
                    fechaSeleccionada
                );

            }


        } catch (exception) {

            console.error(
                'Error consultando disponibilidad:',
                exception
            );


            estadoFechas.classList.add(
                'd-none'
            );


            errorDisponibilidad.classList.remove(
                'd-none'
            );


            errorDisponibilidad.innerHTML = `
            <strong>
                No fue posible cargar la disponibilidad.
            </strong>
            <br>
            ${escapeHtml(
                exception.message
            )}
        `;

        }

    });


    /*
     * Obtener médico por ID
     */

    async function obtenerMedico(medicoId) {

        /*
         * El endpoint existente requiere
         * especialidad_id.
         *
         * Como el API actual no tiene
         * /api/medicos/{id}, consultamos
         * las especialidades y posteriormente
         * los médicos.
         */

        const especialidades =
            await CitaSaludAPI.getEspecialidades();


        if (
            !especialidades.success ||
            !Array.isArray(
                especialidades.data
            )
        ) {

            return null;

        }


        for (
            const especialidad of especialidades.data
        ) {

            try {

                const respuesta =
                    await CitaSaludAPI.getMedicos(
                        especialidad.id
                    );


                if (
                    !respuesta.success ||
                    !Array.isArray(
                        respuesta.data
                    )
                ) {

                    continue;

                }


                const medico =
                    respuesta.data.find(
                        function(item) {

                            return String(item.id) ===
                                String(medicoId);

                        }
                    );


                if (medico) {

                    return medico;

                }

            } catch (error) {

                console.warn(
                    'No fue posible consultar médicos de la especialidad:',
                    especialidad.id
                );

            }

        }


        return null;

    }


    /*
     * Obtener fechas disponibles
     *
     * El endpoint actual requiere fecha.
     *
     * Para no inventar fechas en el frontend,
     * utilizamos inicialmente la fecha actual
     * y posteriormente podemos ampliar el API
     * para devolver directamente las fechas.
     */

    async function obtenerFechasDisponibles(
        medicoId
    ) {

        /*
         * Consultamos los próximos 30 días.
         */

        const fechas = [];


        const hoy =
            new Date();


        for (
            let i = 0; i < 30; i++
        ) {

            const fecha =
                new Date(hoy);


            fecha.setDate(
                hoy.getDate() + i
            );


            const fechaISO =
                fecha.toISOString()
                .split('T')[0];


            try {

                const respuesta =
                    await CitaSaludAPI.getDisponibilidad(
                        medicoId,
                        fechaISO
                    );


                if (
                    respuesta.success &&
                    Array.isArray(
                        respuesta.data
                    ) &&
                    respuesta.data.length > 0
                ) {

                    fechas.push({

                        fecha: fechaISO,

                        horarios: respuesta.data

                    });

                }

            } catch (error) {

                console.warn(
                    'No hay disponibilidad para:',
                    fechaISO
                );

            }

        }


        return {

            success: true,

            data: fechas

        };

    }


    /*
     * Construir tarjetas de fechas
     */

    function construirFechas(
        fechas,
        medicoId,
        fechaSeleccionada
    ) {

        const contenedor =
            document.getElementById(
                'contenedorFechas'
            );


        contenedor.innerHTML = '';


        fechas.forEach(
            function(item) {

                const fechaValor =
                    item.fecha;


                const fecha =
                    new Date(
                        fechaValor +
                        'T00:00:00'
                    );


                const fechaFormateada =
                    fecha.toLocaleDateString(
                        'es-CO', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric'
                        }
                    );


                const dia =
                    fecha.toLocaleDateString(
                        'es-CO', {
                            weekday: 'long'
                        }
                    );


                const columna =
                    document.createElement(
                        'div'
                    );


                columna.className =
                    'col-md-4 col-lg-3 mb-3';


                const seleccionada =
                    fechaSeleccionada &&
                    fechaSeleccionada ===
                    fechaValor;


                columna.innerHTML = `

                <button
                    type="button"
                    class="btn p-0 w-100 text-start btn-fecha"
                    data-fecha="${fechaValor}">

                    <div
                        class="card h-100
                        ${
                            seleccionada
                                ? 'border-primary bg-light'
                                : ''
                        }">

                        <div
                            class="card-body text-center">

                            <div class="text-primary mb-2">
                                📅
                            </div>

                            <h6 class="text-capitalize">
                                ${escapeHtml(
                                    dia
                                )}
                            </h6>

                            <strong>
                                ${fechaFormateada}
                            </strong>

                        </div>

                    </div>

                </button>

            `;


                contenedor.appendChild(
                    columna
                );

            }
        );


        /*
         * Eventos de selección de fecha
         */

        document
            .querySelectorAll(
                '.btn-fecha'
            )
            .forEach(
                function(boton) {

                    boton.addEventListener(
                        'click',
                        async function() {

                            const fecha =
                                this.dataset.fecha;


                            /*
                             * Actualizar URL
                             */

                            const nuevaUrl =
                                '<?php echo APP_URL; ?>/citas/disponibilidad?medico_id=' +
                                encodeURIComponent(
                                    medicoId
                                ) +
                                '&fecha=' +
                                encodeURIComponent(
                                    fecha
                                );


                            window.history.pushState({},
                                '',
                                nuevaUrl
                            );


                            /*
                             * Recargar horarios
                             */

                            await cargarHorarios(
                                medicoId,
                                fecha
                            );


                            /*
                             * Marcar fecha
                             */

                            document
                                .querySelectorAll(
                                    '.btn-fecha .card'
                                )
                                .forEach(
                                    function(card) {

                                        card.classList
                                            .remove(
                                                'border-primary',
                                                'bg-light'
                                            );

                                    }
                                );


                            this
                                .querySelector('.card')
                                .classList.add(
                                    'border-primary',
                                    'bg-light'
                                );

                        }
                    );

                }
            );

    }


    /*
     * Cargar horarios
     */

    async function cargarHorarios(
        medicoId,
        fecha
    ) {

        const seccionHorarios =
            document.getElementById(
                'seccionHorarios'
            );

        const estadoHorarios =
            document.getElementById(
                'estadoHorarios'
            );

        const sinHorarios =
            document.getElementById(
                'sinHorarios'
            );

        const contenedorHorarios =
            document.getElementById(
                'contenedorHorarios'
            );


        seccionHorarios.classList.remove(
            'd-none'
        );

        estadoHorarios.classList.remove(
            'd-none'
        );

        sinHorarios.classList.add(
            'd-none'
        );

        contenedorHorarios.innerHTML = '';


        try {

            console.log(
                'Consultando horarios:',
                medicoId,
                fecha
            );


            const respuesta =
                await CitaSaludAPI.getDisponibilidad(
                    medicoId,
                    fecha
                );


            console.log(
                'Horarios obtenidos:',
                respuesta
            );


            estadoHorarios.classList.add(
                'd-none'
            );


            if (
                !respuesta.success ||
                !Array.isArray(
                    respuesta.data
                )
            ) {

                throw new Error(
                    'Respuesta inválida de la API.'
                );

            }


            if (
                respuesta.data.length === 0
            ) {

                sinHorarios.classList.remove(
                    'd-none'
                );

                return;

            }


            respuesta.data.forEach(
                function(horario) {

                    const columna =
                        document.createElement(
                            'div'
                        );


                    columna.className =
                        'col-md-3 mb-3';


                    const horaInicio =
                        formatearHora(
                            horario.hora_inicio
                        );


                    const horaFin =
                        formatearHora(
                            horario.hora_fin
                        );


                    columna.innerHTML = `

                    <div class="d-grid">

                        <button
                            type="button"
                            class="btn btn-outline-primary btn-horario"
                            data-id="${horario.id}">

                            🕐

                            ${horaInicio}
                            -
                            ${horaFin}

                        </button>

                    </div>

                `;


                    contenedorHorarios.appendChild(
                        columna
                    );

                }
            );


            /*
             * Seleccionar horario
             */

            document
                .querySelectorAll(
                    '.btn-horario'
                )
                .forEach(
                    function(boton) {

                        boton.addEventListener(
                            'click',
                            function() {

                                const disponibilidadId =
                                    this.dataset.id;


                                window.location.href =
                                    '<?php echo APP_URL; ?>/citas/confirmar?disponibilidad_id=' +
                                    encodeURIComponent(
                                        disponibilidadId
                                    );

                            }
                        );

                    }
                );


        } catch (exception) {

            estadoHorarios.classList.add(
                'd-none'
            );


            sinHorarios.classList.remove(
                'd-none'
            );


            sinHorarios.innerHTML = `
            <strong>
                No fue posible consultar los horarios.
            </strong>
            <br>
            ${escapeHtml(
                exception.message
            )}
        `;


            console.error(
                'Error consultando horarios:',
                exception
            );

        }

    }


    /*
     * Formatear hora
     */

    function formatearHora(
        hora
    ) {

        if (!hora) {

            return '';

        }


        return hora.substring(
            0,
            5
        );

    }


    /*
     * Protección HTML
     */

    function escapeHtml(
        texto
    ) {

        const div =
            document.createElement(
                'div'
            );


        div.textContent =
            texto === null ||
            texto === undefined ?
            '' :
            texto;


        return div.innerHTML;

    }
</script>