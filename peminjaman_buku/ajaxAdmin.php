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

    <li class="list-buku-item list-group-item bg-light ">
      <div class="row g-1">
        <div class="col-md-3">
          <img src="assets/images/<?= $buku['gambar'] ?>" class="img-fluid" width="140rem" alt="...">
        </div>
        <div class="col-md-6 w-75">
          <div class="card-body">
            <h5 class="card-title "><?= $buku['nama'] ?></h5>
            <p class="fw-light fs-6 mb-0"><?= $buku['deskripsi'] ?></p>
            <div class="d-grid gap-2 px-2 pt-2">
              <div class="row gap-2">
                <button class="col btn btn-warning btn-sm rounded-pill text-white" type="button" data-bs-toggle="modal" data-bs-target="#edit<?= $buku['id'] ?>">Edit Buku</button>
                <a href="hapusBuku.php?id=<?= $buku['id'] ?>" class="col btn btn-danger btn-sm rounded-pill">Hapus Buku</a>
              </div>

            </div>
            <!-- SECTION POP UP EDIT -->
            <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="edit<?= $buku['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header border-0 text-white" style="background: linear-gradient(120deg,#4433ff,#00ffff);">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Buku <?= $buku['nama'] ?> </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="editBuku.php" method="POST" enctype="multipart/form-data">
                      <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar :</label><br>
                        <img src="assets/images/<?= $buku['gambar'] ?>" class="w-25 mb-2" alt="..." width="100%">
                        <input type="file" class="form-control form-control-sm w-50" id="gambar" name="gambar" accept=".png,.jpg,.jpeg,.gif,.JPG,.PNG,.JPEG,.GIF">
                      </div>
                      <div class="mb-3">
                        <label for="Judul" class="form-label">Judul :</label>
                        <input type="text" class="form-control border-0 border-1 border-dark border-bottom border-start rounded-0" id="Judul" name="judul" value="<?= $buku['nama'] ?>">
                      </div>
                      <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis :</label>
                        <input type="text" class="form-control border-0 border-1 border-dark border-bottom border-start rounded-0" id="penulis" name="penulis" value="<?= $buku['penulis'] ?>">
                      </div>
                      <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit :</label>
                        <input type="text" class="form-control border-0 border-1 border-dark border-bottom border-start rounded-0" id="penerbit" name="penerbit" value="<?= $buku['penerbit'] ?>">
                      </div>
                      <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi :</label>
                        <input type="text" class="form-control border-0 border-1 border-dark border-bottom border-start rounded-0" id="deskripsi" name="deskripsi" value="<?= $buku['deskripsi'] ?>">
                      </div>
                      <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Buku :</label>
                        <input type="text" class="form-control border-0 border-1 
                                  border-dark border-bottom border-start rounded-0 w-25" id="jumlah" name="jumlah" value="<?= $buku['jumlah'] ?>">
                      </div>
                      <input type="hidden" name="idBuku" value="<?= $buku['id'] ?>">
                      <button type="reset" class="btn btn-outline-danger py-0 px-4">Cancel</button>
                      <button type="submit" class="btn btn-outline-primary py-0 px-4">Submit</button>
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