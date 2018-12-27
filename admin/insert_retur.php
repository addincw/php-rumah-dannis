<?php
  session_start();
  include '../function/penjualan.php';
  include '../function/retur.php';
  include "../function/pengiriman_pembayaran.php";

  $ID_JUAL = $_POST['nomor_pembelian'];
  $ID_RETUR = createid_retur(0);
  $ID_KAR = $_SESSION["ID_KAR"];

  //get id konsumen
  $penjualan = get_penjualanby_id($ID_JUAL);
  $ID_KONS = $penjualan['ID_KONS'];

  if($penjualan['STATUS'] == 1){
    $query_retur = get_detail_returbyIdjual($ID_JUAL);
    $last_retur = mysql_fetch_array($query_retur);
    $_SESSION['status_insert'] = 'Permohonan retur sudah pernah diajukan. lihat nota <a href="nota_retur.php?id_retur='.$last_retur['ID_RETUR'].'">'.$last_retur['ID_RETUR'].'</a>';
    header("location:retur.php");
    break;
  }

  date_default_timezone_set('Asia/Jakarta');
  $TGL_PENGAJUAN_RETUR = date('Y-m-d H:i:s');
  $TGL_PERSETUJUAN_RETUR = date('Y-m-d H:i:s');
  $TOTAL_BIAYA_RETUR = $_POST['total_biaya'];

  $retur = insert_retur($ID_RETUR, $ID_KAR, $ID_KONS, $TGL_PENGAJUAN_RETUR, $TGL_PERSETUJUAN_RETUR, $DEADLINE_RETUR = NULL, $JENIS_RETUR = 0, $TOTAL_BIAYA_RETUR, $STATUS = 1);
  if($retur == false){
  	echo mysql_error();
    break;
  }else{
  	$update_penjualan = update_statusjual($ID_JUAL, 1);
    foreach ($_POST['barang'] as $barang) {
			$ID_BARANG = $barang;
      $JUMLAH = $_POST['jumlah'.$barang];
      $KETERANGAN_RETUR = $_POST['keterangan'.$barang];
      //get barang pengganti
      $obj = json_decode($_POST['barang_pengganti'.$barang]);
      $BAR_ID_BARANG = $obj->id_barang;
      $BIAYA_RETUR = $_POST['biaya_tambahan'.$barang];

			$detail_retur = insert_detail_retur($ID_JUAL, $ID_BARANG, $ID_RETUR, $BAR_ID_BARANG, $JUMLAH, $KETERANGAN_RETUR, $BUKTI_RETUR = NULL, $STATUS_RETUR = 1, $BIAYA_RETUR);
			if($detail_retur == false){
				echo mysql_error();
				break;
			}
	   }
    $ID_PEMBAYARAN = createid_bayar(0);
    $pembayaran = insert_pembayaran($ID_PEMBAYARAN, $ID_JUAL, $ID_KAR, $JENIS_PEMBAYARAN = 0, $STATUS_PEMBAYARAN = 2, $TOTAL_PEMBAYARAN = $TOTAL_BIAYA_RETUR, $DEADLINE_PEMBAYARAN = NULL);
    if ($pembayaran == false) {
      echo mysql_error();
      break;
    }else {
      $_SESSION['status_insert'] = 'Data retur berhasil tersimpan. lihat nota <a href="nota_retur.php?id_retur='.$ID_RETUR.'">'.$ID_RETUR.'</a>';
      header("location:retur.php");
    }
  }
?>
