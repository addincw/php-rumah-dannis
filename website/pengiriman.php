<?php
ob_start();
include "header.php";
include '../function/konsumen.php';
include "../function/pengiriman_pembayaran.php";
include "../function/ATM.php";

  if (!isset($_SESSION['list'])) {
    header('location:index.php');
  }else {
    if (!isset($_SESSION['ID_KONS'])) {
      $_SESSION['RETURN_PAGE'] = 'website/pengiriman.php';
      $_SESSION['STATUS_BELANJA'] = 'login terlebih dahulu untuk melanjutkan transaksi';
      header('location:../login.php');
    }else{
      $id_kons = $_SESSION['ID_KONS'];
    }
  }

?>

<div class="w3-container w3-padding-32" style="margin-top:55px;">
  <div class="w3-container w3-card w3-white">
    <h3 class="w3-border-bottom w3-border-black w3-padding-12">Form pengiriman & pembayaran</h3>
    <div class="w3-row">
      <div class="w3-col m6">
        <form method="post" action="insert_penjualan.php">
          <div class="w3-row">
            <p>Alamat pengiriman</p>
            <div class="w3-half">
              <input id="alamat_sama" class="w3-radio" type="radio" name="alamat" value="0">
              <label class="w3-validate">sama dengan akun</label>
            </div>
            <div class="w3-half">
              <input id="alamat_beda" class="w3-radio" type="radio" name="alamat" value="1" checked="checked">
              <label class="w3-validate">beda dengan akun</label>
            </div>
          </div>

          <p>
            <label>Alamat lengkap</label>
            <input id="alamat" class="w3-input w3-border w3-round" name="alamat_lengkap" type="textarea" style="width:75%" required>
          </p>

          <p>
            <label>Pilih provinsi tempat tinggal</label>
            <select id="provinsi" class="w3-input w3-border w3-round" name="provinsi" type="text" style="width:75%; height:38px">
              <option value="">-- pilih provinsi --</option>
              <?php
              $prov = get_provinsi();
                while($provinsi = mysqli_fetch_array($prov)){
              ?>
                <option value="<?php echo $provinsi['ID_PROVINSI']; ?>"><?php echo $provinsi['NAMA_PROVINSI']; ?></option>
              <?php
                }
              ?>
            </select>
          </p>

          <p>
            <label>Pilih kota tempat tinggal</label>
            <select id="kota" class="w3-input w3-border w3-round" name="kota" type="text" style="width:75%; height:38px" disabled>
              <option value="">-- pilih kota --</option>
            </select>
            <div id="warning" class="w3-text-red w3-small"></div>
          </p>

          <p>
            <button id="hitung_ongkir" class="w3-btn w3-small w3-blue" type="button">gunakan alamat</button>
          </p>

          <hr class="w3-border-grey">

          <p>
            <div id="warning2" class="w3-small w3-text-red">isi alamat, provinsi dan kota terlebih dahulu sebelum mengisi jasa pengiriman dan bank</div>
            </br>
            <label>pilih jasa pengiriman</label>
            <select id="jasa_pengiriman" class="w3-input w3-border w3-round" name="jasa_kirim" type="text" data-biaya="hai" style="width:75%; height:38px" disabled>
                  <option value="">-- pilih jasa pengiriman --</option>
            </select>
          </p>

          <p>
            <?php
            $konsumen = read_Konsumenby_id($id_kons);
            @$rekening = explode(":", $konsumen['REKENING_KONS']);
            //print_r($rekening);
            ?>
            <label>Nomor rekening anda (yang kedepannya akan anda gunakan bertransaksi)</label>
            <div class="w3-row" style="width:75%">
              <div class="w3-col l3" style="padding-right:5px">
                <input class="w3-input w3-border w3-round" name="bank_kons" type="text" style="height:28px" placeholder="nama bank" value="<?php echo $rekening[0]; ?>"required>
                <div style="font-size:10px">
                  contoh : Mandiri, BCA, BRI, dll
                </div>
              </div>
              <div class="w3-col l9">
                <input class="w3-input w3-border w3-round" name="rekening_kons" type="text" style="height:28px" placeholder="nomor rekening" value="<?php echo $rekening[1]; ?>" required>
              </div>
            </div>
          </p>

          <p>
            <label>Pilih bank untuk transfer</label>
            <select id="bank_transaksi" class="w3-input w3-border w3-round" name="atm" type="text" style="width:75%; height:38px" disabled>
                  <option value="">-- pilih bank --</option>
            <?php
              $list_atm = read_allATM();
              while($bank = mysqli_fetch_array($list_atm)){
            ?>
                  <option value="<?php echo $bank['ID_ATM']; ?>"><?php echo $bank['NAMA']; ?></option>
            <?php
              }
            ?>
            </select>
          </p>

          <p>
            <button class="w3-btn w3-medium w3-green" type="submit">proses pembelian <i class="fa fa-arrow-right"></i></button>
          </p>
        </form>
     </div>

     <div class="w3-col m6">
       <p>DETAIL PEMBELIAN</p>
       <!--keranjang diambil dari side-keranjang.php-->
       <div class="w3-responsive">
         <?php include "side_keranjang.php"; ?>
       </div>

       <?php $total_barang = $_SESSION['total']; ?>
       <div class="w3-row" style="font-size:18px">
         <b>
           <div class="w3-half">Total harga barang</div>
           <div class="w3-half w3-right"><span class="w3-right" id="total_barang"></span></div>
         </b>
       </div>

       <div class="w3-row" style="font-size:18px">
         <b>
           <div class="w3-half">Ongkos kirim</div>
           <div class="w3-half w3-right"><span class="w3-right" id="ongkir"></span></div>
         </b>
       </div>

       <hr class="w3-border-grey">

       <div class="w3-row" style="font-size:18px">
         <b>
           <div class="w3-half">Total biaya</div>
           <div class="w3-half"><span class="w3-right" id="total_biaya"></span></div>
         </b>
       </div>

       <div id="keterangan" style="font-size:14px"><span class="w3-text-red">*</span> belum termasuk ongkir</div>
     </div>
   </div>
  </div>
</div>

</body>

<script>
  $("document").ready(function(){
    $("#provinsi").select2({
      placeholder : "pilih provinsi"
    });

    $("#kota").select2({
      placeholder : "pilih kota"
    });

    var total_barang = <?php echo $total_barang ?>;
    $("#total_barang").html(total_barang);
    $("#total_biaya").html(total_barang);

    $( "#provinsi" ).change(function() {
      $("#kota").removeAttr("disabled");
      var id = $("#provinsi").val();
      $.post("cari_kota.php",
              {
                id_provinsi : id
              },
              function(data,status){
                $('#kota').html(data);
              });
    });

    $( "#alamat_sama" ).click(function() {
      $("#kota").removeAttr("disabled");
      var konsumen = "<?php echo $id_kons ?>";
      $.post("ambil_alamat.php",
              {
                id_kons : konsumen
              },
              function(data,status){
                var obj = JSON.parse(data);
                $('#alamat').val(obj.alamat);
                $('#provinsi').val(obj.provinsi);
                $.post("cari_kota.php",
                        {
                          id_provinsi : obj.provinsi
                        },
                        function(data,status){
                          $('#kota').html(data);
                          $('#kota').val(obj.kota);
                        });
                //alert(data);
              });
    });

    $( "#alamat_beda" ).click(function() {
      $("#edit").prop("disabled", true);
      $("#alamat").removeAttr("disabled");
      $("#provinsi").removeAttr("disabled");
    });

    $( "#hitung_ongkir" ).click(function() {
      if (($('#alamat').val().length != 0) && ($('#provinsi').val().length != 0) && ($('#kota').val().length != 0)){
        $("#warning").html("");
        $("#warning2").html("");
        $("#jasa_pengiriman").removeAttr("disabled");
        var kota = $("#kota").val();
        $.post("hitung_ongkir.php",
                {
                  id_kota : kota,
                  berat : <?php echo $_SESSION['berat']; ?>
                },
                function(data,status){
                  $('#jasa_pengiriman').html(data);
                  //alert(kota);
                });
      }

      else{
        $("#warning").html("* alamat tidak boleh kosong, provinsi dan kota harus diisi");
      }

    });

    $( "#jasa_pengiriman" ).change(function() {
      $("#bank_transaksi").removeAttr("disabled");
      var data_kurir = $("#jasa_pengiriman").val();
      var kurir = JSON.parse(data_kurir);
      var ongkos_kirim = kurir.biaya;
      var total_barang = <?php echo $total_barang ?>;
      var total_biaya = Number(total_barang) + Number(ongkos_kirim);
      $("#total_barang").html(total_barang);
      $("#ongkir").html(ongkos_kirim);
      $("#total_biaya").html(total_biaya);
      $("#keterangan").html("");
    });
  });
</script>

<?php include "footer.php"; ?>
