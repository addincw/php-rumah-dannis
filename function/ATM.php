<?php
	require_once "koneksi.php";

  function createid_atm(){
    $query=mysqli_query(conn(), "select max(id_atm) from atm");
    $row = mysql_fetch_array($query);
    $id = $row[0]+1;
    return $id;
  }

  function insert_newATM($id, $nama, $no_rekening){
		$insert=mysqli_query(conn(), "INSERT INTO `atm` (`ID_ATM`, `NAMA`, `NOMOR_REKENING`)
      VALUES ('$id', '$nama', '$no_rekening')");
	}

	function read_allATM(){
		$sql = mysqli_query(conn(), "SELECT * FROM `atm`");
		return $sql;
	}

	function read_ATMby_id($id){
		$sql = mysqli_query(conn(), "SELECT * FROM `atm` where id_atm = '$id'");
		$hasil = mysqli_fetch_array($sql);
		return $hasil;
	}

?>
