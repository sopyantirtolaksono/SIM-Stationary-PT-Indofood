<?php

  // mulai session
  require "src/components/session_start.php";
  
  // koneksi database
  require "src/connection/koneksi_database.php";

  // cek cookienya
  if(isset($_COOKIE["idC"]) && isset($_COOKIE["keyC"])) {

    // ambil value cookienya
    $idC   = $_COOKIE["idC"];
    $keyC  = $_COOKIE["keyC"];

    // ambil data admin dari tabel admin
    $ambilAdminC   = $conn->query("SELECT * FROM tbl_admin WHERE id_admin = '$idC' ");
    $statusAdminC  = $ambilAdminC->num_rows;

    // ambil data member dari tabel member
    $ambilMemberC   = $conn->query("SELECT * FROM tbl_member WHERE id_member = '$idC' ");
    $statusMemberC  = $ambilMemberC->num_rows;

    // cek statusnya
    if($statusAdminC == 1) {

      // ambil data adminnya
      $pecahAdminC = $ambilAdminC->fetch_assoc();

      // cek/verifikasi value keyC dengan username admin pada tabel admin
      if($keyC === hash("sha256", $pecahAdminC["username"])) {

        // jika cocok/sama, set session admin
        $_SESSION["admin"] = $pecahAdminC;

      }
      else if($statusMemberC == 1) {

        // ambil data membernya
        $pecahMemberC = $ambilMemberC->fetch_assoc();

        // cek/verifikasi value keyC dengan username member pada tabel member
        if($keyC === hash("sha256", $pecahMemberC["username"])) {
          // jika cocok/sama, set session member
          $_SESSION["member"] = $pecahMemberC;
        }
        else {
          // alihkan ke halaman login
          header("Location: login.php");
          exit();
        }

      }
      else {

        // alihkan ke halaman login
        header("Location: login.php");
        exit();

      }

    }
    else if($statusMemberC == 1) {

      // ambil data membernya
      $pecahMemberC = $ambilMemberC->fetch_assoc();

      // cek/verifikasi value keyC dengan username member pada tabel member
      if($keyC === hash("sha256", $pecahMemberC["username"])) {
        // jika cocok/sama, set session member
        $_SESSION["member"] = $pecahMemberC;
      }
      else {
        // alihkan ke halaman login
        header("Location: login.php");
        exit();
      }

    }
    else {

      // alihkan ke halaman login
      header("Location: login.php");
      exit();

    }

  }

  // cek jika belum ada yang login
  if(isset($_SESSION["admin"])) {
    $_SESSION["admin"];
    // ambil id admin
    // A(Admin)
    $idA = $_SESSION["admin"]["id_admin"];
    // ambil datanya di tabel admin
    // A(Admin)
    $sqlA   = "SELECT * FROM tbl_admin WHERE id_admin = '$idA' ";
    $ambilA = $conn->query($sqlA);
    $pecahA = $ambilA->fetch_assoc();

    // ambil data pesanan member di tabel pesanan
    // P(Pesanan)
    $sqlP   = "SELECT * FROM tbl_pesanan JOIN tbl_barang ON tbl_pesanan.id_barang = tbl_barang.id_barang JOIN tbl_member ON tbl_pesanan.id_member = tbl_member.id_member LIMIT 5";
    $ambilP = $conn->query($sqlP);
    $sqlPKe2   = "SELECT * FROM tbl_pesanan JOIN tbl_barang ON tbl_pesanan.id_barang = tbl_barang.id_barang JOIN tbl_member ON tbl_pesanan.id_member = tbl_member.id_member";
    $ambilPKe2 = $conn->query($sqlPKe2);
    $jmlP   = $ambilPKe2->num_rows;

    // ambil data member yang belum terverifikasi
    // V(Verifikasi)
    $sqlV   = "SELECT * FROM tbl_member WHERE verifikasi = 'belum' LIMIT 5";
    $ambilV = $conn->query($sqlV);
    $sqlVKe2   = "SELECT * FROM tbl_member WHERE verifikasi = 'belum' ";
    $ambilVKe2 = $conn->query($sqlVKe2);
    $jmlV   = $ambilVKe2->num_rows;
  }
  else if(isset($_SESSION["member"])) {
    $_SESSION["member"];
    // ambil id member
    // M(Member)
    $idM    = $_SESSION["member"]["id_member"];
    // ambil datanya di tabel member
    // M(Member)
    $sqlM   = "SELECT * FROM tbl_member WHERE id_member = '$idM' ";
    $ambilM = $conn->query($sqlM);
    $pecahM = $ambilM->fetch_assoc();

    // ambil data pesanan member di tabel pesanan sesuai member yg login
    // PM(Pesanan Member yang login)
    $sqlPM    = "SELECT * FROM tbl_pesanan JOIN tbl_barang ON tbl_pesanan.id_barang = tbl_barang.id_barang JOIN tbl_member ON tbl_pesanan.id_member = tbl_member.id_member WHERE tbl_member.id_member = '$idM' LIMIT 5";
    $ambilPM  = $conn->query($sqlPM);
    $sqlPMKe2    = "SELECT * FROM tbl_pesanan JOIN tbl_barang ON tbl_pesanan.id_barang = tbl_barang.id_barang JOIN tbl_member ON tbl_pesanan.id_member = tbl_member.id_member WHERE tbl_member.id_member = '$idM' ";
    $ambilPMKe2  = $conn->query($sqlPMKe2);
    $jmlPM    = $ambilPMKe2->num_rows;
  }
  else {
    // alihkan ke halaman login
    header("Location: login.php");
    exit();
  }

?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if(isset($_GET["halaman"])) {
    $halaman      = $_GET["halaman"];
    $halExploade  = explode("_", $halaman);
    $halImplode   = implode(" ", $halExploade);
  ?>
  <title>stationary | <?=$halImplode; ?></title>
  <?php } ?>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="src/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="src/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="src/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="src/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="src/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="src/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="src/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="src/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="src/plugins/daterangepicker/daterangepicker.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="src/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- jQuery -->
  <script src="src/plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?halaman=dashboard" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- khusus jika admin yg login -->
      <?php if(isset($_SESSION["admin"])) { ?>
      <li class="nav-item dropdown">
        <?php if($jmlV > 0) { ?>
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <span class="badge badge-danger navbar-badge"><?=$jmlV; ?></span>
        </a>
        <?php } else { ?>
        <a class="nav-link" href="#">
          <i class="far fa-user"></i>
        </a>
        <?php } ?>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <?php while($pecahV = $ambilV->fetch_assoc()) { ?>
          <a href="index.php?halaman=daftar_member" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="src/dist/img/img_member/<?=$pecahV['gambar']; ?>" alt="Foto Member" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?=$pecahV["nama_lengkap"]; ?>
                </h3>
                <p class="text-sm text-muted"><i class="far fa-user mr-1"></i> <?=$pecahV["username"]; ?></p>
                <?php if($pecahV["tanggal_gabung"] == date("Y/m/d")) { ?>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hari ini</p>
                <?php } else { ?>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?=$pecahV["tanggal_gabung"]; ?></p>
                <?php } ?>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <?php } ?>
          
          <a href="index.php?halaman=daftar_member" class="dropdown-item dropdown-footer">Lihat semua member baru</a>
        </div>
      </li>
      <?php } ?>

      <!-- Notifications Dropdown Menu -->
      <!-- jika admin yg login -->
      <?php if(isset($_SESSION["admin"])) { ?>
      <li class="nav-item dropdown">
        <?php if($jmlP > 0) { ?>
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?=$jmlP; ?></span>
        </a>
        <?php } else { ?>
        <a class="nav-link" href="#">
          <i class="far fa-bell"></i>
        </a>
        <?php } ?>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header"><?=$jmlP; ?> Pesanan</span>
          <div class="dropdown-divider"></div>

          <?php while($pecahP = $ambilP->fetch_assoc()) { ?>
          <a href="index.php?halaman=kelola_pesanan" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 
            <?=$pecahP["nama_barang"]; ?>
            <span class="float-right text-muted text-sm">
              <?php if($pecahP["tanggal"] == date("Y/m/d")) { ?>
                Hari ini
              <?php } else { ?>
                <?=$pecahP["tanggal"]; ?>
              <?php } ?>
            </span>
            <br>
            <span class="text-muted text-sm">
              <i class="fas fa-user"></i>
              <?=$pecahP["username"]; ?>
            </span>
            <span class="float-right text-muted text-sm">
              <i class="far fa-clock"></i>
              <?=$pecahP["status_pesanan"]; ?>
            </span>
          </a>
          <div class="dropdown-divider"></div>
          <?php } ?>
          
          <a href="index.php?halaman=kelola_pesanan" class="dropdown-item dropdown-footer">Lihat semua pesanan</a>
        </div>
      </li>
      <?php } else { ?>
      <li class="nav-item dropdown">
        <?php if($jmlPM > 0) { ?>
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?=$jmlPM; ?></span>
        </a>
        <?php } else { ?>
        <a class="nav-link" href="#">
          <i class="far fa-bell"></i>
        </a>
        <?php } ?>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header"><?=$jmlPM; ?> Pesanan</span>
          <div class="dropdown-divider"></div>

          <?php while($pecahPM = $ambilPM->fetch_assoc()) { ?>
          <a href="index.php?halaman=riwayat_pesanan" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 
            <?=$pecahPM["nama_barang"]; ?>
            <span class="float-right text-muted text-sm">
              <?php if($pecahPM["tanggal"] == date("Y/m/d")) { ?>
                Hari ini
              <?php } else { ?>
                <?=$pecahPM["tanggal"]; ?>
              <?php } ?>
            </span>
            <br>
            <span class="text-muted text-sm">
              <i class="far fa-clock"></i>
              <?=$pecahPM["status_pesanan"]; ?>
            </span>
          </a>
          <div class="dropdown-divider"></div>
          <?php } ?>
          
          <a href="index.php?halaman=riwayat_pesanan" class="dropdown-item dropdown-footer">Lihat semua pesanan</a>
        </div>
      </li>
      <?php } ?>

      <li class="nav-item">
        <a class="nav-link" href="src/components/ajax/logout.php" role="button" id="btnLogoutNavbar">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="src/dist/img/AdminLTELogo.png" alt="Logo Aplikasi" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">STATIONARY</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <?php if(isset($_SESSION["admin"])) { ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="src/dist/img/img_admin/<?=$pecahA['gambar']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php?halaman=profil_admin" class="d-block"><?=$pecahA["nama_lengkap"]; ?></a>
        </div>
      </div>
      <?php } else { ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="src/dist/img/img_member/<?=$pecahM['gambar']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php?halaman=profil" class="d-block"><?=$pecahM["nama_lengkap"]; ?></a>
        </div>
      </div>
      <?php } ?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <?php if($_GET["halaman"] == "dashboard") { ?>
          <li class="nav-item">
            <a href="index.php?halaman=dashboard" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a href="index.php?halaman=dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php } ?>


          <!-- jika yang login admin -->
          <?php if(isset($_SESSION["admin"])) { ?>

          <?php if($_GET["halaman"] == "data_barang") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Pengelolaan Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=data_barang" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=penggunaan_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penggunaan Barang</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "update_barang") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Pengelolaan Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=data_barang" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=penggunaan_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penggunaan Barang</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } else if($_GET["halaman"] == "restok_barang") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Pengelolaan Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=data_barang" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=penggunaan_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penggunaan Barang</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "tambah_barang") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Pengelolaan Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=data_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_barang" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=penggunaan_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penggunaan Barang</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "penggunaan_barang") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Pengelolaan Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=data_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=penggunaan_barang" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penggunaan Barang</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Pengelolaan Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=data_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=penggunaan_barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penggunaan Barang</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php } ?>


          <!-- jika yang login admin -->
          <?php if(isset($_SESSION["admin"])) { ?>

          <?php if($_GET["halaman"] == "kelola_pesanan") { ?>
          <li class="nav-item">
            <a href="index.php?halaman=kelola_pesanan" class="nav-link active">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Pengelolaan Pesanan
              </p>
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a href="index.php?halaman=kelola_pesanan" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Pengelolaan Pesanan
              </p>
            </a>
          </li>
          <?php } ?>

          <?php } ?>


          <!-- jika yang login member -->
          <?php if(isset($_SESSION["member"])) { ?>

          <?php if($_GET["halaman"] == "stationary") { ?>
          <li class="nav-item">
            <a href="index.php?halaman=stationary" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Stationary
              </p>
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a href="index.php?halaman=stationary" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Stationary
              </p>
            </a>
          </li>
          <?php } ?>

          <?php } ?>


          <!-- jika yang login admin -->
          <?php if(isset($_SESSION["admin"])) { ?>

          <?php if($_GET["halaman"] == "profil_admin") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=profil_admin" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profil Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=daftar_member" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Member</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "daftar_member") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=profil_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profil Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=daftar_member" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Member</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "detail_member") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=profil_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profil Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=daftar_member" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Member</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=profil_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profil Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=daftar_member" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Member</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php } ?>


          <!-- jika yang login member -->
          <?php if(isset($_SESSION["member"])) { ?>

          <?php if($_GET["halaman"] == "profil") { ?>
          <li class="nav-item">
            <a href="index.php?halaman=profil" class="nav-link active">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a href="index.php?halaman=profil" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
          <?php } ?>

          <?php } ?>


          <!-- jika yang login member -->
          <?php if(isset($_SESSION["member"])) { ?>

          <?php if($_GET["halaman"] == "riwayat_pesanan") { ?>
          <li class="nav-item">
            <a href="index.php?halaman=riwayat_pesanan" class="nav-link active">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Riwayat Pesanan
              </p>
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a href="index.php?halaman=riwayat_pesanan" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Riwayat Pesanan
              </p>
            </a>
          </li>
          <?php } ?>

          <?php } ?>


          <li class="nav-item">
            <a href="src/components/ajax/logout.php" class="nav-link" id="btnLogoutSidebar">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>