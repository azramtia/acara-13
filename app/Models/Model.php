<?php

require_once __DIR__ . '/../Core/Database.php';

/**
 * Model (Base Model)
 * Parent class untuk Model/Repository. Koneksi database cukup
 * ditulis sekali di sini, class turunan tinggal memakai $this->db.
 */
class Model
{
    protected $db;

    public function __construct(?Database $database = null)
    {
        $database = $database ?? new Database();

        $this->db = $database->getConnection();
    }
}
