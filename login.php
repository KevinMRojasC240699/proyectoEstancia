<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="outer-container">
        <div class="image-container">
            <img src="Static/img/customimage.jpeg" alt="Custom Image" class="custom-image">
        </div>
        <div class="container1">
            <img src="Static/img/logo.png" alt="Logo" class="logo">
            <h2>Sistema de generación de menús alimenticios</h2>
            <form action="validacion.php" method="post">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" value="Iniciar sesión">
            </form>
            <form action="register.php" method="post">
                <input type="submit" value="Registrarse" class="register-btn">
            </form>
            <?php
            session_start();
            if (isset($_SESSION['error_message'])) {
                echo "<p class='error-message'>" . $_SESSION['error_message'] . "</p>";
                unset($_SESSION['error_message']);
            }
            ?>
        </div>
    </div>
</body>
<script src="Static/js/validaciones.js"></script>
</html>
