<?php
include 'Static/connect/db.php';

session_start();

$user = $_SESSION['usuario'];

if (!isset($user)) {
    header("Location: login.php");
    exit();
}

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];


$sql = "INSERT INTO platillos (nombre_platillo, descripcion, cantidad, fecha, verificacion,fecha_registro) 
        VALUES ('$nombre', '$descripcion', '$cantidad', CURDATE(), 0, now());";
$execute = mysqli_query($conn, $sql);

if ($execute) {
    $last_id = mysqli_insert_id($conn);

    $sql = "SELECT idUsuarios FROM usuarios WHERE usuario = '$user' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id_usuario = $row['idUsuarios'];


        $sql_nutriologo = "SELECT id_nut FROM nutriologos WHERE Usuarios_idUsuarios = '$id_usuario' LIMIT 1";
        $result_nutriologo = mysqli_query($conn, $sql_nutriologo);

        if ($result_nutriologo && mysqli_num_rows($result_nutriologo) > 0) {
            $row_nutriologo = mysqli_fetch_assoc($result_nutriologo);
            $id_nutriologo = $row_nutriologo['id_nut'];

            $sql_nutriologo_has_platillos = "INSERT INTO nutriologos_has_platillos (nutriologos_id_pac, platillos_id_pla) 
                                              VALUES ('$id_nutriologo', '$last_id')";
            $execute_nutriologo_has_platillos = mysqli_query($conn, $sql_nutriologo_has_platillos);

            if ($execute_nutriologo_has_platillos) {
                header("Location: gestion_platillos2.php");
                exit();
            } else {
                echo "Error al insertar la relación entre nutriólogo y platillo: " . mysqli_error($conn);
            }
        } else {
            echo "Error al obtener el ID del nutriólogo: " . mysqli_error($conn);
        }
    } else {
        echo "Error al obtener el ID del usuario: " . mysqli_error($conn);
    }
} else {
    echo "Error al insertar el platillo: " . mysqli_error($conn);
}

mysqli_close($conn);

include 'includes/footer.php';
?>
