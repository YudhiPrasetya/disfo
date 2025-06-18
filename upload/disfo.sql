-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 07:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `disfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `disfo_login`
--

CREATE TABLE `disfo_login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disfo_login`
--

INSERT INTO `disfo_login` (`id`, `username`, `password`) VALUES
(9, 'admin', '$2y$10$nkt7l0GNAFi6/nQHShKphu5ft3k3IcTE4vwKUoT8e.TUaXo7ru052');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `nama_pelatihan` varchar(255) NOT NULL,
  `kerjasama` varchar(255) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `tgl_pelaksanaan` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `orc` varchar(12) NOT NULL,
  `qty_order` varchar(12) NOT NULL,
  `in_packing` varchar(12) NOT NULL,
  `ready_crtn` varchar(12) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama_pelatihan`, `kerjasama`, `tempat`, `tgl_pelaksanaan`, `color`, `orc`, `qty_order`, `in_packing`, `ready_crtn`, `status`) VALUES
(69, 'AMBRA', '81571', 'AMSHMGSH', '2025-04-15', 'BLACK', '10-25C001B-1', '660', '660', '660', 'Ready Shipment');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disfo_login`
--
ALTER TABLE `disfo_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disfo_login`
--
ALTER TABLE `disfo_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
