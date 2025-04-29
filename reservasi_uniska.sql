-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2024 at 08:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservasi_uniska`
--

-- --------------------------------------------------------

--
-- Table structure for table `asuransi`
--

CREATE TABLE `asuransi` (
  `id` int(20) NOT NULL,
  `plat_nomer` varchar(20) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `Jenis` varchar(11) NOT NULL,
  `statuspem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asuransi`
--

INSERT INTO `asuransi` (`id`, `plat_nomer`, `tgl_awal`, `tgl_akhir`, `Jenis`, `statuspem`) VALUES
(3, 'AE 1123 AP', '2222-02-22', '2222-02-22', '', '3'),
(5, 'AA 8723 PS', '2024-08-20', '2024-08-23', 'Luar', 'lunas'),
(6, 'B 1123 APS', '2024-07-01', '2024-07-05', 'Luar', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `devisi`
--

CREATE TABLE `devisi` (
  `id_devisi` varchar(50) NOT NULL,
  `devisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devisi`
--

INSERT INTO `devisi` (`id_devisi`, `devisi`) VALUES
('Accounting & Budgeting', 'Accounting & Budgeting'),
('AR AP1 Group', 'AR AP1 Group'),
('ASSET', 'ASSET'),
('Collection', 'Collection'),
('Deployement', 'Deployement'),
('EQ & Tech', 'EQ & Tech'),
('Equipment & Technology ', 'Equipment & Technology '),
('Facility Management', 'Facility Management'),
('GA, Asset, Inventory Management', 'GA, Asset, Inventory Management'),
('HR Service, Compensation, Benefit', 'HR Service, Compensation, Benefit'),
('HRD', 'HDR'),
('HSE & Quality', 'HSE & Quality'),
('Human Capital', 'Human Capital'),
('Operational Cleaning', 'Operational Cleaning');

-- --------------------------------------------------------

--
-- Table structure for table `kelayakan`
--

CREATE TABLE `kelayakan` (
  `id` int(20) NOT NULL,
  `plat_nomer` varchar(20) NOT NULL,
  `kerusakan` int(11) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelayakan`
--

INSERT INTO `kelayakan` (`id`, `plat_nomer`, `kerusakan`, `deskripsi`, `status`) VALUES
(8, 'DA 1131 AP', 12, '1. Ban Meletus2', 'pergantian'),
(9, 'B 9012 APS', 1, '1. Ac tidak dingin', 'layak'),
(10, 'B 2231 APS', 2, '1. Pintu belakang tidak bisa ditutup\r\n2. Body depan penyok', 'layak'),
(12, 'DA 2314 AP', 3, '1. Ban meletus \r\n2. Mesin berasap\r\n3. Lampu panjang putus \r\n', 'pergantian'),
(13, 'B 1123 APS', 2, '1. Ban bocor \r\n2. Ac panas', 'layak'),
(14, 'BH 1092 PS', 1, '1. Selang Radiator pecah', 'layak'),
(15, 'AE 1123 AP', 2, '1. Ban bocor \r\n2. Lampu Sen putus', 'layak'),
(16, 'D 2314 APS', 3, '1. Body depan ringsek \r\n2. Setir tidak bisa rata \r\n3. turun mesin', 'pergantian'),
(17, 'AB 4422 APS', 4, '1. Ac panas \r\n2. Kaca jendela tidak bisa turun \r\n3. Pintu  tidak bisa terkunci \r\n4. Spion lepas', 'pergantian'),
(18, 'KH 3321 AP', 1, '1. Kopling lengket', 'layak'),
(19, 'KT 5674 PS', 2, '1. Rem blong \r\n2. Kampas kopling hangus', 'pergantian'),
(20, 'AA 8723 PS', 1, '1. Spion kanan patah', 'layak'),
(21, 'AD 2234 APS', 1, '1. Lampu sen putus', 'layak'),
(22, 'K 4432 AP', 2, '1. Mesin berasap \r\n2. Mobil tidak bisa menyala', 'layak'),
(23, 'R 0021 APS', 1, '1. Lampu Panjang putus', 'layak'),
(24, 'G 1111 APS', 3, '1. Ac panas \r\n2. Lampu pendek putus \r\n3. Spion kiri macet', 'layak'),
(25, 'F 6666 APS', 1, '1.Oli rembes', 'layak'),
(26, 'AG 3333 APS', 2, '1. Oli rembes \r\n2. Knalpot meledak', 'layak'),
(27, 'B 2222 AP', 1, '1. Mesin berasap', 'layak'),
(28, 'D 4444 PS', 1, '1.Spion lepas', 'layak');

-- --------------------------------------------------------

--
-- Table structure for table `kerusakan`
--

CREATE TABLE `kerusakan` (
  `id` int(20) NOT NULL,
  `plat_nomer` varchar(20) NOT NULL,
  `nama_pelapor` varchar(50) NOT NULL,
  `Nik` int(50) NOT NULL,
  `Devisi` varchar(50) NOT NULL,
  `tujuan_terakhir` varchar(50) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deskripsi` longtext NOT NULL,
  `status` enum('pending','sudah diperbaiki') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kerusakan`
--

INSERT INTO `kerusakan` (`id`, `plat_nomer`, `nama_pelapor`, `Nik`, `Devisi`, `tujuan_terakhir`, `tgl`, `deskripsi`, `status`) VALUES
(13, 'B 9012 APS', 'Aisyah Tamara ', 1054, 'Deployement', 'Monitoring', '2024-03-04 18:14:00', 'body penyok ', 'pending'),
(14, 'B 2231 APS', 'Sadewa Sanjaya', 1119, 'HSE & Quality', 'Tinjauan TPS', '2024-02-22 06:31:02', 'Ban Bocor ', 'sudah diperbaiki'),
(15, 'DA 2314 AP', 'Elang Winata', 1259, 'AR AP1 Group', 'Tinjauan TPS', '2024-02-29 00:24:00', 'Mesin berasap', 'pending'),
(16, 'B 2231 APS', 'Fatricia Alliya', 1211, 'Collection', 'Rapat Luar', '2024-02-26 20:30:00', 'Tidak Bisa Menyala', 'pending'),
(17, 'B 9012 APS', 'Rayza Anindita ', 1862, 'EQ & Tech', 'Tinjauan Proyek', '2024-02-27 19:32:00', 'Ban Kempes', 'sudah diperbaiki'),
(18, 'B 2231 APS', 'Gestara Pradeepa', 2029, 'EQ & Tech', 'Tinjauan Lapangan', '2024-02-27 18:33:00', 'spion lepas ', 'sudah diperbaiki'),
(19, 'DA 1131 AP', 'Willy Salwinata', 2112, 'Accounting & Budgeting', 'Tinjauan Lapangan', '2024-02-27 23:34:00', 'Knalpot Meledak', 'pending'),
(20, 'DA 1131 AP', 'Himana Sagala ', 1312, 'GA, Asset, Inventory Management', 'Rapat Luar', '2024-03-04 06:35:00', 'Kursi Belakang Sobek', 'pending'),
(21, 'B 9012 APS', 'Langit Alvanaro', 1501, 'GA, Asset, Inventory Management', 'Penjemputan Tim Audit', '2024-03-04 19:37:00', 'Pintu Tidak Bisa Terkunci', 'pending'),
(22, 'DA 1131 AP', 'Danita Alwiya', 1672, 'HSE & Quality', 'Tinjauan Lapangan', '2024-02-27 06:38:00', 'Lampu sen kiri tidak menyala', 'pending'),
(23, 'B 9012 APS', 'Willy Salwinata', 2112, 'Accounting & Budgeting', 'Rapat Luar', '2024-02-25 20:39:00', 'Sen Kanan tidak berfungsi ', 'sudah diperbaiki'),
(24, 'B 2231 APS', 'Raditya Rahman', 1135, 'Operational Cleaning', 'Tinjauan TPS', '2024-02-27 00:41:00', 'Body belakang penyok', 'sudah diperbaiki'),
(25, 'B 2231 APS', 'Mawi Alkatiri ', 1862, 'Facility Management', 'Tinjauan TPS', '2024-02-27 18:01:00', 'lampu Dim tidak menyala ', 'pending'),
(26, 'B 9012 APS', 'Rayza Anindita ', 1862, 'EQ & Tech', 'Tinjauan Lapangan', '2024-02-22 21:00:00', 'AC Tidak Dingin', 'sudah diperbaiki'),
(27, 'B 2231 APS', 'Rasya Algifari', 1929, 'Collection', 'Tinjauan Proyek', '2024-02-25 20:02:00', 'Suara mesin sangat berisik ', 'pending'),
(28, 'B 9012 APS', 'Rafiki Walaya ', 2012, 'Human Capital', 'Rapat Luar', '2024-02-28 00:08:00', 'Tidak Bisa Menyala', 'pending'),
(29, 'DA 2314 AP', 'Mawi Alkatiri ', 1862, 'Facility Management', 'Tinjauan TPS', '2024-02-28 20:13:00', 'Penutup Box belakang macet', 'sudah diperbaiki'),
(30, 'DA 2314 AP', 'Jeevika Nayana', 2119, 'Equipment & Technology ', 'Tinjauan Proyek', '2024-02-28 17:15:00', 'Tidak Bisa Menyala', 'pending'),
(31, 'B 2231 APS', 'Grasia Altaf ', 2325, 'Deployement', 'Tinjauan TPS', '2024-03-04 07:15:00', 'body penyok ', 'sudah diperbaiki'),
(32, 'B 2231 APS', 'Willy Salwinata', 2112, 'Accounting & Budgeting', 'Rapat Luar', '2024-02-27 23:18:00', 'Ban Bocor ', 'sudah diperbaiki');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `plat_nomer` varchar(20) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `tipe_mobil` varchar(50) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `BBM` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `noMesin` varchar(20) NOT NULL,
  `noRangka` varchar(20) NOT NULL,
  `jumlah` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`plat_nomer`, `merek`, `tipe_mobil`, `warna`, `BBM`, `foto`, `noMesin`, `noRangka`, `jumlah`) VALUES
('AA 8723 PS', 'Chery', 'SEDAN', 'Merah', '55 liter', 'download (6).jpg', '123a', '123a', 1),
('AB 4422 APS', 'Daihatsu Agya', 'SEDAN', 'Putih', '40 liter', 'download (2).jpg', '123b', '123b', 0),
('AD 2234 APS', 'KIA', 'SEDAN', 'Putih', '55 liter', 'download (7).jpg', '123c', '123c', 1),
('AE 1123 AP', 'Honda Mobilio ', 'MINI BUS', 'Grey', '45 liter', 'download.jpg', '123d', '123d', 1),
('AG 3333 APS', 'Volvo XC60', 'SEDAN', 'Silver', '55 liter', 'download (12).jpg', '123e', '123e', 1),
('B 1123 APS', 'Toyota Fortuner', 'MINI BUS', 'Merah', '40 liter', '192657767.jpg', '123f', '123f', 1),
('B 2222 AP', 'Toyota Fortuner', 'MINI BUS', 'Hitam', '60 liter', 'download (13).jpg', '123g', '123g', 1),
('B 2231 APS', 'Toyota Hilux', 'BOX', 'Hitam', '45 liter', 'attitude-black-metalic.png', '123h', '123i', 1),
('B 9012 APS', 'Daihatsu Xenia', 'MINI BUS', 'Hitam', '40 liter', 'xenia.jpg', '123j', '123j', 1),
('BH 1092 PS', 'Nissan Juke', 'MINI BUS', 'Grey', '50 liter', '2017-nissan-juke-premium-special-edition-2.jpg', '123k', '123k', 1),
('D 2314 APS', 'Honda Crv', 'MINIBUS', 'Metalic Purple', '55 liter', 'download (1).jpg', '123l', '123l', 1),
('D 4444 PS', 'Honda Jazz', 'SEDAN', 'Putih', '45 liter', 'download (14).jpg', '123m', '123m', 1),
('DA 1131 AP', 'Toyota Avanza ', 'MINI BUS', 'Silver', '35 liter', '75a7d5447718def42127e7d05236b52b.jpg', '123n', '123n', 1),
('DA 2314 AP', 'Toyota Hilux', 'BOX', 'Putih', '50 Liter', 'download (3).jpg', '123o', '123o', 1),
('F 6666 APS', 'hyundai Palised', 'MINI BUS', 'Merah', '60 liter', 'download (11).jpg', '123p', '123p', 1),
('G 1111 APS', 'Mitsubishi Pajero ', 'MINI BUS', 'Putih', '70 liter', 'download (10).jpg', '123q', '123q', 1),
('K 4432 AP', 'Hyundai Creta', 'MINI BUS', 'Hitam', '60 liter', 'download (8).jpg', '123r', '123r', 1),
('KH 3312 AS', 'toyota Ayla', 'MINI BUS', 'biru', '45 liter', 'Angkasa-Pura-Logo.jpg', '123s', '123s', 1),
('KH 3321 AP', 'Mazda', 'SEDAN', 'Putih', '50 Liter', 'download (4).jpg', '123t', '123t', 1),
('KT 5674 PS', 'Mitsubishi Expander', 'MINI BUS', 'Metalic Black', '60 liter', 'download (5).jpg', '123u', '123u', 1),
('R 0021 APS', 'Wuling Almaz', 'MINI BUS', 'Putih', '65 Liter', 'download (9).jpg', '123v', '123v', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pajak`
--

CREATE TABLE `pajak` (
  `id` int(20) NOT NULL,
  `plat_nomer` varchar(20) NOT NULL,
  `statuspemba` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pajak`
--

INSERT INTO `pajak` (`id`, `plat_nomer`, `statuspemba`) VALUES
(5, 'AA 8723 PS', 'Tahunan'),
(6, 'D 2314 APS', '5 tahun');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_nik` int(20) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `fk_devisi` varchar(50) NOT NULL,
  `Jabatan` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_nik`, `Nama`, `fk_devisi`, `Jabatan`) VALUES
(1003, 'Himawa Alatas ', 'Accounting & Budgeting', 'Staff'),
(1024, 'Gralia Sinaga', 'HR Service, Compensation, Benefit', 'Staff'),
(1054, 'Aisyah Tamara ', 'Deployement', 'Staff'),
(1092, 'Afif Alhajiq', 'Equipment & Technology ', 'Staff'),
(1119, 'Sadewa Sanjaya', 'HSE & Quality', 'Staff'),
(1135, 'Raditya Rahman', 'Operational Cleaning', 'SPV'),
(1211, 'Fatricia Alliya', 'Collection', 'Staff'),
(1259, 'Elang Winata', 'AR AP1 Group', 'SPV'),
(1312, 'Himana Sagala ', 'GA, Asset, Inventory Management', 'Staff'),
(1501, 'Langit Alvanaro', 'GA, Asset, Inventory Management', 'Staff'),
(1672, 'Danita Alwiya', 'HSE & Quality', 'Staff'),
(1682, 'Mawi Alkatiri ', 'Facility Management', 'Staff'),
(1862, 'Rayza Anindita ', 'EQ & Tech', 'SPV'),
(1929, 'Rasya Algifari', 'Collection', 'Staff'),
(2012, 'Rafiki Walaya ', 'Human Capital', 'SPV'),
(2029, 'Gestara Pradeepa', 'EQ & Tech', 'Staff'),
(2112, 'Willy Salwinata', 'Accounting & Budgeting', 'Staff'),
(2119, 'Jeevika Nayana', 'Equipment & Technology ', 'Staff'),
(2325, 'Grasia Altaf ', 'Deployement', 'Staff'),
(2939, 'Alexa Norzahra', 'Facility Management', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `reserv`
--

CREATE TABLE `reserv` (
  `id_reserv` int(20) NOT NULL,
  `Nik` int(50) NOT NULL,
  `Tujuan` varchar(50) NOT NULL,
  `Pilih_Reserv` varchar(50) NOT NULL,
  `Plat_nomer` varchar(20) NOT NULL,
  `WaktuOut` datetime DEFAULT NULL,
  `WaktuIn` datetime DEFAULT NULL,
  `KmOut` varchar(50) NOT NULL,
  `fotoout` text NOT NULL,
  `KmIn` varchar(50) NOT NULL,
  `fotoin` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserv`
--

INSERT INTO `reserv` (`id_reserv`, `Nik`, `Tujuan`, `Pilih_Reserv`, `Plat_nomer`, `WaktuOut`, `WaktuIn`, `KmOut`, `fotoout`, `KmIn`, `fotoin`, `status`) VALUES
(87, 1312, 'serviced', 'Luar', 'R 0021 APS', '2023-01-10 09:23:00', '2023-01-11 20:22:00', '111d', 'SERTIFIKAT124-out.jpg', '112d', '5bd2e036cd725319e8084cc970f40e0e-in.jpg', 'PENDING'),
(88, 2119, 'Rapat Luar ', 'Dalam', 'B 9012 APS', '2024-02-19 15:04:00', '2024-02-19 18:08:00', '921', 'e5c634fa056d80b4c7654e4e7ce61e39-out.jpg', '932', 'd93ae24f0bd253125a8c0c78b95e986a-in.jpg', 'ACC'),
(90, 1119, 'Tinjaun TPS', 'Dalam', 'B 2231 APS', '2024-02-20 10:00:00', '2024-02-20 11:37:00', '331', 'f928083d9efd229607146dd4c0e5fc87-out.jpg', '340', 'e5c634fa056d80b4c7654e4e7ce61e39-in.jpg', 'ACC'),
(91, 1211, 'Lapangan', 'Dalam', 'DA 1131 AP', '2024-02-21 12:00:00', '2024-02-21 01:10:00', '552', 'cf264d27f94fb04133436d448bc65c2f-out.jpg', '557', '5bd2e036cd725319e8084cc970f40e0e (1)-in.jpg', 'ACC'),
(92, 1501, 'Pembelian Stock Gudang ', 'Luar', 'DA 2314 AP', '2024-02-22 09:00:00', '2024-02-22 11:31:00', '781', 'b9751e3f20bffdb50a332672bffb3050-out.jpg', '790', 'd93ae24f0bd253125a8c0c78b95e986a (2)-in.jpg', 'ACC'),
(93, 1672, 'Rapat Luar ', 'Dalam', 'DA 1131 AP',  '2024-02-22 14:05:00', '2024-02-22 13:26:00', '678', '5bd2e036cd725319e8084cc970f40e0e-out.jpg', '688', '886d43c37ff739905f67153caab26e99-in.jpg', 'ACC'),
(95, 1672, 'Monitoring ', 'Dalam', 'DA 1131 AP','2024-02-22 14:00:00', '2024-02-22 15:00:00', '889', '5bd2e036cd725319e8084cc970f40e0e (1)-out.jpg', '910', '886d43c37ff739905f67153caab26e99 (1)-in.jpg', 'ACC'),
(96, 2325, 'Luar ', 'Dalam', 'B 9012 APS',  '2024-02-23 10:09:00', '2024-02-23 12:30:00', '998', 'f928083d9efd229607146dd4c0e5fc87 (1)-out.jpg', '1001', 'cf264d27f94fb04133436d448bc65c2f-in.jpg', 'ACC'),
(97, 1135, 'Tinjaun Lapangan', 'Dalam', 'DA 2314 AP', '2024-02-23 08:30:00', '2024-02-23 09:10:00', '991', '886d43c37ff739905f67153caab26e99-out.jpg', '998', 'b9751e3f20bffdb50a332672bffb3050 (1)-in.jpg', 'ACC'),
(98, 1862, 'Tinjauan Proyek', 'Dalam', 'DA 1131 AP',  '2024-02-24 11:00:00', '2024-02-24 14:20:00', '1012', 'b9751e3f20bffdb50a332672bffb3050 (1)-out.jpg', '1025', 'b9751e3f20bffdb50a332672bffb3050-in.jpg', 'ACC'),
(99, 2939, 'Monitoring ', 'Dalam', 'B 9012 APS',  '2024-02-24 09:02:00', '2024-02-24 10:08:00', '1023', 'e5c634fa056d80b4c7654e4e7ce61e39 (1)-out.jpg', '1033', 'e630ecfd04385d04ad3e11b0657aeed2-in.jpg', 'ACC'),
(100, 1054, 'Lapangan', 'Dalam', 'B 9012 APS',  '2024-02-24 13:01:00', '2024-02-24 14:01:00', '1045', 'b9751e3f20bffdb50a332672bffb3050 (2)-out.jpg', '1050', 'cf264d27f94fb04133436d448bc65c2f (1)-in.jpg', 'ACC'),
(101, 1135, 'Rapat Luar ', 'Dalam', 'DA 1131 AP',  '2024-02-25 09:03:00', '2024-02-25 11:04:00', '1055', 'e630ecfd04385d04ad3e11b0657aeed2-out.jpg', '1060', 'e630ecfd04385d04ad3e11b0657aeed2 (1)-in.jpg', 'ACC'),
(102, 2112, 'Penjemputan Tim Audit ', 'Dalam', 'B 9012 APS',  '2024-02-25 13:06:00', '2024-02-25 14:06:00', '1034', 'e630ecfd04385d04ad3e11b0657aeed2 (1)-out.jpg', '1040', 'f928083d9efd229607146dd4c0e5fc87-in.jpg', 'ACC'),
(103, 1024, 'Tinjauan Kinerja Pegawai', 'Dalam', 'B 9012 APS',  '2024-02-26 09:10:00', '2024-02-25 11:11:00', '1056', 'd93ae24f0bd253125a8c0c78b95e986a-out.jpg', '1060', 'e630ecfd04385d04ad3e11b0657aeed2 (2)-in.jpg', 'ACC'),
(104, 1259, 'Rapat Luar ', 'Dalam', 'DA 1131 AP',  '2024-02-26 10:13:00', '2024-02-26 13:13:00', '1098', 'e630ecfd04385d04ad3e11b0657aeed2 (2)-out.jpg', '1120', 'f928083d9efd229607146dd4c0e5fc87 (1)-in.jpg', 'ACC'),
(105, 1312, 'Pembelian Stock Gudang ', 'Luar', 'DA 2314 AP', '2024-02-26 15:14:00', '2024-02-27 14:15:00', '1013', '886d43c37ff739905f67153caab26e99 (1)-out.jpg', '1020', 'b9751e3f20bffdb50a332672bffb3050 (2)-in.jpg', 'ACC'),
(106, 1501, 'Service', 'Luar', 'B 2231 APS', '2024-02-28 23:17:00', '2024-02-29 16:17:00', '992', 'cf264d27f94fb04133436d448bc65c2f (1)-out.jpg', '1025', 'b9751e3f20bffdb50a332672bffb3050 (3)-in.jpg', 'ACC'),
(107, 2012, 'Rapat Luar', 'Dalam', 'DA 1131 AP',  '2024-02-29 10:21:00', '2024-02-29 15:22:00', '1037', '5bd2e036cd725319e8084cc970f40e0e (2)-out.jpg', '1045', 'e630ecfd04385d04ad3e11b0657aeed2 (3)-in.jpg', 'ACC'),
(108, 2119, 'Monitoring ', 'Dalam', 'B 9012 APS',  '2024-03-03 09:25:00', '2024-03-03 12:23:00', '1060', 'e5c634fa056d80b4c7654e4e7ce61e39 (2)-out.jpg', '1070', 'e630ecfd04385d04ad3e11b0657aeed2 (4)-in.jpg', 'ACC'),
(109, 1024, 'Rapat Luar ', 'Dalam', 'B 9012 APS',  '2024-03-21 14:56:00', '2024-07-18 12:10:00', '112', '27511d6c06eb3aea120b88e45fddac87-out.jpg', '332', '73d51da1cefa62ecf8c4341aadef4819-in.jpg', 'ACC');

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
('admin', 'admin'),
('user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(20) NOT NULL,
  `plat_nomer` varchar(20) NOT NULL,
  `jenis_service` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `plat_nomer`, `jenis_service`) VALUES
(2, 'B 1123 APS', 'Keseluruhan'),
(3, 'BH 1092 PS', 'Mesin');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_sts` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_sts`, `status`) VALUES
('DALAM', 'DALAM'),
('LUAR', 'LUAR');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `Nik` int(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `fk_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `Nik`, `Password`, `fk_role`) VALUES
(20, 12, '$2y$10$cMgbs/rKRRl.zwsXGHyuTuWLUQKXP7TFXxYjzZFgQjoAuHMCECqVa', 'admin'),
(22, 1024, '$2y$10$lA2Qd9nfYUx875.SNzdD/.jJJI.IGjqosmn7hxs/tW0rxBSAHhm6e', 'user'),
(23, 1211, '$2y$10$uphaCShFfLyMXpx/udUlEeeqrNKWHWnfKCqxuFeSZTpXzLEEiaVWy', 'user'),
(24, 1312, '$2y$10$O12VKtrYv6Zl1MyGsO.GCe.I9Dw2KTh8nfVQgNsoNewvzsRKqYtDG', 'admin'),
(25, 2112, '$2y$10$xAKDFq8No4jrS8lnA3W3/uy8maHrBapt9t7i00avoxI7zFow7MsAa', 'user'),
(26, 1003, '$2y$10$VoGL4zfo44qZkjsiyId/QeHDpySPTSC6ay89sYYJ0Gs1BtxS1gSqO', 'admin'),
(27, 1501, '$2y$10$75PmZp7DuIoN.AA3YiTcQuEVr2auHzB09YGPMRpvi6iVl02lHQdNO', 'admin'),
(28, 1672, '$2y$10$ue3JBf6d7lJekbEsfEYPvOHAmoX3xbQc6ClGzz2JPeWjWbPl8zOoi', 'user'),
(29, 1682, '$2y$10$/gIj2v.nqkZNcMawNLb4kONT6BgNW7Ne2VnP5ovsE9zrqjstcLZTe', 'user'),
(31, 1929, '$2y$10$k9s2FXZxdeub3/e.bth2zu94/0ExGLIlsd9Xxnb2L.PpNevscEAU.', 'user'),
(32, 2939, '$2y$10$BvNwxqnbtqVeVoteMaib5uyTUdw798E75dnYnEZufamMOsj.3GYYi', 'user'),
(33, 1054, '$2y$10$R4Be3Q4aJxH0hcr2tQRzsOShs//.HgvG5OU4Z4Dh3EnCwNuiH1Eg.', 'user'),
(34, 1092, '$2y$10$tg.VIYssZ5tpfOpsBC5DNuOxjlWsHxaFUBXY0s7UFQ3LH0e71gYtK', 'user'),
(35, 1135, '$2y$10$amPn6Mj/J.ep79Gx5ctz5..kFQmcK4JIRRfo3VJ0lPl7COClgmZem', 'user'),
(36, 2012, '$2y$10$crL5LMO7VvwfSDCOEABRFeip6DjkBKvXGlR5HnKlB9y5SxU94v3r2', 'user'),
(37, 2325, '$2y$10$.Qghda3A8gr3n1r0D72lme8TtiVX8KWnqqJC2orYH/UDqjdaHGF9q', 'user'),
(38, 1259, '$2y$10$JM3caDn2SMZHuv3azTFMHOoSIacrD6hToK4mnIETX.Td5yEJe0XUq', 'user'),
(40, 1862, '$2y$10$H0xagosvgf0vrXZM.5XGnutUk8Rce.5SA7V.fcuNCbCbTu8DYHmoO', 'admin'),
(41, 2029, '$2y$10$ay4CrvAe.SiuGgaoTVAMS.vBRrAkopvcgYtr2OEm7DGnoAABz9.GG', 'admin'),
(42, 2119, '$2y$10$0PpdJfm3fbBLAgq7lzy0EumKNuDB2lLa8oZtfxvK.HIWWl7yKEoLa', 'user'),
(43, 1119, '$2y$10$OlvnovDQPNGH94/VHa7Fbue1.JlMHxVbuaFXGbESSiKgcxE9K2xym', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asuransi`
--
ALTER TABLE `asuransi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asuransi_ibfk_1` (`plat_nomer`);

--
-- Indexes for table `devisi`
--
ALTER TABLE `devisi`
  ADD PRIMARY KEY (`id_devisi`);

--
-- Indexes for table `kelayakan`
--
ALTER TABLE `kelayakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plat_nomer` (`plat_nomer`);

--
-- Indexes for table `kerusakan`
--
ALTER TABLE `kerusakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobil` (`plat_nomer`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`plat_nomer`);

--
-- Indexes for table `pajak`
--
ALTER TABLE `pajak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plat_nomer` (`plat_nomer`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_nik`),
  ADD KEY `pegawai_ibfk_1` (`fk_devisi`);

--
-- Indexes for table `reserv`
--
ALTER TABLE `reserv`
  ADD PRIMARY KEY (`id_reserv`),
  ADD KEY `reservasi_ibfk_5` (`Plat_nomer`),
  ADD KEY `reservasi_ibfk_2` (`Nik`),
  ADD KEY `reservasi_ibfk_3` (`Pilih_Reserv`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plat_nomer` (`plat_nomer`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_sts`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_ibfk_2` (`fk_role`),
  ADD KEY `Nik` (`Nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asuransi`
--
ALTER TABLE `asuransi`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelayakan`
--
ALTER TABLE `kelayakan`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kerusakan`
--
ALTER TABLE `kerusakan`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pajak`
--
ALTER TABLE `pajak`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reserv`
--
ALTER TABLE `reserv`
  MODIFY `id_reserv` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asuransi`
--
ALTER TABLE `asuransi`
  ADD CONSTRAINT `asuransi_ibfk_1` FOREIGN KEY (`plat_nomer`) REFERENCES `mobil` (`plat_nomer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelayakan`
--
ALTER TABLE `kelayakan`
  ADD CONSTRAINT `plat_nomer` FOREIGN KEY (`plat_nomer`) REFERENCES `mobil` (`plat_nomer`);

--
-- Constraints for table `kerusakan`
--
ALTER TABLE `kerusakan`
  ADD CONSTRAINT `fk_plat_nomer` FOREIGN KEY (`plat_nomer`) REFERENCES `mobil` (`plat_nomer`);

--
-- Constraints for table `pajak`
--
ALTER TABLE `pajak`
  ADD CONSTRAINT `pajak_ibfk_1` FOREIGN KEY (`plat_nomer`) REFERENCES `mobil` (`plat_nomer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserv`
--
ALTER TABLE `reserv`
  ADD CONSTRAINT `reserv_ibfk_2` FOREIGN KEY (`Nik`) REFERENCES `pegawai` (`id_nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserv_ibfk_3` FOREIGN KEY (`Pilih_Reserv`) REFERENCES `status` (`id_sts`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserv_ibfk_5` FOREIGN KEY (`Plat_nomer`) REFERENCES `mobil` (`plat_nomer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`plat_nomer`) REFERENCES `mobil` (`plat_nomer`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
