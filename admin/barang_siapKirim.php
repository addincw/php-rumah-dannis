<?php
session_start();
include '../function/pengiriman_pembayaran.php';
include '../function/penjualan.php';
include '../function/konsumen.php';
include '../function/retur.php';
?>
    <?php
    include 'top-navbar.php';
    include 'side-navbar.php';
    ?>
		<body class="w3-light-grey">

    <div class="w3-main w3-container" style="padding-top:75px; margin-left:200px;">
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
      <div class="w3-container w3-card-2 w3-white" style="margin-top:15px">
        <h3 class="w3-border-bottom w3-border-black w3-padding-12">LIST PEMBELIAN SIAP KIRIM</h3>
				<div class="w3-responsive">
					<table class="w3-table-all w3-card-2" style="margin-bottom:20px">
						<tr class="w3-green">
							<th>Tanggal pembayaran</th>
							<th>nomor pembelian</th>
							<th>jasa pengiriman yang dipilih</th>
							<th>Penerima</th>
							<th>alamat pengiriman</th>
							<th>kontrol</th>
						</tr>

						<?php
						$query = get_pembayaranby_status(2,1);
						while($pembayaran = mysql_fetch_array($query)){
							$pengiriman = get_pengirimanby_idbayar($pembayaran['ID_PEMBAYARAN']);
							$penjualan = get_penjualanby_id($pembayaran['ID_JUAL']);
							$konsumen = read_Konsumenby_id($penjualan['ID_KONS']);

							if ($pengiriman['STATUS_PENGIRIMAN'] == 0) {
								?>

								<tr>
									<td><?php echo $pembayaran['TGL_PEMBAYARAN'];?></td>
									<td>
										<?php
										$penjualan = get_penjualanby_id($pembayaran['ID_JUAL']);
										switch ($penjualan['STATUS']) {
											case 0:
											?>
											<a href="nota.php?id_jual=<?php echo $pembayaran['ID_JUAL'];?>"><?php echo $pembayaran['ID_JUAL'];?></a>
											<p>transaksi penjualan</p>
											<?php
											break;
											case 1:
											$query_retur = get_detail_returbyIdjual($pembayaran['ID_JUAL']);
											$retur = mysql_fetch_array($query_retur);
											?>
											<a href="nota_retur.php?id_retur=<?php echo $retur['ID_RETUR'];?>"><?php echo $pembayaran['ID_JUAL'];?></a>
											<p>transaksi retur</p>
											<?php
											break;
											case 2:
											?>
											<a href="nota.php?id_jual=<?php echo $pembayaran['ID_JUAL'];?>"><?php echo $pembayaran['ID_JUAL'];?></a>
											<p>transaksi pre-order</p>
											<?php
											break;
										}
										?>
									</td>
									<td><?php echo $pengiriman['JASA_KIRIM'];?></td>
									<td>
										<?php echo $konsumen['NM_KONS'];?></br>
										<?php echo "Telp: ".$konsumen['TELP_KONS'];?></br>
										<?php echo "Email: ".$konsumen['EMAIL_KONS'];?>
									</td>
									<td><?php echo $pengiriman['ALAMAT_KIRIM'];?></td>
									<td>
										<button id="action" data-action="1" data-id="<?php echo $pengiriman['ID_KIRIM'];?>" class="action w3-btn w3-btn-small w3-green" type="button" style="margin-bottom:10px">proses</button>
									</td>
								</tr>
								<?php
							}
						}
						?>
					</table>
				</div>

				<div id="konfirmasi_action" class="w3-modal">

					<div class="w3-modal-content w3-animate-zoom" style="width:30%">
						<header class="w3-container w3-red">
							<span class="close_modal w3-btn w3-display-topright">&times;</span>
							<div style="margin-top:6px; margin-bottom:6px">konfirmasi tindakan</div>
						</header>
						<p class="w3-container w3-center" id="ask"></p>
						<p class="w3-center">
							<a class="proses" href=""><button type="button" name="action" class="w3-btn w3-btn-small w3-blue" style="margin-bottom:10px">Ya</button></a>
							<button type="button" name="action" class="close_modal w3-btn w3-btn-small w3-red" style="margin-bottom:10px">tidak</button>
						</p>
					</div>
				</div>

			</div>
    </div>
	</body>

	<script>
		$(".action").click(function(){
			$("#konfirmasi_action").show();
			var action = $(this).data('action');
			var id_kirim = $(this).data('id');

      $("#ask").html("yakin untuk memproses transaksi?");
      $(".proses").attr("href","update_pengiriman.php?action="+action+"&id_kirim="+id_kirim);

		});

		$(".close_modal").click(function(){
			$("#konfirmasi_action").hide();
		});

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
