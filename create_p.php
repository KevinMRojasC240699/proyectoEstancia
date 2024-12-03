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


$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fecha = $_POST['fecha'];
$telefono = $_POST['telefono'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$genero = $_POST['genero'];
$tipo = 'usuario';


$sql_usuario = "INSERT INTO usuarios (nombre, apellido, fecha_nacimiento, telefono, usuario, contrasena, genero, tipo, fecha_registro) 
                VALUES ('$nombre', '$apellido', '$fecha', '$telefono', '$usuario', '$contrasena', '$genero', '$tipo', now());";
$execute_usuario = mysqli_query($conn, $sql_usuario);


$id_usuario = mysqli_insert_id($conn);


$sql_paciente = "INSERT INTO pacientes (Usuarios_idUsuarios) VALUES ('$id_usuario');";
$execute_paciente = mysqli_query($conn, $sql_paciente);

sleep(3);
header("Location:login.php");
?>
        
<?php include 'includes/footer.php'; ?>