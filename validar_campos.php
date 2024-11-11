<?php
require_once './config/config.php';
header("Content-Type: application/json");

try {
    $input = json_decode(file_get_contents("php://input"), true);
    
    $campo = $input['campo'] ?? '';
    $valor = $input['valor'] ?? '';

    $response = ['valido' => true, 'mensaje' => ''];

    switch ($campo) {
        case 'nombre_completo':
            if (empty($valor) || !preg_match("/^[a-zA-Z]+\s[a-zA-Z]+$/", $valor)) {
                $response['valido'] = false;
                $response['mensaje'] = "El nombre debe contener exactamente dos palabras.";
            }
            break;

        case 'dni':
            if (empty($valor) || !preg_match("/^[0-9]{6,8}$/", $valor)) {
                $response['valido'] = false;
                $response['mensaje'] = "El DNI debe ser un número válido entre 100.000 y 99.999.999.";
            }
            break;

        case 'obra_social':
            if (empty($valor)) {
                $response['valido'] = false;
                $response['mensaje'] = "Debe seleccionar una obra social.";
            }
            break;

        case 'especialidad':
            if (empty($valor)) {
                $response['valido'] = false;
                $response['mensaje'] = "Debe seleccionar una especialidad.";
            }
            break;

        default:
            throw new Exception("Campo no válido");
    }

    echo json_encode($response);

} catch (Exception $e) {
    echo json_encode(['valido' => false, 'mensaje' => 'Error en la validación: ' . $e->getMessage()]);
}
