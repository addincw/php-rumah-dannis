<?php
  include "header.php";
  include "../function/barang.php";
  include "../function/kategori.php";
  $id_barang = $_REQUEST['id_barang'];

  //ambil detail informasi gambar
  $barang = read_barang_byId($id_barang);

  //ambil nama kategori
  $kategori = read_kategori_byId($barang['ID_KATEGORI']);
?>

<div class="w3-container w3-padding-32" style="margin-top:55px;">
  <div class="w3-container w3-card w3-white">
    <h3 class="w3-border-bottom w3-border-black w3-padding-12">Detail product</h3>
    <div class="w3-panel w3-round-medium w3-padding-12 w3-yellow">
      jika stok barang kosong, anda dapat memesannya dengan menekan button order.
      kami akan mengupayakan ketersediaan barang beberapa hari ke depan. Pembayaran
      dilakukan setelah barang tersedia.
    </div>
    <div class="w3-row">
      <div class="w3-col m7" style="padding-right:15px">
        <div class="w3-display-container w3-border">
          <?php if ($barang['STOK_BARANG'] <= 0) { ?>
          <div id="stok_barang" data-value="0" class="w3-display-topleft w3-black w3-padding">Stok kosong</div>
          <?php } ?>
          <img src="../asset/<?php echo $barang['GAMBAR1']; ?>.jpg" alt="House" style="width:100%; height:400px">
        </div>
        <div class="w3-row w3-section">
          <div class="w3-col s2 w3-border" style="margin-right:3px"><img src="../asset/<?php if(!empty($barang['GAMBAR2'])){echo $barang['GAMBAR2'].'.jpg';}else{ echo 'no-image-box.png'; }  ?>" alt="House" width="100%" height="100px"></div>
          <div class="w3-col s2 w3-border" style="margin-right:3px"><img src="../asset/<?php if(!empty($barang['GAMBAR3'])){echo $barang['GAMBAR3'].'.jpg';}else{ echo 'no-image-box.png'; }  ?>" alt="House" width="100%" height="100px"></div>
          <div class="w3-col s2 w3-border" style="margin-right:3px"><img src="../asset/<?php if(!empty($barang['GAMBAR4'])){echo $barang['GAMBAR4'].'.jpg';}else{ echo 'no-image-box.png'; }  ?>" alt="House" width="100%" height="100px"></div>
       </div>
     </div>

     <div class="w3-col m5">
       <form id="form" method="post" action="keranjang.php">
         <div style="font-size:24px"><b><?php echo $barang['NM_BARANG'].'-'.$barang['WARNA'].'-'.$barang['UKURAN']; ?></b></div>
         <div class="w3-row" style="font-size:18px">
           <div class="w3-col s1">kode</div>
           <div class="w3-rest"><input class="w3-input" name="id_barang" style="padding:0px; border-bottom:0px" value="<?php echo $barang['ID_BARANG']; ?>" readonly></input></div>
         </div>
         <p class="w3-xlarge w3-text-red"><b><?php echo "Rp. ".number_format($barang['HARGA_JUAL'], 2, ",", "."); ?></b></p>
         <p class="w3-small w3-text-black">Stok saat ini terdapat <?php echo $stok = $barang['STOK_BARANG']; ?> barang</p>
         <p>
           <label>jumlah</label>
           <select id="jumlah_beli" class="w3-input w3-border w3-round" name="jumlah" type="text" style="width:25%; height:38px">
                 <?php for($i=1; $i<=$stok; $i++){
                 ?>
                  <option value="<?php echo $i; ?>" required><?php echo $i; ?></option>
                 <?php
                    }
                 ?>
           </select>
           <input id="jumlah_order" class="w3-input w3-border w3-round" type="text" name="jumlah_order" style="width:25%; height:38px; display:none">
         </p>
         <button id="btn_keranjang" class="w3-btn w3-round w3-large" type="submit"><i class="fa fa-shopping-cart"></i> tambah ke keranjang</button>
         <button id="btn_order" class="w3-btn w3-round w3-large" type="submit" style="display:none"><i class="fa fa-shopping-cart"></i> order</button>
       </form>

       <hr>

       <p class="w3-large w3-text-red"><b>KATEGORI : </b><a href="#"><?php echo strtoupper($kategori['NAMA_KATEGORI']); ?></a></p>
       <hr>
     </div>
   </div>
  </div>
</div>

</body>
<script>
  var stok = $("#stok_barang").data("value");
  if (stok <= 0) {
    $("#btn_keranjang").hide();
    $("#jumlah_beli").hide();
    $("#jumlah_order").show();
    $("#btn_order").show();
    $("#form").attr("action","keranjang_order.php");
  }
</script>

<?php include "footer.php"; ?>
