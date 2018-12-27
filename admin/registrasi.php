<?php
session_start();
include '../function/koneksi.php';

if(!isset($_SESSION['ID_KAR'])){
		$_SESSION['status'] = 'anda belum melakukan login';
		header('location:index.php');
}
?>

	<!-- Top navbar -->
	<?php include 'top-navbar.php'; ?>
	<body class="w3-light-grey">

	<!-- Sidenav/menu -->
	<?php include 'side-navbar.php'; ?>

	<div class="w3-main w3-container" style="margin-left:200px; padding-top:75px">
		<?php
		if(isset($_SESSION['statusRegis'])){
		?>
		<div class="w3-panel w3-card-4 w3-blue">
			<p>
			<span onclick="this.parentElement.style.display='none'" class="w3-closebtn w3-margin-right w3-medium">x</span>
			<?php echo $_SESSION['statusRegis']." ";
			unset($_SESSION['statusRegis']);
			?>

			<a href="list_konsumen.php">lihat daftar konsumen</a>
			</p>
		</div>
		<?php
		}
		?>

		<div class="w3-panel w3-card-2 w3-white" style="margin-top:20px;">
			<h3 class="w3-border-bottom w3-border-black w3-padding-12">FORM REGISTRASI KONSUMEN</h3>
			<p>Isi data form dengan benar demi kelancaran berbelanja.</p>

			<form method="post" action="insert_registrasi.php">
				<p>
					<label>Nama</label>
					<input class="w3-input w3-border w3-round" name="nama" type="text" style="height:28px">
				</p>

				<p>
					<label>Tanggal lahir</label>
					<input class="w3-input w3-border w3-round" name="tgl_lahir" type="date" style="height:28px">
				</p>

				<div class="w3-row">
					<p>Jenis kelamin</p>
					<div class="w3-half">
						<input class="w3-radio" type="radio" name="jk" value="0">
						<label class="w3-validate">Laki - laki</label>
					</div>
					<div class="w3-half">
						<input class="w3-radio" type="radio" name="jk" value="1">
						<label class="w3-validate">Perempuan</label>
					</div>
				</div>

				<p>
					<label>Kota tempat tinggal</label>
					<select id="kota" class="w3-input w3-border w3-round" name="kota" type="text" style="height:38px; width:100%">
						<?php
						$ambilKOTA = "select * from KOTA";

						$result = mysql_query($ambilKOTA);
						$nama = $row['NM_KOTA'];
						while($row = mysql_fetch_array($result)){?>
								<option value="<?php echo $row['ID_KOTA'];?>" required><?php echo $row['NM_KOTA'].', '.$row['TYPE_KOTA']; ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label>Alamat</label>
					<input class="w3-input w3-border w3-round" name="alamat" type="text" style="height:28px">
				</p>

				<p>
					<label>Telpon</label>
					<input class="w3-input w3-border w3-round" name="telpon" type="text" style="height:28px">
				</p>

				<p>
					<label>Email</label>
					<input class="w3-input w3-border w3-round" name="email" type="text" style="height:28px">
				</p>

				<p>
					<label>Nomor rekening anda (yang kedepannya akan anda gunakan bertransaksi)</label>
					<div class="w3-row">
						<div class="w3-container w3-col l3">
							<input class="w3-input w3-border w3-round" name="bank_kons" type="text" style="height:28px" placeholder="nama bank" required>
							<div style="font-size:10px">
								contoh : Mandiri, BCA, BRI, dll
							</div>
						</div>
						<div class="w3-col l9">
							<input class="w3-input w3-border w3-round" name="rekening_kons" type="text" style="height:28px" placeholder="nomor rekening" required>
						</div>
					</div>
				</p>

				<p>
					<label>Username</label>
					<input class="w3-input w3-border w3-round" name="username" type="text" style="height:28px">
				</p>

				<p>
					<label>Password</label>
					<input class="w3-input w3-border w3-round" name="password" type="text" style="height:28px">
				</p>

				<p>
					<button class="w3-btn w3-round-xlarge w3-green" type="submit">Simpan</button>
				</p>
			</form>
		</div>
	</div>
</body>

<script>
	$(document).ready(function(){
		$(".list").click(function(){
			var target = $(this).data("name");
			//alert($(this).data("name"));
			$("."+target).toggle();
		});

		$("#kota").select2({
			placeholder : "pilih kota"
		});

		$("#close").click(function(){
			//alert('berhasil');
			$("#mySidenav").hide();
		});

		$("#menu").click(function(){
			//alert('berhasil');
			$("#mySidenav").toggle();
		});
	});
</script>
