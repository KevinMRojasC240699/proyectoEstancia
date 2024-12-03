<?php
include 'plantilla3.php';
include '../connect/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reporte']) && $_POST['reporte'] == 'generar') {
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];

    $query = "SELECT id_pla, nombre_platillo, descripcion, cantidad, fecha, verificacion 
              FROM platillos 
              WHERE fecha_registro BETWEEN '$fecha_inicio' AND '$fecha_final'";

    $resultado = mysqli_query($conn, $query);

   
    $pdf = new PDF('P', 'mm', 'letter');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 10);

    
    $pdf->Cell(18, 7, 'id_pla', 1, 0, 'C', true);
    $pdf->Cell(28, 7, 'Nombre_Platillo', 1, 0, 'C', true);
    $pdf->Cell(28, 7, 'Descripcion', 1, 0, 'C', true);
    $pdf->Cell(28, 7, 'Cantidad', 1, 0, 'C', true);
    $pdf->Cell(23, 7, 'Fecha', 1, 0, 'C', true);
    $pdf->Cell(20, 7, 'Verificacion', 1, 0, 'C', true);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 11);
    
    while ($row = mysqli_fetch_array($resultado)) {
        $pdf->Cell(18, 7, $row['id_pla'], 1, 0, 'C');
        $pdf->Cell(28, 7, $row['nombre_platillo'], 1, 0, 'C');
        $pdf->Cell(28, 7, $row['descripcion'], 1, 0, 'C');
        $pdf->Cell(28, 7, $row['cantidad'], 1, 0, 'C');
        $pdf->Cell(23, 7, $row['fecha'], 1, 0, 'C');
        $pdf->Cell(20, 7, $row['verificacion'], 1, 0, 'C');
        $pdf->Ln();
    }

    $pdf->Output();
    mysqli_close($conn);
} else {
    echo "Acceso no autorizado";
}
?>
