<?php
include '../function/penjualan.php';
include '../function/pre_order.php';
include '../function/barang.php';
include '../function/pengiriman_pembayaran.php';
?>

<div class="w3-container w3-card w3-white">
  <?php
  $order = get_pesanby_id($_REQUEST['id_beli']);
  ?>
  <p class="w3-row">
    <div class="w3-col l6">
      <b>Nomor order : </b><?php echo $order['ID_PSN']; ?><br>
    </div>
    <div class="w3-col l6">
      <span class="w3-right">
        <span class="w3-tag w3-red">
          <?php
          if (!is_null($order['STATUS_PSN'])) {
            switch ($order['STATUS_PSN']) {
              case 0:
              echo "Barang sudah tersedia";
              break;
              case 1:
              echo "Barang belum tersedia";
              break;
            }
          }else{
            echo "Belum diperiksa.";
          }
          ?>
        </span>
      </span>
    </div>
  </p>
  <br>
  <br>
  <table class="w3-table-all">
    <tr class="w3-green">
      <th>barang</th>
      <th>jumlah</th>
      <th>harga</th>
      <th>subtotal</th>
    </tr>

  <?php
  $query_detail_order = get_detailpesanby_id($order['ID_PSN']);
  while ($detail_order = mysql_fetch_array($query_detail_order)) {
    $barang = read_barang_byId($detail_order['ID_BARANG']);
  ?>
  <tr>
    <td><?php echo $barang['NM_BARANG']."-".$barang['WARNA']."-".$barang['UKURAN']; ?></td>
    <td><?php echo $detail_order['JUMLAH']; ?></td>
    <td><?php echo 'Rp.'.number_format($detail_order['HARGA'],2,',','.'); ?></td>
    <td><?php echo 'Rp.'.number_format($detail_order['TOTAL'],2,',','.'); ?></td>
  </tr>
  <?php } ?>
  </table>
  <p>
  <b>Total biaya : </b><?php echo ' Rp.'.number_format($order['TOTAL'],2,',','.'); ?>
  <hr>
  <span style="font-size:14px">
  <?php
    if (!is_null($order['STATUS_PSN'])) {
      if (($order['STATUS_PSN'] == 0)) {
        if (is_null($order['KONFIRMASI_PSN'])) {
          echo 'Barang sudah tersedia, mohon segera konfirmasi pembelian.';
          ?>
          <a href="update_order.php?id_psn=<?php echo $order['ID_PSN']; ?>">
            <button type="button" name="button">Konfirmasi untuk membeli</button>
          </a>
  <?php
        }else {
          echo 'anda telah melakukan konfirmasi,
          silahkan melakukan transfer dan mengupload bukti transfer dengan menggunakan nomor pembelian yang anda dapatkan. pada halaman <b>transaksi > upload pembayaran</b>, ';
          echo 'anda juga dapat melihat status pembelian anda di halaman <b>transaksi > status transaksi > status pembelian.</b>';
        }
      }
    }else {
      echo '';
    }
  ?>
  </span>
  </p>
</div>
