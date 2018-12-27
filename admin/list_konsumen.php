<?php
include '../function/konsumen.php';
?>
<!DOCTYPE html>
<html>
	<title>Daftar konsumen Rumah Dannis Surabaya</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../w3.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
	<script>
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

	</script>
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
		  <a href="#" class="w3-padding w3-orange w3-text-white"><i class="fa fa-users fa-fw"></i> Overview</a>
		  <a href="#" class="w3-padding"><i class="fa fa-eye fa-fw"></i> Views</a>
		  <a href="#" class="w3-padding"><i class="fa fa-users fa-fw"></i> Traffic</a>
		  <a href="#" class="w3-padding"><i class="fa fa-bullseye fa-fw"></i> Geo</a>
		  <a href="#" class="w3-padding"><i class="fa fa-diamond fa-fw"></i> Orders</a>
		  <a href="#" class="w3-padding"><i class="fa fa-bell fa-fw"></i> News</a>
		  <a href="#" class="w3-padding"><i class="fa fa-bank fa-fw"></i> General</a>
		  <a href="#" class="w3-padding"><i class="fa fa-history fa-fw"></i> History</a>
		  <a href="#" class="w3-padding"><i class="fa fa-cog fa-fw"></i> Settings</a><br><br>
		</nav>

		<div class="w3-main w3-container" style="margin-left:200px; padding-top:35px">
			<div class="w3-panel w3-card-2 w3-white">
				<h2><strong>Daftar konsumen Rumah Dannis Surabaya</strong></h2>
			</div>

      <table class="w3-table-all w3-card-2">
          <tr class="w3-green">
            <th>Id</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Telpon</th>
            <th>TTL</th>
						<th>Kontrol</th>
          </tr>
          <?php
          $query = read_allKonsumen();
          while($array = mysql_fetch_array($query)){
          ?>
          <tr>
          <td><?php echo "$array[0] "?></td>
          <td><?php echo "$array[1] "?></td>
          <td><?php echo "$array[2] "?></td>
          <td><?php echo "$array[3] "?></td>
          <td><?php echo "$array[8] "?></td>
					  <td><a href=""><button type="submit" class="w3-btn w3-orange w3-text-white">edit</button></a></td>
          </tr>
          <?php
            }
          ?>
      </table>
		</div>
	</body>
</html>
