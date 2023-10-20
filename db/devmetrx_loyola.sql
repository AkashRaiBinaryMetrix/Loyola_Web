-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 20, 2023 at 05:50 AM
-- Server version: 10.1.48-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devmetrx_loyola`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `tittle` varchar(250) NOT NULL,
  `description` text,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `slug`, `tittle`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'about_us', 'About Us', '<p>Test<p>', 'active', '2023-07-13 12:23:37', '2023-08-17 15:42:34', NULL),
(3, 'privacy_policy', 'Privacy Policy', '<p>This privacy policy (\"Privacy Policy\") is applicable to the information made available, the information collected, and the services offered by Loyola University of Chicago (\"Loyola\") directly  through the pages comprising Loyola\'s official website (the \"Website\") (https://www.luc.edu).  By using Loyola\'s Website, you agree to this Privacy Policy.  \n\nLoyola\'s Website includes links to websites of unaffiliated, private third parties. Loyola is not responsible for the content, data collection, or data protection practices of such third party websites. Loyola\'s Privacy Policy does not apply to such third party websites and users access such websites at their own risk.   \n\nLoyola is dedicated to promoting privacy awareness and compliance. This Privacy Policy explains what personal data the Website collects, how it is used, shared, and protected, and how you can obtain further information concerning privacy at Loyola. Loyola will periodically update this Privacy Policy to address new laws, technologies, and information security practices. </p>', 'active', '2023-07-13 12:23:37', '2023-08-17 15:41:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `error_logs`
--

CREATE TABLE `error_logs` (
  `id` int(11) NOT NULL,
  `error` longtext,
  `title` varchar(355) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `error_logs`
--

INSERT INTO `error_logs` (`id`, `error`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Received HTTP status code [401] with message \"This feature is temporarily unavailable\" when getting token credentials.', 'twitter login', '2022-01-31 08:44:18', '2022-01-31 08:44:18'),
(2, 'Received HTTP status code [401] with message \"This feature is temporarily unavailable\" when getting token credentials.', 'twitter login', '2022-01-31 08:46:31', '2022-01-31 08:46:31'),
(3, 'Received HTTP status code [401] with message \"This feature is temporarily unavailable\" when getting token credentials.', 'twitter login', '2022-01-31 08:47:06', '2022-01-31 08:47:06'),
(4, 'Received HTTP status code [401] with message \"This feature is temporarily unavailable\" when getting token credentials.', 'twitter login', '2022-01-31 08:48:23', '2022-01-31 08:48:23'),
(5, 'Received HTTP status code [401] with message \"This feature is temporarily unavailable\" when getting token credentials.', 'twitter login', '2022-01-31 08:49:19', '2022-01-31 08:49:19'),
(6, 'Received HTTP status code [401] with message \"This feature is temporarily unavailable\" when getting token credentials.', 'twitter login', '2022-01-31 08:49:54', '2022-01-31 08:49:54'),
(7, 'Temporary identifier passed back by server does not match that of stored temporary credentials.\n                Potential man-in-the-middle.', 'twitter login', '2022-02-04 14:37:41', '2022-02-04 14:37:41'),
(8, 'Client error: `POST https://graph.facebook.com/v3.3/oauth/access_token` resulted in a `400 Bad Request` response:\n{\"error\":{\"message\":\"Missing authorization code\",\"type\":\"OAuthException\",\"code\":1,\"fbtrace_id\":\"A_ZBX_7-tid6ys6zIuSvI95\" (truncated...)\n', 'twitter login', '2022-08-04 19:29:10', '2022-08-04 19:29:10'),
(9, '', 'twitter login', '2022-08-04 19:29:12', '2022-08-04 19:29:12'),
(10, 'Client error: `POST https://graph.facebook.com/v3.3/oauth/access_token` resulted in a `400 Bad Request` response:\n{\"error\":{\"message\":\"Missing authorization code\",\"type\":\"OAuthException\",\"code\":1,\"fbtrace_id\":\"Adh26--BhVK8M4t75RUb1Ko\" (truncated...)\n', 'twitter login', '2022-08-05 02:12:37', '2022-08-05 02:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_12_05_104343_create_books_table', 1),
(5, '2021_12_21_075835_add_google_id_to_users_table', 2),
(6, '2021_12_21_090512_add_facebook_id_to_users_table', 3),
(7, '2021_12_21_101414_add_user_id_and_provider_user_id_and_provider_to_users', 4),
(8, '2021_12_22_113850_alter_table_users', 5),
(9, '2021_12_23_110331_add_otp_to_users_table', 6),
(10, '2021_12_24_103618_add_experiance_to_users_table', 7),
(11, '2021_12_24_103709_add_skills_to_users_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(100) NOT NULL,
  `type` enum('incoming','upcoming') NOT NULL DEFAULT 'incoming',
  `receiver_id` int(100) NOT NULL,
  `survey_id` bigint(100) DEFAULT NULL,
  `message` text NOT NULL,
  `response` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `receiver_id`, `survey_id`, `message`, `response`, `created_at`, `updated_at`) VALUES
(1, 'incoming', 285, 3, 'Personality behaviour has been added.', '{\"multicast_id\":172983548547504571,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689603455946448%dad3232edad3232e\"}]}', '2023-07-17 08:47:35', '2023-07-17 08:47:35'),
(2, 'incoming', 286, 3, 'Personality behaviour has been added.', '{\"multicast_id\":4289950541250032619,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689603461689270%dad3232edad3232e\"}]}', '2023-07-17 08:47:41', '2023-07-17 08:47:41'),
(3, 'incoming', 285, 4, 'Clouding computing has been added.', '{\"multicast_id\":7113160302683600206,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689603481804759%dad3232edad3232e\"}]}', '2023-07-17 08:48:01', '2023-07-17 08:48:01'),
(4, 'incoming', 286, 4, 'Clouding computing has been added.', '{\"multicast_id\":1476893807950305820,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689603487955783%dad3232edad3232e\"}]}', '2023-07-17 08:48:08', '2023-07-17 08:48:08'),
(5, 'incoming', 247, 5, 'Health and science has been added.', '{\"multicast_id\":3014210999618788017,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689603616469954%dad3232edad3232e\"}]}', '2023-07-17 08:50:16', '2023-07-17 08:50:16'),
(6, 'incoming', 285, 5, 'Health and science has been added.', '{\"multicast_id\":6704139116863503720,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689603622220339%dad3232edad3232e\"}]}', '2023-07-17 08:50:22', '2023-07-17 08:50:22'),
(7, 'incoming', 286, 5, 'Health and science has been added.', '{\"multicast_id\":8586212616787027596,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689603627947974%dad3232edad3232e\"}]}', '2023-07-17 08:50:28', '2023-07-17 08:50:28'),
(8, 'incoming', 247, 6, 'General questions has been added.', '{\"multicast_id\":3134382696594934486,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689604989855899%dad3232edad3232e\"}]}', '2023-07-17 09:13:09', '2023-07-17 09:13:09'),
(9, 'incoming', 286, 6, 'General questions has been added.', '{\"multicast_id\":4183529503646586259,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689604995912038%dad3232edad3232e\"}]}', '2023-07-17 09:13:15', '2023-07-17 09:13:15'),
(10, 'incoming', 287, 6, 'General questions has been added.', '{\"multicast_id\":7086425412324706763,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689605001665958%dad3232edad3232e\"}]}', '2023-07-17 09:13:21', '2023-07-17 09:13:21'),
(11, 'incoming', 247, 7, 'Personality behaviour testing has been added.', '{\"multicast_id\":4603998242148892001,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689606793768734%dad3232edad3232e\"}]}', '2023-07-17 09:43:13', '2023-07-17 09:43:13'),
(12, 'incoming', 286, 7, 'Personality behaviour testing has been added.', '{\"multicast_id\":1400533462577060030,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689606799506915%dad3232edad3232e\"}]}', '2023-07-17 09:43:19', '2023-07-17 09:43:19'),
(13, 'incoming', 287, 7, 'Personality behaviour testing has been added.', '{\"multicast_id\":6834867852938047262,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689606805323167%dad3232edad3232e\"}]}', '2023-07-17 09:43:25', '2023-07-17 09:43:25'),
(14, 'incoming', 247, 8, 'General knowledge has been added.', '{\"multicast_id\":5444207792185370827,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689660624680784%dad3232edad3232e\"}]}', '2023-07-18 00:40:24', '2023-07-18 00:40:24'),
(15, 'incoming', 285, 8, 'General knowledge has been added.', '{\"multicast_id\":2320907768231053945,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689660630784350%dad3232edad3232e\"}]}', '2023-07-18 00:40:30', '2023-07-18 00:40:30'),
(16, 'incoming', 286, 8, 'General knowledge has been added.', '{\"multicast_id\":2431608104686079871,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689660636853783%dad3232edad3232e\"}]}', '2023-07-18 00:40:36', '2023-07-18 00:40:36'),
(17, 'incoming', 287, 8, 'General knowledge has been added.', '{\"multicast_id\":8637862431834527834,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689660642940993%dad3232edad3232e\"}]}', '2023-07-18 00:40:43', '2023-07-18 00:40:43'),
(18, 'incoming', 247, 10, 'Compter questions has been added.', '{\"multicast_id\":7176800351807335314,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689663879508001%dad3232edad3232e\"}]}', '2023-07-18 01:34:39', '2023-07-18 01:34:39'),
(19, 'incoming', 285, 10, 'Compter questions has been added.', '{\"multicast_id\":830289148906701453,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689663885616550%dad3232edad3232e\"}]}', '2023-07-18 01:34:45', '2023-07-18 01:34:45'),
(20, 'incoming', 286, 10, 'Compter questions has been added.', '{\"multicast_id\":2634442642677638038,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689663891714031%dad3232edad3232e\"}]}', '2023-07-18 01:34:51', '2023-07-18 01:34:51'),
(21, 'incoming', 287, 10, 'Compter questions has been added.', '{\"multicast_id\":7305922043975350214,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689663897459784%dad3232edad3232e\"}]}', '2023-07-18 01:34:57', '2023-07-18 01:34:57'),
(22, 'incoming', 247, 11, 'Social media questions has been added.', '{\"multicast_id\":6534003131059520441,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689666582830100%dad3232edad3232e\"}]}', '2023-07-18 02:19:42', '2023-07-18 02:19:42'),
(23, 'incoming', 285, 11, 'Social media questions has been added.', '{\"multicast_id\":1222752594220249684,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689666588569009%dad3232edad3232e\"}]}', '2023-07-18 02:19:48', '2023-07-18 02:19:48'),
(24, 'incoming', 286, 11, 'Social media questions has been added.', '{\"multicast_id\":6287837135590217494,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689666594317634%dad3232edad3232e\"}]}', '2023-07-18 02:19:54', '2023-07-18 02:19:54'),
(25, 'incoming', 287, 11, 'Social media questions has been added.', '{\"multicast_id\":898739630125168794,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689666600062574%dad3232edad3232e\"}]}', '2023-07-18 02:20:00', '2023-07-18 02:20:00'),
(26, 'incoming', 247, 12, 'Personality development has been added.', '{\"multicast_id\":6526550632328212188,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689941365393084%dad3232edad3232e\"}]}', '2023-07-21 06:39:25', '2023-07-21 06:39:25'),
(27, 'incoming', 285, 12, 'Personality development has been added.', '{\"multicast_id\":1651413478425516313,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689941371478692%dad3232edad3232e\"}]}', '2023-07-21 06:39:31', '2023-07-21 06:39:31'),
(28, 'incoming', 286, 12, 'Personality development has been added.', '{\"multicast_id\":8433070327633271419,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689941377585018%dad3232edad3232e\"}]}', '2023-07-21 06:39:37', '2023-07-21 06:39:37'),
(29, 'incoming', 287, 12, 'Personality development has been added.', '{\"multicast_id\":7805282513627360967,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1689941383347052%dad3232edad3232e\"}]}', '2023-07-21 06:39:43', '2023-07-21 06:39:43'),
(30, 'incoming', 285, 9, 'Semantic differential scale has been added.', '{\"multicast_id\":1328922850212712049,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690783039381056%dad3232edad3232e\"}]}', '2023-07-31 00:27:19', '2023-07-31 00:27:19'),
(31, 'incoming', 287, 9, 'Semantic differential scale has been added.', '{\"multicast_id\":8530229903770503645,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690783062811557%dad3232edad3232e\"}]}', '2023-07-31 00:27:42', '2023-07-31 00:27:42'),
(32, 'incoming', 285, 5, 'Health and science has been added.', '{\"multicast_id\":148534433595406172,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690783808268730%dad3232edad3232e\"}]}', '2023-07-31 00:40:08', '2023-07-31 00:40:08'),
(33, 'incoming', 287, 5, 'Health and science has been added.', '{\"multicast_id\":3574313401583299535,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690783831606970%dad3232edad3232e\"}]}', '2023-07-31 00:40:31', '2023-07-31 00:40:31'),
(34, 'incoming', 285, 7, 'Personality behaviour testing has been added.', '{\"multicast_id\":2782559876729148833,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690788442839403%dad3232edad3232e\"}]}', '2023-07-31 01:57:22', '2023-07-31 01:57:22'),
(35, 'incoming', 287, 7, 'Personality behaviour testing has been added.', '{\"multicast_id\":93344117658104517,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690788448611932%dad3232edad3232e\"}]}', '2023-07-31 01:57:28', '2023-07-31 01:57:28'),
(36, 'incoming', 285, 12, 'Personality development has been added.', '{\"multicast_id\":2238643034331592929,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690789482113201%dad3232edad3232e\"}]}', '2023-07-31 02:14:42', '2023-07-31 02:14:42'),
(37, 'incoming', 287, 12, 'Personality development has been added.', '{\"multicast_id\":8777692954730020869,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690789487856917%dad3232edad3232e\"}]}', '2023-07-31 02:14:47', '2023-07-31 02:14:47'),
(38, 'incoming', 289, 12, 'Personality development has been added.', '{\"multicast_id\":5166234866993795606,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690789493576514%dad3232edad3232e\"}]}', '2023-07-31 02:14:53', '2023-07-31 02:14:53'),
(39, 'incoming', 285, 10, 'Compter questions has been added.', '{\"multicast_id\":7348482939862243295,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690789667208177%dad3232edad3232e\"}]}', '2023-07-31 02:17:47', '2023-07-31 02:17:47'),
(40, 'incoming', 287, 10, 'Compter questions has been added.', '{\"multicast_id\":636371581231227473,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690789672919349%dad3232edad3232e\"}]}', '2023-07-31 02:17:52', '2023-07-31 02:17:52'),
(41, 'incoming', 289, 10, 'Compter questions has been added.', '{\"multicast_id\":6105013850998024283,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690789679047829%dad3232edad3232e\"}]}', '2023-07-31 02:17:59', '2023-07-31 02:17:59'),
(42, 'incoming', 285, 12, 'Personality development has been added.', '{\"multicast_id\":685813014436591590,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690789811381319%dad3232edad3232e\"}]}', '2023-07-31 02:20:11', '2023-07-31 02:20:11'),
(43, 'incoming', 287, 12, 'Personality development has been added.', '{\"multicast_id\":7163801963635054139,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690789817301168%dad3232edad3232e\"}]}', '2023-07-31 02:20:17', '2023-07-31 02:20:17'),
(44, 'incoming', 289, 12, 'Personality development has been added.', '{\"multicast_id\":7369291405751131975,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690789823052429%dad3232edad3232e\"}]}', '2023-07-31 02:20:23', '2023-07-31 02:20:23'),
(45, 'incoming', 285, 14, 'Physical has been added.', '{\"multicast_id\":2414314381097650445,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690795640878563%dad3232edad3232e\"}]}', '2023-07-31 03:57:20', '2023-07-31 03:57:20'),
(46, 'incoming', 287, 14, 'Physical has been added.', '{\"multicast_id\":6618377355948741993,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690795646613602%dad3232edad3232e\"}]}', '2023-07-31 03:57:26', '2023-07-31 03:57:26'),
(47, 'incoming', 290, 14, 'Physical has been added.', '{\"multicast_id\":142987086051211220,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690795652742549%dad3232edad3232e\"}]}', '2023-07-31 03:57:32', '2023-07-31 03:57:32'),
(48, 'incoming', 285, 14, 'Physical has been added.', '{\"multicast_id\":8135877376902923341,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690795844267639%dad3232edad3232e\"}]}', '2023-07-31 04:00:44', '2023-07-31 04:00:44'),
(49, 'incoming', 287, 14, 'Physical has been added.', '{\"multicast_id\":7756801793624394351,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690795850458304%dad3232edad3232e\"}]}', '2023-07-31 04:00:50', '2023-07-31 04:00:50'),
(50, 'incoming', 290, 14, 'Physical has been added.', '{\"multicast_id\":982476185888378904,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690795856795422%dad3232edad3232e\"}]}', '2023-07-31 04:00:56', '2023-07-31 04:00:56'),
(51, 'incoming', 285, 14, 'Physical has been added.', '{\"multicast_id\":6819078830325217946,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690795865952369%dad3232edad3232e\"}]}', '2023-07-31 04:01:06', '2023-07-31 04:01:06'),
(52, 'incoming', 287, 14, 'Physical has been added.', '{\"multicast_id\":7960687171183905851,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690795872407598%dad3232edad3232e\"}]}', '2023-07-31 04:01:12', '2023-07-31 04:01:12'),
(53, 'incoming', 290, 14, 'Physical has been added.', '{\"multicast_id\":4929394201240333690,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690795878874763%dad3232edad3232e\"}]}', '2023-07-31 04:01:18', '2023-07-31 04:01:18'),
(54, 'incoming', 285, 13, 'Physical has been added.', '{\"multicast_id\":7255826233734861151,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690795947490776%dad3232edad3232e\"}]}', '2023-07-31 04:02:27', '2023-07-31 04:02:27'),
(55, 'incoming', 287, 13, 'Physical has been added.', '{\"multicast_id\":5180574463409573476,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690795953839681%dad3232edad3232e\"}]}', '2023-07-31 04:02:33', '2023-07-31 04:02:33'),
(56, 'incoming', 290, 13, 'Physical has been added.', '{\"multicast_id\":4295638428025276750,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690795959982283%dad3232edad3232e\"}]}', '2023-07-31 04:02:40', '2023-07-31 04:02:40'),
(57, 'incoming', 285, 3, 'Personality behaviour has been added.', '{\"multicast_id\":3343181971141666577,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690796737173906%dad3232edad3232e\"}]}', '2023-07-31 04:15:37', '2023-07-31 04:15:37'),
(58, 'incoming', 287, 3, 'Personality behaviour has been added.', '{\"multicast_id\":7913528207194766398,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690796743263731%dad3232edad3232e\"}]}', '2023-07-31 04:15:43', '2023-07-31 04:15:43'),
(59, 'incoming', 290, 3, 'Personality behaviour has been added.', '{\"multicast_id\":3854340081917968972,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690796749445147%dad3232edad3232e\"}]}', '2023-07-31 04:15:49', '2023-07-31 04:15:49'),
(60, 'incoming', 285, 9, 'Semantic differential scale has been added.', '{\"multicast_id\":3332295531309075459,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690808994589466%dad3232edad3232e\"}]}', '2023-07-31 07:39:54', '2023-07-31 07:39:54'),
(61, 'incoming', 287, 9, 'Semantic differential scale has been added.', '{\"multicast_id\":2885803641180173249,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690809000985465%dad3232edad3232e\"}]}', '2023-07-31 07:40:01', '2023-07-31 07:40:01'),
(62, 'incoming', 290, 9, 'Semantic differential scale has been added.', '{\"multicast_id\":3321162549596388405,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690809006774019%dad3232edad3232e\"}]}', '2023-07-31 07:40:06', '2023-07-31 07:40:06'),
(63, 'incoming', 285, 38, 'Developement has been added.', '{\"multicast_id\":1526289571472364822,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690809663381694%dad3232edad3232e\"}]}', '2023-07-31 07:51:03', '2023-07-31 07:51:03'),
(64, 'incoming', 287, 38, 'Developement has been added.', '{\"multicast_id\":2154315906213062325,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690809669160769%dad3232edad3232e\"}]}', '2023-07-31 07:51:09', '2023-07-31 07:51:09'),
(65, 'incoming', 290, 38, 'Developement has been added.', '{\"multicast_id\":7361636178066545355,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690809675303598%dad3232edad3232e\"}]}', '2023-07-31 07:51:15', '2023-07-31 07:51:15'),
(66, 'incoming', 285, 39, 'What are the 5 basic geography has been added.', '{\"multicast_id\":4561111572019333586,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690810508815017%dad3232edad3232e\"}]}', '2023-07-31 08:05:08', '2023-07-31 08:05:08'),
(67, 'incoming', 287, 39, 'What are the 5 basic geography has been added.', '{\"multicast_id\":8323342577185115319,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690810514637395%dad3232edad3232e\"}]}', '2023-07-31 08:05:14', '2023-07-31 08:05:14'),
(68, 'incoming', 290, 39, 'What are the 5 basic geography has been added.', '{\"multicast_id\":3926781244013982756,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690810520449109%dad3232edad3232e\"}]}', '2023-07-31 08:05:20', '2023-07-31 08:05:20'),
(69, 'incoming', 285, 40, 'What is clouding computer has been added.', '{\"multicast_id\":1825065206085333101,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690810704463640%dad3232edad3232e\"}]}', '2023-07-31 08:08:24', '2023-07-31 08:08:24'),
(70, 'incoming', 287, 40, 'What is clouding computer has been added.', '{\"multicast_id\":759106897733158601,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690810710324493%dad3232edad3232e\"}]}', '2023-07-31 08:08:30', '2023-07-31 08:08:30'),
(71, 'incoming', 290, 40, 'What is clouding computer has been added.', '{\"multicast_id\":3190676391087448,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690810716224050%dad3232edad3232e\"}]}', '2023-07-31 08:08:36', '2023-07-31 08:08:36'),
(72, 'incoming', 285, 44, 'Departments has been added.', '{\"multicast_id\":8506203900561803661,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690882413990595%dad3232edad3232e\"}]}', '2023-08-01 04:03:34', '2023-08-01 04:03:34'),
(73, 'incoming', 290, 44, 'Departments has been added.', '{\"multicast_id\":6118980647093038362,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-01 04:03:40', '2023-08-01 04:03:40'),
(74, 'incoming', 291, 44, 'Departments has been added.', '{\"multicast_id\":7786271980938657534,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690882426283978%dad3232edad3232e\"}]}', '2023-08-01 04:03:46', '2023-08-01 04:03:46'),
(75, 'incoming', 285, 45, 'Health science and public affairs has been added.', '{\"multicast_id\":5968606731705927360,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690882939668870%dad3232edad3232e\"}]}', '2023-08-01 04:12:19', '2023-08-01 04:12:19'),
(76, 'incoming', 290, 45, 'Health science and public affairs has been added.', '{\"multicast_id\":7547749022219024517,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-01 04:12:26', '2023-08-01 04:12:26'),
(77, 'incoming', 291, 45, 'Health science and public affairs has been added.', '{\"multicast_id\":8356414412712741946,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690882951802386%dad3232edad3232e\"}]}', '2023-08-01 04:12:31', '2023-08-01 04:12:31'),
(78, 'incoming', 285, 46, 'Health science and public affairs new has been added.', '{\"multicast_id\":213598143936225967,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690883084652183%dad3232edad3232e\"}]}', '2023-08-01 04:14:44', '2023-08-01 04:14:44'),
(79, 'incoming', 290, 46, 'Health science and public affairs new has been added.', '{\"multicast_id\":5976502661112081470,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-01 04:14:51', '2023-08-01 04:14:51'),
(80, 'incoming', 291, 46, 'Health science and public affairs new has been added.', '{\"multicast_id\":9164659053728855320,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690883096695687%dad3232edad3232e\"}]}', '2023-08-01 04:14:56', '2023-08-01 04:14:56'),
(81, 'incoming', 285, 47, 'Biology has been added.', '{\"multicast_id\":5854141197574083632,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690883363770535%dad3232edad3232e\"}]}', '2023-08-01 04:19:23', '2023-08-01 04:19:23'),
(82, 'incoming', 290, 47, 'Biology has been added.', '{\"multicast_id\":6078645026099256451,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-01 04:19:30', '2023-08-01 04:19:30'),
(83, 'incoming', 291, 47, 'Biology has been added.', '{\"multicast_id\":8953605265244223330,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690883375800458%dad3232edad3232e\"}]}', '2023-08-01 04:19:35', '2023-08-01 04:19:35'),
(84, 'incoming', 285, 48, 'What are the 4 data structures has been added.', '{\"multicast_id\":4053118875857291351,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690884243984903%dad3232edad3232e\"}]}', '2023-08-01 04:34:04', '2023-08-01 04:34:04'),
(85, 'incoming', 290, 48, 'What are the 4 data structures has been added.', '{\"multicast_id\":7180597522409059635,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-01 04:34:10', '2023-08-01 04:34:10'),
(86, 'incoming', 291, 48, 'What are the 4 data structures has been added.', '{\"multicast_id\":3549543926609339907,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690884256386528%dad3232edad3232e\"}]}', '2023-08-01 04:34:16', '2023-08-01 04:34:16'),
(87, 'incoming', 285, 49, 'Geaography has been added.', '{\"multicast_id\":4562895078249199987,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690884499592632%dad3232edad3232e\"}]}', '2023-08-01 04:38:19', '2023-08-01 04:38:19'),
(88, 'incoming', 290, 49, 'Geaography has been added.', '{\"multicast_id\":6255056730038987578,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-01 04:38:25', '2023-08-01 04:38:25'),
(89, 'incoming', 291, 49, 'Geaography has been added.', '{\"multicast_id\":5989413962389941520,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690884512169091%dad3232edad3232e\"}]}', '2023-08-01 04:38:32', '2023-08-01 04:38:32'),
(90, 'incoming', 285, 50, 'Health sciences and publics has been added.', '{\"multicast_id\":7961836905402246436,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690970999741022%dad3232edad3232e\"}]}', '2023-08-02 04:39:59', '2023-08-02 04:39:59'),
(91, 'incoming', 290, 50, 'Health sciences and publics has been added.', '{\"multicast_id\":6498749791906649858,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-02 04:40:05', '2023-08-02 04:40:05'),
(92, 'incoming', 293, 50, 'Health sciences and publics has been added.', '{\"multicast_id\":6994770947016969829,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690971011765065%dad3232edad3232e\"}]}', '2023-08-02 04:40:11', '2023-08-02 04:40:11'),
(93, 'incoming', 285, 51, 'Why cloud computing? has been added.', '{\"multicast_id\":6244175180117403260,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690971487260652%dad3232edad3232e\"}]}', '2023-08-02 04:48:07', '2023-08-02 04:48:07'),
(94, 'incoming', 290, 51, 'Why cloud computing? has been added.', '{\"multicast_id\":2221662100517093702,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-02 04:48:13', '2023-08-02 04:48:13'),
(95, 'incoming', 293, 51, 'Why cloud computing? has been added.', '{\"multicast_id\":7986914710712282180,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690971500086990%dad3232edad3232e\"}]}', '2023-08-02 04:48:20', '2023-08-02 04:48:20'),
(96, 'incoming', 285, 52, 'Who uses cloud computing? has been added.', '{\"multicast_id\":8244433505625372904,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690971744937748%dad3232edad3232e\"}]}', '2023-08-02 04:52:25', '2023-08-02 04:52:25'),
(97, 'incoming', 290, 52, 'Who uses cloud computing? has been added.', '{\"multicast_id\":2532235716251721442,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-02 04:52:31', '2023-08-02 04:52:31'),
(98, 'incoming', 293, 52, 'Who uses cloud computing? has been added.', '{\"multicast_id\":7340656499963092974,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690971757562082%dad3232edad3232e\"}]}', '2023-08-02 04:52:37', '2023-08-02 04:52:37'),
(99, 'incoming', 285, 54, 'Grooming has been added.', '{\"multicast_id\":5314985024559695734,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-02 09:31:45', '2023-08-02 09:31:45'),
(100, 'incoming', 290, 54, 'Grooming has been added.', '{\"multicast_id\":637057556794918737,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-02 09:31:52', '2023-08-02 09:31:52'),
(101, 'incoming', 293, 54, 'Grooming has been added.', '{\"multicast_id\":8221749601631922427,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690988518487099%dad3232edad3232e\"}]}', '2023-08-02 09:31:58', '2023-08-02 09:31:58'),
(102, 'incoming', 294, 54, 'Grooming has been added.', '{\"multicast_id\":6976392391494933686,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1690988524830425%dad3232edad3232e\"}]}', '2023-08-02 09:32:04', '2023-08-02 09:32:04'),
(103, 'incoming', 285, 7, 'Personality behaviour testing has been added.', '{\"multicast_id\":8093554328316281790,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-03 01:27:18', '2023-08-03 01:27:18'),
(104, 'incoming', 290, 7, 'Personality behaviour testing has been added.', '{\"multicast_id\":4215893341668748675,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-03 01:27:24', '2023-08-03 01:27:24'),
(105, 'incoming', 293, 7, 'Personality behaviour testing has been added.', '{\"multicast_id\":1828152346023155005,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1691045850608435%dad3232edad3232e\"}]}', '2023-08-03 01:27:30', '2023-08-03 01:27:30'),
(106, 'incoming', 294, 7, 'Personality behaviour testing has been added.', '{\"multicast_id\":6643843572294400476,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1691045856341639%dad3232edad3232e\"}]}', '2023-08-03 01:27:36', '2023-08-03 01:27:36'),
(107, 'incoming', 285, 55, 'Clouding has been added.', '{\"multicast_id\":5901055931916084504,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-03 03:58:49', '2023-08-03 03:58:49'),
(108, 'incoming', 290, 55, 'Clouding has been added.', '{\"multicast_id\":8942140955279681703,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-03 03:58:55', '2023-08-03 03:58:55'),
(109, 'incoming', 294, 55, 'Clouding has been added.', '{\"multicast_id\":4514649111108801890,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1691054940892784%dad3232edad3232e\"}]}', '2023-08-03 03:59:00', '2023-08-03 03:59:00'),
(110, 'incoming', 295, 55, 'Clouding has been added.', '{\"multicast_id\":2826223653416117647,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1691054946633284%dad3232edad3232e\"}]}', '2023-08-03 03:59:06', '2023-08-03 03:59:06'),
(111, 'incoming', 285, 56, 'What are the 4 data structuress has been added.', '{\"multicast_id\":6115573098812668276,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-03 04:24:04', '2023-08-03 04:24:04'),
(112, 'incoming', 290, 56, 'What are the 4 data structuress has been added.', '{\"multicast_id\":1213706708750764067,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-03 04:24:10', '2023-08-03 04:24:10'),
(113, 'incoming', 293, 56, 'What are the 4 data structuress has been added.', '{\"multicast_id\":2017489984820528381,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1691056456316723%dad3232edad3232e\"}]}', '2023-08-03 04:24:16', '2023-08-03 04:24:16'),
(114, 'incoming', 294, 56, 'What are the 4 data structuress has been added.', '{\"multicast_id\":6386798542046551233,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1691056462405476%dad3232edad3232e\"}]}', '2023-08-03 04:24:22', '2023-08-03 04:24:22'),
(115, 'incoming', 285, 57, 'History questions has been added.', '{\"multicast_id\":6679337804762780951,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-03 04:29:51', '2023-08-03 04:29:51'),
(116, 'incoming', 290, 57, 'History questions has been added.', '{\"multicast_id\":1862263009085139042,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-08-03 04:29:57', '2023-08-03 04:29:57'),
(117, 'incoming', 293, 57, 'History questions has been added.', '{\"multicast_id\":6771997690374700779,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1691056802873163%dad3232edad3232e\"}]}', '2023-08-03 04:30:02', '2023-08-03 04:30:02'),
(118, 'incoming', 294, 57, 'History questions has been added.', '{\"multicast_id\":6538282294411959548,\"success\":1,\"failure\":0,\"canonical_ids\":0,\"results\":[{\"message_id\":\"0:1691056808594797%dad3232edad3232e\"}]}', '2023-08-03 04:30:08', '2023-08-03 04:30:08'),
(119, 'incoming', 285, 58, 'A midnight ride through time has been added.', '{\"multicast_id\":6333045900234525134,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-10-10 02:46:24', '2023-10-10 02:46:24'),
(120, 'incoming', 290, 58, 'A midnight ride through time has been added.', '{\"multicast_id\":3217076702350146725,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-10-10 02:46:30', '2023-10-10 02:46:30'),
(121, 'incoming', 293, 58, 'A midnight ride through time has been added.', '{\"multicast_id\":3688379102348482826,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-10-10 02:46:36', '2023-10-10 02:46:36'),
(122, 'incoming', 294, 58, 'A midnight ride through time has been added.', '{\"multicast_id\":8245782108903391464,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-10-10 02:46:42', '2023-10-10 02:46:42'),
(123, 'incoming', 285, 59, 'Connecting you to opportunity has been added.', '{\"multicast_id\":8126847230281771922,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-10-10 03:06:15', '2023-10-10 03:06:15'),
(124, 'incoming', 290, 59, 'Connecting you to opportunity has been added.', '{\"multicast_id\":4255986328868781390,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-10-10 03:06:21', '2023-10-10 03:06:21'),
(125, 'incoming', 293, 59, 'Connecting you to opportunity has been added.', '{\"multicast_id\":971374509209255286,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-10-10 03:06:27', '2023-10-10 03:06:27'),
(126, 'incoming', 294, 59, 'Connecting you to opportunity has been added.', '{\"multicast_id\":7953154709451905535,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-10-10 03:06:33', '2023-10-10 03:06:33'),
(127, 'incoming', 285, 60, 'Program details has been added.', '{\"multicast_id\":6921700346034269267,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-10-10 03:17:07', '2023-10-10 03:17:07'),
(128, 'incoming', 290, 60, 'Program details has been added.', '{\"multicast_id\":9166047278470251989,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-10-10 03:17:13', '2023-10-10 03:17:13'),
(129, 'incoming', 293, 60, 'Program details has been added.', '{\"multicast_id\":1371265875907892411,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-10-10 03:17:19', '2023-10-10 03:17:19'),
(130, 'incoming', 294, 60, 'Program details has been added.', '{\"multicast_id\":7601645052150106325,\"success\":0,\"failure\":1,\"canonical_ids\":0,\"results\":[{\"error\":\"NotRegistered\"}]}', '2023-10-10 03:17:25', '2023-10-10 03:17:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `image` longtext,
  `published_date` date NOT NULL,
  `is_published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `category_id`, `heading`, `description`, `status`, `image`, `published_date`, `is_published`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 3, 'Personality behaviour', 'Personality behaviour', 'inactive', 'https://binarymetrix-dev.com/loyola/public/survey/personality-behaviour997.png', '2023-07-17', 'Yes', '2023-07-17 08:45:14', '2023-07-31 04:17:06', NULL),
(4, 8, 'Clouding computing', 'Clouding computing', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/clouding-computing908.jpg', '2023-07-17', 'Yes', '2023-07-17 08:46:31', '2023-07-17 08:47:56', NULL),
(5, 7, 'Health and science', 'What is the meaning of health and science?', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/health-and-science957.jpg', '2023-07-19', 'Yes', '2023-07-17 08:49:15', '2023-07-31 02:01:17', NULL),
(6, 8, 'General questions', 'Social science mcq with answers for teacher eligibility test –', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/general-questions470.jpg', '2023-07-19', 'Yes', '2023-07-17 09:12:28', '2023-07-18 00:23:26', NULL),
(7, 3, 'Personality behaviour testing', 'Personality behaviour testing', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/personality-behaviour-testing172.jpg', '2023-07-17', 'Yes', '2023-07-17 09:41:39', '2023-08-03 01:27:03', NULL),
(8, 8, 'General knowledge', 'General knowledge', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/general-knowledge399.png', '2023-07-18', 'Yes', '2023-07-18 00:36:07', '2023-07-18 00:40:18', NULL),
(9, 7, 'Semantic differential scale', 'The semantic differential scale question asks a person to rate a product, brand, or company on a seven-point rating scale.', 'inactive', 'https://binarymetrix-dev.com/loyola/public/survey/semantic-differential-scale936.png', '2023-07-18', 'Yes', '2023-07-18 01:28:24', '2023-07-31 07:39:37', NULL),
(10, 6, 'Compter questions', 'Which device is used to input data into a computer?', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/compter-questions858.png', '2023-07-18', 'Yes', '2023-07-18 01:33:48', '2023-07-31 02:16:56', NULL),
(11, 1, 'Social media questions', 'Ultimate social science', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/social-media-questions464.png', '2023-07-18', 'Yes', '2023-07-18 02:17:37', '2023-07-18 02:19:36', NULL),
(12, 3, 'Personality development', 'Personality development refers to the process by which the organized thought and behavior patterns that make up a person\'s unique personality emerge over time. many factors influence personality, including genetics and environment, how we were parented, a', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/807personality-development.jpg', '2023-07-21', 'Yes', '2023-07-21 06:36:39', '2023-07-31 03:49:30', NULL),
(38, 3, 'Developement', 'What is developement', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/developement479.jpg', '2023-07-31', 'Yes', '2023-07-31 07:50:08', '2023-07-31 07:50:47', NULL),
(39, 10, 'What are the 5 basic geography', 'Geographers study the processes that cause changes like these. to help you understand how geographers think about the world, consider geography\'s five themes—location, place, region, movement, and human-environment interaction.', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/what-are-the-5-basic-geography444.jpg', '2023-07-31', 'Yes', '2023-07-31 08:03:54', '2023-07-31 08:04:53', NULL),
(40, 5, 'What is clouding computer', 'Physical education, often abbreviated to phys ed. or p.e., is a subject taught in schools around the world.', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/what-is-clouding-computer202.png', '2023-08-01', 'Yes', '2023-07-31 08:05:57', '2023-07-31 08:08:08', NULL),
(41, 5, 'Learning', 'What isdevelopement', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/learning163.jpg', '2023-08-01', 'Yes', '2023-08-01 02:32:19', '2023-08-01 02:34:35', NULL),
(42, 8, 'General', 'General questions', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/general343.jpg', '2023-08-01', 'Yes', '2023-08-01 03:42:42', '2023-08-01 03:45:34', NULL),
(43, 1, 'Kk', 'Kk', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/kk876.png', '2023-08-17', 'Yes', '2023-08-01 03:51:01', '2023-08-01 03:59:41', NULL),
(44, 6, 'Departments', 'Departments', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/departments333.png', '2023-08-01', 'Yes', '2023-08-01 04:00:07', '2023-08-01 04:03:15', NULL),
(45, 7, 'Health science and public affairs', 'Health science and public affairs', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/health-science-and-public-affairs486.png', '2023-08-01', 'Yes', '2023-08-01 04:08:52', '2023-08-01 04:12:04', NULL),
(46, 7, 'Health science and public affairs new', 'Health science and public affairs new new', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/health-science-and-public-affairs-new696.png', '2023-08-01', 'Yes', '2023-08-01 04:13:33', '2023-08-01 04:14:29', NULL),
(47, 11, 'Biology', 'Bilogu detail', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/biology139.jpg', '2023-08-01', 'Yes', '2023-08-01 04:16:56', '2023-08-01 04:19:55', NULL),
(48, 14, 'What are the 4 data structures', 'What are the 4 data structures', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/what-are-the-4-data-structures168.png', '2023-08-01', 'Yes', '2023-08-01 04:32:35', '2023-08-01 04:33:48', NULL),
(49, 10, 'Geaography', 'Geography details', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/geaography627.png', '2023-08-01', 'Yes', '2023-08-01 04:37:08', '2023-08-01 04:38:03', NULL),
(50, 7, 'Health sciences and publics', 'Health sciences and publics', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/721health-sciences-and-publics.jpg', '2023-08-02', 'Yes', '2023-08-02 04:33:42', '2023-08-02 04:39:44', NULL),
(51, 10, 'Why cloud computing?', 'Why cloud computing?', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/why-cloud-computing563.jpg', '2023-08-02', 'Yes', '2023-08-02 04:46:21', '2023-08-02 04:47:51', NULL),
(52, 10, 'Who uses cloud', 'What is cloud computing', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/831who-uses-cloud.png', '2023-08-02', 'Yes', '2023-08-02 04:50:49', '2023-08-02 04:54:02', NULL),
(53, 2, 'Science technology', 'Explore the latest questions and answers in aeronautics, and find aeronautics experts.', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/science-technology135.jpg', '2023-08-04', 'No', '2023-08-02 09:26:30', '2023-08-02 09:26:30', NULL),
(54, 3, 'Grooming', 'Need to gather the opinions and attitudes of potential  groomers', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/grooming831.jpg', '2023-08-02', 'Yes', '2023-08-02 09:30:24', '2023-08-02 09:31:27', NULL),
(55, 7, 'Clouding', 'Clouding', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/clouding604.png', '2023-08-03', 'Yes', '2023-08-03 03:57:24', '2023-08-03 03:58:34', NULL),
(56, 14, 'What are the 4 data structuress', 'What is developements', 'inactive', 'https://binarymetrix-dev.com/loyola/public/survey/214what-are-the-4-data-structuress.png', '2023-10-19', 'Yes', '2023-08-03 04:23:22', '2023-10-10 03:29:50', NULL),
(57, 15, 'History questions', 'History questions', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/history-questions877.jpg', '2023-08-03', 'Yes', '2023-08-03 04:28:59', '2023-08-03 04:29:36', NULL),
(58, 16, 'A midnight ride through time', 'Loyola history professor turns chicago\'s streets into a classroom on wheels for a night under the stars.', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/a-midnight-ride-through-time471.jpg', '2023-10-19', 'Yes', '2023-10-10 02:41:40', '2023-10-10 02:46:06', NULL),
(59, 17, 'Connecting you to opportunity', 'Explore the many ways you can connect to your peers online or in-person', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/connecting-you-to-opportunity373.png', '2023-10-19', 'Yes', '2023-10-10 03:01:41', '2023-10-10 03:05:58', NULL),
(60, 18, 'Program details', 'Undergraduate majors undergraduate minors adult continuing education pre-professional programs', 'active', 'https://binarymetrix-dev.com/loyola/public/survey/program-details415.jpg', '2023-10-19', 'Yes', '2023-10-10 03:13:03', '2023-10-10 03:16:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `survey_categories`
--

CREATE TABLE `survey_categories` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_categories`
--

INSERT INTO `survey_categories` (`id`, `image`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'social.456png', 'Social', 'active', '2023-07-14 09:28:02', '2023-07-14 09:28:02', NULL),
(2, 'science.116jpg', 'Science', 'active', '2023-07-14 09:48:51', '2023-07-14 09:48:51', NULL),
(3, 'personality-development.411jpg', 'Personality development', 'active', '2023-07-14 09:49:37', '2023-07-17 12:07:39', NULL),
(4, 'deploy-globally-in-minutes.618png', 'Deploy globally in minutes', 'active', '2023-07-14 13:23:38', '2023-07-14 13:23:38', NULL),
(5, 'training-and-development.894png', 'Training and development', 'active', '2023-07-17 07:28:34', '2023-07-17 12:00:40', NULL),
(6, 'departments-and-programs.188jpg', 'Departments and programs', 'active', '2023-07-17 07:52:46', '2023-07-17 07:52:46', NULL),
(7, 'health-sciences-and-publics.416png', 'Health sciences and publics', 'active', '2023-07-17 07:53:30', '2023-07-17 09:49:47', NULL),
(8, 'general.198png', 'General', 'active', '2023-07-17 12:59:10', '2023-07-17 12:59:10', NULL),
(9, 'politics.690png', 'Politics', 'active', '2023-07-17 13:56:42', '2023-07-17 13:56:42', NULL),
(10, 'geography.726png', 'Geography', 'active', '2023-07-31 07:31:51', '2023-07-31 07:31:51', NULL),
(11, 'biology.261png', 'Biology', 'active', '2023-07-31 07:32:16', '2023-07-31 07:32:16', NULL),
(12, 'physical.725jpg', 'Physical', 'active', '2023-07-31 07:32:55', '2023-07-31 09:18:22', NULL),
(13, 'dddd.370png', 'Dddd', 'active', '2023-07-31 12:35:59', '2023-07-31 12:35:59', NULL),
(14, 'data-structure.648png', 'Data structure', 'active', '2023-08-01 10:01:41', '2023-08-01 10:01:41', NULL),
(15, 'historical.994png', 'Historical', 'active', '2023-08-03 09:58:04', '2023-08-03 09:58:04', NULL),
(16, 'student-life.631png', 'Student life', 'active', '2023-10-10 08:08:49', '2023-10-10 08:08:49', NULL),
(17, 'networking.320png', 'Networking', 'active', '2023-10-10 08:30:06', '2023-10-10 08:30:06', NULL),
(18, 'programs.878jpg', 'Programs', 'active', '2023-10-10 08:42:02', '2023-10-10 08:42:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `name` varchar(255) DEFAULT NULL,
  `type` enum('radio','checkbox','input') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_questions`
--

INSERT INTO `survey_questions` (`id`, `survey_id`, `status`, `name`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 3, 'active', 'Describe your behavior in few words?', 'input', '2023-07-17 08:46:06', '2023-07-17 08:46:06', NULL),
(8, 3, 'active', 'Are you shy person?', 'radio', '2023-07-17 08:46:34', '2023-07-17 08:46:34', NULL),
(9, 4, 'active', 'How does clouding work?', 'radio', '2023-07-17 08:47:00', '2023-07-17 08:47:00', NULL),
(10, 3, 'active', 'What are your hobbies?', 'checkbox', '2023-07-17 08:47:09', '2023-07-17 08:47:09', NULL),
(11, 4, 'active', 'Why use cloud computing?', 'checkbox', '2023-07-17 08:47:26', '2023-07-17 08:47:26', NULL),
(12, 4, 'active', 'What is the 4 types of clouds computer?', 'input', '2023-07-17 08:47:51', '2023-07-17 08:47:51', NULL),
(13, 5, 'active', 'What is the relationship between health and science?', 'radio', '2023-07-17 08:49:37', '2023-07-17 08:49:37', NULL),
(14, 5, 'active', 'What is science and study of health called?', 'input', '2023-07-17 08:49:52', '2023-07-17 08:49:52', NULL),
(15, 5, 'active', 'What is called health?', 'checkbox', '2023-07-17 08:50:06', '2023-07-17 08:50:06', NULL),
(16, 6, 'active', 'On 5 april 2022, who was appointed as the chairman of the union public service commission?', 'radio', '2023-07-17 09:12:42', '2023-07-17 09:12:42', NULL),
(17, 6, 'active', 'Q :  which indian religious festival has recently been included in the representative list of intangible cultural heritage of humanity by unesco, an organisation of the united nations?', 'checkbox', '2023-07-17 09:12:58', '2023-07-17 09:12:58', NULL),
(18, 7, 'active', 'Are you a shy person?', 'radio', '2023-07-17 09:42:58', '2023-07-17 09:42:58', NULL),
(19, 8, 'active', 'What country has the highest life expectancy? hong kong', 'radio', '2023-07-18 00:39:47', '2023-07-18 00:39:47', NULL),
(20, 8, 'active', 'Where would you be if you were standing on the spanish steps?', 'checkbox', '2023-07-18 00:39:58', '2023-07-18 00:39:58', NULL),
(21, 8, 'active', 'Which language has the more native speakers: english or spanish? spanish', 'input', '2023-07-18 00:40:11', '2023-07-18 00:40:11', NULL),
(22, 9, 'active', '7. constant sum survey questions', 'radio', '2023-07-18 01:28:57', '2023-07-18 01:28:57', NULL),
(23, 9, 'active', 'Demographic survey questions', 'checkbox', '2023-07-18 01:29:16', '2023-07-18 01:29:16', NULL),
(24, 10, 'active', 'Which device is used to input data into a computer?', 'radio', '2023-07-18 01:34:07', '2023-07-18 01:34:07', NULL),
(25, 10, 'active', 'Which component of a computer is responsible for storing data permanently?', 'checkbox', '2023-07-18 01:34:22', '2023-07-18 01:34:22', NULL),
(26, 11, 'active', 'Which country among the following is a developing country?', 'radio', '2023-07-18 02:18:08', '2023-07-18 02:18:08', NULL),
(27, 11, 'active', 'The main feature to recognize a developing economy is \"low per capita income.\"', 'checkbox', '2023-07-18 02:18:36', '2023-07-18 02:18:36', NULL),
(28, 11, 'active', 'What is the form of economy in developing economy countries?', 'input', '2023-07-18 02:19:00', '2023-07-18 02:19:00', NULL),
(29, 12, 'active', 'What are the 5 keys of personality development?', 'radio', '2023-07-21 06:37:48', '2023-07-21 06:37:48', NULL),
(30, 12, 'active', 'What are the 6 components of personality?', 'checkbox', '2023-07-21 06:38:34', '2023-07-21 06:38:34', NULL),
(31, 12, 'active', 'What are the 4 elements of personality?', 'input', '2023-07-21 06:38:53', '2023-07-21 06:38:53', NULL),
(32, 14, 'active', 'What is the significance of physical education?', 'radio', '2023-07-31 03:55:56', '2023-07-31 03:55:56', NULL),
(33, 14, 'active', 'What are the 4 types of physical education?', 'checkbox', '2023-07-31 03:56:38', '2023-07-31 03:56:38', NULL),
(34, 14, 'active', 'What is physical education pdf?', 'input', '2023-07-31 03:56:57', '2023-07-31 03:56:57', NULL),
(35, 13, 'active', 'What are the 4 types of physical education?', 'radio', '2023-07-31 04:02:05', '2023-07-31 04:02:05', NULL),
(36, 38, 'active', 'What is personality development?', 'input', '2023-07-31 07:50:37', '2023-07-31 07:50:37', NULL),
(37, 39, 'active', 'What are the two types of geography?', 'radio', '2023-07-31 08:04:36', '2023-07-31 08:04:36', NULL),
(38, 40, 'active', 'What is clouding in computing?', 'input', '2023-07-31 08:07:59', '2023-07-31 08:07:59', NULL),
(39, 41, 'active', 'How long does the average person spend on social media per day?', 'radio', '2023-08-01 02:33:43', '2023-08-01 02:33:43', NULL),
(40, 41, 'active', 'What is the fastest growing social media platform?', 'checkbox', '2023-08-01 02:34:05', '2023-08-01 02:34:05', NULL),
(41, 41, 'active', 'What’s the best time to post on social media?', 'input', '2023-08-01 02:34:21', '2023-08-01 02:34:21', NULL),
(42, 42, 'active', 'Who is father of all subjects?', 'radio', '2023-08-01 03:44:27', '2023-08-01 03:44:27', NULL),
(43, 42, 'active', 'Which book is general knowledge?', 'checkbox', '2023-08-01 03:45:14', '2023-08-01 03:45:14', NULL),
(44, 42, 'active', 'Which site is best for gk?', 'input', '2023-08-01 03:45:29', '2023-08-01 03:45:29', NULL),
(45, 43, 'active', 'Kk', 'radio', '2023-08-01 03:51:23', '2023-08-01 03:51:23', NULL),
(46, 44, 'active', 'What is development in economy?', 'radio', '2023-08-01 04:02:01', '2023-08-01 04:02:01', NULL),
(47, 44, 'active', 'What are the 3 characteristics of development class 10 economics?', 'radio', '2023-08-01 04:03:00', '2023-08-01 04:03:00', NULL),
(48, 45, 'active', 'How is current economy?', 'radio', '2023-08-01 04:10:05', '2023-08-01 04:10:05', NULL),
(49, 45, 'active', 'How is current economy affecting your life?', 'checkbox', '2023-08-01 04:10:52', '2023-08-01 04:10:52', NULL),
(50, 45, 'active', 'Describe current economy in few words?', 'input', '2023-08-01 04:11:23', '2023-08-01 04:11:23', NULL),
(51, 46, 'active', 'Question 1', 'radio', '2023-08-01 04:13:50', '2023-08-01 04:13:50', NULL),
(52, 46, 'active', 'Question 2', 'checkbox', '2023-08-01 04:14:05', '2023-08-01 04:14:05', NULL),
(53, 46, 'active', 'Question 3', 'input', '2023-08-01 04:14:18', '2023-08-01 04:14:18', NULL),
(54, 47, 'active', 'What are some good biology questions?', 'radio', '2023-08-01 04:17:47', '2023-08-01 04:17:47', NULL),
(55, 47, 'active', 'What are the basic biology questions?', 'checkbox', '2023-08-01 04:18:22', '2023-08-01 04:18:22', NULL),
(56, 47, 'active', 'These two huge questions have been subdivided into six general questions scrutinized by developmental biologists:', 'input', '2023-08-01 04:18:44', '2023-08-01 04:18:44', NULL),
(57, 48, 'active', 'What are the 5 types of data structures?', 'radio', '2023-08-01 04:33:07', '2023-08-01 04:33:07', NULL),
(58, 48, 'active', 'What is a data structure in c?', 'checkbox', '2023-08-01 04:33:24', '2023-08-01 04:33:24', NULL),
(59, 48, 'active', 'Who is father of biology?', 'input', '2023-08-01 04:33:39', '2023-08-01 04:33:39', NULL),
(60, 49, 'active', 'What is geography', 'radio', '2023-08-01 04:37:41', '2023-08-01 04:37:41', NULL),
(61, 49, 'active', 'Geaography', 'checkbox', '2023-08-01 04:37:56', '2023-08-01 04:37:56', NULL),
(62, 50, 'active', 'What is the best health description?', 'radio', '2023-08-02 04:38:10', '2023-08-02 04:38:10', NULL),
(63, 50, 'active', 'What are the 5 definitions of health?', 'checkbox', '2023-08-02 04:38:58', '2023-08-02 04:38:58', NULL),
(64, 50, 'active', 'What is health in one paragraph?', 'input', '2023-08-02 04:39:14', '2023-08-02 04:39:14', NULL),
(65, 51, 'active', 'Why cloud computing?', 'radio', '2023-08-02 04:47:09', '2023-08-02 04:47:09', NULL),
(66, 51, 'active', 'What is cloud computing with example?', 'checkbox', '2023-08-02 04:47:30', '2023-08-02 04:47:30', NULL),
(67, 52, 'active', 'Why is it called the cloud?', 'radio', '2023-08-02 04:51:17', '2023-08-02 04:51:17', NULL),
(68, 52, 'active', 'What is data cloud?', 'input', '2023-08-02 04:51:47', '2023-08-02 04:51:47', NULL),
(69, 54, 'active', 'Are you handsome person?', 'radio', '2023-08-02 09:31:15', '2023-08-02 09:31:15', NULL),
(70, 55, 'active', 'Which type off clouding', 'radio', '2023-08-03 03:57:57', '2023-08-03 03:57:57', NULL),
(71, 56, 'active', 'What is the nature of intelligence?', 'radio', '2023-08-03 04:23:39', '2023-08-03 04:23:39', NULL),
(72, 57, 'active', 'What is history 5 points?', 'checkbox', '2023-08-03 04:29:30', '2023-08-03 04:29:30', NULL),
(73, 58, 'active', 'The russian invasion of ukraine & the geopolitics of gender', 'radio', '2023-10-10 02:44:14', '2023-10-10 02:44:14', NULL),
(74, 58, 'active', 'Public service affinity group: network now (washington d.c.)', 'checkbox', '2023-10-10 02:45:52', '2023-10-10 02:45:52', NULL),
(75, 59, 'active', 'What are the networking questions?', 'radio', '2023-10-10 03:04:21', '2023-10-10 03:04:21', NULL),
(76, 59, 'active', 'What are the 3 types of networks?', 'checkbox', '2023-10-10 03:05:18', '2023-10-10 03:05:18', NULL),
(77, 59, 'active', 'What is a tcp ip network?', 'input', '2023-10-10 03:05:43', '2023-10-10 03:05:43', NULL),
(78, 60, 'active', 'What are the 4 basics of coding?', 'radio', '2023-10-10 03:14:42', '2023-10-10 03:14:42', NULL),
(79, 60, 'active', 'Name different types of errors which can occur during the execution of a program?', 'checkbox', '2023-10-10 03:16:27', '2023-10-10 03:16:27', NULL),
(80, 60, 'active', 'When a syntax error occurs?', 'input', '2023-10-10 03:16:43', '2023-10-10 03:16:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `survey_question_options`
--

CREATE TABLE `survey_question_options` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_question_options`
--

INSERT INTO `survey_question_options` (`id`, `question_id`, `status`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 8, 'active', 'Yes', '2023-07-17 08:46:34', '2023-07-17 08:46:34', NULL),
(12, 8, 'active', 'No', '2023-07-17 08:46:34', '2023-07-17 08:46:34', NULL),
(13, 9, 'active', '1', '2023-07-17 08:47:00', '2023-07-17 08:47:00', NULL),
(14, 9, 'active', '2', '2023-07-17 08:47:00', '2023-07-17 08:47:00', NULL),
(15, 10, 'active', 'Singing', '2023-07-17 08:47:09', '2023-07-17 08:47:09', NULL),
(16, 10, 'active', 'Dancing', '2023-07-17 08:47:09', '2023-07-17 08:47:09', NULL),
(17, 10, 'active', 'Watching movies', '2023-07-17 08:47:09', '2023-07-17 08:47:09', NULL),
(18, 11, 'active', '1', '2023-07-17 08:47:26', '2023-07-17 08:47:26', NULL),
(19, 11, 'active', '2', '2023-07-17 08:47:26', '2023-07-17 08:47:26', NULL),
(20, 13, 'active', '1', '2023-07-17 08:49:37', '2023-07-17 08:49:37', NULL),
(21, 13, 'active', '2', '2023-07-17 08:49:37', '2023-07-17 08:49:37', NULL),
(22, 15, 'active', '1', '2023-07-17 08:50:06', '2023-07-17 08:50:06', NULL),
(23, 15, 'active', '2', '2023-07-17 08:50:06', '2023-07-17 08:50:06', NULL),
(24, 16, 'active', '1', '2023-07-17 09:12:42', '2023-07-17 09:12:42', NULL),
(25, 16, 'active', '2', '2023-07-17 09:12:42', '2023-07-17 09:12:42', NULL),
(26, 17, 'active', '1', '2023-07-17 09:12:58', '2023-07-17 09:12:58', NULL),
(27, 17, 'active', '2', '2023-07-17 09:12:58', '2023-07-17 09:12:58', NULL),
(28, 18, 'active', 'Yes', '2023-07-17 09:42:58', '2023-07-17 09:42:58', NULL),
(29, 18, 'active', 'No', '2023-07-17 09:42:58', '2023-07-17 09:42:58', NULL),
(30, 19, 'active', '1', '2023-07-18 00:39:47', '2023-07-18 00:39:47', NULL),
(31, 19, 'active', '2', '2023-07-18 00:39:47', '2023-07-18 00:39:47', NULL),
(32, 20, 'active', '1', '2023-07-18 00:39:58', '2023-07-18 00:39:58', NULL),
(33, 20, 'active', '2', '2023-07-18 00:39:58', '2023-07-18 00:39:58', NULL),
(34, 22, 'active', '1', '2023-07-18 01:28:57', '2023-07-18 01:28:57', NULL),
(35, 22, 'active', '2', '2023-07-18 01:28:57', '2023-07-18 01:28:57', NULL),
(36, 24, 'active', '1', '2023-07-18 01:34:07', '2023-07-18 01:34:07', NULL),
(37, 24, 'active', '2', '2023-07-18 01:34:07', '2023-07-18 01:34:07', NULL),
(38, 25, 'active', '1', '2023-07-18 01:34:22', '2023-07-18 01:34:22', NULL),
(39, 25, 'active', '2', '2023-07-18 01:34:22', '2023-07-18 01:34:22', NULL),
(40, 26, 'active', '1', '2023-07-18 02:18:08', '2023-07-18 02:18:08', NULL),
(41, 26, 'active', '2', '2023-07-18 02:18:08', '2023-07-18 02:18:08', NULL),
(42, 27, 'active', 'True', '2023-07-18 02:18:36', '2023-07-18 02:18:36', NULL),
(43, 27, 'active', 'False', '2023-07-18 02:18:36', '2023-07-18 02:18:36', NULL),
(44, 29, 'active', 'Agreeableness', '2023-07-21 06:37:48', '2023-07-21 06:37:48', NULL),
(45, 29, 'active', 'Conscientiousness', '2023-07-21 06:37:48', '2023-07-21 06:37:48', NULL),
(46, 30, 'active', 'Honesty-humility', '2023-07-21 06:38:34', '2023-07-21 06:38:34', NULL),
(47, 30, 'active', 'Emotionality', '2023-07-21 06:38:34', '2023-07-21 06:38:34', NULL),
(48, 32, 'active', 'Physical education, with its integrated curriculum, will make the young kids fit for the future, and this can help them invariably adopt fitness as a lifelong attitude', '2023-07-31 03:55:56', '2023-07-31 03:55:56', NULL),
(49, 32, 'active', 'This fitness initiative can help them develop skills like collaboration, self-initiative, teamwork, and responsibility.', '2023-07-31 03:55:56', '2023-07-31 03:55:56', NULL),
(50, 32, 'active', 'This fitness initiative can help them develop skills like collaboration, self-initiative, teamwork, and responsibility.', '2023-07-31 03:55:56', '2023-07-31 03:55:56', NULL),
(51, 33, 'active', 'Endurance', '2023-07-31 03:56:38', '2023-07-31 03:56:38', NULL),
(52, 33, 'active', 'Strength', '2023-07-31 03:56:38', '2023-07-31 03:56:38', NULL),
(53, 35, 'active', '1', '2023-07-31 04:02:05', '2023-07-31 04:02:05', NULL),
(54, 35, 'active', '2', '2023-07-31 04:02:05', '2023-07-31 04:02:05', NULL),
(55, 37, 'active', 'Physical geography', '2023-07-31 08:04:36', '2023-07-31 08:04:36', NULL),
(56, 37, 'active', 'Human geography.', '2023-07-31 08:04:36', '2023-07-31 08:04:36', NULL),
(57, 39, 'active', 'In 2019, the average social media user spent around 1 hour and 15 minutes per day on social media. emarketer predicts that this average will increase by 8.8%', '2023-08-01 02:33:43', '2023-08-01 02:33:43', NULL),
(58, 39, 'active', 'In 2019, the average social media user spent around 1 hour and 15 minutes per day on social media. emarketer predicts that this average will increase by 8.8%', '2023-08-01 02:33:43', '2023-08-01 02:33:43', NULL),
(59, 40, 'active', '1', '2023-08-01 02:34:06', '2023-08-01 02:34:06', NULL),
(60, 40, 'active', '2', '2023-08-01 02:34:06', '2023-08-01 02:34:06', NULL),
(61, 42, 'active', 'Father of modern physics	galileo galilei', '2023-08-01 03:44:27', '2023-08-01 03:44:27', NULL),
(62, 42, 'active', 'Father of english poetry	geoffrey chaucer', '2023-08-01 03:44:27', '2023-08-01 03:44:27', NULL),
(63, 43, 'active', 'S. chand\'s advanced objective general knowledge by r.s. aggarwal', '2023-08-01 03:45:14', '2023-08-01 03:45:14', NULL),
(64, 43, 'active', 'S. chand\'s advanced objective general knowledge by r.s. aggarwal', '2023-08-01 03:45:14', '2023-08-01 03:45:14', NULL),
(65, 45, 'active', 'Kkk', '2023-08-01 03:51:23', '2023-08-01 03:51:23', NULL),
(66, 46, 'active', 'Economic development is programs, policies or activities that seek to improve the economic well-being and quality of life for a community.', '2023-08-01 04:02:01', '2023-08-01 04:02:01', NULL),
(67, 46, 'active', 'Economic development is programs, policies or activities that seek to improve the economic well-being and quality of life for a community.', '2023-08-01 04:02:01', '2023-08-01 04:02:01', NULL),
(68, 47, 'active', 'Development is the continuous process that takes place regularly.', '2023-08-01 04:03:00', '2023-08-01 04:03:00', NULL),
(69, 47, 'active', 'The growth in the process of development varies from one person to the other depending on the health, genetic characters and the food they consume.', '2023-08-01 04:03:00', '2023-08-01 04:03:00', NULL),
(70, 47, 'active', 'Development follows the correct pattern in the growth as infancy to the death.', '2023-08-01 04:03:00', '2023-08-01 04:03:00', NULL),
(71, 48, 'active', 'Not good', '2023-08-01 04:10:05', '2023-08-01 04:10:05', NULL),
(72, 48, 'active', 'Good', '2023-08-01 04:10:05', '2023-08-01 04:10:05', NULL),
(73, 48, 'active', 'Can\'t say', '2023-08-01 04:10:05', '2023-08-01 04:10:05', NULL),
(74, 49, 'active', 'Monthly expense', '2023-08-01 04:10:52', '2023-08-01 04:10:52', NULL),
(75, 49, 'active', 'Fooding', '2023-08-01 04:10:52', '2023-08-01 04:10:52', NULL),
(76, 49, 'active', 'Outing', '2023-08-01 04:10:52', '2023-08-01 04:10:52', NULL),
(77, 51, 'active', '1', '2023-08-01 04:13:50', '2023-08-01 04:13:50', NULL),
(78, 51, 'active', '2', '2023-08-01 04:13:50', '2023-08-01 04:13:50', NULL),
(79, 52, 'active', '1', '2023-08-01 04:14:05', '2023-08-01 04:14:05', NULL),
(80, 52, 'active', '1', '2023-08-01 04:14:05', '2023-08-01 04:14:05', NULL),
(81, 54, 'active', 'Hansen\'s disease is more commonly known by which name?', '2023-08-01 04:17:47', '2023-08-01 04:17:47', NULL),
(82, 54, 'active', 'Botany is the study of what life form?', '2023-08-01 04:17:47', '2023-08-01 04:17:47', NULL),
(83, 55, 'active', 'What do we call the most basic structure of living things?', '2023-08-01 04:18:22', '2023-08-01 04:18:22', NULL),
(84, 55, 'active', 'What is genetics? ...', '2023-08-01 04:18:22', '2023-08-01 04:18:22', NULL),
(85, 57, 'active', '1', '2023-08-01 04:33:07', '2023-08-01 04:33:07', NULL),
(86, 57, 'active', '2', '2023-08-01 04:33:07', '2023-08-01 04:33:07', NULL),
(87, 58, 'active', '1', '2023-08-01 04:33:24', '2023-08-01 04:33:24', NULL),
(88, 58, 'active', '2', '2023-08-01 04:33:24', '2023-08-01 04:33:24', NULL),
(89, 60, 'active', '1', '2023-08-01 04:37:41', '2023-08-01 04:37:41', NULL),
(90, 60, 'active', '2', '2023-08-01 04:37:41', '2023-08-01 04:37:41', NULL),
(91, 61, 'active', '1', '2023-08-01 04:37:56', '2023-08-01 04:37:56', NULL),
(92, 61, 'active', '2', '2023-08-01 04:37:56', '2023-08-01 04:37:56', NULL),
(93, 62, 'active', 'Interested in topics ranging from culture', '2023-08-02 04:38:10', '2023-08-02 04:38:10', NULL),
(94, 62, 'active', 'Arts', '2023-08-02 04:38:10', '2023-08-02 04:38:10', NULL),
(95, 62, 'active', 'And social well-being and not merely the absence of disease or infirmity', '2023-08-02 04:38:10', '2023-08-02 04:38:10', NULL),
(96, 63, 'active', 'Freedom from disease', '2023-08-02 04:38:58', '2023-08-02 04:38:58', NULL),
(97, 63, 'active', 'Pain, or defect', '2023-08-02 04:38:58', '2023-08-02 04:38:58', NULL),
(98, 63, 'active', 'Normalcy of physical and mental functions; soundness.', '2023-08-02 04:38:58', '2023-08-02 04:38:58', NULL),
(99, 65, 'active', '1', '2023-08-02 04:47:09', '2023-08-02 04:47:09', NULL),
(100, 65, 'active', '2', '2023-08-02 04:47:09', '2023-08-02 04:47:09', NULL),
(101, 66, 'active', '1', '2023-08-02 04:47:30', '2023-08-02 04:47:30', NULL),
(102, 66, 'active', '2', '2023-08-02 04:47:30', '2023-08-02 04:47:30', NULL),
(103, 67, 'active', '1', '2023-08-02 04:51:17', '2023-08-02 04:51:17', NULL),
(104, 67, 'active', '2', '2023-08-02 04:51:17', '2023-08-02 04:51:17', NULL),
(105, 69, 'active', 'Yes', '2023-08-02 09:31:15', '2023-08-02 09:31:15', NULL),
(106, 69, 'active', 'No', '2023-08-02 09:31:15', '2023-08-02 09:31:15', NULL),
(107, 70, 'active', '1', '2023-08-03 03:57:57', '2023-08-03 03:57:57', NULL),
(108, 70, 'active', '2', '2023-08-03 03:57:57', '2023-08-03 03:57:57', NULL),
(109, 71, 'active', '1', '2023-08-03 04:23:39', '2023-08-03 04:23:39', NULL),
(110, 71, 'active', '2', '2023-08-03 04:23:39', '2023-08-03 04:23:39', NULL),
(111, 72, 'active', '1', '2023-08-03 04:29:30', '2023-08-03 04:29:30', NULL),
(112, 72, 'active', '2', '2023-08-03 04:29:30', '2023-08-03 04:29:30', NULL),
(113, 73, 'active', '1', '2023-10-10 02:44:14', '2023-10-10 02:44:14', NULL),
(114, 73, 'active', '2', '2023-10-10 02:44:14', '2023-10-10 02:44:14', NULL),
(115, 73, 'active', '3', '2023-10-10 02:44:14', '2023-10-10 02:44:14', NULL),
(116, 74, 'active', '1', '2023-10-10 02:45:52', '2023-10-10 02:45:52', NULL),
(117, 74, 'active', '2', '2023-10-10 02:45:52', '2023-10-10 02:45:52', NULL),
(118, 75, 'active', 'Name two technologies by which you would connect two offices in remote locations. ...', '2023-10-10 03:04:21', '2023-10-10 03:04:21', NULL),
(119, 75, 'active', 'Name of the software layers or user support layer in the osi model. ...', '2023-10-10 03:04:21', '2023-10-10 03:04:21', NULL),
(120, 75, 'active', 'Name of the software layers or user support layer in the osi model. ...', '2023-10-10 03:04:21', '2023-10-10 03:04:21', NULL),
(121, 76, 'active', 'Lan(local area network)', '2023-10-10 03:05:18', '2023-10-10 03:05:18', NULL),
(122, 76, 'active', 'Wan(wide area network)', '2023-10-10 03:05:18', '2023-10-10 03:05:18', NULL),
(123, 76, 'active', 'Man(metropolitan area network).', '2023-10-10 03:05:18', '2023-10-10 03:05:18', NULL),
(124, 78, 'active', 'Data structures. ...', '2023-10-10 03:14:42', '2023-10-10 03:14:42', NULL),
(125, 78, 'active', 'Control structures.', '2023-10-10 03:14:42', '2023-10-10 03:14:42', NULL),
(126, 78, 'active', 'Syntax', '2023-10-10 03:14:42', '2023-10-10 03:14:42', NULL),
(127, 78, 'active', 'All of the above', '2023-10-10 03:14:42', '2023-10-10 03:14:42', NULL),
(128, 79, 'active', 'Syntax errors', '2023-10-10 03:16:27', '2023-10-10 03:16:27', NULL),
(129, 79, 'active', 'Runtime errors', '2023-10-10 03:16:27', '2023-10-10 03:16:27', NULL),
(130, 79, 'active', 'Logical errors', '2023-10-10 03:16:27', '2023-10-10 03:16:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `profile_pic` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires_in` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `name`, `email`, `password`, `status`, `profile_pic`, `phone`, `dob`, `email_verified_at`, `fcm_id`, `expires_in`, `remember_token`, `created_at`, `updated_at`) VALUES
(247, 'admin', 'Piyush', 'admin@gmail.com', '$2y$10$XnJEhl/yZqngY7y.iDJvRuGDOxJmg.LEwixxY0XUroAn5D0P8sMxW', 'active', 'admin-profile-pic-6650.png', '8989898989', '11/12/1997', NULL, NULL, NULL, NULL, '2023-06-29 08:07:37', '2023-10-10 04:24:02'),
(285, 'user', 'Aakash rai', 'akashraibinarymetrix@gmail.com', '$2y$10$SUOlNQDVqtE03/JsqjSj.eJBTvbWPZeyJHZ/9YexImj38P2xpAcBe', 'active', '', '6306259996', '08-06-1991', NULL, 'fsPN5uanS9G9RP50WB16tD:APA91bHb1in1WAdU8r67hCFUA6b5Wa-BD9YcUzAkcPMvuX3ZgV8uFzgsVp7Z7yo1r8nBvniTKdUokGk3JhIaOS72G0oXvPNF93BIPLVgk_Y6IAe67Zd5Su1luT-FmZMzw_5yxGJ4MkOK', NULL, NULL, '2023-07-17 08:18:20', '2023-07-17 09:46:08'),
(286, 'user', 'Anjali', 'metrixtestingbinary@gmail.com', '$2y$10$i6982gk6U/a2lL4HvAlg6ORMKT4I4nB2tjmt1av4mx5BpA3KE2IY6', 'active', '', '1234561223', NULL, NULL, NULL, NULL, NULL, '2023-07-17 08:35:30', '2023-07-25 04:19:56'),
(287, 'user', 'Danish akhtar', 'danish.binarymetrix@gmail.com', '$2y$10$tVIdBElkyQY5avyZNVtMR.vo8EEtKvJ5HhrMAzZ9LYYTt.DzG0oau', 'active', '', '9430464652', '18-04-1992', NULL, NULL, NULL, NULL, '2023-07-17 08:57:51', '2023-08-01 01:37:53'),
(288, 'user', 'Peyush', 'peeyush@binarymetrix.in', '$2y$10$t1QDvOsCQpGcX7bq/NzTqe6TpgEXbhEGiw2G6fP3Yms.Hs05nEtxy', 'active', '', '1521521521', NULL, NULL, NULL, NULL, NULL, '2023-07-18 01:02:05', '2023-07-18 01:15:19'),
(289, 'user', 'Kajal', 'kajal@yopmail.com', '$2y$10$/.93jn9hTZiO8KoqV.79p.A.7j0VNR9FrrXSm9vkOkyjOi1pL3IAW', 'active', '', '1231235282', NULL, NULL, NULL, NULL, NULL, '2023-07-31 02:09:54', '2023-07-31 02:32:32'),
(290, 'user', 'Ani', 'ani@yopmail.com', '$2y$10$ClBw1DrlRaT/40hn/7qzJejgfTG.Wgm2gMopZazGoRy0xrqAqYULi', 'active', '', '1251251251', NULL, NULL, 'cSE0Ds7SSRaINmCDDJCWvm:APA91bFjLmyeuKR7O6y7PauqQZpsLjXhxoPfbtFiAyaQPxdxyusyMovHJUeCbnf2V8rzVFw4xWnJd5X7vKLrKDwHPBLXB-9qOpquioBA1d8ifeJajlNHuTpfIkGSUJ4_CDajgub79k05', NULL, NULL, '2023-07-31 02:26:21', '2023-07-31 04:36:52'),
(291, 'user', 'Ani', 'anu@yopmail.com', '$2y$10$4GxP0D7QmymrRDj92Jn8c.t8w6LJSk3hISOnKmS.jMU.PqorhqH/G', 'active', '', '4564564564', NULL, NULL, NULL, NULL, NULL, '2023-07-31 10:18:22', '2023-08-02 00:38:30'),
(292, 'user', 'Anil', 'anil@yopmail.com', '$2y$10$0TCFOKZa/M5KdKnbUUjdeODHQpYR31SallWSgLZPcCLjITTR0W2q.', 'active', '', '1414141415', NULL, NULL, NULL, NULL, NULL, '2023-08-01 04:26:49', '2023-08-01 04:26:49'),
(293, 'user', 'Rah', 'rahul@yopmail.com', '$2y$10$JIvR9fpQofkDE2e3911yUexRkdCtHRj6F3UJ9k4cOP1wdHjbaV4ua', 'active', '', '1591591595', '02-08-2005', NULL, 'f4AFQ0sgS6-7-__aGUCgDD:APA91bEaNxJjRsGhTeA8S1TEmsKOcwdbQUY-juu2jf8srAblN5pIIynZfT7jtoz-0oIQ6DoL96GoEONBD7q8_ave8pZKvOTMH27s8hQpc1UJyim_v4SANzSPEzs_kkJbP84GZXdyCgk3', NULL, NULL, '2023-08-02 00:39:49', '2023-08-03 04:07:23'),
(294, 'user', 'Oliver', 'oliverbinarymetrix@gmail.com', '$2y$10$cGQM9vD5hX.BD5pAOEaxk.x8A1jadJUbaj8Pa30kr88Tra1CEbBPe', 'active', '', '9315132914', NULL, NULL, 'csflf_y8SBKdAfSsLFl2qX:APA91bEThCPIGVwtKc2rp90pi03BOQGZfaEFpyu-8Und1I25e0by0To1IKH2g69qDBCKLdtLwL2lva0qh6v7A5RIQ22LvAkBQRbCAlX6tBTMwxnkD_s9eI48_pgyxB4U7CHG05jBi8L5', NULL, NULL, '2023-08-02 09:29:05', '2023-08-02 09:29:29'),
(295, 'user', 'Bob', 'dam@yopmail.com', '$2y$10$UvUbeANGHkTfy0NX8Sf71OyDnjlIJEsyRtTQQ8aT2C23P1s9VL3ye', 'active', '', '2532532532', NULL, NULL, NULL, NULL, NULL, '2023-08-03 03:54:45', '2023-08-03 04:07:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_feedbacks`
--

CREATE TABLE `user_feedbacks` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `message` text,
  `type` varchar(250) DEFAULT NULL,
  `rate` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_feedbacks`
--

INSERT INTO `user_feedbacks` (`id`, `user_id`, `message`, `type`, `rate`, `created_at`, `updated_at`) VALUES
(1, 290, NULL, NULL, '3.5', '2023-07-31 12:26:28', '2023-07-31 06:56:39'),
(2, 291, NULL, NULL, '4.5', '2023-08-01 10:00:27', '2023-08-01 04:30:33'),
(3, 293, NULL, 'Repair Quality', '0.0', '2023-08-02 10:33:47', '2023-08-02 05:03:54'),
(4, 293, NULL, 'Repair Quality', '0.0', '2023-08-02 10:33:47', '2023-08-02 05:03:56'),
(5, 293, NULL, 'Repair Quality', '3.5', '2023-08-02 10:33:47', '2023-08-02 05:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_question_answers`
--

CREATE TABLE `user_question_answers` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `question_option_ids` varchar(100) DEFAULT NULL,
  `question_option_array_ids` varchar(250) DEFAULT NULL,
  `type` enum('radio','checkbox','input') NOT NULL,
  `input` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_question_answers`
--

INSERT INTO `user_question_answers` (`id`, `user_id`, `survey_id`, `question_id`, `question_option_ids`, `question_option_array_ids`, `type`, `input`, `created_at`, `updated_at`) VALUES
(10, 285, 4, 9, '13', NULL, 'radio', NULL, '2023-07-16 20:48:15', '2023-07-16 20:48:15'),
(11, 285, 4, 11, '19,18', NULL, 'checkbox', NULL, '2023-07-16 20:48:20', '2023-07-16 20:48:20'),
(12, 285, 4, 12, NULL, NULL, 'input', 'great generation', '2023-07-16 20:48:29', '2023-07-16 20:48:29'),
(13, 285, 3, 7, NULL, NULL, 'input', 'I am good.', '2023-07-16 20:48:56', '2023-07-16 20:48:56'),
(14, 285, 3, 8, '12', NULL, 'radio', NULL, '2023-07-16 20:49:34', '2023-07-16 20:49:34'),
(15, 285, 3, 10, '16,17', NULL, 'checkbox', NULL, '2023-07-16 20:49:37', '2023-07-16 20:49:37'),
(16, 247, 3, 7, NULL, NULL, 'input', 'My behaviour is very aggressive, when person is not listening my point.', '2023-07-16 20:49:42', '2023-07-16 20:49:42'),
(17, 286, 5, 13, '20', NULL, 'radio', NULL, '2023-07-16 20:50:41', '2023-07-16 20:50:41'),
(18, 286, 5, 14, NULL, NULL, 'input', 'start away', '2023-07-16 20:51:01', '2023-07-16 20:51:01'),
(19, 286, 5, 15, '23,22', NULL, 'checkbox', 'start away', '2023-07-16 20:51:06', '2023-07-16 20:51:06'),
(20, 286, 4, 9, '13', NULL, 'radio', NULL, '2023-07-16 20:51:19', '2023-07-16 20:51:19'),
(21, 286, 4, 11, '18', NULL, 'checkbox', NULL, '2023-07-16 20:51:31', '2023-07-16 20:51:31'),
(22, 286, 4, 12, NULL, NULL, 'input', 'network', '2023-07-16 20:51:43', '2023-07-16 20:51:43'),
(23, 286, 3, 7, NULL, NULL, 'input', 'hv.xhffew words', '2023-07-18 01:45:11', '2023-07-18 01:45:11'),
(24, 287, 5, 13, '20', NULL, 'radio', NULL, '2023-07-16 20:58:57', '2023-07-16 20:58:57'),
(25, 287, 5, 14, NULL, NULL, 'input', 'No Idea', '2023-07-16 21:04:43', '2023-07-16 21:04:43'),
(26, 286, 3, 8, '11', NULL, 'radio', 'ffew words', '2023-07-16 21:06:48', '2023-07-16 21:06:48'),
(27, 286, 3, 10, '15', NULL, 'checkbox', 'ffew words', '2023-07-16 21:06:49', '2023-07-16 21:06:49'),
(28, 285, 6, 16, '24', NULL, 'radio', NULL, '2023-07-16 21:49:27', '2023-07-16 21:49:27'),
(29, 285, 6, 17, '26,27', NULL, 'checkbox', NULL, '2023-07-16 21:49:37', '2023-07-16 21:49:37'),
(30, 285, 5, 13, '20', NULL, 'radio', NULL, '2023-07-16 21:59:43', '2023-07-16 21:59:43'),
(31, 285, 5, 14, NULL, NULL, 'input', 'hello', '2023-07-16 22:00:07', '2023-07-16 22:00:07'),
(32, 285, 5, 15, '22,23', NULL, 'checkbox', 'hello', '2023-07-16 22:00:33', '2023-07-16 22:00:33'),
(33, 286, 6, 16, '24', NULL, 'radio', NULL, '2023-07-16 22:13:42', '2023-07-16 22:13:42'),
(34, 286, 6, 17, '26', NULL, 'checkbox', NULL, '2023-07-16 22:13:47', '2023-07-16 22:13:47'),
(35, 286, 7, 18, '28', NULL, 'radio', NULL, '2023-07-16 22:28:14', '2023-07-16 22:28:14'),
(36, 286, 8, 19, '30', NULL, 'radio', NULL, '2023-07-18 00:41:13', '2023-07-18 00:41:13'),
(37, 286, 8, 20, '33,32', NULL, 'checkbox', NULL, '2023-07-18 00:41:18', '2023-07-18 00:41:18'),
(38, 286, 8, 21, NULL, NULL, 'input', 'English', '2023-07-18 00:41:29', '2023-07-18 00:41:29'),
(39, 286, 10, 24, '36', NULL, 'radio', NULL, '2023-07-18 01:35:35', '2023-07-18 01:35:35'),
(40, 286, 10, 25, '38', NULL, 'checkbox', NULL, '2023-07-18 01:35:49', '2023-07-18 01:35:49'),
(41, 286, 11, 26, '40', NULL, 'radio', NULL, '2023-07-17 23:01:22', '2023-07-17 23:01:22'),
(42, 289, 10, 24, '36', NULL, 'radio', NULL, '2023-07-31 02:10:27', '2023-07-31 02:10:27'),
(43, 289, 12, 29, '44', NULL, 'radio', NULL, '2023-07-31 02:12:23', '2023-07-31 02:12:23'),
(44, 289, 12, 30, '47,46', NULL, 'checkbox', NULL, '2023-07-31 02:12:33', '2023-07-31 02:12:33'),
(45, 289, 12, 31, NULL, NULL, 'input', 'hello', '2023-07-31 02:12:42', '2023-07-31 02:12:42'),
(46, 289, 10, 25, '38,39', NULL, 'checkbox', NULL, '2023-07-31 02:28:19', '2023-07-31 02:28:19'),
(47, 290, 10, 24, '36', NULL, 'radio', NULL, '2023-07-31 02:40:11', '2023-07-31 02:40:11'),
(48, 290, 10, 25, '39,38', NULL, 'checkbox', NULL, '2023-07-31 02:53:16', '2023-07-31 02:53:16'),
(49, 290, 12, 29, '44', NULL, 'radio', NULL, '2023-07-31 03:38:59', '2023-07-31 03:38:59'),
(50, 290, 14, 32, '49', NULL, 'radio', NULL, '2023-07-31 04:05:38', '2023-07-31 04:05:38'),
(51, 290, 14, 33, '51,52', NULL, 'checkbox', NULL, '2023-07-31 04:05:49', '2023-07-31 04:05:49'),
(52, 290, 14, 34, NULL, NULL, 'input', 'hello', '2023-07-31 04:06:11', '2023-07-31 04:06:11'),
(53, 290, 12, 30, '46', NULL, 'checkbox', NULL, '2023-07-31 04:18:44', '2023-07-31 04:18:44'),
(54, 290, 12, 31, NULL, NULL, 'input', 'hello', '2023-07-31 04:18:54', '2023-07-31 04:18:54'),
(55, 290, 11, 26, '40', NULL, 'radio', NULL, '2023-07-31 04:23:12', '2023-07-31 04:23:12'),
(56, 290, 11, 27, '42', NULL, 'checkbox', NULL, '2023-07-30 20:20:06', '2023-07-30 20:20:06'),
(57, 290, 11, 28, NULL, NULL, 'input', 'yes', '2023-07-30 20:20:10', '2023-07-30 20:20:10'),
(58, 290, 39, 37, '55', NULL, 'radio', NULL, '2023-07-30 20:41:17', '2023-07-30 20:41:17'),
(59, 290, 9, 22, '34', NULL, 'radio', NULL, '2023-07-30 20:47:45', '2023-07-30 20:47:45'),
(60, 290, 6, 16, '24', NULL, 'radio', NULL, '2023-07-30 20:48:16', '2023-07-30 20:48:16'),
(61, 290, 6, 17, '26', NULL, 'checkbox', NULL, '2023-07-30 20:48:24', '2023-07-30 20:48:24'),
(62, 290, 5, 13, '20', NULL, 'radio', NULL, '2023-07-30 20:59:08', '2023-07-30 20:59:08'),
(63, 287, 5, 15, '23,22', NULL, 'checkbox', NULL, '2023-07-30 21:45:33', '2023-07-30 21:45:33'),
(64, 287, 39, 37, '55', NULL, 'radio', NULL, '2023-07-30 21:45:57', '2023-07-30 21:45:57'),
(65, 287, 11, 26, '41', NULL, 'radio', NULL, '2023-07-30 21:49:24', '2023-07-30 21:49:24'),
(66, 287, 11, 27, '42', NULL, 'checkbox', NULL, '2023-07-30 21:49:30', '2023-07-30 21:49:30'),
(67, 287, 11, 28, NULL, NULL, 'input', 'Hello', '2023-07-30 21:49:51', '2023-07-30 21:49:51'),
(68, 291, 12, 29, '44', NULL, 'radio', NULL, '2023-07-30 22:19:21', '2023-07-30 22:19:21'),
(69, 291, 11, 26, '40', NULL, 'radio', NULL, '2023-07-30 22:27:34', '2023-07-30 22:27:34'),
(70, 291, 11, 27, '42,43', NULL, 'checkbox', NULL, '2023-07-30 22:27:37', '2023-07-30 22:27:37'),
(71, 291, 11, 28, NULL, NULL, 'input', 'yes', '2023-07-30 22:27:45', '2023-07-30 22:27:45'),
(72, 291, 10, 24, '36', NULL, 'radio', NULL, '2023-07-30 22:29:19', '2023-07-30 22:29:19'),
(73, 287, 12, 29, '44', NULL, 'radio', NULL, '2023-08-01 01:23:40', '2023-08-01 01:23:40'),
(74, 287, 10, 24, '36', NULL, 'radio', NULL, '2023-08-01 01:27:47', '2023-08-01 01:27:47'),
(75, 287, 8, 19, '30', NULL, 'radio', NULL, '2023-08-01 01:31:01', '2023-08-01 01:31:01'),
(76, 287, 8, 20, '32,33', NULL, 'checkbox', NULL, '2023-08-01 01:31:06', '2023-08-01 01:31:06'),
(77, 287, 6, 16, '24', NULL, 'radio', NULL, '2023-08-01 01:31:49', '2023-08-01 01:31:49'),
(78, 291, 10, 25, '38,39', NULL, 'checkbox', NULL, '2023-08-01 01:54:13', '2023-08-01 01:54:13'),
(79, 291, 12, 30, '46,47', NULL, 'checkbox', NULL, '2023-08-01 01:54:37', '2023-08-01 01:54:37'),
(80, 291, 12, 31, NULL, NULL, 'input', 'he', '2023-08-01 01:54:43', '2023-08-01 01:54:43'),
(81, 291, 6, 16, '25', NULL, 'radio', NULL, '2023-08-01 01:57:54', '2023-08-01 01:57:54'),
(82, 291, 6, 17, '26', NULL, 'checkbox', NULL, '2023-08-01 01:58:15', '2023-08-01 01:58:15'),
(83, 291, 4, 9, '13', NULL, 'radio', NULL, '2023-08-01 01:58:48', '2023-08-01 01:58:48'),
(84, 291, 4, 11, '19,18', NULL, 'checkbox', NULL, '2023-08-01 01:58:52', '2023-08-01 01:58:52'),
(85, 291, 4, 12, NULL, NULL, 'input', 'h', '2023-08-01 01:59:27', '2023-08-01 01:59:27'),
(86, 291, 5, 13, '20', NULL, 'radio', NULL, '2023-08-01 02:02:12', '2023-08-01 02:02:12'),
(87, 291, 5, 14, NULL, NULL, 'input', 'hh', '2023-08-01 02:02:18', '2023-08-01 02:02:18'),
(88, 291, 8, 19, '30', NULL, 'radio', NULL, '2023-08-01 02:20:48', '2023-08-01 02:20:48'),
(89, 291, 41, 39, '57', NULL, 'radio', NULL, '2023-08-01 02:38:11', '2023-08-01 02:38:11'),
(90, 291, 41, 40, '59,60', NULL, 'checkbox', NULL, '2023-08-01 02:58:55', '2023-08-01 02:58:55'),
(91, 291, 41, 41, NULL, NULL, 'input', 'hhh', '2023-08-01 02:59:05', '2023-08-01 02:59:05'),
(92, 291, 8, 20, '32,33', NULL, 'checkbox', NULL, '2023-08-01 03:01:38', '2023-08-01 03:01:38'),
(93, 291, 8, 21, NULL, NULL, 'input', 'ddddd', '2023-08-01 03:01:56', '2023-08-01 03:01:56'),
(94, 291, 42, 42, '61', NULL, 'radio', NULL, '2023-08-01 03:51:54', '2023-08-01 03:51:54'),
(95, 291, 7, 18, '28', NULL, 'radio', NULL, '2023-08-01 03:52:24', '2023-08-01 03:52:24'),
(96, 291, 44, 46, '66', NULL, 'radio', NULL, '2023-08-01 04:05:05', '2023-08-01 04:05:05'),
(97, 291, 39, 37, '55', NULL, 'radio', NULL, '2023-08-01 04:09:51', '2023-08-01 04:09:51'),
(98, 291, 45, 48, '72', NULL, 'radio', NULL, '2023-08-01 04:12:21', '2023-08-01 04:12:21'),
(99, 291, 46, 51, '77', NULL, 'radio', NULL, '2023-08-01 04:15:16', '2023-08-01 04:15:16'),
(100, 291, 47, 54, '81', NULL, 'radio', NULL, '2023-08-01 04:20:28', '2023-08-01 04:20:28'),
(101, 291, 47, 55, '83,84', NULL, 'checkbox', NULL, '2023-08-01 04:20:32', '2023-08-01 04:20:32'),
(102, 291, 47, 56, NULL, NULL, 'input', 'yes', '2023-08-01 04:20:40', '2023-08-01 04:20:40'),
(103, 291, 40, 38, NULL, NULL, 'input', 'yes', '2023-08-01 04:25:29', '2023-08-01 04:25:29'),
(104, 291, 38, 36, NULL, NULL, 'input', 'yes', '2023-08-01 04:25:37', '2023-08-01 04:25:37'),
(105, 291, 5, 15, '22', NULL, 'checkbox', NULL, '2023-08-01 04:29:25', '2023-08-01 04:29:25'),
(106, 291, 44, 47, '69', NULL, 'radio', NULL, '2023-08-01 04:30:46', '2023-08-01 04:30:46'),
(107, 291, 48, 57, '85', NULL, 'radio', NULL, '2023-08-01 04:39:12', '2023-08-01 04:39:12'),
(108, 291, 42, 43, '64', NULL, 'checkbox', NULL, '2023-07-31 21:15:39', '2023-07-31 21:15:39'),
(109, 291, 42, 44, NULL, NULL, 'input', 'h', '2023-07-31 21:15:47', '2023-07-31 21:15:47'),
(110, 291, 49, 60, '90', NULL, 'radio', NULL, '2023-07-31 21:16:16', '2023-07-31 21:16:16'),
(111, 291, 49, 61, '91,92,91,92,91,92,91', NULL, 'checkbox', NULL, '2023-07-31 21:16:30', '2023-07-31 21:16:30'),
(112, 291, 48, 58, '87,88,87', NULL, 'checkbox', NULL, '2023-07-31 21:16:54', '2023-07-31 21:16:54'),
(113, 291, 48, 59, NULL, NULL, 'input', 'hhh', '2023-07-31 21:16:59', '2023-07-31 21:16:59'),
(114, 291, 46, 52, '79,79,79,80', NULL, 'checkbox', NULL, '2023-07-31 21:17:56', '2023-07-31 21:17:56'),
(115, 291, 46, 53, NULL, NULL, 'input', 'ddd', '2023-07-31 21:18:02', '2023-07-31 21:18:02'),
(116, 291, 45, 49, '74,75,76,75', NULL, 'checkbox', NULL, '2023-07-31 21:19:09', '2023-07-31 21:19:09'),
(117, 291, 45, 50, NULL, NULL, 'input', 'fffdfff', '2023-07-31 21:19:16', '2023-07-31 21:19:16'),
(118, 293, 49, 60, '89', NULL, 'radio', NULL, '2023-08-02 00:40:50', '2023-08-02 00:40:50'),
(119, 293, 49, 61, '91', NULL, 'checkbox', NULL, '2023-08-02 00:40:53', '2023-08-02 00:40:53'),
(120, 293, 48, 57, '85', NULL, 'radio', NULL, '2023-08-02 04:40:30', '2023-08-02 04:40:30'),
(121, 293, 48, 58, '87', NULL, 'checkbox', NULL, '2023-08-02 04:40:34', '2023-08-02 04:40:34'),
(122, 293, 50, 62, '93', NULL, 'radio', NULL, '2023-08-02 04:40:45', '2023-08-02 04:40:45'),
(123, 293, 50, 63, '97', NULL, 'checkbox', NULL, '2023-08-02 04:40:47', '2023-08-02 04:40:47'),
(124, 293, 50, 64, NULL, NULL, 'input', 'hello', '2023-08-02 04:40:51', '2023-08-02 04:40:51'),
(125, 293, 51, 65, '99', NULL, 'radio', NULL, '2023-08-02 04:48:33', '2023-08-02 04:48:33'),
(126, 293, 42, 42, '61', NULL, 'radio', NULL, '2023-08-02 04:49:24', '2023-08-02 04:49:24'),
(127, 293, 42, 43, '63,63', NULL, 'checkbox', NULL, '2023-08-02 04:49:30', '2023-08-02 04:49:30'),
(128, 293, 42, 44, NULL, NULL, 'input', 'hello', '2023-08-02 04:49:34', '2023-08-02 04:49:34'),
(129, 293, 51, 66, '102', NULL, 'checkbox', NULL, '2023-08-02 04:56:50', '2023-08-02 04:56:50'),
(130, 293, 47, 54, '81', NULL, 'radio', NULL, '2023-08-02 04:58:47', '2023-08-02 04:58:47'),
(131, 293, 52, 67, '103', NULL, 'radio', NULL, '2023-08-02 04:58:56', '2023-08-02 04:58:56'),
(132, 293, 52, 68, NULL, NULL, 'input', 'hello', '2023-08-02 04:59:00', '2023-08-02 04:59:00'),
(133, 294, 54, 69, '105', NULL, 'radio', NULL, '2023-08-01 21:35:36', '2023-08-01 21:35:36'),
(134, 247, 3, 8, '11', NULL, 'radio', NULL, '2023-08-07 21:43:30', '2023-08-07 21:43:30'),
(135, 247, 3, 10, '16,17', NULL, 'checkbox', NULL, '2023-08-07 21:43:34', '2023-08-07 21:43:34'),
(136, 247, 56, 71, '109', NULL, 'radio', NULL, '2023-08-29 01:17:05', '2023-08-29 01:17:05'),
(137, 247, 57, 72, '111,112', NULL, 'checkbox', NULL, '2023-09-26 23:25:17', '2023-09-26 23:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_survey_history`
--

CREATE TABLE `user_survey_history` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `status` enum('incompleted','completed') NOT NULL DEFAULT 'incompleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_survey_history`
--

INSERT INTO `user_survey_history` (`id`, `user_id`, `survey_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 285, 4, 'completed', '2023-07-17 08:48:15', '2023-07-17 08:48:29'),
(6, 285, 3, 'completed', '2023-07-17 08:48:56', '2023-07-17 08:49:37'),
(7, 247, 3, 'completed', '2023-07-17 08:49:42', '2023-08-08 09:43:34'),
(8, 286, 5, 'completed', '2023-07-17 08:50:41', '2023-07-17 08:51:06'),
(9, 286, 4, 'completed', '2023-07-17 08:51:19', '2023-07-17 08:51:43'),
(10, 286, 3, 'incompleted', '2023-07-17 08:54:10', '2023-07-17 10:13:18'),
(11, 287, 5, 'completed', '2023-07-17 08:58:57', '2023-07-31 09:45:33'),
(12, 285, 6, 'completed', '2023-07-17 09:49:27', '2023-07-17 09:49:37'),
(13, 285, 5, 'completed', '2023-07-17 09:59:43', '2023-07-17 10:00:33'),
(14, 286, 6, 'completed', '2023-07-17 10:13:42', '2023-07-17 10:13:47'),
(15, 286, 7, 'completed', '2023-07-17 10:28:14', '2023-07-17 10:28:14'),
(16, 286, 8, 'completed', '2023-07-18 00:41:13', '2023-07-18 00:41:29'),
(17, 286, 10, 'completed', '2023-07-18 01:35:35', '2023-07-18 01:35:49'),
(18, 286, 11, 'incompleted', '2023-07-18 11:01:22', '2023-07-18 11:01:22'),
(19, 289, 10, 'completed', '2023-07-31 02:10:27', '2023-07-31 02:28:19'),
(20, 289, 12, 'completed', '2023-07-31 02:12:23', '2023-07-31 02:12:42'),
(21, 290, 10, 'completed', '2023-07-31 02:40:11', '2023-07-31 02:53:16'),
(22, 290, 12, 'completed', '2023-07-31 03:38:59', '2023-07-31 04:18:54'),
(23, 290, 14, 'completed', '2023-07-31 04:05:38', '2023-07-31 04:06:11'),
(24, 290, 11, 'completed', '2023-07-31 04:23:12', '2023-07-31 08:20:10'),
(25, 290, 39, 'completed', '2023-07-31 08:41:17', '2023-07-31 08:41:17'),
(26, 290, 9, 'incompleted', '2023-07-31 08:47:45', '2023-07-31 08:47:45'),
(27, 290, 6, 'completed', '2023-07-31 08:48:16', '2023-07-31 08:48:24'),
(28, 290, 5, 'incompleted', '2023-07-31 08:59:08', '2023-07-31 08:59:08'),
(29, 287, 39, 'completed', '2023-07-31 09:45:57', '2023-07-31 09:45:57'),
(30, 287, 11, 'completed', '2023-07-31 09:49:24', '2023-07-31 09:49:51'),
(31, 291, 12, 'completed', '2023-07-31 10:19:21', '2023-08-01 01:54:43'),
(32, 291, 11, 'completed', '2023-07-31 10:27:34', '2023-07-31 10:27:45'),
(33, 291, 10, 'completed', '2023-07-31 10:29:19', '2023-08-01 01:54:13'),
(34, 287, 12, 'incompleted', '2023-08-01 01:23:40', '2023-08-01 01:23:40'),
(35, 287, 10, 'incompleted', '2023-08-01 01:27:47', '2023-08-01 01:27:47'),
(36, 287, 8, 'incompleted', '2023-08-01 01:31:01', '2023-08-01 01:31:01'),
(37, 287, 6, 'incompleted', '2023-08-01 01:31:49', '2023-08-01 01:31:49'),
(38, 291, 6, 'completed', '2023-08-01 01:57:54', '2023-08-01 01:58:15'),
(39, 291, 4, 'completed', '2023-08-01 01:58:48', '2023-08-01 01:59:27'),
(40, 291, 5, 'completed', '2023-08-01 02:02:12', '2023-08-01 04:29:25'),
(41, 291, 8, 'completed', '2023-08-01 02:20:48', '2023-08-01 03:01:56'),
(42, 291, 41, 'completed', '2023-08-01 02:38:11', '2023-08-01 02:59:05'),
(43, 291, 42, 'completed', '2023-08-01 03:51:54', '2023-08-01 09:15:47'),
(44, 291, 7, 'completed', '2023-08-01 03:52:24', '2023-08-01 03:52:24'),
(45, 291, 44, 'completed', '2023-08-01 04:05:05', '2023-08-01 04:30:46'),
(46, 291, 39, 'completed', '2023-08-01 04:09:51', '2023-08-01 04:09:51'),
(47, 291, 45, 'completed', '2023-08-01 04:12:21', '2023-08-01 09:19:16'),
(48, 291, 46, 'completed', '2023-08-01 04:15:16', '2023-08-01 09:18:02'),
(49, 291, 47, 'completed', '2023-08-01 04:20:28', '2023-08-01 04:20:40'),
(50, 291, 40, 'completed', '2023-08-01 04:25:29', '2023-08-01 04:25:29'),
(51, 291, 38, 'completed', '2023-08-01 04:25:37', '2023-08-01 04:25:37'),
(52, 291, 48, 'completed', '2023-08-01 04:39:12', '2023-08-01 09:16:59'),
(53, 291, 49, 'completed', '2023-08-01 09:16:16', '2023-08-01 09:16:30'),
(54, 293, 49, 'completed', '2023-08-02 00:40:50', '2023-08-02 00:40:53'),
(55, 293, 48, 'incompleted', '2023-08-02 04:40:30', '2023-08-02 04:40:30'),
(56, 293, 50, 'completed', '2023-08-02 04:40:45', '2023-08-02 04:40:51'),
(57, 293, 51, 'completed', '2023-08-02 04:48:33', '2023-08-02 04:56:50'),
(58, 293, 42, 'completed', '2023-08-02 04:49:24', '2023-08-02 04:49:34'),
(59, 293, 47, 'incompleted', '2023-08-02 04:58:47', '2023-08-02 04:58:47'),
(60, 293, 52, 'completed', '2023-08-02 04:58:56', '2023-08-02 04:59:00'),
(61, 294, 54, 'completed', '2023-08-02 09:35:36', '2023-08-02 09:35:36'),
(62, 247, 56, 'completed', '2023-08-29 13:17:05', '2023-08-29 13:17:05'),
(63, 247, 57, 'completed', '2023-09-26 23:25:17', '2023-09-26 23:25:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `error_logs`
--
ALTER TABLE `error_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`(191));

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_categories`
--
ALTER TABLE `survey_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_question_options`
--
ALTER TABLE `survey_question_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_feedbacks`
--
ALTER TABLE `user_feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_question_answers`
--
ALTER TABLE `user_question_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_survey_history`
--
ALTER TABLE `user_survey_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `error_logs`
--
ALTER TABLE `error_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `survey_categories`
--
ALTER TABLE `survey_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `survey_question_options`
--
ALTER TABLE `survey_question_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;

--
-- AUTO_INCREMENT for table `user_feedbacks`
--
ALTER TABLE `user_feedbacks`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_question_answers`
--
ALTER TABLE `user_question_answers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `user_survey_history`
--
ALTER TABLE `user_survey_history`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
