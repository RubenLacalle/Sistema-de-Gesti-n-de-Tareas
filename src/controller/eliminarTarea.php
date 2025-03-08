<?php
header('Content-Type: application/json');

try {
    require_once('../model/model_class_tareas.php');

    $jsonData = file_get_contents('php://input');

    $idTarea = json_decode($jsonData);

    if (!$idTarea) {
        throw new Exception('Datos de entrada invalidos');
    }

    $tarea = new Tareas();
    $tarea->eliminarTarea($idTarea);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit;
}
