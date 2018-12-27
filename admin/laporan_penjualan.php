<?php
session_start();
include '../function/konsumen.php';
include '../function/penjualan.php';
include '../function/barang.php';

$idjual = createid_jual(0);
?>
<!DOCTYPE html>
<html>
	<title>Laporan penjualan</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../w3.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
	<script src="../jquery-3.1.1.min.js"></script>
	<body class="w3-light-grey">
		<!-- Top navbar -->
		<?php
		include 'top-navbar.php';
		if(!isset($_SESSION['ID_KAR'])){
				$_SESSION['status'] = 'anda belum melakukan login';
				header('location:index.php');
			}
		?>

		<!-- Sidenav/menu -->
		<?php include 'side-navbar.php'; ?>
		<div class="w3-main w3-container" style="margin-left:200px; padding-top:75px">
			<div class="w3-panel w3-card-2 w3-white" style="margin-top:20px;">
				<h3 class="w3-border-bottom w3-border-black w3-padding-12">LAPORAN PENJUALAN</h3>
				<p>
					Pilih jangka waktu laporan yang ingin di tampilkan.
					<span class="w3-right">
						<label>Tanggal:</label>
						<?php echo date('Y-m-d');?>
					</span>
				</p>

        <div class="w3-card w3-border w3-row w3-container w3-padding-12" style="margin-bottom:15px">
          <form action="" method="post">
            <div class="w3-col l4">
              <div class="w3-row">
                <div class="w3-col l4 m4">
                  <label for="nama"><b>Mulai tanggal : </b></label>
                </div>
                <div class="w3-col l8 m8 w3-container">
                  <input name="tglawal" type="date" class="w3-input w3-border w3-round" required>
                </div>
              </div>
            </div>
            <div class="w3-col l4">
              <div class="w3-row">
                <div class="w3-col l4 m4">
                  <label for="nama"><b>Sampai tanggal : </b></label>
                </div>
                <div class="w3-col l8 m8 w3-container">
                  <input name="tglakhir" type="date" class="w3-input w3-border w3-round" required>
                </div>
              </div>
            </div>
            <div class="w3-col l4">
              <p class="w3-right" style="margin-top:0px; margin-bottom:0px">
                <button type="submit" class="w3-btn w3-large w3-round w3-red">Tampilkan</button>
              </p>
            </div>
          </form>
          </div>
					<div class="w3-responsive">
						<table class="w3-table-all" style="margin-bottom:15px">
							<tr class="w3-green">
								<th>nomor pembelian</th>
								<th>jenis pembelian</th>
								<th>total</th>
								<th>tanggal pembelian</th>
							</tr>
							<?php
							if(isset($_POST['tglawal'])&&isset($_POST['tglakhir'])){
								$tglawal=$_POST['tglawal'].' 00:00:00';
								$tglakhir=$_POST['tglakhir'].' 00:00:00';

								$_SESSION['tglawal']=$tglawal;
								$_SESSION['tglakhir']=$tglakhir;

								$sql=get_penjualanby_date($tglawal, $tglakhir);
							}

							else{
								$sql=get_Allpenjualan();
							}

							$subtotal=0;
							while($row=mysql_fetch_array($sql)){
								?>
								<tr>
									<td><a href="nota.php?id_jual=<?php echo $row['ID_JUAL']; ?>"><?php echo $row['ID_JUAL']; ?></a></td>
									<td>
										<?php
										switch ($row['JENIS_JUAL']) {
											case '0':
											echo 'OFFLINE';
											break;
											case '1':
											echo 'ONLINE';
											break;
										}
										?>
									</td>
									<td><?php echo 'Rp. '.number_format($row['TOTAL'],2,',','.'); ?></td>
									<td><?php echo $row['TGL_PESAN']; ?></td>
								</tr>
								<?php
								$subtotal=$subtotal+$row['TOTAL'];
							}
							?>
							<tr>
								<td colspan="2" align="center"><b>Total penjualan</b></td>
								<td colspan="2" ><?php echo 'Rp. '.number_format($subtotal,2,',','.'); ?></td>
							</tr>
						</table>
					</div>
          <div align="center" style="margin-bottom:15px">
            <a href="laporan_penjualan_pdf.php" target="_blank">
              <button class="w3-btn w3-blue">
                <span class="fa fa-print"></span>
                cetak
              </button>
            </a>
          </div>
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
	});
	</script>
</html>
