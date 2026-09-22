<?php

class Medico extends Model
{
    public function getAll()
    {
        $sql = "
            SELECT
                m.id,
                m.nombre,
                m.apellido,
                m.registro_medico,
                m.telefono,
                m.email,
                m.perfil,
                e.id AS especialidad_id,
                e.nombre AS especialidad
            FROM medicos m
            INNER JOIN especialidades e
                ON e.id = m.especialidad_id
            WHERE m.estado = 1
              AND e.estado = 1
            ORDER BY m.apellido, m.nombre
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getByEspecialidad($especialidadId)
    {
        $sql = "
            SELECT
                m.id,
                m.nombre,
                m.apellido,
                m.registro_medico,
                m.telefono,
                m.email,
                m.perfil,
                e.id AS especialidad_id,
                e.nombre AS especialidad
            FROM medicos m
            INNER JOIN especialidades e
                ON e.id = m.especialidad_id
            WHERE m.especialidad_id = :especialidad_id
              AND m.estado = 1
              AND e.estado = 1
            ORDER BY m.apellido, m.nombre
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':especialidad_id',
            $especialidadId,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $sql = "
            SELECT
                m.*,
                m.especialidad_id,
                e.nombre AS especialidad
            FROM medicos m
            INNER JOIN especialidades e
                ON e.id = m.especialidad_id
            WHERE m.id = :id
              AND m.estado = 1
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
