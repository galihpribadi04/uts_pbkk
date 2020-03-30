-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Okt 2019 pada 08.49
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `barang_id` varchar(15) NOT NULL,
  `barang_nama` text DEFAULT NULL,
  `barang_satuan` text DEFAULT NULL,
  `barang_harpok` double DEFAULT NULL,
  `barang_harjul` double DEFAULT NULL,
  `barang_harjul_grosir` double DEFAULT NULL,
  `barang_stok` int(11) DEFAULT 0,
  `barang_min_stok` int(11) DEFAULT 0,
  `barang_tgl_input` timestamp NULL DEFAULT current_timestamp(),
  `barang_tgl_last_update` datetime DEFAULT NULL,
  `barang_kategori_id` int(11) DEFAULT NULL,
  `barang_user_id` int(11) DEFAULT NULL,
  `barang_suplier_id` int(11) DEFAULT NULL,
  `barang_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`barang_id`, `barang_nama`, `barang_satuan`, `barang_harpok`, `barang_harjul`, `barang_harjul_grosir`, `barang_stok`, `barang_min_stok`, `barang_tgl_input`, `barang_tgl_last_update`, `barang_kategori_id`, `barang_user_id`, `barang_suplier_id`, `barang_desc`) VALUES
('A000001', 'Slow cooker maspion-MSC1825', 'Unit', 10000, 15000, 12000, 20, 20, '2019-10-12 10:28:59', NULL, 41, 4, 6, 'al;sdkl;askd'),
('A000002', 'Piring Kaca', 'Unit', 15000, 18000, 16000, 120, 20, '2019-10-12 10:29:33', NULL, 41, 4, 6, ''),
('A000003', 'gelas kaca', 'Unit', 15000, 20000, 30000, 200, 20, '2019-10-20 08:39:46', NULL, NULL, 4, 6, 'Jalanin aja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_beli`
--

CREATE TABLE `tbl_beli` (
  `beli_kode` varchar(15) NOT NULL,
  `beli_tanggal` date DEFAULT NULL,
  `beli_suplier_id` int(11) DEFAULT NULL,
  `beli_user_id` int(11) DEFAULT NULL,
  `beli_total` text DEFAULT NULL,
  `beli_path` varchar(255) DEFAULT NULL,
  `beli_status` int(2) DEFAULT NULL,
  `create_date_jual` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_beli`
--

INSERT INTO `tbl_beli` (`beli_kode`, `beli_tanggal`, `beli_suplier_id`, `beli_user_id`, `beli_total`, `beli_path`, `beli_status`, `create_date_jual`) VALUES
('BL191019000001', '2019-11-09', 6, 4, '2000000', '2019-10-19_1571466007_repository-open-graph-template.png', 0, '2019-10-19 13:20:09'),
('BL191019000002', '2019-10-31', 6, 4, '2000000', '2019-10-19_1571466796_repository-open-graph-template.png', 0, '2019-10-19 13:33:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_beli`
--

CREATE TABLE `tbl_detail_beli` (
  `d_beli_id` int(11) NOT NULL,
  `d_beli_barang_id` varchar(15) DEFAULT NULL,
  `d_beli_harga` double DEFAULT NULL,
  `d_beli_jumlah` int(11) DEFAULT NULL,
  `d_beli_total` double DEFAULT NULL,
  `d_beli_kode` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_detail_beli`
--

INSERT INTO `tbl_detail_beli` (`d_beli_id`, `d_beli_barang_id`, `d_beli_harga`, `d_beli_jumlah`, `d_beli_total`, `d_beli_kode`) VALUES
(15, 'A000001', 10000, 20, 200000, 'BL191019000001'),
(16, 'A000002', 15000, 20, 300000, 'BL191019000001'),
(17, 'A000001', 10000, 200, 2000000, 'BL191019000002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_jual`
--

CREATE TABLE `tbl_detail_jual` (
  `d_jual_id` int(11) NOT NULL,
  `d_jual_nofak` varchar(15) DEFAULT NULL,
  `d_jual_barang_id` varchar(15) DEFAULT NULL,
  `d_jual_barang_nama` varchar(150) DEFAULT NULL,
  `d_jual_barang_satuan` varchar(30) DEFAULT NULL,
  `d_jual_barang_harpok` double DEFAULT NULL,
  `d_jual_barang_harjul` double DEFAULT NULL,
  `d_jual_qty` int(11) DEFAULT NULL,
  `d_jual_diskon` double DEFAULT NULL,
  `d_jual_total_diskon` double DEFAULT NULL,
  `d_jual_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_detail_jual`
--

INSERT INTO `tbl_detail_jual` (`d_jual_id`, `d_jual_nofak`, `d_jual_barang_id`, `d_jual_barang_nama`, `d_jual_barang_satuan`, `d_jual_barang_harpok`, `d_jual_barang_harjul`, `d_jual_qty`, `d_jual_diskon`, `d_jual_total_diskon`, `d_jual_total`) VALUES
(49, 'PJ121019000001', 'A000001', 'Gelas kaca', 'Unit', 10000, 12000, 20, 20, 48000, 192000),
(50, 'PJ121019000001', 'A000002', 'Piring Kaca', 'Unit', 15000, 16000, 20, 10, 32000, 288000),
(51, 'PJ121019000002', 'A000002', 'Piring Kaca', 'Unit', 15000, 16000, 50, 10, 80000, 720000),
(52, 'PJ121019000002', 'A000001', 'Gelas kaca', 'Unit', 10000, 12000, 20, 10, 24000, 216000),
(53, 'PJ121019000003', 'A000002', 'Piring Kaca', 'Unit', 15000, 16000, 30, 30, 144000, 336000),
(54, 'PJ121019000003', 'A000001', 'Gelas kaca', 'Unit', 10000, 12000, 60, 30, 216000, 504000),
(55, 'PJ191019000004', 'A000001', 'Gelas kaca', 'Unit', 10000, 12000, 20, 20, 48000, 192000),
(56, 'PJ191019000005', 'A000001', 'Gelas kaca', 'Unit', 10000, 12000, 200, 10, 240000, 2160000),
(57, 'PJ201019000006', 'A000001', 'Slow cooker maspion-MSC1825', 'Unit', 10000, 12000, 100, 20, 240000, 960000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_retur`
--

CREATE TABLE `tbl_detail_retur` (
  `id` int(11) NOT NULL,
  `d_retur_id` varchar(50) DEFAULT NULL,
  `d_retur_barang_id` varchar(50) DEFAULT NULL,
  `d_retur_barang` text NOT NULL,
  `d_retur_harga` double DEFAULT NULL,
  `d_retur_qty` double DEFAULT NULL,
  `d_retur_total` double DEFAULT NULL,
  `d_retur_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_detail_retur`
--

INSERT INTO `tbl_detail_retur` (`id`, `d_retur_id`, `d_retur_barang_id`, `d_retur_barang`, `d_retur_harga`, `d_retur_qty`, `d_retur_total`, `d_retur_desc`) VALUES
(1, 'RT261019000002', 'A000001', 'Slow cooker maspion-MSC1825', 15000, 1, 15000, 'rusak'),
(2, 'RT261019000002', 'A000002', 'Piring Kaca', 18000, 1, 18000, 'ancur'),
(3, 'RT261019000003', 'A000001', 'Slow cooker maspion-MSC1825', 15000, 1, 15000, 'rusak'),
(4, 'RT261019000003', 'A000002', 'Piring Kaca', 18000, 1, 18000, 'rusak bgd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jual`
--

CREATE TABLE `tbl_jual` (
  `jual_nofak` varchar(15) NOT NULL,
  `jual_tanggal` datetime DEFAULT current_timestamp(),
  `jual_total` double DEFAULT NULL,
  `jual_total_diskon` double DEFAULT NULL,
  `jual_jml_uang` double DEFAULT NULL,
  `jual_kembalian` double DEFAULT NULL,
  `jual_user_id` int(11) DEFAULT NULL,
  `jual_keterangan` varchar(20) DEFAULT NULL,
  `jual_pembeli` varchar(30) NOT NULL,
  `jual_status` int(11) DEFAULT NULL,
  `create_date_jual` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jual`
--

INSERT INTO `tbl_jual` (`jual_nofak`, `jual_tanggal`, `jual_total`, `jual_total_diskon`, `jual_jml_uang`, `jual_kembalian`, `jual_user_id`, `jual_keterangan`, `jual_pembeli`, `jual_status`, `create_date_jual`) VALUES
('PJ121019000001', '2019-10-12 17:30:12', 480000, 80000, 500000, 20000, 4, 'eceran', 'P0002', 1, '2019-10-12 17:30:12'),
('PJ121019000002', '2019-10-12 17:30:47', 936000, 104000, 1000000, 64000, 4, 'grosir', 'P0003', 1, '2019-10-12 17:30:47'),
('PJ121019000003', '2019-10-23 00:00:00', 840000, 360000, 20000000, 0, 5, 'sales', 'P0002', 1, '2019-10-12 17:31:29'),
('PJ191019000004', '2019-10-31 00:00:00', 192000, 48000, 192000, 0, 5, 'sales', 'P0001', 1, '2019-10-19 13:11:03'),
('PJ191019000005', '2019-10-24 00:00:00', 2160000, 240000, 20000000, 0, 5, 'sales', 'P0002', 1, '2019-10-19 14:43:18'),
('PJ201019000006', '2019-10-31 00:00:00', 960000, 240000, 960000, 0, 6, 'sales', 'P0003', 1, '2019-10-20 16:03:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`kategori_id`, `kategori_nama`) VALUES
(40, 'gelas'),
(41, 'piring');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `pelanggan_id` varchar(15) NOT NULL,
  `pelanggan_nama` varchar(50) NOT NULL,
  `pelanggan_alamat` varchar(50) NOT NULL,
  `pelanggan_notlpn` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`pelanggan_id`, `pelanggan_nama`, `pelanggan_alamat`, `pelanggan_notlpn`) VALUES
('P0001', 'Bahyu Sanciko', 'JL AA', '0896822611288'),
('P0002', 'Sella Purwita Sari', 'JL BB', '02139814132'),
('P0003', 'Tika', 'jl ZZ', '089682261128');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_retur`
--

CREATE TABLE `tbl_retur` (
  `retur_kode` varchar(50) NOT NULL DEFAULT '0',
  `retur_tanggal` datetime DEFAULT current_timestamp(),
  `retur_suplier_id` varchar(15) DEFAULT NULL,
  `retur_user_id` varchar(150) DEFAULT NULL,
  `retur_pelanggan` varchar(255) NOT NULL,
  `retur_subtotal` double DEFAULT NULL,
  `retur_status` int(11) NOT NULL,
  `create_date_retur` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_retur`
--

INSERT INTO `tbl_retur` (`retur_kode`, `retur_tanggal`, `retur_suplier_id`, `retur_user_id`, `retur_pelanggan`, `retur_subtotal`, `retur_status`, `create_date_retur`) VALUES
('RT261019000001', '2019-10-26 01:00:01', '6', '4', 'P0002', 33000, 0, '2019-10-26 01:00:01'),
('RT261019000002', '2019-10-26 01:04:19', '6', '4', 'P0002', 33000, 0, '2019-10-26 01:04:19'),
('RT261019000003', '2019-10-26 01:05:12', '9', '4', 'P0003', 33000, 0, '2019-10-26 01:05:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_suplier`
--

CREATE TABLE `tbl_suplier` (
  `suplier_id` int(11) NOT NULL,
  `suplier_nama` varchar(35) DEFAULT NULL,
  `suplier_alamat` varchar(60) DEFAULT NULL,
  `suplier_notelp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_suplier`
--

INSERT INTO `tbl_suplier` (`suplier_id`, `suplier_nama`, `suplier_alamat`, `suplier_notelp`) VALUES
(6, 'IKEA', 'jl ZZ', '123213123'),
(9, 'asd', 'asd', '11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(35) DEFAULT NULL,
  `user_username` varchar(30) DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `user_level` varchar(2) DEFAULT NULL,
  `user_status` varchar(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_level`, `user_status`) VALUES
(1, 'Bahyu Sanciko', 'bahyu', '$2y$10$/QU9h5JnAxk/KqHkXg6Q0u5LsPLu1pHHdHGnD/WtlKyGRak5amLjm', '1', '1'),
(2, 'kasir', 'kasir', '$2y$10$/QU9h5JnAxk/KqHkXg6Q0u5LsPLu1pHHdHGnD/WtlKyGRak5amLjm', '2', '1'),
(3, 'gudang', 'gudang', '$2y$10$/QU9h5JnAxk/KqHkXg6Q0u5LsPLu1pHHdHGnD/WtlKyGRak5amLjm', '3', '1'),
(4, 'admin', 'admin', '$2y$10$/QU9h5JnAxk/KqHkXg6Q0u5LsPLu1pHHdHGnD/WtlKyGRak5amLjm', '1', '1'),
(5, 'salesku', 'sales', '$2y$10$IIU3QbUjhiOe0HQg.DdXuONpknxxrsJ1jFyTfVWCwcbExStAD5mcO', '4', '1'),
(6, 'salesmu', 'sales1', '$2y$10$dUi7z1AWSGsnY12.yBfhS.bKUal9JKby88jl4BwGDu9PplFQAkpFy', '4', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `barang_user_id` (`barang_user_id`),
  ADD KEY `barang_kategori_id` (`barang_kategori_id`),
  ADD KEY `barang_suplier_id` (`barang_suplier_id`);

--
-- Indeks untuk tabel `tbl_beli`
--
ALTER TABLE `tbl_beli`
  ADD PRIMARY KEY (`beli_kode`),
  ADD KEY `beli_user_id` (`beli_user_id`),
  ADD KEY `beli_suplier_id` (`beli_suplier_id`),
  ADD KEY `beli_id` (`beli_kode`);

--
-- Indeks untuk tabel `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  ADD PRIMARY KEY (`d_beli_id`),
  ADD KEY `d_beli_barang_id` (`d_beli_barang_id`),
  ADD KEY `d_beli_kode` (`d_beli_kode`);

--
-- Indeks untuk tabel `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  ADD PRIMARY KEY (`d_jual_id`),
  ADD KEY `d_jual_barang_id` (`d_jual_barang_id`),
  ADD KEY `d_jual_nofak` (`d_jual_nofak`);

--
-- Indeks untuk tabel `tbl_detail_retur`
--
ALTER TABLE `tbl_detail_retur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_jual`
--
ALTER TABLE `tbl_jual`
  ADD PRIMARY KEY (`jual_nofak`),
  ADD KEY `jual_user_id` (`jual_user_id`),
  ADD KEY `jual_pembeli` (`jual_pembeli`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`) USING BTREE;

--
-- Indeks untuk tabel `tbl_retur`
--
ALTER TABLE `tbl_retur`
  ADD PRIMARY KEY (`retur_kode`);

--
-- Indeks untuk tabel `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  MODIFY `d_beli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  MODIFY `d_jual_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_retur`
--
ALTER TABLE `tbl_detail_retur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD CONSTRAINT `tbl_barang_ibfk_1` FOREIGN KEY (`barang_user_id`) REFERENCES `tbl_user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_barang_ibfk_2` FOREIGN KEY (`barang_kategori_id`) REFERENCES `tbl_kategori` (`kategori_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_barang_ibfk_3` FOREIGN KEY (`barang_suplier_id`) REFERENCES `tbl_suplier` (`suplier_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_beli`
--
ALTER TABLE `tbl_beli`
  ADD CONSTRAINT `tbl_beli_ibfk_1` FOREIGN KEY (`beli_user_id`) REFERENCES `tbl_user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_beli_ibfk_2` FOREIGN KEY (`beli_suplier_id`) REFERENCES `tbl_suplier` (`suplier_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  ADD CONSTRAINT `tbl_detail_beli_ibfk_1` FOREIGN KEY (`d_beli_barang_id`) REFERENCES `tbl_barang` (`barang_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_beli_ibfk_2` FOREIGN KEY (`d_beli_kode`) REFERENCES `tbl_beli` (`beli_kode`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  ADD CONSTRAINT `tbl_detail_jual_ibfk_1` FOREIGN KEY (`d_jual_barang_id`) REFERENCES `tbl_barang` (`barang_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_jual_ibfk_2` FOREIGN KEY (`d_jual_nofak`) REFERENCES `tbl_jual` (`jual_nofak`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_jual`
--
ALTER TABLE `tbl_jual`
  ADD CONSTRAINT `tbl_jual_ibfk_1` FOREIGN KEY (`jual_user_id`) REFERENCES `tbl_user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_jual_ibfk_2` FOREIGN KEY (`jual_pembeli`) REFERENCES `tbl_pelanggan` (`pelanggan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
