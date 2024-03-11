<?php
    include("../config/auth.php");
    include("panel.php");
    include("../config/conexion.php");

    // Obtiene los parámetros de filtro del usuario
    $fecha_inicio = $_POST['fechaIngreso'];
    $fecha_fin = $_POST['fechaFin'];

    // Construye la consulta SQL
    $query = "SELECT c.estado, c.nrotramite, c.fecha_envio, t.razonsocial, t.codigo, CONCAT(t.appaterno, ' ', t.apmaterno, ' ', t.nombre) AS nombre_completo, a.nombre AS nombre_asunto, d.nombre AS nombre_dependencia FROM tbtramite c
                    JOIN tbcliente t ON c.idcliente = t.idcliente
                    JOIN tbasunto a ON c.idasunto = a.idasunto
                    JOIN tbdependencia d ON c.iddependencia = d.iddependencia
                    WHERE c.fecha_envio BETWEEN '$fecha_inicio' AND '$fecha_fin' 
                    ORDER BY c.nrotramite ASC";

    // Ejecuta la consulta
    $resultado = mysqli_query($cn, $query);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title></title>
        <style>
            .main-content {
                position: relative;
                min-height: 100vh;
                top: 0;
                left: 80px;
                transition: all 0.5s ease;
                width: calc(100% - 80px);
                padding: 1rem;
            }

            .formulario {
                position: relative;
                width: 1000px;
                border-radius: 4px;
                margin: 0 auto;
                font-family: 'calibri';
                color: white;
                box-shadow: 7px 13px 37px #000;
                border-collapse: collapse;
            }

            .formulario .cabecera {
                background-color: #000;
            }

            .formulario .cuerpo {
                background-color: #12171e;
            }

            td {
                padding: 5px;
            }

            .btn {
                display: inline-block;
                padding: 8px 16px;
                background-color: #333;
                text-decoration: none;
                border-radius: 4px;
                margin-top: 4px;
                color: #f0f0f0;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class = "main-content" style = "padding: 0; background-color: #D1F2EB;">
            <div class = "container">
                <div style = "position: fixed; width: 100%; z-index: 110;">
                    <nav style = "background-color: #12171e; float: right; width: 100%;">
                        <img src = "../asset/img/UNJFSC.png" width = "600px" style = "float: right; padding-right: 250px;">
                    </nav>
                </div>
                <div align = "center" style = "padding-top: 150px;">
                    <h1>
                        Reporte General
                    </h1>
                    <br>
                    <table class = "formulario" align = "center" border = "2">
                        <tr align = "center" class = "cabecera">
                            <td><b>N° DE TRÁMITE</b></td>
                            <td><b>FECHA</b></td>
                            <td><b>CÓDIGO</b></td>
                            <td><b>NOMBRE DEL ADMINISTRADO</b></td>
                            <td><b>ASUNTO</b></td>
                            <td><b>ÁREA ENCARGADA</b></td>
                            <td><b>ESTADO</b></td>
                        </tr>
                        <?php
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                        ?>
                        <tr align = "center" class = "cuerpo">
                            <td><?php echo $fila["nrotramite"];?></td>
                            <td><?php echo $fila["fecha_envio"];?></td>
                            <td><?php echo $fila["codigo"];?></td>
                            <td><?php echo $fila["nombre_completo"]."".$fila["razonsocial"];?></td>
                            <td><?php echo $fila["nombre_asunto"];?></td>
                            <td><?php echo $fila["nombre_dependencia"];?></td>
                            <td><?php echo $fila["estado"];?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
                <div align = "center">
                    <br>
                    <a href = "reportes.php">
                        <input class = "btn" type = "submit" value = "Restablecer Filtro">
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>