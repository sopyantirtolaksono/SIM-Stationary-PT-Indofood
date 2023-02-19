<?php

	// koneksi ke database
  	require "../../connection/koneksi_database.php";

  	// jika sudah menggirimkan data
	if(isset($_POST["nama_lengkap"])) {
		
		// ambil semua data di form
		$namaLengkap 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama_lengkap"]));
		$nip 			= mysqli_real_escape_string($conn, htmlspecialchars($_POST["nip"]));
		$departement 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["departement"]));
		$jenisKelamin 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["jenis_kelamin"]));
		$username 		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["username"]));
		$email 			= mysqli_real_escape_string($conn, htmlspecialchars($_POST["email"]));
		$password 		= $_POST["password"];
		$tglSekarang 	= date("Y/m/d");

		// cek username
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

			// cek username sudah ada belum
			$sqlMember 		= "SELECT * FROM tbl_member WHERE username = '$username' ";
			$ambilMember 	= $conn->query($sqlMember);
			$statusUsername = $ambilMember->num_rows;

			if($statusUsername != 0) {

				echo "username sudah ada";
				exit();

			}
			else {

				// cek password
				// hilangkan karakter spasi pada password
				$password 		= str_replace(" ", "", $password);
				// hitung panjang/jml karakter dlm password
				$passwordLength = strlen($password);

				// cek jika karakter kurang dari 8
				if($passwordLength < 8) {

					echo "minimal harus 8 karakter";
					exit();

				}
				else {

					// enkripsi password
					$password = password_hash($password, PASSWORD_DEFAULT);

					// masukkan data member baru pada tabel member
					$sqlRegistrasi = "INSERT INTO tbl_member (id_departement, username, password, nama_lengkap, jenis_kelamin, email, nomor_induk_pegawai, tanggal_gabung) VALUES ('$departement', '$username', '$password', '$namaLengkap', '$jenisKelamin', '$email', '$nip', '$tglSekarang')";
					$status = $conn->query($sqlRegistrasi);

					// cek statusnya
					if($status == 1) {
						echo "registrasi berhasil";
						exit();
					}
					else {
						echo "registrasi gagal";
						exit();
					}

				}

			}

		}

	}

?>