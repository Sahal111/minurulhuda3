# ************************************************************
# Sequel Ace SQL dump
# Version 20096
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 9.6.0)
# Database: minurulhuda3
# Generation Time: 2026-07-09 13:46:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table absensis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `absensis`;

CREATE TABLE `absensis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `guru_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun_ajaran_id` bigint unsigned DEFAULT NULL,
  `kelas_id` bigint unsigned DEFAULT NULL,
  `status` enum('Hadir','Sakit','Izin','Alpha') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_absen_siswa_tanggal_kelas` (`siswa_id`,`tanggal`,`kelas_id`),
  KEY `absensis_siswa_id_foreign` (`siswa_id`),
  KEY `absensis_guru_id_foreign` (`guru_id`),
  KEY `absensis_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  KEY `absensis_kelas_id_foreign` (`kelas_id`),
  KEY `absensis_created_by_foreign` (`created_by`),
  KEY `absensis_updated_by_foreign` (`updated_by`),
  KEY `idx_absen_rekap` (`siswa_id`,`tanggal`,`tahun_ajaran_id`),
  CONSTRAINT `absensis_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `absensis_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `absensis_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `absensis_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `absensis_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `absensis_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table admin_ppdb_profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_ppdb_profiles`;

CREATE TABLE `admin_ppdb_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `tahun_ajaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_ppdb_profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `admin_ppdb_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table beasiswas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `beasiswas`;

CREATE TABLE `beasiswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_mulai` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_selesai` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal` decimal(15,2) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `beasiswas_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `beasiswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `beasiswas` WRITE;
/*!40000 ALTER TABLE `beasiswas` DISABLE KEYS */;

INSERT INTO `beasiswas` (`id`, `siswa_id`, `nama`, `jenis`, `tahun_mulai`, `tahun_selesai`, `nominal`, `keterangan`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,8,'pip','Pemerintah Daerah','2025','2030',1000000000.00,'bbhghgfgffttrtrtrytytytytvcgcg','2026-05-21 13:15:08','2026-05-21 13:15:08',NULL);

/*!40000 ALTER TABLE `beasiswas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table bendaharas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bendaharas`;

CREATE TABLE `bendaharas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `jenis_bendahara` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bendaharas_user_id_foreign` (`user_id`),
  CONSTRAINT `bendaharas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table berkas_pendaftars
# ------------------------------------------------------------

DROP TABLE IF EXISTS `berkas_pendaftars`;

CREATE TABLE `berkas_pendaftars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `calon_siswa_id` bigint unsigned NOT NULL,
  `jenis_berkas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_verifikasi` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `berkas_pendaftars_calon_siswa_id_foreign` (`calon_siswa_id`),
  CONSTRAINT `berkas_pendaftars_calon_siswa_id_foreign` FOREIGN KEY (`calon_siswa_id`) REFERENCES `calon_siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table berkas_siswas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `berkas_siswas`;

CREATE TABLE `berkas_siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `jenis_berkas` enum('kartu_keluarga','akte_kelahiran','ktp_orang_tua','ijazah_sebelumnya','kip_pkh_kks','pas_foto','surat_mutasi','rapor_sekolah_asal') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_file_asli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_file_sistem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ekstensi` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran_file` int NOT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `berkas_siswas_created_by_foreign` (`created_by`),
  KEY `berkas_siswas_updated_by_foreign` (`updated_by`),
  KEY `berkas_siswas_siswa_id_jenis_berkas_index` (`siswa_id`,`jenis_berkas`),
  CONSTRAINT `berkas_siswas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `berkas_siswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `berkas_siswas_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `berkas_siswas` WRITE;
/*!40000 ALTER TABLE `berkas_siswas` DISABLE KEYS */;

INSERT INTO `berkas_siswas` (`id`, `siswa_id`, `jenis_berkas`, `nama_file_asli`, `nama_file_sistem`, `path_file`, `ekstensi`, `ukuran_file`, `created_by`, `updated_by`, `created_at`, `updated_at`)
VALUES
	(1,8,'kartu_keluarga','WhatsApp Image 2026-05-20 at 09.20.59 (2).jpeg','ldL6UzKfCBDXSWOLztZdteURRJDqgH7XFqoK3IcO.jpg','berkas_siswa/ldL6UzKfCBDXSWOLztZdteURRJDqgH7XFqoK3IcO.jpg','jpeg',854838,26,NULL,'2026-05-21 13:04:00','2026-05-21 13:04:00'),
	(2,8,'akte_kelahiran','WhatsApp Image 2026-05-20 at 09.21.00.jpeg','5jSUHHA55tlmHeEukK4WAUjYUSSuuQJ1JxFFoLCZ.jpg','berkas_siswa/5jSUHHA55tlmHeEukK4WAUjYUSSuuQJ1JxFFoLCZ.jpg','jpeg',782176,26,NULL,'2026-05-21 13:04:00','2026-05-21 13:04:00'),
	(3,8,'ijazah_sebelumnya','WhatsApp Image 2026-05-20 at 09.20.59.jpeg','rDkVOyKfpHaVH3DFT4oDez09G1octjKU2fTrHdEn.jpg','berkas_siswa/rDkVOyKfpHaVH3DFT4oDez09G1octjKU2fTrHdEn.jpg','jpeg',885986,26,NULL,'2026-05-21 13:04:00','2026-05-21 13:04:00'),
	(4,20,'kartu_keluarga','Screenshot 2026-06-13 at 11.14.40.png','u8L2pmNMMIJZGjPWwQZA77ZLOimraN9un9Fgzasv.png','berkas_siswa/u8L2pmNMMIJZGjPWwQZA77ZLOimraN9un9Fgzasv.png','png',1169912,26,NULL,'2026-06-16 09:55:31','2026-06-16 09:55:31'),
	(5,20,'akte_kelahiran','Screenshot 2026-06-13 at 11.26.41.png','5oLJWORymZnDGO9KU1yAai8wJKStDshyQRnK8UlI.png','berkas_siswa/5oLJWORymZnDGO9KU1yAai8wJKStDshyQRnK8UlI.png','png',667123,26,NULL,'2026-06-16 09:55:31','2026-06-16 09:55:31'),
	(6,20,'ijazah_sebelumnya','Screenshot 2026-06-16 at 14.08.06.png','rP3Q2uR4X41TNSL33bFrxny3ISaiMeRf5nkLb1bC.png','berkas_siswa/rP3Q2uR4X41TNSL33bFrxny3ISaiMeRf5nkLb1bC.png','png',483301,26,NULL,'2026-06-16 09:55:31','2026-06-16 09:55:31'),
	(11,22,'kartu_keluarga','Screenshot 2026-06-09 at 22.58.47.png','4zJfyJQFbkHFiRUJmJmzTbnsfNT5aocZ04yWlQiL.png','berkas_siswa/4zJfyJQFbkHFiRUJmJmzTbnsfNT5aocZ04yWlQiL.png','png',907610,26,26,'2026-06-16 15:26:43','2026-06-16 15:30:22'),
	(12,22,'akte_kelahiran','Screenshot 2026-06-16 at 15.46.20.png','9hFRqfPG4uUK21Cw90HYJDTB8jbLKe0zimNlZUMg.png','berkas_siswa/9hFRqfPG4uUK21Cw90HYJDTB8jbLKe0zimNlZUMg.png','png',693799,26,26,'2026-06-16 15:26:43','2026-06-16 15:30:22'),
	(13,22,'ijazah_sebelumnya','Screenshot 2026-06-13 at 11.14.40.png','rqQLTXOsiqD4SQOoCKrPd3I1u5F6pvszX8M7awXd.png','berkas_siswa/rqQLTXOsiqD4SQOoCKrPd3I1u5F6pvszX8M7awXd.png','png',1169912,26,26,'2026-06-16 15:26:43','2026-06-16 15:30:22'),
	(14,22,'surat_mutasi','Screenshot 2026-06-13 at 11.26.41.png','bVpFfE2HQz688onuXx2izsilesiYkJ8EcUOwt7Uy.png','berkas_siswa/bVpFfE2HQz688onuXx2izsilesiYkJ8EcUOwt7Uy.png','png',667123,26,NULL,'2026-06-16 15:26:43','2026-06-16 15:26:43'),
	(15,22,'rapor_sekolah_asal','Screenshot 2026-06-13 at 11.35.47.png','zH7PVpXVrufn2GwTW7wdLHaq019qH1gCmu4lbs7X.png','berkas_siswa/zH7PVpXVrufn2GwTW7wdLHaq019qH1gCmu4lbs7X.png','png',1316368,26,NULL,'2026-06-16 15:26:43','2026-06-16 15:26:43');

/*!40000 ALTER TABLE `berkas_siswas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cache
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table cache_locks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table calon_siswas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `calon_siswas`;

CREATE TABLE `calon_siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_pendaftaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_sekolah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_orang_tua` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jalur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','lulus','tidak_lulus','cadangan','converted') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `tahun_ajaran_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `calon_siswas_no_pendaftaran_unique` (`no_pendaftaran`),
  KEY `calon_siswas_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  CONSTRAINT `calon_siswas_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table catatan_walis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `catatan_walis`;

CREATE TABLE `catatan_walis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `guru_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun_ajaran_id` bigint unsigned DEFAULT NULL,
  `semester` enum('Ganjil','Genap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catatan_walis_siswa_id_foreign` (`siswa_id`),
  KEY `catatan_walis_guru_id_foreign` (`guru_id`),
  KEY `catatan_walis_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  CONSTRAINT `catatan_walis_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `catatan_walis_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `catatan_walis_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table data_tambahan_siswas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `data_tambahan_siswas`;

CREATE TABLE `data_tambahan_siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `kewarganegaraan` enum('WNI','WNA') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_registrasi_akta_kelahiran` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lintang` decimal(10,8) DEFAULT NULL,
  `bujur` decimal(11,8) DEFAULT NULL,
  `kebutuhan_khusus_ayah` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebutuhan_khusus_ibu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hobi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cita_cita` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp_siswa` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp_siswa` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_siswa` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lingkar_kepala` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_tambahan_siswas_siswa_id_unique` (`siswa_id`),
  CONSTRAINT `data_tambahan_siswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `data_tambahan_siswas` WRITE;
/*!40000 ALTER TABLE `data_tambahan_siswas` DISABLE KEYS */;

INSERT INTO `data_tambahan_siswas` (`id`, `siswa_id`, `kewarganegaraan`, `no_registrasi_akta_kelahiran`, `lintang`, `bujur`, `kebutuhan_khusus_ayah`, `kebutuhan_khusus_ibu`, `hobi`, `cita_cita`, `no_telp_siswa`, `hp_siswa`, `email_siswa`, `lingkar_kepala`, `created_at`, `updated_at`)
VALUES
	(2,8,'WNI','8273782737237732232',90.00000000,100.00000000,'hjhjhcjhsjhdjshd','jshjhjhjhadjhhsdds','jhjhjhjhhhuhu','jjjhhhghhjggsdhjgdd','0899838932232','0898832882389843','sajahjhj@gmail.com',51.30,'2026-05-21 13:04:00','2026-05-21 13:04:00'),
	(3,9,'WNI','83829839823',90.00000000,100.00000000,'bhgghghgh','yuyyhjhjhjhjhjhjghghgfgf',NULL,NULL,NULL,NULL,NULL,NULL,'2026-05-21 14:05:21','2026-06-16 07:44:59'),
	(14,20,'WNI','87877767676775656',-6.56556500,106.08989987,'uyuyuyhjhjhjhjhghghghg','jahjhhdhuuyuyewjsd','membaca','polisi','085788767656','085788767656','hjhhjhjhhjhjh@gmail.com',51.50,'2026-06-16 09:55:30','2026-06-16 09:55:30'),
	(16,22,'WNI','4377837874878734',-6.09289290,108.00000000,'sjdeiuiuiueiruue','jnjwjejwjieiwieie3i','membaca','dokter','089772827287','0879788728',NULL,60.10,'2026-06-16 15:26:43','2026-06-16 15:26:43');

/*!40000 ALTER TABLE `data_tambahan_siswas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table guru_absensis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guru_absensis`;

CREATE TABLE `guru_absensis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hadir',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guru_absensis_guru_id_tanggal_unique` (`guru_id`,`tanggal`),
  CONSTRAINT `guru_absensis_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table guru_diklats
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guru_diklats`;

CREATE TABLE `guru_diklats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `nama_diklat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyelenggara` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diklat',
  `tingkat` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `jumlah_jam` smallint unsigned DEFAULT NULL,
  `no_sertifikat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peran` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'peserta',
  `file_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_diklats_guru_id_index` (`guru_id`),
  KEY `guru_diklats_guru_id_jenis_index` (`guru_id`,`jenis`),
  CONSTRAINT `guru_diklats_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table guru_dokumens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guru_dokumens`;

CREATE TABLE `guru_dokumens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_dokumen` date DEFAULT NULL,
  `tanggal_berlaku` date DEFAULT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_dokumens_guru_id_foreign` (`guru_id`),
  CONSTRAINT `guru_dokumens_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table guru_inpassings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guru_inpassings`;

CREATE TABLE `guru_inpassings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `no_sk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_sk` date NOT NULL,
  `tmt_inpassing` date NOT NULL,
  `golongan_sebelum` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan_sesudah` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_fungsional` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Guru Pertama',
  `angka_kredit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pejabat_penetap` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instansi_penetap` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `file_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_inpassings_guru_id_index` (`guru_id`),
  KEY `guru_inpassings_guru_id_status_index` (`guru_id`,`status`),
  CONSTRAINT `guru_inpassings_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table guru_jabatans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guru_jabatans`;

CREATE TABLE `guru_jabatans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kepegawaian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_nomor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_tanggal` date DEFAULT NULL,
  `tmt_jabatan` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `is_current` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_jabatans_guru_id_foreign` (`guru_id`),
  KEY `guru_jabatans_created_by_foreign` (`created_by`),
  KEY `guru_jabatans_updated_by_foreign` (`updated_by`),
  KEY `guru_jabatans_deleted_by_foreign` (`deleted_by`),
  CONSTRAINT `guru_jabatans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `guru_jabatans_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `guru_jabatans_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_jabatans_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `guru_jabatans` WRITE;
/*!40000 ALTER TABLE `guru_jabatans` DISABLE KEYS */;

INSERT INTO `guru_jabatans` (`id`, `guru_id`, `jabatan`, `golongan`, `status_kepegawaian`, `sk_nomor`, `sk_tanggal`, `tmt_jabatan`, `tanggal_selesai`, `is_current`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`)
VALUES
	(1,1,'guru',NULL,'Honorer','sk/227382377','2020-04-17','2020-04-17',NULL,1,'2026-06-14 02:44:08','2026-06-14 02:44:08',NULL,NULL,NULL,NULL),
	(2,2,'guru','IV/a','PNS','sk/0909090','2026-05-17','2026-05-17',NULL,1,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(3,3,'guru','IV a','PNS','sk/98398/23923','2026-05-10','2021-05-02',NULL,1,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(6,6,'guru',NULL,'honorer','sk/386767467','2005-07-15','2020-04-17',NULL,1,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(7,7,'guru',NULL,'PPPK','sk/32773873823','2020-04-17','2006-07-25',NULL,1,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(9,9,'guru',NULL,'honorer','sk/389289329','2006-08-15','2005-07-15',NULL,1,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(11,11,'guru','iv/d','PNS','sk/3287732878','2026-05-17','2006-07-25',NULL,1,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `guru_jabatans` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table guru_keluargas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guru_keluargas`;

CREATE TABLE `guru_keluargas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `status_perkawinan` enum('Belum Menikah','Menikah','Cerai Hidup','Cerai Mati') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pasangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_pasangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_anak` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_keluargas_guru_id_foreign` (`guru_id`),
  KEY `guru_keluargas_created_by_foreign` (`created_by`),
  KEY `guru_keluargas_updated_by_foreign` (`updated_by`),
  KEY `guru_keluargas_deleted_by_foreign` (`deleted_by`),
  CONSTRAINT `guru_keluargas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `guru_keluargas_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `guru_keluargas_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_keluargas_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `guru_keluargas` WRITE;
/*!40000 ALTER TABLE `guru_keluargas` DISABLE KEYS */;

INSERT INTO `guru_keluargas` (`id`, `guru_id`, `status_perkawinan`, `nama_pasangan`, `pekerjaan_pasangan`, `jumlah_anak`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`)
VALUES
	(1,1,'Menikah','duywyeuyuwe','wertyujhgfdhfj',10,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(2,2,'Menikah','uwyeuywehdjsj','auyudyuewydggewfhg',10,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(3,3,'Menikah','peah','ngepet',10,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(6,6,'Menikah','uweuuwyueyw','ereiueiuriu',10,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(7,7,'Menikah','uweuyuwyeuy','hfhdhfhjdh',10,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(9,9,'Menikah','uweyuywuey','riueiuriur',10,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(11,11,'Menikah','wueuywuyey','ueueuru949redi',10,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `guru_keluargas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table guru_mapels
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guru_mapels`;

CREATE TABLE `guru_mapels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `mapel_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `semester_id` bigint unsigned NOT NULL,
  `tahun_ajaran_id` bigint unsigned DEFAULT NULL,
  `beban_jam` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_mapels_mapel_id_foreign` (`mapel_id`),
  KEY `guru_mapels_kelas_id_foreign` (`kelas_id`),
  KEY `guru_mapels_semester_id_foreign` (`semester_id`),
  KEY `guru_mapels_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  KEY `guru_mapels_created_by_foreign` (`created_by`),
  KEY `guru_mapels_updated_by_foreign` (`updated_by`),
  KEY `guru_mapels_deleted_by_foreign` (`deleted_by`),
  KEY `guru_mapels_active_index` (`guru_id`,`is_active`),
  CONSTRAINT `guru_mapels_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `guru_mapels_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `guru_mapels_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_mapels_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_mapels_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapels` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_mapels_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_mapels_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_mapels_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table guru_pendidikans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guru_pendidikans`;

CREATE TABLE `guru_pendidikans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `jenjang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_lulus` year NOT NULL,
  `no_ijazah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ijazah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_pendidikans_guru_id_foreign` (`guru_id`),
  KEY `guru_pendidikans_created_by_foreign` (`created_by`),
  KEY `guru_pendidikans_updated_by_foreign` (`updated_by`),
  KEY `guru_pendidikans_deleted_by_foreign` (`deleted_by`),
  CONSTRAINT `guru_pendidikans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `guru_pendidikans_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `guru_pendidikans_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_pendidikans_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `guru_pendidikans` WRITE;
/*!40000 ALTER TABLE `guru_pendidikans` DISABLE KEYS */;

INSERT INTO `guru_pendidikans` (`id`, `guru_id`, `jenjang`, `nama_sekolah`, `jurusan`, `tahun_lulus`, `no_ijazah`, `file_ijazah`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`)
VALUES
	(1,1,'SMA / MA','sdshjdjsdjskjdkjskd','sudyyweuyuwyehshd','2020','38478378473874',NULL,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(2,2,'S3 - Doktor','yatasi','pendidikan pancasila','2010','3829388239',NULL,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(3,3,'S1 - Sarjana','wowooo','Pendidikan Umum','2016','9732738748',NULL,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(6,6,'S3 - Doktor','hdhuehu','hdhgfdfhj','2009','928329383',NULL,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(7,7,'S1 - Sarjana','ydyuyegd','hfhdghfghd','2010','938923982839',NULL,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(9,9,'S1 - Sarjana','uduueyeiui','ghggeuryueyyjhd','2019','93829839',NULL,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(11,11,'S1 - Sarjana','iweuuyruyey','ueyyruyeyr','2018','98328938',NULL,'2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `guru_pendidikans` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table guru_rekenings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guru_rekenings`;

CREATE TABLE `guru_rekenings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cabang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gaji_pokok` decimal(15,2) NOT NULL DEFAULT '0.00',
  `tunjangan_fungsional` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_rekenings_guru_id_foreign` (`guru_id`),
  KEY `guru_rekenings_created_by_foreign` (`created_by`),
  KEY `guru_rekenings_updated_by_foreign` (`updated_by`),
  KEY `guru_rekenings_deleted_by_foreign` (`deleted_by`),
  CONSTRAINT `guru_rekenings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `guru_rekenings_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `guru_rekenings_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_rekenings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `guru_rekenings` WRITE;
/*!40000 ALTER TABLE `guru_rekenings` DISABLE KEYS */;

INSERT INTO `guru_rekenings` (`id`, `guru_id`, `nama_bank`, `no_rekening`, `atas_nama`, `cabang`, `npwp`, `gaji_pokok`, `tunjangan_fungsional`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`)
VALUES
	(1,1,'mandiri','3873872873872','Ahmad wawan','bogor','87837478',20000.00,2000.00,'2026-06-14 02:44:08','2026-06-14 02:44:14',NULL,NULL,NULL,NULL),
	(2,2,'mandiri','837487387483832','uwyqeuyuuwhudfh ue hfu h','bogor','8.7348787384784E+17',80000000.00,200000.00,'2026-06-14 02:44:09','2026-06-14 03:28:33',NULL,NULL,NULL,NULL),
	(3,3,'BCA','8273787478384','Ahmad Fauzi, S.Pd','bogor','298219828323224',100000.00,20000.00,'2026-06-14 02:44:09','2026-06-14 02:44:14',NULL,NULL,NULL,NULL),
	(6,6,'BCA','878782799813','shjhduyrcudjiimiidhirtyuy','bogor','87478787438',20000.00,2000.00,'2026-06-14 02:44:09','2026-06-14 02:44:14',NULL,NULL,NULL,NULL),
	(7,7,'mandiri','193772938','hsajjudufdffjkdf','bogor','88349898498',2000.00,20000.00,'2026-06-14 02:44:09','2026-06-14 02:44:14',NULL,NULL,NULL,NULL),
	(9,9,'mandiri','283782772','sjdhufyhjdhjhfjh','bogor','787834787',2000.00,20000.00,'2026-06-14 02:44:09','2026-06-14 02:44:14',NULL,NULL,NULL,NULL),
	(11,11,'mandiri','27372878372','sahal Anwar hadi .S.kom','bogor','87348748',20000.00,30000.00,'2026-06-14 02:44:09','2026-06-14 02:44:14',NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `guru_rekenings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table guru_sertifikasis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guru_sertifikasis`;

CREATE TABLE `guru_sertifikasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `jenis_sertifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_sertifikasi` year NOT NULL,
  `bidang_studi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nrg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_terbit` date DEFAULT NULL,
  `expired_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_sertifikasis_guru_id_foreign` (`guru_id`),
  KEY `guru_sertifikasis_created_by_foreign` (`created_by`),
  KEY `guru_sertifikasis_updated_by_foreign` (`updated_by`),
  KEY `guru_sertifikasis_deleted_by_foreign` (`deleted_by`),
  CONSTRAINT `guru_sertifikasis_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `guru_sertifikasis_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `guru_sertifikasis_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_sertifikasis_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `guru_sertifikasis` WRITE;
/*!40000 ALTER TABLE `guru_sertifikasis` DISABLE KEYS */;

INSERT INTO `guru_sertifikasis` (`id`, `guru_id`, `jenis_sertifikasi`, `no_sertifikat`, `tahun_sertifikasi`, `bidang_studi`, `nrg`, `file_sertifikat`, `tanggal_terbit`, `expired_at`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`)
VALUES
	(1,1,'Sertifikasi Pendidik','394737487834783','1990','guru MI','849384934',NULL,'2026-05-03','2020-04-17','2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(2,2,'Sertifikasi Pendidik','9283982983982','2020','guru MI','47837488',NULL,'2005-01-16','2006-08-15','2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(3,3,'Sertifikasi Pendidik','83748783748734','1999','guru MI','374873748734',NULL,'2005-01-09','2005-07-15','2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(6,6,'Sertifikasi Pendidik','3847873847','2008','guru MI','9348983948',NULL,'2010-05-11','2005-07-15','2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(7,7,'Sertifikasi Pendidik','67667','2007','guru MI','9849389483',NULL,'2020-04-17','2006-08-15','2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(9,9,'Sertifikasi Pendidik','1234567890','2009','guru MI','8394898493',NULL,'2006-08-15','2020-04-17','2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL),
	(11,11,'Sertifikasi Pendidik','1234567890','1990','guru MI','98498348',NULL,'2026-04-06','2005-07-15','2026-06-14 02:44:09','2026-06-14 02:44:09',NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `guru_sertifikasis` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gurus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gurus`;

CREATE TABLE `gurus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `nuptk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_karpeg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nomor Kartu Pegawai',
  `no_karis_karsu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nomor Karis/Karsu',
  `nik` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_kk` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan_darah` enum('A','B','AB','O','-') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `agama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu_kandung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Untuk verifikasi',
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` bigint unsigned DEFAULT NULL,
  `tanggal_bergabung` date DEFAULT NULL,
  `tmt_pns` date DEFAULT NULL COMMENT 'Tanggal Mulai Tugas PNS',
  `tmt_gty` date DEFAULT NULL COMMENT 'Terhitung Mulai Tugas sebagai Guru Tetap Yayasan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gurus_nuptk_unique` (`nuptk`),
  UNIQUE KEY `gurus_email_unique` (`email`),
  UNIQUE KEY `gurus_nik_unique` (`nik`),
  KEY `gurus_user_id_foreign` (`user_id`),
  KEY `gurus_verified_by_foreign` (`verified_by`),
  KEY `gurus_created_by_foreign` (`created_by`),
  KEY `gurus_updated_by_foreign` (`updated_by`),
  KEY `gurus_deleted_by_foreign` (`deleted_by`),
  KEY `gurus_nama_index` (`nama`),
  KEY `gurus_status_aktif_index` (`status_aktif`),
  CONSTRAINT `gurus_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `gurus_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `gurus_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `gurus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `gurus_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `gurus` WRITE;
/*!40000 ALTER TABLE `gurus` DISABLE KEYS */;

INSERT INTO `gurus` (`id`, `user_id`, `nuptk`, `nama`, `nip`, `no_karpeg`, `no_karis_karsu`, `nik`, `no_kk`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `golongan_darah`, `agama`, `nama_ibu_kandung`, `foto`, `alamat`, `no_hp`, `email`, `status_aktif`, `is_verified`, `verified_at`, `verified_by`, `tanggal_bergabung`, `tmt_pns`, `tmt_gty`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`)
VALUES
	(1,NULL,'35678909876567892','Ahmad wawan','623768478786438784','73676764','347837847837','0987656787623456','48976789678935','bogor','2000-05-10','Laki-laki','A','Islam','wiwi','foto_guru/77206036-39f6-4ac0-a410-123a0f0a3879.jpeg','hueyueyrdjhjfhjhdjfhjhjbbcbvhjhjfdhreuiuisijdijs','08787822772689','wawan@gmail.com',1,0,NULL,NULL,'2026-05-03','2005-01-09','2006-08-15','2026-06-14 02:44:05','2026-06-14 02:44:14',NULL,NULL,NULL,NULL),
	(2,NULL,'98789878987897896789','uwyqeuyuuwhudfh ue hfu h','832748974882934','9823982983','239892938/9829389283','3276476273647632','24567678767876700','bogor','1980-01-06','Laki-laki','AB','Islam','uweyuryyryyuyduyfdghcgdf','foto_guru/86c78ff2-b69a-4f49-8f14-13f033a2ebe6.png','yueryuyuryuyhfjhdfjhghfhvbhbfhbvhbf','08768787898789','hgashdggweydtygy@gmail.com',1,0,NULL,NULL,'2005-01-16','2026-05-10','2026-05-10','2026-06-14 02:44:09','2026-06-14 03:28:33',NULL,NULL,NULL,NULL),
	(3,NULL,'1234567890123456','Ahmad Fauzi, S.Pd','198001012005011008','K123456','3384847374','1234567890123456','1123456789012340','Jakarta','1980-01-01','Laki-laki','A','Islam','Siti Aminah','foto_guru/62cb22a8-d616-4b1b-9c7c-bee77da354d4.png','Jl. Pendidikan No 1, RT 01/RW 02, Kel. Contoh','081234567890','ahmad@sekolah.id',1,0,NULL,NULL,'2005-01-09','2010-01-01','2026-05-03','2026-06-14 02:44:09','2026-06-14 02:44:14',NULL,NULL,NULL,NULL),
	(6,NULL,'664737467367434','shjhduyrcudjiimiidhirtyuy','8374745478757487574875','837478374','73847873','834773847873','34378483757287000','bandung','2000-01-11','Perempuan','O','Khonghucu','wooooo','foto_guru/42fa79d1-f0d4-49c8-872f-79c2d7abb90e.png','ndjhhduhueyuyuduiushdskjkskdkjcjxjbc','08776766828773','sduueyidushjhj@gmail.com',1,0,NULL,NULL,'2010-05-11','2026-05-01','2006-07-25','2026-06-14 02:44:09','2026-06-14 02:44:14',NULL,NULL,NULL,NULL),
	(7,NULL,'987878787879','hsajjudufdffjkdf','11839828933847','834778437','834738','83487384783','247874878374','bogor','1999-05-11','Perempuan','O','Katolik','suuuu','foto_guru/052448cf-292e-41ca-95f1-c1e02c42d621.jpeg','iuueiuehdjhkfufycuyuyfuyughhjdhfhieidlskdskdjksdbxncxfhrueycnx','08987873487434','sdbjhheuaudhsjh@gmail.com',1,0,NULL,NULL,'2020-04-17','2005-01-09','2006-08-15','2026-06-14 02:44:09','2026-06-14 02:44:14',NULL,NULL,NULL,NULL),
	(9,NULL,'9898989898','sjdhufyhjdhjhfjh','74873874732','87478374','782837872','3477467364633','727873874873','bogor','1989-01-12','Laki-laki','O','Islam','ettttt','foto_guru/1424076e-776b-4848-8a2d-62a38c7aeb99.png','jshhdusyuyudhjjjhjdcjjbc','0899983748348','ashjhjhajh@gmail.com',1,0,NULL,NULL,'2006-08-15','2010-10-05','2006-08-15','2026-06-14 02:44:09','2026-06-14 02:44:14',NULL,NULL,NULL,NULL),
	(11,NULL,'762736362647','sahal Anwar hadi .S.kom','98982389832','348783784','73827372','3434348384873840','73873384778347','bogor','2026-04-05','Laki-laki','B','Islam','Yusroh','foto_guru/1de6be8a-9006-4b64-a48f-49f62d03ee98.jpg','sghgdghsghdghsgdh','085811723878','sahalanwarhadi25@gmail.com',1,0,NULL,NULL,'2026-04-06','2005-01-09','2020-04-17','2026-06-14 02:44:09','2026-06-14 02:44:14',NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `gurus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jadwals
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jadwals`;

CREATE TABLE `jadwals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kelas_id` bigint unsigned NOT NULL,
  `guru_id` bigint unsigned NOT NULL,
  `mapel_id` bigint unsigned NOT NULL,
  `hari` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `tahun_ajaran_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwals_kelas_id_foreign` (`kelas_id`),
  KEY `jadwals_guru_id_foreign` (`guru_id`),
  KEY `jadwals_mapel_id_foreign` (`mapel_id`),
  KEY `jadwals_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  CONSTRAINT `jadwals_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwals_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwals_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapels` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwals_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table job_batches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table kelas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kapasitas` int NOT NULL DEFAULT '32',
  `parent_meeting_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun_ajaran_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kelas_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  CONSTRAINT `kelas_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;

INSERT INTO `kelas` (`id`, `nama_kelas`, `tingkat`, `kapasitas`, `parent_meeting_at`, `created_at`, `updated_at`, `tahun_ajaran_id`)
VALUES
	(11,'A','1',32,NULL,'2026-05-21 12:56:37','2026-06-16 10:13:33',6),
	(12,'A','2',32,NULL,'2026-05-21 13:23:48','2026-06-16 10:13:45',6),
	(13,'B','1',32,NULL,'2026-06-16 10:27:27','2026-06-16 10:27:27',6);

/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table komponen_penilaians
# ------------------------------------------------------------

DROP TABLE IF EXISTS `komponen_penilaians`;

CREATE TABLE `komponen_penilaians` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_komponen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot_persentase` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table mapels
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mapels`;

CREATE TABLE `mapels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_mapel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelompok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'0001_01_01_000000_create_users_table',1),
	(2,'0001_01_01_000001_create_cache_table',1),
	(3,'0001_01_01_000002_create_jobs_table',1),
	(4,'2026_02_09_134915_create_mapels_table',1),
	(5,'2026_02_19_070000_create_roles_table',1),
	(6,'2026_02_19_070109_create_role_user_table',1),
	(7,'2026_02_19_070150_create_gurus_table',1),
	(8,'2026_02_19_070151_create_kelas_table',1),
	(9,'2026_02_19_070152_create_tahun_ajarans_table',1),
	(10,'2026_02_19_070223_add_tahun_ajaran_to_kelas',1),
	(11,'2026_02_19_070245_create_wali_kelas_table',1),
	(12,'2026_02_19_070316_create_siswas_table',1),
	(13,'2026_02_19_070317_add_tahun_ajaran_to_siswas',1),
	(14,'2026_02_19_070341_create_orang_tuas_table',1),
	(15,'2026_02_19_070409_create_jadwals_table',1),
	(16,'2026_02_19_070432_create_nilais_table',1),
	(17,'2026_02_19_070455_create_absensis_table',1),
	(18,'2026_02_19_070519_create_pembayarans_table',1),
	(19,'2026_02_19_070542_create_catatan_walis_table',1),
	(20,'2026_02_19_070611_create_rapors_table',1),
	(21,'2026_02_19_070635_create_calon_siswas_table',1),
	(22,'2026_02_19_070710_create_berkas_pendaftars_table',1),
	(23,'2026_02_19_070732_create_pembayaran_ppdb_table',1),
	(24,'2026_02_19_163538_remove_role_from_users_table',1),
	(25,'2026_02_22_065400_add_is_active_to_users_table',1),
	(26,'2026_02_22_094600_create_bendaharas_table',1),
	(27,'2026_02_22_094623_create_admin_ppdb_profiles_table',1),
	(28,'2026_04_26_151432_add_fields_to_orang_tuas_table',2),
	(29,'2026_04_27_014438_fix_user_id_nullable_on_orang_tuas',2),
	(30,'2026_04_27_023615_add_foto_to_siswas_table',2),
	(31,'2026_04_27_030532_add_pekerjaan_ibu_to_orang_tuas_table',2),
	(32,'2026_04_27_033454_add_agama_to_siswas_table',2),
	(33,'2026_05_01_191103_add_details_to_tahun_ajarans_table',2),
	(34,'2026_05_01_195325_add_kapasitas_to_kelas_table',2),
	(35,'2026_05_01_200612_add_parent_meeting_at_to_kelas_table',2),
	(36,'2026_05_01_201644_add_tingkat_to_siswas_table',2),
	(37,'2026_05_02_103719_create_semesters_table',2),
	(38,'2026_05_02_103721_remove_semester_columns_from_tahun_ajarans_table',2),
	(39,'2026_05_02_122106_create_riwayat_kelas_table',2),
	(40,'2026_05_02_122200_add_mutasi_fields_to_siswas_table',2),
	(41,'2026_05_03_134202_add_sertifikasi_to_gurus_table',2),
	(42,'2026_05_04_000001_drop_pekerjaan_from_orang_tuas_table',2),
	(43,'2026_05_04_100000_add_additional_fields_to_gurus_table',2),
	(44,'2026_05_04_100000_add_user_id_to_gurus_table',2),
	(45,'2026_05_04_100001_add_health_and_kk_to_siswas_table',2),
	(46,'2026_05_05_085621_create_guru_dokumens_table',2),
	(47,'2026_05_05_120900_create_guru_diklats_table',2),
	(48,'2026_05_05_121042_add_tmt_gty_to_gurus_table',2),
	(49,'2026_05_07_123750_create_guru_inpassings_table',2),
	(50,'2026_05_09_031751_add_fields_to_mapels_table',2),
	(51,'2026_05_09_031805_remove_tahun_ajaran_string_from_kelas_table',2),
	(52,'2026_05_09_031828_create_guru_mapels_table',2),
	(53,'2026_05_09_031828_create_guru_pendidikans_table',2),
	(54,'2026_05_09_031828_create_guru_sertifikasis_table',2),
	(55,'2026_05_09_031829_create_guru_rekenings_table',2),
	(56,'2026_05_09_031958_cleanup_columns_from_gurus_table',2),
	(57,'2026_05_09_033000_create_guru_jabatans_table',2),
	(58,'2026_05_09_033100_further_cleanup_columns_from_gurus_table',2),
	(59,'2026_05_09_034800_create_guru_keluargas_table',2),
	(60,'2026_05_09_034900_final_cleanup_columns_from_gurus_table',2),
	(61,'2026_05_09_044500_refine_guru_module_schema',2),
	(62,'2026_05_09_044600_create_wali_kelas_table',2),
	(63,'2026_05_09_044700_create_guru_absensis_table',2),
	(64,'2026_05_09_044800_add_soft_deletes_and_audit_to_guru_module',2),
	(65,'2026_05_09_044900_add_indexes_to_gurus_table',2),
	(66,'2026_05_10_081452_add_teaching_fields_to_gurus_table',2),
	(67,'2026_05_10_141040_fix_length_no_kk_nik_in_gurus_table',2),
	(68,'2026_05_14_032655_add_soft_deletes_to_guru_diklats_and_inpassings',2),
	(69,'2026_05_14_060820_add_soft_deletes_to_guru_dokumens_table',2),
	(70,'2026_05_16_030749_alter_absensis_table_add_histori',2),
	(71,'2026_05_16_030749_alter_catatan_walis_table_add_histori',2),
	(72,'2026_05_16_030749_alter_nilais_table_add_histori',2),
	(73,'2026_05_16_030749_alter_rapors_table_add_status_kenaikan',2),
	(74,'2026_05_16_030749_alter_riwayat_kelas_add_tahun_ajaran_id',2),
	(75,'2026_05_16_030749_create_tagihans_table',2),
	(76,'2026_05_16_030750_alter_pembayarans_table_add_tagihan_id',2),
	(77,'2026_05_16_030750_alter_siswas_table_add_user_id',2),
	(78,'2026_05_16_033030_add_soft_deletes_to_siswa_module',2),
	(79,'2026_05_16_065605_add_masuk_kembali_to_riwayat_kelas_enum',2),
	(80,'2026_05_17_045526_create_komponen_penilaians_table',2),
	(81,'2026_05_17_045526_create_mutasi_siswas_table',2),
	(82,'2026_05_17_045526_create_orang_tua_siswa_table',2),
	(83,'2026_05_17_045526_create_perkembangan_siswas_table',2),
	(84,'2026_05_17_045526_remove_fisik_mutasi_from_siswas_table',2),
	(85,'2026_05_17_045526_remove_siswa_id_from_orang_tuas_table',2),
	(86,'2026_05_17_045527_add_audit_columns_to_tables',2),
	(87,'2026_05_17_045527_add_kategori_to_tagihans_table',2),
	(88,'2026_05_17_045527_create_plot_guru_mapels_table',2),
	(89,'2026_05_17_045527_refactor_nilais_table',2),
	(90,'2026_05_17_072601_add_wali_fields_to_orang_tuas_table',2),
	(91,'2026_05_17_074551_add_penghasilan_fields_to_orang_tuas_table',2),
	(92,'2026_05_17_163900_add_dapodik_fields_to_siswas_table',2),
	(93,'2026_05_17_163901_add_dapodik_fields_to_orang_tuas_table',2),
	(94,'2026_05_18_072804_create_berkas_siswas_table',2),
	(95,'2026_05_18_101843_update_jenis_mutasi_enum_on_mutasi_siswas_table',2),
	(96,'2026_05_18_103328_add_nonaktif_to_riwayat_kelas_jenis_perubahan',2),
	(97,'2026_05_18_135600_add_soft_deletes_to_perkembangan_siswas_table',2),
	(98,'2026_05_18_142013_add_nik_and_tahun_lahir_wali_to_orang_tuas_table',2),
	(99,'2026_05_20_074839_create_prestasis_table',2),
	(100,'2026_05_20_074840_create_beasiswas_table',2),
	(101,'2026_05_20_100305_add_file_bukti_to_prestasis_table',2),
	(102,'2026_05_21_193200_create_data_tambahan_siswas_table',2),
	(103,'2026_05_21_193210_create_program_kesejahteraan_siswas_table',2),
	(104,'2026_06_16_131005_add_mutasi_masuk_to_mutasi_siswas_table',3),
	(105,'2026_06_16_151600_add_rapor_sekolah_asal_to_berkas_siswas',4);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table mutasi_siswas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mutasi_siswas`;

CREATE TABLE `mutasi_siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `jenis_mutasi` enum('lulus','mutasi_keluar','nonaktif','mutasi_masuk') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci,
  `sekolah_asal_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mutasi_siswas_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `mutasi_siswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `mutasi_siswas` WRITE;
/*!40000 ALTER TABLE `mutasi_siswas` DISABLE KEYS */;

INSERT INTO `mutasi_siswas` (`id`, `siswa_id`, `jenis_mutasi`, `tanggal`, `no_surat`, `alasan`, `sekolah_asal_tujuan`, `created_at`, `updated_at`)
VALUES
	(2,8,'mutasi_keluar','2026-05-10','8787878787','hgghghhguyyuyyhh','yutytytytttyuug','2026-05-21 13:20:37','2026-05-21 13:20:37'),
	(3,9,'mutasi_keluar','2026-06-07','989889889','kjjkjjhghghghghghghggff','sdn kencana 2','2026-06-16 07:54:54','2026-06-16 07:54:54'),
	(4,9,'lulus','2026-06-07','89989898787877','lulus',NULL,'2026-06-16 07:56:04','2026-06-16 07:56:04'),
	(5,9,'nonaktif','2026-06-08','232434435454645','fdfgftyhg',NULL,'2026-06-16 07:57:05','2026-06-16 07:57:05'),
	(6,8,'mutasi_masuk','2026-06-16',NULL,'test',NULL,'2026-06-16 13:27:52','2026-06-16 13:27:52'),
	(8,22,'mutasi_masuk','2026-06-07','5847854787485','sdjhhjhdjhjffdhjdhjfbcjbjbjv','sdn kencana 2 (NPSN: 38487487847)','2026-06-16 15:26:43','2026-06-16 15:26:43');

/*!40000 ALTER TABLE `mutasi_siswas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table nilais
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nilais`;

CREATE TABLE `nilais` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `plot_guru_mapel_id` bigint unsigned DEFAULT NULL,
  `komponen_penilaian_id` bigint unsigned DEFAULT NULL,
  `nilai` decimal(5,2) DEFAULT NULL,
  `nilai_akhir` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun_ajaran_id` bigint unsigned DEFAULT NULL,
  `kelas_id` bigint unsigned DEFAULT NULL,
  `semester` enum('Ganjil','Genap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nilais_siswa_id_foreign` (`siswa_id`),
  KEY `nilais_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  KEY `nilais_kelas_id_foreign` (`kelas_id`),
  KEY `nilais_created_by_foreign` (`created_by`),
  KEY `nilais_updated_by_foreign` (`updated_by`),
  KEY `nilais_plot_guru_mapel_id_foreign` (`plot_guru_mapel_id`),
  KEY `nilais_komponen_penilaian_id_foreign` (`komponen_penilaian_id`),
  KEY `idx_nilai_rapor` (`siswa_id`,`semester`,`tahun_ajaran_id`),
  CONSTRAINT `nilais_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nilais_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nilais_komponen_penilaian_id_foreign` FOREIGN KEY (`komponen_penilaian_id`) REFERENCES `komponen_penilaians` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nilais_plot_guru_mapel_id_foreign` FOREIGN KEY (`plot_guru_mapel_id`) REFERENCES `plot_guru_mapels` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nilais_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nilais_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nilais_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table notifikasis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifikasis`;

CREATE TABLE `notifikasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('absensi','nilai','pembayaran','umum') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'umum',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifikasis_user_id_foreign` (`user_id`),
  CONSTRAINT `notifikasis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table orang_tua_siswa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orang_tua_siswa`;

CREATE TABLE `orang_tua_siswa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `orang_tua_id` bigint unsigned NOT NULL,
  `hubungan_keluarga` enum('Ayah','Ibu','Wali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orang_tua_siswa_siswa_id_orang_tua_id_unique` (`siswa_id`,`orang_tua_id`),
  KEY `orang_tua_siswa_orang_tua_id_foreign` (`orang_tua_id`),
  CONSTRAINT `orang_tua_siswa_orang_tua_id_foreign` FOREIGN KEY (`orang_tua_id`) REFERENCES `orang_tuas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orang_tua_siswa_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `orang_tua_siswa` WRITE;
/*!40000 ALTER TABLE `orang_tua_siswa` DISABLE KEYS */;

INSERT INTO `orang_tua_siswa` (`id`, `siswa_id`, `orang_tua_id`, `hubungan_keluarga`, `created_at`, `updated_at`)
VALUES
	(5,8,5,'Ayah','2026-05-21 14:03:03','2026-05-21 14:03:03'),
	(6,8,6,'Ibu','2026-05-21 14:03:03','2026-05-21 14:03:03'),
	(7,8,7,'Wali','2026-05-21 14:03:03','2026-05-21 14:03:03'),
	(10,9,10,'Ayah','2026-05-21 14:12:14','2026-05-21 14:12:14'),
	(11,9,11,'Ibu','2026-06-16 04:04:17','2026-06-16 04:04:17'),
	(46,20,41,'Ayah','2026-06-16 09:55:31','2026-06-16 09:55:31'),
	(47,20,42,'Ibu','2026-06-16 09:55:31','2026-06-16 09:55:31'),
	(50,22,45,'Ayah','2026-06-16 15:26:43','2026-06-16 15:26:43'),
	(51,22,46,'Ibu','2026-06-16 15:26:43','2026-06-16 15:26:43');

/*!40000 ALTER TABLE `orang_tua_siswa` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table orang_tuas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orang_tuas`;

CREATE TABLE `orang_tuas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_ayah` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_lahir_ayah` year DEFAULT NULL,
  `pendidikan_ayah` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_ibu` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_lahir_ibu` year DEFAULT NULL,
  `pendidikan_ibu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penghasilan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penghasilan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_wali` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_lahir_wali` year DEFAULT NULL,
  `pekerjaan_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_wali` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penghasilan_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_wali` text COLLATE utf8mb4_unicode_ci,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orang_tuas_user_id_foreign` (`user_id`),
  CONSTRAINT `orang_tuas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `orang_tuas` WRITE;
/*!40000 ALTER TABLE `orang_tuas` DISABLE KEYS */;

INSERT INTO `orang_tuas` (`id`, `user_id`, `nama_ayah`, `nik_ayah`, `tahun_lahir_ayah`, `pendidikan_ayah`, `nama_ibu`, `nik_ibu`, `tahun_lahir_ibu`, `pendidikan_ibu`, `pekerjaan_ayah`, `penghasilan_ayah`, `pekerjaan_ibu`, `penghasilan_ibu`, `nama_wali`, `nik_wali`, `tahun_lahir_wali`, `pekerjaan_wali`, `pendidikan_wali`, `penghasilan_wali`, `no_hp_wali`, `alamat_wali`, `no_hp`, `alamat`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,NULL,'jhsjahhhs','7872388783273','2010','SD / Sederajat','jhjhhjhjhjhjhjh','928982398823923','2000','SMP / Sederajat','ajshjahjhjash','Rp 500.000 - Rp 999.999','bdjsjdhjhjhsdhds','Rp 5.000.000 - Rp 20.000.000','nbabnbnbnsdb','98281989891892','2000','sdbbhshdhhshshdhjshj','D4 / S1','Kurang dari Rp 500.000','08988989898','jhjhghghsdhhusydyysydyuyusdyuf','0878878778787','jshdjhjhjhjshhhhhfgdhhghdf','2026-05-21 13:04:00','2026-05-21 13:04:00',NULL),
	(3,NULL,'AYAH TEST 5','1234567890987654','1970','SD / Sederajat',NULL,NULL,NULL,NULL,'ngepet','Rp 2.000.000 - Rp 4.999.999',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'08988989898','jhjhghghsdhhusydyysydyuyusdyuf','2026-05-21 14:01:51','2026-05-21 14:01:51',NULL),
	(4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nbabnbnbnsdb','98281989891892','2000','sdbbhshdhhshshdhjshj','D4 / S1','Kurang dari Rp 500.000','08988989898','jhjhghghsdhhusydyysydyuyusdyuf','08988989898','jhjhghghsdhhusydyysydyuyusdyuf','2026-05-21 14:01:51','2026-05-21 14:01:51',NULL),
	(5,NULL,'AYAH TEST 1','1234567890987654','1970','SD / Sederajat',NULL,NULL,NULL,NULL,'ngepet','Rp 2.000.000 - Rp 4.999.999',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'08988989898','jhjhghghsdhhusydyysydyuyusdyuf','2026-05-21 14:03:03','2026-05-21 14:03:03',NULL),
	(6,NULL,NULL,NULL,NULL,NULL,'suuu','7877878787878787','2000','SMP / Sederajat',NULL,NULL,'jjhjhjhjhhjhjhjhj','Rp 2.000.000 - Rp 4.999.999',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'08988989898','jhjhghghsdhhusydyysydyuyusdyuf','2026-05-21 14:03:03','2026-05-21 14:03:03',NULL),
	(7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nbabnbnbnsdb','98281989891892','2000','sdbbhshdhhshshdhjshj','D4 / S1','Kurang dari Rp 500.000','08988989898','jhjhghghsdhhusydyysydyuyusdyuf','08988989898','jhjhghghsdhhusydyysydyuyusdyuf','2026-05-21 14:03:03','2026-05-21 14:03:03',NULL),
	(8,NULL,'AYAH TEST 2','29389829839823','2000','D2',NULL,NULL,NULL,NULL,'ngepet','Rp 2.000.000 - Rp 4.999.999',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'082289389283',NULL,'2026-05-21 14:05:21','2026-05-21 14:05:21',NULL),
	(9,NULL,'AYAH TEST 3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ngepet',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'082289389283',NULL,'2026-05-21 14:07:38','2026-05-21 14:07:38',NULL),
	(10,NULL,'AYAH TEST 4','8898989896687878','2000','SMP / Sederajat',NULL,NULL,NULL,NULL,'ngepet','Lebih dari Rp 20.000.000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'082289389283','jhjhjhkhkhyuyiihhghghkjkmnmnbnbjjhjhguyiyiuiyiyiiuiui','2026-05-21 14:12:14','2026-06-16 07:44:59',NULL),
	(11,NULL,NULL,NULL,NULL,NULL,'yuyuyuy','7676766878878778','2010','SMP / Sederajat',NULL,NULL,'hghghghghg','Lebih dari Rp 20.000.000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'082289389283','jhjhjhkhkhyuyiihhghghkjkmnmnbnbjjhjhguyiyiuiyiyiiuiui','2026-06-16 04:04:17','2026-06-16 07:44:59',NULL),
	(41,NULL,'wawan','7878778787889889','2000','S3',NULL,NULL,NULL,NULL,'wirausaha','Lebih dari Rp 20.000.000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'089878777655','hasjhjhjhuyuyuyuweikjkjskjdnxnknknckxnkxck','2026-06-16 09:55:30','2026-06-16 09:55:30',NULL),
	(42,NULL,NULL,NULL,NULL,NULL,'maemunah','7878787878787878','1990','SD / Sederajat',NULL,NULL,'dagang','Rp 2.000.000 - Rp 4.999.999',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'089878777655','hasjhjhjhuyuyuyuweikjkjskjdnxnknknckxnkxck','2026-06-16 09:55:31','2026-06-16 09:55:31',NULL),
	(45,NULL,'hsdjshjdhhewuyu','9384989834943434','2020','D1',NULL,NULL,NULL,NULL,'sdjjjshjdhjweiiidsjd','Rp 5.000.000 - Rp 20.000.000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'08787876762','sjjdjhhjhehiiiksdbbhgsahfuuyueyhdhfjkhh239hehhjdjsjfhkhkhhshbbsdc','2026-06-16 15:26:43','2026-06-16 15:26:43',NULL),
	(46,NULL,NULL,NULL,NULL,NULL,'dnjsjfjiejrijeijr','9839928938232332','1990','D2',NULL,NULL,'snndjdfjhdfjd','Lebih dari Rp 20.000.000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'08787876762','sjjdjhhjhehiiiksdbbhgsahfuuyueyhdhfjkhh239hehhjdjsjfhkhkhhshbbsdc','2026-06-16 15:26:43','2026-06-16 15:26:43',NULL);

/*!40000 ALTER TABLE `orang_tuas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_reset_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pembayaran_ppdb
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pembayaran_ppdb`;

CREATE TABLE `pembayaran_ppdb` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `calon_siswa_id` bigint unsigned NOT NULL,
  `jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` decimal(12,2) NOT NULL,
  `status` enum('lunas','belum') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayaran_ppdb_calon_siswa_id_foreign` (`calon_siswa_id`),
  CONSTRAINT `pembayaran_ppdb_calon_siswa_id_foreign` FOREIGN KEY (`calon_siswa_id`) REFERENCES `calon_siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pembayarans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pembayarans`;

CREATE TABLE `pembayarans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bulan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal_bayar` decimal(12,2) NOT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tagihan_id` bigint unsigned DEFAULT NULL,
  `status` enum('Lunas','Dicicil','Belum') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayarans_siswa_id_foreign` (`siswa_id`),
  KEY `pembayarans_tagihan_id_foreign` (`tagihan_id`),
  KEY `pembayarans_created_by_foreign` (`created_by`),
  KEY `pembayarans_updated_by_foreign` (`updated_by`),
  KEY `idx_bayar_status` (`siswa_id`,`status`,`tagihan_id`),
  CONSTRAINT `pembayarans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pembayarans_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pembayarans_tagihan_id_foreign` FOREIGN KEY (`tagihan_id`) REFERENCES `tagihans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pembayarans_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table perkembangan_siswas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `perkembangan_siswas`;

CREATE TABLE `perkembangan_siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `tahun_ajaran_id` bigint unsigned DEFAULT NULL,
  `semester` enum('Ganjil','Genap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinggi_badan` decimal(5,2) DEFAULT NULL,
  `berat_badan` decimal(5,2) DEFAULT NULL,
  `catatan_kesehatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perkembangan_siswas_siswa_id_foreign` (`siswa_id`),
  KEY `perkembangan_siswas_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  CONSTRAINT `perkembangan_siswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `perkembangan_siswas_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `perkembangan_siswas` WRITE;
/*!40000 ALTER TABLE `perkembangan_siswas` DISABLE KEYS */;

INSERT INTO `perkembangan_siswas` (`id`, `siswa_id`, `tahun_ajaran_id`, `semester`, `tinggi_badan`, `berat_badan`, `catatan_kesehatan`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,8,6,'Ganjil',126.00,25.00,'fgnfjjgjfhgjhjfhg','2026-05-21 13:04:00','2026-05-21 13:04:00',NULL),
	(21,20,6,'Ganjil',125.00,30.00,'djhshjhdhjehrh','2026-06-16 09:55:31','2026-06-16 09:55:31',NULL),
	(23,22,6,'Ganjil',120.00,50.00,'djfjjhfjjireriereioiroiedffndf','2026-06-16 15:26:43','2026-06-16 15:26:43',NULL);

/*!40000 ALTER TABLE `perkembangan_siswas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table plot_guru_mapels
# ------------------------------------------------------------

DROP TABLE IF EXISTS `plot_guru_mapels`;

CREATE TABLE `plot_guru_mapels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `mapel_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `tahun_ajaran_id` bigint unsigned NOT NULL,
  `semester` enum('Ganjil','Genap') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_plot_guru_mapel` (`guru_id`,`mapel_id`,`kelas_id`,`tahun_ajaran_id`,`semester`),
  KEY `plot_guru_mapels_mapel_id_foreign` (`mapel_id`),
  KEY `plot_guru_mapels_kelas_id_foreign` (`kelas_id`),
  KEY `plot_guru_mapels_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  CONSTRAINT `plot_guru_mapels_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `plot_guru_mapels_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `plot_guru_mapels_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapels` (`id`) ON DELETE CASCADE,
  CONSTRAINT `plot_guru_mapels_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table prestasis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prestasis`;

CREATE TABLE `prestasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tingkat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penyelenggara` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prestasis_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `prestasis_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `prestasis` WRITE;
/*!40000 ALTER TABLE `prestasis` DISABLE KEYS */;

INSERT INTO `prestasis` (`id`, `siswa_id`, `nama`, `jenis`, `tingkat`, `tahun`, `penyelenggara`, `file_bukti`, `keterangan`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,8,'juara 1 pingpong','Akademik','Sekolah','2025','presiden','prestasi_siswa/1779369275_juara-1-pingpong.jpeg','ghggygytytytytyt','2026-05-21 13:14:35','2026-05-21 13:14:35',NULL);

/*!40000 ALTER TABLE `prestasis` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table program_kesejahteraan_siswas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `program_kesejahteraan_siswas`;

CREATE TABLE `program_kesejahteraan_siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `penerima_kps_pkh` tinyint(1) NOT NULL DEFAULT '0',
  `no_kps_pkh` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layak_pip` tinyint(1) NOT NULL DEFAULT '0',
  `alasan_layak_pip` text COLLATE utf8mb4_unicode_ci,
  `penerima_kip` tinyint(1) NOT NULL DEFAULT '0',
  `no_kip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_tertera_di_kip` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `program_kesejahteraan_siswas_siswa_id_unique` (`siswa_id`),
  CONSTRAINT `program_kesejahteraan_siswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `program_kesejahteraan_siswas` WRITE;
/*!40000 ALTER TABLE `program_kesejahteraan_siswas` DISABLE KEYS */;

INSERT INTO `program_kesejahteraan_siswas` (`id`, `siswa_id`, `penerima_kps_pkh`, `no_kps_pkh`, `layak_pip`, `alasan_layak_pip`, `penerima_kip`, `no_kip`, `nama_tertera_di_kip`, `created_at`, `updated_at`)
VALUES
	(2,8,1,'93898984983',1,'dfjhjdjhjhjrhhuyurtyuyuryt',1,'29839892839892','hjhsdjfhhdjhfhdhfhdhjhfjhfg','2026-05-21 13:04:00','2026-05-21 13:04:00'),
	(3,9,0,NULL,0,NULL,0,NULL,NULL,'2026-05-21 14:05:21','2026-05-21 14:05:21'),
	(14,20,1,'29328839892832',1,'sjhdheuyyueyrusbjdbjfd',1,'3287887873878478734','sdjhjhheuryuyuyhsjhfdj','2026-06-16 09:55:30','2026-06-16 09:55:30'),
	(16,22,1,'823982983982',1,'jshajhdsbhbcnsbhbdfbsdjfjjdshjfhd',1,'2398928938923233','sndjjjewrjkejwkrjerii','2026-06-16 15:26:43','2026-06-16 15:26:43');

/*!40000 ALTER TABLE `program_kesejahteraan_siswas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rapors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rapors`;

CREATE TABLE `rapors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `tahun_ajaran_id` bigint unsigned NOT NULL,
  `catatan_wali` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('draft','final') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_kenaikan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` enum('Ganjil','Genap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rapors_siswa_id_foreign` (`siswa_id`),
  KEY `rapors_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  CONSTRAINT `rapors_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rapors_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table riwayat_kelas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `riwayat_kelas`;

CREATE TABLE `riwayat_kelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned DEFAULT NULL,
  `nama_kelas_snapshot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `jenis_perubahan` enum('naik_kelas','turun_kelas','pindah_kelas','masuk_baru','mutasi_masuk','mutasi_keluar','lulus','masuk_kembali','nonaktif') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun_ajaran_id` bigint unsigned DEFAULT NULL,
  `semester` enum('Ganjil','Genap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `riwayat_kelas_siswa_id_foreign` (`siswa_id`),
  KEY `riwayat_kelas_kelas_id_foreign` (`kelas_id`),
  KEY `riwayat_kelas_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  CONSTRAINT `riwayat_kelas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `riwayat_kelas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `riwayat_kelas_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `riwayat_kelas` WRITE;
/*!40000 ALTER TABLE `riwayat_kelas` DISABLE KEYS */;

INSERT INTO `riwayat_kelas` (`id`, `siswa_id`, `kelas_id`, `nama_kelas_snapshot`, `tanggal_masuk`, `tanggal_keluar`, `jenis_perubahan`, `catatan`, `created_at`, `updated_at`, `tahun_ajaran_id`, `semester`, `deleted_at`)
VALUES
	(14,8,11,'1 A','2026-05-21','2026-05-10','masuk_baru','Pendaftaran siswa baru','2026-05-21 13:04:00','2026-05-21 13:20:37',6,'Ganjil',NULL),
	(15,8,NULL,'Mutasi Keluar','2026-05-10','2026-05-10','mutasi_keluar','hgghghhguyyuyyhh (Surat: 8787878787)','2026-05-21 13:20:37','2026-05-21 13:20:37',6,'Ganjil',NULL),
	(16,8,11,'1 A','2026-05-21',NULL,'masuk_kembali','Siswa aktif kembali dari status pindah','2026-05-21 13:22:29','2026-05-21 13:22:29',6,'Ganjil',NULL),
	(17,9,11,'1 A','2026-06-16','2026-06-07','pindah_kelas','Perpindahan kelas via edit data','2026-06-16 07:54:05','2026-06-16 07:54:54',6,'Ganjil',NULL),
	(18,9,NULL,'Mutasi Keluar','2026-06-07','2026-06-07','mutasi_keluar','kjjkjjhghghghghghghggff (Surat: 989889889)','2026-06-16 07:54:54','2026-06-16 07:54:54',6,'Ganjil',NULL),
	(19,9,11,'1 A','2026-06-16','2026-06-07','masuk_kembali','Siswa aktif kembali dari status pindah','2026-06-16 07:55:29','2026-06-16 07:56:04',6,'Ganjil',NULL),
	(20,9,NULL,'Lulus','2026-06-07','2026-06-07','lulus','lulus (Surat: 89989898787877)','2026-06-16 07:56:04','2026-06-16 07:56:04',6,'Ganjil',NULL),
	(21,9,11,'1 A','2026-06-16','2026-06-08','masuk_kembali','Siswa aktif kembali dari status lulus','2026-06-16 07:56:31','2026-06-16 07:57:05',6,'Ganjil',NULL),
	(22,9,NULL,'Nonaktif','2026-06-08','2026-06-08','nonaktif','fdfgftyhg (Surat: 232434435454645)','2026-06-16 07:57:05','2026-06-16 07:57:05',6,'Ganjil',NULL),
	(23,9,12,'2 A','2026-06-16','2026-06-16','masuk_kembali','Siswa aktif kembali dari status nonaktif','2026-06-16 07:57:49','2026-06-16 08:51:22',6,'Ganjil',NULL),
	(24,20,11,'1 A','2026-06-16','2026-06-16','masuk_baru','Pendaftaran siswa baru','2026-06-16 09:55:31','2026-06-16 10:05:47',6,'Ganjil',NULL),
	(25,9,13,'1 B','2026-06-16',NULL,'pindah_kelas','Perpindahan kelas via edit data','2026-06-16 10:27:45','2026-06-16 10:27:45',6,'Ganjil',NULL),
	(26,20,12,'2 A','2026-06-16',NULL,'pindah_kelas','Perpindahan kelas via edit data','2026-06-16 10:36:11','2026-06-16 10:36:11',6,'Ganjil',NULL),
	(28,22,12,'2 A','2026-06-16','2026-06-16','mutasi_masuk','Mutasi masuk dari sdn kencana 2 (NPSN: 38487487847)','2026-06-16 15:26:43','2026-06-16 15:30:22',6,'Ganjil',NULL);

/*!40000 ALTER TABLE `riwayat_kelas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;

INSERT INTO `role_user` (`id`, `user_id`, `role_id`)
VALUES
	(6,26,9),
	(7,27,6),
	(8,28,7);

/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(6,'kepsek','2026-05-21 12:47:14','2026-05-21 12:47:14'),
	(7,'guru','2026-05-21 12:47:14','2026-05-21 12:47:14'),
	(8,'wali_kelas','2026-05-21 12:47:14','2026-05-21 12:47:14'),
	(9,'operator','2026-05-21 12:47:14','2026-05-21 12:47:14'),
	(10,'bendahara','2026-05-21 12:47:14','2026-05-21 12:47:14'),
	(11,'ortu','2026-05-21 12:47:14','2026-05-21 12:47:14'),
	(12,'admin_ppdb','2026-05-21 12:47:14','2026-05-21 12:47:14');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table semesters
# ------------------------------------------------------------

DROP TABLE IF EXISTS `semesters`;

CREATE TABLE `semesters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun_ajaran_id` bigint unsigned NOT NULL,
  `nama` enum('Ganjil','Genap') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `semesters_tahun_ajaran_id_nama_unique` (`tahun_ajaran_id`,`nama`),
  CONSTRAINT `semesters_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `semesters` WRITE;
/*!40000 ALTER TABLE `semesters` DISABLE KEYS */;

INSERT INTO `semesters` (`id`, `tahun_ajaran_id`, `nama`, `tgl_mulai`, `tgl_selesai`, `is_active`, `created_at`, `updated_at`)
VALUES
	(6,6,'Ganjil','2026-05-03','2026-05-10',1,'2026-05-21 12:56:07','2026-05-21 12:56:07'),
	(7,6,'Genap','2026-01-05','2026-06-20',0,'2026-07-09 20:29:32','2026-07-09 20:29:32');

/*!40000 ALTER TABLE `semesters` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`)
VALUES
	('PJb3tfDMY1zqSO3GKEy955gKKT15jIfwb9nhUDFu',26,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSk9ndHI0Q3JVNW1Lc3FvOEk3SGVmckU2ZVk0MjE3bjRBcWhTaGhNUyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL29wZXJhdG9yL2RhdGEtc2lzd2EiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1ODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL29wZXJhdG9yL2RhdGEtc2lzd2EvMjIvcml3YXlhdC1rZWxhcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI2O30=',1781623828),
	('SkNaoZ7vIqycHnEF68DgGavWg6PPlvfJacPVliO5',26,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiekhjOEFlMnR3SjVFUFF2YmtTN3djY09INjRoVHlnZ2V5cU8xUmFERCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcGVyYXRvci9kYXRhLXNpc3dhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjY7fQ==',1781606171);

/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `created_at`, `updated_at`)
VALUES
	(1,'nama_sekolah','MI Nurul Huda 3',NULL,NULL),
	(2,'npsn','60712345',NULL,NULL),
	(3,'logo','logo/nama_file_logo.png',NULL,NULL),
	(4,'alamat','Jl. Nurul Huda No. 3, Kota Bogor',NULL,NULL),
	(5,'kepala_sekolah','Nama Kepala Sekolah, S.Pd',NULL,NULL);

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table siswas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `siswas`;

CREATE TABLE `siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nisn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` int NOT NULL DEFAULT '1',
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_kk` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan_darah` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `riwayat_penyakit` text COLLATE utf8mb4_unicode_ci,
  `kebutuhan_khusus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_siswa` text COLLATE utf8mb4_unicode_ci,
  `rt` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rw` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anak_ke` smallint unsigned DEFAULT NULL,
  `jumlah_saudara` smallint unsigned DEFAULT NULL,
  `jarak_tempat_tinggal` decimal(5,1) DEFAULT NULL,
  `waktu_tempuh` smallint unsigned DEFAULT NULL,
  `moda_transportasi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `kelas_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun_ajaran_id` bigint unsigned DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswas_nis_unique` (`nis`),
  KEY `siswas_kelas_id_foreign` (`kelas_id`),
  KEY `siswas_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  KEY `siswas_user_id_foreign` (`user_id`),
  CONSTRAINT `siswas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `siswas_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `siswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `siswas` WRITE;
/*!40000 ALTER TABLE `siswas` DISABLE KEYS */;

INSERT INTO `siswas` (`id`, `nisn`, `nis`, `nama`, `tingkat`, `nik`, `no_kk`, `jenis_kelamin`, `agama`, `golongan_darah`, `riwayat_penyakit`, `kebutuhan_khusus`, `alamat_siswa`, `rt`, `rw`, `kelurahan`, `kecamatan`, `kode_pos`, `anak_ke`, `jumlah_saudara`, `jarak_tempat_tinggal`, `waktu_tempuh`, `moda_transportasi`, `tempat_lahir`, `tanggal_lahir`, `kelas_id`, `status`, `created_at`, `updated_at`, `tahun_ajaran_id`, `foto`, `asal_sekolah`, `tanggal_masuk`, `user_id`, `deleted_at`)
VALUES
	(8,'83478478378473','838374873847734','susilo',1,'98989238989238','3289288398298928','L','Islam','B','fhjhjhfjhjghfg','hjdjhdhjhjrr','jjjhsjdhhhhdhuhyuywyueywe','001','002','kencana','tanah sareal','12345',2,10,20.8,16,'Jalan Kaki','bogor','2026-05-03',11,'aktif','2026-05-21 13:04:00','2026-05-21 13:22:29',6,'foto_siswa/2rjhBbphJ43CCk23dHTcFhdQWC22PhPMnT2fDjUL.jpg','Tk robiatus salam','2026-05-03',NULL,NULL),
	(9,'7676767676','887287817287872','dsdhsdhjshdhsd',1,'4444343989898494','4349988398443499','L','Islam','B',NULL,NULL,'dshdgshudhehhruheur','001','002','kencana','tanah sareal','12345',2,10,2.5,10,'Mobil Pribadi','bogor','2026-05-03',13,'aktif','2026-05-21 14:05:21','2026-06-16 10:27:45',6,'foto_siswa/zx9j1Lp4Ayz01JsHrAg730wPB3mYMIPDKIBQOg3T.png',NULL,'2026-06-07',NULL,NULL),
	(20,'6766766767','767655665656','hjhhjhjhhjhjh',2,'9839892933732343','3849839894787384','L','Kristen','AB','djhshjrhjeirur','jasjhjhdjhsjdhjhf','hgghghghuyyyuyuytrtrtryffygyghhjjhjh','001','002','kencana','tanah sareal','12345',6,10,5.0,30,'Perahu / Sampan','bogor','2026-06-07',12,'aktif','2026-06-16 09:55:30','2026-06-16 10:36:11',6,'foto_siswa/DHwTgEz2YKLMsn5PmZBj3XhGCFEQ1HygQBmrTnvV.png','Sdn kencana 2','2026-06-07',NULL,NULL),
	(22,'7374887843','28948989384','SISWA TEST 1',2,'9283989389233289','3293299893829323','L','Kristen','O','sdbbfjjehrfiuieuriueifjdf','jsjjdjjshhejrjjerj','bbdsjjhfjhdhajhjfkdsabjbcbasddfdfcx32u3hbhhu39893','002','005','kencana','tanah sareal','12345',5,11,4.0,30,'Antar Jemput Sekolah','bogor','2026-06-14',12,'aktif','2026-06-16 15:26:43','2026-06-16 15:30:22',6,'foto_siswa/E0iBPjOdmnwsZ5VOLkgY0TIBU5Y67jKgWNH3dNYU.png','sdn kencana 2 (NPSN: 38487487847)','2026-06-07',NULL,NULL);

/*!40000 ALTER TABLE `siswas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tagihans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tagihans`;

CREATE TABLE `tagihans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_tagihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal_wajib` decimal(12,2) NOT NULL,
  `tahun_ajaran_id` bigint unsigned DEFAULT NULL,
  `kategori` enum('rutin','sekali_bayar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sekali_bayar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tagihans_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  CONSTRAINT `tagihans_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table tahun_ajarans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tahun_ajarans`;

CREATE TABLE `tahun_ajarans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_mulai` year DEFAULT NULL,
  `tahun_selesai` year DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `tahun_ajarans` WRITE;
/*!40000 ALTER TABLE `tahun_ajarans` DISABLE KEYS */;

INSERT INTO `tahun_ajarans` (`id`, `tahun`, `tahun_mulai`, `tahun_selesai`, `is_active`, `created_at`, `updated_at`)
VALUES
	(6,'2025/2026','2025','2026',1,'2026-05-21 12:54:32','2026-05-21 12:56:07');

/*!40000 ALTER TABLE `tahun_ajarans` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_active`)
VALUES
	(26,'Super Operator','operator@gmail.com',NULL,'$2y$12$SrHBqDt9sLL3PwBQyUe2feLDuzQOASqy5PfpS6wfLXzDnUE5S4tly',NULL,'2026-05-21 12:47:15','2026-05-21 12:47:15',1),
	(27,'Kepala Sekolah','kepsek@sekolah.id',NULL,'$2y$12$1VQcqfCRH7iGRQUtjYPzpu2J/CIjaTmspGC4biepWkgGoM47o6iYi',NULL,'2026-05-21 12:47:15','2026-05-21 12:47:15',1),
	(28,'Ahmad Wawan','wawan@gmail.com',NULL,'$2y$12$SrHBqDt9sLL3PwBQyUe2feLDuzQOASqy5PfpS6wfLXzDnUE5S4tly',NULL,'2026-07-09 20:27:21','2026-07-09 20:27:21',1),
	(29,'Ahmad Fauzi','ahmad@sekolah.id',NULL,'$2y$12$SrHBqDt9sLL3PwBQyUe2feLDuzQOASqy5PfpS6wfLXzDnUE5S4tly',NULL,'2026-07-09 20:27:21','2026-07-09 20:27:21',1),
	(30,'sahal Anwar hadi','sahalanwarhadi25@gmail.com',NULL,'$2y$12$SrHBqDt9sLL3PwBQyUe2feLDuzQOASqy5PfpS6wfLXzDnUE5S4tly',NULL,'2026-07-09 20:27:21','2026-07-09 20:27:21',1);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table wali_kelas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wali_kelas`;

CREATE TABLE `wali_kelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `tahun_ajaran_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wali_kelas_guru_id_foreign` (`guru_id`),
  KEY `wali_kelas_kelas_id_foreign` (`kelas_id`),
  KEY `wali_kelas_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  CONSTRAINT `wali_kelas_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wali_kelas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wali_kelas_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
