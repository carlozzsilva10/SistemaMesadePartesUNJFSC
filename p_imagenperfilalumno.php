<?php
    include("auth.php");
    $email = $_SESSION["usuario_alumno"];
    $archivo = $_FILES["archivo"]["tmp_name"];
    $nombre = $_FILES["archivo"]["name"];
    list($n,$e) = explode(".",$nombre);
    if ($e == "jpg") {
        move_uploaded_file($archivo, "imgalumno/".$email.".jpg");
        header("location: principal_alumno.php");
    } else {
        $mensaje = "SOLO SE ACEPTAN ARCHIVOS .JPG";
        header('location: imagenperfil_alumno.php?msj='.$mensaje);
    }
?>