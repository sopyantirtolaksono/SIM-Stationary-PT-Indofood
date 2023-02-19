<?php

  	// koneksi ke database
  	require "../../connection/koneksi_database.php";

  	// ambil id barang diURL
  	$idBarang = $_GET["id"];

  	// ambil data barang pada tabel barang sesuai id barang yang dikirim
  	$dataBarang  = "SELECT * FROM tbl_barang WHERE id_barang = '$idBarang' ";
  	$ambilBarang = $conn->query($dataBarang);
  	$pecahBarang = $ambilBarang->fetch_assoc();

?>

<div class="row">
	<div class="col-md-4">
      	<div class="form-group">
        	<label for="">Barang Datang(Lama)</label>
        	<input type="number" class="form-control" value="<?=$pecahBarang['barang_datang']; ?>" placeholder="Barang Datang" disabled>
      	</div>
    </div>
    <div class="col-md-4">
      	<div class="form-group">
        	<label for="">Stok Awal</label>
        	<input type="number" class="form-control" value="<?=$pecahBarang['stok_awal']; ?>" placeholder="Stok Awal" disabled>
      	</div>
    </div>
    <div class="col-md-4">
      	<div class="form-group">
        	<label for="">Stok Akhir</label>
        	<input type="number" class="form-control" value="<?=$pecahBarang['stok_akhir']; ?>" placeholder="Stok Akhir" disabled>
      	</div>
    </div>
</div>