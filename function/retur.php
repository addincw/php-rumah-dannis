<?php
  require_once 'koneksi.php';

  function createid_retur($status_beli){
      $query = mysqli_query(conn(), "SELECT MAX(cast((substring(ID_RETUR,13)) AS unsigned)) as ID_RETUR FROM `RETUR`");
      $retur = mysqli_fetch_array($query);
      $number=$retur['ID_RETUR']+1;
      $id = "RE".date('Ymd').$status_beli."U".$number;
      return $id;
    }

  function insert_retur($ID_RETUR, $ID_KAR, $ID_KONS, $TGL_PENGAJUAN_RETUR, $TGL_PERSETUJUAN_RETUR, $DEADLINE_RETUR, $JENIS_RETUR, $TOTAL_BIAYA_RETUR, $STATUS){
    if ($JENIS_RETUR == 1) {
      $sql = mysqli_query(conn(), "INSERT INTO `retur` (`ID_RETUR`, `ID_KAR`, `ID_KONS`, `TGL_PENGAJUAN_RETUR`, `TGL_PERSETUJUAN_RETUR`, `DEADLINE_RETUR`, `JENIS_RETUR`, `TOTAL_BIAYA_RETUR`, `STATUS`)
                          VALUES ('$ID_RETUR', '$ID_KAR', '$ID_KONS', '$TGL_PENGAJUAN_RETUR', NULL, NULL, '$JENIS_RETUR', '$TOTAL_BIAYA_RETUR', '$STATUS')");
    }else {
      $sql = mysqli_query(conn(), "INSERT INTO `retur` (`ID_RETUR`, `ID_KAR`, `ID_KONS`, `TGL_PENGAJUAN_RETUR`, `TGL_PERSETUJUAN_RETUR`, `DEADLINE_RETUR`, `JENIS_RETUR`, `TOTAL_BIAYA_RETUR`, `STATUS`)
                          VALUES ('$ID_RETUR', '$ID_KAR', '$ID_KONS', '$TGL_PENGAJUAN_RETUR', '$TGL_PERSETUJUAN_RETUR', NULL, '$JENIS_RETUR', '$TOTAL_BIAYA_RETUR', '$STATUS')");
    }

    if($sql == false){
      $value=false;
    }else{
      $value=true;
    }

    return $value;
  }

  function insert_detail_retur($ID_JUAL, $ID_BARANG, $ID_RETUR, $BAR_ID_BARANG, $JUMLAH, $KETERANGAN_RETUR, $BUKTI_RETUR, $STATUS_RETUR, $BIAYA_RETUR){
    if ($BUKTI_RETUR != NULL) {
      $sql = mysqli_query(conn(), "INSERT INTO `detail_retur` (`ID_JUAL`, `ID_BARANG`, `ID_RETUR`, `BAR_ID_BARANG`, `JUMLAH`, `KETERANGAN_RETUR`, `BUKTI_RETUR`, `STATUS_RETUR`, `BIAYA_RETUR`)
                          VALUES ('$ID_JUAL', '$ID_BARANG', '$ID_RETUR', NULL, '$JUMLAH','$KETERANGAN_RETUR', '$BUKTI_RETUR', '$STATUS_RETUR', '$BIAYA_RETUR')");
    }else {
      $sql = mysqli_query(conn(), "INSERT INTO `detail_retur` (`ID_JUAL`, `ID_BARANG`, `ID_RETUR`, `BAR_ID_BARANG`, `JUMLAH`, `KETERANGAN_RETUR`, `BUKTI_RETUR`, `STATUS_RETUR`, `BIAYA_RETUR`)
                          VALUES ('$ID_JUAL', '$ID_BARANG', '$ID_RETUR', '$BAR_ID_BARANG', '$JUMLAH','$KETERANGAN_RETUR', NULL, '$STATUS_RETUR', '$BIAYA_RETUR')");
    }

    if($sql == false){
      $value=false;
    }else{
      $value=true;
    }

    return $value;
  }

  function upload_bukti_retur($namafoto, $foto){
  		// Check file size
  		if ($foto["size"] > 3000000){
  		echo "Sorry, your file is too large.";
      break;
      }

  		else{
  			$target_dir = "../asset/bukti_retur/";
  			$upload = move_uploaded_file($foto["tmp_name"], $target_dir.$namafoto.'.jpg');
        if($upload == false){
          $value = false;
        }else {
          $value = true;
        }
      }

      return $value;
  	}

    function get_allretur(){
      $query = mysqli_query(conn(), "SELECT * FROM `retur`");
      return $query;
    }

    function get_detail_returbyId($id){
      $query = mysqli_query(conn(), "SELECT * FROM `detail_retur` WHERE ID_RETUR = '$id'");
      return $query;
    }

    function get_detail_returbyIdjual($id){
      $query = mysqli_query(conn(), "SELECT * FROM `detail_retur` WHERE ID_JUAL = '$id'");
      return $query;
    }

    function get_detail_returbyIdStatus($id, $status){
      $query = mysqli_query(conn(), "SELECT * FROM `detail_retur` WHERE ID_RETUR = '$id' AND STATUS_RETUR = '$status'");
      return $query;
    }

    function get_returbyId($id){
      $query = mysqli_query(conn(), "SELECT * FROM `retur` WHERE ID_RETUR = '$id'");
      $hasil = mysqli_fetch_array($query);
      return $hasil;
    }

    function get_returbyStatus($status){
      $query = mysqli_query(conn(), "SELECT * FROM `retur` WHERE STATUS = '$status'");
      return $query;
    }

    function update_retur($ID_RETUR, $ID_KAR, $TGL_PERSETUJUAN_RETUR, $DEADLINE_RETUR, $TOTAL_BIAYA_RETUR, $STATUS){
      if ($TOTAL_BIAYA_RETUR == NULL) {
        $query = mysqli_query(conn(), "UPDATE `retur`
                              SET `ID_KAR` = '$ID_KAR', `TGL_PERSETUJUAN_RETUR` = '$TGL_PERSETUJUAN_RETUR', `DEADLINE_RETUR` = '$DEADLINE_RETUR', `STATUS` = '$STATUS'
                              WHERE `retur`.`ID_RETUR` = '$ID_RETUR'");
      }else {
        $query = mysqli_query(conn(), "UPDATE `retur`
                              SET `ID_KAR` = '$ID_KAR', `TGL_PERSETUJUAN_RETUR` = '$TGL_PERSETUJUAN_RETUR', `DEADLINE_RETUR` = '$DEADLINE_RETUR', `TOTAL_BIAYA_RETUR` = '$TOTAL_BIAYA_RETUR', `STATUS` = '$STATUS'
                              WHERE `retur`.`ID_RETUR` = '$ID_RETUR'");
      }

      if ($query == false) {
        $value = false;
      }else {
        $value = true;
      }

      return $value;
    }

    function update_detail_retur($ID_JUAL, $ID_BARANG, $ID_RETUR, $BARANG_PENGGANTI, $STATUS_RETUR, $BIAYA_RETUR){
      if ($BARANG_PENGGANTI == NULL) {
        if ($STATUS_RETUR == 2) {
          $query = mysqli_query(conn(), "UPDATE `detail_retur` SET `STATUS_RETUR` = '$STATUS_RETUR' WHERE `detail_retur`.`ID_JUAL` = '$ID_JUAL' AND `detail_retur`.`ID_RETUR` = '$ID_RETUR' AND `detail_retur`.`STATUS_RETUR` = 0");
        }else {
          $query = mysqli_query(conn(), "UPDATE `detail_retur` SET `STATUS_RETUR` = '$STATUS_RETUR'
            WHERE `detail_retur`.`ID_JUAL` = '$ID_JUAL' AND `detail_retur`.`ID_BARANG` = '$ID_BARANG' AND `detail_retur`.`ID_RETUR` = '$ID_RETUR'");
        }
      }else {
        $query = mysqli_query(conn(), "UPDATE `detail_retur` SET `BAR_ID_BARANG` = '$BARANG_PENGGANTI', `STATUS_RETUR` = '$STATUS_RETUR', `BIAYA_RETUR` = '$BIAYA_RETUR'
                              WHERE `detail_retur`.`ID_JUAL` = '$ID_JUAL' AND `detail_retur`.`ID_BARANG` = '$ID_BARANG' AND `detail_retur`.`ID_RETUR` = '$ID_RETUR'");
      }

      if ($query == false) {
        $value = false;
      }else {
        $value = true;
      }

      return $value;
    }
?>
