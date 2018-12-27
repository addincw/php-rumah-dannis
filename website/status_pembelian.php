<?php
  include 'header.php';
  include '../function/pengiriman_pembayaran.php';
  include '../function/penjualan.php';
  include '../function/konsumen.php';

  @$pembelian = get_pembelian_terakhir($_SESSION['ID_KONS']);

  if(isset($_SESSION['keterangan'])){
  echo $_SESSION['keterangan'];
  unset($_SESSION['keterangan']);
  }
?>

<div class="w3-container w3-padding-32" style="margin-top:55px;">
  <?php
  if(isset($_SESSION['status_update'])){
  ?>
  <div class="w3-panel w3-card-4 w3-blue" style="padding-top:5px; padding-bottom:5px">
      <span onclick="this.parentElement.style.display='none'" class="w3-closebtn w3-margin-right w3-medium">x</span>
      <?php
        echo $_SESSION['status_update'];
        unset($_SESSION['status_update']);
      ?>
  </div>
  <?php
  }
  ?>

  <div class="w3-bar" style="margin-bottom:18px">
  	<a href="status_pembelian.php">
  		<button class="w3-button <?php if (basename($_SERVER['PHP_SELF']) == 'status_pembelian.php') echo 'w3-red'; else echo 'w3-light-gray'; ?>" style="border:0px; padding:6px">status pembelian</button>
  	</a>
  	<a href="status_retur.php">
  		<button class="w3-button <?php if (basename($_SERVER['PHP_SELF']) == 'status_retur.php') echo 'w3-red'; else echo 'w3-light-gray'; ?>" style="border:0px; padding:6px">status retur</button>
  	</a>
    <a href="status_order.php">
      <button class="w3-button <?php if (basename($_SERVER['PHP_SELF']) == 'status_order.php') echo 'w3-red'; else echo 'w3-light-gray'; ?>" style="border:0px; padding:6px">status order</button>
    </a>
  </div>
  <div class="w3-container w3-card w3-white">
    <h3 class="w3-border-bottom w3-border-black w3-padding-12">Status pembelian</h3>
    <p>cek status pembelian anda, dengan memasukkan nomor pembelian yang tertera pada nota.</p>
    <form>
      <div class="w3-row">
        <div class="w3-col m5">
          <label for="nomor_pembelian">nomor pembelian :</label>
          <input id="nomorbeli" class="w3-input w3-border w3-round" type="text" name="nomor_pembelian" style="width:88%">
        </div>

        <div class="w3-col m7">
          <button id="cek" class="w3-btn w3-btn-small w3-round w3-green" type="button" name="button" style="margin-top:25px">cek</button>
        </div>
      </div>
    </form>

    <p>pembelian terakhir : <span id="cek2" data-id="<?php echo $pembelian['ID_JUAL']; ?>" class="w3-border-bottom w3-border-blue w3-text-blue"><?php echo $pembelian['ID_JUAL'].' '.$pembelian['TGL_PESAN']; ?></span></p>
  </div>

  <div id="detail_status" style="margin-top:20px; margin-bottom:30px">
    <div style="margin-bottom:150px">

    </div>
  </div>


</div>

</body>

<script>
  $("#cek").click(function(){
    var id = $("#nomorbeli").val();
    $.get("detail_status.php",
            {
              id_beli : id
            },
            function(data,status){
              $('#detail_status').html(data);
              //alert(kota);
            });
  });

  $("#cek2").click(function(){
    var id = $("#cek2").data('id');
    $.get("detail_status.php",
            {
              id_beli : id
            },
            function(data,status){
              $('#detail_status').html(data);
              //alert(kota);
            });
  });
</script>

<?php include "footer.php"; ?>
