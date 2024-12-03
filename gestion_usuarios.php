<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pacientes</title>
    <link rel="stylesheet" type="text/css" href="Static/css/styles.css">
</head> 
<body>
    <div class="container3">
        <div class="header">
            <img src="Static/img/logo.png" alt="Logo" class="logo">
            <h1>Bienvenido Nutriólogo</h1>
        </div>
        <div class="buttons">
            <button class="btn regresar-btn" onclick="window.location.href='nutriologo.php';">Regresar</button>
        </div>
        <div class="table-container">
            <table id="pacientes-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Genero</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="pacientes-tbody">
                </tbody>
            </table>
        </div>
        <div class="search-section">
            <form id="search-form" onsubmit="buscarPaciente(event);">
                <label for="search">Nombre del Paciente:</label>
                <input type="text" id="search" name="search" placeholder="Buscar...">
                <button type="submit" class="search-btn"><img src="Static/img/buscar.png" alt="Buscar"></button>
            </form>
            <button class="filter-btn" onclick="actualizarTabla();">General</button>
        </div>
    </div>

    <script>

        function eliminarDato(id) {
                    if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                        fetch(`eliminarUsuario.php?id=${id}`, {
                            method: 'DELETE'
                        }).then(response => {
                            if (response.ok) {
                                alert('Registro eliminado exitosamente');
                                actualizarTabla();
                            } else {
                                alert('Registro eliminado exitosamente');
                            }
                        });
                    }
                }

        function actualizarTabla() {
            fetch('pacientesnut2.php')
                .then(response => response.text())
                .then(data => {
                    document.querySelector('#pacientes-tbody').innerHTML = data;
                })
                .catch(error => console.error('Error al actualizar la tabla:', error));
        }

        function buscarPaciente(event) {
            event.preventDefault();
            const search = document.querySelector('#search').value;
            fetch(`busquedaPacien2.php?search=${search}`)
                .then(response => response.text())
                .then(data => {
                    document.querySelector('#pacientes-tbody').innerHTML = data;
                })
                .catch(error => console.error('Error al buscar el paciente:', error));
        }
    </script>
</body>
</html>
