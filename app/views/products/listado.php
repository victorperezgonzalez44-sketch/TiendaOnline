<h1>Productos Kayrox</h1>
<section class="productos">
    <?php foreach ($productos as $producto): ?>
        <a href="?id=<?= $producto['id_producto'] ?>">
            <article class="card-producto">
                <h2>
                    <?= $producto['nombre'] ?>
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
        </a>
    <?php endforeach; ?>
</section>