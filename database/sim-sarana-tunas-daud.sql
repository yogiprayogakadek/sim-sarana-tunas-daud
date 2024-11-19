-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 06:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim-sarana-tunas-daud`
--

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
-- Table structure for table `kerusakan`
--

CREATE TABLE `kerusakan` (
  `id` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `sarana` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`sarana`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_07_17_130436_create_sarana_table', 1),
(7, '2024_07_17_134806_create_peminjaman_table', 1),
(8, '2024_07_17_134835_create_pengembalian_table', 1),
(9, '2024_07_17_134900_create_kerusakan_table', 1);

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `keterangan` text NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `sarana` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`sarana`)),
  `foto` varchar(100) NOT NULL COMMENT 'bukti peminjaman',
  `is_approve` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `tanggal`, `tanggal_pengembalian`, `keterangan`, `user_id`, `sarana`, `foto`, `is_approve`, `created_at`, `updated_at`) VALUES
('52c71d72f90c48169c0bdf97c4f39187', '2024-10-24', '2024-10-25', 'Kegiatan belajar mengajar', '0d3cc035ba114d2789f52688d53e6580', '[{\"saranaId\":\"03869a28a32f4d8ab803a625f955dc53\",\"jumlah\":1,\"namaSarana\":\"Proyektor\",\"kepemilikan\":\"Ruang Admin\"},{\"saranaId\":\"facb861ca53d40368405482fdd465883\",\"jumlah\":2,\"namaSarana\":\"Penghapus Papan Tulis\",\"kepemilikan\":\"Ruang Admin\"}]', 'assets/uploads/peminjaman/0d3cc035ba114d2789f52688d53e6580.png', 1, '2024-11-18 20:37:34', '2024-11-18 20:38:04'),
('f0ac8456ab24488dacc34de6f8a1f8fd', '2024-11-19', '2024-11-20', 'Kegiatan ekstrakurikuler', 'b49cc247bfeb4cbfb0d59153be6f7012', '[{\"saranaId\":\"7f059917610643e18c6e80316438db00\",\"jumlah\":1,\"namaSarana\":\"Speaker\",\"kepemilikan\":\"Ruang Admin\"},{\"saranaId\":\"8286617c57934faf8b9d8fa537fcc7b0\",\"jumlah\":1,\"namaSarana\":\"Microphone\",\"kepemilikan\":\"Ruang Admin\"}]', 'assets/uploads/peminjaman/b49cc247bfeb4cbfb0d59153be6f7012.png', 1, '2024-11-18 21:26:54', '2024-11-18 21:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `peminjaman_id` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `tanggal`, `keterangan`, `peminjaman_id`, `status`, `created_at`, `updated_at`) VALUES
('be182bdc829b46bba8f046309924a556', '2024-10-25', '-', '52c71d72f90c48169c0bdf97c4f39187', 'Sudah Dikembalikan', '2024-11-18 21:24:21', '2024-11-18 21:24:21');

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
-- Table structure for table `sarana`
--

CREATE TABLE `sarana` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `kepemilikan` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sarana`
--

INSERT INTO `sarana` (`id`, `nama`, `jumlah`, `foto`, `kepemilikan`, `created_at`, `updated_at`) VALUES
('03869a28a32f4d8ab803a625f955dc53', 'Proyektor', 2, 'assets/uploads/sarana//Proyektor.jpg', 'Ruang Admin', '2024-09-16 23:45:39', '2024-11-18 21:24:21'),
('7950749ebf934a40a61448f3ebadc5b9', 'Lab Komputer', 30, 'assets/uploads/sarana//Lab-Komputer.jpg', 'Lab Komputer', '2024-09-16 23:49:31', '2024-09-16 23:49:31'),
('7cbce7c1ffd8443ea50a5e4d2ecb7dea', 'Tinta Spidol', 30, 'assets/uploads/sarana//Tinta-Spidol.jpg', 'Ruang Admin', '2024-09-16 23:54:17', '2024-09-16 23:54:17'),
('7f059917610643e18c6e80316438db00', 'Speaker', 1, 'assets/uploads/sarana//Speaker.jpg', 'Ruang Admin', '2024-09-16 23:51:36', '2024-11-18 21:27:17'),
('8286617c57934faf8b9d8fa537fcc7b0', 'Microphone', 4, 'assets/uploads/sarana//Microphone.jpg', 'Ruang Admin', '2024-09-16 23:42:17', '2024-11-18 21:27:17'),
('83ccc5d07c8145dfa5164e63d0f98b31', 'Proyektor', 2, 'assets/uploads/sarana//Proyektor.jpg', 'Lab Komputer', '2024-09-18 18:25:10', '2024-09-18 18:25:10'),
('98e888369b304335bacea872a5a03f88', 'Mixer', 1, 'assets/uploads/sarana//Mixer.jpg', 'Ruang Admin', '2024-09-16 23:42:53', '2024-09-16 23:42:53'),
('b36b2878906c46a795ac7d7421fd4bc2', 'Kamera', 8, 'assets/uploads/sarana//Kamera.jpg', 'Ruang Admin', '2024-09-16 23:41:34', '2024-09-18 18:42:06'),
('d3a09b2d57ba4837a746a33074966a86', 'Tripod', 4, 'assets/uploads/sarana//Tripod.jpg', 'Ruang Admin', '2024-09-16 23:43:27', '2024-09-16 23:43:27'),
('facb861ca53d40368405482fdd465883', 'Penghapus Papan Tulis', 20, 'assets/uploads/sarana//Penghapus-Papan-Tulis.jpg', 'Ruang Admin', '2024-09-16 23:56:31', '2024-11-18 21:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('Admin','Siswa') NOT NULL DEFAULT 'Siswa',
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
('0d3cc035ba114d2789f52688d53e6580', 'Abraham Axel Tanoto', '0062635862', '$2y$12$NUTEAeZXdx7Dsp7M8zF3..JQbFHRDouUOMev9a5OOeEy3p3FuNdTy', 'Siswa', 1, '2024-09-16 23:19:57', '2024-09-16 23:29:24'),
('230fdc2aadf843ffa37fea1d34f27c20', 'Adhiwira Cavell Santoso', '0073668099', '$2y$12$WFHenr9AezZoRJ1nlN3LTuwdYha0.vVJq/y.NjJHfdiICfpmamxym', 'Siswa', 1, '2024-09-16 23:22:15', '2024-09-16 23:29:17'),
('3cf0126ccc6a49c38c3f8b0e199cd2ad', 'Alika Briana Sucipto', '0068297811', '$2y$12$bwpwOj2Fgy9/lFUXFIJGZeLzePXDqJU0rU.TME9QFb1tT.0Y4z15i', 'Siswa', 1, '2024-09-16 23:24:49', '2024-09-16 23:29:07'),
('4c11d1a31f044f0d94a934ed2a5831eb', 'Admin', 'admin', '$2y$12$NUTEAeZXdx7Dsp7M8zF3..JQbFHRDouUOMev9a5OOeEy3p3FuNdTy', 'Admin', 1, '2024-08-17 05:32:24', '2024-08-17 05:32:24'),
('5053d560341b4c9b8062bd4f920f9b6d', 'Alexis Sarah Cimenti', '0064502830', '$2y$12$14jQFeIyNrRntE/dMgogVeqEH2nA9Z166Bw1zlp9jk87EnV5axxuG', 'Siswa', 1, '2024-09-16 23:23:56', '2024-09-16 23:28:59'),
('73e30a969dde4e03bac5109ab7f88a11', 'Alan Brian Frederick', '0065810095', '$2y$12$OtBMskOWLAyzIZde2GE3KuSKENTgzvNK.uvCktOyJfWecbWlegozC', 'Siswa', 1, '2024-09-16 23:23:01', '2024-09-16 23:28:47'),
('79b3ba2f44414872ad6c11349a3d268a', 'Adeline Gianella Lukito', '0073296710', '$2y$12$u3BbOEDMnYCc9JOtRfNSfOazzRAQzIoY47CJC3fikGZA6m/N3y.7K', 'Siswa', 1, '2024-09-16 23:21:26', '2024-09-16 23:28:37'),
('9134d29452ee4e6a8cf49c22d46818cd', 'Abigail Arlyn Chrisanta', '0074446039', '$2y$12$qZq/g1lAYvWidsyzKyIjGuc7aWAvea5slJMx3KacIaoBNLxZk4Lk.', 'Siswa', 1, '2024-09-16 23:18:24', '2024-09-16 23:28:29'),
('b49cc247bfeb4cbfb0d59153be6f7012', 'Adeline Casey Selenia Soetikno', '0088118391', '$2y$12$NUTEAeZXdx7Dsp7M8zF3..JQbFHRDouUOMev9a5OOeEy3p3FuNdTy', 'Siswa', 1, '2024-09-16 23:20:45', '2024-09-16 23:26:50'),
('e585d740ab014e208f5e4a7461e165f4', 'Abigail Jesica', '0086598742', '$2y$12$YCAxyMyXdOfPt6sIuLIJDOdcr4tkze9aAfLFKCu3rWSRSsQNwkI7a', 'Siswa', 1, '2024-09-16 23:19:16', '2024-09-16 23:26:43'),
('f5b8ffd918e341dabbd2f8127c2b131a', 'Arya Putra Hartoyo', '0069868251', '$2y$12$KV0F1ceG72Bk9x54Cw6.y.QOIJqKeFvwo5Z39SCKDmx2iRrs.t8G6', 'Siswa', 0, '2024-09-16 23:25:28', '2024-09-18 18:24:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kerusakan`
--
ALTER TABLE `kerusakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_user_id_foreign` (`user_id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sarana`
--
ALTER TABLE `sarana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
