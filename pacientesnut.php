<?php include 'Static/connect/db.php'?>

<?php
    session_start();

    $user = $_SESSION['usuario'];

    if(!isset($_SESSION['usuario'])){
        header("Location:login.php");
    }

    // Obtener el ID del nutriólogo que ha iniciado sesión
    $sql_nutriologo = "SELECT idUsuarios FROM usuarios WHERE usuario = '$user' AND tipo = 'nutriologo' LIMIT 1";
    $result_nutriologo = mysqli_query($conn, $sql_nutriologo);
    $row_nutriologo = mysqli_fetch_assoc($result_nutriologo);
    $id_nutriologo = $row_nutriologo['idUsuarios'];
?>

<table>
    <thead>
       
    </thead>
    <tbody>
        <?php
        $sql = "SELECT idUsuarios, nombre, apellido, telefono, genero FROM usuarios WHERE tipo = 'usuario'";
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
                            <button class='action-btn' onclick=\"window.location.href='pacientes_agregados.php?id_usuario={$row['idUsuarios']}&id_nutriologo=$id_nutriologo';\">
                                <img src='Static/img/agregar.png' alt='Agregar' class='action-icon'>
                            </button>
                        </td>
                      </tr>";
            }
        } else {
            echo "Error en la consulta: " . mysqli_error($conn);
        }

        mysqli_close($conn);
        ?>
    </tbody>
</table>
