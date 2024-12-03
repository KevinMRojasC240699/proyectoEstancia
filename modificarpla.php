<?php
include 'Static/connect/db.php';
session_start();

$user = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id_pla = $_GET['id'];


$sql = "SELECT nombre_platillo, descripcion, cantidad FROM platillos WHERE id_pla = '$id_pla'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $platillo = mysqli_fetch_assoc($result);
} else {
    echo "Error al obtener los datos del platillo: " . mysqli_error($conn);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre_platillo'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];

    
    $sql_update = "UPDATE platillos SET nombre_platillo = '$nombre', descripcion = '$descripcion', cantidad = '$cantidad' WHERE id_pla = '$id_pla'";
    $result_update = mysqli_query($conn, $sql_update);

    if ($result_update) {
        header("Location: gestion_platillos.php");
        exit();
    } else {
        echo "Error al actualizar el platillo: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Platillo</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body>
    <div class="container3">
        <div class="header">
            <img src="Static/img/logo.png" alt="Logo" class="logo">
            <h1>Modificar Platillo</h1>
        </div>
        <div class="form-container">
            <form method="POST" action="">
                <label for="nombre_platillo">Nombre del Platillo:</label>
                <input type="text" id="nombre_platillo" name="nombre_platillo" value="<?php echo $platillo['nombre_platillo']; ?>" required>
                
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" value="<?php echo $platillo['descripcion']; ?>" required>
                
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" value="<?php echo $platillo['cantidad']; ?>" required>
                
                <button type="submit" class="btn">Actualizar Platillo</button>
                <button type="button" class="btn regresar-btn" onclick="window.location.href='gestionnutriologo.php';">Cancelar</button>
            </form>
        </div>
    </div>
</body>
</html>
