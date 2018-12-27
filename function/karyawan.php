<?php
	require_once "koneksi.php";

	function read_Karyawanby_Userpass($username, $password){
		$sql = mysqli_query (conn(), "SELECT * FROM `karyawan` WHERE USER_KAR = '$username' AND PASS_KAR = '$password'");
		$hasil = mysqli_fetch_array($sql);
		return $hasil;
	}
?>
