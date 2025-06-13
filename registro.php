<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'app/classes/Usuario.class.php';

$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!empty($nombre) && !empty($email) && !empty($password)) {
    $usuario = new Usuario();
    $resultado = $usuario->registrar($nombre, $email, $password);
    echo $resultado;
} else {
    echo "Todos los campos son obligatorios.";
}
// Iniciar sesión
session_start();
require_once 'app/config/database.php';
require_once 'app/classes/Usuario.class.php';

// Verificar si se recibió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log("Datos POST recibidos: " . print_r($_POST, true));

    try {
        // Validar y limpiar datos
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        // Log de datos procesados
        error_log("Datos procesados: Nombre=$nombre, Email=$email");

        // Validaciones básicas
        if (empty($nombre) || empty($email) || empty($password)) {
            throw new Exception("Todos los campos son obligatorios");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email inválido");
        }

        if ($password !== $password2) {
            throw new Exception("Las contraseñas no coinciden");
        }

        if (strlen($password) < 6) {
            throw new Exception("La contraseña debe tener al menos 6 caracteres");
        }

        // Obtener instancia de la base de datos
        $db = Database::getInstance();
        $conexion = $db->getConexion();

        // Verificar si el email ya existe
        $stmt = $conexion->prepare("SELECT id FROM Usuario WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            throw new Exception("El email ya está registrado");
        }

        // Hash de la contraseña
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar nuevo usuario
        $stmt = $conexion->prepare("INSERT INTO Usuarios (nombre, email, password, activo) VALUES (?, ?, ?, 1)");
        $stmt->execute([$nombre, $email, $hash]);

        $_SESSION['success'] = "¡Bienvenido a La Sierra en Línea!";
        header("Location: views/home.php");
        exit;

    } catch (Exception $e) {
        error_log("Error en registro: " . $e->getMessage());
        $_SESSION['error'] = $e->getMessage();
        header("Location: views/home.php");
        exit;
    }
} else {
    require_once 'app/classes/Usuario.class.php';

    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($nombre && $email && $password) {
        $usuario = new Usuario();
        $resultado = $usuario->registrar($nombre, $email, $password);
        echo $resultado;
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

// Si no es POST, redirigir a home
header("Location: views/home.php");
exit;



?>