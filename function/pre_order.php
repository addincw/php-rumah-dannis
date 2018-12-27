<?php
	require_once "koneksi.php";

	function createid_order($status_beli){
			$query = mysqli_query(conn(), "SELECT MAX(cast((substring(ID_PSN,13)) AS unsigned)) as ID_PSN FROM `PEMESAN`");
			$pemesanan = mysqli_fetch_array($query);
			$number=$pemesanan['ID_PSN']+1;
			$id = "OR".date('Ymd').$status_beli."U".$number;
	    return $id;
  }

	function insertPesan($ID_PSN, $ID_KONS, $ID_KAR, $TGL_PSN, $STATUS_PSN, $KONFIRMASI_PSN, $TOTAL, $jenis_psn){
    $insert=mysqli_query(conn(), "INSERT INTO `pemesan` (`ID_PSN`, `ID_KONS`, `ID_KAR`, `TGL_PSN`, `STATUS_PSN`, `KONFIRMASI_PSN`, `TOTAL`, `JENIS_PSN`)
    VALUES ('$ID_PSN', '$ID_KONS', '$ID_KAR', '$TGL_PSN', NULL, NULL, '$TOTAL', '$jenis_psn')");
    if($insert == false){
      $value=false;
    }else{
      $value=true;
    }

			return $value;
	}

	function insertDetail_pesan($ID_PSN, $ID_BARANG, $HARGA, $JUMLAH, $TOTAL){

		$insert=mysqli_query(conn(), "INSERT INTO `rumahdannis`.`detail_pesan` (`ID_PSN`, `ID_BARANG`, `HARGA`, `JUMLAH`, `TOTAL`)
		VALUES ('$ID_PSN', '$ID_BARANG', '$HARGA', '$JUMLAH', '$TOTAL')");

			if($insert == false){
				$value=false;
			}

			else{
				$value=true;
			}

			return $value;
	}

	function get_Allpesan(){
		$sql = mysqli_query(conn(), "select * from pemesan");
		return $sql;
	}

	function get_pesanby_id($id){
		$sql = mysqli_query(conn(), "select * from pemesan where ID_PSN = '$id'");
		$hasil = mysqli_fetch_array($sql);
		return $hasil;
	}

	function get_detailpesanby_id($id){
		$sql = mysqli_query(conn(), "select * from detail_pesan where ID_PSN = '$id'");
		return $sql;
	}

	function update_konfirmasipesan($id, $status){
		$sql = mysqli_query(conn(), "UPDATE `pemesan` SET `KONFIRMASI_PSN` = '$status' WHERE `pemesan`.`ID_PSN` = '$id'");
		return $sql;
	}
/*

function get_detailjualby_id_idbarang($id, $id_barang){
$sql = mysqli_query(conn(), "select * from detail_jual where id_jual = '$id' and id_barang = '$id_barang'");
$hasil = mysqli_fetch_array($sql);
return $hasil;
}


*/



?>
