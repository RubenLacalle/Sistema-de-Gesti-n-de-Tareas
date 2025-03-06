<?php
require_once('../model/model_class_usuarios.php');

$tipoEnvio = $_POST['tratamientoDatos'];
$nUsuario = $_POST['user'];
$passUsuario =$_POST['password'];

switch ($tipoEnvio) {
    case 'Iniciar Sesion':
        $iniUsuario = new Usuarios();
        if ($iniUsuario->consultarAcceso($nUsuario,$passUsuario) == true) {
            header('location: ../../gestor/view/vistaPrincipal.html');
            exit;
        }else{
            header('location: ../view/falloInicioSesion.html');
            exit;
        }
        break;
    
    case 'Registrarte':
        $regisUsuario = new Usuarios();
        if ($regisUsuario->consultarUsuario($nUsuario)) {
            header('locarion: ../view/usuarioYaRegistrado.html');
            exit;
        }else{
            $regisUsuario->agregarUsuario($nUsuario, $passUsuario);
            header('location: ../view/exitoRegistro.html');
            exit;
        }
        break;
}