<?php

  // cek siapa yang login
  if(!isset($_SESSION["admin"])) {
      if(isset($_SESSION["member"])) {
          echo "<script>location ='index.php?halaman=dashboard';</script>";
          exit();
      }
      else {
          echo "<script>location ='login.php';</script>";
          exit();
      }
  }

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Data Barang</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Pengelolaan Barang</li>
          <li class="breadcrumb-item active">Tambah Data Barang</li>
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
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Tambah Data Barang</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="src/components/ajax/tambah_barang.php" method="post" id="formTambahBarang" enctype="multipart/form-data">
            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" id="" placeholder="Nama Barang" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Satuan Barang</label>
                    <input type="text" name="satuan_barang" class="form-control" id="" placeholder="Satuan Barang" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Harga Satuan</label>
                    <input type="number" name="harga_satuan" class="form-control" id="" placeholder="Harga Satuan" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Barang Datang</label>
                    <input type="number" name="barang_datang" class="form-control" id="" placeholder="Barang Datang" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <!-- <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Stok Awal</label>
                    <input type="number" name="stok_awal" class="form-control" id="" placeholder="Stok Awal" required>
                  </div>
                </div> -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Gambar</label>
                    <input type="file" name="gambar" class="form-control" id="" placeholder="Gambar" required>
                  </div>
                </div>
              </div>
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" name="btn_simpan" class="btn btn-primary">Simpan</button>
              <a href="index.php?halaman=data_barang" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
        <!-- /.card -->
        </div>
      <!--/.col (left) -->
      <!-- right column -->
      
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- JS File-->
<!-- Tambah Barang -->
<script src="src/dist/js/ajax/tambah_barang.js"></script>
