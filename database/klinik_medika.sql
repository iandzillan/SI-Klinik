-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2021 at 07:26 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik_medika`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil_periksa`
--

CREATE TABLE `hasil_periksa` (
  `id` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_tindakan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_periksa`
--

INSERT INTO `hasil_periksa` (`id`, `id_pendaftaran`, `id_obat`, `id_tindakan`, `id_pegawai`) VALUES
(30, 17, 4, 9, 6),
(31, 17, 7, 9, 6),
(32, 17, 8, 9, 6),
(33, 19, 8, 7, 7),
(34, 19, 6, 7, 7),
(35, 19, 7, 7, 7),
(36, 19, 5, 7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `jenis`, `satuan`, `harga`, `stok`) VALUES
(4, 'Azithromycin 500 mg', 'Tablet', 'Tablet', 20000, 19),
(5, 'Cefixime 200 mg', 'Kapsul', 'Kotak', 15000, 24),
(6, 'Amoxicillin 500 mg', 'Tablet', 'Tablet', 25000, 22),
(7, 'Cefadroxil 500 mg', 'Kapsul', 'Kotak', 65000, 40),
(8, 'Ciprofloxacin 500 mg', 'Tablet', 'Kotak', 23000, 48);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `nohp` varchar(12) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama_pegawai`, `nohp`, `alamat`, `jk`) VALUES
(1, 'Ian Dzillan Malik', '082216651071', 'Jl. Rafflesia No.01, Ciwedus, Cilegon, Banten', 'L'),
(6, 'Kazuma Yagami', '082216651072', 'Jl. Rafflesia No.02, Ciwedus, Cilegon, Banten', 'L'),
(7, 'Rahmadiani', '082216651073', 'Jl. Rafflesia No.03, Ciwedus, Cilegon, Banten', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `id_tindakan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_pendaftaran`, `id_tindakan`, `id_pegawai`, `bayar`) VALUES
(4, 17, 9, 6, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `id_tindakan` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `jk` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` varchar(12) NOT NULL,
  `tanggal` date NOT NULL,
  `keluhan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `id_tindakan`, `id_wilayah`, `id_pegawai`, `nama_pasien`, `jk`, `alamat`, `nohp`, `tanggal`, `keluhan`, `status`) VALUES
(17, 9, 6, 6, 'Ardi', 'L', 'Bumiwaras No.01', '082216651075', '2021-09-15', 'Sakit kepala', 'Transaksi Selesai'),
(18, 8, 5, 6, 'Jaka', 'L', 'Perumahan Golden Cilegon, No.02', '082216651076', '2021-09-15', 'Tes covid', 'Dalam pemeriksaan'),
(19, 7, 7, 7, 'Nilna', 'P', 'Desa Kebun Kelapa, No.02', '082216651077', '2021-09-15', 'Tes Covid', 'Proses pembayaran'),
(20, 11, 8, 7, 'Retno', 'P', 'Desa Bojongsari, No.06', '082216651078', '2021-09-15', 'Sesak Nafas', 'Dalam pemeriksaan');

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `id` int(11) NOT NULL,
  `tindakan` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`id`, `tindakan`, `harga`) VALUES
(7, 'Tes Antigen', 150000),
(8, 'PCR', 900000),
(9, 'Cek Darah', 50000),
(10, 'Cek Kadar Gula', 60000),
(11, 'Pemeriksaan Paru Paru', 175000);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_obat`
--

CREATE TABLE `tmp_obat` (
  `id` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tmp_obat`
--

INSERT INTO `tmp_obat` (`id`, `id_pendaftaran`, `id_obat`) VALUES
(43, 18, 6),
(44, 18, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_pegawai`, `username`, `password`, `level`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(10, 6, 'kazuma', '9b534531f56f2849feeec30e43b30dcc', 'Dokter'),
(11, 7, 'Rahmadiani', '1b42cd944fd09d64c77e241113c24027', 'Dokter');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id` int(11) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id`, `provinsi`, `kota`, `kecamatan`, `kelurahan`) VALUES
(5, 'Banten', 'Cilegon', 'Cilegon', 'Ciwedus'),
(6, 'Banten', 'Cilegon', 'Pulomerak', 'Tamansari'),
(7, 'Banten', 'Serang', 'Serang', 'Cigoong'),
(8, 'Banten', 'Serang', 'Taktakan', 'Cibendung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil_periksa`
--
ALTER TABLE `hasil_periksa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tindakan_pasien` (`id_tindakan`),
  ADD KEY `fk_wilayah_pasien` (`id_wilayah`),
  ADD KEY `fk_pegawai_pasien` (`id_pegawai`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_obat`
--
ALTER TABLE `tmp_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pendaftaran` (`id_pendaftaran`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pegawai` (`id_pegawai`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil_periksa`
--
ALTER TABLE `hasil_periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tmp_obat`
--
ALTER TABLE `tmp_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
