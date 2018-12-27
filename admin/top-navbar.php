<!DOCTYPE html>
<html>
<title>Rumah Dannis Surabaya | Admin</title>
<?php include '../function/koneksi.php'; ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../w3.css">
<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../select2/dist/css/select2.min.css">
<script src="../jquery-3.1.1.min.js"></script>
<script src="../select2/dist/js/select2.min.js"></script>
<script>
/*
*/
setInterval(function(){
  //alert("test");
  $('#cek_pengiriman_pembayaran').load('cek_pengiriman_pembayaran.php',function(data){
    var nilai = data;
    if(nilai.length != 0){
      alert(nilai);
    }
  });
}, 15000);
</script>

<div class="w3-container w3-top w3-medium w3-padding" style="z-index:4; background-color: #CC362B; color: white;">
  <button class="w3-right w3-btn w3-xlarge w3-hide-large w3-padding-0 w3-hover-text-grey" id="menu" style="background-color: #CC362B; margin-top:15px"><i class="fa fa-bars"></i></button>
  <span class="w3-left"><div class="w3-margin-left"><img src="../asset/logo_rumahdannis.png" alt=""></div></span>
  <span class="w3-right w3-hide-medium w3-hide-small" style="margin-top:13px"><a href="logout.php">Logout</a></span>
</div>

<span id="cek_pengiriman_pembayaran"></span>

<!--#6F001F-->
