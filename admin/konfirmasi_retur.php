<?php
session_start();
include '../function/pengiriman_pembayaran.php';
include '../function/retur.php';
include '../function/konsumen.php';
include '../function/penjualan.php';
include '../function/barang.php';
?>
    <?php
    include 'top-navbar.php';
    include 'side-navbar.php';
    ?>
		<body class="w3-light-grey">

    <div class="w3-main w3-container" style="margin-left:200px; padding-top:75px">
			<?php
				if (isset($_SESSION['status_update'])) {
			?>
				<div id="info" class="w3-panel w3-blue">
					<p>
					<span onclick="document.getElementById('info').style.display='none'" class="w3-btn w3-display-topright">&times;</span>
					<?php
						echo  $_SESSION['status_update'];
						unset($_SESSION['status_update']);
					?>
					</p>
				</div>
			<?php
				}
			?>
      <div class="w3-container w3-card w3-white" style="margin-top:20px;">
        <h3 class="w3-border-bottom w3-border-black w3-padding-12">LIST PENGAJUAN RETUR MENUNGGU KONFIRMASI</h3>
				<div class="w3-responsive">
					<table class="w3-table-all w3-card-2" style="margin-bottom:20px">
						<tr class="w3-green">
							<th>Tanggal pengiriman</th>
							<th>Tanggal pengajuan retur</th>
							<th>nomor pembelian</th>
							<th>pembeli</th>
							<th>jumlah item retur</th>
							<th>kontrol</th>
						</tr>

						<?php
						$id=0;
						$query = get_returbyStatus(0);
						while($retur = mysql_fetch_array($query)){
							$query_detail_retur = get_detail_returbyId($retur['ID_RETUR']);
							$detail_retur = mysql_fetch_array($query_detail_retur);

							$pembayaran = get_pembayaranby_Idjual($detail_retur['ID_JUAL']);
							$pengiriman = get_pengirimanby_idbayar($pembayaran['ID_PEMBAYARAN']);

							$penjualan = get_penjualanby_id($pembayaran['ID_JUAL']);
							$konsumen = read_Konsumenby_id($penjualan['ID_KONS']);
							?>
							<tr>
								<td><?php echo $pengiriman['TGL_KIRIM'];?></td>
								<td><?php echo $retur['TGL_PENGAJUAN_RETUR'];?></td>
								<td>
									<a href="nota.php?id_jual=<?php echo $detail_retur['ID_JUAL'];?>">
										<?php echo $detail_retur['ID_JUAL'];?>
									</a>
								</td>
								<td>
									<?php echo $konsumen['NM_KONS'];?></br>
									<?php echo "Telp: ".$konsumen['TELP_KONS'];?></br>
									<?php echo "Email: ".$konsumen['EMAIL_KONS'];?>
								</td>
								<td>
									<?php  echo $jumlah_item = mysql_num_rows($query_detail_retur); ?>
								</td>
								<td>
									<button data-id="<?php echo $id;?>" data-qty="<?php echo $jumlah_item;?>" class="action w3-btn w3-btn-small w3-green" type="button">detail</button>
								</td>
							</tr>

							<tr id="<?php echo $id; ?>" style="display:none">
								<form action="update_retur.php" method="post">
									<td colspan="6">
										<div class="w3-card-2 w3-border w3-border-yellow">
											<div class="w3-container w3-row w3-yellow w3-padding-12">
												<div class="w3-col m6 s6">
													<b>Nomor pembelian : </b>
													<input class="w3-input w3-yellow w3-border-yellow" style="padding-top:0px; padding-left:0px" type="text" name="ID_JUAL" value="<?php echo $detail_retur['ID_JUAL']; ?>" readonly>
													<b>Nomor retur : </b>
													<input class="w3-input w3-yellow w3-border-yellow" style="padding-top:0px; padding-left:0px" type="text" name="ID_RETUR" value="<?php echo $retur['ID_RETUR']; ?>" readonly><br>
												</div>

												<div class="w3-col m6 s6">
													<b>Data pembeli : </b><br>
													<?php echo $konsumen['NM_KONS'];?></br>
													<?php echo "Telp: ".$konsumen['TELP_KONS'];?></br>
													<?php echo "Email: ".$konsumen['EMAIL_KONS'];?><br>
													<div class="w3-row">
														<div class="w3-col m3 s3">
															<b>pengiriman :</b>
														</div>
														<div class="w3-col m9 s9">
															<input class="w3-input w3-yellow w3-border-yellow" style="padding-top:0px; padding-left:0px" type="text" name="ID_KIRIM" value="<?php echo $pengiriman['ID_KIRIM']; ?>" readonly>
														</div>
													</div>
													<?php echo $pengiriman['ALAMAT_KIRIM'];?><br>
													<?php echo 'kurir : '.$pengiriman['JASA_KIRIM']; ?>
													<span id="ongkir<?php echo $id; ?>" data-value="<?php echo $pengiriman['BIAYA_KIRIM']; ?>">
														<?php echo ' Rp.'.number_format($pengiriman['BIAYA_KIRIM'], 2, ',', '.');  ?>
													</span><br>
												</div>
											</div>

											<div class="w3-container w3-padding-12">
												<span class="w3-text-red">* </span>checklist barang yang disetujui
												<?php
												$n = 0;
												$query_detail_retur = get_detail_returbyId($retur['ID_RETUR']);
												while ($detail_retur = mysql_fetch_array($query_detail_retur)){
													$barang = read_barang_byId($detail_retur['ID_BARANG']);
													?>
													<div class="w3-row">
														<div class="w3-col m3 s3">
															<b>Barang : </b><br>
															<!--
															<span><?php //echo $barang['NM_BARANG'].' - '.$barang['WARNA'].' - '.$barang['UKURAN']." "; ?></span>
														-->
														<input class="w3-input w3-border-white" type="text" id="barang_lama<?php echo $id.$n; ?>" data-id="<?php echo $barang['ID_BARANG']; ?>" data-harga="<?php echo $barang['HARGA_JUAL']; ?>" value="<?php echo $barang['NM_BARANG'].' - '.$barang['WARNA'].' - '.$barang['UKURAN']." "; ?>" readonly>
														<br>
													</div>

													<div class="w3-col m1 s1">
														<b>jumlah : </b><br><?php echo $detail_retur['JUMLAH']; ?><br>
													</div>

													<div class="w3-col m2 s2">
														<b>keterangan : </b><br><?php echo $detail_retur['KETERANGAN_RETUR']; ?>
													</div>

													<div class="w3-col m1 s1">
														<b>bukti retur : </b><br>
														<img class="bukti_retur" data-foto="<?php echo $detail_retur['BUKTI_RETUR']; ?>.jpg" src="../asset/bukti_retur/<?php echo $detail_retur['BUKTI_RETUR']; ?>.jpg" alt="" width="100%" height="50%">
													</div>

													<div class="w3-col m2 s2 w3-container">
														<b>barang pengganti : </b><br>
														<select name="barang_pengganti<?php echo $detail_retur['ID_BARANG']; ?>" id="barang_pengganti<?php echo $id.$n; ?>" data-id='<?php echo $id.$n; ?>' class="cek_biaya w3-input w3-border w3-round" style="height:38px">
															<option>-- pilih barang --</option>

															<?php
															$query_barang = read_barang();
															while($row = mysql_fetch_array($query_barang)){
																if ($row['STOK_BARANG'] > 0) {
																	?>
																	<option value='{"id_barang":"<?php echo $row['ID_BARANG'];?>","harga":"<?php echo $row['HARGA_JUAL'];?>"}' required><?php echo $row['NM_BARANG'].' - '.$row['WARNA'].' - '.$row['UKURAN'];?></option>
																	<?php
																}
															}
															?>
														</select>
													</div>

													<div class="w3-col m2 s2">
														<b>Biaya tambahan : </b><br>
														<input class="w3-input w3-border-white" name="biaya_tambahan<?php echo $detail_retur['ID_BARANG']; ?>" type="text" id="biaya<?php echo $id.$n; ?>" readonly>
														<div id="keterangan<?php echo $id.$n; ?>" style="font-size:10px"></div>
													</div>

													<div class="w3-col m1 s1">
														<input name="barang[]" class="w3-check" type="checkbox" value="<?php echo $detail_retur['ID_BARANG']; ?>">
														<label for="barang"><b>setujui</b></label>
													</div>
												</div>

												<hr>
												<?php
												$n++;
											}
											?>
											<div class="w3-row">
												<div class="w3-col m10 s10">
													<div class="w3-row" style="font-size:20px">
														<b>
															<div class="w3-col m2 s2">
																Total Rp.
															</div>
															<div class="w3-col m10 s10">
																<input class="w3-input w3-border-white" name="total_biaya" style="padding-top:0px; padding-left:0px" type="number" id="total<?php echo $id; ?>" readonly>
															</div>
														</b>
													</div>
												</div>
												<div class="w3-col m2 s2">
													<div class="w3-right">
														<button type="submit" name="button" class="w3-btn w3-btn-xsmall w3-red w3-card-2">proses</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</td>
							</form>
						</tr>

						<?php
						$id++;
					}
					?>
				</table>
				</div>

        <div class="bukti w3-modal">
          <div class="w3-modal-content w3-animate-zoom" style="width:40%; height:70%">
            <span id="close_modal" class="w3-btn w3-display-topright">&times;</span>
            <img class="foto" alt="" width="100%" height="100%">
          </div>
        </div>

			</div>
    </div>
	</body>

	<script>
		var n = 0;
		var ongkir = 0;
		var qty = 0;
		var barang = [];

		$(".action").click(function(){
      var id = $(this).data('id');
			n = id;
			var num = n.toString();
			qty = $(this).data('qty');

			for (var i = 0; i < qty; i++) {
				barang[num+i] = 0;
			}

			//alert(barang['0'+1]);
      $('#'+id).toggle();

			ongkir = $('#ongkir'+id).data('value');
			$('#total'+id).val(ongkir);
      //$(id).hide();
		});

    $(".bukti_retur").click(function(){
      var foto = $(this).data('foto');
      $(".foto").attr("src","../asset/bukti_retur/"+foto);
      $(".bukti").show();
    });

		$("#close_modal").click(function(){
			$(".bukti").hide();
		});

		$(".cek_biaya").change(function(){
			var ongkir = $('#ongkir'+n).data('value');
			var total = ongkir;
			var nilai = $(this).data('id');
			var barang_lama = $("#barang_lama"+nilai).data('id');
			var barang_baru = $("#barang_pengganti"+nilai).val();
			var barang_pengganti = JSON.parse(barang_baru);
			var idbarang_pengganti = barang_pengganti.id_barang;
			//$("#biaya"+nilai).html(nilai);
			//$("#biaya"+nilai).html('barang lama : '+barang_lama+' barang pengganti : '+barang_pengganti);
			if (barang_lama == idbarang_pengganti) {
				$("#biaya"+nilai).val('0');
				barang[nilai] = 0;
				//total = ongkir + barang[nilai];
				//$('#total'+n).html(total);
				$("#keterangan"+nilai).html('');
			}else {
				var harga_barang_lama = $("#barang_lama"+nilai).data('harga');
				var harga_barang_pengganti = barang_pengganti.harga;
				var biaya_tambahan = harga_barang_lama - harga_barang_pengganti;

				if (biaya_tambahan < 0) {
					$("#biaya"+nilai).val((biaya_tambahan*-1));
					$("#keterangan"+nilai).html('barang lama : Rp.'+harga_barang_lama+'<br>barang pengganti : Rp.'+harga_barang_pengganti);

					barang[nilai] = (biaya_tambahan*-1);
					//alert(barang[nilai]);
					//total = ongkir + barang[nilai];
					//$('#total'+n).html(total);
				}else {
					barang[nilai] = 0;
					$("#biaya"+nilai).val('0');
					$("#keterangan"+nilai).html('');
					//$('#total'+n).html(ongkir);
					//$("#biaya"+nilai).html('Rp. '+(biaya_tambahan*-1)+'<br><br>barang lama : Rp.'+harga_barang_lama+'<br>barang pengganti : Rp.'+harga_barang_pengganti);
				}
				//$("#biaya"+nilai).html('barang lama : Rp.'+harga_barang_lama+'<br>barang pengganti : Rp.'+harga_barang_pengganti);
			}

			//untuk menjumlah total
			var num = n.toString();
			for (var i = 0; i < qty; i++) {
				total = total + barang[num+i];
			}

			$('#total'+n).val(total);
		});

		/*
		$(".cek_biaya").click(function(){

		var nilai = $(this).data('id');
		var barang_lama = $("#barang_lama"+nilai).data('id');
		var barang_pengganti = $("#barang_pengganti"+nilai).val();
		//$("#biaya"+nilai).html(nilai);
		$("#biaya"+nilai).html('barang lama : '+barang_lama+' barang pengganti : '+barang_pengganti);
		});
		*/

		$("#close").click(function(){
		//alert('berhasil');
			$("#mySidenav").hide();
		});

		$("#menu").click(function(){
		//alert('berhasil');
			$("#mySidenav").toggle();
		});

		$(".list").click(function(){
			var target = $(this).data("name");
			//alert($(this).data("name"));
			$("."+target).toggle();
		});
	</script>
</html>
