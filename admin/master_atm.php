<?php
session_start();
include '../function/ATM.php';
$idatm = createid_atm();
?>
<!DOCTYPE html>
<html>
	<title>master ATM</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../w3.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

	<body class="w3-light-grey">
		<!-- Top navbar -->
		<div class="w3-container w3-top w3-medium w3-padding" style="z-index:4; background-color: #CF443A; color: white;">
		  <button class="w3-btn w3-hide-large w3-padding-0 w3-hover-text-grey" onclick="w3_open();"><i class="fa fa-bars"></i> �Menu</button>
		  <span class="w3-left"><strong>RUMAH DANNIS SURABAYA</strong></span>
		  <span class="w3-right">Logout</span>
		</div>

		<!-- Sidenav/menu -->
		<nav class="w3-sidenav w3-collapse w3-red" style="z-index:3;width:200px;" id="mySidenav"><br>
		  <div class="w3-container w3-row">
			<div class="w3-col s8" style="padding-top:40px">
			  <span>Welcome, <strong>Mike</strong></span><br>
			</div>
		  </div>
		  <hr>
		  <a href="#" class="w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>� Close Menu</a>
		  <a href="#" class="w3-padding w3-orange w3-text-white"><i class="fa fa-shopping-cart"></i> Penjualan</a>
		  <a href="#" class="w3-padding"><i class="fa fa-eye fa-fw"></i> Views</a>
		  <a href="#" class="w3-padding"><i class="fa fa-users fa-fw"></i> konsumen</a>
		  <a href="#" class="w3-padding"><i class="fa fa-bullseye fa-fw"></i> Geo</a>
		  <a href="#" class="w3-padding"><i class="fa fa-diamond fa-fw"></i> Orders</a>
		  <a href="#" class="w3-padding"><i class="fa fa-bell fa-fw"></i> News</a>
		  <a href="#" class="w3-padding"><i class="fa fa-bank fa-fw"></i> General</a>
		  <a href="#" class="w3-padding"><i class="fa fa-history fa-fw"></i> History</a>
		  <a href="#" class="w3-padding"><i class="fa fa-cog fa-fw"></i> Settings</a><br><br>
		</nav>

		<div class="w3-main w3-container" style="margin-left:200px; padding-top:35px">
			<?php
      if(isset($_SESSION['status'])){
      ?>
      <div class="w3-panel w3-card-4 w3-blue">
        <p>
        <span onclick="this.parentElement.style.display='none'" class="w3-closebtn w3-margin-right w3-medium">x</span>
        <?php echo $_SESSION['status']." ";
        unset($_SESSION['status']);
        ?>
        </p>
      </div>
      <?php
      }
      ?>

			<div class="w3-panel w3-card-2 w3-white">
				<h2><strong>MASTER ATM</strong></h2>
				<p>masukkan data ATM untuk transaksi penjualan, apabila terdapat ATM baru yang dimiliki.</p>
			</div>
			<div class="w3-panel w3-card-2 w3-white" style="margin-top:20px;">
				  <p class="w3-right-align">
				    <label>Tanggal:</label>
				    <?php echo date('Y-m-d');?>
				  </p>

				<form action="insert_ATM.php" method="post">
					<div class="w3-row">

					<p>
						<label>Id ATM :</label>
						<input type="text" class="w3-input w3-border w3-round" style="height:28px" name="id_atm" value="<?php echo $idatm; ?>" readonly>
					</p>

					<p>
						<label>nama ATM :</label>
						<input type="text" class="w3-input w3-border w3-round" style="height:28px" name="nama_atm">
					</p>

					<p>
						<label>No Rekening :</label>
							<input type="text" class="w3-input w3-border w3-round" style="height:28px" name="no_rekening" placeholder="Masukkan no rekening" required>
					</p>

					<p>
						<button class="w3-btn w3-btn-floating w3-green" name="simpan" type="submit">+</button>
					</p>
				</form>
			</div>

				<h3><strong><i class="fa fa-shopping-basket" aria-hidden="true"></i> LIST ATM</strong></h3>
					<iframe name="daftar_ATM" height="200px" width="100%" frameborder="0px" src="list_ATM.php">
					</iframe>

		</div>
	</body>
</html>
