<?php

require '../koneksi.php';

// cek apakah sudah login belom
if (!(isset($_SESSION['login']))) {
  // redirect (memindahkan user nya ke page lain)
  header("Location: ../login-daftar/login_admin.php");
  exit;
}

// SECTION pagination Peminjaman
$dataPerhalaman = 5;
$jumlahData =  count(query("SELECT * FROM
                            siswa s INNER JOIN
                            kelas k ON s.idKelas = k.idKelas INNER JOIN
                            peminjaman p ON s.idSiswa = p.idSiswa INNER JOIN
                            buku b ON s.idSiswa = p.idSiswa AND p.idBuku = b.id"));

$jumlahHalaman = ceil($jumlahData / $dataPerhalaman);

$halamanAktif = isset($_GET['halamanUser']) ? $_GET['halamanUser'] : 1;

$awalData = ($dataPerhalaman * $halamanAktif) - $dataPerhalaman;


// !SECTION pagination Peminjaman

// SECTION pagination histori
$dataPerhalaman2 = 5;
$jumlahData2 =  count(query("SELECT * FROM
                                histori h INNER JOIN
                                siswa s ON s.idSiswa = h.idSiswa INNER JOIN
                                kelas k ON s.idkelas = k.idKelas INNER JOIN
                                buku b ON h.idBuku = b.id AND s.idSiswa = h.idSiswa"));

$jumlahHalaman2 = ceil($jumlahData2 / $dataPerhalaman2);

$halamanAktif2 = isset($_GET['halamanHistori']) ? $_GET['halamanHistori'] : 1;

$awalData2 = ($dataPerhalaman2 * $halamanAktif2) - $dataPerhalaman2;

// !SECTION pagination histori

// SECTION tampilkan data

$peminjaman = query("SELECT * FROM
                      siswa s INNER JOIN
                      kelas k ON s.idKelas = k.idKelas INNER JOIN
                      peminjaman p ON s.idSiswa = p.idSiswa INNER JOIN
                      buku b ON s.idSiswa = p.idSiswa AND p.idBuku = b.id
                      LIMIT $awalData, $dataPerhalaman");

if (!isset($_SESSION['urut'])) {
  $_SESSION['urut'] = "default";
}

if ($_SESSION['urut'] == "default") {
  $histori = query("SELECT * FROM
                    histori h INNER JOIN
                    siswa s ON s.idSiswa = h.idSiswa INNER JOIN
                    kelas k ON s.idkelas = k.idKelas INNER JOIN
                    buku b ON h.idBuku = b.id AND s.idSiswa = h.idSiswa
                    LIMIT $awalData2, $dataPerhalaman2");
}
// !SECTION tampilkan data

// SECTION cari melalui sort by
if (isset($_POST['pengembalianASC']) || $_SESSION['urut'] == "waktuPengembalianASC") {
  $histori = urutan("waktuPengembalian", "ASC", $awalData2, $dataPerhalaman2);
  $_SESSION['urut'] = "waktuPengembalianASC";
}

if (isset($_POST['pengembalianDESC']) || $_SESSION['urut'] == "waktuPengembalianDESC") {
  $histori = urutan("waktuPengembalian", "DESC", $awalData2, $dataPerhalaman2);
  $_SESSION['urut'] = "waktuPengembalianDESC";
}

if (isset($_POST['peminjamanASC']) || $_SESSION['urut'] == "waktuPeminjamanASC") {
  $histori = urutan("waktuPeminjaman", "ASC", $awalData2, $dataPerhalaman2);
  $_SESSION['urut'] = "waktuPeminjamanASC";
}

if (isset($_POST['peminjamanDESC']) || $_SESSION['urut'] == "waktuPeminjamanDESC") {
  $histori = urutan("waktuPeminjaman", "DESC", $awalData2, $dataPerhalaman2);
  $_SESSION['urut'] = "waktuPeminjamanDESC";
}
// !SECTION cari melalui sort by

// SECTION cari histori melalui search
if (isset($_POST['cari']) || $_SESSION['urut'] == "cari") {

  if (!isset($_SESSION['keyword']) || (isset($_POST['cari']) && isset($_POST['keyword']))) {
    $_SESSION['keyword'] = $_POST['keyword'];
    $keyword = $_POST['keyword'];
  }
  if (!isset($_POST['keyword'])) {
    $_POST['keyword'] = $_SESSION['keyword'];
    $keyword = $_POST['keyword'];
  }

  $dataPerhalaman2 = 5;
  $jumlahData2 =  count(query("SELECT * FROM
                                    histori h INNER JOIN
                                    siswa s ON s.idSiswa = h.idSiswa INNER JOIN
                                    kelas k ON s.idkelas = k.idKelas INNER JOIN
                                    buku b ON h.idBuku = b.id AND s.idSiswa = h.idSiswa
                                    WHERE s.namaSiswa LIKE '%$keyword%' OR 
                                    k.namaKelas LIKE '%$keyword%' OR
                                    b.nama LIKE '%$keyword%'
                                    LIMIT $awalData2, $dataPerhalaman2"));

  $jumlahHalaman2 = ceil($jumlahData / $dataPerhalaman);

  $histori = cari($keyword, $awalData2, $dataPerhalaman2);
  $_SESSION['urut'] = "cari";
}
// !SECTION cari histori melalui search

// var_dump($_SESSION['urut']);

$batasPengembalian = 7;


// cek apa kah sudah login atau belom
if (!(isset($_SESSION['login']))) {
  // redirect (memindahkan user nya ke page lain)
  header("Location: ../login-daftar/login_admin.php");
  exit;
}


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Peminjam</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/stylePeminjam.css">
</head>

<body>

  <?php include 'header-menu-admin.php'; ?>

  <!-- AWAL TABEL -->
  <div class="container mt-4">
    <br>
    <!-- SECTION AWAL TABEL PEMINJAM -->

    
    <!-- SECTION Table Peminjaman -->
    
    <!-- AWAL TABEL -->
    <div class="container mt-4">
      <br>
      <!-- AWAL TABEL PEMINJAM -->
      <h5 class="fw-bold text-white text-center">Daftar Peminjam :</h5>
      <!-- SECTION pagination peminjaman-->
      <div aria-label="Page navigation example">
        <ul class="pagination">
          <?php if ($halamanAktif > 1) : ?>
            <li class="page-item"><a class="page-link" href="?halamanUser=<?= $halamanAktif - 1 ?>">Previous</a></li>
          <?php endif; ?>
  
          <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
              <li class="page-item active"><a class="page-link" href="?halamanUser=<?= $i ?>"><?= $i ?></a></li>
            <?php else : ?>
              <li class="page-item"><a class="page-link" href="?halamanUser=<?= $i ?>"><?= $i ?></a></li>
            <?php endif; ?>
          <?php endfor; ?>
  
          <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <li class="page-item"><a class="page-link" href="?halamanUser=<?= $halamanAktif + 1 ?>">Next</a></li>
          <?php endif; ?>
        </ul>
      </div>
      <!-- !SECTION pagination peminjaman-->
      <table class="table table-light table-striped">
        <tr class="text-center">
          <th>No</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Kontak</th>
          <th>Buku</th>
          <th>Waktu</th>
          <th>Batas Waktu</th>
          <th>Aksi</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($peminjaman as $data) : ?>
          <tr class="text-center">
            <td><?= $i; ?></td>
            <td><?= $data["namaSiswa"]; ?></td>
            <td><?= strtoupper($data["namaKelas"]); ?></td>

            <td>
              <a href="" class="kontak">

              </a>
            </td>


            <td><?= $data["nama"]; ?></td>
            <td><?= $data["waktuPeminjaman"]; ?></td>
            <td><?= bataswaktu(strtotime($data["waktuPeminjaman"]), $batasPengembalian); ?></td>
            <td>
              <a href="kembalikan_data_pengembalian.php?id=<?= $data['idPeminjaman']; ?>&waktupeminjaman=<?= $data['waktuPeminjaman']; ?>&param=admin" onclick="return confirm('Yakin ingin mengebalikan buku?')">

                <img src="../icon/left-arrow.png" width="30rem" alt="">
              </a>
            </td>
          </tr>

          <?php $i++; ?>
        <?php endforeach; ?>

        <?php if ($i == 1) : ?>
          <tr>
            <td colspan="8" align="center"> Tidak ada Yang Meminjam buku</td>
          </tr>
        <?php endif; ?>

      </table>
      <!-- !SECTION Table Peminjaman -->


      <!-- !SECTION AKHIR TABEL PEMINJAM -->
      <br>
      <!-- SECTION AWAL TABEL HISTORY -->
      <h5 class="fw-bold text-white text-center">History :</h5>

      <br>

      <!-- SECTION Cari -->
      <form action="" method="post" style="float: left;">
        <input type="text" name="keyword">
        <button type="submit" name="cari">Cari!</button>
      </form>
      <!-- !SECTION Cari -->


      <!-- pagination -->

      <div class="btn-group dropstart mb-2 mt-0" style="float: right;">

        <button type="button" class="dropdown-toggle border-0 bg-transparent fw-semibold" data-bs-toggle="dropdown" aria-expanded="false">
          Sort By
        </button>
        <ul class="dropdown-menu text rounded-4">
          <li class="">

            <form action="" method="post">
              <button class="dropdown-item" type="submit" name="pengembalianASC">Waktu Pengembalian ASC</button>
            </form>
          </li>
          <li>
            <form action="" method="post">
              <button class="dropdown-item" type="submit" name="pengembalianDESC">Waktu Pengembalian DESC</button>
            </form>
          </li>
          <li>
            <form action="" method="post">
              <button class="dropdown-item" type="submit" name="peminjamanASC">Waktu Peminjaman ASC</button>
            </form>
          </li>
          <li>
            <form action="" method="post">
              <button class="dropdown-item" type="submit" name="peminjamanDESC">Waktu Peminjaman DESC</button>
            </form>
          </li>
        </ul>
      </div>
      <table class="table table-light table-striped">
        <tr class="text-center">
          <th>No</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Kontak</th>
          <th>Buku</th>
          <th>Waktu Peminjaman</th>
          <th>Waktu Pengembalian</th>
        </tr>


        <?php $j = 1 ?>
        <?php foreach ($histori as $data2) : ?>
          <tr class="text-center">
            <td><?= $j; ?></td>
            <td><?= $data2['namaSiswa']; ?></td>
            <td><?= strtoupper($data2['namaKelas']); ?></td>
            <td><a href="https://api.whatsapp.com/<?php $data2["kontakSiswa"]; ?>" class="kontak"><?= $data2['kontakSiswa']; ?></td>
            <td><?= $data2['nama']; ?></td>
            <td><?= $data2['waktuPeminjaman']; ?></td>
            <td><?= $data2['waktuPengembalian']; ?></td>
          </tr>
          <?php $j++; ?>
        <?php endforeach; ?>

        <?php if ($j == 1) : ?>
          <tr>
            <td colspan="8" align="center"> Tidak ada Histori yang tersedia</td>
          </tr>
        <?php endif; ?>

      </table>

      <!-- SECTION pagination histori -->
      <div aria-label="Page navigation example">
        <ul class="pagination">
          <?php if ($halamanAktif2 > 1) : ?>
            <li class="page-item"><a class="page-link" href="?halamanHistori=<?= $halamanAktif2 - 1 ?>">Previous</a></li>
          <?php endif; ?>

          <?php for ($j = 1; $j <= $jumlahHalaman2; $j++) : ?>
            <?php if ($j == $halamanAktif2) : ?>
              <li class="page-item active"><a class="page-link" href="?halamanHistori=<?= $j ?>"><?= $j ?></a></li>
            <?php else : ?>
              <li class="page-item"><a class="page-link" href="?halamanHistori=<?= $j ?>"><?= $j ?></a></li>
            <?php endif; ?>
          <?php endfor; ?>

          <?php if ($halamanAktif2 < $jumlahHalaman2) : ?>
            <li class="page-item"><a class="page-link" href="?halamanHistori=<?= $halamanAktif2 + 1 ?>">Next</a></li>
          <?php endif; ?>
        </ul>
      </div>
      <!-- !SECTION pagination histori -->


      <!-- !SECTION AKHIR TABEL HISTORY -->

    </div>
    <!-- AKHIR TABEL -->
    <!-- AWAL FOOTER -->
    <div class="bg-dark mt-3 p-1 pt-2 w-100" id="footer" style="margin-bottom: -2rem;">
      <footer class="main-footer mt-3" style="padding-top: 10px;">
        <div class="text-center">
          <a href="http://smkn1-cirebon.sch.id" class="txt2 hov1 text-decoration-none text-white nav-link disabled" target="_blank">
            © 2022 SMK Negeri 1 Cirebon
          </a>
        </div>
      </footer>

      <p class="text-center text-white"><small>- Support By XI RPL 2 -</small></p>
    </div>
    <!-- AKHIR FOOTER -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>