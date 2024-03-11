<?php
    include("../config/auth.php");
    include("panel.php");
    include("../config/conexion.php");
    $codigo = $_SESSION["usuario"];
    $sql = "SELECT * FROM tbadministrador WHERE codadministrador = '$codigo'";
    $fila = mysqli_query($cn, $sql);
    $r = mysqli_fetch_assoc($fila);
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
        </style>
    </head>
    <body>
        <div class = "main-content" style = "padding: 0; background-color: #D1F2EB;">
            <div class = "container">
                <div style = "padding-bottom: 150px;">
                    <nav style = "background-color: #12171e; float: right; width: 100%;">
                        <img src = "../asset/img/UNJFSC.png" width = "400px" style = "float: right; padding-right: 20px;">
                    </nav>
                </div>
                <center>
                    <h1>Bienvenido(a) <?php echo $r["nombres"]. " ".$r["apaterno"]. " " .$r["amaterno"];?><i class = "fa-solid fa-circle-user"></i></h1>
                </center>
                <center style = "padding-top: 50px;">
                    <table class = "info" cellspacing = "7" align = "center" style = "background-color: #12171e; font-size: 20px; color: #D1F2EB;">
                        <tr>
                            <td rowspan = "6" align = "center" valign = "middle">
                                <img src = "../asset/img/<?php echo $codigo;?>.jpg" width = "100%" height = "300">
                            </td>
                            <td align = "left"><strong>CÓDIGO ADMINISTRATIVO:</strong></td>
                            <td style = "padding-left: 20px;"><?php echo $r["codadministrador"];?></td>
                        </tr>
                        <tr>
                            <td align = "right"><strong>APELLIDO PATERNO:</strong></td>
                            <td style = "padding-left: 20px;"><?php echo $r["apaterno"];?></td>
                        </tr>
                        <tr>
                            <td align = "right"><strong>APELLIDO MATERNO:</strong></td>
                            <td style = "padding-left: 20px;"><?php echo $r["amaterno"];?></td>
                        </tr>
                        <tr>
                            <td align = "right"><strong>NOMBRES COMPLETOS:</strong></td>
                            <td style = "padding-left: 20px;"><?php echo $r["nombres"];?></td>
                        </tr>
                        <tr>
                            <td align = "right"><strong>CORREO ELECTRÓNICO:</strong></td>
                            <td style = "padding-left: 20px;"><?php echo $r["correo"];?></td>
                        </tr>
                        <tr>
                            <td align = "right"><strong>CELULAR:</strong></td>
                            <td style = "padding-left: 20px;"><?php echo $r["celular"];?></td>
                        </tr>
                    </table>
                </center>
            </div>
        </div>
    </body>
</html>