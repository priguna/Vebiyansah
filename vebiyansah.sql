-- Adminer 4.7.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `asset_level_user`;
CREATE TABLE `asset_level_user` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `value` varchar(200) NOT NULL,
  `class` varchar(200) NOT NULL,
  `nav` enum('_top_nav','_side_nav') NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `asset_level_user` (`id`, `value`, `class`, `nav`, `status`, `created_date`) VALUES
(0,	'Administator',	'admin',	'_side_nav',	'Aktif',	'2023-10-19 01:41:19'),
(1,	'User',	'user',	'_side_nav',	'Aktif',	'2023-10-19 01:41:19'),
(2,	'Perawat Poliklinik',	'perawat_poliklinik',	'_side_nav',	'Aktif',	'0000-00-00 00:00:00'),
(3,	'Dokter',	'dokter',	'_side_nav',	'Aktif',	'0000-00-00 00:00:00'),
(5,	'Kepala Apotek',	'kepala_apotek',	'_side_nav',	'Aktif',	'0000-00-00 00:00:00'),
(6,	'Administrasi',	'administrasi',	'_side_nav',	'Aktif',	'0000-00-00 00:00:00'),
(7,	'Verifikator MPP',	'varifikator_mpp',	'_side_nav',	'Aktif',	'0000-00-00 00:00:00'),
(8,	'Verifikator Tahap 1',	'varifikator_tahap_1',	'_side_nav',	'Aktif',	'0000-00-00 00:00:00'),
(9,	'Verifikator Tahap 2',	'varifikator_tahap_2',	'_side_nav',	'Aktif',	'0000-00-00 00:00:00'),
(10,	'Keuangan',	'keuangan',	'_side_nav',	'Aktif',	'0000-00-00 00:00:00'),
(11,	'Direktur',	'direktur',	'_side_nav',	'Aktif',	'0000-00-00 00:00:00'),
(12,	'Kasir',	'kasir',	'_side_nav',	'Aktif',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `asset_menu`;
CREATE TABLE `asset_menu` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `aplikasi` int(2) NOT NULL,
  `urut_menu` int(2) NOT NULL,
  `urut_submenu` int(2) NOT NULL,
  `submenu` int(2) NOT NULL,
  `target` enum('-','New Tab') NOT NULL,
  `status` enum('Aktif','Tidak aktif') NOT NULL DEFAULT 'Aktif',
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `asset_menu` (`id`, `judul`, `url`, `icon`, `aplikasi`, `urut_menu`, `urut_submenu`, `submenu`, `target`, `status`, `created_date`) VALUES
(19,	'Data Menu',	'data_menu',	'fas fa-list',	5,	3,	0,	1,	'-',	'Aktif',	'2023-10-19 01:45:25'),
(20,	'Menu',	'asset_menu',	'fas fa-genderless',	5,	3,	1,	2,	'-',	'Aktif',	'2023-10-19 01:45:25'),
(21,	'Class',	'asset_menu_class',	'fas fa-genderless',	5,	3,	3,	2,	'-',	'Aktif',	'2023-10-19 01:45:25'),
(22,	'Level User',	'asset_level_user',	'fas fa-genderless',	5,	3,	2,	2,	'-',	'Aktif',	'2023-10-19 01:45:25'),
(75,	'Pengaturan',	'pengaturan',	'fa fa-gear',	5,	5,	0,	1,	'-',	'Aktif',	'0000-00-00 00:00:00'),
(109,	'Data User',	'data_user',	'fas fa-user-tag',	5,	2,	0,	1,	'-',	'Aktif',	'0000-00-00 00:00:00'),
(113,	'Update',	'update',	'fas fa-tools',	5,	4,	0,	1,	'-',	'Aktif',	'0000-00-00 00:00:00'),
(139,	'Asset',	'-',	'fas fa-globe',	5,	0,	0,	0,	'-',	'Aktif',	'0000-00-00 00:00:00'),
(140,	'Pembiayaan Pasien',	'-',	'fas fa-globe',	1,	0,	0,	0,	'-',	'Aktif',	'0000-00-00 00:00:00'),
(141,	'Pemeriksaan',	'pembiayaan_pasien',	'fas fa-user-injured',	1,	1,	0,	1,	'-',	'Aktif',	'0000-00-00 00:00:00'),
(142,	'Verifikasi',	'pembiayaan_verifikasi',	'fas fa-file-signature',	1,	2,	0,	1,	'-',	'Aktif',	'0000-00-00 00:00:00'),
(143,	'Rekap',	'pembiayaan_rekap',	'fas fa-file-invoice',	1,	3,	0,	1,	'-',	'Aktif',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `asset_menu_class`;
CREATE TABLE `asset_menu_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(6) NOT NULL,
  `level_id` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `level_id` (`level_id`),
  CONSTRAINT `asset_menu_class_ibfk_3` FOREIGN KEY (`menu_id`) REFERENCES `asset_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asset_menu_class_ibfk_4` FOREIGN KEY (`level_id`) REFERENCES `asset_level_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `asset_menu_class` (`id`, `menu_id`, `level_id`) VALUES
(60,	139,	0),
(65,	19,	0),
(66,	20,	0),
(67,	21,	0),
(68,	22,	0),
(69,	109,	0),
(70,	113,	0),
(71,	75,	0),
(72,	140,	0),
(73,	141,	0),
(74,	142,	0),
(75,	143,	0),
(76,	140,	7),
(77,	141,	7),
(78,	142,	7),
(79,	143,	7),
(80,	140,	8),
(82,	142,	8),
(83,	143,	8),
(84,	140,	9),
(86,	142,	9),
(87,	143,	9),
(88,	140,	10),
(90,	142,	10),
(91,	143,	10),
(92,	140,	11),
(93,	142,	11),
(94,	143,	11);

DROP TABLE IF EXISTS `data_user`;
CREATE TABLE `data_user` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` int(3) NOT NULL,
  `ruangan_id` int(6) NOT NULL,
  `nomor_wa` varchar(20) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `data_user` (`id`, `nama`, `username`, `password`, `email`, `level`, `ruangan_id`, `nomor_wa`, `status`, `created_date`) VALUES
(1,	'Administator',	'admin',	'123456',	'allpelaksana@rsudbumiayu.com',	0,	0,	'083850167281',	'Aktif',	'0000-00-00 00:00:00'),
(10,	'User',	'user',	'123456',	'rsud.bumiayu@yahoo.com',	1,	0,	'',	'Aktif',	'2024-11-06 09:33:24'),
(11,	'Poliklinik',	'poli',	'123456',	'user@gmail.com',	2,	0,	'',	'Aktif',	'2025-04-26 11:40:12'),
(12,	'Oneng',	'oneng',	'123456',	'allpelaksana@rsudbumiayu.com',	5,	0,	'',	'Aktif',	'2025-08-12 08:47:07'),
(13,	'MPP',	'mpp',	'123456',	'',	7,	0,	'085641049935',	'Aktif',	'2025-09-08 03:59:02'),
(14,	'dr. Novie',	'verifikator_1a',	'123456',	'',	8,	0,	'087837352350',	'Aktif',	'2025-09-08 03:59:49'),
(15,	'Kasubag TU',	'kasubag_tu',	'123456',	'',	9,	0,	'081548277850',	'Aktif',	'2025-09-08 04:00:02'),
(16,	'Direktur',	'direktur',	'123456',	'',	11,	0,	'081575714171',	'Aktif',	'2025-09-08 04:00:18'),
(17,	'Keuangan',	'keuangan',	'123456',	'',	10,	0,	'085869970984',	'Aktif',	'2025-09-09 12:20:58'),
(18,	'dr. Syafii',	'verifikator_1b',	'123456',	'',	8,	0,	'082324303004',	'Aktif',	'2025-10-16 10:38:45'),
(19,	'IT',	'it',	'123456',	'rsudbumiayukab.brebes@gmail.com',	8,	0,	'083850167281',	'Aktif',	'2025-10-16 11:01:05'),
(20,	'Keuangan',	'keuangan_a',	'123456',	'',	10,	0,	'083850167281',	'Aktif',	'2025-10-16 11:17:42'),
(21,	'Kasir',	'kasir',	'123456',	'',	12,	0,	'085198264447',	'Aktif',	'2025-10-18 09:57:12'),
(24,	'Kasir',	'kasir_priguna',	'123456',	'',	12,	0,	'083850167281',	'Aktif',	'2025-10-18 10:06:00');

DROP TABLE IF EXISTS `pembiayaan_pasien`;
CREATE TABLE `pembiayaan_pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_rawat` varchar(255) NOT NULL,
  `no_rkm_medis` varchar(255) NOT NULL,
  `nm_pasien` varchar(255) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `jk` varchar(255) NOT NULL,
  `tmp_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `no_tlp` varchar(255) NOT NULL,
  `umur` varchar(255) NOT NULL,
  `pnd` varchar(255) NOT NULL,
  `no_peserta` varchar(255) NOT NULL,
  `kelayakan` text NOT NULL,
  `identifikasi` text NOT NULL,
  `asal_rujukan` varchar(255) NOT NULL,
  `tidak_mampu` enum('0','1') DEFAULT NULL,
  `tidak_punya_bpjs` enum('0','1') DEFAULT NULL,
  `bpjs_mandiri_off` enum('0','1') DEFAULT NULL,
  `bpjs_pbi_off` enum('0','1') DEFAULT NULL,
  `tgl_pengajuan` date NOT NULL,
  `user_mpp` int(6) DEFAULT NULL,
  `diagnosa` text NOT NULL,
  `estimasi_beban_biaya` varchar(255) NOT NULL,
  `tgl_verifikasi_1` datetime NOT NULL,
  `user_verifikasi_1` int(6) DEFAULT NULL,
  `jenis_pembiayaan` varchar(255) NOT NULL,
  `tgl_verifikasi_2` datetime NOT NULL,
  `user_verifikasi_2` int(6) DEFAULT NULL,
  `pembiayaan_kasir` varchar(255) NOT NULL,
  `url_nota` varchar(255) NOT NULL,
  `diagnostic` enum('0','1') DEFAULT NULL,
  `biaya` enum('0','1') DEFAULT NULL,
  `administratif` enum('0','1') DEFAULT NULL,
  `tgl_verifikasi_direktur` datetime NOT NULL,
  `user_verifikasi_direktur` int(6) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_rawat` (`no_rawat`),
  KEY `user_mpp` (`user_mpp`),
  KEY `user_verifikasi_1` (`user_verifikasi_1`),
  KEY `user_verifikasi_2` (`user_verifikasi_2`),
  KEY `user_verifikasi_direktur` (`user_verifikasi_direktur`),
  CONSTRAINT `pembiayaan_pasien_ibfk_1` FOREIGN KEY (`user_mpp`) REFERENCES `data_user` (`id`),
  CONSTRAINT `pembiayaan_pasien_ibfk_2` FOREIGN KEY (`user_verifikasi_1`) REFERENCES `data_user` (`id`),
  CONSTRAINT `pembiayaan_pasien_ibfk_3` FOREIGN KEY (`user_verifikasi_2`) REFERENCES `data_user` (`id`),
  CONSTRAINT `pembiayaan_pasien_ibfk_5` FOREIGN KEY (`user_verifikasi_direktur`) REFERENCES `data_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pembiayaan_pasien_files`;
CREATE TABLE `pembiayaan_pasien_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pembiayaan_pasien_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pembiayaan_pasien_id` (`pembiayaan_pasien_id`),
  CONSTRAINT `pembiayaan_pasien_files_ibfk_2` FOREIGN KEY (`pembiayaan_pasien_id`) REFERENCES `pembiayaan_pasien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE `pengaturan` (
  `nama` varchar(255) NOT NULL,
  `singkatan` varchar(255) NOT NULL,
  `perusahaan` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `footer` varchar(255) NOT NULL,
  `url_logo_header` varchar(255) NOT NULL,
  `url_logo_besar` varchar(255) NOT NULL,
  `url_logo_kecil` varchar(255) NOT NULL,
  `url_update` varchar(255) NOT NULL,
  `url_payment` varchar(255) NOT NULL,
  `versi` int(3) NOT NULL,
  `mode` enum('Client','Server') NOT NULL DEFAULT 'Client'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pengaturan` (`nama`, `singkatan`, `perusahaan`, `no_telp`, `alamat`, `email`, `prefix`, `footer`, `url_logo_header`, `url_logo_besar`, `url_logo_kecil`, `url_update`, `url_payment`, `versi`, `mode`) VALUES
('Vebiyansah',	'Verifikasi Pembiayaan Pasien Bermasalah',	'RSUD Bumiayu',	'-',	'-',	'help@gmail.com',	'verifikasi_pembiayaan_pasien_bermasalah',	'Copyright © 2024',	'_asset/img/besar-20240605-035234.png',	'_asset/img/besar-20250111-103720.png',	'_asset/img/kecil-20240826-052411.png',	'https://apps.faskesbrebes.my.id/sipadi_ayu/update_from_server',	'',	1,	'Client');

-- 2025-10-29 04:43:31
