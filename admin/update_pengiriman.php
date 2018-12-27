<?php
 session_start();
 include '../function/pengiriman_pembayaran.php';

 $status = $_REQUEST['action'];
 $id = $_REQUEST['id_kirim'];

 $update_pengiriman = update_pengiriman($id, NULL, $status);

 if ($update_pengiriman == false) {
   echo mysql_error();
   break;
 }else {
   $_SESSION['status_update'] = 'berhasil memperbarui status untuk transaksi '.$id.' segera lakukan pengiriman dan upload nomor resi pengiriman';
   header("location:barang_siapKirim.php");
 }


?>
