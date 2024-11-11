<?php

require_once __DIR__.'/../config/config.php';

header('Content-Type: application/json');

try {
    $result = $obras_sociales->getObrasSociales();
    echo json_encode($result);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
}
