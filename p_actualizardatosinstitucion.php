<?php
    include("auth.php");
    include("conexion.php");

    $email = $_SESSION["usuario_institucion"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nivel = $_POST["lstnivel"];

        // Limpiar y validar los datos
        $nivel = strtoupper(trim($nivel));

        // Si lstcategoria es vacío, asigna NULL
        $nivel = empty($nivel) ? 'NULL' : $nivel;

        // Actualizar datos en la tabla tbcliente
        $sql = "UPDATE tbcliente SET ciclo_grado_nivel = '$nivel', estado = 1 WHERE email = '$email'";
        mysqli_query($cn, $sql);

        mysqli_close($cn);

        header("location: principal_institucion.php");
    }
?>
