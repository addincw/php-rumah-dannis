<?php
session_start();
include "../function/penjualan.php";
include "../function/pengiriman_pembayaran.php";

date_default_timezone_set('Asia/Jakarta');
$tgl_sekarang = date('Y-m-d H:i:s');

$status_transaksi = 0;
$namafile = $_POST['nomor_pembelian'];
$penjualan = get_penjualanby_id($namafile);
if ($penjualan['STATUS'] == 1) {
  $status_transaksi = 1;
  $namafile = $_POST['nomor_pembelian'].'-R';
}
/*
*/
$pembayaran = get_pembayaranby_idjual($_POST['nomor_pembelian'], $status_transaksi);
if($pembayaran['ID_PEMBAYARAN'] == NULL){
  $_SESSION['status_upload'] = 'nomor pembelian tidak ditemukan, tulis sesuai dengan yang tertera di nota';
  header("location:konfirmasi_pembayaran.php");
  break;
}else {

  //cek deadline pembayaran melebihi atau tidak
  if ($tgl_sekarang <= $pembayaran['DEADLINE_PEMBAYARAN']) {
    $update_pembayaran = update_pembayaran($pembayaran['ID_PEMBAYARAN'], $namafile, $status = 1);
    if($update_pembayaran == false){
      echo mysql_error();
      break;
    }else {
      $upload = upload_pembayaran($namafile, $_FILES["bukti_transfer"]);
      if($upload == false){
        echo mysql_error();
        break;
      }else {
        $_SESSION['status_upload'] = 'upload bukti pembayaran berhasil';
        header("location:konfirmasi_pembayaran.php");
      }
    }
  }else {
    update_pembayaran($pembayaran['ID_PEMBAYARAN'], NULL, 3);
    $_SESSION['status_upload'] = "upload tidak dapat dilakukan karenan
    melebihi deadline pembayaran, silahkan mengulangi pembelian";
    header("location:konfirmasi_pembayaran.php");
    break;
  }

}


?>
