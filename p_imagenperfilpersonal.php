<?php
    include("auth.php");
    $email = $_SESSION["usuario_personal"];
    $archivo = $_FILES["archivo"]["tmp_name"];
    $nombre = $_FILES["archivo"]["name"];
    list($n,$e) = explode(".",$nombre);
    if ($e == "jpg") {
        move_uploaded_file($archivo, "imgpersonal/".$email.".jpg");
        header("location: principal_personal.php");
    } else {
        $mensaje = "SOLO SE ACEPTAN ARCHIVOS .JPG";
        header('location: imagenperfil_personal.php?msj='.$mensaje);
    }
?>