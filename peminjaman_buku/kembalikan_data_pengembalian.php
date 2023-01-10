<?php
    require 'koneksi.php';
    
    //Menentukan baris pada table
    $idpengembali = $_GET['id_pengembali'];

    //Mengambil data dari table
    $histori = query("SELECT * FROM pengembalian WHERE id_pengembali='$idpengembali'");
    foreach($histori as $hstr){
        $namahstr = $hstr['nama_pengembali'];
        $kelashstr = $hstr['kelas_pengembali'];
        $kontakhstr = $hstr['kontak_pengembali'];
        $bukuhstr = $hstr['id_buku'];
        $waktupeminjamanhstr = $hstr['waktu_peminjaman'];
        $waktupengembalianhstr = date("Y-m-j");
    }
    $tambah = "INSERT INTO histori VALUES('', '$namahstr', '$kelashstr', '$kontakhstr', '$bukuhstr', '$waktupeminjamanhstr', '$waktupengembalianhstr')";
    mysqli_query($conn, $tambah);


    //Menghapus Data Pengembalian
    $hapus = "DELETE FROM pengembalian WHERE id_pengembali='$idpengembali'";
    mysqli_query($conn, $hapus);

    if( hapus($idpengembali) > 0 ){
        echo "
        <script>
        alert('Data Tidak Berhasil dihapus');
        document.location.href = 'login.php';
        </script>
        ";
    } else {
        echo"
        <script>
        alert('Terima Kasih Telah Membaca Buku');
        document.location.href = 'login.php';
        </script>
        ";
    }

?>