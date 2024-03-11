<?php 
	include("auth.php");
	include("menu_egresado.php");
	include("conexion.php");
	$email = $_SESSION["usuario_egresado"];
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
        <link rel = "stylesheet" href = "CSS/Estiloegresado.css">
    </head>
    <body>
        <br>
        <form action = "p_actualizardatosegresado.php" method = "post" onsubmit = "return validarFormulario()">
            <table align = "center">
                <tr>
                    <td align = "center"><b>ESCUELA</b></td>
                    <td colspan = "2">
                        <select name = "lstescuela" id = "lstescuela">
                            <option value = "" disabled <?php if (empty($r["idescuela"])) echo 'selected';?>>Seleccione una escuela</option>
                            <?php
                                $sql = "SELECT * FROM tbescuela";
                                $idescuela = $r["idescuela"];
                                $result = mysqli_query($cn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $selected = ($idescuela == $row["idescuela"]) ? 'selected' : '';
                            ?>
                            <option value = "<?php echo $row["idescuela"];?>" <?php echo $selected;?>><?php echo $row["nombre"];?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align = "center"><b>FACULTAD</b></td>
                    <td colspan = "2">
                        <select name = "lstfacultad" id = "lstfacultad">
                            <option value = "" disabled <?php if (empty($r["idfacultad"])) echo 'selected'; ?>>Seleccione una facultad</option>
                            <?php
                                $sql = "SELECT * FROM tbfacultad";
                                $idfacultad = $r["idfacultad"];
                                $result = mysqli_query($cn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $selected = ($idfacultad == $row["idfacultad"]) ? 'selected' : '';
                            ?>
                            <option value = "<?php echo $row["idfacultad"];?>" <?php echo $selected;?>><?php echo $row["nombre"];?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr align = "center">
                    <td><b>AÑO DE INGRESO</b></td>
                    <td><b>MODALIDAD</b></td>
                    <td><b>GRADO</b></td>
                </tr>
                <tr>
                    <td>
                        <select name = "lstañoingreso" id = "lstañoingreso">
                            <?php
                                $año = 2000;
                                $añoactual = date('Y');
                                $semestres = array('I', 'II');
                                for ($i = 0; $i <= ($añoactual - $año); $i++) {
                                    foreach ($semestres as $semestre) {
                                        $periodo = $año + $i . '-' . $semestre;
                                        $selected = ($periodo == $r["yearingreso"]) ? 'selected' : '';
                            ?>
                            <option value = "<?php echo $periodo;?>"<?php echo $selected;?>><?php echo $periodo;?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name = "lstmodalidad" id = "lstmodalidad">
                            <option value = "" disabled <?php if (empty($r["modalidad"])) echo 'selected';?>>Seleccione una modalidad</option>
                            <?php
                                $modalidades = array('Ordinario', 'Especial', 'CPU');
                                foreach ($modalidades as $modalidad_option) {
                                    $selected = ($modalidad_option == $r["modalidad"]) ? 'selected' : '';
                            ?>
                            <option value = "<?php echo $modalidad_option;?>"<?php echo $selected;?>><?php echo $modalidad_option;?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name = "lstgrado" id = "lstgrado">
                            <option value = "" disabled <?php if (empty($r["ciclo_grado_nivel_nivel"])) echo 'selected';?>>Seleccione un grado</option>
                            <?php
                                $grados = array('Grado de Bachiller', 'Grado de Licenciatura', 'Grado de Maestría', 'Grado de Doctorado', 'Grado Técnico');
                                foreach ($grados as $grado_option) {
                                    $selected = ($grado_option == $r["ciclo_grado_nivel_nivel"]) ? 'selected' : '';
                            ?>
                            <option value = "<?php echo $grado_option;?>"<?php echo $selected;?>><?php echo $grado_option;?></option>
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
                var escuela = document.getElementById("lstescuela").value;
                var facultad = document.getElementById("lstfacultad").value;
                var añoIngreso = document.getElementById("lstañoingreso").value;
                var modalidad = document.getElementById("lstmodalidad").value;
                var ciclo = document.getElementById("lstgrado").value;

                // Verifica que no haya valores vacíos
                if (!escuela || !facultad || !añoIngreso || !modalidad || !ciclo) {
                    alert("Por favor, selecciona una opción para cada campo.");
                    return false;
                }

                // Verifica si la escuela pertenece a la facultad seleccionada
                if (!verificarRelacionEscuelaFacultad(facultad, escuela)) {
                    alert("La escuela seleccionada no pertenece a esa facultad.");
                    return false;
                }

                return true;
            }

            function verificarRelacionEscuelaFacultad(facultad, escuela) {
                // Definir las relaciones entre escuelas y facultades
                var relaciones = {
                    1: [1],  // Bromatología y Nutrición
                    2: [2, 3, 4, 5],  // Ciencias
                    3: [6, 7],
                    4: [8, 9, 10],
                    5: [11, 12, 13],
                    6: [14],
                    7: [15, 16, 17, 18, 19],
                    8: [20, 21, 22, 23],
                    9: [24],
                    10: [25, 26, 27, 28],
                    11: [29, 30],
                    12: [31, 32],
                    13: [33, 34],
                };

                // Verificar si la escuela pertenece a la facultad
                return relaciones[facultad] && relaciones[facultad].includes(parseInt(escuela));
            }
        </script>
    </body>
</html>