<?php include 'Static/connect/db.php'?>


<?php

    session_start();

    $user = $_SESSION['usuario'];

    if(isset($_SESSION['usuario'])){
        
    }else{
        header("Location:login.php");
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión del Platillo</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body>
    <div class="container3">
        <div class="header">
            <img src="Static/img/logo.png" alt="Logo" class="logo">
            <h1>Gestión de platillos</h1>
        </div>
        <div class="buttons">
            <button class="btn" onclick="window.location.href='registerPla2.php';">Registrar Platillo</button>
            <button class="btn regresar-btn" onclick="window.location.href='nutriologo.php';">Regresar</button>
        </div>
        <div class="table-container">
            <table id="platillos-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del platillo</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="platillos-tbody">
                </tbody>
            </table>
        </div>
        <div class="search-section">
            <form id="search-form" onsubmit="buscarNutriologo(event);">
                <label for="search">Nombre del Platillo:</label>
                <input type="text" id="search" name="search" placeholder="Buscar...">
                <button type="submit" class="search-btn"><img src="Static/img/buscar.png" alt="Buscar"></button>
            </form>
            
        </div>
    </div>

    <script>
        function eliminarDato(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                fetch(`eliminarpla2.php?id=${id}`, {
                    method: 'DELETE'
                }).then(response => {
                    if (response.ok) {
                        alert('Registro eliminado exitosamente');
                        actualizarTablaPlatillos();
                    } else {
                        alert('Error al eliminar el registro');
                    }
                });
            }
        }

        function actualizarTablaPlatillos() {
            fetch('listar_platillos3.php')
                .then(response => response.text())
                .then(data => {
                    document.querySelector('#platillos-tbody').innerHTML = data;
                })
                .catch(error => console.error('Error al actualizar la tabla de platillos:', error));
        }

        function buscarNutriologo(event) {
            event.preventDefault();
            const search = document.querySelector('#search').value;
            fetch(`busquedaPla2.php?search=${search}`)
                .then(response => response.text())
                .then(data => {
                    document.querySelector('#platillos-tbody').innerHTML = data;
                })
                .catch(error => console.error('Error al buscar el platillos:', error));
        }

        document.addEventListener('DOMContentLoaded', actualizarTablaPlatillos);
    </script>
</body>
</html>

