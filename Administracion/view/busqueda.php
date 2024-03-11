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
        <script type = "text/javascript" src = "../js/funcion.js"></script>
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

            #caja {
                width: 200px;
                height: 50px;
                text-align: center;
                font-family: Impact;
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <div class = "main-content" style = "padding: 0; background-color: #D1F2EB;">
            <div class = "container">
                <div style = "position: fixed; width: 100%; z-index: 110;">
                    <nav style = "background-color: #12171e; float: right; width: 100%;">
                        <img src = "../asset/img/UNJFSC.png" width = "600px" style = "float: right; padding-right: 250px;">
                    </nav>
                </div>
                <center>
                    <div class = "buscar" style = "padding-top: 150px;">
                        <div style = "display: inline-flex; align-content: center; align-items: center;">
                            <h1>Búsqueda</h1>&nbsp;&nbsp;&nbsp;
                            <i class = "fa-solid fa-magnifying-glass" style = "font-size: 30px;"></i>
                        </div>
                        <p><strong>(Nombre, Apellido, Razón Social, Número de Tramite y Fecha)</strong></p>
                        <br>
                        <div id = "busqueda">
                            <input type = "text" name = "txtcodigo" placeholder = "..." id = "caja" maxlength = "30" autocomplete = "off" autofocus = "autofocus" onkeyup = "cargarInfo()" required>
                        </div>
                    </div>
                </center>
                <br><br>
                <div id = "resultado"></div>
            </div>
        </div>
    </body>
</html>