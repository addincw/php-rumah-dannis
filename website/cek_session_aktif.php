<?php
session_start();
include "../function/penjualan.php";
include "../function/pengiriman_pembayaran.php";
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
?>
