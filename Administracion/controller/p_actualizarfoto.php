<?php
    include("../config/auth.php");
    $codigo = $_SESSION["usuario"];
    $archivo = $_FILES["archivo"]["tmp_name"];
    $nombre = $_FILES["archivo"]["name"];
    $extension = pathinfo($nombre, PATHINFO_EXTENSION);
    if ($extension == "jpg") {
        move_uploaded_file($archivo, "../asset/img/$codigo.jpg");
        header("location: ../view/principal.php");
    } else {
        $mensaje = "SOLO SE ACEPTAN ARCHIVOS .JPG";
        header('location: ../view/actualizar_foto.php?msj=' . $mensaje);
    }
?>
