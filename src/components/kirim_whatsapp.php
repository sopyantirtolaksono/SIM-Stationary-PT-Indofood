<?php

	// mulai session
	require "session_start.php";

	// koneksi ke database
	require "../connection/koneksi_database.php";

	// ambil data pesanan diURL
	$val 		= $_GET["val"];
	$value 		= explode("_", $val);
	$idBarang 	= $value[0];
	$jumlah 	= $value[1];
	$keterangan = $value[2];

	// ambil barang dari tabel barang, sesuai id barang yg dikirim
	$sqlBarang = "SELECT * FROM tbl_barang WHERE id_barang = '$idBarang' ";
	$ambilBarang = $conn->query($sqlBarang);
	$pecahBarang = $ambilBarang->fetch_assoc();
	$namaBarang  = $pecahBarang["nama_barang"];

	// ambil data member yang melakukan pesanan
	$idMember 		= $_SESSION["member"]["id_member"];
	$sqlMember 		= "SELECT * FROM tbl_member JOIN tbl_departement ON tbl_member.id_departement = tbl_departement.id_departement WHERE tbl_member.id_member = '$idMember' ";
	$ambilMember 	= $conn->query($sqlMember);
	$pecahMember 	= $ambilMember->fetch_assoc();

	// ambil nama member dan nama departementnya
	$namaMember 	= $pecahMember["nama_lengkap"];
	$departement 	= $pecahMember["kode_nama"];

	// mengirim pesanan via whatsapp
	header("Location: https://api.whatsapp.com/send?phone=62895391089934&text=[Dari:%20$namaMember,%20Departement:%20$departement]%20~%20Nama%20Barang:%20($namaBarang),%20Jumlah:%20($jumlah),%20Keterangan:%20($keterangan)");

?>