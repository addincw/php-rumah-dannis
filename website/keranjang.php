<?php
ob_start();
include "header.php";
include "../function/barang.php";


/*
if(!isset($_SESSION['list'])){
	$_SESSION['list'][] = 0;
	unset ($_SESSION['list'][0]);
	}
*/

?>

<div class="w3-container w3-padding-32" style="margin-top:55px; height:500px">
<!--
<div class="w3-row">
<a href="keranjang.php">
<div class="w3-col l2 tablink w3-bottombar w3-hover-light-grey w3-padding">Keranjang belanjaan</div>
</a>
<a href="keranjang_order.php">
<div class="w3-col l2 tablink w3-bottombar w3-hover-light-grey w3-padding">Keranjang order</div>
</a>
</div>
-->

<div class="w3-bar" style="margin-bottom:18px">
	<a href="keranjang.php">
		<button class="w3-button <?php if (basename($_SERVER['PHP_SELF']) == 'keranjang.php') echo 'w3-red'; else echo 'w3-light-gray'; ?>" style="border:0px; padding:6px">keranjang belanjaan</button>
	</a>
	<a href="keranjang_order.php">
		<button class="w3-button <?php if (basename($_SERVER['PHP_SELF']) == 'keranjang_order.php') echo 'w3-red'; else echo 'w3-light-gray'; ?>" style="border:0px; padding:6px">keranjang order</button>
	</a>
</div>

	<div class="w3-container w3-card w3-white">
    <h3 class="w3-border-bottom w3-border-black w3-padding-12">Keranjang belanjaan</h3>
		<?php	if(!isset($_SESSION['list'])){	?>
			<div class="w3-panel">
				<p style="margin-bottom:300px">
					<?php echo "keranjang kosong, anda belum memilih barang";	?>
				</p>
			</div>
		</div>
		<?php	}else { ?>
			<div class="w3-responsive">
				<table class="w3-table-all w3-card-2" style="margin-bottom:20px">
					<tr class="w3-green">
						<th>Product</th>
						<th>Harga</th>
						<th>Disc</th>
						<th>Jumlah</th>
						<th>total berat barang</th>
						<th>Sub total</th>
						<th>Kontrol</th>
					</tr>

					<?php
					$total = 0;
					$berat = 0;
					foreach($_SESSION['list'] as $no => $daftar){?>
						<tr>
							<td><?php echo $daftar['nama'];?></td>
							<td><?php echo "Rp. ".number_format($daftar['harga_jual'], 2, ",", ".");?></td>
							<td> - </td>
							<td><?php echo $daftar['jumlah'];?></td>
							<td><?php echo $daftar['berat'].' gram';?></td>
							<td><?php echo "Rp. ".number_format($daftar['subtotal'], 2, ",", ".");
									?>
							</td>
							<td><a href="?Delete=<?php echo $no; ?>"><button type="submit" class="w3-btn w3-orange w3-text-white">batal</button></a></td>
						</tr>
					<?php
					$total=$total+$daftar['subtotal'];
					$berat=$berat+$daftar['berat'];
					}

					$_SESSION['total'] = $total;
					$_SESSION['berat'] = $berat;
					?>

				</table>
			</div>


    <div style="font-size:20px"><b>Total <?php echo "Rp. ".number_format($total, 2, ",", "."); ?></b></div>
    <div style="font-size:14px"><span class="w3-text-red">* </span>belum termasuk ongkir</div>
    <p class="w3-center">
      <a href="index.php"><button class="w3-btn w3-medium" type="button">< kembali berbelanja</button></a>
      <a href="pengiriman.php">
				<?php if((count($_SESSION['list']) == 0)){ ?>
				<button class="w3-btn w3-medium w3-green" type="button" disabled>proses</button>
				<?php }else { ?>
				<button class="w3-btn w3-medium w3-green" type="button">proses</button>
				<?php }	?>
			</a>
    </p>
  </div>
	<?php }	?>
</div>
</body>
<?php
include "footer.php";

//@$tgl_pesan = date('Y-m-d');
@$id_barang = $_POST['id_barang'];
@$jumlah = $_POST['jumlah'];

if (isset($_POST['id_barang'])){
	$barang = read_barang_byId($id_barang);
	//$berat_barang = $barang['BERAT_BARANG']*$jumlah;

		$sama = false;
		foreach ($_SESSION['list'] as $key=>$item) {
		if ($item['id'] == $_POST['id_barang']){
			$_SESSION['list'][$key]['jumlah'] = $_SESSION['list'][$key]['jumlah'] + $jumlah;
			$_SESSION['list'][$key]['subtotal'] = $_SESSION['list'][$key]['subtotal'] + ($barang['HARGA_JUAL']*$jumlah);
			$_SESSION['list'][$key]['berat'] = $_SESSION['list'][$key]['berat'] + ($barang['BERAT_BARANG']*$jumlah);

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
			'berat'	=> $barang['BERAT_BARANG']*$jumlah,
      'subtotal' => $barang['HARGA_JUAL']*$jumlah
			);



		$_SESSION['list'][] =  $item;
	}


	header('Location: ' . $_SERVER['PHP_SELF']);
	}else if (isset($_GET['Delete'])){
	unset($_SESSION['list'][$_GET['Delete']]);
	header('Location: ' . $_SERVER['PHP_SELF']);
	}
?>
