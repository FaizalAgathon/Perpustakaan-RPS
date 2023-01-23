-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2023 at 07:34 AM
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
(3, 'Ramius', 'Draissen');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tglTerbit` date NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `gambar` varchar(35) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `jumlah_dipinjam` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `nama`, `deskripsi`, `tglTerbit`, `penerbit`, `penulis`, `gambar`, `jumlah`, `jumlah_dipinjam`) VALUES
(1, 'PHP dan Laravel', 'PHP dan Laravel Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', '2023-01-02', 'PT Elex Media Komputindo', 'Eichiro Oda', 'ppNoImg.png', -1, 12),
(3, 'CSS Dasar', 'CSS Dasar Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', '2023-01-01', 'PT Tiga Serangkai Pustaka Mandiri', 'Masashi Kishimoto', '6829-ppNoImg.png', 4, 10),
(4, 'Laravel Dasar', 'Laravel Dasar Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', '2023-01-01', '', 'Masashi Kishimoto', '9753-ppNoImg.png', 2, 12),
(11, 'C++', 'C++ Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', '2023-01-01', 'PT ~~~~~~', 'Faizal Agathon', '4888-ppNoImg.png', 3, 9),
(13, 'HTML DASAR', 'HTML Dasar Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', '2023-01-01', 'PT ~~~~~~', 'Faizal Agathon', '4735-ppNoImg.png', 3, 9),
(14, 'Laravel 9', 'Laravel 9 Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', '2023-01-01', 'PT ~~~~~~', 'Faizal Agathon', '7611-ppNoImg.png', 3, 9),
(15, 'Java', 'Java Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', '2023-01-01', 'PT ~~~~~~', 'Faizal Agathon', 'ppNoImg.png', 3, 3),
(17, 'Python', 'Python Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', '2023-01-01', 'PT ----', 'Faizal Agathon', 'ppNoImg.png', 3, 3),
(18, 'C#', 'C# Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore similique sed dolore pariatur aliquid magnam nesciunt iusto, aliquam dolores ea nihil nulla nisi tenetur delectus soluta! Temporibus consequuntur ab sit!', '2017-01-01', 'PT ~~~~~~', 'Faizal Agathon', 'ppNoImg.png', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `isi` varchar(500) NOT NULL,
  `tglDibuat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `isi`, `tglDibuat`) VALUES
(1, 'sfsafsafawfaefasfsadsdfawefasfsarttjmrijiogikgnngnsidng', '0000-00-00'),
(2, 'Percobaan 2', '0000-00-00'),
(3, 'Percobaan 3', '2023-01-22'),
(4, 'Percobaan 4', '2023-01-22'),
(5, 'wffsfsfasfsafasf22335532534646', '2023-01-22'),
(6, '34535323253453523523534535', '2023-01-22'),
(7, 'Percobaan 5 melalui home', '2023-01-23'),
(8, 'Percobaan 5 melalui home', '2023-01-23'),
(13, 'Percobaan 6 home', '2023-01-23'),
(14, 'Percobaan 6 home', '2023-01-23'),
(17, 'Percobaan 7 home', '2023-01-23'),
(18, 'Percobaan 7 home', '2023-01-23'),
(25, 'Percobaan 8', '2023-01-23'),
(27, 'Percobaan 9', '2023-01-23'),
(28, 'Percobaan 10 peminjaman', '2023-01-23'),
(29, 'Percobaan 11 peminjaman', '2023-01-23'),
(30, 'Percobaan 12 peminjaman', '2023-01-23'),
(31, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam impedit pariatur incidunt consectetur, ut quas est. Doloremque eum quia voluptatem saepe, nulla necessitatibus assumenda quos fugiat dolores error. Facilis, laborum.', '2023-01-23'),
(32, '2 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam impedit pariatur incidunt consectetur, ut quas est. Doloremque eum quia voluptatem saepe, nulla necessitatibus assumenda quos fugiat dolores error. Facilis, laborum.', '2023-01-23'),
(33, '3 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam impedit pariatur incidunt consectetur, ut quas est. Doloremque eum quia voluptatem saepe, nulla necessitatibus assumenda quos fugiat dolores error. Facilis, laborum.', '2023-01-23'),
(34, '3 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam impedit pariatur incidunt consectetur, ut quas est. Doloremque eum quia voluptatem saepe, nulla necessitatibus assumenda quos fugiat dolores error. Facilis, laborum.', '2023-01-23'),
(35, '4 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam impedit pariatur incidunt consectetur, ut quas est. Doloremque eum quia voluptatem saepe, nulla necessitatibus assumenda quos fugiat dolores error. Facilis, laborum.', '2023-01-23');

-- --------------------------------------------------------

--
-- Table structure for table `histori`
--

CREATE TABLE `histori` (
  `idPengembalian` int(11) NOT NULL,
  `idSiswa` int(11) NOT NULL,
  `idBuku` int(11) NOT NULL,
  `waktuPeminjaman` date NOT NULL,
  `waktuPengembalian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `histori`
--

INSERT INTO `histori` (`idPengembalian`, `idSiswa`, `idBuku`, `waktuPeminjaman`, `waktuPengembalian`) VALUES
(1, 3, 3, '2023-01-06', '2023-01-13'),
(2, 1, 1, '2023-01-05', '2023-01-13'),
(3, 1, 4, '0000-00-00', '0000-00-00'),
(4, 4, 1, '2023-01-16', '2023-01-16'),
(5, 2, 3, '2023-01-16', '2023-01-16'),
(6, 1, 4, '2023-01-16', '2023-01-16'),
(7, 1, 1, '2023-01-17', '2023-01-17'),
(8, 1, 1, '2023-01-17', '2023-01-17'),
(9, 1, 1, '2023-01-17', '2023-01-17'),
(10, 1, 1, '2023-01-17', '2023-01-17'),
(11, 1, 1, '2023-01-01', '2023-01-17'),
(12, 2, 13, '2023-01-14', '2023-01-18'),
(13, 26, 4, '2023-01-18', '2023-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `idKelas` int(11) NOT NULL,
  `namaKelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`idKelas`, `namaKelas`) VALUES
(1, 'XI RPL 2'),
(3, 'XI RPL 1'),
(4, 'X PPLG 1');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `idPeminjaman` int(11) NOT NULL,
  `idSiswa` int(11) NOT NULL,
  `idBuku` int(11) DEFAULT NULL,
  `waktuPeminjaman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`idPeminjaman`, `idSiswa`, `idBuku`, `waktuPeminjaman`) VALUES
(18, 3, 11, '2023-01-17'),
(21, 1, 4, '2023-01-17'),
(22, 1, 18, '2023-01-17'),
(23, 21, 1, '2023-01-18'),
(24, 24, 4, '2023-01-18'),
(25, 26, 3, '2023-01-18'),
(30, 29, 18, '2023-01-18'),
(31, 21, 13, '2023-01-18'),
(32, 21, 18, '2023-01-18'),
(33, 33, 18, '2023-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `idQuotes` int(11) NOT NULL,
  `isiQuotes` text NOT NULL,
  `kutipanQuotes` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `idSiswa` int(11) NOT NULL,
  `idKelas` int(11) NOT NULL,
  `namaSiswa` varchar(100) NOT NULL,
  `kontakSiswa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`idSiswa`, `idKelas`, `namaSiswa`, `kontakSiswa`) VALUES
(1, 1, 'Faizal Agathon', '081914523696'),
(2, 1, 'Rendi Ramadhan', '098623582436'),
(3, 1, 'Azis', '0696746564'),
(4, 3, 'Chandra', '097865433'),
(5, 3, 'Mohamad Faizal Agathon', '0987654345678'),
(6, 3, 'Mohamad Faizal Agathon', '0987654345678'),
(7, 3, 'Mohamad Faizal Agathon', '0987654345678'),
(8, 3, 'Mohamad Faizal Agathon', '0987654345678'),
(9, 4, 'Mohamad Faizal Agathon', '0876545435'),
(10, 4, 'Mohamad Faizal Agathon', '0876545435'),
(11, 4, 'Mohamad Faizal Agathon', '0876545435'),
(12, 4, 'Mohamad Faizal Agathon', '0876545435'),
(13, 4, 'Mohamad Faizal Agathon', '0876545435'),
(14, 4, 'Mohamad Faizal Agathon', '0876545435'),
(15, 4, 'Mohamad Faizal Agathon', '0876545435'),
(16, 4, 'Mohamad Faizal Agathon', '0876545435'),
(17, 4, 'Mohamad Faizal Agathon', '0876545435'),
(18, 4, 'Mohamad Faizal Agathon', '0876545435'),
(19, 4, 'Mohamad Faizal Agathon', '0876545435'),
(20, 4, 'Mohamad Faizal Agathon', '0876545435'),
(21, 1, 'Mohamad Faizal Agathon', '0876545435'),
(22, 1, 'Mohamad Faizal Agathon', '0876545435'),
(23, 1, 'Mohamad Faizal Agathon', '0876545435'),
(24, 1, 'womp5', '09876543245678'),
(25, 1, 'womp5', '09876543245678'),
(26, 3, 'womp5', '09876543245678'),
(27, 3, 'womp5', '09876543245678'),
(28, 1, 'womp10', '07854243534'),
(29, 3, 'MUHAMMAD HADI NUGRAHA', '0657356234536457'),
(30, 3, 'MUHAMMAD HADI NUGRAHA', '0657356234536457'),
(31, 3, 'womp3534', '07867345353465'),
(32, 3, 'womp3534', '07867345353465'),
(33, 1, 'Rendi', '08191452'),
(34, 1, 'Rendi', '08191452'),
(35, 1, 'Rendi', '08191452'),
(36, 1, 'Rendi', '08191452'),
(37, 1, 'Rendi', '08191452'),
(38, 1, 'Rendi', '08191452'),
(39, 1, 'M Faizal', '081914523696'),
(41, 1, 'Mohamad Faizal Agathon', '0876545435'),
(42, 1, 'Rendi', '08191452'),
(43, 1, 'Rendi', '08191452'),
(44, 1, 'Rendi', '08191452'),
(45, 1, 'Rendi', '08191452'),
(46, 1, 'Mohamad Faizal Agathon', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histori`
--
ALTER TABLE `histori`
  ADD PRIMARY KEY (`idPengembalian`),
  ADD KEY `fk_histori_siswa` (`idSiswa`),
  ADD KEY `fk_histori_buku` (`idBuku`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`idKelas`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`idPeminjaman`),
  ADD KEY `fk_peminjaman_siswa` (`idSiswa`),
  ADD KEY `fk_peminjaman_buku` (`idBuku`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`idQuotes`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`idSiswa`),
  ADD KEY `fk_siswa_kelas` (`idKelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `histori`
--
ALTER TABLE `histori`
  MODIFY `idPengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `idKelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `idPeminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `idQuotes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `idSiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `histori`
--
ALTER TABLE `histori`
  ADD CONSTRAINT `fk_histori_buku` FOREIGN KEY (`idBuku`) REFERENCES `buku` (`id`),
  ADD CONSTRAINT `fk_histori_siswa` FOREIGN KEY (`idSiswa`) REFERENCES `siswa` (`idSiswa`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_peminjaman_buku` FOREIGN KEY (`idBuku`) REFERENCES `buku` (`id`),
  ADD CONSTRAINT `fk_peminjaman_siswa` FOREIGN KEY (`idSiswa`) REFERENCES `siswa` (`idSiswa`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_siswa_kelas` FOREIGN KEY (`idKelas`) REFERENCES `kelas` (`idKelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
