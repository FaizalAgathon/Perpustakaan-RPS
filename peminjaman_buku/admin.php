<?php
require "koneksi.php";

//Data Pengembalian
$pengembalian = query("SELECT *,buku.nama AS nama_buku 
  FROM buku RIGHT JOIN pengembalian ON pengembalian.id_pengembali = buku.id");

//Data Histori
$histori = query("SELECT *,buku.nama AS buku_histori 
  FROM buku RIGHT JOIN histori ON histori.id_histori = buku.id");

//Hapus Data Histori
$hapushistori = query("SELECT * FROM histori");

$harihapus = 1; //setelah sudah 30 hari menurut hari RL akan menghapus data dari database

foreach ($hapushistori as $hpshstr) {
  $haripengembalian = bataswaktu(strtotime($hpshstr["waktu_pengembalian"]), 0);
  $batashapus = date("Y-m-j", time() + 60 * 60 * 24 * -$harihapus);

  if ($haripengembalian == $batashapus) {
    $hapus = "DELETE FROM histori WHERE waktu_pengembalian ='$haripengembalian'";
    mysqli_query($conn, $hapus);
  }
}

// login
$login = query("SELECT * FROM admin WHERE username='$_POST[username]'");

//Definisikan data admin dari Hasil input User
$user_username = $_POST['username'];
$user_password = $_POST['password'];

//Definisakan data admin dari Database
foreach ($login as $d) {
  $db_username = $d['username'];
  $db_password = $d['password'];
}

$hasillogin = login($user_username, $user_password, $db_username, $db_password);

echo $hasillogin;

// Cek apakah sudah login atau belom
if (!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($db_username) || !isset($db_password)) {
  // redirect (memindahkan user nya ke page lain)
  header("Location: login.php");
  exit;
}

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
      <div class="row w-100 p-1">
        <h2 class="fw-bold text-white m-auto mt-2 pb-1 judul">Peminjaman Buku</h2>
        <form class="d-flex input-group justify-content-center" role="search">
          <input class="form-control border-info mt-2 rounded-end rounded-pill w-75" type="search" placeholder="Search" aria-label="Search" id="inputCari">
          <button class="btn btn-primary mt-2 rounded-start rounded-pill" type="submit">Search</button>
          <button class="btn btn-outline-primary rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#tambah-buku">Tambah Buku</button>
        </form>

        <div class="col-12 col-md-8 mb-3 mt-2">
          <!-- DAFTAR BUKU -->
          <ul class="list-buku list-group" id="list">
            <?php foreach (query("SELECT * FROM buku") as $buku) : ?>

              <li class="list-buku-item list-group-item bg-light">
                <div class="row g-1">
                  <div class="col-md-2">
                    <img src="assets/images/<?= $buku['gambar'] ?>" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-6">
                    <div class="card-body">
                      <h5 class="card-title "><?= $buku['nama'] ?></h5>
                      <span class="fw-light text-primary">

                      <?php 
                      $bukuGenre = explode(',',$buku['genre']);
                      echo implode(' ',$bukuGenre);
                      ?>

                      </span>
                      <p class="fw-light fs-6 mb-0"><?= $buku['deskripsi'] ?></p>
                      <div class="d-grid gap-2 px-2 pt-2">
                        <button class="btn btn-primary rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#buku<?= $buku['id'] ?>">Detail</button>
                        <button class="btn btn-outline-primary rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#pinjam<?= $buku['id'] ?>">Pinjam Buku</button>
                        <button class="btn btn-outline-primary rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#edit<?= $buku['id'] ?>">Edit Buku</button>
                        <a href="hapusBuku.php?id=<?=$buku['id']?>" class="btn btn-danger rounded-pill">Hapus Buku</a>
                      </div>
                      <!-- SECTION POP UP DETAIL -->
                      <div class="modal fade" id="buku<?= $buku['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
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
                                    <h6>Tanggal terbit : </h6>
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
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Form Peminjaman Buku <?= $buku['nama'] ?> </h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="peminjaman.php" method="POST">
                                <div class="mb-3">
                                  <label for="nama" class="form-label">Nama :</label>
                                  <input type="text" class="form-control" id="nama" name="nama">
                                </div>
                                <div class="mb-3">
                                  <label for="kelas" class="form-label">Kelas :</label>
                                  <input type="text" class="form-control" id="kelas" name="kelas">
                                </div>
                                <div class="mb-3">
                                  <label for="kontak" class="form-label">Kontak :</label>
                                  <input type="number" class="form-control" id="kontak" name="kontak">
                                </div>
                                <div class="mb-3">
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
                                <button type="submit" class="btn btn-outline-primary align-center">Submit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- !SECTION POP UP PEMINJAMAN -->
                      <!-- SECTION POP UP EDIT -->
                      <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="edit<?= $buku['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Buku <?= $buku['nama'] ?> </h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="editBuku.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                  <label for="Judul" class="form-label">Judul :</label>
                                  <input type="text" class="form-control" id="Judul" name="judul" value="<?=$buku['nama']?>">
                                </div>
                                <div class="mb-3">
                                  <label for="penulis" class="form-label">Penulis :</label>
                                  <input type="text" class="form-control" id="penulis" name="penulis" value="<?=$buku['penulis']?>">
                                </div>
                                <div class="mb-3">
                                  <label for="penerbit" class="form-label">Penerbit :</label>
                                  <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?=$buku['penerbit']?>">
                                </div>
                                <div class="mb-3">
                                  <label for="deskripsi" class="form-label">Deskripsi :</label>
                                  <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?=$buku['deskripsi']?>">
                                </div>
                                <div class="mb-3">
                                  <label for="gambar" class="form-label">Gambar :</label>
                                  <img src="assets/images/<?=$buku['gambar']?>" alt="..." width="100%">
                                  <input type="file" class="form-control" id="gambar" name="gambar" accept=".png,.jpg,.jpeg,.gif,.JPG,.PNG,.JPEG,.GIF">
                                </div>
                                <input type="hidden" name="idBuku" value="<?= $buku['id'] ?>">
                                <button type="reset" class="btn btn-outline-danger">Cancel</button>
                                <button type="submit" class="btn btn-outline-primary align-center">Submit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- !SECTION POP UP EDIT -->
                    </div>
                  </div>
                </div>
              </li>

            <?php endforeach; ?>
          </ul>
        </div>
        <!-- SECTION POP UP TAMBAH BUKU -->
        <div class="modal fade" id="tambah-buku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="tambah_buku.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="judul" class="form-label">Judul :</label>
                    <input type="text" class="form-control" id="judul" name="judul">
                  </div>
                  <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi :</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                  </div>
                  <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit :</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit">
                  </div>
                  <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis :</label>
                    <input type="text" class="form-control" id="penulis" name="penulis">
                  </div>
                  <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar :</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept=".png,.jpg,.jpeg,.gif,.JPG,.PNG,.JPEG,.GIF">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-outline-danger">Cancel</button>
                  <button type="submit" class="btn btn-outline-primary align-center">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- !SECTION POP UP TAMBAH BUKU -->
        <div class="col-12 col-md-4 mt-2">
          <div class="mt-0 mb-3 bg-white rounded-3 px-2">
            <blockquote class="blockquote text-center">
              <p class="fs-6">Menuntut ilmu di masa muda bagai mengukir di atas batu</p>
              <footer class="blockquote-footer"><cite title="Source Title">
                  Hasan al-Bashri</cite>
              </footer>
            </blockquote>
          </div>
          <ol class="list-group list-group-numbered">
            <li class="d-flex justify-content-center p-1 bg-white align-items-start rounded-top">
              <h2 class="">Top Buku</h2>
            </li>

            <?php 
            
            $bukuTop = query("SELECT * FROM buku ORDER BY jumlah_dipinjam DESC");
            
            foreach ($bukuTop as $bT ) :
            ?>

            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto d-flex">
                <img src="assets/images/<?=$bT['gambar']?>" alt="..." width="70" class="float-start">
                <div class="fw-bold">
                  <p><?=$bT['nama']?></p>
                  <span>
                  <?php 
                  $bukuGenre = explode(',',$bT['genre']);
                  echo implode(' ',$bukuGenre); 
                  ?>
                  </span>
                </div>
              </div>
              <span class="badge bg-warning rounded-pill"><?=$bT['jumlah_dipinjam']?></span>
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
          <th>Nama Pengembali</th>
          <th>Kelas Pengembali</th>
          <th>Kontak Pengembali</th>
          <th>Buku Pengembali</th>
          <th>Waktu Peminjaman</th>
          <th>Batas Waktu Pengembalian</th>
          <th>Aksi</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($pengembalian as $data) : ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= $data["nama_pengembali"]; ?></td>
            <td><?= strtoupper($data["kelas_pengembali"]); ?></td>
            <td><a href="https://api.whatsapp.com/<?php $data["kontak_pengembali"]; ?>" class="kontak"><?= $data["kontak_pengembali"]; ?></a></td>
            <td><?= $data["nama_buku"]; ?></td>
            <td><?= $data["waktu_peminjaman"]; ?></td>
            <td><?= bataswaktu(strtotime($data["waktu_peminjaman"]), 7); ?></td>
            <td><a href="kembalikan_data_pengembalian.php?id_pengembali=<?= $data['id_pengembali']; ?>" onclick="return confirm('Yakin ingin mengebalikan buku?')">Kembalikan</a></td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>

        <?php if ($i == 1) : ?>
          <tr>
            <td colspan="8" align="center"> Tidak ada Yang Meminjam buku</td>
          </tr>
        <?php endif; ?>

      </table>

      <br>

      <h5 class="fw-bold text-white text-center">History :</h5>
      <table class="table table-light table-striped">
        <tr>
          <th>No</th>
          <th>Nama histori</th>
          <th>Kelas histori</th>
          <th>Kontak histori</th>
          <th>Buku histori</th>
          <th>Waktu Peminjaman</th>
          <th>Waktu Pengembalian</th>
        </tr>

        <?php $j = 1 ?>
        <?php foreach ($histori as $data2) : ?>
          <tr>
            <td><?= $j; ?></td>
            <td><?= $data2['nama_histori']; ?></td>
            <td><?= strtoupper($data2["kelas_histori"]); ?></td>
            <td><a href="https://api.whatsapp.com/<?php $data2["kontak_histori"]; ?>" class="kontak"> <?= $data2['kontak_histori']; ?></td>
            <td><?= $data2['buku_histori']; ?></td>
            <td><?= $data2['waktu_peminjaman']; ?></td>
            <td><?= $data2['waktu_pengembalian']; ?></td>
          </tr>
          <?php $j++; ?>
        <?php endforeach; ?>

        <?php if ($j == 1) : ?>
          <tr>
            <td colspan="8" align="center"> Tidak ada Histori yang tersedia</td>
          </tr>
        <?php endif; ?>

      </table>
    </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="assets/js/scriptAdmin.js"></script>
</body>

</html>