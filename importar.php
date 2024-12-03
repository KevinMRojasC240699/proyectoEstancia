<?php
$host = 'localhost'; 
$dbname = 'sistemaalimentos4'; 
$username = 'root'; 
$password = 'admin'; 
$filename = 'C:\xampp\htdocs\Estancia2\respaldo.sql'; 


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}


$sql = file_get_contents($filename);

if ($sql === false) {
    die('Error al leer el archivo SQL.');
}


if ($conn->multi_query($sql)) {
    do {

        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());
    echo 'Importación de la base de datos completada exitosamente.';
} else {
    echo 'Error al importar la base de datos: ' . $conn->error;
}


$conn->close();
?>
