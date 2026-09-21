<?php

class Cita extends Model
{
    /**
     * Obtiene la información de una disponibilidad
     * junto con el médico y la especialidad.
     */
    public function getDisponibilidadDetalle($disponibilidadId)
    {
        $sql = "
            SELECT
                d.id AS disponibilidad_id,
                d.medico_id,
                d.fecha,
                d.hora_inicio,
                d.hora_fin,
                d.estado,

                m.nombre AS medico_nombre,
                m.apellido AS medico_apellido,

                e.id AS especialidad_id,
                e.nombre AS especialidad

            FROM disponibilidad d

            INNER JOIN medicos m
                ON m.id = d.medico_id

            INNER JOIN especialidades e
                ON e.id = m.especialidad_id

            WHERE d.id = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':id',
            $disponibilidadId,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Registra una cita y reserva el horario.
     *
     * Se utiliza una transacción para garantizar
     * que ambas operaciones se realicen correctamente.
     */
    public function registrar(
        $pacienteId,
        $medicoId,
        $disponibilidadId,
        $fecha,
        $hora,
        $motivo
    ) {
        try {

            $this->db->beginTransaction();

            /*
             * Bloqueamos el registro de disponibilidad
             * para evitar doble reserva.
             */
            $sqlDisponibilidad = "
                SELECT
                    id,
                    estado
                FROM disponibilidad
                WHERE id = :id
                FOR UPDATE
            ";

            $stmtDisponibilidad =
                $this->db->prepare($sqlDisponibilidad);

            $stmtDisponibilidad->bindValue(
                ':id',
                $disponibilidadId,
                PDO::PARAM_INT
            );

            $stmtDisponibilidad->execute();

            $disponibilidad =
                $stmtDisponibilidad->fetch();

            if (!$disponibilidad) {

                throw new Exception(
                    'El horario seleccionado no existe.'
                );
            }

            if ($disponibilidad['estado'] !== 'DISPONIBLE') {

                throw new Exception(
                    'El horario seleccionado ya no está disponible.'
                );
            }


            /*
             * Crear la cita.
             */
            $sqlCita = "
                INSERT INTO citas (
                    paciente_id,
                    medico_id,
                    disponibilidad_id,
                    fecha,
                    hora,
                    motivo,
                    estado,
                    created_at,
                    updated_at
                )
                VALUES (
                    :paciente_id,
                    :medico_id,
                    :disponibilidad_id,
                    :fecha,
                    :hora,
                    :motivo,
                    'PROGRAMADA',
                    NOW(),
                    NOW()
                )
            ";

            $stmtCita =
                $this->db->prepare($sqlCita);

            $stmtCita->bindValue(
                ':paciente_id',
                $pacienteId,
                PDO::PARAM_INT
            );

            $stmtCita->bindValue(
                ':medico_id',
                $medicoId,
                PDO::PARAM_INT
            );

            $stmtCita->bindValue(
                ':disponibilidad_id',
                $disponibilidadId,
                PDO::PARAM_INT
            );

            $stmtCita->bindValue(
                ':fecha',
                $fecha
            );

            $stmtCita->bindValue(
                ':hora',
                $hora
            );

            $stmtCita->bindValue(
                ':motivo',
                $motivo
            );

            $stmtCita->execute();


            $citaId =
                $this->db->lastInsertId();


            /*
             * Marcar horario como reservado.
             */
            $sqlUpdate = "
                UPDATE disponibilidad
                SET
                    estado = 'RESERVADO',
                    updated_at = NOW()
                WHERE id = :id
                  AND estado = 'DISPONIBLE'
            ";

            $stmtUpdate =
                $this->db->prepare($sqlUpdate);

            $stmtUpdate->bindValue(
                ':id',
                $disponibilidadId,
                PDO::PARAM_INT
            );

            $stmtUpdate->execute();


            if ($stmtUpdate->rowCount() !== 1) {

                throw new Exception(
                    'No fue posible reservar el horario.'
                );
            }


            $this->db->commit();

            return $citaId;
        } catch (Exception $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            throw $e;
        }
    }

    /**
     * Obtiene la información de una cita
     * junto con el paciente, médico y especialidad.
     */
    public function find($id)
    {
        $sql = "
        SELECT
            c.id,
            c.fecha,
            c.hora,
            c.motivo,
            c.estado,

            p.nombre AS paciente_nombre,
            p.apellido AS paciente_apellido,

            m.nombre AS medico_nombre,
            m.apellido AS medico_apellido,

            e.nombre AS especialidad

        FROM citas c

        INNER JOIN pacientes p
            ON p.id = c.paciente_id

        INNER JOIN medicos m
            ON m.id = c.medico_id

        INNER JOIN especialidades e
            ON e.id = m.especialidad_id

        WHERE c.id = :id

        LIMIT 1
    ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':id',
            $id,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Obtiene las citas de un paciente.
     */
    public function getByPaciente($pacienteId)
    {
        $sql = "
        SELECT
            c.id,
            c.fecha,
            c.hora,
            c.motivo,
            c.observaciones,
            c.estado,

            m.nombre AS medico_nombre,
            m.apellido AS medico_apellido,

            e.nombre AS especialidad

        FROM citas c

        INNER JOIN medicos m
            ON m.id = c.medico_id

        INNER JOIN especialidades e
            ON e.id = m.especialidad_id

        WHERE c.paciente_id = :paciente_id

        ORDER BY c.fecha DESC, c.hora DESC
    ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':paciente_id',
            $pacienteId,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }


    /**
     * Obtiene las citas futuras de un paciente.
     */
    public function getProximasByPaciente($pacienteId)
    {
        $sql = "
        SELECT
            c.id,
            c.fecha,
            c.hora,
            c.motivo,
            c.observaciones,
            c.estado,

            m.nombre AS medico_nombre,
            m.apellido AS medico_apellido,

            e.nombre AS especialidad

        FROM citas c

        INNER JOIN medicos m
            ON m.id = c.medico_id

        INNER JOIN especialidades e
            ON e.id = m.especialidad_id

        WHERE c.paciente_id = :paciente_id

          AND c.fecha >= CURDATE()

          AND c.estado IN (
              'PROGRAMADA',
              'CONFIRMADA'
          )

        ORDER BY c.fecha ASC, c.hora ASC
    ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':paciente_id',
            $pacienteId,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }


    /**
     * Obtiene el historial de citas.
     */
    public function getHistorialByPaciente($pacienteId)
    {
        $sql = "
        SELECT
            c.id,
            c.fecha,
            c.hora,
            c.motivo,
            c.observaciones,
            c.estado,

            m.nombre AS medico_nombre,
            m.apellido AS medico_apellido,

            e.nombre AS especialidad

        FROM citas c

        INNER JOIN medicos m
            ON m.id = c.medico_id

        INNER JOIN especialidades e
            ON e.id = m.especialidad_id

        WHERE c.paciente_id = :paciente_id

          AND (
              c.fecha < CURDATE()
              OR c.estado IN (
                  'ATENDIDA',
                  'CANCELADA',
                  'NO_ASISTIO'
              )
          )

        ORDER BY c.fecha DESC, c.hora DESC
    ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':paciente_id',
            $pacienteId,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Obtiene el detalle de una cita para un paciente específico.
     */
    public function getDetalleByPaciente($citaId, $pacienteId)
    {
        $sql = "
        SELECT
            c.id,
            c.fecha,
            c.hora,
            c.motivo,
            c.observaciones,
            c.estado,
            c.created_at,

            p.nombre AS paciente_nombre,
            p.apellido AS paciente_apellido,
            p.documento AS paciente_documento,

            m.nombre AS medico_nombre,
            m.apellido AS medico_apellido,
            m.email AS medico_email,

            e.nombre AS especialidad

        FROM citas c

        INNER JOIN pacientes p
            ON p.id = c.paciente_id

        INNER JOIN medicos m
            ON m.id = c.medico_id

        INNER JOIN especialidades e
            ON e.id = m.especialidad_id

        WHERE c.id = :cita_id
          AND c.paciente_id = :paciente_id

        LIMIT 1
    ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':cita_id',
            $citaId,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':paciente_id',
            $pacienteId,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Cancela una cita y libera el horario.
     *
     * Se utiliza una transacción para garantizar
     * que ambas operaciones se realicen correctamente.
     */
    public function cancelar($citaId, $pacienteId)
    {
        try {

            $this->db->beginTransaction();

            /*
         * Obtener la cita y bloquearla.
         */
            $sql = "
            SELECT
                id,
                disponibilidad_id,
                estado
            FROM citas
            WHERE id = :id
              AND paciente_id = :paciente_id
            FOR UPDATE
        ";

            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(
                ':id',
                $citaId,
                PDO::PARAM_INT
            );

            $stmt->bindValue(
                ':paciente_id',
                $pacienteId,
                PDO::PARAM_INT
            );

            $stmt->execute();

            $cita = $stmt->fetch();

            if (!$cita) {
                throw new Exception(
                    'Cita no encontrada.'
                );
            }

            if (!in_array(
                $cita['estado'],
                array(
                    'PROGRAMADA',
                    'CONFIRMADA'
                )
            )) {

                throw new Exception(
                    'La cita no puede ser cancelada.'
                );
            }


            /*
         * Cancelar la cita.
         */
            $sqlUpdate = "
            UPDATE citas
            SET
                estado = 'CANCELADA',
                updated_at = NOW()
            WHERE id = :id
        ";

            $stmtUpdate =
                $this->db->prepare($sqlUpdate);

            $stmtUpdate->bindValue(
                ':id',
                $citaId,
                PDO::PARAM_INT
            );

            $stmtUpdate->execute();


            /*
         * Liberar disponibilidad.
         */
            if (!empty($cita['disponibilidad_id'])) {

                $sqlDisponibilidad = "
                UPDATE disponibilidad
                SET
                    estado = 'DISPONIBLE',
                    updated_at = NOW()
                WHERE id = :id
            ";

                $stmtDisponibilidad =
                    $this->db->prepare(
                        $sqlDisponibilidad
                    );

                $stmtDisponibilidad->bindValue(
                    ':id',
                    $cita['disponibilidad_id'],
                    PDO::PARAM_INT
                );

                $stmtDisponibilidad->execute();
            }


            $this->db->commit();

            return true;
        } catch (Exception $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            throw $e;
        }
    }
}
