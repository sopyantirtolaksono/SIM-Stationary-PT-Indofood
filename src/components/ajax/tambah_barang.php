<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// setting auto increment pada field kode_barang ditabel barang
	$ambilMaxKode = $conn->query("SELECT max(kode_barang) as maxKode FROM tbl_barang");
	$pecahMaxKode = $ambilMaxKode->fetch_assoc();
	$maxKode = $pecahMaxKode["maxKode"];
	// lanjut menggabungkan char dan nomor menjadi kode barang yang benar.
	$kodeUrut = (int) substr($maxKode, 2, 3);
	$kodeUrut++;
	$char = "KS";
	$kodeJadi = $char . sprintf("%03s", $kodeUrut);

	// jika data sudah dikirim
	if(isset($_POST["nama_barang"])) {
		// ambil gambar dari form(nama gambar dan lokasi gambar)
		$namaGambar		= $_FILES["gambar"]["name"];
		$lokasiGambar	= $_FILES["gambar"]["tmp_name"];
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
            $kodeBarang 	= $kodeJadi;
			$namaBarang 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama_barang"]));
			$satuanBarang 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["satuan_barang"]));
			$hargaSatuan 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["harga_satuan"]));
			$barangDatang 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["barang_datang"]));
			$stokAwal 		= $barangDatang;
			$stokAkhir 		= $stokAwal;
			$gambar 		= $namaGambarBaru;

			// masukkan data baru pada tabel barang
			$tambahBarang = "INSERT INTO tbl_barang (kode_barang, nama_barang, satuan_barang, harga_satuan, barang_datang, stok_awal, stok_akhir, gambar) VALUES ('$kodeBarang', '$namaBarang', '$satuanBarang', '$hargaSatuan', '$barangDatang', '$stokAwal', '$stokAkhir', '$gambar')";
			$status = $conn->query($tambahBarang);
			// cek status
			if($status == 1) {
				echo "sukses menambah data baru";
				exit();
			}
			else {
				echo "gagal menambah data baru";
				exit();
			}

        }
        else {
        	echo "format gambar salah";
        	exit();
        }

	}

?>