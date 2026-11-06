<section class="homepage">

    <section class="featured-products" id="productos-destacados">

        <div class="section-heading">
            <div class="section-heading-inner">
                <div>
                    <span class="section-eyebrow">KAYROX COLLECTION</span>
                    <h2>Productos destacados</h2>
                    <p>Descubre los detalles que marcan la diferencia.</p>
                </div>

                <div class="carousel-controls">
                    <button type="button" class="carousel-button" id="carousel-prev" aria-label="Productos anteriores">
                        &#8592;
                    </button>
                    <button type="button" class="carousel-button" id="carousel-next" aria-label="Productos siguientes">
                        &#8594;
                    </button>
                </div>
            </div>
        </div>

        <div class="products-carousel" id="products-carousel">

            <?php if (!empty($productos)): ?>

                <?php foreach (array_slice($productos, 0, 8) as $producto): ?>

                    <article class="featured-product-card">

                        <a href="?id=<?= (int) $producto['id_producto'] ?>" class="featured-product-link">
                            <div class="featured-product-image">
                                <span>KAYROX</span>
                            </div>

                            <div class="featured-product-info">
                                <span class="featured-product-category">
                                    <?= escapar($producto['categoria']) ?>
                                </span>

                                <h3>
                                    <?= escapar($producto['nombre']) ?>
                                </h3>

                                <p class="featured-product-price">
                                    <?= number_format((float) $producto['precio'], 2, ',', '.') ?> €
                                </p>
                            </div>
                        </a>

                    </article>

                <?php endforeach; ?>

            <?php else: ?>

                <p>No hay productos disponibles actualmente.</p>

            <?php endif; ?>

        </div>

        <div class="featured-products-footer">
            <a href="?productos" class="view-all-products">
                Ver todos los productos
                <span>&rarr;</span>
            </a>
        </div>

    </section>

    <section class="categories-section" id="categorias">

        <div class="section-heading">
            <div class="section-heading-inner">
                <div>
                    <span class="section-eyebrow">ENCUENTRA TU ESTILO</span>
                    <h2>Explora por categoría</h2>
                    <p>Encuentra los detalles que mejor encajan contigo.</p>
                </div>
            </div>
        </div>
        <div class="categories-grid">

            <?php foreach ($categorias as $categoria): ?>

                <a href="?productos&categoria=<?= (int) $categoria['id_categoria'] ?>" class="category-card">

                    <div class="category-image">
                        <span>
                            <?= escapar($categoria['nombre']) ?>
                        </span>
                    </div>

                </a>

            <?php endforeach; ?>

        </div>
    </section>
</section>