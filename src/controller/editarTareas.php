<?php
header('Content-Type: application/json');

try {
    require_once('../model/model_class_tareas.php');

    $jsonData = file_get_contents('php://input');
    $editarTarea = json_decode($jsonData, true);

    if (!$editarTarea) {
        throw new Exception('Datos de entrada invalidos');
    }

    $titulo = $editarTarea['titulo'];
    $descripción = $editarTarea['descripcion'];
    $fechaFin = $editarTarea['fechaLimite'];
    $idTarea = $editarTarea['idTarea'];

    $tarea = new Tareas();
    $tarea->editarTarea($titulo, $descripción, $fechaFin, $idTarea);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit;
}
