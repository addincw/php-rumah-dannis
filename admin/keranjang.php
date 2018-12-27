<?php
session_start();
ob_start();
include '../function/barang.php';

if(!isset($_SESSION['list'])){
	$_SESSION['list'][] = 0;
	unset ($_SESSION['list'][0]);
	}

?>
	<link rel="stylesheet" href="../w3.css">
	<div class="w3-responsive">
		<table class="w3-table-all w3-card-2" style="margin-bottom:20px">
			<tr class="w3-green">
				<th>Product</th>
				<th>Harga</th>
				<th>Disc</th>
				<th>Jumlah</th>
				<th>Sub total</th>
				<th>Kontrol</th>
			</tr>

			<?php
			$total = 0;
			foreach($_SESSION['list'] as $no => $daftar){?>
				<tr>
					<td><?php echo $daftar['nama'];?></td>
					<td><?php echo "Rp. ".number_format($daftar['harga_jual'], 2, ",", ".");?></td>
					<td> - </td>
					<td><?php echo $daftar['jumlah'];?></td>
					<td><?php echo "Rp. ".number_format($daftar['subtotal'], 2, ",", ".");
					?>
				</td>
				<td><a href="?Delete=<?php echo $no; ?>"><button type="submit" class="w3-btn w3-orange w3-text-white">batal</button></a></td>
			</tr>
			<?php
			$total=$total+$daftar['subtotal'];
		}

		$_SESSION['total'] = $total;
		?>
	</table>
	</div>

	<div style="font-size:20px"><b>Total <?php echo "Rp. ".number_format($total, 2, ",", "."); ?></b></div>
</div>


<?php
//@$tgl_pesan = date('Y-m-d');
if (isset($_POST['id_jual'])) {
	$_SESSION['id_jual'] = $_POST['id_jual'];
	$_SESSION['ID_KONS']	= $_POST['id_kons'];
}

@$id_barang = $_POST['id_barang'];
@$jumlah = $_POST['jumlah'];

if (isset($_POST['id_barang'])){

$barang = read_barang_byId($id_barang);

	$sama = false;
	foreach ($_SESSION['list'] as $key=>$item) {
	if ($item['id'] == $_POST['id_barang']){
		$_SESSION['list'][$key]['jumlah'] += $jumlah;

		$sama = true;
	}
}

if (!$sama){
	$item = array(
		'id' => $barang['ID_BARANG'],
		'nama' => $barang['NM_BARANG'].'-'.$barang['WARNA'].'-'.$barang['UKURAN'],
		'harga_jual' => $barang['HARGA_JUAL'],
		'harga_beli' => $barang['HARGA_BELI'],
		'jumlah' => $jumlah,
		'subtotal' => $barang['HARGA_JUAL']*$jumlah
		);



	$_SESSION['list'][] =  $item;
}


header('Location: ' . $_SERVER['PHP_SELF']);
}

else if (isset($_GET['Delete'])){
unset($_SESSION['list'][$_GET['Delete']]);
header('Location: ' . $_SERVER['PHP_SELF']);

}
?>
