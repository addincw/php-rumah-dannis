<?php
  include '../function/koneksi.php';
  include '../function/pengiriman_pembayaran.php';

  $id_provinsi = $_REQUEST['id_provinsi'];

  $list_kota = get_kota_byProvinsi($id_provinsi);
  while($kota = mysqli_fetch_array($list_kota)){
    //echo $kota['ID_KOTA'].' '.$kota['NM_KOTA'].', ';
?>
    <option value="<?php echo $kota['ID_KOTA']?>"><?php echo $kota['NM_KOTA'].', '.$kota['TYPE_KOTA']; ?></option></br>
<?php
  }
?>
