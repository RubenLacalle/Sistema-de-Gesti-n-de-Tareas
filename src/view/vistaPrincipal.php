<?php
session_start();
$nUsuario = $_SESSION['nUsuario'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Tareas</title>
    <link rel="stylesheet" href="../../public/css/principal.css">
</head>

<body>
    <div class="box">
        <h1>Buenos días </h1>
        <input type="button" value="Agregar tarea" id="bAddTarea" class="botonVerde">
        <div id="nuevaTarea" hidden>
            <table>
                <tr>
                    <td>Título <input type="text" name="titulo" id="tituloTarea"> </td>
                    <td>Descripción <textarea name="descripcion" id="descripcionTarea"></textarea> </td>
                    <td>Fecha Limite <input type="date" name="fechaLimite" id="fechaFinTarea"> </td>
                    <td><input type="button" value="Añadir Tarea" id="bAñadirTarea" class="botonVerde"></td>

                </tr>
            </table>
        </div>
        <div id="tareas">
            <table id="tablaTareas">
                <tr>
                    <th>Tarea</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                </tr>
            </table>
        </div>
    </div>
    <script>
        let nUsuario = <?php echo json_encode($nUsuario); ?>;

        let hoy = new Date().toISOString().split("T")[0];
        document.querySelector("input[name='fechaLimite']").setAttribute("min", hoy);
    </script>
    <script src="../../public/js/main.js"></script>
</body>

</html>