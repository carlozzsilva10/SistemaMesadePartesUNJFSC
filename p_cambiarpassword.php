<?php
    include("conexion.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = mysqli_real_escape_string($cn, $_POST['email']);
        $nueva_password = $_POST['txtnuevapassword'];
        $repetir_password = $_POST['txtrepetirpassword'];

        // Verificar si las contraseñas coinciden
        if ($nueva_password == $repetir_password) {
            // Actualizar la contraseña en la base de datos
            $sql = "UPDATE tbusuario SET password = '$nueva_password' WHERE email = '$email'";
            $result = mysqli_query($cn, $sql);

            if ($result) {
                // Contraseña cambiada con éxito, redirigir a loginusuario.php
                header("location: loginusuario.php");
                exit();
            } else {
                echo "Hubo un error al cambiar la contraseña. Por favor, inténtalo de nuevo.";
            }
        }
    } else {
        // Si no es una solicitud POST, redirigir a cambiarpassword.php
        header("location: cambiarpassword.php");
        exit();
    }
?>
