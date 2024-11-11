<?php

class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "2doParcial";
    private $charset = "utf8";
    private $conn;

    public function __construct() {
        $this->conectar();
    }

    private function conectar() {
        if (!$this->conn) {
            try {
                $dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->db . ";charset=" . $this->charset;
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
                $this->conn = null;
            }
        }
    }

    public function obtenerConexion() {
        return $this->conn;
    }

    public function __destruct() {
        $this->conn = null;
    }
}