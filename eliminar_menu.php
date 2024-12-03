<?php
include 'Static/connect/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id_menu = $_GET['id'];

$sql_delete_relation = "DELETE FROM platillos_has_menu WHERE menu_id_menu = '$id_menu'";
if (!mysqli_query($conn, $sql_delete_relation)) {
    echo "Error al eliminar la relación del menú: " . mysqli_error($conn);
}


$sql_delete_menu = "DELETE FROM menu WHERE id_menu = '$id_menu'";
if (mysqli_query($conn, $sql_delete_menu)) {
    echo "Menú eliminado correctamente.";
} else {
    echo "Error al eliminar el menú: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
