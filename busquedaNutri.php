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

$search = $_GET['search'] ?? '';

$sql = "SELECT n.id_nut, u.nombre, u.apellido, u.telefono, n.especialidad 
        FROM nutriologos n 
        JOIN usuarios u ON n.Usuarios_idUsuarios = u.idUsuarios 
        WHERE u.nombre LIKE '%$search%' OR u.apellido LIKE '%$search%'";

$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id_nut']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['apellido']}</td>
                <td>{$row['especialidad']}</td>
                <td>{$row['telefono']}</td>
                <td>
                    <button class='action-btn' onclick=\"window.location.href='modificarnut.php?id={$row['id_nut']}';\">
                        <img src='Static/img/modificar.png' alt='Editar' class='action-icon'>
                    </button>
                    <button class='action-btn' onclick=\"eliminarDato({$row['id_nut']});\">
                        <img src='Static/img/eliminar.png' alt='Eliminar' class='action-icon'>
                    </button>
                </td>
              </tr>";
    }
} else {
    echo "Error en la consulta: " . mysqli_error($conn);
}

mysqli_close($conn);
