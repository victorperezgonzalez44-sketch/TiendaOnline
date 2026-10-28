
<?php if (isset($resultado['error'])): ?>
    <p class="alerta alerta-error">
        <?= escapar($resultado['error']) ?>
    </p>
<?php endif; ?>

<?php if (isset($resultado['exito'])): ?>
    <p class="alerta alerta-exito">
        <?= escapar($resultado['exito']) ?>
    </p>
<?php endif; ?>

<?php
$tallas = [];
$colores = [];

foreach ($producto['variantes'] as $variante) {
    $tallas[] = $variante['talla'];
    $colores[] = $variante['color'];
}

$tallas = array_unique($tallas);
$colores = array_unique($colores);
?>

<section class="producto-detalle">

    <div class="producto-visual" aria-hidden="true">
        <span class="producto-visual-marca">KAYROX</span>
        <div class="producto-visual-ornamento"></div>
        <span class="producto-visual-texto">DETALLES QUE HABLAN</span>
    </div>

    <article class="producto-info">

        <p class="producto-etiqueta">
            <?= escapar($producto['categoria']) ?>
        </p>

        <h1><?= escapar($producto['nombre']) ?></h1>

        <p class="producto-descripcion">
            <?= escapar($producto['descripcion']) ?>
        </p>

        <div class="producto-separador"></div>

        <p class="producto-precio">
            <?= number_format((float) $producto['precio'], 2, ',', '.') ?> €
        </p>

        <p class="producto-nota">Selecciona tus opciones</p>

        <form method="POST" class="producto-formulario">

            <div class="producto-campos">

                <div class="producto-campo">
                    <label for="talla">Talla</label>
                    <select name="talla" id="talla" required>
                        <?php foreach ($tallas as $talla): ?>
                            <option value="<?= escapar($talla) ?>">
                                <?= escapar($talla) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="producto-campo">
                    <label for="color">Color</label>
                    <select name="color" id="color" required>
                        <?php foreach ($colores as $color): ?>
                            <option value="<?= escapar($color) ?>">
                                <?= escapar($color) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

            <div class="producto-campo producto-cantidad">
                <label for="cantidad">Cantidad</label>
                <input
                    type="number"
                    name="cantidad"
                    id="cantidad"
                    value="1"
                    min="1"
                    required
                >
            </div>

            <button type="submit" class="producto-boton">
                Añadir al carrito
                <span aria-hidden="true">→</span>
            </button>

        </form>


    </article>

</section>
