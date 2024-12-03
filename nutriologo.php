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
    <title>Nutriólogo</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body>
    <img src="Static/img/salad2.png" alt="Ensalada" class="salad-background salad-left">
    <img src="Static/img/salad1.png" alt="Ensalada" class="salad-background salad-right">
    
    <div class="container2">
        <div class="header">
            <img src="Static/img/logo.png" alt="Logo" class="logo">
            <h1>Bienvenido Nutriólogo</h1>
        </div>
        <div class="buttons">
            <button class="btn" onclick="window.location.href='consultapacientes.php';">Pacientes</button>
            <button class="btn" onclick="window.location.href='gestion_platillos2.php';">Gestión de Platillos</button>
            <button class="btn" onclick="window.location.href='gestion_menus2.php';">Gestión de Menús</button>
            
        </div>
        <div><button class="btn" onclick="window.location.href='AsignacionMenuPaci.php';">Asignar menú</button></div>
        <div class="icons">
            <a href="reportesnut.php">
                
                <img src="Static/img/rep.png" alt="Document" class="icon">
            </a>
        </div>
        <button class="regresar-btn" onclick="window.location.href='login.php';">Regresar</button>
    </div>
</body>
</html>

