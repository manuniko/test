<?php

class EspecialidadesModel {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getEspecialidades(){
        $query = "SELECT id, nombre FROM especialidades";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}