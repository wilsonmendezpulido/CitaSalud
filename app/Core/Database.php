<?php

class Database
{
    private static $connection = null;

    private function __construct()
    {
    }

    public static function getConnection()
    {
        if (self::$connection === null) {

            $host = '127.0.0.1';
            $database = 'citasalud';
            $username = 'citasalud';
            $password = 'cita4salud$2026$';

            $dsn = "mysql:host={$host};dbname={$database};charset=utf8mb4";

            try {

                self::$connection = new PDO(
                    $dsn,
                    $username,
                    $password,
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    )
                );

            } catch (PDOException $e) {

                die(
                    'Error de conexión con la base de datos: ' .
                    $e->getMessage()
                );
            }
        }

        return self::$connection;
    }
}