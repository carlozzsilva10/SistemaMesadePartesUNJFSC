<?php
    session_start();
    include("../config/conexion.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $codigo = $_POST["txtcodigo"];
        $password = $_POST["txtpassword"];
        $area = $_POST["lstarea"];


        $sql = "SELECT * FROM tbadministrador WHERE codadministrador = '$codigo' AND passadmi = '$password' AND iddependencia = '$area'";

        $fila = mysqli_query($cn, $sql);

        $r = mysqli_fetch_assoc($fila);

        $valor = $r["codadministrador"];

        if ($valor == null) {
            header('location: ../view/index.php');
        } else {
            $_SESSION["usuario"] = $valor;
            $_SESSION["auth"] = 1;
            header('location: ../view/principal.php');
        }
        mysqli_close($cn);
    } else {
        header("location: ../view/index.php");
    }
?>
