-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table fyp.blog
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_disabled` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.blog: ~4 rows (approximately)
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` (`id`, `image`, `author`, `title`, `slug`, `description`, `is_active`, `is_disabled`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(12, 'h42mV0GWOcwr8fNpnoiqW4Bw2XJA5K-1624781486.jpg', 'faizan', 'laravel is a best php framework', 'laravel-is-a-best-php-framework', 'dasdsa vdasdas', 0, 0, 1, 1, '2021-06-27 08:11:26', '2021-09-28 13:12:43', NULL),
	(13, 'XW4oHb7hpJNJIVzR0CvtqjPPD9lhBl-1624781534.jpg', 'SAJJAD', 'laravel is a best php framework TEST', 'laravel-is-a-best-php-framework-test', 'aSASDA EWREWRW EWERQWERQW', 1, 0, 1, 0, '2021-06-27 08:12:14', '2021-09-28 12:38:17', NULL),
	(14, 'DYpX4ReGGlnAcvP1rxWsJFvGK5N6Fn-1624781565.jpg', 'Umer', 'laravel is a best php framework AST', 'laravel-is-a-best-php-framework-ast', 'ASAS DSADAS EDWAEDWQQ WEQWEWQ', 1, 0, 1, 1, '2021-06-27 08:12:46', '2021-06-27 08:13:45', '2021-06-27 08:13:45'),
	(15, 'EGEn7g4FbupajPrma1YD6TFMiWc48I-1624781658.jpg', 'Umer', 'laravel is a best php framework AST', 'laravel-is-a-best-php-framework-ast', 'DCADSDASD EDWADASDX EDWQD EWQEWQ', 1, 0, 1, 0, '2021-06-27 08:14:18', '2021-10-31 11:29:16', NULL);
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;

-- Dumping structure for table fyp.cms_about_us
CREATE TABLE IF NOT EXISTS `cms_about_us` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vision` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.cms_about_us: ~0 rows (approximately)
/*!40000 ALTER TABLE `cms_about_us` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_about_us` ENABLE KEYS */;

-- Dumping structure for table fyp.cms_contact_us
CREATE TABLE IF NOT EXISTS `cms_contact_us` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `it_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.cms_contact_us: ~0 rows (approximately)
/*!40000 ALTER TABLE `cms_contact_us` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_contact_us` ENABLE KEYS */;

-- Dumping structure for table fyp.cms_home
CREATE TABLE IF NOT EXISTS `cms_home` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_disabled` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.cms_home: ~3 rows (approximately)
/*!40000 ALTER TABLE `cms_home` DISABLE KEYS */;
INSERT INTO `cms_home` (`id`, `banner`, `description`, `is_disabled`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Id7ZeQ3Tz4V8JMFCbqcD7SKpLNXB3c-1632430499.jpg', 'JUW-ORIC MANAGEMENT PORTAL', 0, 1, 1, '2021-06-26 08:25:13', '2021-09-23 20:54:59', NULL),
	(2, 'SwAM7k8FZvDT5UfNvGknDb5MzswShm-1632429577.jpg', 'EXPLORE UNDER ONE UMBRELLA', 0, 1, 1, '2021-06-26 08:39:30', '2021-09-23 20:39:37', NULL),
	(3, 'l1FvWvhCCSB6jAzphDDCGZ98PfeMiN-1625217061.jpg', 'JUW ORIC WEB PORTAL', 0, 1, 1, '2021-06-26 08:39:42', '2021-10-31 10:40:10', NULL);
/*!40000 ALTER TABLE `cms_home` ENABLE KEYS */;

-- Dumping structure for table fyp.cms_home_intro
CREATE TABLE IF NOT EXISTS `cms_home_intro` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vision` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `values` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_disabled` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.cms_home_intro: ~1 rows (approximately)
/*!40000 ALTER TABLE `cms_home_intro` DISABLE KEYS */;
INSERT INTO `cms_home_intro` (`id`, `vision`, `mission`, `values`, `is_disabled`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(5, 'To ignite ingenuity, creativity and innovation in the hearts of our researchers to explore their inner soul and make their dreams a reality.', 'To become the hub for innovative ideas and their implementation. To provide a launching pad for the brilliant students, faculty and professionals to market their research; where every passing day promises a better tomorrow.', 'Innovation is the specific instrument of entrepreneurship; the act that endows resources with a new capacity to create wealth, and to generate new ideas into futuristic solutions for the betterment of individual, institute and the humanity.', 0, 1, 1, '2021-06-26 14:27:30', '2021-10-31 10:39:23', NULL);
/*!40000 ALTER TABLE `cms_home_intro` ENABLE KEYS */;

-- Dumping structure for table fyp.cms_home_oric_members
CREATE TABLE IF NOT EXISTS `cms_home_oric_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_picture` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.cms_home_oric_members: ~4 rows (approximately)
/*!40000 ALTER TABLE `cms_home_oric_members` DISABLE KEYS */;
INSERT INTO `cms_home_oric_members` (`id`, `profile_picture`, `name`, `designation`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 's28wgoIY75P0QfpC4KqFA7cKC2orP0-1624706002.png', 'oric', '.Net Developer', 'XasXDA s d RFE WERQ RWER F', 1, 1, '2021-06-26 11:13:22', '2021-06-26 11:32:30', NULL),
	(2, 'xmY3T1KrwdYD8rn2IA7OgEnnz5bZ5y-1624730252.jpg', 'asaa SA', 'A sa s', 'SA   sASa sASaAS  AS S AAS AS qs ASasA', 1, 0, '2021-06-26 17:57:32', '2021-06-26 17:57:32', NULL),
	(3, 'zcQhGN0kulhaCyTZ0mvxnNpuXKXZG1-1624730509.jpg', 'DFSDF SA', 'QA wq', 'wsddsa  sassdad swqesqwesqwe', 1, 1, '2021-06-26 18:00:50', '2021-06-26 18:01:49', NULL),
	(4, 'PVpl0OhsErTspsxcZsYDsIADAlzGAG-1624730570.jpg', 'asdasd', 'dasdasdas saswsdaw', 'awsw ewdqwee wqe eqwedwqeeqwwe e qwedqw eqw', 1, 0, '2021-06-26 18:02:50', '2021-06-26 18:02:50', NULL);
/*!40000 ALTER TABLE `cms_home_oric_members` ENABLE KEYS */;

-- Dumping structure for table fyp.cms_home_testimonials
CREATE TABLE IF NOT EXISTS `cms_home_testimonials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_picture` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.cms_home_testimonials: ~3 rows (approximately)
/*!40000 ALTER TABLE `cms_home_testimonials` DISABLE KEYS */;
INSERT INTO `cms_home_testimonials` (`id`, `profile_picture`, `name`, `designation`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'MWBz4f7NLJUjcFoGWVVsN0e3iiYzbs-1632430133.jpg', 'Dr. Rashida R Zohra', 'Director ORIC-JUW', 'To lead in today’s education sector, a researcher is a passionate soul with commitment to serve society through science.  ORIC JUW provides a complete package to the researchers of JUW.', 1, 1, '2021-06-26 11:44:45', '2021-09-23 20:48:53', NULL),
	(2, '5WyvKIvDlg3vdgJuKEuB3gdVyUQV7j-1624719141.jpg', 'Mr. Wajeeh Uddin Ahmed', 'Chancellor JUW', 'Proud of its extraordinary roster of former researchers and its past successes in the research arena, Jinnah for Women (JUW) is unequivocally focused on the future.', 1, 1, '2021-06-26 14:33:43', '2021-09-23 20:52:40', NULL),
	(3, '8h4qdLN2nC05Sx4iQ8FsMOqiw5gyIQ-1624719149.jpg', 'Prof. Dr. Naeem Farooqui', 'Vice chancellor JUW', 'We have state of the art faculties in the field of bio-science, pharmaceutics, business management and media science.The innovative based researches have vast impact on international level.', 1, 1, '2021-06-26 14:34:10', '2021-09-23 20:54:37', NULL);
/*!40000 ALTER TABLE `cms_home_testimonials` ENABLE KEYS */;

-- Dumping structure for table fyp.cms_inquires
CREATE TABLE IF NOT EXISTS `cms_inquires` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` char(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_answer` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.cms_inquires: ~0 rows (approximately)
/*!40000 ALTER TABLE `cms_inquires` DISABLE KEYS */;
INSERT INTO `cms_inquires` (`id`, `name`, `email`, `contact`, `subject`, `message`, `is_answer`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'dwewq', 'faizan.ahmed123.f@gmail.com', '3325774617', 'gfdgf', 'rrer rwerwer rewwer rew', 0, '2021-09-20 16:53:18', '2021-09-20 16:53:18', NULL),
	(2, 'asda', 'faizan.ahmed123.f@gmail.com', '3325774617', 'dasasdas', 'dasdasdsads', 0, '2021-11-02 10:08:28', '2021-11-02 10:08:28', NULL);
/*!40000 ALTER TABLE `cms_inquires` ENABLE KEYS */;

-- Dumping structure for table fyp.cms_news
CREATE TABLE IF NOT EXISTS `cms_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_disabled` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.cms_news: ~1 rows (approximately)
/*!40000 ALTER TABLE `cms_news` DISABLE KEYS */;
INSERT INTO `cms_news` (`id`, `title`, `banner`, `description`, `is_disabled`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(4, 'News', '7m9xix54LdXcSFVpDDhpu1kCVKspL6-1624863965.jpg', 'dcsad  dad aedwar ew wqeqww', 0, 1, 1, '2021-06-27 12:42:12', '2021-06-28 07:06:05', NULL);
/*!40000 ALTER TABLE `cms_news` ENABLE KEYS */;

-- Dumping structure for table fyp.cms_research
CREATE TABLE IF NOT EXISTS `cms_research` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(55) DEFAULT NULL,
  `banner` varchar(55) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_disabled` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table fyp.cms_research: ~0 rows (approximately)
/*!40000 ALTER TABLE `cms_research` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_research` ENABLE KEYS */;

-- Dumping structure for table fyp.event
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule` datetime NOT NULL,
  `mode` enum('Online','Physical') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Physical',
  `location` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_disabled` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.event: ~8 rows (approximately)
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` (`id`, `image`, `title`, `slug`, `description`, `schedule`, `mode`, `location`, `is_disabled`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(10, 'c5u0k6zjDqt50hXjNJlGOOUZqOxOeT-1624789842.jpg', 'Event 1', 'event-1', 'dads dada swseqw  dfeasef edwerdweq  rfewrdweq rqewrrdweq', '2021-11-02 02:05:06', 'Online', 'asdasdas', 0, 1, 4, '2021-06-27 10:30:42', '2021-11-02 09:05:08', NULL),
	(11, 'sJVWgB8fdD5lOMFeUzsKhPyYop9nnl-1626182640.jpg', 'Test', 'test', 'adas dd da dasdas dsdas das dasdasd erqwerqw dedwq weeqwe eqweqweqw ewqeqwe ewe qweqwe eqwqwewq  qweqweqw eqweqweqwe eqweqwewqe eqweqw', '2021-07-13 07:16:37', 'Physical', 'dasddasdas d dasdas adasdasd dadasdas dasdasd', 0, 1, 1, '2021-07-13 13:24:00', '2021-08-18 13:08:47', '2021-08-18 13:08:47'),
	(12, '3TI3cx1zWukmEku2UexXefVBTRYP6p-1629290435.jpg', 'Event 3', 'event-3', 'ddsa  dasdas d aas', '2021-08-20 05:38:03', 'Online', NULL, 0, 1, 0, '2021-08-18 12:40:35', '2021-09-23 17:34:43', '2021-09-23 17:34:43'),
	(13, '7hlYGmGsRr57lc0uS9PEmkeVRnfQXq-1632419533.jpg', 'FPCCI visit', 'fpcci-visit', 'A viist to FPPCI', '2021-11-02 02:04:01', 'Physical', 'Jinnah university', 0, 1, 4, '2021-09-23 17:52:13', '2021-11-02 09:04:04', NULL),
	(14, '9oBDYGdXy8bARXtfsgykBS0YD4VIoA-1632420116.jpg', 'Cultural Exhibition', 'cultural-exhibition', 'Cultural Exhibition At Marriott Hotel Karachi', '2021-09-23 11:00:56', 'Physical', 'Marriott Hotel', 0, 1, 0, '2021-09-23 18:01:56', '2021-10-31 09:09:56', NULL),
	(15, 'ZYVjeCtxdIvN9HoqvCKNw43ZQQgCgV-1632420795.jpg', 'From campus to venture', 'from-campus-to-venture', 'Role f social media', '2021-10-07 11:00:00', 'Physical', 'Universirty campus', 0, 1, 0, '2021-09-23 18:13:16', '2021-10-08 19:14:43', '2021-10-08 19:14:43'),
	(16, 'Xa9uiPgN7e9FzkrRdPWG6xvHrAMU4Y-1632420996.png', 'IBM Workshop', 'ibm-workshop', 'IBM workshop for students', '2021-09-23 11:15:58', 'Online', NULL, 0, 1, 0, '2021-09-23 18:16:36', '2021-10-08 19:10:42', '2021-10-08 19:10:42'),
	(17, 'qncpVsesINobRNDl5auYRLxsB12z1v-1635842798.jpg', 'Test event', 'test-event', 'dassa dasdasdsa', '2021-11-02 03:06:06', 'Physical', 'Karachi.Pakistan', 0, 4, 4, '2021-11-02 08:46:38', '2021-11-02 10:06:08', NULL);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;

-- Dumping structure for table fyp.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table fyp.funding_opportunities
CREATE TABLE IF NOT EXISTS `funding_opportunities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `principle_investigator` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `funding_agency` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_disabled` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.funding_opportunities: ~4 rows (approximately)
/*!40000 ALTER TABLE `funding_opportunities` DISABLE KEYS */;
INSERT INTO `funding_opportunities` (`id`, `title`, `principle_investigator`, `funding_agency`, `department`, `amount`, `is_disabled`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Test 1', 'dasda', NULL, 'SsS S wsS DADASD', NULL, 0, 1, 0, '2021-06-28 18:24:27', '2021-06-28 18:51:28', '2021-06-28 18:51:28'),
	(2, 'Test 1', 'dasda', 'sadsad', 'ADAD', '1', 0, 1, 1, '2021-06-28 18:46:12', '2021-10-31 11:37:29', '2021-10-31 11:37:29'),
	(3, 'Test 1', 'dasda', 'sadsad', NULL, '3', 0, 1, 0, '2021-06-28 18:50:52', '2021-10-31 11:55:11', NULL),
	(4, 'laravel', 'dasda', NULL, 'dsaaasdas', NULL, 1, 1, 0, '2021-06-28 18:57:56', '2021-10-31 11:47:12', NULL);
/*!40000 ALTER TABLE `funding_opportunities` ENABLE KEYS */;

-- Dumping structure for table fyp.gallery
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(20) unsigned NOT NULL,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_disabled` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.gallery: ~5 rows (approximately)
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` (`id`, `event_id`, `image`, `is_disabled`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(10, 10, 'A3Foe7iSzLeeJ4O7NDHkS7RM4tPx7b-1624793219.jpg', 0, 1, 1, '2021-06-27 11:26:59', '2021-06-27 11:57:16', NULL),
	(11, 10, '6cuH2UgOSZFeBv09ZG7MI9WaxeQR3q-1624863517.jpg', 0, 1, 0, '2021-06-28 06:58:37', '2021-06-28 06:58:37', NULL),
	(12, 10, 'f5K7Sl14xYWd3uep2BcoINCQkErhnC-1624863541.jpg', 0, 1, 0, '2021-06-28 06:59:01', '2021-06-28 06:59:01', NULL),
	(13, 10, 'HMQsTbyJ7XtTk3IOS6Y0KV1wetmd1T-1624863553.jpg', 0, 1, 0, '2021-06-28 06:59:13', '2021-06-28 06:59:13', NULL),
	(14, 10, 'uEl3Dqt1RoFXj3MR2DQp3NLiGGvtbr-1624863592.jpg', 1, 1, 0, '2021-06-28 06:59:52', '2021-10-31 11:03:29', NULL);
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;

-- Dumping structure for table fyp.internships
CREATE TABLE IF NOT EXISTS `internships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode` enum('Online','Physical') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Physical',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `duration` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_disabled` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.internships: ~5 rows (approximately)
/*!40000 ALTER TABLE `internships` DISABLE KEYS */;
INSERT INTO `internships` (`id`, `image`, `title`, `slug`, `description`, `company`, `mode`, `location`, `paid`, `duration`, `is_disabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(12, 'eHZo9iEpaZkNlQgqibDHH04f2SQhG2-1632426991.jpg', 'International Projects', 'international-projects', 'Engineering- Computer Diploma', 'Satejinfo Tech', 'Physical', 'fsdfdsfd f fsd', 1, '2021-09-08 - 2021-10-07', 0, '2021-08-18 13:17:28', '2021-09-23 19:56:31', NULL),
	(13, '9WbUtZ3vWR5Z2kx4TvV5fYEJQS6lxI-1632427100.jpg', 'Creative Interns', 'creative-interns', 'Social Media & Communications, Data collection & Analytics', 'Every-Mind Organization', 'Physical', NULL, 1, '2021-09-08 - 2021-10-07', 0, '2021-09-08 16:45:29', '2021-09-23 19:59:05', NULL),
	(14, 'pIZqGdUUlsTodbeSQf6mIDTKLjfYod-1632427388.jpg', 'Job Vacancy', 'job-vacancy', 'BCS - Fresh 1 year of experience', 'Speridian Technology', 'Physical', NULL, 1, '28-09-2021 - 22-10-2021', 0, '2021-09-23 20:03:08', '2021-09-23 20:03:08', NULL),
	(15, 'b5zvOy4tBVyIM4Adxrdhwv37AqFAMG-1632427521.jpg', 'Career Advising & Counselling Officer', 'career-advising-counselling-officer', 'Interested applicants with minimum two year of relevant experience and 16 years of education can send resume', 'PAK - TURK MAARIF', 'Physical', NULL, 1, '04-10-2021 - 11-11-2021', 0, '2021-09-23 20:05:21', '2021-10-08 19:19:50', '2021-10-08 19:19:50'),
	(16, 'pPoF3eJHKrDgujJ44MwZ4LnwxjUWDY-1633721094.png', 'test', 'test', 'test', 'Test Comp', 'Physical', NULL, 0, '09-10-2021 - 10-11-2021', 0, '2021-10-08 19:24:54', '2021-10-31 09:09:33', NULL);
/*!40000 ALTER TABLE `internships` ENABLE KEYS */;

-- Dumping structure for table fyp.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.migrations: ~6 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2019_08_19_000000_create_failed_jobs_table', 1),
	(3, '2021_05_26_083308_create_permission_tables', 1),
	(4, '2021_06_02_183327_create_research_projects_table', 1),
	(5, '2021_06_04_023315_create_notifications_table', 1),
	(6, '2021_06_05_123512_create_upload_samples_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table fyp.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table fyp.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.model_has_roles: ~12 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(3, 'App\\Models\\User', 2),
	(2, 'App\\Models\\User', 3),
	(3, 'App\\Models\\User', 4),
	(2, 'App\\Models\\User', 5),
	(2, 'App\\Models\\User', 6),
	(2, 'App\\Models\\User', 7),
	(2, 'App\\Models\\User', 8),
	(2, 'App\\Models\\User', 9),
	(2, 'App\\Models\\User', 10),
	(2, 'App\\Models\\User', 11),
	(2, 'App\\Models\\User', 12);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table fyp.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.notifications: ~0 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` (`id`, `user_id`, `type`, `message`, `is_read`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 8, 'fyp-project-proposal', ' is send approval request of fyp proposal.', 0, '2021-09-23 21:08:09', '2021-09-23 21:08:09', NULL);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Dumping structure for table fyp.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.permissions: ~55 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(87, 'user-fyp-proposal-list', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(88, 'user-fyp-proposal-create', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(89, 'user-funded-proposal-list', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(90, 'user-funded-proposal-create', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(91, 'user-funded-project-list', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(92, 'user-funded-project-create', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(93, 'user-fyp-project-list', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(94, 'user-fyp-project-create', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(95, 'user-notification-list', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(96, 'user-notification-detail', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(97, 'user-event-list', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(98, 'user-event-create', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(99, 'user-event-update', 'web', '2021-11-02 10:04:26', '2021-11-02 10:04:26'),
	(100, 'user-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(101, 'user-create', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(102, 'user-update', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(103, 'user-delete', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(104, 'role-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(105, 'role-create', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(106, 'role-update', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(107, 'role-delete', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(108, 'admin-notification-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(109, 'admin-notification-detail', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(110, 'admin-notification-delete', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(111, 'upload-sample-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(112, 'upload-sample-delete', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(113, 'inquiry-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(114, 'internship-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(115, 'internship-create', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(116, 'internship-update', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(117, 'internship-delete', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(118, 'event-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(119, 'event-create', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(120, 'event-update', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(121, 'event-delete', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(122, 'fyp-proposal-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(123, 'fyp-proposal-create', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(124, 'fyp-proposal-update', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(125, 'funded-proposal-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(126, 'funded-proposal-create', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(127, 'funded-proposal-update', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(128, 'funded-project-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(129, 'funded-project-create', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(130, 'funded-project-update', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(131, 'fyp-project-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(132, 'fyp-project-create', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(133, 'fyp-project-update', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(134, 'news-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(135, 'news-create', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(136, 'news-update', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(137, 'news-delete', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(138, 'blog-list', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(139, 'blog-create', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(140, 'blog-update', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12'),
	(141, 'blog-delete', 'web', '2021-11-02 10:05:12', '2021-11-02 10:05:12');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table fyp.register_events
CREATE TABLE IF NOT EXISTS `register_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `event_id` int(10) unsigned NOT NULL,
  `status` enum('registered','un-registered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'un-registered',
  `guest_name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitor_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.register_events: ~4 rows (approximately)
/*!40000 ALTER TABLE `register_events` DISABLE KEYS */;
INSERT INTO `register_events` (`id`, `user_id`, `event_id`, `status`, `guest_name`, `guest_email`, `visitor_ip`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, NULL, 11, 'registered', 'Faizan', 'faizan.ahmed123.f@gmail.com', '127.0.0.1', '2021-08-18 10:50:43', '2021-08-18 13:08:47', '2021-08-18 13:08:47'),
	(2, 3, 11, 'registered', NULL, NULL, NULL, '2021-08-18 10:55:23', '2021-08-18 13:08:47', '2021-08-18 13:08:47'),
	(3, 3, 10, 'registered', NULL, NULL, NULL, '2021-08-18 11:04:30', '2021-09-23 18:09:30', '2021-09-23 18:09:30'),
	(4, 8, 13, 'registered', NULL, NULL, NULL, '2021-09-23 21:09:03', '2021-09-23 21:09:03', NULL);
/*!40000 ALTER TABLE `register_events` ENABLE KEYS */;

-- Dumping structure for table fyp.register_interns
CREATE TABLE IF NOT EXISTS `register_interns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `internship_id` int(10) unsigned NOT NULL,
  `status` enum('registered','un-registered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'un-registered',
  `guest_name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitor_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.register_interns: ~5 rows (approximately)
/*!40000 ALTER TABLE `register_interns` DISABLE KEYS */;
INSERT INTO `register_interns` (`id`, `user_id`, `internship_id`, `status`, `guest_name`, `guest_email`, `visitor_ip`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 3, 12, 'registered', NULL, NULL, NULL, '2021-08-18 15:06:30', '2021-08-18 15:10:21', '2021-08-18 15:10:21'),
	(2, NULL, 12, 'registered', 'Faizan', 'faizan.ahmed123.f@gmail.com', '127.0.0.1', '2021-08-19 07:14:11', '2021-08-19 07:21:28', '2021-08-19 07:21:28'),
	(3, 3, 12, 'un-registered', NULL, NULL, NULL, '2021-08-19 07:21:08', '2021-09-08 17:24:50', NULL),
	(4, 3, 13, 'registered', NULL, NULL, NULL, '2021-09-08 17:24:43', '2021-09-08 17:24:43', NULL),
	(5, 8, 13, 'registered', NULL, NULL, NULL, '2021-09-23 21:09:15', '2021-09-23 21:09:15', NULL),
	(6, 3, 16, 'registered', NULL, NULL, NULL, '2021-10-31 12:18:33', '2021-10-31 12:18:33', NULL);
/*!40000 ALTER TABLE `register_interns` ENABLE KEYS */;

-- Dumping structure for table fyp.research_projects
CREATE TABLE IF NOT EXISTS `research_projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `research_proposal_id` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_project` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('fyp','funded') COLLATE utf8mb4_unicode_ci NOT NULL,
  `submission_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.research_projects: ~0 rows (approximately)
/*!40000 ALTER TABLE `research_projects` DISABLE KEYS */;
INSERT INTO `research_projects` (`id`, `user_id`, `research_proposal_id`, `upload_project`, `type`, `submission_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 3, '3', 'research-project-61531f7619700.pdf', 'funded', '2021-09-28', '2021-09-28 13:58:14', '2021-09-28 13:58:14', NULL);
/*!40000 ALTER TABLE `research_projects` ENABLE KEYS */;

-- Dumping structure for table fyp.research_proposals
CREATE TABLE IF NOT EXISTS `research_proposals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `investigator_details_pi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investigator_details_copi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abstract` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `submission_date` date NOT NULL,
  `upload_research` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('fyp','funded') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.research_proposals: ~6 rows (approximately)
/*!40000 ALTER TABLE `research_proposals` DISABLE KEYS */;
INSERT INTO `research_proposals` (`id`, `user_id`, `title`, `investigator_details_pi`, `investigator_details_copi`, `abstract`, `agency`, `amount`, `submission_date`, `upload_research`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 7, 'Research Grants Program', 'Ms Ummay Faseeha', '', 'The Research Grants Program provides support for research projects in the following field: Basic and Applied Sciences, Biotechnology and Informatics, Information Technology, Administrative Sciences and Arts.', 'Ignite', 25000, '2021-09-18', 'research-project-611e42e5db2e6.pdf', 'funded', 'approved', '2021-09-23 19:08:12', '2021-09-23 19:08:12', NULL),
	(2, 11, 'Micropropagation Of Commercially Important Ornamental Plants', 'Dr. Syeda Kahkashan kazmi', '', 'Micropropagation refers to the in vitro multiplication and/or regeneration of plant material under aseptic and controlled environmental conditions to', 'Higher Education Commission.', 25000, '2021-09-16', 'research-project-611e42e5db2e6.pdf', 'funded', 'approved', '2021-09-23 19:10:11', '2021-09-23 19:10:11', NULL),
	(3, 12, 'Synthesis of Dye Intermediates used for the synthesis of industrial dyes', 'Dr. Farzana Naz', '', 'A dye intermediate is the main raw material used for the manufacturing dyestuff. The manufacturing chain of dyes can be traced back to petroleum based products.', 'Higher Education Commission', 30000, '2021-09-23', 'research-project-611e42e5db2e6.pdf', 'funded', 'approved', '2021-09-23 19:11:43', '2021-09-23 19:11:43', NULL),
	(4, 7, 'Impaired Glove', 'Ms. Ummay Faseeha', '', 'converts hand signals into audio output. It helps to reduce the interaction gap between speech impaired', 'Ignite', 76140, '2021-08-03', 'research-project-611e42e5db2e6.pdf', 'funded', 'approved', '2021-09-23 19:15:15', '2021-09-23 19:15:15', NULL),
	(5, 3, 'Toddler Track', 'Ms. Saima Amber', '', 'National track and field competitions usually start for primary school-age children aged six and over,', 'Ignite', 78800, '2021-06-11', 'research-project-611e42e5db2e6.pdf', 'funded', 'pending', '2021-09-23 19:17:28', '2021-09-23 19:17:28', NULL),
	(6, 8, 'From campus to venture', 'Ms Ummay Faseeha', '', 'A dye intermediate is the main raw material used for the manufacturing dyestuff. The manufacturing chain of dyes can be traced back to petroleum based products.', 'Ignite', 25000, '2021-09-23', 'research-project-611e42e5db2e6.pdf', 'fyp', 'pending', '2021-09-23 21:08:09', '2021-09-23 21:08:09', NULL);
/*!40000 ALTER TABLE `research_proposals` ENABLE KEYS */;

-- Dumping structure for table fyp.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_disabled` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.roles: ~5 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `is_disabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'super-admin', 'web', 0, '2021-07-06 13:53:04', '2021-07-06 13:53:04', NULL),
	(2, 'student', 'web', 0, '2021-07-06 13:53:04', '2021-07-06 13:53:04', NULL),
	(3, 'oric-member', 'web', 0, '2021-07-06 13:53:05', '2021-07-06 13:53:05', NULL),
	(4, 'researcher', 'web', 0, '2021-07-06 13:53:05', '2021-07-06 13:53:05', NULL),
	(6, 'focal-person', 'web', 0, '2021-07-06 13:53:05', '2021-07-06 13:53:05', NULL),
	(7, 'faculty', 'web', 0, '2021-10-31 06:56:05', '2021-10-31 08:52:26', NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table fyp.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.role_has_permissions: ~101 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(100, 1),
	(101, 1),
	(102, 1),
	(103, 1),
	(104, 1),
	(105, 1),
	(106, 1),
	(107, 1),
	(108, 1),
	(109, 1),
	(110, 1),
	(111, 1),
	(112, 1),
	(113, 1),
	(114, 1),
	(115, 1),
	(116, 1),
	(117, 1),
	(118, 1),
	(119, 1),
	(120, 1),
	(121, 1),
	(122, 1),
	(123, 1),
	(124, 1),
	(125, 1),
	(126, 1),
	(127, 1),
	(128, 1),
	(129, 1),
	(130, 1),
	(131, 1),
	(132, 1),
	(133, 1),
	(134, 1),
	(135, 1),
	(136, 1),
	(137, 1),
	(138, 1),
	(139, 1),
	(140, 1),
	(141, 1),
	(87, 2),
	(88, 2),
	(89, 2),
	(90, 2),
	(91, 2),
	(92, 2),
	(93, 2),
	(94, 2),
	(95, 2),
	(96, 2),
	(97, 2),
	(87, 3),
	(88, 3),
	(89, 3),
	(90, 3),
	(91, 3),
	(92, 3),
	(93, 3),
	(94, 3),
	(95, 3),
	(96, 3),
	(97, 3),
	(98, 3),
	(99, 3),
	(87, 4),
	(88, 4),
	(89, 4),
	(90, 4),
	(91, 4),
	(92, 4),
	(93, 4),
	(94, 4),
	(95, 4),
	(96, 4),
	(97, 4),
	(87, 6),
	(88, 6),
	(89, 6),
	(90, 6),
	(91, 6),
	(92, 6),
	(93, 6),
	(94, 6),
	(95, 6),
	(96, 6),
	(97, 6),
	(87, 7),
	(88, 7),
	(89, 7),
	(90, 7),
	(91, 7),
	(92, 7),
	(93, 7),
	(94, 7),
	(95, 7),
	(96, 7),
	(97, 7),
	(98, 7),
	(99, 7);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table fyp.upload_samples
CREATE TABLE IF NOT EXISTS `upload_samples` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_disabled` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.upload_samples: ~1 rows (approximately)
/*!40000 ALTER TABLE `upload_samples` DISABLE KEYS */;
INSERT INTO `upload_samples` (`id`, `type`, `name`, `is_disabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'project-proposal-form', 'project-proposal-1635681566.docx', 0, '2021-10-31 11:59:27', '2021-10-31 12:07:58', NULL);
/*!40000 ALTER TABLE `upload_samples` ENABLE KEYS */;

-- Dumping structure for table fyp.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_detail` text COLLATE utf8mb4_unicode_ci,
  `student_rollno` bigint(20) unsigned DEFAULT NULL,
  `student_seatno` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` bigint(20) DEFAULT NULL,
  `gender` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `designation` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expertise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_block` tinyint(4) NOT NULL DEFAULT '0',
  `is_verified` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT '0',
  `updated_by` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fyp.users: ~12 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `father_name`, `cnic`, `email`, `password`, `profile_picture`, `profile_detail`, `student_rollno`, `student_seatno`, `department`, `contact`, `gender`, `dob`, `designation`, `qualification`, `expertise`, `certification`, `joining_date`, `verification_token`, `remember_token`, `is_block`, `is_verified`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Dr. Rashida R', 'Zohra', NULL, '2342423312312', 'admin@fyp.com', '$2y$10$5lczYJxP6Cpj/ydTFDN0Nuv5ut3QBfFgbQSMlBdXYA/GmD2ufi8Ky', '0fnEFnGriQ1632431005.jpg', 'dasdasd', NULL, NULL, NULL, NULL, 'female', '2021-07-06', NULL, NULL, NULL, NULL, '2019-08-21', NULL, '4MRU5NwzZHqJbzHtpRsA5m49Z6c0os7VC6EeyWaE1nvDJNiGScidJxJGJOhn', 0, 1, 0, 1, '2021-07-06 13:53:04', '2021-09-23 21:03:53'),
	(2, 'Aisha', 'Khan', NULL, '2342423442342', 'sajjad.ali@viftech.com.pk', '$2y$10$tqDpuOhJ.4kdiNM.qs0h6.5u1xCNnOdseceE0Z1ZZ4M6Wi4LnUvbK', NULL, 'asa', NULL, NULL, NULL, NULL, 'female', '2021-07-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, '2021-07-07 06:10:32', '2021-09-28 12:17:54'),
	(3, 'Affan', 'Ali', NULL, '1323123123123', 'affan@viftech.com.pk', '$2y$10$wD3DgVlac9LlJrPO0UpgVuOoSdqyFB3Vkbc7ajXePJmBnnlYR5EhG', NULL, 'dasdasd', 24234, '312f', NULL, NULL, 'male', '2021-08-02', NULL, NULL, NULL, NULL, '2021-08-19', NULL, 'BL73Zxx51HaOHDaZnwG6oBKl4Vbq3F1GwVGEmdpkJuI5va1NW5vuXANpEXSr', 0, 1, 1, 1, '2020-07-07 06:38:30', '2021-09-23 17:36:26'),
	(4, 'Faizan', 'AHMED RAZA', NULL, '3412312312312', 'faizan@viftech.com.pk', '$2y$10$5lczYJxP6Cpj/ydTFDN0Nuv5ut3QBfFgbQSMlBdXYA/GmD2ufi8Ky', NULL, NULL, NULL, NULL, NULL, NULL, 'male', '2021-09-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 1, '2021-07-07 06:57:17', '2021-09-23 19:45:18'),
	(5, 'fariha', 'sheikh', 'sheikh', NULL, 'test1@email.com', '$2y$10$QTfxdzZSvum20TEwkMy8BODv2iDD21WQn1/ByMcr63KAFRVDevFde', NULL, NULL, NULL, NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 0, '2021-08-03 11:00:08', '2021-08-03 11:00:33'),
	(6, 'aqsa', 'Khan', NULL, NULL, 'aqsa@fyp.com', '$2y$10$rhhv.QnHmew2PseozhbdiuDoBSqpC2bCER04WnCizs6NV8qfKVv/2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uUWXyITdvfJpEupTIPTi7uRvkJgNLoHWmIwZKeOkLlAYCb2UsU', NULL, 0, 1, NULL, 0, '2021-09-23 17:29:40', '2021-09-23 18:21:05'),
	(7, 'aiman', 'khan', NULL, NULL, 'aiman@gmail.com', '$2y$10$GcqHjFwtnVw8scsJYbsBP.rBC4NK9C6CEQAQjWe688GbJDlWu4QNe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HSzW0pTs8IhVGCGC7JPbfC6u9a66sdU7GaMNUlkDgJSNGS1Vqj', NULL, 0, 1, NULL, 0, '2021-09-23 17:30:49', '2021-09-23 18:21:21'),
	(8, 'Jaweria', 'khan', NULL, NULL, 'jaweria@fyp.com', '$2y$10$icx9lYBZG33Ko9.sfzQHoe0075SUo.NBgP72vxNL3WskuUAcBV1Di', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pqaE0d8byD6vHhQPyfBOR4kMYrnTQTYjaWMV4CZG62MpyxljRm', NULL, 0, 1, NULL, 0, '2021-09-23 17:31:39', '2021-09-23 18:21:11'),
	(9, 'Aqsa', 'Khan', NULL, NULL, 'aqsa00@fyp.com', '$2y$10$Oc7WCGXdN2GrJd.lZmZ/PeQbDo9si6RuwjgPNipbgH.nl1JbwNKV.', NULL, NULL, NULL, NULL, NULL, NULL, 'female', '2021-09-23', NULL, NULL, NULL, NULL, NULL, 'UgvDGA51EaYLJedf7OuEtSUsoeyc4Jyy09qY5zL6dZjbMek8B5', NULL, 0, 1, NULL, 1, '2021-09-23 18:17:50', '2021-09-23 18:28:48'),
	(10, 'mahnoor', 'Khan', NULL, NULL, 'mahnoor00@fyp.com', '$2y$10$Hhhzt.uCWoS.ZConMzp6HO6SwSF6LMslllC5NhbfgRlMV0lbRUxyu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JEubsvDeoj2qMcZWaA7qPyq6goab6aSqYnqJXe1VxCcYbOfbyE', NULL, 0, 1, NULL, 0, '2021-09-23 18:18:40', '2021-09-23 18:18:40'),
	(11, 'Jaweria', 'arif', NULL, NULL, 'jaweria00@fyp.com', '$2y$10$gjoyzt6uyXVhP6xvScxPx.mDNeKc6rp9WJc.iQFIlM9g0CR/izezu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'xlnQ05PUQndLswAPXOMa8DLY2XZBqHjCO3L3tKq9cS5ijO95gY', NULL, 0, 1, NULL, 0, '2021-09-23 18:19:24', '2021-09-23 18:19:24'),
	(12, 'khadija', 'zulfikar', NULL, '6433468997657', 'khadija@fyp.com', '$2y$10$1dQsTE60uXf5L.9KNlC0wOnyVrdS4OIwhLyJFCw/ZFzk1Wm4xtN1a', NULL, NULL, NULL, NULL, 'Computer Science', 98546789976, 'female', '2021-09-23', 'Student', NULL, NULL, NULL, NULL, 'USLFNxWAHXTZCoUQk3YU1rMzh5TSJFQMXGWuf2iYiwUdgs67kp', NULL, 0, 1, 1, 0, '2021-09-23 18:25:32', '2021-09-23 18:25:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
