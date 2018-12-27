<?php
ob_start();
include "header.php";
include "../function/barang.php";


/*
if(!isset($_SESSION['list_order'])){
	$_SESSION['list_order'][] = 0;
	unset ($_SESSION['list_order'][0]);
	}
*/

?>

<div class="w3-container w3-padding-32" style="margin-top:55px; height:500px">
  <?php if (isset($_SESSION['status_insert'])) { ?>
          <div class="w3-panel w3-blue">
            <p>
              <span onclick="this.parentElement.style.display='none'" class="w3-closebtn w3-margin-right w3-medium">x</span>
              <?php
                echo $_SESSION['status_insert'];
                unset($_SESSION['status_insert']);
              ?>
            </p>
          </div>
  <?php } ?>
  <div class="w3-bar" style="margin-bottom:18px">
  	<a href="keranjang.php">
  		<button class="w3-button <?php if (basename($_SERVER['PHP_SELF']) == 'keranjang.php') echo 'w3-red'; else echo 'w3-light-gray'; ?>" style="border:0px; padding:6px">keranjang belanjaan</button>
  	</a>
  	<a href="keranjang_order.php">
  		<button class="w3-button <?php if (basename($_SERVER['PHP_SELF']) == 'keranjang_order.php') echo 'w3-red'; else echo 'w3-light-gray'; ?>" style="border:0px; padding:6px">keranjang order</button>
  	</a>
  </div>
  <div class="w3-container w3-card w3-white" style="margin-bottom:25px">
    <h3 class="w3-border-bottom w3-border-black w3-padding-12">Keranjang order</h3>
		<?php	if(!isset($_SESSION['list_order'])){	?>
			<div class="w3-panel">
				<p style="margin-bottom:300px">
					<?php echo "keranjang kosong, anda belum memilih barang";	?>
				</p>
			</div>
		</div>
		<?php	}else { ?>
    <div class="w3-panel w3-round-medium w3-padding-12 w3-yellow">
      jika sudah tidak ada barang tambahan yang akan di pesan, silahkan tekan button proses.
      Kami akan mengupayakan ketersediaan barang anda dalam beberapa hari kedepan. Silahkan cek halaman
      transaksi > status transaksi > status order, dan masukkan nomor order yang anda dapatkan setelah
      menekan button proses untuk mengetahui informasi terbaru pesanan anda(pastikan nomor order anda simpan).
      <span class="w3-red" style="padding:2px">Pembayaran dilakukan setelah barang tersedia.</span>
    </div>
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
      foreach($_SESSION['list_order'] as $no => $daftar){?>
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

      $_SESSION['total_order'] = $total;
      ?>

    </table>

    <div style="font-size:20px"><b>Total <?php echo "Rp. ".number_format($total, 2, ",", "."); ?></b></div>
    <div style="font-size:14px"><span class="w3-text-red">* </span>belum termasuk ongkir</div>
    <p class="w3-center">
      <a href="index.php"><button class="w3-btn w3-medium" type="button">< kembali berbelanja</button></a>
      <a href="insert_order.php">
				<?php if((count($_SESSION['list_order']) == 0)){ ?>
				<button class="w3-btn w3-medium w3-green" type="button" disabled>proses</button>
				<?php }else { ?>
				<button class="w3-btn w3-medium w3-green" type="button">proses</button>
				<?php }	?>
			</a>
    </p>
  </div>
	<?php }	?>
</body>
<?php
include "footer.php";

//@$tgl_pesan = date('Y-m-d');
@$id_barang = $_POST['id_barang'];
@$jumlah = $_POST['jumlah_order'];

if (isset($_POST['id_barang'])){
	$barang = read_barang_byId($id_barang);

		$sama = false;
		foreach ($_SESSION['list_order'] as $key=>$item) {
		if ($item['id'] == $_POST['id_barang']){
			$_SESSION['list_order'][$key]['jumlah'] += $jumlah;

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



		$_SESSION['list_order'][] =  $item;
	}


	header('Location: ' . $_SERVER['PHP_SELF']);
	}

	else if (isset($_GET['Delete'])){
	unset($_SESSION['list_order'][$_GET['Delete']]);
	header('Location: ' . $_SERVER['PHP_SELF']);

}
?>
