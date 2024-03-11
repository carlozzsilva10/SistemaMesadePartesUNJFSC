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
    $fila = mysqli_query($cn, $sql);
    $r = mysqli_fetch_assoc($fila);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title></title>
        <link rel = "stylesheet" href = "CSS/Estiloalumno.css">
        <style>
            #resultado {
                border: 1px solid #00539C;
                padding: 20px;
                width: 40%;
                background-color: rgba(255, 255, 255, 0.8);
                text-align: center;
                margin: auto;
            }

            p {
                color: #40C4FF;
                -webkit-text-stroke-width: 1px;
                -webkit-text-stroke-color: #000000;
                margin: 10px 0;
                display: inline-block; /* Hacer que el párrafo y el botón se muestren en línea */
            }

            a.button {
                background-color: #45bceb;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                display: inline-block; /* Hacer que el botón se muestre en línea */
            }

            a.button:hover {
                background-color: rgb(11, 87, 230);
            }
        </style>
    </head>
    <body>
        <br>
        <div id = "resultado">
            <h1>
                Trámite Registrado Exitosamente
            </h1>
            <p>Número de Trámite: <?php echo $_GET['nrotramite'];?></p>&nbsp;&nbsp;&nbsp;
            <p>Contraseña: <?php echo $_GET['password']; ?></p>
            <p>Para darle seguimiento a tu trámite da clic aquí:</p>
            <br>
            <a href = "consultartramite.php" class = "button">Consultar Trámite</a>
        </div>
        <br>
        <center>
            <a href = "enviartramite_alumno.php" class = "button">Volver</a>
        </center>
    </body>
</html>
