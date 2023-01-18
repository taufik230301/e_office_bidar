-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2023 at 02:24 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_office`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id_jenis_surat` varchar(5) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id_jenis_surat`, `jenis_surat`) VALUES
('1', 'Surat Naik'),
('2', 'Surat Keluar'),
('3', 'Surat Masuk'),
('4', 'MOU'),
('5', 'PKS');

-- --------------------------------------------------------

--
-- Table structure for table `status_surat`
--

CREATE TABLE `status_surat` (
  `id_status_surat` varchar(5) NOT NULL,
  `status_surat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_surat`
--

INSERT INTO `status_surat` (`id_status_surat`, `status_surat`) VALUES
('1', 'Menunggu Konfirmasi'),
('2', 'Ditolak'),
('3', 'Diterima'),
('4', '-');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id_surat` varchar(255) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `file_lembar_disposisi` varchar(255) NOT NULL,
  `file_surat` varchar(255) NOT NULL,
  `file_nota_dinas` varchar(255) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `created_at` datetime NOT NULL,
  `nomor_agenda` varchar(50) NOT NULL,
  `id_jenis_surat` varchar(5) NOT NULL,
  `id_status_surat` varchar(5) NOT NULL,
  `keterangan` text NOT NULL,
  `instansi_pengirim` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id_surat`, `perihal`, `nomor_surat`, `file_lembar_disposisi`, `file_surat`, `file_nota_dinas`, `tanggal_surat`, `created_at`, `nomor_agenda`, `id_jenis_surat`, `id_status_surat`, `keterangan`, `instansi_pengirim`) VALUES
('098dfd6d0d162ec9918561692452c2c2', 'Peminjaman Toa', '12781728', 'dc26b0579dda4ba1afc7d55b60409efb_file_lembar_disposisi.pdf', 'dc26b0579dda4ba1afc7d55b60409efb_file_surat.pdf', '-', '2023-01-18', '2023-01-18 08:09:15', '1212', '3', '1', '1', 'PU Muara Enim'),
('0e7a29f9fa0a829a57629e89afb4911a', 'Undangan Acara Kapolda', '-', '-', 'd244d104b9effeea90a9455c3892f4cb_file_surat.pdf', '9b0b30a61668cc7715c68f88e14d36a8_file_nota_dinas.pdf', '2023-12-12', '2023-01-18 04:18:26', '-', '1', '3', 'Undangan', '-'),
('3fdb86a1b669c5cfe2a633622e8b5f98', 'test', '121', '15a5125861d91be1a6a71c3a584589ee_file_lembar_disposisi.pdf', '15a5125861d91be1a6a71c3a584589ee_file_surat.pdf', '-', '2001-12-12', '2023-01-18 08:17:27', '12121', '3', '1', '1', '1212'),
('54167b738a8d8a9aec94cae35a2805d5', 'Cuti Melahirkan', '01', '-', '8d33df9f91ecd0b57d6048da7b365b02_file_surat.pdf', '-', '2023-01-26', '2023-01-18 08:09:50', '-', '4', '1', 'Melahirkan', '-'),
('5abbad263d1edfe3c648bd33aa0a964b', 'asahs', '-', '-', '584d32745e17725650148480335ecc20_file_surat.pdf', '584d32745e17725650148480335ecc20_file_nota_dinas.pdf', '2001-12-12', '2023-01-18 08:19:52', '-', '1', '1', 'ajsks\r\n', '-'),
('682b18e033491105338c3954a0f30ff1', 'test', '-', '-', '7842d421635f63f1a3e7a422b6a7de68_file_surat.pdf', '7842d421635f63f1a3e7a422b6a7de68_file_nota_dinas.pdf', '2001-12-12', '2023-01-18 08:19:27', '-', '1', '1', 'hasha', '-'),
('7b34063a5bf983e509963b6c33e9bb8f', 'Peminjaman Gedung Balai', '12515261', '-', '22e357daac8cf2f25cf8c28542fb857f_file_surat.pdf', '22e357daac8cf2f25cf8c28542fb857f_file_nota_dinas.pdf', '2023-01-18', '2023-01-18 08:05:41', '-', '1', '3', 'Peminjaman Gedung Balai', '-'),
('9e1e07fee911eb63faa86d2c45e8f3a3', 'Surat Peminjaman Gedung', '-', '-', '27383b85e0b4bfa1c988e0b768489787_file_surat.pdf', '6af04a3af14b52b0cc9c921f145c601d_file_nota_dinas.pdf', '2021-12-12', '2023-01-18 04:15:10', '-', '1', '3', 'Pinjam Gedung', '-'),
('9e409bfcdd4e674c436f75b4995c1fc1', '1', '1', 'e1eb0de19fdb62bd5881486bdffed9c2_file_lembar_disposisi.pdf', 'e1eb0de19fdb62bd5881486bdffed9c2_file_surat.pdf', '-', '0200-12-12', '2023-01-18 08:18:36', '1', '3', '1', 'ahsjhas', '12'),
('c8eb9b6fa95605621050f7c17579f850', 'Peminjaman TOA', '-', '-', 'e58c087791bc42b34ae8a3cc95c58e86_file_surat.pdf', 'e58c087791bc42b34ae8a3cc95c58e86_file_nota_dinas.pdf', '2023-12-12', '2023-01-18 04:17:22', '-', '2', '1', 'Pinjam TOA', '-');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_user_level` varchar(255) NOT NULL,
  `id_user_detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_user_level`, `id_user_detail`) VALUES
('1', 'admin', '123', '1', '-'),
('2', 'admin_sekda', '123', '2', '-');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id_user_level` varchar(5) NOT NULL,
  `user_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_user_level`, `user_level`) VALUES
('1', 'Admin'),
('2', 'Admin Sekda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id_jenis_surat`);

--
-- Indexes for table `status_surat`
--
ALTER TABLE `status_surat`
  ADD PRIMARY KEY (`id_status_surat`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_user_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
