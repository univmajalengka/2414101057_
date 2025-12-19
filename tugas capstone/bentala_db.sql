-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2025 at 10:43 AM
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
-- Database: `bentala_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `nomor_hp` varchar(20) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `waktu_perjalanan` int(11) NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `harga_paket` decimal(15,2) NOT NULL,
  `jumlah_tagihan` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama_wisata` varchar(100) DEFAULT NULL,
  `biaya_wisata` decimal(15,2) DEFAULT NULL,
  `tour_guide` tinyint(1) DEFAULT 0,
  `sewa_mobil` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `nama_pemesan`, `nomor_hp`, `tanggal_pesan`, `waktu_perjalanan`, `jumlah_peserta`, `harga_paket`, `jumlah_tagihan`, `created_at`, `nama_wisata`, `biaya_wisata`, `tour_guide`, `sewa_mobil`) VALUES
(4, 'ADITYA', '0875638928', '2025-12-30', 2, 1, 350000.00, 700000.00, '2025-12-19 09:40:31', 'Gunung Merbabu', 150000.00, 1, 0),
(5, 'ADAM', '02029320390', '2025-12-26', 1, 2, 475000.00, 950000.00, '2025-12-19 09:40:55', 'Gunung Ciremai', 175000.00, 0, 1),
(6, 'ANGGA', '029302930', '2026-01-08', 2, 1, 500000.00, 1000000.00, '2025-12-19 09:41:15', 'Gunung Rinjani', 500000.00, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
