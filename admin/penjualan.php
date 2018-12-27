<?php
session_start();
include '../function/konsumen.php';
include '../function/penjualan.php';
include '../function/barang.php';

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
			<?php if (isset($_SESSION['status_insert'])) { ?>
							<div class="w3-panel w3-blue">
								<p>
									<span onclick="this.parentElement.style.display='none'" class="w3-closebtn w3-margin-right w3-medium">x</span>
									<?php
										echo $_SESSION['status_insert'];
										unset($_SESSION['status_insert']);
									?>
								</p>
							</div>
			<?php } ?>
			<div class="w3-panel w3-card-2 w3-white" style="margin-top:20px;">
				<h3 class="w3-border-bottom w3-border-black w3-padding-12">FORM PENJUALAN</h3>
				<p>
					Isi data form dengan benar demi kelancaran berbelanja.
					<span class="w3-right">
						<label>Tanggal:</label>
						<?php echo date('Y-m-d');?>
					</span>
				</p>

				<form action="keranjang.php" method="post" target="keranjang_belanja">
					<div class="w3-row">
						<div class="w3-col m6">
							<p>
								<label>Nama konsumen :</label>
								<select id="namakonsumen" class="w3-input w3-border w3-round" style="height:38px; width:100%" name="id_kons">
									<option value="">pilih konsumen</option>
									<?php
									$namakonsumen = read_allKonsumen();
									while($row = mysql_fetch_array($namakonsumen)){?>
									<option value="<?php echo $row['ID_KONS'];?>" required><?php echo $row['ID_KONS'].' - '.$row['NM_KONS']?></option>
									<?php } ?>
								</select>
							</p>
						</div>

						<div class="w3-col m6 w3-right-align" style="padding-top:25px">
							<p>nama konsumen tidak ada? <a href="registrasi.php"><button class="w3-btn w3-round-xlarge w3-blue" type="button">daftarkan</button></a></p>
						</div>
					</div>

					<p>
						<label>Id Jual :</label>
							<input type="text" class="w3-input w3-border w3-round" style="height:28px; width:100%" name="id_jual" value="<?php echo $idjual; ?>" readonly>
					</p>

					<p>
						<label>Pilih barang :</label>
						<select name="id_barang" id="barang" class="w3-input w3-border w3-round" style="height:38px; width:100%">
								<option>default</option>
								<?php
								$query_barang = read_barang();
								while($row = mysql_fetch_array($query_barang)){
								?>
							      <option value="<?php echo $row['ID_BARANG'];?>" required><?php echo $row['NM_BARANG'].' - '.$row['WARNA'].' - '.$row['UKURAN'];?></option>
								<?php } ?>
					  </select>
					</p>

					<p>
						<label>harga :</label>
							<input id="harga" type="text" class="w3-input w3-border w3-round" style="height:28px" name="harga" readonly>
					</p>

					<p>
						<label>Jumlah :</label>
						<input type="text" class="w3-input w3-border w3-round" style="height:28px" name="jumlah" placeholder="Masukkan jumlah barang" required>
						<span id="keterangan" class="w3-text-red" style="font-size:12px"></span><span id="pre_order" class="w3-right w3-text-blue" style="display:none"><a href="pre_order.php">order</a></span>
					</p>

					<p class="w3-center">
						<button id="tambah" class="w3-btn w3-btn-round w3-green" name="pesan" type="submit"><li class="fa fa-plus"></li> Tambah</button>
						<!--
						<button id="pre_order" class="w3-btn w3-btn-round" name="pesan" type="submit" style="display:none"><li class="fa fa-plus"></li> Pre - order</button>
						-->
					</p>
				</form>
			</div>

				<h3><strong><i class="fa fa-shopping-basket" aria-hidden="true"></i> KERANJANG BELANJAAN</strong></h3>
					<iframe name="keranjang_belanja" height="200px" width="100%" frameborder="0px" src="keranjang.php">
					</iframe>
					<a href="insert_penjualan.php" style="padding-bottom:20px">
					<button class="w3-btn w3-round-xlarge" name="simpan"><i class="fa fa-shopping-cart" aria-hidden="true"></i> proses</button>
					</a>
		</div>
	</body>
	<script>
/*
function cekharga(){
var http = new XMLHttpRequest();
var konsumen = document.getElementById('kons').value;
var brg = document.getElementById('barang').value;

http.onreadystatechange = function(){
if(http.readyState == 4 && http.status == 200){
document.getElementById("harga").value = http.responseText;
console.log(http.responseText);
}
}

http.open("GET", "cekharga.php?kons="+konsumen+"&barang="+brg, true);
http.send();
}

function disable_konsumen(){
document.getElementById("kons").disabled = true;
}
*/
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

	$("#barang").change(function(){
		var barang = $(this).val();
		$.post("cekharga.php",
		{
			id_barang : barang
		},
		function(data,status){
			var detail_barang = JSON.parse(data);
			$("#harga").val(detail_barang.harga);
			$("#keterangan").html("stok yang tersedia : "+detail_barang.stok+" barang");
			if (detail_barang.stok <= 0) {
				$("#pre_order").show(100);
				$("#tambah").prop("disabled", true);
			}else {
				$("#pre_order").hide(100);
				$("#tambah").removeAttr("disabled")
			}
			//alert(detail_barang.harga);
		});
	});

	$("#barang").select2({
		placeholder : "pilih barang"
	});

	$("#namakonsumen").select2({
		placeholder : "pilih konsumen"
	});

});
	</script>
</html>
