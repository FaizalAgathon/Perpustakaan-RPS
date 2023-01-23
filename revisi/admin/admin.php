<?php 
require '../koneksi.php'; 

if ( isset($_POST['tambahBuku']) ){

  $judul = $_POST['judul'];
  $penerbit = $_POST['penerbit'];
  $penulis = $_POST['penulis'];
  $deskripsi = $_POST['deskripsi'];
  $tglTerbit = $_POST['tglTerbit'];
  $jumlah = $_POST['jumlah'];

  $namaGambar = $_FILES['gambar']['name'];
  $ukuranGambar = $_FILES['gambar']['size'];

  $rand = rand(1000,9999);

  // var_dump($deskripsi);

  if ( $ukuranGambar == 0 ){

    mysqli_query($conn, "INSERT INTO buku VALUES
      (NULL, '$judul', '$deskripsi', '$tglTerbit', 
      '$penerbit', '$penulis', 'ppNoImg.png', '$jumlah', '0')");

    // var_dump($judul);

  } elseif ( $ukuranGambar <= 5000000 ){

    $gambar = $rand . '-' . $namaGambar;

    move_uploaded_file($_FILES['gambar']['tmp_name'], '../assets/images/' . $gambar);

    mysqli_query($conn, "INSERT INTO buku VALUES
      (NULL, '$judul', '$deskripsi', '$tglTerbit', 
      '$penerbit', '$penulis', '$gambar', '$jumlah', '0')");

    // var_dump($deskripsi);

  }

}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styleAdmin.css">
</head>

<body>

  <?php include 'header-menu-admin.php'; ?>

  <!-- BAGIAN KIRI & DAFTAR BUKU -->
  <div class="row m-auto">
    <div class="col-12 col-md-8 mb-3 mt-4">
      <?php 

      $jmlDataperHal = 5;
      $jmlData = count(query("SELECT * FROM buku"));
      $jmlHal = ceil($jmlData / $jmlDataperHal);
      $halAktif = ( isset($_GET['hal']) ) ? $_GET['hal'] : 1;
      $awalData = ( $jmlDataperHal * $halAktif ) - $jmlDataperHal;
      
      ?>
      <?php if ( !isset($_POST['inputCari']) AND !isset($_GET['halCari']) ) : ?>
        <?php foreach (query("SELECT * FROM buku LIMIT $awalData, $jmlDataperHal") as $buku) : ?>
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
                        <button class="col btn btn-warning btn-sm rounded-pill text-white p-0" type="button" data-bs-toggle="modal" data-bs-target="#edit<?= $buku['id'] ?>">
                          <img src="../icon/edit1.png" width="20px" alt="">
                        </button>
                        <a href="hapusBuku.php?id=<?= $buku['id'] ?>" class="col btn btn-danger btn-sm rounded-pill">
                          <img src="../icon/bin.png" width="20px" alt="">
                        </a>
                      </div>
                    </div>
                    <!-- SECTION AWAL POP UP EDIT -->
                    <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="edit<?= $buku['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header border-0 text-white" style="background: linear-gradient(120deg,#4433ff,#00ffff);">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Buku</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="editBuku.php" method="POST" enctype="multipart/form-data">
                              <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar :</label><br>
                                <img src="../assets/images/<?= $buku['gambar'] ?>" class="w-25 mb-2" alt="..." width="100%">
                                <input type="file" class="form-control form-control-sm w-50" id="gambar" name="gambar" accept=".png,.jpg,.jpeg,.gif,.JPG,.PNG,.JPEG,.GIF">
                              </div>
                              <div class="mb-3">
                                <label for="Judul" class="form-label">Judul :</label>
                                <input type="text" class="form-control border-bottom border-0 rounded-0" id="Judul" name="judul" value="<?= $buku['nama'] ?>">
                              </div>
                              <div class="mb-3">
                                <label for="penulis" class="form-label">Penulis :</label>
                                <input type="text" class="form-control border-bottom border-0 rounded-0" id="penulis" name="penulis" value="<?= $buku['penulis'] ?>">
                              </div>
                              <div class="mb-3">
                                <label for="penerbit" class="form-label">Penerbit :</label>
                                <input type="text" class="form-control border-bottom border-0 rounded-0" id="penerbit" name="penerbit" value="<?= $buku['penerbit'] ?>">
                              </div>
                              <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi :</label>
                                <input type="text" class="form-control border-bottom border-0 rounded-0" id="deskripsi" name="deskripsi" value="<?= $buku['deskripsi'] ?>">
                              </div>
                              <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah Buku :</label>
                                <input type="text" class="form-control border-1 rounded-3 w-25" id="jumlah" name="jumlah" value="<?= $buku['jumlah'] ?>">
                              </div>
                              <input type="hidden" name="idBuku" value="<?= $buku['id'] ?>">
                              <div class="input-group">
                                <button type="reset" class="btn btn-outline-danger py-1 px-4 pt-0 w-50">
                                  <img src="../icon/multiply.png" width="20rem" alt="">
                                  Cancel
                                </button>
                                <button type="submit" class="btn btn-outline-primary py-1 px-4 pt-0 w-50">
                                  <img src="../icon/bookmark.png" width="20rem" alt="">
                                  save
                                </button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- !SECTION AKHIR POP UP EDIT -->
                  </div>
                </div>
              </div>
            </li>

          </ul>
        <?php endforeach; ?>
        <nav aria-label="Page navigation example">
          <ul class="pagination">

            <?php if ( $halAktif > 1 ) : ?>
            <li class="page-item">
              <a class="page-link" href="?hal=<?= $halAktif - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <?php endif; ?>

            <?php for ( $i = 1; $i <= $jmlHal; $i++ ) : ?>
            <li class="page-item <?= $i == $halAktif ? 'active' : '' ?>">
              <a class="page-link" href="?hal=<?= $i ?>">
                <?= $i ?>
              </a>
            </li>
            <?php endfor; ?>

            <?php if ( $halAktif < $jmlHal ) : ?>
            <li class="page-item">
              <a class="page-link" href="?hal=<?= $halAktif + 1 ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
            <?php endif; ?>

          </ul>
        </nav>
      <?php endif; ?>
      <?php if ( isset($_POST['inputCari']) OR isset($_GET['halCari']) ) : ?>
        <?php 
        $keyword = $_POST['inputCari'];
        $jmlDataCari = count(query("SELECT * FROM buku WHERE nama LIKE '%$keyword%'"));
        $jmlHalCari = ceil($jmlDataCari / $jmlDataperHal);
        foreach ( query("SELECT * FROM buku WHERE nama LIKE '%$keyword%' LIMIT $awalData, $jmlDataperHal") as $cariBuku ) : ?>
          <ul class="list-buku list-group" id="list">
            <li class="list-buku-item list-group-item bg-white rounded rounded-4 border" style="box-shadow: 5px 5px 5px rgb(120, 120, 120);">
              <div class="row g-1">
                <div class="col-md-3">
                  <img src="../assets/images/<?= $cariBuku['gambar'] ?>" class="img-fluid border rounded rounded-3" width="140rem" alt="...">
                </div>
                <div class="col-md-6 w-75">
                  <div class="card-body p-1">
                    <h5 class="card-title "><?= $cariBuku['nama'] ?></h5>
                    <p class="fw-light fs-6 mb-0"><?= $cariBuku['deskripsi'] ?></p>
                    <div class="d-grid gap-2 px-2 pt-2">
                      <div class="row gap-2">
                        <button class="col btn btn-warning btn-sm rounded-pill text-white p-0" type="button" data-bs-toggle="modal" data-bs-target="#edit<?= $cariBuku['id'] ?>">
                          <img src="../icon/edit1.png" width="20px" alt="">
                        </button>
                        <a href="hapusBuku.php?id=<?= $cariBuku['id'] ?>" class="col btn btn-danger btn-sm rounded-pill">
                          <img src="../icon/bin.png" width="20px" alt="">
                        </a>
                      </div>
                    </div>
                    <!-- SECTION AWAL POP UP EDIT -->
                    <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="edit<?= $cariBuku['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header border-0 text-white" style="background: linear-gradient(120deg,#4433ff,#00ffff);">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Buku</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="editBuku.php" method="POST" enctype="multipart/form-data">
                              <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar :</label><br>
                                <img src="../assets/images/<?= $cariBuku['gambar'] ?>" class="w-25 mb-2" alt="..." width="100%">
                                <input type="file" class="form-control form-control-sm w-50" id="gambar" name="gambar" accept=".png,.jpg,.jpeg,.gif,.JPG,.PNG,.JPEG,.GIF">
                              </div>
                              <div class="mb-3">
                                <label for="Judul" class="form-label">Judul :</label>
                                <input type="text" class="form-control border-bottom border-0 rounded-0" id="Judul" name="judul" value="<?= $cariBuku['nama'] ?>">
                              </div>
                              <div class="mb-3">
                                <label for="penulis" class="form-label">Penulis :</label>
                                <input type="text" class="form-control border-bottom border-0 rounded-0" id="penulis" name="penulis" value="<?= $cariBuku['penulis'] ?>">
                              </div>
                              <div class="mb-3">
                                <label for="penerbit" class="form-label">Penerbit :</label>
                                <input type="text" class="form-control border-bottom border-0 rounded-0" id="penerbit" name="penerbit" value="<?= $cariBuku['penerbit'] ?>">
                              </div>
                              <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi :</label>
                                <input type="text" class="form-control border-bottom border-0 rounded-0" id="deskripsi" name="deskripsi" value="<?= $cariBuku['deskripsi'] ?>">
                              </div>
                              <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah Buku :</label>
                                <input type="text" class="form-control border-1 rounded-3 w-25" id="jumlah" name="jumlah" value="<?= $cariBuku['jumlah'] ?>">
                              </div>
                              <input type="hidden" name="idBuku" value="<?= $cariBuku['id'] ?>">
                              <div class="input-group">
                                <button type="reset" class="btn btn-outline-danger py-1 px-4 pt-0 w-50">
                                  <img src="../icon/multiply.png" width="20rem" alt="">
                                  Cancel
                                </button>
                                <button type="submit" class="btn btn-outline-primary py-1 px-4 pt-0 w-50">
                                  <img src="../icon/bookmark.png" width="20rem" alt="">
                                  save
                                </button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- !SECTION AKHIR POP UP EDIT -->
                  </div>
                </div>
              </div>
            </li>
          </ul>
        <?php endforeach; ?>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?php if ( $halAktif > 1 ) : ?>
            <li class="page-item">
              <a class="page-link" href="?halCari=<?= $halAktif - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <?php endif; ?>
            <?php for ( $i = 1; $i <= $jmlHalCari; $i++ ) : ?>
            <li class="page-item">
              <a class="page-link" href="?halCari=<?= $i ?>">
                <?= $i ?>
              </a>
            </li>
            <?php endfor; ?>
            <?php if ( $halAktif < $jmlHalCari ) : ?>
            <li class="page-item">
              <a class="page-link" href="?halCari=<?= $halAktif + 1 ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </nav>
      <?php endif; ?>
    </div>
    <!-- AKHIR BAGIAN KIRI & DAFTAR BUKU -->
    <!-- BAGIAN KANAN -->
    <div class="col-12 col-md-4 mt-4">
      <form action="" method="POST" class="input-group mb-2" role="search">
        <input class="form-control border-primary mt-2 rounded-pill" type="search" placeholder="Search" aria-label="Search" name="inputCari">
        <!-- <button class="btn btn-primary mt-2 rounded-start rounded-pill">Cari</button> -->
      </form>
      <div class="mt-0 mb-3 bg-white rounded-3 px-2">
        <blockquote class="blockquote text-center">
          <p class="" style="font-size: 1rem;">Menuntut ilmu di masa muda bagai mengukir di atas batu</p>
          <footer class="blockquote-footer fs-6"><cite title="Source Title">
              Hasan al-Bashri</cite>
          </footer>
        </blockquote>
      </div>
      <ol class="list-group list-group-numbered">
        <li class="d-flex justify-content-center p-1 bg-white align-items-start rounded-top" style="background: linear-gradient(120deg,#d760ff,#4976ff);">
          <h2 class="text-white fs-5">Top Buku</h2>
        </li>
        <?php

        $bukuTop = query("SELECT * FROM buku ORDER BY jumlah_dipinjam DESC LIMIT 5");

        foreach ($bukuTop as $bT) :
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