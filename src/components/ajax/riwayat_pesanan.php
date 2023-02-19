<?php

  // mulai session
  require "../session_start.php";

  // koneksi ke database
  require "../../connection/koneksi_database.php";

  // ambil id member pada session member
  $idMember = $_SESSION["member"]["id_member"];

  // ambil data pesanan dari tabel pesanan
  $sqlPesanan = "SELECT * FROM tbl_pesanan JOIN tbl_member ON tbl_pesanan.id_member = tbl_member.id_member JOIN tbl_departement ON tbl_member.id_departement = tbl_departement.id_departement JOIN tbl_barang ON tbl_pesanan.id_barang = tbl_barang.id_barang WHERE tbl_pesanan.status_pesanan = 'menunggu' AND tbl_pesanan.id_member = '$idMember' ORDER BY tbl_pesanan.id_pesanan DESC";
  $ambilPesanan = $conn->query($sqlPesanan);

  // ambil data barang ditabel barang(untuk status terkonfirmasi)
  $sqlBarang        = "SELECT * FROM tbl_barang";
  $ambilBarang      = $conn->query($sqlBarang);

  // ambil data departement ditabel departement(untuk status terkonfirmasi)
  $sqlDept          = "SELECT * FROM tbl_member JOIN tbl_departement ON tbl_member.id_departement = tbl_departement.id_departement WHERE tbl_member.id_member = '$idMember' ";
  $ambilDept        = $conn->query($sqlDept);
  $pecahDept        = $ambilDept->fetch_assoc();

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Riwayat Pesanan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item">Riwayat Pesanan</li>
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
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#menunggu" data-toggle="tab">Menunggu</a></li>
              <li class="nav-item"><a class="nav-link" href="#terkonfirmasi" data-toggle="tab">Terkonfirmasi</a></li>
            </ul>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="tab-content">

              <div class="tab-pane active" id="menunggu">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Aksi</th>
                      <th>Status Pesanan</th>
                      <th>Nama Member</th>
                      <th>Departement</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>
                      <th>Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                    <?php 
                      $no = 1;
                      while($pecahPesanan = $ambilPesanan->fetch_assoc()) { 
                    ?>
                    <tr>
                        <td><?=$no; ?></td>
                        <td>
                          <a href="src/components/ajax/batalkan_pesanan.php?id=<?=$pecahPesanan['id_pesanan']; ?>" class="btn btn-secondary btn-sm" id="btnBatal">Batal</a>
                        </td>
                        <td>

                          <?php if($pecahPesanan["stok_akhir"] < 1) { ?>

                          <small class="badge badge-warning">
                            <?=$pecahPesanan["status_pesanan"]; ?>
                          </small>
                          <small class="badge badge-info">
                            sedang restok barang
                          </small>

                          <?php } else if($pecahPesanan["stok_akhir"] >= 1) { ?>

                          <small class="badge badge-warning">
                            <?=$pecahPesanan["status_pesanan"]; ?>
                          </small>

                          <?php } else { ?>

                          <small class="badge badge-warning">
                            <?=$pecahPesanan["status_pesanan"]; ?>
                          </small>
                          <small class="badge badge-danger">
                            harap bersabar, sedang ada perbaikan
                          </small>

                          <?php } ?>

                        </td>
                        <td><?=$pecahPesanan["nama_lengkap"]; ?></td>
                        <td><?=$pecahPesanan["kode_nama"]; ?></td>
                        <td><?=$pecahPesanan["nama_barang"]; ?></td>
                        <td><?=$pecahPesanan["jumlah"]; ?></td>
                        <td><?=$pecahPesanan["keterangan"]; ?></td>
                        <td><?=$pecahPesanan["tanggal"]; ?></td>
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
                      <th>Status Pesanan</th>
                      <th>Nama Member</th>
                      <th>Departement</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>
                      <th>Tanggal</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="terkonfirmasi">

                <form action="src/components/ajax/riwayat_pesanan_terkonfirmasi.php" method="post" id="formTerkonfirmasi">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Departement</label>
                          <input type="hidden" class="form-control" value="<?=$pecahDept['id_departement']; ?>" name="departement">
                          <input type="text" class="form-control" value="<?=$pecahDept['kode_nama']; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Nama Barang</label>
                          <select class="form-control select2 select2bs4" style="width: 100%;" name="nama_barang" required>
                            <?php while($pecahBarang = $ambilBarang->fetch_assoc()) { ?>
                            <option value="<?=$pecahBarang['id_barang']; ?>">
                              <?=$pecahBarang["nama_barang"]; ?>
                            </option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                      <!-- Date range -->
                      <div class="form-group">
                        <label>Date range</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="text" class="form-control float-right" id="dateRange" name="date_range">
                        </div>
                        <!-- /.input group -->
                      </div>
                      <!-- /.form group -->
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary btn-block" id="btnLihat">Lihat</button>
                    </div>
                  </div>
                </form>

                <div class="mt-3" id="loadDataTerkonfirmasi">

                </div>

              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
    </div>
  </div>
</section>


<!-- JS File -->
<!-- Riwayat Pesanan -->
<script src="src/dist/js/ajax/riwayat_pesanan.js"></script>