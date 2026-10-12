CREATE DATABASE IF NOT EXISTS kayrox
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE kayrox;


-- =========================================
-- USUARIOS
-- =========================================

CREATE TABLE usuarios (
    id_usuario INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    rol VARCHAR(20) NOT NULL DEFAULT 'cliente'
);


-- =========================================
-- CATEGORIAS
-- =========================================

CREATE TABLE categorias (
    id_categoria INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);


-- =========================================
-- PRODUCTOS
-- =========================================

CREATE TABLE productos (
    id_producto INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT UNSIGNED NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (id_categoria)
        REFERENCES categorias(id_categoria)
);


-- =========================================
-- VARIANTES
-- =========================================

CREATE TABLE variantes (
    id_variante INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_producto INT UNSIGNED NOT NULL,
    talla VARCHAR(30) NOT NULL,
    color VARCHAR(30) NOT NULL,
    stock INT UNSIGNED NOT NULL DEFAULT 0,

    FOREIGN KEY (id_producto)
        REFERENCES productos(id_producto)
);


-- =========================================
-- CARRITOS
-- =========================================

CREATE TABLE carritos (
    id_carrito INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT UNSIGNED NOT NULL,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_usuario)
        REFERENCES usuarios(id_usuario)
);


-- =========================================
-- CARRITO_ITEMS
-- =========================================

CREATE TABLE carrito_items (
    id_item_carrito INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_carrito INT UNSIGNED NOT NULL,
    id_variante INT UNSIGNED NOT NULL,
    cantidad INT UNSIGNED NOT NULL DEFAULT 1,

    FOREIGN KEY (id_carrito)
        REFERENCES carritos(id_carrito),

    FOREIGN KEY (id_variante)
        REFERENCES variantes(id_variante)
);


-- =========================================
-- PEDIDOS
-- =========================================

CREATE TABLE pedidos (
    id_pedido INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT UNSIGNED NOT NULL,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(30) NOT NULL DEFAULT 'pendiente',
    total DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (id_usuario)
        REFERENCES usuarios(id_usuario)
);


-- =========================================
-- PEDIDO_ITEMS
-- =========================================

CREATE TABLE pedido_items (
    id_item INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT UNSIGNED NOT NULL,
    id_variante INT UNSIGNED NOT NULL,
    cantidad INT UNSIGNED NOT NULL,
    precio DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (id_pedido)
        REFERENCES pedidos(id_pedido),

    FOREIGN KEY (id_variante)
        REFERENCES variantes(id_variante)
);