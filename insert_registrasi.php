<?php
session_start();
include('function/konsumen.php');

$id = createid_konsumen('id_kons','konsumen','kons','4');
$nama = $_POST['nama'];
$tgl_lahir = $_POST['tgl_lahir'];
$jenis_kelamin = $_POST['jk'];
$alamat = $_POST['alamat'];
$kota = $_POST['kota'];
$telpon = $_POST['telpon'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT, array("cost" => 10));
$rekening_kons = $_POST['bank_kons']." : ".$_POST['rekening_kons'];

$insert = registrasi_konsumen($id, $nama, $alamat, $telpon, $email, $username, $password, $kota, $tgl_lahir, $jenis_kelamin, $rekening_kons);

if (isset($_SESSION['RETURN_PAGE'])) {
  $_SESSION['ID_KONS'] = $id;
  header("location:".$_SESSION['RETURN_PAGE']);
}else{
  $_SESSION['statusRegis'] = 'registrasi berhasil';
  header('location:registrasi.php');
}
?>
