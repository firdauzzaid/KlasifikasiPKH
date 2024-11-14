-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 02:32 PM
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
-- Database: `klasifikasipkh`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(6, 'Suwono', '123'),
(12, 'Admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `hasilklasifikasi`
--

CREATE TABLE `hasilklasifikasi` (
  `id_klasifikasi` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `statusAwal` varchar(25) NOT NULL,
  `statusPKH` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasilklasifikasi`
--

INSERT INTO `hasilklasifikasi` (`id_klasifikasi`, `id_penerima`, `nama`, `statusAwal`, `statusPKH`) VALUES
(1416, 1001, 'Andri', 'Belum Terklasifikasi', 'Tidak Layak'),
(1417, 1002, 'Lita', 'Belum Terklasifikasi', 'Tidak Layak'),
(1418, 1003, 'Bambang', 'Belum Terklasifikasi', 'Tidak Layak'),
(1419, 1004, 'Annisa', 'Belum Terklasifikasi', 'Tidak Layak'),
(1420, 1005, 'Agung', 'Belum Terklasifikasi', 'Layak'),
(1421, 1006, 'Yusuf', 'Belum Terklasifikasi', 'Tidak Layak'),
(1422, 1007, 'Dinda', 'Belum Terklasifikasi', 'Tidak Layak'),
(1423, 1008, 'Angkasa', 'Belum Terklasifikasi', 'Layak'),
(1424, 1009, 'Wawan', 'Belum Terklasifikasi', 'Tidak Layak'),
(1425, 1010, 'Firdaus', '', 'Tidak Layak');

-- --------------------------------------------------------

--
-- Table structure for table `latihdata`
--

CREATE TABLE `latihdata` (
  `id_penerima` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `sts_lahan` enum('Pribadi','Warisan','Negara') NOT NULL,
  `sts_bangunan` enum('Pribadi','Warisan','Umum') NOT NULL,
  `jns_lantai` enum('Vinyl','Keramik','Teraso','Semen') NOT NULL,
  `jns_dinding` enum('Hebel','Batako','Bata Merah','GRC','Kayu') NOT NULL,
  `jns_atap` enum('Tanah Liat','Asbes','Seng') NOT NULL,
  `smr_air` enum('PDAM','Sanyo','Sumur') NOT NULL,
  `smr_penerangan` enum('Listrik','Lainnya') NOT NULL,
  `bb_memasak` enum('Gas','Kompor Minyak','Tungku') NOT NULL,
  `jns_kloset` enum('Kloset Duduk','Kloset Jongkok') NOT NULL,
  `jns_kendaraan` enum('Mobil','Motor','Sepeda','Angkutan Umum') NOT NULL,
  `aset_pribadi` enum('Tanah','Sawah','Rumah','Tidak Ada') NOT NULL,
  `tlpn_rumah` enum('Ya','Tidak') NOT NULL,
  `wifi` enum('Ya','Tidak') NOT NULL,
  `statusAwal` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `latihdata`
--

INSERT INTO `latihdata` (`id_penerima`, `id_admin`, `nama`, `alamat`, `sts_lahan`, `sts_bangunan`, `jns_lantai`, `jns_dinding`, `jns_atap`, `smr_air`, `smr_penerangan`, `bb_memasak`, `jns_kloset`, `jns_kendaraan`, `aset_pribadi`, `tlpn_rumah`, `wifi`, `statusAwal`) VALUES
(1, 12, 'JAI', 'Gg. Sinar Pagi I No 01', 'Pribadi', 'Pribadi', 'Vinyl', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Duduk', 'Mobil', 'Tanah', 'Ya', 'Ya', '0'),
(2, 12, 'MARUF', 'Gg. Sinar Pagi I No 02', 'Pribadi', 'Warisan', 'Keramik', 'Batako', 'Tanah Liat', 'Sanyo', 'Listrik', 'Kompor Minyak', 'Kloset Duduk', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(3, 12, 'SARIAH', 'Gg. Sinar Pagi I No 03', 'Warisan', 'Umum', 'Semen', 'Hebel', 'Asbes', 'Sumur', 'Listrik', 'Tungku', 'Kloset Jongkok', 'Sepeda', 'Sawah', 'Tidak', 'Tidak', '1'),
(4, 12, 'A NAZARUDDIN LATIF', 'Gg. Sinar Pagi I No 04', 'Negara', 'Pribadi', 'Keramik', 'Kayu', 'Asbes', 'PDAM', 'Lainnya', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(5, 12, 'AA SUGIANA', 'Gg. Sinar Pagi I No 05', 'Pribadi', 'Warisan', 'Teraso', 'GRC', 'Seng', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(6, 12, 'AAH SUTIANI', 'Gg. Sinar Pagi I No 06', 'Warisan', 'Umum', 'Semen', 'Bata Merah', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Ya', '1'),
(7, 12, 'AAN ARYANA', 'Gg. Sinar Pagi I No 07', 'Negara', 'Pribadi', 'Semen', 'Bata Merah', 'Asbes', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(8, 12, 'AAN LESMANAWATI', 'Gg. Sinar Pagi I No 08', 'Pribadi', 'Warisan', 'Vinyl', 'Hebel', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(9, 12, 'AAN MARIANA', 'Gg. Sinar Pagi I No 09', 'Pribadi', 'Umum', 'Semen', 'Hebel', 'Seng', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(10, 12, 'AANG KUSAERI', 'Gg. Sinar Pagi I No 10', 'Pribadi', 'Pribadi', 'Keramik', 'Batako', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(11, 12, 'ABD ROHMAN', 'Gg. Sinar Pagi I No 11', 'Warisan', 'Warisan', 'Keramik', 'Batako', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(12, 12, 'ABDUL AZIS', 'Gg. Sinar Pagi I No 12', 'Negara', 'Umum', 'Teraso', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(13, 12, 'ABDUL GOPUR', 'Gg. Sinar Pagi I No 13', 'Pribadi', 'Pribadi', 'Keramik', 'Batako', 'Tanah Liat', 'Sanyo', 'Lainnya', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(14, 12, 'ABDUL KOSIM', 'Gg. Sinar Pagi I No 14', 'Warisan', 'Warisan', 'Teraso', 'Hebel', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(15, 12, 'ABDUL MANAP', 'Gg. Sinar Pagi I No 15', 'Negara', 'Umum', 'Vinyl', 'Kayu', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(16, 12, 'ABDUL RAHMAN', 'Gg. Sinar Pagi I No 16', 'Pribadi', 'Pribadi', 'Keramik', 'GRC', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(17, 12, 'ABDULLAH', 'Gg. Sinar Pagi I No 17', 'Warisan', 'Warisan', 'Keramik', 'Bata Merah', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(18, 12, 'ABDURACHMAN', 'Gg. Sinar Pagi I No 18', 'Negara', 'Pribadi', 'Keramik', 'Bata Merah', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tanah', 'Tidak', 'Tidak', '0'),
(19, 12, 'ABDURACHMAN', 'Gg. Sinar Pagi I No 19', 'Pribadi', 'Warisan', 'Keramik', 'Hebel', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(20, 12, 'ABRAHAM', 'Gg. Sinar Pagi I No 20', 'Warisan', 'Umum', 'Keramik', 'Hebel', 'Tanah Liat', 'PDAM', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(21, 12, 'ACHMAD RIFAI', 'Gg. Sinar Pagi I No 21', 'Negara', 'Pribadi', 'Semen', 'Batako', 'Asbes', 'Sanyo', 'Listrik', 'Tungku', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(22, 12, 'ACHMAD SUDRAJAT', 'Gg. Sinar Pagi I No 22', 'Pribadi', 'Warisan', 'Teraso', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Duduk', 'Mobil', 'Rumah', 'Tidak', 'Tidak', '0'),
(23, 12, 'ACHMAD SYARIF', 'Gg. Sinar Pagi I No 23', 'Warisan', 'Umum', 'Keramik', 'Bata Merah', 'Seng', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(24, 12, 'ACHMAD TAUFIK', 'Gg. Sinar Pagi I No 24', 'Negara', 'Pribadi', 'Keramik', 'Bata Merah', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(25, 12, 'ACIH', 'Gg. Sinar Pagi I No 25', 'Pribadi', 'Warisan', 'Keramik', 'Hebel', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(26, 12, 'ACIH SUNTACI', 'Gg. Sinar Pagi I No 26', 'Warisan', 'Umum', 'Semen', 'Hebel', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(27, 12, 'ADANG SUNANDAR', 'Gg. Sinar Pagi I No 27', 'Pribadi', 'Pribadi', 'Vinyl', 'Batako', 'Seng', 'Sumur', 'Lainnya', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(28, 12, 'ADE LUKMAN', 'Gg. Sinar Pagi I No 28', 'Warisan', 'Warisan', 'Keramik', 'Batako', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(29, 12, 'ADE SURYANI', 'Gg. Sinar Pagi I No 29', 'Negara', 'Umum', 'Vinyl', 'Bata Merah', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(30, 12, 'ADHITYA WARMAN', 'Gg. Sinar Pagi I No 30', 'Pribadi', 'Pribadi', 'Keramik', 'Batako', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Ya', '0'),
(31, 12, 'ADI APRIYANTO', 'Gg. Sinar Pagi I No 31', 'Warisan', 'Warisan', 'Keramik', 'Hebel', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(32, 12, 'ADI FEBRIADI', 'Gg. Sinar Pagi I No 32', 'Warisan', 'Umum', 'Keramik', 'Kayu', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Sawah', 'Tidak', 'Tidak', '1'),
(33, 12, 'ADI SUKIRMAN', 'Gg. Sinar Pagi I No 33', 'Negara', 'Pribadi', 'Keramik', 'GRC', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(34, 12, 'AEN MISHAENY', 'Gg. Sinar Pagi I No 34', 'Pribadi', 'Warisan', 'Keramik', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(35, 12, 'AFIV LUKMANUL HAKIM', 'Gg. Sinar Pagi I No 35', 'Pribadi', 'Pribadi', 'Semen', 'Bata Merah', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(36, 12, 'AGUNG KOKO HARMOKO', 'Gg. Sinar Pagi I No 36', 'Warisan', 'Warisan', 'Semen', 'Hebel', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(37, 12, 'AGUNG PETAPA AZNAR KAMEIL', 'Gg. Sinar Pagi I No 37', 'Negara', 'Umum', 'Keramik', 'Hebel', 'Tanah Liat', 'PDAM', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(38, 12, 'AGUS BUDI SUMANTO', 'Gg. Sinar Pagi I No 38', 'Pribadi', 'Pribadi', 'Keramik', 'Batako', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(39, 12, 'AGUS DAMAYANA', 'Gg. Sinar Pagi I No 39', 'Warisan', 'Warisan', 'Keramik', 'Batako', 'Asbes', 'Sumur', 'Listrik', 'Tungku', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(40, 12, 'AGUS GUNAWAN', 'Gg. Sinar Pagi I No 40', 'Negara', 'Umum', 'Semen', 'Hebel', 'Seng', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(41, 12, 'AGUS MULYANA PUTRA SETIAWAN', 'Gg. Sinar Pagi II No 010', 'Pribadi', 'Pribadi', 'Vinyl', 'Hebel', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Rumah', 'Ya', 'Tidak', '0'),
(42, 12, 'AGUS NURAHMAN', 'Gg. Sinar Pagi II No 011', 'Warisan', 'Warisan', 'Keramik', 'Batako', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(43, 12, 'AGUS NUROCHMAN FIRMANSYAH', 'Gg. Sinar Pagi II No 012', 'Negara', 'Umum', 'Keramik', 'Batako', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(44, 12, 'AGUS PRANATA', 'Gg. Sinar Pagi II No 013', 'Pribadi', 'Pribadi', 'Keramik', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(45, 12, 'AGUS RACHMAN', 'Gg. Sinar Pagi II No 014', 'Warisan', 'Warisan', 'Semen', 'Batako', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Rumah', 'Ya', 'Tidak', '0'),
(46, 12, 'AGUS SUGIANTO', 'Gg. Sinar Pagi II No 015', 'Negara', 'Umum', 'Teraso', 'Hebel', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(47, 12, 'AGUSTINI', 'Gg. Sinar Pagi II No 016', 'Pribadi', 'Pribadi', 'Keramik', 'Kayu', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(48, 12, 'AHAN SUBIHAN', 'Gg. Sinar Pagi II No 017', 'Warisan', 'Warisan', 'Keramik', 'GRC', 'Tanah Liat', 'Sanyo', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(49, 12, 'AHMAD BASARI', 'Gg. Sinar Pagi II No 018', 'Pribadi', 'Umum', 'Teraso', 'Bata Merah', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(50, 12, 'AHMAD FARIS MAULANA', 'Gg. Sinar Pagi II No 019', 'Warisan', 'Pribadi', 'Semen', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(51, 12, 'AHMAD GUSTI FERDIANDI', 'Gg. Sinar Pagi II No 020', 'Negara', 'Warisan', 'Vinyl', 'Hebel', 'Tanah Liat', 'Sanyo', 'Lainnya', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(52, 12, 'AHMAD MURHAJI', 'Gg. Sinar Pagi II No 021', 'Pribadi', 'Pribadi', 'Keramik', 'Hebel', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(53, 12, 'AHMAD ROSANDI', 'Gg. Sinar Pagi II No 022', 'Warisan', 'Warisan', 'Vinyl', 'Batako', 'Asbes', 'Sanyo', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(54, 12, 'AHMAD SALIM', 'Gg. Sinar Pagi II No 023', 'Negara', 'Umum', 'Keramik', 'Batako', 'Seng', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(55, 12, 'AHMAD TIGOR KSO', 'Gg. Sinar Pagi II No 024', 'Pribadi', 'Pribadi', 'Keramik', 'Bata Merah', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(56, 12, 'AHMAD YANI', 'Gg. Sinar Pagi II No 025', 'Warisan', 'Warisan', 'Keramik', 'Bata Merah', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(57, 12, 'AHMAD ZAJULI', 'Gg. Sinar Pagi II No 026', 'Negara', 'Umum', 'Teraso', 'Hebel', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tanah', 'Ya', 'Tidak', '0'),
(58, 12, 'AI NURHAYATI', 'Gg. Sinar Pagi II No 027', 'Pribadi', 'Pribadi', 'Keramik', 'Hebel', 'Seng', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(59, 12, 'AIDA LONA', 'Gg. Sinar Pagi II No 028', 'Warisan', 'Warisan', 'Semen', 'Batako', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(60, 12, 'AIS SUPRIADI', 'Gg. Sinar Pagi II No 029', 'Negara', 'Umum', 'Semen', 'Batako', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(61, 12, 'AJENG PRATIWI', 'Gg. Sinar Pagi II No 030', 'Pribadi', 'Pribadi', 'Keramik', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(62, 12, 'AJI ZAKARIA', 'Gg. Sinar Pagi II No 031', 'Warisan', 'Warisan', 'Keramik', 'Batako', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(63, 12, 'AKMAD', 'Gg. Sinar Pagi II No 032', 'Negara', 'Umum', 'Keramik', 'Hebel', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(64, 12, 'AKMADI', 'Gg. Sinar Pagi II No 033', 'Pribadi', 'Pribadi', 'Semen', 'Kayu', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Ya', '0'),
(65, 12, 'AL MAIDAH', 'Gg. Sinar Pagi II No 034', 'Warisan', 'Warisan', 'Vinyl', 'GRC', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(66, 12, 'ALAM', 'Gg. Sinar Pagi II No 035', 'Pribadi', 'Umum', 'Keramik', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(67, 12, 'ALFIAN', 'Gg. Sinar Pagi II No 036', 'Warisan', 'Pribadi', 'Keramik', 'Bata Merah', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(68, 12, 'ALI MASHUDI', 'Gg. Sinar Pagi II No 037', 'Pribadi', 'Warisan', 'Keramik', 'Hebel', 'Asbes', 'Sumur', 'Lainnya', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(69, 12, 'ALI ROMLI', 'Gg. Sinar Pagi II No 038', 'Warisan', 'Pribadi', 'Semen', 'Hebel', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(70, 12, 'ALIAH AGUSTINA', 'Gg. Sinar Pagi II No 039', 'Negara', 'Umum', 'Semen', 'Batako', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(71, 12, 'ALIM MURYANTO', 'Gg. Sinar Pagi III No 120', 'Pribadi', 'Umum', 'Keramik', 'Batako', 'Tanah Liat', 'Sanyo', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Ya', '0'),
(72, 12, 'ALIYAH YULIATI', 'Gg. Sinar Pagi III No 121', 'Warisan', 'Pribadi', 'Semen', 'Hebel', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(73, 12, 'AMELIYAH', 'Gg. Sinar Pagi III No 122', 'Negara', 'Warisan', 'Vinyl', 'Hebel', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(74, 12, 'AMINAH', 'Gg. Sinar Pagi III No 123', 'Pribadi', 'Umum', 'Keramik', 'Batako', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(75, 12, 'AMINAH', 'Gg. Sinar Pagi III No 124', 'Warisan', 'Pribadi', 'Vinyl', 'Batako', 'Asbes', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Rumah', 'Ya', 'Ya', '0'),
(76, 12, 'AMINAH', 'Gg. Sinar Pagi III No 125', 'Negara', 'Warisan', 'Keramik', 'Bata Merah', 'Seng', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(77, 12, 'AMINAH', 'Gg. Sinar Pagi III No 126', 'Pribadi', 'Umum', 'Keramik', 'Batako', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(78, 12, 'AMING MIRDJA', 'Gg. Sinar Pagi III No 127', 'Warisan', 'Pribadi', 'Keramik', 'Hebel', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(79, 12, 'ANA', 'Gg. Sinar Pagi III No 128', 'Negara', 'Warisan', 'Keramik', 'Kayu', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(80, 12, 'ANA KAEROH', 'Gg. Sinar Pagi III No 129', 'Pribadi', 'Umum', 'Keramik', 'GRC', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(81, 12, 'ANAH', 'Gg. Sinar Pagi III No 130', 'Warisan', 'Pribadi', 'Semen', 'Bata Merah', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(82, 12, 'ANAH', 'Gg. Sinar Pagi III No 131', 'Negara', 'Warisan', 'Semen', 'Bata Merah', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(83, 12, 'ANAH NURHASANAH', 'Gg. Sinar Pagi III No 132', 'Pribadi', 'Umum', 'Keramik', 'Hebel', 'Tanah Liat', 'PDAM', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(84, 12, 'ANANG MAULLANA ISHAQ', 'Gg. Sinar Pagi III No 133', 'Warisan', 'Pribadi', 'Keramik', 'Hebel', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(85, 12, 'ANDI JUPRI', 'Gg. Sinar Pagi III No 134', 'Pribadi', 'Warisan', 'Teraso', 'Batako', 'Asbes', 'Sumur', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Motor', 'Sawah', 'Ya', 'Ya', '0'),
(86, 12, 'ANDI PERMANA', 'Gg. Sinar Pagi III No 135', 'Warisan', 'Pribadi', 'Semen', 'Batako', 'Tanah Liat', 'PDAM', 'Listrik', 'Tungku', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(87, 12, 'ANDI PRAYITNO', 'Gg. Sinar Pagi III No 136', 'Negara', 'Warisan', 'Vinyl', 'Bata Merah', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(88, 12, 'ANDIKA FEBBY PRABOWO', 'Gg. Sinar Pagi III No 137', 'Pribadi', 'Umum', 'Teraso', 'Bata Merah', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(89, 12, 'ANDIKA PRATAMA', 'Gg. Sinar Pagi III No 138', 'Pribadi', 'Pribadi', 'Keramik', 'Hebel', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(90, 12, 'ANDREYANTO', 'Gg. Sinar Pagi III No 139', 'Warisan', 'Warisan', 'Keramik', 'Hebel', 'Seng', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(91, 12, 'ANDRI AFRYTAMA', 'Gg. Sinar Pagi III No 140', 'Negara', 'Umum', 'Teraso', 'Batako', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(92, 12, 'ANDRIATNO', 'Gg. Sinar Pagi III No 141', 'Pribadi', 'Pribadi', 'Semen', 'Batako', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(93, 12, 'ANDRIYANI', 'Gg. Sinar Pagi III No 142', 'Warisan', 'Warisan', 'Keramik', 'Bata Merah', 'Asbes', 'PDAM', 'Listrik', 'Gas', 'Kloset Duduk', 'Sepeda', 'Tanah', 'Tidak', 'Ya', '0'),
(94, 12, 'ANDRIYANI', 'Gg. Sinar Pagi III No 143', 'Negara', 'Umum', 'Teraso', 'Batako', 'Seng', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(95, 12, 'ANGGA RAHMAN', 'Gg. Sinar Pagi III No 144', 'Pribadi', 'Pribadi', 'Keramik', 'Hebel', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(96, 12, 'ANGGA ROSANDI', 'Gg. Sinar Pagi III No 145', 'Warisan', 'Warisan', 'Semen', 'Kayu', 'Tanah Liat', 'Sanyo', 'Lainnya', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(97, 12, 'ANI NURAENI', 'Gg. Sinar Pagi III No 146', 'Negara', 'Umum', 'Vinyl', 'GRC', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(98, 12, 'ANI SUMARNI', 'Gg. Sinar Pagi III No 147', 'Pribadi', 'Pribadi', 'Keramik', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(99, 12, 'ANI TRIYANA', 'Gg. Sinar Pagi III No 148', 'Warisan', 'Warisan', 'Vinyl', 'Bata Merah', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(100, 12, 'ANIH', 'Gg. Sinar Pagi IV No 23', 'Negara', 'Umum', 'Keramik', 'Hebel', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(101, 12, 'ANIRAH', 'Gg. Sinar Pagi IV No 24', 'Warisan', 'Warisan', 'Semen', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Mobil', 'Tanah', 'Ya', 'Ya', '0'),
(102, 12, 'ANISA', 'Gg. Sinar Pagi IV No 25', 'Negara', 'Umum', 'Semen', 'Batako', 'Tanah Liat', 'Sanyo', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Angkutan Umum', 'Sawah', 'Ya', 'Ya', '0'),
(103, 12, 'ANISAH', 'Gg. Sinar Pagi IV No 26', 'Pribadi', 'Pribadi', 'Vinyl', 'Hebel', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Duduk', 'Motor', 'Tanah', 'Ya', 'Ya', '0'),
(104, 12, 'ANISAH', 'Gg. Sinar Pagi IV No 27', 'Warisan', 'Warisan', 'Semen', 'Kayu', 'Tanah Liat', 'PDAM', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Sepeda', 'Tanah', 'Ya', 'Ya', '0'),
(105, 12, 'ANISAH', 'Gg. Sinar Pagi IV No 28', 'Negara', 'Umum', 'Keramik', 'GRC', 'Asbes', 'Sanyo', 'Listrik', 'Tungku', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(106, 12, 'ANITA SEFTIANI', 'Gg. Sinar Pagi IV No 29', 'Pribadi', 'Pribadi', 'Keramik', 'Bata Merah', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(107, 12, 'ANNISA FARDILA SETIAWANTI HAKIM', 'Gg. Sinar Pagi IV No 30', 'Warisan', 'Warisan', 'Teraso', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(108, 12, 'ANTI SURYAWINANTI', 'Gg. Sinar Pagi IV No 31', 'Pribadi', 'Pribadi', 'Keramik', 'Hebel', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Duduk', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(109, 12, 'ANTI WIDIANINGRUM', 'Gg. Sinar Pagi IV No 32', 'Warisan', 'Warisan', 'Teraso', 'Hebel', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(110, 12, 'ANTO', 'Gg. Sinar Pagi IV No 33', 'Negara', 'Umum', 'Vinyl', 'Batako', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(111, 12, 'ANTONIUS TRIRAHARJO', 'Gg. Sinar Pagi IV No 34', 'Pribadi', 'Pribadi', 'Keramik', 'Batako', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(112, 12, 'ANUGRAH BUDI SURYA', 'Gg. Sinar Pagi V No 12', 'Pribadi', 'Pribadi', 'Keramik', 'Bata Merah', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(113, 12, 'APID PERMANA', 'Gg. Sinar Pagi V No 13', 'Warisan', 'Warisan', 'Keramik', 'Bata Merah', 'Seng', 'Sanyo', 'Listrik', 'Gas', 'Kloset Duduk', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(114, 12, 'APRI HANDAYANI', 'Gg. Sinar Pagi V No 14', 'Negara', 'Umum', 'Keramik', 'Hebel', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Duduk', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(115, 12, 'APUDIN', 'Gg. Sinar Pagi V No 15', 'Negara', 'Umum', 'Keramik', 'Hebel', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Duduk', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(116, 12, 'ARDI SUKARDI', 'Gg. Sinar Pagi V No 16', 'Warisan', 'Warisan', 'Semen', 'Bata Merah', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(117, 12, 'ARDIYANTO', 'Gg. Sinar Pagi V No 17', 'Negara', 'Umum', 'Teraso', 'Hebel', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(118, 12, 'ARI KURNIAWAN', 'Gg. Sinar Pagi V No 18', 'Pribadi', 'Pribadi', 'Keramik', 'Bata Merah', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Mobil', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(119, 12, 'ARI SUNANDAR', 'Gg. Sinar Pagi V No 19', 'Warisan', 'Warisan', 'Vinyl', 'Batako', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(120, 12, 'ARIE PERMANA', 'Gg. Sinar Pagi V No 20', 'Negara', 'Umum', 'Keramik', 'Hebel', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Duduk', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(121, 12, 'ARIE WIBOWO', 'Gg. Sinar Pagi V No 21', 'Pribadi', 'Pribadi', 'Vinyl', 'Kayu', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(122, 12, 'ARIEF RAHMAN SANTOSO', 'Gg. Sinar Pagi V No 22', 'Warisan', 'Warisan', 'Keramik', 'GRC', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(123, 12, 'ARIEF RAHMANSYAH', 'Gg. Sinar Pagi V No 23', 'Pribadi', 'Pribadi', 'Semen', 'Batako', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(124, 12, 'ARIES SENTANA', 'Gg. Sinar Pagi V No 24', 'Warisan', 'Warisan', 'Semen', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0');

-- --------------------------------------------------------

--
-- Table structure for table `penerimapkh`
--

CREATE TABLE `penerimapkh` (
  `id_penerima` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `sts_lahan` enum('Pribadi','Warisan','Negara') NOT NULL,
  `sts_bangunan` enum('Pribadi','Warisan','Umum') NOT NULL,
  `jns_lantai` enum('Vinyl','Keramik','Teraso','Semen') NOT NULL,
  `jns_dinding` enum('Hebel','Batako','Bata Merah','GRC','Kayu') NOT NULL,
  `jns_atap` enum('Tanah Liat','Asbes','Seng') NOT NULL,
  `smr_air` enum('PDAM','Sanyo','Sumur') NOT NULL,
  `smr_penerangan` enum('Listrik','Lainnya') NOT NULL,
  `bb_memasak` enum('Gas','Kompor Minyak','Tungku') NOT NULL,
  `jns_kloset` enum('Kloset Duduk','Kloset Jongkok') NOT NULL,
  `jns_kendaraan` enum('Mobil','Motor','Sepeda','Angkutan Umum') NOT NULL,
  `aset_pribadi` enum('Tanah','Sawah','Rumah','Tidak Ada') NOT NULL,
  `tlpn_rumah` enum('Ya','Tidak') NOT NULL,
  `wifi` enum('Ya','Tidak') NOT NULL,
  `statusAwal` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerimapkh`
--

INSERT INTO `penerimapkh` (`id_penerima`, `id_admin`, `nama`, `alamat`, `sts_lahan`, `sts_bangunan`, `jns_lantai`, `jns_dinding`, `jns_atap`, `smr_air`, `smr_penerangan`, `bb_memasak`, `jns_kloset`, `jns_kendaraan`, `aset_pribadi`, `tlpn_rumah`, `wifi`, `statusAwal`) VALUES
(1001, 6, 'Andri', 'Kesambi', 'Pribadi', 'Warisan', 'Keramik', 'Batako', 'Asbes', 'PDAM', 'Listrik', 'Gas', 'Kloset Duduk', 'Sepeda', 'Tanah', 'Tidak', 'Ya', 'Belum Terklasifikasi'),
(1002, 6, 'Lita', 'Kesambi', 'Warisan', 'Umum', 'Vinyl', 'Hebel', 'Asbes', 'Sumur', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Motor', 'Sawah', 'Tidak', 'Tidak', 'Belum Terklasifikasi'),
(1003, 6, 'Bambang', 'Kesambi', 'Pribadi', 'Warisan', 'Semen', 'GRC', 'Seng', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', 'Belum Terklasifikasi'),
(1004, 6, 'Annisa', 'Kesambi', 'Pribadi', 'Umum', 'Keramik', 'Batako', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Duduk', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', 'Belum Terklasifikasi'),
(1005, 6, 'Agung', 'Kesambi', 'Warisan', 'Warisan', 'Semen', 'Kayu', 'Asbes', 'Sumur', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', 'Belum Terklasifikasi'),
(1006, 6, 'Yusuf', 'Kesambi', 'Negara', 'Umum', 'Keramik', 'Batako', 'Seng', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', 'Belum Terklasifikasi'),
(1007, 6, 'Dinda', 'Kesambi', 'Pribadi', 'Warisan', 'Semen', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Mobil', 'Tanah', 'Ya', 'Ya', 'Belum Terklasifikasi'),
(1008, 6, 'Angkasa', 'Kesambi', 'Negara', 'Umum', 'Keramik', 'GRC', 'Asbes', 'Sanyo', 'Listrik', 'Tungku', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', 'Belum Terklasifikasi'),
(1009, 6, 'Wawan', 'Kesambi', 'Negara', 'Pribadi', 'Vinyl', 'Hebel', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Ya', 'Belum Terklasifikasi'),
(1010, 6, 'Firdaus', 'Kesambi', 'Warisan', 'Pribadi', 'Keramik', 'Bata Merah', 'Asbes', 'PDAM', 'Listrik', 'Kompor Minyak', 'Kloset Duduk', 'Angkutan Umum', 'Rumah', 'Ya', 'Ya', '');

-- --------------------------------------------------------

--
-- Table structure for table `validasidata`
--

CREATE TABLE `validasidata` (
  `id_penerima` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `sts_lahan` enum('Pribadi','Warisan','Negara') NOT NULL,
  `sts_bangunan` enum('Pribadi','Warisan','Umum') NOT NULL,
  `jns_lantai` enum('Vinyl','Keramik','Teraso','Semen') NOT NULL,
  `jns_dinding` enum('Hebel','Batako','Bata Merah','GRC','Kayu') NOT NULL,
  `jns_atap` enum('Tanah Liat','Asbes','Seng') NOT NULL,
  `smr_air` enum('PDAM','Sanyo','Sumur') NOT NULL,
  `smr_penerangan` enum('Listrik','Lainnya') NOT NULL,
  `bb_memasak` enum('Gas','Kompor Minyak','Tungku') NOT NULL,
  `jns_kloset` enum('Kloset Duduk','Kloset Jongkok') NOT NULL,
  `jns_kendaraan` enum('Mobil','Motor','Sepeda','Angkutan Umum') NOT NULL,
  `aset_pribadi` enum('Tanah','Sawah','Rumah','Tidak Ada') NOT NULL,
  `tlpn_rumah` enum('Ya','Tidak') NOT NULL,
  `wifi` enum('Ya','Tidak') NOT NULL,
  `statusAwal` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `validasidata`
--

INSERT INTO `validasidata` (`id_penerima`, `id_admin`, `nama`, `alamat`, `sts_lahan`, `sts_bangunan`, `jns_lantai`, `jns_dinding`, `jns_atap`, `smr_air`, `smr_penerangan`, `bb_memasak`, `jns_kloset`, `jns_kendaraan`, `aset_pribadi`, `tlpn_rumah`, `wifi`, `statusAwal`) VALUES
(77, 12, 'AMINAH', 'Gg. Sinar Pagi III No 126', 'Pribadi', 'Umum', 'Keramik', 'Batako', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(78, 12, 'AMING MIRDJA', 'Gg. Sinar Pagi III No 127', 'Warisan', 'Pribadi', 'Keramik', 'Hebel', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(79, 12, 'ANA', 'Gg. Sinar Pagi III No 128', 'Negara', 'Warisan', 'Keramik', 'Kayu', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(80, 12, 'ANA KAEROH', 'Gg. Sinar Pagi III No 129', 'Pribadi', 'Umum', 'Keramik', 'GRC', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(81, 12, 'ANAH', 'Gg. Sinar Pagi III No 130', 'Warisan', 'Pribadi', 'Semen', 'Bata Merah', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(82, 12, 'ANAH', 'Gg. Sinar Pagi III No 131', 'Negara', 'Warisan', 'Semen', 'Bata Merah', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(83, 12, 'ANAH NURHASANAH', 'Gg. Sinar Pagi III No 132', 'Pribadi', 'Umum', 'Keramik', 'Hebel', 'Tanah Liat', 'PDAM', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(84, 12, 'ANANG MAULLANA ISHAQ', 'Gg. Sinar Pagi III No 133', 'Warisan', 'Pribadi', 'Keramik', 'Hebel', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(85, 12, 'ANDI JUPRI', 'Gg. Sinar Pagi III No 134', 'Pribadi', 'Warisan', 'Teraso', 'Batako', 'Asbes', 'Sumur', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Motor', 'Sawah', 'Ya', 'Ya', '0'),
(86, 12, 'ANDI PERMANA', 'Gg. Sinar Pagi III No 135', 'Warisan', 'Pribadi', 'Semen', 'Batako', 'Tanah Liat', 'PDAM', 'Listrik', 'Tungku', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(87, 12, 'ANDI PRAYITNO', 'Gg. Sinar Pagi III No 136', 'Negara', 'Warisan', 'Vinyl', 'Bata Merah', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(88, 12, 'ANDIKA FEBBY PRABOWO', 'Gg. Sinar Pagi III No 137', 'Pribadi', 'Umum', 'Teraso', 'Bata Merah', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(89, 12, 'ANDIKA PRATAMA', 'Gg. Sinar Pagi III No 138', 'Pribadi', 'Pribadi', 'Keramik', 'Hebel', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(90, 12, 'ANDREYANTO', 'Gg. Sinar Pagi III No 139', 'Warisan', 'Warisan', 'Keramik', 'Hebel', 'Seng', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(91, 12, 'ANDRI AFRYTAMA', 'Gg. Sinar Pagi III No 140', 'Negara', 'Umum', 'Teraso', 'Batako', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(92, 12, 'ANDRIATNO', 'Gg. Sinar Pagi III No 141', 'Pribadi', 'Pribadi', 'Semen', 'Batako', 'Asbes', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(93, 12, 'ANDRIYANI', 'Gg. Sinar Pagi III No 142', 'Warisan', 'Warisan', 'Keramik', 'Bata Merah', 'Asbes', 'PDAM', 'Listrik', 'Gas', 'Kloset Duduk', 'Sepeda', 'Tanah', 'Tidak', 'Ya', '0'),
(94, 12, 'ANDRIYANI', 'Gg. Sinar Pagi III No 143', 'Negara', 'Umum', 'Teraso', 'Batako', 'Seng', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(95, 12, 'ANGGA RAHMAN', 'Gg. Sinar Pagi III No 144', 'Pribadi', 'Pribadi', 'Keramik', 'Hebel', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(96, 12, 'ANGGA ROSANDI', 'Gg. Sinar Pagi III No 145', 'Warisan', 'Warisan', 'Semen', 'Kayu', 'Tanah Liat', 'Sanyo', 'Lainnya', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(97, 12, 'ANI NURAENI', 'Gg. Sinar Pagi III No 146', 'Negara', 'Umum', 'Vinyl', 'GRC', 'Tanah Liat', 'Sumur', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(98, 12, 'ANI SUMARNI', 'Gg. Sinar Pagi III No 147', 'Pribadi', 'Pribadi', 'Keramik', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Motor', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(99, 12, 'ANI TRIYANA', 'Gg. Sinar Pagi III No 148', 'Warisan', 'Warisan', 'Vinyl', 'Bata Merah', 'Asbes', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Sepeda', 'Tidak Ada', 'Tidak', 'Tidak', '1'),
(100, 12, 'ANIH', 'Gg. Sinar Pagi IV No 23', 'Negara', 'Umum', 'Keramik', 'Hebel', 'Tanah Liat', 'Sanyo', 'Listrik', 'Gas', 'Kloset Jongkok', 'Angkutan Umum', 'Tidak Ada', 'Tidak', 'Tidak', '0'),
(101, 12, 'ANIRAH', 'Gg. Sinar Pagi IV No 24', 'Warisan', 'Warisan', 'Semen', 'Bata Merah', 'Tanah Liat', 'PDAM', 'Listrik', 'Gas', 'Kloset Jongkok', 'Mobil', 'Tanah', 'Ya', 'Ya', '0'),
(102, 6, 'Anisah', 'Gg. Sinar Pagi IV No 25', 'Negara', 'Umum', 'Semen', 'Batako', 'Tanah Liat', 'Sanyo', 'Listrik', 'Kompor Minyak', 'Kloset Jongkok', 'Angkutan Umum', 'Sawah', 'Ya', 'Ya', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `hasilklasifikasi`
--
ALTER TABLE `hasilklasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`),
  ADD KEY `id_penerima` (`id_penerima`);

--
-- Indexes for table `latihdata`
--
ALTER TABLE `latihdata`
  ADD PRIMARY KEY (`id_penerima`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `penerimapkh`
--
ALTER TABLE `penerimapkh`
  ADD PRIMARY KEY (`id_penerima`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `validasidata`
--
ALTER TABLE `validasidata`
  ADD PRIMARY KEY (`id_penerima`),
  ADD KEY `id_admin` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hasilklasifikasi`
--
ALTER TABLE `hasilklasifikasi`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1426;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasilklasifikasi`
--
ALTER TABLE `hasilklasifikasi`
  ADD CONSTRAINT `hasilklasifikasi_ibfk_1` FOREIGN KEY (`id_penerima`) REFERENCES `penerimapkh` (`id_penerima`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penerimapkh`
--
ALTER TABLE `penerimapkh`
  ADD CONSTRAINT `penerimapkh_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
