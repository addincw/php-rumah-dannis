<?php
  include "../function/konsumen.php";
  $id_kons = $_REQUEST['id_kons'];

  $konsumen = read_Konsumenby_id($id_kons);
  $provinsi = read_Kotaby_id($konsumen['ID_KOTA']);
  $alamat = '{"alamat":"'.$konsumen['ALM_KONS'].'","provinsi":"'.$provinsi['ID_PROVINSI'].'","kota":"'.$konsumen['ID_KOTA'].'"}';
  echo $alamat;
?>
