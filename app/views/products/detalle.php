<?php if (isset($resultado['error'])): ?>

    <p><?= $resultado['error'] ?></p>

<?php endif ?>

<?php if (isset($resultado['exito'])): ?>
    
    <p><?= $resultado['exito'] ?></p>

<?php endif ?>

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

<article>
    <h1>
        <?= $producto['nombre'] ?>
    </h1>
    <h2>
        <?= $producto['categoria'] ?>
    </h2>
    <p>
        <?= $producto['descripcion'] ?>
    </p>
    <form method="POST">
        <select name="talla">
            <?php foreach ($tallas as $talla): ?>
                <option value="<?= $talla ?>">
                    <?= $talla ?>
                </option>
            <?php endforeach ?>
        </select>
        <select name="color">
            <?php foreach ($colores as $color): ?>
                <option value="<?= $color ?>">
                    <?= $color ?>
                </option>
            <?php endforeach ?>
        </select>
        <input type="number" name="cantidad" value="1" min="1">
        <button type="submit">Añadir al carrito</button>
    </form>

    <strong>
        <?= $producto['precio'] ?> €
    </strong>


</article>