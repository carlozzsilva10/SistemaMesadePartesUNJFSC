<?php
    include("panel.php");
    include("../config/auth.php");
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title></title>
        <style>
            .main-content {
                position: relative;
                min-height: 100vh;
                top: 0;
                left: 80px;
                transition: all 0.5s ease;
                width: calc(100% - 80px);
                padding: 1rem;
            }

            .card-container {
                display: flex;
                flex-direction: row;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 40px;
            }

            .card {
                width: 300px;
                background-color: black;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0px 2px 4px rgba(0, 0, 0.2);
                margin: 10px 20px;
            }

            .card i {
                padding-top: 10px;
                color: #f0f0f0;
            }

            .card-content {
                padding: 16px;
            }

            .card-content h3 {
                font-size: 28px;
                margin-bottom: 8px;
                color: #f0f0f0;
            }

            .card-content .btn {
                display: inline-block;
                padding: 8px 16px;
                background-color: #333;
                text-decoration: none;
                border-radius: 4px;
                margin-top: 16px;
                color: #f0f0f0;
            }
        </style>
    </head>
    <body>
        <div class = "main-content" style = "padding: 0; background-color: #D1F2EB;">
            <div class = "container">
                <div style = "padding-bottom: 150px;">
                    <nav style = "background-color: #12171e; float: right; width: 100%;">
                        <img src = "../asset/img/UNJFSC.png" width = "400px" style = "float: right; padding-right: 20px;">
                    </nav>
                </div>
                <div class = "card-container">
                    <?php
                        $sql1 = "SELECT * FROM tbadministrador WHERE codadministrador = '$codigo' AND iddependencia = 11";
                        $fila = mysqli_query($cn, $sql1);
                        if (mysqli_num_rows($fila) == null) {
                    ?>
                        <div class = "card">
                            <center>
                                <i class = "fa-solid fa-folder" style = "font-size: 150px;"></i>
                                <div class = "card-content">
                                    <h3>
                                        Expedientes no Atendidos
                                    </h3>
                                    <a href = "expedientesNA_area.php" class = "btn">Ir</a>
                                </div>
                            </center>
                        </div>
                        <div class = "card">
                            <center>
                                <i class = "fa-regular fa-folder-open" style = "font-size: 150px;"></i>
                                <div class = "card-content">
                                    <h3>
                                        Expedientes en Proceso
                                    </h3>
                                    <a href = "expedientesP_area.php" class = "btn">Ir</a>
                                </div>
                            </center>
                        </div>
                        <div class = "card">
                            <center>
                                <i class = "fa-solid fa-folder-open" style = "font-size: 150px;"></i>
                                <div class = "card-content">
                                    <h3>
                                        Expedientes Atendidos
                                    </h3>
                                    <a href = "expedientesA_area.php" class = "btn">Ir</a>
                                </div>
                            </center>
                        </div>
                    <?php
                        } else {
                    ?>
                        <div class = "card">
                            <center>
                                <i class = "fa-solid fa-folder-open" style = "font-size: 150px;"></i>
                                <div class = "card-content">
                                    <h3>
                                        Expedientes Atendidos
                                    </h3>
                                    <a href = "expedientesA.php" class = "btn">Ir</a>
                                </div>
                            </center>
                        </div>
                        <div class = "card">
                            <center>
                                <i class = "fa-solid fa-folder" style = "font-size: 150px;"></i>
                                <div class = "card-content">
                                    <h3>
                                        Expedientes no Atendidos
                                    </h3>
                                    <a href = "expedientesNA.php" class = "btn">Ir</a>
                                </div>
                            </center>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>