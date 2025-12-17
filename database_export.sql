-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: audit_kig
-- ------------------------------------------------------
-- Server version	8.0.44

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
-- Table structure for table `audit_answers`
--

DROP TABLE IF EXISTS `audit_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `audit_question_id` bigint unsigned NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci COMMENT 'Jawaban dari auditee',
  `answered_by` bigint unsigned NOT NULL,
  `answer_status` enum('draft','submitted','revision','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft' COMMENT 'Status jawaban',
  `revision_notes` text COLLATE utf8mb4_unicode_ci COMMENT 'Catatan revisi dari auditor',
  `reviewed_by` bigint unsigned DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu submit jawaban',
  `reviewed_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu review',
  `revision_count` int NOT NULL DEFAULT '0' COMMENT 'Jumlah revisi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_answers_answered_by_foreign` (`answered_by`),
  KEY `audit_answers_reviewed_by_foreign` (`reviewed_by`),
  KEY `audit_answers_audit_question_id_answer_status_index` (`audit_question_id`,`answer_status`),
  CONSTRAINT `audit_answers_answered_by_foreign` FOREIGN KEY (`answered_by`) REFERENCES `users` (`id`),
  CONSTRAINT `audit_answers_audit_question_id_foreign` FOREIGN KEY (`audit_question_id`) REFERENCES `audit_questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `audit_answers_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_answers`
--

LOCK TABLES `audit_answers` WRITE;
/*!40000 ALTER TABLE `audit_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_comments`
--

DROP TABLE IF EXISTS `audit_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `audit_question_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Isi komentar',
  `comment_type` enum('question','feedback','revision','general') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general' COMMENT 'Tipe komentar',
  `is_internal` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Komentar internal auditor (tidak terlihat auditee)',
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Status sudah dibaca',
  `read_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu dibaca',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_comments_user_id_foreign` (`user_id`),
  KEY `audit_comments_audit_question_id_created_at_index` (`audit_question_id`,`created_at`),
  KEY `audit_comments_parent_id_index` (`parent_id`),
  CONSTRAINT `audit_comments_audit_question_id_foreign` FOREIGN KEY (`audit_question_id`) REFERENCES `audit_questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `audit_comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `audit_comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `audit_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_comments`
--

LOCK TABLES `audit_comments` WRITE;
/*!40000 ALTER TABLE `audit_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_documents`
--

DROP TABLE IF EXISTS `audit_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `audit_question_id` bigint unsigned NOT NULL,
  `audit_answer_id` bigint unsigned DEFAULT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama dokumen',
  `document_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Path file dokumen',
  `document_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tipe file (pdf, xlsx, docx, dll)',
  `file_size` int NOT NULL COMMENT 'Ukuran file dalam bytes',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi dokumen',
  `uploaded_by` bigint unsigned NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'Status dokumen',
  `reviewed_by` bigint unsigned DEFAULT NULL,
  `review_notes` text COLLATE utf8mb4_unicode_ci COMMENT 'Catatan review',
  `reviewed_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu review',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_documents_audit_answer_id_foreign` (`audit_answer_id`),
  KEY `audit_documents_uploaded_by_foreign` (`uploaded_by`),
  KEY `audit_documents_reviewed_by_foreign` (`reviewed_by`),
  KEY `audit_documents_audit_question_id_status_index` (`audit_question_id`,`status`),
  CONSTRAINT `audit_documents_audit_answer_id_foreign` FOREIGN KEY (`audit_answer_id`) REFERENCES `audit_answers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `audit_documents_audit_question_id_foreign` FOREIGN KEY (`audit_question_id`) REFERENCES `audit_questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `audit_documents_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `audit_documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_documents`
--

LOCK TABLES `audit_documents` WRITE;
/*!40000 ALTER TABLE `audit_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_program_documents`
--

DROP TABLE IF EXISTS `audit_program_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_program_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `audit_program_id` bigint unsigned NOT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama dokumen yang dibutuhkan',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi dokumen',
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Path file dokumen',
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nama file asli',
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tipe file (pdf, docx, xlsx, dll)',
  `file_size` int DEFAULT NULL COMMENT 'Ukuran file dalam bytes',
  `status` enum('required','uploaded','reviewed','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'required' COMMENT 'Status dokumen',
  `is_mandatory` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Apakah dokumen wajib',
  `uploaded_by` bigint unsigned DEFAULT NULL,
  `uploaded_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu upload',
  `reviewed_by` bigint unsigned DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu review',
  `review_notes` text COLLATE utf8mb4_unicode_ci COMMENT 'Catatan review',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_program_documents_uploaded_by_foreign` (`uploaded_by`),
  KEY `audit_program_documents_reviewed_by_foreign` (`reviewed_by`),
  KEY `audit_program_documents_status_index` (`status`),
  KEY `audit_program_documents_audit_program_id_index` (`audit_program_id`),
  CONSTRAINT `audit_program_documents_audit_program_id_foreign` FOREIGN KEY (`audit_program_id`) REFERENCES `audit_programs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `audit_program_documents_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`),
  CONSTRAINT `audit_program_documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_program_documents`
--

LOCK TABLES `audit_program_documents` WRITE;
/*!40000 ALTER TABLE `audit_program_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_program_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_programs`
--

DROP TABLE IF EXISTS `audit_programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_programs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `audit_timeline_id` bigint unsigned NOT NULL,
  `program_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Kode program audit',
  `program_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama program audit',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi program',
  `audit_objective` text COLLATE utf8mb4_unicode_ci COMMENT 'Tujuan audit',
  `status` enum('draft','active','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft' COMMENT 'Status program',
  `created_by` bigint unsigned NOT NULL,
  `team_leader_id` bigint unsigned DEFAULT NULL,
  `team_members` json DEFAULT NULL COMMENT 'Anggota tim auditor (array user IDs)',
  `risks` json DEFAULT NULL COMMENT 'Array of risks: [{name, level}]',
  `assurance_scope` text COLLATE utf8mb4_unicode_ci COMMENT 'Untuk memastikan (scope assurance)',
  `start_date` date DEFAULT NULL COMMENT 'Tanggal mulai program',
  `end_date` date DEFAULT NULL COMMENT 'Tanggal selesai program',
  `total_questions` int NOT NULL DEFAULT '0' COMMENT 'Total pertanyaan',
  `answered_questions` int NOT NULL DEFAULT '0' COMMENT 'Pertanyaan terjawab',
  `closed_questions` int NOT NULL DEFAULT '0' COMMENT 'Pertanyaan closed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `audit_programs_program_code_unique` (`program_code`),
  KEY `audit_programs_audit_timeline_id_foreign` (`audit_timeline_id`),
  KEY `audit_programs_created_by_foreign` (`created_by`),
  KEY `audit_programs_status_index` (`status`),
  KEY `audit_programs_team_leader_id_index` (`team_leader_id`),
  CONSTRAINT `audit_programs_audit_timeline_id_foreign` FOREIGN KEY (`audit_timeline_id`) REFERENCES `audit_timelines` (`id`) ON DELETE CASCADE,
  CONSTRAINT `audit_programs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `audit_programs_team_leader_id_foreign` FOREIGN KEY (`team_leader_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_programs`
--

LOCK TABLES `audit_programs` WRITE;
/*!40000 ALTER TABLE `audit_programs` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_questions`
--

DROP TABLE IF EXISTS `audit_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `audit_program_id` bigint unsigned NOT NULL,
  `order_number` int NOT NULL COMMENT 'Nomor urut pertanyaan',
  `question_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Kode pertanyaan',
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Pertanyaan audit',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi/penjelasan pertanyaan',
  `question_type` enum('text','file','both') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'both' COMMENT 'Tipe jawaban yang dibutuhkan',
  `status` enum('open','in_progress','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open' COMMENT 'Status pertanyaan',
  `is_required` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Wajib dijawab',
  `requires_document` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Memerlukan dokumen',
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tipe dokumen yang dibutuhkan',
  `assigned_to` bigint unsigned DEFAULT NULL,
  `answered_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu dijawab',
  `closed_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu closed',
  `closed_by` bigint unsigned DEFAULT NULL,
  `closure_notes` text COLLATE utf8mb4_unicode_ci COMMENT 'Catatan penutupan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_questions_assigned_to_foreign` (`assigned_to`),
  KEY `audit_questions_closed_by_foreign` (`closed_by`),
  KEY `audit_questions_audit_program_id_status_index` (`audit_program_id`,`status`),
  KEY `audit_questions_order_number_index` (`order_number`),
  CONSTRAINT `audit_questions_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `audit_questions_audit_program_id_foreign` FOREIGN KEY (`audit_program_id`) REFERENCES `audit_programs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `audit_questions_closed_by_foreign` FOREIGN KEY (`closed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_questions`
--

LOCK TABLES `audit_questions` WRITE;
/*!40000 ALTER TABLE `audit_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_reports`
--

DROP TABLE IF EXISTS `audit_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `audit_program_id` bigint unsigned NOT NULL,
  `report_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nomor laporan',
  `report_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Judul laporan',
  `report_date` date NOT NULL COMMENT 'Tanggal laporan',
  `executive_summary` text COLLATE utf8mb4_unicode_ci COMMENT 'Ringkasan eksekutif',
  `audit_scope` text COLLATE utf8mb4_unicode_ci COMMENT 'Ruang lingkup audit',
  `audit_methodology` text COLLATE utf8mb4_unicode_ci COMMENT 'Metodologi audit',
  `findings` text COLLATE utf8mb4_unicode_ci COMMENT 'Temuan audit (JSON)',
  `recommendations` text COLLATE utf8mb4_unicode_ci COMMENT 'Rekomendasi',
  `conclusion` text COLLATE utf8mb4_unicode_ci COMMENT 'Kesimpulan',
  `status` enum('draft','review','approved','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft' COMMENT 'Status laporan',
  `prepared_by` bigint unsigned NOT NULL,
  `reviewed_by` bigint unsigned DEFAULT NULL,
  `approved_by` bigint unsigned DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu review',
  `approved_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu approve',
  `published_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu publish',
  `pdf_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Path file PDF laporan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `audit_reports_report_number_unique` (`report_number`),
  KEY `audit_reports_audit_program_id_foreign` (`audit_program_id`),
  KEY `audit_reports_prepared_by_foreign` (`prepared_by`),
  KEY `audit_reports_reviewed_by_foreign` (`reviewed_by`),
  KEY `audit_reports_approved_by_foreign` (`approved_by`),
  KEY `audit_reports_status_index` (`status`),
  KEY `audit_reports_report_date_index` (`report_date`),
  CONSTRAINT `audit_reports_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `audit_reports_audit_program_id_foreign` FOREIGN KEY (`audit_program_id`) REFERENCES `audit_programs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `audit_reports_prepared_by_foreign` FOREIGN KEY (`prepared_by`) REFERENCES `users` (`id`),
  CONSTRAINT `audit_reports_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_reports`
--

LOCK TABLES `audit_reports` WRITE;
/*!40000 ALTER TABLE `audit_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_timelines`
--

DROP TABLE IF EXISTS `audit_timelines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_timelines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `audit_year` year NOT NULL COMMENT 'Tahun audit',
  `department_id` bigint unsigned NOT NULL,
  `start_date` date NOT NULL COMMENT 'Tanggal mulai audit',
  `end_date` date NOT NULL COMMENT 'Tanggal selesai audit',
  `actual_start_date` date DEFAULT NULL COMMENT 'Tanggal realisasi mulai audit',
  `actual_end_date` date DEFAULT NULL COMMENT 'Tanggal realisasi selesai audit',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Status aktif (departemen dapat jadwal audit)',
  `status` enum('scheduled','ongoing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'scheduled' COMMENT 'Status timeline',
  `created_by` bigint unsigned NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci COMMENT 'Catatan tambahan',
  `email_sent` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Status email notifikasi sudah dikirim',
  `email_sent_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu email dikirim',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_timelines_department_id_foreign` (`department_id`),
  KEY `audit_timelines_created_by_foreign` (`created_by`),
  KEY `audit_timelines_audit_year_department_id_index` (`audit_year`,`department_id`),
  KEY `audit_timelines_status_index` (`status`),
  CONSTRAINT `audit_timelines_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `audit_timelines_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_timelines`
--

LOCK TABLES `audit_timelines` WRITE;
/*!40000 ALTER TABLE `audit_timelines` DISABLE KEYS */;
INSERT INTO `audit_timelines` VALUES (17,2025,1,'2025-02-12','2025-12-20',NULL,NULL,1,'scheduled',1,NULL,0,NULL,'2025-12-12 06:33:03','2025-12-12 07:21:47',NULL),(18,2025,3,'2025-12-13','2025-12-21',NULL,NULL,1,'scheduled',1,NULL,0,NULL,'2025-12-12 06:33:03','2025-12-12 06:33:03',NULL),(19,2025,8,'2025-12-15','2025-12-23',NULL,NULL,1,'scheduled',1,NULL,0,NULL,'2025-12-12 06:33:03','2025-12-12 06:33:03',NULL),(20,2025,5,'2025-12-16','2025-12-24',NULL,NULL,1,'scheduled',1,NULL,0,NULL,'2025-12-12 06:33:03','2025-12-12 06:33:03',NULL),(21,2025,6,'2025-12-18','2025-12-26',NULL,NULL,1,'scheduled',1,NULL,0,NULL,'2025-12-12 06:33:03','2025-12-12 06:33:03',NULL),(22,2025,7,'2025-12-19','2025-12-27',NULL,NULL,1,'scheduled',1,NULL,0,NULL,'2025-12-12 06:33:03','2025-12-12 06:33:03',NULL);
/*!40000 ALTER TABLE `audit_timelines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_years`
--

DROP TABLE IF EXISTS `audit_years`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_years` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `year` int NOT NULL COMMENT 'Tahun audit',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi tahun audit',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Status aktif',
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `audit_years_year_unique` (`year`),
  KEY `audit_years_created_by_foreign` (`created_by`),
  KEY `audit_years_year_index` (`year`),
  KEY `audit_years_is_active_index` (`is_active`),
  CONSTRAINT `audit_years_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_years`
--

LOCK TABLES `audit_years` WRITE;
/*!40000 ALTER TABLE `audit_years` DISABLE KEYS */;
INSERT INTO `audit_years` VALUES (1,2025,NULL,1,1,'2025-12-12 02:31:41','2025-12-12 02:31:41'),(2,2026,NULL,1,1,'2025-12-12 02:42:18','2025-12-12 02:42:18'),(3,2027,NULL,1,1,'2025-12-12 02:42:25','2025-12-12 02:42:25');
/*!40000 ALTER TABLE `audit_years` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-admin@audit.kig.co.id|127.0.0.1','i:1;',1765502129),('laravel-cache-admin@audit.kig.co.id|127.0.0.1:timer','i:1765502128;',1765502128),('laravel-cache-boost.roster.scan','a:2:{s:6:\"roster\";O:21:\"Laravel\\Roster\\Roster\":3:{s:13:\"\0*\0approaches\";O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:9:{i:0;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^12.0\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:LARAVEL\";s:14:\"\0*\0packageName\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"12.41.1\";s:6:\"\0*\0dev\";b:0;}i:1;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.3.8\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PROMPTS\";s:14:\"\0*\0packageName\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:5:\"0.3.8\";s:6:\"\0*\0dev\";b:0;}i:2;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^2.3\";s:10:\"\0*\0package\";E:36:\"Laravel\\Roster\\Enums\\Packages:BREEZE\";s:14:\"\0*\0packageName\";s:14:\"laravel/breeze\";s:10:\"\0*\0version\";s:5:\"2.3.8\";s:6:\"\0*\0dev\";b:1;}i:3;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.4.1\";s:10:\"\0*\0package\";E:33:\"Laravel\\Roster\\Enums\\Packages:MCP\";s:14:\"\0*\0packageName\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"0.4.1\";s:6:\"\0*\0dev\";b:1;}i:4;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.24\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PINT\";s:14:\"\0*\0packageName\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.26.0\";s:6:\"\0*\0dev\";b:1;}i:5;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.41\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:SAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/sail\";s:10:\"\0*\0version\";s:6:\"1.50.0\";s:6:\"\0*\0dev\";b:1;}i:6;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:7:\"^11.5.3\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PHPUNIT\";s:14:\"\0*\0packageName\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:7:\"11.5.46\";s:6:\"\0*\0dev\";b:1;}i:7;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:38:\"Laravel\\Roster\\Enums\\Packages:ALPINEJS\";s:14:\"\0*\0packageName\";s:8:\"alpinejs\";s:10:\"\0*\0version\";s:6:\"3.15.2\";s:6:\"\0*\0dev\";b:1;}i:8;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:TAILWINDCSS\";s:14:\"\0*\0packageName\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:6:\"3.4.18\";s:6:\"\0*\0dev\";b:1;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:21:\"\0*\0nodePackageManager\";E:43:\"Laravel\\Roster\\Enums\\NodePackageManager:NPM\";}s:9:\"timestamp\";i:1765284101;}',1765370501);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Kode departemen',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama departemen',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi departemen',
  `sm_user_id` bigint unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Status aktif departemen',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_code_unique` (`code`),
  KEY `departments_sm_user_id_foreign` (`sm_user_id`),
  CONSTRAINT `departments_sm_user_id_foreign` FOREIGN KEY (`sm_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'FIN','Finance','Departemen keuangan yang mengelola semua aspek finansial perusahaan',3,1,'2025-12-09 11:59:50','2025-12-09 12:02:05',NULL),(2,'IT','Information Technology','Departemen teknologi informasi yang mengelola infrastruktur IT dan sistem',8,1,'2025-12-09 11:59:50','2025-12-09 12:02:06',NULL),(3,'HR','Human Resources','Departemen sumber daya manusia yang mengelola karyawan dan rekrutmen',NULL,1,'2025-12-09 11:59:50','2025-12-09 11:59:50',NULL),(4,'OPS','Operations','Departemen operasional yang mengelola kegiatan operasional harian',4,1,'2025-12-09 11:59:50','2025-12-09 12:02:05',NULL),(5,'MKT','Marketing','Departemen pemasaran yang mengelola strategi pemasaran dan branding',NULL,1,'2025-12-09 11:59:50','2025-12-09 11:59:50',NULL),(6,'PROC','Procurement','Departemen pengadaan yang mengelola pembelian dan vendor',NULL,1,'2025-12-09 11:59:50','2025-12-09 11:59:50',NULL),(7,'QA','Quality Assurance','Departemen quality assurance yang memastikan kualitas produk dan layanan',NULL,1,'2025-12-09 11:59:50','2025-12-09 11:59:50',NULL),(8,'LOG','Logistics','Departemen logistik yang mengelola distribusi dan pergudangan',NULL,1,'2025-12-09 11:59:50','2025-12-12 03:11:11',NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_12_08_174237_add_audit_fields_to_users_table',1),(5,'2025_12_08_175731_create_roles_table',1),(6,'2025_12_08_175832_update_users_role_to_foreign_key',1),(7,'2025_12_09_114257_create_departments_table',1),(8,'2025_12_09_114302_create_audit_timelines_table',1),(9,'2025_12_09_114303_create_audit_programs_table',1),(10,'2025_12_09_114304_create_audit_questions_table',1),(11,'2025_12_09_114305_create_audit_answers_table',1),(12,'2025_12_09_114306_create_audit_documents_table',1),(13,'2025_12_09_114307_create_audit_comments_table',1),(14,'2025_12_09_114308_create_audit_reports_table',1),(15,'2025_12_09_114309_add_department_fields_to_users_table',1),(16,'2025_12_09_141848_create_question_comments_table',2),(17,'2025_12_11_034422_add_audit_details_to_audit_programs_table',3),(18,'2025_12_11_034605_create_audit_program_documents_table',4),(19,'2025_12_12_014706_change_risk_to_json_in_audit_programs_table',5),(20,'2025_12_12_021905_create_audit_years_table',6),(21,'2025_12_12_040908_add_actual_dates_to_audit_timelines_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_comments`
--

DROP TABLE IF EXISTS `question_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `audit_question_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Isi komentar',
  `is_internal` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Komentar internal (hanya auditor)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_comments_audit_question_id_index` (`audit_question_id`),
  KEY `question_comments_user_id_index` (`user_id`),
  CONSTRAINT `question_comments_audit_question_id_foreign` FOREIGN KEY (`audit_question_id`) REFERENCES `audit_questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `question_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_comments`
--

LOCK TABLES `question_comments` WRITE;
/*!40000 ALTER TABLE `question_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator','Akses penuh ke seluruh sistem','2025-12-09 11:48:50','2025-12-09 11:48:50'),(2,'auditor','Auditor','Dapat membuat dan mengelola audit','2025-12-09 11:48:50','2025-12-09 11:48:50'),(3,'auditee_sm','Auditee SM','Auditee Senior Management','2025-12-09 11:48:50','2025-12-09 11:48:50'),(4,'auditee_em','Auditee EM','Auditee Executive Management','2025-12-09 11:48:50','2025-12-09 11:48:50'),(5,'pimpinan','Pimpinan','Pimpinan perusahaan','2025-12-09 11:48:50','2025-12-09 11:48:50');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('9HJN56Yq8Q29z2uNBdwgAwuAeOYOTI1Q2DXtVyJ4',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:145.0) Gecko/20100101 Firefox/145.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQUo3MEN2NHg3NjJCUkJ4UXNwQ0NhNWJPOE1YYUNsRzhua0hIbkl1OCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYXBvcmFuIjtzOjU6InJvdXRlIjtzOjEzOiJsYXBvcmFuLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1765781532),('AkEzxW2wOEPf9ahz9s4qZrhU5VcHP41Wx01ySusQ',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:145.0) Gecko/20100101 Firefox/145.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoibVJKUWxXRjlrVU5XYVBISEhUMkdNczJ1YkVOekIwZWc2M1hHTUlXYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ya2lhL3Byb2dyYW0iO3M6NToicm91dGUiO3M6MTI6InJraWEucHJvZ3JhbSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1765528353),('jl9L7iB3MM38Inu2Wtyh9ZeMR9J62xiNsJcTheng',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:145.0) Gecko/20100101 Firefox/145.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoibkJTRFhXTXFXZERKRDVZMVV4RkNHYmZSa0ZUNFNjZ2s2emJqZDY2MiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JraWEvMjAyNS90aW1lbGluZSI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1765616798),('q3jRizo5Ke7X3aa6tCYTew3MqmOFy9SRy6YthxBX',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:145.0) Gecko/20100101 Firefox/145.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQk1yYVhyMW5uTzhrRlBFRjJFT2NnYXNkZjFXU0JwVlNRQm9zeUxVWiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmtpYS8yMDI1L3RpbWVsaW5lIjtzOjU6InJvdXRlIjtzOjEzOiJya2lhLnRpbWVsaW5lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1765536526);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned DEFAULT NULL,
  `is_department_head` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Apakah SM/Kepala Departemen',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_employee_id_unique` (`employee_id`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_department_id_foreign` (`department_id`),
  CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin','KIG001','IT','System Administrator',1,NULL,0,1,'2025-12-15 06:50:03','admin@kig.co.id','2025-12-09 11:48:50','$2y$12$eRMSdA7F6izIWHBODX0SAeIZiDtLjBRgSyJl6yA7MMTHrLubLWGfG',NULL,'2025-12-09 11:48:50','2025-12-15 06:50:03'),(2,'Auditor Senior','auditor','KIG002','Internal Audit','Senior Auditor',2,NULL,0,1,'2025-12-09 12:20:50','auditor@kig.co.id','2025-12-09 11:48:51','$2y$12$jTtinJZEuvJXMLni5AfOWOH.8rLLY9GGKHXWhwgEwUsuVBjiu28uW',NULL,'2025-12-09 11:48:51','2025-12-09 12:20:50'),(3,'Auditee SM','auditee_sm','KIG003','Finance','Senior Manager',3,1,1,1,NULL,'auditee.sm@kig.co.id','2025-12-09 11:48:51','$2y$12$kGtka24Fvh01oR2pi.v9mOhDe.CwoQUViFteMyUH3IdvPWGCN2ozG',NULL,'2025-12-09 11:48:51','2025-12-09 12:02:05'),(4,'Auditee EM','auditee_em','KIG004','Operations','Executive Manager',4,4,1,1,NULL,'auditee.em@kig.co.id','2025-12-09 11:48:51','$2y$12$U7nbJQZ7gM5dLw4vrUSTb.0S8nmtr2hnx0WmMuXNnJNEnnYky0Xv6',NULL,'2025-12-09 11:48:51','2025-12-09 12:02:05'),(5,'Pimpinan','pimpinan','KIG005','Management','Direktur',5,NULL,0,1,NULL,'pimpinan@kig.co.id','2025-12-09 11:48:52','$2y$12$cTb8kcmwMvZ0BJ3RBu6gwOUWzLJS5cjWxkHd1JHZJW6n3NiXxTm8i',NULL,'2025-12-09 11:48:52','2025-12-09 11:48:52'),(6,'Budi Santoso','budi.santoso','KIG101','Finance','Finance Staff',4,1,0,1,NULL,'budi.santoso@kig.co.id','2025-12-09 12:02:05','$2y$12$.y9R5lruSBDttUxUNppuyunk5bu1ln7kODGfXuF.xbhK3IM0Pe/Eq',NULL,'2025-12-09 12:02:05','2025-12-09 12:02:05'),(7,'Siti Nurhaliza','siti.nurhaliza','KIG102','Finance','Accounting Staff',4,1,0,1,NULL,'siti.nurhaliza@kig.co.id','2025-12-09 12:02:05','$2y$12$RV70om6deZswpbnegB4hq.6PTsLAcwp8o2qBfIWmWR3jziRsS4SY.',NULL,'2025-12-09 12:02:05','2025-12-09 12:02:05'),(8,'Ahmad Fauzi','ahmad.fauzi','KIG201','IT','IT Manager',3,2,1,1,NULL,'ahmad.fauzi@kig.co.id','2025-12-09 12:02:06','$2y$12$boTe1uLSzAZsXSmxMg7QreLgMy33zIL88LDiW69LxDf7fU1Mr5FSm',NULL,'2025-12-09 12:02:06','2025-12-09 12:02:06'),(9,'Dewi Lestari','dewi.lestari','KIG202','IT','Developer',4,2,0,1,NULL,'dewi.lestari@kig.co.id','2025-12-09 12:02:06','$2y$12$cKO3esPV9C.6sLFhajIGZumUStVQZww1JSXhDT4eGOuPS7aTwJQIO',NULL,'2025-12-09 12:02:06','2025-12-09 12:02:06'),(10,'Rudi Hartono','rudi.hartono','KIG301','Operations','Operations Staff',4,4,0,1,NULL,'rudi.hartono@kig.co.id','2025-12-09 12:02:06','$2y$12$KEjMDsZrRoR04BssTz3stu7EpSYFV1vFTzN0Pd8qMc6dCwfknHu8S',NULL,'2025-12-09 12:02:06','2025-12-09 12:02:06'),(11,'ivanroy','ivan','98789',NULL,NULL,2,2,0,1,'2025-12-12 01:55:34','ivanpandhe@gmail.com',NULL,'$2y$12$eGZIiPYX0jymhxreSOBfWuaxts1VRQWS5.Rr/Dx7JeL8.pBsrxDui',NULL,'2025-12-12 01:55:11','2025-12-12 01:55:34');
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

-- Dump completed on 2025-12-15  7:53:39
