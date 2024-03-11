<?php
    include("../config/conexion.php");
    include("../config/auth.php");

    // La localidad del servidor
    setlocale(LC_ALL, "es_PE");

    // La zona horaria
    ini_set('date.timezone', 'America/Lima');

    // Obtener el id del tramite
    $id = $_GET["id"];

    // Obtener el idcliente del tramite
    $queryCliente = "SELECT idcliente FROM tbtramite WHERE nrotramite = '$id'";
    $resultadoCliente = mysqli_query($cn, $queryCliente);

    if ($rowCliente = mysqli_fetch_assoc($resultadoCliente)) {
        // Obtener el idcliente real
        $idcliente = $rowCliente['idcliente'];

        $estado = "Recepcionado";

        // Actualizar el estado en tbtramite
        $sql = "UPDATE tbtramite SET estado = '$estado' WHERE nrotramite = '$id'";
        mysqli_query($cn, $sql);

        // Insertar en tbdetalletramite con el idcliente
        $sql1 = "INSERT INTO tbdetalletramite (idcliente, tramite, estado) VALUES ('$idcliente','$id','$estado')";
        mysqli_query($cn, $sql1);

        // Redireccionar
        header('location: ../view/expedientesNA.php');
    } else {
        // Manejo de error si no se encuentra el idcliente
        echo "Error: No se pudo obtener el idcliente.";
    }
?>
