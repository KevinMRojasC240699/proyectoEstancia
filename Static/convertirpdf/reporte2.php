<?php
include 'plantilla2.php';
include "../connect/db.php";

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];

$query = "SELECT pa.idUsuarios, pa.nombre, pa.apellido, pa.fecha_nacimiento, pa.telefono, pa.usuario, pa.contrasena, pa.genero 
    FROM usuarios pa 
    INNER JOIN pacientes p ON pa.idUsuarios = p.Usuarios_idUsuarios
    INNER JOIN pacientes_menus pm ON p.id_pac = pm.paciente_id 
    WHERE pm.fecha_registro BETWEEN '$fecha_inicio' AND '$fecha_final';"; 

$resultado = mysqli_query($conn, $query);

$pdf = new PDF('P', 'mm', 'letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(18,7,'IDUsuario',1,0,'C',true);
$pdf->Cell(28,7,'Nombre',1,0,'C',true);
$pdf->Cell(28,7,'Apellido',1,0,'C',true);
$pdf->Cell(28,7,'Fecha Nac.',1,0,'C',true);
$pdf->Cell(23,7,'Telefono',1,0,'C',true);
$pdf->Cell(20,7,'Usuario',1,0,'C',true);
$pdf->Cell(25,7,'Contrasena',1,0,'C',true);
$pdf->Cell(19,7,'Genero',1,0,'C',true);

$pdf->SetFont('Arial', '', 11);

while ($row = mysqli_fetch_array($resultado)) {
    $pdf->Ln();
    $pdf->Cell(18,7,$row['idUsuarios'],1,0,'C');                 
    $pdf->Cell(28,7,$row['nombre'],1,0,'C');            
    $pdf->Cell(28,7,$row['apellido'],1,0,'C');  
    $pdf->Cell(28,7,$row['fecha_nacimiento'],1,0,'C');  
    $pdf->Cell(23,7,$row['telefono'],1,0,'C');
    $pdf->Cell(20,7,$row['usuario'],1,0,'C');
    $pdf->Cell(25,7,$row['contrasena'],1,0,'C');    
    $pdf->Cell(19,7,$row['genero'],1,0,'C');    
}

$pdf->Output();
mysqli_close($conn);
?>
