<?php 

require 'koneksi.php';

$idBuku = $_POST['idBuku'];

$namaPeminjam = $_POST['nama'];
$kelasPeminjam = $_POST['kelas'];
$kontakPeminjam = $_POST['kontak'];

$namaPeminjam = $namaPeminjam . "-" . rand(100,999);
$kelasPeminjam = strtoupper($kelasPeminjam);
$waktuRT = date('Y-m-d');

mysqli_query($conn,"INSERT INTO pengembalian 
  VALUES (NULL,'$namaPeminjam','$kelasPeminjam','$kontakPeminjam','$idBuku','$waktuRT')");

header("Location:admin.php");

// $idPeminjam = query("SELECT id FROM peminjam WHERE nama = '$namaPeminjam'")[0];

// $idPeminjam = $idPeminjam['id'];

// mysqli_query($conn,"INSERT INTO peminjaman VALUES (NULL,'$idPeminjam','$idBuku','$waktuRT')");

// echo "
//   <script>
//     window.location.href('user.php?berhasil');
//   </script>
// ";

// if (mysqli_num_rows(mysqli_query($link,"SELECT * FROM peminjam")) > 0) {
//   header('user.php?berhasil');
// }

// echo $namaPeminjam . "<br>" . $kelasPeminjam . "<br>" . $kontakPeminjam;
// var_dump(query("SELECT * FROM buku WHERE id = '$idBuku'"));