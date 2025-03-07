<?php
header('Content-Type: application/json');

try {
    require_once('../model/model_class_usuarios.php');
    require_once('../model/model_class_tareas.php');

    $jsonData = file_get_contents('php://input');

    $nuevaTarea = json_decode($jsonData, true);

    if (!$nuevaTarea) {
        throw new Exception('Datos de entrada invalidos');
    }

    $titulo = $nuevaTarea['titulo'];
    $descripción = $nuevaTarea['descripcion'];
    $fechaInicio = date('Y-m-d');
    $fechaFin = $nuevaTarea['fechaLimite'];
    $nUsuario = $nuevaTarea['nUsuario'];

    $usuario = new Usuarios();
    $idUsuario = $usuario->consultarId($nUsuario);


    $nuevaTarea = new Tareas();
    $resultado = $nuevaTarea->agregarTarea($titulo, $descripción, $fechaInicio, $fechaFin, $idUsuario);


    if ($resultado) {
        echo json_encode(['status' => 'success', 'message' => 'Tarea agregada correctamente']);
        exit;
    } else {
        throw new Exception('No se pudo agregar la tarea');
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit;
}
