<?php

	// mulai session
  	require "../session_start.php";

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// jika data sudah dikirim
	if(isset($_POST["nama_lengkap"])) {
		// ambil id admin
		$idAdmin = $_SESSION["admin"]["id_admin"];

		// ambil username yg diinputkan
		$username 		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["username"]));
		// hilangkan karakter spasi pada username
		$username 		= str_replace(" ", "", $username);
		// jadikan semua karakter huruf besar menjadi huruf kecil
		$username 		= strtolower($username);
		// jadikan nilai variabel username menjadi array & ambil karakter pertamanya
		$usernameSplit 	= str_split($username);
		// cek karakter pertama dari nilai username
		if($usernameSplit[0] != "@") {

			echo "karakter pertama harus @";
			exit();

		}
		else {

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
		            move_uploaded_file($lokasiGambar, "../../dist/img/img_admin/" .$namaGambarBaru);

		            // ambil semua data dari form
					$namaLengkap 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama_lengkap"]));
					$username 		= $username;
					$nip 			= mysqli_real_escape_string($conn, htmlspecialchars($_POST["nip"]));
					$jenisKelamin 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["jenis_kelamin"]));
					$email 			= mysqli_real_escape_string($conn, htmlspecialchars($_POST["email"]));
					$telepon 		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["telepon"]));
					$alamat 		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["alamat"]));
					$gambar 		= $namaGambarBaru;

					// masukkan data baru pada tabel admin
					$sqlAdmin = "UPDATE tbl_admin SET username = '$username', nama_lengkap = '$namaLengkap', jenis_kelamin = '$jenisKelamin', email = '$email', alamat = '$alamat', telepon = '$telepon', nomor_induk_pegawai = '$nip', gambar = '$gambar' WHERE id_admin = '$idAdmin' ";
					$status = $conn->query($sqlAdmin);
					// cek statusnya
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
				$namaLengkap 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama_lengkap"]));
				$username 		= $username;
				$nip 			= mysqli_real_escape_string($conn, htmlspecialchars($_POST["nip"]));
				$jenisKelamin 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["jenis_kelamin"]));
				$email 			= mysqli_real_escape_string($conn, htmlspecialchars($_POST["email"]));
				$telepon 		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["telepon"]));
				$alamat 		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["alamat"]));

				// masukkan data baru pada tabel admin
				$sqlAdmin = "UPDATE tbl_admin SET username = '$username', nama_lengkap = '$namaLengkap', jenis_kelamin = '$jenisKelamin', email = '$email', alamat = '$alamat', telepon = '$telepon', nomor_induk_pegawai = '$nip' WHERE id_admin = '$idAdmin' ";
				$status = $conn->query($sqlAdmin);
				// cek statusnya
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

	}

?>