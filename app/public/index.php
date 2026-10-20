<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/models/producto.php';
require_once __DIR__ . '/../src/controllers/auth.php';
require_once __DIR__ . '/../src/models/carrito.php';
require_once __DIR__ . '/../src/controllers/functions.php';

if (isset($_GET['registro'])) {
    $title = "Registro";
    $resultado = procesarRegistro($pdo);
    require_once __DIR__ . '/../views/layouts/header.php';
    require_once __DIR__ . '/../views/auth/registro.php';
    require_once __DIR__ . '/../views/layouts/footer.php';



} elseif (isset($_GET['login'])) {
    $title = "Login";
    $resultado = procesarLogin($pdo);
    require_once __DIR__ . '/../views/layouts/header.php';
    require_once __DIR__ . '/../views/auth/login.php';
    require_once __DIR__ . '/../views/layouts/footer.php';

} elseif (isset($_GET['carrito'])) {

    if (isset($_SESSION['id_usuario'])) {

        $carrito = obtenerOCrearCarrito($pdo, $_SESSION['id_usuario']);
        $id_carrito = (int) $carrito['id_carrito'];
        $title = "Carrito";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $accion = $_POST['accion'] ?? '';
            $id_item_carrito = filter_var($_POST['id_item_carrito'] ?? '', FILTER_VALIDATE_INT);

            if ($id_item_carrito === false || $id_item_carrito < 1) {

                $resultado = [
                    'error' => 'El artículo seleccionado no es válido'
                ];

            } elseif ($accion === 'modificar') {

                $cantidad = filter_var($_POST['cantidad'] ?? '', FILTER_VALIDATE_INT);

                if ($cantidad === false || $cantidad < 1) {

                    $resultado = [
                        'error' => 'La cantidad debe ser como mínimo 1'
                    ];

                } else {

                    $respuesta = modificarCantidadCarrito($pdo, $id_carrito, $id_item_carrito, $cantidad);

                    if ($respuesta === 'ok') {

                        $resultado = [
                            'exito' => 'Cantidad actualizada correctamente'
                        ];

                    } elseif ($respuesta === 'No hay suficiente stock') {

                        $resultado = [
                            'error' => 'No hay suficiente stock disponible'
                        ];

                    } else {

                        $resultado = [
                            'error' => 'No se ha podido actualizar el artículo'
                        ];
                    }
                }

            } elseif ($accion === 'eliminar') {

                $eliminado = eliminarDelCarrito($pdo, $id_carrito, $id_item_carrito);

                if ($eliminado) {

                    $resultado = [
                        'exito' => 'Artículo eliminado del carrito'
                    ];

                } else {

                    $resultado = [
                        'error' => 'No se ha encontrado el artículo en tu carrito'
                    ];
                }

            } else {

                $resultado = [
                    'error' => 'La acción solicitada no es válida'
                ];
            }
            $_SESSION['mensaje_carrito'] = $resultado;
            header('Location: ?carrito', true, 303);
            exit;
        }
        $resultado = $_SESSION['mensaje_carrito'] ?? [];
        unset($_SESSION['mensaje_carrito']);

        $items = obtenerItemsCarrito($pdo, $id_carrito);

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/cart/listadoCarrito.php';
        require_once __DIR__ . '/../views/layouts/footer.php';


    } else {

        $resultado = ['error' => 'Debes iniciar sesión para ver el carrito'];
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/cart/errorCarrito.php';
        require_once __DIR__ . '/../views/layouts/footer.php';


    }

} elseif (($_GET['id'] ?? "") !== "") {

    $id_producto = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if ($id_producto === false || $id_producto < 1) {
        http_response_code(400);
        exit('El identificador del producto no es válido');
    }

    $producto = obtenerPorID($pdo, $id_producto);
    $title = $producto['nombre'];

    if ($producto === false) {
        http_response_code(404);
        exit('Producto no encontrado');
    }


    if (isset($_POST['talla'], $_POST['color'], $_POST['cantidad'])) {

        $cantidadParaPedir = filter_var($_POST['cantidad'], FILTER_VALIDATE_INT);

        if ($cantidadParaPedir === false || $cantidadParaPedir < 1) {
            $resultado = [
                'error' => 'La cantidad debe ser un número entero mayor que 0'
            ];
        } else {

            $id_variante = null;

            foreach ($producto['variantes'] as $variante) {

                if ($variante['talla'] === $_POST['talla'] && $variante['color'] === $_POST['color']) {
                    $id_variante = $variante['id_variante'];
                    break;
                }

            }
            if ($id_variante === null) {
                $resultado = [
                    'error' => 'La talla y el color seleccionados no están disponibles'
                ];

            } elseif (isset($_SESSION['id_usuario'])) {

                $carrito = obtenerOCrearCarrito($pdo, $_SESSION['id_usuario']);
                $id_carrito = $carrito['id_carrito'];
                $respuesta = añadirAlCarrito($pdo, $id_carrito, $id_variante, $cantidadParaPedir);

                if ($respuesta === 'ok') {
                    $resultado = ['exito' => 'Producto añadido al carrito'];

                } elseif ($respuesta === 'stock_insuficiente') {
                    $resultado = ['error' => 'No hay suficiente stock para esa cantidad'];

                } elseif ($respuesta === 'variante_no_encontrada') {
                    $resultado = ['error' => 'La variante seleccionada no existe'];

                } else {
                    $resultado = ['error' => 'La cantidad indicada no es válida'];
                }

            } else {
                $resultado = ['error' => 'Debes iniciar sesión para añadir al carrito'];
            }



        }



    }



    require_once __DIR__ . '/../views/layouts/header.php';
    require_once __DIR__ . '/../views/products/detalle.php';
    require_once __DIR__ . '/../views/layouts/footer.php';

} else {
    $title = "Catálogo";
    $productos = obtenerTodos($pdo);
    require_once __DIR__ . '/../views/layouts/header.php';
    require_once __DIR__ . '/../views/products/listado.php';
    require_once __DIR__ . '/../views/layouts/footer.php';
}

?>