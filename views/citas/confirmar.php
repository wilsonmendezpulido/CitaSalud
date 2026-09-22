<?php
require BASE_PATH . '/views/layouts/main.php';
?>

<div class="container main-container confirmacion-page">

    <!-- =====================================================
     ENCABEZADO - PASO 4
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

                    Revise la información de su cita antes de confirmar la programación.

                </p>


                <!-- Paso actual -->

                <div class="d-flex flex-wrap align-items-center gap-2">

                    <span class="badge bg-primary rounded-pill px-3 py-2">

                        <i class="bi bi-4-circle me-1"></i>

                        Paso 4 de 4

                    </span>


                    <span class="text-muted small">

                        Confirmación de la cita

                    </span>

                </div>

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

                        <div class="step-circle completed">

                            <i class="bi bi-check-lg"></i>

                        </div>

                        <div>

                            <div class="fw-semibold">
                                Fecha y hora
                            </div>

                            <small class="text-success">
                                Completado
                            </small>

                        </div>

                    </div>

                </div>


                <!-- Paso 4 -->

                <div class="col-12 col-md-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="step-circle active">

                            <i class="bi bi-check2-circle"></i>

                        </div>

                        <div>

                            <div class="fw-semibold text-primary">
                                Confirmación
                            </div>

                            <small class="text-primary">
                                Paso actual
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         RESUMEN DE LA CITA
         ========================================================= -->

    <div class="card border-0 shadow-sm citasalud-card mb-4">

        <div class="card-body p-4">

            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">

                <div>

                    <span class="section-kicker">
                        Paso 4
                    </span>

                    <h2 class="h4 mb-1">
                        Confirme su cita médica
                    </h2>

                    <p class="text-muted mb-0">
                        Verifique que la información sea correcta antes de reservar el horario.
                    </p>

                </div>

                <span class="badge bg-success">
                    <i class="bi bi-shield-check me-1"></i>
                    Validación REST
                </span>

            </div>


            <!-- Estado de validación -->

            <div
                id="estadoValidacion"
                class="alert alert-info"
                role="status">

                <div class="d-flex align-items-center">

                    <div
                        class="spinner-border spinner-border-sm me-2"
                        role="status">
                    </div>

                    Verificando disponibilidad de la cita...

                </div>

            </div>


            <!-- Error -->

            <div
                id="errorValidacion"
                class="alert alert-danger d-none"
                role="alert">
            </div>


            <!-- Información de la cita -->

            <div id="informacionCita">

                <div class="appointment-summary-grid">

                    <div class="appointment-summary-item">

                        <div class="summary-item-icon">
                            <i class="bi bi-person-badge"></i>
                        </div>

                        <div>
                            <span class="summary-item-label">
                                Profesional
                            </span>

                            <strong id="medicoNombre">
                                <?php
                                echo htmlspecialchars(
                                    $detalle['medico_nombre'] .
                                    ' ' .
                                    $detalle['medico_apellido']
                                );
                                ?>
                            </strong>
                        </div>

                    </div>


                    <div class="appointment-summary-item">

                        <div class="summary-item-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </div>

                        <div>
                            <span class="summary-item-label">
                                Especialidad
                            </span>

                            <strong id="especialidadNombre">
                                <?php
                                echo htmlspecialchars(
                                    $detalle['especialidad']
                                );
                                ?>
                            </strong>
                        </div>

                    </div>


                    <div class="appointment-summary-item">

                        <div class="summary-item-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>

                        <div>
                            <span class="summary-item-label">
                                Fecha
                            </span>

                            <strong>
                                <?php
                                echo date(
                                    'd/m/Y',
                                    strtotime(
                                        $detalle['fecha']
                                    )
                                );
                                ?>
                            </strong>
                        </div>

                    </div>


                    <div class="appointment-summary-item">

                        <div class="summary-item-icon">
                            <i class="bi bi-clock"></i>
                        </div>

                        <div>
                            <span class="summary-item-label">
                                Horario
                            </span>

                            <strong>
                                <?php
                                echo date(
                                    'H:i',
                                    strtotime(
                                        $detalle['hora_inicio']
                                    )
                                );

                                echo ' - ';

                                echo date(
                                    'H:i',
                                    strtotime(
                                        $detalle['hora_fin']
                                    )
                                );
                                ?>
                            </strong>
                        </div>

                    </div>

                </div>


                <div class="confirmation-notice mt-4">

                    <div class="confirmation-notice-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>

                    <div>
                        <strong>Antes de confirmar</strong>

                        <p class="mb-0">
                            Una vez confirmada la cita, este horario será reservado para usted.
                            Verifique que la fecha, hora y profesional seleccionados sean correctos.
                        </p>
                    </div>

                </div>


                <hr class="my-4">


                <!-- =================================================
                     FORMULARIO
                     ================================================= -->

                <form
                    method="POST"
                    action="<?php echo APP_URL; ?>/citas/store"
                    id="formConfirmarCita">

                    <?php echo Security::csrfField(); ?>


                    <input
                        type="hidden"
                        name="disponibilidad_id"
                        value="<?php echo (int)$detalle['disponibilidad_id']; ?>">


                    <div class="mb-4">

                        <label
                            for="motivo"
                            class="form-label fw-semibold">

                            Motivo de consulta
                            <span class="text-danger">*</span>

                        </label>

                        <textarea
                            id="motivo"
                            name="motivo"
                            class="form-control"
                            rows="4"
                            maxlength="500"
                            required
                            placeholder="Describa brevemente el motivo de su consulta..."></textarea>

                        <div class="d-flex justify-content-between mt-1">

                            <div class="form-text">
                                Esta información ayudará al profesional a conocer el motivo de su consulta.
                            </div>

                            <div class="form-text">
                                <span id="contadorMotivo">0</span>/500
                            </div>

                        </div>

                    </div>


                    <div class="d-flex flex-wrap justify-content-between gap-2">

                        <a
                            href="<?php echo APP_URL; ?>/citas/disponibilidad?medico_id=<?php echo (int)$detalle['medico_id']; ?>&fecha=<?php echo urlencode($detalle['fecha']); ?>"
                            class="btn btn-outline-secondary">

                            <i class="bi bi-arrow-left me-1"></i>
                            Regresar

                        </a>


                        <button
                            type="submit"
                            id="btnConfirmar"
                            class="btn btn-primary px-4"
                            disabled>

                            <i class="bi bi-check-circle me-1"></i>
                            Confirmar cita

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<style>

.confirmacion-page {
    padding-top: 1rem;
    padding-bottom: 3rem;
}

.appointment-progress {
    display: flex;
    align-items: center;
    width: 100%;
    overflow-x: auto;
    padding-bottom: .25rem;
}

.progress-step {
    display: flex;
    align-items: center;
    gap: .65rem;
    min-width: 150px;
    flex-shrink: 0;
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
    flex-shrink: 0;
}

.progress-step-content {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
}

.progress-step-content strong {
    font-size: .9rem;
    color: #334155;
}

.progress-step-content small {
    color: #94a3b8;
    margin-top: .2rem;
}

.progress-step.completed .progress-step-circle {
    background: #198754;
    border-color: #198754;
    color: #fff;
}

.progress-step.completed .progress-step-content small {
    color: #198754;
}

.progress-step.active .progress-step-circle {
    background: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
    box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .12);
}

.progress-step.active .progress-step-content strong,
.progress-step.active .progress-step-content small {
    color: #0d6efd;
}

.progress-line {
    height: 2px;
    background: #e2e8f0;
    flex: 1;
    min-width: 35px;
    margin: 0 .75rem;
}

.progress-line.completed,
.progress-line.active {
    background: #0d6efd;
}

.appointment-summary-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
}

.appointment-summary-item {
    display: flex;
    align-items: center;
    gap: .85rem;
    min-height: 82px;
    padding: 1rem;
    border: 1px solid #e2e8f0;
    border-radius: .9rem;
    background: #fff;
}

.summary-item-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e7f1ff;
    color: #0d6efd;
    font-size: 1.15rem;
    flex-shrink: 0;
}

.summary-item-label {
    display: block;
    font-size: .75rem;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: .04em;
    margin-bottom: .2rem;
}

.appointment-summary-item strong {
    display: block;
    color: #1e293b;
    font-size: .98rem;
}

.confirmation-notice {
    display: flex;
    align-items: flex-start;
    gap: .85rem;
    padding: 1rem 1.1rem;
    border-radius: .85rem;
    background: #f0f7ff;
    border: 1px solid #cfe2ff;
}

.confirmation-notice-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e7f1ff;
    color: #0d6efd;
    flex-shrink: 0;
}

.confirmation-notice strong {
    display: block;
    color: #1e293b;
    margin-bottom: .2rem;
}

.confirmation-notice p {
    color: #64748b;
    font-size: .9rem;
}

#estadoValidacion {
    border-radius: .85rem;
}

@media (max-width: 767.98px) {

    .appointment-progress {
        align-items: flex-start;
    }

    .progress-step {
        min-width: 125px;
    }

    .progress-step-content {
        display: none;
    }

    .appointment-summary-grid {
        grid-template-columns: 1fr;
    }

}

@media (prefers-reduced-motion: reduce) {

    .progress-step-circle,
    .progress-line {
        transition: none;
    }

}

</style>

<script>

document.addEventListener(
    'DOMContentLoaded',
    async function () {

        const estado =
            document.getElementById(
                'estadoValidacion'
            );

        const error =
            document.getElementById(
                'errorValidacion'
            );

        const boton =
            document.getElementById(
                'btnConfirmar'
            );


        /*
         * Datos provenientes de PHP
         */

        const medicoId =
            <?php echo (int)$detalle['medico_id']; ?>;

        const fecha =
            '<?php echo htmlspecialchars(
                $detalle['fecha'],
                ENT_QUOTES,
                'UTF-8'
            ); ?>';


        try {

            console.log(
                'Validando disponibilidad mediante API REST...'
            );

            console.log(
                'Médico:',
                medicoId
            );

            console.log(
                'Fecha:',
                fecha
            );


            /*
             * Consultar disponibilidad
             */

            const respuesta =
                await CitaSaludAPI.getDisponibilidad(
                    medicoId,
                    fecha
                );


            console.log(
                'Disponibilidad API:',
                respuesta
            );


            if (
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
             * Buscar el horario seleccionado
             */

            const disponibilidadId =
                <?php echo (int)$detalle['disponibilidad_id']; ?>;


            const horario =
                respuesta.data.find(
                    function (item) {

                        return String(item.id) ===
                            String(disponibilidadId);

                    }
                );


            /*
             * Si el horario ya no aparece
             * en la API, ya no está disponible.
             */

            if (!horario) {

                throw new Error(
                    'El horario seleccionado ya no se encuentra disponible.'
                );

            }


            /*
             * Disponibilidad confirmada
             */

            estado.classList.remove(
                'alert-info'
            );

            estado.classList.add(
                'alert-success'
            );


            estado.innerHTML = `
                <strong>✓ Disponibilidad confirmada.</strong>
                El horario seleccionado está disponible.
            `;


            /*
             * Habilitar botón
             */

            boton.disabled = false;


        } catch (exception) {

            console.error(
                'Error validando disponibilidad:',
                exception
            );


            estado.classList.add(
                'd-none'
            );


            error.classList.remove(
                'd-none'
            );


            error.innerHTML = `
                <strong>
                    No es posible confirmar esta cita.
                </strong>
                <br>
                ${escapeHtml(
                    exception.message
                )}
            `;


            /*
             * Evitar que se confirme
             * un horario no disponible.
             */

            boton.disabled = true;

        }

    }
);


/*
 * Protección de contenido HTML
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
        texto === undefined
            ? ''
            : texto;


    return div.innerHTML;

}

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const motivo = document.getElementById('motivo');
    const contador = document.getElementById('contadorMotivo');
    const formulario = document.getElementById('formConfirmarCita');
    const boton = document.getElementById('btnConfirmar');

    if (motivo && contador) {

        const actualizarContador = function () {
            contador.textContent = motivo.value.length;
        };

        motivo.addEventListener('input', actualizarContador);
        actualizarContador();

    }

    if (formulario && boton) {

        formulario.addEventListener('submit', function () {

            if (formulario.checkValidity()) {

                boton.disabled = true;

                boton.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>' +
                    ' Confirmando cita...';

            }

        });

    }

});
</script>
