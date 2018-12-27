<?php
session_start();
include '../function/konsumen.php';
include '../function/penjualan.php';
include '../function/barang.php';
include '../function/kategori.php';
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
<?php
if(isset($_POST['tglawal'])&&isset($_POST['tglakhir'])){
  $tglawal=$_POST['tglawal'].' 00:00:00';
  $tglakhir=$_POST['tglakhir'].' 00:00:00';

  $_SESSION['tglawal']=$tglawal;
  $_SESSION['tglakhir']=$tglakhir;

  $sql_penjualanby_jenisJual=get_penjualanby_jenisJual($tglawal, $tglakhir);
  $sql_barang_terlaris=get_barang_terlaris($tglawal, $tglakhir);
  $sql_kategori_terlaris=get_kategori_terlaris($tglawal, $tglakhir);
  $sql_kota_terlaris=get_kota_terlaris($tglawal, $tglakhir);
}

else{
  $sql_penjualanby_jenisJual=get_penjualanby_jenisJual();
  $sql_barang_terlaris=get_barang_terlaris();
  $sql_kategori_terlaris=get_kategori_terlaris();
  $sql_kota_terlaris=get_kota_terlaris();
}
?>

	<div align="left">
	  <h5>Penjualan berdasarkan kota (3 teratas) :</h5>
	</div>
  <table class="w3-table-all w3-card-2" style="margin-top:0px; margin-bottom:20px">
    <tr class="w3-green">
      <th>kota</th>
      <th>banyaknya terjual</th>
    </tr>
    <?php
    while($row=mysql_fetch_array($sql_kota_terlaris)){
      $kota = read_Kotaby_id($row['ID_KOTA']);
    ?>
      <tr>
        <td><?php echo $kota['NM_KOTA']; ?></td>
        <td><?php echo $row['JUMLAH_PENJUALAN']; ?></td>
      </tr>
      <?php
    }
    ?>
		</table>

    <div align="left">
      <h5>Penjualan berdasarkan jenis penjualan :</h5>
    </div>
    <table class="w3-table-all w3-card-2" style="margin-top:0px; margin-bottom:20px">
      <tr class="w3-green">
        <th>jenis penjualan</th>
        <th>banyak penjualan</th>
        <th>total penjualan</th>
      </tr>
      <?php
      while($row=mysql_fetch_array($sql_penjualanby_jenisJual)){
      ?>
        <tr>
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
          <td><?php echo $row['JUMLAH_TRANSAKSI'].' x'; ?></td>
          <td><?php echo 'Rp. '.number_format($row['TOTAL_TRANSAKSI'],2,',','.'); ?></td>
        </tr>
        <?php
        $subtotal=$subtotal+$row['TOTAL_TRANSAKSI'];
      }
      ?>
      <tr>
        <td colspan="2" align="center"><b>Total seluruh penjualan</b></td>
        <td colspan="2" ><?php echo 'Rp. '.number_format($subtotal,2,',','.'); ?></td>
      </tr>
      </table>

      <div align="left">
        <h5>Penjualan berdasarkan kategori terlaris (3 teratas) :</h5>
      </div>
      <table class="w3-table-all w3-card-2" style="margin-top:0px; margin-bottom:20px">
        <tr class="w3-green">
          <th>kategori</th>
          <th>banyaknya terjual</th>
        </tr>
        <?php
        while($row=mysql_fetch_array($sql_kategori_terlaris)){
          $kategori = read_kategori_byId($row['ID_KATEGORI']);
        ?>
          <tr>
            <td><?php echo $kategori['NAMA_KATEGORI']; ?></td>
            <td><?php echo $row['BANYAK_TERJUAL']; ?></td>
          </tr>
          <?php
        }
        ?>
        </table>

        <div align="left">
          <h5>Penjualan berdasarkan barang terlaris (3 teratas) :</h5>
        </div>
        <table class="w3-table-all w3-card-2" style="margin-top:0px; margin-bottom:20px">
          <tr class="w3-green">
            <th>barang</th>
            <th>kategori</th>
            <th>banyaknya terjual</th>
          </tr>
          <?php
          while($row=mysql_fetch_array($sql_barang_terlaris)){
            $barang = read_barang_byId($row['ID_BARANG']);
            $kategori = read_kategori_byId($row['ID_KATEGORI']);
          ?>
            <tr>
              <td><?php echo $barang['NM_BARANG'].'-'.$barang['UKURAN'].'-'.$barang['WARNA'];?></td>
              <td><?php echo $kategori['NAMA_KATEGORI']; ?></td>
              <td><?php echo $row['BANYAK_TERJUAL']; ?></td>
            </tr>
            <?php
          }
          ?>
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
