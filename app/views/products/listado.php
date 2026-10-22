<h1>Productos Kayrox</h1>
<section class="productos">
    <?php foreach ($productos as $producto): ?>

        <article class="card-producto">
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
            <p>
                <strong>
                    <?= $producto['precio'] ?> €
                </strong>
            </p>

        </article>

    <?php endforeach; ?>
</section>