<?php

class ApiToken extends Model
{
    public function create($usuarioId, $nombre = 'CitaSalud API', $dias = 7)
    {
        $token = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);

        $sql = "
            INSERT INTO api_tokens
            (
                usuario_id,
                token_hash,
                nombre,
                expires_at
            )
            VALUES
            (
                :usuario_id,
                :token_hash,
                :nombre,
                DATE_ADD(NOW(), INTERVAL :dias DAY)
            )
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':usuario_id',
            $usuarioId,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':token_hash',
            $tokenHash,
            PDO::PARAM_STR
        );

        $stmt->bindValue(
            ':nombre',
            $nombre,
            PDO::PARAM_STR
        );

        $stmt->bindValue(
            ':dias',
            $dias,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $token;
    }

    public function findUserByToken($token)
    {
        $tokenHash = hash('sha256', $token);

        $sql = "
            SELECT
                u.id,
                u.nombre_usuario,
                u.email,
                u.rol,
                u.estado
            FROM api_tokens t
            INNER JOIN usuarios u
                ON u.id = t.usuario_id
            WHERE t.token_hash = :token_hash
              AND u.estado = 1
              AND (
                    t.expires_at IS NULL
                    OR t.expires_at > NOW()
                  )
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':token_hash',
            $tokenHash,
            PDO::PARAM_STR
        );

        $stmt->execute();

        $usuario = $stmt->fetch();

        if ($usuario) {
            $this->updateLastUsed($tokenHash);
        }

        return $usuario;
    }

    private function updateLastUsed($tokenHash)
    {
        $sql = "
            UPDATE api_tokens
            SET last_used_at = NOW()
            WHERE token_hash = :token_hash
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':token_hash',
            $tokenHash,
            PDO::PARAM_STR
        );

        $stmt->execute();
    }

    public function deleteByToken($token)
    {
        $tokenHash = hash('sha256', $token);

        $sql = "
            DELETE FROM api_tokens
            WHERE token_hash = :token_hash
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':token_hash',
            $tokenHash,
            PDO::PARAM_STR
        );

        return $stmt->execute();
    }

    public function deleteByUsuarioId($usuarioId)
    {
        $sql = "DELETE FROM api_tokens WHERE usuario_id = :usuario_id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':usuario_id',
            $usuarioId,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }
}
