<?php include 'Static/connect/db.php'?>

<?php
    session_start();

    $user = $_SESSION['usuario'];

    if(!isset($_SESSION['usuario'])){
        header("Location:login.php");
    }

    
    $sql_nutriologo = "SELECT id_nut FROM nutriologos WHERE Usuarios_idUsuarios = (SELECT idUsuarios FROM usuarios WHERE usuario = '$user' AND tipo = 'nutriologo' LIMIT 1)";
    $result_nutriologo = mysqli_query($conn, $sql_nutriologo);
    $row_nutriologo = mysqli_fetch_assoc($result_nutriologo);
    $id_nutriologo = $row_nutriologo['id_nut'];
?>


            <?php
            $sql = "SELECT u.idUsuarios, u.nombre, u.apellido, u.telefono, u.genero 
                    FROM usuarios u 
                    INNER JOIN pacientes p ON u.idUsuarios = p.Usuarios_idUsuarios 
                    INNER JOIN nutriologos_pacientes np ON p.id_pac = np.paciente_id 
                    WHERE np.nutriologo_id = '$id_nutriologo'";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['idUsuarios']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['apellido']}</td>
                            <td>{$row['telefono']}</td>
                            <td>{$row['genero']}</td>
                            <td>
                            
                                <button class='action-btn' onclick=\"eliminarDato({$row['idUsuarios']});\">
                                    <img src='Static/img/eliminar.png' alt='Eliminar' class='action-icon'>
                                </button>
                
                            </td>
                          </tr>";
                }
            } else {
                echo "Error en la consulta: " . mysqli_error($conn);
            }

            mysqli_close($conn);
            ?>
      
