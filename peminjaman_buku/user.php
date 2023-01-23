<?php

require "koneksi.php";

if ( isset($_POST['login']) ) :
  $siswaNama = $_POST['nama'];
  $siswaKelas = $_POST['kelas'];
  $siswaKontak = $_POST['kontak'];
  $siswaKontak = strval($siswaKontak);

  $daftarSiswa = query("SELECT * FROM siswa s INNER JOIN
    kelas k ON s.idKelas = k.idKelas 
    WHERE namaSiswa = '$siswaNama' AND
    namaKelas = '$siswaKelas' AND 
    kontakSiswa = '$siswaKontak'")[0];


// $daftarKelas = query("SELECT * FROM kelas WHERE namaKelas = '$siswaKelas'")[0];

// mysqli_query($conn,"INSERT INTO siswa VALUES (NULL,$daftarKelas[idKelas],'$siswaNama','$siswaKontak')");

// var_dump($daftarKelas);


// var_dump($daftarSiswa);

//Mengambil Data
$peminjaman = query("SELECT 
                      -- s.idSiswa, s.namaSiswa, k.namaKelas, s.kontakSiswa, b.nama, p.waktuPeminjaman
                      *
                      FROM
                      siswa s INNER JOIN
                      kelas k ON s.idKelas = k.idKelas INNER JOIN
                      peminjaman p ON s.idSiswa = p.idSiswa INNER JOIN
                      buku b ON s.idSiswa = p.idSiswa AND p.idBuku = b.id
                      ORDER BY waktuPeminjaman ASC");

// $histori = query( "SELECT *
//                     FROM
//                     histori h INNER JOIN
//                     siswa s ON s.idSiswa = h.idSiswa INNER JOIN
//                     kelas k ON s.idkelas = k.idKelas INNER JOIN
//                     buku b ON h.idBuku = b.id AND s.idSiswa = h.idSiswa
//                     ORDER BY waktuPeminjaman DESC" );

$batasPengembalian = 7;

// if (!(isset($_SESSION['login']))) {
  // redirect (memindahkan user nya ke page lain)
//   header("Location: login.php");
//   exit;

// }

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Peminjaman</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <ul class="nav nav-tabs my-3 border-dark" id="myTab" role="tablist">
    <li class="nav-item mt-3 menu1" role="presentation">
      <button class="nav-link active bg-light w-100 fw-bold tombol1 border-dark" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Daftar Buku</button>
    </li>
    <li class="nav-item mt-3 menu31 position-relative">
      <div class="menu32">
        <img src="assets/images/SMKN 1 Cirebon.png" alt="" class="menu3 position-absolute top-50 start-50 translate-middle bg-light rounded-circle p-2 border border-dark">
      </div>
    </li>
    <li class="nav-item mt-3 menu2" role="presentation">
      <button class="nav-link bg-light w-100 fw-bold border-dark" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Daftar Peminjam</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active mx-3 py-0 tab1" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
      <button class="btn btn-warning rounded-pill px-5">
        <a href="index.php" style="text-decoration: none;" class="text-white fw-bold">Keluar</a>
      </button>
      <div class="row p-1">
        <h2 class="fw-bold text-white m-auto mt-2 pb-1 judul">Peminjaman Buku</h2>
        <form class="d-flex input-group justify-content-center" role="search">
          <input class="form-control border-info mt-2 rounded-end rounded-pill w-75" type="search" placeholder="Search" aria-label="Search" id="inputCari">
          <button class="btn btn-primary mt-2 ms-1 rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#tambah-buku">+Tambah Buku</button>
        </form>

        <div class="col-12 col-md-8 mb-3 mt-4">
          <!-- DAFTAR BUKU -->
          <ul class="list-buku list-group" id="list">
            <?php foreach (query("SELECT * FROM buku") as $buku) : ?>

              <li class="list-buku-item list-group-item bg-light">
                <div class="row g-1">
                  <div class="col-md-3">
                    <img src="assets/images/<?= $buku['gambar'] ?>" class="img-fluid" width="140rem" alt="...">
                  </div>
                  <div class="col-md-6 w-75">
                    <div class="card-body">
                      <h5 class="card-title "><?= $buku['nama'] ?></h5>
                      <p class="fw-light fs-6 mb-0"><?= $buku['deskripsi'] ?></p>
                      <!-- BUTTON -->
                      <div class="d-flex input-group mt-2">
                        <button class="btn btn-outline-primary btn-sm w-50 rounded-end rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#buku<?= $buku['id'] ?>">Detail</button>
                        <button class="btn btn-outline-primary btn-sm w-50 rounded-start rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#pinjam<?= $buku['id'] ?>">Pinjam Buku</button>
                      </div>
                      <!-- SECTION POP UP DETAIL -->
                      <div class="modal fade" id="buku<?= $buku['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header border-0 text-white" style="background: linear-gradient(120deg,#4433ff,#00ffff);">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Detail <?= $buku['nama'] ?></h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row g-2">
                                <div class="col-md-4">
                                  <img src="assets/images/<?= $buku['gambar'] ?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                  <div class="card-body">
                                    <h5>Judul : <?= $buku['nama'] ?></h5>

                                    <h6>Pengarang : Fuse Sensei</h6>
                                    <h6>Penulis : <?= $buku['penulis'] ?></h6>
                                    <h6>Penerbit : <?= $buku['penerbit'] ?></h6>
                                    <h6>Tanggal terbit : <?= $buku['tglTerbit'] ?></h6>
                                    <h6>Tersedia : <?= $buku['jumlah'] ?> Buku</h6>
                                  </div>
                                </div>
                                <hr>
                                <h6 class="fw-bold">Sinopsis :</h6>
                                <p><?= $buku['deskripsi'] ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- !SECTION POP UP DETAIL -->
                      <!-- SECTION POP UP PEMINJAMAN -->
                      <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="pinjam<?= $buku['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header border-0" style="background: linear-gradient(120deg,#4433ff,#00ffff);">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Peminjaman Buku <?= $buku['nama'] ?> </h1>
                              <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="peminjaman.php" method="POST">
                                <div class="mb-3">
                                  <p for="nama" class="form-label">
                                    Nama : 
                                    <span id="nama">
                                      <?= $daftarSiswa['namaSiswa'] ?>
                                    </span>
                                  </p>
                                  <input type="hidden" name="nama" value="<?= $daftarSiswa['namaSiswa'] ?>">
                                </div>
                                <div class="mb-3">
                                  <p for="kontak" class="form-label">
                                    Kontak : 
                                    <span id="kontak">
                                      <?= $daftarSiswa['kontakSiswa'] ?>
                                    </span>
                                  </p>
                                  <input type="hidden" name="kontak" value="<?= $daftarSiswa['kontakSiswa'] ?>">
                                </div>
                                <div class="mb-3">
                                  <p for="kelas" class="form-label">
                                    Kelas : 
                                    <span id="kelas">
                                      <?= $daftarSiswa['namaKelas'] ?>
                                    </span>
                                  </p>
                                  <input type="hidden" name="kelas" value="<?= $daftarSiswa['namaKelas'] ?>">
                                </div>
                                <div class="mb-3 border p-2">
                                  <h5>Tata Tertib :</h5>
                                  <ol class="text-danger">
                                    <li>Lorem ipsum dolor sit amet.</li>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                  </ol>
                                </div>
                                <input type="hidden" name="idBuku" value="<?= $buku['id'] ?>">
                                <button type="reset" class="btn btn-outline-danger">Cancel</button>
                                <button type="submit" class="btn btn-outline-primary" name="peminjamanUser">Submit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- !SECTION POP UP PEMINJAMAN -->
                    </div>
                  </div>
                </div>
              </li>

            <?php endforeach; ?>
          </ul>
        </div>
        <div class="col-12 col-md-4 mt-4">
          <div class="mt-0 mb-3 bg-white rounded-3 px-2">
            <h4> 
              Nama : <?= $daftarSiswa['namaSiswa'] ?> <br>
              Kelas : <?= $daftarSiswa['namaKelas'] ?>
            </h4>
          </div>
          <div class="mt-0 mb-3 bg-white rounded-3 px-2">
            <?php 
            if( date('s') % 30 == 0 ){
              $quotes = query("SELECT * FROM quotes");
            }
            ?>
            <blockquote class="blockquote text-center">
              <p class="fs-6">Menuntut ilmu di masa muda bagai mengukir di atas batu</p>
              <footer class="blockquote-footer fs-6"><cite title="Source Title">
                  Hasan al-Bashri</cite>
              </footer>
            </blockquote>
          </div>
          <ol class="list-group list-group-numbered">
            <li class="d-flex justify-content-center p-1 bg-white align-items-start rounded-top" 
            style="background: linear-gradient(120deg,#d760ff,#4976ff);">
              <h2 class="text-white">Top Buku</h2>
            </li>

            <?php 
            
            $bukuTop = query("SELECT * FROM buku ORDER BY jumlah_dipinjam DESC LIMIT 5");
            
            foreach ($bukuTop as $bT ) :
            ?>

            <li class="list-group-item d-flex justify-content-center align-items-start gap-2">
              <div class="me-auto d-flex">
                <img src="assets/images/<?=$bT['gambar']?>" alt="..." width="60rem" height="80rem" class="float-start">
                <div class="fw-semibold ms-2">
                  <p class="mb-0" style="font-size: 1rem;"><?=$bT['nama']?></p>
                  <!-- <p style="font-size: small"></p> -->
                </div>
              </div>
              <!-- <span class="badge bg-warning rounded-pill"><?=$bT['jumlah_dipinjam']?></span> -->
            </li>
            
            <?php endforeach; ?>

          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
    <div class="container mt-4">
      <br>
      <h5 class="fw-bold text-white text-center">Daftar Peminjam :</h5>
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
            <td><a href="https://api.whatsapp.com/<?php $data["kontakSiswa"]; ?>" class="kontak"><?= $data["kontakSiswa"]; ?></a></td>
            <td><?= $data["nama"]; ?></td>
            <td><?= $data["waktuPeminjaman"]; ?></td>
            <td><?= bataswaktu(strtotime($data["waktuPeminjaman"]), $batasPengembalian); ?></td>
            <td><a href="kembalikan_data_pengembalian.php?id=<?= $data['idPeminjaman']; ?>&waktupeminjaman=<?= $data['waktuPeminjaman']; ?>" onclick="return confirm('Yakin ingin mengebalikan buku?')">Kembalikan</a></td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>

        <?php if ($i == 1) : ?>
          <tr>
            <td colspan="8" align="center"> Tidak ada Yang Meminjam buku</td>
          </tr>
        <?php endif; ?>

      </table>
    </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="assets/js/scriptUser.js"></script>

  <?php endif; ?>

</body>

</html>