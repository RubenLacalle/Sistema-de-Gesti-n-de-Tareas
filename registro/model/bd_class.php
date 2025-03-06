<?php

class Conexion {
    protected $db_conexion;

    public function __construct()
    {
        try {
            $db_usuario = 'root';
            $db_clave = '';

            // Crear conexión con la base de datos
            $this->db_conexion = new PDO('mysql:host=localhost; dbname=sistemagestiontareas; charset=utf8', $db_usuario, $db_clave, );

            // Verificar si hubo error en la conexión
            if ($this->db_conexion->errorCode()) {
                throw new Exception("Error en la conexión: " . $this->db_conexion->errorCode());
            }
        } catch (Exception $e) {
            die("Excepción capturada: " . $e->getMessage());
        }
    }
    public function finalizarConexion()
    {
        $this->db_conexion = null;
    }
}