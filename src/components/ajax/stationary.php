<?php

	// mulai session
	require "../session_start.php";

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil data akun member yang login
	$akunMember = $_SESSION["member"];
	// ambil id member yang login
	$idMember 	= $akunMember["id_member"];

	// ambil tanggal sekarang
	$tglSekarang = date("Y/m/d");

	// cek sudah ada data yg dikirim belum
	if(isset($_POST["nama_barang"])) {

		// ambil semua data yg dikirim + beri function htmlspecialchars
		$namaBarang = htmlspecialchars($_POST["nama_barang"]);
		$jumlah 	= htmlspecialchars($_POST["jumlah"]);
		$keterangan = htmlspecialchars($_POST["keterangan"]);
		// beri function mysqli_real_escape_string
		$namaBarang = mysqli_real_escape_string($conn, $namaBarang);
		$jumlah 	= mysqli_real_escape_string($conn, $jumlah);
		$keterangan = mysqli_real_escape_string($conn, $keterangan);

		// mengambil data barang(stok akhir) sesuai id barang yg dipilih
		$sqlAmbilStokAkhir = "SELECT * FROM tbl_barang WHERE id_barang = '$namaBarang' ";
		$ambilStokAkhir = $conn->query($sqlAmbilStokAkhir);
		$statusAmbilStokAkhir = $ambilStokAkhir->num_rows;

		// cek statusnya
		if($statusAmbilStokAkhir == 1) {

			// ambil datanya dan jadikan array assosiatif
			$pecahStokAkhir = $ambilStokAkhir->fetch_assoc();
			// ambil stok akhir barang
			$stokAkhir 		= $pecahStokAkhir["stok_akhir"];

			// cek kondisi jumlah barang yg diinputkan & jumlah stok akhir
			if($jumlah < 1 || $jumlah > $stokAkhir) {
				echo "periksa jumlah barang yang diinputkan";
				exit();
			}
			else {
				
				// masukkan data pesanan stationary kedalam tabel pesanan
				$sqlPesanan = "INSERT INTO tbl_pesanan (id_barang, id_member, tanggal, jumlah, keterangan) VALUES ('$namaBarang', '$idMember', '$tglSekarang', '$jumlah', '$keterangan')";
				$statusPesanan = $conn->query($sqlPesanan);

				// cek status pesanan
				if($statusPesanan == 1) {
					if(isset($_POST["kirimWA"])) {
						echo "pesanan sukses, mengirim whatsapp";
						exit();
					}
					else {
						echo "sukses";
						exit();
					}
				}
				else {
					echo "gagal";
					exit();
				}
				
			}

		}
		else {
			// jika gagal mengambil stok akhir barang
			echo "gagal mengambil stok akhir barang";
			exit();
		}

	}

?>