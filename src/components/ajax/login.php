<?php

	// mulai session
	require "../session_start.php";

	// koneksi ke database
  	require "../../connection/koneksi_database.php";

  	// jika data sudah dikirimkan
  	if(isset($_POST["username_or_email"])) {

  		// ambil datanya pada form login
  		$usernameOrEmail = mysqli_real_escape_string($conn, htmlspecialchars($_POST["username_or_email"]));
  		$password		 = mysqli_real_escape_string($conn, htmlspecialchars($_POST["password"]));
  		$statusUser      = mysqli_real_escape_string($conn, htmlspecialchars($_POST["status_user"]));

  		// jika yg login admin
  		if($statusUser == "admin") {
  			// ambil data admin yg login pada tabel admin
  			$usernameEmail = "SELECT * FROM tbl_admin WHERE username = '$usernameOrEmail' OR email = '$usernameOrEmail' AND status_user = '$statusUser' ";
	  		$ambilAkun = $conn->query($usernameEmail);
	  		$status = $ambilAkun->num_rows;

	  		// cek statusnya
	  		if($status == 1) {
	  			// ambil datanya & jadikan array assosiatif
	  			$akunUser = $ambilAkun->fetch_assoc();
	  			// verifikasi password
	  			if(password_verify($password, $akunUser["password"])) {
	  				// cek status user
	  				if($akunUser["status_user"] == "admin") {
	  					$_SESSION["admin"] = $akunUser;

	  					// cek ada cookie tidak
		                if(isset($_POST["remember"])) {
		                    // set cookie id admin
		                    setcookie("idC", $akunUser["id_admin"], time()+2629800, "/", "", 0 );
		                    // set cookie username admin
		                    setcookie("keyC", hash("sha256", $akunUser["username"]), time()+2629800, "/", "", 0 );
		                }

	  					echo "login sukses";
	  					exit();
	  				}
	  				else {
	  					echo "akun tidak ditemukan";
	  					exit();
	  				}
	  			}
	  			else {
	  				echo "password salah";
	  				exit();
	  			}
	  		}
	  		else {
	  			echo "akun tidak ditemukan";
	  			exit();
	  		}

  		}
  		// jika yg login member
  		else if($statusUser == "member") {

  			// ambil data member yg login pada tabel member
  			$usernameEmail = "SELECT * FROM tbl_member WHERE username = '$usernameOrEmail' OR email = '$usernameOrEmail' AND status_user = '$statusUser' ";
	  		$ambilAkun = $conn->query($usernameEmail);
	  		$status = $ambilAkun->num_rows;

	  		// cek statusnya
	  		if($status == 1) {
	  			// ambil datanya & dipecah jadi array assosiatif
	  			$akunUser = $ambilAkun->fetch_assoc();
	  			// verifikasi password
	  			if(password_verify($password, $akunUser["password"])) {

	  				// cek status user
	  				if($akunUser["status_user"] == "member") {
	  					$_SESSION["member"] = $akunUser;

	  					// cek ada cookie tidak
		                if(isset($_POST["remember"])) {
		                    // set cookie id member
		                    setcookie("idC", $akunUser["id_member"], time()+2629800, "/", "", 0 );
		                    // set cookie username member
		                    setcookie("keyC", hash("sha256", $akunUser["username"]), time()+2629800, "/", "", 0 );
		                }

	  					echo "login sukses";
	  					exit();
	  				}
	  				else {
	  					echo "akun tidak ditemukan";
	  					exit();
	  				}

	  			}
	  			else {
	  				echo "password salah";
	  				exit();
	  			}
	  		}
	  		else {
	  			echo "akun tidak ditemukan";
	  			exit();
	  		}

  		}
  		// jika statusnya tidak dikenali
  		else {

  			echo "akun tidak ditemukan";
  			exit();

  		}

  	}

?>