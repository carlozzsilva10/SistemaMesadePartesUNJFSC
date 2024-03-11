<?php
    include("conexion.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idtipousuario = $_POST["lsttipous"];
        $idtipodocumento = isset($_POST["lsttipodoc"]) ? $_POST["lsttipodoc"] : "";
        $nrodocumento = isset($_POST["txtnrodoc"]) ? $_POST["txtnrodoc"] : "";
        $codigo = isset($_POST["txtcodigo"]) ? $_POST["txtcodigo"] : "";
        $razonsocial = isset($_POST["txtrazonsocial"]) ? $_POST["txtrazonsocial"] : "";
        $appaterno = isset($_POST["txtappaterno"]) ? $_POST["txtappaterno"] : "";
        $apmaterno = isset($_POST["txtapmaterno"]) ? $_POST["txtapmaterno"] : "";
        $nombres = isset($_POST["txtnombres"]) ? $_POST["txtnombres"] : "";
        $direccion = isset($_POST["txtdireccion"]) ? $_POST["txtdireccion"] : "";
        $referencia = isset($_POST["txtreferencia"]) ? $_POST["txtreferencia"] : "";
        $distrito = isset($_POST["txtdistrito"]) ? $_POST["txtdistrito"] : "";
        $email = isset($_POST["txtemail"]) ? $_POST["txtemail"] : "";
        $telefono = isset($_POST["txttelefono"]) ? $_POST["txttelefono"] : "";
        $celular = isset($_POST["txtcelular"]) ? $_POST["txtcelular"] : "";
        $password = isset($_POST["txtpassword"]) ? $_POST["txtpassword"] : "";

        // Limpiar y validar los datos
        $codigo = trim($codigo);
        $razonsocial = strtoupper(trim($razonsocial));
        $appaterno = strtoupper(trim($appaterno));
        $apmaterno = strtoupper(trim($apmaterno));
        $nombres = strtoupper(trim($nombres));
        $direccion = strtoupper(trim($direccion));
        $referencia = strtoupper(trim($referencia));
        $distrito = strtoupper(trim($distrito));
        $email = trim($email);

        // Verificar si algún campo está vacío según las reglas mencionadas
        if (
            ($idtipousuario == "2" || $idtipousuario == "3" || $idtipousuario == "4") &&
            (empty($idtipodocumento) || empty($nrodocumento) || empty($codigo) || empty($appaterno) || empty($apmaterno) || empty($nombres) || empty($direccion) || empty($referencia) || empty($distrito) || empty($email) || empty($telefono) || empty($celular) || empty($password))
        ) {
            header("location: crearcuenta.php");
        } else if ($idtipousuario == "5" && (empty($idtipodocumento) || empty($nrodocumento) || empty($razonsocial) || empty($direccion) || empty($referencia) || empty($distrito) || empty($email) || empty($telefono) || empty($celular) || empty($password))) {
            header("location: crearcuenta.php");
        } else {
            // Insertar en la tabla tbcliente
            $sqlCliente = "INSERT INTO tbcliente (idtipousuario, idtipodocumento, nrodocumento, codigo, razonsocial, appaterno, apmaterno, nombre, direccion, referencia, distrito, email, telefono, celular) 
                                VALUES ('$idtipousuario', '$idtipodocumento', '$nrodocumento', '$codigo', '$razonsocial', '$appaterno', '$apmaterno', '$nombres', '$direccion', '$referencia', '$distrito', '$email', '$telefono', '$celular')";
            $stmtCliente = mysqli_prepare($cn, $sqlCliente);

            $resultCliente = mysqli_stmt_execute($stmtCliente);

            if ($resultCliente) {
                $idcliente = mysqli_insert_id($cn);

                // Insertar en la tabla tbusuario
                $sqlUsuario = "INSERT INTO tbusuario (idcliente, email, password) VALUES (?, ?, ?)";
                $stmtUsuario = mysqli_prepare($cn, $sqlUsuario);

                mysqli_stmt_bind_param($stmtUsuario, "iss", $idcliente, $email, $password);

                $resultUsuario = mysqli_stmt_execute($stmtUsuario);

                if ($resultUsuario) {
                    header("location: loginusuario.php");
                } else {
                    echo "<script>alert('Error al registrar en tbusuario.');</script>";
                }
            } else {
                echo "<script>alert('Error al registrar en tbcliente.');</script>";
            }
        }
    } else {
        // Redireccionar a la página de creación de cuenta si se intenta acceder directamente a este script
        header("location: crearcuenta.php");
    }

    mysqli_close($cn);
?>