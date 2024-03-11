<?php
    include("panel.php");
    include("../config/auth.php");
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                <i class = "fa-solid fa-lock" style = "font-size: 150px;"></i>
                                <div class = "card-content">
                                    <h3>
                                        Contraseña
                                    </h3>
                                    <a href = "actualizar_info.php" class = "btn">Regresar</a>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class = "column wide " style = "width: 2000px;">
                        <form action = "../controller/p_actualizarpassword.php" method = "post">
                            <center style = "padding-top: 20px;">
                                <table class = "info" cellspacing = "20" align = "center" style = "background-color: #12171e; font-size: 20px; color: white;">
                                    <tr>
                                        <td align = "center" colspan = "2">
                                            <i class = "fa-solid fa-unlock" style = "font-size: 50px;"></i> &nbsp;
                                            <i class = "fa-solid fa-key" style = "font-size: 50px;"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align = "right"><strong>CONTRASEÑA ACTUAL:</strong></td>
                                        <td style = "padding-left: 20px;">
                                            <input type = "password" required name = "txtpwdpassactual" id = "password">
                                            <i class = "fa-solid fa-eye" style = "padding-left: 10px; cursor: pointer;" id = "icon"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align = "right"><strong>NUEVA CONTRASEÑA:</strong></td>
                                        <td style = "padding-left: 20px;">
                                            <input type = "password" required name = "txtpwdpassnuevo" id = "password-1">
                                            <i class = "fa-solid fa-eye" style = "padding-left: 10px; cursor: pointer;" id = "icon-1"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align = "right"><strong>REPETIR CONTRASEÑA:</strong></td>
                                        <td style = "padding-left: 20px;">
                                            <input type = "password" required name = "txtpwdrepass" id = "password-2">
                                            <i class = "fa-solid fa-eye" style = "padding-left: 10px; cursor: pointer;" id = "icon-2"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan = "2">
                                            <center>
                                                <input class = "btn" type = "submit" value = "Actualizar Contraseña">
                                            </center>
                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let icon = document.getElementById("icon");
            let pass = document.getElementById("password");

            icon.onclick = function() {
                if (pass.type == "password") {
                    pass.type = "text";
                    icon.className = "fa-solid fa-eye-slash"
                } else {
                    pass.type = "password";
                    icon.className = "fa-solid fa-eye"
                }
            }

            let icon1 = document.getElementById("icon-1");
            let pass1 = document.getElementById("password-1");

            icon1.onclick = function() {
                if (pass1.type == "password") {
                    pass1.type = "text";
                    icon1.className = "fa-solid fa-eye-slash"
                } else {
                    pass1.type = "password";
                    icon1.className = "fa-solid fa-eye"
                }
            }

            let icon2 = document.getElementById("icon-2");
            let pass2 = document.getElementById("password-2");

            icon2.onclick = function() {
                if (pass2.type == "password") {
                    pass2.type = "text";
                    icon2.className = "fa-solid fa-eye-slash"
                } else {
                    pass2.type = "password";
                    icon2.className = "fa-solid fa-eye"
                }
            }
        </script>
    </body>
</html>