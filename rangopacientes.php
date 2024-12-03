<?php

    session_start();

    $user = $_SESSION['usuario'];

    if(isset($_SESSION['usuario'])){ 
        ?>
        <a href="logout.php">Cerrar Sesion</a>
        <?php
    }else{
        header("Location:login.php");
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes para Nutriólogos</title>
    <link rel="stylesheet" href="Static/css/styles.css">