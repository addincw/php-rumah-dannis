<?php
session_start();
include('../function/pre_order.php');

$id_order = $_SESSION['id_order'];

date_default_timezone_set('Asia/Jakarta');
$TGL_PSN = date('Y-m-d H:i:s');
$ID_KAR = $_SESSION['ID_KAR'];
$ID_KONS = $_SESSION['ID_KONS_ORDER'];
$total = $_SESSION['total_order'];

$insert=insertPesan($id_order, $ID_KONS, $ID_KAR, $TGL_PSN, $STATUS_PSN = NULL, $KONFIRMASI_PSN = NULL, $total, $jenis_psn = 0);

			if($insert == false){
				echo mysql_error();
			}else{
				foreach ($_SESSION['list_order'] as $noitem => $item){
					$ID_BARANG=$item['id'];
					$HARGA=$item['harga_jual'];
          $harga_beli=$item['harga_beli'];
					$JUMLAH=$item['jumlah'];
					$subtotal=$item['subtotal'];
					$detail=insertDetail_pesan($id_order, $ID_BARANG, $HARGA, $JUMLAH, $subtotal);
					if($detail == false){
            echo mysql_error();
            break;
					}else {
            unset($_SESSION['list_order'][$noitem]);
					}

				}

        unset($_SESSION['id_order']);
        unset($_SESSION['total_order']);
        unset($_SESSION['ID_KONS_ORDER']);
				$_SESSION['status_insert'] = 'Data order berhasil tersimpan. lihat detail order <a href="nota_order.php?id_order='.$id_order.'" target=_blank>'.$id_order.'</a>';
				header("location:pre_order.php");
				}







?>
