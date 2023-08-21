-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2023 at 11:39 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_koprasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE `angsuran` (
  `id` int(11) NOT NULL,
  `id_pinjaman` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `no_angsuran` varchar(6) DEFAULT NULL,
  `jumlah_angsuran` int(20) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `bukti_bayar` varchar(30) DEFAULT NULL,
  `status` char(3) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`id`, `id_pinjaman`, `id_user`, `no_angsuran`, `jumlah_angsuran`, `nilai`, `tanggal`, `bukti_bayar`, `status`) VALUES
(13, 9887, 31, 'ANG307', 1, 600000, '2023-01-11 23:03:05', 'Bukti_Angsuran_13.jpg', '200'),
(14, 9887, 31, 'ANG307', 2, 600000, '2023-01-11 23:03:11', NULL, '100'),
(15, 9887, 31, 'ANG307', 3, 600000, '2023-01-11 23:03:17', NULL, '100');

-- --------------------------------------------------------

--
-- Table structure for table `lama`
--

CREATE TABLE `lama` (
  `id` int(11) NOT NULL,
  `lama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lama`
--

INSERT INTO `lama` (`id`, `lama`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24);

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `no_pinjaman` varchar(6) DEFAULT NULL,
  `jumlah` varchar(9) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `lama` int(11) DEFAULT NULL,
  `bunga` int(11) NOT NULL,
  `status` enum('Y','N','T') NOT NULL,
  `alasan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `id_user`, `no_pinjaman`, `jumlah`, `tanggal`, `lama`, `bunga`, `status`, `alasan`) VALUES
(7013, 31, 'ANG5', '9000000', '2023-01-11 23:02:50', 12, 0, 'N', NULL),
(8246, 31, 'ANG659', '5000000', '2023-01-11 21:18:49', 6, 0, 'T', 'Nominal pinjaman terlalu banyak'),
(9887, 31, 'ANG307', '5000000', '2023-01-11 23:02:21', 10, 20, 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE `simpanan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nik` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `bukti_bayar` varchar(30) DEFAULT NULL,
  `status` char(4) NOT NULL,
  `tanggal_bayar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id`, `id_user`, `nik`, `jumlah`, `bukti_bayar`, `status`, `tanggal_bayar`) VALUES
(1511, 31, 2147483647, 1500000, 'Bukti_Simpanan_1511.jpg', '200', '2022-12-17 14:19:24'),
(29072, 31, 2147483647, 500000, NULL, '100', '2022-12-17 14:19:05'),
(69052, 31, 2147483647, 1000000, 'Bukti_Simpanan_69052.jpg', '300', '2022-12-17 14:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `nik` varchar(16) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `full_name` varchar(25) DEFAULT NULL,
  `tlp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `password` varchar(65) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `image` varchar(30) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nik`, `username`, `full_name`, `tlp`, `alamat`, `jenis_kelamin`, `password`, `id_level`, `image`, `is_active`) VALUES
(30, '1823685934860492', 'admin ', 'Dani Armando', '+6281254673458', 'Palembang', 'laki-laki', '$2y$05$CBvPBPah2YMf6xn/gOUVNu0rDDEtljII7DZxolL.kDEfUxphAMp4G', 1, 'admin-dani.PNG', 'Y'),
(31, '1895647284729492', 'anggota', 'Ambara Kusniadi', '+6281348375647', 'Bandar Lampung', 'laki-laki', '$2y$05$PtEzrbCYRqbbYLIZRU6p0OtS0rur1UBEfQcH7G5nAxhdIoq5GDD1e', 3, 'ambara-kusniadi.PNG', 'Y'),
(32, '1896374837365728', 'ketua', 'Dodi Supiandi', '+62856738437366', 'Bandar Lampung', 'laki-laki', '$2y$05$HEhAoOeqcp3eOsDoGTi84.WKjIfUr9WtLN0SGeu9/1gc2b7oUy86K', 2, 'dodi-supiandi.PNG', 'Y'),
(35, '1897465837465244', 'Ade Sudirgo', 'Ade Sudirgo', '+62826475627582', 'Pringsewu', 'laki-laki', '$2y$05$hYAH1WFfiRCXfuTxmlqyH.8L0aIGJTepAdBtgTVPGXGeLc3vQkp.u', 3, 'ade-sudirgo.PNG', 'Y'),
(36, '1875638374653875', 'Kurniawan Sucip', 'Kurniawan Sucipto', '+6285673648877', 'Palembang', 'laki-laki', '$2y$05$sEyNX80nJThDLqKY8O8Q6uH7tQBlSv.nTRXG3GYLteJ.GC1gayvda', 3, 'kurniawan-sucipto.PNG', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlevel`
--

CREATE TABLE `tbl_userlevel` (
  `id_level` int(11) UNSIGNED NOT NULL,
  `nama_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_userlevel`
--

INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES
(1, 'admin'),
(2, 'ketua'),
(3, 'anggota');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lama`
--
ALTER TABLE `lama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  ADD PRIMARY KEY (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lama`
--
ALTER TABLE `lama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9888;

--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69053;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  MODIFY `id_level` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
