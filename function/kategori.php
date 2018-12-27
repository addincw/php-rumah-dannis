<?php
	require_once "koneksi.php";

	function read_kategori_byId($id){
		$query=mysqli_query(conn(), "SELECT * FROM kategori WHERE ID_kategori = '$id'");
		$hasil = mysqli_fetch_array($query);
		return $hasil;
	}

	function read_kategori(){
		$query=mysqli_query(conn(), "SELECT * FROM kategori");
		return $query;
	}
?>
