<?php
include 'Static/connect/db.php';

session_start();

$user = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$idUsuarios = $_GET['id'];

try {
 
    mysqli_begin_transaction($conn);

    $sql_pacientes_has_platillos = "DELETE FROM pacientes_has_platillos WHERE pacientes_id_pac = (SELECT id_pac FROM pacientes WHERE Usuarios_idUsuarios = '$idUsuarios')";
    if (!mysqli_query($conn, $sql_pacientes_has_platillos)) {
        throw new Exception("Error al eliminar la relación paciente-platillo: " . mysqli_error($conn));
    }

    $sql_pacientes_menus = "DELETE FROM pacientes_menus WHERE paciente_id = (SELECT id_pac FROM pacientes WHERE Usuarios_idUsuarios = '$idUsuarios')";
    if (!mysqli_query($conn, $sql_pacientes_menus)) {
        throw new Exception("Error al eliminar la relación paciente-menú: " . mysqli_error($conn));
    }

    $sql_nutriologos_pacientes = "DELETE FROM nutriologos_pacientes WHERE paciente_id = (SELECT id_pac FROM pacientes WHERE Usuarios_idUsuarios = '$idUsuarios')";
    if (!mysqli_query($conn, $sql_nutriologos_pacientes)) {
        throw new Exception("Error al eliminar la relación nutriólogo-paciente: " . mysqli_error($conn));
    }

    $sql_paciente = "DELETE FROM pacientes WHERE Usuarios_idUsuarios = '$idUsuarios'";
    if (!mysqli_query($conn, $sql_paciente)) {
        throw new Exception("Error al eliminar el paciente: " . mysqli_error($conn));
    }

  
    $sql_delete = "DELETE FROM usuarios WHERE idUsuarios = $idUsuarios";
    if (!mysqli_query($conn, $sql_delete)) {
        throw new Exception("Error al eliminar el usuario: " . mysqli_error($conn));
    }

    mysqli_commit($conn);
    echo "Paciente y usuario eliminados correctamente.";
    header("Location: gestion_usuarios.php");
    exit();
} catch (Exception $e) {
   
    mysqli_rollback($conn);
    echo $e->getMessage();
}

mysqli_close($conn);
?>
