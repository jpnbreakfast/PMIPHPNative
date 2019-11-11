-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 11, 2019 at 06:22 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmifix2`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `daftarpendonorunitdarah`
-- (See below for the actual view)
--
CREATE TABLE `daftarpendonorunitdarah` (
`nama_lengkap_pendonor` varchar(50)
,`id_pendonor` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` varchar(10) NOT NULL,
  `instasi_jadwal` varchar(50) NOT NULL,
  `target_jumlah_jadwal` int(11) NOT NULL,
  `tanggal_jadwal` date NOT NULL,
  `hari_jadwal` varchar(10) NOT NULL,
  `jam_jadwal` time NOT NULL,
  `alamat_jadwal` text NOT NULL,
  `kecamatan_jadwal` varchar(50) NOT NULL,
  `lat_jadwal` float(10,6) NOT NULL,
  `lng_jadwal` float(10,6) NOT NULL,
  `link_jadwal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `instasi_jadwal`, `target_jumlah_jadwal`, `tanggal_jadwal`, `hari_jadwal`, `jam_jadwal`, `alamat_jadwal`, `kecamatan_jadwal`, `lat_jadwal`, `lng_jadwal`, `link_jadwal`) VALUES
('jadwal5', 'AAA', 2, '2019-06-10', 'Senin', '00:00:00', 'Jalan Teuku Umar Barat,  Padangsambian Klod', 'Denpasar Barat', -8.676742, 115.186333, 'http://google.com/maps?q=-8.676742336912469,115.18632888793947'),
('jadwal6', 'Made Limun Korporation', 50, '2019-11-11', 'Selasa', '11:05:00', 'Jalan Jayagiri XXV,  Sumerta Kelod', 'Denpasar Timur', -8.659603, 115.228813, 'http://google.com/maps?q=-8.659602574426698,115.22881507873537'),
('jadwal7', 'Mang Sudi Lawar Corp.', 50, '2019-10-25', 'Senin', '10:00:00', 'Jalan Sekar Jepun 1 6-10,  Kesiman Kertalangu', 'Denpasar Timur', -8.634655, 115.246407, 'http://google.com/maps?q=-8.634655188475021,115.24641036987306');

-- --------------------------------------------------------

--
-- Stand-in structure for view `jadwaldanlokasi`
-- (See below for the actual view)
--
CREATE TABLE `jadwaldanlokasi` (
`instasi_jadwal` varchar(50)
,`target_jumlah_jadwal` int(11)
,`tanggal_jadwal` date
,`hari_jadwal` varchar(10)
,`jam_jadwal` time
,`alamat_jadwal` text
,`kecamatan_jadwal` varchar(50)
,`link_jadwal` text
,`id_jadwallokasi` varchar(10)
,`id_jadwal` varchar(10)
,`doketer_jadwallokasi` varchar(50)
,`tensi_jadwallokasi` varchar(50)
,`hb_jadwallokasi` varchar(50)
,`aftaper_jadwallokasi` varchar(50)
,`admin_jadwallokasi` varchar(50)
,`supir_jadwallokasi` varchar(50)
,`lat_jadwal` float(10,6)
,`lng_jadwal` float(10,6)
);

-- --------------------------------------------------------

--
-- Table structure for table `jadwallokasi`
--

CREATE TABLE `jadwallokasi` (
  `id_jadwallokasi` varchar(10) NOT NULL,
  `id_jadwal` varchar(10) NOT NULL,
  `doketer_jadwallokasi` varchar(50) NOT NULL,
  `tensi_jadwallokasi` varchar(50) NOT NULL,
  `hb_jadwallokasi` varchar(50) NOT NULL,
  `aftaper_jadwallokasi` varchar(50) NOT NULL,
  `admin_jadwallokasi` varchar(50) NOT NULL,
  `supir_jadwallokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwallokasi`
--

INSERT INTO `jadwallokasi` (`id_jadwallokasi`, `id_jadwal`, `doketer_jadwallokasi`, `tensi_jadwallokasi`, `hb_jadwallokasi`, `aftaper_jadwallokasi`, `admin_jadwallokasi`, `supir_jadwallokasi`) VALUES
('lokasi1', 'jadwal5', 'IRAYADI', 'Inemmunz', 'MUSA', 'Tera', 'AAAA', 'Inemmuna'),
('lokasi2', 'jadwal6', 'Mas Kadir', 'Inemmunz', 'MUSA', 'Tera', 'Inem', 'Inemmuna'),
('lokasi3', 'jadwal7', 'Mas Kadir', 'Inemmunz', 'MUSA', 'Tera', 'Inem', 'Inemmuna');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` varchar(12) NOT NULL,
  `username_login` varchar(20) NOT NULL,
  `password_login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username_login`, `password_login`) VALUES
('1', 'ita555', '$2y$10$JCb7f2GGPpAr7JClEkdChuwvZgpStyQzlY.Hr3CxFAtHsccX3x/qW'),
('2', 'Inem', '$2y$10$/t6m4WrY7rdE.p7n4rC35eIzc1/XRn1BP8f7V3CP3UMEOPkSdqlv6'),
('3', 'asdda', '$2y$10$PlAgByG.ynYLJhtfT1VUIO8O0BhYUeoWdlVfbknu6fLp05xXQmHKO'),
('4', '', '$2y$10$2WZbNTHLfxDLu9pDId9ieew4QQDQVPySpeZeCPxWlKSL/IZVfpeoO');

-- --------------------------------------------------------

--
-- Table structure for table `pendonor`
--

CREATE TABLE `pendonor` (
  `id_pendonor` varchar(20) NOT NULL,
  `nama_lengkap_pendonor` varchar(50) NOT NULL,
  `jenis_kelamin_pendonor` varchar(10) NOT NULL,
  `tanggal_lahir_pendonor` date NOT NULL,
  `tempat_lahir_pendonor` text NOT NULL,
  `alamat_pendonor` text NOT NULL,
  `pekerjaan_pendonor` varchar(50) NOT NULL,
  `golongan_darah_pendonor` varchar(20) NOT NULL,
  `no_telp_pendonor` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendonor`
--

INSERT INTO `pendonor` (`id_pendonor`, `nama_lengkap_pendonor`, `jenis_kelamin_pendonor`, `tanggal_lahir_pendonor`, `tempat_lahir_pendonor`, `alamat_pendonor`, `pekerjaan_pendonor`, `golongan_darah_pendonor`, `no_telp_pendonor`) VALUES
('5171DG545MA1', 'Papank Zidane', 'Laki-Laki', '2019-05-10', 'Denpasar', 'Denpasar', 'Petani', 'O', '11111'),
('5171DG545MA2', 'Rai Saputra', 'Laki-Laki', '2019-06-08', 'AAA', 'AAAA', 'AAAA', 'B', '1111'),
('5171DG545MA3', 'Eka Pratama', 'Laki-Laki', '2019-06-08', 'AAA', 'AAAA', 'AAAA', 'AB', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `posisi_petugas` varchar(20) NOT NULL,
  `foto_petugas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `nama_petugas`, `posisi_petugas`, `foto_petugas`) VALUES
('petugas1', 'ita555', 'Papank', 'Administrator Web', 'petugas1.jpg'),
('petugas12', '', 'Inemmuna', 'Supir', 'default_profile.jpg'),
('petugas13', '', 'Tera', 'Aftaper', 'default_profile.jpg'),
('petugas14', '', 'Inemmunz', 'Tensi', 'default_profile.jpg'),
('petugas15', '', 'Inem', 'Administrator Web', 'default_profile.jpg'),
('petugas16', '', 'AAA', 'Administrator Web', 'default_profile.jpg'),
('petugas17', '', 'AFFG', 'Administrator Web', 'default_profile.jpg'),
('petugas18', '', 'dfgfgfdg', 'Administrator Web', 'default_profile.jpg'),
('petugas19', 'asdda', 'asdadad', 'Administrator Web', 'default_profile.jpg'),
('petugas20', '', 'AAAA', 'Administrator', 'default_profile.jpg'),
('petugas7', '', 'YANTO', 'Supir', '../img/default_profile.jpg'),
('petugas8', '', 'IRAYADI', 'Dokter', '../img/default_profile.jpg'),
('petugas9', '', 'MUSA', 'HB', '../img/default_profile.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `petugas_view`
-- (See below for the actual view)
--
CREATE TABLE `petugas_view` (
`id_petugas` varchar(20)
,`nama_petugas` varchar(50)
,`posisi_petugas` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(12) NOT NULL,
  `id_pendonor` varchar(20) NOT NULL,
  `id_petugas` varchar(20) NOT NULL,
  `nama_pendonor` text NOT NULL,
  `nomor_kantong_darah` varchar(20) NOT NULL,
  `golongan_darah` varchar(3) NOT NULL,
  `id_jadwal` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `pengambilan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pendonor`, `id_petugas`, `nama_pendonor`, `nomor_kantong_darah`, `golongan_darah`, `id_jadwal`, `tanggal`, `pengambilan`) VALUES
('transaksi1', '5171DG545MA1', 'petugas1', 'AAA', '306U8922', 'A', 'jadwal5', '2019-10-10', 'Biasa'),
('transaksi2', '5171DG545MA1', 'petugas1', 'Papank Zidane', '306U8922', 'A', 'jadwal6', '2019-11-11', 'Biasa'),
('transaksi3', '5171DG545MA3', 'petugas17', 'Eka Pratama', '306U8925', 'AB', 'jadwal7', '2019-10-25', 'Biasa');

-- --------------------------------------------------------

--
-- Table structure for table `unit_darah`
--

CREATE TABLE `unit_darah` (
  `nomor_kantong_darah` varchar(20) NOT NULL,
  `id_pendonor` varchar(20) NOT NULL,
  `rhesus_darah` varchar(1) NOT NULL,
  `golongan_darah` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_darah`
--

INSERT INTO `unit_darah` (`nomor_kantong_darah`, `id_pendonor`, `rhesus_darah`, `golongan_darah`) VALUES
('306U8922', '5171DG545MA1', '+', 'O'),
('306U8923', '5171DG545MA1', '+', 'A'),
('306U8924', '5171DG545MA2', '-', 'B'),
('306U8925', '5171DG545MA3', '-', 'AB'),
('306U8926', '5171DG545MA1', '+', 'O');

-- --------------------------------------------------------

--
-- Structure for view `daftarpendonorunitdarah`
--
DROP TABLE IF EXISTS `daftarpendonorunitdarah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftarpendonorunitdarah`  AS  select `a`.`nama_lengkap_pendonor` AS `nama_lengkap_pendonor`,`b`.`id_pendonor` AS `id_pendonor` from (`pendonor` `a` join `unit_darah` `b`) where (`a`.`id_pendonor` = `b`.`id_pendonor`) ;

-- --------------------------------------------------------

--
-- Structure for view `jadwaldanlokasi`
--
DROP TABLE IF EXISTS `jadwaldanlokasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jadwaldanlokasi`  AS  select `a`.`instasi_jadwal` AS `instasi_jadwal`,`a`.`target_jumlah_jadwal` AS `target_jumlah_jadwal`,`a`.`tanggal_jadwal` AS `tanggal_jadwal`,`a`.`hari_jadwal` AS `hari_jadwal`,`a`.`jam_jadwal` AS `jam_jadwal`,`a`.`alamat_jadwal` AS `alamat_jadwal`,`a`.`kecamatan_jadwal` AS `kecamatan_jadwal`,`a`.`link_jadwal` AS `link_jadwal`,`b`.`id_jadwallokasi` AS `id_jadwallokasi`,`b`.`id_jadwal` AS `id_jadwal`,`b`.`doketer_jadwallokasi` AS `doketer_jadwallokasi`,`b`.`tensi_jadwallokasi` AS `tensi_jadwallokasi`,`b`.`hb_jadwallokasi` AS `hb_jadwallokasi`,`b`.`aftaper_jadwallokasi` AS `aftaper_jadwallokasi`,`b`.`admin_jadwallokasi` AS `admin_jadwallokasi`,`b`.`supir_jadwallokasi` AS `supir_jadwallokasi`,`a`.`lat_jadwal` AS `lat_jadwal`,`a`.`lng_jadwal` AS `lng_jadwal` from (`jadwal` `a` join `jadwallokasi` `b`) where (`a`.`id_jadwal` = `b`.`id_jadwal`) ;

-- --------------------------------------------------------

--
-- Structure for view `petugas_view`
--
DROP TABLE IF EXISTS `petugas_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `petugas_view`  AS  select `petugas`.`id_petugas` AS `id_petugas`,`petugas`.`nama_petugas` AS `nama_petugas`,`petugas`.`posisi_petugas` AS `posisi_petugas` from `petugas` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `jadwallokasi`
--
ALTER TABLE `jadwallokasi`
  ADD PRIMARY KEY (`id_jadwallokasi`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `pendonor`
--
ALTER TABLE `pendonor`
  ADD PRIMARY KEY (`id_pendonor`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pendonor` (`id_pendonor`),
  ADD KEY `nomor_kantong_darah` (`nomor_kantong_darah`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `petugas` (`id_petugas`);

--
-- Indexes for table `unit_darah`
--
ALTER TABLE `unit_darah`
  ADD PRIMARY KEY (`nomor_kantong_darah`),
  ADD KEY `id_pendonor` (`id_pendonor`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwallokasi`
--
ALTER TABLE `jadwallokasi`
  ADD CONSTRAINT `jadwallokasi_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pendonor`) REFERENCES `pendonor` (`id_pendonor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`nomor_kantong_darah`) REFERENCES `unit_darah` (`nomor_kantong_darah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`);

--
-- Constraints for table `unit_darah`
--
ALTER TABLE `unit_darah`
  ADD CONSTRAINT `unit_darah_ibfk_1` FOREIGN KEY (`id_pendonor`) REFERENCES `pendonor` (`id_pendonor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
