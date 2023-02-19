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

  // ambil data barang ditabel barang
  $sqlBarang        = "SELECT * FROM tbl_barang";
  $ambilBarang      = $conn->query($sqlBarang);

  // ambil data departement ditabel departement
  $sqlDept          = "SELECT * FROM tbl_departement";
  $ambilDept        = $conn->query($sqlDept);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Penggunaan Barang</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Pengelolaan Barang</li>
          <li class="breadcrumb-item active">Penggunaan Barang</li>
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
            <br><br>

            <form action="src/components/ajax/penggunaan_barang.php" method="post" id="formPenggunaanBarang">
            <div class="row">
              <div class="col-md-3">
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
              <div class="col-md-3">
                <div class="form-group">
                    <label>Departement</label>
                    <select class="form-control select2 select2bs4" style="width: 100%;" name="departement" required>
                      <?php while($pecahDept = $ambilDept->fetch_assoc()) { ?>
                      <option value="<?=$pecahDept['id_departement']; ?>">
                        <?=$pecahDept["kode_nama"]; ?>
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

              <div class="col-md-2">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <a href="src/components/export_pages/excel_stationary.php?val=" class="btn btn-success btn-block" id="btnDownloadExcel">Download Excel</a>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block" id="btnLihat">Lihat</button>
              </div>
            </div>
            </form>

          </div>
          <!-- /.card-header -->

          <div id="loadData">

          </div>

        </div>
        <!-- /.card -->

      </div>
    </div>
  </div>
</section>


<!-- JS File-->
<!-- Penggunaan Barang -->
<script src="src/dist/js/ajax/penggunaan_barang.js"></script>
