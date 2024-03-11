<?php
    include("conexion.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = mysqli_real_escape_string($cn, $_POST['email']);

        // Verificar si el email existe
        $sql = "SELECT * FROM tbusuario WHERE email = '$email'";
        $result = mysqli_query($cn, $sql);
        $usuario_existente = mysqli_num_rows($result) > 0;

        if ($usuario_existente) {
            // Si el email existe, mostrar el formulario para cambiar la contraseña
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title>
            Cambiar Contraseña
        </title>
        <link rel = "icon" href = "img/unjfsc_insignia.png">
        <link rel = "stylesheet" href = "CSS/Estilocrear.css">
        <style>
            #formpass {
                width: 750px;
                text-align: center;
            }
            
            a.button {
                background-color: #45bceb;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            a.button:hover {
                background-color: rgb(11, 87, 230);
            }
        </style>
    </head>
    <body>
        <div id = "cabecera">
            <img src = "img/unjfsc_logotipo.png" alt = "logo" height = "160px">
        </div>
        <form action = "p_cambiarpassword.php" method = "post" id = "formpass">
            <input type = "hidden" name = "email" value = "<?php echo htmlspecialchars($email);?>">
            <table>
                <tr>
                    <td>Nueva Contraseña:</td>
                    <td><input type = "password" name = "txtnuevapassword" required></td>
                </tr>
                <tr>
                    <td>Repetir Contraseña:</td>
                    <td><input type = "password" name = "txtrepetirpassword" required></td>
                </tr>
            </table>
            <input type = "submit" value = "Cambiar Contraseña">
        </form>
        <br>
        <center>
            <a href = "cambiarpassword.php" class = "button">Volver</a>
        </center>
    </body>
</html>
<?php
        } else {
            echo "<p>El email proporcionado no existe. Vuelve a intentarlo.</p>";
        }
    } else {
        // Si no es una solicitud POST, mostrar el formulario inicial
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title>
            Cambiar Contraseña
        </title>
        <link rel = "icon" href = "img/unjfsc_insignia.png">
        <link rel = "stylesheet" href = "CSS/Estilocrear.css">
        <style>
            #formemail {
                width: 400px;
                text-align: center;
            }

            a.button {
                background-color: #45bceb;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            a.button:hover {
                background-color: rgb(11, 87, 230);
            }
        </style>
    </head>
    <body>
        <div id = "cabecera">
            <img src = "img/unjfsc_logotipo.png" alt = "logo" height = "160px">
        </div>
        <form action = "cambiarpassword.php" method = "post" id = "formemail">
            <table>
                <tr>
                    <td>Email:</td>
                    <td><input type = "email" name = "email" required autocomplete = "off"></td>
                </tr>
            </table>
            <input type = "submit" value = "Enviar Email">
        </form>
        <br>
        <center>
            <a href = "loginusuario.php" class = "button">Volver</a>
        </center>
    </body>
</html>
<?php
    }
?>
