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
    <title>Gestión del Nutriólogo</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body>
    <div class="container3">
        <div class="header">
            <img src="Static/img/logo.png" alt="Logo" class="logo">
            <h1>Bienvenido Administrador</h1>
        </div>
        <div class="buttons">
            <button class="btn" onclick="window.location.href='registernut.php';">Registrar Nutriólogo</button>
            <button class="btn regresar-btn" onclick="window.location.href='admin.php';">Regresar</button>
        </div>
        <div class="table-container">
            <table id="nutriologos-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Especialidad</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="nutriologos-tbody">
                </tbody>
            </table>
        </div>
        <div class="search-section">
            <form id="search-form" onsubmit="buscarNutriologo(event);">
                <label for="search">Nombre del Nutriólogo:</label>
                <input type="text" id="search" name="search" placeholder="Buscar...">
                <button type="submit" class="search-btn"><img src="Static/img/buscar.png" alt="Buscar"></button>
            </form>
            <button class="filter-btn" onclick="actualizarTabla();">General</button>
        </div>
    </div>

    <script>
        function eliminarDato(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                fetch(`eliminar.php?id=${id}`, {
                    method: 'DELETE'
                }).then(response => {
                    if (response.ok) {
                        alert('Registro eliminado exitosamente');
                        actualizarTabla();
                    } else {
                        alert('Error al eliminar el registro');
                    }
                });
            }
        }

        function actualizarTabla() {
            fetch('listar_nutriologos.php')
                .then(response => response.text())
                .then(data => {
                    document.querySelector('#nutriologos-tbody').innerHTML = data;
                })
                .catch(error => console.error('Error al actualizar la tabla:', error));
        }

        function buscarNutriologo(event) {
            event.preventDefault();
            const search = document.querySelector('#search').value;
            fetch(`busquedaNutri.php?search=${search}`)
                .then(response => response.text())
                .then(data => {
                    document.querySelector('#nutriologos-tbody').innerHTML = data;
                })
                .catch(error => console.error('Error al buscar el nutriólogo:', error));
        }
    </script>
</body>
</html>
