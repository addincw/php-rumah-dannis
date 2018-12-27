<?php
session_start();
include '../function/penjualan.php';
include "../function/pengiriman_pembayaran.php";

$id_jual = $_POST['nomor_pembelian'];
$jasa_pengiriman = $_POST['jasa_pengiriman'];
$nomor_resi = $_POST['nomor_resi'];

$penjualan = get_penjualanby_id($id_jual);
if ($penjualan['STATUS'] == 1) {
  $pembayaran = get_pembayaranby_idjual($id_jual, 1);
}else {
  $pembayaran = get_pembayaranby_idjual($id_jual);
}

$pengiriman = get_pengirimanby_idbayar($pembayaran['ID_PEMBAYARAN']);
/*
*/
$update_pengiriman = update_pengiriman($pengiriman['ID_KIRIM'], $nomor_resi, $status = 2);
if($update_pengiriman == false){
  echo mysql_error();
  break;
}else {
  $_SESSION['status_upload'] = 'upload bukti pembayaran berhasil';
  header("location:upload_buktiKirim.php");
}
?>
