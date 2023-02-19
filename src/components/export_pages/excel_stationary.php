<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil date range di url
	$dateRange 	 = $_GET["val"];
	$dateRange 	 = explode("-", $dateRange);
	$tglMulai  	 = $dateRange[0];
	$tglSelesai  = $dateRange[1];

	// ambil data departement
	$sqlDept 	 = "SELECT * FROM tbl_departement";
	$ambilDept 	 = $conn->query($sqlDept);
	// ambil data barang
	$sqlBarang	 = "SELECT * FROM tbl_barang";
    $ambilBarang = $conn->query($sqlBarang);

    // script export to excel
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data_Stock_dan_Penggunaan_Stationary.xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Export Data Stock & Penggunaan Stationary</title>
</head>
<body>

	<h3 style="text-align: center; margin-bottom: 20px;">
		DATA STOCK DAN PENGGUNAAN BARANG<br>
		(<?php echo $tglMulai." - ".$tglSelesai; ?>)
	</h3>

	<table border="2" width="100%" cellpadding="10" cellspacing="0">
		<thead>
			<tr>
				<th rowspan="2">No.</th>
				<th rowspan="2">Nama Barang</th>
				<th rowspan="2">Satuan</th>
				<th rowspan="2">Barang Datang</th>
				<th rowspan="2">Stok Awal</th>
				<th rowspan="2">Stok Akhir</th>
				<th colspan="12">Penggunaan Week</th>
			</tr>
			<tr>
				<?php while($pecahDept = $ambilDept->fetch_assoc()) { ?>
					<th><?=$pecahDept["kode_nama"]; ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>

			<?php 
				$no = 1;
				while($pecahBarang = $ambilBarang->fetch_assoc()) { 
			?>
			<tr>
				<td align="center"><?=$no; ?></td>
				<td><?=$pecahBarang["nama_barang"]; ?></td>
				<td><?=$pecahBarang["satuan_barang"]; ?></td>
				<td align="center"><?=$pecahBarang["barang_datang"]; ?></td>
				<td align="center"><?=$pecahBarang["stok_awal"]; ?></td>
				<td align="center"><?=$pecahBarang["stok_akhir"]; ?></td>
				<td align="center">
					<?php 
						$sqlPenggunaanAcct = "SELECT * FROM tbl_riwayat_pesanan WHERE nama_barang = '$pecahBarang[nama_barang]' AND kode_nama = 'ACCT' AND tanggal BETWEEN '$tglMulai' AND '$tglSelesai' ";
    					$ambilPenggunaanAcct = $conn->query($sqlPenggunaanAcct);
    					$totalPenggunaanAcct = 0;
    					while($pecahPenggunaanAcct = $ambilPenggunaanAcct->fetch_assoc()) {
    						$totalPenggunaanAcct += $pecahPenggunaanAcct["jumlah"];
    					}
    					echo $totalPenggunaanAcct;
					?>
				</td>
				<td align="center">
					<?php 
						$sqlPenggunaanMgt = "SELECT * FROM tbl_riwayat_pesanan WHERE nama_barang = '$pecahBarang[nama_barang]' AND kode_nama = 'MGT' AND tanggal BETWEEN '$tglMulai' AND '$tglSelesai' ";
    					$ambilPenggunaanMgt = $conn->query($sqlPenggunaanMgt);
    					$totalPenggunaanMgt = 0;
    					while($pecahPenggunaanMgt = $ambilPenggunaanMgt->fetch_assoc()) {
    						$totalPenggunaanMgt += $pecahPenggunaanMgt["jumlah"];
    					}
    					echo $totalPenggunaanMgt;
					?>
				</td>
				<td align="center">
					<?php 
						$sqlPenggunaanMkt = "SELECT * FROM tbl_riwayat_pesanan WHERE nama_barang = '$pecahBarang[nama_barang]' AND kode_nama = 'MKT' AND tanggal BETWEEN '$tglMulai' AND '$tglSelesai' ";
    					$ambilPenggunaanMkt = $conn->query($sqlPenggunaanMkt);
    					$totalPenggunaanMkt = 0;
    					while($pecahPenggunaanMkt = $ambilPenggunaanMkt->fetch_assoc()) {
    						$totalPenggunaanMkt += $pecahPenggunaanMkt["jumlah"];
    					}
    					echo $totalPenggunaanMkt;
					?>
				</td>
				<td align="center">
					<?php 
						$sqlPenggunaanMfg = "SELECT * FROM tbl_riwayat_pesanan WHERE nama_barang = '$pecahBarang[nama_barang]' AND kode_nama = 'MFG' AND tanggal BETWEEN '$tglMulai' AND '$tglSelesai' ";
    					$ambilPenggunaanMfg = $conn->query($sqlPenggunaanMfg);
    					$totalPenggunaanMfg = 0;
    					while($pecahPenggunaanMfg = $ambilPenggunaanMfg->fetch_assoc()) {
    						$totalPenggunaanMfg += $pecahPenggunaanMfg["jumlah"];
    					}
    					echo $totalPenggunaanMfg;
					?>
				</td>
				<td align="center">
					<?php 
						$sqlPenggunaanQc = "SELECT * FROM tbl_riwayat_pesanan WHERE nama_barang = '$pecahBarang[nama_barang]' AND kode_nama = 'QC' AND tanggal BETWEEN '$tglMulai' AND '$tglSelesai' ";
    					$ambilPenggunaanQc = $conn->query($sqlPenggunaanQc);
    					$totalPenggunaanQc = 0;
    					while($pecahPenggunaanQc = $ambilPenggunaanQc->fetch_assoc()) {
    						$totalPenggunaanQc += $pecahPenggunaanQc["jumlah"];
    					}
    					echo $totalPenggunaanQc;
					?>
				</td>
				<td align="center">
					<?php 
						$sqlPenggunaanDist = "SELECT * FROM tbl_riwayat_pesanan WHERE nama_barang = '$pecahBarang[nama_barang]' AND kode_nama = 'DIST' AND tanggal BETWEEN '$tglMulai' AND '$tglSelesai' ";
    					$ambilPenggunaanDist = $conn->query($sqlPenggunaanDist);
    					$totalPenggunaanDist = 0;
    					while($pecahPenggunaanDist = $ambilPenggunaanDist->fetch_assoc()) {
    						$totalPenggunaanDist += $pecahPenggunaanDist["jumlah"];
    					}
    					echo $totalPenggunaanDist;
					?>
				</td>
				<td align="center">
					<?php 
						$sqlPenggunaanWh = "SELECT * FROM tbl_riwayat_pesanan WHERE nama_barang = '$pecahBarang[nama_barang]' AND kode_nama = 'WH' AND tanggal BETWEEN '$tglMulai' AND '$tglSelesai' ";
    					$ambilPenggunaanWh = $conn->query($sqlPenggunaanWh);
    					$totalPenggunaanWh = 0;
    					while($pecahPenggunaanWh = $ambilPenggunaanWh->fetch_assoc()) {
    						$totalPenggunaanWh += $pecahPenggunaanWh["jumlah"];
    					}
    					echo $totalPenggunaanWh;
					?>
				</td>
				<td align="center">
					<?php 
						$sqlPenggunaanPpic = "SELECT * FROM tbl_riwayat_pesanan WHERE nama_barang = '$pecahBarang[nama_barang]' AND kode_nama = 'PPIC' AND tanggal BETWEEN '$tglMulai' AND '$tglSelesai' ";
    					$ambilPenggunaanPpic = $conn->query($sqlPenggunaanPpic);
    					$totalPenggunaanPpic = 0;
    					while($pecahPenggunaanPpic = $ambilPenggunaanPpic->fetch_assoc()) {
    						$totalPenggunaanPpic += $pecahPenggunaanPpic["jumlah"];
    					}
    					echo $totalPenggunaanPpic;
					?>
				</td>
				<td align="center">
					<?php 
						$sqlPenggunaanTek = "SELECT * FROM tbl_riwayat_pesanan WHERE nama_barang = '$pecahBarang[nama_barang]' AND kode_nama = 'TEK' AND tanggal BETWEEN '$tglMulai' AND '$tglSelesai' ";
    					$ambilPenggunaanTek = $conn->query($sqlPenggunaanTek);
    					$totalPenggunaanTek = 0;
    					while($pecahPenggunaanTek = $ambilPenggunaanTek->fetch_assoc()) {
    						$totalPenggunaanTek += $pecahPenggunaanTek["jumlah"];
    					}
    					echo $totalPenggunaanTek;
					?>
				</td>
				<td align="center">
					<?php 
						$sqlPenggunaanPurc = "SELECT * FROM tbl_riwayat_pesanan WHERE nama_barang = '$pecahBarang[nama_barang]' AND kode_nama = 'PURC' AND tanggal BETWEEN '$tglMulai' AND '$tglSelesai' ";
    					$ambilPenggunaanPurc = $conn->query($sqlPenggunaanPurc);
    					$totalPenggunaanPurc = 0;
    					while($pecahPenggunaanPurc = $ambilPenggunaanPurc->fetch_assoc()) {
    						$totalPenggunaanPurc += $pecahPenggunaanPurc["jumlah"];
    					}
    					echo $totalPenggunaanPurc;
					?>
				</td>
				<td align="center">
					<?php 
						$sqlPenggunaanProd = "SELECT * FROM tbl_riwayat_pesanan WHERE nama_barang = '$pecahBarang[nama_barang]' AND kode_nama = 'PROD' AND tanggal BETWEEN '$tglMulai' AND '$tglSelesai' ";
    					$ambilPenggunaanProd = $conn->query($sqlPenggunaanProd);
    					$totalPenggunaanProd = 0;
    					while($pecahPenggunaanProd = $ambilPenggunaanProd->fetch_assoc()) {
    						$totalPenggunaanProd += $pecahPenggunaanProd["jumlah"];
    					}
    					echo $totalPenggunaanProd;
					?>
				</td>
				<td align="center">
					<?php 
						$sqlPenggunaanHr = "SELECT * FROM tbl_riwayat_pesanan WHERE nama_barang = '$pecahBarang[nama_barang]' AND kode_nama = 'HR' AND tanggal BETWEEN '$tglMulai' AND '$tglSelesai' ";
    					$ambilPenggunaanHr = $conn->query($sqlPenggunaanHr);
    					$totalPenggunaanHr = 0;
    					while($pecahPenggunaanHr = $ambilPenggunaanHr->fetch_assoc()) {
    						$totalPenggunaanHr += $pecahPenggunaanHr["jumlah"];
    					}
    					echo $totalPenggunaanHr;
					?>
				</td>
			</tr>
			<?php 
				$no++;
				} 
			?>

		</tbody>
	</table>
	
</body>
</html>