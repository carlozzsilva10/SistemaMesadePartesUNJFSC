<?php
    include("../config/auth.php");
    include("panel.php");
    include("../config/conexion.php");
    $codigo = $_SESSION["usuario"];
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

            .paginado {
                margin-top: 35px;
            }

            .paginado a {
                font-size: 23px;
                margin: 10px;
                text-decoration: none;
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                border: 2px solid black;
                padding: 0 20px;
                background-color: #12171e;
                color: #D1F2EB;
            }
        </style>
    </head>
    <body>
        <div class = "main-content" style = "padding: 0; background-color: #D1F2EB;">
            <div class = "container">
                <div style = "top:0; width: 100%;">
                    <nav style = "background-color: #12171e; float: right; width: 100%;">
                        <img src = "../asset/img/UNJFSC.png" width = "400px" style = "float: right; padding-right: 20px;">
                    </nav>
                </div>
                <br><br><br><br><br><br>
                <center>
                    <div style = "display: inline-flex; align-content: center; align-items: center;">
                        <h1>Expedientes Atendidos</h1>&nbsp;&nbsp;&nbsp;
                        <i class = "fa-regular fa-folder-open" style = "font-size: 30px;"></i>
                    </div>
                </center>
                <br>
                <table class = "formulario" align = "center" border="2">
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
                        $query = "SELECT c.estado, c.fecha_envio, c.nrotramite, CONCAT(t.appaterno, ' ', t.apmaterno, ' ', t.nombre) AS nombre_completo, a.nombre AS nombre_asunto, d.nombre AS nombre_dependencia FROM tbtramite c
                                        JOIN tbcliente t ON c.idcliente = t.idcliente
                                        JOIN tbasunto a ON c.idasunto = a.idasunto
                                        JOIN tbadministrador z ON c.iddependencia = z.iddependencia
                                        JOIN tbdependencia d ON c.iddependencia = d.iddependencia  
                                        WHERE c.estado = 'Finalizado' and z.codadministrador = '$codigo' 
                                        ORDER by c.fecha_envio DESC LIMIT $empieza,$por_pagina";
                        $resultado = mysqli_query($cn, $query);
                    ?>
                    <tr align = "center" class = "cabecera">
                        <td><b>N° DE TRÁMITE</b></td>
                        <td><b>REMITENTE</b></td>
                        <td><b>TIPO DE DOCUMENTO</b></td>
                        <td><b>ÁREA ASIGNADA</b></td>
                        <td><b>DOCUMENTO</b></td>
                        <td><b>ESTADO</b></td>
                    </tr>
                    <?php
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $r = $fila;
                    ?>
                    <tr align = "center" class = "cuerpo">
                        <td name = "nrotramite"><?php echo $r["nrotramite"];?></td>
                        <td><?php echo $r["nombre_completo"];?></td>
                        <td><?php echo $r["nombre_asunto"];?></td>
                        <td><?php echo $r["nombre_dependencia"];?></td>
                        <td>
                            <a href = "../../tramite/<?php echo $r["nrotramite"];?>.pdf" target = "_blank">
                                <center>
                                    <img src = "../asset/img/pdf.png" width = "30" height = "30">
                                </center>
                            </a>
                        </td>
                        <td><?php echo $r["estado"]; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <br>
                <center class = "paginado">
                    <?php
                        $query = "SELECT c.estado, c.fecha_envio, c.nrotramite, CONCAT(t.appaterno, ' ', t.apmaterno, ' ', t.nombre) AS nombre_completo, a.nombre AS nombre_asunto, d.nombre AS nombre_dependencia FROM tbtramite c
                                        JOIN tbcliente t ON c.idcliente = t.idcliente
                                        JOIN tbasunto a ON c.idasunto = a.idasunto
                                        JOIN tbadministrador z ON c.iddependencia = z.iddependencia
                                        JOIN tbdependencia d ON c.iddependencia = d.iddependencia  
                                        WHERE c.estado = 'Finalizado' AND z.codadministrador = '$codigo' 
                                        ORDER BY c.fecha_envio DESC";
                                        $resultado = mysqli_query($cn, $query);
                                        $total_registros = mysqli_num_rows($resultado);
                                        $total_paginas = ceil($total_registros / $por_pagina);
                        echo "<center><a href = 'expedientesA_area.php?pagina=1'>"  . 'Inicio' . " </a>";
                        for ($i = 1; $i <= $total_paginas; $i++) {
                            echo "<a href = 'expedientesA_area.php?pagina=" . $i . "'> " . $i . " </a> ";
                        }
                        echo "<a href = 'expedientesA_area.php?pagina=$total_paginas'>"  . 'Final' . "</a></center>";
                    ?>
                </center>
            </div>
        </div>
    </body>
</html>