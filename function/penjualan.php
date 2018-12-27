<?php
	require_once "koneksi.php";

	function createid_penjualan($id,$tabel,$nama, $urutan){
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

		function createid_jual($status_beli){
				$query = mysqli_query(conn(), "SELECT MAX(cast((substring(ID_JUAL,13)) AS unsigned)) as ID_JUAL FROM `penjualan`");
				$penjualan = mysqli_fetch_array($query);
				$number=$penjualan['ID_JUAL']+1;
				$id = "TR".date('Ymd').$status_beli."U".$number;
		    return $id;
		  }



	function insertJual($id_jual ,$id_kar, $id_kons, $id_psn, $id_atm, $tgl_jual, $jenis_jual, $status, $total, $rekening_kons){
		if($id_atm == NULL){
			if (!is_null($id_psn)) {
				$insert=mysqli_query(conn(), "INSERT INTO `penjualan` (`ID_JUAL`, `ID_KAR`, `ID_KONS`, `ID_PSN`, `ID_ATM`, `TGL_PESAN`, `JENIS_JUAL`, `STATUS`, `TOTAL`)
				VALUES ('$id_jual', '$id_kar', '$id_kons', '$id_psn', NULL, '$tgl_jual', '$jenis_jual', '$status', '$total')");
			}else {
				$insert=mysqli_query(conn(), "INSERT INTO `penjualan` (`ID_JUAL`, `ID_KAR`, `ID_KONS`, `ID_ATM`, `TGL_PESAN`, `JENIS_JUAL`, `STATUS`, `TOTAL`)
				VALUES ('$id_jual', '$id_kar', '$id_kons', NULL, '$tgl_jual', '$jenis_jual', '$status', '$total')");
			}

				if($insert == false){
					$value=false;
				}else{
					$value=true;
				}

		}else {
			if (!is_null($id_psn)) {
				$insert=mysqli_query(conn(), "INSERT INTO `penjualan` (`ID_JUAL`, `ID_KAR`, `ID_KONS`, `ID_PSN`,`ID_ATM`, `TGL_PESAN`, `JENIS_JUAL`, `STATUS`, `TOTAL`, `REKENING_KONS`)
				VALUES ('$id_jual', '$id_kar', '$id_kons', '$id_psn', '$id_atm', '$tgl_jual', '$jenis_jual', '$status', '$total', '$rekening_kons')");
			}else {
				$insert=mysqli_query(conn(), "INSERT INTO `penjualan` (`ID_JUAL`, `ID_KAR`, `ID_KONS`, `ID_ATM`, `TGL_PESAN`, `JENIS_JUAL`, `STATUS`, `TOTAL`, `REKENING_KONS`)
				VALUES ('$id_jual', '$id_kar', '$id_kons', '$id_atm', '$tgl_jual', '$jenis_jual', '$status', '$total', '$rekening_kons')");
			}

				if($insert == false){
					$value=false;
				}else{
					$value=true;
				}

		}

			return $value;
	}

	function insertDetail_jual($id_jual,$id_barang,$harga_jual, $harga_beli, $jumlah, $subtotal, $status){

		$insert=mysqli_query(conn(), "INSERT INTO `detail_jual` (`ID_JUAL`, `ID_BARANG`, `HARGA_JUAL`, `HARGA_BELI`, `JUMLAH`, `HARGA_TOTAL`)
												 VALUES ('$id_jual', '$id_barang', '$harga_jual', '$harga_beli', '$jumlah', '$subtotal')");

			if($insert == false){
				$value=false;
			}

			else{
				$value=true;
			}

			return $value;
	}

	function get_penjualanby_id($id){
		$sql = mysqli_query(conn(), "select * from penjualan where id_jual = '$id'");
		$hasil = mysqli_fetch_array($sql);
		return $hasil;
	}

	function get_Allpenjualan(){
		$sql = mysqli_query(conn(), "SELECT * FROM `penjualan`");
		return $sql;
	}

	function get_penjualanby_date($tglawal, $tglakhir){
		$sql = mysqli_query(conn(), "SELECT * FROM `penjualan` WHERE TGL_PESAN between '$tglawal' and '$tglakhir'");
		return $sql;
	}

	function get_penjualanby_jenisJual($tglawal = NULL, $tglakhir = NULL){
		if($tglawal == NULL && $tglakhir == NULL){
			$sql = mysqli_query(conn(), "SELECT JENIS_JUAL, COUNT(`penjualan`.JENIS_JUAL) as JUMLAH_TRANSAKSI, SUM(`pembayaran`.`TOTAL_PEMBAYARAN`) as TOTAL_TRANSAKSI
			FROM `penjualan`,`pembayaran` WHERE `penjualan`.`ID_JUAL`=`pembayaran`.`ID_JUAL` AND `pembayaran`.`STATUS_PEMBAYARAN`='2' GROUP BY JENIS_JUAL");
		}else {
			$sql = mysqli_query(conn(), "SELECT JENIS_JUAL, COUNT(`penjualan`.JENIS_JUAL) as JUMLAH_TRANSAKSI, SUM(`pembayaran`.`TOTAL_PEMBAYARAN`) as TOTAL_TRANSAKSI
			FROM `penjualan`,`pembayaran` WHERE `penjualan`.`ID_JUAL`=`pembayaran`.`ID_JUAL` AND `pembayaran`.`STATUS_PEMBAYARAN`='2'
			AND `penjualan`.TGL_PESAN between '$tglawal' and '$tglakhir' GROUP BY JENIS_JUAL");
		}

		return $sql;
	}

	function get_barang_terlaris($tglawal = NULL, $tglakhir = NULL){
		if ($tglawal == NULL && $tglakhir == NULL) {
			$sql = mysqli_query(conn(), "SELECT `detail_jual`.ID_BARANG, `barang`.`ID_KATEGORI`, COUNT(`detail_jual`.ID_BARANG) as BANYAK_TERJUAL
			FROM `detail_jual`, `barang`, `penjualan`, `pembayaran` WHERE `detail_jual`.`ID_BARANG`=`barang`.`ID_BARANG` AND `detail_jual`.`ID_JUAL`=`penjualan`.`ID_JUAL`
			AND `penjualan`.`ID_JUAL`=`pembayaran`.`ID_JUAL` AND `pembayaran`.`STATUS_PEMBAYARAN`=2 GROUP BY `detail_jual`.ID_BARANG ORDER by BANYAK_TERJUAL DESC LIMIT 3");
		}
		else {
			$sql = mysqli_query(conn(), "SELECT `detail_jual`.ID_BARANG, `barang`.`ID_KATEGORI`, COUNT(`detail_jual`.ID_BARANG) as BANYAK_TERJUAL FROM `detail_jual`, `barang`, `penjualan`, `pembayaran`
			WHERE `detail_jual`.`ID_BARANG`=`barang`.`ID_BARANG` AND `detail_jual`.`ID_JUAL`=`penjualan`.`ID_JUAL` AND `penjualan`.`ID_JUAL`=`pembayaran`.`ID_JUAL`
			AND `pembayaran`.`STATUS_PEMBAYARAN`=2 AND `penjualan`.TGL_PESAN
			between '$tglawal' and '$tglakhir' AND `detail_jual`.`ID_JUAL`=`penjualan`.`ID_JUAL` GROUP BY `detail_jual`.ID_BARANG
			ORDER by BANYAK_TERJUAL DESC LIMIT 3");
		}

		return $sql;
	}

	function get_kategori_terlaris($tglawal = NULL, $tglakhir = NULL){
		if ($tglawal == NULL && $tglakhir == NULL) {
			$sql = mysqli_query(conn(), "SELECT `barang`.`ID_KATEGORI`, COUNT(`barang`.`ID_KATEGORI`) as BANYAK_TERJUAL FROM `detail_jual`, `barang`, `penjualan`, `pembayaran`
			WHERE `penjualan`.`ID_JUAL`=`pembayaran`.`ID_JUAL` AND `pembayaran`.`STATUS_PEMBAYARAN`='2' AND `detail_jual`.`ID_BARANG`=`barang`.`ID_BARANG` AND `detail_jual`.`ID_JUAL`=`penjualan`.`ID_JUAL` GROUP BY `barang`.`ID_KATEGORI`
			ORDER by BANYAK_TERJUAL DESC LIMIT 3");
		}
		else {
			$sql = mysqli_query(conn(), "SELECT `barang`.`ID_KATEGORI`, COUNT(`barang`.`ID_KATEGORI`) as BANYAK_TERJUAL FROM `detail_jual`, `barang`, `penjualan`, `pembayaran` WHERE `penjualan`.`ID_JUAL`=`pembayaran`.`ID_JUAL` AND `pembayaran`.`STATUS_PEMBAYARAN`='2'
			AND `detail_jual`.`ID_BARANG`=`barang`.`ID_BARANG` AND `detail_jual`.`ID_JUAL`=`penjualan`.`ID_JUAL` AND `penjualan`.TGL_PESAN
			between '$tglawal' and '$tglakhir' GROUP BY `barang`.`ID_KATEGORI`
			ORDER by BANYAK_TERJUAL DESC LIMIT 3");
		}

		return $sql;
	}

	function get_kota_terlaris($tglawal = NULL, $tglakhir = NULL){
		if ($tglawal == NULL && $tglakhir == NULL) {
			$sql = mysqli_query(conn(), "SELECT `konsumen`.`ID_KOTA`, COUNT(`konsumen`.`ID_KOTA`) as JUMLAH_PENJUALAN FROM `pembayaran`, `penjualan`, `konsumen` WHERE `penjualan`.`ID_JUAL`=`pembayaran`.`ID_JUAL` AND `pembayaran`.`STATUS_PEMBAYARAN`='2'
			AND `pembayaran`.`ID_JUAL`=`penjualan`.`ID_JUAL` AND `penjualan`.`ID_KONS`=`konsumen`.`ID_KONS` GROUP BY `konsumen`.`ID_KOTA`
			ORDER BY JUMLAH_PENJUALAN DESC LIMIT 3");
		}
		else {
			$sql = mysqli_query(conn(), "SELECT `konsumen`.`ID_KOTA`, COUNT(`konsumen`.`ID_KOTA`) as JUMLAH_PENJUALAN FROM `pembayaran`, `penjualan`, `konsumen` WHERE `penjualan`.`ID_JUAL`=`pembayaran`.`ID_JUAL` AND `pembayaran`.`STATUS_PEMBAYARAN`='2'
			AND `pembayaran`.`ID_JUAL`=`penjualan`.`ID_JUAL` AND `penjualan`.`ID_KONS`=`konsumen`.`ID_KONS` AND `penjualan`.TGL_PESAN between '$tglawal' and '$tglakhir' GROUP BY `konsumen`.`ID_KOTA`
			ORDER BY JUMLAH_PENJUALAN DESC LIMIT 3");
		}

		return $sql;
	}

	function get_detailjualby_id_idbarang($id, $id_barang){
		$sql = mysqli_query(conn(), "select * from detail_jual where id_jual = '$id' and id_barang = '$id_barang'");
		$hasil = mysqli_fetch_array($sql);
		return $hasil;
	}

	function get_detailjualby_id($id){
		$sql = mysqli_query(conn(), "select * from detail_jual where id_jual = '$id'");
		return $sql;
	}

	function update_statusjual($id, $status){
		$sql = mysqli_query(conn(), "UPDATE `penjualan` SET `STATUS` = '$status' WHERE `penjualan`.`ID_JUAL` = '$id'");
		return $sql;
	}



?>
