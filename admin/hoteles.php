<?php
require_once __DIR__ . '/../app/models/HotelModel.php';


// ...código existente...
session_start();
// Verificar permisos de admin
if (!isset($_SESSION['usuario'])) {
    header('Location: /login.php');
    exit;
}

$modelo = new HotelModel();

// Manejar eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $modelo->eliminarHotel($_POST['id']);
}

$hoteles = $modelo->obtenerHotelesDestacados();
?>

<!-- Vista HTML -->