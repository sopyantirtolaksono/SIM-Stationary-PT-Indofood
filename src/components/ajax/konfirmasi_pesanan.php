<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil id pesanan diURL
	$idPesanan = $_GET["id"];

	// menggabungkan 3 tabel(pesanan,member,barang) dan mengambil semua datanya berdasarkan id pesanan yg dikirim
	$sqlJoinTabel = "SELECT * FROM tbl_pesanan JOIN tbl_member ON tbl_pesanan.id_member = tbl_member.id_member JOIN tbl_departement ON tbl_member.id_departement = tbl_departement.id_departement JOIN tbl_barang ON tbl_pesanan.id_barang = tbl_barang.id_barang WHERE tbl_pesanan.id_pesanan = '$idPesanan' ";
	$ambilData  = $conn->query($sqlJoinTabel);
	$statusData = $ambilData->num_rows;

	// cek statusnya
	if($statusData == 1) {
		// ambil datanya menjadi assosiatif array
		$pecahData = $ambilData->fetch_assoc();

		// ambil datanya satu-satu
		$idpesanan 		= $pecahData["id_pesanan"];
		$idMember 		= $pecahData["id_member"];
		$idBarang 		= $pecahData["id_barang"];
		$idDept 		= $pecahData["id_departement"];
		$kodeBarang 	= $pecahData["kode_barang"];
		$namaBarang 	= $pecahData["nama_barang"];
		$satuanBarang 	= $pecahData["satuan_barang"];
		$barangDatang 	= $pecahData["barang_datang"];
		$stokAwal 		= $pecahData["stok_awal"];
		$stokAkhir 		= $pecahData["stok_akhir"];
		$username 		= $pecahData["username"];
		$namaLengkap 	= $pecahData["nama_lengkap"];
		$nip 			= $pecahData["nomor_induk_pegawai"];
		$departement 	= $pecahData["kode_nama"];
		$tanggal 		= $pecahData["tanggal"];
		$tglKonfirmasi 	= date("Y/m/d");
		$jumlah 		= $pecahData["jumlah"];
		$keterangan 	= $pecahData["keterangan"];
		$statusPesanan 	= "terkonfirmasi";

		// cek stok akhir barang masih ada / kosong
		if($stokAkhir < 1) {
			echo "barang kosong";
			exit();
		}
		else if($stokAkhir - $jumlah < 0) {
			echo "stok barang tidak cukup";
			exit();
		}
		else {
			
			// mengurangi jumlah stok barang yang ada ditabel barang sesuai jumlah yg diinputkan
			$stokAkhir = $stokAkhir - $jumlah;
			// update stok akhir pada tabel barang
			$sqlMengurangiStok = "UPDATE tbl_barang SET stok_akhir = '$stokAkhir' WHERE id_barang = '$idBarang' ";
			$statusMengurangiStok = $conn->query($sqlMengurangiStok);

			// cek jika stok akhir berhasil dikurangi & diupdate
			if($statusMengurangiStok == 1) {

				// masukkan data pesanan yg terkonfirmasi kedalam tabel riwayat pesanan
				$sqlRiwayat = "INSERT INTO tbl_riwayat_pesanan (id_pesanan, id_member, id_barang, id_departement, kode_barang, nama_barang, satuan_barang, barang_datang, stok_awal, stok_akhir, username, nama_lengkap, nomor_induk_pegawai, kode_nama, tanggal, tanggal_konfirmasi, jumlah, keterangan, status_pesanan) VALUES ('$idpesanan', '$idMember', '$idBarang', '$idDept', '$kodeBarang', '$namaBarang', '$satuanBarang', '$barangDatang', '$stokAwal', '$stokAkhir', '$username', '$namaLengkap', '$nip', '$departement', '$tanggal', '$tglKonfirmasi', '$jumlah', '$keterangan', '$statusPesanan') ";
				$statusRiwayat = $conn->query($sqlRiwayat);

				// cek statusnya
				if($statusRiwayat == 1) {
					// hapus data pesanan yg ada ditabel pesanan yg sudah terkonfirmasi sesuai id pesanan yg dikirim
					$sqlHapusPesanan = "DELETE FROM tbl_pesanan WHERE id_pesanan = '$idPesanan' ";
					$statusHapusPesanan = $conn->query($sqlHapusPesanan);

					// cek statusnya
					if($statusHapusPesanan == 1) {
						echo "terkonfirmasi";
						exit();
					}
					else {
						echo "pesanan terkonfirmasi, tapi ada kegagalan saat menghapus data pesanan";
						exit();
					}
					
				}
				else {
					echo "ada kesalahan saat menambahkan data";
					exit();
				}

			}
			else {
				echo "ada kesalahan saat mengurangi stok barang";
				exit();
			}

		}

	}
	else {
		echo "ada kesalahan saat mengambil data";
		exit();
	}

?>