<?php
function obtenerCarrito($pdo, $id_usuario)
{

    $consulta = $pdo->prepare("SELECT * 
                                FROM carritos 
                                WHERE id_usuario = :id_usuario");
    $consulta->execute([':id_usuario' => $id_usuario]);
    $carritoUsuario = $consulta->fetch(PDO::FETCH_ASSOC);



    return $carritoUsuario;


}

function crearCarrito($pdo, $id_usuario)
{

    $consulta = $pdo->prepare("INSERT INTO carritos(id_usuario) 
                                        VALUES (:id_usuario)");
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
    if (!is_numeric($cantidad) || (int) $cantidad < 1) {
        return 'cantidad_invalida';
    }
    $cantidad = (int) $cantidad;

    $consulta = $pdo->prepare("SELECT stock
                                FROM variantes
                                WHERE id_variante = :id_variante");

    $consulta->execute([
        ':id_variante' => $id_variante
    ]);

    $variante = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($variante === false) {
        return 'variante_no_encontrada';
    }

    $stock = (int) $variante['stock'];

    $consulta = $pdo->prepare("SELECT cantidad 
                                FROM carrito_items 
                                WHERE id_carrito = :id_carrito 
                                AND id_variante = :id_variante");
    $consulta->execute([':id_carrito' => $id_carrito, ':id_variante' => $id_variante]);
    $item = $consulta->fetch(PDO::FETCH_ASSOC);

    $cantidadActual = $item === false ? 0 : (int) $item['cantidad'];

    if ($cantidadActual + $cantidad > $stock) {
        return 'stock_insuficiente';
    }

    if ($item === false) {

        $consulta = $pdo->prepare("INSERT INTO carrito_items(id_carrito, id_variante, cantidad) VALUES (:id_carrito, :id_variante, :cantidad)");
        $consulta->execute([':id_carrito' => $id_carrito, ':id_variante' => $id_variante, ':cantidad' => $cantidad]);

    } else {

        $consulta = $pdo->prepare("UPDATE carrito_items SET cantidad = cantidad + :cantidad WHERE id_carrito = :id_carrito AND id_variante = :id_variante");
        $consulta->execute([':id_carrito' => $id_carrito, ':id_variante' => $id_variante, ':cantidad' => $cantidad]);

    }
    return 'ok';


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

function modificarCantidadCarrito($pdo, $id_carrito, $id_item_carrito, $cantidad)
{
    $consulta = $pdo->prepare("SELECT variantes.stock
                                FROM variantes
                                JOIN carrito_items
                                    ON carrito_items.id_variante = variantes.id_variante
                                WHERE carrito_items.id_item_carrito = :id_item_carrito
                                AND carrito_items.id_carrito = :id_carrito");
    $consulta->execute([
        ':id_item_carrito' => $id_item_carrito,
        ':id_carrito' => $id_carrito
    ]);

    $item = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($item === false) {
        return "No encontrado";
    }

    if ($cantidad < 1) {
        return "Cantidad invalida";
    }
    $stock = (int) $item['stock'];

    if ($cantidad > $stock) {
        return "No hay suficiente stock";
    }

    $consulta = $pdo->prepare("UPDATE carrito_items
                                SET cantidad = :cantidad
                                WHERE carrito_items.id_item_carrito = :id_item_carrito
                                AND id_carrito = :id_carrito
    
    ");
    $consulta->execute([
        ':cantidad' => $cantidad,
        ':id_item_carrito' => $id_item_carrito,
        ':id_carrito' => $id_carrito
    ]);

    return 'ok';

}

function eliminarDelCarrito($pdo, $id_carrito, $id_item_carrito)
{
    $consulta = $pdo->prepare("DELETE FROM carrito_items
                                WHERE carrito_items.id_item_carrito = :id_item_carrito
                                AND carrito_items.id_carrito = :id_carrito");
    $consulta->execute([
        ':id_item_carrito' => $id_item_carrito,
        ':id_carrito' => $id_carrito
    ]);

    return $consulta->rowCount() > 0;

}
