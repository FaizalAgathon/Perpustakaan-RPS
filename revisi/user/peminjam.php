<?php 

require '../koneksi.php';

if ( isset($_POST['pinjam']) ){

  $idBuku = $_POST['idBuku'];
  
  $namaPeminjam = $_POST['nama'];
  $kelasPeminjam = $_POST['kelas'];
  $kontakPeminjam = $_POST['kontak'];
  
  $idKelas = query("SELECT idKelas FROM kelas WHERE namaKelas = '$kelasPeminjam'")[0];
  $idSiswa = query("SELECT idSiswa FROM siswa 
    WHERE idKelas = $idKelas[idKelas] AND 
    namaSiswa = '$namaPeminjam' AND 
    kontakSiswa = '$kontakPeminjam'")[0];

  $waktuRT = date('Y-m-d');
  
  $peminjaman = mysqli_query($conn,"INSERT INTO peminjaman 
    VALUES (NULL,'$idSiswa[idSiswa]','$idBuku','$waktuRT')");
  
  if ( $peminjaman ){
    $buku = query("SELECT * FROM buku WHERE id = $idBuku")[0];
    $jumlahBuku = $buku['jumlah'] - 1;
    mysqli_query($conn,"UPDATE buku SET jumlah = $jumlahBuku
      WHERE id = $idBuku");
    mysqli_query($conn,"UPDATE buku SET jumlah_dipinjam = $buku[jumlah_dipinjam] + 1
      WHERE id = $idBuku");
  }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peminjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css_user/stylePeminjam.css">
  </head>
  <body>
    <!-- HEADER -->
    <!-- <nav class="navbar bg-white judul">
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
                                <img src="../icon/logout.png" width="30rem" alt="">Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav> -->
    <!-- MENU -->
    <!-- <div class="container">
        <ul class="nav justify-content-center mt-3 border rounded-pill bg-white" style="box-shadow: 5px 5px 5px #c5c5c5;">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="home.html">
                    <img src="../icon/book1.png" width="35rem" alt="" class="ms-4"><br>
                    Daftar Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark text-decoration-underline" href="peminjam.html">
                    <img src="../icon/reader.png" width="35rem" alt="" class="ms-3"><br>
                    Peminjam
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#footer">
                    <img src="../icon/chat.png" width="35rem" alt="" class="ms-3"><br>
                    Feedback
                </a>
            </li>
        </ul>
    </div> -->
    <!-- AKHIR MENU -->

    <?php include 'header-menu-user.php'; ?>

    <!-- AWAL TABEL -->
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
            </tr>
            <tr class="text-center">
              <td></td>
              <td></td>
              <td></td>
              <td><a href="https://api.whatsapp.com/" class="kontak"></a></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td colspan="8" align="center"> Tidak ada Yang Meminjam buku</td>
            </tr>
        </table>
    </div>
      <!-- AKHIR TABEL -->
      <!-- AWAL FOOTER -->
    <div class="bg-dark mt-3 p-1 pt-2 w-100" id="footer" style="margin-bottom: -2rem;">
        <div class="row w-100">
            <div class="col ms-2 me-0 mt-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15849.134770711997!2d108.5367314!3d-6.735204!3m2!
                1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x51cf481547b4b319!2sSMK%20Negeri%201%20Cirebon!5e0!3m2!1sid!2sid!4v1674230224751!5m2!1sid!2sid" 
                width="400" height="350" style="border:0;" allowfullscreen="" class="rounded-4" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col mt-3 border rounded-4" style="box-shadow: 3px 3px 5px rgb(201, 201, 201);">
                <div class="p-2">
                    <p class="text-white mb-0">Kritik Dan Saran :</p><br>
                    <textarea class="form-control w-75 bg-light" aria-label="With textarea"></textarea>
                    <button type="submit" class="mt-2 btn btn-light py-0">
                        <img src="../icon/send.png" width="20rem" alt="">
                        Kirim
                    </button>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>