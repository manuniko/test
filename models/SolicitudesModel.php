<?php

class SolicitudesModel {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    private function validarFormulario($nombre, $dni, $obra_social_id, $especialidad_id){
        if (empty($nombre) || empty($dni) || empty($obra_social_id) || empty($especialidad_id)) {
            throw new Exception("Todos los campos son obligatorios.");
        }
    
        if (!preg_match("/^[a-zA-Z]+\s[a-zA-Z]+$/", $nombre)) {
            throw new Exception("El nombre debe contener exactamente dos palabras.");
        }
    
        if (!preg_match("/^[0-9]{6,8}$/", $dni)) {
            throw new Exception("El DNI debe ser un número válido entre 100.000 y 99.999.999.");
        }
    }

    public function crearSolicitud($nombre, $dni, $obra_social_id, $especialidad_id){
        $this->validarFormulario($nombre, $dni, $obra_social_id, $especialidad_id);

        $query = <<<SQL
                    INSERT INTO
                        solicitudes (nombre, dni, obra_social, especialidad)
                        VALUES(:nombre, :dni, :obra_social, :especialidad)
                    SQL;
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":dni", $dni);
        $stmt->bindParam(":obra_social", $obra_social_id);
        $stmt->bindParam(":especialidad", $especialidad_id);
        
        if (!$stmt->execute()) {
            throw new Exception("Error al guardar la solicitud.");
        }
        return true;
    }
}