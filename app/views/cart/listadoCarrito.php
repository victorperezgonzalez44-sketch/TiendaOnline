<?php if (isset($resultado['error'])): ?>
    <p>
        <?= escapar($resultado['error']) ?>
    </p>
<?php endif; ?>

<?php if (isset($resultado['exito'])): ?>
    <p>
        <?= escapar($resultado['exito']) ?>
    </p>
<?php endif; ?>

<?php if (empty($items)) { ?>
    <p>No hay artículos en tu carrito aún</p>

    <?php

} else {
    $total = 0;

    foreach ($items as $productoCarrito) {
        $nombre = escapar($productoCarrito['nombre']);
        $talla = escapar($productoCarrito['talla']);
        $color = escapar($productoCarrito['color']);
        $precio = (float) $productoCarrito['precio'];
        $cantidad = (int) $productoCarrito['cantidad'];
        $subtotal = $precio * $cantidad;
        ?>
        <article>
            <h3><?= $nombre ?></h3>
            <p><?= $talla ?></p>
            <p><?= $color ?></p>
            <span class="price">
                <?= $cantidad ?> x <?= number_format((float) $precio, 2, ',', '.') ?> €
            </span>
            <form method="POST" action="?carrito">

                <input type="hidden" name="id_item_carrito" value="<?= (int) $productoCarrito['id_item_carrito'] ?>">

                <label>
                    Cantidad:
                    <input type="number" name="cantidad" value="<?= (int) $productoCarrito['cantidad'] ?>" min="1" required>
                </label>

                <button type="submit" name="accion" value="modificar">
                    Actualizar cantidad
                </button>

                <button type="submit" name="accion" value="eliminar">
                    Eliminar artículo
                </button>

            </form>
            <span class="subtotal-price">
                <?= number_format((float) $subtotal, 2, ',', '.') ?> €
            </span>
        </article>
        <?php
        $total += $subtotal;
    }
    ?>
    <h2>Total:
        <?= number_format($total, 2, ',', '.') ?> €
    </h2>
    <?php

}
?>