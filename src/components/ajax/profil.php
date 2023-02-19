<?php

  // mulai session
  require "../session_start.php";

  // koneksi ke database
  require "../../connection/koneksi_database.php";

  // ambil id member yg login
  $idMember   = $_SESSION["member"]["id_member"];

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
        <h1 class="m-0 text-dark">Profil</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item">Profil</li>
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
      <div class="col-md-3">

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
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
            	<li class="nav-item"><a class="nav-link active" href="#settingsAkun" data-toggle="tab">Akun</a></li>
              	<li class="nav-item"><a class="nav-link" href="#settingsPassword" data-toggle="tab">Password</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">

              <div class="tab-pane active" id="settingsAkun">
                <form action="src/components/ajax/set_akun_member.php" method="post" class="form-horizontal" id="formSettingsAkun" enctype="multipart/form-data">
                  
                  <div class="form-group row">
                    <label for="namaLengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap" value="<?=$pecahAkun['nama_lengkap']; ?>" placeholder="Nama Lengkap" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="username" name="username" value="<?=$pecahAkun['username']; ?>" placeholder="Username" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="nip" class="col-sm-2 col-form-label">Nomor Induk Pegawai</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nip" name="nip" value="<?=$pecahAkun['nomor_induk_pegawai']; ?>" placeholder="Nomor Induk Pegawai" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="departement" class="col-sm-2 col-form-label">Departement</label>
                    <div class="col-sm-10">
                      <select class="form-control select2 select2bs4" id="departement" name="departement" required>
                      	<option selected value="<?=$pecahAkun['id_departement']; ?>">
                      		<?=$pecahAkun["kode_nama"]; ?>
                      	</option>

                      	<?php while($pecahDept = $ambilDept->fetch_assoc()) { ?>
                        <option value="<?=$pecahDept['id_departement']; ?>">
                        	<?=$pecahDept["kode_nama"]; ?>
                        </option>
                    	<?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="jenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                      <select class="form-control select2 select2bs4" id="jenisKelamin" name="jenis_kelamin" required>
                      	<option selected value="<?=$pecahAkun['jenis_kelamin']; ?>">
                      		<?=$pecahAkun["jenis_kelamin"]; ?>
                      	</option>
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" name="email" value="<?=$pecahAkun['email']; ?>" placeholder="Email">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="telepon" name="telepon" value="<?=$pecahAkun['telepon']; ?>" placeholder="Telepon">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="gambar" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="gambar" name="gambar">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="alamat" name="alamat" cols="30" rows="5" placeholder="Alamat"><?=$pecahAkun["alamat"]; ?></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane " id="settingsPassword">
                <form action="src/components/ajax/set_pass_member.php" method="post" class="form-horizontal" id="formsettingsPassword">

                  <div class="form-group row">
                    <label for="passwordLama" class="col-sm-2 col-form-label">Password Lama</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="passwordLama" name="passwordLama" placeholder="Password Lama" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="passwordBaru" class="col-sm-2 col-form-label">Password Baru</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="passwordBaru" name="passwordBaru" placeholder="Password Baru" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" onclick="showHide()"> Lihat password
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<!-- JS File -->
<!-- Profil -->
<script src="src/dist/js/ajax/profil.js"></script>