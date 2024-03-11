<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title>
            App-Control de Raciones
        </title>
        <link rel = "stylesheet" href = "css/estilo.css" type = "text/css">
        <script type = "text/javascript" src = "js/funcion.js"></script>
    </head>
    <body>
        <style>
            .formulario {
                position: relative;
                width: 1200px;
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
        </style>
        <?php
            include("../config/conexion.php");
            include("../config/auth.php");
            $valor = $_POST["valor"];
            $sql = "SELECT a.*, e.*, i.*, o.*, u.* FROM tbtramite a, tbcliente e, tbasunto i, tbdependencia o, tbtipousuario u
                        WHERE a.idcliente = e.idcliente AND a.idasunto = i.idasunto AND a.iddependencia = o.iddependencia AND e.idtipousuario = u.idtipousuario
                        AND CONCAT(e.nombre, ' ', e.appaterno, ' ', e.apmaterno, ' ', e.razonsocial, ' ', a.nrotramite, ' ', a.fecha_envio) LIKE '%" . $valor . "%' ORDER BY a.idtramite DESC";
            $fila = mysqli_query($cn, $sql);
            if (mysqli_num_rows($fila) == null) {
        ?>
        <center>
            <div style = "display: inline-flex; align-content: center; align-items: center;">
                <h1>Sin Resultados</h1>&nbsp;&nbsp;&nbsp;
                <i class = "fa-solid fa-0" style = "font-size: 30px;"></i>
            </div>
        </center>
        <?php
            } else {
        ?>
        <table class = "formulario" align = "center" border = "2">
            <tr align = "center" class = "cabecera">
                <td style = "width: 100px;"><strong>N° DE TRÁMITE</strong></td>
                <td style = "width: 80px;"><strong>TIPO DE USUARIO</strong></td>
                <td style = "width: 300px;"><strong>NOMBRE DEL ADMINISTRADO</strong></td>
                <td style = "width: 200px;"><strong>ASUNTO</strong></td>
                <td style = "width: 150px;"><strong>ÁREA ENCARGADA</strong></td>
                <td style = "width: 150px;"><strong>FECHA DE ENVÍO</strong></td>
                <td style = "width: 50px;"><strong>DOCUMENTO</strong></td>
                <td style = "width: 50px;"><strong>ESTADO</strong></td>
            </tr>
            <?php
                while ($r = mysqli_fetch_array($fila)) {
            ?>
            <tr align = "center" class = "cuerpo">
                <td><?php echo $r["nrotramite"];?></td>
                <td><?php echo $r["nomtipous"];?></td>
                <td><?php echo $r["razonsocial"]." ".$r["17"]." ".$r["appaterno"]." ".$r["apmaterno"];?></td>
                <td><?php echo $r["35"];?></td>
                <td><?php echo $r["37"];?></td>
                <td><?php echo $r['fecha_envio']?></td>
                <td><a href = "../../tramite/<?php echo $r["nrotramite"];?>.pdf" target = "_blank">
                    <center>
                        <img src = "../asset/img/pdf.png" width = "30" height = "30">
                    </center>
                    </a></td>
                <td><?php echo $r['7']?></td>
            </tr>
            <?php
                }
            ?>
            </table>
        <?php
            }
        ?>
    </body>
</html>