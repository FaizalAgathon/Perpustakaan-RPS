<?php

require 'koneksi.php';

$keyword = $_GET['keyword'];

$sqlCari = "SELECT * FROM buku WHERE 
  nama LIKE '%$keyword%'
  ";

// if ( isset($keyword) ) :

  $siswaNama = $_GET['nama'];
  $siswaKelas = $_GET['kelas'];
  $siswaKontak = $_GET['kontak'];
  // $siswaKontak = strval($siswaKontak);

  $daftarSiswa = query("SELECT * FROM siswa s INNER JOIN
    kelas k ON s.idKelas = k.idKelas 
    WHERE namaSiswa = '$siswaNama' AND
    namaKelas = '$siswaKelas' AND 
    kontakSiswa = '$siswaKontak'")[0];

// echo $keyword;

// var_dump(query("SELECT * FROM buku"));

?>

<ul class="list-group" id="list">
  <?php foreach (query($sqlCari) as $buku) : ?>

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
                          Nama : <?= $daftarSiswa['namaSiswa'] ?>
                        </p>
                        <input type="hidden" name="nama" value="<?= $daftarSiswa['namaSiswa'] ?>">
                      </div>
                      <div class="mb-3">
                        <p for="kontak" class="form-label">
                          Kontak : <?= $daftarSiswa['kontakSiswa'] ?>
                        </p>
                        <input type="hidden" name="kontak" value="<?= $daftarSiswa['kontakSiswa'] ?>">
                      </div>
                      <div class="mb-3">
                        <p for="kelas" class="form-label">
                          Kelas : <?= $daftarSiswa['namaKelas'] ?>
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

  <?php endforeach; //endif; ?>
</ul>