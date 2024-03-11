<?php 
	include("auth.php");
	include("menu_institucion.php");
	include("conexion.php");
	$email = $_SESSION["usuario_institucion"];
	$sql = "SELECT c.*, u.* FROM tbcliente c, tbusuario u WHERE c.idcliente = u.idcliente AND c.email = '$email'";
	$fila = mysqli_query($cn,$sql);
	$r = mysqli_fetch_assoc($fila);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title></title>
        <link rel = "stylesheet" href = "CSS/Estiloinstitucion.css">
    </head>
    <body>
        <br>
        <form action = "p_actualizardatosinstitucion.php" method = "post" onsubmit = "return validarFormulario()">
            <table align = "center">
                <tr>
                    <td align = "center"><b>NIVEL</b></td>
                    <td colspan = "2">
                        <select name = "lstnivel" id = "lstnivel">
                            <option value = "" disabled <?php if (empty($r["ciclo_grado_nivel"])) echo 'selected';?>>Seleccione un nivel</option>
                            <?php
                                $niveles = array('Publico', 'Privado', 'Mixto');
                                foreach ($niveles as $nivel) {
                                    $selected = ($nivel == $r["ciclo_grado_nivel"]) ? 'selected' : '';
                            ?>
                            <option value = "<?php echo $nivel;?>"<?php echo $selected;?>><?php echo $nivel;?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <center>
                <input type = "submit" value = "Actualizar datos">
            </center>
        </form>
        <script>
            function validarFormulario() {
                var ciclo = document.getElementById("lstnivel").value;

                // Verifica que no haya valores vacíos
                if (!ciclo) {
                    alert("Por favor, selecciona una opción para cada campo.");
                    return false;
                }
            }
        </script>
    </body>
</html>