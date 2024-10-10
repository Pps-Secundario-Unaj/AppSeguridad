<?php
ini_set(option: 'display_errors', value: 1);
ini_set(option: 'display_startup_errors', value: 1);
error_reporting(error_level: E_ALL);
include("../con_db.php");

if (isset($_POST['partido'])) {
    $partido = mysqli_real_escape_string(mysql: $conex, string: $_POST['partido']);
    
    $consulta = "SELECT COUNT(localidad) AS total_incidentes FROM incidentes WHERE partido='$partido';";
    $resultado = mysqli_query(mysql: $conex, query: $consulta);

    // Si se obtuvo un resultado, envía la cantidad como respuesta JSON.
    if ($resultado && mysqli_num_rows(result: $resultado) > 0) {
        $fila = mysqli_fetch_assoc(result: $resultado);
        echo json_encode(value: array("total" => $fila['total_incidentes']));
    } else {
        echo json_encode(value: array("total" => 0)); 
    }
} else {
    echo json_encode(value: array("error" => "No se especificó la localidad."));
}


?>
