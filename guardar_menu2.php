<?php
include 'Static/connect/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$fecha = $_POST['fecha'];
$tipo_comida = $_POST['tipo_comida'];
$platillos_seleccionados = explode(',', $_POST['platillos_seleccionados']);


$sql_menu = "INSERT INTO menu (nombre_platillo, fecha, tipo_comida) VALUES (?, ?, ?)";
$stmt_menu = mysqli_prepare($conn, $sql_menu);

foreach ($platillos_seleccionados as $id_pla) {
   
    $sql_platillo = "SELECT nombre_platillo FROM platillos WHERE id_pla = ?";
    $stmt_platillo = mysqli_prepare($conn, $sql_platillo);
    mysqli_stmt_bind_param($stmt_platillo, 'i', $id_pla);
    mysqli_stmt_execute($stmt_platillo);
    $result_platillo = mysqli_stmt_get_result($stmt_platillo);

    if ($result_platillo && mysqli_num_rows($result_platillo) > 0) {
        $row_platillo = mysqli_fetch_assoc($result_platillo);
        $nombre_platillo = $row_platillo['nombre_platillo'];

       
        mysqli_stmt_bind_param($stmt_menu, 'sss', $nombre_platillo, $fecha, $tipo_comida);
        mysqli_stmt_execute($stmt_menu);

        
        $menu_id_menu = mysqli_insert_id($conn);

        
        $sql_platillos_menu = "INSERT INTO platillos_has_menu (platillos_id_pla, menu_id_menu) VALUES (?, ?)";
        $stmt_platillos_menu = mysqli_prepare($conn, $sql_platillos_menu);
        mysqli_stmt_bind_param($stmt_platillos_menu, 'ii', $id_pla, $menu_id_menu);
        mysqli_stmt_execute($stmt_platillos_menu);
    }
}

header("Location: gestion_menus2.php");
mysqli_close($conn);
?>

