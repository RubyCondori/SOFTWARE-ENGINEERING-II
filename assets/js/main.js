document.addEventListener('DOMContentLoaded', function() {
    // Abrir modal al hacer clic en "Registro / Acceso"
    document.querySelectorAll('a').forEach(function(link) {
        if (link.textContent.includes('Registro')) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var modal = document.getElementById('modalLogin');
                if(modal) modal.style.display = 'block';
            });
        }
    });
    // Cerrar modal al hacer clic en la X
    var cerrar = document.getElementById('cerrarModal');
    if(cerrar) {
        cerrar.onclick = function() {
            var modal = document.getElementById('modalLogin');
            if(modal) modal.style.display = 'none';
        };
    }
    // Cerrar modal al hacer clic fuera del contenido
    window.onclick = function(event) {
        var modal = document.getElementById('modalLogin');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
});