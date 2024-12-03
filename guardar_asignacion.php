<?php
include 'Static/connect/db.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}


$usuario_id = isset($_POST['usuario_id']) ? intval($_POST['usuario_id']) : null;
$menu_id = isset($_POST['menu_id']) ? intval($_POST['menu_id']) : null;
$nutriologo_id = isset($_POST['nutriologo_id']) ? intval($_POST['nutriologo_id']) : null;

if (!$usuario_id || !$menu_id || !$nutriologo_id) {
    die("Faltan datos obligatorios.");
}


$sql_insert = "INSERT INTO pacientes_menus (paciente_id, menu_id, nutriologo_id, fecha_registro) 
               VALUES ('$usuario_id', '$menu_id', '$nutriologo_id', NOW())";

if (mysqli_query($conn, $sql_insert)) {
    echo "Asignación guardada exitosamente.";
    header("Location: nutriologo.php");
    exit();
} else {
    echo "Error al guardar la asignación: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
