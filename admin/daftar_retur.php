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

  		<div class="w3-main w3-container" style="margin-left:200px; padding-top:35px">
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
      <div class="w3-container w3-card w3-white" style="margin-top:60px">
        <h3 class="w3-border-bottom w3-border-black w3-padding-12">DAFTAR RETUR</h3>
				<div class="w3-responsive">
					<table class="w3-table-all w3-card-2" style="margin-bottom:20px">
						<tr class="w3-green">
							<th>Tanggal persetujuan retur</th>
							<th>deadline retur</th>
							<th>nomor pembelian</th>
							<th>pembeli</th>
							<th>jumlah item retur</th>
							<th>kontrol</th>
						</tr>

						<?php
						$id=0;
						$query = get_returbyStatus(1);
						while($retur = mysql_fetch_array($query)){
							$query_detail_retur = get_detail_returbyId($retur['ID_RETUR']);
							$detail_retur = mysql_fetch_array($query_detail_retur);

							$pembayaran = get_pembayaranby_Idjual($detail_retur['ID_JUAL']);
							//$pengiriman = get_pengirimanby_idbayar($pembayaran['ID_PEMBAYARAN']);

							$penjualan = get_penjualanby_id($pembayaran['ID_JUAL']);
							$konsumen = read_Konsumenby_id($penjualan['ID_KONS']);
							?>
							<tr>
								<td><?php echo $retur['TGL_PERSETUJUAN_RETUR'];?></td>
								<td><?php echo $retur['DEADLINE_RETUR'];?></td>
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
									<?php
									$query_total_item = get_detail_returbyIdStatus($retur['ID_RETUR'], 1);
									echo $jumlah_item = mysql_num_rows($query_total_item);
									?>
								</td>
								<td>
									<button class="w3-btn w3-btn-small w3-red" type="button">
										<a href="retur_barangPengganti.php?id_retur=<?php echo $retur['ID_RETUR']; ?>">proses</a>
									</button>
								</td>
							</tr>

							<?php
						}
						?>
					</table>
				</div>

			</div>
    </div>
	</body>
	<script>
		$(document).ready(function(){
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
		})
	</script>
</html>
