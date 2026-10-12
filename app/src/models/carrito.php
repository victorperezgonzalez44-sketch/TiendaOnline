<?php
function obtenerCarrito($pdo, $id_usuario)
{

    $consulta = $pdo->prepare("SELECT * FROM carritos WHERE id_usuario = :id_usuario");
    $consulta->execute([':id_usuario' => $id_usuario]);
    $carritoUsuario = $consulta->fetch(PDO::FETCH_ASSOC);



    return $carritoUsuario;


}

function crearCarrito($pdo, $id_usuario)
{

    $consulta = $pdo->prepare("INSERT INTO carritos(id_usuario) VALUES (:id_usuario)");
    $consulta->execute([':id_usuario' => $id_usuario]);


}

function obtenerOCrearCarrito($pdo, $id_usuario)
{

    $carrito = obtenerCarrito($pdo, $id_usuario);

    if ($carrito === false) {

        crearCarrito($pdo, $id_usuario);
        $carrito = obtenerCarrito($pdo, $id_usuario);

    }
    return $carrito;

}

function añadirAlCarrito($pdo, $id_carrito, $id_variante, $cantidad)
{
    $consulta = $pdo->prepare("SELECT cantidad FROM carrito_items WHERE id_carrito = :id_carrito AND id_variante = :id_variante");
    $consulta->execute([':id_carrito' => $id_carrito, ':id_variante' => $id_variante]);
    $item = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($item === false) {

        $consulta = $pdo->prepare("INSERT INTO carrito_items(id_carrito, id_variante, cantidad) VALUES (:id_carrito, :id_variante, :cantidad)");
        $consulta->execute([':id_carrito' => $id_carrito, ':id_variante' => $id_variante, ':cantidad' => $cantidad]);

    } else {

        $consulta = $pdo->prepare("UPDATE carrito_items SET cantidad = cantidad + :cantidad WHERE id_carrito = :id_carrito AND id_variante = :id_variante");
        $consulta->execute([':id_carrito' => $id_carrito, ':id_variante' => $id_variante, ':cantidad' => $cantidad]);

    }


}

function obtenerItemsCarrito($pdo, $id_carrito)
{

    $consulta = $pdo->prepare("SELECT carrito_items.cantidad,
                                        carrito_items.id_item_carrito,
                                        variantes.talla, 
                                        variantes.color, 
                                        productos.nombre, 
                                        productos.precio 
                                        FROM carrito_items 
                                        JOIN variantes 
                                            ON carrito_items.id_variante = variantes.id_variante 
                                        JOIN productos 
                                            ON variantes.id_producto = productos.id_producto
                                        WHERE carrito_items.id_carrito = :id_carrito");

    $consulta->execute([':id_carrito' => $id_carrito]);
    $items = $consulta->fetchALL(PDO::FETCH_ASSOC);
    return $items;

}