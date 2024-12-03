<?php include 'Static/connect/db.php'?>

<?php
session_start();
$user = $_POST['usuario'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE usuario= '$user' AND contrasena='$password'";

$execute = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($execute)) {
    if ($row['usuario'] == $user && $row['contrasena'] == $password) {
        $_SESSION['usuario'] = $user;
        $_SESSION['tipo'] = $row['tipo']; 
        switch ($row['tipo']) {
            case 'nutriologo':
                header("Location: nutriologo.php");
                break;
            case 'admi':
                header("Location: admin.php");
                break;
            case 'usuario':
                header("Location: usuario.php");
                break;
        }
        exit();
    }
} else {
    $_SESSION['error_message'] = "Datos inválidos. Por favor, intente de nuevo.";
    header("Location: login.php");
    exit();
}

mysqli_close($conn);
?>
