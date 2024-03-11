<?php 
    include("auth.php");
    include("menu_personal.php");
    include("conexion.php");
    $email = $_SESSION["usuario_personal"];
    $sql = "SELECT c.*, u.*, f.nombre AS nombre_facultad, con.nombre AS nombre_condicion, cat.nombre AS nombre_categoria, car.nombre AS nombre_cargo FROM tbcliente c
                JOIN tbusuario u ON c.idcliente = u.idcliente
                LEFT JOIN tbfacultad f ON c.idfacultad = f.idfacultad
                LEFT JOIN tbcondicion con ON c.idcondicion = con.idcondicion
                LEFT JOIN tbcategoria cat ON c.idcategoria = cat.idcategoria
                LEFT JOIN tbcargo car ON c.idcargo = car.idcargo
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
        <link rel = "stylesheet" href = "CSS/Estilopersonal.css">
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
            <form action = "p_imagenperfilpersonal.php" method = "post" enctype = "multipart/form-data">
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
