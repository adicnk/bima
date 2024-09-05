-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 27, 2024 at 09:00 PM
-- Server version: 10.3.39-MariaDB-cll-lve
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stikeppp_bp3mi`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'democrazy', NULL, '2024-08-22 22:30:51', 0),
(2, '::1', 'demo', NULL, '2024-08-22 22:35:24', 0),
(3, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-22 22:35:44', 1),
(4, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-23 01:24:08', 1),
(5, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-23 07:53:34', 1),
(6, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-23 19:44:58', 1),
(7, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-23 19:49:01', 1),
(8, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-23 20:03:17', 1),
(9, '::1', 'ysrent@gmail.com', 2, '2024-08-23 20:50:35', 1),
(10, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-23 20:52:27', 1),
(11, '::1', 'ysrent@gmail.com', 2, '2024-08-23 20:53:58', 1),
(12, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-23 20:59:02', 1),
(13, '::1', 'ysrent@gmail.com', 2, '2024-08-23 20:59:56', 1),
(14, '::1', 'ysrent@gmail.com', 2, '2024-08-23 21:05:36', 1),
(15, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-23 21:15:46', 1),
(16, '::1', 'ysrent@gmail.com', 2, '2024-08-24 03:09:32', 1),
(17, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-24 03:10:16', 1),
(18, '::1', 'baru', 2, '2024-08-24 03:26:34', 0),
(19, '::1', 'ysrent@gmail.com', 2, '2024-08-24 03:27:38', 1),
(20, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-24 03:28:20', 1),
(21, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-24 04:39:05', 1),
(22, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-24 04:43:55', 1),
(23, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-24 08:28:35', 1),
(24, '::1', 'baru', NULL, '2024-08-24 15:01:33', 0),
(25, '::1', 'ysrent@gmail.com', 2, '2024-08-24 15:01:57', 1),
(26, '::1', 'adicoolnkeren@gmail.com', 1, '2024-08-24 15:02:51', 1),
(27, '180.244.135.248', 'bp3mi@stikep-ppnijabar.ac.id', 2, '2024-08-24 16:23:36', 1),
(28, '180.244.135.248', 'admin@stikep-ppnijabar.ac.id', 1, '2024-08-24 16:32:18', 1),
(29, '180.244.135.248', 'bp3mi@stikep-ppnijabar.ac.id', 2, '2024-08-24 16:38:18', 1),
(30, '180.244.135.248', 'bp3mi@stikep-ppnijabar.ac.id', 2, '2024-08-24 16:39:21', 1),
(31, '180.244.135.248', 'bp3mi@stikep-ppnijabar.ac.id', 2, '2024-08-24 16:42:39', 1),
(32, '180.244.135.248', 'bp3mi@stikep-ppnijabar.ac.id', 2, '2024-08-24 16:46:26', 1),
(33, '180.244.135.248', 'bp3mi@stikep-ppnijabar.ac.id', 2, '2024-08-24 16:47:07', 1),
(34, '180.244.135.248', 'admin@stikep-ppnijabar.ac.id', 1, '2024-08-24 16:51:46', 1),
(35, '180.244.135.248', 'bp3mi@stikep-ppnijabar.ac.id', 2, '2024-08-24 22:50:29', 1),
(36, '180.244.135.248', 'bp3mi@stikep-ppnijabar.ac.id', 2, '2024-08-24 22:51:06', 1),
(37, '180.244.135.248', 'admin@stikep-ppnijabar.ac.id', 1, '2024-08-24 22:51:43', 1),
(38, '180.244.135.248', 'bp3mi@stikep-ppnijabar.ac.id', 2, '2024-08-24 22:52:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `nidn_nidk` varchar(15) DEFAULT NULL,
  `klaster` varchar(50) DEFAULT NULL,
  `institusi` varchar(50) DEFAULT NULL,
  `program_studi` varchar(30) DEFAULT NULL,
  `pendidikan` varchar(30) DEFAULT NULL,
  `jabatan` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tanggal_lahir` varchar(30) DEFAULT NULL,
  `ktp` varchar(30) DEFAULT NULL,
  `telp` varchar(30) DEFAULT NULL,
  `hp` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='data dosen';

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `user_id`, `nama`, `nidn_nidk`, `klaster`, `institusi`, `program_studi`, `pendidikan`, `jabatan`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `ktp`, `telp`, `hp`, `email`, `website`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Astri Mutiar', '0415049106', 'Kelompok Perguruan Tinggi Binaan', 'Sekolah Tinggi Ilmu Keperawtan PPNI Jawa Barat', 'Ilmu Keperawatan', 'S2', 'Asisten Ahli', 'jl talaga bodas no 144 BRP', 'Ciamis', '15 April 1991', '3207315504910001', '', '085351700634', NULL, '', NULL, '2024-08-24 16:33:50', '2024-08-24 16:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `dosen_profile`
--

CREATE TABLE `dosen_profile` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `penelitian` int(11) DEFAULT NULL,
  `pengabdian` int(11) DEFAULT NULL,
  `artikel_internasional` int(11) DEFAULT NULL,
  `hki` int(11) DEFAULT NULL,
  `buku` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen_profile`
--

INSERT INTO `dosen_profile` (`id`, `dosen_id`, `penelitian`, `pengabdian`, `artikel_internasional`, `hki`, `buku`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 6, 10, 2, '2024-08-24 16:33:50', '2024-08-24 16:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `isdt`
--

CREATE TABLE `isdt` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `scopus_id` int(11) DEFAULT NULL,
  `index` varchar(30) DEFAULT NULL,
  `skor` int(4) DEFAULT NULL,
  `wos` int(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='index sains dan teknologi';

-- --------------------------------------------------------

--
-- Table structure for table `makro_riset`
--

CREATE TABLE `makro_riset` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `makro_riset`
--

INSERT INTO `makro_riset` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Kelompok Riset Terapan Berbasis Sumber Daya Alam', '2024-08-03 15:21:27', '2024-08-03 15:21:31'),
(2, 'Kelompok Riset Maju Berbasis   Sumber Daya Alam', '2024-08-03 15:23:20', '2024-08-03 15:23:22'),
(3, 'Kelompok Riset Terapan Manufaktur', '2024-08-03 15:24:37', '2024-08-03 15:24:39'),
(4, 'Kelompok Riset Maju Manufaktur', '2024-08-03 15:25:23', '2024-08-03 15:25:25'),
(5, 'Kelompok Riset Teknologi Tinggi', '2024-08-03 15:26:54', '2024-08-03 15:26:57'),
(6, 'Kelompok Riset Rintisan Terdepan', '2024-08-03 15:27:58', '2024-08-03 15:28:01'),
(7, 'Kelompok Riset Lainnya', '2024-08-03 15:29:10', '2024-08-03 15:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1724383815, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penilai`
--

CREATE TABLE `penilai` (
  `id` int(11) NOT NULL,
  `nidn_nidk` varchar(15) DEFAULT NULL,
  `klaster` varchar(30) DEFAULT NULL,
  `institusi` varchar(50) DEFAULT NULL,
  `program_studi` varchar(30) DEFAULT NULL,
  `jenjang_pendidikan` varchar(30) DEFAULT NULL,
  `jabatan_akademik` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tanggal_lahir` varchar(8) DEFAULT NULL,
  `ktp` varchar(30) DEFAULT NULL,
  `telp` varchar(30) DEFAULT NULL,
  `hp` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='data dosen' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `penilai_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rab`
--

CREATE TABLE `rab` (
  `id` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `rab_kelompok_id` int(11) DEFAULT NULL,
  `dana_disetujui` int(11) DEFAULT NULL,
  `dana_direncanakan` int(11) DEFAULT NULL,
  `grant_total` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Rencana Anggaran Belanja';

-- --------------------------------------------------------

--
-- Table structure for table `rab_detail`
--

CREATE TABLE `rab_detail` (
  `id` int(11) NOT NULL,
  `rab_id` int(11) DEFAULT NULL,
  `rab_komponen_id` int(11) DEFAULT NULL,
  `rab_satuan_id` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rab_komponen`
--

CREATE TABLE `rab_komponen` (
  `id` int(11) NOT NULL,
  `rab_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `rab_satuan_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rab_komponen`
--

INSERT INTO `rab_komponen` (`id`, `rab_id`, `name`, `rab_satuan_id`, `created_at`, `updated_at`) VALUES
(1, 0, 'Transport Penelitian', 1, '2024-08-03 17:35:18', '2024-08-03 17:35:21'),
(2, 0, 'Ruang Penunjang Penelitian', 2, '2024-08-03 17:35:23', '2024-08-03 17:35:26'),
(3, 0, 'Biaya Kosumsi Rapat', 3, '2024-08-03 17:36:36', '2024-08-03 17:36:38'),
(4, 0, 'Kebun Percobaan', 2, '2024-08-04 08:35:24', '2024-08-04 08:35:27'),
(5, 0, 'Penginapan', 3, '2024-08-04 08:35:29', '2024-08-04 08:35:31'),
(6, 0, 'Biaya Seminar Nasional', 4, '2024-08-04 08:35:33', '2024-08-04 08:35:36'),
(7, 0, 'Tiket', 1, '2024-08-04 08:35:37', '2024-08-04 08:35:39'),
(8, 0, 'Biaya Penyusunan Buku termasuk Book Chapter', 4, '2024-08-04 08:35:41', '2024-08-04 08:35:43'),
(9, 0, 'Publikasi di Jurnal Internasional', 4, '2024-08-04 08:35:45', '2024-08-04 08:35:46'),
(10, 0, 'Biaya Seminar Internasional', 4, '2024-08-04 08:35:48', '2024-08-04 08:35:50'),
(11, 0, 'Obyek Penelitian', 2, '2024-08-04 08:35:51', '2024-08-04 08:35:53'),
(12, 0, 'Uang Harian Rapat di dalam Kantor', 3, '2024-08-04 08:35:54', '2024-08-04 08:35:56'),
(13, 0, 'HR Pengolah Data', 5, '2024-08-04 08:36:02', '2024-08-04 08:36:03'),
(14, 0, 'HR Sekretariat / Administrasi Peneliti', 6, '2024-08-04 08:36:06', '2024-08-04 08:36:07'),
(15, 0, 'Transport', 1, '2024-08-04 08:36:10', '2024-08-04 08:36:12'),
(16, 0, 'Biaya Analisis Sample', 2, '2024-08-04 08:36:14', '2024-08-04 08:36:16'),
(17, 0, 'Uang Harian', 3, '2024-08-04 08:36:17', '2024-08-04 08:36:19'),
(18, 0, 'Bahan Penelitin (Habis Pakai)', 2, '2024-08-04 08:36:20', '2024-08-04 08:36:22'),
(19, 0, 'Tiket', 1, '2024-08-04 08:36:24', '2024-08-04 08:36:26'),
(20, 0, 'Peralatan Penelitian', 2, '2024-08-04 08:36:28', '2024-08-04 08:36:29'),
(21, 0, 'Penginapan', 3, '2024-08-04 08:36:46', '2024-08-04 08:36:47'),
(22, 0, 'Biaya Konsumsi Rapat', 3, '2024-08-04 08:36:49', '2024-08-04 08:36:51'),
(23, 0, 'Honorarium Narasumber', 7, '2024-08-04 08:36:53', '2024-08-04 08:36:54'),
(24, 0, 'Biaya Pembuatan Uji Produk', 4, '2024-08-04 08:36:56', '2024-08-04 08:36:58'),
(25, 0, 'ATK', 4, '2024-08-04 08:37:00', '2024-08-04 08:37:02'),
(26, 0, 'Biaya Kosumsi', 3, '2024-08-04 08:37:07', '2024-08-04 08:37:09'),
(27, 0, 'Luaran Kl (paten, hak cipta, dll)', 4, '2024-08-04 08:37:13', '2024-08-04 08:37:15'),
(28, 0, 'FGD Persiapan Penelitian', 4, '2024-08-04 08:37:31', '2024-08-04 08:37:32'),
(29, 0, 'HR Petugas Survey', 3, '2024-08-04 08:37:34', '2024-08-04 08:37:36'),
(30, 0, 'Biaya Pembuatan Dokumen Feasibility Study', 4, '2024-08-04 08:37:38', '2024-08-04 08:37:39'),
(31, 0, 'HR Sekretariat / Administrasi Peneliti', 6, '2024-08-04 08:37:41', '2024-08-04 08:37:43'),
(32, 0, 'Uang Harian', 3, '2024-08-04 08:37:45', '2024-08-04 08:37:48'),
(33, 0, 'Biaya Luaran Iptek Lainnya (Purwa rupa, TTG, dll)', 4, '2024-08-04 08:37:50', '2024-08-04 08:37:51'),
(34, 0, 'HR Pembantu Lapangan', 3, '2024-08-04 08:37:53', '2024-08-04 08:37:55'),
(35, 0, 'Uang Harian Rapat di Dalam Kantor', 3, '2024-08-04 08:37:56', '2024-08-04 08:38:00'),
(36, 0, 'Uang Harian Rapat di Luar Kantor', 3, '2024-08-04 08:38:02', '2024-08-04 08:38:05'),
(37, 0, 'HR Sekretariat / Administrasi Peneliti', 6, '2024-08-04 08:38:11', '2024-08-04 08:38:13'),
(38, 0, 'Uang Harian Rapat di Luar Kantor', 3, '2024-08-04 08:38:17', '2024-08-04 08:38:20'),
(39, 0, 'Transport Lokal', 1, '2024-08-04 08:38:23', '2024-08-04 08:38:25'),
(40, 0, 'HR Pembantu Peneliti', 7, '2024-08-04 08:38:27', '2024-08-04 08:38:29'),
(41, 0, 'Biaya Publikasi Artikel di Jurnal Nasional', 4, '2024-08-04 08:38:31', '2024-08-04 08:38:32'),
(42, 0, 'Barang Persediaan', 2, '2024-08-04 08:38:34', '2024-08-04 08:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `rab_satuan`
--

CREATE TABLE `rab_satuan` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rab_satuan`
--

INSERT INTO `rab_satuan` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'OK (kali)', '2024-08-03 16:47:45', '2024-08-03 16:47:48'),
(2, 'Unit', '2024-08-03 16:48:34', '2024-08-03 16:48:36'),
(3, 'OH', '2024-08-03 16:49:03', '2024-08-03 16:49:05'),
(4, 'Paket', '2024-08-03 16:49:28', '2024-08-03 16:49:32'),
(5, 'P (Penelitian)', '2024-08-03 16:51:20', '2024-08-03 16:51:22'),
(6, 'OB', '2024-08-03 16:51:42', '2024-08-03 16:51:45'),
(7, 'OJ', '2024-08-03 16:52:47', '2024-08-03 16:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_penelitian`
--

CREATE TABLE `riwayat_penelitian` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='riwayat penelitian dosen';

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pengabdian`
--

CREATE TABLE `riwayat_pengabdian` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='riwayat pengabdian dosen' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `scopus`
--

CREATE TABLE `scopus` (
  `id` int(11) NOT NULL,
  `scopus_id` int(11) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `scpous_id` varchar(10) DEFAULT NULL,
  `h_index` int(11) DEFAULT NULL,
  `articles` int(11) DEFAULT NULL,
  `citation` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='konten di isdt';

--
-- Dumping data for table `scopus`
--

INSERT INTO `scopus` (`id`, `scopus_id`, `dosen_id`, `scpous_id`, `h_index`, `articles`, `citation`, `created_at`, `updated_at`) VALUES
(1, 0, 1, NULL, 4, 2, 6, '2024-08-24 16:33:50', '2024-08-24 16:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `sinta`
--

CREATE TABLE `sinta` (
  `id` int(50) NOT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `sinta_id` varchar(10) DEFAULT NULL,
  `overall` int(11) DEFAULT NULL,
  `3_year` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sinta`
--

INSERT INTO `sinta` (`id`, `dosen_id`, `sinta_id`, `overall`, `3_year`, `created_at`, `updated_at`) VALUES
(1, 1, '6698251', 303, NULL, '2024-08-24 16:33:50', '2024-08-24 16:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `substansi_penelitian`
--

CREATE TABLE `substansi_penelitian` (
  `id` int(11) NOT NULL,
  `usulan_penelitian_id` int(11) DEFAULT NULL,
  `makro_riset_id` int(11) DEFAULT NULL,
  `filename` varchar(50) DEFAULT NULL,
  `direktori` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_kesanggupan`
--

CREATE TABLE `surat_kesanggupan` (
  `id` int(11) NOT NULL,
  `filename` varchar(50) DEFAULT NULL,
  `direktori` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `dosen_id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'admin@stikep-ppnijabar.ac.id', 'demo', '$2y$10$dum1msJbC1bWevfl5EKnDuH87sAR.x.yZsHgoxW4jh3MMmkrnWpCu', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-08-22 22:32:27', '2024-08-24 16:33:50', NULL),
(2, NULL, 'bp3mi@stikep-ppnijabar.ac.id', 'baru', '$2y$10$rXVxbco1dCflr.QBY9lkiu5L45ru3k5bOrCLO9f63693dOpFmCG/.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-08-23 20:50:12', '2024-08-24 16:33:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usulan_penelitian`
--

CREATE TABLE `usulan_penelitian` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL DEFAULT 0,
  `judul` text DEFAULT NULL,
  `ketua_nama` varchar(50) DEFAULT NULL,
  `ketua_id` int(11) DEFAULT NULL,
  `bidang_fokus` varchar(30) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `peran` varchar(4) DEFAULT NULL,
  `status` varchar(4) DEFAULT NULL,
  `hasil` int(11) DEFAULT NULL,
  `lama` int(11) DEFAULT NULL,
  `tema` varchar(50) DEFAULT NULL,
  `skema` varchar(30) DEFAULT NULL,
  `topik` varchar(50) DEFAULT NULL,
  `ruang_lingkup` varchar(50) DEFAULT NULL,
  `rumpun_ilmu` varchar(30) DEFAULT NULL,
  `target_tkt` int(11) DEFAULT NULL,
  `tahun_usulan` varchar(4) DEFAULT NULL,
  `tahun_pelaksanaan` varchar(4) DEFAULT NULL,
  `ketua_sinta_id` int(11) DEFAULT NULL,
  `file` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usulan_pengabdian`
--

CREATE TABLE `usulan_pengabdian` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `judul` text DEFAULT NULL,
  `bidang_fokus` varchar(30) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `status` varchar(4) DEFAULT NULL,
  `penilaian` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wos`
--

CREATE TABLE `wos` (
  `id` int(11) NOT NULL,
  `wos` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen_profile`
--
ALTER TABLE `dosen_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `isdt`
--
ALTER TABLE `isdt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `makro_riset`
--
ALTER TABLE `makro_riset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilai`
--
ALTER TABLE `penilai`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rab`
--
ALTER TABLE `rab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rab_detail`
--
ALTER TABLE `rab_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rab_komponen`
--
ALTER TABLE `rab_komponen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rab_satuan_id` (`rab_satuan_id`);

--
-- Indexes for table `rab_satuan`
--
ALTER TABLE `rab_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_penelitian`
--
ALTER TABLE `riwayat_penelitian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_pengabdian`
--
ALTER TABLE `riwayat_pengabdian`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `scopus`
--
ALTER TABLE `scopus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sinta`
--
ALTER TABLE `sinta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `substansi_penelitian`
--
ALTER TABLE `substansi_penelitian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_kesanggupan`
--
ALTER TABLE `surat_kesanggupan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `usulan_penelitian`
--
ALTER TABLE `usulan_penelitian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usulan_pengabdian`
--
ALTER TABLE `usulan_pengabdian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wos`
--
ALTER TABLE `wos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dosen_profile`
--
ALTER TABLE `dosen_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `isdt`
--
ALTER TABLE `isdt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `makro_riset`
--
ALTER TABLE `makro_riset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penilai`
--
ALTER TABLE `penilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rab`
--
ALTER TABLE `rab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rab_detail`
--
ALTER TABLE `rab_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rab_komponen`
--
ALTER TABLE `rab_komponen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `rab_satuan`
--
ALTER TABLE `rab_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `riwayat_penelitian`
--
ALTER TABLE `riwayat_penelitian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_pengabdian`
--
ALTER TABLE `riwayat_pengabdian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scopus`
--
ALTER TABLE `scopus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sinta`
--
ALTER TABLE `sinta`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `substansi_penelitian`
--
ALTER TABLE `substansi_penelitian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_kesanggupan`
--
ALTER TABLE `surat_kesanggupan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usulan_penelitian`
--
ALTER TABLE `usulan_penelitian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usulan_pengabdian`
--
ALTER TABLE `usulan_pengabdian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wos`
--
ALTER TABLE `wos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rab_komponen`
--
ALTER TABLE `rab_komponen`
  ADD CONSTRAINT `rab_satuan_id_fk` FOREIGN KEY (`rab_satuan_id`) REFERENCES `rab_satuan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
