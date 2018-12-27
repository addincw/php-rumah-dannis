<?php
session_start();
include('../function/penjualan.php');
include '../function/barang.php';
include '../function/pre_order.php';
include "../function/pengiriman_pembayaran.php";
// print_r($_SESSION);
// die();
$id_jual = $_SESSION['id_jual'];
$ID_PEMBAYARAN = createid_bayar(0);
date_default_timezone_set('Asia/Jakarta');
$tgl_jual = date('Y-m-d H:i:s');
$id_kar = $_SESSION['ID_KAR'];
$id_kons = $_SESSION['ID_KONS'];
$total = $_SESSION['total'];

if (isset($_SESSION['ID_PSN'])) {
	$id_psn = $_SESSION['ID_PSN'];
	$id_jual = createid_jual(0);
	$insert=insertJual($id_jual ,$id_kar, $id_kons, $id_psn, $id_atm = NULL, $tgl_jual, $jenis_jual = 0, $status = 2, $total);
	$update_order = update_konfirmasipesan($id_psn, 0);
	unset($_SESSION['ID_PSN']);
}else {
	$insert=insertJual($id_jual ,$id_kar, $id_kons, $id_psn = NULL, $id_atm = NULL, $tgl_jual, $jenis_jual = 0, $status = 0, $total);
}

//$insert=mysql_query("insert into penjualan values ('$id_pesan','$idkar','$tgl_jual','kons000','offline','lunas','','$subtotal')");

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
            break;
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
							break;
						}
					}

					unset($_SESSION['list'][$noitem]);
				}

				unset($_SESSION['total']);
				$pembayaran = insert_pembayaran($ID_PEMBAYARAN, $id_jual, $id_kar, $JENIS_PEMBAYARAN = 0, $STATUS_PEMBAYARAN = 2, $TOTAL_PEMBAYARAN = $total, $DEADLINE_PEMBAYARAN = NULL);
				if ($pembayaran == false) {
					echo mysql_error();
					break;
				}


				$_SESSION['status_insert'] = 'Data pembelian berhasil tersimpan. lihat nota <a href="nota.php?id_jual='.$id_jual.'" target=_blank>'.$id_jual.'</a>';
				header("location:penjualan.php");
				}







?>
