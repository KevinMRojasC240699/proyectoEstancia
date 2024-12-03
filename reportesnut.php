<?php
session_start();

$user = $_SESSION['usuario'];

if (isset($_SESSION['usuario'])) { 
    ?>
    <a class="cerrar" href="logout.php">Cerrar Sesión</a>
    <?php
} else {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes para Nutriólogos</title>
    <link rel="stylesheet" href="Static/css/styles.css">
</head>
<body class="reportes-body">
    <div class="reportes-outer-container">
        <div class="reportes-image-container">
            <img src="Static/img/salad4.png" alt="Custom Image" class="reportes-custom-image">
        </div>
        <div class="reportes-container1">
            <header class="reportes-header">
                <img src="Static/img/logo.png" alt="Logo" class="reportes-logo">
                <h1 class="reportes-h1">Reportes para Nutriólogos</h1>
            </header>
            <main class="reportes-main">
                <div class="reportes-container2">
                    <h3 class="reportes-h2">Número de Pacientes</h3>
                    <button class="reportes-btn"onclick="window.location.href='fechaReportesNut.php';">Generar</button>
                    <h3 class="reportes-h2">Pacientes con Menú</h3>
                    <button class="reportes-btn"onclick="window.location.href='pacientesConMenu.php';">Generar</button>
                    <h3 class="reportes-h2">Platillos</h3>
                    <button class="reportes-btn"onclick="window.location.href='reportesPlatillos.php';">Generar</button>
                    <br>
                    <br>
                    <button class="reportes-regresar-btn"onclick="window.location.href='nutriologo.php';">Regresar</button>
                </div>
                <div class="reportes-image-container2">
                    <img src="Static/img/salad5.png" alt="Vegetables" class="reportes-custom-image">
                </div>
            </main>
        </div>
    </div>
</body>
</html>
