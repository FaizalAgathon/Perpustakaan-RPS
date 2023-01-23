<?php 

require '../koneksi.php';

// SECTION cek apakah sudah login belom
if (!(isset($_SESSION['login'])) ) {
    // redirect (memindahkan user nya ke page lain)
    header("Location: ../login-daftar/login_admin.php");
    exit;
  
  }

// !SECTION cek apakah sudah login belom

// SECTION pagination feedback
$dataPerhalaman = 5;
$jumlahData =  count(query("SELECT * FROM feedback"));

$jumlahHalaman = ceil($jumlahData / $dataPerhalaman);

$halamanAktif = isset( $_GET['halamanFeedback']) ? $_GET['halamanFeedback'] : 1;

$awalData = ($dataPerhalaman * $halamanAktif) - $dataPerhalaman;

// !SECTION pagination feedback


// SECTION Tampilkan unek unek

    $dataKomen = query("SELECT * FROM feedback LIMIT $awalData, $dataPerhalaman");

// !SECTION Tampilkan unek unek


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/feedback.css">
  </head>
  <body>
    <!-- HEADER -->
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
    <!-- AKHIR HEADER -->
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
                <a class="nav-link" href="tambahbuku.php">
                    <img src="../icon/book2.png" width="35rem" alt="" class="ms-4"><br>
                    Tambah Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark text-decoration-underline" href="feedback.php">
                    <img src="../icon/chat.png" width="35rem" alt="" class="ms-3"><br>
                    Feedback
                </a>
            </li>
        </ul>
    </div>
    <!-- AKHIR MENU -->
    <!-- AWAL FEEDBACK -->
    <div class="container mt-4">
        <br>
        <h5 class="fw-bold text-white text-center">Daftar Saran & Kritik :</h5>
        <!-- SECTION pagination peminjaman-->
        <div aria-label="Page navigation example" > 
            <ul class="pagination">
                <?php if ( $halamanAktif > 1 ) : ?>
                    <li class="page-item"><a class="page-link" href="?halamanFeedback=<?=$halamanAktif - 1 ?>">Previous</a></li>
                <?php endif ; ?>

                <?php for( $i=1; $i<=$jumlahHalaman; $i++) : ?>
                    <?php if ( $i == $halamanAktif ) : ?>
                        <li class="page-item active"><a class="page-link" href="?halamanFeedback=<?= $i ?>"><?= $i ?></a></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link" href="?halamanFeedback=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif ; ?>
                <?php endfor ; ?>
                
                <?php if ( $halamanAktif < $jumlahHalaman ) : ?>
                    <li class="page-item"><a class="page-link" href="?halamanFeedback=<?=$halamanAktif + 1 ?>">Next</a></li>
                <?php endif ; ?>
            </ul>
        </div>
        <!-- !SECTION pagination peminjaman-->

        <div class="bg-light p-2 mb-3 rounded rounded-3"
        style="box-shadow: 5px 5px 5px rgb(120, 120, 120);
        height: fit-content;">
        <?php $i=1; ?>
        <?php foreach( $dataKomen as $dtKomen ) : ?>
            <p>
                <?=$i?>.<?= $dtKomen['isi']; ?> <br>
                <div> Tanggal : <?= $dtKomen['tglDibuat']; ?> </div>
            </p>
            <hr>
        <?php $i++; ?>
        <?php endforeach ; ?>
        </div>
    </div>
    <!-- AKHIR FEEDBACK -->
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