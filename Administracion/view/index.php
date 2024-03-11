<?php
    include("../config/conexion.php");
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title>
            Mesa de Partes Virtual Administrativos 2023
        </title>
        <link rel = "icon" href = "../asset/img/unjfsc_insignia.png">
        <link rel = "stylesheet" href = "../asset/css/styleadmin.css">
    </head>
    <body>
        <section>
            <div class = "contenedor">
                <div class = "formulario">
                    <form action = "../controller/p_index.php" method = "post">
                        <div class = "login-box">
                            <img src = "../asset/img/unjfsc_insignia.png" alt = "UNJFSC - Logo">
                        </div>
                        <br>
                        <h2>
                            ADMINISTRATIVOS - 2023
                        </h2>
                        <div class = "input-contenedor">
                            <i class = "fa-solid fa-envelope"></i>
                            <input type = "text" name = "txtcodigo" maxlength = "10" autocomplete = "off" required>
                            <label for = "#">Código Administrativo</label>
                        </div>
                        <div class = "input-contenedor">
                            <i class = "fa-solid fa-lock"></i>
                            <input type = "password" name = "txtpassword" autocomplete = "off" required>
                            <label for = "contraseña">Contraseña</label>
                        </div>
                        <div align = "center">
                            <input type = "checkbox" id = "show-password">
                            <label for = "show-password" style = "color:white">Mostrar contraseña</label>
                        </div>
                        <br>
                        <div align = "center">
                            <select class = "select" name = "lstarea" required>
                                <option value = "" hidden>Selecciona una Dependencia</option>
                                <?php
                                    $sql = "SELECT * FROM tbdependencia";
                                    $dependencia_id = $r["iddependencia"];
                                    $result = mysqli_query($cn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = ($dependencia_id == $row["iddependencia"]) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $row["iddependencia"]; ?>" <?php echo $selected; ?>><?php echo $row["nombre"];?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <br><br>
                        </div>
                        <div align = "center">
                            <input type = "submit" value = "Iniciar Sesión" class = "btn">
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </section>
        <script>
            const passwordInput = document.querySelector('input[name="txtpassword"]');
            const showPasswordCheckbox = document.querySelector('#show-password');

            showPasswordCheckbox.addEventListener('change', (e) => {
                if (e.target.checked) {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });
        </script>
    </body>
</html>