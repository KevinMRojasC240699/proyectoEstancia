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

$sql = "SELECT idUsuarios, nombre, apellido, telefono, genero 
        FROM usuarios
        WHERE nombre LIKE '%$search%' AND tipo='usuario'";

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
                    <button class='action-btn' onclick=\"window.location.href='modificarpacien.php?id={$row['idUsuarios']}';\">
                        <img src='Static/img/modificar.png' alt='Editar' class='action-icon'>
                    </button>
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
