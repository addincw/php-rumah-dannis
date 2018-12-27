<?php
session_start();
//include '../function/konsumen.php';
include "../function/penjualan.php";
include "../function/barang.php";
include "../function/pre_order.php";
include "../function/pengiriman_pembayaran.php";

$id_jual = createid_jual(1);

//tidak usah, lgsg current_timestamp
//$tgl_jual = date('Y-m-d');
date_default_timezone_set('Asia/Jakarta');
$tgl_jual = date('Y-m-d H:i:s').'</br>';
$DEADLINE_PEMBAYARAN = date('Y-m-d H:i:s', time() + 3600 * 24).'</br>';

$id_kar = "online";
$id_kons = $_SESSION['ID_KONS'];
$total = $_SESSION['total'];

$ID_PEMBAYARAN = createid_bayar(1);

$ID_KIRIM = createid_kirim(1);
$obj = json_decode($_POST['jasa_kirim']);
$BIAYA_KIRIM = $obj->biaya;
$TOTAL_PEMBAYARAN = $total + $BIAYA_KIRIM;

$JASA_KIRIM = $obj->kurir.' - '.$obj->service;

$kota = get_kotaby_id($_POST['kota']);
$provinsi = get_provinsiby_id($_POST['provinsi']);
$ALAMAT_KIRIM = $_POST['alamat_lengkap'].', '.$kota['NM_KOTA'].', '.$provinsi['NAMA_PROVINSI'];
$id_atm = $_POST['atm'];
$rekening_kons = $_POST['bank_kons']." : ".$_POST['rekening_kons'];

if (isset($_SESSION['ID_PSN'])) {
	$id_psn = $_SESSION['ID_PSN'];
	$insert=insertJual($id_jual ,$id_kar, $id_kons, $id_psn, $id_atm, $tgl_jual, $jenis_jual = 1, $status = 2, $total, $rekening_kons);
	$update_order = update_konfirmasipesan($id_psn, 0);
	unset($_SESSION['ID_PSN']);
}else {
	$insert=insertJual($id_jual ,$id_kar, $id_kons, $id_psn = NULL, $id_atm, $tgl_jual, $jenis_jual = 1, $status = 0, $total, $rekening_kons);
}

if($insert == false){
	echo mysql_error();
}else{
	foreach ($_SESSION['list'] as $noitem => $item){
		$id_barang=$item['id'];
		$harga_jual=$item['harga_jual'];
		$harga_beli=$item['harga_beli'];
		$jumlah=$item['jumlah'];
		$subtotal=$item['subtotal'];
		$detail=insertDetail_jual($id_jual,$id_barang,$harga_jual, $harga_beli, $jumlah, $subtotal, $status = 0);
		if($detail == false){
			echo mysql_error();

		}else {
			$barang=read_barang_byId($id_barang);
			if ($barang['STOK_BARANG']<=0) {
				$stok_terbaru=$barang['STOK_BARANG'];
			}else {
				$stok_terbaru=$barang['STOK_BARANG'] - $jumlah;
			}

			$update_stok_barang=update_stok_barang($stok_terbaru,$id_barang);

			if($update_stok_barang == false){
				echo mysql_error();

			}
		}
	}

	$pembayaran = insert_pembayaran($ID_PEMBAYARAN, $id_jual, $id_kar, $JENIS_PEMBAYARAN = 1, $STATUS_PEMBAYARAN = 0, $TOTAL_PEMBAYARAN, $DEADLINE_PEMBAYARAN);
	if ($pembayaran == false) {
		echo mysql_error();

	}else {
		$pengiriman = insert_pengiriman($ID_KIRIM, $ID_PEMBAYARAN, $id_kar, $JASA_KIRIM, $BIAYA_KIRIM, $ALAMAT_KIRIM, $STATUS_PENGIRIMAN = 0);
		if ($pengiriman == false) {
			echo mysql_error();

		}
	}

	unset($_SESSION['total']);
	unset($_SESSION['berat']);
	$_SESSION['transaksi'] = array(
		'id_jual' => $id_jual,
		'id_atm' => $id_atm,
		'biaya_kirim' => $BIAYA_KIRIM,
		'total_barang'=> $total,
		'total_pembayaran' => $TOTAL_PEMBAYARAN
	);

	header('location:transaksi_sukses.php');
}
/*
*/
?>
