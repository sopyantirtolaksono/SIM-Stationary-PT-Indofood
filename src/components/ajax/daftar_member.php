<?php

	// koneksi ke database
  	require "../../connection/koneksi_database.php";

	// ambil data member ditabel member
	$sqlMember   = "SELECT * FROM tbl_member JOIN tbl_departement ON tbl_member.id_departement = tbl_departement.id_departement ORDER BY tbl_member.id_member DESC";
	$ambilMember = $conn->query($sqlMember);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Daftar Member</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item">Daftar Member</li>
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
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar member</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Nama Lengkap</th>
                <th>NIP</th>
                <th>Departement</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gambar</th>
              </tr>
              </thead>
              <tbody>

                <?php 
                  $no = 1;
                  while($pecahMember = $ambilMember->fetch_assoc()) { 
                ?>
                <tr>
                    <td><?=$no; ?></td>
                    <td>
                    <?php if($pecahMember["verifikasi"] == "belum") { ?>
                      <a href="src/components/ajax/verifikasi.php?id=<?=$pecahMember['id_member']; ?>" class="btn btn-success btn-sm" id="btnVerifikasi">Verifikasi</a>
                  	<?php } ?>
                      <a href="index.php?halaman=detail_member&id=<?=$pecahMember['id_member']; ?>" class="btn btn-info btn-sm">Detail</a>
                    </td>
                    <td><?=$pecahMember["nama_lengkap"]; ?></td>
                    <td><?=$pecahMember["nomor_induk_pegawai"]; ?></td>
                    <td><?=$pecahMember["kode_nama"]; ?></td>
                    <td><?=$pecahMember["username"]; ?></td>
                    <td><?=$pecahMember["email"]; ?></td>
                    <td>
                      <img src="src/dist/img/img_member/<?=$pecahMember['gambar']; ?>" class="img-thumbnail" alt="Foto Member">
                    </td>
                </tr>
                <?php 
                  $no++;
                  } 
                ?>

              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Nama Lengkap</th>
                <th>NIP</th>
                <th>Departement</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gambar</th>
              </tr>
              </tfoot>
            </table>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
    </div>
  </div>
</section>


<!-- JS File -->
<!-- Daftar Member -->
<script src="src/dist/js/ajax/daftar_member.js"></script>