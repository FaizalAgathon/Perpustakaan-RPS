<?php

require '../koneksi.php';

// cek apakah sudah login belom
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
    <title>Add book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styletambah.css">
  </head>
  <body>
    <!-- AWAL HEADER -->
    <nav class="navbar bg-white judul">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 ms-4" href="#">
                <img src="../../../peminjaman_buku/assets/images/SMKN 1 Cirebon.png" alt="Bootstrap" width="70" height="70">
                Peminjamaan Buku
            </a>
            <div class="d-flex">
                <button class="border-0 bg-white fw-bold rounded-pill" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <img src="../icon/profile.png" width="40rem" alt="" class="bg-light rounded-pill p-0 py-1 pe-1">Profile
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <img src="../icon/profile.png" width="100rem" alt="" class="mb-3">
                        <p>Muhammad Azis Nurfajari</p>
                        <p>XI RPL 2</p>
                        <p>0858-6280-0579</p>
                        <div class="footer">
                            <button class="border-0 bg-white fw-bold">
                            <a href="../login-daftar/logout.php"><img src="../icon/logout.png" width="30rem" alt="">Logout</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- AKHIR TABEL -->
    <!-- AWAL MENU -->
    <div class="container">
        <ul class="nav justify-content-center mt-3 border rounded-pill bg-white" style="box-shadow: 5px 5px 5px #c5c5c5;">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="admin.php">
                    <img src="../icon/book1.png" width="35rem" alt="" class="ms-4"><br>
                    Daftar Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="peminjam.php">
                    <img src="../icon/reader.png" width="35rem" alt="" class="ms-3"><br>
                    Peminjam
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark text-decoration-underline" href="tambahbuku.php">
                    <img src="../icon/book2.png" width="35rem" alt="" class="ms-4"><br>
                    Tambah Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="feedback.php">
                    <img src="../icon/chat.png" width="35rem" alt="" class="ms-3"><br>
                    Feedback
                </a>
            </li>
        </ul>
    </div>
    <!-- AKHIR MENU -->
    <!-- AWAL FORM TAMBAH BUKU -->
    <div class="container mt-3 mb-3">
        <form action="admin.php" class="bg-light p-3 tambah w-50 m-auto rounded-4" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="mb-3">
                <label for="judul" class="form-label">Judul :</label>
                <input type="text" class="form-control rounded-4 border-bottom border-2" id="judul" name="judul">
              </div>
              <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi :</label>
                <input type="text" class="form-control rounded-4 border-bottom border-2" id="deskripsi" name="deskripsi">
              </div>
              <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit :</label>
                <input type="text" class="form-control rounded-4 border-bottom border-2" id="penerbit" name="penerbit">
              </div>
              <div class="mb-3">
                <label for="penulis" class="form-label">Penulis :</label>
                <input type="text" class="form-control rounded-4 border-bottom border-2" id="penulis" name="penulis">
              </div>
              <div class="mb-3">
                <label for="tglTerbit" class="form-label">Tanggal Terbit :</label>
                <input type="date" class="form-control rounded-4 border-bottom border-2 w-50" id="tglTerbit" name="tglTerbit">
              </div>
              <div class="mb-3">
                <label for="gambar" class="form-label">Gambar :</label>
                <input type="file" class="form-control form-control-sm w-50" id="gambar" name="gambar" accept=".png,.jpg,.jpeg,.gif,.JPG,.PNG,.JPEG,.GIF">
              </div>
              <div class="mb-3">
                <label for="jmlBuku" class="form-label">Jumlah Buku :</label>
                <input type="text" class="form-control rounded-4 border-3 w-25 py-0" id="jmlBuku" name="jumlah">
              </div>
            </div>
            <div class="modal-footer input-group border-0">
              <button type="reset" class="btn btn-light btn-sm align-center border w-50 rounded-pill rounded-end py-0 fw-semibold">
                <img src="../icon/cross-button.png" width="18rem" alt=""><br>
                Cancel
              </button>
              <input type="hidden" name="tambahBuku" value="---">
              <button type="submit" class="btn btn-light border btn-sm align-center w-50 rounded-pill rounded-start py-0 fw-semibold">
                <img src="../icon/upload.png" width="18rem" alt=""><br>
                Submit
              </button>
            </div>
          </form>
    </div>
    <!-- AKHIR FORM TAMBAH BUKU -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>