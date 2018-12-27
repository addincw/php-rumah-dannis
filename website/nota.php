<?php
session_start();
include("../function/koneksi.php");
 // Define relative path from this script to mPDF
$nama_dokumen='nota penjualan'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../MPDF60/');
include(_MPDF_PATH ."mpdf.php");
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document

//Beginning Buffer to save PHP variables and HTML tags
ob_start();
?>

<div style="height:90px; border: none; border-bottom: 2px solid red;">
	<div style="width:250px; float:left">
		<b style="font-size:20px">Rumah Dannis Surabaya</b></br>
		BG Junction Mall, Blauran, Surabaya</br>
		08113766444</br>
	</div>

	<div style="width:200px; float:right;">
		<div style="width:50%; float:left">
			Tanggal
		</div>

		<div style="width:50%; float:right">
			<?php echo "brrr";?></br>
		</div>
	</div>
</div>

<div align="center">
	<h2 align="center">NOTA</h2>
	<table width="100%" height="31">
	  <tr>
	    <th width="64">PRODUCT</th>
	    <th width="48">HARGA</th>
	    <th width="22">NO</th>
	    <th width="22">JUMLAH</th>
			<th width="56">SUBTOTAL</th>
	  </tr>

		<?php
			$no = 0;
			$total = 0;
			while($row=mysql_fetch_array($nota)){
				$ambilnama = "select * from barang where id_barang='$row[0]'";
				$result = mysql_query($ambilnama);
				$rowb = mysql_fetch_array($result);
				$nama = $rowb[1].' '.$rowb[4];
		?>

      <tr>
        <td width="64" align="center"><?php echo $nama;?></td>
        <td width="48" align="center"><?php echo "Rp. ".number_format($row[1], 2, ",", ".");?></td>
        <td width="22" align="center"><?php echo $no+1;?></td>
				<td width="56" align="center"><?php echo $row[2];?></td>
				<td width="56" align="center"><?php $subtotal=$row[1]*$row[2];
																						echo "Rp. ".number_format($subtotal, 2, ",", ".");
																			?>
				</td>
      </tr>

		<?php
		$no++;
		$total=$total+$subtotal;
		}
		?>

		<tr>
       <td colspan="4" align="center" bgcolor="#999999" style="color:#FFF">Total</td>
       <td align="center"><?php echo "Rp. ".number_format($total, 2, ",", ".");?></td>
    </tr>
  </table>
</div>

<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>
