<?php
session_start();
include "../function/pengiriman_pembayaran.php";
include "../function/penjualan.php";
include "../function/barang.php";

// Define relative path from this script to mPDF
$nama_dokumen='nota penjualan'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../MPDF60/');
include(_MPDF_PATH ."mpdf.php");
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document

//Beginning Buffer to save PHP variables and HTML tags
ob_start();

$pembayaran = get_pembayaranby_idjual($_REQUEST['id_jual']);
$id_pembayaran = $pembayaran['ID_PEMBAYARAN'];
$total_pembayaran = $pembayaran['TOTAL_PEMBAYARAN'];
$deadline_pembayaran = $pembayaran['DEADLINE_PEMBAYARAN'];

$penjualan = get_penjualanby_id($_REQUEST['id_jual']);
$tgl_beli = $penjualan['TGL_PESAN'];
$total_barang = $penjualan['TOTAL'];

$pengiriman = get_pengirimanby_idbayar($id_pembayaran);
$biaya_kirim = $pengiriman['BIAYA_KIRIM'];
?>

<div style="height:90px;">
  <div style="width:250px; float:left">
		<b style="font-size:20px">Rumah Dannis Surabaya</b></br>
		BG Junction Mall, Blauran, Surabaya</br>
		08113766444</br>
	</div>

	<div style="width:280px; float:right;">
		<div style="width:50%; float:left">
			Tanggal pembelian
		</div>

		<div align="right" style="width:50%; float:right">
			<?php echo $tgl_beli;?></br>
		</div>
	</div>
</div>

  <hr class="w3-border-grey">

<div align="center">
	<h2 align="center">NOTA</h2>
  <div style="height:20px; margin-bottom:10px">
    <div style="width:250px; float:left">
      Nomor pembelian
    </div>

    <div style="width:200px; float:right;" align="right">
      <?php echo $_REQUEST['id_jual']; ?>
    </div>
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
    $query = get_detailjualby_id($_REQUEST['id_jual']);
    while($detail_jual = mysqli_fetch_array($query)){
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

  <div style="height:20px;">
    <div style="width:250px; float:left">
      Total harga barang
  	</div>

  	<div style="width:200px; float:right;" align="right">
      <?php echo "Rp. ".number_format($total_barang, 2, ",", "."); ?>
    </div>
  </div>

  <div style="height:20px;">
    <div style="width:250px; float:left">
      Ongkos kirim
    </div>

    <div style="width:200px; float:right;" align="right">
      <?php echo "Rp. ".number_format($biaya_kirim, 2, ",", ".");; ?>
    </div>
  </div>

  <hr class="w3-border-grey">

  <div style="height:20px;">
    <div style="width:250px; float:left">
      Total biaya
    </div>

    <div style="width:200px; float:right;" align="right">
      <?php echo "Rp. ".number_format($total_pembayaran, 2, ",", ".");; ?>
    </div>
  </div>

  <div style="margin-top:50px">
    <b>
      status pembelian :
      <?php
        switch ($pembayaran['STATUS_PEMBAYARAN']) {
            case 0:
                echo "belum transfer pembayaran, harap transfer sebelum tanggal ".$deadline_pembayaran;
                break;
            case 1:
                echo "menunggu konfirmasi bukti pembayaran";
                break;
            case 2:
                echo "lunas, sedang proses pengiriman";
                break;
            case 3:
                echo "bukti pembayaran tidak valid";
                break;

            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }
      ?>
    </b>
  </div>

  <div style="font-size:12px; margin-top:10px; margin-bottom:10px"><span class="w3-text-red">* </span>
    simpan nomor pembelian anda. berguna untuk mengecek status barang anda
  </div>


</div>

<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$stylesheet = file_get_contents('../w3.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>
