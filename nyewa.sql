-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 05:45 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nyewa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `kontak` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `password`, `kontak`) VALUES
(16, 'admin', '$2y$10$EthMqlmLwONHS/I4L2jNLufjRg8hH0tY.IsPjzG05y5HNTtxfJinG', '085677889900'),
(17, 'ridho', '$2y$10$UfQFq354ydoM2uTB7zrFluNkEKgcyukubvlH4wYwOF5GsRQZA8L12', '085600766260'),
(18, 'raka', '$2y$10$rayNQd9Y.x1uEwjvC0Doj.B/WkBxgKjzrO4dzHmMb37uxVaVQzV3C', '085334478323'),
(19, 'Tasya', '$2y$10$Md2grux6Xm0bQQAXfymFf.lPEjQD4ePoi2yB5FR/2hKmshKr0b7tG', '088295286371'),
(20, '11', '$2y$10$R3HqmqqJlAd4zId3pAlnA.mSEYKuiTZ5BKO34fUz76tw5y4tf3icW', '11'),
(21, '22', '$2y$10$nz3WinFxPk79.xsTOBFJ1Ofh30wWYQxEom3t.RtWpThLhXbYWZlGe', '22'),
(22, 'fira', '$2y$10$jAiNcDzYertkOmoMWte9geTtK8Hpeq9oXQK5dQkYYRcF4Zy.GwIdK', '085334478323');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penyewa`
--

CREATE TABLE `detail_penyewa` (
  `id_penyewa` int(20) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `kontak` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penyewa`
--

INSERT INTO `detail_penyewa` (`id_penyewa`, `nama`, `alamat`, `kontak`) VALUES
(33111, 'Rido', 'Tipes', '08123455'),
(3311001, 'Budi Santoso', 'Jl. Raya Solo No. 12, Surakarta', '081234567890'),
(3311002, 'Siti Aminah', 'Jl. Merdeka 45, Semarang', '082345678901'),
(3311003, 'Andi Setiawan', 'Jl. Magelang 77, Magelang', '083456789012'),
(3311004, 'Dewi Lestari', 'Jl. Diponegoro 11, Salatiga', '084567890123'),
(3311005, 'Joko Widodo', 'Jl. Pemuda 88, Tegal', '085678901234'),
(3311006, 'Rani Pratiwi', 'Jl. Karanganyar 23, Karanganyar', '086789012345'),
(3311007, 'Eka Rachmawati', 'Jl. Sukowati 30, Klaten', '087890123456'),
(3311008, 'Fajar Prasetya', 'Jl. Pahlawan 44, Purwokerto', '088901234567'),
(3311009, 'Gina Oktavia', 'Jl. Siliwangi 67, Banjarnegara', '089012345678'),
(3311010, 'Hendra Kurniawan', 'Jl. Lintas Selatan 55, Cilacap', '080123456789'),
(3311011, 'Irma Nurul', 'Jl. Raya Temanggung No. 50, Temanggung', '081234567891'),
(3311012, 'Joko Purnomo', 'Jl. Raya Pati No. 101, Pati', '082345678902'),
(3311013, 'Lina Herlina', 'Jl. Imogiri No. 12, Yogyakarta', '083456789013'),
(3311014, 'Mia Anggraini', 'Jl. Sumber No. 10, Sragen', '084567890124'),
(3311015, 'Nana Septiana', 'Jl. Kebon No. 33, Jepara', '085678901235'),
(3311016, 'Oscar Kurniawan', 'Jl. Jendral Sudirman 16, Wonosobo', '086789012346'),
(3311017, 'Putri Anggraini', 'Jl. Merdeka Raya 10, Sukoharjo', '087890123457'),
(3311018, 'Qori Anwar', 'Jl. Raya Karanganyar No. 70, Karanganyar', '088901234568'),
(3311019, 'Rina Susanti', 'Jl. Setiabudi No. 58, Semarang', '089012345679'),
(3311020, 'Siska Natalia', 'Jl. Munggang 32, Kebumen', '080123456780');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penyewaan`
--

CREATE TABLE `detail_penyewaan` (
  `id_detail` int(11) NOT NULL,
  `id_sewa` int(11) DEFAULT NULL,
  `id_ken` int(11) DEFAULT NULL,
  `id_penyewa` int(11) DEFAULT NULL,
  `biaya` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penyewaan`
--

INSERT INTO `detail_penyewaan` (`id_detail`, `id_sewa`, `id_ken`, `id_penyewa`, `biaya`) VALUES
(35, 42, 30, 33111, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama`) VALUES
(1, 'Motor'),
(2, 'Mobil'),
(3, 'Kapal'),
(4, 'Pesawat'),
(5, 'Rocket');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_ken` int(11) NOT NULL,
  `nomor` varchar(30) NOT NULL,
  `merek` varchar(50) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `harga` varchar(30) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status` enum('Tersedia','Disewa') DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_ken`, `nomor`, `merek`, `id_jenis`, `harga`, `jumlah`, `status`) VALUES
(23, 'AD 3847 KLM', 'Honda Vario', 1, '75000', 1, 'Tersedia'),
(24, 'AD 7824 BXT', 'Yamaha Nmax', 1, '120000', 1, 'Tersedia'),
(25, 'AD 1935 ZQ', 'Suzuki Nex', 1, '65000', 1, 'Tersedia'),
(26, 'AD 5690 MXV', 'Kawasaki Ninja', 1, '150000', 1, 'Tersedia'),
(27, 'AD 2486 PLN', 'Honda Beat', 1, '50000', 1, 'Tersedia'),
(28, 'AD 7452 QZ', 'Yamaha Mio', 1, '70000', 1, 'Tersedia'),
(29, 'AD 9374 XP', 'Honda Scoopy', 1, '85000', 1, 'Tersedia'),
(30, 'AD 5610 LRT', 'Suzuki Satria', 1, '140000', 1, 'Disewa'),
(31, 'AD 8035 QK', 'Vespa LX', 1, '125000', 1, 'Tersedia'),
(32, 'AD 4297 BRP', 'Yamaha Fino', 1, '80000', 1, 'Tersedia'),
(33, 'AD 3850 VXN', 'Honda Supra X', 1, '60000', 1, 'Tersedia'),
(34, 'AD 7209 CL', 'Suzuki Spin', 1, '72000', 1, 'Tersedia'),
(35, 'AD 8472 WX', 'Yamaha Aerox', 1, '100000', 1, 'Tersedia'),
(36, 'AD 5921 LQ', 'Honda Revo', 1, '55000', 1, 'Tersedia'),
(37, 'AD 3068 TRV', 'Kawasaki KLX', 1, '130000', 1, 'Tersedia'),
(38, 'AD 6894 ZKT', 'Honda CB150', 1, '110000', 1, 'Tersedia'),
(39, 'AD 1240 BXP', 'Yamaha RX King', 1, '95000', 1, 'Tersedia'),
(40, 'AD 9357 WQ', 'Suzuki Thunder', 1, '75000', 1, 'Tersedia'),
(41, 'AD 4873 LRP', 'Vespa Primavera', 1, '145000', 1, 'Tersedia'),
(42, 'AD 6381 QXN', 'Honda CBR', 1, '150000', 1, 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_sewa` int(11) NOT NULL,
  `tgl_sewa` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`id_sewa`, `tgl_sewa`, `tgl_kembali`, `id_admin`, `jumlah`, `total_harga`) VALUES
(42, '2025-01-10', '2025-01-12', 16, 1, '280000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_penyewa`
--
ALTER TABLE `detail_penyewa`
  ADD PRIMARY KEY (`id_penyewa`);

--
-- Indexes for table `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_sewa` (`id_sewa`),
  ADD KEY `fk_kendaraan` (`id_ken`),
  ADD KEY `fk_penyewa` (`id_penyewa`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_ken`),
  ADD KEY `fk_jenis` (`id_jenis`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `fk_admin` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `detail_penyewa`
--
ALTER TABLE `detail_penyewa`
  MODIFY `id_penyewa` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_ken` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  ADD CONSTRAINT `fk_kendaraan` FOREIGN KEY (`id_ken`) REFERENCES `kendaraan` (`id_ken`),
  ADD CONSTRAINT `fk_penyewa` FOREIGN KEY (`id_penyewa`) REFERENCES `detail_penyewa` (`id_penyewa`),
  ADD CONSTRAINT `fk_sewa` FOREIGN KEY (`id_sewa`) REFERENCES `penyewaan` (`id_sewa`);

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `fk_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`);

--
-- Constraints for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `fk_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
