<?php
    include("panel.php");
    include("../config/auth.php");
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

            .card-container {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 40px;
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
                <div class = "card-container">
                    <div class = "card">
                        <center>
                            <i class = "fa-solid fa-user-gear" style = "font-size: 150px;"></i>
                            <div class = "card-content">
                                <h3>
                                    Datos Personales
                                </h3>
                                <a href = "actualizar_datos.php" class = "btn">Ir</a>
                            </div>
                        </center>
                    </div>
                    <div class = "card">
                        <center>
                            <i class = "fa-solid fa-image" style = "font-size: 150px;"></i>
                            <div class = "card-content">
                                <h3>
                                    Foto
                                </h3>
                                <a href = "actualizar_foto.php" class = "btn">Ir</a>
                            </div>
                        </center>
                    </div>
                    <div class = "card">
                        <center>
                            <i class = "fa-solid fa-lock" style = "font-size: 150px;"></i>
                            <div class = "card-content">
                                <h3>
                                    Contraseña
                                </h3>
                                <a href = "actualizar_password.php" class = "btn">Ir</a>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>