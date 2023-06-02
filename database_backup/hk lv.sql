-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 02:53 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hk`
--

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `sort` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `project_id`, `title`, `description`, `type`, `foto`, `sort`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'test', 'test', 'Text', NULL, NULL, '2023-05-11 12:25:21', '2023-05-11 12:14:45', '2023-05-11 12:25:21'),
(2, 1, 'tset', 'tsert', 'Text', NULL, NULL, '2023-05-11 12:25:21', '2023-05-11 12:14:56', '2023-05-11 12:25:21'),
(6, 3, 'test', 'test', 'Text', NULL, NULL, '2023-05-17 03:10:15', '2023-05-11 18:13:21', '2023-05-17 03:10:15'),
(7, 3, 'test', 'tesy', 'Text', NULL, NULL, '2023-05-17 03:10:15', '2023-05-11 18:13:51', '2023-05-17 03:10:15'),
(25, 4, 'test', 'tset', 'Text', NULL, NULL, '2023-05-17 03:10:13', '2023-05-17 03:10:05', '2023-05-17 03:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` int(50) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `dateFrom` varchar(255) DEFAULT NULL,
  `dateTo` varchar(255) DEFAULT NULL,
  `timeFrom` varchar(255) DEFAULT NULL,
  `timeTo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `userId`, `title`, `dateFrom`, `dateTo`, `timeFrom`, `timeTo`, `created_at`, `updated_at`) VALUES
(4, 20, 'ahmed birhtday', '2023-08-30', '2023-08-30', NULL, NULL, '2023-05-11 14:07:07', '2023-05-11 14:07:07'),
(29, 20, 'ختبار الفاينل', '2023-06-15', '2023-06-15', '08:30', '09:30', '2023-05-19 02:04:25', '2023-05-27 12:06:39'),
(37, 20, 'طبيب اسنان', '2023-06-13', '2023-06-13', '09:00', '10:00', '2023-05-23 15:30:00', '2023-05-27 12:06:34'),
(38, 20, 'محاضره علوم', '2023-05-25', '2023-05-25', '08:00', '09:00', '2023-05-23 15:31:05', '2023-05-25 23:15:57'),
(45, 20, 'test', '2023-05-28', '2023-05-31', NULL, NULL, '2023-05-25 21:33:08', '2023-05-27 12:00:29'),
(46, 32, 'test', '2023-05-28', '2023-05-30', NULL, NULL, '2023-05-27 14:56:10', '2023-05-27 14:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_09_023730_create_projects_table', 1),
(6, '2023_04_11_232123_create_events_table', 1),
(7, '2023_04_16_193715_create_contents_table', 1),
(8, '2023_05_14_030703_create_settings_table', 2),
(9, '2023_05_20_155905_create_skills_table', 3),
(10, '2023_05_26_130919_add_subscription_end_date_to_users', 4),
(11, '2023_05_26_131625_role', 5),
(12, '2023_05_26_170918_create_notifications_table', 6),
(13, '2023_05_27_145645_user_id_to_settings', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `sendedBy` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `userId`, `title`, `message`, `sendedBy`, `created_at`, `updated_at`) VALUES
(4, 20, 'System', 'Your subscription will expire in 2023 Jun 26.', 29, '2023-05-26 16:29:54', '2023-05-26 16:29:54'),
(5, 32, 'System', 'Your subscription will expire in 2023 Jun 27.', 20, '2023-05-27 13:04:48', '2023-05-27 13:04:48'),
(6, 33, 'System', 'Your subscription will expire in 2023 Jun 27.', 32, '2023-05-27 13:57:15', '2023-05-27 13:57:15'),
(7, 36, 'System', 'Your subscription will expire in 2023 Jun 27.', 20, '2023-05-27 17:28:32', '2023-05-27 17:28:32'),
(8, 37, 'System', 'Your subscription will expire in 2023 Jun 27.', 20, '2023-05-27 17:31:03', '2023-05-27 17:31:03'),
(9, 38, 'System', 'Your subscription will expire in 2023 Jun 27.', 20, '2023-05-27 19:31:24', '2023-05-27 19:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('jfroosama10@gmail.com', '$2y$10$kgNXy5.UXaVC8S1rPdWwkOG5V2DqwREgE4U1BbGVPxsKBqBrI/3a6', '2023-05-27 15:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `slug` varchar(500) NOT NULL,
  `sourceUrl` varchar(400) DEFAULT NULL,
  `demoUrl` varchar(400) DEFAULT NULL,
  `deleted_at` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `userId`, `title`, `description`, `path`, `type`, `slug`, `sourceUrl`, `demoUrl`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 22, 'satamqx', 'test', '/img/cases/JfrO_HOW_DOES_AI_looks_like_50472c71-6209-41f2-b675-93911a6c704a.png', NULL, 'satamqx', NULL, NULL, '2023-05-24 15:18:27', '2023-05-17 05:45:32', '2023-05-24 13:18:27'),
(7, 22, 'test', 'test', '/img/cases/Singlelinkedlist.png', NULL, 'test-1', NULL, NULL, '2023-05-24 14:51:57', '2023-05-17 05:56:02', '2023-05-24 12:51:57'),
(11, 20, 'test', 'test', '/img/cases/IMG-20200301-WA0023.jpeg', NULL, 'test', NULL, NULL, NULL, '2023-05-25 11:17:45', '2023-05-25 11:17:45'),
(12, 32, 'account mangment', 'testing', '/img/cases/system2.webp', NULL, 'account-mangment', NULL, NULL, NULL, '2023-05-27 16:11:37', '2023-05-27 16:11:37'),
(13, 38, 'test', 'test', '/img/cases/system2.webp', NULL, 'test', NULL, NULL, NULL, '2023-05-27 19:38:47', '2023-05-27 19:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `api_token`, `created_at`, `updated_at`, `userId`) VALUES
(1, 'xSf1pvnMobVx15mjcCKS', NULL, '2023-05-27 12:20:05', 20),
(3, '5mv1SnfcbSKjxpMoxCV1', '2023-05-27 13:04:48', '2023-05-27 13:04:48', 32),
(4, 'MbVSmvxS51CKno1fxpcj', '2023-05-27 13:57:15', '2023-05-27 13:57:15', 33),
(5, 'Mnx1Sv1boSmfKxCVpjc5', '2023-05-27 17:27:08', '2023-05-27 17:27:08', 35),
(6, 'KfxSmj1Co15McpVSxvbn', '2023-05-27 17:28:32', '2023-05-27 17:28:32', 36),
(7, 'n5S1MxKvp1bVxCjmocSf', '2023-05-27 17:31:03', '2023-05-27 17:31:03', 37),
(8, 'kJIVQiUiPWwC54v5frxs', '2023-05-27 19:31:24', '2023-05-27 19:37:17', 38);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `job` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `avatar` varchar(333) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subscription_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `job`, `city`, `address`, `description`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `subscription_end_date`) VALUES
(20, 'Hkaleefah', 'Admin', 'jfroosama10@gmail.com', 'front-end developer', 'Denmark', 'Nyborg', 'goood', NULL, NULL, '$2a$12$HaPkwZu.ANedITbO948k8Ou2ugmDe6f8Mx6ishwRoNZrN6YgWQNAi', NULL, NULL, '2023-05-23 19:32:08', '2023-06-26'),
(22, 'jfro', NULL, 'jaafarosama75@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2a$12$5dn6YrRWunVqU.Gb/cdIR.0n8oiHqXTK3y3QaSS0IhrpGN54cf7HK', NULL, NULL, NULL, NULL),
(32, 'test for the api', NULL, 'test2@gmail.com', NULL, 'Delfzijl', '40 Zwet', NULL, NULL, NULL, '$2y$10$B2uW70tI3K5VRDUkP7gPqOltkShDt8OXBnkime02g2VXCIYyiQKJW', NULL, '2023-05-27 13:04:48', '2023-05-27 13:04:48', '2023-06-27'),
(38, 'satamqx', NULL, 'satamqx@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$hgq6dUAszrLMKN49rmlT5eWAtnBoD54CQqH0d043NPEIQJkxZvfJ6', NULL, '2023-05-27 19:31:24', '2023-05-27 19:31:24', '2023-06-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
