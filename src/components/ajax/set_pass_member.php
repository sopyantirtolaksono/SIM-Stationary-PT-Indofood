<?php

	// mulai session
	require "../session_start.php";

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil id member yg login di session membernya
	$idMember = $_SESSION["member"]["id_member"];

	// ambil data(password) member yg login
	$sqlDataMember 		= "SELECT * FROM tbl_member WHERE id_member = '$idMember' ";
	$ambilData 			= $conn->query($sqlDataMember);
	$statusDataMember 	= $ambilData->num_rows;

	// cek statusnya
	if($statusDataMember == 1) {
		// ambil datanya, pecah jadi array assosiatif
		$pecahData 	= $ambilData->fetch_assoc();
		$passUtama	= $pecahData["password"];

		// ambil data password lama dan baru dari form
		$passLama 	= $_POST["passwordLama"];
		$passBaru 	= $_POST["passwordBaru"];

		if(password_verify($passLama, $passUtama)) {
			// hilangkan karakter spasi pada password baru
			$passBaru 		= str_replace(" ", "", $passBaru);
			// hitung panjang/jml karakter dlm password baru
			$passBaruLength = strlen($passBaru);

			// cek jika karakter kurang dari 8
			if($passBaruLength < 8) {
				echo "minimal harus 8 karakter";
				exit();
			}
			else {

				// enkripsi password baru
				$passBaru = password_hash($passBaru, PASSWORD_DEFAULT);
				// update password
				$sqlUpdatePass = "UPDATE tbl_member SET password = '$passBaru' ";
				$statusUpdatePass = $conn->query($sqlUpdatePass);
				// cek statusnya
				if($statusUpdatePass == 1) {
					echo "update password sukses";
					exit();
				}
				else {
					echo "update password gagal";
					exit();
				}

			}
			
		}
		else {
			echo "password anda tidak cocok";
			exit();
		}
	}
	else {
		echo "data member tidak ditemukan";
		exit();
	}

?>