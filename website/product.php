<?php
include "header.php";
include "../function/barang.php";
include "../function/kategori.php";
?>
<div class="w3-container">
  <div class="w3-container w3-card w3-white" style="margin-top:90px; margin-bottom:15px" id="about">
    <h3 class="w3-border-bottom w3-border-black w3-padding-12">Semua product</h3>
    <div class="w3-row" style="margin-bottom:25px">
      <div class="w3-left">
        <label>filter by <?php if(!empty($_POST['fkategori']) && $_POST['fkategori'] != 'all'){ $obj = json_decode($_POST['fkategori']); echo 'kategori : '.$obj->value_name; } ?> <?php if(!empty($_POST['fwarna']) && $_POST['fwarna'] != 'all'){ $obj = json_decode($_POST['fwarna']); echo 'warna : '.$obj->value; } ?> <?php if(!empty($_POST['fukuran']) && $_POST['fukuran'] != 'all'){ $obj = json_decode($_POST['fukuran']); echo 'ukuran : '.$obj->value; } ?> </label>
      </div>
      <div class="w3-right">
        <form>
          <label>items per page: </label>
          <select class="peritem">
            <option>8</option>
            <option>12</option>
          </select>
        </form>
      </div>
    </div>
    <div class="w3-row">
      <div class="w3-col l2">
        <div class="w3-card w3-container" style="margin-bottom:55px; padding-bottom:15px">
          <h4 class="w3-bottombar w3-border-red w3-padding-12" style="margin-top:0px"><b>filter product</b></h4>
          <form class="" action="" method="post">
            <label>Kategori </label>
            <select id="kategori" class="w3-input w3-border w3-round w3-small" name="fkategori">
              <option value="all">semua kategori</option>
              <?php
              $sql = read_kategori();
              while ($kategori = mysqli_fetch_array($sql)) {
              ?>
              <option value='{"name":"ID_KATEGORI","value":"<?php echo $kategori['ID_KATEGORI']; ?>", "value_name":"<?php echo $kategori['NAMA_KATEGORI']; ?>"}'><?php echo $kategori['NAMA_KATEGORI']; ?></option>
              <?php
              }
              ?>
            </select>
            <br>
            <label>Warna </label>
            <select id="warna" class="w3-input w3-border w3-round w3-small" name="fwarna">
              <option value="all">semua warna</option>
              <option value='{"name":"WARNA","value":"merah"}'>merah</option>
              <option value='{"name":"WARNA","value":"kuning"}'>kuning</option>
              <option value='{"name":"WARNA","value":"hijau"}'>hijau</option>
              <option value='{"name":"WARNA","value":"biru"}'>biru</option>
              <option value='{"name":"WARNA","value":"ungu"}'>ungu</option>
              <option value='{"name":"WARNA","value":"merah muda"}'>merah muda</option>
              <option value='{"name":"WARNA","value":"orange"}'>orange</option>
              <option value='{"name":"WARNA","value":"tosca"}'>tosca</option>
              <option value='{"name":"WARNA","value":"merah maroon"}'>merah maroon</option>
            </select>
            <br>
            <label>Ukuran </label>
            <select id="ukuran" class="w3-input w3-border w3-round w3-small" name="fukuran">
              <option value="all">semua ukuran</option>
              <option value='{"name":"UKURAN","value":"s"}'>S</option>
              <option value='{"name":"UKURAN","value":"m"}'>M</option>
              <option value='{"name":"UKURAN","value":"l"}'>L</option>
              <option value='{"name":"UKURAN","value":"xl"}'>XL</option>
              <option value='{"name":"UKURAN","value":"xxl"}'>XXL</option>
            </select>
            <br>
            <button name="filter" value="filter" class="w3-btn w3-medium w3-red" type="submit" style="width:100%">filter <i class="fa fa-arrow-right"></i></button>
          </form>
        </div>
      </div>

      <div class="w3-col l10 w3-container">
        <div class="w3-row-padding w3-card" style="padding-top:10px">
          <div id="itemContainer">
            <?php
              $sql = read_barang();

              if ((!empty($_REQUEST['filter']))) {
                $filter = array();

                if ((isset($_REQUEST['fkategori'])) && ($_REQUEST['fkategori'] != 'all')) {
                  $filter[] = $_REQUEST['fkategori'];
                }

                if ((isset($_REQUEST['fukuran'])) && ($_REQUEST['fukuran'] != 'all')) {
                  $filter[] = $_REQUEST['ukuran'];
                }

                if ((isset($_REQUEST['fwarna'])) && ($_REQUEST['fwarna'] != 'all')) {
                  $filter[] = $_REQUEST['fwarna'];
                }
                // print_r($filter);
                // die();
                $sql = read_filterbarang($filter);
              }

            $rows = array ();
            while ($row = mysqli_fetch_array($sql)) {
              $rows[] = $row;
            }

            $products = (array_chunk($rows,4));
            foreach($products as $all){
              ?>
              <div class="w3-row">
                <?php
                foreach ($all as $product) {
                  // print_r($product['STOK_BARANG']);
                  // die();
                ?>
                <div class="w3-col l3 m6 w3-margin-bottom w3-container">
                  <div class="w3-display-container w3-card">
                    <?php if ($product['STOK_BARANG'] <= 0) { ?>
                      <div class="w3-display-topleft w3-black w3-padding">Stok kosong</div>
                    <?php } ?>
                    <img src="../asset/<?php echo $product['GAMBAR1']?>.jpg" alt="GAMBAR1" style="height:230px; width:100%">
                    <div style="padding-left:2%">
                      <h3>
                        <?php
                        $nama = $product['NM_BARANG'].'-'.$product['WARNA'].'-'.$product['UKURAN'];
                        if (strlen($nama) > 15 ) {
                          echo substr($nama,0,15).'...';
                        }else {
                          echo $nama;
                        }
                        ?>
                      </h3>
                      <p class="w3-opacity"><?php echo "Rp. ".number_format($product['HARGA_JUAL'], 2, ",", "."); ?></p>
                    </div>
                    <a href="detail_barang.php?id_barang=<?php echo $product['ID_BARANG']?>"><button class="w3-btn-block w3-red">Lihat</button></a>
                  </div>
                </div>
                <?php
                }
                 ?>
              </div>
              <?php
              }
              ?>
          </div>
        </div>
        <hr>
        <div class="holder w3-center">
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
</body>
<script>
  $(function() {
    /* initiate plugin */
    $("div.holder").jPages({
        containerID : "itemContainer",
        perPage : 2
    });
    /* on select change */
    $("select.peritem").change(function(){
        /* get new nº of items per page */
      var newPerPage = parseInt( $(this).val() );
      /* destroy jPages and initiate plugin again */
      $("div.holder").jPages("destroy").jPages({
            containerID   : "itemContainer",
            perPage       : newPerPage
        });
    });
  });
</script>
</html>
