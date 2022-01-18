-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2021 at 04:02 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stokbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `keluar` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `keluar`, `penerima`, `qty`) VALUES
(9, 63, '2021-12-13 13:00:37', 'Polan', 20),
(10, 64, '2021-12-22 01:41:10', 'isdpopk', 50),
(12, 66, '2021-12-23 14:30:45', 'Ujal', 100);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama_user` text NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `email`, `nama_user`, `password`) VALUES
(1, 'sayamautidur@gmail.com', 'Muhamamad Ferdy Maulana', 'satudua12'),
(2, 'sayamaubangun@gmail.com', 'Pavolia Reine', 'adminreine'),
(3, 'sayamaumati@gmail.com', 'Ayanokouji Kiyokata', '1212'),
(4, 'ferdymaulana@gmail.com', 'Muhammad Ferdy Maulana', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `pengirim` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `pengirim`, `qty`) VALUES
(109, 61, '2021-12-10 08:08:10', 'Ajul', 20),
(110, 61, '2021-12-10 08:08:16', 'Ujang', 50),
(111, 61, '2021-12-10 08:08:23', 'Siti', 10),
(112, 61, '2021-12-10 08:08:30', 'Imah', 90),
(113, 63, '2021-12-13 13:00:05', 'Kazuma', 50),
(114, 64, '2021-12-22 01:39:19', 'ijat', 100),
(115, 65, '2021-12-23 03:38:19', 'Uja;', 9000),
(116, 62, '2021-12-23 03:38:26', 'Imah', 500);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `idbarang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `deskripsi` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL,
  `merek_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`idbarang`, `nama_barang`, `deskripsi`, `stock`, `merek_barang`) VALUES
(62, 'Madurasa Sachet 100g', 'Kesehatan', 10500, 'Madurasa'),
(65, 'Sepatu Nike', 'Kesehatan', 9020, 'Manga'),
(66, 'Kemeja Flannel', 'Pakaian Pria', -50, '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
