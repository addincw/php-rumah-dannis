<?php
session_start();
include '../function/karyawan.php';
echo $username = $_POST['username'];
echo $password = $_POST['password'];

$karyawan = read_Karyawanby_Userpass($username, $password);
echo $karyawan['USER_KAR'];
echo $karyawan['PASS_KAR'];

  if (($username == $karyawan['USER_KAR']) && ($password == $karyawan['PASS_KAR'])) {
    $_SESSION['ID_KAR'] = $karyawan['ID_KAR'];
    header('location:penjualan.php');
  }else {
    $_SESSION['status'] = 'username atau password salah';
    header('location:index.php');
  }
?>
