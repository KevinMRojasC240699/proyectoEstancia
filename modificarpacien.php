<?php include 'Static/connect/db.php'?>


<?php

    session_start();

    $user = $_SESSION['usuario'];

    if(isset($_SESSION['usuario'])){
        
    }else{
        header("Location:login.php");
    }

?>

<?php
include 'Static/connect/db.php';

$idUsuarios = $_GET['id'];
$sql = "SELECT idUsuarios, nombre, apellido, telefono, genero 
        FROM usuarios 
        WHERE idUsuarios = $idUsuarios";
$result = mysqli_query($conn, $sql);
$usuario = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $genero = $_POST['genero'];

    $sql_update = "UPDATE usuarios 
                   SET nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', genero = '$genero' 
                   WHERE idUsuarios = $idUsuarios";

    if (mysqli_query($conn, $sql_update)) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header('Location: gestionpacientes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Paciente</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body>
    <h2>Modificar Paciente</h2>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo $usuario['apellido']; ?>" required>
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" value="<?php echo $usuario['telefono']; ?>" required>
        <label for="genero">Genero:</label>
        <input type="text" id="genero" name="genero" value="<?php echo $usuario['genero']; ?>" required>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
