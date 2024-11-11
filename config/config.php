<?php

require_once __DIR__.'/database.php';
require_once __DIR__.'/../models/EspecialidadesModel.php';
require_once __DIR__.'/../models/ObrasSocialesModel.php';
require_once __DIR__.'/../models/SolicitudesModel.php';

try {
    $db = new Database();
    $conn = $db->obtenerConexion();

    $especialidades = new EspecialidadesModel($conn);
    $obras_sociales = new ObrasSocialesModel($conn);
    $solicitudes = new SolicitudesModel($conn);
    
} catch (Exception $e) {
    echo 'Error: '.$e->getMessage();
}

