<?php
include 'header.php';
include '../function/pengiriman_pembayaran.php';

@$pembelian = get_pembelian_terakhir($_SESSION['ID_KONS'],'0');
?>

<div class="w3-container" style="margin-top:35px; padding-top:65px; margin-bottom:20px">
  <?php
  if(isset($_SESSION['status_upload'])){
    ?>
    <div class="w3-panel w3-card-4 w3-blue">
      <p>
        <?php
        echo $_SESSION['status_upload'];
        unset($_SESSION['status_upload']);
        ?>
      </p>
    </div>
    <?php
  }
  ?>
  <div class="w3-container w3-card w3-white">
    <h3 class="w3-border-bottom w3-border-black w3-padding-12">Konfirmasi pembayaran</h3>
    <div class="w3-row">
      <div class="w3-col m5">
        <form method="post" action="insert_konfirmasi_pembayaran.php"  enctype="multipart/form-data">
          <p>
            masukkan nomor pembelian yang anda dapatkan dan upload bukti transfer anda.
          </p>

          <p>
  					<label>No pembelian </label>
            <input name="nomor_pembelian" class="nomorpembelian w3-input w3-border w3-round" required></input>
  				</p>

          <p>
            <label>Bukti transfer </label></br>
            <input name="bukti_transfer" style="width:100%" type="file" required />
  				</p>

          <p>
            <?php if(isset($_SESSION['ID_KONS'])){ ?>
              <button class="w3-btn w3-medium w3-green" type="submit" style="width:100%">upload pembayaran <i class="fa fa-arrow-right"></i></button>
            <?php }else {  ?>
              <button class="w3-btn w3-medium w3-green" type="submit" style="width:100%" disabled>upload pembayaran <i class="fa fa-arrow-right"></i></button>
            <?php } ?>
          </p>
        </form>
       </div>


     <div class="w3-container w3-col m7">

         <div class="w3-panel w3-blue">
           <p>PEMBELIAN TERAKHIR MENUNGGU KONFIRMASI</p>
         </div>

        <div class="w3-card w3-border" style="margin-bottom:55px">
           <div class="w3-panel w3-row">
               <div class="w3-half">nomor pembelian</div>
               <div class="w3-half w3-right">
                 <span class="w3-right">
                   <a href="#" class="idbeli" data-value="<?php echo $pembelian['ID_JUAL']; ?>"><?php echo $pembelian['ID_JUAL']; ?></a>
                 </span>
               </div>
               </br>
               <span style="font-size:10px;">
                 tanggal pembelian : <?php echo $pembelian['TGL_PESAN']; ?></br>
                 deadline pembayaran tanggal : <?php echo $pembelian['DEADLINE_PEMBAYARAN']; ?>
               </span>
           </div>

           <hr>

           <div class="w3-panel">
               Alamat pengiriman :</br>
               <span style="font-size:14px;">
                 <?php echo $pembelian['ALAMAT_KIRIM']; ?>
               </span>
           </div>

           <hr>

           <div class="w3-panel w3-row">
               <div class="w3-half"><b>Total pembayaran</b></div>
               <div class="w3-half w3-right"><span class="w3-right"><b><?php echo "Rp. ".number_format($pembelian['TOTAL_PEMBAYARAN'], 2, ",", "."); ?></b></span></div>
           </div>
         </div>

        <div class="w3-panel w3-border">
            <p>PEMBELIAN LAINNYA, MENUNGGU KONFIRMASI</p>

            <hr class="w3-border-grey">

            <div class="w3-row" style="margin-bottom:15px">
              <?php
               @$query_list = get_pembelian_terbaru($_SESSION['ID_KONS']);
               while($list_pembelian = mysql_fetch_array($query_list)){
                 if ($list_pembelian['ID_JUAL'] != $pembelian['ID_JUAL']) {
              ?>
                   <div class="w3-col s2"><a href="#"><?php echo $list_pembelian['ID_JUAL']; ?></a></div>
             <?php
                 }
               }
             ?>
          </div>
        </div>
      </div>
   </div>

  </div>
</div>

</body>
<script>
  $('.idbeli').click(function(){
    var id = $(this).data('value');
    $('.nomorpembelian').val(id);
  });
</script>
<?php include "footer.php"; ?>
