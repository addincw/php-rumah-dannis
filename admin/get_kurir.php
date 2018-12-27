<?php
//include '../function/penjualan.php';
include '../function/pengiriman_pembayaran.php';

$id_jual = $_REQUEST['id_jual'];

$pembayaran = get_pembayaranby_idjual($id_jual);
$pengiriman = get_pengirimanby_idbayar($pembayaran['ID_PEMBAYARAN']);
echo $pengiriman['JASA_KIRIM'];

?>
