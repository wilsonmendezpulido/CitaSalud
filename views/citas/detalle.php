<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container main-container">

    <!-- HEADER -->
    <div class="detail-header mb-4">

        <div>

            <div class="d-flex align-items-center gap-2 mb-2">

                <div class="detail-title-icon">
                    <i class="bi bi-calendar2-heart"></i>
                </div>

                <h1 class="page-title mb-0">
                    Detalle de la cita
                </h1>

            </div>

            <p class="page-subtitle">
                Consulta la información completa de tu cita médica.
            </p>

        </div>


        <a
            href="<?= APP_URL ?>/citas/mis-citas"
            class="btn btn-outline-secondary btn-icon">

            <i class="bi bi-arrow-left"></i>

            Mis citas

        </a>

    </div>


    <!-- CONTENEDOR PRINCIPAL -->

    <div class="card appointment-detail-card shadow-sm">

        <!-- LOADING -->

        <div
            id="estadoCarga"
            class="detail-loading">

            <div class="loading-icon">

                <div
                    class="spinner-border text-primary"
                    role="status">

                    <span class="visually-hidden">
                        Cargando...
                    </span>

                </div>

            </div>

            <h5>
                Cargando información
            </h5>

            <p class="text-muted mb-0">
                Consultando los datos de la cita...
            </p>

        </div>


        <!-- ERROR -->

        <div
            id="errorDetalle"
            class="alert alert-danger d-none detail-error"
            role="alert">

            <div class="d-flex align-items-start gap-3">

                <i class="bi bi-exclamation-triangle-fill fs-4"></i>

                <div class="flex-grow-1">

                    <strong>
                        No fue posible cargar la cita.
                    </strong>

                    <div
                        id="mensajeError"
                        class="small mt-1">
                    </div>

                    <button
                        type="button"
                        id="btnReintentar"
                        class="btn btn-sm btn-outline-danger btn-icon mt-3">

                        <i class="bi bi-arrow-clockwise"></i>

                        Reintentar

                    </button>

                </div>

            </div>

        </div>


        <!-- DETALLE -->

        <div
            id="detalleCita"
            class="d-none">


            <!-- HERO DE CITA -->

            <div class="appointment-detail-hero">

                <div class="hero-content">

                    <div class="hero-date-icon">

                        <i class="bi bi-calendar-check"></i>

                    </div>

                    <div>

                        <span class="hero-label">
                            Cita médica
                        </span>

                        <h2 id="heroEspecialidad">
                            -
                        </h2>

                        <div class="hero-date">

                            <span>
                                <i class="bi bi-calendar3 me-1"></i>

                                <span id="heroFecha">
                                    -
                                </span>
                            </span>

                            <span>
                                <i class="bi bi-clock me-1"></i>

                                <span id="heroHora">
                                    -
                                </span>
                            </span>

                        </div>

                    </div>

                </div>


                <div id="heroEstado">
                </div>

            </div>


            <div class="p-4 p-md-5">


                <!-- INFORMACIÓN DE CITA -->

                <div class="detail-section">

                    <div class="detail-section-heading">

                        <div class="section-icon section-icon-primary">

                            <i class="bi bi-calendar2-check"></i>

                        </div>

                        <div>

                            <h3>
                                Información de la cita
                            </h3>

                            <p>
                                Datos relacionados con la programación.
                            </p>

                        </div>

                    </div>


                    <div class="row g-3">


                        <!-- Fecha -->

                        <div class="col-12 col-md-6">

                            <div class="detail-item">

                                <div class="detail-item-icon">

                                    <i class="bi bi-calendar3"></i>

                                </div>

                                <div>

                                    <span>
                                        Fecha
                                    </span>

                                    <strong id="fecha">
                                        -
                                    </strong>

                                </div>

                            </div>

                        </div>


                        <!-- Hora -->

                        <div class="col-12 col-md-6">

                            <div class="detail-item">

                                <div class="detail-item-icon">

                                    <i class="bi bi-clock"></i>

                                </div>

                                <div>

                                    <span>
                                        Hora
                                    </span>

                                    <strong id="hora">
                                        -
                                    </strong>

                                </div>

                            </div>

                        </div>


                        <!-- Especialidad -->

                        <div class="col-12 col-md-6">

                            <div class="detail-item">

                                <div class="detail-item-icon">

                                    <i class="bi bi-heart-pulse"></i>

                                </div>

                                <div>

                                    <span>
                                        Especialidad
                                    </span>

                                    <strong id="especialidad">
                                        -
                                    </strong>

                                </div>

                            </div>

                        </div>


                        <!-- Estado -->

                        <div class="col-12 col-md-6">

                            <div class="detail-item">

                                <div class="detail-item-icon">

                                    <i class="bi bi-info-circle"></i>

                                </div>

                                <div>

                                    <span>
                                        Estado
                                    </span>

                                    <div id="estado">
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <hr class="detail-divider">


                <!-- MÉDICO -->

                <div class="detail-section">

                    <div class="detail-section-heading">

                        <div class="section-icon section-icon-success">

                            <i class="bi bi-person-badge"></i>

                        </div>

                        <div>

                            <h3>
                                Profesional de salud
                            </h3>

                            <p>
                                Médico asignado a la cita.
                            </p>

                        </div>

                    </div>


                    <div class="doctor-profile">

                        <div class="doctor-profile-avatar">

                            <i class="bi bi-person-fill"></i>

                        </div>

                        <div>

                            <span class="doctor-profile-label">
                                Médico
                            </span>

                            <h4 id="medico">
                                -
                            </h4>

                            <span
                                id="medicoEspecialidad"
                                class="doctor-specialty">
                            </span>

                        </div>

                    </div>

                </div>


                <hr class="detail-divider">


                <!-- PACIENTE -->

                <div class="detail-section">

                    <div class="detail-section-heading">

                        <div class="section-icon section-icon-info">

                            <i class="bi bi-person-vcard"></i>

                        </div>

                        <div>

                            <h3>
                                Información del paciente
                            </h3>

                            <p>
                                Datos asociados a la cita.
                            </p>

                        </div>

                    </div>


                    <div class="row g-3">


                        <div class="col-12 col-md-6">

                            <div class="detail-item">

                                <div class="detail-item-icon">

                                    <i class="bi bi-person"></i>

                                </div>

                                <div>

                                    <span>
                                        Paciente
                                    </span>

                                    <strong id="pacienteNombre">
                                        -
                                    </strong>

                                </div>

                            </div>

                        </div>


                        <div class="col-12 col-md-6">

                            <div class="detail-item">

                                <div class="detail-item-icon">

                                    <i class="bi bi-card-text"></i>

                                </div>

                                <div>

                                    <span>
                                        Documento
                                    </span>

                                    <strong id="pacienteDocumento">
                                        -
                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <hr class="detail-divider">


                <!-- MOTIVO -->

                <div class="detail-section">

                    <div class="detail-section-heading">

                        <div class="section-icon section-icon-warning">

                            <i class="bi bi-chat-left-text"></i>

                        </div>

                        <div>

                            <h3>
                                Motivo de consulta
                            </h3>

                            <p>
                                Información proporcionada al programar la cita.
                            </p>

                        </div>

                    </div>


                    <div
                        id="motivo"
                        class="text-content-box">
                    </div>

                </div>


                <!-- OBSERVACIONES -->

                <div
                    id="contenedorObservaciones"
                    class="detail-section d-none">

                    <hr class="detail-divider">

                    <div class="detail-section-heading">

                        <div class="section-icon section-icon-secondary">

                            <i class="bi bi-journal-text"></i>

                        </div>

                        <div>

                            <h3>
                                Observaciones
                            </h3>

                            <p>
                                Información adicional asociada a la cita.
                            </p>

                        </div>

                    </div>


                    <div
                        id="observaciones"
                        class="text-content-box">
                    </div>

                </div>


                <!-- ACCIONES -->

                <div
                    id="acciones"
                    class="detail-actions">
                </div>

            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     MODAL CANCELAR
====================================================== -->

<div
    class="modal fade"
    id="modalCancelar"
    tabindex="-1"
    aria-labelledby="modalCancelarLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content cancellation-modal">

            <div class="modal-header">

                <div class="d-flex align-items-center gap-3">

                    <div class="modal-warning-icon">

                        <i class="bi bi-calendar-x"></i>

                    </div>

                    <div>

                        <h5
                            class="modal-title mb-0"
                            id="modalCancelarLabel">

                            Cancelar cita

                        </h5>

                    </div>

                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <div class="modal-body">

                <p>
                    ¿Estás seguro de que deseas cancelar esta cita?
                </p>

                <div class="modal-info-box">

                    <i class="bi bi-info-circle me-2"></i>

                    La cita quedará registrada como
                    <strong>cancelada</strong>.

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal">

                    Conservar cita

                </button>

                <button
                    type="button"
                    class="btn btn-danger btn-icon"
                    id="btnConfirmarCancelacion">

                    <i class="bi bi-calendar-x"></i>

                    Cancelar cita

                </button>

            </div>

        </div>

    </div>

</div>


<script src="<?= APP_URL ?>/js/api.js"></script>


<script>

let citaSeleccionada = null;

let modalCancelacion = null;


/* =====================================================
   INICIO
====================================================== */

document.addEventListener(
    'DOMContentLoaded',
    async function () {

        const btnReintentar =
            document.getElementById(
                'btnReintentar'
            );


        if (btnReintentar) {

            btnReintentar.addEventListener(
                'click',
                cargarDetalle
            );

        }


        const btnCancelar =
            document.getElementById(
                'btnConfirmarCancelacion'
            );


        if (btnCancelar) {

            btnCancelar.addEventListener(
                'click',
                confirmarCancelacion
            );

        }


        await cargarDetalle();

    }
);


/* =====================================================
   CARGAR DETALLE
====================================================== */

async function cargarDetalle() {

    const params =
        new URLSearchParams(
            window.location.search
        );


    const citaId =
        params.get('id');


    const estadoCarga =
        document.getElementById(
            'estadoCarga'
        );

    const error =
        document.getElementById(
            'errorDetalle'
        );

    const mensajeError =
        document.getElementById(
            'mensajeError'
        );

    const detalle =
        document.getElementById(
            'detalleCita'
        );


    estadoCarga.classList.remove(
        'd-none'
    );

    error.classList.add(
        'd-none'
    );

    detalle.classList.add(
        'd-none'
    );


    if (!citaId || !/^\d+$/.test(citaId)) {

        estadoCarga.classList.add(
            'd-none'
        );

        error.classList.remove(
            'd-none'
        );

        mensajeError.textContent =
            'No se recibió un identificador de cita válido.';

        return;

    }


    try {

        const respuesta =
            await CitaSaludAPI.getDetalleCita(
                citaId
            );


        if (
            !respuesta.success ||
            !respuesta.data
        ) {

            throw new Error(
                'La respuesta de la API no tiene el formato esperado.'
            );

        }


        const cita =
            respuesta.data;


        estadoCarga.classList.add(
            'd-none'
        );

        detalle.classList.remove(
            'd-none'
        );


        mostrarInformacion(
            cita
        );


    } catch (exception) {

        console.error(
            'Error consultando detalle:',
            exception
        );


        estadoCarga.classList.add(
            'd-none'
        );


        error.classList.remove(
            'd-none'
        );


        mensajeError.textContent =
            exception.message ||
            'Ocurrió un error inesperado.';

    }

}


/* =====================================================
   MOSTRAR INFORMACIÓN
====================================================== */

function mostrarInformacion(
    cita
) {

    const nombrePaciente =
        (
            cita.paciente_nombre || ''
        ) +
        ' ' +
        (
            cita.paciente_apellido || ''
        );


    const nombreMedico =
        (
            cita.medico_nombre || ''
        ) +
        ' ' +
        (
            cita.medico_apellido || ''
        );


    const fecha =
        formatearFecha(
            cita.fecha
        );


    const hora =
        formatearHora(
            cita.hora
        );


    document.getElementById(
        'pacienteNombre'
    ).textContent =
        nombrePaciente.trim() ||
        'No disponible';


    document.getElementById(
        'pacienteDocumento'
    ).textContent =
        cita.paciente_documento ||
        'No disponible';


    document.getElementById(
        'especialidad'
    ).textContent =
        cita.especialidad ||
        'No disponible';


    document.getElementById(
        'medico'
    ).textContent =
        nombreMedico.trim() ||
        'No disponible';


    document.getElementById(
        'fecha'
    ).textContent =
        fecha;


    document.getElementById(
        'hora'
    ).textContent =
        hora;


    document.getElementById(
        'heroEspecialidad'
    ).textContent =
        cita.especialidad ||
        'Cita médica';


    document.getElementById(
        'heroFecha'
    ).textContent =
        fecha;


    document.getElementById(
        'heroHora'
    ).textContent =
        hora;


    document.getElementById(
        'medicoEspecialidad'
    ).textContent =
        cita.especialidad ||
        '';


    document.getElementById(
        'motivo'
    ).textContent =
        cita.motivo ||
        'No se registró un motivo de consulta.';


    mostrarEstado(
        cita.estado
    );


    mostrarObservaciones(
        cita.observaciones
    );


    mostrarAcciones(
        cita
    );

}


/* =====================================================
   ESTADO
====================================================== */

function obtenerEstadoVisual(
    estado
) {

    const estados = {

        'PROGRAMADA': {
            texto: 'Programada',
            clase: 'status-programada',
            icono: 'bi-calendar-check'
        },

        'CONFIRMADA': {
            texto: 'Confirmada',
            clase: 'status-confirmada',
            icono: 'bi-check-circle'
        },

        'ATENDIDA': {
            texto: 'Atendida',
            clase: 'status-atendida',
            icono: 'bi-check-circle-fill'
        },

        'CANCELADA': {
            texto: 'Cancelada',
            clase: 'status-cancelada',
            icono: 'bi-x-circle'
        },

        'NO_ASISTIO': {
            texto: 'No asistió',
            clase: 'status-no-asistio',
            icono: 'bi-exclamation-circle'
        }

    };


    return estados[estado] || {

        texto: estado || 'Sin estado',

        clase: 'status-default',

        icono: 'bi-question-circle'

    };

}


function mostrarEstado(
    estado
) {

    const estadoVisual =
        obtenerEstadoVisual(
            estado
        );


    const contenido = `

        <span
            class="appointment-status ${estadoVisual.clase}">

            <i
                class="bi ${estadoVisual.icono} me-1">
            </i>

            ${estadoVisual.texto}

        </span>

    `;


    document.getElementById(
        'estado'
    ).innerHTML =
        contenido;


    document.getElementById(
        'heroEstado'
    ).innerHTML =
        contenido;

}


/* =====================================================
   OBSERVACIONES
====================================================== */

function mostrarObservaciones(
    observaciones
) {

    const contenedor =
        document.getElementById(
            'contenedorObservaciones'
        );


    const elemento =
        document.getElementById(
            'observaciones'
        );


    if (
        observaciones &&
        observaciones.trim() !== ''
    ) {

        elemento.textContent =
            observaciones;

        contenedor.classList.remove(
            'd-none'
        );

    } else {

        contenedor.classList.add(
            'd-none'
        );

    }

}


/* =====================================================
   ACCIONES
====================================================== */

function mostrarAcciones(
    cita
) {

    const acciones =
        document.getElementById(
            'acciones'
        );


    acciones.innerHTML = '';


    if (
        cita.estado !== 'PROGRAMADA' &&
        cita.estado !== 'CONFIRMADA'
    ) {

        return;

    }


    acciones.innerHTML = `

        <div class="action-panel">

            <div>

                <strong>
                    ¿Necesitas cancelar esta cita?
                </strong>

                <p>
                    Puedes cancelar la cita mientras se encuentre
                    programada o confirmada.
                </p>

            </div>


            <button
                type="button"
                class="btn btn-outline-danger btn-icon"
                onclick="abrirModalCancelacion(${cita.id})">

                <i class="bi bi-calendar-x"></i>

                Cancelar cita

            </button>

        </div>

    `;

}


/* =====================================================
   MODAL
====================================================== */

function abrirModalCancelacion(
    citaId
) {

    citaSeleccionada =
        citaId;


    const modalElement =
        document.getElementById(
            'modalCancelar'
        );


    modalCancelacion =
        bootstrap.Modal.getOrCreateInstance(
            modalElement
        );


    modalCancelacion.show();

}


/* =====================================================
   CONFIRMAR CANCELACIÓN
====================================================== */

function confirmarCancelacion() {

    if (!citaSeleccionada) {
        return;
    }


    const boton =
        document.getElementById(
            'btnConfirmarCancelacion'
        );


    boton.disabled = true;


    boton.innerHTML = `

        <span
            class="spinner-border spinner-border-sm"
            role="status">
        </span>

        Cancelando...

    `;


    const form =
        document.createElement(
            'form'
        );


    form.method =
        'POST';


    form.action =
        '<?= APP_URL ?>/citas/cancelar';


    const inputId =
        document.createElement(
            'input'
        );


    inputId.type =
        'hidden';

    inputId.name =
        'id';

    inputId.value =
        citaSeleccionada;


    const csrf =
        document.createElement(
            'input'
        );


    csrf.type =
        'hidden';

    csrf.name =
        'csrf_token';

    csrf.value =
        '<?= Security::csrfToken(); ?>';


    form.appendChild(
        inputId
    );

    form.appendChild(
        csrf
    );


    document.body.appendChild(
        form
    );


    form.submit();

}


/* =====================================================
   FECHA
====================================================== */

function formatearFecha(
    fecha
) {

    if (!fecha) {
        return '';
    }


    const partes =
        fecha.split('-');


    if (
        partes.length !== 3
    ) {

        return fecha;

    }


    return (

        partes[2] +
        '/' +
        partes[1] +
        '/' +
        partes[0]

    );

}


/* =====================================================
   HORA
====================================================== */

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


/* =====================================================
   XSS
====================================================== */

function escapeHtml(
    texto
) {

    const div =
        document.createElement(
            'div'
        );


    div.textContent =
        texto === null ||
        texto === undefined
            ? ''
            : texto;


    return div.innerHTML;

}

</script>


<style>

/* =====================================================
   HEADER
====================================================== */

.detail-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;

    gap: 20px;
}

.detail-title-icon {
    width: 48px;
    height: 48px;

    border-radius: 14px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #e7f1ff;
    color: #0d6efd;

    font-size: 24px;
}


/* =====================================================
   CARD
====================================================== */

.appointment-detail-card {
    border: 0;
    border-radius: 18px;

    overflow: hidden;
}


/* =====================================================
   LOADING
====================================================== */

.detail-loading {
    text-align: center;

    padding: 80px 20px;
}

.loading-icon {
    width: 58px;
    height: 58px;

    margin: 0 auto 18px;

    display: flex;
    align-items: center;
    justify-content: center;
}


/* =====================================================
   ERROR
====================================================== */

.detail-error {
    margin: 24px;

    border: 0;
    border-left: 4px solid #dc3545;

    border-radius: 12px;
}


/* =====================================================
   HERO
====================================================== */

.appointment-detail-hero {

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 20px;

    padding: 28px 32px;

    background:
        linear-gradient(
            135deg,
            #f5f9ff 0%,
            #eef6ff 100%
        );

    border-bottom: 1px solid #e3ebf5;

}

.hero-content {

    display: flex;

    align-items: center;

    gap: 16px;

}

.hero-date-icon {

    width: 64px;
    height: 64px;

    border-radius: 18px;

    background: #0d6efd;

    color: #fff;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 28px;

    box-shadow:
        0 8px 20px rgba(
            13,
            110,
            253,
            .18
        );

}

.hero-label {

    display: block;

    color: #6c757d;

    font-size: .76rem;

    text-transform: uppercase;

    font-weight: 650;

    letter-spacing: .04em;

    margin-bottom: 3px;

}

.hero-content h2 {

    margin: 0;

    font-size: 1.45rem;

    font-weight: 700;

}

.hero-date {

    display: flex;

    align-items: center;

    gap: 15px;

    margin-top: 6px;

    color: #495057;

    font-size: .88rem;

}

.hero-date span:first-child {

    color: #0d6efd;

    font-weight: 600;

}


/* =====================================================
   SECTION
====================================================== */

.detail-section {
    margin-bottom: 10px;
}

.detail-section-heading {

    display: flex;

    align-items: center;

    gap: 12px;

    margin-bottom: 20px;

}

.detail-section-heading h3 {

    margin: 0 0 3px;

    font-size: 1.05rem;

    font-weight: 650;

}

.detail-section-heading p {

    margin: 0;

    color: #6c757d;

    font-size: .82rem;

}

.section-icon {

    width: 44px;
    height: 44px;

    border-radius: 12px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;

    font-size: 19px;

}

.section-icon-primary {

    background: #e7f1ff;

    color: #0d6efd;

}

.section-icon-success {

    background: #e8f7ef;

    color: #198754;

}

.section-icon-info {

    background: #e8f6fa;

    color: #087990;

}

.section-icon-warning {

    background: #fff3cd;

    color: #997404;

}

.section-icon-secondary {

    background: #f1f3f5;

    color: #495057;

}


/* =====================================================
   DETAIL ITEM
====================================================== */

.detail-item {

    display: flex;

    align-items: center;

    gap: 13px;

    min-height: 72px;

    padding: 14px;

    border: 1px solid #edf0f2;

    border-radius: 12px;

    background: #fff;

}

.detail-item-icon {

    width: 40px;
    height: 40px;

    border-radius: 10px;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #f1f6fd;

    color: #0d6efd;

    flex-shrink: 0;

}

.detail-item span {

    display: block;

    color: #6c757d;

    font-size: .74rem;

    font-weight: 600;

    text-transform: uppercase;

    letter-spacing: .02em;

    margin-bottom: 3px;

}

.detail-item strong {

    display: block;

    color: #212529;

    font-size: .92rem;

    word-break: break-word;

}


/* =====================================================
   DOCTOR
====================================================== */

.doctor-profile {

    display: flex;

    align-items: center;

    gap: 16px;

    padding: 20px;

    border-radius: 14px;

    background: #f8fbf9;

    border: 1px solid #e4f0e8;

}

.doctor-profile-avatar {

    width: 58px;
    height: 58px;

    border-radius: 16px;

    background: #dff3e8;

    color: #198754;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 25px;

    flex-shrink: 0;

}

.doctor-profile-label {

    display: block;

    font-size: .73rem;

    color: #6c757d;

    text-transform: uppercase;

    font-weight: 600;

    margin-bottom: 2px;

}

.doctor-profile h4 {

    margin: 0;

    font-size: 1rem;

    font-weight: 650;

}

.doctor-specialty {

    display: block;

    margin-top: 3px;

    color: #198754;

    font-size: .82rem;

}


/* =====================================================
   TEXT
====================================================== */

.text-content-box {

    padding: 16px 18px;

    border-radius: 12px;

    background: #f8f9fa;

    border: 1px solid #edf0f2;

    color: #495057;

    line-height: 1.6;

    min-height: 55px;

}


/* =====================================================
   DIVIDER
====================================================== */

.detail-divider {

    margin: 30px 0;

    border-color: #edf0f2;

    opacity: 1;

}


/* =====================================================
   STATUS
====================================================== */

.appointment-status {

    display: inline-flex;

    align-items: center;

    padding: 7px 11px;

    border-radius: 8px;

    font-size: .76rem;

    font-weight: 650;

}

.status-programada {

    background: #e7f1ff;

    color: #0a58ca;

}

.status-confirmada {

    background: #d1e7dd;

    color: #146c43;

}

.status-atendida {

    background: #d1e7dd;

    color: #146c43;

}

.status-cancelada {

    background: #f8d7da;

    color: #b02a37;

}

.status-no-asistio {

    background: #fff3cd;

    color: #997404;

}

.status-default {

    background: #e9ecef;

    color: #495057;

}


/* =====================================================
   ACTIONS
====================================================== */

.detail-actions {

    margin-top: 30px;

}

.action-panel {

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 20px;

    padding: 18px 20px;

    border-radius: 14px;

    background: #fff8f8;

    border: 1px solid #f5d6d9;

}

.action-panel strong {

    display: block;

    color: #842029;

    font-size: .92rem;

}

.action-panel p {

    margin: 3px 0 0;

    color: #6c757d;

    font-size: .8rem;

}


/* =====================================================
   MODAL
====================================================== */

.cancellation-modal {

    border: 0;

    border-radius: 16px;

    overflow: hidden;

}

.modal-warning-icon {

    width: 42px;
    height: 42px;

    border-radius: 12px;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #fff3cd;

    color: #997404;

    font-size: 19px;

}

.modal-info-box {

    padding: 12px 14px;

    margin-top: 15px;

    border-radius: 10px;

    background: #f8f9fa;

    color: #6c757d;

    font-size: .86rem;

}


/* =====================================================
   RESPONSIVE
====================================================== */

@media (max-width: 767.98px) {

    .detail-header {

        flex-direction: column;

        align-items: stretch;

    }

    .detail-header .btn {

        width: 100%;

    }

    .appointment-detail-hero {

        flex-direction: column;

        align-items: flex-start;

        padding: 22px;

    }

    .hero-date {

        flex-direction: column;

        align-items: flex-start;

        gap: 4px;

    }

    .action-panel {

        flex-direction: column;

        align-items: stretch;

    }

    .action-panel .btn {

        width: 100%;

    }

}

@media (max-width: 575.98px) {

    .appointment-detail-hero {

        padding: 18px;

    }

    .hero-date-icon {

        width: 54px;
        height: 54px;

        font-size: 23px;

    }

    .hero-content h2 {

        font-size: 1.2rem;

    }

    .appointment-detail-card
    .p-4 {

        padding: 18px !important;

    }

    .detail-section-heading h3 {

        font-size: .98rem;

    }

    .doctor-profile {

        padding: 15px;

    }

}

</style>