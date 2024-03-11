<?php 
    include("auth.php");
    include("conexion.php");
    
    $email = $_SESSION["usuario_personal"];
    $passactual = $_POST["txtpwdpassactual"];
    $passnuevo = $_POST["txtpwdpassnuevo"];
    $repass = $_POST["txtpwdrepass"];

    // Verificar si los campos están vacíos
    if (empty($passactual) || empty($passnuevo) || empty($repass)) {
        header("location: cambiarpassword_personal.php");
        exit();
    }

    // Verificar si la contraseña actual es correcta
    $sql = "SELECT * FROM tbusuario WHERE email= '$email' AND password = '$passactual'";
    $result = mysqli_query($cn, $sql);
    $r = mysqli_fetch_assoc($result);

    if (!$r) {
        // La contraseña actual no es correcta
        header("location: cambiarpassword_personal.php");
        exit();
    }

    // Verificar si las nuevas contraseñas coinciden
    if ($passnuevo !== $repass) {
        header("location: cambiarpassword_personal.php");
        exit();
    }

    // Actualizar la contraseña en la base de datos
    $update_sql = "UPDATE tbusuario SET password = '$passnuevo' WHERE email = '$email'";
    mysqli_query($cn, $update_sql);

    header("location: cerrarsesion.php");
    exit();
?>
