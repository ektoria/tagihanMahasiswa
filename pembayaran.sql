-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pembayaran
CREATE DATABASE IF NOT EXISTS `pembayaran` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `pembayaran`;

-- Dumping structure for table pembayaran.tbl_detail_pembayaran
CREATE TABLE IF NOT EXISTS `tbl_detail_pembayaran` (
  `kode_jenispembayaran` varchar(20) NOT NULL,
  `no_transaksi` int(20) NOT NULL,
  `sub_total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pembayaran.tbl_detail_pembayaran: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_detail_pembayaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_detail_pembayaran` ENABLE KEYS */;

-- Dumping structure for table pembayaran.tbl_mahasiswa
CREATE TABLE IF NOT EXISTS `tbl_mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(50) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `jk` varchar(12) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_telfon` varchar(13) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nim` (`nim`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table pembayaran.tbl_mahasiswa: ~10 rows (approximately)
/*!40000 ALTER TABLE `tbl_mahasiswa` DISABLE KEYS */;
INSERT INTO `tbl_mahasiswa` (`id`, `nim`, `nama_mahasiswa`, `jk`, `tempat_lahir`, `tgl_lahir`, `alamat`, `no_telfon`) VALUES
	(1, '11251103842', 'Ikhsan Prakasa', 'L', 'Pekanbaru', '1993-09-12', '', ''),
	(2, '11251103843', 'Dian Nugroho', 'L', 'Pekanbaru', '1994-10-10', '', ''),
	(3, '11251103844', 'Dini Sri Wahyuni', 'P', 'Pekalongan', '1995-05-29', '', ''),
	(4, '11251103845', 'Susi Susilawati', 'P', 'Bandung', '1992-05-29', '', ''),
	(5, '11251103846', 'Siska Pujiastuti', 'P', 'Kudus', '1995-12-10', '', ''),
	(6, '11251103847', 'Afri Naldo', 'L', 'Dumai', '1994-05-29', '', ''),
	(7, '11251103848', 'Naldi Syahputra', 'L', 'Rokan Hilir', '1993-07-21', '', ''),
	(8, '11251103849', 'Dwi Putra Tunggal', 'L', 'Rokan Hulu', '1993-05-29', '', ''),
	(9, '11251103850', 'Rizal Tarigan', 'L', 'Siantar', '1994-09-11', '', ''),
	(10, '11251103851', 'Roy Koto', 'L', 'Pariaman', '1996-01-01', '', '');
/*!40000 ALTER TABLE `tbl_mahasiswa` ENABLE KEYS */;

-- Dumping structure for table pembayaran.tbl_pembayaran
CREATE TABLE IF NOT EXISTS `tbl_pembayaran` (
  `no_transaksi` int(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `kode_ta` varchar(10) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `total` int(10) NOT NULL,
  PRIMARY KEY (`no_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pembayaran.tbl_pembayaran: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_pembayaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pembayaran` ENABLE KEYS */;

-- Dumping structure for table pembayaran.tbl_tagihan
CREATE TABLE IF NOT EXISTS `tbl_tagihan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(50) NOT NULL DEFAULT '0',
  `nama_tagihan` varchar(50) NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL,
  `id_mahasiswa` int(11) NOT NULL DEFAULT 0,
  `nominal` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `flag` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pembayaran.tbl_tagihan: ~22 rows (approximately)
/*!40000 ALTER TABLE `tbl_tagihan` DISABLE KEYS */;
INSERT INTO `tbl_tagihan` (`id`, `id_transaksi`, `nama_tagihan`, `keterangan`, `id_mahasiswa`, `nominal`, `status`, `flag`) VALUES
	(2, '20210529021546', 'Biaya Semester', '', 3, 5500000, 0, 1),
	(3, '20210529034735', 'Biaya Pembangunan', '', 1, 2500000, 1, 1),
	(4, '20210529034735', 'Biaya Pembangunan', '', 2, 2500000, 0, 1),
	(5, '20210529034735', 'Biaya Pembangunan', '', 3, 2500000, 0, 1),
	(6, '20210529034735', 'Biaya Pembangunan', '', 4, 2500000, 0, 1),
	(7, '20210529034735', 'Biaya Pembangunan', '', 5, 2500000, 0, 1),
	(8, '20210529034735', 'Biaya Pembangunan', '', 6, 2500000, 0, 1),
	(9, '20210529034735', 'Biaya Pembangunan', '', 7, 2500000, 0, 1),
	(10, '20210529034735', 'Biaya Pembangunan', '', 8, 2500000, 0, 1),
	(11, '20210529034735', 'Biaya Pembangunan', '', 9, 2500000, 0, 1),
	(12, '20210529034735', 'Biaya Pembangunan', '', 10, 2500000, 0, 1),
	(54, '20210530104245', 'Biaya Pratikum', 'Pratikum', 1, 2000000, 0, 0),
	(55, '20210530104356', 'Pratikum', '', 1, 2000000, 1, 1),
	(56, '20210530104356', 'Pratikum', '', 2, 2000000, 0, 1),
	(57, '20210530104356', 'Pratikum', '', 3, 2000000, 0, 1),
	(58, '20210530104356', 'Pratikum', '', 4, 2000000, 0, 1),
	(59, '20210530104356', 'Pratikum', '', 5, 2000000, 0, 1),
	(60, '20210530104356', 'Pratikum', '', 6, 2000000, 0, 1),
	(61, '20210530104356', 'Pratikum', '', 7, 2000000, 0, 1),
	(62, '20210530104356', 'Pratikum', '', 8, 2000000, 0, 1),
	(63, '20210530104356', 'Pratikum', '', 9, 2000000, 0, 1),
	(64, '20210530104356', 'Pratikum', '', 10, 2000000, 0, 1);
/*!40000 ALTER TABLE `tbl_tagihan` ENABLE KEYS */;

-- Dumping structure for table pembayaran.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipeUser` int(11) NOT NULL,
  `status_user` enum('0','1') NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'default.png',
  `flag_aktif` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pembayaran.user: ~4 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `name`, `password`, `tipeUser`, `status_user`, `img`, `flag_aktif`) VALUES
	(1, 'admin', 'Administrator', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, '1', 'default.jpg', 0),
	(5, 'bendahara', 'Bendahara', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, '1', 'default.png', 0),
	(6, 'pimpinan', 'Pimpinan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3, '1', 'default.png', 0),
	(7, '11251103842', 'Ikhsan Prakasa', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 4, '1', 'default.png', 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table pembayaran.user_level
CREATE TABLE IF NOT EXISTS `user_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table pembayaran.user_level: ~4 rows (approximately)
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` (`id`, `role_user`) VALUES
	(1, 'admin'),
	(2, 'bendahara'),
	(3, 'pimpinan'),
	(4, 'mahasiswa');
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
