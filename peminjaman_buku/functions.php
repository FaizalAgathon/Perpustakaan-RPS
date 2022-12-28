<?php 

$link = mysqli_connect("localhost","root","","perpus_padudung");

function query($sql){
	global $link;

	$hsl = mysqli_query($link, $sql);
	$rows = [];

	while( $row = mysqli_fetch_assoc($hsl) ){
		$rows[] = $row;
	}
	return $rows;
}
// }
// function cariGuru($keyword){
//   global $link;

//   $sqlCari = "SELECT * FROM guru_and_tu WHERE
//               kode_guru LIKE '%$keyword%' OR
//               nama_guru LIKE '%$keyword%' OR
//               nip_guru LIKE '%$keyword%' OR
//               tempat_tgl_lahir_guru LIKE '%$keyword%' OR
//               jabatan_guru LIKE '%$keyword%'";

//   return mysqli_query($link,$sqlCari);
// }
// function cariSiswa($kelas,$keyword){
//   global $link;

//   $sqlCari = "SELECT * FROM $kelas WHERE
//               absen_siswa LIKE '%$keyword%' OR
//               nis_siswa LIKE '%$keyword%' OR
//               nama_siswa LIKE '%$keyword%'";
              
//   return mysqli_query($link,$sqlCari);
// }
// function hapus($id,$tabel){
//   global $link;

//   $sql = "DELETE FROM $tabel WHERE id_siswa = $id";
//   mysqli_query($link,$sql);

//   return mysqli_affected_rows($link);
// }
// function cekNis($nis){
//   global $link;
//   global $tabel;
  
//   return mysqli_num_rows (
//     mysqli_query($link,"SELECT nis_siswa FROM $tabel WHERE nis_siswa like $nis"));
// }
// function cekNIP($nip){
//   global $link;
  
//   return mysqli_num_rows (
//     mysqli_query($link,"SELECT id_guru FROM guru_and_tu WHERE id_guru like $nip"));
// }

?>