<?php
session_start();
include '../function/penjualan.php';
include '../function/pengiriman_pembayaran.php';
include '../function/retur.php';
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
      <div class="w3-container w3-card-2 w3-white" style="margin-top:15px">
				<h3 class="w3-border-bottom w3-border-black w3-padding-12">LIST PEMBAYARAN MENUNGGU KONFIRMASI</h3>
				<div class="w3-responsive">
					<table class="w3-table-all w3-card-2" style="margin-bottom:20px">
						<tr class="w3-green">
							<th>Tanggal pembayaran</th>
							<th>Deadline pembayaran</th>
							<th>nomor pembelian</th>
							<th>Total yang harus dibayar</th>
							<th>bukti pembayaran</th>
							<th>kontrol</th>
						</tr>

						<?php
						$id = 0;
						$query = get_pembayaranby_status(1);
						while($pembayaran = mysql_fetch_array($query)){
							?>
							<tr>
								<td><?php echo $pembayaran['TGL_PEMBAYARAN'];?></td>
								<td><?php echo $pembayaran['DEADLINE_PEMBAYARAN'];?></td>
								<!--cek jika id jual adalah retur, yang di tampilkan rincian retur-->
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
								<td><?php echo "Rp. ".number_format($pembayaran['TOTAL_PEMBAYARAN'], 2, ",", ".");?></td>
								<td>
									<img id="bukti_bayar" onclick="document.getElementById('<?php echo "bukti".$id;?>').style.display='block'" src="../asset/bukti_bayar/<?php echo $pembayaran['BUKTI_PEMBAYARAN'];?>.jpg" alt="" style="width:80px; height:80px"></td>
									<td>
										<button id="action" data-action="2" data-id="<?php echo $pembayaran['ID_PEMBAYARAN'];?>" class="action w3-btn w3-btn-small w3-green" type="button" style="margin-bottom:10px">terima</button>
										<button id="action" data-action="3" data-id="<?php echo $pembayaran['ID_PEMBAYARAN'];?>" class="action w3-btn w3-btn-small w3-orange" type="button">tolak</button>
									</td>

									<div id="bukti<?php echo $id;?>" class="w3-modal">
										<div class="w3-modal-content w3-animate-zoom" style="width:40%; height:70%">
											<span id="close_modal" onclick="document.getElementById('<?php echo "bukti".$id;?>').style.display='none'" class="w3-btn w3-display-topright">&times;</span>
											<img src="../asset/bukti_bayar/<?php echo $pembayaran['BUKTI_PEMBAYARAN'];?>.jpg" alt="" width="100%" height="100%">
										</div>
									</div>

									<?php
									$id++;
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
							<a class="update" href=""><button type="button" name="action" class="w3-btn w3-btn-small w3-blue" style="margin-bottom:10px">Ya</button></a>
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
			var id_bayar = $(this).data('id');
			if (action == 2) {
				alert(id_bayar);
				$("#ask").html("yakin untuk menerima pembayaran?");
				$(".update").attr("href","update_pembayaran.php?action="+action+"&id_bayar="+id_bayar);
			}else {
				$("#ask").html("yakin untuk menolak pembayaran?");
				$(".update").attr("href","update_pembayaran.php?action="+action+"&id_bayar="+id_bayar);
			}
			//alert(action);
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
