-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2025 at 01:14 AM
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
-- Database: `sewamobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `mobil_id` int(11) NOT NULL,
  `nama_mobil` varchar(100) NOT NULL,
  `model_mobil` varchar(100) DEFAULT NULL,
  `harga_perhari` decimal(10,2) DEFAULT NULL,
  `status_ketersediaan` varchar(50) DEFAULT 'Available',
  `gambar` varchar(255) DEFAULT NULL,
  `jumlah_disewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`mobil_id`, `nama_mobil`, `model_mobil`, `harga_perhari`, `status_ketersediaan`, `gambar`, `jumlah_disewa`) VALUES
(1, 'Mitsubishi', 'Xpander', 700000.00, 'Available', './uploads/1605461108_mitsubishi-xpander-cross-kelebihan-spesifikasi-dan-harga.webp', 0),
(2, 'toyota', 'avanza', 560000.00, 'Available', './uploads/mobil-mpv-adalah.webp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `sewa_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mobil_id` int(11) DEFAULT NULL,
  `tanggal_sewa` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `harga_total` decimal(10,2) DEFAULT NULL,
  `status_sewa` varchar(255) DEFAULT 'Menunggu Pembayaran',
  `alamat` varchar(255) DEFAULT NULL,
  `nama_penyewa` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`sewa_id`, `user_id`, `mobil_id`, `tanggal_sewa`, `tanggal_kembali`, `harga_total`, `status_sewa`, `alamat`, `nama_penyewa`) VALUES
(3, 1, 1, '2024-11-30', '2024-12-03', 2800000.00, 'sudah_dikembalikan', 'Ambarawa', 'Putra Antoro'),
(4, 1, 1, '2024-12-01', '2024-12-03', 2100000.00, 'sudah_dikembalikan', 'bawen', 'ariellus putra'),
(5, 1, 1, '2024-12-02', '2024-12-18', 11900000.00, 'sudah_dikembalikan', 'cobacoab', 'aaaaaa'),
(6, 1, 2, '2024-12-15', '2024-12-17', 1500000.00, 'sudah_dikembalikan', 'salatiga', 'test2'),
(7, 1, 1, '2024-12-03', '2024-12-04', 1400000.00, 'sudah_dikembalikan', 'Salatiga', 'Ariel'),
(8, 1, 1, '2024-12-04', '2024-12-04', 700000.00, 'sudah_dikembalikan', 'Salatiga', 'Ariel'),
(9, 1, 1, '2024-12-18', '2024-12-19', 1400000.00, 'sudah_dikembalikan', 'Tegal', 'Arya'),
(10, 1, 2, '2024-12-17', '2024-12-18', 1100000.00, 'sudah_dikembalikan', 'Bekasi', 'tersti');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `sewa_id` int(11) DEFAULT NULL,
  `uang_dibayar` decimal(10,2) DEFAULT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Belum Lunas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `sewa_id`, `uang_dibayar`, `tanggal_pembayaran`, `status`) VALUES
(7, 4, 2100000.00, '2024-12-02', 'LUNAS'),
(8, 3, 2800000.00, '2024-12-06', 'LUNAS'),
(9, 6, 1500000.00, '2024-12-03', 'LUNAS'),
(11, 5, 11900000.00, '2024-12-11', 'LUNAS'),
(12, 8, 700000.00, '2024-12-03', 'LUNAS'),
(13, 9, 1400000.00, '2024-12-03', 'LUNAS'),
(14, 7, 1400000.00, '2024-12-03', 'LUNAS'),
(15, 10, 1100000.00, '2024-12-03', 'LUNAS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `first_name`, `last_name`, `phone_number`, `role`) VALUES
(1, 'arielTest', 'test@gmail.com', '123', 'test', 'cuyy', '0853427134', 'user'),
(2, 'admin', 'admin@gmail.com', 'admin123', 'Admin', 'Bebas', '085112345678', 'admin'),
(3, 'arya', 'aryamisiu@gmail.com', '111', 'Arya', 'Bebas', '085112345679', 'user'),
(4, 'kasir1', 'kasir@gmail.com', '1234', 'Kasir', 'Bebas', '087612341234', 'kasir'),
(5, 'User2', 'user2@gmail.com', 'user123', 'User', 'Two', '085212344321', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`mobil_id`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`sewa_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mobil_id` (`mobil_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `sewa_id` (`sewa_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `mobil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `sewa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `penyewaan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `penyewaan_ibfk_2` FOREIGN KEY (`mobil_id`) REFERENCES `mobil` (`mobil_id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`sewa_id`) REFERENCES `penyewaan` (`sewa_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
