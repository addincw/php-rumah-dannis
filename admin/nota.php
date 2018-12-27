<?php
  session_start();
  include '../function/penjualan.php';
  include '../function/pengiriman_pembayaran.php';
  include '../function/barang.php';

  if(!isset($_SESSION['ID_KAR'])){
  		$_SESSION['status'] = 'anda belum melakukan login';
  		header('location:index.php');
  	}else {
      if(isset($_REQUEST['id_jual'])){
        $pembayaran = get_pembayaranby_idjual($_REQUEST['id_jual']);
        $id_pembayaran = $pembayaran['ID_PEMBAYARAN'];
        $total_pembayaran = $pembayaran['TOTAL_PEMBAYARAN'];


        $penjualan = get_penjualanby_id($_REQUEST['id_jual']);
        $tgl_beli = $penjualan['TGL_PESAN'];
        $total_barang = $penjualan['TOTAL'];

        $pengiriman = get_pengirimanby_idbayar($id_pembayaran);
        $biaya_kirim = $pengiriman['BIAYA_KIRIM'];
      }
  	}

?>
<!DOCTYPE html>
<html>
	<title>Nota Beli</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../w3.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
  <script src="../jquery-3.1.1.min.js"></script>
  <body class="w3-light-grey">
    <?php include 'top-navbar.php'; ?>
    <div class="w3-container w3-padding-32" style="margin-top:55px;">
      <div class="w3-container w3-card w3-white">
        <h3 class="w3-border-bottom w3-border-black w3-padding-12">NOTA PEMBELIAN</h3>
        <div class="w3-row" style="margin-bottom:15px">
            <div class="w3-half">nomor pembelian <?php echo $_REQUEST['id_jual']; ?></div>
            <div class="w3-half w3-right"><span class="w3-right"><?php echo $tgl_beli; ?></span></div>
        </div>

        <div class="w3-responsive">
          <table class="w3-table-all w3-card-2" style="margin-bottom:20px">
            <tr class="w3-green">
              <th>Product</th>
              <th>Harga</th>
              <th>Disc</th>
              <th>Jumlah</th>
              <th>Sub total</th>
            </tr>

            <?php
            $query = get_detailjualby_id($_REQUEST['id_jual']);
            while($detail_jual = mysql_fetch_array($query)){
              $barang = read_barang_byId($detail_jual['ID_BARANG']);
              ?>
              <tr>
                <td><?php echo $barang['NM_BARANG'].' '.$barang['WARNA'].' - '.$barang['UKURAN'];?></td>
                <td><?php echo "Rp. ".number_format($detail_jual['HARGA_JUAL'], 2, ",", ".");?></td>
                <td> - </td>
                <td><?php echo $detail_jual['JUMLAH'];?></td>
                <td><?php echo "Rp. ".number_format($detail_jual['HARGA_TOTAL'], 2, ",", ".");
                ?>
              </td>
              <?php
            }
            ?>

          </table>
        </div>

        <div class="w3-row">
            <div class="w3-half">Total harga barang</div>
            <div class="w3-half w3-right"><span class="w3-right"><?php echo "Rp. ".number_format($total_barang, 2, ",", "."); ?></span></div>
        </div>

        <?php if ($penjualan['JENIS_JUAL'] == 1) { ?>
          <div class="w3-row">
              <div class="w3-half">Ongkos kirim</div>
              <div class="w3-half w3-right"><span class="w3-right"><?php echo "Rp. ".number_format($biaya_kirim, 2, ",", "."); ?></span></div>
          </div>

          <hr class="w3-border-grey">

          <div class="w3-row">
              <div class="w3-half">Total pembayaran</div>
              <div class="w3-half w3-right"><span class="w3-right"><?php echo "Rp. ".number_format($total_pembayaran, 2, ",", "."); ?></span></div>
          </div>

        <?php }else { ?>
          <hr class="w3-border-grey">
        <?php } ?>
        <p>
          Status pembelian :
          <?php
            switch ($pembayaran['STATUS_PEMBAYARAN']) {
                case 0:
                    echo "belum transfer pembayaran, harap transfer sebelum tanggal ".$deadline_pembayaran;
                    break;
                case 1:
                    echo "menunggu konfirmasi bukti pembayaran";
                    break;
                case 2:
                    echo "lunas";
                    break;
                case 3:
                    echo "bukti pembayaran tidak valid";
                    break;
                default:
                    echo "Your favorite color is neither red, blue, nor green!";
              }
          ?>
        </p>


        <div style="font-size:12px; margin-bottom:10px"><span class="w3-text-red">* </span>
            simpan nomor pembelian anda. berguna untuk mengecek status barang anda
        </div>

        <p class="w3-center">
          <a href="nota_pdf.php?id_jual=<?php echo $_REQUEST['id_jual'];?>" target="_blank">
            <button class="w3-btn w3-medium" type="button">cetak nota</button>
          </a>
        </p>

      </div>
    </div>
  </body>
  <script>
    $(document).ready(function(){
      $("#close").click(function(){
      //alert('berhasil');
        $("#mySidenav").hide();
      });

      $("#menu").click(function(){
      //alert('berhasil');
        $("#mySidenav").toggle();
      });
    })
  </script>
</html>
