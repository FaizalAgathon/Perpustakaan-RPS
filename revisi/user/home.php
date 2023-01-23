<?php

require '../koneksi.php';

if (!isset($_POST['login'])) {
  header("Location: ../login-daftar/login_siswa.php");
} elseif ($_SESSION['user'] == true) {
  // header("Location: home.php");
}

$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$kontak = $_POST['kontak'];
// $password = $_POST['password'];

$idKelas = query("SELECT idKelas FROM kelas WHERE namaKelas = '$kelas'")[0];
$result = mysqli_query($conn, "SELECT * FROM siswa 
    WHERE idKelas = $idKelas[idKelas] AND
    namaSiswa = '$nama' AND 
    kontakSiswa = '$kontak'");

if (mysqli_num_rows($result) != 1) {

  header("Location: ../login-daftar/login_siswa.php?gagal");
} else {

  $_SESSION['user'] = true;
}

$daftarSiswa = query("SELECT * FROM siswa s INNER JOIN
    kelas k ON s.idKelas = k.idKelas 
    WHERE namaSiswa = '$nama' AND
    namaKelas = '$kelas' AND 
    kontakSiswa = '$kontak'")[0];


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="css_user/styleUser.css">
</head>

<body>
  
  <?php include 'header-menu-user.php'; ?>

  <!-- BAGIAN KIRI & DAFTAR BUKU-->
  <div class="row m-auto">
    <div class="col-12 col-md-8 mb-3 mt-4">
      <?php foreach( query("SELECT * FROM buku") as $buku ) : ?>
      <ul class="list-buku list-group" id="list">
        <li class="list-buku-item list-group-item bg-white rounded rounded-4 border" style="box-shadow: 5px 5px 5px rgb(120, 120, 120);">
          <div class="row g-1">
            <div class="col-md-3">
              <img src="../assets/images/<?= $buku['gambar'] ?>" class="img-fluid border rounded rounded-3" width="140rem" alt="...">
            </div>
            <div class="col-md-6 w-75">
              <div class="card-body p-1">
                <h5 class="card-title "><?= $buku['nama'] ?></h5>
                <p class="fw-light fs-6 mb-0"><?= $buku['deskripsi'] ?></p>
                <div class="d-grid gap-2 px-2 pt-2">
                  <div class="row gap-2">
                    <button class="col btn btn-white border btn-sm rounded-pill text-dark fw-semibold p-0" type="button" data-bs-toggle="modal" 
                    data-bs-target="#detail<?= $buku['id'] ?>" style="box-shadow: 5px 5px 5px rgb(201, 201, 201)">
                      <img src="../icon/information2.png" width="20rem" alt=""><br>
                      Detail
                    </button>
                    <button class="col btn btn-white border btn-sm rounded-pill text-dark fw-semibold p-0" type="button" data-bs-toggle="modal" data-bs-target="#pinjam<?= $buku['id'] ?>" style="box-shadow: 5px 5px 5px rgb(201, 201, 201)">
                      <img src="../icon/clipboard.png" width="20rem" alt=""><br>
                      Pinjam
                    </button>
                  </div>
                </div>
                <!-- AWAL POP UP DETAIL -->
                <div class="modal fade" id="detail<?= $buku['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header border-0 text-white" style="background: linear-gradient(120deg,#4433ff,#00ffff);">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row g-2">
                          <div class="col-md-4">
                            <img src="../assets/images/<?= $buku['gambar'] ?>" class="img-fluid rounded-start" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5>Judul : <?= $buku['nama'] ?></h5>

                              <h6>Penulis : <?= $buku['penulis'] ?></h6>
                              <h6>Penerbit : <?= $buku['penerbit'] ?></h6>
                              <h6>Tanggal terbit : <?= $buku['tglTerbit'] ?></h6>
                              <h6>Tersedia : <?= $buku['jumlah'] ?> Buku</h6>
                            </div>
                          </div>
                          <hr>
                          <h6 class="fw-bold">Deskripsi : <?= $buku['deskripsi'] ?></h6>
                          <p></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- AKHIR POP UP DETAIL -->
                <!-- AWAL POP UP PEMINJAMAN -->
                <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="pinjam<?= $buku['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header border-0" style="background: linear-gradient(120deg,#4433ff,#00ffff);">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Konfirmasi Peminjaman Buku</h1>
                        <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="peminjam.php" method="POST">
                          <div class="mb-3">
                            <p for="nama" class="form-label">
                              Buku :
                              <span id="nama"><?= $buku['nama'] ?></span>
                            </p>
                            <input type="hidden" name="idBuku" value="<?= $buku['id'] ?>">
                            <input type="hidden" name="nama" 
                            value="">
                          </div>
                          <div class="mb-3">
                            <p for="nama" class="form-label">
                              Nama :
                              <span id="nama"><?= $daftarSiswa['namaSiswa'] ?></span>
                            </p>
                            <input type="hidden" name="nama" 
                            value="<?= $daftarSiswa['namaSiswa'] ?>">
                          </div>
                          <div class="mb-3">
                            <p for="kontak" class="form-label">
                              Kontak :
                              <span id="kontak"><?= $daftarSiswa['kontakSiswa'] ?></span>
                            </p>
                            <input type="hidden" name="kontak" 
                            value="<?= $daftarSiswa['kontakSiswa'] ?>">
                          </div>
                          <div class="mb-3">
                            <p for="kelas" class="form-label">
                              Kelas :
                              <span id="kelas"><?= $daftarSiswa['namaKelas'] ?></span>
                            </p>
                            <input type="hidden" name="kelas" 
                            value="<?= $daftarSiswa['namaKelas'] ?>">
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
                          <div class="input-group">
                            <button type="reset" class="btn btn-outline-danger py-0 px-4 pt-0 w-50 rounded-pill rounded-end">
                              <img src="../icon/multiply.png" alt="" width="20rem"><br>
                              Cancel
                            </button>
                            <input type="hidden" name="pinjam" value="---">
                            <button type="submit" class="btn btn-outline-primary py-0 px-4 pt-0 w-50 rounded-pill rounded-start" name="peminjamanUser">
                              <img src="../icon/clipboard.png" width="20rem" alt=""><br>
                              Pinjam
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- AKHIR POP UP PEMINJAMAN -->
              </div>
            </div>
          </div>
        </li>
      </ul>
      <?php endforeach; ?>
    </div>
    <!-- AKHIR BAGIAN KIRI & DAFTAR BUKU -->
    <!-- AWAL BAGIAN KANAN -->
    <div class="col-12 col-md-4 mt-4">
      <form class="input-group mb-2" role="search">
        <input class="form-control border-primary mt-2 rounded-pill" type="search" placeholder="Search" aria-label="Search" id="inputCari">
        <!-- <button class="btn btn-primary mt-2 rounded-start rounded-pill">Cari</button> -->
      </form>
      <div class="mt-0 mb-3 bg-white rounded-3 px-2">
        <blockquote class="blockquote text-center">
          <p class="" style="font-size: 1rem;">Menuntut ilmu di masa muda bagai mengukir di atas batu</p>
          <footer class="blockquote-footer fs-6">
            <cite title="Source Title">
              Hasan al-Bashri
            </cite>
          </footer>
        </blockquote>
      </div>
      <ol class="list-group list-group-numbered">
        <li class="d-flex justify-content-center p-1 bg-white align-items-start rounded-top" style="background: linear-gradient(120deg,#d760ff,#4976ff);">
          <h2 class="text-white fs-5">Top Buku</h2>
        </li>

        <?php 
        
        foreach ( query("SELECT nama,gambar FROM buku ORDER BY jumlah_dipinjam DESC LIMIT 5") as $bT ) :

        ?>

        <li class="list-group-item d-flex justify-content-center align-items-start gap-2">
          <div class="me-auto d-flex">
            <img src="../assets/images/<?= $bT['gambar'] ?>" alt="..." width="60rem" height="80rem" class="float-start">
            <div class="fw-semibold ms-2">
              <p class="mb-0" style="font-size: 1rem;"><?= $bT['nama'] ?></p>
              <span class="" style="font-size: small;">#Action #Fantasy</span>
            </div>
          </div>
        </li>

        <?php endforeach; ?>

      </ol>
      <!-- SLIDE GAMBAR -->
      <div id="carouselExampleControls" class="carousel slide mt-2" data-bs-ride="carousel">
        <div class="carousel-inner rounded rounded-4 border border-2">
          <div class="carousel-item active">
            <img src="../../../peminjaman_buku/background/bg4.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../../../peminjaman_buku/background/bg5.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../../../peminjaman_buku/background/bg6.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <!-- AKHIR SLIDE GAMBAR -->
    </div>
    <!-- AKHIR BAGIAN KANAN -->
  </div>
  <!-- AWAL FOOTER -->
  <div class="bg-dark mt-3 p-1 pt-2 w-100" id="footer" style="margin-bottom: -2rem;">
    <div class="row w-100">
      <div class="col ms-2 mt-3">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15849.134770711997!2d108.5367314!3d-6.735204!3m2!
                1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x51cf481547b4b319!2sSMK%20Negeri%201%20Cirebon!5e0!3m2!1sid!2sid!4v1674230224751!5m2!1sid!2sid" width="400" height="350" style="border: 0;" allowfullscreen="" class="rounded-4" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="col mt-3 border rounded-4" style="box-shadow: 3px 3px 5px rgb(201, 201, 201);">
          <form action="" method="post">
              <div class="p-2">
                  <p class="text-white mb-0">Kritik Dan Saran :</p><br>
                  <input type="text" name="param" value="home" hidden>
                  <textarea name="komen" class="form-control w-75 bg-light" aria-label="With textarea"></textarea>
                  <button name="feedback" type="submit" class="mt-2 btn btn-light py-0">
                      <img src="../icon/send.png" width="20rem" alt="">
                      Kirim
                  </button>
              </div>
          </form>
      </div>
    </div>
    <footer class="main-footer mt-5" style="padding-top: 10px;">
      <div class="text-center">
        <a href="http://smkn1-cirebon.sch.id" class="txt2 hov1 text-decoration-none text-white" target="_blank">
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