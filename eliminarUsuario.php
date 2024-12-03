<?php
include 'Static/connect/db.php';
session_start();

$user = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_GET['id'];

$sql_nutriologo = "SELECT id_nut FROM nutriologos WHERE Usuarios_idUsuarios = (SELECT idUsuarios FROM usuarios WHERE usuario = '$user' AND tipo = 'nutriologo' LIMIT 1)"; 
$result_nutriologo = mysqli_query($conn, $sql_nutriologo); 
$row_nutriologo = mysqli_fetch_assoc($result_nutriologo); 
$id_nutriologo = $row_nutriologo['id_nut'];

$sql_paciente = "SELECT id_pac FROM pacientes WHERE Usuarios_idUsuarios = '$id_usuario'";
 $result_paciente = mysqli_query($conn, $sql_paciente);
  $row_paciente = mysqli_fetch_assoc($result_paciente); 
  $id_paciente = $row_paciente['id_pac']; 
  
  $sql_eliminar = "DELETE FROM nutriologos_pacientes WHERE nutriologo_id = '$id_nutriologo' AND paciente_id = '$id_paciente'"; 
  
    if (mysqli_query($conn, $sql_eliminar)) { 
        
        echo "Paciente eliminado exitosamente.";
        header("Location: gestion_pacientes.php"); 
        exit(); 
    } 
        else { 
            echo "Error al eliminar el paciente: " . mysqli_error($conn); 
        } 
    mysqli_close($conn); 
?>
