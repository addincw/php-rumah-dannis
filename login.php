<?php
session_start();
include 'function/koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Halaman Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>

<body class="w3-wide w3-light-grey">
  <div class="w3-top">
    <ul class="w3-navbar w3-red w3-wide w3-padding-8 w3-card-2">
      <li>
        <div class="w3-margin-left"><img src="asset/logo_rumahdannis.png" alt=""></div>
      </li>
      <!-- Float links to the right. Hide them on small screens -->
      <li class="w3-right w3-hide-small" style="margin-top:13px;">
        <a href="index.php" class="w3-left"><i class="fa fa-home"></i> Home</a>
      </li>
    </ul>
  </div>

  <div class="w3-content" style="margin-top:12%">
    <?php
    if(isset($_SESSION['STATUS_BELANJA'])){
    ?>
    <div class="w3-panel w3-card-4 w3-blue">
      <p>
        <span onclick="this.parentElement.style.display='none'" class="w3-closebtn w3-margin-right w3-medium">x</span>
        <?php echo $_SESSION['STATUS_BELANJA'];
        unset($_SESSION['STATUS_BELANJA']);
        ?>
      </p>
    </div>
    <?php
    }
    ?>

    <div class="w3-row w3-card-2 w3-white w3-round-large" style="height:300px">
      <div class="w3-half w3-white w3-round-large" style="padding:15px; height:100%">
        <form method="post" action="cek_login.php">
          <h1 style="padding:0px; margin:0px"><strong>LOGIN.</strong></h1>
          <p>
            <input id="user" class="w3-input" name="username" type="text" placeholder="username">
          </p>

          <p>
            <input id="pass" class="w3-input" name="password" type="password" placeholder="password">
          </p>

          <p class="w3-center">
            <button name='login' class="w3-btn w3-round-large w3-red" type="submit" style="width:100%; margin-bottom:15px">LOGIN</button>
            <?php
            if(isset($_SESSION['status_login'])){
            ?>
              <span class="w3-text-red"><?php echo $_SESSION['status_login']; ?></span>
            <?php
              unset($_SESSION['status_login']);
            }

            else{
            echo "Isikan username dan password anda.";
            }
            ?>
          </p>

        </form>
      </div>

      <div class="w3-half w3-red"
      style="height:100%; border-top-left-radius: 0em;
border-top-right-radius: 0.5em;
border-bottom-right-radius: 0.5em;
border-bottom-left-radius: 0em;">
        <p class="w3-center" style="padding-top:20%">
          <strong>Belum punya username dan password?</strong></br></br>
          <a href="registrasi.php">
            <button class="w3-btn w3-round-large" type="button">DAFTAR</button>
          </a>
        </p>
      </div>
    </div>
  </div>
</body>
