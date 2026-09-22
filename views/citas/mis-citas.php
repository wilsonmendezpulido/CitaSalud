<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container main-container">

    <!-- HEADER -->
    <div class="appointments-header mb-4">

        <div>

            <div class="d-flex align-items-center gap-2 mb-2">

                <div class="appointments-title-icon">
                    <i class="bi bi-calendar2-heart"></i>
                </div>

                <h1 class="page-title mb-0">
                    Mis citas
                </h1>

            </div>

            <p class="page-subtitle">
                Consulta tus próximas citas y el historial de atención.
            </p>

        </div>


        <a
            href="<?= APP_URL ?>/citas/create"
            class="btn btn-primary btn-icon">

            <i class="bi bi-calendar-plus"></i>

            Programar cita

        </a>

    </div>


    <!-- MENSAJE DE CANCELACIÓN -->
    <?php if (
        isset($_GET['success']) &&
        $_GET['success'] === 'cancelled'
    ): ?>

        <div
            class="alert alert-success alert-dismissible fade show shadow-sm appointment-alert"
            role="alert">

            <div class="d-flex align-items-center gap-3">

                <div class="alert-icon">
                    <i class="bi bi-check-lg"></i>
                </div>

                <div>

                    <strong>Cita cancelada</strong>

                    <div class="small">
                        La cita fue cancelada correctamente.
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


    <!-- ==========================
         PRÓXIMAS CITAS
    =========================== -->

    <section class="appointments-section mb-4">

        <div class="section-heading">

            <div class="section-heading-content">

                <div class="section-icon section-icon-primary">
                    <i class="bi bi-calendar-check"></i>
                </div>

                <div>

                    <h2 class="section-title">
                        Próximas citas
                    </h2>

                    <p class="section-description">
                        Tus citas médicas programadas.
                    </p>

                </div>

            </div>


            <span class="api-badge">

                <i class="bi bi-cloud-check"></i>

                API REST

            </span>

        </div>


        <div class="card appointments-card shadow-sm">

            <div class="card-body p-4">


                <!-- LOADING -->

                <div
                    id="estadoProximas"
                    class="loading-state">

                    <div class="loading-spinner">

                        <div
                            class="spinner-border text-primary"
                            role="status">

                            <span class="visually-hidden">
                                Cargando...
                            </span>

                        </div>

                    </div>

                    <h6 class="mt-3 mb-1">
                        Consultando tus citas
                    </h6>

                    <p class="text-muted mb-0">
                        Estamos obteniendo la información más reciente.
                    </p>

                </div>


                <!-- ERROR -->

                <div
                    id="errorCitas"
                    class="alert alert-danger d-none"
                    role="alert">

                    <div class="d-flex align-items-start gap-3">

                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>

                        <div class="flex-grow-1">

                            <strong>
                                No fue posible cargar tus citas.
                            </strong>

                            <div
                                id="mensajeError"
                                class="small mt-1">
                            </div>

                            <button
                                type="button"
                                id="btnReintentar"
                                class="btn btn-sm btn-outline-danger mt-3 btn-icon">

                                <i class="bi bi-arrow-clockwise"></i>

                                Reintentar

                            </button>

                        </div>

                    </div>

                </div>


                <!-- CONTENEDOR -->

                <div
                    id="contenedorProximas"
                    class="row g-4 d-none">
                </div>


                <!-- SIN CITAS -->

                <div
                    id="sinProximas"
                    class="empty-state d-none">

                    <div class="empty-state-icon">

                        <i class="bi bi-calendar-x"></i>

                    </div>

                    <h5>
                        No tienes citas próximas
                    </h5>

                    <p>
                        Actualmente no tienes citas médicas programadas.
                    </p>

                    <a
                        href="<?= APP_URL ?>/citas/create"
                        class="btn btn-primary btn-icon">

                        <i class="bi bi-calendar-plus"></i>

                        Programar una cita

                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- ==========================
         HISTORIAL
    =========================== -->

    <section class="appointments-section">

        <div class="section-heading">

            <div class="section-heading-content">

                <div class="section-icon section-icon-success">

                    <i class="bi bi-clock-history"></i>

                </div>

                <div>

                    <h2 class="section-title">
                        Historial de citas
                    </h2>

                    <p class="section-description">
                        Consulta las citas que ya finalizaron.
                    </p>

                </div>

            </div>

        </div>


        <div class="card appointments-card shadow-sm">

            <div class="card-body p-0">


                <!-- SIN HISTORIAL -->

                <div
                    id="sinHistorial"
                    class="empty-state d-none">

                    <div class="empty-state-icon">

                        <i class="bi bi-clock-history"></i>

                    </div>

                    <h5>
                        No hay historial
                    </h5>

                    <p>
                        Todavía no tienes citas registradas en tu historial.
                    </p>

                </div>


                <!-- TABLA -->

                <div
                    id="contenedorHistorial"
                    class="table-responsive d-none">

                    <table
                        class="table appointment-table mb-0">

                        <thead>

                            <tr>

                                <th>
                                    Fecha
                                </th>

                                <th>
                                    Especialidad
                                </th>

                                <th>
                                    Médico
                                </th>

                                <th>
                                    Estado
                                </th>

                                <th class="text-end">
                                    Acción
                                </th>

                            </tr>

                        </thead>

                        <tbody id="tablaHistorial">
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>


<!-- ==========================
     MODAL CANCELACIÓN
=========================== -->

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
                    data-bs-dismiss="modal"
                    aria-label="Cerrar">
                </button>

            </div>


            <div class="modal-body">

                <p class="mb-2">

                    ¿Estás seguro de que deseas cancelar esta cita?

                </p>

                <div class="modal-info-box">

                    <i class="bi bi-info-circle me-2"></i>

                    Esta acción cambiará el estado de la cita a
                    <strong>cancelada</strong>.

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal">

                    No, conservar

                </button>

                <button
                    type="button"
                    class="btn btn-danger btn-icon"
                    id="btnConfirmarCancelacion">

                    <i class="bi bi-x-circle"></i>

                    Sí, cancelar cita

                </button>

            </div>

        </div>

    </div>

</div>


<script src="<?= APP_URL ?>/js/api.js"></script>


<script>

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
                cargarMisCitas
            );

        }

        await cargarMisCitas();

    }
);


/* =========================================================
   CARGAR CITAS
========================================================= */

async function cargarMisCitas() {

    const estado =
        document.getElementById(
            'estadoProximas'
        );

    const error =
        document.getElementById(
            'errorCitas'
        );

    const mensajeError =
        document.getElementById(
            'mensajeError'
        );

    const contenedor =
        document.getElementById(
            'contenedorProximas'
        );

    const sinProximas =
        document.getElementById(
            'sinProximas'
        );


    estado.classList.remove('d-none');

    error.classList.add('d-none');

    contenedor.classList.add('d-none');

    sinProximas.classList.add('d-none');


    try {

        const respuesta =
            await CitaSaludAPI.getCitas();


        if (
            !respuesta.success ||
            !respuesta.data
        ) {

            throw new Error(
                'La respuesta de la API no tiene el formato esperado.'
            );

        }


        const proximas =
            Array.isArray(
                respuesta.data.proximas
            )
                ? respuesta.data.proximas
                : [];


        const historial =
            Array.isArray(
                respuesta.data.historial
            )
                ? respuesta.data.historial
                : [];


        estado.classList.add('d-none');


        if (proximas.length === 0) {

            sinProximas.classList.remove(
                'd-none'
            );

        } else {

            contenedor.classList.remove(
                'd-none'
            );

            renderizarProximas(
                proximas
            );

        }


        renderizarHistorial(
            historial
        );


    } catch (exception) {

        console.error(
            'Error cargando citas:',
            exception
        );


        estado.classList.add(
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


/* =========================================================
   PRÓXIMAS CITAS
========================================================= */

function renderizarProximas(
    citas
) {

    const contenedor =
        document.getElementById(
            'contenedorProximas'
        );


    contenedor.innerHTML = '';


    citas.forEach(
        function (cita) {

            const columna =
                document.createElement(
                    'div'
                );


            columna.className =
                'col-12 col-lg-6';


            const estado =
                obtenerEstadoVisual(
                    cita.estado
                );


            columna.innerHTML = `

                <article
                    class="appointment-card">

                    <div
                        class="appointment-card-top">

                        <div class="appointment-date">

                            <div class="appointment-date-icon">

                                <i class="bi bi-calendar3"></i>

                            </div>

                            <div>

                                <span class="appointment-date-label">
                                    Fecha y hora
                                </span>

                                <strong>
                                    ${formatearFecha(
                                        cita.fecha
                                    )}
                                </strong>

                                <span class="appointment-time">
                                    <i class="bi bi-clock me-1"></i>
                                    ${formatearHora(
                                        cita.hora
                                    )}
                                </span>

                            </div>

                        </div>


                        <span
                            class="appointment-status ${estado.clase}">

                            <i class="bi ${estado.icono} me-1"></i>

                            ${estado.texto}

                        </span>

                    </div>


                    <div
                        class="appointment-card-body">

                        <div class="doctor-info">

                            <div class="doctor-avatar">

                                <i class="bi bi-person-badge"></i>

                            </div>

                            <div>

                                <span class="doctor-label">
                                    Médico
                                </span>

                                <strong>

                                    ${escapeHtml(
                                        cita.medico_nombre +
                                        ' ' +
                                        cita.medico_apellido
                                    )}

                                </strong>

                            </div>

                        </div>


                        <div class="specialty-info">

                            <i class="bi bi-heart-pulse"></i>

                            <span>

                                ${escapeHtml(
                                    cita.especialidad
                                )}

                            </span>

                        </div>


                        ${
                            cita.motivo
                                ? `

                                    <div class="appointment-reason">

                                        <span>
                                            <i class="bi bi-chat-left-text me-1"></i>
                                            Motivo
                                        </span>

                                        <p>
                                            ${escapeHtml(
                                                cita.motivo
                                            )}
                                        </p>

                                    </div>

                                  `
                                : ''
                        }


                    </div>


                    <div
                        class="appointment-card-footer">

                        <a
                            href="<?= APP_URL ?>/citas/detalle?id=${encodeURIComponent(cita.id)}"
                            class="btn btn-outline-primary btn-sm btn-icon">

                            <i class="bi bi-eye"></i>

                            Ver detalle

                        </a>


                        <button
                            type="button"
                            class="btn btn-outline-danger btn-sm btn-icon btn-cancelar"
                            data-id="${escapeHtml(cita.id)}">

                            <i class="bi bi-calendar-x"></i>

                            Cancelar

                        </button>

                    </div>

                </article>

            `;


            contenedor.appendChild(
                columna
            );

        }
    );


    document
        .querySelectorAll(
            '.btn-cancelar'
        )
        .forEach(
            function (boton) {

                boton.addEventListener(
                    'click',
                    function () {

                        abrirModalCancelacion(
                            this.dataset.id
                        );

                    }
                );

            }
        );

}


/* =========================================================
   HISTORIAL
========================================================= */

function renderizarHistorial(
    citas
) {

    const contenedor =
        document.getElementById(
            'contenedorHistorial'
        );

    const tabla =
        document.getElementById(
            'tablaHistorial'
        );

    const sinHistorial =
        document.getElementById(
            'sinHistorial'
        );


    tabla.innerHTML = '';


    if (
        !Array.isArray(citas) ||
        citas.length === 0
    ) {

        sinHistorial.classList.remove(
            'd-none'
        );

        contenedor.classList.add(
            'd-none'
        );

        return;

    }


    sinHistorial.classList.add(
        'd-none'
    );


    contenedor.classList.remove(
        'd-none'
    );


    citas.forEach(
        function (cita) {

            const estado =
                obtenerEstadoVisual(
                    cita.estado
                );


            const fila =
                document.createElement(
                    'tr'
                );


            fila.innerHTML = `

                <td>

                    <div class="history-date">

                        <i class="bi bi-calendar3"></i>

                        <span>
                            ${formatearFecha(
                                cita.fecha
                            )}
                        </span>

                    </div>

                </td>


                <td>

                    <span class="history-specialty">

                        <i class="bi bi-heart-pulse me-1"></i>

                        ${escapeHtml(
                            cita.especialidad
                        )}

                    </span>

                </td>


                <td>

                    <div class="history-doctor">

                        <div class="history-doctor-icon">

                            <i class="bi bi-person"></i>

                        </div>

                        <span>

                            ${escapeHtml(
                                cita.medico_nombre +
                                ' ' +
                                cita.medico_apellido
                            )}

                        </span>

                    </div>

                </td>


                <td>

                    <span
                        class="appointment-status ${estado.clase}">

                        <i class="bi ${estado.icono} me-1"></i>

                        ${estado.texto}

                    </span>

                </td>


                <td class="text-end">

                    <a
                        href="<?= APP_URL ?>/citas/detalle?id=${encodeURIComponent(cita.id)}"
                        class="btn btn-sm btn-outline-primary btn-icon">

                        <i class="bi bi-eye"></i>

                        Ver

                    </a>

                </td>

            `;


            tabla.appendChild(
                fila
            );

        }
    );

}


/* =========================================================
   MODAL CANCELACIÓN
========================================================= */

let citaSeleccionada = null;

let modalCancelacion = null;


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


document.addEventListener(
    'DOMContentLoaded',
    function () {

        const btn =
            document.getElementById(
                'btnConfirmarCancelacion'
            );


        if (!btn) {
            return;
        }


        btn.addEventListener(
            'click',
            function () {

                if (!citaSeleccionada) {
                    return;
                }


                cancelarCita(
                    citaSeleccionada
                );

            }
        );

    }
);


/* =========================================================
   CANCELAR
========================================================= */

function cancelarCita(
    citaId
) {

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


    const id =
        document.createElement(
            'input'
        );


    id.type =
        'hidden';

    id.name =
        'id';

    id.value =
        citaId;


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
        id
    );

    form.appendChild(
        csrf
    );


    document.body.appendChild(
        form
    );


    form.submit();

}


/* =========================================================
   ESTADOS
========================================================= */

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


/* =========================================================
   FECHA
========================================================= */

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


/* =========================================================
   HORA
========================================================= */

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


/* =========================================================
   XSS
========================================================= */

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

/* =========================================================
   HEADER
========================================================= */

.appointments-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 20px;
}

.appointments-title-icon {
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


/* =========================================================
   ALERT
========================================================= */

.appointment-alert {
    border: 0;
    border-left: 4px solid #198754;
    border-radius: 12px;
}

.alert-icon {
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


/* =========================================================
   SECTION
========================================================= */

.appointments-section {
    width: 100%;
}

.section-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    margin-bottom: 14px;
}

.section-heading-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 650;
    margin: 0 0 2px;
}

.section-description {
    margin: 0;
    color: #6c757d;
    font-size: .86rem;
}

.section-icon {
    width: 44px;
    height: 44px;

    border-radius: 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 20px;

    flex-shrink: 0;
}

.section-icon-primary {
    background: #e7f1ff;
    color: #0d6efd;
}

.section-icon-success {
    background: #e8f7ef;
    color: #198754;
}

.api-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;

    padding: 6px 10px;

    border-radius: 20px;

    background: #e8f7ef;
    color: #198754;

    font-size: .72rem;
    font-weight: 600;

    white-space: nowrap;
}


/* =========================================================
   CARD
========================================================= */

.appointments-card {
    border: 0;
    border-radius: 16px;
    overflow: hidden;
}


/* =========================================================
   LOADING
========================================================= */

.loading-state {
    text-align: center;
    padding: 45px 20px;
}

.loading-spinner {
    width: 48px;
    height: 48px;

    margin: auto;

    display: flex;
    align-items: center;
    justify-content: center;
}


/* =========================================================
   EMPTY
========================================================= */

.empty-state {
    text-align: center;
    padding: 50px 20px;
}

.empty-state-icon {
    width: 68px;
    height: 68px;

    margin: 0 auto 16px;

    border-radius: 18px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f1f3f5;
    color: #868e96;

    font-size: 30px;
}

.empty-state h5 {
    font-weight: 650;
}

.empty-state p {
    color: #6c757d;
    margin-bottom: 20px;
}


/* =========================================================
   APPOINTMENT CARD
========================================================= */

.appointment-card {
    height: 100%;

    background: #fff;

    border: 1px solid #e7ebef;

    border-radius: 16px;

    overflow: hidden;

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        border-color .2s ease;
}

.appointment-card:hover {
    transform: translateY(-3px);

    border-color: #d8e5f5;

    box-shadow:
        0 10px 28px rgba(0, 0, 0, .07);
}

.appointment-card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;

    gap: 15px;

    padding: 18px;

    background: #f8fbff;

    border-bottom: 1px solid #edf0f2;
}

.appointment-date {
    display: flex;
    align-items: center;
    gap: 12px;
}

.appointment-date-icon {
    width: 44px;
    height: 44px;

    border-radius: 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #e7f1ff;
    color: #0d6efd;

    font-size: 19px;
}

.appointment-date-label {
    display: block;

    font-size: .72rem;

    text-transform: uppercase;

    letter-spacing: .03em;

    color: #6c757d;

    font-weight: 600;

    margin-bottom: 2px;
}

.appointment-date strong {
    display: block;
    font-size: .98rem;
}

.appointment-time {
    display: block;

    color: #0d6efd;

    font-size: .85rem;

    margin-top: 2px;

    font-weight: 600;
}


/* =========================================================
   STATUS
========================================================= */

.appointment-status {
    display: inline-flex;
    align-items: center;

    padding: 6px 9px;

    border-radius: 8px;

    font-size: .74rem;

    font-weight: 600;

    white-space: nowrap;
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


/* =========================================================
   BODY
========================================================= */

.appointment-card-body {
    padding: 18px;
}

.doctor-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.doctor-avatar {
    width: 44px;
    height: 44px;

    border-radius: 50%;

    background: #eef2f7;
    color: #495057;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 19px;
}

.doctor-label {
    display: block;

    color: #6c757d;

    font-size: .72rem;

    text-transform: uppercase;

    font-weight: 600;

    margin-bottom: 2px;
}

.doctor-info strong {
    display: block;
    font-size: .95rem;
}

.specialty-info {
    display: flex;
    align-items: center;
    gap: 8px;

    margin-top: 15px;

    color: #0d6efd;

    font-size: .88rem;

    font-weight: 600;
}

.appointment-reason {
    margin-top: 15px;

    padding-top: 14px;

    border-top: 1px solid #edf0f2;
}

.appointment-reason span {
    color: #6c757d;
    font-size: .78rem;
    font-weight: 600;
}

.appointment-reason p {
    margin: 4px 0 0;

    color: #495057;

    font-size: .86rem;
}


/* =========================================================
   FOOTER
========================================================= */

.appointment-card-footer {
    display: flex;
    justify-content: flex-end;
    gap: 8px;

    padding: 14px 18px;

    border-top: 1px solid #edf0f2;
}


/* =========================================================
   HISTORIAL
========================================================= */

.appointment-table thead th {
    background: #f8f9fa;

    color: #495057;

    font-size: .78rem;

    text-transform: uppercase;

    letter-spacing: .02em;

    font-weight: 650;

    padding: 15px 18px;

    border-bottom: 1px solid #dee2e6;
}

.appointment-table tbody td {
    padding: 15px 18px;
}

.history-date {
    display: flex;
    align-items: center;
    gap: 8px;

    font-weight: 500;
}

.history-date i {
    color: #0d6efd;
}

.history-specialty {
    color: #495057;
}

.history-doctor {
    display: flex;
    align-items: center;
    gap: 8px;
}

.history-doctor-icon {
    width: 32px;
    height: 32px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f1f3f5;

    color: #6c757d;
}


/* =========================================================
   MODAL
========================================================= */

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


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 767.98px) {

    .appointments-header {
        align-items: stretch;
        flex-direction: column;
    }

    .appointments-header .btn {
        width: 100%;
    }

    .section-heading {
        align-items: flex-start;
    }

    .api-badge {
        display: none;
    }

    .appointment-card-top {
        flex-direction: column;
    }

    .appointment-card-footer {
        flex-direction: column;
    }

    .appointment-card-footer .btn {
        width: 100%;
    }

    .appointment-table {
        min-width: 700px;
    }

}

@media (max-width: 575.98px) {

    .appointment-card-body {
        padding: 15px;
    }

    .appointment-card-top {
        padding: 15px;
    }

    .appointment-card-footer {
        padding: 13px 15px;
    }

    .section-title {
        font-size: 1rem;
    }

    .section-description {
        font-size: .8rem;
    }

}

</style>