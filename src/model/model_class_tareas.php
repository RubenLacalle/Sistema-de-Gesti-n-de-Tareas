<?php
require_once(__DIR__ . '/bd_class.php');

class Tareas extends Conexion
{
    public function __construct()
    {
        parent::__construct();
    }

    public function agregarTarea($titulo, $descripcion, $fechaIni, $fechaFin, $idUsuario)
    {
        try {
            $query = "INSERT INTO tareas (Titulo, Descripcion, FechaInicio, FechaFin, idUsuario) VALUES (:titulo, :descripcion, :fechaIni, :fechaFin, :idUsuario)";
            $resultado = $this->db_conexion->prepare($query);
            $resultado->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $resultado->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $resultado->bindParam(':fechaIni', $fechaIni, PDO::PARAM_STR);
            $resultado->bindParam(':fechaFin', $fechaFin, PDO::PARAM_STR);
            $resultado->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
            $resultado->execute();
            
            if ($resultado->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return "Excepcion capturada: " . $e->getMessage();
        }
    }
}
