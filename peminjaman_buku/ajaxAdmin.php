<?php

require 'koneksi.php';

$keyword = $_GET['keyword'];

$sqlCari = "SELECT * FROM buku WHERE 
  nama LIKE '%$keyword%'
  ";

// echo $keyword;

// var_dump(query("SELECT * FROM buku"));

?>

<ul class="list-group" id="list">
  <?php foreach (query($sqlCari) as $buku) : ?>

    <li class="list-group-item bg-light">
      <div class="row g-1">
        <div class="col-md-2">
          <img src="assets/images/<?= $buku['gambar'] ?>" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-6">
          <div class="card-body">
            <h5 class="card-title "><?= $buku['nama'] ?></h5>
            <a href="" class="button text-decoration-none">#Action</a>
            <a href="" class="button text-decoration-none">#Comedy</a>
            <a href="" class="button text-decoration-none">#Fantasy</a>
            <p class="fw-light fs-6 mb-0"><?= $buku['deskripsi'] ?></p>
            <div class="d-grid gap-2 px-2 pt-2">
              <button class="btn btn-primary rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#buku<?= $buku['id'] ?>">Detail</button>
              <button class="btn btn-outline-primary rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#pinjam<?= $buku['id'] ?>">Pinjam Buku</button>
            </div>
            <!-- POP UP DETAIL -->
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
          </div>
        </div>
      </div>
    </li>

  <?php endforeach; ?>
</ul>