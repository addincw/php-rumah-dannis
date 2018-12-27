<?php
include 'header.php';
?>

<div class="w3-container" style="margin-top:85px; margin-bottom:20px;">
  <?php
  if(isset($_REQUEST['status_upload'])){
  ?>
  <div class="w3-panel w3-card-4 w3-blue">
    <p>
      <span onclick="this.parentElement.style.display='none'" class="w3-closebtn w3-margin-right w3-medium">x</span>
      <?php echo $_REQUEST['status_upload']; ?>
    </p>
  </div>
  <?php
  }
  ?>
  <div class="w3-container w3-card w3-white" style="margin-bottom:150px">
    <h3 class="w3-border-bottom w3-border-black w3-padding-12">Form retur barang</h3>
    <div class="w3-row">
      <div class="w3-col m7">
        <form method="post" action="upload_retur.php"  enctype="multipart/form-data">
          <p>
            masukkan nomor pembelian yang anda dapatkan.
          </p>

          <p>
  					<label>No pembelian </label>
            <input id="nomorbeli" name="nomor_pembelian" class="w3-input w3-border w3-round" required></input>
  				</p>

          <div id="daftar_barang">
          </div>


          <p>
            <button class="w3-btn w3-medium w3-green" type="submit" style="width:100%">proses retur <i class="fa fa-arrow-right"></i></button>
          </p>
        </form>
       </div>


     <div class="w3-container w3-col m5">

         <div class="w3-panel w3-blue">
           <p>ATURAN RETUR :</p>
         </div>

        <div class="w3-card w3-border" style="margin-bottom:55px">
          <p>
            <ul>
              <li>Barang yang dapat diretur, adalah barang yang mengalami kerusakan sebelum di gunakan.</li>
              <li>Barang tidak dapat ditukarkan dengan uang, harus berupa barang dengan harga minimal sama dengan harga barang yang diretur</li>
              <li>jika harga barang pengganti lebih tinggi dari harga barang yang diretur. maka pembeli akan di kenakan biaya tambahan selisih harga dari kedua barang tersebut.</li>
              <li>biaya pengiriman di tanggung oleh pembeli.</li>
            </ul>
          </p>
       </div>
    </div>
   </div>

  </div>
</div>

</body>
<script>
  $("#nomorbeli").keyup(function(){
    var id = $("#nomorbeli").val();
    $.get("detail_retur.php",
            {
              id_beli : id
            },
            function(data,status){
              $('#daftar_barang').html(data);
              //alert(kota);
            });
  });
</script>

<?php include "footer.php"; ?>
