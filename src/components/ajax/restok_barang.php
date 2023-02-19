<?php

  // koneksi ke database
  require "../../connection/koneksi_database.php";

  // ambil id barang
  $idBarang = $_POST["id"];

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
        <h1 class="m-0 text-dark">ReStok Barang</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Pengelolaan Barang</li>
          <li class="breadcrumb-item active">ReStok Barang</li>
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
            <h3 class="card-title">Form ReStok Barang</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="src/components/ajax/restok.php" method="post" id="formReStok">
            <div class="card-body">

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input type="text" class="form-control" placeholder="Nama Barang" value="<?=$pecahBarang['nama_barang']; ?>" disabled></div>
                </div>
              </div>

              <div id="loadStok">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Barang Datang(Lama)</label>
                    <input type="number" name="" class="form-control" id="" value="<?=$pecahBarang['barang_datang']; ?>" placeholder="Barang Datang" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Stok Awal</label>
                    <input type="number" name="" class="form-control" id="" value="<?=$pecahBarang['stok_awal']; ?>" placeholder="Stok Awal" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Stok Akhir</label>
                    <input type="number" name="" class="form-control" id="" value="<?=$pecahBarang['stok_akhir']; ?>" placeholder="Stok Akhir" disabled>
                  </div>
                </div>
              </div>
              </div>

              <div class="row">

                <input type="hidden" name="id_barang" value="<?=$pecahBarang['id_barang']; ?>" required>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Barang Datang(Baru)</label>
                    <input type="number" name="barang_datang" class="form-control" id="" placeholder="Barang Datang(Baru)" required>
                  </div>
                </div>
              </div>
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" name="btn_simpan" class="btn btn-primary">Simpan</button>
              <a href="index.php?halaman=data_barang" class="btn btn-secondary">Kembali</a>
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
<!-- ReStok Barang -->
<script src="src/dist/js/ajax/restok_barang.js"></script>
<script type="text/javascript">
  
  function loadStok() {
    <?php GLOBAL $idBarang; ?>
    let id = <?php echo json_encode($idBarang); ?>;
    $("div#loadStok").load("src/components/ajax/load_stok.php?id="+id);
  }

</script>