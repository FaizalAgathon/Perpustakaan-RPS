<?php

session_start();

    // Koneksi ke Database
    $conn = mysqli_connect("localhost", "root", "", "perpus_padudung");

    //Data Pengembalian
    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while( $row = mysqli_fetch_assoc($result) ){
            $rows[] = $row;
        }
        return $rows;
    }

    //Batas Waktu Pengembalian
    function bataswaktu($ubah, $batas){
        $bataswaktu = date("Y-m-j", $ubah +60*60*24*$batas);
        return $bataswaktu;
    }


    // SECTION search pada peminjaman admin
    function cari( $keyword, $awalData2, $dataPerhalaman2 ){

        $query = "SELECT * FROM
                    histori h INNER JOIN
                    siswa s ON s.idSiswa = h.idSiswa INNER JOIN
                    kelas k ON s.idkelas = k.idKelas INNER JOIN
                    buku b ON h.idBuku = b.id AND s.idSiswa = h.idSiswa
                    WHERE s.namaSiswa LIKE '%$keyword%' OR 
                    k.namaKelas LIKE '%$keyword%' OR
                    b.nama LIKE '%$keyword%'
                    LIMIT $awalData2, $dataPerhalaman2";

        return query($query);
    }
    // !SECTION search pada peminjaman admin


// SECTION Sort by pada peminjaman admin

    function urutan( $waktu, $urutan, $awalData2, $dataPerhalaman2 ){

        $query = "SELECT *
                    FROM
                    histori h INNER JOIN
                    siswa s ON s.idSiswa = h.idSiswa INNER JOIN
                    kelas k ON s.idkelas = k.idKelas INNER JOIN
                    buku b ON h.idBuku = b.id AND s.idSiswa = h.idSiswa
                    ORDER BY $waktu $urutan LIMIT $awalData2, $dataPerhalaman2 ";

        return query($query) ;
    }

// !SECTION Sort by pada peminjaman admin

// SECTION tambah data feedback

if(isset($_POST['feedback'])){

    $komen = $_POST['komen'];
    $waktuKomen = date("Y-m-d");

    $qry = sprintf("INSERT INTO feedback(id, isi, tgl) VALUES (NULL, '%s', '$waktuKomen') ", $komen);

if ( $_POST['param'] == "home") {
    mysqli_query($conn, $qry);
    header("Location: home.php");
    exit;
} 
if ( $_POST['param'] == "peminjaman") {
    mysqli_query($conn, $qry);
    header("Location: user/peminjam.php");
    exit;
}


}

// !SECTION tambah data feedback

?>

