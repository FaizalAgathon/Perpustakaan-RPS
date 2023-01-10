<?php 

require 'koneksi.php';

$namaBuku = $_POST['judul'];
$deskripsiBuku = $_POST['deskripsi'];
$penerbitBuku = $_POST['penerbit'];
$penulisBuku = $_POST['penulis'];

// $format =  array('png','jpg','jpeg','gif','JPG','PNG','JPEG','GIF');
$namaFile = $_FILES['gambar']['name'];
$ukuranFile = $_FILES['gambar']['size'];
// $ext = pathinfo($namaFile, PATHINFO_EXTENSION);

$rand = rand(1000,9999);
$batasUkuranGambar = 3145728; // KB

if ($ukuranFile < $batasUkuranGambar){		
  $gambarBuku = $rand . '-' . $namaFile;
  move_uploaded_file($_FILES['gambar']['tmp_name'], 'assets/images/'.$gambarBuku);
  $sqlTambah = "INSERT INTO buku
    VALUES ('','$namaBuku','$deskripsiBuku','$penerbitBuku','$penulisBuku','$gambarBuku')";
  mysqli_query($conn,$sqlTambah);
  echo 
  "<script>
    window.location.href = 'login.php?berhasil'
  </script>";
}else{
  echo 
  "<script>
    window.location.href = 'login.php?gagal'
  </script>";
}
