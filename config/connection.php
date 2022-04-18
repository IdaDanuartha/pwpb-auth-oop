<?php

class Connection
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "pwpb_login";

    protected $conn;

    function __construct()
    {

        if (!isset($this->conn)) {
            $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        }

        if (!$this->conn) {
            echo "Koneksi Gagal";
        }

        return $this->conn;
    }
}
