<?php
session_start();
include('../function/ATM.php');

$id_atm = $_POST['id_atm'];
$nama_atm = $_POST['nama_atm'];
$no_rekening = $_POST['no_rekening'];

$insert=insert_newATM($id_atm ,$nama_atm, $no_rekening);
//$insert=mysql_query("insert into penjualan values ('$id_pesan','$idkar','$tgl_jual','kons000','offline','lunas','','$subtotal')");

			if($insert == false){
				echo mysql_error();
			}

			else{
        $_SESSION['status'] = 'data sudah tersimpan';
        header('location:master_atm.php');
				}








?>
