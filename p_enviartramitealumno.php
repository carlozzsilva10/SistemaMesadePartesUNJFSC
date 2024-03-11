<?php
    include("auth.php");
    include("conexion.php");
    $email = $_SESSION["usuario_alumno"];

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar los datos del formulario
        $asunto = $_POST["lstasunto"];
        $dependencia = $_POST["lstdependencia"];
        $descripcion = $_POST["txtdescripcion"];

        // Limpiar y validar los datos
        $descripcion = strtoupper(trim($descripcion));

        // Validar que no hay campos vacíos
        if (empty($asunto) || empty($dependencia) || empty($descripcion)) {
            // Redireccionar con mensaje de error si hay campos vacíos
            header("Location: enviartramite_alumno.php");
            exit();
        }

        // Validar que se ha cargado un archivo y que es un PDF
        if ($_FILES["archivo"]["size"] > 0) {
            $archivoNombre = $_FILES["archivo"]["name"];
            $archivoTemp = $_FILES["archivo"]["tmp_name"];

            // Verificar que el archivo tenga la extensión .pdf
            $extension = pathinfo($archivoNombre, PATHINFO_EXTENSION);
            if (strtolower($extension) != "pdf") {
                // Redireccionar con mensaje de error si no es un archivo PDF
                header("Location: enviartramite_alumno.php");
                exit();
            }

            // Generar el número de trámite
            $nrotramite = obtenerNumeroTramite($cn);

            // Mover el archivo a la carpeta de destino con su número de trámite
            $archivoDestino = "tramite/" . $nrotramite . ".pdf";
            move_uploaded_file($archivoTemp, $archivoDestino);

            // Obtener el idcliente correspondiente al usuario actual
            $sqlCliente = "SELECT idcliente FROM tbusuario WHERE email = '$email'";
            $resultCliente = mysqli_query($cn, $sqlCliente);
            $rowCliente = mysqli_fetch_assoc($resultCliente);
            $idcliente = $rowCliente["idcliente"];

            // Generar una contraseña aleatoria
            $password = generarPassword();

            // Insertar datos en la tabla tbtramite
            $sqlInsert = "INSERT INTO tbtramite (idcliente, nrotramite, idasunto, iddependencia, descripcion, password)
                        VALUES ('$idcliente', '$nrotramite', '$asunto', '$dependencia', '$descripcion', '$password')";

            // Intentar ejecutar la inserción en tbtramite
            if (mysqli_query($cn, $sqlInsert)) {
                // Insertar datos en la tabla tbdetalletramite
                $sqlDetalle = "INSERT INTO tbdetalletramite (idcliente, tramite, estado) VALUES ('$idcliente', '$nrotramite', 'Enviado')";

                // Intentar ejecutar la inserción en tbdetalletramite
                if (mysqli_query($cn, $sqlDetalle)) {
                    // Redireccionar a la página de resultado con la información del trámite
                    header("Location: resultadotramite_alumno.php?nrotramite=$nrotramite&password=$password");
                    exit();
                } else {
                    // Inserción en tbdetalletramite fallida
                    header("Location: enviartramite_alumno.php");
                    exit();
                }
            } else {
                // Inserción en tbtramite fallida
                header("Location: enviartramite_alumno.php");
                exit();
            }
        } else {
            // Redireccionar con mensaje de error si no se carga un archivo
            header("Location: enviartramite_alumno.php");
            exit();
        }
    } else {
        // Si se intenta acceder directamente a este script sin enviar el formulario, redireccionar
        header("Location: loginusuario.php");
        exit();
    }

    // Función para obtener el número de trámite con el formato deseado
    function obtenerNumeroTramite($cn) {
        $anioActual = date("Y");
        $sql = "SELECT MAX(nrotramite) AS maxNro FROM tbtramite WHERE nrotramite LIKE '$anioActual%'";
        $result = mysqli_query($cn, $sql);
        $row = mysqli_fetch_assoc($result);

        $maxNro = $row["maxNro"];

        // Si no hay trámites para el año actual, iniciar desde 000001
        if (!$maxNro) {
            return $anioActual . "-000001";
        }

        // Incrementar el número existente y asegurarse de que tenga 6 dígitos
        $nuevoNro = intval(substr($maxNro, -6)) + 1;
        return $anioActual . "-" . sprintf('%06d', $nuevoNro);
    }

    // Función para generar una contraseña aleatoria de 5 caracteres
    function generarPassword() {
        $caracteresPermitidos = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $password = "";

        for ($i = 0; $i < 5; $i++) {
            $password .= $caracteresPermitidos[rand(0, strlen($caracteresPermitidos) - 1)];
        }

        return $password;
    }
?>
