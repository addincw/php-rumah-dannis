<?php
session_start();
include "../function/penjualan.php";
include "../function/pengiriman_pembayaran.php";
include '../function/retur.php';

$ID_JUAL = $_POST['nomor_pembelian'];
$ID_RETUR = createid_retur(1);
$ID_KAR = "online";
$ID_KONS = $_SESSION['ID_KONS'];

date_default_timezone_set('Asia/Jakarta');
$TGL_PENGAJUAN_RETUR = date('Y-m-d H:i:s');

$retur = insert_retur($ID_RETUR, $ID_KAR, $ID_KONS, $TGL_PENGAJUAN_RETUR, $TGL_PERSETUJUAN_RETUR = NULL, $DEADLINE_RETUR = NULL, $JENIS_RETUR = 1, $TOTAL_BIAYA_RETUR = 0, $STATUS = 0);

			if($retur == false){
				echo mysql_error();
        break;
			}else{
				$update_penjualan = update_statusjual($ID_JUAL, 1);
				$x = 0;
        foreach ($_POST['barang'] as $barang) {
					$ID_BARANG = $barang;
          $JUMLAH = $_POST[$barang.'jumlah'];
          $KETERANGAN_RETUR = $_POST[$barang.'keterangan'];
					$BUKTI_RETUR = $ID_JUAL." - ".$x;
					$detail_retur = insert_detail_retur($ID_JUAL, $ID_BARANG, $ID_RETUR, $BAR_ID_BARANG = NULL, $JUMLAH, $KETERANGAN_RETUR, $BUKTI_RETUR, $STATUS_RETUR = 0, $BIAYA_RETUR = 0);
					if($detail_retur == false){
						echo mysql_error();
						break;
					}else {
						$upload = upload_bukti_retur($BUKTI_RETUR, $_FILES[$barang."bukti_retur"]);
						if($upload == false){
							echo mysql_error();
							break;
						}
					}

					$x++;
				}

				header("location:retur.php?status_upload=pengajuan retur berhasil");
			}




?>
