<?php 

require 'koneksi.php';

$idBuku = $_POST['idBuku'];

$namaPeminjam = $_POST['nama'];
$kelasPeminjam = $_POST['kelas'];
$kontakPeminjam = $_POST['kontak'];

// var_dump($namaPeminjam); echo '<br>';
// var_dump($kelasPeminjam); echo '<br>';
// var_dump($kontakPeminjam); echo '<br>';

$idKelas = query("SELECT idKelas FROM kelas WHERE namaKelas = '$kelasPeminjam'")[0];
$idSiswa = query("SELECT idSiswa FROM siswa 
  WHERE idKelas = $idKelas[idKelas] AND 
  namaSiswa = '$namaPeminjam' AND 
  kontakSiswa = '$kontakPeminjam'")[0];

// var_dump($idKelas);
// echo '<br>';
// var_dump($idSiswa);

// $namaPeminjam = $namaPeminjam . "-" . rand(100,999);
// $kelasPeminjam = strtoupper($kelasPeminjam);
$waktuRT = date('Y-m-d');

$peminjaman = mysqli_query($conn,"INSERT INTO peminjaman 
  VALUES (NULL,'$idSiswa[idSiswa]','$idBuku','$waktuRT')")[0];

if ( $peminjaman ){
  $buku = query("SELECT * FROM buku WHERE id = $idBuku")[0];
  $jumlahBuku = $buku['jumlah'] - 1;
  mysqli_query($conn,"UPDATE buku SET jumlah = $jumlahBuku
    WHERE id = $idBuku");
  mysqli_query($conn,"UPDATE buku SET jumlah_dipinjam = $buku[jumlah_dipinjam] + 1
    WHERE id = $idBuku");
}

header("Location:index.php");
// if ( isset($_POST['peminjamanUser']) ){
// } else if ( isset($_POST['peminjamanAdmin']) ){
//   header("Location:admin.php");
// }

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