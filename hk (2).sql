-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 08:14 PM
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
(25, 4, 'test', 'tset', 'Text', NULL, NULL, '2023-05-17 03:10:13', '2023-05-17 03:10:05', '2023-05-17 03:10:13'),
(32, 5, 'test', 'test', 'Text', NULL, NULL, '2023-05-23 15:33:14', '2023-05-17 05:43:42', '2023-05-23 15:33:14'),
(54, 10, 'test', 'test', 'Text', NULL, '0', '2023-05-22 17:58:04', '2023-05-22 17:14:34', '2023-05-22 17:58:04'),
(55, 10, 'test', 'test', 'Text', NULL, '3', '2023-05-22 17:58:04', '2023-05-22 17:14:44', '2023-05-22 17:58:04'),
(56, 10, NULL, NULL, 'Foto', 'MO_A_beautiful_girl_from_Yanbu_realistic_8k_265940ea-9dbc-411a-86b8-f208f309008c.png', '2', '2023-05-22 17:58:04', '2023-05-22 17:15:04', '2023-05-22 17:58:04'),
(57, 10, NULL, NULL, 'Foto', 'JfrO_HOW_DOES_AI_looks_like_50472c71-6209-41f2-b675-93911a6c704a.png', '1', '2023-05-22 17:58:04', '2023-05-22 17:15:04', '2023-05-22 17:58:04'),
(58, 10, NULL, NULL, 'Foto', '---512.jpg', '4', '2023-05-22 17:58:04', '2023-05-22 17:15:04', '2023-05-22 17:58:04'),
(59, 5, 'test', 'tset', 'Text', NULL, NULL, '2023-05-23 15:33:14', '2023-05-22 18:03:07', '2023-05-23 15:33:14'),
(60, 5, 'test', 'test', 'Text', NULL, NULL, '2023-05-23 15:33:14', '2023-05-22 18:03:15', '2023-05-23 15:33:14'),
(61, 5, 'test', 'test', 'Text', NULL, NULL, '2023-05-23 15:33:14', '2023-05-22 18:03:23', '2023-05-23 15:33:14');

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
(4, NULL, 'ahmed birhtday', '2023-08-30', '2023-08-30', NULL, NULL, '2023-05-11 14:07:07', '2023-05-11 14:07:07'),
(29, 20, 'ختبار الفاينل', '2023-06-13', '2023-06-14', '08:30', '09:30', '2023-05-19 02:04:25', '2023-05-23 15:31:27'),
(37, 20, 'طبيب اسنان', '2023-05-29', '2023-05-29', '09:00', '10:00', '2023-05-23 15:30:00', '2023-05-23 15:30:29'),
(38, 20, 'محاضره علوم', '2023-05-26', '2023-05-28', '14:00', '15:00', '2023-05-23 15:31:05', '2023-05-23 15:31:05');

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
(9, '2023_05_20_155905_create_skills_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

INSERT INTO `projects` (`id`, `title`, `description`, `path`, `type`, `slug`, `sourceUrl`, `demoUrl`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 'test', 'test', '/img/cases/Singlelinkedlist.png', NULL, 'test', NULL, NULL, '2023-05-23 17:33:14', '2023-05-17 03:10:28', '2023-05-23 15:33:14'),
(6, 'satamqx', 'test', '/img/cases/JfrO_HOW_DOES_AI_looks_like_50472c71-6209-41f2-b675-93911a6c704a.png', NULL, 'satamqx', NULL, NULL, '2023-05-23 17:33:17', '2023-05-17 05:45:32', '2023-05-23 15:33:17'),
(7, 'test', 'test', '/img/cases/Singlelinkedlist.png', NULL, 'test-1', NULL, NULL, NULL, '2023-05-17 05:56:02', '2023-05-22 18:02:27'),
(10, 'test', 'tesrt', '/img/cases/JfrO_HOW_DOES_AI_looks_like_50472c71-6209-41f2-b675-93911a6c704a.png', NULL, 'test-2', NULL, NULL, '2023-05-22 19:58:04', '2023-05-22 17:13:31', '2023-05-22 17:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'ht$cL8@lGtE9RZDHW7if', NULL, '2023-05-22 17:38:06');

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

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `userId`, `name`, `created_at`, `updated_at`) VALUES
(27, 20, 'Html', '2023-05-23 10:06:42', '2023-05-23 10:06:42'),
(28, 20, 'CSS', '2023-05-23 10:06:42', '2023-05-23 10:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `job`, `city`, `address`, `description`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(20, 'Hkaleefah', 'jfroosama10@gmail.com', 'front-end developer', 'Denmark', 'Nyborg', NULL, NULL, NULL, '$2a$12$HaPkwZu.ANedITbO948k8Ou2ugmDe6f8Mx6ishwRoNZrN6YgWQNAi', NULL, NULL, '2023-05-23 10:47:38');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
