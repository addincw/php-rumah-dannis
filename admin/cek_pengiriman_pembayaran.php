<?php
include '../function/penjualan.php';
include '../function/barang.php';
include '../function/pengiriman_pembayaran.php';

$sql = get_pembayaranby_status(0, 1);
$sql2 = get_pengiriman(2);

date_default_timezone_set('Asia/Jakarta');
$tgl_sekarang = date('Y-m-d H:i:s');

  //cek_pengiriman
  while ($pengiriman = mysql_fetch_array($sql2)) {
    $date = new DateTime($pengiriman['TGL_KIRIM']);
    $date->modify('+10 day');

    if ($tgl_sekarang >= $date->format('Y-m-d H:i:s')) {

  		echo "telah di update ".$pengiriman['ID_KIRIM']." pengiriman dianggap telah diterima";
  		$update=update_pengiriman($pengiriman['ID_KIRIM'], NULL, 3);

  		if ($update == false) {
  			echo mysql_error();
  			break;
  		}

  	}

  }

  //cek_pembayaran
  while ($pembayaran = mysql_fetch_array($sql)) {
  	if ($tgl_sekarang >= $pembayaran['DEADLINE_PEMBAYARAN']) {

  		echo "telah di update ".$pembayaran['ID_PEMBAYARAN']." karena telah melebihi deadline pembayaran<br>";
  		$update=update_pembayaran($pembayaran['ID_PEMBAYARAN'], NULL, 3);

  		if ($update == false) {
  			echo mysql_error();
  			break;
  		}else {
  			$sql_penjualan = get_detailjualby_id($pembayaran['ID_JUAL']);
  			while ($detail_jual=mysql_fetch_array($sql_penjualan)) {
  				$barang=read_barang_byId($detail_jual['ID_BARANG']);
  				$jumlah = $barang['STOK_BARANG'] + $detail_jual['JUMLAH'];
  				update_stok_barang($jumlah, $detail_jual['ID_BARANG']);
  			}
  		}
  	}
  }

?>
