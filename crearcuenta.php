<?php
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title>
            Crear Cuenta
        </title>
        <link rel = "icon" href = "img/unjfsc_insignia.png">
        <link rel = "stylesheet" href = "CSS/Estilocrear.css">
    </head>
    <body>
        <div id = "cabecera">
            <img src = "img/unjfsc_logotipo.png" alt = "logo" height = "160px">
        </div>
        <form action = "p_crearcuenta.php" method = "post" id = "formulario">
            <h2>
                CREACIÓN DE USUARIO
            </h2>
            <table>
                <tr>
                    <td><b>TIPO DE USUARIO:*</b></td>
                    <td>
                        <select name = "lsttipous" id = "lsttipous" required onchange = "toggleCampos()">
                            <option value = "" disabled selected>Seleccione un tipo de usuario</option>
                            <?php
                                $sql = "SELECT * FROM tbtipousuario WHERE idtipousuario != 1";
                                $fila = mysqli_query($cn, $sql);
                                while ($r = mysqli_fetch_assoc($fila)) {  
                            ?>
                            <option value = "<?php echo $r["idtipousuario"];?>"><?php echo $r["nomtipous"];?></option>
                            <?php
                                } 
                            ?>
                        </select>
                    </td>
                    <td><b>TIPO DE DOCUMENTO:*</b></td>
                    <td>
                        <select name = "lsttipodoc" disabled>
                            <option value = "" disabled selected>Seleccione un tipo de documento</option>
                            <?php
                                $sql = "SELECT * FROM tbtipodocumento";
                                $fila = mysqli_query($cn, $sql);
                                while ($r = mysqli_fetch_assoc($fila)) {  
                            ?>
                            <option value = "<?php echo $r["idtipodocumento"];?>"><?php echo $r["nomtipodoc"];?></option>
                            <?php
                                } 
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><b>N° DE DOCUMENTO:*</b></td>
                    <td><input type = "text" name = "txtnrodoc" maxlength = "12" placeholder = "Nro de documento" required autocomplete = "off" disabled ></td>
                    <td><b>CÓDIGO:</b></td>
                    <td><input type = "text" name = "txtcodigo" maxlength = "10" placeholder = "Código" required autocomplete = "off" disabled></td>
                </tr>
                <tr>
                    <td><b>RAZÓN SOCIAL:</b></td>
                    <td><input type = "text" name = "txtrazonsocial" placeholder = "Razón social" required autocomplete = "off" disabled></td>
                    <td><b>APELLIDO PATERNO:</b></td>
                    <td><input type = "text" name = "txtappaterno" placeholder = "Apellido paterno" required autocomplete = "off" disabled></td>
                </tr>
                <tr>
                    <td><b>APELLIDO MATERNO:</b></td>
                    <td><input type = "text" name = "txtapmaterno" placeholder = "Apellido materno" required autocomplete = "off" disabled></td>
                    <td><b>NOMBRES:</b></td>
                    <td><input type = "text" name = "txtnombres" placeholder = "Nombres" required autocomplete = "off" disabled></td>
                </tr>
                <tr>
                    <td><b>DIRECCIÓN:*</b></td>
                    <td><input type = "text" name = "txtdireccion" placeholder = "Dirección" required autocomplete = "off" disabled></td>
                    <td><b>REFERENCIA:*</b></td>
                    <td><textarea name = "txtreferencia" cols = "20" rows = "2" placeholder = "Referencia" disabled></textarea></td></td>
                </tr>
                <tr>
                    <td><b>DISTRITO:*</b></td>
                    <td><input type = "text" name = "txtdistrito" placeholder = "Distrito" required autocomplete = "off" disabled></td>
                    <td><b>EMAIL:*</b></td>
                    <td><input type = "email" name = "txtemail" placeholder = "Email" required autocomplete = "off" disabled></td>
                </tr>
                <tr>
                    <td><b>TELÉFONO:*</b></td>
                    <td><input type = "text" name = "txttelefono" maxlength = "7" placeholder = "Teléfono" required autocomplete = "off" disabled></td>
                    <td><b>CELULAR:*</b></td>
                    <td><input type = "text" name = "txtcelular" maxlength = "9" placeholder = "Celular" required autocomplete = "off" disabled></td>
                </tr>
                <tr>
                    <td><b>CONTRASEÑA:*</b></td>
                    <td><input type = "password" name = "txtpassword" maxlength = "8" placeholder = "Contraseña" disabled></td>
                    <td><b>CONFIRMAR CONTRASEÑA:*</b></td>
                    <td><input type = "password" name = "txtpasswordrep" maxlength = "8" placeholder = "Contraseña" disabled></td>
                </tr>
            </table>
            <br>
            <center>
                <input type = "submit" value = "Crear Usuario">
            </center>
        </form>
        <script>
            // Función para habilitar/deshabilitar campos según el tipo de usuario
            function toggleCampos() {
                var tipoUsuario = document.getElementById("lsttipous").value;
                var camposAlumno = ["lsttipodoc", "txtnrodoc", "txtcodigo", "txtappaterno", "txtapmaterno", "txtnombres", "txtdireccion", "txtreferencia", "txtdistrito", "txtemail", "txttelefono", "txtcelular", "txtpassword", "txtpasswordrep"];
                var camposInstitucion = ["lsttipodoc", "txtnrodoc", "txtrazonsocial", "txtdireccion", "txtreferencia", "txtdistrito", "txtemail", "txttelefono", "txtcelular", "txtpassword", "txtpasswordrep"];
                var campoTipoDocumento = document.getElementsByName("lsttipodoc")[0];

                // Deshabilitar todos los campos
                var todosCampos = camposAlumno.concat(camposInstitucion);
                todosCampos.forEach(function (campo) {
                    var elementos = document.getElementsByName(campo);
                    elementos.forEach(function (elemento) {
                        elemento.disabled = true;
                    });
                });

                // Mostrar todas las opciones de tipo de documento
                Array.from(campoTipoDocumento.options).forEach(function (option) {
                    option.style.display = 'block';
                });

                // Habilitar campos según el tipo de usuario seleccionado
                if (tipoUsuario === "2" || tipoUsuario === "3" || tipoUsuario === "4") {
                    camposAlumno.forEach(function (campo) {
                        var elementos = document.getElementsByName(campo);
                        elementos.forEach(function (elemento) {
                            elemento.disabled = false;
                        });
                    });

                    // Ocultar la opción de "RUC" para Alumno, Personal o Egresado
                    Array.from(campoTipoDocumento.options).forEach(function (option) {
                        if (option.value === "4") { // "4" es el valor de RUC
                            option.style.display = 'none';
                        }
                    });

                    campoTipoDocumento.disabled = false;
                } else if (tipoUsuario === "5") {
                    camposInstitucion.forEach(function (campo) {
                        var elementos = document.getElementsByName(campo);
                        elementos.forEach(function (elemento) {
                            elemento.disabled = false;
                        });

                        // Establecer automáticamente el tipo de documento como "4" (RUC) para Institución
                        campoTipoDocumento.value = "4";
                    });

                    // Ocultar todas las opciones excepto "RUC" para Institución
                    Array.from(campoTipoDocumento.options).forEach(function (option) {
                        if (option.value !== "4") {
                            option.style.display = 'none';
                        }
                    });
                }
            }

            // Función para verificar si las contraseñas coinciden y si no hay campos vacíos
            function verificarContraseñas() {
                if (!verificarCamposVacios()) {
                    alert("Por favor, complete todos los campos.");
                    return false;
                }

                var password = document.getElementsByName("txtpassword")[0].value;
                var passwordRep = document.getElementsByName("txtpasswordrep")[0].value;

                if (password !== passwordRep) {
                    alert("Las contraseñas no coinciden. Por favor, verifíquelas.");
                    return false;
                }

                alert("¡Registro exitoso! Tu cuenta ha sido creada correctamente.");

                return true;
            }

            // Función para verificar campos vacíos en campos habilitados
            function verificarCamposVacios() {
                var tipoUsuario = document.getElementById("lsttipous").value;
                var camposHabilitados = tipoUsuario === "5" ? ["lsttipodoc", "txtnrodoc", "txtrazonsocial", "txtdireccion", "txtdistrito", "txtemail", "txtcelular", "txtpassword", "txtpasswordrep"] : ["lsttipodoc", "txtnrodoc", "txtcodigo", "txtappaterno", "txtapmaterno", "txtnombres", "txtdireccion", "txtdistrito", "txtemail", "txtcelular", "txtpassword", "txtpasswordrep"];

                for (var i = 0; i < camposHabilitados.length; i++) {
                    var valorCampo = document.getElementsByName(camposHabilitados[i])[0].value;
                    if (valorCampo.trim() === "") {
                        return false; // Hay campos vacíos
                    }
                }

                return true; // No hay campos vacíos
            }

            // Asignar la función verificarContraseñas al evento onsubmit del formulario
            document.getElementById("formulario").onsubmit = function () {
                return verificarContraseñas();
            };
        </script>
    </body>
</html>