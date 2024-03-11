<?php
    include("auth.php");
    include("conexion.php");
    $email = $_SESSION["usuario_alumno"];
    $sql = "SELECT c.*, u.* FROM tbcliente c, tbusuario u WHERE c.idcliente = u.idcliente AND c.email = '$email'";
    $fila = mysqli_query($cn,$sql);
    $r = mysqli_fetch_assoc($fila);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title>
            Alumno - Trámites 2023
        </title>
        <link rel = "icon" href = "img/unjfsc_insignia.png">
        <link rel = "stylesheet" href = "CSS/Estiloalumno.css">
        <link rel = "stylesheet" type = "text/css" href = "menu_assets/estilo.css">
        <link rel = "stylesheet" type = "text/css" href = "menu_assets/styles.css">
    </head>
    <body>
        <div id = "cabecera">
            <img src = "img/unjfsc_logotipo.png" alt = "logo" height = "100px">
        </div>
        <center>
            <img src = "img/alumno.png" width = "150" height = "150">
        </center>
        <h1>
            ALUMNO - TRÁMITES 2023
        </h1>
        <br>
        <center>
            <div id = "cssmenu">
                <ul>
                    <li><a href = "principal_alumno.php"><span>Principal</span></a></li>
                    <li class = "has-sub"><a href = "#"><span>Tus Datos</span></a>
                        <ul>
                            <li><a href = "actualizardatos_alumno.php"><span>Actualizar Datos</span></a></li>
                            <li><a href = "imagenperfil_alumno.php"><span>Insertar foto de Perfil</span></a></li>
                            <li class = "last"><a href = "cambiarpassword_alumno.php"><span>Cambiar Password</span></a></li>
                        </ul>
                    </li>
                    <?php 
                        if ($r["estado"] == 1) {                  
                    ?>
                    <li><a href = "enviartramite_alumno.php"><span>Enviar Trámite</span></a></li>
                    <li><a href = "vertramite_alumno.php"><span>Ver Trámites</span></a></li>
                    <?php 
                        }
                    ?>
                    <li class = "last"><a href = "cerrarsesion.php"><span>Cerrar Sesi&oacute;n</span></a></li>
                </ul>
            </div>    
        </center>
    </body>
</html>