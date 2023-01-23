<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peminjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/stylePeminjam.css">
  </head>
  <body>

  <?php include 'header-menu-admin.php'; ?>

    <!-- AWAL TABEL -->
    <div class="container mt-4">
        <br>
        <!-- AWAL TABEL PEMINJAM -->
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
    
            <tr class="text-center">
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="" class="kontak">
                        
                    </a>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="" onclick="return confirm('Yakin ingin mengebalikan buku?')">
                        <img src="../icon/left-arrow.png" width="30rem" alt="">
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan="8" align="center"> Tidak ada Yang Meminjam buku</td>
            </tr>
        </table>
        <!-- AKHIR TABEL PEMINJAM -->
        <br>
        <!-- AWAL TABEL HISTORY -->
        <h5 class="fw-bold text-white text-center">History :</h5>
        <div class="btn-group dropstart mb-2 mt-0" style="float: right;">
            <button type="button" class="dropdown-toggle border-0 bg-transparent fw-semibold" data-bs-toggle="dropdown" aria-expanded="false">
              Sort By
            </button>
            <ul class="dropdown-menu text rounded-4">
              <li class="">
                <button class="dropdown-item">A-Z</button>
              </li>
              <li>
                <button class="dropdown-item">Z-A</button>
              </li>
              <li>
                <button class="dropdown-item">Date</button>
              </li>
            </ul>
        </div>
        <table class="table table-light table-striped">
          <tr class="text-center">
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Kontak</th>
            <th>Buku</th>
            <th>Waktu Peminjaman</th>
            <th>Waktu Pengembalian</th>
          </tr>
  
            <tr class="text-center">
              <td></td>
              <td></td>
              <td></td>
              <td><a href="" class="kontak"></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td colspan="8" align="center"> Tidak ada Histori yang tersedia</td>
            </tr>

        </table>
        <!-- AKHIR TABEL HISTORY -->
    </div>
    <!-- AKHIR TABEL -->
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