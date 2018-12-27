<?php
include '../function/konsumen.php';
include '../function/penjualan.php';
include '../function/barang.php';
include '../function/retur.php';
?>

<body>
  <h4>Daftar barang</h4>
  <div class="w3-container w3-padding-12">
    <span class="w3-text-red">* </span>checklist barang yang disetujui
    <div class="w3-row w3-light-grey" style="margin-bottom:10px">
      <div class="w3-col m3 s3">
        <b>Barang : </b><br>
      </div>

      <div class="w3-col m1 s1">
        <b>jumlah : </b>
      </div>

      <div class="w3-col m2 s2">
        <b>keterangan : </b><br>
      </div>

      <div class="w3-col m2 s2 w3-container">
        <b>barang pengganti : </b><br>
      </div>

      <div class="w3-col m2 s2">
        <b>Biaya tambahan : </b><br>
      </div>

      <div class="w3-col m1 s1">
        <b>Kontrol :</b>
      </div>
    </div>
    <?php
    $n = 0;
    $query_detail = get_detailjualby_id($_REQUEST['id_beli']);
    while ($detail = mysql_fetch_array($query_detail)){
      $barang = read_barang_byId($detail['ID_BARANG']);
      ?>
      <div class="w3-row">
        <div class="w3-col m3 s3">
          <input class="w3-input w3-border-white" style="padding-top:0px; padding-left:0px" type="text" id="barang_lama<?php echo $n; ?>" data-id="<?php echo $barang['ID_BARANG']; ?>" data-harga="<?php echo $barang['HARGA_JUAL']; ?>" value="<?php echo $barang['NM_BARANG'].' - '.$barang['WARNA'].' - '.$barang['UKURAN']." "; ?>" readonly>
        </div>

        <div class="w3-col m1 s1">
          <select class="w3-input w3-border w3-round" name="jumlah<?php echo $detail['ID_BARANG']; ?>" type="text" style="width:70%; height:38px">
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
          </select>
        </div>

        <div class="w3-col m2 s2">
          <input class="w3-input w3-border w3-round" type="text" name="keterangan<?php echo $detail['ID_BARANG']; ?>">
        </div>

        <div class="w3-col m2 s2 w3-container">
          <select name="barang_pengganti<?php echo $detail['ID_BARANG']; ?>" id="barang_pengganti<?php echo $n; ?>" data-id='<?php echo $n; ?>' class="cek_biaya w3-input w3-border w3-round" style="height:38px">
            <option>pilih barang</option>

            <?php
            $query_barang = read_barang();
            while($row = mysql_fetch_array($query_barang)){
              ?>
              <option value='{"id_barang":"<?php echo $row['ID_BARANG'];?>","harga":"<?php echo $row['HARGA_JUAL'];?>"}' required><?php echo $row['NM_BARANG'].' - '.$row['WARNA'].' - '.$row['UKURAN'];?></option>
              <?php	}	?>
            </select>
          </div>

          <div class="w3-col m2 s2">
            <input class="w3-input w3-border-white" name="biaya_tambahan<?php echo $detail['ID_BARANG']; ?>" type="text" id="biaya<?php echo $n; ?>" readonly>
            <div id="keterangan<?php echo $n; ?>" style="font-size:10px"></div>
          </div>

          <div class="w3-col m1 s1">
            <input name="barang[]" class="w3-check" type="checkbox" value="<?php echo $detail['ID_BARANG']; ?>">
            <label for="barang"><b>setujui</b></label>
          </div>
        </div>

        <hr>
        <?php
        $n++;
      }
      ?>
      <div class="w3-row">
        <b>
          <div class="w3-col m2 s2">
            Total Rp.
          </div>
          <div class="w3-col m10 s10">
            <input class="w3-input w3-border-white" name="total_biaya" style="padding-top:0px; padding-left:0px" type="number" id="total" readonly>
          </div>
        </b>
      </div>
    </div>

</body>
<script>
var qty = <?php echo $n; ?>;
var barang = [];

for (var i = 0; i < qty; i++) {
  barang[i] = 0;
}


$(".cek_biaya").change(function(){
  var total = 0;
  var nilai = $(this).data('id');
  var barang_lama = $("#barang_lama"+nilai).data('id');
  var barang_baru = $("#barang_pengganti"+nilai).val();
  var barang_pengganti = JSON.parse(barang_baru);
  var idbarang_pengganti = barang_pengganti.id_barang;

  if (barang_lama == idbarang_pengganti) {
    $("#biaya"+nilai).val('0');

    $("#keterangan"+nilai).html('');
  }else {
    var harga_barang_lama = $("#barang_lama"+nilai).data('harga');
    var harga_barang_pengganti = barang_pengganti.harga;
    var biaya_tambahan = harga_barang_lama - harga_barang_pengganti;

    if (biaya_tambahan < 0) {
      $("#biaya"+nilai).val((biaya_tambahan*-1));
      $("#keterangan"+nilai).html('barang lama : Rp.'+harga_barang_lama+'<br>barang pengganti : Rp.'+harga_barang_pengganti);

      barang[nilai] = (biaya_tambahan*-1);
    }else {
      $("#biaya"+nilai).val('0');
      $("#keterangan"+nilai).html('');
    }
  }

  //untuk menjumlah total
  for (var i = 0; i < qty; i++) {
    total = total + barang[i];
  }

  $('#total').val(total);
});
</script>
