-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Des 2025 pada 05.28
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `panel_data`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `target_number` varchar(50) NOT NULL,
  `price_cost` decimal(12,2) NOT NULL,
  `price_selling` decimal(12,2) NOT NULL,
  `status` enum('pending','processing','success','failed') DEFAULT 'pending',
  `digiflazz_ref` varchar(100) DEFAULT NULL,
  `tokoku_ref` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `provider_msg` text DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  `provider_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_code`, `target_number`, `price_cost`, `price_selling`, `status`, `digiflazz_ref`, `tokoku_ref`, `created_at`, `updated_at`, `provider_msg`, `finished_at`, `provider_status`) VALUES
(1, 4, 'TEST001', '08123456789', 10000.00, 10000.00, 'pending', 'DFZ-1764854566-0a395a', NULL, '2025-12-04 20:22:46', '2025-12-04 20:22:46', NULL, NULL, NULL),
(2, 4, 'TEST001', '08123456789', 10000.00, 10000.00, 'pending', 'DFZ-1764855069-6d77b3', NULL, '2025-12-04 20:31:09', '2025-12-04 20:31:09', NULL, NULL, NULL),
(3, 4, 'TEST001', '08123456789', 10000.00, 10000.00, 'pending', 'DFZ-1764855853-2c1d41', NULL, '2025-12-04 20:44:13', '2025-12-04 20:44:13', NULL, NULL, NULL),
(4, 4, 'TEST001', '08123456789', 10000.00, 10000.00, 'success', 'DFZ-1764855897-ca5d7d', NULL, '2025-12-04 20:44:57', '2025-12-04 20:44:57', NULL, NULL, NULL),
(5, 4, 'C0004001', '48641618761', 320000.00, 320000.00, 'success', 'DFZ-1764871794-ecc784', NULL, '2025-12-05 01:09:54', '2025-12-05 01:11:47', NULL, NULL, NULL),
(6, 4, 'C0004001', '48641618761', 320000.00, 320000.00, 'pending', 'DFZ-1764871901-1aba87', NULL, '2025-12-05 01:11:41', '2025-12-05 01:11:41', NULL, NULL, NULL),
(7, 4, 'C0004001', '48461618761', 320000.00, 320000.00, 'pending', 'DFZ-1764874258-6254b8', NULL, '2025-12-05 01:50:58', '2025-12-05 01:50:58', NULL, NULL, NULL),
(8, 4, 'C0004001', '48461618761', 320000.00, 320000.00, 'pending', 'DFZ-1764874358-498f1b', NULL, '2025-12-05 01:52:38', '2025-12-05 01:52:38', NULL, NULL, NULL),
(9, 4, 'C0004001', '48461618761', 320000.00, 320000.00, 'pending', 'DFZ-1764874401-c426b9', NULL, '2025-12-05 01:53:21', '2025-12-05 01:53:21', NULL, NULL, NULL),
(10, 4, 'C0004001', '48461618761', 320000.00, 320000.00, 'pending', 'DFZ-1764874517-c0b45b', NULL, '2025-12-05 01:55:17', '2025-12-05 01:55:17', NULL, NULL, NULL),
(11, 4, 'C0004001', '48461618761', 320000.00, 320000.00, 'pending', 'DFZ-1764874611-f545b2', NULL, '2025-12-05 01:56:51', '2025-12-05 01:56:51', NULL, NULL, NULL),
(12, 4, 'C0004001', '48461618761', 320000.00, 320000.00, 'pending', 'DFZ-1764874752-210958', NULL, '2025-12-05 01:59:12', '2025-12-05 01:59:12', NULL, NULL, NULL),
(13, 4, 'C0004001', '48461618761', 320000.00, 320000.00, 'pending', 'DFZ-1764875195-6fab0c', NULL, '2025-12-05 02:06:35', '2025-12-05 02:06:35', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_logs`
--

CREATE TABLE `order_logs` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `source` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `payload` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_logs`
--

INSERT INTO `order_logs` (`id`, `order_id`, `source`, `type`, `payload`, `created_at`) VALUES
(1, 2, 'tokoku', 'request', '{\"ref_id\":\"DFZ-1764855069-6d77b3\",\"product_code\":\"TEST001\",\"target\":\"08123456789\",\"price_selling\":10000}', '2025-12-04 20:31:09'),
(2, 2, 'tokoku', 'response', '{\"status\":0,\"body\":false,\"error\":\"\",\"info\":{\"url\":\"\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":0,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":0,\"namelookup_time\":0,\"connect_time\":0,\"pretransfer_time\":0,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":-1,\"starttransfer_time\":0,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"\",\"certinfo\":[],\"primary_port\":0,\"local_ip\":\"\",\"local_port\":0,\"http_version\":0,\"protocol\":0,\"ssl_verifyresult\":0,\"scheme\":\"\",\"appconnect_time_us\":0,\"connect_time_us\":0,\"namelookup_time_us\":0,\"pretransfer_time_us\":0,\"redirect_time_us\":0,\"starttransfer_time_us\":0,\"total_time_us\":0}}', '2025-12-04 20:31:09'),
(3, 3, 'tokoku', 'request', '{\"ref_id\":\"DFZ-1764855853-2c1d41\",\"product_code\":\"TEST001\",\"target\":\"08123456789\",\"price_selling\":10000}', '2025-12-04 20:44:13'),
(4, 3, 'tokoku', 'response', '{\"status\":0,\"body\":false,\"error\":\"\",\"info\":{\"url\":\"\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":0,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":0,\"namelookup_time\":0,\"connect_time\":0,\"pretransfer_time\":0,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":-1,\"starttransfer_time\":0,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"\",\"certinfo\":[],\"primary_port\":0,\"local_ip\":\"\",\"local_port\":0,\"http_version\":0,\"protocol\":0,\"ssl_verifyresult\":0,\"scheme\":\"\",\"appconnect_time_us\":0,\"connect_time_us\":0,\"namelookup_time_us\":0,\"pretransfer_time_us\":0,\"redirect_time_us\":0,\"starttransfer_time_us\":0,\"total_time_us\":0}}', '2025-12-04 20:44:13'),
(5, 4, 'tokoku', 'request', '{\"ref_id\":\"DFZ-1764855897-ca5d7d\",\"product_code\":\"TEST001\",\"target\":\"08123456789\",\"price_selling\":10000}', '2025-12-04 20:44:57'),
(6, 4, 'tokoku', 'response', '{\"status\":0,\"body\":false,\"error\":\"\",\"info\":{\"url\":\"\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":0,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":0,\"namelookup_time\":0,\"connect_time\":0,\"pretransfer_time\":0,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":-1,\"starttransfer_time\":0,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"\",\"certinfo\":[],\"primary_port\":0,\"local_ip\":\"\",\"local_port\":0,\"http_version\":0,\"protocol\":0,\"ssl_verifyresult\":0,\"scheme\":\"\",\"appconnect_time_us\":0,\"connect_time_us\":0,\"namelookup_time_us\":0,\"pretransfer_time_us\":0,\"redirect_time_us\":0,\"starttransfer_time_us\":0,\"total_time_us\":0}}', '2025-12-04 20:44:57'),
(7, 4, 'callback', 'inbound', '{\"ref_id\":\"DFZ-1764855897-ca5d7d\",\"status\":\"success\"}', '2025-12-04 20:44:57'),
(8, 5, 'tokoku', 'request', '{\"ref_id\":\"DFZ-1764871794-ecc784\",\"product_code\":\"C0004001\",\"target\":\"48641618761\",\"price_selling\":320000}', '2025-12-05 01:09:54'),
(9, 5, 'tokoku', 'response', '{\"status\":0,\"body\":false,\"error\":\"\",\"info\":{\"url\":\"\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":0,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":0,\"namelookup_time\":0,\"connect_time\":0,\"pretransfer_time\":0,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":-1,\"starttransfer_time\":0,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"\",\"certinfo\":[],\"primary_port\":0,\"local_ip\":\"\",\"local_port\":0,\"http_version\":0,\"protocol\":0,\"ssl_verifyresult\":0,\"scheme\":\"\",\"appconnect_time_us\":0,\"connect_time_us\":0,\"namelookup_time_us\":0,\"pretransfer_time_us\":0,\"redirect_time_us\":0,\"starttransfer_time_us\":0,\"total_time_us\":0}}', '2025-12-05 01:09:54'),
(10, 6, 'tokoku', 'request', '{\"ref_id\":\"DFZ-1764871901-1aba87\",\"product_code\":\"C0004001\",\"target\":\"48641618761\",\"price_selling\":320000}', '2025-12-05 01:11:41'),
(11, 6, 'tokoku', 'response', '{\"status\":0,\"body\":false,\"error\":\"\",\"info\":{\"url\":\"\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":0,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":0,\"namelookup_time\":0,\"connect_time\":0,\"pretransfer_time\":0,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":-1,\"starttransfer_time\":0,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"\",\"certinfo\":[],\"primary_port\":0,\"local_ip\":\"\",\"local_port\":0,\"http_version\":0,\"protocol\":0,\"ssl_verifyresult\":0,\"scheme\":\"\",\"appconnect_time_us\":0,\"connect_time_us\":0,\"namelookup_time_us\":0,\"pretransfer_time_us\":0,\"redirect_time_us\":0,\"starttransfer_time_us\":0,\"total_time_us\":0}}', '2025-12-05 01:11:41'),
(12, 5, 'callback', 'inbound', '{\"ref_id\":\"DFZ-1764871794-ecc784\",\"status\":\"SUCCESS\"}', '2025-12-05 01:11:47'),
(13, 7, 'tokoku', 'request', '{\"ref_id\":\"DFZ-1764874258-6254b8\",\"product_code\":\"C0004001\",\"target\":\"48461618761\",\"price_selling\":320000}', '2025-12-05 01:50:58'),
(14, 7, 'tokoku', 'response', '{\"status\":0,\"body\":false,\"error\":\"\",\"info\":{\"url\":\"\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":0,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":0,\"namelookup_time\":0,\"connect_time\":0,\"pretransfer_time\":0,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":-1,\"starttransfer_time\":0,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"\",\"certinfo\":[],\"primary_port\":0,\"local_ip\":\"\",\"local_port\":0,\"http_version\":0,\"protocol\":0,\"ssl_verifyresult\":0,\"scheme\":\"\",\"appconnect_time_us\":0,\"connect_time_us\":0,\"namelookup_time_us\":0,\"pretransfer_time_us\":0,\"redirect_time_us\":0,\"starttransfer_time_us\":0,\"total_time_us\":0}}', '2025-12-05 01:50:58'),
(15, 8, 'tokoku', 'request', '{\"ref_id\":\"DFZ-1764874358-498f1b\",\"product_code\":\"C0004001\",\"target\":\"48461618761\",\"price_selling\":320000}', '2025-12-05 01:52:38'),
(16, 8, 'tokoku', 'response', '{\"status\":0,\"body\":false,\"error\":\"\",\"info\":{\"url\":\"\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":0,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":0,\"namelookup_time\":0,\"connect_time\":0,\"pretransfer_time\":0,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":-1,\"starttransfer_time\":0,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"\",\"certinfo\":[],\"primary_port\":0,\"local_ip\":\"\",\"local_port\":0,\"http_version\":0,\"protocol\":0,\"ssl_verifyresult\":0,\"scheme\":\"\",\"appconnect_time_us\":0,\"connect_time_us\":0,\"namelookup_time_us\":0,\"pretransfer_time_us\":0,\"redirect_time_us\":0,\"starttransfer_time_us\":0,\"total_time_us\":0}}', '2025-12-05 01:52:38'),
(17, 9, 'tokoku', 'request', '{\"ref_id\":\"DFZ-1764874401-c426b9\",\"product_code\":\"C0004001\",\"target\":\"48461618761\",\"price_selling\":320000}', '2025-12-05 01:53:21'),
(18, 9, 'tokoku', 'response', '{\"status\":0,\"body\":false,\"error\":\"\",\"info\":{\"url\":\"\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":0,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":0,\"namelookup_time\":0,\"connect_time\":0,\"pretransfer_time\":0,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":-1,\"starttransfer_time\":0,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"\",\"certinfo\":[],\"primary_port\":0,\"local_ip\":\"\",\"local_port\":0,\"http_version\":0,\"protocol\":0,\"ssl_verifyresult\":0,\"scheme\":\"\",\"appconnect_time_us\":0,\"connect_time_us\":0,\"namelookup_time_us\":0,\"pretransfer_time_us\":0,\"redirect_time_us\":0,\"starttransfer_time_us\":0,\"total_time_us\":0}}', '2025-12-05 01:53:21'),
(19, 10, 'tokoku', 'request', '{\"ref_id\":\"DFZ-1764874517-c0b45b\",\"product_code\":\"C0004001\",\"target\":\"48461618761\",\"price_selling\":320000}', '2025-12-05 01:55:17'),
(20, 10, 'tokoku', 'response', '{\"status\":0,\"body\":false,\"error\":\"\",\"info\":{\"url\":\"\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":0,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":0,\"namelookup_time\":0,\"connect_time\":0,\"pretransfer_time\":0,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":-1,\"starttransfer_time\":0,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"\",\"certinfo\":[],\"primary_port\":0,\"local_ip\":\"\",\"local_port\":0,\"http_version\":0,\"protocol\":0,\"ssl_verifyresult\":0,\"scheme\":\"\",\"appconnect_time_us\":0,\"connect_time_us\":0,\"namelookup_time_us\":0,\"pretransfer_time_us\":0,\"redirect_time_us\":0,\"starttransfer_time_us\":0,\"total_time_us\":0}}', '2025-12-05 01:55:17'),
(21, 11, 'tokoku', 'request', '{\"ref_id\":\"DFZ-1764874611-f545b2\",\"product_code\":\"C0004001\",\"target\":\"48461618761\",\"price_selling\":320000}', '2025-12-05 01:56:51'),
(22, 11, 'tokoku', 'response', '{\"status\":0,\"body\":false,\"error\":\"\",\"info\":{\"url\":\"\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":0,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":0,\"namelookup_time\":0,\"connect_time\":0,\"pretransfer_time\":0,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":-1,\"starttransfer_time\":0,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"\",\"certinfo\":[],\"primary_port\":0,\"local_ip\":\"\",\"local_port\":0,\"http_version\":0,\"protocol\":0,\"ssl_verifyresult\":0,\"scheme\":\"\",\"appconnect_time_us\":0,\"connect_time_us\":0,\"namelookup_time_us\":0,\"pretransfer_time_us\":0,\"redirect_time_us\":0,\"starttransfer_time_us\":0,\"total_time_us\":0}}', '2025-12-05 01:56:51'),
(23, 12, 'tokoku', 'request', '{\"ref_id\":\"DFZ-1764874752-210958\",\"product_code\":\"C0004001\",\"target\":\"48461618761\",\"price_selling\":320000}', '2025-12-05 01:59:12'),
(24, 12, 'tokoku', 'response', '{\"status\":0,\"body\":false,\"error\":\"\",\"info\":{\"url\":\"\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":0,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":0,\"namelookup_time\":0,\"connect_time\":0,\"pretransfer_time\":0,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":-1,\"starttransfer_time\":0,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"\",\"certinfo\":[],\"primary_port\":0,\"local_ip\":\"\",\"local_port\":0,\"http_version\":0,\"protocol\":0,\"ssl_verifyresult\":0,\"scheme\":\"\",\"appconnect_time_us\":0,\"connect_time_us\":0,\"namelookup_time_us\":0,\"pretransfer_time_us\":0,\"redirect_time_us\":0,\"starttransfer_time_us\":0,\"total_time_us\":0}}', '2025-12-05 01:59:12'),
(25, 13, 'tokoku', 'request', '{\"ref_id\":\"DFZ-1764875195-6fab0c\",\"product_code\":\"C0004001\",\"target\":\"48461618761\",\"price_selling\":320000}', '2025-12-05 02:06:35'),
(26, 13, 'tokoku', 'response', '{\"status\":0,\"body\":false,\"error\":\"\",\"info\":{\"url\":\"\",\"content_type\":null,\"http_code\":0,\"header_size\":0,\"request_size\":0,\"filetime\":-1,\"ssl_verify_result\":0,\"redirect_count\":0,\"total_time\":0,\"namelookup_time\":0,\"connect_time\":0,\"pretransfer_time\":0,\"size_upload\":0,\"size_download\":0,\"speed_download\":0,\"speed_upload\":0,\"download_content_length\":-1,\"upload_content_length\":-1,\"starttransfer_time\":0,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"\",\"certinfo\":[],\"primary_port\":0,\"local_ip\":\"\",\"local_port\":0,\"http_version\":0,\"protocol\":0,\"ssl_verifyresult\":0,\"scheme\":\"\",\"appconnect_time_us\":0,\"connect_time_us\":0,\"namelookup_time_us\":0,\"pretransfer_time_us\":0,\"redirect_time_us\":0,\"starttransfer_time_us\":0,\"total_time_us\":0}}', '2025-12-05 02:06:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES
('digiflazz_api_key', '12345', '2025-12-04 19:57:10', '2025-12-04 20:02:58'),
('digiflazz_username', 'testuser', '2025-12-04 19:57:10', '2025-12-04 20:02:58'),
('tokoku_client_id', 'abcde', '2025-12-04 19:57:10', '2025-12-04 20:02:58'),
('tokoku_client_secret', '99999', '2025-12-04 19:57:10', '2025-12-04 20:02:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `plain_password` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `plain_password`, `created_at`, `updated_at`) VALUES
(3, 'Administrator', 'admin@data.com', '$2y$10$N9N.juKsFH8hE5FgP39zEeKQP3jhKAabBzvTKTYWxNje.YdWndgQG', 'admin123', '2025-12-03 23:25:52', '2025-12-03 23:40:21'),
(4, 'jaya', 'jaya@data.com', '$2y$10$6YAMw7XzpRw5FYKDjx41huOEEjt3hcs8eODLIoZlPJlJ3LKZxVObq', 'jaya123', '2025-12-04 00:02:30', '2025-12-04 00:02:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `order_logs`
--
ALTER TABLE `order_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `order_logs`
--
ALTER TABLE `order_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_logs`
--
ALTER TABLE `order_logs`
  ADD CONSTRAINT `order_logs_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
