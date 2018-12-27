<?php
session_start();
include '../function/pre_order.php';
include '../function/barang.php';

// Define relative path from this script to mPDF
$nama_dokumen='nota order'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../MPDF60/');
include(_MPDF_PATH ."mpdf.php");
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document

//Beginning Buffer to save PHP variables and HTML tags
ob_start();
$pemesanan = get_pesanby_id($_REQUEST['id_order']);

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
			<?php echo $pemesanan['TGL_PSN'];?></br>
		</div>
	</div>
</div>

  <hr class="w3-border-grey">

<div align="center">
	<h2 align="center">NOTA</h2>
  <div style="height:20px; margin-bottom:10px">
    <div style="width:250px; float:left">
      Nomor order
    </div>

    <div style="width:200px; float:right;" align="right">
      <?php echo $_REQUEST['id_order']; ?>
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
    $query = get_detailpesanby_id($_REQUEST['id_order']);
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

  <div style="height:20px;">
    <div style="width:250px; float:left">
      Total harga barang
  	</div>

  	<div style="width:200px; float:right;" align="right">
      <?php echo "Rp. ".number_format($pemesanan['TOTAL'], 2, ",", "."); ?>
    </div>
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
