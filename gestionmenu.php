<?php
include 'Static/connect/db.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['usuario'];

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
                 WHERE p.Usuarios_idUsuarios = '$id_usuario'";
    $result_menu = mysqli_query($conn, $sql_menu);
} else {
    echo "Error al obtener el ID del usuario.";
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Menús</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body>
    <div class="container3">
        <div class="header">
            <img src="Static/img/logo.png" alt="Logo" class="logo">
            <h1>Gestión de Menús</h1>
        </div>
        <div class="buttons">
            <button class="btn regresar-btn" onclick="window.location.href='usuario.php';">Regresar</button>
        </div>
        <div class="table-container">
            <table id="menu-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Platillo</th>
                        <th>Fecha</th>
                        <th>Tipo de Comida</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
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
                    ?>
                </tbody>
            </table>
        </div>
        <div class="search-section">
            <form id="search-form" onsubmit="buscarMenu(event);">
                <label for="search">Buscar Menú:</label>
                <input type="text" id="search" name="search" placeholder="Buscar...">
                <button type="submit" class="search-btn"><img src="Static/img/buscar.png" alt="Buscar"></button>
            </form>
        </div>
    </div>
    

    <script src="Static/js/validaciones.js"></script>
    <script>
        function eliminarMenu(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este menú?')) {
                fetch(`eliminar_menu.php?id=${id}`, {
                    method: 'DELETE'
                }).then(response => {
                    if (response.ok) {
                        alert('Menú eliminado exitosamente');
                        location.reload();
                    } else {
                        alert('Error al eliminar el menú');
                    }
                });
            }
        }

        function buscarMenu(event) {
            event.preventDefault();
            const search = document.querySelector('#search').value;
            fetch(`busqueda_menu.php?search=${search}`)
                .then(response => response.text())
                .then(data => {
                    document.querySelector('#menu-table tbody').innerHTML = data;
                })
                .catch(error => console.error('Error al buscar el menú:', error));
        } 
    </script>
</body>
</html>
