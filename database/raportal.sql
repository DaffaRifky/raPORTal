-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2026 at 12:48 PM
-- Server version: 8.4.3
-- PHP Version: 8.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raportal`
--

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
-- Table structure for table `guru_mengajar`
--

CREATE TABLE `guru_mengajar` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `mp_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru_mengajar`
--

INSERT INTO `guru_mengajar` (`id`, `user_id`, `kelas_id`, `mp_id`, `created_at`, `updated_at`) VALUES
(127, 2, 1, 3, '2026-07-06 05:30:18', '2026-07-06 05:30:18'),
(128, 2, 1, 5, '2026-07-06 05:30:18', '2026-07-06 05:30:18'),
(129, 2, 8, 3, '2026-07-06 05:30:18', '2026-07-06 05:30:18'),
(130, 2, 8, 5, '2026-07-06 05:30:18', '2026-07-06 05:30:18'),
(131, 2, 9, 3, '2026-07-06 05:30:18', '2026-07-06 05:30:18'),
(132, 2, 9, 5, '2026-07-06 05:30:19', '2026-07-06 05:30:19'),
(148, 32, 1, 3, '2026-07-10 23:59:13', '2026-07-10 23:59:13'),
(149, 32, 1, 1, '2026-07-10 23:59:13', '2026-07-10 23:59:13'),
(150, 32, 4, 3, '2026-07-10 23:59:13', '2026-07-10 23:59:13'),
(151, 32, 4, 1, '2026-07-10 23:59:13', '2026-07-10 23:59:13'),
(152, 11, 1, 2, '2026-07-11 00:12:20', '2026-07-11 00:12:20'),
(153, 11, 1, 5, '2026-07-11 00:12:20', '2026-07-11 00:12:20'),
(154, 11, 3, 2, '2026-07-11 00:12:20', '2026-07-11 00:12:20'),
(155, 11, 3, 5, '2026-07-11 00:12:20', '2026-07-11 00:12:20'),
(156, 11, 6, 2, '2026-07-11 00:12:20', '2026-07-11 00:12:20'),
(157, 11, 6, 5, '2026-07-11 00:12:20', '2026-07-11 00:12:20'),
(164, 37, 1, 1, '2026-07-24 04:26:39', '2026-07-24 04:26:39'),
(165, 37, 1, 2, '2026-07-24 04:26:39', '2026-07-24 04:26:39'),
(166, 37, 1, 3, '2026-07-24 04:26:39', '2026-07-24 04:26:39'),
(167, 37, 1, 4, '2026-07-24 04:26:39', '2026-07-24 04:26:39'),
(168, 37, 1, 5, '2026-07-24 04:26:40', '2026-07-24 04:26:40'),
(171, 38, 1, 1, '2026-07-24 05:05:16', '2026-07-24 05:05:16'),
(172, 38, 1, 4, '2026-07-24 05:05:16', '2026-07-24 05:05:16'),
(173, 38, 4, 1, '2026-07-24 05:05:16', '2026-07-24 05:05:16'),
(174, 38, 4, 4, '2026-07-24 05:05:17', '2026-07-24 05:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_kelas` int NOT NULL,
  `huruf_kelas` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wali_kelas_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nomor_kelas`, `huruf_kelas`, `created_at`, `updated_at`, `wali_kelas_id`) VALUES
(1, 10, 'A', NULL, NULL, 11),
(3, 10, 'B', NULL, NULL, NULL),
(4, 11, 'A', NULL, NULL, NULL),
(6, 11, 'B', NULL, NULL, NULL),
(8, 12, 'a', NULL, NULL, NULL),
(9, 12, 'b', NULL, NULL, NULL),
(11, 10, 'C', NULL, NULL, 35),
(12, 11, 'C', NULL, NULL, NULL);

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
(9, '0001_01_01_000001_create_cache_table', 2),
(11, '2026_04_30_110440_create_sessions_table', 2),
(12, '2026_06_18_074543_create_mps_table', 3),
(17, '2026_06_18_083202_create_kelas_table', 4),
(18, '2026_06_18_083213_create_siswa_table', 5),
(19, '2026_06_18_083245_create_guru_mengajar_table', 6),
(20, '2026_06_19_131336_create_tugas_table', 7),
(21, '2026_06_19_131337_create_nilai_table', 7),
(22, '2026_06_22_084651_add_wali_kelas_to_kelas_table', 8),
(24, '2026_06_23_082932_add_image_to_user_table', 9),
(25, '2026_07_09_184343_add_tanda_tangan_to_user_table', 10),
(26, '2026_07_09_185035_create_pengaturan_akademik', 10);

-- --------------------------------------------------------

--
-- Table structure for table `mps`
--

CREATE TABLE `mps` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mps`
--

INSERT INTO `mps` (`id`, `nama`, `singkatan`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan Agama dan Budi Pekerti', 'PABP', NULL, NULL),
(2, 'Pendidikan Pancasila', 'PP', NULL, NULL),
(3, 'Bahasa Indonesia', 'IND', NULL, NULL),
(4, 'Matematika', 'MTK', NULL, NULL),
(5, 'Bahasa Inggris', 'ENG', NULL, NULL),
(12, 'Informatika', 'INF', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `tugas_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nilai` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `siswa_id`, `tugas_id`, `user_id`, `nilai`, `created_at`, `updated_at`) VALUES
(2, 5, 1, 32, 80.00, '2026-06-19 08:33:16', '2026-07-11 00:07:04'),
(6, 5, 2, 32, 80.00, '2026-06-24 23:36:46', '2026-07-11 00:07:21'),
(10, 5, 3, 32, 40.00, '2026-06-24 23:38:57', '2026-07-11 00:07:49'),
(14, 5, 5, 2, 90.00, '2026-06-26 07:40:32', '2026-06-26 07:40:32'),
(16, 5, 10, 11, 90.00, '2026-06-29 07:43:40', '2026-06-29 07:43:40'),
(18, 9, 10, 32, 85.00, '2026-07-11 00:04:27', '2026-07-11 00:04:27'),
(19, 11, 10, 32, 86.00, '2026-07-11 00:04:29', '2026-07-11 00:04:29'),
(20, 8, 10, 32, 91.00, '2026-07-11 00:04:29', '2026-07-11 00:04:29'),
(21, 10, 10, 32, 79.00, '2026-07-11 00:04:30', '2026-07-11 00:04:30'),
(22, 9, 11, 32, 92.00, '2026-07-11 00:04:55', '2026-07-11 00:04:55'),
(23, 5, 11, 32, 69.00, '2026-07-11 00:04:55', '2026-07-11 00:04:55'),
(24, 11, 11, 32, 78.00, '2026-07-11 00:04:56', '2026-07-11 00:04:56'),
(25, 8, 11, 32, 80.00, '2026-07-11 00:04:56', '2026-07-11 00:04:56'),
(26, 10, 11, 32, 80.00, '2026-07-11 00:04:57', '2026-07-11 00:04:57'),
(27, 9, 12, 32, 83.00, '2026-07-11 00:05:03', '2026-07-11 00:05:03'),
(28, 5, 12, 32, 93.00, '2026-07-11 00:05:08', '2026-07-11 00:05:08'),
(29, 10, 12, 32, 86.00, '2026-07-11 00:05:17', '2026-07-11 00:05:17'),
(30, 8, 12, 32, 85.00, '2026-07-11 00:05:18', '2026-07-11 00:05:18'),
(31, 11, 12, 32, 74.00, '2026-07-11 00:05:19', '2026-07-11 00:05:19'),
(32, 10, 15, 32, 80.00, '2026-07-11 00:05:45', '2026-07-11 00:05:45'),
(33, 8, 15, 32, 75.00, '2026-07-11 00:05:46', '2026-07-11 00:05:46'),
(34, 11, 15, 32, 79.00, '2026-07-11 00:05:46', '2026-07-11 00:05:46'),
(35, 5, 15, 32, 79.00, '2026-07-11 00:05:47', '2026-07-11 00:05:47'),
(36, 9, 15, 32, 60.00, '2026-07-11 00:05:47', '2026-07-11 00:05:47'),
(37, 10, 16, 32, 90.00, '2026-07-11 00:06:18', '2026-07-11 00:06:18'),
(38, 8, 16, 32, 76.00, '2026-07-11 00:06:18', '2026-07-11 00:06:18'),
(39, 11, 16, 32, 86.00, '2026-07-11 00:06:19', '2026-07-11 00:06:19'),
(40, 5, 16, 32, 69.00, '2026-07-11 00:06:19', '2026-07-11 00:06:19'),
(41, 9, 16, 32, 65.00, '2026-07-11 00:06:20', '2026-07-11 00:06:20'),
(42, 9, 1, 32, 86.00, '2026-07-11 00:07:06', '2026-07-11 00:07:06'),
(43, 10, 1, 32, 89.00, '2026-07-11 00:07:14', '2026-07-11 00:07:14'),
(44, 8, 1, 32, 79.00, '2026-07-11 00:07:14', '2026-07-11 00:07:14'),
(45, 11, 1, 32, 78.00, '2026-07-11 00:07:14', '2026-07-11 00:07:14'),
(46, 10, 2, 32, 59.00, '2026-07-11 00:07:28', '2026-07-11 00:07:28'),
(47, 8, 2, 32, 96.00, '2026-07-11 00:07:29', '2026-07-11 00:07:29'),
(48, 11, 2, 32, 85.00, '2026-07-11 00:07:29', '2026-07-11 00:07:29'),
(49, 9, 2, 32, 74.00, '2026-07-11 00:07:30', '2026-07-11 00:07:30'),
(50, 10, 3, 32, 81.00, '2026-07-11 00:07:43', '2026-07-11 00:07:43'),
(51, 8, 3, 32, 74.00, '2026-07-11 00:07:43', '2026-07-11 00:07:43'),
(52, 11, 3, 32, 84.00, '2026-07-11 00:07:44', '2026-07-11 00:07:44'),
(53, 9, 3, 32, 85.00, '2026-07-11 00:07:44', '2026-07-11 00:07:44'),
(54, 10, 13, 32, 70.00, '2026-07-11 00:08:08', '2026-07-11 00:08:08'),
(55, 8, 13, 32, 70.00, '2026-07-11 00:08:08', '2026-07-11 00:08:08'),
(56, 11, 13, 32, 61.00, '2026-07-11 00:08:09', '2026-07-11 00:08:09'),
(57, 5, 13, 32, 65.00, '2026-07-11 00:08:09', '2026-07-11 00:08:09'),
(58, 9, 13, 32, 55.00, '2026-07-11 00:08:10', '2026-07-11 00:08:10'),
(59, 9, 14, 32, 81.00, '2026-07-11 00:08:28', '2026-07-11 00:08:28'),
(60, 5, 14, 32, 70.00, '2026-07-11 00:08:29', '2026-07-11 00:08:29'),
(61, 11, 14, 32, 80.00, '2026-07-11 00:08:29', '2026-07-11 00:08:29'),
(62, 8, 14, 32, 0.00, '2026-07-11 00:08:30', '2026-07-11 00:08:30'),
(63, 10, 14, 32, 40.00, '2026-07-11 00:08:31', '2026-07-11 00:08:31'),
(64, 10, 19, 32, 80.00, '2026-07-11 00:08:47', '2026-07-11 00:08:47'),
(65, 8, 19, 32, 79.00, '2026-07-11 00:08:47', '2026-07-11 00:08:47'),
(66, 11, 19, 32, 82.00, '2026-07-11 00:08:48', '2026-07-11 00:08:48'),
(67, 5, 19, 32, 88.00, '2026-07-11 00:08:48', '2026-07-11 00:08:48'),
(68, 9, 19, 32, 89.00, '2026-07-11 00:08:48', '2026-07-11 00:08:48'),
(69, 10, 20, 32, 90.00, '2026-07-11 00:09:02', '2026-07-11 00:09:02'),
(70, 8, 20, 32, 80.00, '2026-07-11 00:09:03', '2026-07-11 00:09:03'),
(71, 11, 20, 32, 85.00, '2026-07-11 00:09:03', '2026-07-11 00:09:03'),
(72, 9, 20, 32, 70.00, '2026-07-11 00:09:04', '2026-07-11 00:09:04'),
(73, 5, 20, 32, 75.00, '2026-07-11 00:09:05', '2026-07-11 00:09:05'),
(74, 9, 33, 37, 70.00, '2026-07-11 04:00:42', '2026-07-24 04:28:29'),
(87, 9, 17, 37, 70.00, '2026-07-24 04:27:40', '2026-07-24 04:27:40'),
(88, 5, 17, 37, 65.00, '2026-07-24 04:27:45', '2026-07-24 04:27:45'),
(89, 11, 17, 37, 80.00, '2026-07-24 04:27:48', '2026-07-24 04:27:48'),
(90, 8, 17, 37, 55.00, '2026-07-24 04:28:00', '2026-07-24 04:28:00'),
(91, 10, 17, 37, 98.00, '2026-07-24 04:28:02', '2026-07-24 04:28:02'),
(92, 9, 18, 37, 46.00, '2026-07-24 04:28:08', '2026-07-24 04:28:08'),
(93, 5, 18, 37, 59.00, '2026-07-24 04:28:12', '2026-07-24 04:28:12'),
(94, 11, 18, 37, 80.00, '2026-07-24 04:28:18', '2026-07-24 04:28:18'),
(95, 8, 18, 37, 70.00, '2026-07-24 04:28:21', '2026-07-24 04:28:21'),
(96, 10, 18, 37, 70.00, '2026-07-24 04:28:23', '2026-07-24 04:28:23'),
(97, 5, 33, 37, 85.00, '2026-07-24 04:28:34', '2026-07-24 04:28:34'),
(98, 11, 33, 37, 86.00, '2026-07-24 04:28:36', '2026-07-24 04:28:36'),
(99, 8, 33, 37, 85.00, '2026-07-24 04:28:38', '2026-07-24 04:28:38'),
(100, 10, 33, 37, 85.00, '2026-07-24 04:28:39', '2026-07-24 04:28:39'),
(101, 9, 34, 37, 76.00, '2026-07-24 04:28:49', '2026-07-24 04:28:49'),
(102, 5, 34, 37, 79.00, '2026-07-24 04:28:53', '2026-07-24 04:28:53'),
(103, 11, 34, 37, 85.00, '2026-07-24 04:28:55', '2026-07-24 04:28:55'),
(104, 8, 34, 37, 81.00, '2026-07-24 04:29:00', '2026-07-24 04:29:00'),
(105, 10, 34, 37, 80.00, '2026-07-24 04:29:03', '2026-07-24 04:29:03'),
(106, 9, 35, 37, 58.00, '2026-07-24 04:29:12', '2026-07-24 04:29:12'),
(107, 5, 35, 37, 52.00, '2026-07-24 04:29:14', '2026-07-24 04:29:14'),
(108, 11, 35, 37, 98.00, '2026-07-24 04:29:16', '2026-07-24 04:29:16'),
(109, 8, 35, 37, 100.00, '2026-07-24 04:29:21', '2026-07-24 04:29:21'),
(110, 10, 35, 37, 100.00, '2026-07-24 04:29:26', '2026-07-24 04:29:26'),
(111, 9, 36, 37, 49.00, '2026-07-24 04:29:33', '2026-07-24 04:29:33'),
(112, 5, 36, 37, 59.00, '2026-07-24 04:29:35', '2026-07-24 04:29:35'),
(113, 11, 36, 37, 59.00, '2026-07-24 04:29:36', '2026-07-24 04:29:36'),
(114, 8, 36, 37, 65.00, '2026-07-24 04:29:39', '2026-07-24 04:29:39'),
(115, 10, 36, 37, 60.00, '2026-07-24 04:29:44', '2026-07-24 04:29:44'),
(116, 9, 5, 37, 90.00, '2026-07-24 04:30:16', '2026-07-24 04:30:16'),
(117, 11, 5, 37, 95.00, '2026-07-24 04:30:19', '2026-07-24 04:30:19'),
(118, 8, 5, 37, 85.00, '2026-07-24 04:30:20', '2026-07-24 04:30:20'),
(119, 10, 5, 37, 75.00, '2026-07-24 04:30:21', '2026-07-24 04:30:21'),
(120, 9, 6, 37, 60.00, '2026-07-24 04:30:29', '2026-07-24 04:30:29'),
(121, 5, 6, 37, 60.00, '2026-07-24 04:30:31', '2026-07-24 04:30:31'),
(122, 11, 6, 37, 60.00, '2026-07-24 04:30:32', '2026-07-24 04:30:32'),
(123, 8, 6, 37, 60.00, '2026-07-24 04:30:34', '2026-07-24 04:30:34'),
(124, 10, 6, 37, 70.00, '2026-07-24 04:30:35', '2026-07-24 04:30:35'),
(125, 9, 7, 37, 80.00, '2026-07-24 04:30:39', '2026-07-24 04:30:39'),
(126, 5, 7, 37, 97.00, '2026-07-24 04:30:42', '2026-07-24 04:30:42'),
(127, 11, 7, 37, 75.00, '2026-07-24 04:30:45', '2026-07-24 04:30:45'),
(128, 8, 7, 37, 75.00, '2026-07-24 04:30:47', '2026-07-24 04:30:47'),
(129, 10, 7, 37, 70.00, '2026-07-24 04:30:49', '2026-07-24 04:30:49'),
(130, 9, 23, 37, 68.00, '2026-07-24 04:30:54', '2026-07-24 04:30:54'),
(131, 5, 23, 37, 65.00, '2026-07-24 04:30:56', '2026-07-24 04:30:56'),
(132, 11, 23, 37, 59.00, '2026-07-24 04:31:00', '2026-07-24 04:31:00'),
(133, 8, 23, 37, 50.00, '2026-07-24 04:31:02', '2026-07-24 04:31:02'),
(134, 10, 23, 37, 50.00, '2026-07-24 04:31:03', '2026-07-24 04:31:03'),
(135, 9, 24, 37, 76.00, '2026-07-24 04:31:09', '2026-07-24 04:31:09'),
(136, 5, 24, 37, 75.00, '2026-07-24 04:31:10', '2026-07-24 04:31:10'),
(137, 11, 24, 37, 75.00, '2026-07-24 04:31:11', '2026-07-24 04:31:11'),
(138, 8, 24, 37, 75.00, '2026-07-24 04:31:12', '2026-07-24 04:31:12'),
(139, 10, 24, 37, 70.00, '2026-07-24 04:31:14', '2026-07-24 04:31:14'),
(140, 9, 8, 37, 85.00, '2026-07-24 04:39:23', '2026-07-24 04:39:23'),
(141, 5, 8, 37, 87.00, '2026-07-24 04:39:29', '2026-07-24 04:39:29'),
(142, 11, 8, 37, 75.00, '2026-07-24 04:39:31', '2026-07-24 04:39:31'),
(143, 8, 8, 37, 85.00, '2026-07-24 04:39:32', '2026-07-24 04:39:32'),
(144, 10, 8, 37, 85.00, '2026-07-24 04:39:34', '2026-07-24 04:39:34'),
(145, 9, 9, 37, 85.00, '2026-07-24 04:40:05', '2026-07-24 04:40:05'),
(146, 5, 9, 37, 80.00, '2026-07-24 04:40:12', '2026-07-24 04:40:12'),
(147, 11, 9, 37, 65.00, '2026-07-24 04:40:15', '2026-07-24 04:40:15'),
(148, 8, 9, 37, 75.00, '2026-07-24 04:40:17', '2026-07-24 04:40:17'),
(149, 10, 9, 37, 75.00, '2026-07-24 04:40:18', '2026-07-24 04:40:18'),
(150, 9, 21, 37, 76.00, '2026-07-24 04:40:22', '2026-07-24 04:40:22'),
(151, 5, 21, 37, 67.00, '2026-07-24 04:40:25', '2026-07-24 04:40:25'),
(152, 11, 21, 37, 86.00, '2026-07-24 04:40:28', '2026-07-24 04:40:28'),
(153, 8, 21, 37, 60.00, '2026-07-24 04:40:31', '2026-07-24 04:40:31'),
(154, 10, 21, 37, 60.00, '2026-07-24 04:40:32', '2026-07-24 04:40:32'),
(155, 9, 22, 37, 87.00, '2026-07-24 04:40:37', '2026-07-24 04:40:37'),
(156, 5, 22, 37, 76.00, '2026-07-24 04:40:39', '2026-07-24 04:40:39'),
(157, 11, 22, 37, 67.00, '2026-07-24 04:40:41', '2026-07-24 04:40:41'),
(158, 8, 22, 37, 65.00, '2026-07-24 04:40:43', '2026-07-24 04:40:43'),
(159, 10, 22, 37, 65.00, '2026-07-24 04:40:45', '2026-07-24 04:40:45'),
(160, 19, 10, 38, 80.00, '2026-07-24 05:08:04', '2026-07-24 05:08:04'),
(161, 19, 11, 38, 85.00, '2026-07-24 05:08:09', '2026-07-24 05:08:09'),
(162, 19, 12, 38, 94.00, '2026-07-24 05:08:16', '2026-07-24 05:08:16');

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
-- Table structure for table `pengaturan_akademik`
--

CREATE TABLE `pengaturan_akademik` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaturan_akademik`
--

INSERT INTO `pengaturan_akademik` (`id`, `nama_sekolah`, `alamat_sekolah`, `tahun_ajaran`, `semester`, `created_at`, `updated_at`) VALUES
(1, 'SMA POLIBATAM', 'jalan 123 blok ABC', '2025/2026', '1', NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `NIS` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `NIS`, `nama`, `kelas_id`, `created_at`, `updated_at`) VALUES
(5, '12-13579', 'bob', 1, NULL, NULL),
(8, '12-75648', 'gerald', 1, NULL, NULL),
(9, '12-45637', 'aisyah', 1, NULL, NULL),
(10, '12-67854', 'lily', 1, NULL, NULL),
(11, '12-34567', 'ferry', 1, NULL, NULL),
(12, '12-54673', 'febri', 3, NULL, NULL),
(13, '12-67859', 'vebry', 3, NULL, NULL),
(15, '12-12987', 'betty', 11, NULL, NULL),
(16, '12-78560', 'Andika', 3, NULL, NULL),
(17, '121-456', 'Felis', 3, NULL, NULL),
(18, '13-12345', 'Mendi', 3, NULL, NULL),
(19, '12-96857', 'Betty', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` enum('Tugas','PR','Ulangan','UTS','UAS') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tugas',
  `mp_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `nama`, `tipe`, `mp_id`, `created_at`, `updated_at`) VALUES
(1, 'Tugas 1', 'Tugas', 3, '2026-06-19 06:33:18', '2026-06-19 06:33:18'),
(2, 'Tugas 2', 'Tugas', 3, '2026-06-19 06:33:30', '2026-06-19 06:33:30'),
(3, 'Tugas 3', 'Tugas', 3, '2026-06-19 06:33:46', '2026-06-19 06:33:46'),
(5, 'Introducing Our Selfs', 'Tugas', 5, '2026-06-22 23:54:27', '2026-06-22 23:54:42'),
(6, 'Team work', 'Tugas', 5, '2026-06-22 23:54:52', '2026-06-22 23:54:52'),
(7, 'Presentation', 'Tugas', 5, '2026-06-22 23:55:08', '2026-06-22 23:55:08'),
(8, 'PBB dan KPK', 'Tugas', 4, '2026-06-22 23:55:30', '2026-06-22 23:55:30'),
(9, 'Phytagoras', 'Tugas', 4, '2026-06-22 23:55:51', '2026-06-22 23:55:51'),
(10, 'Tugas BAB I', 'Tugas', 1, '2026-06-28 06:25:19', '2026-06-28 06:25:19'),
(11, 'Tugas BAB II', 'Tugas', 1, '2026-06-28 06:25:27', '2026-06-28 06:25:27'),
(12, 'Tugas BAB III', 'Tugas', 1, '2026-06-28 06:25:39', '2026-06-28 06:25:39'),
(13, 'PR 1', 'PR', 3, '2026-07-06 06:03:22', '2026-07-06 06:03:22'),
(14, 'PR 2', 'PR', 3, '2026-07-06 08:15:30', '2026-07-06 08:15:30'),
(15, 'UTS', 'UTS', 1, '2026-07-09 10:12:51', '2026-07-09 10:12:51'),
(16, 'UAS', 'UAS', 1, '2026-07-09 10:12:52', '2026-07-09 10:12:52'),
(17, 'UTS', 'UTS', 2, '2026-07-09 10:12:52', '2026-07-09 10:12:52'),
(18, 'UAS', 'UAS', 2, '2026-07-09 10:12:52', '2026-07-09 10:12:52'),
(19, 'UTS', 'UTS', 3, '2026-07-09 10:12:52', '2026-07-09 10:12:52'),
(20, 'UAS', 'UAS', 3, '2026-07-09 10:12:52', '2026-07-09 10:12:52'),
(21, 'UTS', 'UTS', 4, '2026-07-09 10:12:52', '2026-07-09 10:12:52'),
(22, 'UAS', 'UAS', 4, '2026-07-09 10:12:52', '2026-07-09 10:12:52'),
(23, 'UTS', 'UTS', 5, '2026-07-09 10:12:52', '2026-07-09 10:12:52'),
(24, 'UAS', 'UAS', 5, '2026-07-09 10:12:52', '2026-07-09 10:12:52'),
(33, 'Tugas 1', 'Tugas', 2, '2026-07-11 00:13:45', '2026-07-11 00:13:45'),
(34, 'Tugas 2', 'Tugas', 2, '2026-07-11 00:13:54', '2026-07-11 00:13:54'),
(35, 'Tugas 3', 'Tugas', 2, '2026-07-11 00:14:05', '2026-07-11 00:14:05'),
(36, 'Ulangan 1', 'Ulangan', 2, '2026-07-11 00:14:19', '2026-07-11 00:14:19'),
(49, 'UTS', 'UTS', 12, '2026-07-24 05:04:39', '2026-07-24 05:04:39'),
(50, 'UAS', 'UAS', 12, '2026-07-24 05:04:39', '2026-07-24 05:04:39'),
(51, 'Matematika Dasar', 'PR', 4, '2026-07-24 05:05:50', '2026-07-24 05:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin TU','Guru','Kepala Sekolah') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Guru',
  `no_hp` int DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perguruan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanda_tangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nip`, `nama`, `role`, `no_hp`, `email`, `perguruan`, `pendidikan`, `alamat`, `image`, `tanda_tangan`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '12345', 'Admin TU', 'Admin TU', 812345678, 'admin123@example.com', 'X', 'S1', 'Jl. Merdeka No. 123', 'tELe5LUk8gTpGjy63StbKnWq1gmIltB1hAqmPCPr.png', '', '$2y$12$qAPInKyqbt2hE96583.QbOiBKhndMUgadF1Je.ySf4PXXUgjIOa82', 'aAuKCuW9UvuLcY2TpEgEBsXFJ35xAhdWfgM1goj2a5rmHVrAM27SmvttnEZx', '2026-05-24 06:45:45', '2026-05-24 06:45:45'),
(2, '67890', 'veronika', 'Guru', NULL, NULL, NULL, NULL, NULL, '', '', '$2y$12$L8NMMYCMryx.4zSJvaYIqed99F4mhpYZi.Kd9MAAoDXIaXQhPiucG', 'Iu1DKkjPWJ6T5rb0JgIuAVsCjJMtLyLXWDf0GXkSubdcrG0RhTAKORJjctQy', '2026-05-24 06:45:45', '2026-05-24 06:45:45'),
(4, '13579', 'John Doe', 'Kepala Sekolah', 812345678, 'kepalasekolah@example.com', 'X', 'S1', 'Jl. Merdeka No. 123', '', '4J1Oh2jdUnVeUiE14adduDydOvgaF4JiVcIBMBjV.png', '$2y$12$qAPInKyqbt2hE96583.QbOiBKhndMUgadF1Je.ySf4PXXUgjIOa82', 'qtPqkW9bedsYc02VfnpdUyJ7NJIxXgoP4nqGJPMOLSOWDeHAIfTFYYzjG4bE', '2026-05-24 06:45:45', '2026-05-24 06:45:45'),
(9, '54321', 'qwerty', 'Admin TU', NULL, NULL, NULL, NULL, NULL, '', '', '$2y$12$rOhWxJ9OYo2/C7l9gMWXfuWo.ghxuhllPcC4nAbjSyDDmLiXvkozi', 'Fi0WNvgZavQ1cAEq7efgUH2NEgU3IPO4mwUSWZEnjTfHCOQHBIVRcUlsmnZu', '2026-05-24 06:45:45', '2026-05-24 06:45:45'),
(11, '98765', 'jane dew', 'Guru', NULL, NULL, NULL, NULL, NULL, '45V2bFkDRm4Le77vZJ80n8RY8vZdTSB8pTxOMNMK.png', 'orOCbt9F0pgHhsnXcyaaGplEgKIF1QG0vXKX3VBR.png', '$2y$12$NjW7F7pHv7vtOR5BQt5WoOAO3y11SA./ukKCRvnZ.rFMWy6PgOYBa', 'zutpZ2vBPMQPAOyHejWteWyOpwaUe7jaIJXOq4yxLK3P5jJHrynbBR4U3d1X', NULL, NULL),
(27, '3312511066', 'Cristania Apriliani Hutagaol', 'Admin TU', NULL, NULL, NULL, NULL, NULL, NULL, '', '$2y$12$Je4rQEb2aGEhYrNLmKLhP.r5CV2vPHBkOXMdILwKuVCW48t5R7Tg.', NULL, NULL, NULL),
(28, '3312511073', 'Jauza Arkan Arivin', 'Admin TU', NULL, NULL, NULL, NULL, NULL, NULL, '', '$2y$12$wX6gm3ZyBnSGRkBrsmX2cePeOLCn1ns1R2UQMHcnpxaxuHqsGl0rO', NULL, NULL, NULL),
(30, '01928', 'johny', 'Guru', NULL, NULL, NULL, NULL, NULL, NULL, '', '$2y$12$3R9erXlFmAGEkuDRqh2ZS.GNV0rl4YpkZqZakROtF22HwNff9DWvy', NULL, NULL, NULL),
(31, '34987', 'chika', 'Guru', NULL, NULL, NULL, NULL, NULL, NULL, '', '$2y$12$UbjVVRxjxd8oh5OzJ4ykhufIuKMdEH49jlHblWfuLhAkZHP0BxTJu', NULL, NULL, NULL),
(32, '55555', 'liam', 'Guru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$a8VTEjW8gqXG3RMZLRymvuqU31YKf9us0IyiU60RGDvfHeB6U.eBe', NULL, NULL, NULL),
(35, '01234', 'william', 'Guru', NULL, NULL, NULL, NULL, NULL, NULL, '7XFBk6YXwscDZGq4CG7CyJBam0rid5WwAKOvdJpE.png', '$2y$12$fgHS94r1zAceXwRPk2/T2OCzvqEchoXlbGwp2agAZ87icItAJdDWK', 'SWu3uXQFMuXedKHQ2qoo697awL4EQUNCVZMh5zm67LOKNGzbUHQNR1FPxPFm', NULL, NULL),
(36, '04321', 'ezzio', 'Admin TU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$XjYPNBlEP/ZiFFs8zh62N.vZ8/AH9u5NjhkvFenUJtrC/2PTWjelS', NULL, NULL, NULL),
(37, '09123', 'guru', 'Guru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$y8A99IzneSf5woinSMNi5.6znEMlGMH9d3Ki06UOH.ErnhMJBQpx.', NULL, NULL, NULL),
(38, '12534', 'Andreas', 'Guru', 812345, 'guru@email.com', NULL, NULL, NULL, NULL, NULL, '$2y$12$6LlNyGXzzFAys.W4kJxY6.r1ilxC0/D.w6t3FTs1To5nxs4yHcTfW', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `guru_mengajar`
--
ALTER TABLE `guru_mengajar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_mengajar_user_id_kelas_id_mp_id_unique` (`user_id`,`kelas_id`,`mp_id`),
  ADD KEY `guru_mengajar_kelas_id_foreign` (`kelas_id`),
  ADD KEY `guru_mengajar_mp_id_foreign` (`mp_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_wali_kelas_id_foreign` (`wali_kelas_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mps`
--
ALTER TABLE `mps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nilai_siswa_id_tugas_id_unique` (`siswa_id`,`tugas_id`),
  ADD KEY `nilai_tugas_id_foreign` (`tugas_id`),
  ADD KEY `nilai_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaturan_akademik`
--
ALTER TABLE `pengaturan_akademik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIS` (`NIS`),
  ADD KEY `siswa_kelas_id_foreign` (`kelas_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_mp_id_foreign` (`mp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`,`no_hp`,`email`,`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru_mengajar`
--
ALTER TABLE `guru_mengajar`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `mps`
--
ALTER TABLE `mps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `pengaturan_akademik`
--
ALTER TABLE `pengaturan_akademik`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru_mengajar`
--
ALTER TABLE `guru_mengajar`
  ADD CONSTRAINT `guru_mengajar_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guru_mengajar_mp_id_foreign` FOREIGN KEY (`mp_id`) REFERENCES `mps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guru_mengajar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_wali_kelas_id_foreign` FOREIGN KEY (`wali_kelas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_tugas_id_foreign` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_mp_id_foreign` FOREIGN KEY (`mp_id`) REFERENCES `mps` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
