<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title>
            Trámites 2023 UNJFSC
        </title>
        <link rel = "icon" href = "img/unjfsc_insignia.png">
        <link rel = "stylesheet" href = "CSS/Estiloconsultar.css">
    </head>
    <body>
        <section>
            <div class = "contenedor">
                <div class = "formulario">
                    <form action = "p_consultartramite.php" method = "post">
                        <div class = "login-box">
                            <img src = "img/unjfsc_insignia.png" alt = "UNJFSC - Logo">
                        </div>
                        <h2>
                            TRÁMITES - 2023
                        </h2>
                        <div class = "input-contenedor">
                            <i class = "fa-solid fa-envelope"></i>
                            <input type = "text" name = "txtnrotramite" maxlength = "11" required autocomplete = "off">
                            <label for = "#">N° de Trámite</label>
                        </div>
                        <div class = "input-contenedor">
                            <i class  ="fa-solid fa-lock"></i>
                            <input type = "password" name = "txtpassword" required>
                            <label for = "contraseña">Contraseña</label>
                        </div>
                        <div class = "olvidar">
                            <p>Consulta aquí tus trámites</p>
                        </div>
                        <div>
                            <input type = "submit" value = "Consultar" class = "btn">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>