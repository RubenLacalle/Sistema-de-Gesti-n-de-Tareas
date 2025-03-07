<?php
require_once('../model/model_class_usuarios.php');

$tipoEnvio = htmlspecialchars($_POST['tratamientoDatos']);
$nUsuario = htmlspecialchars($_POST['user']);
$passUsuario =htmlspecialchars($_POST['password']);

switch ($tipoEnvio) {
    case 'Iniciar Sesion':
        $iniUsuario = new Usuarios();
        if ($iniUsuario->consultarAcceso($nUsuario,$passUsuario) == true) {
            session_start();
            $_SESSION['nUsuario'] = $nUsuario;
            header('location: ../view/vistaPrincipal.php');
            exit;
        }else{
            header('location: ../view/falloInicioSesion.html');
            exit;
        }
        break;
    
    case 'Registrarte':
        $regisUsuario = new Usuarios();
        if ($regisUsuario->consultarUsuario($nUsuario)) {
            header('location: ../view/usuarioYaRegistrado.html');
            exit;
        }else{
            $regisUsuario->agregarUsuario($nUsuario, $passUsuario);
            session_start();
            $_SESSION['nUsuario'] = json_encode($nUsuario);
            header('location: ../view/exitoRegistro.html');
            exit;
        }
        break;
}