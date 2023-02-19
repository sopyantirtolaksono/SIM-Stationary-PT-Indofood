<?php

	 // koneksi ke database
  	require "../../connection/koneksi_database.php";

  	// jika data sudah dikirim
  	if(isset($_POST["nama_barang"])) {
      // ambil datanya + beri function htmlspecialchars
      $departement = htmlspecialchars($_POST["departement"]);
  		$namaBarang  = htmlspecialchars($_POST["nama_barang"]);
		  $dateRange   = htmlspecialchars($_POST["date_range"]);
      // beri function mysqli_real_escape_string
      $departement = mysqli_real_escape_string($conn, $departement);
      $namaBarang  = mysqli_real_escape_string($conn, $namaBarang);
      $dateRange   = mysqli_real_escape_string($conn, $dateRange);

      // merubah date range bertipe data string menjadi array
  		$explodeDateRange = explode(" - ", $dateRange);
  		$dateRange1  = $explodeDateRange[0];
  		$dateRange2  = $explodeDateRange[1];

      // buat variabel baru dengan nilainya array kosong
  		$semuaData = array();
  		
      // pencarian data penggunaan barang
  		$sqlPenggunaan = "SELECT * FROM tbl_riwayat_pesanan WHERE id_departement = '$departement' AND id_barang = '$namaBarang' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ORDER BY id_riwayat_pesanan DESC ";
  		$ambilData = $conn->query($sqlPenggunaan);
  		$status = $ambilData->num_rows;
      // lakukan perulangan data yg didapat
  		while($pecahData = $ambilData->fetch_assoc()) {
        // masukkan data yg didapat pada variabel $semuaData[]
  			$semuaData[] = $pecahData;
  		}

  	}

?>

<div class="card-body table-responsive p-0">
    <table id="example1" class="table table-bordered table-striped">
      	<thead>
	      	<tr>
                <th>No</th>
                <th>Status Pesanan</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Departement</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
      		</tr>
      	</thead>

        <!-- cek statusnya, jika ada data dan tidak -->
      	<?php if($status > 0) { ?>

     	<tbody>

     		<?php
          $total = 0;
		    	foreach($semuaData as $data => $value) :
            $total += $value["jumlah"];
		    ?>
		    <tr>
		        <td><?=$data+1; ?></td>
            <td><?=$value["status_pesanan"]; ?></td>
		        <td><?=$value["nama_barang"]; ?></td>
		        <td><?=$value["satuan_barang"]; ?></td>
		        <td><?=$value["kode_nama"]; ?></td>
		        <td><?=$value["tanggal"]; ?></td>
		        <td><?=$value["keterangan"]; ?></td>
		        <td><?=$value["jumlah"]; ?></td>
		    </tr>
		    <?php
		    	endforeach;
		    ?>

      	</tbody>
      	
      	<?php } else { ?>

    		<tbody>
  		    <tr>
  		        <td colspan="8" class="text-center">No matching records found</td>
  		    </tr>
    		</tbody>

      	<?php } ?>

      	<tfoot>
      		<tr>
              <th>&nbsp;&nbsp;No</th>
              <th>Status Pesanan</th>
              <th>Nama Barang</th>
              <th>Satuan</th>
              <th>Departement</th>
              <th>Tanggal</th>
              <th>Keterangan</th>
              <th>Jumlah</th>
      		</tr>

          <?php if($status > 0) { ?>
          <tr>
            <th colspan="8" class="text-center">
              <h6>Total <strong><?=$value["nama_barang"]; ?></strong> yang digunakkan dari tanggal <strong><?=$dateRange1; ?> - <?=$dateRange2; ?></strong> adalah <strong><?=$total." ".$value["satuan_barang"]; ?></strong></h6>
            </th>
          </tr>
          <?php } ?>
      	</tfoot>
    </table>
</div>
<!-- /.card-body -->