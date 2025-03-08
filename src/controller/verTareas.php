<?php
header('Content-Type: application/json');

try {
    require_once('../model/model_class_usuarios.php');
    require_once('../model/model_class_tareas.php');

    $jsonData = file_get_contents('php://input');
    $nUsuario = json_decode($jsonData);

    if (!$nUsuario) {
        throw new Exception('Datos de entrada invalidos');
    }

    $usuario = new Usuarios();
    $idUsuario = $usuario->consultarId($nUsuario);

    $tarea = new Tareas();
    $arrayTareas = $tarea->verTareas($idUsuario);

    if($arrayTareas){
        echo json_encode($arrayTareas);
        exit;
    }else {
        throw new Exception('No se pudo cargar la lista de tareas');
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit;
}