-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Des 2022 pada 15.00
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Rendi Ramadhan', 'Rendi123'),
(2, 'Kathryn', 'Brain123'),
(3, 'Ramius', 'Sex123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `genre` int(11) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `gambar` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `nama`, `deskripsi`, `genre`, `penerbit`, `penulis`, `gambar`) VALUES
(1, 'PHP Dasar', NULL, 0, 'PT Elex Media Komputindo', 'Masashi Kishimoto', 'jessica.png'),
(2, 'HTML Dasar', NULL, 0, 'PT Tiga Serangkai', 'Junji Ito', 'kanata1.jpg'),
(3, 'CSS Dasar', NULL, 0, 'PT Tiga Serangkai Pustaka Mandiri', 'Masashi Kishimoto', 'mask-girl.jpg'),
(4, 'Laravel Dasar', NULL, 0, '', 'Masashi Kishimoto', 'amiya.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori`
--

CREATE TABLE `histori` (
  `id_histori` int(11) NOT NULL,
  `nama_histori` varchar(150) NOT NULL,
  `kelas_histori` varchar(20) NOT NULL,
  `kontak_histori` varchar(20) NOT NULL,
  `buku_histori` varchar(200) NOT NULL,
  `waktu_peminjaman` date NOT NULL,
  `waktu_pengembalian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjam`
--

CREATE TABLE `peminjam` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `kontak` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjam`
--

INSERT INTO `peminjam` (`id`, `nama`, `kelas`, `kontak`) VALUES
(1, 'Faizal', 'xi rpl 2', '081914523696'),
(2, 'Azis', 'xi rpl 2', '081914523696'),
(3, 'Rendi', 'xi rpl 2', '081914523696'),
(4, 'Amiya', 'xii TKJ 1', ''),
(5, 'Kal\'tsit', 'x PPLG 1', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjam` int(11) NOT NULL,
  `nama_peminjam` varchar(150) NOT NULL,
  `kelas_peminjam` varchar(20) NOT NULL,
  `kontak_peminjam` varchar(20) DEFAULT NULL,
  `buku_peminjam` varchar(200) NOT NULL,
  `waktu_peminjaman` date NOT NULL,
  `penerbit_buku` varchar(150) DEFAULT NULL,
  `penulis_buku` varchar(150) DEFAULT NULL,
  `gambar_buku` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjam`, `nama_peminjam`, `kelas_peminjam`, `kontak_peminjam`, `buku_peminjam`, `waktu_peminjaman`, `penerbit_buku`, `penulis_buku`, `gambar_buku`) VALUES
(1, 'Faizal', 'xi rpl 2', '081914523696', 'PHP Dasar', '2022-12-14', 'PT Elex Media Komputindo', 'Masashi Kishimoto', 'jessica.png'),
(2, 'Azis', 'xi rpl 2', '081914523696', 'HTML Dasar', '2022-12-07', 'PT Tiga Serangkai', 'Junji Ito', 'kanata1.jpg'),
(3, 'Rendi', 'xi rpl 2', '081914523696', 'CSS Dasar', '2022-12-08', 'PT Tiga Serangkai Pustaka Mandiri', 'Masashi Kishimoto', 'mask-girl.jpg'),
(4, 'Amiya', 'xii TKJ 1', '', 'Laravel Dasar', '2022-12-10', '', 'Masashi Kishimoto', 'amiya.jpg'),
(5, 'Kal\'tsit', 'x PPLG 1', '', 'HTML Dasar', '2022-12-14', '', 'Junji Ito', 'kaltsit.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembali` int(11) NOT NULL,
  `nama_pengembali` varchar(150) NOT NULL,
  `kelas_pengembali` varchar(20) NOT NULL,
  `kontak_pengembali` varchar(20) DEFAULT NULL,
  `buku_pengembali` varchar(200) NOT NULL,
  `waktu_peminjaman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `histori`
--
ALTER TABLE `histori`
  ADD PRIMARY KEY (`id_histori`);

--
-- Indeks untuk tabel `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjam`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembali`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `histori`
--
ALTER TABLE `histori`
  MODIFY `id_histori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
