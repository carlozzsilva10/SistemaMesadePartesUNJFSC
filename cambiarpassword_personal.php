<?php 
	include("auth.php");
	include("menu_personal.php");
	include("conexion.php");
	$email = $_SESSION["usuario_personal"];
	$sql = "SELECT c.*, u.*, f.nombre AS nombre_facultad, con.nombre AS nombre_condicion, cat.nombre AS nombre_categoria, car.nombre AS nombre_cargo FROM tbcliente c
                JOIN tbusuario u ON c.idcliente = u.idcliente
                LEFT JOIN tbfacultad f ON c.idfacultad = f.idfacultad
                LEFT JOIN tbcondicion con ON c.idcondicion = con.idcondicion
                LEFT JOIN tbcategoria cat ON c.idcategoria = cat.idcategoria
                LEFT JOIN tbcargo car ON c.idcargo = car.idcargo
                WHERE u.email = '$email'";
	$fila = mysqli_query($cn,$sql);
	$r = mysqli_fetch_assoc($fila);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title></title>
        <link rel = "stylesheet" href = "CSS/Estilopersonal.css">
    </head>
    <body>
        <br>
        <form action = "p_cambiarpasswordpersonal.php" method = "post" onsubmit = "return validarFormulario()">
            <table align = "center">
                <tr>
                    <td><b>INGRESAR CONTRASEÑA ACTUAL</b></td>
                    <td><input type = "password" name = "txtpwdpassactual" id = "txtpwdpassactual"></td>
                </tr>
                <tr>
                    <td><b>INGRESAR NUEVA CONTRASEÑA</b></td>
                    <td><input type = "password" name = "txtpwdpassnuevo" id = "txtpwdpassnuevo"></td>
                </tr>
                <tr>
                    <td><b>REPETIR NUEVA CONTRASEÑA</b></td>
                    <td><input type = "password" name = "txtpwdrepass" id = "txtpwdrepass"></td>
                </tr>
            </table>
            <br>
            <center>
                <input type = "submit" value = "Cambiar contraseña">
            </center>
        </form>
        <script>
            function validarFormulario() {
                var passActual = document.getElementById("txtpwdpassactual").value;
                var passNuevo = document.getElementById("txtpwdpassnuevo").value;
                var passRepetido = document.getElementById("txtpwdrepass").value;

                // Verificar campos vacíos
                if (!passActual || !passNuevo || !passRepetido) {
                    alert("Por favor, completa todos los campos.");
                    return false;
                }

                // Verificar si la contraseña actual es correcta (puedes adaptar aquí la lógica)
                // Supongamos que la contraseña actual está almacenada en la variable PHP $passwordActual
                var passwordActualPHP = "<?php echo $r['password']; ?>";

                if (passActual !== passwordActualPHP) {
                    alert("La contraseña actual no es correcta.");
                    return false;
                }

                // Verificar si las nuevas contraseñas coinciden
                if (passNuevo !== passRepetido) {
                    alert("Las nuevas contraseñas no coinciden.");
                    return false;
                }

                // Cambio de contraseña exitoso
                alert("Cambio de contraseña exitoso.");
                return true;
            }
        </script>
    </body>
</html>