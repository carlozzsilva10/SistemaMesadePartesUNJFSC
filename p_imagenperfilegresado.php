<?php
    include("auth.php");
    $email = $_SESSION["usuario_egresado"];
    $archivo = $_FILES["archivo"]["tmp_name"];
    $nombre = $_FILES["archivo"]["name"];
    list($n,$e) = explode(".",$nombre);
    if ($e == "jpg") {
        move_uploaded_file($archivo, "imgegresado/".$email.".jpg");
        header("location: principal_egresado.php");
    } else {
        $mensaje = "SOLO SE ACEPTAN ARCHIVOS .JPG";
        header('location: imagenperfil_egresado.php?msj='.$mensaje);
    }
?>