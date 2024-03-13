-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 13, 2024 at 09:03 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collegetemplate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_hash_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_admin_hash_id_unique` (`admin_hash_id`),
  UNIQUE KEY `admins_school_id_unique` (`school_id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_hash_id`, `school_id`, `name`, `email`, `email_verified_at`, `password`, `verify`, `remember_token`, `created_at`, `updated_at`, `pin`, `user_status`) VALUES
(1, 'c890b63e2a05fb53519acdecfafc205b', 100, 'Admin User', 'admin@email.com', NULL, '$2y$10$qXALZyaMY5GAbLWXkOKpbeOnr4cndMWB.Q/L2vakzX.pDeKc9X9xe', 1, '', '2024-01-15 08:50:28', '2024-01-15 08:50:28', '102', 1);

-- --------------------------------------------------------

--
-- Table structure for table `child_menus`
--

DROP TABLE IF EXISTS `child_menus`;
CREATE TABLE IF NOT EXISTS `child_menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_id` int DEFAULT NULL,
  `submenu_id` int DEFAULT NULL,
  `childmenu_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_menu_slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_menu_desc` text COLLATE utf8mb4_unicode_ci,
  `upload` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_menu_status` int DEFAULT NULL,
  `dept_id` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `child_menu_slug` (`child_menu_slug`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_menus`
--

INSERT INTO `child_menus` (`id`, `menu_id`, `submenu_id`, `childmenu_name`, `child_menu_slug`, `child_menu_desc`, `upload`, `child_menu_status`, `dept_id`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 'test', 'test', '<p>test</p>', '', 1, 0, '2024-03-13 07:12:20', '2024-03-13 07:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_hash_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_type_id` bigint UNSIGNED NOT NULL,
  `upload` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_status` int NOT NULL,
  `school_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_hash_id`, `event_title`, `event_description`, `event_type_id`, `upload`, `start_date`, `end_date`, `url`, `color`, `event_status`, `school_id`, `created_at`, `updated_at`) VALUES
(1, '1ba152e7cdfbe6dcb154a989b9446aef', 'শিশু দিবস', '<p>শিশু দিবস<br></p>', 2, '1710091955430033780_3201774206632790_2755277982313711726_n.jpg', '2024-03-17 00:00:00', '2024-03-17 00:00:00', 'sisu-dibs', 'green', 1, 100, '2024-03-10 23:32:35', '2024-03-10 23:33:32'),
(2, '2550d29ccab36ebf5c185967ddbe8213', 'বার্ষিক পরিক্ষা', '<p>বার্ষিক পরিক্ষাবার্ষিক পরিক্ষাবার্ষিক পরিক্ষাবার্ষিক পরিক্ষাবার্ষিক পরিক্ষা<br></p>', 1, '1710092072logo.png', '2024-03-18 00:00:00', '2024-03-25 00:00:00', 'barshik-priksha', 'blue', 1, 100, '2024-03-10 23:34:32', '2024-03-10 23:36:12'),
(3, 'f4237e14c013194176930bb599b2a77a', 'স্বাধিনতা দিবস', '<p>স্বাধিনতা দিবসস্বাধিনতা দিবসস্বাধিনতা দিবসস্বাধিনতা দিবসস্বাধিনতা দিবসস্বাধিনতা দিবস<br></p>', 1, '', '2024-03-26 00:00:00', '2024-03-26 00:00:00', 'swadhinta-dibs', 'blue', 1, 100, '2024-03-10 23:37:05', '2024-03-10 23:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

DROP TABLE IF EXISTS `event_types`;
CREATE TABLE IF NOT EXISTS `event_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `school_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `type_name`, `color`, `status`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'একাডেমিক', 'blue', 1, 101, '2024-03-10 23:26:50', '2024-03-10 23:26:50'),
(2, 'ইভেন্ট', 'green', 1, 101, '2024-03-10 23:26:50', '2024-03-10 23:26:50'),
(3, 'বিজ্ঞপ্তি', 'pink', 1, 101, '2024-03-10 22:58:23', '2024-03-10 22:59:50'),
(4, 'এন ও সি', 'purple', 1, 101, '2024-03-10 23:26:50', '2024-03-10 23:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `histories`
--

DROP TABLE IF EXISTS `histories`;
CREATE TABLE IF NOT EXISTS `histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `history` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `history`, `created_at`, `updated_at`) VALUES
(1, 'বালিয়াকান্দি রাজবড়ী জেলার অন্তর্গত একটি উপজেলা। বালিয়াকান্দির উত্তরে পাংশা উপজেলা, দক্ষিণে ফরিদপুর জেলার মধুখালী উপজেলা, পূর্বে রাজবাড়ী সদর উপজেলা, পশ্চিমে মাগুরা জেলার শ্রীপুর উপজেলা।&nbsp;বালিয়াকান্দি রাজবড়ী জেলার অন্তর্গত একটি উপজেলা। বালিয়াকান্দির উত্তরে পাংশা উপজেলা, দক্ষিণে ফরিদপুর জেলার মধুখালী উপজেলা, পূর্বে রাজবাড়ী সদর উপজেলা, পশ্চিমে মাগুরা জেলার শ্রীপুর উপজেলা।', '2024-03-10 23:11:52', '2024-03-10 23:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `important_links`
--

DROP TABLE IF EXISTS `important_links`;
CREATE TABLE IF NOT EXISTS `important_links` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `link_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_home` int NOT NULL,
  `menu_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_name`, `slug`, `upload`, `is_home`, `menu_status`, `created_at`, `updated_at`) VALUES
(1, 'প্রতিষ্ঠান সম্পর্কে', 'about-institute', '1694792981_1.png', 0, 1, NULL, '2024-03-12 11:46:05'),
(2, 'পাঠ্যক্রম সম্পর্কে', 'administration', '1694792989_2.png', 0, 1, NULL, '2024-03-12 11:47:36'),
(3, 'বিভাগ সমুহ', 'teachers-and-staffs', '1696913896_IMG_20231009_111508.jpg', 0, 1, NULL, '2024-03-12 11:48:21'),
(4, 'সহশিক্ষা কার্যক্রম', 'sikshartheer-tthz', '1694793009_4.png', 0, 1, NULL, '2024-03-12 11:49:19'),
(5, 'ই-সেবা', 'academic-information', '1694793021_5.png', 0, 1, NULL, '2024-03-12 11:50:16'),
(6, 'শিক্ষার্থী লগইন', 'admission', '1694793031_6.png', 0, 1, NULL, '2024-03-12 11:51:35'),
(7, 'অনলাইন এডমিশন', 'co-curricular', '1694793041_8.png', 0, 1, NULL, '2024-03-12 11:52:36'),
(8, 'গ্যালারি', 'exam-information', '1694793052_9.png', 0, 1, NULL, '2024-03-12 11:54:20'),
(10, 'আমাদের কলেজ', 'gallery', '1694793073_10.png', 1, 1, NULL, '2024-03-12 11:56:53'),
(11, 'প্রশাসন', 'prsasn', '', 1, 1, '2024-03-12 11:58:25', '2024-03-12 11:58:25'),
(12, 'অনুষদ', 'onushd', '', 1, 1, '2024-03-12 11:59:42', '2024-03-12 11:59:42'),
(13, 'পরীক্ষা ও ফলাফল', 'preeksha-oo-flafl', '', 1, 1, '2024-03-12 12:00:18', '2024-03-12 12:00:18'),
(14, 'ভর্তি বিষয়ক', 'vrti-bishyk', '', 1, 1, '2024-03-12 12:01:35', '2024-03-12 12:01:35'),
(15, 'সংগঠন', 'snggthn', '', 1, 1, '2024-03-12 12:02:37', '2024-03-12 12:02:37'),
(16, 'সহায়ক লিংক', 'shayk-lingk', '', 1, 1, '2024-03-12 12:03:12', '2024-03-12 12:03:12'),
(17, 'অভিযোগ প্রতিকার ব্যবস্থাপনা', 'ovizog-prtikar-lingk', '', 1, 1, '2024-03-12 12:03:56', '2024-03-12 12:04:43'),
(18, 'বার্যিক কর্মপরিকল্পনা', 'barzik-krmpriklpna', '', 1, 1, '2024-03-12 12:07:04', '2024-03-12 12:07:04'),
(19, 'এলামনাই সেল', 'elamnai-sel', '', 1, 1, '2024-03-12 12:07:40', '2024-03-12 12:07:40');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `message_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_desc` text COLLATE utf8mb4_unicode_ci,
  `upload` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `messages_message_slug_unique` (`message_slug`),
  UNIQUE KEY `messages_upload_unique` (`upload`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message_type`, `message_slug`, `name`, `message_desc`, `upload`, `message_status`, `created_at`, `updated_at`) VALUES
(1, 'অধ্যক্ষের বাণী', '', 'মিঃ অধ্যক্ষ', 'বালিয়াকান্দি রাজবড়ী জেলার অন্তর্গত একটি উপজেলা। বালিয়াকান্দির উত্তরে পাংশা উপজেলা, দক্ষিণে ফরিদপুর জেলার মধুখালী উপজেলা, পূর্বে রাজবাড়ী সদর উপজেলা, পশ্চিমে মাগুরা জেলার শ্রীপুর উপজেলা।&nbsp;বালিয়াকান্দি রাজবড়ী জেলার অন্তর্গত একটি উপজেলা। বালিয়াকান্দির উত্তরে পাংশা উপজেলা, দক্ষিণে ফরিদপুর জেলার মধুখালী উপজেলা, পূর্বে রাজবাড়ী সদর উপজেলা, পশ্চিমে মাগুরা জেলার শ্রীপুর উপজেলা।', '1710091345_images.png', 1, '2024-03-10 23:12:14', '2024-03-10 23:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_09_05_080010_create_menus_table', 1),
(7, '2023_09_08_112639_create_sub_menus_table', 1),
(8, '2023_09_08_150447_create_important_links_table', 1),
(9, '2023_09_08_161326_create_events_table', 1),
(10, '2023_09_11_170529_create_histories_table', 1),
(11, '2023_09_12_131256_create_sliders_table', 1),
(12, '2023_09_12_143659_create_web_settings_table', 1),
(13, '2023_09_15_130156_create_mujib_corners_table', 1),
(14, '2023_09_16_050254_create_uploads_table', 1),
(15, '2023_09_20_113839_create_messages_table', 1),
(16, '2023_12_08_150200_create_event_types_table', 1),
(17, '2024_03_05_221937_create_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mujib_corners`
--

DROP TABLE IF EXISTS `mujib_corners`;
CREATE TABLE IF NOT EXISTS `mujib_corners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `upload` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `upload` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `slider_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `upload`, `title`, `desc`, `slider_status`, `created_at`, `updated_at`) VALUES
(1, '1710091030_430033780_3201774206632790_2755277982313711726_n.jpg', 'ভাষা শহিদদের প্রতি শ্রদ্ধা নিবেদন।', 'আন্তর্জাতিক মাতৃভাষা দিবসে ভাষা শহিদদের প্রতি শ্রদ্ধা নিবেদন।', 1, '2024-03-10 23:17:10', '2024-03-10 23:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

DROP TABLE IF EXISTS `sub_menus`;
CREATE TABLE IF NOT EXISTS `sub_menus` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int NOT NULL,
  `submenu_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submenu_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submenu_desc` text COLLATE utf8mb4_unicode_ci,
  `upload` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submenu_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_menus_submenu_slug_unique` (`submenu_slug`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_menus`
--

INSERT INTO `sub_menus` (`id`, `menu_id`, `submenu_name`, `submenu_slug`, `submenu_desc`, `upload`, `submenu_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'প্রতিষ্ঠান সম্পর্কে', 'about-institution', '<br>', '1704957133_class rutin 2024.pdf', 1, '0000-00-00 00:00:00', '2024-03-11 00:08:56'),
(2, 1, 'প্রশাসন', 'mission-vision', '<p><br></p>', '', 1, '0000-00-00 00:00:00', '2024-03-12 12:13:45'),
(3, 1, 'শিক্ষক-কর্মকর্তা-কর্মচারী', 'history', '<p class=\"MsoNormal\"><br></p>', '', 1, '0000-00-00 00:00:00', '2024-03-12 12:14:56'),
(15, 2, 'স্তর ও বিভাগ সমুহ', 'managing-commettee-information', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 12:23:22'),
(16, 2, 'ভর্তি সংক্রান্ত', 'president-list', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 12:24:22'),
(17, 2, 'পরিক্ষা সংক্রান্ত', 'head-master-list', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 12:45:05'),
(18, 2, 'ফলাফল সংক্রান্ত', 'donor-list', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 12:45:37'),
(69, 3, 'ব্যবসা প্রশাসন অনুযদ', 'bzbsa-prsasn-onuzd', NULL, '', 1, '2024-03-12 12:49:26', '2024-03-12 12:49:26'),
(20, 3, 'কলা অনুযদ', 'teacher-information', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 12:47:16'),
(21, 3, 'বিজ্ঞান অনুযদ', 'staff-information', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 12:48:10'),
(22, 4, 'লাইব্রেরি ও ক্লাব', 'class-gender-based-student-information', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:36:54'),
(23, 4, 'কো-কারিকুলাম', 'class-wise-student-information', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:37:39'),
(24, 4, 'এক্সট্রা-কারিকুলাম', 'student-attendence-information', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:38:13'),
(25, 4, 'হোস্টেল', 'class-six-student-information', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:38:48'),
(92, 16, 'জাতীয় বিশববিদ্যালয়', 'jateey-bisbbidzaly', NULL, '', 1, '2024-03-12 15:05:55', '2024-03-12 15:05:55'),
(91, 15, 'ক্লাব সমুহ', 'klab-smuh', NULL, '', 1, '2024-03-12 14:15:03', '2024-03-12 14:15:03'),
(90, 15, 'শিক্ষক ছাত্র কল্যান সমিতি', 'sikshk-chatr-klzan-smiti', NULL, '', 1, '2024-03-12 14:14:44', '2024-03-12 14:14:44'),
(88, 15, 'বিএন্সিসি', 'biensisi', NULL, '', 1, '2024-03-12 14:13:39', '2024-03-12 14:13:39'),
(89, 15, 'রোবার', 'robar', NULL, '', 1, '2024-03-12 14:13:54', '2024-03-12 14:13:54'),
(30, 5, 'ই পেমেন্ট সংক্রান্ত সেবা', 'list-of-holiday', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:40:44'),
(31, 5, 'পেমেন্ট রশিদ সার্চ', 'academic-calendar', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:41:33'),
(32, 5, 'পরিক্ষার ফলাফল', 'class-routine', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:42:23'),
(33, 5, 'মোবাইল  App', 'syllabas', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:45:28'),
(87, 14, 'ফোকাল পয়েন্ট', 'fokal-pyent', NULL, '', 1, '2024-03-12 14:13:15', '2024-03-12 14:13:15'),
(86, 14, 'ভর্তি পরিক্ষার ফলাফল', 'vrti-prikshar-flafl', NULL, '', 1, '2024-03-12 14:12:49', '2024-03-12 14:12:49'),
(85, 14, 'ভর্তি ফর্ম', 'vrti-frm', NULL, '', 1, '2024-03-12 14:12:17', '2024-03-12 14:12:17'),
(83, 13, 'সার্টিফিকেট সংক্রান্ত', 'sartifiket-sngkrant', NULL, '', 1, '2024-03-12 14:10:55', '2024-03-12 14:10:55'),
(84, 14, 'ভর্তি বিষয়ক তথ্য', 'vrti-bishyk-tthz', NULL, '', 1, '2024-03-12 14:11:56', '2024-03-12 14:11:56'),
(82, 13, 'ফলাফল সমুহ', 'flafl-smuh', NULL, '', 1, '2024-03-12 14:10:12', '2024-03-12 14:10:12'),
(81, 13, 'পরিক্ষা নিয়ন্ত্রকের অফিস', 'priksha-niyntrker-ofis', NULL, '', 1, '2024-03-12 14:09:52', '2024-03-12 14:09:52'),
(80, 13, 'পরিক্ষার তালিকা', 'prikshar-talika', NULL, '', 1, '2024-03-12 14:08:44', '2024-03-12 14:08:44'),
(79, 12, 'নিতিমালা', 'nitimala', NULL, '', 1, '2024-03-12 14:08:15', '2024-03-12 14:08:15'),
(78, 12, 'কর্ম পরিকল্পনা', 'krm-priklpna', NULL, '', 1, '2024-03-12 14:07:59', '2024-03-12 14:07:59'),
(77, 12, 'বিভাগীয় প্রধানগণ', 'bivageey-prdhangn', NULL, '', 1, '2024-03-12 14:06:40', '2024-03-12 14:06:40'),
(76, 12, 'অনুষদ ভিত্তিক বিভাগ সমুহ', 'onushd-vittik-bivag-smuh', NULL, '', 1, '2024-03-12 14:06:00', '2024-03-12 14:06:00'),
(75, 11, 'প্রশাসনিক বিজ্ঞপ্তি', 'prsasnik-bijngpti', NULL, '', 1, '2024-03-12 14:04:51', '2024-03-12 14:04:51'),
(74, 11, 'পরিষদ সমুহ', 'prishd-smuh', NULL, '', 1, '2024-03-12 14:04:05', '2024-03-12 14:04:05'),
(73, 11, 'প্রশাসনিক কাঠামো', 'prsasnik-kathamo', NULL, '', 1, '2024-03-12 14:03:33', '2024-03-12 14:03:33'),
(72, 11, 'অফিস স্টাফ', 'ofis-staf', NULL, '', 1, '2024-03-12 14:02:39', '2024-03-12 14:02:39'),
(56, 8, 'ফটো গ্যালারি', 'exam-rules', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:51:57'),
(57, 8, 'ভিডিও গ্যালারি', 'exam-result-time-table', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:52:21'),
(71, 10, 'সাফল্য ও অর্জন', 'saflz-oo-orjn', NULL, '', 1, '2024-03-12 13:57:33', '2024-03-12 13:57:33'),
(60, 9, 'অভ্যন্তরীণ ফলাফল', 'school-result', '', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 9, 'পাবলিক পরীক্ষার ফলাফল', 'public-exam-result', '', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 9, 'বৃত্তি পরীক্ষার ফলাফল', 'scholership-result', '', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 10, 'এক নজরে', 'photo-gallery', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:55:38'),
(64, 10, 'অধ্যক্ষ', 'video-gallery', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:56:04'),
(65, 10, 'লক্ষ্য ও উদ্দেশ্য', 'magazine', NULL, '', 1, '0000-00-00 00:00:00', '2024-03-12 13:56:31'),
(70, 3, 'সমাজ বিজ্ঞান অনুযদ', 'smaj-bijngan-onuzd', NULL, '', 1, '2024-03-12 12:50:35', '2024-03-12 12:50:35'),
(93, 16, 'মাধ্যমিক ও উচ্চশিক্ষা অধিদপ্তর', 'madhzmik-oo-uccsiksha-odhidptr', NULL, '', 1, '2024-03-12 15:06:56', '2024-03-12 15:06:56'),
(94, 16, 'শিক্ষক বাতায়ন', 'sikshk-batayn', NULL, '', 1, '2024-03-12 15:13:44', '2024-03-12 15:13:44'),
(95, 16, 'মুক্তপাঠ', 'muktpath', NULL, '', 1, '2024-03-12 15:14:14', '2024-03-12 15:14:14'),
(96, 17, 'নির্দেশিকাসমুহ', 'nirdesikasmuh', NULL, '', 1, '2024-03-12 15:15:55', '2024-03-12 15:15:55'),
(97, 17, 'অনলাইন অভিযোগ দাখিল', 'onlain-ovizog-dakhil', NULL, '', 1, '2024-03-12 15:16:27', '2024-03-12 15:16:27'),
(98, 17, 'অভিযোগ প্রতিকার ব্যবস্থা', 'ovizog-prtikar-bzbstha', NULL, '', 1, '2024-03-12 15:17:20', '2024-03-12 15:17:20'),
(99, 17, 'অনিক ও আপিল কর্মকর্তা', 'onik-oo-apil-krmkrta', NULL, '', 1, '2024-03-12 15:19:45', '2024-03-12 15:19:45'),
(100, 18, 'কর্মপরিকল্পনা', 'krmpriklpna', NULL, '', 1, '2024-03-12 15:51:56', '2024-03-12 15:51:56'),
(101, 18, 'ত্রৈমাসিক অর্জন', 'troimasik-orjn', NULL, '', 1, '2024-03-12 15:56:54', '2024-03-12 15:56:54'),
(102, 18, 'উদ্যোগ সমুহ', 'udzog-smuh', NULL, '', 1, '2024-03-12 15:57:36', '2024-03-12 15:57:36'),
(103, 18, 'প্রকিউরমেন্ট আইন ও বিধিমালা', 'prkiurment-ain-oo-bidhimala', NULL, '', 1, '2024-03-12 15:59:00', '2024-03-12 15:59:00'),
(104, 19, 'এলামনাই এসোসিয়েশন সংক্রান্ত তথ্য', 'elamnai-esosiyesn-sngkrant-tthz', NULL, '', 1, '2024-03-12 16:00:09', '2024-03-12 16:00:09'),
(105, 19, 'এলামনাই আইন ও বিধিমালা', 'elamnai-ain-oo-bidhimala', NULL, '', 1, '2024-03-12 16:00:51', '2024-03-12 16:00:51'),
(106, 19, 'এলামনাই তালিকা', 'elamnai-talika', NULL, '', 1, '2024-03-12 16:05:59', '2024-03-12 16:05:59'),
(107, 19, 'ফোকাল পয়েন্ট তথ্য', 'fokal-pyent-tthz', NULL, '', 1, '2024-03-12 16:06:20', '2024-03-12 16:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
CREATE TABLE IF NOT EXISTS `uploads` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `upload` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_settings`
--

DROP TABLE IF EXISTS `web_settings`;
CREATE TABLE IF NOT EXISTS `web_settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_one` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_two` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eiin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_settings`
--

INSERT INTO `web_settings` (`id`, `school_title`, `logo`, `phone1`, `phone2`, `fax`, `email`, `address_one`, `address_two`, `eiin`, `facebook`, `twitter`, `linkedin`, `instagram`, `created_at`, `updated_at`) VALUES
(1, 'বালিয়াকান্দি সরকারি কলেজ', '1710091042_logo.png', '+৮৮ ০১৩০৯ ১১৩ ২৯৭', '+৮৮ ০১৭৩১ ৯৯২ ৯৫৮', NULL, 'bkndcol@gmail.com', 'ইলিশকোল', 'বালিয়াকান্দি, রাজবাড়ি', NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-10 23:17:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
