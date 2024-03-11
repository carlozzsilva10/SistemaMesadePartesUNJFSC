<?php
    include("conexion.php");
    if (isset($_GET['nrotramite'])) {
        $nrotramite = $_GET['nrotramite'];

        $consulta = "SELECT t.nrotramite, CONCAT(c.appaterno, ' ', c.apmaterno, ' ', c.nombre) AS nombrecliente, c.razonsocial, a.nombre AS nombreasunto, 
                            t.estado, d.nombre AS dependencia, tu.nomtipous AS nombretipo,c.idtipousuario, de.fecha, t.descripcion FROM tbtramite t
                            INNER JOIN tbcliente c ON t.idcliente = c.idcliente
                            INNER JOIN tbasunto a ON t.idasunto = a.idasunto
                            LEFT JOIN tbdetalletramite de ON t.nrotramite = de.tramite
                            LEFT JOIN tbdependencia d ON t.iddependencia = d.iddependencia
                            LEFT JOIN tbtipousuario tu ON c.idtipousuario = tu.idtipousuario
                            WHERE t.nrotramite = '$nrotramite'";

        $resultado = mysqli_query($cn, $consulta);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title>
            Trámites 2023 UNJFSC
        </title>
        <link rel = "icon" href = "img/unjfsc_insignia.png">
        <link rel = "stylesheet" href = "CSS/Estilotramite.css">
    </head>
    <body>
        <div id = "cabecera">
            <img src = "img/unjfsc_logotipo.png" alt = "logo" height = "160px">
        </div>
        <fieldset>
            <h2>
                Consulta de Expedientes en Línea
            </h2>
            <table>
                <tr>
                    <th>Nro Documento</th>
                    <th>Nombre del cliente</th>
                    <th>Asunto</th>
                </tr>
                <?php
                    $row = mysqli_fetch_assoc($resultado);
                    echo "<tr>";
                    echo "<td>{$row['nrotramite']}</td>";

                    if ($row['idtipousuario'] == 5) {
                        echo "<td>{$row['razonsocial']}</td>"; // Mostrar razón social
                    } else {
                        echo "<td>{$row['nombrecliente']}</td>"; // Mostrar nombre del cliente
                    }

                    echo "<td>".$row['nombreasunto']."</td>";
                    echo "</tr>";

                    // Mostrar las siguientes columnas fijas
                    echo "<tr>";
                    echo "<th>Estado</th>";
                    echo "<th>Dependencia</th>";
                    echo "<th>Tipo de Usuario</th>";
                    echo "</tr>";

                    // Mostrar los valores correspondientes
                    echo "<td>".$row['estado']."</td>";
                    echo "<td>".$row['dependencia']."</td>";
                    echo "<td>".$row['nombretipo']."</td>";
                ?>
            </table>
            <br>
            <center>
                <button onclick = "generarPDF('<?php echo $nrotramite; ?>')">Ver Movimientos</button>
                <button onclick = "location.href = 'consultartramite.php'">Salir del Sistema</button>
            </center>
            <br>
        </fieldset>
        <script>
            function generarPDF(nrotramite) {
                window.open('reportemovimientostramite.php?nrotramite=' + nrotramite, '_blank');
            }
        </script>
    </body>
</html>
<?php
    }
?>