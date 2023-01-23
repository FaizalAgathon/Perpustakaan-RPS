<?php

require 'koneksi.php';

// if (isset($_SESSION["login"])) {
//   header("Location: admin.php");
//   exit;
// }

// Cek apakah sudah login atau belom

// if (isset($_POST['login'])) {

//   $username = $_POST['username'];
//   $password = $_POST['password'];

//   $result = mysqli_query($conn, "SELECT * FROM admin WHERE username= '$username'");

//   if (mysqli_num_rows($result) === 1) {

//     foreach ($result as $row) {
//       if ($row['username'] == $username && $row['password'] == $password) {
//         header("Location: admin.php");
//         $_SESSION['login'] = true;
//         exit;
//       }
//     }
//   }
// }

// $eror = true;

// if ($eror && isset($_POST['login'])) {
?>
    <!-- <script type="text/javascript"> -->
    <!-- alert("Username atau Password tidak valid"); -->
    <!-- </script> -->
<?php
// }

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="login_style.css">
</head>

<body>

  <form action="index.php" method="post" class="m-auto my-5 p-3 rounded-5">
    <div class="d-flex justify-content-center m-0">
      <img src="assets/images/SMKN 1 Cirebon.png" alt="">
    </div>

    <h2 class="text-center pb-3">Pendaftaran Siswa</h2>

    <div class="mb-3 px-3 mt-5">
      <label for="nama" class="form-label">Nama :</label>
      <input type="text" name="nama" class="form-control border-0 border-bottom" id="nama" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
      <label for="kelas" class="form-label">Kelas :</label>
      <br>
      <?php foreach ($LoginKelas = query("SELECT * FROM kelas") as $kelas) : ?>
        <input class="form-check-input" type="radio" name="kelas" id="<?= $kelas['namaKelas'] ?>" value="<?= $kelas['namaKelas'] ?>">
        <label class="form-check-label me-3" for="<?= $kelas['namaKelas'] ?>">
          <?= $kelas['namaKelas'] ?>
        </label>
      <?php endforeach; ?>
      <br>
    </div>

    <div class="mb-3 px-3">
      <label for="kontak" class="form-label">Kontak :</label>
      <input type="number" name="kontak" class="form-control border-0 border-bottom" id="kontak">
    </div>

    <br>

    <div class="d-grid gap-2">
      <input type="hidden" name="daftar" value="daftar">
      <button type="submit" name="login" class="btn rounded-pill text-white fw-bold">Daftar</button>
    </div>

    <footer class="main-footer " style="padding-top: 10px;">
      <div class="text-center">
        <a href="index.php">Login disini</a>
        <a href="http://smkn1-cirebon.sch.id" class="txt2 hov1 text-decoration-none text-dark" target="_blank">
          © 2022 SMK Negeri 1 Cirebon
        </a>
      </div>
    </footer>

    <p class="text-center"><small>- Support By XI RPL 2 -</small></p>

  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>