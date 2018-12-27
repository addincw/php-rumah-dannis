<?php
include '../function/penjualan.php';
include '../function/barang.php';

$query_barang = get_detailjualby_id($_REQUEST['id_beli']);
//$jumlah_barang = mysql_num_rows($barang);
//$jumlah_barang = 3;
?>

<h4>Daftar barang</h4>
<span class="w3-text-red">* </span>Silahkan checklist barang yang ingin di retur.

<?php
  $i=0;
  while ($detail = mysql_fetch_array($query_barang)) {
    $barang = read_barang_byId($detail['ID_BARANG']);
?>
  <div class="w3-row w3-border" style="padding:5px; margin-bottom:5px">
    <div class="w3-col m1 s1 w3-border-right">
      <input name="barang[]" class="w3-check" type="checkbox" value="<?php echo $detail['ID_BARANG']; ?>" style="top:0px">
    </div>

    <div class="w3-col m11 s11">
      <div class="w3-row">
        <div class="w3-container w3-col m3 s3">
          <img src="../asset/<?php echo $barang['GAMBAR1']; ?>.jpg" alt="" width="100%" height="30%">
        </div>

        <div class="w3-container w3-col m9 s9">
          <?php echo $barang['NM_BARANG'].' - '.$barang['WARNA'].' - '.$barang['UKURAN']; ?><br><br>
          <label for="">jumlah</label>
          <select class="w3-input w3-border w3-round" name="<?php echo $detail['ID_BARANG']; ?>jumlah" type="text" style="width:100%; height:38px">
                <?php
                  for($j=1; $j<=$detail['JUMLAH']; $j++){
                    if ($j == $detail['JUMLAH']) {
                ?>
                    <option value="<?php echo $j; ?>" selected><?php echo $j; ?></option>
                <?php
                    }else {
                ?>
                  <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                <?php
                    }

                   }
                ?>
          </select><br>
          <label>Bukti retur </label><br>
          <input name="<?php echo $detail['ID_BARANG']; ?>bukti_retur" type="file" style="width:100%" /><br><br>
          <label for="">keterangan</label>
          <input class="w3-input w3-border w3-round" type="text" name="<?php echo $detail['ID_BARANG']; ?>keterangan">
          <!--
          <label for="">pilih barang pengganti</label>
          <input class="w3-input w3-border w3-round" type="text" name="" value=""><br>
          -->
        </div>
      </div>

    </div>
  </div>
<?php
    $i++;
  }
?>
