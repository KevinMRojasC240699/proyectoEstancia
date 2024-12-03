<?php include 'Static/connect/db.php'?>


<?php

    session_start();

    $user = $_SESSION['usuario'];

    if(isset($_SESSION['usuario'])){
        
    }else{
        header("Location:login.php");
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Platillo</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body2>
    
        
        <h2>Registro del Platillo</h2>
    
    <main class="main">
        <form action="create_pla2.php" method="post">
            <label for="nombre">Nombre del platillo:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="descripcion">Descripcion:</label>
            <input type="text" id="descripcion" name="descripcion" required>

            <label for="cantidad">Cantidad:</label>
            <input type="text" id="cantidad" name="cantidad" required>

            
            <div class="buttons">
                <input type="submit" value="Registrar" class="register-btn">
                <input type="button" value="Regresar" class="btn regresar-btn" onclick="window.location.href='nutriologo.php';">
            </div>
        </form>
        
    </main>
</body2>
</html>
