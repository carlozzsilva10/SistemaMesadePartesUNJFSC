<?php
    session_start();
    include("conexion.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nrotramite = $_POST["txtnrotramite"];
        $password = $_POST["txtpassword"];

        // Consultar la base de datos para verificar la existencia del trámite y la contraseña
        $consulta = "SELECT * FROM tbtramite WHERE nrotramite = '$nrotramite' AND password = '$password'";
        $resultado = mysqli_query($cn, $consulta);

        if (mysqli_num_rows($resultado) > 0) {
            // Si existe, redireccionar a vermovimientostramite.php
            header("location: vermovimientostramite.php?nrotramite=$nrotramite");
        } else {
            // Si no existe, redireccionar a consultartramite.php con un mensaje de error
            header("location: consultartramite.php");
        }
    } else {
        // Redireccionar a la página de inicio de sesión si se intenta acceder directamente a este script
        header("location: loginusuario.php");
    }
?>
