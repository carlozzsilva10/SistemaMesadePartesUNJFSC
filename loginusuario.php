<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title>
            Trámites 2023 UNJFSC
        </title>
        <link rel = "icon" href = "img/unjfsc_insignia.png">
        <link rel = "stylesheet" href = "CSS/Estilologin.css">
    </head>
    <body>
        <section>
            <div class = "contenedor">
                <div class = "formulario">
                    <form action = "p_loginusuario.php" method = "post">
                        <div class = "login-box">
                            <img src = "img/unjfsc_insignia.png" alt = "UNJFSC - Logo">
                        </div>
                        <h2>
                            TRÁMITES - 2023
                        </h2>
                        <div class = "input-contenedor">
                            <i class = "fa-solid fa-envelope"></i>
                            <input type = "email" name = "txtemail" required autocomplete = "off">
                            <label for = "#">Email</label>
                        </div>
                        <div class = "input-contenedor">
                            <i class = "fa-solid fa-lock"></i>
                            <input type = "password" name = "txtpassword" required>
                            <label for = "contraseña">Contraseña</label>
                        </div>    
                        <div class = "olvidar">
                            <a href = "cambiarpassword.php" target = "_parent" style = "color: #fff;">¿Olvidaste tu contraseña?</a>
                        </div>
                        <div>
                            <input type = "submit" value = "Iniciar Sesión" class = "btn">
                        </div>
                    </form>
                    <div class = "registrar">
                        <p>¿No tienes una cuenta? <a href = "crearcuenta.php" target = "_parent">Crear cuenta</a></p>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>