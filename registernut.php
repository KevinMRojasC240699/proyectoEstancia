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
    <title>Registro de Nutriólogos</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body>
    <header class="header">
        
        <h2>Registro del Nutriólogo</h2>
    </header>
    <main class="main">
        <form action="create_nut.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="fecha">Fecha de nacimiento:</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required>

            <label for="especialidad">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad" required>

            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
            
            <label for="genero">Género:</label>
            <select id="genero" name="genero" required>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otro">Otro</option>
            </select>
            <div class="buttons">
                <input type="submit" value="Registrar" class="register-btn">
                <input type="button" value="Regresar" class="btn regresar-btn" onclick="window.location.href='gestionnutriologo.php';">
            </div>
        </form>
        <div class="image-container2">
            <img src="Static/img/salad3.png" alt="Ensalada" class="custom-image">
        </div>
    </main>
</body>
</html>
