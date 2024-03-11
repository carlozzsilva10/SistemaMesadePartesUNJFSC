<?php
    include("../config/conexion.php");
    include("../config/auth.php");

    $codigo = $_SESSION["usuario"];

    $passactual = $_POST["txtpwdpassactual"];
    $passnuevo = $_POST["txtpwdpassnuevo"];
    $repass = $_POST["txtpwdrepass"];

    // Verificar si los campos están vacíos
    if (empty($passactual) || empty($passnuevo) || empty($repass)) {
        header("location: ../view/actualizar_password.php");
        exit();
    }

    // Verificar si la contraseña actual es correcta
    $sql = "SELECT * FROM tbadministrador WHERE codadministrador = '$codigo' AND passadmi = '$passactual'";
    $result = mysqli_query($cn, $sql);
    $r = mysqli_fetch_assoc($result);

    if (!$r) {
        // La contraseña actual no es correcta
        header("location: ../view/actualizar_password.php");
        exit();
    }

    // Verificar si las nuevas contraseñas coinciden
    if ($passnuevo !== $repass) {
        header("location: ../view/actualizar_password.php");
        exit();
    }

    // Actualizar la contraseña en la base de datos
    $update_sql = "UPDATE tbadministrador SET passadmi = '$passnuevo' WHERE codadministrador = '$codigo'";
    mysqli_query($cn, $update_sql);

    header("location: ../view/principal.php");
    exit();
?>
