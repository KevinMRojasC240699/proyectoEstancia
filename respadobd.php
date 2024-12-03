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
    <title>Respaldo e Importación de Base de Datos</title>
    <link rel="stylesheet" href="Static/css/styles.css">
</head>
<body class="respaldo-body">
    <div class="respaldo-outer-container">
        <div class="respaldo-image-container">
            <img src="Static/img/logo.png" alt="Logo" class="respaldo-logo">
        </div>
        <div class="respaldo-content-container">
            <header class="respaldo-header">
                <h1>Respaldo e Importación de Base de Datos</h1>
                <p>¿Desea respaldar o restaurar la base de datos?</p>
            </header>
            <main class="respaldo-main">
                <form action="respaldo.php" method="post">
                    <button type="submit" class="respaldo-btn">Respaldar</button>
                </form>
                <form action="importar.php" method="post">
                    <button type="submit" class="respaldo-btn">Restaurar</button>
                </form>
                <button class="respaldo-regresar-btn" onclick="window.location.href='admin.php';">Regresar</button>
            </main>
        </div>
        <div class="respaldo-image-container">
            <img src="Static/img/salad6.png" alt="Salad Image" class="respaldo-custom-image">
        </div>
    </div>
</body>
</html>

