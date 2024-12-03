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
    <title>Administrador</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body>
    <img src="Static/img/salad2.png" alt="Ensalada" class="salad-background salad-left">
    <img src="Static/img/salad1.png" alt="Ensalada" class="salad-background salad-right">
    
    <div class="container2">
        <div class="header">
            <img src="Static/img/logo.png" alt="Logo" class="logo">
            <h1>Bienvenido Administrador</h1>
        </div>
        <div class="buttons">
            <button class="btn" onclick="window.location.href='gestionnutriologo.php';">Nutriólogos</button>
            <button class="btn" onclick="window.location.href='gestionpacientes.php';">Pacientes</button>
        </div>
        <div class="icons">
            <a href="reportesadmin.php">
                <img src="Static/img/rep.png" alt="Document" class="icon">
            </a>
            <a href="respadobd.php">
                <img src="Static/img/res.png" alt="Upload" class="icon">
            </a>
        </div>
        <button class="regresar-btn" onclick="window.location.href='login.php';">Regresar</button>
    </div>
</body>
</html>

