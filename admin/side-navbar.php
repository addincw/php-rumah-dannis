<nav class="w3-sidenav w3-collapse  w3-red w3-text-white" style="z-index:3;width:200px; margin-top:53px; padding-bottom:65px" id="mySidenav"><br>
  <a id="close" href="javascript:void(0)" class="w3-right w3-padding-16 w3-hide-large" title="close menu" style="margin-right:5px"><i class="fa fa-remove fa-fw"></i></a>
  <div class="w3-container w3-row" style=" background-image: url('../asset/admin.jpg'); background-size: 200px 128px; background-repeat: no-repeat;">
    <div class="w3-col s8" style="padding-top:40px; padding-bottom:25px;">
      <span style="font-size:20px">Welcome, <strong><?php echo $_SESSION['ID_KAR'] ?></strong></span><br>
    </div>
  </div>

  <a href="registrasi.php" class="w3-padding <?php if (basename($_SERVER['PHP_SELF']) == 'registrasi.php') echo 'w3-orange w3-text-white'?>">
    <i class="fa fa-user-plus w3-large"></i><span style="margin-left:5px">Registrasi</span>
  </a>
  <a href="penjualan.php" class="w3-padding <?php if (basename($_SERVER['PHP_SELF']) == 'penjualan.php') echo 'w3-orange w3-text-white'?>">
    <i class="fa fa-shopping-cart w3-large" style="margin-right:5px"></i><span style="margin-left:5px">Penjualan</span>
  </a>
  <a class="list w3-padding <?php if ((basename($_SERVER['PHP_SELF']) == 'pre_order.php') || (basename($_SERVER['PHP_SELF']) == 'daftar_order.php')) echo 'w3-orange w3-text-white'?>" data-name="pre_order">
    <i class="fa fa-hand-o-up w3-large"></i> Pre - order <i class="fa fa-caret-right" aria-hidden="true"></i>
  </a>
  <div class="pre_order w3-container" style="display:none">
    <a href="pre_order.php" class="w3-padding <?php if ((basename($_SERVER['PHP_SELF']) == 'pre_order.php')) echo 'w3-text-orange'?>">
      Pre - order
    </a>
    <a href="daftar_order.php" class="w3-padding <?php if (basename($_SERVER['PHP_SELF']) == 'daftar_order.php') echo 'w3-text-orange'?>">
      Daftar order
    </a>
  </div>
  <a href="konfirmasi_pembayaran.php" class="w3-padding <?php if (basename($_SERVER['PHP_SELF']) == 'konfirmasi_pembayaran.php') echo 'w3-orange w3-text-white'?>">
    <i class="fa fa-money w3-large"></i><span style="margin-left:5px">Konfirmasi bayar</span>
  </a>
  <a class="list w3-padding <?php if ((basename($_SERVER['PHP_SELF']) == 'barang_siapKirim.php') || (basename($_SERVER['PHP_SELF']) == 'upload_buktiKirim.php')) echo 'w3-orange w3-text-white'?>" data-name="pengiriman">
    <i class="fa fa-truck w3-large" w3-large></i><span style="margin-left:5px">pengiriman</span> <i class="fa fa-caret-right" aria-hidden="true"></i>
  </a>
  <div class="pengiriman w3-container" style="display:none">
    <a href="barang_siapKirim.php" class="w3-padding <?php if (basename($_SERVER['PHP_SELF']) == 'barang_siapKirim.php') echo 'w3-text-orange'?>">
      <span style="margin-left:5px">Siap kirim</span>
    </a>
    <a href="upload_buktiKirim.php" class="w3-padding <?php if (basename($_SERVER['PHP_SELF']) == 'upload_buktiKirim.php') echo 'w3-text-orange'?>">
      <span style="margin-left:5px">Upload resi kirim</span>
    </a>
  </div>
  <a class="list w3-padding <?php if ((basename($_SERVER['PHP_SELF']) == 'retur.php') || (basename($_SERVER['PHP_SELF']) == 'konfirmasi_retur.php')  || (basename($_SERVER['PHP_SELF']) == 'daftar_retur.php')) echo 'w3-orange w3-text-white'?>" data-name="retur">
    <i class="fa fa-undo w3-large"></i><span style="margin-left:5px">Retur </span><i class="fa fa-caret-right" aria-hidden="true"></i>
  </a>
  <div class="retur w3-container" style="display:none">
    <a href="retur.php" class="w3-padding <?php if (basename($_SERVER['PHP_SELF']) == 'retur.php') echo 'w3-text-orange'?>">
      <span style="margin-left:5px">Retur Offline</span>
    </a>
    <a href="konfirmasi_retur.php" class="w3-padding <?php if (basename($_SERVER['PHP_SELF']) == 'konfirmasi_retur.php') echo 'w3-text-orange'?>">
      <span style="margin-left:5px">Konfirmasi retur</span>
    </a>
    <a href="daftar_retur.php" class="w3-padding <?php if (basename($_SERVER['PHP_SELF']) == 'daftar_retur.php') echo 'w3-text-orange'?>">
       Daftar retur
    </a>
  </div>
  <a href="laporan_penjualan2.php" class="w3-padding <?php if (basename($_SERVER['PHP_SELF']) == 'laporan_penjualan2.php') echo 'w3-orange w3-text-white'?>">
    <i class="fa fa-list w3-large"></i> Laporan penjualan
  </a>

  <div class="w3-hide-large">
    <hr>
    <a href="logout.php">Logout</a>
  </div>
</nav>
