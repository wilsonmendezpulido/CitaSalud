<?php

class Usuario extends Model
{
    public function findByEmail($email)
    {
        $sql = "
            SELECT
                id,
                nombre_usuario,
                email,
                password,
                rol,
                estado
            FROM usuarios
            WHERE email = :email
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':email', $email);

        $stmt->execute();

        return $stmt->fetch();
    }
}
