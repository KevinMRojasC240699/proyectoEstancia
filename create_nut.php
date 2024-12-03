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
$tipo = 'nutriologo';
$espe = $_POST['especialidad'];

$sql = "INSERT INTO usuarios (nombre, apellido, fecha_nacimiento, telefono, usuario, contrasena, genero, tipo,fecha_registro) 
        VALUES ('$nombre', '$apellido', '$fecha', '$telefono', '$usuario', '$contrasena', '$genero', '$tipo',now());";

$execute = mysqli_query($conn, $sql);

if ($execute) {
    $last_id = mysqli_insert_id($conn);

    $sql_nutriologo = "INSERT INTO nutriologos (especialidad, Usuarios_idUsuarios,fecha_ingreso) 
                       VALUES ('$espe', '$last_id',now());";
    
    $execute_nutriologo = mysqli_query($conn, $sql_nutriologo);
    
    if ($execute_nutriologo) {
        header("Location: gestionnutriologo.php");
        exit();
    } else {
        echo "Error al insertar especialidad: " . mysqli_error($conn);
    }
} else {
    echo "Error al insertar usuario: " . mysqli_error($conn);
}

include 'includes/footer.php'; 
?>