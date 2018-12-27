-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 27, 2018 at 11:37 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5184705_rumahdannis_ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `atm`
--

CREATE TABLE `atm` (
  `ID_ATM` int(11) NOT NULL,
  `NAMA` varchar(10) DEFAULT NULL,
  `NAMA_REKENING` varchar(75) DEFAULT NULL,
  `NOMOR_REKENING` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atm`
--

INSERT INTO `atm` (`ID_ATM`, `NAMA`, `NAMA_REKENING`, `NOMOR_REKENING`) VALUES
(1, 'BCA', 'rumahdannis', '1541121331');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `ID_BARANG` varchar(20) NOT NULL,
  `ID_KATEGORI` int(11) NOT NULL,
  `NM_BARANG` varchar(20) DEFAULT NULL,
  `STOK_BARANG` int(11) DEFAULT NULL,
  `UKURAN` varchar(4) DEFAULT NULL,
  `WARNA` varchar(15) DEFAULT NULL,
  `BERAT_BARANG` int(11) DEFAULT NULL,
  `HARGA_BELI` int(11) DEFAULT NULL,
  `HARGA_JUAL` int(11) DEFAULT NULL,
  `DISKON` float DEFAULT NULL,
  `GAMBAR1` varchar(20) DEFAULT NULL,
  `GAMBAR2` varchar(20) DEFAULT NULL,
  `GAMBAR3` varchar(20) DEFAULT NULL,
  `GAMBAR4` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_BARANG`, `ID_KATEGORI`, `NM_BARANG`, `STOK_BARANG`, `UKURAN`, `WARNA`, `BERAT_BARANG`, `HARGA_BELI`, `HARGA_JUAL`, `DISKON`, `GAMBAR1`, `GAMBAR2`, `GAMBAR3`, `GAMBAR4`) VALUES
('BRG001', 1, 'koko LPD', 3, 'M', 'biru', 1, 75000, 150000, NULL, 'brg001-1', NULL, NULL, NULL),
('brg002', 1, 'koko LPD', 10, 'L', 'Black', 1, 100000, 175000, NULL, 'brg002-1', NULL, NULL, NULL),
('brg003', 1, 'koko LPD', 7, 'L', 'merah', 1, 100000, 175000, NULL, 'brg003-1', NULL, NULL, NULL),
('brg004', 2, 'd\'cozy', 2, 'S', 'biru', 1, 80000, 150000, NULL, 'brg004-1', NULL, NULL, NULL),
('brg005', 2, 'blouse katun', 2, 'xs', 'kuning', 1, 150000, 219000, NULL, 'brg005-1', NULL, NULL, NULL),
('brg006', 2, 'blouse katun', 5, 'm', 'merah', 1, 150000, 219000, NULL, 'brg006-1', NULL, NULL, NULL),
('brgg007', 3, 'abaya', 3, 'M', 'orange', 1, 200000, 300000, NULL, 'brg007-1', NULL, NULL, NULL),
('brgg008', 3, 'abaya', 3, 'M', '', 1, 200000, 300000, NULL, 'brg008-1', NULL, NULL, NULL),
('brgg009', 3, 'abaya', 3, 'M', 'abu-abu', 1, 200000, 300000, NULL, 'brg009-1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_jual`
--

CREATE TABLE `detail_jual` (
  `ID_JUAL` varchar(20) NOT NULL,
  `ID_BARANG` varchar(20) NOT NULL,
  `HARGA_JUAL` int(11) DEFAULT NULL,
  `HARGA_BELI` int(11) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `HARGA_TOTAL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_jual`
--

INSERT INTO `detail_jual` (`ID_JUAL`, `ID_BARANG`, `HARGA_JUAL`, `HARGA_BELI`, `JUMLAH`, `HARGA_TOTAL`) VALUES
('TR201803251U1', 'brg003', 175000, 100000, 1, 175000),
('TR201803251U2', 'BRG001', 150000, 75000, 1, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan_gudang`
--

CREATE TABLE `detail_pemesanan_gudang` (
  `ID_PEMESANAN_GDG` varchar(10) NOT NULL,
  `ID_PSN` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesan`
--

CREATE TABLE `detail_pesan` (
  `ID_PSN` varchar(20) NOT NULL,
  `ID_BARANG` varchar(20) NOT NULL,
  `HARGA` int(11) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `TOTAL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_retur`
--

CREATE TABLE `detail_retur` (
  `ID_JUAL` varchar(20) NOT NULL,
  `ID_BARANG` varchar(20) NOT NULL,
  `ID_RETUR` varchar(20) NOT NULL,
  `BAR_ID_BARANG` varchar(20) NOT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `KETERANGAN_RETUR` varchar(50) DEFAULT NULL,
  `BUKTI_RETUR` varchar(20) DEFAULT NULL,
  `STATUS_RETUR` char(1) DEFAULT NULL,
  `BIAYA_RETUR` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `ID_KAR` varchar(6) NOT NULL,
  `NM_KAR` varchar(35) DEFAULT NULL,
  `ALM_KAR` varchar(50) DEFAULT NULL,
  `TELP_KAR` varchar(12) DEFAULT NULL,
  `USER_KAR` varchar(20) DEFAULT NULL,
  `PASS_KAR` char(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`ID_KAR`, `NM_KAR`, `ALM_KAR`, `TELP_KAR`, `USER_KAR`, `PASS_KAR`) VALUES
('KAR001', 'cendekia', 'gms', '0812', 'cendekia', 'cendekia'),
('online', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `ID_KATEGORI` int(11) NOT NULL,
  `NAMA_KATEGORI` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`) VALUES
(1, 'koko pria'),
(2, 'blouse'),
(3, 'abaya');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `ID_KONS` varchar(12) NOT NULL,
  `ID_KOTA` int(11) NOT NULL,
  `NM_KONS` varchar(35) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `JENIS_KELAMIN` char(1) DEFAULT NULL,
  `ALM_KONS` varchar(100) DEFAULT NULL,
  `TELP_KONS` varchar(12) DEFAULT NULL,
  `EMAIL_KONS` varchar(50) DEFAULT NULL,
  `REKENING_KONS` varchar(35) DEFAULT NULL,
  `USER_KONS` varchar(20) DEFAULT NULL,
  `PASS_KONS` char(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`ID_KONS`, `ID_KOTA`, `NM_KONS`, `TGL_LAHIR`, `JENIS_KELAMIN`, `ALM_KONS`, `TELP_KONS`, `EMAIL_KONS`, `REKENING_KONS`, `USER_KONS`, `PASS_KONS`) VALUES
('kons001', 409, 'addin cendekia', '1992-01-22', '0', 'gms ab 44', '08882222', 'cw@gmail.com', 'mandiri : 12344421', 'addin', '$2y$10$VSDXoPRxcUy3Xp.1vn4IeOUC6DCoGBYvTUBSorHsHtSZhdmpt/2lO');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `ID_KOTA` int(11) NOT NULL,
  `ID_PROVINSI` int(11) NOT NULL,
  `NM_KOTA` varchar(100) DEFAULT NULL,
  `TYPE_KOTA` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`ID_KOTA`, `ID_PROVINSI`, `NM_KOTA`, `TYPE_KOTA`) VALUES
(1, 21, 'Aceh Barat', 'Kabupaten'),
(2, 21, 'Aceh Barat Daya', 'Kabupaten'),
(3, 21, 'Aceh Besar', 'Kabupaten'),
(4, 21, 'Aceh Jaya', 'Kabupaten'),
(5, 21, 'Aceh Selatan', 'Kabupaten'),
(6, 21, 'Aceh Singkil', 'Kabupaten'),
(7, 21, 'Aceh Tamiang', 'Kabupaten'),
(8, 21, 'Aceh Tengah', 'Kabupaten'),
(9, 21, 'Aceh Tenggara', 'Kabupaten'),
(10, 21, 'Aceh Timur', 'Kabupaten'),
(11, 21, 'Aceh Utara', 'Kabupaten'),
(12, 32, 'Agam', 'Kabupaten'),
(13, 23, 'Alor', 'Kabupaten'),
(14, 19, 'Ambon', 'Kota'),
(15, 34, 'Asahan', 'Kabupaten'),
(16, 24, 'Asmat', 'Kabupaten'),
(17, 1, 'Badung', 'Kabupaten'),
(18, 13, 'Balangan', 'Kabupaten'),
(19, 15, 'Balikpapan', 'Kota'),
(20, 21, 'Banda Aceh', 'Kota'),
(21, 18, 'Bandar Lampung', 'Kota'),
(22, 9, 'Bandung', 'Kabupaten'),
(23, 9, 'Bandung', 'Kota'),
(24, 9, 'Bandung Barat', 'Kabupaten'),
(25, 29, 'Banggai', 'Kabupaten'),
(26, 29, 'Banggai Kepulauan', 'Kabupaten'),
(27, 2, 'Bangka', 'Kabupaten'),
(28, 2, 'Bangka Barat', 'Kabupaten'),
(29, 2, 'Bangka Selatan', 'Kabupaten'),
(30, 2, 'Bangka Tengah', 'Kabupaten'),
(31, 11, 'Bangkalan', 'Kabupaten'),
(32, 1, 'Bangli', 'Kabupaten'),
(33, 13, 'Banjar', 'Kabupaten'),
(34, 9, 'Banjar', 'Kota'),
(35, 13, 'Banjarbaru', 'Kota'),
(36, 13, 'Banjarmasin', 'Kota'),
(37, 10, 'Banjarnegara', 'Kabupaten'),
(38, 28, 'Bantaeng', 'Kabupaten'),
(39, 5, 'Bantul', 'Kabupaten'),
(40, 33, 'Banyuasin', 'Kabupaten'),
(41, 10, 'Banyumas', 'Kabupaten'),
(42, 11, 'Banyuwangi', 'Kabupaten'),
(43, 13, 'Barito Kuala', 'Kabupaten'),
(44, 14, 'Barito Selatan', 'Kabupaten'),
(45, 14, 'Barito Timur', 'Kabupaten'),
(46, 14, 'Barito Utara', 'Kabupaten'),
(47, 28, 'Barru', 'Kabupaten'),
(48, 17, 'Batam', 'Kota'),
(49, 10, 'Batang', 'Kabupaten'),
(50, 8, 'Batang Hari', 'Kabupaten'),
(51, 11, 'Batu', 'Kota'),
(52, 34, 'Batu Bara', 'Kabupaten'),
(53, 30, 'Bau-Bau', 'Kota'),
(54, 9, 'Bekasi', 'Kabupaten'),
(55, 9, 'Bekasi', 'Kota'),
(56, 2, 'Belitung', 'Kabupaten'),
(57, 2, 'Belitung Timur', 'Kabupaten'),
(58, 23, 'Belu', 'Kabupaten'),
(59, 21, 'Bener Meriah', 'Kabupaten'),
(60, 26, 'Bengkalis', 'Kabupaten'),
(61, 12, 'Bengkayang', 'Kabupaten'),
(62, 4, 'Bengkulu', 'Kota'),
(63, 4, 'Bengkulu Selatan', 'Kabupaten'),
(64, 4, 'Bengkulu Tengah', 'Kabupaten'),
(65, 4, 'Bengkulu Utara', 'Kabupaten'),
(66, 15, 'Berau', 'Kabupaten'),
(67, 24, 'Biak Numfor', 'Kabupaten'),
(68, 22, 'Bima', 'Kabupaten'),
(69, 22, 'Bima', 'Kota'),
(70, 34, 'Binjai', 'Kota'),
(71, 17, 'Bintan', 'Kabupaten'),
(72, 21, 'Bireuen', 'Kabupaten'),
(73, 31, 'Bitung', 'Kota'),
(74, 11, 'Blitar', 'Kabupaten'),
(75, 11, 'Blitar', 'Kota'),
(76, 10, 'Blora', 'Kabupaten'),
(77, 7, 'Boalemo', 'Kabupaten'),
(78, 9, 'Bogor', 'Kabupaten'),
(79, 9, 'Bogor', 'Kota'),
(80, 11, 'Bojonegoro', 'Kabupaten'),
(81, 31, 'Bolaang Mongondow (Bolmong)', 'Kabupaten'),
(82, 31, 'Bolaang Mongondow Selatan', 'Kabupaten'),
(83, 31, 'Bolaang Mongondow Timur', 'Kabupaten'),
(84, 31, 'Bolaang Mongondow Utara', 'Kabupaten'),
(85, 30, 'Bombana', 'Kabupaten'),
(86, 11, 'Bondowoso', 'Kabupaten'),
(87, 28, 'Bone', 'Kabupaten'),
(88, 7, 'Bone Bolango', 'Kabupaten'),
(89, 15, 'Bontang', 'Kota'),
(90, 24, 'Boven Digoel', 'Kabupaten'),
(91, 10, 'Boyolali', 'Kabupaten'),
(92, 10, 'Brebes', 'Kabupaten'),
(93, 32, 'Bukittinggi', 'Kota'),
(94, 1, 'Buleleng', 'Kabupaten'),
(95, 28, 'Bulukumba', 'Kabupaten'),
(96, 16, 'Bulungan (Bulongan)', 'Kabupaten'),
(97, 8, 'Bungo', 'Kabupaten'),
(98, 29, 'Buol', 'Kabupaten'),
(99, 19, 'Buru', 'Kabupaten'),
(100, 19, 'Buru Selatan', 'Kabupaten'),
(101, 30, 'Buton', 'Kabupaten'),
(102, 30, 'Buton Utara', 'Kabupaten'),
(103, 9, 'Ciamis', 'Kabupaten'),
(104, 9, 'Cianjur', 'Kabupaten'),
(105, 10, 'Cilacap', 'Kabupaten'),
(106, 3, 'Cilegon', 'Kota'),
(107, 9, 'Cimahi', 'Kota'),
(108, 9, 'Cirebon', 'Kabupaten'),
(109, 9, 'Cirebon', 'Kota'),
(110, 34, 'Dairi', 'Kabupaten'),
(111, 24, 'Deiyai (Deliyai)', 'Kabupaten'),
(112, 34, 'Deli Serdang', 'Kabupaten'),
(113, 10, 'Demak', 'Kabupaten'),
(114, 1, 'Denpasar', 'Kota'),
(115, 9, 'Depok', 'Kota'),
(116, 32, 'Dharmasraya', 'Kabupaten'),
(117, 24, 'Dogiyai', 'Kabupaten'),
(118, 22, 'Dompu', 'Kabupaten'),
(119, 29, 'Donggala', 'Kabupaten'),
(120, 26, 'Dumai', 'Kota'),
(121, 33, 'Empat Lawang', 'Kabupaten'),
(122, 23, 'Ende', 'Kabupaten'),
(123, 28, 'Enrekang', 'Kabupaten'),
(124, 25, 'Fakfak', 'Kabupaten'),
(125, 23, 'Flores Timur', 'Kabupaten'),
(126, 9, 'Garut', 'Kabupaten'),
(127, 21, 'Gayo Lues', 'Kabupaten'),
(128, 1, 'Gianyar', 'Kabupaten'),
(129, 7, 'Gorontalo', 'Kabupaten'),
(130, 7, 'Gorontalo', 'Kota'),
(131, 7, 'Gorontalo Utara', 'Kabupaten'),
(132, 28, 'Gowa', 'Kabupaten'),
(133, 11, 'Gresik', 'Kabupaten'),
(134, 10, 'Grobogan', 'Kabupaten'),
(135, 5, 'Gunung Kidul', 'Kabupaten'),
(136, 14, 'Gunung Mas', 'Kabupaten'),
(137, 34, 'Gunungsitoli', 'Kota'),
(138, 20, 'Halmahera Barat', 'Kabupaten'),
(139, 20, 'Halmahera Selatan', 'Kabupaten'),
(140, 20, 'Halmahera Tengah', 'Kabupaten'),
(141, 20, 'Halmahera Timur', 'Kabupaten'),
(142, 20, 'Halmahera Utara', 'Kabupaten'),
(143, 13, 'Hulu Sungai Selatan', 'Kabupaten'),
(144, 13, 'Hulu Sungai Tengah', 'Kabupaten'),
(145, 13, 'Hulu Sungai Utara', 'Kabupaten'),
(146, 34, 'Humbang Hasundutan', 'Kabupaten'),
(147, 26, 'Indragiri Hilir', 'Kabupaten'),
(148, 26, 'Indragiri Hulu', 'Kabupaten'),
(149, 9, 'Indramayu', 'Kabupaten'),
(150, 24, 'Intan Jaya', 'Kabupaten'),
(151, 6, 'Jakarta Barat', 'Kota'),
(152, 6, 'Jakarta Pusat', 'Kota'),
(153, 6, 'Jakarta Selatan', 'Kota'),
(154, 6, 'Jakarta Timur', 'Kota'),
(155, 6, 'Jakarta Utara', 'Kota'),
(156, 8, 'Jambi', 'Kota'),
(157, 24, 'Jayapura', 'Kabupaten'),
(158, 24, 'Jayapura', 'Kota'),
(159, 24, 'Jayawijaya', 'Kabupaten'),
(160, 11, 'Jember', 'Kabupaten'),
(161, 1, 'Jembrana', 'Kabupaten'),
(162, 28, 'Jeneponto', 'Kabupaten'),
(163, 10, 'Jepara', 'Kabupaten'),
(164, 11, 'Jombang', 'Kabupaten'),
(165, 25, 'Kaimana', 'Kabupaten'),
(166, 26, 'Kampar', 'Kabupaten'),
(167, 14, 'Kapuas', 'Kabupaten'),
(168, 12, 'Kapuas Hulu', 'Kabupaten'),
(169, 10, 'Karanganyar', 'Kabupaten'),
(170, 1, 'Karangasem', 'Kabupaten'),
(171, 9, 'Karawang', 'Kabupaten'),
(172, 17, 'Karimun', 'Kabupaten'),
(173, 34, 'Karo', 'Kabupaten'),
(174, 14, 'Katingan', 'Kabupaten'),
(175, 4, 'Kaur', 'Kabupaten'),
(176, 12, 'Kayong Utara', 'Kabupaten'),
(177, 10, 'Kebumen', 'Kabupaten'),
(178, 11, 'Kediri', 'Kabupaten'),
(179, 11, 'Kediri', 'Kota'),
(180, 24, 'Keerom', 'Kabupaten'),
(181, 10, 'Kendal', 'Kabupaten'),
(182, 30, 'Kendari', 'Kota'),
(183, 4, 'Kepahiang', 'Kabupaten'),
(184, 17, 'Kepulauan Anambas', 'Kabupaten'),
(185, 19, 'Kepulauan Aru', 'Kabupaten'),
(186, 32, 'Kepulauan Mentawai', 'Kabupaten'),
(187, 26, 'Kepulauan Meranti', 'Kabupaten'),
(188, 31, 'Kepulauan Sangihe', 'Kabupaten'),
(189, 6, 'Kepulauan Seribu', 'Kabupaten'),
(190, 31, 'Kepulauan Siau Tagulandang Biaro (Sitaro)', 'Kabupaten'),
(191, 20, 'Kepulauan Sula', 'Kabupaten'),
(192, 31, 'Kepulauan Talaud', 'Kabupaten'),
(193, 24, 'Kepulauan Yapen (Yapen Waropen)', 'Kabupaten'),
(194, 8, 'Kerinci', 'Kabupaten'),
(195, 12, 'Ketapang', 'Kabupaten'),
(196, 10, 'Klaten', 'Kabupaten'),
(197, 1, 'Klungkung', 'Kabupaten'),
(198, 30, 'Kolaka', 'Kabupaten'),
(199, 30, 'Kolaka Utara', 'Kabupaten'),
(200, 30, 'Konawe', 'Kabupaten'),
(201, 30, 'Konawe Selatan', 'Kabupaten'),
(202, 30, 'Konawe Utara', 'Kabupaten'),
(203, 13, 'Kotabaru', 'Kabupaten'),
(204, 31, 'Kotamobagu', 'Kota'),
(205, 14, 'Kotawaringin Barat', 'Kabupaten'),
(206, 14, 'Kotawaringin Timur', 'Kabupaten'),
(207, 26, 'Kuantan Singingi', 'Kabupaten'),
(208, 12, 'Kubu Raya', 'Kabupaten'),
(209, 10, 'Kudus', 'Kabupaten'),
(210, 5, 'Kulon Progo', 'Kabupaten'),
(211, 9, 'Kuningan', 'Kabupaten'),
(212, 23, 'Kupang', 'Kabupaten'),
(213, 23, 'Kupang', 'Kota'),
(214, 15, 'Kutai Barat', 'Kabupaten'),
(215, 15, 'Kutai Kartanegara', 'Kabupaten'),
(216, 15, 'Kutai Timur', 'Kabupaten'),
(217, 34, 'Labuhan Batu', 'Kabupaten'),
(218, 34, 'Labuhan Batu Selatan', 'Kabupaten'),
(219, 34, 'Labuhan Batu Utara', 'Kabupaten'),
(220, 33, 'Lahat', 'Kabupaten'),
(221, 14, 'Lamandau', 'Kabupaten'),
(222, 11, 'Lamongan', 'Kabupaten'),
(223, 18, 'Lampung Barat', 'Kabupaten'),
(224, 18, 'Lampung Selatan', 'Kabupaten'),
(225, 18, 'Lampung Tengah', 'Kabupaten'),
(226, 18, 'Lampung Timur', 'Kabupaten'),
(227, 18, 'Lampung Utara', 'Kabupaten'),
(228, 12, 'Landak', 'Kabupaten'),
(229, 34, 'Langkat', 'Kabupaten'),
(230, 21, 'Langsa', 'Kota'),
(231, 24, 'Lanny Jaya', 'Kabupaten'),
(232, 3, 'Lebak', 'Kabupaten'),
(233, 4, 'Lebong', 'Kabupaten'),
(234, 23, 'Lembata', 'Kabupaten'),
(235, 21, 'Lhokseumawe', 'Kota'),
(236, 32, 'Lima Puluh Koto/Kota', 'Kabupaten'),
(237, 17, 'Lingga', 'Kabupaten'),
(238, 22, 'Lombok Barat', 'Kabupaten'),
(239, 22, 'Lombok Tengah', 'Kabupaten'),
(240, 22, 'Lombok Timur', 'Kabupaten'),
(241, 22, 'Lombok Utara', 'Kabupaten'),
(242, 33, 'Lubuk Linggau', 'Kota'),
(243, 11, 'Lumajang', 'Kabupaten'),
(244, 28, 'Luwu', 'Kabupaten'),
(245, 28, 'Luwu Timur', 'Kabupaten'),
(246, 28, 'Luwu Utara', 'Kabupaten'),
(247, 11, 'Madiun', 'Kabupaten'),
(248, 11, 'Madiun', 'Kota'),
(249, 10, 'Magelang', 'Kabupaten'),
(250, 10, 'Magelang', 'Kota'),
(251, 11, 'Magetan', 'Kabupaten'),
(252, 9, 'Majalengka', 'Kabupaten'),
(253, 27, 'Majene', 'Kabupaten'),
(254, 28, 'Makassar', 'Kota'),
(255, 11, 'Malang', 'Kabupaten'),
(256, 11, 'Malang', 'Kota'),
(257, 16, 'Malinau', 'Kabupaten'),
(258, 19, 'Maluku Barat Daya', 'Kabupaten'),
(259, 19, 'Maluku Tengah', 'Kabupaten'),
(260, 19, 'Maluku Tenggara', 'Kabupaten'),
(261, 19, 'Maluku Tenggara Barat', 'Kabupaten'),
(262, 27, 'Mamasa', 'Kabupaten'),
(263, 24, 'Mamberamo Raya', 'Kabupaten'),
(264, 24, 'Mamberamo Tengah', 'Kabupaten'),
(265, 27, 'Mamuju', 'Kabupaten'),
(266, 27, 'Mamuju Utara', 'Kabupaten'),
(267, 31, 'Manado', 'Kota'),
(268, 34, 'Mandailing Natal', 'Kabupaten'),
(269, 23, 'Manggarai', 'Kabupaten'),
(270, 23, 'Manggarai Barat', 'Kabupaten'),
(271, 23, 'Manggarai Timur', 'Kabupaten'),
(272, 25, 'Manokwari', 'Kabupaten'),
(273, 25, 'Manokwari Selatan', 'Kabupaten'),
(274, 24, 'Mappi', 'Kabupaten'),
(275, 28, 'Maros', 'Kabupaten'),
(276, 22, 'Mataram', 'Kota'),
(277, 25, 'Maybrat', 'Kabupaten'),
(278, 34, 'Medan', 'Kota'),
(279, 12, 'Melawi', 'Kabupaten'),
(280, 8, 'Merangin', 'Kabupaten'),
(281, 24, 'Merauke', 'Kabupaten'),
(282, 18, 'Mesuji', 'Kabupaten'),
(283, 18, 'Metro', 'Kota'),
(284, 24, 'Mimika', 'Kabupaten'),
(285, 31, 'Minahasa', 'Kabupaten'),
(286, 31, 'Minahasa Selatan', 'Kabupaten'),
(287, 31, 'Minahasa Tenggara', 'Kabupaten'),
(288, 31, 'Minahasa Utara', 'Kabupaten'),
(289, 11, 'Mojokerto', 'Kabupaten'),
(290, 11, 'Mojokerto', 'Kota'),
(291, 29, 'Morowali', 'Kabupaten'),
(292, 33, 'Muara Enim', 'Kabupaten'),
(293, 8, 'Muaro Jambi', 'Kabupaten'),
(294, 4, 'Muko Muko', 'Kabupaten'),
(295, 30, 'Muna', 'Kabupaten'),
(296, 14, 'Murung Raya', 'Kabupaten'),
(297, 33, 'Musi Banyuasin', 'Kabupaten'),
(298, 33, 'Musi Rawas', 'Kabupaten'),
(299, 24, 'Nabire', 'Kabupaten'),
(300, 21, 'Nagan Raya', 'Kabupaten'),
(301, 23, 'Nagekeo', 'Kabupaten'),
(302, 17, 'Natuna', 'Kabupaten'),
(303, 24, 'Nduga', 'Kabupaten'),
(304, 23, 'Ngada', 'Kabupaten'),
(305, 11, 'Nganjuk', 'Kabupaten'),
(306, 11, 'Ngawi', 'Kabupaten'),
(307, 34, 'Nias', 'Kabupaten'),
(308, 34, 'Nias Barat', 'Kabupaten'),
(309, 34, 'Nias Selatan', 'Kabupaten'),
(310, 34, 'Nias Utara', 'Kabupaten'),
(311, 16, 'Nunukan', 'Kabupaten'),
(312, 33, 'Ogan Ilir', 'Kabupaten'),
(313, 33, 'Ogan Komering Ilir', 'Kabupaten'),
(314, 33, 'Ogan Komering Ulu', 'Kabupaten'),
(315, 33, 'Ogan Komering Ulu Selatan', 'Kabupaten'),
(316, 33, 'Ogan Komering Ulu Timur', 'Kabupaten'),
(317, 11, 'Pacitan', 'Kabupaten'),
(318, 32, 'Padang', 'Kota'),
(319, 34, 'Padang Lawas', 'Kabupaten'),
(320, 34, 'Padang Lawas Utara', 'Kabupaten'),
(321, 32, 'Padang Panjang', 'Kota'),
(322, 32, 'Padang Pariaman', 'Kabupaten'),
(323, 34, 'Padang Sidempuan', 'Kota'),
(324, 33, 'Pagar Alam', 'Kota'),
(325, 34, 'Pakpak Bharat', 'Kabupaten'),
(326, 14, 'Palangka Raya', 'Kota'),
(327, 33, 'Palembang', 'Kota'),
(328, 28, 'Palopo', 'Kota'),
(329, 29, 'Palu', 'Kota'),
(330, 11, 'Pamekasan', 'Kabupaten'),
(331, 3, 'Pandeglang', 'Kabupaten'),
(332, 9, 'Pangandaran', 'Kabupaten'),
(333, 28, 'Pangkajene Kepulauan', 'Kabupaten'),
(334, 2, 'Pangkal Pinang', 'Kota'),
(335, 24, 'Paniai', 'Kabupaten'),
(336, 28, 'Parepare', 'Kota'),
(337, 32, 'Pariaman', 'Kota'),
(338, 29, 'Parigi Moutong', 'Kabupaten'),
(339, 32, 'Pasaman', 'Kabupaten'),
(340, 32, 'Pasaman Barat', 'Kabupaten'),
(341, 15, 'Paser', 'Kabupaten'),
(342, 11, 'Pasuruan', 'Kabupaten'),
(343, 11, 'Pasuruan', 'Kota'),
(344, 10, 'Pati', 'Kabupaten'),
(345, 32, 'Payakumbuh', 'Kota'),
(346, 25, 'Pegunungan Arfak', 'Kabupaten'),
(347, 24, 'Pegunungan Bintang', 'Kabupaten'),
(348, 10, 'Pekalongan', 'Kabupaten'),
(349, 10, 'Pekalongan', 'Kota'),
(350, 26, 'Pekanbaru', 'Kota'),
(351, 26, 'Pelalawan', 'Kabupaten'),
(352, 10, 'Pemalang', 'Kabupaten'),
(353, 34, 'Pematang Siantar', 'Kota'),
(354, 15, 'Penajam Paser Utara', 'Kabupaten'),
(355, 18, 'Pesawaran', 'Kabupaten'),
(356, 18, 'Pesisir Barat', 'Kabupaten'),
(357, 32, 'Pesisir Selatan', 'Kabupaten'),
(358, 21, 'Pidie', 'Kabupaten'),
(359, 21, 'Pidie Jaya', 'Kabupaten'),
(360, 28, 'Pinrang', 'Kabupaten'),
(361, 7, 'Pohuwato', 'Kabupaten'),
(362, 27, 'Polewali Mandar', 'Kabupaten'),
(363, 11, 'Ponorogo', 'Kabupaten'),
(364, 12, 'Pontianak', 'Kabupaten'),
(365, 12, 'Pontianak', 'Kota'),
(366, 29, 'Poso', 'Kabupaten'),
(367, 33, 'Prabumulih', 'Kota'),
(368, 18, 'Pringsewu', 'Kabupaten'),
(369, 11, 'Probolinggo', 'Kabupaten'),
(370, 11, 'Probolinggo', 'Kota'),
(371, 14, 'Pulang Pisau', 'Kabupaten'),
(372, 20, 'Pulau Morotai', 'Kabupaten'),
(373, 24, 'Puncak', 'Kabupaten'),
(374, 24, 'Puncak Jaya', 'Kabupaten'),
(375, 10, 'Purbalingga', 'Kabupaten'),
(376, 9, 'Purwakarta', 'Kabupaten'),
(377, 10, 'Purworejo', 'Kabupaten'),
(378, 25, 'Raja Ampat', 'Kabupaten'),
(379, 4, 'Rejang Lebong', 'Kabupaten'),
(380, 10, 'Rembang', 'Kabupaten'),
(381, 26, 'Rokan Hilir', 'Kabupaten'),
(382, 26, 'Rokan Hulu', 'Kabupaten'),
(383, 23, 'Rote Ndao', 'Kabupaten'),
(384, 21, 'Sabang', 'Kota'),
(385, 23, 'Sabu Raijua', 'Kabupaten'),
(386, 10, 'Salatiga', 'Kota'),
(387, 15, 'Samarinda', 'Kota'),
(388, 12, 'Sambas', 'Kabupaten'),
(389, 34, 'Samosir', 'Kabupaten'),
(390, 11, 'Sampang', 'Kabupaten'),
(391, 12, 'Sanggau', 'Kabupaten'),
(392, 24, 'Sarmi', 'Kabupaten'),
(393, 8, 'Sarolangun', 'Kabupaten'),
(394, 32, 'Sawah Lunto', 'Kota'),
(395, 12, 'Sekadau', 'Kabupaten'),
(396, 28, 'Selayar (Kepulauan Selayar)', 'Kabupaten'),
(397, 4, 'Seluma', 'Kabupaten'),
(398, 10, 'Semarang', 'Kabupaten'),
(399, 10, 'Semarang', 'Kota'),
(400, 19, 'Seram Bagian Barat', 'Kabupaten'),
(401, 19, 'Seram Bagian Timur', 'Kabupaten'),
(402, 3, 'Serang', 'Kabupaten'),
(403, 3, 'Serang', 'Kota'),
(404, 34, 'Serdang Bedagai', 'Kabupaten'),
(405, 14, 'Seruyan', 'Kabupaten'),
(406, 26, 'Siak', 'Kabupaten'),
(407, 34, 'Sibolga', 'Kota'),
(408, 28, 'Sidenreng Rappang/Rapang', 'Kabupaten'),
(409, 11, 'Sidoarjo', 'Kabupaten'),
(410, 29, 'Sigi', 'Kabupaten'),
(411, 32, 'Sijunjung (Sawah Lunto Sijunjung)', 'Kabupaten'),
(412, 23, 'Sikka', 'Kabupaten'),
(413, 34, 'Simalungun', 'Kabupaten'),
(414, 21, 'Simeulue', 'Kabupaten'),
(415, 12, 'Singkawang', 'Kota'),
(416, 28, 'Sinjai', 'Kabupaten'),
(417, 12, 'Sintang', 'Kabupaten'),
(418, 11, 'Situbondo', 'Kabupaten'),
(419, 5, 'Sleman', 'Kabupaten'),
(420, 32, 'Solok', 'Kabupaten'),
(421, 32, 'Solok', 'Kota'),
(422, 32, 'Solok Selatan', 'Kabupaten'),
(423, 28, 'Soppeng', 'Kabupaten'),
(424, 25, 'Sorong', 'Kabupaten'),
(425, 25, 'Sorong', 'Kota'),
(426, 25, 'Sorong Selatan', 'Kabupaten'),
(427, 10, 'Sragen', 'Kabupaten'),
(428, 9, 'Subang', 'Kabupaten'),
(429, 21, 'Subulussalam', 'Kota'),
(430, 9, 'Sukabumi', 'Kabupaten'),
(431, 9, 'Sukabumi', 'Kota'),
(432, 14, 'Sukamara', 'Kabupaten'),
(433, 10, 'Sukoharjo', 'Kabupaten'),
(434, 23, 'Sumba Barat', 'Kabupaten'),
(435, 23, 'Sumba Barat Daya', 'Kabupaten'),
(436, 23, 'Sumba Tengah', 'Kabupaten'),
(437, 23, 'Sumba Timur', 'Kabupaten'),
(438, 22, 'Sumbawa', 'Kabupaten'),
(439, 22, 'Sumbawa Barat', 'Kabupaten'),
(440, 9, 'Sumedang', 'Kabupaten'),
(441, 11, 'Sumenep', 'Kabupaten'),
(442, 8, 'Sungaipenuh', 'Kota'),
(443, 24, 'Supiori', 'Kabupaten'),
(444, 11, 'Surabaya', 'Kota'),
(445, 10, 'Surakarta (Solo)', 'Kota'),
(446, 13, 'Tabalong', 'Kabupaten'),
(447, 1, 'Tabanan', 'Kabupaten'),
(448, 28, 'Takalar', 'Kabupaten'),
(449, 25, 'Tambrauw', 'Kabupaten'),
(450, 16, 'Tana Tidung', 'Kabupaten'),
(451, 28, 'Tana Toraja', 'Kabupaten'),
(452, 13, 'Tanah Bumbu', 'Kabupaten'),
(453, 32, 'Tanah Datar', 'Kabupaten'),
(454, 13, 'Tanah Laut', 'Kabupaten'),
(455, 3, 'Tangerang', 'Kabupaten'),
(456, 3, 'Tangerang', 'Kota'),
(457, 3, 'Tangerang Selatan', 'Kota'),
(458, 18, 'Tanggamus', 'Kabupaten'),
(459, 34, 'Tanjung Balai', 'Kota'),
(460, 8, 'Tanjung Jabung Barat', 'Kabupaten'),
(461, 8, 'Tanjung Jabung Timur', 'Kabupaten'),
(462, 17, 'Tanjung Pinang', 'Kota'),
(463, 34, 'Tapanuli Selatan', 'Kabupaten'),
(464, 34, 'Tapanuli Tengah', 'Kabupaten'),
(465, 34, 'Tapanuli Utara', 'Kabupaten'),
(466, 13, 'Tapin', 'Kabupaten'),
(467, 16, 'Tarakan', 'Kota'),
(468, 9, 'Tasikmalaya', 'Kabupaten'),
(469, 9, 'Tasikmalaya', 'Kota'),
(470, 34, 'Tebing Tinggi', 'Kota'),
(471, 8, 'Tebo', 'Kabupaten'),
(472, 10, 'Tegal', 'Kabupaten'),
(473, 10, 'Tegal', 'Kota'),
(474, 25, 'Teluk Bintuni', 'Kabupaten'),
(475, 25, 'Teluk Wondama', 'Kabupaten'),
(476, 10, 'Temanggung', 'Kabupaten'),
(477, 20, 'Ternate', 'Kota'),
(478, 20, 'Tidore Kepulauan', 'Kota'),
(479, 23, 'Timor Tengah Selatan', 'Kabupaten'),
(480, 23, 'Timor Tengah Utara', 'Kabupaten'),
(481, 34, 'Toba Samosir', 'Kabupaten'),
(482, 29, 'Tojo Una-Una', 'Kabupaten'),
(483, 29, 'Toli-Toli', 'Kabupaten'),
(484, 24, 'Tolikara', 'Kabupaten'),
(485, 31, 'Tomohon', 'Kota'),
(486, 28, 'Toraja Utara', 'Kabupaten'),
(487, 11, 'Trenggalek', 'Kabupaten'),
(488, 19, 'Tual', 'Kota'),
(489, 11, 'Tuban', 'Kabupaten'),
(490, 18, 'Tulang Bawang', 'Kabupaten'),
(491, 18, 'Tulang Bawang Barat', 'Kabupaten'),
(492, 11, 'Tulungagung', 'Kabupaten'),
(493, 28, 'Wajo', 'Kabupaten'),
(494, 30, 'Wakatobi', 'Kabupaten'),
(495, 24, 'Waropen', 'Kabupaten'),
(496, 18, 'Way Kanan', 'Kabupaten'),
(497, 10, 'Wonogiri', 'Kabupaten'),
(498, 10, 'Wonosobo', 'Kabupaten'),
(499, 24, 'Yahukimo', 'Kabupaten'),
(500, 24, 'Yalimo', 'Kabupaten'),
(501, 5, 'Yogyakarta', 'Kota');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `ID_PEMBAYARAN` varchar(20) NOT NULL,
  `ID_JUAL` varchar(20) NOT NULL,
  `ID_KAR` varchar(6) NOT NULL,
  `TGL_PEMBAYARAN` date DEFAULT NULL,
  `DEADLINE_PEMBAYARAN` date DEFAULT NULL,
  `BUKTI_PEMBAYARAN` varchar(20) DEFAULT NULL,
  `JENIS_PEMBAYARAN` char(1) DEFAULT NULL,
  `STATUS_PEMBAYARAN` char(1) DEFAULT NULL,
  `TOTAL_PEMBAYARAN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`ID_PEMBAYARAN`, `ID_JUAL`, `ID_KAR`, `TGL_PEMBAYARAN`, `DEADLINE_PEMBAYARAN`, `BUKTI_PEMBAYARAN`, `JENIS_PEMBAYARAN`, `STATUS_PEMBAYARAN`, `TOTAL_PEMBAYARAN`) VALUES
('PY201803251U1', 'TR201803251U1', 'online', '2018-03-25', '2018-03-26', 'TR201803251U1', '1', '2', 180000),
('PY201803251U2', 'TR201803251U2', 'online', NULL, '2018-03-26', NULL, '1', '0', 155000);

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
  `ID_PSN` varchar(20) NOT NULL,
  `ID_KONS` varchar(12) NOT NULL,
  `ID_KAR` varchar(6) NOT NULL,
  `TGL_PSN` date DEFAULT NULL,
  `STATUS_PSN` char(1) DEFAULT NULL,
  `KONFIRMASI_PSN` char(1) DEFAULT NULL,
  `TOTAL` int(11) DEFAULT NULL,
  `JENIS_PSN` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_gudang`
--

CREATE TABLE `pemesanan_gudang` (
  `ID_PEMESANAN_GDG` varchar(10) NOT NULL,
  `ID_PEMILIK` varchar(10) NOT NULL,
  `TGL_PEMESANAN_GDG` date DEFAULT NULL,
  `PERIODE_TGL_AWAL` date DEFAULT NULL,
  `PERIODE_TGL_AKHIR` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `ID_PEMILIK` varchar(10) NOT NULL,
  `PASS_PEMILIK` varchar(20) DEFAULT NULL,
  `NAMA_PEMILIK` varchar(50) DEFAULT NULL,
  `EMAIL_PEMILIK` varchar(50) DEFAULT NULL,
  `ALAMAT_PEMILIK` varchar(70) DEFAULT NULL,
  `TELP_PEMILIK` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `ID_KIRIM` varchar(20) NOT NULL,
  `ID_PEMBAYARAN` varchar(20) NOT NULL,
  `ID_KAR` varchar(6) NOT NULL,
  `TGL_KIRIM` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `JASA_KIRIM` varchar(8) DEFAULT NULL,
  `BIAYA_KIRIM` int(11) DEFAULT NULL,
  `NO_RESI` varchar(20) DEFAULT NULL,
  `ALAMAT_KIRIM` varchar(150) DEFAULT NULL,
  `STATUS_PENGIRIMAN` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`ID_KIRIM`, `ID_PEMBAYARAN`, `ID_KAR`, `TGL_KIRIM`, `JASA_KIRIM`, `BIAYA_KIRIM`, `NO_RESI`, `ALAMAT_KIRIM`, `STATUS_PENGIRIMAN`) VALUES
('SH201803251U1', 'PY201803251U1', 'online', '2018-03-25 10:28:54', 'jne - CT', 5000, NULL, 'gms ab 44, Sidoarjo, Jawa Timur', '0'),
('SH201803251U2', 'PY201803251U2', 'online', '2018-03-25 11:47:24', 'jne - CT', 5000, NULL, 'gms ab 44, Sidoarjo, Jawa Timur', '0');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `ID_JUAL` varchar(20) NOT NULL,
  `ID_KAR` varchar(6) NOT NULL,
  `ID_KONS` varchar(12) NOT NULL,
  `ID_PSN` varchar(20) DEFAULT NULL,
  `ID_ATM` int(11) DEFAULT NULL,
  `TGL_PESAN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `JENIS_JUAL` char(1) DEFAULT NULL,
  `STATUS` char(1) DEFAULT NULL,
  `TOTAL` int(11) DEFAULT NULL,
  `REKENING_KONS` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`ID_JUAL`, `ID_KAR`, `ID_KONS`, `ID_PSN`, `ID_ATM`, `TGL_PESAN`, `JENIS_JUAL`, `STATUS`, `TOTAL`, `REKENING_KONS`) VALUES
('TR201803251U1', 'online', 'kons001', NULL, 1, '2018-03-25 17:28:54', '1', '0', 175000, 'mandiri  :  12344421'),
('TR201803251U2', 'online', 'kons001', NULL, 1, '2018-03-25 18:47:24', '1', '0', 150000, 'mandiri  :  12344421');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `ID_PROVINSI` int(11) NOT NULL,
  `NAMA_PROVINSI` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`ID_PROVINSI`, `NAMA_PROVINSI`) VALUES
(1, 'Bali'),
(2, 'Bangka Belitung'),
(3, 'Banten'),
(4, 'Bengkulu'),
(5, 'DI Yogyakarta'),
(6, 'DKI Jakarta'),
(7, 'Gorontalo'),
(8, 'Jambi'),
(9, 'Jawa Barat'),
(10, 'Jawa Tengah'),
(11, 'Jawa Timur'),
(12, 'Kalimantan Barat'),
(13, 'Kalimantan Selatan'),
(14, 'Kalimantan Tengah'),
(15, 'Kalimantan Timur'),
(16, 'Kalimantan Utara'),
(17, 'Kepulauan Riau'),
(18, 'Lampung'),
(19, 'Maluku'),
(20, 'Maluku Utara'),
(21, 'Nanggroe Aceh Darussalam (NAD)'),
(22, 'Nusa Tenggara Barat (NTB)'),
(23, 'Nusa Tenggara Timur (NTT)'),
(24, 'Papua'),
(25, 'Papua Barat'),
(26, 'Riau'),
(27, 'Sulawesi Barat'),
(28, 'Sulawesi Selatan'),
(29, 'Sulawesi Tengah'),
(30, 'Sulawesi Tenggara'),
(31, 'Sulawesi Utara'),
(32, 'Sumatera Barat'),
(33, 'Sumatera Selatan'),
(34, 'Sumatera Utara');

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE `retur` (
  `ID_RETUR` varchar(20) NOT NULL,
  `ID_KAR` varchar(6) NOT NULL,
  `ID_KONS` varchar(12) DEFAULT NULL,
  `TGL_PENGAJUAN_RETUR` date DEFAULT NULL,
  `TGL_PERSETUJUAN_RETUR` date DEFAULT NULL,
  `DEADLINE_RETUR` date DEFAULT NULL,
  `JENIS_RETUR` char(1) DEFAULT NULL,
  `TOTAL_BIAYA_RETUR` int(11) DEFAULT NULL,
  `STATUS` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atm`
--
ALTER TABLE `atm`
  ADD PRIMARY KEY (`ID_ATM`),
  ADD UNIQUE KEY `ATM_PK` (`ID_ATM`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`),
  ADD UNIQUE KEY `BARANG_PK` (`ID_BARANG`),
  ADD KEY `BERADA_FK` (`ID_KATEGORI`);

--
-- Indexes for table `detail_jual`
--
ALTER TABLE `detail_jual`
  ADD PRIMARY KEY (`ID_JUAL`,`ID_BARANG`),
  ADD UNIQUE KEY `DETAIL_JUAL_PK` (`ID_JUAL`,`ID_BARANG`),
  ADD KEY `RELATION_49_FK` (`ID_BARANG`),
  ADD KEY `MEMILIKI_BANYAK_FK` (`ID_JUAL`);

--
-- Indexes for table `detail_pemesanan_gudang`
--
ALTER TABLE `detail_pemesanan_gudang`
  ADD PRIMARY KEY (`ID_PEMESANAN_GDG`,`ID_PSN`),
  ADD UNIQUE KEY `DETAIL_PEMESANAN_GUDANG_PK` (`ID_PEMESANAN_GDG`,`ID_PSN`),
  ADD KEY `MENDAPAT_FK` (`ID_PSN`),
  ADD KEY `MENGHASILKAN_FK` (`ID_PEMESANAN_GDG`);

--
-- Indexes for table `detail_pesan`
--
ALTER TABLE `detail_pesan`
  ADD PRIMARY KEY (`ID_PSN`,`ID_BARANG`),
  ADD UNIQUE KEY `DETAIL_PESAN_PK` (`ID_PSN`,`ID_BARANG`),
  ADD KEY `DIISI_FK` (`ID_PSN`),
  ADD KEY `BERISI_FK` (`ID_BARANG`);

--
-- Indexes for table `detail_retur`
--
ALTER TABLE `detail_retur`
  ADD PRIMARY KEY (`ID_JUAL`,`ID_BARANG`,`ID_RETUR`),
  ADD UNIQUE KEY `DETAIL_RETUR_PK` (`ID_JUAL`,`ID_BARANG`,`ID_RETUR`),
  ADD KEY `RELATION_1923_FK` (`ID_RETUR`),
  ADD KEY `RELATION_1924_FK` (`ID_JUAL`,`ID_BARANG`),
  ADD KEY `MENGGANTIKAN_FK` (`BAR_ID_BARANG`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`ID_KAR`),
  ADD UNIQUE KEY `KARYAWAN_PK` (`ID_KAR`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID_KATEGORI`),
  ADD UNIQUE KEY `KATEGORI_PK` (`ID_KATEGORI`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`ID_KONS`),
  ADD UNIQUE KEY `KONSUMEN_PK` (`ID_KONS`),
  ADD KEY `BERTEMPAT_FK` (`ID_KOTA`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`ID_KOTA`),
  ADD UNIQUE KEY `KOTA_PK` (`ID_KOTA`),
  ADD KEY `BANYAK_FK` (`ID_PROVINSI`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID_PEMBAYARAN`),
  ADD UNIQUE KEY `PEMBAYARAN_PK` (`ID_PEMBAYARAN`),
  ADD KEY `MEMILIKI_FK` (`ID_JUAL`),
  ADD KEY `MENGKONFIRMASI_FK` (`ID_KAR`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`ID_PSN`),
  ADD UNIQUE KEY `PEMESAN_PK` (`ID_PSN`),
  ADD KEY `MEMESAN_FK` (`ID_KONS`),
  ADD KEY `MENCATAT_PESANAN_FK` (`ID_KAR`);

--
-- Indexes for table `pemesanan_gudang`
--
ALTER TABLE `pemesanan_gudang`
  ADD PRIMARY KEY (`ID_PEMESANAN_GDG`),
  ADD UNIQUE KEY `PEMESANAN_GUDANG_PK` (`ID_PEMESANAN_GDG`),
  ADD KEY `MENGURUS_FK` (`ID_PEMILIK`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`ID_PEMILIK`),
  ADD UNIQUE KEY `PEMILIK_PK` (`ID_PEMILIK`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`ID_KIRIM`),
  ADD UNIQUE KEY `PENGIRIMAN_PK` (`ID_KIRIM`),
  ADD KEY `UNTUK_FK` (`ID_PEMBAYARAN`),
  ADD KEY `MENGIRIM_FK` (`ID_KAR`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`ID_JUAL`),
  ADD UNIQUE KEY `PENJUALAN_PK` (`ID_JUAL`),
  ADD KEY `MELAYANI_FK` (`ID_KAR`),
  ADD KEY `MEMBELI_FK` (`ID_KONS`),
  ADD KEY `TERCATAT_FK` (`ID_PSN`),
  ADD KEY `MENGGUNAKAN_FK` (`ID_ATM`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`ID_PROVINSI`),
  ADD UNIQUE KEY `PROVINSI_PK` (`ID_PROVINSI`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`ID_RETUR`),
  ADD UNIQUE KEY `RETUR_PK` (`ID_RETUR`),
  ADD KEY `MELAYANI_RETUR_FK` (`ID_KAR`),
  ADD KEY `MENGEMBALIKAN_FK` (`ID_KONS`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`ID_KATEGORI`) REFERENCES `kategori` (`ID_KATEGORI`);

--
-- Constraints for table `detail_jual`
--
ALTER TABLE `detail_jual`
  ADD CONSTRAINT `detail_jual_ibfk_1` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`),
  ADD CONSTRAINT `detail_jual_ibfk_2` FOREIGN KEY (`ID_JUAL`) REFERENCES `penjualan` (`ID_JUAL`);

--
-- Constraints for table `detail_pemesanan_gudang`
--
ALTER TABLE `detail_pemesanan_gudang`
  ADD CONSTRAINT `detail_pemesanan_gudang_ibfk_1` FOREIGN KEY (`ID_PSN`) REFERENCES `pemesan` (`ID_PSN`),
  ADD CONSTRAINT `detail_pemesanan_gudang_ibfk_2` FOREIGN KEY (`ID_PEMESANAN_GDG`) REFERENCES `pemesanan_gudang` (`ID_PEMESANAN_GDG`);

--
-- Constraints for table `detail_pesan`
--
ALTER TABLE `detail_pesan`
  ADD CONSTRAINT `detail_pesan_ibfk_1` FOREIGN KEY (`ID_PSN`) REFERENCES `pemesan` (`ID_PSN`),
  ADD CONSTRAINT `detail_pesan_ibfk_2` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`);

--
-- Constraints for table `detail_retur`
--
ALTER TABLE `detail_retur`
  ADD CONSTRAINT `detail_retur_ibfk_1` FOREIGN KEY (`ID_RETUR`) REFERENCES `retur` (`ID_RETUR`),
  ADD CONSTRAINT `detail_retur_ibfk_2` FOREIGN KEY (`ID_JUAL`,`ID_BARANG`) REFERENCES `detail_jual` (`ID_JUAL`, `ID_BARANG`),
  ADD CONSTRAINT `detail_retur_ibfk_3` FOREIGN KEY (`BAR_ID_BARANG`) REFERENCES `barang` (`ID_BARANG`);

--
-- Constraints for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD CONSTRAINT `konsumen_ibfk_1` FOREIGN KEY (`ID_KOTA`) REFERENCES `kota` (`ID_KOTA`);

--
-- Constraints for table `kota`
--
ALTER TABLE `kota`
  ADD CONSTRAINT `kota_ibfk_1` FOREIGN KEY (`ID_PROVINSI`) REFERENCES `provinsi` (`ID_PROVINSI`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`ID_JUAL`) REFERENCES `penjualan` (`ID_JUAL`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`ID_KAR`) REFERENCES `karyawan` (`ID_KAR`);

--
-- Constraints for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD CONSTRAINT `pemesan_ibfk_1` FOREIGN KEY (`ID_KONS`) REFERENCES `konsumen` (`ID_KONS`),
  ADD CONSTRAINT `pemesan_ibfk_2` FOREIGN KEY (`ID_KAR`) REFERENCES `karyawan` (`ID_KAR`);

--
-- Constraints for table `pemesanan_gudang`
--
ALTER TABLE `pemesanan_gudang`
  ADD CONSTRAINT `pemesanan_gudang_ibfk_1` FOREIGN KEY (`ID_PEMILIK`) REFERENCES `pemilik` (`ID_PEMILIK`);

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`ID_PEMBAYARAN`) REFERENCES `pembayaran` (`ID_PEMBAYARAN`),
  ADD CONSTRAINT `pengiriman_ibfk_2` FOREIGN KEY (`ID_KAR`) REFERENCES `karyawan` (`ID_KAR`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`ID_KAR`) REFERENCES `karyawan` (`ID_KAR`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`ID_KONS`) REFERENCES `konsumen` (`ID_KONS`),
  ADD CONSTRAINT `penjualan_ibfk_3` FOREIGN KEY (`ID_PSN`) REFERENCES `pemesan` (`ID_PSN`),
  ADD CONSTRAINT `penjualan_ibfk_4` FOREIGN KEY (`ID_ATM`) REFERENCES `atm` (`ID_ATM`);

--
-- Constraints for table `retur`
--
ALTER TABLE `retur`
  ADD CONSTRAINT `retur_ibfk_1` FOREIGN KEY (`ID_KAR`) REFERENCES `karyawan` (`ID_KAR`),
  ADD CONSTRAINT `retur_ibfk_2` FOREIGN KEY (`ID_KONS`) REFERENCES `konsumen` (`ID_KONS`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
