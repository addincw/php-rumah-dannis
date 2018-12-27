<?php
include "header.php";
require "../function/barang.php";
require "../function/kategori.php";
?>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px; margin-top:76px" id="home">
  <img class="w3-image" src="../asset/rumah_dannis.png" alt="Architecture" width="1500" height="600">
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Project Section -->
  <div class="w3-container w3-row" id="projects">
    <div class="w3-col l4 m6">
      <h3><i class="fa fa-caret-right w3-text-red" aria-hidden="true"></i>  <b>Lihat berdasarkan kategori</b></h3>
    </div>

    <div class="w3-col l8 m6">
      <div class="w3-red" style="height:5px; margin-top:28px; margin-bottom:10px">
      </div>
    </div>
  </div>

  <div id="kategori" class="owl-carousel owl-theme" style="margin-bottom:5px">
    <?php
    $sql = read_kategori();
    $color = array('w3-red','w3-orange','w3-green','w3-red');
    $n = 0;
    while($kategori = mysqli_fetch_array($sql)){
      ?>
      <div class="w3-container w3-padding-32">
        <form class="" action="product.php" method="post">
          <input type="hidden" name="fkategori" value='{"name":"ID_KATEGORI","value":"<?php echo $kategori['ID_KATEGORI']; ?>", "value_name":"<?php echo $kategori['NAMA_KATEGORI']; ?>"}'>
          <input type="hidden" name="filter" value='filter'>
          <div class="item w3-container <?php echo $warna = $color[array_rand($color)]; ?> w3-center w3-round-large w3-padding-64" style="font-size:18px">
            <button class="w3-btn <?php echo $warna; ?>" type="submit" name="button">
              <b><?php echo strtoupper($kategori['NAMA_KATEGORI']); ?></b>
            </button>
          </div>
        </form>
      </div>
      <?php
      $n++;
    }
    ?>
  </div>

  <!-- About Section -->
  <div class="w3-container w3-card w3-white" style="margin-top:15px" id="about">
    <h3 class="w3-border-bottom w3-border-black w3-padding-12">Semua product</h3>
    <div class="w3-row-padding">
      <?php
        $sql = read_for_thumbnail();
        while($row = mysqli_fetch_array($sql)){
      ?>
      <div class="w3-col l3 m6 w3-margin-bottom">
        <div class="w3-display-container w3-card">
          <?php if ($row['STOK_BARANG'] <= 0) { ?>
            <div class="w3-display-topleft w3-black w3-padding">Stok kosong</div>
            <?php } ?>
            <img src="../asset/<?php echo $row['GAMBAR1']?>.jpg" alt="John" style="height:230px; width:100%">
            <div style="padding-left:2%">
              <h3><?php echo $row['NM_BARANG'].'-'.$row['WARNA'].'-'.$row['UKURAN']; ?></h3>
              <p class="w3-opacity"><?php echo "Rp. ".number_format($row['HARGA_JUAL'], 2, ",", "."); ?></p>
            </div>
            <a href="detail_barang.php?id_barang=<?php echo $row['ID_BARANG']?>"><button class="w3-btn-block w3-red">Lihat</button></a>
        </div>
      </div>
      <?php
        }
      ?>
    </div>
    <hr>
    <p class=" w3-right">
      <a href="product.php"><button class="w3-btn w3-green">lihat lebih banyak ></button></a>
    </p>
  </div>
</div>

<?php include "footer.php"; ?>
</body>
<script>
  $(document).ready(function(){
    $("#kategori").owlCarousel({
      items : 4
    });

     $("#kategori").trigger('owl.play',5000);
  })
</script>
</html>
