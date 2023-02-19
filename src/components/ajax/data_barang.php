<?php

  // koneksi ke database
  require "../../connection/koneksi_database.php";

  // ambil semua data barang dari tabel barang
  $semuaDataBarang = "SELECT * FROM tbl_barang ORDER BY id_barang DESC";
  $ambilBarang = $conn->query($semuaDataBarang);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Semua Data Barang</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Pengelolaan Barang</li>
          <li class="breadcrumb-item active">Semua Data Barang</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

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
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Satuan Barang</th>
                <th>Harga Satuan</th>
                <th>Barang Datang</th>
                <th>Stok Awal</th>
                <th>Stok Akhir</th>
                <th>Gambar</th>
              </tr>
              </thead>
              <tbody>

                <?php 
                  $no = 1;
                  while($pecahBarang = $ambilBarang->fetch_assoc()) { 
                ?>
                <tr>
                    <td><?=$no; ?></td>
                    <td>
                      <a href="index.php?halaman=restok_barang&id=<?=$pecahBarang['id_barang']; ?>" class="btn btn-success btn-sm">ReStok</a>
                      <a href="index.php?halaman=update_barang&id=<?=$pecahBarang['id_barang']; ?>" class="btn btn-info btn-sm">Update</a>
                      <a href="src/components/ajax/hapus_barang.php?id=<?=$pecahBarang['id_barang']; ?>" class="btn btn-danger btn-sm" id="btnHapusBarang">Hapus</a>
                    </td>
                    <td><?=$pecahBarang["kode_barang"]; ?></td>
                    <td><?=$pecahBarang["nama_barang"]; ?></td>
                    <td><?=$pecahBarang["satuan_barang"]; ?></td>
                    <td><?=$pecahBarang["harga_satuan"]; ?></td>
                    <td><?=$pecahBarang["barang_datang"]; ?></td>
                    <td><?=$pecahBarang["stok_awal"]; ?></td>
                    <td><?=$pecahBarang["stok_akhir"]; ?></td>
                    <td>
                      <img src="src/dist/img/img_barang/<?=$pecahBarang['gambar']; ?>" class="img-thumbnail" alt="Gambar Barang">
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
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Satuan Barang</th>
                <th>Harga Satuan</th>
                <th>Barang Datang</th>
                <th>Stok Awal</th>
                <th>Stok Akhir</th>
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

<!-- JS File-->
<!-- Data Barang -->
<script src="src/dist/js/ajax/data_barang.js"></script>