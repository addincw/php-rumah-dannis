<?php
session_start();
include "function/pengiriman_pembayaran.php";
?>

<!DOCTYPE html>
<html>
<title>Registrasi Konsumen</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="select2/dist/css/select2.min.css">
<script src="jquery-3.1.1.min.js"></script>
<script src="select2/dist/js/select2.min.js"></script>
<body class="w3-light-grey">
	<!-- Top navbar -->
	<div class="w3-top">
	  <ul class="w3-navbar w3-red w3-wide w3-padding-8 w3-card-2">
	    <li>
				<div class="w3-margin-left"><img src="asset/logo_rumahdannis.png" alt=""></div>
	    </li>
	    <!-- Float links to the right. Hide them on small screens -->
	    <li class="w3-right w3-hide-small" style="margin-top:13px">
	      <a href="website/index.php" class="w3-left"><i class="fa fa-home"></i> Home</a>
	    </li>
	  </ul>
	</div>

	<div class="w3-main w3-container" style="margin-top:78px; margin-left:180px; margin-right:180px;">
    <?php
    if(isset($_SESSION['statusRegis'])){
    ?>
    <div class="w3-panel w3-card-4 w3-blue">
      <p>
			<span onclick="this.parentElement.style.display='none'" class="w3-closebtn w3-margin-right w3-medium">x</span>
      <?php echo $_SESSION['statusRegis'];
    	unset($_SESSION['statusRegis']);
      ?>
    </p>
    </div>
    <?php
    }
    ?>

		<div class="w3-panel w3-card-4 w3-white">
			<h2><strong>REGISTRASI</strong></h2>
			<p>
        Isi data form dengan benar demi kelancaran berbelanja.
        Gunakan Username dan Password anda untuk login.
      </p>
		</div>

		<div class="w3-panel w3-card-4 w3-white">
			<form method="post" action="insert_registrasi.php">
				<p>
					<label>Nama</label>
					<input class="w3-input w3-border w3-round" name="nama" type="text" style="height:28px" required>
				</p>

				<p>
					<label>Tanggal lahir</label>
					<input class="w3-input w3-border w3-round" name="tgl_lahir" type="date" style="height:28px" required>
				</p>

				<div class="w3-row">
					<p>Jenis kelamin</p>
					<div class="w3-half">
						<input class="w3-radio" type="radio" name="jk" value="0" checked>
						<label class="w3-validate">Laki - laki</label>
					</div>
					<div class="w3-half">
						<input class="w3-radio" type="radio" name="jk" value="1">
						<label class="w3-validate">Perempuan</label>
					</div>
				</div>

				<p>
          <label>Alamat lengkap</label>
          <input id="alamat" class="w3-input w3-border w3-round" name="alamat" type="textarea" required>
        </p>

        <p>
          <label>Pilih provinsi tempat tinggal</label>
          <select id="provinsi" class="js-example-basic-single w3-input w3-border w3-round" name="kota" type="text" style="width:100%">
            <option value="">-- pilih provinsi --</option>
            <?php
            $prov = get_provinsi();
              while($provinsi = mysql_fetch_array($prov)){
            ?>
              <option value="<?php echo $provinsi['ID_PROVINSI']; ?>"><?php echo $provinsi['NAMA_PROVINSI']; ?></option>
            <?php
              }
            ?>
          </select>
        </p>

        <p>
          <label>Pilih kota tempat tinggal</label>
          <select id="kota" class="w3-input w3-border w3-round" name="kota" type="text" style="width:100%" disabled>
          </select>
        </p>

				<p>
					<label>Telpon</label>
					<input class="w3-input w3-border w3-round" name="telpon" type="text" style="height:28px" required>
				</p>

				<p>
					<label>Email</label>
					<input class="w3-input w3-border w3-round" name="email" type="text" style="height:28px" required>
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
					<input class="w3-input w3-border w3-round" name="username" type="text" style="height:28px" required>
				</p>

				<p>
					<label>Password</label>
					<input class="w3-input w3-border w3-round" name="password" type="password" style="height:28px" required>
				</p>

				<p>
					<button class="w3-btn w3-round-xlarge w3-green" type="submit">Simpan</button>
				</p>
			</form>
		</div>
	</div>
</body>

<script>
//fungsine sm kyk yg ada di pengiriman
$(document).ready(function(){
	$( "#provinsi" ).change(function() {
		$("#kota").removeAttr("disabled");
		var id = $("#provinsi").val();
		$.post("website/cari_kota.php",
		{
			id_provinsi : id
		},
		function(data,status){
			$('#kota').html(data);
		});
	});

	$(".js-example-basic-single").select2({
		placeholder : "pilih provinsi"
	});
	$("#kota").select2({
		placeholder : "pilih kota"
	});
})
</script>
