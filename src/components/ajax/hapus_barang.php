<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil id barang diURL
	$idBarang = $_GET["id"];

	// hapus data barang ditabel barang sesuai dengan id yang dikirim
	$hapusBarang = "DELETE FROM tbl_barang WHERE id_barang = '$idBarang' ";
	$status = $conn->query($hapusBarang);

	// cek status
	if($status == 1) {
		echo "sukses menghapus data";
		exit();
	}
	else {
		echo "gagal menghapus data";
		exit();
	}

?>