<?php
session_start();
include'../function/penjualan.php';
include '../function/barang.php';
 // Define relative path from this script to mPDF
$nama_dokumen='laporan_penjualan'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../MPDF60/');
include(_MPDF_PATH ."mpdf.php");
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
//$id_pesan = $_SESSION['idpesan'];
//$tgl_pesan = $_SESSION['tglpesan'];
//$idkar = $_SESSION['idkar'];
if(isset($_SESSION['tglawal'])&&isset($_SESSION['tglakhir'])){
$tgl_laporan="Tanggal ".substr($_SESSION['tglawal'], 0,10).' - '.substr($_SESSION['tglakhir'],0,10);
}

else{
$tgl_laporan='keseluruhan';
}
//$struk = mysql_query("select * from detail_jual where id_pesan='$id_pesan'");
//Beginning Buffer to save PHP variables and HTML tags
ob_start();
?>

<div style="height:90px;">
  <div style="width:250px; float:left">
		<b style="font-size:20px">Rumah Dannis Surabaya</b></br>
		BG Junction Mall, Blauran, Surabaya</br>
		08113766444</br>
	</div>

	<div style="width:280px; float:right;">
		<div style="width:50%; float:left">
			Tanggal :
		</div>

		<div align="right" style="width:50%; float:right">
			<?php echo date('d-m-Y');?></br>
		</div>
	</div>
</div>

<hr class="w3-border-grey">

<div align="center">
<h3 align="center"><br>Laporan Penjualan</br><br><?php echo $tgl_laporan;?></br></h3>
  <table class="w3-table-all w3-card-2" style="margin-top:0px; margin-bottom:20px">
    	<tr class="w3-green">
				<th>nomor pembelian</th>
				<th>jenis pembelian</th>
				<th>total</th>
				<th>tanggal pembelian</th>
      </tr>
<?php
if(isset($_SESSION['tglawal'])&&isset($_SESSION['tglakhir'])){
$tglawal=$_SESSION['tglawal'];
$tglakhir=$_SESSION['tglakhir'];

$sql=get_penjualanby_date($tglawal, $tglakhir);
}

else{
$sql=get_Allpenjualan();
}

while($row=mysql_fetch_array($sql)){
?>
    	<tr>
        <td><?php echo $row['ID_JUAL']; ?></td>
        <td>
					<?php
					switch ($row['JENIS_JUAL']) {
						case '0':
							echo 'OFFLINE';
							break;
						case '1':
							echo 'ONLINE';
							break;
					}
					?>
				</td>
				<td><?php echo 'Rp. '.number_format($row['TOTAL'],2,',','.'); ?></td>
				<td><?php echo $row['TGL_PESAN']; ?></td>
      </tr>
<?php
$subtotal=$subtotal+$row['TOTAL'];
}
?>
			<tr>
				<td colspan="2" align="center"><b>Total penjualan</b></td>
				<td colspan="2" ><?php echo 'Rp. '.number_format($subtotal,2,',','.'); ?></td>
		  </tr>
		</table>
</div>

<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$stylesheet = file_get_contents('../w3.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
unset($_SESSION['tglawal']);
unset($_SESSION['tglakhir']);
exit;
?>
