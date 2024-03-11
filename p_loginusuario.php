<?php
    session_start();
    include("conexion.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["txtemail"];
        $password = $_POST["txtpassword"];

        // Realiza la verificación del usuario aquí
        $sqlVerificarUsuario = "SELECT u.email, c.idtipousuario FROM tbusuario u JOIN tbcliente c ON u.idcliente = c.idcliente WHERE u.email = ? AND u.password = ?";
        $stmtVerificarUsuario = mysqli_prepare($cn, $sqlVerificarUsuario);
        mysqli_stmt_bind_param($stmtVerificarUsuario, "ss", $email, $password);
        mysqli_stmt_execute($stmtVerificarUsuario);
        mysqli_stmt_store_result($stmtVerificarUsuario);

        // Si el usuario existe y las credenciales son correctas
        if (mysqli_stmt_num_rows($stmtVerificarUsuario) > 0) {
            // Obtiene el tipo de usuario
            $stmtVerificarUsuario -> bind_result($email, $idTipoUsuario);
            $stmtVerificarUsuario -> fetch();

            // Agrega el código específico para cada tipo de usuario
            switch ($idTipoUsuario) {
                case 2: // Alumno
                    $_SESSION["usuario_alumno"] = $email;
                    $_SESSION["auth"] = 1;
                    header("location: principal_alumno.php");
                    break;
                case 3: // Personal
                    $_SESSION["usuario_personal"] = $email;
                    $_SESSION["auth"] = 1;
                    header("location: principal_personal.php");
                    break;
                case 4: // Egresado
                    $_SESSION["usuario_egresado"] = $email;
                    $_SESSION["auth"] = 1;
                    header("location: principal_egresado.php");
                    break;
                case 5: // Institucion
                    $_SESSION["usuario_institucion"] = $email;
                    $_SESSION["auth"] = 1;
                    header("location: principal_institucion.php");
                    break;
                default:
                    // Manejo de error si el tipo de usuario no está definido
                    header("location: loginusuario.php");
                    break;
            }
        } else {
            // El usuario no existe o las credenciales son incorrectas
            header("location: loginusuario.php");
        }

        mysqli_close($cn);
    } else {
        // Redireccionar a la página de inicio de sesión si se intenta acceder directamente a este script
        header("location: loginusuario.php");
    }
?>
