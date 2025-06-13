<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>LA SIERRA - Inicio</title>
    <link rel="stylesheet" href="/hostp/assets/css/estilos.css">
</head>
<body>
    <header>
        <nav>
            <img src="/hostp/assets/img/logo.png" alt="LA SIERRA Logo" class="logo">
            <ul>
                <li><a href="#" class="activo">Inicio</a></li>
                <li><a href="#">Hoteles</a></li>
                <li><a href="#">Actividades</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#" id="btnRegistro">Registro / Acceso</a></li>
            </ul>
        </nav>
    </header>
    <section class="hero" style="background-image: url('/hostp/assets/img/candelaria.jpg');">
        <form class="buscador-hotel" method="GET" action="buscar.php">
            <h2>Buscar Hotel</h2>
            <label>
                Check in
                <input type="date" name="checkin" required>
            </label>
            <label>
                Check out
                <input type="date" name="checkout" required>
            </label>
            <label>
                Adultos
                <input type="number" name="adultos" min="1" value="1">
            </label>
            <label>
                Niños
                <input type="number" name="ninos" min="0" value="0">
            </label>
            <button type="submit">Buscar</button>
        </form>
    </section>
    <section class="ventajas">
        <div>
            
            <h4>Unlimited Adventures Await</h4>
            <p>Travels & stay in the best accommodation</p>
        </div>
        <div>
            <h4>Globally Connected</h4>
            <p>Over 1 million options to choose from</p>
        </div>
        <div>
            <h4>Always The Best Pricing</h4>
            <p>Transparency Guaranteed</p>
        </div>
        <div>
            <h4>Reliable & Convenient Technology</h4>
            <p>Secured rates on our easy to use platform</p>
        </div>
    </section>

    <!-- Modal de Registro -->
    <div id="modalRegistro" class="modal">
        <div class="modal-contenido">
            <span class="cerrar">&times;</span>
            <img src="/hostp/assets/img/logo.png" alt="Logo LA SIERRA" class="modal-logo">

            <!-- Formulario de Login -->
            <div id="loginForm">
                <h2>HOLA, BIENVENIDO A LA SIERRA EN LÍNEA</h2>
                <form action="/hostp/login.php" method="POST">
                    <div class="form-group">
                        <label for="loginEmail">Correo electrónico</label>
                        <input type="email" id="loginEmail" name="email" required 
                               placeholder="Captura tu correo electrónico">
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Contraseña</label>
                        <input type="password" id="loginPassword" name="password" required 
                               placeholder="Captura tu contraseña">
                    </div>
                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="recordar" name="recordar">
                        <label for="recordar">Recordar mi cuenta</label>
                        <a href="#" class="recuperar">Recuperar tu contraseña</a>
                    </div>
                    <button type="submit">Entrar a la Sierra en Línea</button>
                </form>
                <p class="cambiar-modal">
                    <a href="#" id="btnRegistrate">Regístrate aquí</a>
                </p>
            </div>

            <!-- Formulario de Registro -->
            <div id="registroForm" style="display: none;">
                <h2>HOLA, BIENVENIDO A LA SIERRA EN LÍNEA</h2>
                <form action="/hostp/Registro.php" method="POST">
                    <div class="form-group">
                        <label for="regNombre">Nombre</label>
                        <input type="text" id="regNombre" name="nombre" required 
                               placeholder="Captura tu nombre">
                    </div>
                    <div class="form-group">
                        <label for="regEmail">Correo electrónico</label>
                        <input type="email" id="regEmail" name="email" required 
                               placeholder="Captura tu correo electrónico">
                    </div>
                    <div class="form-group">
                        <label for="regPassword">Contraseña</label>
                        <input type="password" id="regPassword" name="password" required 
                               placeholder="Captura tu contraseña">
                    </div>
                    <button type="submit">Registrarme en la Sierra en Línea</button>
                </form>
                <p class="cambiar-modal">
                    <a href="#" id="btnEntrar">Entrar a la Sierra en Línea</a>
                </p>
            </div>
        </div>
    </div>


    <!-- Script para el modal -->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Obtener elementos
    const modal = document.getElementById('modalRegistro');
    const btnRegistro = document.getElementById('btnRegistro');
    const cerrar = document.getElementsByClassName('cerrar')[0];
    const btnRegistrate = document.getElementById('btnRegistrate');
    const btnEntrar = document.getElementById('btnEntrar');
    const loginForm = document.getElementById('loginForm');
    const registroForm = document.getElementById('registroForm');

    // Abrir modal
    if(btnRegistro) {
        btnRegistro.addEventListener('click', function(e) {
            e.preventDefault();
            modal.style.display = "block";
            loginForm.style.display = "block";
            registroForm.style.display = "none";
        });
    }

    // Cambiar a registro
    if(btnRegistrate) {
        btnRegistrate.addEventListener('click', function(e) {
            e.preventDefault();
            loginForm.style.display = "none";
            registroForm.style.display = "block";
        });
    }

    // Cambiar a login
    if(btnEntrar) {
        btnEntrar.addEventListener('click', function(e) {
            e.preventDefault();
            registroForm.style.display = "none";
            loginForm.style.display = "block";
        });
    }

    // Cerrar modal con X
    if(cerrar) {
        cerrar.addEventListener('click', function() {
            modal.style.display = "none";
        });
    }

    // Cerrar modal al hacer clic fuera
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
});
</script>
</body>
</html>