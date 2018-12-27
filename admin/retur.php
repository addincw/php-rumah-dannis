<?php session_start(); ?>

		<!-- Top navbar -->
		<?php
		include 'top-navbar.php';
		if(!isset($_SESSION['ID_KAR'])){
				$_SESSION['status'] = 'anda belum melakukan login';
				header('location:index.php');
			}
		?>
		<body class="w3-light-grey">

		<!-- Sidenav/menu -->
		<?php include 'side-navbar.php'; ?>
		<div class="w3-main w3-container" style="margin-left:200px; padding-top:75px">
			<?php
				if (isset($_SESSION['status_insert'])) {
			?>
				<div class="w3-container w3-panel w3-blue w3-padding-12">
					<?php
						echo $_SESSION['status_insert'];
						unset($_SESSION['status_insert']);
					?>
				</div>
			<?php
				}
			?>
			<div class="w3-panel w3-card-2 w3-white" style="margin-top:20px;">
        <div>
          <h3 class="w3-border-bottom w3-border-black w3-padding-12">FORM RETUR</h3>

          <form method="post" action="insert_retur.php"  enctype="multipart/form-data">
            <p>
              masukkan nomor pembelian yang ada pada nota.
            </p>

            <p>
              <label>No pembelian </label>
              <input id="nomorbeli" name="nomor_pembelian" class="w3-input w3-border w3-round" required></input>
            </p>

            <div id="daftar_barang">
            </div>


            <p>
							<button class="w3-btn w3-medium w3-green" type="submit" style="width:100%">Proses retur <i class="fa fa-arrow-right"></i></button>
            </p>
          </form>
         </div>
			</div>

		</div>
	</body>
  <script>
    $("#nomorbeli").keyup(function(){
      var id = $("#nomorbeli").val();

			$.get("detail_retur.php",
	            {
	              id_beli : id
	            },
	            function(data,status){
	              $('#daftar_barang').html(data);
	              //alert(kota);
	            });
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
</html>
