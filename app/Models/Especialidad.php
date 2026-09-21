<?php

class Especialidad extends Model
{
    public function getAll()
    {
        $sql = "
            SELECT
                id,
                nombre,
                descripcion
            FROM especialidades
            WHERE estado = 1
            ORDER BY nombre
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $sql = "
            SELECT
                id,
                nombre,
                descripcion
            FROM especialidades
            WHERE id = :id
              AND estado = 1
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