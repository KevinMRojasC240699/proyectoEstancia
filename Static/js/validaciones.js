function validacion(){
    if(document.frm1.nombre.value.length==0){
        document.getElementById("nombre").focus();
        return false;
    }
    if(document.frm1.precio.value.length==0){
        document.getElementById("precio").focus();
        return false;
    }
    frm1.submit();
}

document.getElementById('filter-general').onclick = function() {
    
    var searchQuery = document.getElementById('search').value;
    
    
    window.location.href = 'listar_nutriologos.php?tipo=general&search=' + encodeURIComponent(searchQuery);
};

function validarFormulario(event) {
    var pacienteSeleccionado = document.querySelector('input[name="usuario_id"]:checked');
    var menuSeleccionado = document.querySelector('input[name="menu_id"]:checked');

    if (!pacienteSeleccionado || !menuSeleccionado) {
        event.preventDefault();
        alert('Debe seleccionar un paciente y un menú.');
    }
}
