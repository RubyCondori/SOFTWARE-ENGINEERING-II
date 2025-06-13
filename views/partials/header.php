<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HostP - Sistema de Reservas Hoteleras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header class="header-principal">
        <nav class="navegacion">
            <a href="/" class="logo"><i class="fas fa-hotel"></i> HostP</a>
            <ul class="menu">
                <li><a href="/hoteles.php"><i class="fas fa-bed"></i> Hoteles</a></li>
                <li><a href="/blog.php"><i class="fas fa-blog"></i> Blog</a></li>
                <li><a href="/contacto.php"><i class="fas fa-envelope"></i> Contacto</a></li>
                <?php if(isset($_SESSION['usuario'])): ?>
                    <li><a href="/admin"><i class="fas fa-user-cog"></i> Panel</a></li>
                <?php else: ?>
                    <li><a href="/login.php"><i class="fas fa-sign-in-alt"></i> Ingresar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>