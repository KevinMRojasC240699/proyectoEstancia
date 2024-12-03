<?php
include 'Static/connect/db.php';
session_start();

$user = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}


$sql = "SELECT idUsuarios FROM usuarios WHERE usuario = '$user' LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $id_usuario = $row['idUsuarios'];

    
    $sql_platillos = "SELECT p.id_pla, p.nombre_platillo, p.descripcion, p.cantidad
                      FROM platillos p
                      INNER JOIN nutriologos_has_platillos ph ON p.id_pla = ph.platillos_id_pla
                      INNER JOIN nutriologos pac ON ph.nutriologos_id_pac = pac.id_nut
                      WHERE pac.Usuarios_idUsuarios = '$id_usuario'";

    $result_platillos = mysqli_query($conn, $sql_platillos);

    if ($result_platillos && mysqli_num_rows($result_platillos) > 0) {
        while ($row_platillo = mysqli_fetch_assoc($result_platillos)) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='platillo' value='" . $row_platillo['id_pla'] . "'></td>";
            echo "<td>" . $row_platillo['id_pla'] . "</td>";
            echo "<td>" . $row_platillo['nombre_platillo'] . "</td>";
            echo "<td>" . $row_platillo['descripcion'] . "</td>";
            echo "<td>" . $row_platillo['cantidad'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No se encontraron platillos para este usuario.</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>Error al obtener el ID del usuario.</td></tr>";
}

mysqli_close($conn);
?>
