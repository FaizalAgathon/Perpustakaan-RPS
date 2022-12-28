<?php
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

    //Hapus Data Pengembalian
    function hapus($id_pengembalian){
        global $conn;
        $hapus = "DELETE FROM pengembalian WHERE id_pengembali = $id_pengembalian";
        mysqli_query($conn, $hapus);
        return mysqli_affected_rows($conn);
    }

    //Batas Waktu Pengembalian
    function bataswaktu($ubah, $batas){
        $bataswaktu = date("Y-m-j", $ubah +60*60*24*$batas);
        return $bataswaktu;
    }

    // login
    function login( $user_username, $user_password, $db_username, $db_password ){
        if( $user_username == $db_username && $user_password == $db_password ){
            ?>
            <script type="text/javascript">alert("berhasil masuk");
            </script>
            <?php
        }
        else if ( $user_username == $db_username && !($user_password == $db_password) ){
            ?>
            <script type="text/javascript">alert("Username Dan Password Anda Tidak Valid");
            window.location="login.php";
            </script>
            <?php
        }
        else{
            ?>
            <script type="text/javascript">alert("Anda Tidak Memasukan apa apa");
            window.location="login.php";
            </script>
            <?php
        }
    }

?>