<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// jika data sudah dikirim
	if(isset($_POST["nama_barang"])) {
		// ambil id barang
		$idBarang = mysqli_real_escape_string($conn, htmlspecialchars($_POST["id_barang"]));

		// ambil gambar dari form(nama gambar dan lokasi gambar)
		$namaGambar		= $_FILES["gambar"]["name"];
		$lokasiGambar	= $_FILES["gambar"]["tmp_name"];

		// cek ada gambar yang diupload tidak
		if(!empty($lokasiGambar)) {

			// ambil nama ekstensinya(gambar barang)
	        $namaEkstensi = pathinfo($namaGambar, PATHINFO_EXTENSION);
	        // cek apakah format gambar valid / invalid
	        if( $namaEkstensi == "jpg" || 
	            $namaEkstensi == "JPG" || 
	            $namaEkstensi == "png" || 
	            $namaEkstensi == "PNG" ||
	            $namaEkstensi == "jpeg" ||
	            $namaEkstensi == "JPEG" ) {

	        	// aktifkan uniqid
	            $uniqId = uniqid();
	            // buat nama gambar baru
	            $namaGambarBaru = $uniqId."_".$namaGambar;
	            // pindahkan gambar dari lokasi sementara ke folder
	            move_uploaded_file($lokasiGambar, "../../dist/img/img_barang/" .$namaGambarBaru);

	            // ambil semua data dari form
				$namaBarang 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama_barang"]));
				$satuanBarang 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["satuan_barang"])) ;
				$hargaSatuan 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["harga_satuan"]));
				$barangDatang 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["barang_datang"]));
				$stokAwal 		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["stok_awal"]));
				$stokAkhir 		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["stok_akhir"]));
				$gambar 		= $namaGambarBaru;

				// masukkan data baru pada tabel barang
				$updateBarang = "UPDATE tbl_barang SET nama_barang = '$namaBarang', satuan_barang = '$satuanBarang', harga_satuan = '$hargaSatuan', barang_datang = '$barangDatang', stok_awal = '$stokAwal', stok_akhir = '$stokAkhir', gambar = '$gambar' WHERE id_barang = '$idBarang' ";
				$status = $conn->query($updateBarang);
				// cek status
				if($status == 1) {
					echo "sukses mengupdate data";
					exit();
				}
				else {
					echo "gagal mengupdate data";
					exit();
				}

	        }
	        else {
	        	echo "format gambar salah";
	        	exit();
	        }

		}
		else {

			// ambil semua data dari form
			$namaBarang 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama_barang"]));
			$satuanBarang 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["satuan_barang"]));
			$hargaSatuan 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["harga_satuan"]));
			$barangDatang 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["barang_datang"]));
			$stokAwal 		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["stok_awal"]));
			$stokAkhir 		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["stok_akhir"]));

			// masukkan data baru pada tabel barang
			$updateBarang = "UPDATE tbl_barang SET nama_barang = '$namaBarang', satuan_barang = '$satuanBarang', harga_satuan = '$hargaSatuan', barang_datang = '$barangDatang', stok_awal = '$stokAwal', stok_akhir = '$stokAkhir' WHERE id_barang = '$idBarang' ";
			$status = $conn->query($updateBarang);
			// cek status
			if($status == 1) {
				echo "sukses mengupdate data";
				exit();
			}
			else {
				echo "gagal mengupdate data";
				exit();
			}

		}

	}

?>