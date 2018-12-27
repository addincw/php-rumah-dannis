<?php
 session_start();
 include '../function/pengiriman_pembayaran.php';

 $status = $_REQUEST['action'];
 $id = $_REQUEST['id_bayar'];

 $update_pembayaran = update_pembayaran($id, NULL, $status);

 if ($update_pembayaran == false) {
   echo mysql_error();
   break;
 }else {
   $_SESSION['status_update'] = 'konfirmasi pembayaran berhasil dilakukan untuk transaksi '.$id;
   header("location:konfirmasi_pembayaran.php");
 }
?>
