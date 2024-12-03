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

$id_usuario = $_GET['id'];
$sql = "SELECT n.id_nut, u.nombre, u.apellido, u.telefono, n.especialidad
        FROM nutriologos n
        JOIN usuarios u ON n.Usuarios_idUsuarios = u.idUsuarios
        WHERE u.idUsuarios = $id_usuario";
$result = mysqli_query($conn, $sql);
$nutriologo = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $especialidad = $_POST['especialidad'];

    $sql_update = "UPDATE nutriologos n
                   JOIN usuarios u ON n.Usuarios_idUsuarios = u.idUsuarios
                   SET u.nombre = '$nombre', u.apellido = '$apellido', u.telefono = '$telefono', n.especialidad = '$especialidad'
                   WHERE u.idUsuarios = $id_usuario";

    if (mysqli_query($conn, $sql_update)) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header('Location: gestionnutriologo.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Nutriólogo</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body>
    <h2>Modificar Nutriólogo</h2>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nutriologo['nombre']; ?>" required>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo $nutriologo['apellido']; ?>" required>
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" value="<?php echo $nutriologo['telefono']; ?>" required>
        <label for="especialidad">Especialidad:</label>
        <input type="text" id="especialidad" name="especialidad" value="<?php echo $nutriologo['especialidad']; ?>" required>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>