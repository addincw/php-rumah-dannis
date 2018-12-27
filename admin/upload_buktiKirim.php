<?php
session_start();
include '../function/pengiriman_pembayaran.php';
include '../function/penjualan.php';
include '../function/konsumen.php';
?>

  <?php
    include 'top-navbar.php';
    include 'side-navbar.php';
  ?>
	<body class="w3-light-grey">
  <div class="w3-main w3-container" style="padding-top:75px; margin-left:200px;">
    <?php
    if(isset($_SESSION['status_upload'])){
    ?>
    <div class="w3-panel w3-card-4 w3-blue" style="padding-top:5px; padding-bottom:5px">
        <span onclick="this.parentElement.style.display='none'" class="w3-closebtn w3-margin-right w3-medium">x</span>
        <?php
          echo $_SESSION['status_upload'];
          unset($_SESSION['status_upload']);
        ?>
    </div>
    <?php
    }
    ?>

    <div class="w3-container w3-card-2 w3-white" style="margin-top:20px">
      <h3 class="w3-border-bottom w3-border-black w3-padding-12">FORM UPLOAD RESI PENGIRIMAN</h3>
      <div class="w3-row">
        <div class="w3-col m5">
          <form method="post" action="insert_resi_pengiriman.php">
            <p>
              masukkan nomor pembelian dari pengiriman yang bersangkutan.
            </p>

            <p>
    					<label>No pembelian </label>
              <input id="id_beli" name="nomor_pembelian" class="nomorpembelian w3-input w3-border w3-round" required></input>
    				</p>

            <p>
    					<label>Jasa Pengiriman </label>
              <input id="jasa_pengiriman" name="jasa_pengiriman" class="w3-input w3-border w3-round" required readonly></input>
    				</p>

            <p>
              <label>Nomor resi pengiriman </label>
              <input name="nomor_resi" class="w3-input w3-border w3-round" required></input>
            </p>

            <p>
              <button class="w3-btn w3-medium w3-green" type="submit" style="width:100%">upload resi <i class="fa fa-arrow-right"></i></button>
            </p>
          </form>
         </div>


       <div class="w3-container w3-col m7">

           <div class="w3-panel w3-blue">
             <p>LIST PEMBELIAN MENUNGGU RESI PENGIRIMAN</p>
           </div>

					 <div class="w3-responsive">
						 <table class="w3-table-all w3-card-2" style="margin-bottom:20px">
							 <tr class="w3-green">
								 <th>Tanggal pembayaran</th>
								 <th>nomor pembelian</th>
								 <th>pengiriman</th>
							 </tr>

							 <?php
							 $query = get_pengiriman(1);
							 while($pengiriman = mysql_fetch_array($query)){
								 $pembayaran = get_pembayaranby_id($pengiriman['ID_PEMBAYARAN']);
								 $penjualan = get_penjualanby_id($pembayaran['ID_JUAL']);
								 $konsumen = read_Konsumenby_id($penjualan['ID_KONS']);
								 ?>

								 <tr>
									 <td><?php echo $pembayaran['TGL_PEMBAYARAN'];?></td>
									 <td>
                     <a href="#" class="idbeli" data-value="<?php echo $pembayaran['ID_JUAL'];?>">
                       <?php echo $pembayaran['ID_JUAL'];?>
                     </a>
                     <a href="nota.php?id_jual=<?php echo $pembayaran['ID_JUAL'];?>" >
                       <button type="button" name="button" class="w3-btn w3-btn-small w3-green">lihat nota</button>
                     </a>
                   </td>
									 <td>
										 <button id="lihat_detail" class="w3-btn w3-btn-small" onclick="document.getElementById('<?php echo "detail".$pengiriman['ID_KIRIM'];?>').style.display='block'">Lihat detail</button>
										 <span id="detail<?php echo $pengiriman['ID_KIRIM']; ?>" style="display:none">
											 <button class="w3-btn w3-btn-small w3-red close w3-right" onclick="document.getElementById('<?php echo "detail".$pengiriman['ID_KIRIM'];?>').style.display='none'">X</button><br>
											 <b>jasa pengiriman :</b><br>
											 <?php echo $pengiriman['JASA_KIRIM'];?></br>
											 <hr>
											 <b>alamat :</b><br>
											 <?php echo $pengiriman['ALAMAT_KIRIM'];?>
											 <hr>
											 <b>data pembeli :</b><br>
											 <?php echo $konsumen['NM_KONS'];?></br>
											 <?php echo "Telp: ".$konsumen['TELP_KONS'];?></br>
											 <?php echo "Email: ".$konsumen['EMAIL_KONS'];?>
										 </span>
									 </td>
								 </tr>
								 <?php
							 }
							 ?>
						 </table>
					 </div>

        </div>
     </div>

    </div>
  </div>
</body>

<script>
$('.idbeli').click(function(){
  var id = $(this).data('value');
  $('.nomorpembelian').val(id);
  if (($('#id_beli').val().length != 0)){
    var nomor_pembelian = $("#id_beli").val();
    $.post("get_kurir.php",
    {
      id_jual : nomor_pembelian
    },
    function(data,status){
      $('#jasa_pengiriman').val(data);
      //alert(kota);
    });
  }
});

	$("#close").click(function(){
	//alert('berhasil');
		$("#mySidenav").hide();
	});

	$("#menu").click(function(){
	//alert('berhasil');
		$("#mySidenav").toggle();
	});

	$(".list").click(function(){
		var target = $(this).data("name");
		//alert($(this).data("name"));
		$("."+target).toggle();
	});
</script>
