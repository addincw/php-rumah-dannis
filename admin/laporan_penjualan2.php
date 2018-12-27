<?php
session_start();
include '../function/konsumen.php';
include '../function/penjualan.php';
include '../function/barang.php';
include '../function/kategori.php';

$idjual = createid_jual(0);
?>

		<!-- Top navbar -->
		<?php
		include 'top-navbar.php';
		if(!isset($_SESSION['ID_KAR'])){
				$_SESSION['status'] = 'anda belum melakukan login';
				header('location:index.php');
			}
		?>
		<body class="w3-light-grey">

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
          <?php
          if(isset($_POST['tglawal'])&&isset($_POST['tglakhir'])){
            $tglawal=$_POST['tglawal'].' 00:00:00';
            $tglakhir=$_POST['tglakhir'].' 00:00:00';

            $_SESSION['tglawal']=$tglawal;
            $_SESSION['tglakhir']=$tglakhir;

            $sql_penjualanby_jenisJual=get_penjualanby_jenisJual($tglawal, $tglakhir);
            $sql_barang_terlaris=get_barang_terlaris($tglawal, $tglakhir);
						$sql_kategori_terlaris=get_kategori_terlaris($tglawal, $tglakhir);
						$sql_kota_terlaris=get_kota_terlaris($tglawal, $tglakhir);
					}

          else{
            $sql_penjualanby_jenisJual=get_penjualanby_jenisJual();
						$sql_barang_terlaris=get_barang_terlaris();
						$sql_kategori_terlaris=get_kategori_terlaris();
						$sql_kota_terlaris=get_kota_terlaris();
          }

          $subtotal=0;

          if(isset($_SESSION['tglawal'])&&isset($_SESSION['tglakhir'])){
          $tgl_laporan="Tanggal ".substr($_SESSION['tglawal'], 0,10).' sampai dengan '.substr($_SESSION['tglakhir'],0,10);
          }

          else{
          $tgl_laporan='keseluruhan';
          }
          ?>
          <h6>Periode laporan : <?php echo $tgl_laporan; ?></h6>
          <hr>
					<h5>Penjualan berdasarkan kota (3 teratas) :</h5>
          <div class="w3-responsive">
            <table class="w3-table-all" style="margin-bottom:15px">
              <tr class="w3-green">
                <th>kota</th>
                <th>banyaknya terjual</th>
              </tr>
              <?php
              while($row=mysql_fetch_array($sql_kota_terlaris)){
                $kota = read_Kotaby_id($row['ID_KOTA']);
              ?>
                <tr>
                  <td><?php echo $kota['NM_KOTA']; ?></td>
                  <td><?php echo $row['JUMLAH_PENJUALAN']; ?></td>
                </tr>
                <?php
              }
              ?>
            </table>
          </div>

          <h5>Penjualan berdasarkan jenis penjualan :</h5>
					<div class="w3-responsive">
						<table class="w3-table-all" style="margin-bottom:15px">
							<tr class="w3-green">
								<th>jenis penjualan</th>
								<th>banyak penjualan</th>
                <th>total penjualan</th>
							</tr>
							<?php
							while($row=mysql_fetch_array($sql_penjualanby_jenisJual)){
							?>
								<tr>
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
									<td><?php echo $row['JUMLAH_TRANSAKSI'].' x'; ?></td>
                  <td><?php echo 'Rp. '.number_format($row['TOTAL_TRANSAKSI'],2,',','.'); ?></td>
								</tr>
								<?php
								$subtotal=$subtotal+$row['TOTAL_TRANSAKSI'];
							}
							?>
							<tr>
								<td colspan="2" align="center"><b>Total seluruh penjualan</b></td>
								<td colspan="2" ><?php echo 'Rp. '.number_format($subtotal,2,',','.'); ?></td>
							</tr>
						</table>
					</div>

          <h5>Penjualan berdasarkan kategori terlaris (3 teratas) :</h5>
          <div class="w3-responsive">
            <table class="w3-table-all" style="margin-bottom:15px">
              <tr class="w3-green">
                <th>kategori</th>
                <th>banyaknya terjual</th>
              </tr>
              <?php
              while($row=mysql_fetch_array($sql_kategori_terlaris)){
                $kategori = read_kategori_byId($row['ID_KATEGORI']);
              ?>
                <tr>
                  <td><?php echo $kategori['NAMA_KATEGORI']; ?></td>
                  <td><?php echo $row['BANYAK_TERJUAL']; ?></td>
                </tr>
                <?php
              }
              ?>
            </table>
          </div>

					<h5>Penjualan berdasarkan barang terlaris (3 teratas) :</h5>
					<div class="w3-responsive">
						<table class="w3-table-all" style="margin-bottom:15px">
							<tr class="w3-green">
								<th>barang</th>
								<th>kategori</th>
								<th>banyaknya terjual</th>
							</tr>
							<?php
							while($row=mysql_fetch_array($sql_barang_terlaris)){
								$barang = read_barang_byId($row['ID_BARANG']);
								$kategori = read_kategori_byId($row['ID_KATEGORI']);
							?>
								<tr>
									<td><?php echo $barang['NM_BARANG'].'-'.$barang['UKURAN'].'-'.$barang['WARNA'];?></td>
									<td><?php echo $kategori['NAMA_KATEGORI']; ?></td>
									<td><?php echo $row['BANYAK_TERJUAL']; ?></td>
								</tr>
								<?php
							}
							?>
						</table>
					</div>

          <div align="center" style="margin-bottom:15px">
            <a href="laporan_penjualan2_pdf.php" target="_blank">
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
