<?php
    include("../config/auth.php");
    include("panel.php");
    include("../config/conexion.php");
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
                width: 1050px;
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
            .paginado {
                margin-top: 35px;
            }
            .paginado a{
                font-size: 23px;
                margin: 10px;
                text-decoration: none;
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                border: 2px solid black;
                padding: 0 20px;
                background-color: #12171e;
                color: #D1F2EB;
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
        <div class = "main-content" style="padding: 0; background-color: #D1F2EB;">
            <div class = "container">
                <div style = "padding-bottom: 100px;">
                    <nav style = "background-color: #12171e; float: right; width: 100%;">
                        <img src = "../asset/img/UNJFSC.png" width = "400px" style = "float: right; padding-right: 20px;">
                    </nav>
                </div>
                <br>
                <center>
                    <h1>
                        Reporte General
                    </h1>
                </center>
                <section align = "center">
                    <div id = "campos-fecha">
                        <form action = "rango_fechaA.php" method = "post" accept-charset = "UTF-8">
                            <input type = "date" name = "fechaIngreso" value = "<?php if (isset($_GET['from_date'])) { echo $_GET['from_date']; }?>" class = "form-control" placeholder = "Fecha de Inicio">
                            <input type = "date" name = "fechaFin" class = "form-control" placeholder = "Fecha Final">
                            <input class = "btn" type = "submit" value = "Filtrar">
                        </form>
                    </div>
                </section>
                <br>
                <table class = "formulario" align = "center" border = "2">
                    <?php
                        $por_pagina = 5;
                        if (isset($_GET['pagina'])) {
                            $pagina = $_GET['pagina'];
                        } else {
                            $pagina = 1;
                        }
                        $empieza = ($pagina - 1) * $por_pagina;
                        if ($empieza < 0) {
                            $empieza = 0;
                        }
                        $query = "SELECT c.estado, c.fecha_envio, c.nrotramite, t.codigo, t.razonsocial, CONCAT(t.appaterno, ' ', t.apmaterno, ' ', t.nombre) AS nombre_completo, a.nombre AS nombre_asunto, d.nombre AS nombre_dependencia FROM tbtramite c
                                        JOIN tbcliente t ON c.idcliente = t.idcliente
                                        JOIN tbasunto a ON c.idasunto = a.idasunto
                                        JOIN tbadministrador z ON c.iddependencia = z.iddependencia
                                        JOIN tbdependencia d ON c.iddependencia = d.iddependencia
                                        WHERE c.estado != 'Enviado' AND  z.codadministrador = '$codigo' LIMIT $empieza, $por_pagina";
                        $resultado = mysqli_query($cn, $query);
                    ?>
                    <tr align="center" class="cabecera">
                        <td><b>N° DE TRÁMITE</b></td>
                        <td><b>FECHA DE ENVÍO</b></td>
                        <td><b>CÓDIGO</b></td>
                        <td><b>NOMBRE DEL ADMINISTRADO</b></td>
                        <td><b>ASUNTO</b></td>
                        <td><b>ÁREA ENCARGADA</b></td>
                        <td><b>ESTADO</b></td>
                    </tr>
                    <?php
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $r = $fila;
                    ?>
                    <tr align = "center" class = "cuerpo">
                        <td><?php echo $r["nrotramite"];?></td>
                        <td><?php echo $r["fecha_envio"];?></td>
                        <td><?php echo $r["codigo"];?></td>
                        <td><?php echo $r["nombre_completo"]."".$r["razonsocial"];?></td>
                        <td><?php echo $r["nombre_asunto"];?></td>
                        <td><?php echo $r["nombre_dependencia"];?></td>
                        <td><?php echo $r["estado"];?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <center class="paginado">
                <?php
                    $query = "SELECT c.estado, c.fecha_envio, c.nrotramite, CONCAT(t.appaterno, ' ', t.apmaterno, ' ', t.nombre) AS nombre_completo, a.nombre AS nombre_asunto, d.nombre AS nombre_dependencia FROM tbtramite c
                                    JOIN tbcliente t ON c.idcliente = t.idcliente
                                    JOIN tbasunto a ON c.idasunto = a.idasunto
                                    JOIN tbadministrador z ON c.iddependencia = z.iddependencia
                                    JOIN tbdependencia d ON c.iddependencia = d.iddependencia  
                                    WHERE c.estado = 'Finalizado' and  z.codadministrador = '$codigo' ";
                    $resultado = mysqli_query($cn, $query);
                    $total_registros = mysqli_num_rows($resultado);
                    $total_paginas = ceil($total_registros / $por_pagina);
                    echo "<center><a href = 'reportesA.php?pagina=1'>"  . 'Inicio' . "</a>";
                    for ($i = 1; $i <= $total_paginas; $i++) {
                        echo "<a href = 'reportesA.php?pagina=" . $i . "'> " . $i . " </a> ";
                    }
                    echo "<a href = 'reportesA.php?pagina=$total_paginas'>"  . 'Final' . "</a></center>";
                ?>
            </center>
        </div>
    </body>
</html>