<?php

	// mulai session
	require "../session_start.php";

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil id pesanan yg ada diURL
	$idPesanan = $_GET["id"];
	// ambil id member dari session member yg login
	$idMember  		= $_SESSION["member"]["id_member"];
	// ambil data pesanan sesuai id pesanan yg dikirim di URL
	$sqlPesanan 	= "SELECT * FROM tbl_pesanan WHERE id_pesanan = '$idPesanan' ";
	$ambilPesanan 	= $conn->query($sqlPesanan);
	$pecahPesanan 	= $ambilPesanan->fetch_assoc();
	// cek apakah pesanan yg dihapus sesuai/milik member yg login
	if($pecahPesanan["id_member"] != $idMember) {

		header("Location: ../../../index.php?halaman=riwayat_pesanan");
		exit();

	}
	else {

		// hapus pesanan sesuai dengan id pesanan yg dikirimkan
		$sqlHapusPesanan = "DELETE FROM tbl_pesanan WHERE id_pesanan = '$idPesanan' ";
		$statusHapusPesanan = $conn->query($sqlHapusPesanan);

		// cek statusnya
		if($statusHapusPesanan == 1) {
			echo "sukses membatalkan pesanan";
			exit();
		}
		else {
			echo "gagal membatalkan pesanan";
			exit();
		}

	}

?>