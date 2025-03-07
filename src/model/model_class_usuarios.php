<?php
require_once(__DIR__ . '/bd_class.php');

class Usuarios extends Conexion
{
    public function __construct()
    {
        parent::__construct();
    }

    public function agregarUsuario($nUsuario, $passUsuario)
    {
        try {
            $query = "INSERT INTO usuarios (Nombre, Contraseña) VALUES (:nombre, :contrasena)";
            $resultado = $this->db_conexion->prepare($query);
            $resultado->bindParam(':nombre', $nUsuario, PDO::PARAM_STR);
            $resultado->bindParam(':contrasena', $passUsuario, PDO::PARAM_STR);
            $resultado->execute();
            if (!$resultado) {
                throw new Exception("Error en la consulta: " . $this->db_conexion);
            }
            return true;
        } catch (Exception $e) {
            return "Excepcion capturada: " . $e->getMessage();
        }
    }

    public function consultarAcceso($nUsuario, $passUsuario)
    {
        try {
            $query = "SELECT COUNT(*) FROM usuarios WHERE Nombre = :nombre AND Contraseña = :contrasena";

            $resultado = $this->db_conexion->prepare($query);
            $resultado->bindValue(':nombre', $nUsuario, PDO::PARAM_STR);
            $resultado->bindValue(':contrasena', $passUsuario, PDO::PARAM_STR);
            $resultado->execute();
            return $resultado->fetchColumn() > 0;
        } catch (Exception $e) {
            return "Excepcion capturada: " . $e->getMessage();
        }
    }
    public function consultarUsuario($nUsuario)
    {
        try {
            $query = "SELECT COUNT(*) FROM usuarios WHERE Nombre = :nombre";

            $resultado = $this->db_conexion->prepare($query);
            $resultado->bindValue(':nombre', $nUsuario, PDO::PARAM_STR);
            $resultado->execute();

            return $resultado->fetchColumn() > 0;
        } catch (Exception $e) {
            return "Excepcion capturada: " . $e->getMessage();
        }
    }
    public function consultarId($nUsuario){
        try {
            $query = "SELECT Id FROM usuarios WHERE Nombre = :nombre";

            $resultado = $this->db_conexion->prepare(($query));
            $resultado->bindValue(':nombre', $nUsuario, PDO::PARAM_STR);
            $resultado->execute();

            $idUsuario = $resultado->fetchColumn();

            return $idUsuario;
        } catch (Exception $e) {
            return "Excepcion capturada: ".$e->getMessage();
        }
    }
}
