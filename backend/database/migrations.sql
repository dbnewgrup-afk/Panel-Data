-- ===========================================
-- DATABASE SCHEMA PANEL-DATA
-- ===========================================

-- Drop tables if exists (optional)
DROP TABLE IF EXISTS order_logs;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS settings;
DROP TABLE IF EXISTS users;

-- ==============================
-- TABEL USERS
-- ==============================
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ==============================
-- TABEL SETTINGS (key-value)
-- ==============================
CREATE TABLE `settings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(100) NOT NULL UNIQUE,
    `value` TEXT,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ==============================
-- TABEL ORDERS
-- ==============================
CREATE TABLE `orders` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `product_code` VARCHAR(50) NOT NULL,
    `target_number` VARCHAR(50) NOT NULL,
    `price_cost` DECIMAL(12,2) NOT NULL,
    `price_selling` DECIMAL(12,2) NOT NULL,
    `status` ENUM('pending','processing','success','failed') DEFAULT 'pending',
    `digiflazz_ref` VARCHAR(100),
    `tokoku_ref` VARCHAR(100),
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- ==============================
-- TABEL ORDER LOGS
-- ==============================
CREATE TABLE `order_logs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `type` VARCHAR(100) NOT NULL,
    `direction` ENUM('inbound','outbound') NOT NULL,
    `payload` TEXT NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE
);
