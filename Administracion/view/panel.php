<?php
    include("../config/auth.php");
    include("../config/conexion.php");
    $codigo = $_SESSION["usuario"];
    $sql = "SELECT * FROM tbadministrador WHERE codadministrador = '$codigo'";
    $fila = mysqli_query($cn, $sql);
    $r = mysqli_fetch_assoc($fila);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
        <title>
            Administración
        </title>
        <link rel = "icon" href = "../asset/img/unjfsc_insignia.png">
        <link rel = "stylesheet" href = "../asset/css/style.css">
        <script src = "https://kit.fontawesome.com/7b0ec4edc6.js" crossorigin = "anonymous"></script>
        <style>
            .sidebar {
                position: fixed;
            }
        </style>
    </head>
    <body>
        <div class = "sidebar">
            <div class = "top">
                <div class = "logo">
                    <i class = "fa-solid fa-user-tie"></i>
                    <span>Panel Administrativo</span>
                </div>
                <i class = "fa-solid fa-bars" id = "btn"></i>
            </div>
            <div class = "user">
                <img src = "../asset/img/<?php echo $codigo;?>.jpg" alt = "logo" class = "user-img">
                <div>
                    <p class = "bold"><?php echo $r["nombres"];?></p>
                    <P>Administrador</P>
                </div>
            </div>
            <ul>
                <li>
                    <a href = "principal.php">
                        <i class = "fa-solid fa-house"></i>
                        <span class = "nav-item">Inicio</span>
                    </a>
                    <span class = "tooltip">Inicio</span>
                </li>
                <li>
                    <a href = "actualizar_info.php">
                        <i class = "fa-solid fa-rotate-right"></i>
                        <span class = "nav-item">Actualizar</span>
                    </a>
                    <span class = "tooltip">Actualizar</span>
                </li>
                <li>
                    <?php
                        $sql1 = "SELECT * FROM tbadministrador WHERE codadministrador = '$codigo' AND iddependencia = 11";
                        $fila = mysqli_query($cn, $sql1);
                        if (mysqli_num_rows($fila) == null) {
                    ?>
                    <a href = "busquedaA.php" target = "_parent">
                        <i class = "fa-solid fa-magnifying-glass"></i>
                        <span class = "nav-item">Búsqueda</span>
                    </a>
                    <span class = "tooltip">Búsqueda</span>
                    <?php
                        } else {
                    ?>
                    <a href = "busqueda.php" target = "_parent">
                        <i class = "fa-solid fa-magnifying-glass"></i>
                        <span class = "nav-item">Búsqueda</span>
                    </a>
                    <span class = "tooltip">Búsqueda</span>
                    <?php
                        }
                    ?>
                </li>
                <li>
                    <a href = "expedientes.php">
                        <i class = "fa-solid fa-file"></i>
                        <span class = "nav-item">Expedientes</span>
                    </a>
                    <span class="tooltip">Expedientes</span>
                </li>
                <li>
                    <?php
                        $sql1 = "SELECT * FROM tbadministrador WHERE codadministrador = '$codigo' AND iddependencia = 11";
                        $fila = mysqli_query($cn, $sql1);
                        if (mysqli_num_rows($fila) == null) {
                    ?>
                    <a href = "reportesA.php">
                        <i class = "fa-solid fa-file-lines"></i>
                        <span class = "nav-item">Reportes</span>
                    </a>
                    <span class = "tooltip">Reportes</span>
                    <?php
                        } else {
                    ?>
                    <a href = "reportes.php">
                        <i class = "fa-solid fa-file-lines"></i>
                        <span class = "nav-item">Reportes</span>
                    </a>
                    <span class="tooltip">Reportes</span>
                    <?php
                        }
                    ?>
                </li>
                <li></li>
                <li>
                    <a href = "../controller/cerrarsesion.php">
                        <i class = "fa-solid fa-arrow-right-from-bracket"></i>
                        <span class = "nav-item">Salir</span>
                    </a>
                    <span class = "tooltip">Salir</span>
                </li>
            </ul>
        </div>
        <script>
            let btn = document.querySelector('#btn');
            let sidebar = document.querySelector('.sidebar');

            btn.onclick = function() {
                sidebar.classList.toggle('active');
            };
        </script>
    </body>
</html>