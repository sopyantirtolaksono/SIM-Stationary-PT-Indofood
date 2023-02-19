-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2021 at 08:25 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stationary`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `nomor_induk_pegawai` varchar(255) NOT NULL,
  `status_user` varchar(255) NOT NULL DEFAULT 'admin',
  `gambar` varchar(255) NOT NULL DEFAULT 'img_default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `jenis_kelamin`, `email`, `alamat`, `telepon`, `nomor_induk_pegawai`, `status_user`, `gambar`) VALUES
(1, '@muzakki', '$2y$10$DshX36dH0HEGKWK34kE2eeAZPkQyEuuv2k1hDy3Y2UjcGyM.INUTi', 'M Inam Muzakki', 'pria', 'muzakki@gmail.com', 'Ngaliyan, Semarang', '081123456789', '50112658', 'admin', 'img_default.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan_barang` varchar(255) NOT NULL,
  `harga_satuan` int(255) NOT NULL,
  `barang_datang` int(255) NOT NULL,
  `stok_awal` int(255) NOT NULL,
  `stok_akhir` int(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `kode_barang`, `nama_barang`, `satuan_barang`, `harga_satuan`, `barang_datang`, `stok_awal`, `stok_akhir`, `gambar`) VALUES
(8, 'KS001', 'HVS', 'Rim', 50000, 5, 10, 0, '611130fc2aec8_no-img.png'),
(9, 'KS002', 'PENA', 'PCS', 2000, 50, 50, 38, '613078736d11a_no-img.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departement`
--

CREATE TABLE `tbl_departement` (
  `id_departement` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_departement`
--

INSERT INTO `tbl_departement` (`id_departement`, `nama`, `kode_nama`) VALUES
(1, 'Accounting', 'ACCT'),
(2, 'Management', 'MGT'),
(3, 'Marketing', 'MKT'),
(4, 'Manufakturing', 'MFG'),
(5, 'PDQC', 'QC'),
(6, 'Distribusi', 'DIST'),
(7, 'Warehouse', 'WH'),
(8, 'PPIC', 'PPIC'),
(9, 'Teknik', 'TEK'),
(10, 'Purchasing', 'PURC'),
(11, 'Produksi', 'PROD'),
(12, 'HR', 'HR');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `id_member` int(11) NOT NULL,
  `id_departement` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `nomor_induk_pegawai` varchar(255) NOT NULL,
  `status_user` varchar(255) NOT NULL DEFAULT 'member',
  `gambar` varchar(255) NOT NULL DEFAULT 'img_default.png',
  `tanggal_gabung` varchar(255) NOT NULL,
  `verifikasi` varchar(255) NOT NULL DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id_member`, `id_departement`, `username`, `password`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `email`, `telepon`, `nomor_induk_pegawai`, `status_user`, `gambar`, `tanggal_gabung`, `verifikasi`) VALUES
(5, 1, '@yap', '$2y$10$ZT5LFmBJxKnDTO0Px8OMoe5/zYVJE6wcN7gkm4WsGY9AoKlv.xuR2', 'Yohanes Adi Prayogo', 'pria', '', 'yohanesadip@gmail.com', '', '21140878', 'member', 'img_default.png', '2021/08/09', 'sudah'),
(6, 12, '@ajisp', '$2y$10$JvifVqffq7bdsKf4mlCFA.UlAeqlbVwXsL/JPBkKQ0NCt11Wd2OWe', 'Aji Syahputra', 'pria', 'Jakarta, Indonesia', 'aji_sp@gmail.com', '083842885661', '21150877', 'member', 'img_default.png', '2021/09/02', 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_pesanan` varchar(255) NOT NULL DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `id_barang`, `id_member`, `tanggal`, `jumlah`, `keterangan`, `status_pesanan`) VALUES
(1, 9, 5, '2021/09/03', 3, '-', 'menunggu'),
(2, 9, 5, '2021/09/03', 5, '-', 'menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_riwayat_pesanan`
--

CREATE TABLE `tbl_riwayat_pesanan` (
  `id_riwayat_pesanan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan_barang` varchar(255) NOT NULL,
  `barang_datang` int(255) NOT NULL,
  `stok_awal` int(255) NOT NULL,
  `stok_akhir` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nomor_induk_pegawai` varchar(255) NOT NULL,
  `kode_nama` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `tanggal_konfirmasi` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_pesanan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_riwayat_pesanan`
--

INSERT INTO `tbl_riwayat_pesanan` (`id_riwayat_pesanan`, `id_pesanan`, `id_member`, `id_barang`, `id_departement`, `kode_barang`, `nama_barang`, `satuan_barang`, `barang_datang`, `stok_awal`, `stok_akhir`, `username`, `nama_lengkap`, `nomor_induk_pegawai`, `kode_nama`, `tanggal`, `tanggal_konfirmasi`, `jumlah`, `keterangan`, `status_pesanan`) VALUES
(1, 20, 5, 8, 1, 'KS001', 'HVS', 'Rim', 50, 100, 90, '@yap', 'Yohanes Adi Prayogo', '21140878', 'ACCT', '2021/08/18', '2021/08/18', 10, '-', 'terkonfirmasi'),
(2, 21, 5, 8, 1, 'KS001', 'HVS', 'Rim', 50, 100, 40, '@yap', 'Yohanes Adi Prayogo', '21140878', 'ACCT', '2021/08/18', '2021/08/18', 50, '-', 'terkonfirmasi'),
(3, 22, 5, 8, 1, 'KS001', 'HVS', 'Rim', 50, 100, -10, '@yap', 'Yohanes Adi Prayogo', '21140878', 'ACCT', '2021/08/18', '2021/08/18', 50, '-', 'terkonfirmasi'),
(4, 23, 5, 8, 1, 'KS001', 'HVS', 'Rim', 50, 100, 8, '@yap', 'Yohanes Adi Prayogo', '21140878', 'ACCT', '2021/08/18', '2021/08/18', 2, '-', 'terkonfirmasi'),
(5, 24, 5, 8, 1, 'KS001', 'HVS', 'Rim', 5, 10, 0, '@yap', 'Yohanes Adi Prayogo', '21140878', 'ACCT', '2021/08/18', '2021/08/19', 10, '-', 'terkonfirmasi'),
(6, 25, 5, 8, 1, 'KS001', 'HVS', 'Rim', 5, 10, 8, '@yap', 'Yohanes Adi Prayogo', '21140878', 'ACCT', '2021/08/19', '2021/08/19', 2, '-', 'terkonfirmasi'),
(7, 26, 5, 8, 1, 'KS001', 'HVS', 'Rim', 5, 10, 0, '@yap', 'Yohanes Adi Prayogo', '21140878', 'ACCT', '2021/08/19', '2021/09/02', 10, '-', 'terkonfirmasi'),
(8, 27, 5, 9, 1, 'KS002', 'PENA', 'PCS', 50, 50, 48, '@yap', 'Yohanes Adi Prayogo', '21140878', 'ACCT', '2021/09/02', '2021/09/02', 2, '-', 'terkonfirmasi'),
(9, 28, 6, 9, 12, 'KS002', 'PENA', 'PCS', 50, 50, 38, '@ajisp', 'Aji Syahputra', '21150877', 'HR', '2021/09/02', '2021/09/02', 10, '-', 'terkonfirmasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_departement`
--
ALTER TABLE `tbl_departement`
  ADD PRIMARY KEY (`id_departement`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_member` (`id_member`);

--
-- Indexes for table `tbl_riwayat_pesanan`
--
ALTER TABLE `tbl_riwayat_pesanan`
  ADD PRIMARY KEY (`id_riwayat_pesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_departement`
--
ALTER TABLE `tbl_departement`
  MODIFY `id_departement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_riwayat_pesanan`
--
ALTER TABLE `tbl_riwayat_pesanan`
  MODIFY `id_riwayat_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD CONSTRAINT `tbl_pesanan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tbl_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_2` FOREIGN KEY (`id_member`) REFERENCES `tbl_member` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
