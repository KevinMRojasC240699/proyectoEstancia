<?php
include 'Static/connect/db.php';

session_start();

$user = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];

$sql = "INSERT INTO platillos (nombre_platillo, descripcion, cantidad, fecha, verificacion, fecha_registro) 
        VALUES ('$nombre', '$descripcion', '$cantidad', CURDATE(), 0, now());";
$execute = mysqli_query($conn, $sql);

if ($execute) {
    $last_id = mysqli_insert_id($conn);

    $sql = "SELECT idUsuarios FROM usuarios WHERE usuario = '$user' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id_usuario = $row['idUsuarios'];

        $sql_paciente = "SELECT id_pac FROM pacientes WHERE Usuarios_idUsuarios = '$id_usuario' LIMIT 1";
        $result_paciente = mysqli_query($conn, $sql_paciente);

        if ($result_paciente && mysqli_num_rows($result_paciente) > 0) {
            $row_paciente = mysqli_fetch_assoc($result_paciente);
            $id_paciente = $row_paciente['id_pac'];

            $sql_paciente_has_platillos = "INSERT INTO pacientes_has_platillos (pacientes_id_pac, platillos_id_pla) 
                                           VALUES ('$id_paciente', '$last_id')";
            $execute_paciente_has_platillos = mysqli_query($conn, $sql_paciente_has_platillos);

            if ($execute_paciente_has_platillos) {
                echo "<script>alert('Registro exitoso'); window.location.href='gestion_platillos.php';</script>";
                exit();
            } else {
                echo "Error al insertar la relación entre paciente y platillo: " . mysqli_error($conn);
            }
        } else {
            echo "Error al obtener el ID del paciente: " . mysqli_error($conn);
        }
    } else {
        echo "Error al obtener el ID del usuario: " . mysqli_error($conn);
    }
} else {
    echo "Error al insertar el platillo: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
