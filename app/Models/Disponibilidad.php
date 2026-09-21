<?php

class Disponibilidad extends Model
{
    /**
     * Obtiene las fechas disponibles de un médico.
     */
    public function getFechasDisponibles($medicoId)
    {
        $sql = "
            SELECT DISTINCT
                fecha
            FROM disponibilidad
            WHERE medico_id = :medico_id
              AND estado = 'DISPONIBLE'
              AND fecha >= CURDATE()
            ORDER BY fecha ASC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':medico_id',
            $medicoId,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Obtiene los horarios disponibles de un médico
     * para una fecha determinada.
     */
    public function getHorariosDisponibles($medicoId, $fecha)
    {
        $sql = "
            SELECT
                id,
                fecha,
                hora_inicio,
                hora_fin,
                estado
            FROM disponibilidad
            WHERE medico_id = :medico_id
              AND fecha = :fecha
              AND estado = 'DISPONIBLE'
            ORDER BY hora_inicio ASC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':medico_id',
            $medicoId,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':fecha',
            $fecha
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Obtiene una disponibilidad específica.
     */
    public function find($id)
    {
        $sql = "
            SELECT
                d.*,
                m.nombre AS medico_nombre,
                m.apellido AS medico_apellido,
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
            $id,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetch();
    }
}
