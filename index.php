<?php
require_once __DIR__ . '/app/models/HotelModel.php';

$modelo = new HotelModel();
$hoteles = $modelo->obtenerHotelesDestacados();

include 'views/home.php';