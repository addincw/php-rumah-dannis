<?php
  require_once "koneksi.php";

  function createid_bayar($status_beli){
      $query = mysqli_query(conn(), "SELECT MAX(cast((substring(ID_PEMBAYARAN,13)) AS unsigned)) as ID_PEMBAYARAN FROM `pembayaran`");
      $pembayaran = mysqli_fetch_array($query);
      $number=$pembayaran['ID_PEMBAYARAN']+1;
      $id = "PY".date('Ymd').$status_beli."U".$number;
      return $id;
    }

  function createid_kirim($status_beli){
      $query = mysqli_query(conn(), "SELECT MAX(cast((substring(ID_KIRIM,13)) AS unsigned)) as ID_KIRIM FROM `pengiriman`");
      $penjualan = mysqli_fetch_array($query);
      $number=$penjualan['ID_KIRIM']+1;
      $id = "SH".date('Ymd').$status_beli."U".$number;
      return $id;
  }


  function get_provinsi(){
    $sql = mysqli_query(conn(), "SELECT * FROM provinsi");
    return $sql;
  }

  function get_provinsiby_id($id){
    $sql = mysqli_query(conn(), "SELECT * FROM provinsi where ID_PROVINSI = '$id'");
    $hasil = mysqli_fetch_array($sql);
    return $hasil;
  }

  function get_kotaby_id($id){
    $sql = mysqli_query(conn(), "SELECT * FROM kota where id_kota = '$id'");
    $hasil = mysqli_fetch_array($sql);
    return $hasil;
  }

  function get_kota_byProvinsi($provinsi){
    $sql = mysqli_query(conn(), "SELECT * FROM kota where ID_PROVINSI = '$provinsi'");
    return $sql;
  }

  function get_biaya_kirim($destination, $weight, $courier){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      //444 code untuk surabaya kota
      CURLOPT_POSTFIELDS => "origin=444&destination=".$destination."&weight="."$weight"."&courier=".$courier,
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: a5f49d4171fe06d2a89f0a1efe3e16f1"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      $pesan =  "cURL Error #:" . $err;
      return $pesan;
    } else {
      $obj = json_decode($response);
      return $obj;
    }
  }

  function insert_pembayaran($ID_PEMBAYARAN, $ID_JUAL, $ID_KAR, $JENIS_PEMBAYARAN, $STATUS_PEMBAYARAN, $TOTAL_PEMBAYARAN, $DEADLINE_PEMBAYARAN){
    if ($JENIS_PEMBAYARAN == 1) {
      $sql = mysqli_query(conn(), "INSERT INTO `pembayaran` (`ID_PEMBAYARAN`, `ID_JUAL`, `ID_KAR`, `TGL_PEMBAYARAN`, `JENIS_PEMBAYARAN`, `STATUS_PEMBAYARAN`, `TOTAL_PEMBAYARAN`, `DEADLINE_PEMBAYARAN`)
      VALUES ('$ID_PEMBAYARAN', '$ID_JUAL', '$ID_KAR', NULL, '$JENIS_PEMBAYARAN', '$STATUS_PEMBAYARAN', '$TOTAL_PEMBAYARAN', '$DEADLINE_PEMBAYARAN')");

      if($sql == false){
        $value=false;
      }

      else{
        $value=true;
      }

    }else {
      date_default_timezone_set('Asia/Jakarta');
      $TGL_PEMBAYARAN = date('Y-m-d H:i:s');
      $sql = mysqli_query(conn(), "INSERT INTO `pembayaran` (`ID_PEMBAYARAN`, `ID_JUAL`, `ID_KAR`, `TGL_PEMBAYARAN`, `JENIS_PEMBAYARAN`, `STATUS_PEMBAYARAN`, `TOTAL_PEMBAYARAN`, `DEADLINE_PEMBAYARAN`)
      VALUES ('$ID_PEMBAYARAN', '$ID_JUAL', '$ID_KAR', '$TGL_PEMBAYARAN', '$JENIS_PEMBAYARAN', '$STATUS_PEMBAYARAN', '$TOTAL_PEMBAYARAN', NULL)");

      if($sql == false){
        $value=false;
      }

      else{
        $value=true;
      }
    }

    return $value;
  }

  function insert_pengiriman($ID_KIRIM, $ID_PEMBAYARAN, $ID_KAR, $JASA_KIRIM, $BIAYA_KIRIM, $ALAMAT_KIRIM, $STATUS_PENGIRIMAN){
    $sql = mysqli_query(conn(), "INSERT INTO `pengiriman` (`ID_KIRIM`, `ID_PEMBAYARAN`, `ID_KAR`, `TGL_KIRIM`, `JASA_KIRIM`, `BIAYA_KIRIM`, `ALAMAT_KIRIM`, `STATUS_PENGIRIMAN`)
                        VALUES ('$ID_KIRIM', '$ID_PEMBAYARAN', '$ID_KAR', NULL,'$JASA_KIRIM', '$BIAYA_KIRIM', '$ALAMAT_KIRIM', '$STATUS_PENGIRIMAN')");

    if($sql == false){
      $value=false;
    }

    else{
      $value=true;
    }

    return $value;
  }

  function get_pembayaranby_id($id){
    $sql = mysqli_query(conn(), "select * from pembayaran where id_pembayaran = '$id'");
    $hasil = mysqli_fetch_array($sql);
    return $hasil;
  }

  function get_all_pembayaran(){
    $sql = mysqli_query(conn(), "SELECT * FROM pembayaran");
    return $sql;
  }

  function get_pembayaranby_idjual($id, $status = 0){
    if ($status == 1) {
      //$status = 1, ambil id pembayaran terbaru. (retur)
      $sql = mysqli_query(conn(), "select * from pembayaran where id_jual = '$id' ORDER BY DEADLINE_PEMBAYARAN DESC LIMIT 1");
      $hasil = mysqli_fetch_array($sql);
    }else {
      $sql = mysqli_query(conn(), "select * from pembayaran where id_jual = '$id'");
      $hasil = mysqli_fetch_array($sql);
    }

    return $hasil;
  }

  function get_pengirimanby_idbayar($id){
    $sql = mysqli_query(conn(), "select * from pengiriman where id_pembayaran = '$id'");
    $hasil = mysqli_fetch_array($sql);
    return $hasil;
  }

  function get_pengirimanby_id($id){
    $sql = mysqli_query(conn(), "select * from pengiriman where id_kirim = '$id'");
    $hasil = mysqli_fetch_array($sql);
    return $hasil;
  }

  function get_pengiriman($status){
    $sql = mysqli_query(conn(), "select * from pengiriman where STATUS_PENGIRIMAN = '$status'");
    //$hasil = mysqli_fetch_array($sql);
    return $sql;
  }

  function get_pembelian_terakhir($id_kons, $status_pembayaran = NULL){
    if ($status_pembayaran == NULL) {
      $sql = mysqli_query(conn(), "SELECT * FROM `pembayaran`, `penjualan`, `pengiriman` WHERE pembayaran.ID_PEMBAYARAN = pengiriman.ID_PEMBAYARAN AND penjualan.ID_JUAL = pembayaran.ID_JUAL AND penjualan.ID_KONS = '$id_kons' ORDER BY penjualan.TGL_PESAN DESC LIMIT 1");
      $hasil = mysqli_fetch_array($sql);
    }else {
      $sql = mysqli_query(conn(), "SELECT * FROM `pembayaran`, `penjualan`, `pengiriman` WHERE pembayaran.ID_PEMBAYARAN = pengiriman.ID_PEMBAYARAN AND penjualan.ID_JUAL = pembayaran.ID_JUAL AND penjualan.ID_KONS = '$id_kons' AND pembayaran.STATUS_PEMBAYARAN = '$status_pembayaran' ORDER BY penjualan.TGL_PESAN DESC LIMIT 1");
      $hasil = mysqli_fetch_array($sql);
    }

    return $hasil;
  }

  function get_pembelian_terbaru($id_kons){
    $sql = mysqli_query(conn(), "SELECT * FROM `pembayaran`, `penjualan`, `pengiriman` WHERE pembayaran.ID_PEMBAYARAN = pengiriman.ID_PEMBAYARAN AND penjualan.ID_JUAL = pembayaran.ID_JUAL AND penjualan.ID_KONS = '$id_kons' AND pembayaran.STATUS_PEMBAYARAN = '0' ORDER BY penjualan.TGL_PESAN DESC");
    return $sql;
  }

  function get_pembayaranby_status($status, $jenis_pembayaran = 0){
    if ($jenis_pembayaran == 0) {
      $sql = mysqli_query(conn(), "SELECT * FROM `pembayaran` WHERE STATUS_PEMBAYARAN = '$status' ORDER BY TGL_PEMBAYARAN DESC");
    }else {
      $sql = mysqli_query(conn(), "SELECT * FROM `pembayaran` WHERE STATUS_PEMBAYARAN = '$status' AND JENIS_PEMBAYARAN = '$jenis_pembayaran' ORDER BY TGL_PEMBAYARAN ASC");
    }

    return $sql;
  }

  function update_pembayaran($id_pembayaran, $namafoto, $status){
    if (($status == 2) || ($status == 3)) {
      $sql = mysqli_query(conn(), "UPDATE `pembayaran` SET `STATUS_PEMBAYARAN` = '$status' WHERE `pembayaran`.`ID_PEMBAYARAN` = '$id_pembayaran'");
    }else {
      $sql = mysqli_query(conn(), "UPDATE `pembayaran` SET `TGL_PEMBAYARAN` = CURRENT_TIMESTAMP, `BUKTI_PEMBAYARAN` = '$namafoto', `STATUS_PEMBAYARAN` = '$status' WHERE `pembayaran`.`ID_PEMBAYARAN` = '$id_pembayaran'");
    }

      if($sql == false){
        $value=false;
      }

      else{
        $value=true;
      }

    return $value;
  }

  function upload_pembayaran($namafoto, $foto){
  		// Check file size
  		if ($foto["size"] > 3000000){
  		    echo "Sorry, your file is too large.";
      }

  		else{
  			$target_dir = "../asset/bukti_bayar/";
  			$upload = move_uploaded_file($foto["tmp_name"], $target_dir.$namafoto.'.jpg');
        if($upload == false){
          $value = false;
        }else {
          $value = true;
        }
      }

      return $value;
  	}

    function update_pengiriman($id_pengiriman, $nomor_resi, $status){
      if ($nomor_resi == NULL) {
        $sql = mysqli_query(conn(), "UPDATE `pengiriman` SET `STATUS_PENGIRIMAN` = '$status' WHERE `pengiriman`.`ID_KIRIM` = '$id_pengiriman'");
      }else {
        $sql = mysqli_query(conn(), "UPDATE `pengiriman` SET `TGL_KIRIM` = CURRENT_TIMESTAMP, `NO_RESI` = '$nomor_resi', `STATUS_PENGIRIMAN` = '$status' WHERE `pengiriman`.`ID_KIRIM` = '$id_pengiriman'");
      }

        if($sql == false){
          $value=false;
        }

        else{
          $value=true;
        }

      return $value;
    }
?>
