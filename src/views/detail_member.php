<?php

  // ambil id member yg dikirim diURL
  $idMember   = $_GET["id"];

  // ambil data member dan data departement
  $sqlMemberDept = "SELECT * FROM tbl_member JOIN tbl_departement ON tbl_member.id_departement = tbl_departement.id_departement WHERE tbl_member.id_member = '$idMember' ";
  $ambilAkun     = $conn->query($sqlMemberDept);
  $pecahAkun     = $ambilAkun->fetch_assoc();

  // ambil data departement ditabel departement
  $sqlDept          = "SELECT * FROM tbl_departement";
  $ambilDept        = $conn->query($sqlDept);
  
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Detail Member</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item">Detail Member</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="src/dist/img/img_member/<?=$pecahAkun['gambar']; ?>"
                   alt="Foto member">
            </div>

            <h3 class="profile-username text-center"><?=$pecahAkun["nama_lengkap"]; ?></h3>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Username</b> <a class="float-right"><?=$pecahAkun["username"]; ?></a>
              </li>
              <li class="list-group-item">
                <b>NIP</b> <a class="float-right"><?=$pecahAkun["nomor_induk_pegawai"]; ?></a>
              </li>
              <li class="list-group-item">
                <b>Departement</b> <a class="float-right"><?=$pecahAkun["kode_nama"]; ?></a>
              </li>
            </ul>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->

      <div class="col-md-8">

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tentang</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-user mr-1"></i> Jenis Kelamin</strong>

            <p class="text-muted text-capitalize">
              <?=$pecahAkun["jenis_kelamin"]; ?>
            </p>

            <hr>

            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

            <p class="text-muted"><?=$pecahAkun["email"]; ?></p>

            <hr>

            <strong><i class="fas fa-phone mr-1"></i> Telepon</strong>

            <p class="text-muted"><?=$pecahAkun["telepon"]; ?></p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

            <p class="text-muted"><?=$pecahAkun["alamat"]; ?></p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->