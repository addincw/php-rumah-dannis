<?php
session_start();
include '../function/koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Halaman Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../w3.css">
<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
</head>

<body style="background-color: #6F001F; color: white;">
  <div class="w3-row" style="margin-top:13%; ">
    <div class="w3-col s5 m6 w3-hide-small" style="padding-left:220px; padding-top:25px">
      <img src="../asset/logo_rumahdannis.png" style="width:230px; height:202px">
    </div>

    <div class="w3-col s7 m6 w3-container w3-leftbar w3-border-red" style="padding-left:25px; padding-right:25px">
      <p>
        <h1><strong>LOGIN.</strong></h1>
      </p>
      <form method="post" action="ceklogin.php">
        <p>
					<input id="user" class="w3-input w3-round" name="username" type="text" style="height:30px; width:75%" placeholder="username">
				</p>

				<p>
					<input id="pass" class="w3-input w3-round" name="password" type="password" style="height:30px; width:75%" placeholder="password">
				</p>

        <p>
          <button name='login' class="w3-btn w3-round-large w3-red" type="submit" style="width:75%">LOGIN</button>
        </p>

        <p>
          <?php
          if(isset($_SESSION['status'])){
            echo $_SESSION['status'];
            unset($_SESSION['status']);
          }

          else{
          echo "Isikan username dan password anda.";
          }
          ?>
        </p>
      </form>
    </div>
  </div>
</body>
