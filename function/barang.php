<?php
	require_once "koneksi.php";

  function read_for_thumbnail(){
    $query=mysqli_query(conn(), "SELECT * FROM barang ORDER BY ID_BARANG LIMIT 4");
    return $query;
  }

	function read_barang_byId($id){
		$query=mysqli_query(conn(), "SELECT * FROM barang WHERE ID_BARANG = '$id'");
		$hasil = mysqli_fetch_array($query);
		return $hasil;
	}

	function read_barang(){
		$query = mysqli_query(conn(), "select * from barang");
		return $query;
	}

	function update_stok_barang($jumlah, $id_barang){
		$query = mysqli_query(conn(), "UPDATE `barang` SET `STOK_BARANG` = $jumlah WHERE `barang`.`ID_BARANG` = '$id_barang'");
		return $query;
	}

	function read_filterbarang($filter = array()){
		$text = "select * from barang where ";
		$where = "";
		for ($i=0; $i < count($filter); $i++) {
			$obj = json_decode($filter[$i]);
			$filter_name = $obj->name;
			$filter_value = $obj->value;

			if ($i != (count($filter) - 1)) {
				$where .= $filter_name."='".$filter_value."' and ";
			}else {
				$where .= $filter_name."='".$filter_value."'";
			}
		}

		$sql = $text.$where;
		$query = mysqli_query(conn(), $sql);
		return $query;
	}
?>
