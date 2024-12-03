<?php
include 'Static/connect/db.php';
session_start();

$user = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$search = $_GET['search'] ?? '';


$sql_usuario = "SELECT idUsuarios FROM usuarios WHERE usuario = '$user' LIMIT 1";
$result_usuario = mysqli_query($conn, $sql_usuario);

if ($result_usuario && mysqli_num_rows($result_usuario) > 0) {
    $row_usuario = mysqli_fetch_assoc($result_usuario);
    $id_usuario = $row_usuario['idUsuarios'];

    
    $sql_menu = "SELECT m.id_menu, m.nombre_platillo, m.fecha, m.tipo_comida
                 FROM menu m
                 JOIN platillos_has_menu phm ON m.id_menu = phm.menu_id_menu
                 JOIN pacientes_has_platillos php ON phm.platillos_id_pla = php.platillos_id_pla
                 JOIN pacientes p ON php.pacientes_id_pac = p.id_pac
                 WHERE p.Usuarios_idUsuarios = '$id_usuario' 
                 AND (m.nombre_platillo LIKE '%$search%' OR m.tipo_comida LIKE '%$search%' OR m.fecha LIKE '%$search%')";
    $result_menu = mysqli_query($conn, $sql_menu);

    if ($result_menu && mysqli_num_rows($result_menu) > 0) {
        while ($row_menu = mysqli_fetch_assoc($result_menu)) {
            echo "<tr>";
            echo "<td>" . $row_menu['id_menu'] . "</td>";
            echo "<td>" . $row_menu['nombre_platillo'] . "</td>";
            echo "<td>" . $row_menu['fecha'] . "</td>";
            echo "<td>" . $row_menu['tipo_comida'] . "</td>";
            echo "<td>
                    <button class='action-btn' onclick=\"window.location.href='modificarmenu.php?id={$row_menu['id_menu']}';\">
                        <img src='Static/img/modificar.png' alt='Editar' class='action-icon'>
                    </button>
                    <button class='action-btn' onclick=\"eliminarMenu({$row_menu['id_menu']});\">
                        <img src='Static/img/eliminar.png' alt='Eliminar' class='action-icon'>
                    </button>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No se encontraron menús para este usuario.</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>Error al obtener el ID del usuario.</td></tr>";
}

mysqli_close($conn);
?>
