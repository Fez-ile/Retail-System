
-- users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') NOT NULL DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- order_items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- sample admin user  
INSERT INTO users (fullname, email, password, role)
VALUES ('Admin User', 'admin@example.com', '$2y$10$v1b9d3h2O1qH0q3W6qj3yu2NnP8R0G1o8QhF1z6dGuE4c5xqf9V6G', 'admin');

-- sample products replaced with AMMS curated collection
INSERT INTO products (name, description, price, stock, created_at)
VALUES
('Signature Tailored Blazer','Structured black blazer with a sharp silhouette.',3499.00,8,CURRENT_TIMESTAMP),
('Classic White Overshirt','Premium cotton overshirt with a relaxed fit.',1799.00,12,'2025-06-01 10:00:00'),
('Structured Black Trousers','Tailored straight-leg trousers with refined detailing.',2199.00,10,'2025-05-25 11:00:00'),
('Minimal Crewneck Tee','Heavyweight cotton tee with a clean finish.',899.00,30,'2025-04-10 09:00:00'),
('Longline Wool Coat','Statement outerwear with a timeless cut.',4999.00,5,CURRENT_TIMESTAMP),
('Monochrome Knit Sweater','Soft knit with a minimalist silhouette.',1699.00,14,'2025-03-20 12:00:00'),
('Relaxed Tailored Shirt','Versatile essential with structured lines.',1599.00,18,'2025-02-28 08:00:00'),
('Wide-Leg Tailored Pants','Fluid silhouette with elevated tailoring.',2299.00,9,'2025-05-15 14:00:00'),
('Essential Zip Hoodie','Premium fabric with subtle structure.',1499.00,20,'2025-01-10 10:30:00'),
('Slim Fit Black Jeans','Clean-cut denim with a modern edge.',1899.00,16,'2025-04-01 13:00:00'),
('Oversized Wool Scarf','Soft wool accessory in monochrome tones.',999.00,25,'2024-12-15 09:15:00'),
('Structured Leather Belt','Minimal hardware with premium finish.',799.00,40,'2024-11-05 10:00:00'),
('Classic White Sneakers','Minimal leather sneakers with sleek detailing.',2499.00,7,'2025-06-02 09:00:00'),
('Black Leather Loafers','Refined silhouette with polished finish.',2899.00,6,'2025-05-20 15:30:00'),
('Cropped Utility Jacket','Structured jacket with modern edge.',2699.00,11,'2025-03-01 16:00:00'),
('Ribbed Tank Top','Fitted essential with clean lines.',699.00,28,'2024-10-10 08:00:00'),
('Tailored Shorts','Sharp-cut shorts with refined structure.',1399.00,13,'2024-11-20 09:45:00'),
('Minimalist Crossbody Bag','Compact design with smooth leather texture.',1999.00,10,CURRENT_TIMESTAMP),
('Structured Tote Bag','Spacious tote with arc)hitectural design.',2999.00,8,'2025-02-15 11:30:00'),
('Monochrome Beanie','Soft knit beanie in versatile tones.',499.00,30,'2024-12-01 10:00:00');
