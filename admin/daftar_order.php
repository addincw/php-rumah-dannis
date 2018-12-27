<?php
session_start();
include '../function/konsumen.php';
include '../function/pre_order.php';
include '../function/barang.php';
?>

    <?php
    include 'top-navbar.php';
    include 'side-navbar.php';
    ?>
		<body class="w3-light-grey">

    <div class="w3-main w3-container" style="padding-top:75px; margin-left:200px;">
      <div class="w3-container w3-card-2 w3-white" style="margin-top:15px">
        <h3 class="w3-border-bottom w3-border-black w3-padding-12">LIST ORDER BARANG</h3>
				<div class="w3-responsive">
					<table class="w3-table-all w3-card-2" style="margin-bottom:20px">
						<tr class="w3-green">
							<th>Tanggal order</th>
							<th>nomor order</th>
							<th>jummlah item</th>
							<th>total</th>
							<th>status order</th>
							<th>pemesan</th>
							<th>konfirmasi order</th>
						</tr>

						<?php
						$query = get_Allpesan();
						while($order = mysql_fetch_array($query)){
							$detail_order = get_detailpesanby_id($order['ID_PSN']);
							$konsumen = read_Konsumenby_id($order['ID_KONS']);

							if (is_null($order['KONFIRMASI_PSN'])) {
								?>
								<tr>
									<td><?php echo $order['TGL_PSN'];?></td>
									<td><?php	echo $order['ID_PSN'];?></td>
									<td><?php echo mysql_num_rows($detail_order); ?></td>
									<td><?php echo "Rp. ".number_format($order['TOTAL'],2,'.',','); ?></td>
									<td>
										<?php
										if (is_null($order['STATUS_PSN'])) {
											echo 'barang belum tersedia';
										}else {
											echo 'barang tersedia';
										};
										?>
									</td>
									<td>
										<?php echo $konsumen['NM_KONS'];?></br>
										<?php echo "Telp: ".$konsumen['TELP_KONS'];?></br>
										<?php echo "Email: ".$konsumen['EMAIL_KONS'];?>
									</td>
									<td>
										<?php
                    //jenis pesan 0=offline, 1=online
                    /* kalau offline konfirmasi dilakukan oleh admin */
                    /* kalau online, tugas admin hanya perlu mengingatkan konsumen untuk melakukan konfirmasi pembelian */
										if ($order['JENIS_PSN'] == 0) {
											if (is_null($order['STATUS_PSN'])) {
												?>
												<button id="action" data-id="<?php echo $order['ID_PSN'];?>" class="action w3-btn w3-btn-small w3-green" type="button" style="margin-bottom:10px" disabled>konfirmasi pembelian</button>
												<?php
											}else {
												?>
												<button id="action" data-id="<?php echo $order['ID_PSN'];?>" class="action w3-btn w3-btn-small w3-green" type="button" style="margin-bottom:10px">konfirmasi pembelian</button>
												<?php
											}
										}else {
											echo 'pembeli belum melakukan konfirmasi';
										};
										?>
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
			var id_psn = $(this).data('id');

      $("#ask").html("yakin untuk memproses transaksi?");
      $(".proses").attr("href","update_order.php?id_psn="+id_psn);

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
