<?php
  include "header.php";
  include "../function/ATM.php";

  if(!isset($_SESSION['transaksi'])){
    $_SESSION['keterangan'] = "silahkan melihat perkembangan transaksi pembelian anda di halaman ini";
    header("location:status_pembelian.php");
  }

  $id = $_SESSION['transaksi']['id_atm'];
  $atm = read_ATMby_id($id);
?>

<div class="w3-container w3-padding-32" style="margin-top:55px;">
  <div class="w3-container w3-card w3-white">
    <h3 class="w3-border-bottom w3-border-black w3-padding-12">Pembelian akan segera di proses ...</h3>
    <div class="w3-row">
      <div class="w3-col m6">
        <p>
          Terimakasih, pembelian anda akan di proses setelah anda melakukan transfer dan menguploadnya
          pada halaman transaksi > upload bukti pembayaran.
        </p>

        <p>
          silahkan transfer ke nomor rekening <?php echo $atm['NAMA']; ?> a/n <?php echo $atm['NAMA_REKENING']; ?> <?php echo $atm['NOMOR_REKENING']; ?> sebesar <?php echo number_format($_SESSION['transaksi']['total_pembayaran'], 2, ",", "."); ?> rupiah.
        </p>

        <p>
          pemesanan dianggap batal jika melebihi batas maksimal transfer, yaitu 1X24 jam
        </p>
     </div>

     <div class="w3-container w3-col m6">
  		 <p>DETAIL PEMBELIAN</p>
       <div class="w3-row">
           <div class="w3-half">nomor pembelian <?php echo $_SESSION['transaksi']['id_jual']; ?></div>
           <div class="w3-half w3-right"><span class="w3-right" id="total_barang"><?php echo date('d/m/Y'); ?></span></div>
       </div>
       <!--<div style="font-size:18px">kode xxx-xxx</div>-->
       <div class="w3-responsive">
         <?php include 'side_keranjang.php'; ?>
       </div>

       <div class="w3-row">
           <div class="w3-half">Total harga barang</div>
           <div class="w3-half w3-right"><span class="w3-right" id="total_barang"><?php echo "Rp. ".number_format($_SESSION['transaksi']['total_barang'], 2, ",", "."); ?></span></div>
       </div>

       <div class="w3-row">
           <div class="w3-half">Ongkos kirim</div>
           <div class="w3-half w3-right"><span class="w3-right" id="ongkir"><?php echo "Rp. ".number_format($_SESSION['transaksi']['biaya_kirim'], 2, ",", ".");; ?></span></div>
       </div>

       <hr class="w3-border-grey">

       <div class="w3-row">
           <div class="w3-half">Total biaya</div>
           <div class="w3-half"><span class="w3-right" id="total_biaya"><?php echo "Rp. ".number_format($_SESSION['transaksi']['total_pembayaran'], 2, ",", "."); ?></span></div>
       </div>

       <p>
         <a href="nota_beli.php?id_jual=<?php echo $_SESSION['transaksi']['id_jual'];?>" target="_blank">
           <button class="w3-btn w3-medium" type="button">simpan nota</button>
         </a>
       </p>

       <div style="font-size:12px; margin-bottom:10px"><span class="w3-text-red">* </span>
         simpan nomor pembelian anda. berguna untuk mengecek status barang anda
       </div>
     </div>
   </div>
  </div>
</div>

</body>

<?php
  include "footer.php";

  unset($_SESSION['list']);
  unset($_SESSION['transaksi']);
?>
