<?php
include 'Static/connect/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id_menu = $_GET['id'];


$sql = "SELECT * FROM menu WHERE id_menu = '$id_menu'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $menu = mysqli_fetch_assoc($result);
} else {
    echo "Error al obtener los datos del menú: " . mysqli_error($conn);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_platillo = $_POST['nombre_platillo'];
    $fecha = $_POST['fecha'];
    $tipo_comida = $_POST['tipo_comida'];

   
    $sql_update = "UPDATE menu SET nombre_platillo = '$nombre_platillo', fecha = '$fecha', tipo_comida = '$tipo_comida' WHERE id_menu = '$id_menu'";
    $result_update = mysqli_query($conn, $sql_update);

    if ($result_update) {
        header("Location: gestionmenu.php");
        exit();
    } else {
        echo "Error al actualizar el menú: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Menú</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body>
    <div class="container3">
        <div class="header">
            <img src="Static/img/logo.png" alt="Logo" class="logo">
            <h1>Modificar Menú</h1>
        </div>
        <div class="form-container">
            <form method="POST" action="">
                <label for="nombre_platillo">Nombre del Platillo:</label>
                <input type="text" id="nombre_platillo" name="nombre_platillo" value="<?php echo $menu['nombre_platillo']; ?>" required>
                
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo $menu['fecha']; ?>" required>
                
                <label for="tipo_comida">Tipo de Comida:</label>
                <select id="tipo_comida" name="tipo_comida" required>
                    <option value="almuerzo" <?php if ($menu['tipo_comida'] == 'almuerzo') echo 'selected'; ?>>Almuerzo</option>
                    <option value="comida" <?php if ($menu['tipo_comida'] == 'comida') echo 'selected'; ?>>Comida</option>
                    <option value="cena" <?php if ($menu['tipo_comida'] == 'cena') echo 'selected'; ?>>Cena</option>
                </select>

                <button type="submit" class="btn">Actualizar Menú</button>
                <button type="button" class="btn regresar-btn" onclick="window.location.href='gestionmenu.php';">Cancelar</button>
            </form>
        </div>
    </div>
</body>
</html>
