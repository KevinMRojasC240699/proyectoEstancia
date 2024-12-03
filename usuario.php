<?php include 'Static/connect/db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de generación de menús alimenticios</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Static/css/styles.css">
    
    <script>
        function setConsumido(consumido, form) {
            form.consumido.value = consumido;
            form.submit();
        }
    </script>
</head>
<body>

    <div class="menu-container">
        <header class="menu-header">
        <img src="Static/img/logo.png" alt="Logo" class="logo">
            <h1>Sistema de generación de menús alimenticios</h1>
        </header>

        <div class="menu-button-container">
            <a href="gestion_menus.php" class="btn btn-primary">Agregar menú</a>
            <a href="gestion_platillos.php" class="btn btn-secondary">Gestión de Platillos</a>
        </div>

        <?php
            session_start();
            $user = $_SESSION['usuario'];

            if (isset($_SESSION['usuario'])) {
                echo "<h1>Bienvenid@ :$user</h1>";
                echo '<a href="logout.php">Cerrar Sesión</a>';
            } else {
                header("Location:login.php");
                exit();
            }
        ?>

        <h1>Calendario de Comidas</h1>
        <table class="menu-calendar-table">
            <thead>
                <tr>
                    <th class="menu-calendar-header">Domingo</th>
                    <th class="menu-calendar-header">Lunes</th>
                    <th class="menu-calendar-header">Martes</th>
                    <th class="menu-calendar-header">Miércoles</th>
                    <th class="menu-calendar-header">Jueves</th>
                    <th class="menu-calendar-header">Viernes</th>
                    <th class="menu-calendar-header">Sábado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_usuario = "SELECT idUsuarios FROM usuarios WHERE usuario = '$user' LIMIT 1";
                $result_usuario = mysqli_query($conn, $sql_usuario);

                if ($result_usuario && mysqli_num_rows($result_usuario) > 0) {
                    $row_usuario = mysqli_fetch_assoc($result_usuario);
                    $id_usuario = $row_usuario['idUsuarios'];

                    $month = date('m');
                    $year = date('Y');
                    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                    $firstDayOfMonth = date('w', mktime(0, 0, 0, $month, 1, $year));

                    $dayCounter = 1;
                    $currentDay = 0;

                    $sql_menu = "SELECT m.id_menu, m.nombre_platillo, m.fecha, m.tipo_comida,
                                 CONCAT(u.nombre, ' ', u.apellido) AS nutriologo_nombre
                                 FROM menu m
                                 JOIN platillos_has_menu phm ON m.id_menu = phm.menu_id_menu
                                 LEFT JOIN pacientes_has_platillos php ON phm.platillos_id_pla = php.platillos_id_pla
                                 LEFT JOIN pacientes p ON php.pacientes_id_pac = p.id_pac
                                 LEFT JOIN pacientes_menus pm ON m.id_menu = pm.menu_id AND pm.paciente_id = (SELECT id_pac FROM pacientes WHERE Usuarios_idUsuarios = '$id_usuario')
                                 LEFT JOIN nutriologos n ON pm.nutriologo_id = n.id_nut
                                 LEFT JOIN usuarios u ON n.Usuarios_idUsuarios = u.idUsuarios
                                 WHERE (p.Usuarios_idUsuarios = '$id_usuario' OR pm.paciente_id = (SELECT id_pac FROM pacientes WHERE Usuarios_idUsuarios = '$id_usuario'))
                                 AND MONTH(m.fecha) = '$month' 
                                 AND YEAR(m.fecha) = '$year'
                                 ORDER BY m.fecha, FIELD(m.tipo_comida, 'almuerzo', 'comida', 'cena')";
                    $result_menu = mysqli_query($conn, $sql_menu);

                    $menus = [];
                    if ($result_menu && mysqli_num_rows($result_menu) > 0) {
                        while ($row_menu = mysqli_fetch_assoc($result_menu)) {
                            $menus[$row_menu['fecha']][] = $row_menu;
                        }
                    }

                    for ($week = 0; $week < 6; $week++) {
                        echo "<tr>";
                        for ($day = 0; $day < 7; $day++) {
                            if ($week == 0 && $day < $firstDayOfMonth || $dayCounter > $daysInMonth) {
                                echo "<td class='menu-calendar-cell'></td>";
                            } else {
                                $currentDate = "$year-$month-" . str_pad($dayCounter, 2, '0', STR_PAD_LEFT);
                                echo "<td class='menu-calendar-cell'>";
                                echo "<div class='menu-calendar-date'>$dayCounter</div>";
                                if (isset($menus[$currentDate])) {
                                    foreach ($menus[$currentDate] as $menu) {
                                        echo "<hr>";
                                        echo "<div class='menu-calendar-menu'>{$menu['nombre_platillo']} ({$menu['tipo_comida']})</div>";
                                        if (!empty($menu['nutriologo_nombre'])) {
                                            echo "<div class='menu-nutriologo'>Asignado por: {$menu['nutriologo_nombre']}</div>";
                                        }
                                        ;
                                        echo "<form class='form-bitacora' action='guardar_bitacora.php' method='POST'>";
                                        echo "<input type='hidden' name='id_usuario' value='$id_usuario'>";
                                        echo "<input type='hidden' name='fecha' value='{$menu['fecha']}'>";
                                        echo "<input type='hidden' name='nombre_platillo' value='{$menu['nombre_platillo']}'>";
                                        echo "<input type='hidden' name='tipo_comida' value='{$menu['tipo_comida']}'>";
                                        echo "<input type='hidden' name='consumido' value=''>";
                                        echo "<textarea class='menu-calendar-textarea' name='comentario' placeholder='Escribe tu comentario aquí'></textarea>";
                                        echo "<button type='button' class='menu-calendar-button menu-calendar-button-si' onclick='setConsumido(\"si\", this.form)'>Sí</button>";
                                        echo "<button type='button' class='menu-calendar-button menu-calendar-button-no' onclick='setConsumido(\"no\", this.form)'>No</button>";
                                        
                                        echo "</form>";
                                        echo "</div>";
                                        echo "<hr>";
                                    }
                                }
                                echo "</td>";
                                $dayCounter++;
                            }
                            $currentDay++;
                        }
                        echo "</tr>";
                        if ($dayCounter > $daysInMonth) {
                            break;
                        }
                    }
                } else {
                    echo "Error al obtener el ID del usuario.";
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>





