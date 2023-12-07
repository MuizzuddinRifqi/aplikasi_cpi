-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2020 at 08:08 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_cpi`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` varchar(10) NOT NULL,
  `nm_guru` varchar(20) DEFAULT NULL,
  `jenkel` varchar(20) DEFAULT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nm_guru`, `jenkel`, `alamat`) VALUES
('G01', 'GURU A', 'Laki-laki', 'Jakarta'),
('G02', 'GURU B', 'Laki-laki', 'Jakarta'),
('G03', 'GURU C', 'Perempuan', 'Tangerang'),
('G04', 'GURU D', 'Laki-laki', 'Bogor'),
('G05', 'GURU E', 'Perempuan', 'Tangerang');

-- --------------------------------------------------------

--
-- Table structure for table `kinerja`
--

CREATE TABLE `kinerja` (
  `id_kinerja` varchar(10) NOT NULL,
  `tgl_kinerja` date NOT NULL,
  `periode` char(4) NOT NULL,
  `nil_akhir` float NOT NULL,
  `id_guru` varchar(10) NOT NULL,
  `id_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kinerja`
--

INSERT INTO `kinerja` (`id_kinerja`, `tgl_kinerja`, `periode`, `nil_akhir`, `id_guru`, `id_user`) VALUES
('KJ01', '2020-08-04', '2020', 104.707, 'G01', 'US01'),
('KJ02', '2020-08-04', '2020', 102.921, 'G02', 'US01'),
('KJ03', '2020-08-04', '2020', 93.7821, 'G03', 'US01'),
('KJ04', '2020-08-04', '2020', 97.1429, 'G04', 'US01'),
('KJ05', '2020-08-04', '2020', 102.711, 'G05', 'US01');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` varchar(10) NOT NULL,
  `nm_kriteria` varchar(40) DEFAULT NULL,
  `tren` varchar(20) DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nm_kriteria`, `tren`, `bobot`) VALUES
('KR01', 'KRITERIA A', 'Positif', 20),
('KR02', 'KRITERIA B', 'Positif', 15),
('KR03', 'KRITERIA C', 'Positif', 15),
('KR04', 'KRITERIA D', 'Negatif', 15),
('KR05', 'KRITERIA E', 'Positif', 10),
('KR06', 'KRITERIA F', 'Negatif', 15),
('KR07', 'KRITERIA G', 'Positif', 10);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_kriteria` varchar(10) NOT NULL,
  `id_kinerja` varchar(10) NOT NULL,
  `nilai` int(11) NOT NULL,
  `nil_hitung` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_kriteria`, `id_kinerja`, `nilai`, `nil_hitung`) VALUES
(1, 'KR01', 'KJ01', 97, 102.105),
(2, 'KR02', 'KJ01', 60, 100),
(3, 'KR03', 'KJ01', 70, 100),
(4, 'KR04', 'KJ01', 2, 100),
(5, 'KR05', 'KJ01', 85, 121.429),
(6, 'KR06', 'KJ01', 2, 100),
(7, 'KR07', 'KJ01', 85, 121.429),
(8, 'KR01', 'KJ02', 97, 102.105),
(9, 'KR02', 'KJ02', 80, 133.333),
(10, 'KR03', 'KJ02', 90, 128.571),
(11, 'KR04', 'KJ02', 4, 50),
(12, 'KR05', 'KJ02', 90, 128.571),
(13, 'KR06', 'KJ02', 3, 66.6667),
(14, 'KR07', 'KJ02', 90, 128.571),
(15, 'KR01', 'KJ03', 96, 101.053),
(16, 'KR02', 'KJ03', 60, 100),
(17, 'KR03', 'KJ03', 85, 121.429),
(18, 'KR04', 'KJ03', 3, 66.6667),
(19, 'KR05', 'KJ03', 80, 114.286),
(20, 'KR06', 'KJ03', 4, 50),
(21, 'KR07', 'KJ03', 80, 114.286),
(22, 'KR01', 'KJ04', 95, 100),
(23, 'KR02', 'KJ04', 60, 100),
(24, 'KR03', 'KJ04', 80, 114.286),
(25, 'KR04', 'KJ04', 3, 66.6667),
(26, 'KR05', 'KJ04', 70, 100),
(27, 'KR06', 'KJ04', 2, 100),
(28, 'KR07', 'KJ04', 70, 100),
(29, 'KR01', 'KJ05', 96, 101.053),
(30, 'KR02', 'KJ05', 60, 100),
(31, 'KR03', 'KJ05', 85, 121.429),
(32, 'KR04', 'KJ05', 2, 100),
(33, 'KR05', 'KJ05', 85, 121.429),
(34, 'KR06', 'KJ05', 3, 66.6667),
(35, 'KR07', 'KJ05', 85, 121.429);

-- --------------------------------------------------------

--
-- Table structure for table `sk`
--

CREATE TABLE `sk` (
  `no_sk` varchar(50) NOT NULL,
  `tgl_sk` date NOT NULL,
  `periode` char(4) NOT NULL,
  `id_kinerja` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk`
--

INSERT INTO `sk` (`no_sk`, `tgl_sk`, `periode`, `id_kinerja`) VALUES
('SK/01/KJ01/08/2020', '2020-08-04', '2020', 'KJ01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(10) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`) VALUES
('US01', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `kinerja`
--
ALTER TABLE `kinerja`
  ADD PRIMARY KEY (`id_kinerja`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `sk`
--
ALTER TABLE `sk`
  ADD PRIMARY KEY (`no_sk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
