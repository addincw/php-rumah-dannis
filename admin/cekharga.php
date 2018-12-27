<?php
include'../function/barang.php';

$idbarang=$_REQUEST['id_barang'];

//mengambil harga
$barang=read_barang_byId($idbarang);
$harga = "Rp. ".number_format($barang['HARGA_JUAL'], 2, ",", ".");

//echo '{"harga" : '.$harga.', "stok" : '.$barang['STOK']'}';
echo '{"harga":"'.$harga.'","stok":"'.$barang['STOK_BARANG'].'"}';
?>
