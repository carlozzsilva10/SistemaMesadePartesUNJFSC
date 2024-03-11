<?php
    include("auth.php");
    $email = $_SESSION["usuario_institucion"];
    $archivo = $_FILES["archivo"]["tmp_name"];
    $nombre = $_FILES["archivo"]["name"];
    list($n,$e) = explode(".",$nombre);
    if ($e == "jpg") {
        move_uploaded_file($archivo, "imginstitucion/".$email.".jpg");
        header("location: principal_institucion.php");
    } else {
        $mensaje = "SOLO SE ACEPTAN ARCHIVOS .JPG";
        header('location: imagenperfil_institucion.php?msj='.$mensaje);
    }
?>