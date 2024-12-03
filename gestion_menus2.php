<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Menús</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head>
<body>
    <div class="container3">
        <div class="header">
            <img src="Static/img/logo.png" alt="Logo" class="logo">
            <h1>Gestión de Menús</h1>
        </div>
        
        <div class="buttons">
        <button class="btn" onclick="window.location.href='gestionmenu2.php';">Gestionar Menús</button> 
        <button class="btn regresar-btn" onclick="window.location.href='nutriologo.php';">Regresar</button>
     </div>
        <div class="table-container">
            <h2>Platillos Disponibles</h2>
            <table id="platillos-table">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>ID</th>
                        <th>Nombre del platillo</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="form-container">
            <form id="menu-form" action="guardar_menu2.php" method="POST">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
                
                <label for="tipo_comida">Tipo de Comida:</label>
                <select id="tipo_comida" name="tipo_comida" required>
                    <option value="almuerzo">Almuerzo</option>
                    <option value="comida">Comida</option>
                    <option value="cena">Cena</option>
                </select>

                <input type="hidden" id="platillos_seleccionados" name="platillos_seleccionados">
                <button type="submit" class="btn">Guardar Menú</button>
            </form>
        </div>
    </div>

    <script src="Static/js/validaciones.js"></script>
    <script>
     
        function cargarPlatillos() {
            fetch('listar_platillos4.php')
                .then(response => response.text())
                .then(data => {
                    document.querySelector('#platillos-table tbody').innerHTML = data;
                })
                .catch(error => console.error('Error al cargar los platillos:', error));
        }

       
        document.querySelector('#menu-form').onsubmit = function(event) {
            event.preventDefault();
            var platillosSeleccionados = [];
            document.querySelectorAll('input[name="platillo"]:checked').forEach(function(element) {
                platillosSeleccionados.push(element.value);
            });
            document.querySelector('#platillos_seleccionados').value = platillosSeleccionados.join(',');
            this.submit();
        };

        document.addEventListener('DOMContentLoaded', cargarPlatillos);
    </script>
</body>
</html>
