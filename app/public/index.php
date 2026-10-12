<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/models/producto.php';
require_once __DIR__ . '/../src/controllers/auth.php';
require_once __DIR__ . '/../src/models/carrito.php';


if (isset($_GET['registro'])) {

    $resultado = procesarRegistro($pdo);
    require_once __DIR__ . '/../views/auth/registro.php';



} elseif (isset($_GET['login'])) {

    $resultado = procesarLogin($pdo);
    require_once __DIR__ . '/../views/auth/login.php';

} elseif (isset($_GET['carrito'])) {

    if (isset($_SESSION['id_usuario'])) {

        $carrito = obtenerOCrearCarrito($pdo, $_SESSION['id_usuario']);

        $items = obtenerItemsCarrito($pdo, $carrito['id_carrito']);


        require_once __DIR__ . '/../views/cart/listadoCarrito.php';


    } else {

        $resultado = ['error' => 'Debes iniciar sesión para ver el carrito'];
        require_once __DIR__ . '/../views/cart/errorCarrito.php';

    }

} elseif (($_GET['id'] ?? "") !== "") {

    $producto = obtenerPorID($pdo, $_GET['id']);

    $id_variante = null;
    $cant_stock = 0;

    if (isset($_POST['talla'], $_POST['color'], $_POST['cantidad'])) {

        $cantidadParaPedir = (int) $_POST['cantidad'];
        if ($cantidadParaPedir >= 1) {

            foreach ($producto['variantes'] as $variante) {

                if ($variante['talla'] === $_POST['talla'] && $variante['color'] === $_POST['color']) {
                    $id_variante = $variante['id_variante'];
                    $cant_stock = $variante['stock'];
                    break;
                }
            }
            if (isset($_SESSION['id_usuario'])) {

                if ($cant_stock >= $cantidadParaPedir) {

                    $carrito = obtenerOCrearCarrito($pdo, $_SESSION['id_usuario']);
                    $id_carrito = $carrito['id_carrito'];
                    añadirAlCarrito($pdo, $id_carrito, $id_variante, $cantidadParaPedir);

                    $resultado = ['exito' => 'Producto añadido al carrito'];


                } else {

                    $resultado = ['error' => 'No hay suficiente stock'];

                }

            } else {
                $resultado = ['error' => 'Debes iniciar sesión para añadir al carrito'];
            }



        }



    }


    require_once __DIR__ . '/../views/products/detalle.php';

} else {
    $productos = obtenerTodos($pdo);
    require_once __DIR__ . '/../views/products/listado.php';
}




?>