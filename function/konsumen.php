<?php
	require_once "koneksi.php";

  function createid_konsumen($id,$tabel,$nama, $urutan){
    $query=mysqli_query(conn(), "select max($id) from $tabel");
    $id=mysqli_fetch_array($query);
    $getangka=substr($id[0],$urutan);
      if($getangka < 9){
        $id=$nama."00".($getangka+1);
      }

      if($getangka >= 9 && $getangka <= 99){
        $id=$nama."0".($getangka+1);
      }

      if($getangka >= 99 && $getangka <= 999){
        $id=$nama.($getangka+1);
      }

      return $id;
  }

  function registrasi_konsumen($id, $nama, $alamat, $telpon, $email, $username, $pass, $kota, $tgl_lahir, $jenis_kelamin, $rekening_kons){
		$insert=mysqli_query(conn(), "INSERT INTO `konsumen` (`ID_KONS`, `NM_KONS`, `ALM_KONS`, `TELP_KONS`, `USER_KONS`, `PASS_KONS`, `ID_KOTA`, `EMAIL_KONS`, `TGL_LAHIR`, `JENIS_KELAMIN`, `REKENING_KONS`)
      VALUES ('$id', '$nama', '$alamat', '$telpon', '$username', '$pass', '$kota', '$email', '$tgl_lahir', '$jenis_kelamin', '$rekening_kons')");
	}

	function read_allKonsumen(){
		$sql = mysqli_query(conn(), "SELECT * FROM `konsumen`");
		return $sql;
	}

	function read_Konsumenby_username($username){
		$sql = mysqli_query(conn(), "SELECT * FROM `konsumen` WHERE USER_KONS = '$username'");
		$hasil = mysqli_fetch_array($sql);
		return $hasil;
	}

	function read_Konsumenby_id($id_kons){
		$sql = mysqli_query(conn(), "SELECT * FROM `konsumen` WHERE ID_KONS = '$id_kons'");
		$hasil = mysqli_fetch_array($sql);
		return $hasil;
	}

	function read_Kotaby_id($id_kota){
		$sql = mysqli_query(conn(), "SELECT * FROM `kota` WHERE ID_KOTA = '$id_kota'");
		$hasil = mysqli_fetch_array($sql);
		return $hasil;
	}


?>
