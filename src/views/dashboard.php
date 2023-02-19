<?php

  // cek jika belum ada yang login
  if(isset($_SESSION["admin"])) {
    // ambil session admin
    $_SESSION["admin"];

    // ambil data barang di tabel barang(admin & member)
    $sqlBarang    = "SELECT * FROM tbl_barang";
    $ambilBarang  = $conn->query($sqlBarang);
    $jmlBarang    = $ambilBarang->num_rows;
    
    // ambil data pesanan terkonfirmasi di tabel riwayat pesanan(admin)
    $sqlRiwayat    = "SELECT * FROM tbl_riwayat_pesanan";
    $ambilRiwayat  = $conn->query($sqlRiwayat);
    $jmlRiwayat    = $ambilRiwayat->num_rows;

    // ambil data pesanan menunggu di tabel pesanan(admin)
    $sqlPesanan    = "SELECT * FROM tbl_pesanan";
    $ambilPesanan  = $conn->query($sqlPesanan);
    $jmlPesanan    = $ambilPesanan->num_rows;

    // ambil data member di tabel member(admin)
    $sqlMember    = "SELECT * FROM tbl_member";
    $ambilMember  = $conn->query($sqlMember);
    $jmlMember    = $ambilMember->num_rows;

  }
  else if(isset($_SESSION["member"])) {
    // ambil session member
    $_SESSION["member"];
    // ambil id member
    $idMember = $_SESSION["member"]["id_member"];

    // ambil data barang di tabel barang(admin & member)
    $sqlBarang    = "SELECT * FROM tbl_barang";
    $ambilBarang  = $conn->query($sqlBarang);
    $jmlBarang    = $ambilBarang->num_rows;

    // ambil data pesanan terkonfirmasi di tabel riwayat pesanan(member)
    $sqlRiwayat    = "SELECT * FROM tbl_riwayat_pesanan WHERE id_member = '$idMember' ";
    $ambilRiwayat  = $conn->query($sqlRiwayat);
    $jmlRiwayat    = $ambilRiwayat->num_rows;
    
    // ambil data pesanan menunggu di tabel pesanan(member)
    $sqlPesanan    = "SELECT * FROM tbl_pesanan WHERE id_member = '$idMember'";
    $ambilPesanan  = $conn->query($sqlPesanan);
    $jmlPesanan    = $ambilPesanan->num_rows;
    
  }
  else {
    // alihkan ke halaman login
    header("Location: login.php");
    exit();
  }

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard Stationary</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box">
          <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-th"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Barang</span>
            <span class="info-box-number">
              <?=$jmlBarang; ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-envelope"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Pesanan Terkonfirmasi</span>
            <span class="info-box-number"><?=$jmlRiwayat; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-clock"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Pesanan Menunggu</span>
            <span class="info-box-number"><?=$jmlPesanan; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- jika admin yang login -->
      <?php if(isset($_SESSION["admin"])) { ?>
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Member</span>
            <span class="info-box-number"><?=$jmlMember; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <?php } ?>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </div><!--/. container-fluid -->
</section>
<!-- /.content -->