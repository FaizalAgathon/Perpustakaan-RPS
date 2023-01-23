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

?>