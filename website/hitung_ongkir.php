<?php
  include '../function/koneksi.php';
  include '../function/pengiriman_pembayaran.php';

  $id_kota = $_REQUEST['id_kota'];
  $berat = $_REQUEST['berat'];

  $obj= get_biaya_kirim($id_kota, $berat,"jne");

  $banyak_pilihan = count($obj->rajaongkir->results[0]->costs);
    if ($banyak_pilihan == 0) {
  ?>
      <option value="" disabled="true">tidak ada jasa pengiriman yang melayani</option></br>
  <?php
  }
  ?>
      <option value="">-- pilih jasa pengiriman --</option>
  <?php
  for($i=0;$i<$banyak_pilihan;$i++){
    if($service_desc = $obj->rajaongkir->results[0]->costs[$i]->description != "JNE Trucking"){
      $kurir = $obj->rajaongkir->results[0]->code;
      $service = $obj->rajaongkir->results[0]->costs[$i]->service;
      $service_desc = $obj->rajaongkir->results[0]->costs[$i]->description;
      $biaya = $obj->rajaongkir->results[0]->costs[$i]->cost[0]->value;
      $estimasi = $obj->rajaongkir->results[0]->costs[$i]->cost[0]->etd;
    ?>
    <option value='{"kurir":"<?php echo $kurir; ?>","service":"<?php echo $service; ?>", "biaya":"<?php echo $biaya; ?>"}'><?php echo $kurir." : ".$service." (".$service_desc.") - Rp.".number_format($biaya, 2, ",", ".")." (".$estimasi." hari)"; ?></option></br>
  <?php
    }
  }
  ?>
