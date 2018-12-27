<?php
 session_start();
 include '../function/pengiriman_pembayaran.php';

 $status = $_REQUEST['status'];
 $id = $_REQUEST['id_kirim'];

 $update_pengiriman = update_pengiriman($id, NULL, $status);

 if ($update_pengiriman == false) {
   echo mysql_error();
   break;
 }else {
   $_SESSION['status_update'] = 'berhasil memperbarui status transaksi';
   header("location:status_pembelian.php");
 }


?>
