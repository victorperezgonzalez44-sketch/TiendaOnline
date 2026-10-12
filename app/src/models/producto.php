<?php


function obtenerTodos($pdo)
{

    $consulta = $pdo->query("SELECT productos.*, categorias.nombre AS categoria FROM productos JOIN categorias ON productos.id_categoria = categorias.id_categoria");
    $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
    return $productos;


}
function obtenerPorID($pdo, $id_producto)
{

    $consultaProducto = $pdo->prepare('SELECT productos.*, categorias.nombre as categoria FROM productos JOIN categorias ON productos.id_categoria = categorias.id_categoria WHERE productos.id_producto = :id_producto ');
    $consultaVariantes = $pdo->prepare('SELECT variantes.* FROM variantes WHERE variantes.id_producto = :id_producto');

    $consultaProducto->execute([':id_producto' => $id_producto]);
    $consultaVariantes->execute([':id_producto' => $id_producto]);

    $producto = $consultaProducto->fetch(PDO::FETCH_ASSOC);
    $variantes = $consultaVariantes->fetchALL(PDO::FETCH_ASSOC);

    $producto['variantes'] = $variantes;
    return $producto;
}
?>