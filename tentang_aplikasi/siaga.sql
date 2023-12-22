-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 06:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siaga`
--

-- --------------------------------------------------------

--
-- Table structure for table `datamakan`
--

CREATE TABLE `datamakan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `tanggalwaktu` datetime NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `datamakan`
--

INSERT INTO `datamakan` (`id`, `nik`, `nama`, `shift`, `tanggalwaktu`, `kategori`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, '0123456789104', 'Tonaji', 'Malam', '2023-12-07 16:11:03', 'Prasmanan', 'Kantin', '2023-12-07 09:11:03', '2023-12-07 09:11:03'),
(2, '0123456789104', 'Tonaji', 'Malam', '2023-12-07 16:34:03', 'Prasmanan', 'Kantin', '2023-12-07 09:34:03', '2023-12-07 09:34:03'),
(3, '0123456789101', 'Chandra Kirana', 'Malam', '2023-12-07 16:34:31', 'Prasmanan', 'Kantin', '2023-12-07 09:34:31', '2023-12-07 09:34:31'),
(4, '0123456789101', 'Chandra Kirana', 'Malam', '2023-12-07 16:34:41', 'Prasmanan', 'Kantin', '2023-12-07 09:34:41', '2023-12-07 09:34:41'),
(5, '0123456789103', 'Agus Sopyan', 'Malam', '2023-12-07 16:34:48', 'Prasmanan', 'Kantin', '2023-12-07 09:34:48', '2023-12-07 09:34:48'),
(6, '0123456789102', 'Risman', 'Malam', '2023-12-07 16:34:54', 'Prasmanan', 'Kantin', '2023-12-07 09:34:54', '2023-12-07 09:34:54'),
(7, '0123456789101', 'Chandra Kirana', 'undefined', '2023-12-13 16:35:31', 'Packmeal', 'Packmeal', '2023-12-13 09:35:31', '2023-12-13 09:35:31'),
(8, '0123456789104', 'Tonaji', 'undefined', '2023-12-13 16:35:51', 'Packmeal', 'Packmeal', '2023-12-13 09:35:51', '2023-12-13 09:35:51'),
(9, '0123456789101', 'Chandra Kirana', 'undefined', '2023-12-13 16:35:54', 'Packmeal', 'Packmeal', '2023-12-13 09:35:54', '2023-12-13 09:35:54'),
(10, '0123456789103', 'Agus Sopyan', 'undefined', '2023-12-13 16:35:56', 'Packmeal', 'Packmeal', '2023-12-13 09:35:56', '2023-12-13 09:35:56'),
(11, '0123456789103', 'Agus Sopyan', 'undefined', '2023-12-13 16:37:45', 'Prasmanan', 'Kantin', '2023-12-13 09:37:45', '2023-12-13 09:37:45'),
(12, '0123456789101', 'Chandra Kirana', 'Siang', '2023-12-21 12:17:00', 'Prasmanan', 'Kantin', '2023-12-21 05:17:00', '2023-12-21 05:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_makanan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`nama_makanan`)),
  `tanggal_berlaku` date NOT NULL,
  `shift` text NOT NULL,
  `jenis_makanan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama_makanan`, `tanggal_berlaku`, `shift`, `jenis_makanan`, `created_at`, `updated_at`) VALUES
(1, '[\"Risol\",\"Pisang Coklat\",\"Teh\",\"Kopi\"]', '2023-11-27', 'Siang', 'Snack', '2023-11-29 04:45:15', '2023-11-29 04:45:15'),
(2, '[\"Risol\",\"Pisang Coklat\",\"Teh\",\"Kopi\"]', '2023-11-30', 'Siang', 'Snack', '2023-11-29 04:45:15', '2023-11-29 04:51:26'),
(3, '[\"Risol\",\"Pisang Coklat\",\"Teh\",\"Kopi\"]', '2023-12-02', 'Pagi', 'Snack', '2023-11-29 04:45:15', '2023-11-29 04:45:15'),
(4, '[\"Risol\",\"Pisang Coklat\",\"Teh\",\"Kopi\"]', '2023-12-03', 'Malam', 'Snack', '2023-11-29 04:45:15', '2023-11-29 04:45:15'),
(5, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-11-28', 'Malam', 'Menu Spesial', '2023-11-29 04:47:32', '2023-11-29 04:47:32'),
(6, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-01', 'Siang', 'Menu Spesial', '2023-11-29 04:47:32', '2023-11-29 04:47:32'),
(7, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-02', 'Siang', 'Menu Spesial', '2023-11-29 04:47:32', '2023-11-29 04:47:32'),
(8, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-03', 'Pagi', 'Menu Spesial', '2023-11-29 04:47:32', '2023-11-29 04:47:32'),
(9, '[\"Nasi\",\"Telur\",\"Sayur\"]', '2023-11-28', 'Pagi', 'Reguler', '2023-11-29 04:48:13', '2023-11-29 04:48:13'),
(10, '[\"Nasi\",\"Telur\",\"Sayur\"]', '2023-12-01', 'Siang', 'Reguler', '2023-11-29 04:48:13', '2023-11-29 04:48:13'),
(11, '[\"Nasi\",\"Telur\",\"Sayur\"]', '2023-12-02', 'Pagi', 'Reguler', '2023-11-29 04:48:13', '2023-11-29 04:48:13'),
(12, '[\"Nasi\",\"Telur\",\"Sayur\"]', '2023-12-03', 'Malam', 'Reguler', '2023-11-29 04:48:13', '2023-11-29 04:48:13'),
(13, '[\"Nasi, Ikan Nila Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur\"]', '2023-12-04', 'Siang', 'Menu Spesial', '2023-12-06 05:24:05', '2023-12-06 05:24:05'),
(14, '[\"Nasi, Ikan Nila Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur\"]', '2023-12-05', 'Siang', 'Menu Spesial', '2023-12-06 05:24:05', '2023-12-06 05:24:05'),
(15, '[\"Nasi, Ikan Nila Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur\"]', '2023-12-06', 'Malam', 'Menu Spesial', '2023-12-06 05:24:05', '2023-12-06 05:24:05'),
(16, '[\"Nasi, Ikan Nila Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur\"]', '2023-12-09', 'Pagi', 'Menu Spesial', '2023-12-06 05:24:05', '2023-12-06 05:24:05'),
(17, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-07', 'Pagi', 'Menu Spesial', '2023-12-07 05:46:29', '2023-12-07 05:46:29'),
(18, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-09', 'Siang', 'Menu Spesial', '2023-12-07 05:46:29', '2023-12-07 05:46:29'),
(19, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-10', 'Malam', 'Menu Spesial', '2023-12-07 05:46:29', '2023-12-07 05:46:29'),
(20, '[\"Risol\",\"Pisang Goreng\",\"Kopi\",\"Teh\"]', '2023-12-05', 'Siang', 'Snack', '2023-12-07 05:47:28', '2023-12-07 05:47:28'),
(21, '[\"Risol\",\"Pisang Goreng\",\"Kopi\",\"Teh\"]', '2023-12-08', 'Siang', 'Snack', '2023-12-07 05:47:28', '2023-12-07 05:47:28'),
(22, '[\"Risol\",\"Pisang Goreng\",\"Kopi\",\"Teh\"]', '2023-12-09', 'Malam', 'Snack', '2023-12-07 05:47:28', '2023-12-07 05:47:28'),
(23, '[\"Risol\",\"Pisang Goreng\",\"Kopi\",\"Teh\"]', '2023-12-10', 'Pagi', 'Snack', '2023-12-07 05:47:28', '2023-12-07 05:47:28'),
(24, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-11', 'Siang', 'Menu Spesial', '2023-12-13 05:18:11', '2023-12-13 05:18:11'),
(25, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-12', 'Pagi', 'Menu Spesial', '2023-12-13 05:18:11', '2023-12-13 05:18:11'),
(26, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-13', 'Malam', 'Menu Spesial', '2023-12-13 05:18:11', '2023-12-13 05:18:11'),
(27, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-14', 'Siang', 'Menu Spesial', '2023-12-13 05:18:11', '2023-12-13 05:18:11'),
(28, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-15', 'Siang', 'Menu Spesial', '2023-12-13 05:18:11', '2023-12-13 05:18:11'),
(29, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-16', 'Malam', 'Menu Spesial', '2023-12-13 05:18:11', '2023-12-13 05:18:11'),
(30, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-17', 'Siang', 'Menu Spesial', '2023-12-13 05:18:11', '2023-12-13 05:18:11'),
(31, '[\"Risol\",\"Pisang Coklat\",\"Tahu isi\",\"Kopi\",\"Teh Manis\"]', '2023-12-11', 'Pagi', 'Snack', '2023-12-13 05:19:05', '2023-12-13 05:19:05'),
(32, '[\"Risol\",\"Pisang Coklat\",\"Tahu isi\",\"Kopi\",\"Teh Manis\"]', '2023-12-12', 'Siang', 'Snack', '2023-12-13 05:19:05', '2023-12-13 05:19:05'),
(33, '[\"Risol\",\"Pisang Coklat\",\"Tahu isi\",\"Kopi\",\"Teh Manis\"]', '2023-12-13', 'Malam', 'Snack', '2023-12-13 05:19:05', '2023-12-13 05:19:05'),
(34, '[\"Risol\",\"Pisang Coklat\",\"Tahu isi\",\"Kopi\",\"Teh Manis\"]', '2023-12-14', 'Siang', 'Snack', '2023-12-13 05:19:05', '2023-12-13 05:19:05'),
(35, '[\"Risol\",\"Pisang Coklat\",\"Tahu isi\",\"Kopi\",\"Teh Manis\"]', '2023-12-15', 'Siang', 'Snack', '2023-12-13 05:19:05', '2023-12-13 05:19:05'),
(36, '[\"Risol\",\"Pisang Coklat\",\"Tahu isi\",\"Kopi\",\"Teh Manis\"]', '2023-12-16', 'Malam', 'Snack', '2023-12-13 05:19:05', '2023-12-13 05:19:05'),
(37, '[\"Risol\",\"Pisang Coklat\",\"Tahu isi\",\"Kopi\",\"Teh Manis\"]', '2023-12-17', 'Siang', 'Snack', '2023-12-13 05:19:05', '2023-12-13 05:19:05'),
(38, '[\"Nasi\",\"Ayam Goreng\",\"Sayur\"]', '2023-12-11', 'Siang', 'Reguler', '2023-12-13 05:19:51', '2023-12-13 05:19:51'),
(39, '[\"Nasi\",\"Ayam Goreng\",\"Sayur\"]', '2023-12-12', 'Siang', 'Reguler', '2023-12-13 05:19:51', '2023-12-13 05:19:51'),
(40, '[\"Nasi\",\"Ayam Goreng\",\"Sayur\"]', '2023-12-13', 'Siang', 'Reguler', '2023-12-13 05:19:51', '2023-12-13 05:19:51'),
(41, '[\"Nasi\",\"Ayam Goreng\",\"Sayur\"]', '2023-12-14', 'Pagi', 'Reguler', '2023-12-13 05:19:51', '2023-12-13 05:19:51'),
(42, '[\"Nasi\",\"Ayam Goreng\",\"Sayur\"]', '2023-12-15', 'Malam', 'Reguler', '2023-12-13 05:19:51', '2023-12-13 05:19:51'),
(43, '[\"Nasi\",\"Ayam Goreng\",\"Sayur\"]', '2023-12-16', 'Siang', 'Reguler', '2023-12-13 05:19:51', '2023-12-13 05:19:51'),
(44, '[\"Nasi\",\"Ayam Goreng\",\"Sayur\"]', '2023-12-17', 'Malam', 'Reguler', '2023-12-13 05:19:51', '2023-12-13 05:19:51'),
(45, '[\"Pisang Goreng\"]', '2023-12-13', 'Siang', 'Snack', '2023-12-13 05:36:32', '2023-12-13 05:36:32'),
(46, '[\"bakwan\"]', '2023-12-13', 'Pagi', 'Snack', '2023-12-13 05:36:49', '2023-12-13 05:36:49'),
(47, '[\"Risol\",\"Pisang Coklat\"]', '2023-12-18', 'Pagi', 'Snack', '2023-12-18 06:10:09', '2023-12-18 06:10:09'),
(48, '[\"Risol\",\"Pisang Coklat\"]', '2023-12-19', 'Siang', 'Snack', '2023-12-18 06:10:09', '2023-12-18 06:10:09'),
(49, '[\"Risol\",\"Pisang Coklat\"]', '2023-12-20', 'Malam', 'Snack', '2023-12-18 06:10:09', '2023-12-18 06:10:09'),
(50, '[\"Risol\",\"Pisang Coklat\"]', '2023-12-21', 'Siang', 'Snack', '2023-12-18 06:10:09', '2023-12-18 06:10:09'),
(51, '[\"Risol\",\"Pisang Coklat\"]', '2023-12-22', 'Siang', 'Snack', '2023-12-18 06:10:09', '2023-12-18 06:10:09'),
(52, '[\"Risol\",\"Pisang Coklat\"]', '2023-12-23', 'Malam', 'Snack', '2023-12-18 06:10:09', '2023-12-18 06:10:09'),
(53, '[\"Risol\",\"Pisang Coklat\"]', '2023-12-24', 'Pagi', 'Snack', '2023-12-18 06:10:09', '2023-12-18 06:10:09'),
(54, '[\"Pisang Coklat\",\"Bakwan\",\"Tahu isi\"]', '2023-12-18', 'Siang', 'Snack', '2023-12-18 10:48:12', '2023-12-18 10:48:12'),
(55, '[\"Pisang Coklat\",\"Bakwan\",\"Tahu isi\"]', '2023-12-19', 'Pagi', 'Snack', '2023-12-18 10:48:12', '2023-12-18 10:48:12'),
(56, '[\"Pisang Coklat\",\"Bakwan\",\"Tahu isi\"]', '2023-12-20', 'Pagi', 'Snack', '2023-12-18 10:48:12', '2023-12-18 10:48:12'),
(57, '[\"Pisang Coklat\",\"Bakwan\",\"Tahu isi\"]', '2023-12-21', 'Pagi', 'Snack', '2023-12-18 10:48:12', '2023-12-18 10:48:12'),
(58, '[\"Pisang Coklat\",\"Bakwan\",\"Tahu isi\"]', '2023-12-22', 'Pagi', 'Snack', '2023-12-18 10:48:12', '2023-12-18 10:48:12'),
(59, '[\"Pisang Coklat\",\"Bakwan\",\"Tahu isi\"]', '2023-12-23', 'Pagi', 'Snack', '2023-12-18 10:48:12', '2023-12-18 10:48:12'),
(60, '[\"Pisang Coklat\",\"Bakwan\",\"Tahu isi\"]', '2023-12-24', 'Siang', 'Snack', '2023-12-18 10:48:12', '2023-12-18 10:48:12'),
(61, '[\"Keripik Pisang\"]', '2023-12-18', 'Malam', 'Snack', '2023-12-18 10:49:01', '2023-12-18 10:49:01'),
(62, '[\"Keripik Pisang\"]', '2023-12-19', 'Malam', 'Snack', '2023-12-18 10:49:01', '2023-12-18 10:49:01'),
(63, '[\"Keripik Pisang\"]', '2023-12-20', 'Siang', 'Snack', '2023-12-18 10:49:01', '2023-12-18 10:49:01'),
(64, '[\"Keripik Pisang\"]', '2023-12-21', 'Malam', 'Snack', '2023-12-18 10:49:01', '2023-12-18 10:49:01'),
(65, '[\"Keripik Pisang\"]', '2023-12-22', 'Malam', 'Snack', '2023-12-18 10:49:01', '2023-12-18 10:49:01'),
(66, '[\"Keripik Pisang\"]', '2023-12-23', 'Siang', 'Snack', '2023-12-18 10:49:01', '2023-12-18 10:49:01'),
(67, '[\"Keripik Pisang\"]', '2023-12-24', 'Malam', 'Snack', '2023-12-18 10:49:01', '2023-12-18 10:49:01'),
(68, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-18', 'Pagi', 'Menu Spesial', '2023-12-19 04:57:06', '2023-12-19 04:57:06'),
(69, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-19', 'Pagi', 'Menu Spesial', '2023-12-19 04:57:06', '2023-12-19 04:57:06'),
(70, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-20', 'Pagi', 'Menu Spesial', '2023-12-19 04:57:06', '2023-12-19 04:57:06'),
(71, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-21', 'Pagi', 'Menu Spesial', '2023-12-19 04:57:06', '2023-12-19 04:57:06'),
(72, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-22', 'Pagi', 'Menu Spesial', '2023-12-19 04:57:06', '2023-12-19 04:57:06'),
(73, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-23', 'Pagi', 'Menu Spesial', '2023-12-19 04:57:06', '2023-12-19 04:57:06'),
(74, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-24', 'Pagi', 'Menu Spesial', '2023-12-19 04:57:06', '2023-12-19 04:57:06'),
(75, '[\"Nasi, Ayam Goreng, Sayur\",\"Nasi, Rendang, Sayur, Buah\"]', '2023-12-18', 'Siang', 'Menu Spesial', '2023-12-19 04:58:08', '2023-12-19 04:58:08'),
(76, '[\"Nasi, Ayam Goreng, Sayur\",\"Nasi, Rendang, Sayur, Buah\"]', '2023-12-19', 'Siang', 'Menu Spesial', '2023-12-19 04:58:08', '2023-12-19 04:58:08'),
(77, '[\"Nasi, Ayam Goreng, Sayur\",\"Nasi, Rendang, Sayur, Buah\"]', '2023-12-20', 'Siang', 'Menu Spesial', '2023-12-19 04:58:08', '2023-12-19 04:58:08'),
(78, '[\"Nasi, Ayam Goreng, Sayur\",\"Nasi, Rendang, Sayur, Buah\"]', '2023-12-21', 'Siang', 'Menu Spesial', '2023-12-19 04:58:08', '2023-12-19 04:58:08'),
(79, '[\"Nasi, Ayam Goreng, Sayur\",\"Nasi, Rendang, Sayur, Buah\"]', '2023-12-22', 'Siang', 'Menu Spesial', '2023-12-19 04:58:08', '2023-12-19 04:58:08'),
(80, '[\"Nasi, Ayam Goreng, Sayur\",\"Nasi, Rendang, Sayur, Buah\"]', '2023-12-23', 'Siang', 'Menu Spesial', '2023-12-19 04:58:08', '2023-12-19 04:58:08'),
(81, '[\"Nasi, Ayam Goreng, Sayur\",\"Nasi, Rendang, Sayur, Buah\"]', '2023-12-24', 'Siang', 'Menu Spesial', '2023-12-19 04:58:08', '2023-12-19 04:58:08'),
(82, '[\"Nasi, Telor, Ikan,Sayur\",\"Nasi, Ayam, Sayur, Buah\"]', '2023-12-18', 'Malam', 'Menu Spesial', '2023-12-19 04:59:01', '2023-12-19 04:59:01'),
(83, '[\"Nasi, Telor, Ikan,Sayur\",\"Nasi, Ayam, Sayur, Buah\"]', '2023-12-19', 'Malam', 'Menu Spesial', '2023-12-19 04:59:01', '2023-12-19 04:59:01'),
(84, '[\"Nasi, Telor, Ikan,Sayur\",\"Nasi, Ayam, Sayur, Buah\"]', '2023-12-20', 'Malam', 'Menu Spesial', '2023-12-19 04:59:01', '2023-12-19 04:59:01'),
(85, '[\"Nasi, Telor, Ikan,Sayur\",\"Nasi, Ayam, Sayur, Buah\"]', '2023-12-21', 'Malam', 'Menu Spesial', '2023-12-19 04:59:01', '2023-12-19 04:59:01'),
(86, '[\"Nasi, Telor, Ikan,Sayur\",\"Nasi, Ayam, Sayur, Buah\"]', '2023-12-22', 'Malam', 'Menu Spesial', '2023-12-19 04:59:01', '2023-12-19 04:59:01'),
(87, '[\"Nasi, Telor, Ikan,Sayur\",\"Nasi, Ayam, Sayur, Buah\"]', '2023-12-23', 'Malam', 'Menu Spesial', '2023-12-19 04:59:01', '2023-12-19 04:59:01'),
(88, '[\"Nasi, Telor, Ikan,Sayur\",\"Nasi, Ayam, Sayur, Buah\"]', '2023-12-24', 'Malam', 'Menu Spesial', '2023-12-19 04:59:01', '2023-12-19 04:59:01'),
(89, '[\"Nasi\",\"Ikan Goreng\",\"Sayur\"]', '2023-12-18', 'Pagi', 'Reguler', '2023-12-21 03:52:32', '2023-12-21 03:52:32'),
(90, '[\"Nasi\",\"Ikan Goreng\",\"Sayur\"]', '2023-12-19', 'Siang', 'Reguler', '2023-12-21 03:52:32', '2023-12-21 03:52:32'),
(91, '[\"Nasi\",\"Ikan Goreng\",\"Sayur\"]', '2023-12-20', 'Malam', 'Reguler', '2023-12-21 03:52:32', '2023-12-21 03:52:32'),
(92, '[\"Nasi\",\"Ikan Goreng\",\"Sayur\"]', '2023-12-21', 'Pagi', 'Reguler', '2023-12-21 03:52:32', '2023-12-21 03:52:32'),
(93, '[\"Nasi\",\"Ikan Goreng\",\"Sayur\"]', '2023-12-22', 'Siang', 'Reguler', '2023-12-21 03:52:32', '2023-12-21 03:52:32'),
(94, '[\"Nasi\",\"Ikan Goreng\",\"Sayur\"]', '2023-12-23', 'Malam', 'Reguler', '2023-12-21 03:52:32', '2023-12-21 03:52:32'),
(95, '[\"Nasi\",\"Ikan Goreng\",\"Sayur\"]', '2023-12-24', 'Pagi', 'Reguler', '2023-12-21 03:52:32', '2023-12-21 03:52:32'),
(96, '[\"Nasi\",\"Ayam\",\"Sayur\"]', '2023-12-18', 'Siang', 'Reguler', '2023-12-21 03:53:19', '2023-12-21 03:53:19'),
(97, '[\"Nasi\",\"Ayam\",\"Sayur\"]', '2023-12-19', 'Malam', 'Reguler', '2023-12-21 03:53:19', '2023-12-21 03:53:19'),
(98, '[\"Nasi\",\"Ayam\",\"Sayur\"]', '2023-12-20', 'Pagi', 'Reguler', '2023-12-21 03:53:19', '2023-12-21 03:53:19'),
(99, '[\"Nasi\",\"Ayam\",\"Sayur\"]', '2023-12-21', 'Siang', 'Reguler', '2023-12-21 03:53:19', '2023-12-21 03:53:19'),
(100, '[\"Nasi\",\"Ayam\",\"Sayur\"]', '2023-12-22', 'Malam', 'Reguler', '2023-12-21 03:53:19', '2023-12-21 03:53:19'),
(101, '[\"Nasi\",\"Ayam\",\"Sayur\"]', '2023-12-23', 'Pagi', 'Reguler', '2023-12-21 03:53:19', '2023-12-21 03:53:19'),
(102, '[\"Nasi\",\"Ayam\",\"Sayur\"]', '2023-12-24', 'Siang', 'Reguler', '2023-12-21 03:53:19', '2023-12-21 03:53:19'),
(103, '[\"Nasi\",\"Ikan Nila\",\"Sayur\"]', '2023-12-18', 'Malam', 'Reguler', '2023-12-21 03:53:56', '2023-12-21 03:53:56'),
(104, '[\"Nasi\",\"Ikan Nila\",\"Sayur\"]', '2023-12-19', 'Pagi', 'Reguler', '2023-12-21 03:53:56', '2023-12-21 03:53:56'),
(105, '[\"Nasi\",\"Ikan Nila\",\"Sayur\"]', '2023-12-20', 'Siang', 'Reguler', '2023-12-21 03:53:56', '2023-12-21 03:53:56'),
(106, '[\"Nasi\",\"Ikan Nila\",\"Sayur\"]', '2023-12-21', 'Malam', 'Reguler', '2023-12-21 03:53:56', '2023-12-21 03:53:56'),
(107, '[\"Nasi\",\"Ikan Nila\",\"Sayur\"]', '2023-12-22', 'Pagi', 'Reguler', '2023-12-21 03:53:56', '2023-12-21 03:53:56'),
(108, '[\"Nasi\",\"Ikan Nila\",\"Sayur\"]', '2023-12-23', 'Siang', 'Reguler', '2023-12-21 03:53:56', '2023-12-21 03:53:56'),
(109, '[\"Nasi\",\"Ikan Nila\",\"Sayur\"]', '2023-12-24', 'Malam', 'Reguler', '2023-12-21 03:53:56', '2023-12-21 03:53:56'),
(110, '[\"Nasi, Ikan Goreng, Sayur\",\"Nasi, Ayam Goreng, Sayur, Buah\"]', '2023-12-25', 'Pagi', 'Menu Spesial', '2023-12-21 05:14:39', '2023-12-21 05:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_27_064627_create_datamakan_table', 1),
(6, '2023_09_27_064652_create_roles_table', 1),
(7, '2023_09_27_064742_create_orders_table', 1),
(8, '2023_09_27_064857_create_menu_table', 1),
(9, '2023_09_27_081549_add_foreignkey_roles_to_users', 1),
(10, '2023_09_27_081856_add_foreignkey_users_to_orders', 1),
(11, '2023_09_27_082641_create_ordermenu_table', 1),
(12, '2023_11_27_102857_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('2016c657-f2c8-42a7-81d3-f8c5074cb300', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 3, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan  untuk 21 Dec 2023 - 23 Dec 2023 pukul 14.00 Sudah Selesai\",\"pesananId\":\"46\"}', NULL, '2023-12-21 02:54:11', '2023-12-21 02:54:11'),
('2594ddf1-d540-457e-b962-fb163b83125a', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 4, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan  untuk 21 Dec 2023 - 23 Dec 2023 pukul 14.00 Sudah Selesai\",\"pesananId\":\"46\"}', '2023-12-21 02:53:50', '2023-12-21 02:51:34', '2023-12-21 02:53:50'),
('33ff40bf-65c1-4448-aadf-d2de022cb50e', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 3, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan Snack untuk 21 Dec 2023 - 22 Dec 2023 pukul 09.00  Sedang Diproses\",\"pesananId\":50}', NULL, '2023-12-21 03:18:55', '2023-12-21 03:18:55'),
('3567a6b9-adbb-49c7-867a-c18738e5090f', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 3, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan Snack untuk 22 Dec 2023 - 22 Dec 2023 pukul 14.00  Sedang Diproses\",\"pesananId\":46}', NULL, '2023-12-21 02:05:08', '2023-12-21 02:05:08'),
('3de5f9ab-1f43-48b9-baaa-7d7e1630cbbc', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 3, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan Others untuk 22 Dec 2023 - 23 Dec 2023 pukul 09.27 Sudah Disetujui \",\"pesananId\":\"47\"}', NULL, '2023-12-21 03:35:14', '2023-12-21 03:35:14'),
('41609410-40c9-4126-8065-70c1b13a0396', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 1, '{\"tujuan\":\"data\",\"data\":\"Pesanan Menu Spesial dari Departemen IT untuk 22 Dec 2023 - 22 Dec 2023 pukul 13.00\",\"pesananId\":45}', NULL, '2023-12-21 02:03:49', '2023-12-21 02:03:49'),
('489ea093-f459-40e0-a53f-131f07d712e6', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 1, '{\"tujuan\":\"data\",\"data\":\"Pesanan Others dari Departemen IT untuk 22 Dec 2023 - 23 Dec 2023 pukul 09.27\",\"pesananId\":\"47\"}', NULL, '2023-12-21 03:31:49', '2023-12-21 03:31:49'),
('4a2850d4-3026-41d1-ad56-7315ed712e6c', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 3, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan Menu Spesial untuk 22 Dec 2023 - 22 Dec 2023 pukul 13.00  Sedang Diproses\",\"pesananId\":45}', NULL, '2023-12-21 02:03:49', '2023-12-21 02:03:49'),
('533c98ff-af46-4821-bece-1bad9a62737a', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 3, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan Snack untuk 21 Dec 2023 - 22 Dec 2023 pukul 13.00  Sedang Diproses\",\"pesananId\":48}', NULL, '2023-12-21 03:00:31', '2023-12-21 03:00:31'),
('67e21873-d161-426b-8a24-35d8c2ec707c', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 3, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan  untuk 22 Dec 2023 - 23 Dec 2023 pukul 10.35 Ditolak \",\"pesananId\":\"47\"}', NULL, '2023-12-21 03:35:47', '2023-12-21 03:35:47'),
('6e1d5585-51e3-43a0-9878-97361054e7d2', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 3, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan Others untuk 21 Dec 2023 - 21 Dec 2023 pukul 09.27 Menunggu Persetujuan\",\"pesananId\":47}', NULL, '2023-12-21 02:27:54', '2023-12-21 02:27:54'),
('6f20792e-3a00-4045-abf4-6bf9b362746e', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 1, '{\"tujuan\":\"data\",\"data\":\"Pesanan Snack dari Departemen IT untuk 22 Dec 2023 - 22 Dec 2023 pukul 14.00\",\"pesananId\":46}', NULL, '2023-12-21 02:05:08', '2023-12-21 02:05:08'),
('73982f38-bd5e-457b-b0fd-9fa1960e556c', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 1, '{\"tujuan\":\"data\",\"data\":\"Pesanan Snack dari Departemen IT untuk 21 Dec 2023 - 22 Dec 2023 pukul 09.00\",\"pesananId\":50}', NULL, '2023-12-21 03:18:55', '2023-12-21 03:18:55'),
('7732599e-b476-4db1-9ba2-94f74cf8f01d', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 2, '{\"tujuan\":\"permintaan\",\"data\":\"Pesanan Others dari Departemen ga untuk 21 Dec 2023 - 22 Dec 2023 Memerlukan Konfirmasi\",\"pesananId\":51}', NULL, '2023-12-21 05:06:49', '2023-12-21 05:06:49'),
('916846c1-2b46-4945-bb29-16461da61af9', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 3, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan Snack untuk 21 Dec 2023 - 21 Dec 2023 pukul 07.00  Sedang Diproses\",\"pesananId\":50}', NULL, '2023-12-21 03:22:30', '2023-12-21 03:22:30'),
('923d9c7c-1c9e-41cf-bac5-254474606e16', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 3, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan Others untuk 22 Dec 2023 - 23 Dec 2023 pukul 09.27 Sudah Disetujui \",\"pesananId\":\"47\"}', NULL, '2023-12-21 03:31:49', '2023-12-21 03:31:49'),
('9790cb16-f237-46b2-b770-aa433b167cd3', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 3, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan  untuk 22 Dec 2023 - 23 Dec 2023 pukul 10.32 Ditolak \",\"pesananId\":\"47\"}', NULL, '2023-12-21 03:32:26', '2023-12-21 03:32:26'),
('9a65254b-29ff-4a31-8f86-9fd03195c2cd', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 2, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan Others untuk 21 Dec 2023 - 22 Dec 2023 pukul 11.00 Menunggu Persetujuan\",\"pesananId\":51}', NULL, '2023-12-21 05:06:49', '2023-12-21 05:06:49'),
('a70f2d78-4d7f-4378-8d1b-cfc8989a784a', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 3, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan  untuk 22 Dec 2023 - 23 Dec 2023 pukul 12.08 Ditolak \",\"pesananId\":\"47\"}', NULL, '2023-12-21 05:08:19', '2023-12-21 05:08:19'),
('bfd79c86-7873-4289-99f6-e310dcd8b9c8', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 1, '{\"tujuan\":\"data\",\"data\":\"Pesanan Others dari Departemen IT untuk 22 Dec 2023 - 23 Dec 2023 pukul 09.27\",\"pesananId\":\"47\"}', NULL, '2023-12-21 03:35:14', '2023-12-21 03:35:14'),
('c845b07d-ccfe-4aaf-b0ce-f9fb52ed037b', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 4, '{\"tujuan\":\"riwayat\",\"data\":\"Pesanan  untuk 21 Dec 2023 - 23 Dec 2023 pukul 14.00 Sudah Selesai\",\"pesananId\":\"46\"}', '2023-12-21 02:53:55', '2023-12-21 02:50:01', '2023-12-21 02:53:55'),
('d0f553c3-306f-4ae3-851e-3b18ef64ee6f', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 2, '{\"tujuan\":\"permintaan\",\"data\":\"Pesanan Others dari Departemen IT untuk 21 Dec 2023 - 21 Dec 2023 Memerlukan Konfirmasi\",\"pesananId\":47}', NULL, '2023-12-21 02:27:54', '2023-12-21 02:27:54'),
('d779785b-8c2e-49ef-a71d-722644ac4c2c', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 1, '{\"tujuan\":\"data\",\"data\":\"Pesanan Snack dari Departemen IT untuk 21 Dec 2023 - 22 Dec 2023 pukul 13.00\",\"pesananId\":48}', NULL, '2023-12-21 03:00:31', '2023-12-21 03:00:31'),
('e9e185d8-83f0-4a40-8160-a5e7b6fe0707', 'App\\Notifications\\UserOrder', 'App\\Models\\User', 1, '{\"tujuan\":\"data\",\"data\":\"Pesanan Snack dari Departemen IT untuk 21 Dec 2023 - 21 Dec 2023 pukul 07.00\",\"pesananId\":50}', NULL, '2023-12-21 03:22:30', '2023-12-21 03:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `ordermenu`
--

CREATE TABLE `ordermenu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_pesanan` varchar(255) NOT NULL,
  `makanan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`makanan`)),
  `tanggal_pesanan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`tanggal_pesanan`)),
  `waktu_pesanan` time NOT NULL,
  `shift` varchar(255) NOT NULL,
  `jumlah_pesanan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`jumlah_pesanan`)),
  `detail_karyawan` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Menunggu',
  `lokasi_pengantaran` text NOT NULL,
  `alasan` text DEFAULT NULL,
  `alasan_pemesanan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_menu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `jenis_pesanan`, `makanan`, `tanggal_pesanan`, `waktu_pesanan`, `shift`, `jumlah_pesanan`, `detail_karyawan`, `catatan`, `status`, `lokasi_pengantaran`, `alasan`, `alasan_pemesanan`, `created_at`, `updated_at`, `id_user`, `id_menu`) VALUES
(45, 'Menu Spesial', '[\"Nasi, Ayam Goreng, Sayur\",\"Nasi, Rendang, Sayur, Buah\",\"Nasi, Ayam Goreng, Sayur\",\"Nasi, Rendang, Sayur, Buah\"]', '[\"2023-12-22\",\"2023-12-23\"]', '13:00:00', 'Siang', '[\"1\",\"2\",\"1\",\"2\"]', '0123456789101 -  Chandra Kirana,0123456789102 - Risman,0123456789103 - Agus Sopyan', NULL, 'Selesai', 'Ruang Meeting', NULL, 'Meeting', '2023-12-21 02:03:49', '2023-12-21 02:39:09', 3, '[79,80]'),
(46, 'Snack', '[\"Risol\",\"Pisang Coklat\",\"Keripik Pisang\"]', '[\"2023-12-21\",\"2023-12-23\"]', '14:00:00', 'Siang', '[\"2\",\"1\",\"3\"]', '0123456789104 - Tonaji,0123456789105 - Hamzah,0123456789106 - Ansar Taufik', NULL, 'Selesai', 'Ruang Meeting', NULL, 'Meeting', '2023-12-21 02:05:08', '2023-12-21 02:54:11', 3, '[51,66]'),
(47, 'Others', '[\"Mie Goreng\",\"Nasi Goreng\",\"Nasi Goreng Ayam\"]', '[\"2023-12-22\",\"2023-12-23\"]', '09:27:54', 'Pagi', '[\"2\",\"2\",\"2\"]', '0123456789101 -  Chandra Kirana,0123456789105 - Hamzah', NULL, 'Ditolak', 'Ruang Meeting', 'Meeting Diundur', 'Meeting', '2023-12-21 02:27:54', '2023-12-21 05:08:19', 3, NULL),
(48, 'Snack', '[\"Risol\",\"Pisang Coklat\",\"Risol\",\"Pisang Coklat\"]', '[\"2023-12-21\",\"2023-12-22\"]', '12:00:00', 'Siang', '[\"1\",\"1\",\"1\",\"0\"]', '0123456789101 -  Chandra Kirana,0123456789106 - Ansar Taufik,0123456789107 - Andri Saputra', NULL, 'Kadaluwarsa', 'Ruang Meeting', NULL, 'Meeting', '2023-12-21 03:00:31', '2023-12-22 03:01:14', 3, '[50,51]'),
(49, 'Snack', '[\"Risol\",\"Pisang Coklat\",\"Risol\",\"Pisang Coklat\"]', '[\"2023-12-21\",\"2023-12-22\"]', '14:00:00', 'Siang', '[\"1\",\"1\",\"1\",\"0\"]', '0123456789101 -  Chandra Kirana,0123456789106 - Ansar Taufik,0123456789107 - Andri Saputra', NULL, 'Kadaluwarsa', 'Ruang Meeting', NULL, 'Meeting', '2023-12-21 03:00:31', '2023-12-22 03:01:14', 3, '[50,51]'),
(50, 'Snack', '[\"Pisang Coklat\",\"Bakwan\",\"Tahu isi\",\"Pisang Coklat\",\"Bakwan\",\"Tahu isi\"]', '[\"2023-12-21\",\"2023-12-22\"]', '09:00:00', 'Pagi', '[\"1\",\"2\",\"1\",\"1\",\"1\",\"2\"]', '0123456789102 - Risman,0123456789103 - Agus Sopyan', NULL, 'Kadaluwarsa', 'Ruang Meeting', NULL, 'Meeting', '2023-12-21 03:18:55', '2023-12-22 03:01:14', 3, '[57,58]'),
(51, 'Others', '[\"Mie Goreng\",\"Nasi Goreng\"]', '[\"2023-12-21\",\"2023-12-22\"]', '14:00:00', 'Siang', '[\"2\",\"2\"]', '0123456789101 -  Chandra Kirana,0123456789102 - Risman', NULL, 'Kadaluwarsa', 'Ruang Meeting', NULL, 'Untuk Meeting', '2023-12-21 05:06:49', '2023-12-22 03:01:14', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'departemen', NULL, NULL),
(2, 'catering', NULL, NULL),
(3, 'hrd', NULL, NULL),
(4, 'ga', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `departemen` varchar(255) DEFAULT NULL,
  `perusahaan` varchar(255) DEFAULT NULL,
  `divisi` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Aktif',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_role` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `name`, `email`, `email_verified_at`, `password`, `level`, `departemen`, `perusahaan`, `divisi`, `no_telp`, `status`, `remember_token`, `created_at`, `updated_at`, `id_role`) VALUES
(1, '123456789012341', 'catering', 'catering@example.com', NULL, '$2y$10$9yqYVuy.GDmrobZwegfbz.yHL2unoDQzVRUiraJ3kS.ZLasGuOU2K', NULL, NULL, NULL, NULL, '081234567890', 'Aktif', NULL, NULL, NULL, 2),
(2, '123456789012342', 'ga', 'ga@example.com', NULL, '$2y$10$9yqYVuy.GDmrobZwegfbz.yHL2unoDQzVRUiraJ3kS.ZLasGuOU2K', 'ga', 'ga', 'PT Mandiri Inti Perkasa', 'ga', '081234567890', 'Aktif', NULL, NULL, NULL, 4),
(3, '123456789012343', 'departemen', 'departemen@example.com', NULL, '$2y$10$9yqYVuy.GDmrobZwegfbz.yHL2unoDQzVRUiraJ3kS.ZLasGuOU2K', 'Kepala Departemen', 'IT', 'PT Mandiri Inti Perkasa', 'IT', '081234567890', 'Aktif', NULL, NULL, NULL, 1),
(4, '123456789012344', 'hrd', 'hrd@example.com', NULL, '$2y$10$9yqYVuy.GDmrobZwegfbz.yHL2unoDQzVRUiraJ3kS.ZLasGuOU2K', 'hrd', 'hrd', 'PT Mandiri Inti Perkasa', 'hrd', '081234567890', 'Aktif', NULL, NULL, NULL, 3),
(6, '0123456789101', 'Chandra Kirana', 'karyawan1@example.com', NULL, '$2y$10$9yqYVuy.GDmrobZwegfbz.yHL2unoDQzVRUiraJ3kS.ZLasGuOU2K', 'Kepala Departemen', 'IT', 'PT.Mandiri Inti Perkasa', 'IT', '081234567890', 'Aktif', NULL, '2023-12-21 05:10:14', '2023-12-21 05:10:14', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datamakan`
--
ALTER TABLE `datamakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `ordermenu`
--
ALTER TABLE `ordermenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordermenu_id_order_foreign` (`id_order`),
  ADD KEY `ordermenu_id_menu_foreign` (`id_menu`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id_user_foreign` (`id_user`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_role_foreign` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datamakan`
--
ALTER TABLE `datamakan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ordermenu`
--
ALTER TABLE `ordermenu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordermenu`
--
ALTER TABLE `ordermenu`
  ADD CONSTRAINT `ordermenu_id_menu_foreign` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordermenu_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
