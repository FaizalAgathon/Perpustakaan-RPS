<?php 

require 'koneksi.php';

$idBuku = $_POST['idBuku'];

$namaBuku = $_POST['judul'];
$penulisBuku = $_POST['penulis'];
$penerbitBuku = $_POST['penerbit'];
$deskripsiBuku = $_POST['deskripsi'];
$namaFile = $_FILES['gambar']['name'];
$ukuranFile = $_FILES['gambar']['size'];

$rand = rand(1000,9999);
$batasUkuranGambar = 3145728; // KB

if ($ukuranFile < $batasUkuranGambar){		
  $gambarBuku = $rand . '-' . $namaFile;
  move_uploaded_file($_FILES['gambar']['tmp_name'], 'assets/images/'.$gambarBuku);

  $editBuku = mysqli_query($conn,"UPDATE buku SET 
  nama = '$namaBuku',
  deskripsi = '$deskripsiBuku',
  penulis = '$penulisBuku',
  penerbit = '$penerbitBuku',
  gambar = '$gambarBuku'
  WHERE id = $idBuku");

  header("Location:login.php");
}else{
  header("Location:login.php");
}

