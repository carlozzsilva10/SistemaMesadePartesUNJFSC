<?php
    include("panel.php");
    include("../config/auth.php");
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
        <link rel = "stylesheet" href = "css/estilo.css">
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

            .container-datos {
                display: flex;
                flex-direction: row;
            }

            .card {
                width: 300px;
                background-color: black;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0px 2px 4px rgba(0, 0, 0.2);
                margin: 20px;
            }

            .card i {
                padding-top: 10px;
                color: #f0f0f0;
            }

            .card-content {
                padding: 16px;
            }

            .card-content h3 {
                font-size: 28px;
                margin-bottom: 8px;
                color: #f0f0f0;
            }

            .card-content .btn {
                display: inline-block;
                padding: 8px 16px;
                background-color: #333;
                text-decoration: none;
                border-radius: 4px;
                margin-top: 16px;
                color: #f0f0f0;
            }

            .btn {
                display: inline-block;
                padding: 8px 16px;
                background-color: #333;
                text-decoration: none;
                border-radius: 4px;
                margin-top: 16px;
                color: #f0f0f0;
                cursor: pointer;
            }

            .column {
                padding: 10px;
            }

            .thin {
                flex: 1;
            }

            .wide {
                flex: 2;
            }

            input {
                background-color: transparent;
                border: 1px solid #ccc;
                padding: 5px;
                color: #f0f0f0;
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
                <div class = "container-datos">
                    <div class = "column thin">
                        <center>
                            <div class = "card">
                                <i class = "fa-solid fa-image" style = "font-size: 150px;"></i>
                                <div class = "card-content">
                                    <h3>
                                        Foto
                                    </h3>
                                    <a href = "actualizar_info.php" class = "btn">Regresar</a>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class = "column wide">
                        <form action = "../controller/p_actualizarfoto.php" method = "post" enctype = "multipart/form-data">
                            <center>
                                <table class = "info" cellspacing = "10" align = "center" style = "background-color: #12171e; font-size: 20px; color: #D1F2EB; border-radius: 50px;">
                                    <tr>
                                        <td align = "center">
                                            <h3>
                                                Foto Actual
                                            </h3>
                                            <img src = "../asset/img/<?php echo $codigo; ?>.jpg" width = "100%" height = 300px" style = "border-radius: 40%;">
                                        </td>
                                        <td align = "center" style = "width: 100px;">
                                            Escoger archivo (solo .jpg)
                                            <br><br>
                                            <input type = "file" name = "archivo" required>
                                            <?php
                                                if (isset($_GET["msj"])) {
                                                    $msj = $_GET["msj"];
                                                    echo "<center><h5 id='titulo'>$msj</h5></center>";
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan = "2" align = "center">
                                            <input class = "btn" type = "submit" value = "Actualizar Foto">
                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>