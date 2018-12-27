<?php
session_start();
include '../function/pengiriman_pembayaran.php';
include '../function/retur.php';
include '../function/konsumen.php';
include '../function/penjualan.php';
include '../function/barang.php';
?>
<!DOCTYPE html>
<html>
	<title>Rincian retur</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../w3.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
  <script src="../jquery-3.1.1.min.js"></script>

<body class="w3-light-grey">
  <?php
    include 'top-navbar.php';
    include 'side-navbar.php';

		$retur = get_returbyId($_REQUEST['id_retur']);
    $query_id_retur = get_detail_returbyId($_REQUEST['id_retur']);
    $id_retur = mysql_fetch_array($query_id_retur);
    $pembayaran = get_pembayaranby_Idjual($id_retur['ID_JUAL'], 1);
    $pengiriman = get_pengirimanby_idbayar($pembayaran['ID_PEMBAYARAN']);

    $penjualan = get_penjualanby_id($pembayaran['ID_JUAL']);
    $konsumen = read_Konsumenby_id($penjualan['ID_KONS']);
  ?>

  <div class="w3-main w3-container" style="padding-top:75px; margin-left:200px;">
    <div class="w3-container w3-card w3-white" style="margin-top:20px">
      <h3 class="w3-border-bottom w3-border-black w3-padding-12">RINCIAN RETUR</h3>
      <form action="" method="post">
        <p>
          <div class="w3-container w3-row w3-yellow w3-padding-12">
            <div class="w3-col m6 s6">
              <b>Nomor pembelian : </b>
              <input class="w3-input w3-yellow w3-border-yellow" style="padding-top:0px; padding-left:0px;" type="text" name="ID_JUAL" value="<?php echo $id_retur['ID_JUAL']; ?>" readonly>
              <b>Nomor retur : </b>
              <input class="w3-input w3-yellow w3-border-yellow" style="padding-top:0px; padding-left:0px;" type="text" name="ID_RETUR" value="<?php echo $_REQUEST['id_retur']; ?>" readonly><br>
							<span style="font-size:10px">
								<?php
									echo 'tanggal persetujuan retur : '.$retur['TGL_PERSETUJUAN_RETUR'];
									echo ' deadline retur : '.$retur['DEADLINE_RETUR'];
								?>
							</span>
						</div>

            <div class="w3-col m6 s6">
              <b>Data pembeli : </b><br>
              <?php echo $konsumen['NM_KONS'];?></br>
              <?php echo "Telp: ".$konsumen['TELP_KONS'];?></br>
              <?php echo "Email: ".$konsumen['EMAIL_KONS'];?><br>
							<?php
							if ($retur['JENIS_RETUR'] == 1) {
							?>
							<b>pengiriman : </b><br>
							<?php echo $pengiriman['ALAMAT_KIRIM'];?><br>
							<?php echo 'kurir : '.$pengiriman['JASA_KIRIM'].' Rp.'.number_format($pengiriman['BIAYA_KIRIM'],2,',','.');?><br>
							<?php
							}
							?>
            </div>
          </div>
        </p>

        <div class="w3-container w3-card-4 w3-border w3-padding-12" style="margin-bottom:15px">
        <?php
          $query_detail_retur = get_detail_returbyId($_REQUEST['id_retur']);
          while ($detail_retur = mysql_fetch_array($query_detail_retur)){
            $barang = read_barang_byId($detail_retur['ID_BARANG']);
        ?>

          <div class="w3-row">
            <div class="w3-col m3 s3">
              <b>Barang : </b><br>
              <?php echo $barang['NM_BARANG'].' - '.$barang['WARNA'].' - '.$barang['UKURAN']." "; ?><br>
            </div>

            <div class="w3-col m1 s1">
              <b>jumlah : </b><br><?php echo $detail_retur['JUMLAH']; ?><br>
            </div>

            <div class="w3-col m2 s2">
              <b>keterangan : </b><br><?php echo $detail_retur['KETERANGAN_RETUR']; ?>
            </div>

            <div class="w3-col m4 s4" style="padding-right:30px">
              <b>barang pengganti : </b><br>
							<?php
							$row = read_barang_byId($detail_retur['BAR_ID_BARANG']);
							echo $row['NM_BARANG'].' - '.$row['WARNA'].' - '.$row['UKURAN'];
							?>

            </div>

            <div class="w3-col m2 s2">
              <b>Biaya tambahan : </b><br>
							<?php echo 'Rp.'.number_format($detail_retur['BIAYA_RETUR'],2,',','.'); ?>
            </div>
          </div>

        <hr>

        <?php
          }
        ?>
          <div class="w3-row">
            <div class="w3-col m10 s10">
              <div style="font-size:20px">
								<b>Total	<?php	echo "Rp. ".number_format($retur['TOTAL_BIAYA_RETUR'], 2, ",", "."); ?></b>
							</div>
            </div>
            <div class="w3-col m2 s2">
							<!--
							<div class="w3-right">
							<button type="submit" name="button" class="w3-btn w3-btn-xsmall w3-red w3-card-2">proses</button>
						</div>
							-->
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
