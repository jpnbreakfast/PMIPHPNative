-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2018 at 06:18 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pmifix2`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `daftarpendonorunitdarah`
--
CREATE TABLE IF NOT EXISTS `daftarpendonorunitdarah` (
`nama_lengkap_pendonor` varchar(50)
,`id_pendonor` varchar(20)
);
-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
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
('jadwal1', 'STIKI Indonesia', 50, '2018-07-02', 'Senin', '12:00:00', 'Jl. Tukad Pakerisan No.97A,  Panjer', 'Denpasar Selatan', -8.690763, 115.226135, 'https://www.google.com/maps/place/?q=place_id:ChIJTU5wlgJB0i0Ry3v6idvwW6g'),
('jadwal2', 'STIKOM Bali', 100, '2018-07-03', 'Selasa', '13:00:00', 'Jl. Raya Puputan No.86,  Dangin Puri Klod', 'Denpasar Selatan', -8.673258, 115.226700, 'https://www.google.com/maps/place/?q=place_id:ChIJda4AOPJA0i0RCQAJhmV-6Oo'),
('jadwal3', 'Hardy', 50, '2018-07-03', 'Senin', '00:00:00', 'Jl. Imam Bonjol No.160,  Pemecutan Klod', 'Denpasar Selatan', -8.672774, 115.203590, 'https://www.google.com/maps/place/?q=place_id:ChIJKxeZmMdA0i0RAFHtyfPJi3g');

-- --------------------------------------------------------

--
-- Stand-in structure for view `jadwaldanlokasi`
--
CREATE TABLE IF NOT EXISTS `jadwaldanlokasi` (
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

CREATE TABLE IF NOT EXISTS `jadwallokasi` (
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
('lokasi1', 'jadwal1', 'IRAYADI', 'MAS YONO', 'MUSA', 'WIDIA', 'TJOK DE', 'YANTO'),
('lokasi2', 'jadwal2', 'IRAYADI', 'MAS YONO', 'MUSA', 'WIDIA', 'TJOK DE', 'YANTO'),
('lokasi3', 'jadwal3', 'IRAYADI', 'MAS YONO', 'MUSA', 'WIDIA', 'TJOK DE', 'YANTO');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id_login` varchar(12) NOT NULL,
  `username_login` varchar(20) NOT NULL,
  `password_login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username_login`, `password_login`) VALUES
('1', 'ita555', '202CB962AC59075B964B07152D234B70');

-- --------------------------------------------------------

--
-- Table structure for table `pendonor`
--

CREATE TABLE IF NOT EXISTS `pendonor` (
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
('5171DG545MA2', 'A A MADE WIDIA ADINATA', 'Laki-Laki', '1989-12-07', 'DENPASAR', 'JL IMAM BONJOL GG I /1C', '-', 'B', '-'),
('5171DG545MA3', 'I WAYAN SUKANDA', 'Laki-Laki', '1988-09-24', 'DENPASAR', 'JL P BATANTA GG 12 NO 2', '-', 'O', '-'),
('5171DG545MA4', 'DEWA AYU', 'Perempuan', '2012-01-02', 'Denpasar', 'Jl. Panjer', 'Mahasiswa', 'A', '-'),
('5171DG545MA5', '1234', 'Laki-Laki', '2018-07-02', 'Denpasar', '1010', 'dokter', 'A', '08356789');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE IF NOT EXISTS `petugas` (
  `id_petugas` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `posisi_petugas` varchar(20) NOT NULL,
  `foto_petugas` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `nama_petugas`, `posisi_petugas`, `foto_petugas`) VALUES
('petugas1', 'ita555', 'Ita', 'Administrator Web', 0x70657475676173315f6b6567696174616e312e6a7067),
('petugas4', '', 'WIDIA', 'Aftaper', 0x2e2e2f696d672f64656661756c745f70726f66696c652e6a7067),
('petugas5', '', 'TJOK DE', 'Administrator', 0x2e2e2f696d672f64656661756c745f70726f66696c652e6a7067),
('petugas6', '', 'MAS YONO', 'Tensi', 0x2e2e2f696d672f64656661756c745f70726f66696c652e6a7067),
('petugas7', '', 'YANTO', 'Supir', 0x2e2e2f696d672f64656661756c745f70726f66696c652e6a7067),
('petugas8', '', 'IRAYADI', 'Dokter', 0x2e2e2f696d672f64656661756c745f70726f66696c652e6a7067),
('petugas9', '', 'MUSA', 'HB', 0x2e2e2f696d672f64656661756c745f70726f66696c652e6a7067);

-- --------------------------------------------------------

--
-- Stand-in structure for view `petugas_view`
--
CREATE TABLE IF NOT EXISTS `petugas_view` (
`id_petugas` varchar(20)
,`nama_petugas` varchar(50)
,`posisi_petugas` varchar(20)
);
-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` varchar(12) NOT NULL,
  `id_pendonor` varchar(20) NOT NULL,
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

INSERT INTO `transaksi` (`id_transaksi`, `id_pendonor`, `nama_pendonor`, `nomor_kantong_darah`, `golongan_darah`, `id_jadwal`, `tanggal`, `pengambilan`) VALUES
('transaksi2', '5171DG545MA2', 'A A MADE WIDIA ADINATA', '306U8922', 'B', 'jadwal1', '2018-07-02', 'Biasa');

-- --------------------------------------------------------

--
-- Table structure for table `unit_darah`
--

CREATE TABLE IF NOT EXISTS `unit_darah` (
  `nomor_kantong_darah` varchar(20) NOT NULL,
  `id_pendonor` varchar(20) NOT NULL,
  `rhesus_darah` varchar(1) NOT NULL,
  `golongan_darah` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_darah`
--

INSERT INTO `unit_darah` (`nomor_kantong_darah`, `id_pendonor`, `rhesus_darah`, `golongan_darah`) VALUES
('306U8922', '5171DG545MA2', '+', 'B'),
('306U8923', '5171DG545MA3', '+', 'O'),
('306U8924', '5171DG545MA4', '+', 'A');

-- --------------------------------------------------------

--
-- Structure for view `daftarpendonorunitdarah`
--
DROP TABLE IF EXISTS `daftarpendonorunitdarah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftarpendonorunitdarah` AS select `a`.`nama_lengkap_pendonor` AS `nama_lengkap_pendonor`,`b`.`id_pendonor` AS `id_pendonor` from (`pendonor` `a` join `unit_darah` `b`) where (`a`.`id_pendonor` = `b`.`id_pendonor`);

-- --------------------------------------------------------

--
-- Structure for view `jadwaldanlokasi`
--
DROP TABLE IF EXISTS `jadwaldanlokasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jadwaldanlokasi` AS select `a`.`instasi_jadwal` AS `instasi_jadwal`,`a`.`target_jumlah_jadwal` AS `target_jumlah_jadwal`,`a`.`tanggal_jadwal` AS `tanggal_jadwal`,`a`.`hari_jadwal` AS `hari_jadwal`,`a`.`jam_jadwal` AS `jam_jadwal`,`a`.`alamat_jadwal` AS `alamat_jadwal`,`a`.`kecamatan_jadwal` AS `kecamatan_jadwal`,`a`.`link_jadwal` AS `link_jadwal`,`b`.`id_jadwallokasi` AS `id_jadwallokasi`,`b`.`id_jadwal` AS `id_jadwal`,`b`.`doketer_jadwallokasi` AS `doketer_jadwallokasi`,`b`.`tensi_jadwallokasi` AS `tensi_jadwallokasi`,`b`.`hb_jadwallokasi` AS `hb_jadwallokasi`,`b`.`aftaper_jadwallokasi` AS `aftaper_jadwallokasi`,`b`.`admin_jadwallokasi` AS `admin_jadwallokasi`,`b`.`supir_jadwallokasi` AS `supir_jadwallokasi`,`a`.`lat_jadwal` AS `lat_jadwal`,`a`.`lng_jadwal` AS `lng_jadwal` from (`jadwal` `a` join `jadwallokasi` `b`) where (`a`.`id_jadwal` = `b`.`id_jadwal`);

-- --------------------------------------------------------

--
-- Structure for view `petugas_view`
--
DROP TABLE IF EXISTS `petugas_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `petugas_view` AS select `petugas`.`id_petugas` AS `id_petugas`,`petugas`.`nama_petugas` AS `nama_petugas`,`petugas`.`posisi_petugas` AS `posisi_petugas` from `petugas`;

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
 ADD PRIMARY KEY (`id_jadwallokasi`), ADD KEY `id_jadwal` (`id_jadwal`);

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
 ADD PRIMARY KEY (`id_transaksi`), ADD KEY `id_pendonor` (`id_pendonor`), ADD KEY `nomor_kantong_darah` (`nomor_kantong_darah`), ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `unit_darah`
--
ALTER TABLE `unit_darah`
 ADD PRIMARY KEY (`nomor_kantong_darah`), ADD KEY `id_pendonor` (`id_pendonor`);

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
ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`nomor_kantong_darah`) REFERENCES `unit_darah` (`nomor_kantong_darah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unit_darah`
--
ALTER TABLE `unit_darah`
ADD CONSTRAINT `unit_darah_ibfk_1` FOREIGN KEY (`id_pendonor`) REFERENCES `pendonor` (`id_pendonor`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
