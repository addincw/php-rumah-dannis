<?php
  session_start();
  include '../function/pengiriman_pembayaran.php';
  include '../function/retur.php';
  include '../function/konsumen.php';
  include '../function/penjualan.php';
  include '../function/barang.php';

  $ID_JUAL = $_POST['ID_JUAL'];
  $ID_RETUR = $_POST['ID_RETUR'];
  $id_pengiriman = $_POST['ID_KIRIM'];


  $ID_KAR = $_SESSION['ID_KAR'];

  date_default_timezone_set('Asia/Jakarta');
  $TGL_PERSETUJUAN_RETUR = date('Y-m-d H:i:s');
  $DEADLINE_RETUR = date('Y-m-d H:i:s', time() + 3600 * 24 * 7);
  //$DEADLINE_PEMBAYARAN = date('Y-m-d H:i:s', time() + 3600 * 24);
  $TOTAL_BIAYA_RETUR = $_POST['total_biaya'];

  $update_retur = update_retur($ID_RETUR, $ID_KAR, $TGL_PERSETUJUAN_RETUR, $DEADLINE_RETUR, $TOTAL_BIAYA_RETUR, $STATUS = 1);
  if ($update_retur == false) {
    echo mysql_error();
    break;
  }else {
    foreach ($_POST['barang'] as $ID_BARANG) {
      //echo $ID_BARANG.'<br>';
      $obj = json_decode($_POST['barang_pengganti'.$ID_BARANG]);
      $BARANG_PENGGANTI = $obj->id_barang;
      $BIAYA_RETUR = $_POST['biaya_tambahan'.$ID_BARANG];

      $update_detail_retur = update_detail_retur($ID_JUAL, $ID_BARANG, $ID_RETUR, $BARANG_PENGGANTI, $STATUS_RETUR = 1, $BIAYA_RETUR);
      if ($update_detail_retur == false) {
        echo mysql_error();
        break;
      }
    }

    //status = 2 berarti di tolak
    $update_detail_retur = update_detail_retur($ID_JUAL, $ID_BARANG, $ID_RETUR, $BARANG_PENGGANTI = NULL, $STATUS_RETUR = 2, $BIAYA_RETUR = NULL);
    if ($update_detail_retur == false) {
      echo mysql_error();
      break;
    }else {
      $ID_PEMBAYARAN = createid_bayar(1);
      $pembayaran = insert_pembayaran($ID_PEMBAYARAN, $ID_JUAL, $ID_KAR, $JENIS_PEMBAYARAN = 1, $STATUS_PEMBAYARAN = 0, $TOTAL_BIAYA_RETUR, $DEADLINE_RETUR);
      if ($pembayaran == false) {
        echo mysql_error();
        break;
      }else {
        $ID_KIRIM = createid_kirim(1);
        $kirim = get_pengirimanby_id($id_pengiriman);
        $pengiriman = insert_pengiriman($ID_KIRIM, $ID_PEMBAYARAN, $ID_KAR, $kirim['JASA_KIRIM'], $kirim['BIAYA_KIRIM'], $kirim['ALAMAT_KIRIM'], $STATUS_PENGIRIMAN = 0);
        if ($pengiriman == false) {
          echo mysql_error();
          break;
        }else {
          $_SESSION['status_update'] = 'konfirmasi berhasil dilakukan';
          header('location:konfirmasi_retur.php');
        }
      }
    }

  }
?>
