# ************************************************************
# Sequel Ace SQL dump
# Version 20096
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 9.6.0)
# Database: minurulhuda3
# Generation Time: 2026-07-10 16:01:07 +0000
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
  KEY `absensis_siswa_id_foreign` (`siswa_id`),
  KEY `absensis_guru_id_foreign` (`guru_id`),
  KEY `absensis_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  KEY `absensis_kelas_id_foreign` (`kelas_id`),
  KEY `absensis_created_by_foreign` (`created_by`),
  KEY `absensis_updated_by_foreign` (`updated_by`),
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
  `nominal` int DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `beasiswas_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `beasiswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



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
  `mapel` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_mengajar` smallint unsigned DEFAULT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwals_kelas_id_foreign` (`kelas_id`),
  KEY `jadwals_guru_id_foreign` (`guru_id`),
  KEY `jadwals_mapel_id_foreign` (`mapel_id`),
  CONSTRAINT `jadwals_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwals_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwals_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapels` (`id`) ON DELETE CASCADE
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
  `wali_kelas_id` bigint unsigned DEFAULT NULL,
  `kapasitas` int NOT NULL DEFAULT '32',
  `parent_meeting_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun_ajaran_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kelas_wali_kelas_id_index` (`wali_kelas_id`),
  KEY `kelas_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  CONSTRAINT `kelas_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



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
	(104,'2026_06_16_131005_add_mutasi_masuk_to_mutasi_siswas_table',2),
	(105,'2026_06_16_151600_add_rapor_sekolah_asal_to_berkas_siswas',2),
	(106,'2026_07_10_084651_add_wali_kelas_id_to_kelas_table',2),
	(107,'2026_07_10_102731_add_excel_fields_to_siswa_tables',2),
	(108,'2026_07_10_141459_add_soft_deletes_to_tahun_ajaran_module',2),
	(109,'2026_07_10_160005_create_personal_access_tokens_table',3);

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
  CONSTRAINT `nilais_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nilais_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nilais_komponen_penilaian_id_foreign` FOREIGN KEY (`komponen_penilaian_id`) REFERENCES `komponen_penilaians` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nilais_plot_guru_mapel_id_foreign` FOREIGN KEY (`plot_guru_mapel_id`) REFERENCES `plot_guru_mapels` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nilais_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nilais_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nilais_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
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
  `status_ayah` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kewarganegaraan_ayah` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir_ayah` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_ayah` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_ibu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kewarganegaraan_ibu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir_ibu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_ibu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_wali` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kewarganegaraan_wali` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir_wali` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orang_tuas_user_id_foreign` (`user_id`),
  CONSTRAINT `orang_tuas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



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



# Dump of table personal_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`)
VALUES
	(1,'App\\Models\\User',6,'auth_token','b94120e91b468fbbf854016e927c000176d39ce1c1e746ad699e13687e5f2988','[\"*\"]','2026-07-10 16:00:39',NULL,'2026-07-10 16:00:25','2026-07-10 16:00:39');

/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
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
  KEY `plot_guru_mapels_guru_id_foreign` (`guru_id`),
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
	(6,6,9),
	(7,7,6),
	(8,8,7),
	(9,9,8),
	(10,10,10),
	(11,11,11),
	(12,12,12);

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
	(6,'kepsek','2026-07-10 15:59:19','2026-07-10 15:59:19'),
	(7,'guru','2026-07-10 15:59:19','2026-07-10 15:59:19'),
	(8,'wali_kelas','2026-07-10 15:59:19','2026-07-10 15:59:19'),
	(9,'operator','2026-07-10 15:59:19','2026-07-10 15:59:19'),
	(10,'bendahara','2026-07-10 15:59:19','2026-07-10 15:59:19'),
	(11,'ortu','2026-07-10 15:59:19','2026-07-10 15:59:19'),
	(12,'admin_ppdb','2026-07-10 15:59:19','2026-07-10 15:59:19');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `semesters_tahun_ajaran_id_nama_unique` (`tahun_ajaran_id`,`nama`),
  CONSTRAINT `semesters_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



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
  `nama_kepala_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pembiaya_sekolah` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imunisasi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `kelas_pararel` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_absen` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  CONSTRAINT `siswas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  CONSTRAINT `siswas_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `siswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



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
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



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
	(6,'Operator Madrasah','operator@gmail.com',NULL,'$2y$12$TwD3FnZANuYCLSTHLui7zOrUKxUDZvzGznMpC4ps/n8UMgs8yjMsW',NULL,'2026-07-10 15:59:19','2026-07-10 15:59:19',1),
	(7,'Kepala Madrasah','kepsek@gmail.com',NULL,'$2y$12$rYNKreO8spz75fo6kNRv1Ob7iHgnj161/x5wcRd/7anWBSa6ZErAW',NULL,'2026-07-10 15:59:19','2026-07-10 15:59:19',1),
	(8,'Guru Pengajar','guru@gmail.com',NULL,'$2y$12$aRH1bmcIHPQ.iJEtbz.f8eJtOaEcGDvGBYRmfnDfHQAXvX1lJATiS',NULL,'2026-07-10 15:59:20','2026-07-10 15:59:20',1),
	(9,'Wali Kelas 1','walikelas@gmail.com',NULL,'$2y$12$V4nKenB/2tMpJDU9s6Bl5.nVS29er7mHxYUHvYLc/AtadNb8/i.9a',NULL,'2026-07-10 15:59:20','2026-07-10 15:59:20',1),
	(10,'Bendahara Madrasah','bendahara@gmail.com',NULL,'$2y$12$8O7.wZvJH61wtw3efKX2VOHvKRZQOC6GLJIsDZpIBTQoomH.9l3uq',NULL,'2026-07-10 15:59:20','2026-07-10 15:59:20',1),
	(11,'Orang Tua Siswa','ortu@gmail.com',NULL,'$2y$12$7VMzAjfg6aHjQxETz.l2l.7wn6hW9GDEaQHQoNa1kjZ6Ae6K/gk.G',NULL,'2026-07-10 15:59:20','2026-07-10 15:59:20',1),
	(12,'Admin PPDB','admin_ppdb@gmail.com',NULL,'$2y$12$UR3fA7iqxkk5zPw3vx6ApO5bAoELr7selTOeVIOGGIB9i4D1.m0AW',NULL,'2026-07-10 15:59:20','2026-07-10 15:59:20',1);

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
