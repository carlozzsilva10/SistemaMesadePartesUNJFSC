<?php
    include("auth.php");
    include("conexion.php");
    $email = $_SESSION["usuario_egresado"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir datos del formulario
        $idescuela = $_POST["lstescuela"];
        $idfacultad = $_POST["lstfacultad"];
        $añoingreso = $_POST["lstañoingreso"];
        $modalidad = $_POST["lstmodalidad"];
        $grado = $_POST["lstgrado"];

        // Limpiar y validar los datos
        $modalidad = strtoupper(trim($modalidad));
        $grado = strtoupper(trim($grado));

        // Verificar si la escuela pertenece a la facultad seleccionada
        if (!verificarRelacionEscuelaFacultad($idfacultad, $idescuela)) {
            header("location: actualizardatos_egresado.php");
        } else {
            // Actualizar datos en la tabla tbcliente
            $sql = "UPDATE tbcliente SET idescuela = $idescuela, idfacultad = $idfacultad, yearingreso = '$añoingreso', modalidad = '$modalidad', ciclo_grado_nivel = '$grado', estado = 1 WHERE email = '$email'";
            mysqli_query($cn, $sql);
            
            mysqli_close($cn);

            header("location: principal_egresado.php");
        }
    }

    function verificarRelacionEscuelaFacultad($facultad, $escuela) {
        // Definir las relaciones entre escuelas y facultades
        $relaciones = [
            1 => [1],  // Bromatología y Nutrición
            2 => [2, 3, 4, 5],  // Ciencias
            3 => [6, 7],
            4 => [8, 9, 10],
            5 => [11, 12, 13],
            6 => [14],
            7 => [15, 16, 17, 18, 19],
            8 => [20, 21, 22, 23],
            9 => [24],
            10 => [25, 26, 27, 28],
            11 => [29, 30],
            12 => [31, 32],
            13 => [33, 34],
        ];

        // Verificar si la escuela pertenece a la facultad
        return isset($relaciones[$facultad]) && in_array($escuela, $relaciones[$facultad]);
    }
?>
