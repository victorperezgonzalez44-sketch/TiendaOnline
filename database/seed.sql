USE kayrox;

-- ======================================================
-- CATEGORÍAS
-- ======================================================

INSERT INTO categorias (nombre) VALUES
('Relojes'),
('Anillos'),
('Cadenas'),
('Pulseras');


-- ======================================================
-- USUARIOS
-- ======================================================

INSERT INTO usuarios (nombre, apellidos, email, password, rol) VALUES
('Victor', 'Pérez González', 'victor@kayrox.test', '$2y$10$abcdefghijklmnopqrstuu', 'cliente'),
('Admin', 'Kayrox', 'admin@kayrox.test', '$2y$10$abcdefghijklmnopqrstuu', 'admin');


-- ======================================================
-- PRODUCTOS
-- ======================================================

INSERT INTO productos
(id_categoria, nombre, descripcion, precio)
VALUES

(1, 'Chronos Black',
 'Reloj de diseño minimalista con acabado negro y esfera oscura.',
 89.99),

(1, 'Chronos Silver',
 'Reloj elegante con caja plateada y diseño contemporáneo.',
 94.99),

(2, 'Eclipse Ring',
 'Anillo masculino de acabado negro mate.',
 29.99),

(2, 'Titan Ring',
 'Anillo de diseño robusto con acabado metálico.',
 34.99),

(3, 'Venom Chain',
 'Cadena de estilo urbano con acabado oscuro.',
 49.99),

(3, 'Classic Chain',
 'Cadena minimalista para uso diario.',
 39.99),

(4, 'Shadow Bracelet',
 'Pulsera masculina de diseño oscuro y minimalista.',
 24.99),

(4, 'Steel Bracelet',
 'Pulsera metálica de estilo elegante.',
 32.99);


-- ======================================================
-- VARIANTES
-- ======================================================

INSERT INTO variantes
(id_producto, talla, color, stock)
VALUES

-- Chronos Black
(1, 'Única', 'Negro', 10),

-- Chronos Silver
(2, 'Única', 'Plata', 8),

-- Eclipse Ring
(3, '18', 'Negro', 5),
(3, '20', 'Negro', 7),
(3, '22', 'Negro', 4),
(3, '18', 'Plata', 5),
(3, '20', 'Plata', 7),
(3, '22', 'Plata', 4),

-- Titan Ring
(4, '18', 'Plata', 6),
(4, '20', 'Plata', 8),
(4, '22', 'Plata', 5),

-- Venom Chain
(5, '50 cm', 'Negro', 9),
(5, '60 cm', 'Negro', 6),

-- Classic Chain
(6, '50 cm', 'Plata', 10),
(6, '60 cm', 'Plata', 7),

-- Shadow Bracelet
(7, 'Única', 'Negro', 12),

-- Steel Bracelet
(8, 'Única', 'Plata', 9);


-- ======================================================
-- CARRITOS
-- ======================================================

INSERT INTO carritos
(id_usuario)
VALUES
(1),
(2);


-- ======================================================
-- ELEMENTOS DEL CARRITO
-- ======================================================

INSERT INTO carrito_items
(id_carrito, id_variante, cantidad)
VALUES

-- Carrito de Victor
(1, 3, 1),
(1, 9, 1),
(1, 13, 2);


-- ======================================================
-- PEDIDOS
-- ======================================================

INSERT INTO pedidos
(id_usuario, estado, total)
VALUES

(1, 'entregado', 79.97),
(1, 'pendiente', 89.99);


-- ======================================================
-- ELEMENTOS DE LOS PEDIDOS
-- ======================================================

INSERT INTO pedido_items
(id_pedido, id_variante, cantidad, precio)
VALUES

-- Pedido 1
(1, 3, 1, 29.99),
(1, 9, 1, 49.99),

-- Pedido 2
(2, 1, 1, 89.99);