<?php
    include("auth.php");
    include("conexion.php");

    $email = $_SESSION["usuario_personal"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir datos del formulario
        $idcondicion = $_POST["lstcondicion"];
        $idcargo = $_POST["lstcargo"];
        $idfacultad = $_POST["lstfacultad"];
        $añoingreso = $_POST["lstañoingreso"];
        $grado = $_POST["lstgrado"];
        $idcategoria = $_POST["lstcategoria"];

        // Limpiar y validar los datos
        $grado = strtoupper(trim($grado));

        // Si lstcategoria es vacío, asigna NULL
        $idcategoria = empty($idcategoria) ? 'NULL' : $idcategoria;

        // Actualizar datos en la tabla tbcliente
        $sql = "UPDATE tbcliente SET idcargo = $idcargo, idfacultad = $idfacultad, yearingreso = '$añoingreso', idcondicion = $idcondicion,  ciclo_grado_nivel = '$grado', idcategoria = $idcategoria, estado = 1 WHERE email = '$email'";
        mysqli_query($cn, $sql);

        mysqli_close($cn);

        header("location: principal_personal.php");
    }
?>
