-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2023 at 02:21 AM
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
-- Database: `perpus_padudung`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Rendi Ramadhan', 'Rendi123'),
(2, 'Kathryn', 'Brain123'),
(3, 'Ramius', 'Sex123');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `penerbit` varchar(50) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `gambar` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `nama`, `deskripsi`, `penerbit`, `penulis`, `gambar`) VALUES
(1, 'PHP Dasar', 'PHP Dasar Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', 'PT Elex Media Komputindo', 'Masashi Kishimoto', 'jessica.png'),
(2, 'HTML Dasar', 'HTML Dasar Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', 'PT Tiga Serangkai', 'Junji Ito', 'kanata1.jpg'),
(3, 'CSS Dasar', 'CSS Dasar Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', 'PT Tiga Serangkai Pustaka Mandiri', 'Masashi Kishimoto', 'mask-girl.jpg'),
(4, 'Laravel Dasar', 'Laravel Dasar Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', '', 'Masashi Kishimoto', 'amiya.jpg'),
(9, 'OOP Dasar', 'OOP Dasar Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', 'PT Elex Media Komputindo', 'Masashi Kishimoto', 'IMG_20220101_170616.jpg'),
(10, 'HTML DASAR', 'lorem ipsum', 'PT ----', 'Faizal Agathon', '8823-79447651_p0_master1200.jpg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `histori`
--

CREATE TABLE `histori` (
  `id_histori` int(11) NOT NULL,
  `nama_histori` varchar(150) NOT NULL,
  `kelas_histori` varchar(20) NOT NULL,
  `kontak_histori` varchar(20) NOT NULL,
  `buku_histori` varchar(200) NOT NULL,
  `waktu_peminjaman` date NOT NULL,
  `waktu_pengembalian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `histori`
--

INSERT INTO `histori` (`id_histori`, `nama_histori`, `kelas_histori`, `kontak_histori`, `buku_histori`, `waktu_peminjaman`, `waktu_pengembalian`) VALUES
(6, 'Rendi Ramadhan', 'xi rpl 2', '08122364364', 'Doujin', '2022-12-14', '2022-12-19'),
(7, 'Ramius Draissen', 'xii rpl 2', '08122364364', 'Hentai', '2022-12-14', '2022-12-20'),
(0, 'Azis', 'xi rpl 2', '', 'HTML Dasar', '2022-12-07', '2022-12-14'),
(0, 'Rendi', 'xi rpl 2', '', 'CSS Dasar', '2022-12-08', '2022-12-14'),
(0, 'Faizal', 'XI RPL 2', '', 'PHP Dasar', '2022-12-12', '0000-00-00'),
(0, '', '', '', '', '0000-00-00', '0000-00-00'),
(0, 'Faizal', 'XI RPL 2', '081914523696', 'PHP Dasar', '2022-12-28', '2022-12-28');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `nama_peminjam` varchar(50) NOT NULL,
  `kelas_peminjam` varchar(10) NOT NULL,
  `kontak_peminjam` varchar(20) NOT NULL,
  `waktu_peminjaman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_buku`, `nama_peminjam`, `kelas_peminjam`, `kontak_peminjam`, `waktu_peminjaman`) VALUES
(1, 3, 'Faizal', 'xi rpl 2', '081914523696', '2022-12-14'),
(2, 3, 'Azis', 'XI RPL 2', '081914523696', '2022-12-07'),
(3, 1, 'Rendi', 'XI RPL 2', '081914523696', '2022-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembali` int(11) NOT NULL,
  `nama_pengembali` varchar(150) NOT NULL,
  `kelas_pengembali` varchar(20) NOT NULL,
  `kontak_pengembali` varchar(20) DEFAULT NULL,
  `id_buku` int(11) NOT NULL,
  `waktu_peminjaman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembali`, `nama_pengembali`, `kelas_pengembali`, `kontak_pengembali`, `id_buku`, `waktu_peminjaman`) VALUES
(8, 'Faizal', 'XI RPL 2', '081914523696', 1, '2022-12-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_peminjaman_buku` (`id_buku`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembali`),
  ADD KEY `fk_buku_peminjam` (`id_buku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_peminjaman_buku` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `fk_buku_peminjam` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
