<?php

include_once __DIR__ . '/config/config.php';


// try {
//     $test_db = new ConexionDB();
//     //var_dump($test_db);
//     $conn = $test_db->obtenerConexion();
// } catch (Exception $e) {
//     echo 'Error: '.$e->getMessage();
// }

// if ($_POST) {
//     var_dump($_POST);
//     die;
// }



?>


<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"
        defer></script>
    <script src="./assets/js/app.js" defer></script>
    <title>2do Parcial - 2024</title>
</head>

<body>

    <h1 class="text-center mt-5">Centro de salud</h1>

    <div class="container mt-4 col-8 col-sm-8 col-md-8 col-lg-6">
        <form method="POST" id="form_solicitud" class="needs-validation" novalidate>
            <fieldset>
                <legend class="mb-3">Solicitar turno médico</legend>
                <div class="mb-3">
                    <label for="nombre_completo" class="form-label">Nombre Completo</label>
                    <input type="text" id="nombre_completo" name="nombre_completo" class="form-control" maxlength="60"
                        pattern="^[A-Za-záéíóúÁÉÍÓÚñÑ]+(?:\s[A-Za-záéíóúÁÉÍÓÚñÑ]+){1}$" placeholder="Juan Pérez"
                        required>
                    <div id="error_nombre_completo" class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="number" id="dni" name="dni" class="form-control" min="100000" max="99999999"
                        placeholder="25647486" required>
                    <div id="error_dni" class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label for="obra_social" class="form-label">Obra Social/Prepaga</label>
                    <select class="form-select" id="obra_social" name="obra_social" aria-label="Default select example"
                        required>
                    </select>
                    <div id="error_obra_social" class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <select class="form-select" id="especialidad" name="especialidad"
                        aria-label="Default select example" required>
                    </select>
                    <div id="error_especialidad" class="invalid-feedback"></div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Enviar</button>
            </fieldset>
        </form>
    </div>

    <div class="toast-container d-flex justify-content-center align-items-center w-100">
        <div id="errorToast"
            class="toast align-items-center text-bg-danger border-0 position-fixed top-50 start-50 translate-middle"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="errorToastMessage">
                    <!-- Mensaje de error -->
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="toast-container d-flex justify-content-center align-items-center w-100">
        <div id="successToast"
            class="toast align-items-center text-bg-success border-0 position-fixed top-50 start-50 translate-middle" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="successToastMessage">
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>


</body>

</html>