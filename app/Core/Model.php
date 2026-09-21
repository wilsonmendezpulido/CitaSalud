<?php

require_once BASE_PATH . '/app/Core/Database.php';

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }
}