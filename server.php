<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $alumno = $_POST['alumno'];
    $nota = intval($_POST['nota']);
    
    // Leer el archivo JSON
    $json = file_get_contents('notas.json');
    $data = json_decode($json, true);
    
    // Agregar la nueva nota
    $data[] = array('alumno' => $alumno, 'nota' => $nota);
    
    // Guardar los datos de nuevo en el archivo JSON
    file_put_contents('notas.json', json_encode($data));
    
    // Responder con los datos actualizados
    echo json_encode($data);
    header('Location: /');
    exit;
}




header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header('Content-Type: application/json;');

// Reading the JSON file
$json = file_get_contents('notas.json');
$data = json_decode($json, true);

// Encoding the data back to JSON and outputting it
echo json_encode($data);


