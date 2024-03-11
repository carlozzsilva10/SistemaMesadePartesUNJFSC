<?php
    include("../config/conexion.php");
    include("../config/auth.php");

    $campo = isset($_POST['campo']) ? $cn->real_escape_string($_POST¨['campo']) : null;

    $column = ['nrotramite','nombre_completo'];

    $where = ' ';

    if ($campo != null) {
        $where = "where (";
        $cont = count($column);
        for ($i = 0; $i < $cont; $i++) { 
            $where .= $column[$i]. " LIKE '%". $campo . "%' OR ";
        }
        $where = substr_replace($where,"",-3);
        $where .= ")";
    }

    $sql = "SELECT c.fechaingreso, c.nrotramite, CONCAT(t.appaterno, ' ', t.apmaterno, ' ', t.nombre) AS nombre_completo, a.nombre AS nombre_asunto, d.nombre AS nombre_dependencia FROM tbtramite c 
                JOIN tbcliente t ON c.idcliente = t.idcliente 
                JOIN tbasunto a ON c.idasunto = a.idasunto 
                JOIN tbdependencia d ON c.iddependencia = d.iddependencia $where";

    $resultado = $cn->query($sql);

    $num_rows = $resultado->num_rows;

    $html = ' ';

    if ($num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>' . $row['nrotramite'] . '</td>';
            $html .= '<td>' . $row['nombre_completo'] . '</td>';
            $html .= '<td>' . $row['nombre_asunto'] . '</td>';
            $html .= '<td>' . $row['nombre_dependencia'] . '</td>';
            $html .= '<td>' . $row['fechaingreso'] . '</td>';
            $html .= '<td>' . '<a href="../../tramite/'.$row['nrotramite'] .'.pdf" target = "_parent">
            <center>
                <img src = "../asset/img/pdf.png" width = "30" height = "30">
            </center>
        </a>' . '</td>';
            $html .= '<td>' . '<form action="cambiarestado.php">
            <a href="../controller/actualizar_estado.php?id='.$row['nrotramite'] .'" target = "_parent">
                <img src = "../asset/img/aprobar.png" width = "30" height = "30">
            </a>
        </form>' . '</td>';
            $html .= '</tr>';
        }
    } else {
        $html .= '<tr>';
        $html .= '<td colspan="7">Sin Resultados</td>';
        $html .= '</tr>';
    }

    echo json_encode($html,JSON_UNESCAPED_UNICODE);
?>