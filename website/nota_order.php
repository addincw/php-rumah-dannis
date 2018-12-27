<?php
  session_start();
  include '../function/pre_order.php';
  include '../function/barang.php';

  if(!isset($_SESSION['ID_KONS'])){
  		$_SESSION['status'] = 'anda belum melakukan login';
  		header('location:index.php');
  	}else {
      if(isset($_REQUEST['id_order'])){
        $pemesanan = get_pesanby_id($_REQUEST['id_order']);
      }
  	}

?>
<!DOCTYPE html>
<html>
	<title>Nota Order</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../w3.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

  <body class="w3-light-grey">
    <div class="w3-container w3-padding-32" style="margin-top:35px;">
      <div class="w3-container w3-card w3-white">
        <h3 class="w3-border-bottom w3-border-black w3-padding-12">NOTA ORDER</h3>
        <div class="w3-row" style="margin-bottom:15px">
            <div class="w3-half">nomor order <?php echo $_REQUEST['id_order']; ?></div>
            <div class="w3-half w3-right"><span class="w3-right"><?php echo $pemesanan['TGL_PSN']; ?></span></div>
        </div>

        <table class="w3-table-all w3-card-2" style="margin-bottom:20px">
          <tr class="w3-green">
            <th>Product</th>
            <th>Harga</th>
            <th>Disc</th>
            <th>Jumlah</th>
            <th>Sub total</th>
          </tr>

          <?php
          $query = get_detailpesanby_id($pemesanan['ID_PSN']);
          while($detail_pesan = mysql_fetch_array($query)){
            $barang = read_barang_byId($detail_pesan['ID_BARANG']);
          ?>
            <tr>
              <td><?php echo $barang['NM_BARANG'].' '.$barang['WARNA'].' - '.$barang['UKURAN'];?></td>
              <td><?php echo "Rp. ".number_format($detail_pesan['HARGA'], 2, ",", ".");?></td>
              <td> - </td>
              <td><?php echo $detail_pesan['JUMLAH'];?></td>
              <td><?php echo "Rp. ".number_format($detail_pesan['TOTAL'], 2, ",", ".");
                  ?>
              </td>
          <?php
          }
          ?>

        </table>

        <div class="w3-row">
            <div class="w3-half">Total harga barang</div>
            <div class="w3-half w3-right"><span class="w3-right"><?php echo "Rp. ".number_format($pemesanan['TOTAL'], 2, ",", "."); ?></span></div>
        </div>

        <hr class="w3-border-grey">

        <p>
          Status order :
          <?php
            switch ($pemesanan['STATUS_PSN']) {
                case 0:
                    if (empty($pemesanan['STATUS_PSN'])) {
                      echo "Order belum di periksa.";
                      break;
                    }else {
                      echo "barang tersedia, harap segera lakukan konfirmasi";
                      break;
                    }
                case 1:
                    echo "barang belum tersedia";
                    break;
              }
          ?>
        </p>


        <div style="font-size:12px; margin-bottom:10px"><span class="w3-text-red">* </span>
            simpan nomor order anda. berguna untuk mengecek status barang anda
        </div>

        <p class="w3-center">
          <a href="nota_order_pdf.php?id_order=<?php echo $pemesanan['ID_PSN'];?>" target="_blank">
            <button class="w3-btn w3-medium" type="button">cetak nota</button>
          </a>
        </p>

      </div>
    </div>
  </body>
</html>
