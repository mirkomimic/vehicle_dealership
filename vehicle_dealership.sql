-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220801.ff0b2d86c9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 01, 2023 at 08:15 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle_dealership`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'BMW', '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(2, 'Mercedes-Benz', '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(3, 'Volkswagen', '2023-07-23 17:48:04', '2023-07-23 17:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `vehicle_id`, `user_id`, `parent_id`, `comment`, `created_at`, `updated_at`) VALUES
(12, 101, 1, NULL, '1', '2023-07-31 18:38:32', '2023-07-31 18:38:32'),
(13, 101, 1, 12, '1.1', '2023-07-31 18:39:21', '2023-07-31 18:39:21'),
(14, 101, 1, NULL, '2', '2023-07-31 18:39:58', '2023-07-31 18:39:58'),
(15, 101, 1, 14, '2.1', '2023-07-31 18:40:11', '2023-07-31 18:40:11'),
(16, 101, 1, 15, '2.1.1', '2023-07-31 18:40:47', '2023-07-31 18:40:47'),
(17, 101, 1, 14, '2.2', '2023-07-31 18:48:06', '2023-07-31 18:48:06');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_23_103507_create_brands_table', 1),
(7, '2023_07_23_115314_create_vehicle_types_table', 1),
(8, '2023_07_23_183101_create_models_table', 1),
(9, '2023_07_23_191030_create_vehicles_table', 1),
(11, '2023_07_27_060033_create_vehicle_imgs_table', 2),
(13, '2023_07_29_145548_create_comments_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `name`, `brand_id`, `vehicle_type_id`, `created_at`, `updated_at`) VALUES
(1, 'ducimus0', 3, 3, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(2, 'qui35', 1, 2, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(3, 'harum33', 1, 2, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(4, 'non11', 1, 2, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(5, 'ut13', 3, 3, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(6, 'doloribus29', 3, 3, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(7, 'et69', 1, 3, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(8, 'dolorem70', 3, 3, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(9, 'cumque40', 3, 1, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(10, 'et73', 1, 1, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(11, 'pariatur76', 3, 1, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(12, 'eveniet0', 2, 1, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(13, 'quia95', 3, 1, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(14, 'quia90', 2, 3, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(15, 'dicta27', 1, 1, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(16, 'qui88', 3, 1, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(17, 'doloremque96', 1, 1, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(18, 'dolores26', 1, 2, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(19, 'quaerat17', 1, 3, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(20, 'praesentium65', 3, 2, '2023-07-23 17:48:04', '2023-07-23 17:48:04');

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mirko', 'mirko@example.com', '2023-07-23 17:48:04', '$2y$10$Q2ahgAo7FceQD0yqvntbKujD9JSG2OK277xdedsMecJAA2oCAqx52', 'KXHzqdci8e', '2023-07-23 17:48:04', '2023-07-23 17:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `mileage` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `model_id`, `price`, `year`, `mileage`, `created_at`, `updated_at`) VALUES
(1, 18, 64833.00, 2008, 725, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(2, 13, 34190.00, 2020, 28141, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(3, 5, 46627.00, 2016, 16548, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(4, 17, 54710.00, 2008, 31087, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(5, 3, 20952.00, 2022, 54277, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(6, 17, 74359.00, 2014, 5346, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(7, 2, 9090.00, 2023, 91050, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(8, 4, 23972.00, 2014, 99445, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(9, 1, 29269.00, 2017, 31682, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(10, 10, 93740.00, 2006, 96406, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(11, 18, 5556.00, 2021, 58914, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(12, 2, 55241.00, 2014, 21177, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(13, 9, 35808.00, 2001, 93330, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(14, 5, 48835.00, 2006, 36569, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(15, 17, 13871.00, 2008, 23311, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(16, 13, 84517.00, 2007, 31859, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(17, 17, 3207.00, 2015, 33758, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(18, 12, 69798.00, 2016, 72147, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(19, 7, 97063.00, 2004, 54446, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(20, 16, 16927.00, 2021, 70767, '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(21, 2, 1626.86, 2014, 1234, '2023-07-26 14:53:53', '2023-07-26 14:53:53'),
(22, 2, 14000.00, 2017, 12324, '2023-07-26 15:05:17', '2023-07-26 15:05:17'),
(23, 7, 23454.00, 2013, 23453, '2023-07-26 15:06:10', '2023-07-26 15:06:10'),
(24, 12, 45432.00, 2016, 33333, '2023-07-26 15:08:13', '2023-07-26 15:08:13'),
(25, 6, 44534.00, 2016, 55544, '2023-07-26 15:08:42', '2023-07-26 15:08:42'),
(26, 3, 14000.00, 2016, 5555, '2023-07-26 15:09:54', '2023-07-26 15:09:54'),
(27, 12, 1626.86, 2015, 5555, '2023-07-26 15:13:06', '2023-07-26 15:13:06'),
(28, 7, 1626.86, 1984, 3434, '2023-07-26 15:15:02', '2023-07-26 15:15:02'),
(29, 3, 1626.86, 2012, 3454, '2023-07-26 15:16:30', '2023-07-26 15:16:30'),
(30, 3, 3453.00, 2010, 4444, '2023-07-26 17:06:55', '2023-07-26 17:06:55'),
(101, 4, 195.00, 1988, 3, '2023-07-27 09:42:32', '2023-07-27 09:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_imgs`
--

CREATE TABLE `vehicle_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_imgs`
--

INSERT INTO `vehicle_imgs` (`id`, `vehicle_id`, `img`, `created_at`, `updated_at`) VALUES
(9, 101, '8g3IfH4FY8OvGEs4f9v90LYDc9DMbdtBEZS2IIf7.jpg', '2023-07-27 09:42:32', '2023-07-27 09:42:32'),
(10, 101, 'BqZo7YgveKhs9LSAem5f4PZdJ5qXhtDSx6HxpJvg.jpg', '2023-07-27 09:42:32', '2023-07-27 09:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Automobile', '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(2, 'Motorcycle', '2023-07-23 17:48:04', '2023-07-23 17:48:04'),
(3, 'Truck', '2023-07-23 17:48:04', '2023-07-23 17:48:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

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
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `models_name_unique` (`name`),
  ADD KEY `models_brand_id_foreign` (`brand_id`),
  ADD KEY `models_vehicle_type_id_foreign` (`vehicle_type_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_model_id_foreign` (`model_id`);

--
-- Indexes for table `vehicle_imgs`
--
ALTER TABLE `vehicle_imgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_imgs_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `vehicle_imgs`
--
ALTER TABLE `vehicle_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `models_vehicle_type_id_foreign` FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_types` (`id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`);

--
-- Constraints for table `vehicle_imgs`
--
ALTER TABLE `vehicle_imgs`
  ADD CONSTRAINT `vehicle_imgs_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
