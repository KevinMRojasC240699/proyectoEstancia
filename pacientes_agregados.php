<?php 
include 'Static/connect/db.php';

session_start();
$user = $_SESSION['usuario'];

if (!isset($user)) {
    header("Location:login.php");
    exit();
}

$sql_nutriologo = "SELECT id_nut FROM nutriologos WHERE Usuarios_idUsuarios = (SELECT idUsuarios FROM usuarios WHERE usuario = '$user' AND tipo = 'nutriologo'LIMIT 1)";
$result_nutriologo = mysqli_query($conn, $sql_nutriologo);

if ($row_nutriologo = mysqli_fetch_assoc($result_nutriologo)) {
    $id_nutriologo = $row_nutriologo['id_nut'];
} else {
    echo "Error: No se encontró el nutriólogo.";
    exit();
}


$id_usuario = isset($_GET['id_usuario']) ? intval($_GET['id_usuario']) : 0;

if ($id_usuario <= 0) {
    echo "Error: ID del usuario inválido.";
    exit();
}


$sql_obtener_paciente = "SELECT id_pac FROM pacientes WHERE Usuarios_idUsuarios = '$id_usuario'";
$result_obtener_paciente = mysqli_query($conn, $sql_obtener_paciente);

if ($row_paciente = mysqli_fetch_assoc($result_obtener_paciente)) {
    $id_paciente = $row_paciente['id_pac'];
} else {
    echo "Error: El usuario no está registrado como paciente.";
    exit();
}


$sql_verificar = "SELECT 1 FROM nutriologos_pacientes WHERE nutriologo_id = '$id_nutriologo' AND paciente_id = '$id_paciente'";
$result_verificar = mysqli_query($conn, $sql_verificar);

if (mysqli_num_rows($result_verificar) > 0) {
    echo "El paciente ya está asignado a este nutriólogo.";
    exit();
}


$sql_insertar = "INSERT INTO nutriologos_pacientes (nutriologo_id, paciente_id) VALUES ('$id_nutriologo', '$id_paciente')";
if (mysqli_query($conn, $sql_insertar)) {
    echo "Paciente asignado al nutriólogo exitosamente.";
} else {
    echo "Error al asignar el paciente: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

