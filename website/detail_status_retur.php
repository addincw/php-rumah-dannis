<?php
include '../function/ATM.php';
include '../function/penjualan.php';
include '../function/retur.php';
include '../function/barang.php';
include '../function/pengiriman_pembayaran.php';
?>

<div class="w3-container w3-card w3-white">
  <?php
  $penjualan = get_penjualanby_id($_REQUEST['id_beli']);
  if ($penjualan['STATUS'] == 0) {
    echo 'tidak ada retur dengan nomor pembelian '.$_REQUEST['id_beli'];
  }else {
    $get_idretur = get_detail_returbyIdjual($penjualan['ID_JUAL']);
    $id_retur = mysql_fetch_array($get_idretur);
    $status_retur = get_returbyId($id_retur['ID_RETUR']);
    if ($status_retur["STATUS"] == 1) {
      $pembayaran = get_pembayaranby_Idjual($penjualan['ID_JUAL'], 1);
      $pengiriman = get_pengirimanby_idbayar($pembayaran['ID_PEMBAYARAN']);
    }else {
      $pembayaran = get_pembayaranby_Idjual('', 1);
      $pengiriman = get_pengirimanby_idbayar('');
    }
  ?>
  <div style="<?php if ($status_retur["STATUS"] == 0) {echo 'display:none';} ?>">
    <p class="w3-row">
      <div class="w3-col l6">
        <b>Nomor pembelian : </b><?php echo $penjualan['ID_JUAL']; ?><br>
        <hr>
        <span class="w3-tag w3-red">
          <?php
          switch ($pembayaran['STATUS_PEMBAYARAN']) {
            case 0:
            $atm = read_ATMby_id($penjualan['ID_ATM']);
            echo "menunggu pembayaran.<br>".$atm['NAMA'].' - '.$atm['NOMOR_REKENING'].' ('.$atm['NAMA_REKENING'].')';
            break;
            case 1:
            echo "pembayaran menunggu konfirmasi";
            break;
            case 2:
            echo "pembayaran diterima, ";
            switch ($pengiriman['STATUS_PENGIRIMAN']) {
              case 0:
              echo "pengiriman belum di proses";
              break;
              case 1:
              echo "pengiriman sedang di proses";
              break;
              case 2:
              echo "barang sudah di kirim";
              break;
            }
            break;
            case 3:
            echo "pembayaran ditolak";
            break;
          }
          ?>
        </span>
      </div>
      <div class="w3-col l6">
        <span class="w3-right">
          <b>alamat pengiriman : </b><br>
          <?php echo  $pengiriman['ALAMAT_KIRIM']; ?><br>
          <?php echo  $pengiriman['JASA_KIRIM'].' : Rp.'.number_format($pengiriman['BIAYA_KIRIM'],2,',','.'); ?><br>
          <hr>
          <b>Resi : </b>
          <?php echo  $pengiriman['NO_RESI']; ?><br>
        </span>
      </div>
    </p>
  </div>
  <br>
  <br>
  <table class="w3-table-all">
    <tr class="w3-green">
      <th>barang</th>
      <th>barang pengganti</th>
      <th>jumlah</th>
      <th>keterangan</th>
      <th>biaya tambahan</th>
      <th>status</th>
    </tr>

  <?php
  $status = 0;
  $query_detail_retur = get_detail_returbyIdjual($penjualan['ID_JUAL']);
  while ($detail_retur = mysql_fetch_array($query_detail_retur)) {
    $barang = read_barang_byId($detail_retur['ID_BARANG']);
    $barang_pengganti = read_barang_byId($detail_retur['BAR_ID_BARANG']);
    $retur = get_returbyId($detail_retur['ID_RETUR']);
  ?>
  <tr>
    <td><?php echo $barang['NM_BARANG']."-".$barang['WARNA']."-".$barang['UKURAN']; ?></td>
    <td><?php echo $barang_pengganti['NM_BARANG']."-".$barang_pengganti['WARNA']."-".$barang_pengganti['UKURAN']; ?></td>
    <td><?php echo $detail_retur['JUMLAH']; ?></td>
    <td><?php echo $detail_retur['KETERANGAN_RETUR']; ?></td>
    <td><?php echo 'Rp.'.number_format($detail_retur['BIAYA_RETUR'],2,',','.'); ?></td>
    <td>
      <?php
        switch ($detail_retur['STATUS_RETUR']) {
            case 0:
                echo "belum diperiksa";
                break;
            case 1:
                echo "retur disetujui";
                break;
            case 2:
                echo "retur ditolak";
                break;
        }
      ?>
    </td>
  </tr>
  <?php
    if ($detail_retur['STATUS_RETUR'] == 1) {
      $status = $detail_retur['STATUS_RETUR'];
    }
  }
  ?>
  </table>
  <p>
  <b>Total biaya retur : </b><?php echo ' Rp.'.number_format($retur['TOTAL_BIAYA_RETUR'],2,',','.'); ?>
  <hr>
  <span style="font-size:14px">
  <?php
    if ($status == 1) {
      echo 'Segera lakukan pembayaran dan pengembalian barang yang disetujui sebelum tanggal '.$retur['DEADLINE_RETUR'];
    }
  }
  ?>
  </span>
  </p>
</div>
