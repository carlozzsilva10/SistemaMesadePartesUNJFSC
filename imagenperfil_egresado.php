<?php 
    include("auth.php");
    include("menu_egresado.php");
    include("conexion.php");
    $email = $_SESSION["usuario_egresado"];
    $sql = "SELECT c.*, u.*, e.nombre AS nombre_escuela, f.nombre AS nombre_facultad FROM tbcliente c
                JOIN tbusuario u ON c.idcliente = u.idcliente
                LEFT JOIN tbescuela e ON c.idescuela = e.idescuela
                LEFT JOIN tbfacultad f ON c.idfacultad = f.idfacultad
                WHERE u.email = '$email'";
    $fila = mysqli_query($cn, $sql);
    $r = mysqli_fetch_assoc($fila);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title></title>
        <link rel = "stylesheet" href = "CSS/Estiloegresado.css">
        <style>
            fieldset {
                border: 1px solid #00539C;
                padding: 10px;
                width: 50%;
                height: 50px;
                background-color: rgba(255, 255, 255, 0.8);
                margin: auto;
            }

            form {
                text-align: center;
            }

            fieldset label {
                color: #1E88E5;
            }
        </style>
    </head>
    <body>
        <br>
        <fieldset>
            <form action = "p_imagenperfilegresado.php" method = "post" enctype = "multipart/form-data">
                <center>
                    <!-- Aplicar el estilo al texto -->
                    <label>Escoger archivo (Solo .jpg)</label>
                    <input type = "file" name = "archivo">
                    <input type = "submit" value = "Cargar foto">
                </center>
            </form>
            <br><br><br>
            <?php 
                if (isset($_GET["msj"])) {
                    $mensaje = $_GET["msj"];
                    echo "<center><h1 id='titulo'>$mensaje</h1></center>";
                }
            ?>
        </fieldset>
    </body>
</html>
