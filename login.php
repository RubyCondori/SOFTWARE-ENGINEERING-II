<?php
require_once __DIR__.'/app/config/database.php';
require_once __DIR__.'/app/classes/Usuario.class.php';

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    try {
        $usuario = new Usuario();
        if($usuario->login($email, $password)) {
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Email o contraseña incorrectos";
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        $error = "Error al intentar iniciar sesión";
    }
}
?>

<?php include 'views/partials/header.php'; ?>

<div class="contenedor-login">
    <form class="formulario-auth" method="POST">
        <h2>Iniciar Sesión</h2>
        <?php if(isset($error)): ?>
            <div class="alerta-error"><?= $error ?></div>
        <?php endif; ?>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Ingresar</button>
        <p>¿No tienes cuenta? <a href="/registro.php">Regístrate</a></p>
    </form>
</div>

<?php include 'views/partials/footer.php'; ?>