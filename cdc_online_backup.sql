-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: cdc_online
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `company_applied`
--

DROP TABLE IF EXISTS `company_applied`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_applied` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f6` int NOT NULL,
  `f7` int NOT NULL,
  `f7a` int NOT NULL,
  `f1001` enum('Tidak','Tidak, tapi saya sedang menunggu hasil lamaran kerja','Ya, saya akan mulai bekerja dalam 2 minggu ke depan','Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1002` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_applied_user_id_foreign` (`user_id`),
  CONSTRAINT `company_applied_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_applied`
--

LOCK TABLES `company_applied` WRITE;
/*!40000 ALTER TABLE `company_applied` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_applied` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competence`
--

DROP TABLE IF EXISTS `competence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competence` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f1761` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1763` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1764` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1765` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1766` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1767` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1768` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1769` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1770` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1771` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1772` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1773` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1774` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `competence_user_id_foreign` (`user_id`),
  CONSTRAINT `competence_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competence`
--

LOCK TABLES `competence` WRITE;
/*!40000 ALTER TABLE `competence` DISABLE KEYS */;
/*!40000 ALTER TABLE `competence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `education` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `strata` enum('D3','D4','S1','S2','S3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_masuk` int DEFAULT NULL,
  `tahun_lulus` int DEFAULT NULL,
  `no_ijasah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perguruan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Polteknik Negeri Jember',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education`
--

LOCK TABLES `education` WRITE;
/*!40000 ALTER TABLE `education` DISABLE KEYS */;
/*!40000 ALTER TABLE `education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folowed`
--

DROP TABLE IF EXISTS `folowed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `folowed` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folowed_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `folowed_user_id_foreign` (`user_id`),
  KEY `folowed_folowed_id_foreign` (`folowed_id`),
  CONSTRAINT `folowed_folowed_id_foreign` FOREIGN KEY (`folowed_id`) REFERENCES `users` (`id`),
  CONSTRAINT `folowed_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folowed`
--

LOCK TABLES `folowed` WRITE;
/*!40000 ALTER TABLE `folowed` DISABLE KEYS */;
/*!40000 ALTER TABLE `folowed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folowers`
--

DROP TABLE IF EXISTS `folowers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `folowers` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folowers_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `folowers_user_id_foreign` (`user_id`),
  KEY `folowers_folowers_id_foreign` (`folowers_id`),
  CONSTRAINT `folowers_folowers_id_foreign` FOREIGN KEY (`folowers_id`) REFERENCES `users` (`id`),
  CONSTRAINT `folowers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folowers`
--

LOCK TABLES `folowers` WRITE;
/*!40000 ALTER TABLE `folowers` DISABLE KEYS */;
/*!40000 ALTER TABLE `folowers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `furthe_study`
--

DROP TABLE IF EXISTS `furthe_study`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `furthe_study` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f18a` enum('Biaya Sendiri','Bea Siswa') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f18b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f18d` timestamp NULL DEFAULT NULL,
  `f1201` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1202` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f14` enum('Sangar Erat','Erat','Cukup Erat','Kurang Erat','Tidak sama sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f15` enum('Setingkat lebih tinggi','Tingkat yang sama','Setingkat lebih rendah','Tidak perlu pendidikan tinggi') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `furthe_study_user_id_foreign` (`user_id`),
  CONSTRAINT `furthe_study_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `furthe_study`
--

LOCK TABLES `furthe_study` WRITE;
/*!40000 ALTER TABLE `furthe_study` DISABLE KEYS */;
/*!40000 ALTER TABLE `furthe_study` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `how_to_find_jobs`
--

DROP TABLE IF EXISTS `how_to_find_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `how_to_find_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f401` tinyint(1) NOT NULL,
  `f402` tinyint(1) NOT NULL,
  `f403` tinyint(1) NOT NULL,
  `f404` tinyint(1) NOT NULL,
  `f405` tinyint(1) NOT NULL,
  `f406` tinyint(1) NOT NULL,
  `f407` tinyint(1) NOT NULL,
  `f408` tinyint(1) NOT NULL,
  `f409` tinyint(1) NOT NULL,
  `f410` tinyint(1) NOT NULL,
  `f411` tinyint(1) NOT NULL,
  `f412` tinyint(1) NOT NULL,
  `f413` tinyint(1) NOT NULL,
  `f414` tinyint(1) NOT NULL,
  `f415` tinyint(1) NOT NULL,
  `f416` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `how_to_find_jobs_user_id_foreign` (`user_id`),
  CONSTRAINT `how_to_find_jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `how_to_find_jobs`
--

LOCK TABLES `how_to_find_jobs` WRITE;
/*!40000 ALTER TABLE `how_to_find_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `how_to_find_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_suitability`
--

DROP TABLE IF EXISTS `job_suitability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_suitability` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f1601` tinyint(1) NOT NULL,
  `f1602` enum('Pekerjaan saya sudah sesuai','Pekerjaan saya sudah sesuai-Saya belum mendapatkan pekerjaan yang lebih sesuai','Saya belum mendapatkan pekerjaan yang lebih sesuai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1603` tinyint(1) NOT NULL,
  `f1604` tinyint(1) NOT NULL,
  `f1605` tinyint(1) NOT NULL,
  `f1606` tinyint(1) NOT NULL,
  `f1607` tinyint(1) NOT NULL,
  `f1608` tinyint(1) NOT NULL,
  `f1609` tinyint(1) NOT NULL,
  `f1610` tinyint(1) NOT NULL,
  `f1611` tinyint(1) NOT NULL,
  `f1612` tinyint(1) NOT NULL,
  `f1613` tinyint(1) NOT NULL,
  `f1614` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_suitability_user_id_foreign` (`user_id`),
  CONSTRAINT `job_suitability_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_suitability`
--

LOCK TABLES `job_suitability` WRITE;
/*!40000 ALTER TABLE `job_suitability` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_suitability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaji` int NOT NULL,
  `jenis_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_masuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_keluar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_saatini` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_user_id_foreign` (`user_id`),
  CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (132,'2014_10_12_000000_create_users_table',1),(133,'2014_10_12_100000_create_password_resets_table',1),(134,'2019_08_19_000000_create_failed_jobs_table',1),(135,'2019_12_14_000001_create_personal_access_tokens_table',1),(136,'2023_09_27_053904_education_tables',1),(137,'2023_09_27_131729_create_folowers',1),(138,'2023_09_27_134311_create_detail_folowers_table',1),(139,'2023_09_29_061610_create_jobs_table',1),(140,'2023_10_01_093136_create_folowed_table',1),(141,'2023_10_01_124032_create_quis_identitas_prodi_table',1),(142,'2023_10_01_133833_create_quis_identitas_table',1),(143,'2023_10_02_103316_create_regency_table',1),(144,'2023_10_02_104144_create_province_table',1),(145,'2023_10_02_113748_create_quis_main_table',1),(146,'2023_10_03_194042_create_furthe_study_table',1),(147,'2023_10_04_043435_create_competence_table',1),(148,'2023_10_04_043957_create_study_method_table',1),(149,'2023_10_04_044601_create_how_to_find_jobs_table',1),(150,'2023_10_04_045001_create_company_applied_table',1),(151,'2023_10_04_045239_create_job_suitability_table',1),(152,'2023_10_04_050208_create_start_search_jobs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `province` (
  `id` int NOT NULL,
  `province_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quis_identitas`
--

DROP TABLE IF EXISTS `quis_identitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quis_identitas` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kdptimsmh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '005019',
  `kdpstmsmh` int NOT NULL,
  `nimhsmsmh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nmmhsmsmh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telpomsmh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailmsmh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_lulus` int NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quis_identitas_kdpstmsmh_foreign` (`kdpstmsmh`),
  KEY `quis_identitas_user_id_foreign` (`user_id`),
  CONSTRAINT `quis_identitas_kdpstmsmh_foreign` FOREIGN KEY (`kdpstmsmh`) REFERENCES `quis_identitas_prodi` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quis_identitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quis_identitas`
--

LOCK TABLES `quis_identitas` WRITE;
/*!40000 ALTER TABLE `quis_identitas` DISABLE KEYS */;
/*!40000 ALTER TABLE `quis_identitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quis_identitas_prodi`
--

DROP TABLE IF EXISTS `quis_identitas_prodi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quis_identitas_prodi` (
  `id` int NOT NULL,
  `nama_prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quis_identitas_prodi`
--

LOCK TABLES `quis_identitas_prodi` WRITE;
/*!40000 ALTER TABLE `quis_identitas_prodi` DISABLE KEYS */;
/*!40000 ALTER TABLE `quis_identitas_prodi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quis_main`
--

DROP TABLE IF EXISTS `quis_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quis_main` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f8` enum('Bekerja (full time/part time)','Belum memungkinkan bekerja','Wiraswasta','Melanjutkan Pendidikan','Tidak kerja tetapi sedang mencari kerja') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f504` tinyint(1) NOT NULL,
  `f502` int NOT NULL,
  `f505` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f5a1` int NOT NULL,
  `f5a2` int NOT NULL,
  `f506` int NOT NULL,
  `f1101` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f5b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f5c` enum('Founder','Co-Founder','Staff','Freelance/Kerja Lepas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f5d` enum('Lokal/wilayah/wiraswasta tidak berbadan hukum','Nasional/wiraswasta berbadan hukum','Multinasional/Internasional') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quis_main_f5a1_foreign` (`f5a1`),
  KEY `quis_main_f5a2_foreign` (`f5a2`),
  KEY `quis_main_user_id_foreign` (`user_id`),
  CONSTRAINT `quis_main_f5a1_foreign` FOREIGN KEY (`f5a1`) REFERENCES `province` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `quis_main_f5a2_foreign` FOREIGN KEY (`f5a2`) REFERENCES `regency` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `quis_main_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quis_main`
--

LOCK TABLES `quis_main` WRITE;
/*!40000 ALTER TABLE `quis_main` DISABLE KEYS */;
/*!40000 ALTER TABLE `quis_main` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regency`
--

DROP TABLE IF EXISTS `regency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `regency` (
  `id` int NOT NULL,
  `regency_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regency`
--

LOCK TABLES `regency` WRITE;
/*!40000 ALTER TABLE `regency` DISABLE KEYS */;
/*!40000 ALTER TABLE `regency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `start_search_jobs`
--

DROP TABLE IF EXISTS `start_search_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `start_search_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f301` enum('Saya mencari kerja sebelum lulus','Saya mencari kerja sesudah wisuda','Saya tidak mencari kerja') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f302` int NOT NULL,
  `f303` int NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: cdc_online
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `company_applied`
--

DROP TABLE IF EXISTS `company_applied`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_applied` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f6` int NOT NULL,
  `f7` int NOT NULL,
  `f7a` int NOT NULL,
  `f1001` enum('Tidak','Tidak, tapi saya sedang menunggu hasil lamaran kerja','Ya, saya akan mulai bekerja dalam 2 minggu ke depan','Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1002` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_applied_user_id_foreign` (`user_id`),
  CONSTRAINT `company_applied_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_applied`
--

LOCK TABLES `company_applied` WRITE;
/*!40000 ALTER TABLE `company_applied` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_applied` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competence`
--

DROP TABLE IF EXISTS `competence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competence` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f1761` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1763` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1764` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1765` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1766` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1767` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1768` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1769` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1770` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1771` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1772` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1773` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1774` enum('Sangat Rendah','Rendah','Netral','Tinggi','Sangat Tinggi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `competence_user_id_foreign` (`user_id`),
  CONSTRAINT `competence_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competence`
--

LOCK TABLES `competence` WRITE;
/*!40000 ALTER TABLE `competence` DISABLE KEYS */;
/*!40000 ALTER TABLE `competence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `education` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `strata` enum('D3','D4','S1','S2','S3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_masuk` int DEFAULT NULL,
  `tahun_lulus` int DEFAULT NULL,
  `no_ijasah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perguruan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Polteknik Negeri Jember',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education`
--

LOCK TABLES `education` WRITE;
/*!40000 ALTER TABLE `education` DISABLE KEYS */;
/*!40000 ALTER TABLE `education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folowed`
--

DROP TABLE IF EXISTS `folowed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `folowed` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folowed_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `folowed_user_id_foreign` (`user_id`),
  KEY `folowed_folowed_id_foreign` (`folowed_id`),
  CONSTRAINT `folowed_folowed_id_foreign` FOREIGN KEY (`folowed_id`) REFERENCES `users` (`id`),
  CONSTRAINT `folowed_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folowed`
--

LOCK TABLES `folowed` WRITE;
/*!40000 ALTER TABLE `folowed` DISABLE KEYS */;
/*!40000 ALTER TABLE `folowed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folowers`
--

DROP TABLE IF EXISTS `folowers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `folowers` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folowers_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `folowers_user_id_foreign` (`user_id`),
  KEY `folowers_folowers_id_foreign` (`folowers_id`),
  CONSTRAINT `folowers_folowers_id_foreign` FOREIGN KEY (`folowers_id`) REFERENCES `users` (`id`),
  CONSTRAINT `folowers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folowers`
--

LOCK TABLES `folowers` WRITE;
/*!40000 ALTER TABLE `folowers` DISABLE KEYS */;
/*!40000 ALTER TABLE `folowers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `furthe_study`
--

DROP TABLE IF EXISTS `furthe_study`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `furthe_study` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f18a` enum('Biaya Sendiri','Bea Siswa') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f18b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f18d` timestamp NULL DEFAULT NULL,
  `f1201` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1202` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f14` enum('Sangar Erat','Erat','Cukup Erat','Kurang Erat','Tidak sama sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f15` enum('Setingkat lebih tinggi','Tingkat yang sama','Setingkat lebih rendah','Tidak perlu pendidikan tinggi') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `furthe_study_user_id_foreign` (`user_id`),
  CONSTRAINT `furthe_study_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `furthe_study`
--

LOCK TABLES `furthe_study` WRITE;
/*!40000 ALTER TABLE `furthe_study` DISABLE KEYS */;
/*!40000 ALTER TABLE `furthe_study` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `how_to_find_jobs`
--

DROP TABLE IF EXISTS `how_to_find_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `how_to_find_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f401` tinyint(1) NOT NULL,
  `f402` tinyint(1) NOT NULL,
  `f403` tinyint(1) NOT NULL,
  `f404` tinyint(1) NOT NULL,
  `f405` tinyint(1) NOT NULL,
  `f406` tinyint(1) NOT NULL,
  `f407` tinyint(1) NOT NULL,
  `f408` tinyint(1) NOT NULL,
  `f409` tinyint(1) NOT NULL,
  `f410` tinyint(1) NOT NULL,
  `f411` tinyint(1) NOT NULL,
  `f412` tinyint(1) NOT NULL,
  `f413` tinyint(1) NOT NULL,
  `f414` tinyint(1) NOT NULL,
  `f415` tinyint(1) NOT NULL,
  `f416` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `how_to_find_jobs_user_id_foreign` (`user_id`),
  CONSTRAINT `how_to_find_jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `how_to_find_jobs`
--

LOCK TABLES `how_to_find_jobs` WRITE;
/*!40000 ALTER TABLE `how_to_find_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `how_to_find_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_suitability`
--

DROP TABLE IF EXISTS `job_suitability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_suitability` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f1601` tinyint(1) NOT NULL,
  `f1602` enum('Pekerjaan saya sudah sesuai','Pekerjaan saya sudah sesuai-Saya belum mendapatkan pekerjaan yang lebih sesuai','Saya belum mendapatkan pekerjaan yang lebih sesuai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f1603` tinyint(1) NOT NULL,
  `f1604` tinyint(1) NOT NULL,
  `f1605` tinyint(1) NOT NULL,
  `f1606` tinyint(1) NOT NULL,
  `f1607` tinyint(1) NOT NULL,
  `f1608` tinyint(1) NOT NULL,
  `f1609` tinyint(1) NOT NULL,
  `f1610` tinyint(1) NOT NULL,
  `f1611` tinyint(1) NOT NULL,
  `f1612` tinyint(1) NOT NULL,
  `f1613` tinyint(1) NOT NULL,
  `f1614` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_suitability_user_id_foreign` (`user_id`),
  CONSTRAINT `job_suitability_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_suitability`
--

LOCK TABLES `job_suitability` WRITE;
/*!40000 ALTER TABLE `job_suitability` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_suitability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaji` int NOT NULL,
  `jenis_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_masuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_keluar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_saatini` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_user_id_foreign` (`user_id`),
  CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (132,'2014_10_12_000000_create_users_table',1),(133,'2014_10_12_100000_create_password_resets_table',1),(134,'2019_08_19_000000_create_failed_jobs_table',1),(135,'2019_12_14_000001_create_personal_access_tokens_table',1),(136,'2023_09_27_053904_education_tables',1),(137,'2023_09_27_131729_create_folowers',1),(138,'2023_09_27_134311_create_detail_folowers_table',1),(139,'2023_09_29_061610_create_jobs_table',1),(140,'2023_10_01_093136_create_folowed_table',1),(141,'2023_10_01_124032_create_quis_identitas_prodi_table',1),(142,'2023_10_01_133833_create_quis_identitas_table',1),(143,'2023_10_02_103316_create_regency_table',1),(144,'2023_10_02_104144_create_province_table',1),(145,'2023_10_02_113748_create_quis_main_table',1),(146,'2023_10_03_194042_create_furthe_study_table',1),(147,'2023_10_04_043435_create_competence_table',1),(148,'2023_10_04_043957_create_study_method_table',1),(149,'2023_10_04_044601_create_how_to_find_jobs_table',1),(150,'2023_10_04_045001_create_company_applied_table',1),(151,'2023_10_04_045239_create_job_suitability_table',1),(152,'2023_10_04_050208_create_start_search_jobs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `province` (
  `id` int NOT NULL,
  `province_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quis_identitas`
--

DROP TABLE IF EXISTS `quis_identitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quis_identitas` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kdptimsmh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '005019',
  `kdpstmsmh` int NOT NULL,
  `nimhsmsmh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nmmhsmsmh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telpomsmh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailmsmh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_lulus` int NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quis_identitas_kdpstmsmh_foreign` (`kdpstmsmh`),
  KEY `quis_identitas_user_id_foreign` (`user_id`),
  CONSTRAINT `quis_identitas_kdpstmsmh_foreign` FOREIGN KEY (`kdpstmsmh`) REFERENCES `quis_identitas_prodi` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quis_identitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quis_identitas`
--

LOCK TABLES `quis_identitas` WRITE;
/*!40000 ALTER TABLE `quis_identitas` DISABLE KEYS */;
/*!40000 ALTER TABLE `quis_identitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quis_identitas_prodi`
--

DROP TABLE IF EXISTS `quis_identitas_prodi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quis_identitas_prodi` (
  `id` int NOT NULL,
  `nama_prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quis_identitas_prodi`
--

LOCK TABLES `quis_identitas_prodi` WRITE;
/*!40000 ALTER TABLE `quis_identitas_prodi` DISABLE KEYS */;
/*!40000 ALTER TABLE `quis_identitas_prodi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quis_main`
--

DROP TABLE IF EXISTS `quis_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quis_main` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f8` enum('Bekerja (full time/part time)','Belum memungkinkan bekerja','Wiraswasta','Melanjutkan Pendidikan','Tidak kerja tetapi sedang mencari kerja') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f504` tinyint(1) NOT NULL,
  `f502` int NOT NULL,
  `f505` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f5a1` int NOT NULL,
  `f5a2` int NOT NULL,
  `f506` int NOT NULL,
  `f1101` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f5b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f5c` enum('Founder','Co-Founder','Staff','Freelance/Kerja Lepas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f5d` enum('Lokal/wilayah/wiraswasta tidak berbadan hukum','Nasional/wiraswasta berbadan hukum','Multinasional/Internasional') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quis_main_f5a1_foreign` (`f5a1`),
  KEY `quis_main_f5a2_foreign` (`f5a2`),
  KEY `quis_main_user_id_foreign` (`user_id`),
  CONSTRAINT `quis_main_f5a1_foreign` FOREIGN KEY (`f5a1`) REFERENCES `province` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `quis_main_f5a2_foreign` FOREIGN KEY (`f5a2`) REFERENCES `regency` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `quis_main_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quis_main`
--

LOCK TABLES `quis_main` WRITE;
/*!40000 ALTER TABLE `quis_main` DISABLE KEYS */;
/*!40000 ALTER TABLE `quis_main` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regency`
--

DROP TABLE IF EXISTS `regency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `regency` (
  `id` int NOT NULL,
  `regency_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regency`
--

LOCK TABLES `regency` WRITE;
/*!40000 ALTER TABLE `regency` DISABLE KEYS */;
/*!40000 ALTER TABLE `regency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `start_search_jobs`
--

DROP TABLE IF EXISTS `start_search_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `start_search_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f301` enum('Saya mencari kerja sebelum lulus','Saya mencari kerja sesudah wisuda','Saya tidak mencari kerja') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f302` int NOT NULL,
  `f303` int NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `start_search_jobs_user_id_foreign` (`user_id`),
  CONSTRAINT `start_search_jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `start_search_jobs`
--

LOCK TABLES `start_search_jobs` WRITE;
/*!40000 ALTER TABLE `start_search_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `start_search_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `study_method`
--

DROP TABLE IF EXISTS `study_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `study_method` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f21` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f22` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f23` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f24` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f25` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f26` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f27` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `study_method_user_id_foreign` (`user_id`),
  CONSTRAINT `study_method_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `study_method`
--

LOCK TABLES `study_method` WRITE;
/*!40000 ALTER TABLE `study_method` DISABLE KEYS */;
/*!40000 ALTER TABLE `study_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttl` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('female','male') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visible_alamat` tinyint(1) NOT NULL DEFAULT '1',
  `visible_email` tinyint(1) NOT NULL DEFAULT '1',
  `visible_fullname` tinyint(1) NOT NULL DEFAULT '1',
  `visible_ttl` tinyint(1) NOT NULL DEFAULT '1',
  `visible_nik` tinyint(1) NOT NULL DEFAULT '0',
  `visible_no_telp` tinyint(1) NOT NULL DEFAULT '0',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twiter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_expire` timestamp NULL DEFAULT NULL,
  `level` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_status` enum('noob','beginner','intermediate','star') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noob',
  `email_verivied` tinyint(1) NOT NULL DEFAULT '0',
  `expire_email` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_nik_unique` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-04  5:08:27
,
  PRIMARY KEY (`id`),
  KEY `start_search_jobs_user_id_foreign` (`user_id`),
  CONSTRAINT `start_search_jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `start_search_jobs`
--

LOCK TABLES `start_search_jobs` WRITE;
/*!40000 ALTER TABLE `start_search_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `start_search_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `study_method`
--

DROP TABLE IF EXISTS `study_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `study_method` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `f21` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f22` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f23` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f24` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f25` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f26` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f27` enum('Sangat Besar','Besar','Cukup Besar','Kurang','Tidak Sama Sekali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `study_method_user_id_foreign` (`user_id`),
  CONSTRAINT `study_method_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `study_method`
--

LOCK TABLES `study_method` WRITE;
/*!40000 ALTER TABLE `study_method` DISABLE KEYS */;
/*!40000 ALTER TABLE `study_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttl` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('female','male') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visible_alamat` tinyint(1) NOT NULL DEFAULT '1',
  `visible_email` tinyint(1) NOT NULL DEFAULT '1',
  `visible_fullname` tinyint(1) NOT NULL DEFAULT '1',
  `visible_ttl` tinyint(1) NOT NULL DEFAULT '1',
  `visible_nik` tinyint(1) NOT NULL DEFAULT '0',
  `visible_no_telp` tinyint(1) NOT NULL DEFAULT '0',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twiter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_expire` timestamp NULL DEFAULT NULL,
  `level` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_status` enum('noob','beginner','intermediate','star') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noob',
  `email_verivied` tinyint(1) NOT NULL DEFAULT '0',
  `expire_email` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_nik_unique` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-04  5:08:27
