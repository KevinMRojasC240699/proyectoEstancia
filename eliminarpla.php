<?php
include 'Static/connect/db.php';
session_start();

$user = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id_pla = $_GET['id'];

$sql_delete_relation = "DELETE FROM pacientes_has_platillos WHERE platillos_id_pla = '$id_pla'";
if (!mysqli_query($conn, $sql_delete_relation)) {
    echo "Error al eliminar la relación del platillo: " . mysqli_error($conn);
}

$sql_delete_platillo = "DELETE FROM platillos WHERE id_pla = '$id_pla'";
if (mysqli_query($conn, $sql_delete_platillo)) {
    echo "Registro eliminado correctamente.";
} else {
    echo "Error al eliminar el platillo: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
