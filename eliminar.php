<?php
include 'Static/connect/db.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_GET['id'];


   
    $sql_nutriologo = "DELETE FROM nutriologos WHERE Usuarios_idUsuarios = '$id_usuario'";
    if (!mysqli_query($conn, $sql_nutriologo)) {
        throw new Exception("Error al eliminar el nutriólogo: " . mysqli_error($conn));
    }


    $sql_usuario = "DELETE FROM usuarios WHERE idUsuarios = '$id_usuario'";
    if (!mysqli_query($conn, $sql_usuario)) {
        throw new Exception("Error al eliminar el usuario: " . mysqli_error($conn));
    }

  
    echo "Nutriólogo y usuario eliminados exitosamente.";
    header("Location: gestion_usuarios.php");
    exit();

mysqli_close($conn);
?>

