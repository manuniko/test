<?php

require_once './config/config.php';
require_once './validar_form.php';

header("Content-Type: application/json");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre = isset($_POST['nombre_completo']) ? $_POST['nombre_completo'] : '';
    $dni = isset($_POST['dni']) ? $_POST['dni'] : '';
    $obra_social_id = isset($_POST['obra_social']) ? $_POST['obra_social'] : '';
    $especialidad_id = isset($_POST['especialidad']) ? $_POST['especialidad'] : '';

    try {
        if ($solicitudes->crearSolicitud($nombre, $dni, $obra_social_id, $especialidad_id)) {
            $response['success'] = "¡Solicitud guardada con éxito!";
            echo json_encode($response);
        }
    } catch (Exception $e) {
        $response['error'] = $e->getMessage();
        echo json_encode($response);
    }
}