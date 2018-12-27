<?php include "header.php"; ?>

<div class="w3-container w3-padding-32" style="margin-top:35px; padding-left:50px; padding-right:50px">
    <h3 class="w3-border-bottom w3-border-black w3-padding-12">Form pembayaran</h3>
  <div class="w3-row">
    <div class="w3-col m6">
      <form method="post" action="nota.php">
        <p>
					<label>Pilih ATM</label>
					<select class="w3-input w3-border w3-round" name="kota" type="text" style="width:75%; height:38px">
								<option value="JNE" required>BRI</option>
                <option value="TIKI" required>Mandiri</option>
					</select>
				</p>

        <p>
          <button class="w3-btn w3-medium w3-green" type="submit">Lanjut <i class="fa fa-arrow-right"></i></button>
        </p>
      </form>
   </div>

   <div class="w3-col m6" style="padding-left:50px">
		 <p>DETAIL PEMBELIAN</p>
     <!--<div style="font-size:18px">kode xxx-xxx</div>-->
     <?php include 'side_keranjang.php'; ?>
     <div style="font-size:18px"><b>Total harga barang <?php echo "Rp. ".number_format($_SESSION['total'], 2, ",", "."); ?></b></div>
     <div style="font-size:14px"><b>Biaya kirim RP. xxx.xxx</b></div>
     <hr class="w3-border-grey">
     <div style="font-size:14px"><b>Total belanja RP. xxx.xxx</b></div>
   </div>
 </div>
</div>

</body>

<?php include "footer.php"; ?>
