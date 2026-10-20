<?php
$usuarioAutenticado = isset($_SESSION['id_usuario']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#094040">
    <title><?= escapar($title ?? 'Kayrox') ?> | Kayrox</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

    <header class="site-header">
        <div class="header-container">

            <a class="logo" href="./" aria-label="Kayrox, inicio">
                KAYROX<span>.</span>
            </a>

            <nav class="main-nav" aria-label="Navegación principal">
                <a href="./">Inicio</a>
                <a href="./#productos">Productos</a>
            </nav>

            <div class="header-actions">

                <a class="header-icon" href="<?= $usuarioAutenticado ? '?carrito' : '?login' ?>"
                    aria-label="Ver carrito" title="Carrito">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 3h2l2.2 11.2a2 2 0 0 0 2 1.6h8.9a2 2 0 0 0 2-1.6L22 8H6" />
                        <circle cx="10" cy="20" r="1" />
                        <circle cx="18" cy="20" r="1" />
                    </svg>
                </a>

                <a class="header-icon" href="<?= $usuarioAutenticado ? '?cuenta' : '?login' ?>" aria-label="Mi cuenta"
                    title="Mi cuenta">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 21v-2a8 8 0 0 1 16 0v2" />
                    </svg>
                </a>

            </div>
        </div>
    </header>

    <main class="site-main">