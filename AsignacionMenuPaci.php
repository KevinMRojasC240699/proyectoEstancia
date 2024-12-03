<?php include 'Static/connect/db.php'?>

<?php
    session_start();
    $user = $_SESSION['usuario'];

    if(!isset($_SESSION['usuario'])){
        header("Location: login.php");
        exit();
    }

    // Obtener el ID del usuario
    $sql_usuario = "SELECT idUsuarios FROM usuarios WHERE usuario = '$user' LIMIT 1";
    $result_usuario = mysqli_query($conn, $sql_usuario);

    if ($result_usuario && mysqli_num_rows($result_usuario) > 0) {
        $row_usuario = mysqli_fetch_assoc($result_usuario);
        $id_usuario = $row_usuario['idUsuarios'];

        // Obtener los menús del nutriólogo
        $sql_menu = "SELECT m.id_menu, m.nombre_platillo, m.fecha, m.tipo_comida
                     FROM menu m
                     JOIN platillos_has_menu phm ON m.id_menu = phm.menu_id_menu
                     JOIN nutriologos_has_platillos php ON phm.platillos_id_pla = php.platillos_id_pla
                     JOIN nutriologos p ON php.nutriologos_id_pac = p.id_nut
                     WHERE p.Usuarios_idUsuarios = '$id_usuario'";
        $result_menu = mysqli_query($conn, $sql_menu);

        // Obtener el ID del nutriólogo que ha iniciado sesión
        $sql_nutriologo = "SELECT id_nut FROM nutriologos WHERE Usuarios_idUsuarios = '$id_usuario' LIMIT 1";
        $result_nutriologo = mysqli_query($conn, $sql_nutriologo);
        $row_nutriologo = mysqli_fetch_assoc($result_nutriologo);
        $id_nutriologo = $row_nutriologo['id_nut'];

        // Obtener los pacientes del nutriólogo
        $sql_pacientes = "SELECT p.id_pac, u.nombre, u.apellido, u.telefono, u.genero 
                          FROM usuarios u 
                          INNER JOIN pacientes p ON u.idUsuarios = p.Usuarios_idUsuarios 
                          INNER JOIN nutriologos_pacientes np ON p.id_pac = np.paciente_id 
                          WHERE np.nutriologo_id = '$id_nutriologo'";
        $result_pacientes = mysqli_query($conn, $sql_pacientes);
    } else {
        echo "Error al obtener el ID del usuario.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Asignaciones</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
    <script src="Static/js/validaciones.js"></script>
</head>
<body>
    <div class="form-container2">
        <h1>Gestión de Asignaciones</h1>

        <form class="asignacion-form" method="POST" action="guardar_asignacion.php" onsubmit="validarFormulario(event)">
            <div class="table-container">
                <h2>Pacientes</h2>
                <table id="pacientes-table">
                    <thead>
                        <tr>
                            <th>Seleccionar</th>
                            <th>ID Usuario</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Teléfono</th>
                            <th>Género</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_pacientes) {
                            while ($row = mysqli_fetch_assoc($result_pacientes)) {
                                echo "<tr>
                                        <td><input type='radio' name='usuario_id' value='{$row['id_pac']}'></td>
                                        <td>{$row['id_pac']}</td>
                                        <td>{$row['nombre']}</td>
                                        <td>{$row['apellido']}</td>
                                        <td>{$row['telefono']}</td>
                                        <td>{$row['genero']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No se encontraron pacientes.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div class="table-container">
                <h2>Menús</h2>
                <table id="menu-table">
                    <thead>
                        <tr>
                            <th>Seleccionar</th>
                            <th>ID Menú</th>
                            <th>Nombre del Platillo</th>
                            <th>Fecha</th>
                            <th>Tipo de Comida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_menu) {
                            while ($row = mysqli_fetch_assoc($result_menu)) {
                                echo "<tr>
                                        <td><input type='radio' name='menu_id' value='{$row['id_menu']}'></td>
                                        <td>{$row['id_menu']}</td>
                                        <td>{$row['nombre_platillo']}</td>
                                        <td>{$row['fecha']}</td>
                                        <td>{$row['tipo_comida']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No se encontraron menús.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <input type="hidden" name="nutriologo_id" value="<?php echo $id_nutriologo; ?>">
            <button type="submit">Asignar Menú al Paciente</button>
        </form>
        
        <button class="btn regresar-btn" onclick="window.location.href='nutriologo.php';">Regresar</button>
    </div>
</body>
</html>
