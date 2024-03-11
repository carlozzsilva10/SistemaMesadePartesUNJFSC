<?php 
	include("auth.php");
	include("menu_alumno.php");
	include("conexion.php");
	$email = $_SESSION["usuario_alumno"];
	$sql = "SELECT c.*, u.*, e.nombre AS nombre_escuela, f.nombre AS nombre_facultad FROM tbcliente c
                JOIN tbusuario u ON c.idcliente = u.idcliente
                LEFT JOIN tbescuela e ON c.idescuela = e.idescuela
                LEFT JOIN tbfacultad f ON c.idfacultad = f.idfacultad
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
        <link rel = "stylesheet" href = "CSS/Estiloalumno.css">
    </head>
    <body>
        <br>
        <form action = "p_enviartramitealumno.php" method = "post" enctype = "multipart/form-data" onsubmit = "return validarFormulario()">
            <table align = "center">
                <tr>
                    <td align = "center"><b>ASUNTO</b></td>
                    <td>
                        <select name = "lstasunto" id = "lstasunto">
                            <option value = "" disabled selected>Seleccione un asunto</option>
                            <?php
                                $sql = "SELECT * FROM tbasunto WHERE idtipousuario = 2";
                                $fila = mysqli_query($cn, $sql);
                                while ($r = mysqli_fetch_assoc($fila)) {  
                            ?>
                            <option value = "<?php echo $r["idasunto"];?>"><?php echo $r["nombre"];?></option>
                            <?php
                                } 
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align = "center"><b>AUTORIDAD/DEPENDENCIA</b></td>
                    <td>
                        <select name = "lstdependencia" id = "lstdependencia">
                            <option value = "" disabled selected>Seleccione una autoridad o dependencia</option>
                            <?php
                                $sql = "SELECT * FROM tbdependencia";
                                $fila = mysqli_query($cn, $sql);
                                while ($r = mysqli_fetch_assoc($fila)) {  
                            ?>
                            <option value = "<?php echo $r["iddependencia"];?>"><?php echo $r["nombre"];?></option>
                            <?php
                                } 
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><b>DESCRIPCIÓN</b></td>
                    <td><textarea name = "txtdescripcion" cols = "20" rows = "2" placeholder = "Descripción"></textarea></td></td>
                </tr>
                <tr>
                    <td><b>ADJUNTAR ARCHIVOS SOLO (.pdf)</b></td>
                    <td><input type = "file" name = "archivo"></td>
                </tr>
            </table>
            <br>
            <center>
                <input type = "submit" value = "Enviar trámite">
            </center>  
        </form>
        <script>
            function validarFormulario() {
                var asunto = document.getElementById("lstasunto").value;
                var dependencia = document.getElementById("lstdependencia").value;
                var descripcion = document.getElementsByName("txtdescripción")[0].value;
                var archivo = document.getElementsByName("archivo")[0].value;

                if (asunto === "" || dependencia === "" || descripcion === "" || archivo === "") {
                    alert("Por favor, complete todos los campos y seleccione un archivo.");
                    return false;
                }

                // Verificar la extensión del archivo
                var extension = archivo.substring(archivo.lastIndexOf(".") + 1).toLowerCase();
                if (extension !== "pdf") {
                    alert("Por favor, seleccione un archivo con extensión PDF.");
                    return false;
                }

                return true;
            }
        </script>
    </body>
</html>