<?php
    include("../config/conexion.php");
    include("../config/auth.php");

    $codigo = $_SESSION["usuario"];

    $correo = $_POST["txtcorreo"];
    $celular = $_POST["txtcelular"];

    $sql = "UPDATE tbadministrador SET correo = '$correo', celular = '$celular'  WHERE codadministrador = '$codigo'";
    mysqli_query($cn, $sql);
    header("location: ../view/principal.php");
?>