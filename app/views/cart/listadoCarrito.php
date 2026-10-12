<?php
if ($items === "") {
    $resultado = ['error' => 'No hay artículos en tu carrito aún'];
}
foreach ($items as $productoCarrito) {
    $nombre = $productoCarrito['nombre'];
    $talla = $productoCarrito['talla'];
    $color = $productoCarrito['color'];
    $precio = (int) $productoCarrito['precio'];
}


?>