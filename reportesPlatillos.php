<?php
session_start();

$user = $_SESSION['usuario'];

if(isset($_SESSION['usuario'])){ 
    ?>
    <a href="logout.php">Cerrar Sesion</a>
    <?php
} else {
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes para Nutriólogo</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Reportes para Nutriólogo</h1>
        <form action="Static/convertirpdf/reporte3.php" method="POST">
            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="form-group">
                <label for="fecha_final">Fecha de Final:</label>
                <input type="date" id="fecha_final" name="fecha_final" required>
            </div>
            <button class="regresar-btn" type="button" onclick="window.location.href='reportesnut.php';">Regresar</button>
            <div class="buttons">
                <button type="submit" name="reporte" value="generar">Generar</button>
            </div>
        </form>
    </div>
</body>
</html>
