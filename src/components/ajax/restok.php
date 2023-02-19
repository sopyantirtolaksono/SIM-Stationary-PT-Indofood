<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// jika jumlah barang datang sudah dikirim
	if(isset($_POST["barang_datang"])) {
		$barangDatang 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["barang_datang"]));
		$idBarang 		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["id_barang"]));

		// ambil semua data barang dari tabel barang
	  	$sqlDataBarang = "SELECT * FROM tbl_barang WHERE id_barang = '$idBarang' ";
	  	$ambilBarang  = $conn->query($sqlDataBarang);
	  	$statusBarang = $ambilBarang->num_rows;

	  	// cek status barang ada atau tidak
	  	if($statusBarang == 1) {
	  		// pecah barang menjadi array
	  		$pecahBarang  = $ambilBarang->fetch_assoc();
	  		// tambahkan stok akhir dengan jumlah barang datang
	  		$stokAkhir	  = $pecahBarang["stok_akhir"] + $barangDatang;
	  		// update stok akhir, stok awal, jumlah barang datang
	  		$sqlReStok = "UPDATE tbl_barang SET barang_datang = '$barangDatang', stok_awal = '$stokAkhir', stok_akhir = '$stokAkhir' WHERE id_barang = '$idBarang' ";
	  		$statusReStok = $conn->query($sqlReStok);
	  		// cek jika berhasil restok barang
	  		if($statusReStok == 1) {
	  			echo "sukses restok";
	  			exit();
	  		}
	  		else {
	  			echo "gagal restok";
	  			exit();
	  		}
	  	}
	  	else {
	  		echo "barang tidak ada";
	  		exit();
	  	}
	  	
	}

?>