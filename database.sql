-- database.sql
DROP DATABASE IF EXISTS srs_db;

CREATE DATABASE srs_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE srs_db;

-- users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') NOT NULL DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- orders table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- order_items table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- sample admin user (password: Admin@123) -- change in production
INSERT INTO
    users (
        fullname,
        email,
        password,
        role
    )
VALUES (
        'Admin User',
        'admin@example.com',
        '$2y$10$v1b9d3h2O1qH0q3W6qj3yu2NnP8R0G1o8QhF1z6dGuE4c5xqf9V6G',
        'admin'
    );
-- password hashed with password_hash('Admin@123', PASSWORD_DEFAULT)

-- sample products
INSERT INTO
    products (
        name,
        description,
        price,
        stock
    )
VALUES (
        'White T-Shirt',
        'Comfortable cotton t-shirt, unisex.',
        129.99,
        25
    ),
    (
        'Black Jeans',
        'Slim-fit black jeans.',
        599.00,
        12
    ),
    (
        'Running Shoes',
        'Lightweight running shoes.',
        899.50,
        8
    );