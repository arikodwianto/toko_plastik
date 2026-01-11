-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2026 at 03:36 AM
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
(5, 'BRG-0001', 'Kaos Eiger', 2, 11000.00, 13000.00, '2026-01-03 09:41:19', '2026-01-10 07:06:00'),
(6, 'BRG-0002', 'plastik anti panas', 40, 12000.00, 16000.00, '2026-01-03 10:56:00', '2026-01-05 08:16:44');

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
(1, 5, 12, 'masuk', 'Stok masuk dari supplier', '2026-01-03 11:28:31', '2026-01-03 11:28:31'),
(2, 6, 4, 'masuk', 'Stok masuk dari supplier', '2026-01-03 11:34:48', '2026-01-03 11:34:48'),
(3, 5, 0, 'opname_plus', 'Stok opname', '2026-01-03 11:41:18', '2026-01-03 11:41:18'),
(4, 5, 0, 'opname_plus', 'Stok opname', '2026-01-03 11:41:44', '2026-01-03 11:41:44'),
(5, 6, 3, 'opname_minus', 'Stok opname', '2026-01-03 11:42:05', '2026-01-03 11:42:05'),
(6, 6, 12, 'masuk', 'Stok masuk dari supplier', '2026-01-04 00:16:19', '2026-01-04 00:16:19'),
(7, 6, 2, 'masuk', 'Stok masuk oleh admin kasir', '2026-01-05 03:30:22', '2026-01-05 03:30:22'),
(8, 6, 2, 'keluar', 'Penjualan', '2026-01-05 05:04:38', '2026-01-05 05:04:38'),
(9, 6, 2, 'keluar', 'Penjualan', '2026-01-05 05:04:51', '2026-01-05 05:04:51'),
(10, 5, 1, 'keluar', 'Penjualan', '2026-01-05 05:05:57', '2026-01-05 05:05:57'),
(11, 5, 1, 'keluar', 'Penjualan', '2026-01-05 07:33:39', '2026-01-05 07:33:39'),
(12, 6, 1, 'keluar', 'Penjualan', '2026-01-05 07:38:15', '2026-01-05 07:38:15'),
(13, 5, 12, 'masuk', 'Stok masuk oleh admin kasir', '2026-01-05 07:38:46', '2026-01-05 07:38:46'),
(14, 5, 12, 'keluar', 'Penjualan', '2026-01-05 07:39:30', '2026-01-05 07:39:30'),
(15, 6, 12, 'keluar', 'Penjualan', '2026-01-05 07:39:30', '2026-01-05 07:39:30'),
(16, 5, 12, 'retur', 'Pembatalan transaksi TRX-20260105143930', '2026-01-05 07:44:42', '2026-01-05 07:44:42'),
(17, 6, 12, 'retur', 'Pembatalan transaksi TRX-20260105143930', '2026-01-05 07:44:42', '2026-01-05 07:44:42'),
(18, 5, 12, 'retur', 'Pembatalan transaksi TRX-20260105143930', '2026-01-05 07:44:50', '2026-01-05 07:44:50'),
(19, 6, 12, 'retur', 'Pembatalan transaksi TRX-20260105143930', '2026-01-05 07:44:50', '2026-01-05 07:44:50'),
(20, 6, 1, 'retur', 'Pembatalan transaksi TRX-20260105143815', '2026-01-05 07:45:02', '2026-01-05 07:45:02'),
(21, 6, 1, 'retur', 'Pembatalan transaksi TRX-20260105143815', '2026-01-05 07:45:09', '2026-01-05 07:45:09'),
(22, 5, 12, 'retur', 'Pembatalan transaksi TRX-20260105143930', '2026-01-05 07:47:46', '2026-01-05 07:47:46'),
(23, 6, 12, 'retur', 'Pembatalan transaksi TRX-20260105143930', '2026-01-05 07:47:46', '2026-01-05 07:47:46'),
(24, 6, 1, 'retur', 'Retur item TRX-20260105143815', '2026-01-05 07:54:13', '2026-01-05 07:54:13'),
(25, 6, 1, 'retur', 'Pembatalan transaksi TRX-20260105143815', '2026-01-05 07:54:31', '2026-01-05 07:54:31'),
(26, 6, 1, 'keluar', 'Penjualan', '2026-01-05 08:05:12', '2026-01-05 08:05:12'),
(27, 6, 1, 'retur', 'Retur item TRX-20260105150512', '2026-01-05 08:16:44', '2026-01-05 08:16:44'),
(28, 5, 1, 'keluar', 'Penjualan', '2026-01-06 08:05:41', '2026-01-06 08:05:41'),
(29, 5, 33, 'opname_minus', 'Stok opname', '2026-01-10 07:06:00', '2026-01-10 07:06:00');

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
(1, 'TRX-20260105120438', '2026-01-05 12:04:38', 31998.00, 0.00, 120000.00, 88002.00, 'qris', 2, '2026-01-05 05:04:38', '2026-01-05 05:04:38', 'selesai'),
(2, 'TRX-20260105120451', '2026-01-05 12:04:51', 31998.00, 0.00, 16000.00, -15998.00, 'qris', 2, '2026-01-05 05:04:51', '2026-01-05 05:04:51', 'selesai'),
(3, 'TRX-20260105120557', '2026-01-05 12:05:57', 13000.00, 0.00, 13000.00, 0.00, 'cash', 2, '2026-01-05 05:05:57', '2026-01-05 05:05:57', 'selesai'),
(4, 'TRX-20260105143339', '2026-01-05 14:33:39', 13000.00, 0.00, 13000.00, 0.00, 'cash', 2, '2026-01-05 07:33:39', '2026-01-05 07:33:39', 'selesai'),
(5, 'TRX-20260105143815', '2026-01-05 14:38:15', 0.00, 0.00, 16000.00, 0.00, 'cash', 2, '2026-01-05 07:38:15', '2026-01-05 07:54:31', 'dibatalkan'),
(6, 'TRX-20260105143930', '2026-01-05 14:39:30', 348000.00, 0.00, 348000.00, 0.00, 'cash', 2, '2026-01-05 07:39:30', '2026-01-05 07:47:46', 'dibatalkan'),
(7, 'TRX-20260105150512', '2026-01-05 15:05:12', 0.00, 0.00, 16000.00, 0.00, 'cash', 2, '2026-01-05 08:05:12', '2026-01-05 08:16:44', 'selesai'),
(8, 'TRX-20260106150541', '2026-01-06 15:05:41', 13000.00, 0.00, 13000.00, 0.00, 'cash', 2, '2026-01-06 08:05:41', '2026-01-06 08:05:41', 'selesai');

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
(1, 1, 6, 16000.00, 2, 0, 2.00, 31998.00, '2026-01-05 05:04:38', '2026-01-05 05:04:38'),
(2, 2, 6, 16000.00, 2, 0, 2.00, 31998.00, '2026-01-05 05:04:51', '2026-01-05 05:04:51'),
(3, 3, 5, 13000.00, 1, 0, 0.00, 13000.00, '2026-01-05 05:05:57', '2026-01-05 05:05:57'),
(4, 4, 5, 13000.00, 1, 0, 0.00, 13000.00, '2026-01-05 07:33:39', '2026-01-05 07:33:39'),
(5, 5, 6, 16000.00, 1, 1, 0.00, 16000.00, '2026-01-05 07:38:15', '2026-01-05 07:54:13'),
(6, 6, 5, 13000.00, 12, 0, 0.00, 156000.00, '2026-01-05 07:39:30', '2026-01-05 07:39:30'),
(7, 6, 6, 16000.00, 12, 0, 0.00, 192000.00, '2026-01-05 07:39:30', '2026-01-05 07:39:30'),
(8, 7, 6, 16000.00, 1, 1, 0.00, 16000.00, '2026-01-05 08:05:12', '2026-01-05 08:16:44'),
(9, 8, 5, 13000.00, 1, 0, 0.00, 13000.00, '2026-01-06 08:05:41', '2026-01-06 08:05:41');

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
('cZ5Dfq4K0GN7EnZ19vqFvPAExSiMzbqrr9GsWRCI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXM0Q2FxRENJTDc4WHpwM05Jd2h3UExmekoyb1pyamhRZnl5cU5XNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1768102569);

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
(1, 5, 12, 'hu', '2026-01-03 11:26:39', NULL, '2026-01-03 11:26:39', '2026-01-03 11:26:39'),
(2, 5, 12, 'hu', '2026-01-03 11:28:31', NULL, '2026-01-03 11:28:31', '2026-01-03 11:28:31'),
(3, 6, 4, 'hu', '2026-01-03 11:34:48', NULL, '2026-01-03 11:34:48', '2026-01-03 11:34:48'),
(4, 6, 12, 'anh', '2026-01-04 00:16:19', NULL, '2026-01-04 00:16:19', '2026-01-04 00:16:19'),
(5, 6, 2, 'njhn', '2026-01-05 03:30:22', NULL, '2026-01-05 03:30:22', '2026-01-05 03:30:22'),
(6, 5, 12, NULL, '2026-01-05 07:38:46', NULL, '2026-01-05 07:38:46', '2026-01-05 07:38:46');

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
(1, 'Owner User', 'owner@example.com', NULL, '$2y$12$Arg9DmtRt84cJrnr9rAnPO/YqnUoRd/n6z2iatbUn3fQf7gLKHLVK', 'owner', NULL, '2025-12-01 07:59:24', '2025-12-01 07:59:24'),
(2, 'Ariko DwiAnto', 'arikodwiantostti@gmail.com', NULL, '$2y$12$FVsRHNxC/x4fzJVX5J60cuLph2NNmOA4u0zCGZYQ3MUGzEL.9f8Le', 'admin_kasir', NULL, '2025-12-01 08:00:47', '2026-01-04 00:50:00'),
(3, 'Ariko DwiAnto', 'juraganngetik@gmail.com', NULL, '$2y$12$bNegegFF85LyGq/ccpXVaebz/54dgp6cdBSHndgVwE1SHgM3Pm8Qy', 'admin_kasir', NULL, '2026-01-03 09:17:33', '2026-01-03 09:17:33');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penjualans`
--
ALTER TABLE `penjualans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penjualan_details`
--
ALTER TABLE `penjualan_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stok_opname`
--
ALTER TABLE `stok_opname`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
