<?php
include '../function/ATM.php';
?>
  <link rel="stylesheet" href="../w3.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
      <table class="w3-table-all w3-card-2">
          <tr class="w3-green">
            <th>Id</th>
            <th>Nama</th>
            <th>No Rekening</th>
						<th>Kontrol</th>
          </tr>
          <?php
          $query = read_allATM();
          while($array = mysql_fetch_array($query)){
          ?>
          <tr>
          <td><?php echo "$array[0] "?></td>
          <td><?php echo "$array[1] "?></td>
          <td><?php echo "$array[2] "?></td>
				  <td><a href=""><button type="submit" class="w3-btn w3-orange w3-text-white">edit</button></a></td>
          </tr>
          <?php
            }
          ?>
      </table>
