<?php
  include '../function/pengiriman_pembayaran.php';
  include '../function/penjualan.php';
  include '../function/ATM.php';

  $penjualan = get_penjualanby_id($_REQUEST['id_beli']);
  $pembayaran = get_pembayaranby_idjual($penjualan['ID_JUAL']);
  $pengiriman = get_pengirimanby_idbayar($pembayaran['ID_PEMBAYARAN']);
  $atm = read_ATMby_id($penjualan['ID_ATM']);
?>

<div class="w3-card w3-container w3-white">
  <p class="w3-border-bottom w3-border-black w3-padding-12"><b>nomor pembelian : </b><?php echo $penjualan['ID_JUAL']; ?></p>

  <div class="w3-row w3-border" style="margin-bottom:30px">
    <div class="w3-col m4 w3-container w3-border-right">
      <h5 class="w3-bottombar w3-border-black"><b>1. PEMBELIAN</b></h5>
      <p>
        <b>Tanggal Pembelian </b><br><?php echo $penjualan['TGL_PESAN']; ?><br>
        <hr>
        <b>Total pembayaran </b><br><?php echo "Rp. ".number_format($pembayaran['TOTAL_PEMBAYARAN'], 2, ",", "."); ?><br>
        <hr>
        <b><a class="w3-text-blue" href="nota_beli.php?id_jual=<?php echo $penjualan['ID_JUAL']; ?>">Detail pembelian</a></b><br>
      </p>
    </div>

    <div class="w3-col m4 w3-container w3-border-right">
      <h5 class="w3-bottombar w3-border-orange"><b>2. PEMBAYARAN</b></h5>
      <p>
        <b>Deadline pembayaran </b><br><?php echo $pembayaran['DEADLINE_PEMBAYARAN']; ?><br>
        <hr>
        <b>Tanggal pembayaran </b><br><?php echo $pembayaran['TGL_PEMBAYARAN']; ?><br>
        <hr>
        <b>Rekening Pembayaran yang dipilih </b><br><?php echo $atm['NAMA'].' - '.$atm['NOMOR_REKENING']; ?><br>
        <hr>
        <b>Status :</b>
          <?php
            switch ($pembayaran['STATUS_PEMBAYARAN']) {
                case 0:
                    echo "menunggu pembayaran";
                    break;
                case 1:
                    echo "pembayaran menunggu konfirmasi";
                    break;
                case 2:
                    echo "pembayaran di terima";
                    break;
                case 3:
                    echo "pembayaran di tolak, mohon upload ulang bukti pembayaran. atau hubungi cs";
                    break;
            }
          ?>
        <br>
      </p>
    </div>

    <div class="w3-col m4 w3-container">
      <h5 class="w3-bottombar w3-border-green"><b>3. PENGIRIMAN</b></h5>
      <p>
        <b>Tanggal pengiriman </b><br><?php echo $pengiriman['TGL_KIRIM']; ?><br>
        <hr>
        <b>Alamat pengiriman </b><br><?php echo $pengiriman['ALAMAT_KIRIM']; ?><br>
        <b>Jasa pengiriman </b><br><?php echo $pengiriman['JASA_KIRIM']; ?><br>
        <hr>
        <?php
          if ($pengiriman['STATUS_PENGIRIMAN'] == 2) {
        ?>
        <b>Nomor resi pengiriman </b><br><?php echo $pengiriman['NO_RESI']; ?><br>
        <hr>
        <?php
          }
        ?>
        <b>Status :</b>
          <?php
            switch ($pengiriman['STATUS_PENGIRIMAN']) {
                case 0:
                    echo "pengiriman belum di proses";
                    break;
                case 1:
                    echo "pengiriman sedang di proses";
                    break;
                case 2:
                    echo "barang sudah di kirim";
          ?>
                    <br>
                    <br>
                    <p style="font-size:12px">apakah barang telah diterima?</p>
                    <a href="update_pengiriman.php?id_kirim=<?php echo $pengiriman['ID_KIRIM']; ?>&status=3"><button type="button" name="button" class="w3-btn w3-green">barang sudah diterima</button></a>
          <?php
                    break;
                case 3:
                    echo "barang telah diterima.";
                    break;
            }
          ?>
        <br>
      </p>
    </div>
  </div>
</div>
