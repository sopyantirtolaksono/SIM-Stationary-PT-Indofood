<?php

  // cek siapa yang login
  if(!isset($_SESSION["member"])) {
    if(isset($_SESSION["admin"])) {
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

  // ambil data member & departement ditabel member & departement
  $idMember           = $_SESSION["member"]["id_member"];
  $sqlMember          = "SELECT * FROM tbl_member JOIN tbl_departement ON tbl_member.id_departement = tbl_departement.id_departement WHERE tbl_member.id_member = '$idMember' ";
  $ambilMember        = $conn->query($sqlMember);
  $pecahMember        = $ambilMember->fetch_assoc();

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Form Pesanan Stationary</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item">Form Pesanan Stationary</li>
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
            <h3 class="card-title">Stationary</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="src/components/ajax/stationary.php" method="post" id="formPesananStationary">
            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Departement</label>
                    <input type="text" class="form-control" placeholder="Departement" value="<?=$pecahMember['kode_nama']; ?>" readonly disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" class="form-control" placeholder="Tanggal Sekarang" value="<?=date('Y/m/d'); ?>" readonly disabled>
                  </div>
                </div>
              </div>

              <hr>

              <div class="row" id="rowPesananStationary">

                <div class="col-md-5">
                  <div class="form-group">
                    <label>Nama Barang</label>
                    <select class="form-control select2 select2bs4" style="width: 100%;" name="nama_barang" required>
                      <?php while($pecahBarang = $ambilBarang->fetch_assoc()) { ?>

                      <?php if($pecahBarang["stok_akhir"] < 1) { ?>

                      <option disabled>
                        <?=$pecahBarang["nama_barang"]; ?> (Kosong)
                      </option>

                      <?php } else if($pecahBarang["stok_akhir"] >= 1) { ?>

                      <option value="<?=$pecahBarang['id_barang']; ?>">
                        <?=$pecahBarang["nama_barang"]; ?> (Stok: <?=$pecahBarang["stok_akhir"]; ?>)
                      </option>

                      <?php } else { ?>

                      <option disabled>
                        <?=$pecahBarang["nama_barang"]; ?> (Kosong)
                      </option>

                      <?php } ?>

                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="">
                      Jumlah
                    </label>
                    <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required>
                  </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" required>
                  </div>
                </div>
              </div>

              <div class="form-group row mt-2">
                <div class="col-md-12">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="kirimWA"> Kirim WhatsApp <i class="fab fa-whatsapp"></i></a>
                    </label>
                  </div>
                </div>
              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
        </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-6">

      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<!-- JS File -->
<!-- Stationary -->
<script src="src/dist/js/ajax/stationary.js"></script>