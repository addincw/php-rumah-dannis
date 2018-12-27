<?php
session_start();
include 'function/konsumen.php';
$username = $_POST['username'];
$password = $_POST['password'];

$konsumen = read_Konsumenby_username($username);
if ($username == $konsumen['USER_KONS']) {
  if(password_verify($password, $konsumen['PASS_KONS'])){
    $_SESSION['ID_KONS'] = $konsumen['ID_KONS'];
    if (isset($_SESSION['RETURN_PAGE'])) {
      header("location:".$_SESSION['RETURN_PAGE']);
    }else{
      header('location:website/index.php');
    }
  }else {
    $_SESSION['status_login'] = 'password salah';
    header('location:login.php');
  }
}else {
  $_SESSION['status_login'] = 'username salah';
  header('location:login.php');
}
?>
