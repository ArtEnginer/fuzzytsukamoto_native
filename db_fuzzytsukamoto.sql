-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 01:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fuzzytsukamoto`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id` int(12) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `nip` int(30) NOT NULL,
  `create_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id`, `nama`, `nip`, `create_at`, `updated_at`) VALUES
(1, 'RIFAN DANI KHAN', 12344, 0, 0),
(2, 'BETRAN TORI', 24321, 0, 0),
(3, 'BENI SUNARYO', 6534231, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id` int(12) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `create_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id`, `nama`, `create_at`, `updated_at`) VALUES
(1, 'Kinerja', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Disiplin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'absen', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `id` int(11) NOT NULL,
  `alternatif_id` varchar(255) NOT NULL,
  `nilai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`id`, `alternatif_id`, `nilai`) VALUES
(1, '1', '{\"1\":\"85\",\"2\":\"86\",\"3\":\"24\"}'),
(3, '3', '{\"1\":\"34\",\"2\":\"32\",\"3\":\"17\"}');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rules`
--

CREATE TABLE `tb_rules` (
  `id` int(12) NOT NULL,
  `rule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`rule`)),
  `output` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rules`
--

INSERT INTO `tb_rules` (`id`, `rule`, `output`) VALUES
(1, '{\"1\":\"1\",\"2\":\"4\",\"3\":\"7\"}', 'baik'),
(2, '{\"1\":\"1\",\"2\":\"4\",\"3\":\"8\"}', 'baik'),
(3, '{\"1\":\"1\",\"2\":\"4\",\"3\":\"9\"}', 'cukup');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_kriteria`
--

CREATE TABLE `tb_sub_kriteria` (
  `id` int(12) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kriteria_id` int(12) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sub_kriteria`
--

INSERT INTO `tb_sub_kriteria` (`id`, `nama`, `kriteria_id`, `created_at`, `updated_at`) VALUES
(1, 'Baik', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Cukup', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Kurang', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Baik', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Cukup', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Kurang', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Baik', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Cukup', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Kurang', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin', 'admin'),
(2, 'user', 'user', 'user@gmail.com', 'user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_rules`
--
ALTER TABLE `tb_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
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
-- AUTO_INCREMENT for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_rules`
--
ALTER TABLE `tb_rules`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
