<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Usuario</title>
    <link rel="stylesheet" href="../..//public/css/formularios.css">
</head>
<body>
    <form action="" method="post" id="formIniSesion">
        <div id="usuario">
            <label>Usuario:</label>
            <input type="text" name="user" id="inputUser">
        </div>
        <div id="passw">
            <label>Contraseña:</label>
            <input type="password" name="password" id="inputPassword">
        </div>
        <input type="submit" value="Registrarte" id="enviarDatos">

        <div id="otrasOpciones">
            <a href="./inicioSesion.php">Iniciar sesión</a>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../public/js/validacionDatos.js"></script>
</body>
</html>