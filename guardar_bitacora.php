<?php
include 'Static/connect/db.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_POST['id_usuario'];
$fecha = $_POST['fecha'];
$nombre_platillo = $_POST['nombre_platillo'];
$tipo_comida = $_POST['tipo_comida'];
$consumido = $_POST['consumido'];
$comentario = $_POST['comentario'];

$sql_insert = "INSERT INTO bitacora_paciente (id_usuario, fecha, nombre_platillo, tipo_comida, consumido, comentario) 
               VALUES ('$id_usuario', '$fecha', '$nombre_platillo', '$tipo_comida', '$consumido', '$comentario')";

if (mysqli_query($conn, $sql_insert)) {
    echo "Información guardada en la bitácora exitosamente.";
    header("Location: usuario.php");
    exit();
} else {
    echo "Error al guardar la información en la bitácora: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
