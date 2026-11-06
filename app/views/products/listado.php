<h1>
    <?= isset($nombreCategoria)
        ? escapar($nombreCategoria)
        : 'Todos los productos' ?>
</h1>
<p>
    <?= isset($nombreCategoria)
        ? 'Descubre nuestra colección de ' . escapar(strtolower($nombreCategoria))
        : 'Descubre todos los productos de Kayrox' ?>
</p>
<section class="productos">
    <?php foreach ($productos as $producto): ?>
        <a href="?id=<?= $producto['id_producto'] ?>">
            <article class="card-producto">

                <div class="producto-visual card-producto-visual" aria-hidden="true">
                    <span class="producto-visual-marca">KAYROX</span>
                    <div class="producto-visual-ornamento"></div>
                    <span class="producto-visual-texto">DETALLES QUE HABLAN</span>
                </div>

                <h2>
                    <?= $producto['nombre'] ?>
                </h2>
                <p class="producto-etiqueta">
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