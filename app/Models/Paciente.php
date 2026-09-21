<?php

class Paciente extends Model
{
    /**
     * Obtener todos los pacientes activos.
     */
    public function getAll()
    {
        $sql = "
            SELECT
                p.id,
                p.usuario_id,
                p.documento,
                p.nombre,
                p.apellido,
                p.fecha_nacimiento,
                p.telefono,
                p.direccion,
                p.email,
                p.eps,
                p.sexo,
                p.discapacidad,
                p.estado,
                p.created_at
            FROM pacientes p
            WHERE p.estado = 1
            ORDER BY p.apellido ASC, p.nombre ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Obtener un paciente por ID.
     */
    public function find($id)
    {
        $sql = "
            SELECT
                p.id,
                p.usuario_id,
                p.documento,
                p.nombre,
                p.apellido,
                p.fecha_nacimiento,
                p.telefono,
                p.direccion,
                p.email,
                p.eps,
                p.sexo,
                p.discapacidad,
                p.estado
            FROM pacientes p
            WHERE p.id = :id
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
     * Crear paciente.
     */
    public function create($data)
    {
        $sql = "
            INSERT INTO pacientes
            (
                documento,
                nombre,
                apellido,
                fecha_nacimiento,
                telefono,
                direccion,
                email,
                eps,
                sexo,
                discapacidad,
                estado
            )
            VALUES
            (
                :documento,
                :nombre,
                :apellido,
                :fecha_nacimiento,
                :telefono,
                :direccion,
                :email,
                :eps,
                :sexo,
                :discapacidad,
                1
            )
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':documento', $data['documento']);
        $stmt->bindValue(':nombre', $data['nombre']);
        $stmt->bindValue(':apellido', $data['apellido']);
        $stmt->bindValue(':fecha_nacimiento', $data['fecha_nacimiento']);
        $stmt->bindValue(':telefono', $data['telefono']);
        $stmt->bindValue(':direccion', $data['direccion']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':eps', $data['eps']);
        $stmt->bindValue(':sexo', $data['sexo']);
        $stmt->bindValue(':discapacidad', $data['discapacidad']);

        return $stmt->execute();
    }

    /**
     * Actualizar paciente.
     */
    public function update($id, $data)
    {
        $sql = "
            UPDATE pacientes
            SET
                documento = :documento,
                nombre = :nombre,
                apellido = :apellido,
                fecha_nacimiento = :fecha_nacimiento,
                telefono = :telefono,
                direccion = :direccion,
                email = :email,
                eps = :eps,
                sexo = :sexo,
                discapacidad = :discapacidad
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':documento', $data['documento']);
        $stmt->bindValue(':nombre', $data['nombre']);
        $stmt->bindValue(':apellido', $data['apellido']);
        $stmt->bindValue(':fecha_nacimiento', $data['fecha_nacimiento']);
        $stmt->bindValue(':telefono', $data['telefono']);
        $stmt->bindValue(':direccion', $data['direccion']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':eps', $data['eps']);
        $stmt->bindValue(':sexo', $data['sexo']);
        $stmt->bindValue(':discapacidad', $data['discapacidad']);

        return $stmt->execute();
    }

    /**
     * Desactivar paciente.
     */
    public function delete($id)
    {
        $sql = "
            UPDATE pacientes
            SET estado = 0
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':id',
            $id,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }

    /**
     * Obtener un paciente por usuario_id.
     */
    public function findByUsuarioId($usuarioId)
    {
        $sql = "
        SELECT *
        FROM pacientes
        WHERE usuario_id = :usuario_id
          AND estado = 1
        LIMIT 1
    ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':usuario_id',
            $usuarioId,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Actualizar perfil del paciente.
     */
    public function updatePerfil($pacienteId, $data)
    {
        $sql = "
        UPDATE pacientes
        SET
            nombre = :nombre,
            apellido = :apellido,
            fecha_nacimiento = :fecha_nacimiento,
            telefono = :telefono,
            direccion = :direccion,
            email = :email,
            eps = :eps,
            sexo = :sexo,
            discapacidad = :discapacidad,
            updated_at = NOW()
        WHERE id = :id
          AND estado = 1
    ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':nombre',
            $data['nombre']
        );

        $stmt->bindValue(
            ':apellido',
            $data['apellido']
        );

        $stmt->bindValue(
            ':fecha_nacimiento',
            $data['fecha_nacimiento']
        );

        $stmt->bindValue(
            ':telefono',
            $data['telefono']
        );

        $stmt->bindValue(
            ':direccion',
            $data['direccion']
        );

        $stmt->bindValue(
            ':email',
            $data['email']
        );

        $stmt->bindValue(
            ':eps',
            $data['eps']
        );

        $stmt->bindValue(
            ':sexo',
            $data['sexo']
        );

        $stmt->bindValue(
            ':discapacidad',
            $data['discapacidad'],
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':id',
            $pacienteId,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }
}
