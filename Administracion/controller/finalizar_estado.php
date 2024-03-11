<?php
    include("../config/conexion.php");
    include("../config/auth.php");

    // La localidad del servidor
    setlocale(LC_ALL, "es_PE");

    // La zona horaria
    ini_set('date.timezone', 'America/Lima');

    $id = $_GET["id"];

    // Obtener el idcliente de tbtramite
    $sqlGetIdCliente = "SELECT idcliente FROM tbtramite WHERE nrotramite = '$id'";
    $resultIdCliente = mysqli_query($cn, $sqlGetIdCliente);

    if ($rowIdCliente = mysqli_fetch_assoc($resultIdCliente)) {
        $idcliente = $rowIdCliente['idcliente'];

        $estado = "Finalizado";

        // Actualizar tbtramite
        $sqlUpdateTramite = "UPDATE tbtramite SET estado = '$estado' WHERE nrotramite = '$id'";
        mysqli_query($cn, $sqlUpdateTramite);

        // Insertar en tbdetalletramite con idcliente
        $sqlInsertDetalleEstado = "INSERT INTO tbdetalletramite (idcliente, tramite, estado) VALUES ('$idcliente', '$id', '$estado')";
        mysqli_query($cn, $sqlInsertDetalleEstado);

        header('location: ../view/expedientesP_area.php');
    } else {
        // Manejar el caso donde no se encuentra el idcliente
        // Puedes redirigir a una página de error o hacer otra cosa según tus necesidades
        echo "Error: No se encontró el idcliente correspondiente al nrotramite.";
    }
?>