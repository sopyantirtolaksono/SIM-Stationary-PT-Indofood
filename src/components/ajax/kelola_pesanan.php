<?php

  // koneksi ke database
  require "../../connection/koneksi_database.php";

  // ambil data pesanan dari tabel pesanan
  $sqlPesanan = "SELECT * FROM tbl_pesanan JOIN tbl_member ON tbl_pesanan.id_member = tbl_member.id_member JOIN tbl_departement ON tbl_member.id_departement = tbl_departement.id_departement JOIN tbl_barang ON tbl_pesanan.id_barang = tbl_barang.id_barang WHERE tbl_pesanan.status_pesanan = 'menunggu' ";
  $ambilPesanan = $conn->query($sqlPesanan);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Pengelolaan Pesanan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item">Pengelolaan Pesanan</li>
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
            <h3 class="card-title">Data barang stationary</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
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
                      <?php if($pecahPesanan["stok_akhir"] < 1) { ?>

                      <a href="index.php?halaman=restok_barang&id=<?=$pecahPesanan['id_barang']; ?>" class="btn btn-primary btn-sm">ReStok</a>

                      <?php } else if($pecahPesanan["stok_akhir"] >= 1 ) { ?>

                      <a href="src/components/ajax/konfirmasi_pesanan.php?id=<?=$pecahPesanan['id_pesanan']; ?>" class="btn btn-success btn-sm" id="btnKonfirmasi">Konfirmasi</a>

                      <?php } else { ?>

                      <a href="index.php?halaman=data_barang" class="btn btn-info btn-sm">Detail</a>

                      <?php } ?>
                      
                    </td>
                    <td>
                      <?php if($pecahPesanan["stok_akhir"] < 1) { ?>

                      <small class="badge badge-warning">
                        <?=$pecahPesanan["status_pesanan"]; ?>
                      </small>
                      <small class="badge badge-danger">
                        stok kosong
                      </small>

                      <?php } else if($pecahPesanan["stok_akhir"] >= 1 ) { ?>

                      <small class="badge badge-warning">
                        <?=$pecahPesanan["status_pesanan"]; ?>
                      </small>

                      <?php } else { ?>

                      <small class="badge badge-danger">
                        ada kesalahan!
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
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
    </div>
  </div>
</section>

<!-- JS File-->
<!-- Kelola Pesanan -->
<script src="src/dist/js/ajax/kelola_pesanan.js"></script>