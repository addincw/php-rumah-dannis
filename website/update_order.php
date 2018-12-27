<?php
session_start();
include '../function/pre_order.php';
include '../function/barang.php';
if (isset($_REQUEST['id_psn'])){
  $_SESSION['ID_PSN'] = $_REQUEST['id_psn'];
  $order = get_pesanby_id($_REQUEST['id_psn']);
  $query_detail_order = get_detailpesanby_id($_REQUEST['id_psn']);
  while ($detail_order = mysql_fetch_array($query_detail_order)) {
    $barang = read_barang_byId($detail_order['ID_BARANG']);

    $sama = false;
		foreach ($_SESSION['list'] as $key=>$value) {
		if ($value['id'] == $detail_order['ID_BARANG']){
      $sama = true;
		}
	 }

   if (!$sama) {
     $item = array(
       'id' => $barang['ID_BARANG'],
       'nama' => $barang['NM_BARANG'].'-'.$barang['WARNA'].'-'.$barang['UKURAN'],
       'harga_jual' => $detail_order['HARGA'],
       'harga_beli' => $barang['HARGA_BELI'],
       'jumlah' => $detail_order['JUMLAH'],
       'berat'	=> $barang['BERAT_BARANG']*$detail_order['JUMLAH'],
       'subtotal' => $detail_order['TOTAL']
     );
     $_SESSION['list'][] =  $item;
   }

  }

  $_SESSION['total'] = $order['TOTAL'];
  header('Location:pengiriman.php');
}
?>
