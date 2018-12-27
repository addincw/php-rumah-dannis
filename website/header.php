<?php
session_start();
//$_SESSION['ID_KONS'] = 'ZZZ';
?>
<!DOCTYPE html>
<html>
<title>Rumah Dannis Surabaya</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../w3.css">
<link rel="stylesheet" href="../jPages.css">
<link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="../select2/dist/css/select2.min.css">
<link rel="stylesheet" href="../owl.carousel/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="../owl.carousel/owl-carousel/owl.theme.css">
<script src="../jquery-3.1.1.min.js"></script>
<script src="../jPages.js"></script>
<script src="../select2/dist/js/select2.min.js"></script>
<script src="../owl.carousel/owl-carousel/owl.carousel.min.js"></script>
<script>
  $(document).ready(function(){
	  $("#close").click(function(){
    //alert('berhasil');
      $("#mySidebar").hide();
    });

    $("#transaksi").click(function(){
    //alert('berhasil');
      $("#dropdown_transaksi").toggle();
    });

    $("#menu").click(function(){
    //alert('berhasil');
      $("#mySidebar").toggle();
    });
  });
</script>
<body class="w3-light-grey">

<!--
Navbar (sit on top)
-->
<div class="w3-top w3-hide-medium w3-hide-small">
  <ul class="w3-navbar w3-red w3-wide w3-padding-8 w3-card-2">
    <li>
      <div class="w3-margin-left"><img src="../asset/logo_rumahdannis.png" alt=""></div>
    </li>

    <li class="w3-right" style="margin-top:13px;">
      <a href="index.php" class="w3-left"><i class="fa fa-home"></i> Home</a>
      <a href="product.php" class="w3-left">Product</a>
      <div class="w3-dropdown-hover w3-left">
        <a href="#">Transaksi <i class="fa fa-caret-down"></i></a>
        <div class="w3-dropdown-content w3-white w3-card-4">
          <a href="konfirmasi_pembayaran.php">upload bukti pembayaran</a>
          <a href="retur.php">retur</a>
          <a href="status_pembelian.php">status transaksi</a>
        </div>
      </div>
    <a href="keranjang.php" class="w3-left"><i class="fa fa-shopping-cart"></i> Keranjang</a>
  <?php if (isset($_SESSION['ID_KONS'])) {
    //echo $_SESSION['ID_KONS'];
  ?>
    <a href="logout.php" class="w3-left"><i class="fa fa-close"></i> Logout</a>
  <?php
        }else {
  ?>
    <a href="../login.php" class="w3-left"><i class="fa fa-open"></i> Login</a>
  <?php
      }
  ?>
    </li>
  </ul>
</div>

<div class="w3-container w3-top w3-red w3-medium w3-padding w3-hide-large" style="z-index:3;">
  <button id="menu" class="w3-right w3-btn w3-xlarge w3-red w3-padding-0 w3-hover-text-grey" style="margin-top:15px"><i class="fa fa-bars"></i></button>
  <span class="w3-left"><div class="w3-margin-left"><img src="../asset/logo_rumahdannis.png" alt=""></div></span>
</div>

<nav class="w3-sidebar w3-white w3-collapse w3-top" style="z-index:3;width:300px; height:100%; padding-bottom:15px; display:none" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i id="close" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><b>Menu</b></h3>
  </div>
  <a href="index.php" class="w3-btn w3-white" style="text-align:left; width:100%"><i class="fa fa-home"></i> Home</a>
  <a href="product.php" class="w3-btn w3-white" style="text-align:left; width:100%">Product</a>
  <a id="transaksi" class="w3-btn w3-white" style="text-align:left; width:100%">Transaksi <i class="fa fa-caret-down"></i></a>
  <div id="dropdown_transaksi" class="w3-container" style="display:none">
    <a href="konfirmasi_pembayaran.php" class="w3-btn w3-white w3-text-grey" style="text-align:left; width:100%">upload bukti pembayaran</a>
    <a href="retur.php" class="w3-btn w3-white w3-text-grey" style="text-align:left; width:100%">retur</a>
    <a href="status_pembelian.php" class="w3-btn w3-white w3-text-grey" style="text-align:left; width:100%">status transaksi</a>
  </div>
<a href="keranjang.php" class="w3-btn w3-white" style="text-align:left; width:100%"><i class="fa fa-shopping-cart"></i> Keranjang</a>
<hr>
<?php if (isset($_SESSION['ID_KONS'])) {
//echo $_SESSION['ID_KONS'];
?>
<a href="logout.php" class="w3-btn w3-white" style="text-align:left; width:100%"><i class="fa fa-close"></i> Logout</a>
<?php
    }else {
?>
<a href="../login.php" class="w3-btn w3-white" style="text-align:left; width:100%"><i class="fa fa-open"></i> Login</a>
<?php
  }
?>
</nav>
