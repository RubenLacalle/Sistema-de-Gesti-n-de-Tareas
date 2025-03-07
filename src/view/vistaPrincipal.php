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
</head>

<body>
    <div class="box">
        <h1>Buenos días </h1>
        <input type="button" value="Agregar tarea" id="bAddTarea">
        <div id="nuevaTarea" hidden>
            <table>
                <tr>
                    <td>Título <input type="text" name="titulo" id="tituloTareaNueva"> </td>
                    <td>Descripción <textarea name="descripcion" id="descripcionTareaNueva"></textarea> </td>
                    <td>Fecha Limite <input type="date" name="fechaLimite" id="fechaLimiteTareaNueva"> </td>
                    <td><input type="button" value="Añadir Tarea" id="bAñadirTarea"></td>
                </tr>
            </table>
        </div>
        <div id="tareas">
            <table id="tablaTareas">
                    <th>Tarea</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
            </table>
        </div>
    </div>
    <script>
        let nUsuario = <?php echo json_encode($nUsuario); ?>;        

        let hoy = new Date().toISOString().split("T")[0];
        document.getElementById("fechaLimiteTareaNueva").setAttribute("min", hoy);
    </script>
    <script src="../../public/js/main.js"></script>
</body>

</html>