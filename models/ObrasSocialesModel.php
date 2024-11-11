<?php

class ObrasSocialesModel {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getObrasSociales(){
        $query = "SELECT id, nombre FROM obras_sociales";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}