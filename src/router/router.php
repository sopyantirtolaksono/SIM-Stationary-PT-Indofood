<?php

	if(isset($_GET["halaman"])) {
		if($_GET["halaman"] == "dashboard") {
			require "src/views/dashboard.php";
		}
		else if($_GET["halaman"] == "data_barang") {
			require "src/views/data_barang.php";
		}
		else if($_GET["halaman"] == "tambah_barang") {
			require "src/views/tambah_barang.php";
		}
		else if($_GET["halaman"] == "update_barang") {
			require "src/views/update_barang.php";
		}
		else if($_GET["halaman"] == "restok_barang") {
			require "src/views/restok_barang.php";
		}
		else if($_GET["halaman"] == "penggunaan_barang") {
			require "src/views/penggunaan_barang.php";
		}
		else if($_GET["halaman"] == "kelola_pesanan") {
			require "src/views/kelola_pesanan.php";
		}
		else if($_GET["halaman"] == "stationary") {
			require "src/views/stationary.php";
		}
		else if($_GET["halaman"] == "profil_admin") {
			require "src/views/profil_admin.php";
		}
		else if($_GET["halaman"] == "daftar_member") {
			require "src/views/daftar_member.php";
		}
		else if($_GET["halaman"] == "detail_member") {
			require "src/views/detail_member.php";
		}
		else if($_GET["halaman"] == "profil") {
			require "src/views/profil.php";
		}
		else if($_GET["halaman"] == "riwayat_pesanan") {
			require "src/views/riwayat_pesanan.php";
		}
		else {
			require "src/views/404.php";
		}
	}
	else {
		echo "<script>location='index.php?halaman=dashboard';</script>";
	}
