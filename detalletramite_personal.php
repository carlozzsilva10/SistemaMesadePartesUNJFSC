<?php 
	include("auth.php");
    include("menu_personal.php");
	include("conexion.php");
	$email = $_SESSION["usuario_personal"];
	$idtramite = $_GET["idtramite"];
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title>
            Detalle de Trámite
        </title>
        <link rel = "icon" href = "img/unjfsc_insignia.png">
        <link rel = "stylesheet" href = "CSS/Estilopersonal.css">
    </head>
    <body>
        <br>
        <table align = "center">
            <?php 
                // Consulta para obtener detalles del trámite
                $sql = "SELECT CONCAT(c.appaterno, ' ', c.apmaterno, ' ', c.nombre) AS nombre_completo, t.nrotramite, t.descripcion AS descripcion_tramite, a.nombre AS nombre_asunto, d.nombre AS nombre_dependencia FROM tbcliente c
                            JOIN tbtramite t ON c.idcliente = t.idcliente
                            JOIN tbasunto a ON t.idasunto = a.idasunto
                            JOIN tbdependencia d ON t.iddependencia = d.iddependencia
                            WHERE t.idtramite = '$idtramite'";
                $fila = mysqli_query($cn, $sql);
                $r = mysqli_fetch_assoc($fila);
            ?>
            <tr>
                <td colspan = "2"><center><b><?php echo "TRÁMITE N° ".$r["nrotramite"];?></center></b></td>
            </tr>
            <tr>
                <td><b>NOMBRE COMPLETO</b></td>
                <td><?php echo $r["nombre_completo"];?></td>
            </tr>
            <tr>
                <td><b>ASUNTO</b></td>
                <td><?php echo $r["nombre_asunto"];?></td>
            </tr>
            <tr>
                <td><b>DEPENDENCIA</b></td>
                <td><?php echo $r["nombre_dependencia"];?></td>
            </tr>
            <tr>
                <td><b>DESCRIPCIÓN</b></td>
                <td><?php echo $r["descripcion_tramite"];?></td>
            </tr>
        </table>
        <br>
        <center>
            <button>
                <a class = "a" href = "vertramite_personal.php">Volver</a>
            </button>
        </center>
    </body>
</html>
