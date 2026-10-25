<section class="carrito-container">
    <?php if (isset($resultado['error'])): ?>
        <p class="alerta alerta-error"><?= escapar($resultado['error']) ?></p>
    <?php endif; ?>

    <?php if (isset($resultado['exito'])): ?>
        <p class="alerta alerta-exito"><?= escapar($resultado['exito']) ?></p>
    <?php endif; ?>

    <?php if (empty($items)) { ?>
        <p class="carrito-vacio">No hay artículos en tu carrito aún</p>
    <?php } else { 
        $total = 0;
        ?>
        <div class="carrito-lista">
            <?php foreach ($items as $productoCarrito) {
                $nombre = escapar($productoCarrito['nombre']);
                $talla = escapar($productoCarrito['talla']);
                $color = escapar($productoCarrito['color']);
                $precio = (float) $productoCarrito['precio'];
                $cantidad = (int) $productoCarrito['cantidad'];
                $subtotal = $precio * $cantidad;
                ?>
                <article class="carrito-item">
                    
                    <div class="item-info">
                        <h3><?= $nombre ?></h3>
                        <p class="item-meta">Talla: <span><?= $talla ?></span> • Color: <span><?= $color ?></span></p>
                        <div class="item-precio-base">
                            <?= number_format((float) $precio, 2, ',', '.') ?> € / unidad
                        </div>
                    </div>

                    <form method="POST" action="?carrito" class="item-controles">
                        <input type="hidden" name="id_item_carrito" value="<?= (int) $productoCarrito['id_item_carrito'] ?>">
                        
                        <div class="controles-fila">
                            <label class="form-cantidad">
                                <span>Cant:</span>
                                <input type="number" name="cantidad" value="<?= (int) $productoCarrito['cantidad'] ?>" min="1" required>
                            </label>
                            
                            <button type="submit" name="accion" value="modificar" class="btn-action btn-update" title="Actualizar cantidad">
                                🔄 <span>Actualizar</span>
                            </button>
                            
                            <button type="submit" name="accion" value="eliminar" class="btn-action btn-delete" title="Eliminar artículo">
                                🗑️ <span>Eliminar</span>
                            </button>
                        </div>
                    </form>

                    <div class="item-subtotal">
                        <span class="subtotal-label">Subtotal</span>
                        <span class="subtotal-price"><?= number_format((float) $subtotal, 2, ',', '.') ?> €</span>
                    </div>

                </article>
                <?php
                $total += $subtotal;
            }
            ?>
        </div>

        <div class="carrito-total">
            <h2>Total: <span><?= number_format($total, 2, ',', '.') ?> €</span></h2>
        </div>
    <?php } ?>
</section>
