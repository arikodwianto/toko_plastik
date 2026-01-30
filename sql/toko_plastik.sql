-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2026 at 05:23 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_plastik`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `harga_modal` decimal(15,2) NOT NULL DEFAULT '0.00',
  `harga_jual` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama`, `stok`, `harga_modal`, `harga_jual`, `created_at`, `updated_at`) VALUES
(9, 'BRG-0001', 'Plastik PE 1 Kg', 47, 15000.00, 20000.00, '2026-01-23 04:48:23', '2026-01-24 08:31:29'),
(10, 'BRG-0002', 'Plastik PP 1 Kg', 57, 16000.00, 21000.00, '2026-01-23 04:48:23', '2026-01-23 04:52:48'),
(11, 'BRG-0003', 'Plastik HD 1 Kg', 40, 17000.00, 22000.00, '2026-01-23 04:48:23', '2026-01-23 04:48:23'),
(12, 'BRG-0004', 'Kantong Kresek Hitam', 100, 5000.00, 8000.00, '2026-01-23 04:48:23', '2026-01-23 04:48:23'),
(13, 'BRG-0005', 'Kantong Kresek Putih', 120, 5500.00, 8500.00, '2026-01-23 04:48:23', '2026-01-23 04:48:23'),
(14, 'BRG-0006', 'Plastik Mika', 30, 12000.00, 17000.00, '2026-01-23 04:48:23', '2026-01-23 04:48:23'),
(15, 'BRG-0007', 'Plastik Vacuum', 25, 20000.00, 26000.00, '2026-01-23 04:48:23', '2026-01-23 04:48:23'),
(16, 'BRG-0008', 'Plastik Roll Besar', 15, 30000.00, 38000.00, '2026-01-23 04:48:23', '2026-01-23 04:48:23'),
(17, 'BRG-0009', 'Plastik Roll Kecil', 20, 18000.00, 24000.00, '2026-01-23 04:48:23', '2026-01-23 04:48:23'),
(18, 'BRG-0010', 'Plastik Es Batu', 80, 7000.00, 11000.00, '2026-01-23 04:48:23', '2026-01-23 04:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `harga_modal` int NOT NULL DEFAULT '0',
  `harga_jual` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_29_064949_add_role_to_users_table', 1),
(5, '2025_12_08_115546_create_barang_table', 2),
(6, '2025_12_08_115611_create_stok_masuk_table', 2),
(7, '2025_12_08_115630_create_mutasi_stok_table', 2),
(8, '2025_12_08_115654_create_stok_opname_table', 3),
(9, '2025_12_08_120317_create_items_table', 4),
(10, '2026_01_03_181754_add_jumlah_to_stok_masuk_table', 5),
(11, '2026_01_03_182024_add_tanggal_masuk_to_stok_masuk_table', 6),
(12, '2026_01_03_182231_drop_qty_from_stok_masuk_table', 7),
(13, '2026_01_03_182500_set_default_tanggal_masuk_on_stok_masuk_table', 8),
(14, '2026_01_03_182711_create_mutasi_stok_table', 9),
(15, '2026_01_03_183938_alter_tipe_on_mutasi_stok_table', 10),
(16, '2026_01_05_114826_create_penjualans_table', 11),
(17, '2026_01_05_114846_create_penjualan_details_table', 11),
(18, '2026_01_05_144123_add_status_to_penjualans', 12),
(19, '2026_01_05_145107_add_qty_retur_to_penjualan_details', 13);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_stok`
--

CREATE TABLE `mutasi_stok` (
  `id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `tipe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mutasi_stok`
--

INSERT INTO `mutasi_stok` (`id`, `barang_id`, `jumlah`, `tipe`, `keterangan`, `created_at`, `updated_at`) VALUES
(31, 10, 12, 'masuk', 'Stok masuk dari supplier', '2026-01-23 04:52:48', '2026-01-23 04:52:48'),
(32, 9, 1, 'keluar', 'Penjualan', '2026-01-23 07:23:03', '2026-01-23 07:23:03'),
(33, 9, 1, 'keluar', 'Penjualan', '2026-01-24 08:31:22', '2026-01-24 08:31:22'),
(34, 9, 1, 'keluar', 'Penjualan', '2026-01-24 08:31:29', '2026-01-24 08:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjualans`
--

CREATE TABLE `penjualans` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `diskon_total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `bayar` decimal(15,2) NOT NULL,
  `kembalian` decimal(15,2) NOT NULL,
  `metode_pembayaran` enum('cash','transfer','qris') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasir_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('selesai','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualans`
--

INSERT INTO `penjualans` (`id`, `kode_transaksi`, `tanggal`, `total`, `diskon_total`, `bayar`, `kembalian`, `metode_pembayaran`, `kasir_id`, `created_at`, `updated_at`, `status`) VALUES
(21, 'TRX-20260124153122', '2026-01-24 15:31:22', 20000.00, 0.00, 20000.00, 0.00, 'cash', 2, '2026-01-24 08:31:22', '2026-01-24 08:31:22', 'selesai'),
(22, 'TRX-20260124153129', '2026-01-24 15:31:29', 20000.00, 0.00, 20000.00, 0.00, 'cash', 2, '2026-01-24 08:31:29', '2026-01-24 08:31:29', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_details`
--

CREATE TABLE `penjualan_details` (
  `id` bigint UNSIGNED NOT NULL,
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `qty` int NOT NULL,
  `qty_retur` int NOT NULL DEFAULT '0',
  `diskon` decimal(15,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan_details`
--

INSERT INTO `penjualan_details` (`id`, `penjualan_id`, `barang_id`, `harga`, `qty`, `qty_retur`, `diskon`, `subtotal`, `created_at`, `updated_at`) VALUES
(33, 21, 9, 20000.00, 1, 0, 0.00, 20000.00, '2026-01-24 08:31:22', '2026-01-24 08:31:22'),
(34, 22, 9, 20000.00, 1, 0, 0.00, 20000.00, '2026-01-24 08:31:29', '2026-01-24 08:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('At5Ws4s9bf6iT93iUCP96lBJAt1vc1nXmNQurFa7', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibVZBSG9OSEoxcHc4M2RGbVVCdWJxWGdtWWVQaVhFdGNMcVRCeXJ1UyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbl9rYXNpci9wZW5qdWFsYW4vMjEvZGV0YWlsIjtzOjU6InJvdXRlIjtzOjI4OiJhZG1pbl9rYXNpci5wZW5qdWFsYW4uZGV0YWlsIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1769268715),
('b4rwA8jxKPRaN9IvCfWMKUJRnkvqgTSYCLMjbbLm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUV2eE9ZQlkwYnR2UHlhdFlDTndhQlhGZlFTSGtkMXY1M3NxcE1SbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1769178621),
('EylgGKtW5SJocJFG3Y6Xqwv7T6GriFlSA0kMWTiP', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUGVxdTZKbE5GY2xRZnJJa0xUYk8xRWZpekpvWWxNY0xIcGloWmRpaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vd25lci9sYXBvcmFuL3BlbWJlbGlhbiI7czo1OiJyb3V0ZSI7czoyMzoib3duZXIubGFwb3Jhbi5wZW1iZWxpYW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1769169193),
('k1wevWMrIVllaZbdauWbgkoPCZYWCV9gJKR09SfC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidXZhNlRKVWY4WnJzYkdrVFRqZXpObEdJRVVydUg1ZVhXV2ZMTUJLdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vd25lci9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6Im93bmVyLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1769793776);

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `harga_modal` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`id`, `barang_id`, `jumlah`, `supplier`, `tanggal_masuk`, `harga_modal`, `created_at`, `updated_at`) VALUES
(7, 10, 12, 'Cv. Hyhy', '2026-01-23 04:52:48', NULL, '2026-01-23 04:52:48', '2026-01-23 04:52:48'),
(8, 9, 20, 'CV. Sinar Jaya', '2026-01-20 02:00:00', 15000.00, '2026-01-23 14:18:36', '2026-01-23 14:18:36'),
(9, 10, 30, 'CV. Sinar Jaya', '2026-01-20 02:15:00', 16000.00, '2026-01-23 14:18:36', '2026-01-23 14:18:36'),
(10, 11, 25, 'CV. Makmur Abadi', '2026-01-21 03:00:00', 17000.00, '2026-01-23 14:18:36', '2026-01-23 14:18:36'),
(11, 12, 50, 'CV. Makmur Abadi', '2026-01-21 03:30:00', 5000.00, '2026-01-23 14:18:36', '2026-01-23 14:18:36'),
(12, 13, 40, 'CV. Berkah Plastik', '2026-01-22 04:00:00', 5500.00, '2026-01-23 14:18:36', '2026-01-23 14:18:36'),
(13, 14, 15, 'CV. Berkah Plastik', '2026-01-22 07:00:00', 12000.00, '2026-01-23 14:18:36', '2026-01-23 14:18:36'),
(14, 15, 20, 'CV. Plastik Jaya', '2026-01-23 01:30:00', 20000.00, '2026-01-23 14:18:36', '2026-01-23 14:18:36'),
(15, 16, 10, 'CV. Plastik Jaya', '2026-01-23 02:00:00', 30000.00, '2026-01-23 14:18:36', '2026-01-23 14:18:36'),
(16, 17, 60, 'CV. Sinar Jaya', '2026-01-23 03:00:00', 18000.00, '2026-01-23 14:18:36', '2026-01-23 14:18:36'),
(17, 18, 35, 'CV. Makmur Abadi', '2026-01-23 04:00:00', 7000.00, '2026-01-23 14:18:36', '2026-01-23 14:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `stok_opname`
--

CREATE TABLE `stok_opname` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('owner','admin_kasir') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin_kasir',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Owner User', 'owner@example.com', NULL, '$2y$12$Arg9DmtRt84cJrnr9rAnPO/YqnUoRd/n6z2iatbUn3fQf7gLKHLVK', 'owner', '046iwp9ZoD8mL9dEU25YQB6zapBiHkpZtKSB5f0C6ptvIsj3IQZQnCUJj3d8', '2025-12-01 07:59:24', '2025-12-01 07:59:24'),
(2, 'kasir', 'arikodwiantostti@gmail.com', NULL, '$2y$12$FVsRHNxC/x4fzJVX5J60cuLph2NNmOA4u0zCGZYQ3MUGzEL.9f8Le', 'admin_kasir', 'cs34GqRFpxBnZeQ5xB28AUHUp31V1cczocL8FuMp2TuZgudrHlf9yGpCf1t8', '2025-12-01 08:00:47', '2026-01-23 04:37:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi_stok`
--
ALTER TABLE `mutasi_stok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mutasi_stok_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penjualans`
--
ALTER TABLE `penjualans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penjualans_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `penjualans_kasir_id_foreign` (`kasir_id`);

--
-- Indexes for table `penjualan_details`
--
ALTER TABLE `penjualan_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_details_penjualan_id_foreign` (`penjualan_id`),
  ADD KEY `penjualan_details_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stok_masuk_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `stok_opname`
--
ALTER TABLE `stok_opname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mutasi_stok`
--
ALTER TABLE `mutasi_stok`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `penjualans`
--
ALTER TABLE `penjualans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `penjualan_details`
--
ALTER TABLE `penjualan_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stok_opname`
--
ALTER TABLE `stok_opname`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mutasi_stok`
--
ALTER TABLE `mutasi_stok`
  ADD CONSTRAINT `mutasi_stok_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penjualans`
--
ALTER TABLE `penjualans`
  ADD CONSTRAINT `penjualans_kasir_id_foreign` FOREIGN KEY (`kasir_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penjualan_details`
--
ALTER TABLE `penjualan_details`
  ADD CONSTRAINT `penjualan_details_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `penjualan_details_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD CONSTRAINT `stok_masuk_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
