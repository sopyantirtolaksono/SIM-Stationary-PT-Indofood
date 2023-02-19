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

  // ambil id barang diURL
  $idBarang = $_GET["id"];

  // ambil data barang pada tabel barang sesuai id barang yang dikirim
  $dataBarang  = "SELECT * FROM tbl_barang WHERE id_barang = '$idBarang' ";
  $ambilBarang = $conn->query($dataBarang);
  $pecahBarang = $ambilBarang->fetch_assoc();

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Update Data Barang</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Pengelolaan Barang</li>
          <li class="breadcrumb-item active">Update Data Barang</li>
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
            <h3 class="card-title">Form Update Data Barang</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="src/components/ajax/update_barang.php" method="post" id="formUpdateBarang" enctype="multipart/form-data">
            <div class="card-body">

              <div class="row">

                <input type="hidden" name="id_barang" value="<?=$pecahBarang['id_barang']; ?>" required>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" id="" value="<?=$pecahBarang['nama_barang']; ?>" placeholder="Nama Barang" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Satuan Barang</label>
                    <input type="text" name="satuan_barang" class="form-control" id="" value="<?=$pecahBarang['satuan_barang']; ?>" placeholder="Satuan Barang" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Harga Satuan</label>
                    <input type="number" name="harga_satuan" class="form-control" id="" value="<?=$pecahBarang['harga_satuan']; ?>" placeholder="Harga Satuan" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Barang Datang</label>
                    <input type="number" name="barang_datang" class="form-control" id="" value="<?=$pecahBarang['barang_datang']; ?>" placeholder="Barang Datang" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Stok Awal</label>
                    <input type="number" name="stok_awal" class="form-control" id="" value="<?=$pecahBarang['stok_awal']; ?>" placeholder="Stok Awal" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Stok Akhir</label>
                    <input type="number" name="stok_akhir" class="form-control" id="" value="<?=$pecahBarang['stok_akhir']; ?>" placeholder="Stok Akhir" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Gambar</label>
                    <input type="file" name="gambar" class="form-control" id="" placeholder="Gambar">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <img src="src/dist/img/img_barang/<?=$pecahBarang['gambar']; ?>" class="img-thumbnail" width="50%" alt="Gambar Barang">
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

    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- JS File-->
<!-- Update Barang -->
<script src="src/dist/js/ajax/update_barang.js"></script>
