<?php 
	include("auth.php");
	include("menu_alumno.php");
	include("conexion.php");
	$email = $_SESSION["usuario_alumno"];
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title></title>
        <link rel = "stylesheet" href = "CSS/Estiloalumno.css">
    </head>
    <body>
        <br>
        <table align = "center">
            <?php
                $limi = 0;
                if (isset($_GET["limite"])) {
                    $limi = $_GET["limite"];
                    $sql = "SELECT c.*, u.*, t.*  FROM tbcliente c
                                JOIN tbusuario u ON c.idcliente = u.idcliente
                                LEFT JOIN tbtramite t ON c.idcliente = t.idcliente 
                                WHERE u.email = '$email' LIMIT $limi, 5";
                } else {
                    $sql = "SELECT c.*, u.*, t.* FROM tbcliente c
                                JOIN tbusuario u ON c.idcliente = u.idcliente
                                LEFT JOIN tbtramite t ON c.idcliente = t.idcliente 
                                WHERE u.email = '$email' LIMIT 0, 5";
                }
                $fila = mysqli_query($cn, $sql);

                while ($r = mysqli_fetch_assoc($fila)) {
            ?>
            <tr>
                <td><b>N° DE TRÁMITE</b></td>
                <td><b>DETALLE</b></td>
                <td><b>FECHA DE ENVÍO</b></td>
            </tr>
            <tr>
                <td><?php echo $r["nrotramite"];?></td>
                <td>
                    <?php 
                        // Verificar si el tramite existe antes de mostrar el enlace
                        $detalleLink = "vertramite_alumno.php?limite=$limi";
                        if (isset($r["idtramite"])) {
                            $detalleLink = "detalletramite_alumno.php?idtramite={$r["idtramite"]}";
                        }
                    ?>
                    <a href = "<?php echo $detalleLink;?>" target = "_parent">
                        <center>
                            <img src = "img/detalle.png" width = "30" height = "30">
                        </center>
                    </a>
                </td>
                <td><?php echo $r["fecha_envio"];?></td>
            </tr>
            <?php 
                }
            ?>
        </table>
        <br>
        <center>
            <?php
                $sql = "SELECT COUNT(*) AS 'CANTIDAD' FROM tbcliente c
                            JOIN tbusuario u ON c.idcliente = u.idcliente
                            LEFT JOIN tbescuela e ON c.idescuela = e.idescuela
                            LEFT JOIN tbfacultad f ON c.idfacultad = f.idfacultad
                            LEFT JOIN tbtramite t ON c.idcliente = t.idcliente";
                $fila = mysqli_query($cn, $sql);
                $r = mysqli_fetch_assoc($fila);
                $total = $r["CANTIDAD"];
                $cantidad = 5;
                $numpaginas = ceil($total / $cantidad);
                for ($i = 0; $i < $numpaginas; $i++) { 
                    $lim = $i * $cantidad;
                    echo "<a href='vertramite_alumno.php?limite=$lim' target='_parent'>".($i+1)."</a>&nbsp;&nbsp;&nbsp;"; 
                }
            ?>
        </center>
    </body>
</html>