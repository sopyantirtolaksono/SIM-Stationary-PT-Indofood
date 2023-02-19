<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil id member pada URL
	$idMember = $_GET["id"];

	// jika sudah mengirimkan data
	if(isset($idMember)) {
		// update status verifikasi member pada tabel member
		$sqlMember = "UPDATE tbl_member SET verifikasi = 'sudah' WHERE id_member = '$idMember' ";
		$status = $conn->query($sqlMember);

		// cek statusnya
		if($status == 1) {
			echo "terverifikasi";
			exit();
		}
		else {
			echo "gagal verifikasi";
			exit();
		}
	}

?>