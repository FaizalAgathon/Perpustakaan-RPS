<?php
    require 'koneksi.php';
    
    //Menentukan baris pada table
    $idpengembali = $_GET['id'];
    $waktuPeminjaman = $_GET['waktupeminjaman'];
    $waktuPengembalian = date("Y-m-d");

// Mengambil Data
$pengembalian = query("SELECT 
                      -- s.idSiswa, s.namaSiswa, k.namaKelas, s.kontakSiswa, b.nama, p.waktuPeminjaman
                      *
                      FROM
                      siswa s INNER JOIN
                      kelas k ON s.idKelas = k.idKelas INNER JOIN
                      peminjaman p ON s.idSiswa = p.idSiswa INNER JOIN
                      buku b ON s.idSiswa = p.idSiswa 
                      AND p.idBuku = b.id WHERE idPeminjaman = $idpengembali")[0];

    mysqli_query($conn,"INSERT INTO histori VALUES ( '', '$pengembalian[idSiswa]', '$pengembalian[idBuku]', '$waktuPeminjaman', '$waktuPengembalian')" );

    mysqli_query($conn,"DELETE FROM peminjaman WHERE idPeminjaman = $idpengembali");

    header("Location: admin.php");

?>