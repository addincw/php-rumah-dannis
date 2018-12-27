<table class="w3-table-all w3-card-2" style="margin-bottom:20px">
  <tr class="w3-green">
    <th>Product</th>
    <th>Harga</th>
    <th>Disc</th>
    <th>Jumlah</th>
    <th>Sub total</th>
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
  <?php
  }
  ?>

</table>
