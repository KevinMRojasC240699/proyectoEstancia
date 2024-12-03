<?php
include 'plantilla.php';
include '../connect/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reporte']) && $_POST['reporte'] == 'generar') {
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];

    $query = "SELECT idUsuarios, nombre, apellido, fecha_nacimiento, telefono, usuario, contrasena, genero 
              FROM usuarios 
              WHERE fecha_registro BETWEEN '$fecha_inicio' AND '$fecha_final' AND tipo = 'usuario'";

    $resultado = mysqli_query($conn, $query);

    $total_query = "SELECT COUNT(*) AS total FROM usuarios WHERE fecha_registro BETWEEN '$fecha_inicio' AND '$fecha_final' AND tipo = 'usuario'";
    $total_masculino_query = "SELECT COUNT(*) AS total_masculino FROM usuarios WHERE fecha_registro BETWEEN '$fecha_inicio' AND '$fecha_final' AND tipo = 'usuario' AND genero = 'masculino'";
    $total_femenino_query = "SELECT COUNT(*) AS total_femenino FROM usuarios WHERE fecha_registro BETWEEN '$fecha_inicio' AND '$fecha_final' AND tipo = 'usuario' AND genero = 'femenino'";

    $total_resultado = mysqli_query($conn, $total_query);
    $total_masculino_resultado = mysqli_query($conn, $total_masculino_query);
    $total_femenino_resultado = mysqli_query($conn, $total_femenino_query);

    $total_pacientes = mysqli_fetch_assoc($total_resultado)['total'];
    $total_masculino = mysqli_fetch_assoc($total_masculino_resultado)['total_masculino'];
    $total_femenino = mysqli_fetch_assoc($total_femenino_resultado)['total_femenino'];

    $pdf = new PDF('P', 'mm', 'letter');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->Cell(0, 10, 'Numero total de pacientes: ' . $total_pacientes, 0, 1, 'L');
    $pdf->Cell(0, 10, 'Total de pacientes masculinos: ' . $total_masculino, 0, 1, 'L');
    $pdf->Cell(0, 10, 'Total de pacientes femeninos: ' . $total_femenino, 0, 1, 'L');
    $pdf->Ln(10); 

    $pdf->Cell(18, 7, 'IDUsuario', 1, 0, 'C', true);
    $pdf->Cell(28, 7, 'Nombre', 1, 0, 'C', true);
    $pdf->Cell(28, 7, 'Apellido', 1, 0, 'C', true);
    $pdf->Cell(28, 7, 'Fecha Nac.', 1, 0, 'C', true);
    $pdf->Cell(23, 7, 'Telefono', 1, 0, 'C', true);
    $pdf->Cell(20, 7, 'Usuario', 1, 0, 'C', true);
    $pdf->Cell(25, 7, 'Contrasena', 1, 0, 'C', true);
    $pdf->Cell(19, 7, 'Genero', 1, 0, 'C', true);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 11);

    while ($row = mysqli_fetch_array($resultado)) {
        $pdf->Cell(18, 7, $row['idUsuarios'], 1, 0, 'C');
        $pdf->Cell(28, 7, $row['nombre'], 1, 0, 'C');
        $pdf->Cell(28, 7, $row['apellido'], 1, 0, 'C');
        $pdf->Cell(28, 7, $row['fecha_nacimiento'], 1, 0, 'C');
        $pdf->Cell(23, 7, $row['telefono'], 1, 0, 'C');
        $pdf->Cell(20, 7, $row['usuario'], 1, 0, 'C');
        $pdf->Cell(25, 7, $row['contrasena'], 1, 0, 'C');
        $pdf->Cell(19, 7, $row['genero'], 1, 0, 'C');
        $pdf->Ln();
    }

    $pdf->Output();
    mysqli_close($conn);
} else {
    echo "Acceso no autorizado";
}
?>
