-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 25, 2024 at 02:51 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dagat_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Docu_ID` bigint UNSIGNED NOT NULL,
  `Sign_ID` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_docu_id_foreign` (`Docu_ID`),
  KEY `activity_logs_sign_id_foreign` (`Sign_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `Docu_ID`, `Sign_ID`, `action`, `Timestamp`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Received', '2024-07-23 23:31:32', '2024-07-23 23:31:32', '2024-07-23 23:31:32'),
(2, 1, 2, 'Approved', '2024-07-23 23:31:47', '2024-07-23 23:31:47', '2024-07-23 23:31:47'),
(3, 1, 1, 'Received', '2024-07-23 23:32:02', '2024-07-23 23:32:02', '2024-07-23 23:32:02'),
(4, 1, 1, 'Approved', '2024-07-23 23:32:15', '2024-07-23 23:32:15', '2024-07-23 23:32:15'),
(5, 1, NULL, 'Fully Approved', '2024-07-23 23:32:15', '2024-07-23 23:32:15', '2024-07-23 23:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `approved_files`
--

DROP TABLE IF EXISTS `approved_files`;
CREATE TABLE IF NOT EXISTS `approved_files` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `document_type_id` bigint UNSIGNED DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `approved_files_document_type_id_foreign` (`document_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `DT_ID` bigint UNSIGNED NOT NULL,
  `Status_ID` bigint UNSIGNED NOT NULL,
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date_Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Date_Approved` timestamp NULL DEFAULT NULL,
  `Document_File` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_user_id_foreign` (`user_id`),
  KEY `documents_dt_id_foreign` (`DT_ID`),
  KEY `documents_status_id_foreign` (`Status_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `DT_ID`, `Status_ID`, `Description`, `Date_Created`, `Date_Approved`, `Document_File`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 'CIC PSITS Activity Design', '2024-07-24 07:32:15', '2024-07-23 23:32:15', 'documents/wgpNsX2050ANOGCw2US8Jxt72Udj16VBagmihwSh.pdf', '2024-07-23 23:31:19', '2024-07-23 23:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

DROP TABLE IF EXISTS `document_types`;
CREATE TABLE IF NOT EXISTS `document_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `DT_Type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_types`
--

INSERT INTO `document_types` (`id`, `DT_Type`, `created_at`, `updated_at`) VALUES
(1, 'Activity Design', NULL, NULL),
(2, 'Letter', NULL, NULL),
(3, 'Planning Form', NULL, NULL),
(4, 'Financial Statement', NULL, NULL),
(5, 'Achievement Report', NULL, NULL),
(6, 'PubMat Request', NULL, NULL),
(7, 'Attendance Sheet', NULL, NULL),
(8, 'Notice of Meeting', NULL, NULL),
(9, 'Minutes of Meeting', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(145, '2024_07_10_070458_create_privileges_table', 1),
(146, '2024_07_10_081817_create_positions_table', 1),
(147, '2024_07_10_081823_create_users_table', 1),
(148, '2024_07_11_022447_create_password_resets_table', 1),
(149, '2024_07_11_022455_create_failed_jobs_table', 1),
(150, '2024_07_11_022502_create_personal_access_tokens_table', 1),
(151, '2024_07_11_022518_create_document_types_table', 1),
(152, '2024_07_11_022530_create_statuses_table', 1),
(153, '2024_07_11_022538_create_offices_table', 1),
(154, '2024_07_11_023205_create_documents_table', 1),
(155, '2024_07_11_023226_create_qrcodes_table', 1),
(156, '2024_07_11_023233_create_signatories_table', 1),
(157, '2024_07_11_023240_create_activity_logs_table', 1),
(158, '2024_07_11_031950_create_sessions_table', 1),
(159, '2024_07_11_032224_create_cache_table', 1),
(160, '2024_07_11_033718_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

DROP TABLE IF EXISTS `offices`;
CREATE TABLE IF NOT EXISTS `offices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Office_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Office_Pin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `offices_office_pin_unique` (`Office_Pin`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `Office_Name`, `Office_Pin`, `created_at`, `updated_at`) VALUES
(1, 'Office of the President', 'ADM001', NULL, NULL),
(2, 'Office of the Vice President for Academic Affairs', 'ADM002', NULL, NULL),
(3, 'Office of the Vice President for Administration', 'ADM003', NULL, NULL),
(4, 'Office of the Vice President for Planning and Quality Assurance', 'ADM004', NULL, NULL),
(5, 'Office of the Vice President for Research, Development and Extension', 'ADM005', NULL, NULL),
(6, 'Office of the Secretary of the University and the University Records Office', 'ADM006', NULL, NULL),
(7, 'Office of Legal Affairs', 'ADM007', NULL, NULL),
(8, 'International Affairs Division', 'ADM008', NULL, NULL),
(9, 'Public Affairs Division', 'ADM009', NULL, NULL),
(10, 'Office of Advance Studies', 'ADM010', NULL, NULL),
(11, 'Human Resource Management Division', 'ADM011', NULL, NULL),
(12, 'Administrative Services Division', 'ADM012', NULL, NULL),
(13, 'Physical Development Division', 'ADM013', NULL, NULL),
(14, 'Gender and Development Office', 'ADM014', NULL, NULL),
(15, 'Bids & Awards Committee', 'ADM015', NULL, NULL),
(16, 'Office of Student Affairs and Services', 'SER001', NULL, NULL),
(17, 'Office of the University Registrar', 'SER002', NULL, NULL),
(18, 'University Assessment and Guidance Center', 'SER003', NULL, NULL),
(19, 'University Learning Resource Center', 'SER004', NULL, NULL),
(20, 'Resource Management Division', 'SER005', NULL, NULL),
(21, 'Health Services Division', 'SER006', NULL, NULL),
(22, 'University Finance Division', 'SER007', NULL, NULL),
(23, 'Research, Development and Extension', 'SER008', NULL, NULL),
(24, 'College of Applied Economics', 'COL001', NULL, NULL),
(25, 'College of Arts and Sciences', 'COL002', NULL, NULL),
(26, 'College of Business Administration', 'COL003', NULL, NULL),
(27, 'College of Education', 'COL004', NULL, NULL),
(28, 'College of Engineering', 'COL005', NULL, NULL),
(29, 'College of Information and Computing', 'COL006', NULL, NULL),
(30, 'College of Technology', 'COL007', NULL, NULL),
(31, 'College of Applied Economics LC', 'CLC001', NULL, NULL),
(32, 'College of Arts and Sciences LC', 'CLC002', NULL, NULL),
(33, 'College of Business Administration LC', 'CLC003', NULL, NULL),
(34, 'College of Education LC', 'CLC004', NULL, NULL),
(35, 'College of Engineering LC', 'CLC005', NULL, NULL),
(36, 'College of Information and Computing LC', 'CLC006', NULL, NULL),
(37, 'College of Technology LC', 'CLC007', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `position_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position_name`, `created_at`, `updated_at`) VALUES
(1, 'Governor', NULL, NULL),
(2, 'Vice Governor', NULL, NULL),
(3, 'Secretary', NULL, NULL),
(4, 'Treasurer', NULL, NULL),
(5, 'Auditor', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Privilege_Level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `Privilege_Level`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, NULL),
(2, 'Officer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qrcodes`
--

DROP TABLE IF EXISTS `qrcodes`;
CREATE TABLE IF NOT EXISTS `qrcodes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Docu_ID` bigint UNSIGNED NOT NULL,
  `QR_Image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date_Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Usage_Count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qrcodes_docu_id_foreign` (`Docu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qrcodes`
--

INSERT INTO `qrcodes` (`id`, `Docu_ID`, `QR_Image`, `Date_Created`, `Usage_Count`, `created_at`, `updated_at`) VALUES
(1, 1, 'qrcodes/1.svg', '2024-07-24 07:32:15', 4, '2024-07-23 23:31:19', '2024-07-23 23:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('OeXrNVzh8knW5no4W11Fex8BaMQ3rjPPbZoatztC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWG00VlhMVXBXMnZ3eWcyOEF0Y25qR3c4S0ZYMmk3VmVVVDlKdldtTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcmNoaXZlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1721918753);

-- --------------------------------------------------------

--
-- Table structure for table `signatories`
--

DROP TABLE IF EXISTS `signatories`;
CREATE TABLE IF NOT EXISTS `signatories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `QRC_ID` bigint UNSIGNED NOT NULL,
  `Office_ID` bigint UNSIGNED NOT NULL,
  `Status_ID` bigint UNSIGNED NOT NULL,
  `Received_Date` timestamp NULL DEFAULT NULL,
  `Signed_Date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `signatories_qrc_id_foreign` (`QRC_ID`),
  KEY `signatories_office_id_foreign` (`Office_ID`),
  KEY `signatories_status_id_foreign` (`Status_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signatories`
--

INSERT INTO `signatories` (`id`, `QRC_ID`, `Office_ID`, `Status_ID`, `Received_Date`, `Signed_Date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, '2024-07-23 23:32:02', '2024-07-23 23:32:15', '2024-07-23 23:31:19', '2024-07-23 23:32:15'),
(2, 1, 2, 3, '2024-07-23 23:31:32', '2024-07-23 23:31:47', '2024-07-23 23:31:19', '2024-07-23 23:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Status_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `Status_Name`, `created_at`, `updated_at`) VALUES
(1, 'Pending', NULL, NULL),
(2, 'Received ', NULL, NULL),
(3, 'Approved ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `PRI_ID` bigint UNSIGNED NOT NULL,
  `Position_ID` bigint UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_pri_id_foreign` (`PRI_ID`),
  KEY `users_position_id_foreign` (`Position_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `PRI_ID`, `Position_ID`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Deane Santos Jr.', 'governor@example.com', NULL, 1, 1, '$2y$12$VD3Ya5eLNmCeVaALU99DDucyEQa7CA86eUN9.mYHbabM2E4F5kiJe', NULL, NULL, NULL),
(2, 'Samantha Locsin', 'vice_governor@example.com', NULL, 2, 2, '$2y$12$r1N9A1p6A1N5.sDq6O2v6.yaApAsKRJvA/aAwgi91AqZXpHG/IYOy', NULL, NULL, NULL),
(3, 'Jinnelyn Corpin', 'secretary@example.com', NULL, 2, 3, '$2y$12$C30DjXKXFlujsOoDdCqVh.UrFsP2FAj6kyOOIGVCET3mFGohM1ElW', NULL, NULL, NULL),
(4, 'Jay Marasigan', 'treasurer@example.com', NULL, 2, 4, '$2y$12$rWM14cxaxl0Vzr6gYE5Cm.UKEdlML6UVCb6rmm3BUtvki0TNxafeG', NULL, NULL, NULL),
(5, 'Lilian Dawatan', 'auditor@example.com', NULL, 2, 5, '$2y$12$AD9f52xGZMLNloVIfvvUOekEdi32pfs5slltaVUDWKS9eTS9i0bHe', NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_docu_id_foreign` FOREIGN KEY (`Docu_ID`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activity_logs_sign_id_foreign` FOREIGN KEY (`Sign_ID`) REFERENCES `signatories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_dt_id_foreign` FOREIGN KEY (`DT_ID`) REFERENCES `document_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documents_status_id_foreign` FOREIGN KEY (`Status_ID`) REFERENCES `statuses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qrcodes`
--
ALTER TABLE `qrcodes`
  ADD CONSTRAINT `qrcodes_docu_id_foreign` FOREIGN KEY (`Docu_ID`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `signatories`
--
ALTER TABLE `signatories`
  ADD CONSTRAINT `signatories_office_id_foreign` FOREIGN KEY (`Office_ID`) REFERENCES `offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `signatories_qrc_id_foreign` FOREIGN KEY (`QRC_ID`) REFERENCES `qrcodes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `signatories_status_id_foreign` FOREIGN KEY (`Status_ID`) REFERENCES `statuses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_position_id_foreign` FOREIGN KEY (`Position_ID`) REFERENCES `positions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_pri_id_foreign` FOREIGN KEY (`PRI_ID`) REFERENCES `privileges` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
