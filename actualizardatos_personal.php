<?php 
	include("auth.php");
	include("menu_personal.php");
	include("conexion.php");
	$email = $_SESSION["usuario_personal"];
    $sql = "SELECT c.*, u.*, ca.* FROM tbcliente c
                INNER JOIN tbusuario u ON c.idcliente = u.idcliente 
                LEFT JOIN tbcargo ca ON c.idcargo = ca.idcargo
                WHERE c.email = '$email'";
	$fila = mysqli_query($cn,$sql);
	if ($fila) {
        $r = mysqli_fetch_assoc($fila);
    } else {
        // Manejo de error si la consulta no es exitosa
        echo "Error en la consulta: " . mysqli_error($cn);
    }
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
        <form action = "p_actualizardatospersonal.php" method = "post" onsubmit = "return validarFormulario()">
            <table align = "center">
                <tr>
                    <td align = "center"><b>CONDICIÓN:</b></td>
                    <td colspan = "2">
                        <select name = "lstcondicion" id = "lstcondicion" onchange = "habilitarCampos()">
                        <option value = "" disabled <?php if (empty($r["idcondicion"])) echo 'selected';?>>Seleccione un cargo</option>
                        <?php
                            $sql = "SELECT * FROM tbcondicion";
                            $idcondicion = $r["idcondicion"];
                            $fila = mysqli_query($cn, $sql);
                            while ($row = mysqli_fetch_assoc($fila)) {
                                $selected = ($idcondicion == $row["idcondicion"]) ? 'selected' : '';
                        ?>
                        <option value = "<?php echo $row["idcondicion"];?>"<?php echo $selected;?>><?php echo $row["nombre"];?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align = "center"><b>CARGO:</b></td>
                    <td colspan = "2">
                        <select name = "lstcargo" id = "lstcargo" disabled>
                            <option value = "" disabled <?php if (empty($r["idcargo"])) echo 'selected';?>>Seleccione un cargo</option>
                            <?php
                                $sql = "SELECT * FROM tbcargo";
                                $idcargo = $r["idcargo"];
                                $fila = mysqli_query($cn, $sql);
                                while ($row = mysqli_fetch_assoc($fila)) {
                                    $selected = ($idcargo == $row["idcargo"]) ? 'selected' : '';
                            ?>
                            <option value = "<?php echo $row["idcargo"];?>"<?php echo $selected;?>><?php echo $row["nombre"];?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align = "center"><b>FACULTAD</b></td>
                    <td colspan = "2">
                        <select name = "lstfacultad" id = "lstfacultad" disabled>
                            <option value = "" disabled <?php if (empty($r["idfacultad"])) echo 'selected'; ?>>Seleccione una facultad</option>
                            <?php
                                $sql = "SELECT * FROM tbfacultad";
                                $idfacultad = $r["idfacultad"];
                                $fila = mysqli_query($cn, $sql);
                                while ($row = mysqli_fetch_assoc($fila)) {
                                    $selected = ($idfacultad == $row["idfacultad"]) ? 'selected' : '';
                            ?>
                            <option value = "<?php echo $row["idfacultad"];?>"<?php echo $selected;?>><?php echo $row["nombre"];?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr align = "center">
                    <td><b>AÑO DE INGRESO</b></td>
                    <td><b>GRADO</b></td>
                    <td><b>CATEGORÍA</b></td>
                </tr>
                <tr>
                    <td>
                        <select name="lstañoingreso" id = "lstañoingreso" disabled>
                            <?php
                                $añoInicial = 1970;
                                $añoActual = date('Y');

                                for ($año = $añoInicial; $año <= $añoActual; $año++) {
                                    $periodo = $año;
                                    $selected = ($periodo == $r["yearingreso"]) ? 'selected' : '';

                                    echo "<option value=\"$periodo\" $selected>$periodo</option>";
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name = "lstgrado" id = "lstgrado" disabled>
                            <option value = "" disabled <?php if (empty($r["ciclo_grado_nivel"])) echo 'selected';?>>Seleccione un grado</option>
                            <?php
                                $grados = array('Grado de Bachiller', 'Grado de Licenciatura', 'Grado de Maestría', 'Grado de Doctorado', 'Grado Técnico');
                                foreach ($grados as $grado_option) {
                                    $selected = ($grado_option == $r["ciclo_grado_nivel"]) ? 'selected' : '';
                            ?>
                            <option value = "<?php echo $grado_option;?>"<?php echo $selected;?>><?php echo $grado_option;?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name = "lstcategoria" id = "lstcategoria" disabled>
                            <option value = "" disabled <?php if (empty($r["idcategoria"])) echo 'selected';?>>Seleccione una categoría</option>
                            <?php
                                $sql = "SELECT * FROM tbcategoria";
                                $idcategoria = $r["idcategoria"];
                                $fila = mysqli_query($cn, $sql);
                                while ($r = mysqli_fetch_assoc($fila)) {
                                    $selected = ($idcategoria == $r["idcategoria"]) ? 'selected' : '';
                            ?>
                            <option value = "<?php echo $r["idcategoria"];?>"<?php echo $selected;?>><?php echo $r["nombre"];?></option>
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
                var lstcondicion = document.getElementById("lstcondicion");
                var lstcargo = document.getElementById("lstcargo");
                var lstcategoria = document.getElementById("lstcategoria");
                var lstfacultad = document.getElementById("lstfacultad");
                var lstañoingreso = document.getElementById("lstañoingreso");
                var lstgrado = document.getElementById("lstgrado");

                var selectedCondicion = lstcondicion.options[lstcondicion.selectedIndex].value;

                // Validar según la condición seleccionada
                if ((selectedCondicion === '1' || selectedCondicion === '2') && !lstcategoria.disabled && !lstcategoria.value) {
                    alert("Por favor, seleccione una categoría.");
                    return false;
                }

                if (!lstcargo.value || !lstfacultad.value || !lstañoingreso.value || !lstgrado.value) {
                    alert("Por favor, complete todos los campos.");
                    return false;
                }

                // Resto del código de envío del formulario si todo está bien
                return true;
            }
            
            function habilitarCampos() {
                var lstcondicion = document.getElementById("lstcondicion");
                var lstcargo = document.getElementById("lstcargo");
                var lstcategoria = document.getElementById("lstcategoria");
                var lstfacultad = document.getElementById("lstfacultad");
                var lstañoingreso = document.getElementById("lstañoingreso");
                var lstgrado = document.getElementById("lstgrado");

                // Obtén el valor seleccionado en lstcondicion
                var selectedCondicion = lstcondicion.options[lstcondicion.selectedIndex].value;

                // Habilita o deshabilita campos según la condición seleccionada
                if (selectedCondicion === '1' || selectedCondicion === '2') {
                    // Administrativo Contratado o Administrativo Nombrado
                    lstcargo.disabled = false;
                    lstcategoria.disabled = true;

                    // Llena lstcargo con todos los cargos excepto 12 Docente
                    llenarCargosExceptoDocente();
                } else if (selectedCondicion === '3' || selectedCondicion === '4') {
                    // Docente Contratado o Docente Nombrado
                    lstcargo.disabled = false;
                    lstcategoria.disabled = false;

                    // Llena lstcargo solo con 12 Docente
                    llenarSoloDocente();
                }

                // Habilita o deshabilita otros campos según la lógica necesaria
                lstfacultad.disabled = false; // Ejemplo: facultad siempre habilitado
                lstañoingreso.disabled = false; // Ejemplo: año de ingreso siempre habilitado
                lstgrado.disabled = false; // Ejemplo: grado siempre habilitado
            }

            function llenarCargosExceptoDocente() {
                lstcargo.innerHTML = `
                    <option value = "1">Decano</option>
                    <option value = "2">Director de Asuntos Estudiantiles</option>
                    <option value = "3">Director de Comunicación y Relaciones Públicas</option>
                    <option value = "4">Director de Departamento</option>
                    <option value = "5">Director de Escuela</option>
                    <option value = "6">Director de Extensión</option>
                    <option value = "7">Director de Investigación</option>
                    <option value = "8">Director de Planificación y Desarrollo</option>
                    <option value = "9">Director de Recursos Humanos</option>
                    <option value = "10">Director de Tecnologías de la Información</option>
                    <option value = "11">Director General de Administración</option>
                    <option value = "13">Gerente Administrativo</option>
                    <option value = "14">Rector</option>
                    <option value = "15">Secretario Académico</option>
                    <option value = "16">Vicerrector</option>
                `;
            }

            function llenarSoloDocente() {
                // Código para llenar lstcargo solo con 12 Docente
                lstcargo.innerHTML = `
                    <option value = "12">Docente</option>
                `;
            }
        </script>
    </body>
</html>