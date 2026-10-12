<h1>Productos Kayrox</h1>
<?php foreach ($productos as $producto): ?>

    <article>
        <h2>
            <a href="?id=<?= $producto['id_producto'] ?>">
                <?= $producto['nombre'] ?>
            </a>
        </h2>
        <p>
            <?= $producto['categoria'] ?>
        </p>
        <p>
            <?= $producto['descripcion'] ?>
        </p>
        <strong>
            <?= $producto['precio'] ?> €
        </strong>
    </article>

<?php endforeach; ?>