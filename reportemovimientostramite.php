<?php
    include("conexion.php");
    include("fpdf.php");

    class PDF extends FPDF {
        // Cabecera de página
        function Header() {
            // Arial bold 15
            $this->SetFont('Arial','B',18);
            // Movernos a la derecha
            $this->Cell(60);
            // Agregar imagen
            $this->Image('img/unjfsc_logotipo.png', 10, 8, 50);
            // Título
            $this->Cell(70,20,'Reporte de Movimientos',0,0,'C');
            // Salto de línea
            $this->Ln(20);
        }

        // Pie de páginas
        function Footer() {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    if (isset($_GET['nrotramite'])) {
        $nrotramite = $_GET['nrotramite'];

        // Consulta para obtener detalles de estado
        $consultaEstado = "SELECT c.*, de.iddetalletramite AS detalle_estado_id, de.idcliente AS detalle_estado_idcliente, de.tramite AS detalle_numero_tramite, de.estado AS detalle_estado_estado, de.fecha AS detalle_estado_fecha, t.* FROM tbtramite t
                                LEFT JOIN tbdetalletramite de ON t.nrotramite = de.tramite
                                LEFT JOIN tbcliente c ON t.idcliente = c.idcliente
                                WHERE t.nrotramite = '$nrotramite'
                                ORDER BY de.fecha;";

        $resultadoEstado = mysqli_query($cn, $consultaEstado);

        // Crear instancia de PDF
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        
        // Ajustar el tamaño de la fuente
        $pdf->SetFont('Arial', 'B', 12);

        // Centrar la tabla
        $pdf->Cell(10);
        // Agregar encabezados de columnas
        $pdf->Cell(50, 10, utf8_decode('N° de trámite'), 1, 0, 'C', 0);
        $pdf->Cell(70, 10, utf8_decode('Estado'), 1, 0, 'C', 0);
        $pdf->Cell(50, 10, utf8_decode('Fecha'), 1, 0, 'C', 0);
        $pdf->Ln(); // Salto de línea

        // Agregar detalles de estado al PDF
        while ($rowEstado = mysqli_fetch_assoc($resultadoEstado)) {
            // Agregar una fila por cada cambio de estado
            $pdf->Cell(10);
            $pdf->Cell(50, 10, utf8_decode($rowEstado['nrotramite']), 1, 0, 'C', 0);
            $pdf->Cell(70, 10, utf8_decode($rowEstado['detalle_estado_estado']), 1, 0, 'C', 0);
            $pdf->Cell(50, 10, utf8_decode($rowEstado['detalle_estado_fecha']), 1, 0, 'C', 0);
            $pdf->Ln(); // Salto de línea
        }

        // Output del PDF
        $pdf->Output();
    }
?>
