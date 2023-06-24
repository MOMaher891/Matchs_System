-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2023 at 03:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matches_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `image`, `phone`, `is_blocked`, `created_at`, `updated_at`) VALUES
(1, 'Mohamed Maher', 'admin@admin.com', '$2y$10$JqaVwGVtTZRLTMBA2rdAGeu9Yrzlmb5vZJfqkUFucv.1oyEhv434S', NULL, '', 0, NULL, NULL),
(2, 'Mohamed Magdy', 'admin1@admin.com', '$2y$10$6VP/RC2k5WEoahYSgLO0Ceuf1JL6G6gDGv6ImZ9ybDV9FkGavyE8O', 'Yl0pc8LQQT6rwqvju68Twnxm7r24EQahhL0KJdeA.png', '+201113050566', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blocked_users`
--

CREATE TABLE `blocked_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blocked_users`
--

INSERT INTO `blocked_users` (`id`, `client_id`, `admin_id`, `created_at`, `updated_at`) VALUES
(4, 17, 1, '2023-06-10 09:34:43', '2023-06-10 09:34:43');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `stadium_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('const','once') NOT NULL DEFAULT 'once',
  `total` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('bending','accept','decline') NOT NULL DEFAULT 'bending',
  `times` varchar(255) DEFAULT NULL,
  `date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_requests`
--

CREATE TABLE `book_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `stadium_id` bigint(20) UNSIGNED NOT NULL,
  `time` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_times`
--

CREATE TABLE `book_times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `time_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(6, 'قضاء المتن', NULL, NULL, NULL),
(7, 'قضاء بعبدا', NULL, NULL, NULL),
(8, 'قضاء عاليه', NULL, NULL, NULL),
(9, 'قضاء الشوف', NULL, NULL, NULL),
(10, 'قضاء جبيل', NULL, NULL, NULL),
(11, 'قضاء الهرمل', NULL, NULL, NULL),
(12, 'قضاء راشيا', NULL, NULL, NULL),
(13, 'قضاء البقاع الغربي', NULL, NULL, NULL),
(14, 'قضاء زحلة', NULL, NULL, NULL),
(17, 'قضاء زحلة', NULL, NULL, NULL),
(18, 'قضاء بعلبك', NULL, NULL, NULL),
(19, 'قضاء الهرمل', NULL, NULL, NULL),
(20, 'قضاء الضنية', NULL, NULL, NULL),
(21, 'قضاء الكورة', NULL, NULL, NULL),
(22, 'قضاء البترون', NULL, NULL, NULL),
(23, 'قضاء بشري', NULL, NULL, NULL),
(24, 'قضاء زغرتا - الزاوية', NULL, NULL, NULL),
(25, 'قضاء طرابلس', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `otp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `password`, `address`, `birth_date`, `long`, `lat`, `image`, `is_blocked`, `created_at`, `updated_at`, `verified`, `otp`) VALUES
(16, 'Mohamed Maher', '+201147151491', '$2y$10$IQLuZn7W8meJpjofKtTf8ehxWz.6caGGc0SqyKFuPFE.JxtfPNgLK', 'Cairo', '2023-05-01', NULL, NULL, NULL, 0, NULL, NULL, 1, '98376'),
(17, 'Mohamed', '+201113050566', '$2y$10$UoDcTi6nLzyJcKt6rfMbw.LIyGknmEK7UfH2QNXUcmyJk3M3Yw8ki', 'Cairo', '2023-05-10', NULL, NULL, NULL, 0, NULL, NULL, 1, '74492');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'EG', NULL, NULL),
(3, 'EG', NULL, NULL),
(4, 'EG', NULL, NULL),
(5, 'SA', NULL, NULL),
(6, 'LB', NULL, NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_05_10_120839_create_admins_table', 1),
(5, '2023_05_10_120920_create_clients_table', 1),
(6, '2023_05_10_121101_create_countries_table', 1),
(7, '2023_05_10_121107_create_cities_table', 1),
(8, '2023_05_10_121116_create_regions_table', 1),
(9, '2023_05_10_121130_create_times_table', 1),
(10, '2023_05_10_121151_create_stadia_table', 1),
(11, '2023_05_10_121229_create_book_requests_table', 1),
(12, '2023_05_10_121329_create_bookings_table', 1),
(13, '2023_05_10_121350_create_book_times_table', 1),
(14, '2023_05_10_121412_create_stadium_images_table', 1),
(15, '2023_05_10_121427_create_blocked_users_table', 1),
(16, '2023_05_11_104321_add_password_column_for_clients_table', 1),
(17, '2023_05_12_130149_add_image_to_users_table', 1),
(18, '2023_05_12_234250_add_accoun_verefied_column', 1),
(19, '2023_05_13_211954_create_is_admin_column', 2),
(20, '2023_05_18_142938_add_column_type_to_stadiums_table', 3),
(21, '2023_05_18_160312_add_otp_to_client', 4),
(22, '2023_05_21_174606_add_column_to_stadiums', 5),
(23, '2023_05_21_192545_add_status_to_booking', 6),
(24, '2023_05_21_212407_add_times_to_bookings', 6),
(25, '2023_05_24_133322_add_date_bookings_table', 7),
(26, '2023_05_24_133727_add_date_book_times_table', 7),
(27, '2023_05_27_004802_add_admin_id_col', 8),
(28, '2023_06_07_064054_add_total_col', 9),
(29, '2023_06_07_233049_add_weather_table_stadiums', 10),
(30, '2023_06_07_233456_add_weather_table_stadiums', 11),
(31, '2023_06_07_233651_add_weather_table_stadiums', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `city_id`, `created_at`, `updated_at`) VALUES
(5, 'Region1', 6, NULL, NULL),
(6, 'Region2', 7, NULL, NULL),
(7, 'Region3', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stadiums`
--

CREATE TABLE `stadiums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `phone` varchar(255) NOT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT 0,
  `long` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `region_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 10,
  `num_of_player` int(11) DEFAULT 10,
  `clothes` tinyint(1) DEFAULT 0,
  `bathroom` tinyint(1) DEFAULT 0,
  `s_bathroom` tinyint(1) DEFAULT 0,
  `period` varchar(255) DEFAULT NULL,
  `weather` enum('winter','summer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stadiums`
--

INSERT INTO `stadiums` (`id`, `name`, `description`, `price`, `phone`, `is_open`, `long`, `lat`, `region_id`, `admin_id`, `created_at`, `updated_at`, `type`, `num_of_player`, `clothes`, `bathroom`, `s_bathroom`, `period`, `weather`) VALUES
(23, 'Al-Ahly', '<p>Welcome in our stadium</p>', 150, '+201501036198', 1, '35.490490468634476', '33.854004042810175', 7, 1, NULL, NULL, 10, 10, 1, 1, 1, '1,2', 'winter'),
(27, 'Model', '<p>Welcome in this stadium</p>', 1520.25, '01145341512', 1, '36.70873161142627', '34.01003594028436', 6, 2, NULL, NULL, 10, 10, 1, 1, 1, NULL, NULL),
(29, 'admin', '<p>dfdfdfdfkdfjkfj</p>', 1470, '01145341515', 1, '35.70943066068048', '34.00736231649247', 6, 2, NULL, NULL, 10, 6, 1, 1, 1, '1,2,3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stadium_images`
--

CREATE TABLE `stadium_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stadium_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stadium_images`
--

INSERT INTO `stadium_images` (`id`, `image`, `stadium_id`, `created_at`, `updated_at`) VALUES
(14, 't8SPE5DBIzRCuIk2cTTtkjoEj6ELnZYHuYmHJkEM.jpg', 15, NULL, NULL),
(15, 'cCorPRbK30vDrcGN0r7lT3of0s4LVjgr5S7ImGMj.jpg', 15, NULL, NULL),
(16, 'TCYNX3GFcRDwZzjoWwwAwDFtJgtHDJ7gSU1g4jTY.jpg', 15, NULL, NULL),
(17, 'yjinU1veH240ONnWMDD1hT1BnYy5EJT7Ax5EDOq8.jpg', 15, NULL, NULL),
(18, 'HtngUADOvGwk8Fc9llrJzI0YKqi1Jl8785NiKEcY.jpg', 16, NULL, NULL),
(19, 'SO2h9KXtIvNJKF9LGzggQz2LM4bpK8DiME3YWtZT.jpg', 16, NULL, NULL),
(20, 'OeoLtec7lV50mZZkMe03hxlK5zKe3SCQILRGbQf3.jpg', 16, NULL, NULL),
(21, '41qvcYivpzy4RRS1iAFC2myMI4vy4DVOUHkuQaTl.jpg', 16, NULL, NULL),
(22, '7vK4ywXiNStGM1vQeNNslQJOkaNHgOdVySPSNm99.jpg', 17, NULL, NULL),
(23, 'oC57671fMeGkp7J5SV286agsYPsueSh1WvnhbQ1E.jpg', 17, NULL, NULL),
(24, 'Xk9yO8iQdUtgIntx0youf3EzAseqqAJfmzziVWbs.jpg', 17, NULL, NULL),
(25, 'obWVq0NPslflfV3MzWws0l2N1O7q6lPxzrdBmriK.jpg', 18, NULL, NULL),
(26, 'LjtYxs5HsBTS1w1rYEMPsLHCil2ErPekJrZoP08o.jpg', 18, NULL, NULL),
(27, 'BsBnjzN9PjnJsJqKRUIGo83XxhHB9440VeHf9prV.jpg', 18, NULL, NULL),
(28, 'DGiscm1eQRyp8L14ZarpkMHVZYz4q0HoQfVBjyhP.jpg', 18, NULL, NULL),
(29, '77yw3hEz4fCf6jlzSrI9ZBhL0aRXMCXuescngnkp.jpg', 19, NULL, NULL),
(30, 'O7XiMw3DNDaQ6LMNUKzOhPSW9Ega3gvfQhLYkLmj.jpg', 19, NULL, NULL),
(31, 'SPJyFKfDVMjvhnEKqDmjIKL06XZcgDwaV1FNxBsd.jpg', 19, NULL, NULL),
(32, 'K6o4yaeWYg7XrUayTDlPgxWDnKSS7rDMCDjaccwN.jpg', 19, NULL, NULL),
(33, 'kM8f9Nn9dmTEeGrd57WwpSGli49DvclU0BRr8z2O.png', 20, NULL, NULL),
(34, '5mjknFbUdkUrYJWFu7MOoE7Zoq13XjSK8fSXimHc.png', 20, NULL, NULL),
(35, 'oz06OrgiEbLVaKFTVE4j7sCLTz4Un4ARWs41H9Bl.png', 20, NULL, NULL),
(42, '0iEeif6C5wBiScH2dutBu5cOe6X2tVBXkrl3lcng.jpg', 23, NULL, NULL),
(43, 'HD2jAo5M5OXF32AfRyKcxGOf16Q6nCvLhAqGwmZr.jpg', 27, NULL, NULL),
(44, 'xOqn0ywH4vQJL61K1IxoAOhsrESyTIWn7gr7dyaZ.jpg', 27, NULL, NULL),
(45, 'QbA26R3hh4cOrRzpHYVfEXoIOkMk11gz7rvSG9uT.jpg', 27, NULL, NULL),
(47, 'Jq4C2Stp4NfyhLf16pYjhFOspNEVGhnPCtjFRurg.jpg', 29, NULL, NULL),
(48, 'Uszbkcat2X2QycBPQ1BM7cL85OrCaRPXipTDKthh.jpg', 29, NULL, NULL),
(49, 'mUQ9ceJp8rBG9M19Lv0u3xcip8FrrlPFGsCVJZST.jpg', 29, NULL, NULL),
(50, 'SYie5kytofoOHKr6kyVsrfusN4LZsN63ynSSFHOM.jpg', 29, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `times`
--

CREATE TABLE `times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `times`
--

INSERT INTO `times` (`id`, `from`, `to`, `created_at`, `updated_at`) VALUES
(1, '00:00:00', '00:30:00', NULL, NULL),
(2, '00:30:00', '01:00:00', NULL, NULL),
(3, '01:00:00', '01:30:00', NULL, NULL),
(4, '01:30:00', '02:00:00', NULL, NULL),
(5, '02:00:00', '02:30:00', NULL, NULL),
(6, '02:30:00', '03:00:00', NULL, NULL),
(7, '03:00:00', '03:30:00', NULL, NULL),
(8, '03:30:00', '04:00:00', NULL, NULL),
(9, '04:00:00', '04:30:00', NULL, NULL),
(10, '04:30:00', '05:00:00', NULL, NULL),
(11, '05:00:00', '05:30:00', NULL, NULL),
(12, '05:30:00', '06:00:00', NULL, NULL),
(13, '06:00:00', '06:30:00', NULL, NULL),
(14, '06:30:00', '07:00:00', NULL, NULL),
(15, '07:00:00', '07:30:00', NULL, NULL),
(16, '07:30:00', '08:00:00', NULL, NULL),
(17, '08:00:00', '08:30:00', NULL, NULL),
(18, '08:30:00', '09:00:00', NULL, NULL),
(19, '09:00:00', '09:30:00', NULL, NULL),
(20, '09:30:00', '10:00:00', NULL, NULL),
(21, '10:00:00', '10:30:00', NULL, NULL),
(22, '10:30:00', '11:00:00', NULL, NULL),
(23, '11:00:00', '11:30:00', NULL, NULL),
(24, '11:30:00', '12:00:00', NULL, NULL),
(25, '12:00:00', '12:30:00', NULL, NULL),
(26, '12:30:00', '13:00:00', NULL, NULL),
(27, '13:00:00', '13:30:00', NULL, NULL),
(28, '13:30:00', '14:00:00', NULL, NULL),
(29, '14:00:00', '14:30:00', NULL, NULL),
(30, '14:30:00', '15:00:00', NULL, NULL),
(31, '15:00:00', '15:30:00', NULL, NULL),
(32, '15:30:00', '16:00:00', NULL, NULL),
(33, '16:00:00', '16:30:00', NULL, NULL),
(34, '16:30:00', '17:00:00', NULL, NULL),
(35, '17:00:00', '17:30:00', NULL, NULL),
(36, '17:30:00', '18:00:00', NULL, NULL),
(37, '18:00:00', '18:30:00', NULL, NULL),
(38, '18:30:00', '19:00:00', NULL, NULL),
(39, '19:00:00', '19:30:00', NULL, NULL),
(40, '19:30:00', '20:00:00', NULL, NULL),
(41, '20:00:00', '20:30:00', NULL, NULL),
(42, '20:30:00', '21:00:00', NULL, NULL),
(43, '21:00:00', '21:30:00', NULL, NULL),
(44, '21:30:00', '22:00:00', NULL, NULL),
(45, '22:00:00', '22:30:00', NULL, NULL),
(46, '22:30:00', '23:00:00', NULL, NULL),
(47, '23:00:00', '23:30:00', NULL, NULL),
(48, '23:30:00', '00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'super_admin', 'superadmin@admin.com', NULL, '$2y$10$KnQQNoK3/Bdn9e2bcH0zEuC9VMzgewymX1X80mWv9.YsEteLeBMhS', NULL, NULL, '2023-05-13 10:31:42', '2023-05-13 10:31:42', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`);

--
-- Indexes for table `blocked_users`
--
ALTER TABLE `blocked_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blocked_users_client_id_foreign` (`client_id`),
  ADD KEY `blocked_users_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_code_unique` (`code`),
  ADD KEY `bookings_client_id_foreign` (`client_id`),
  ADD KEY `bookings_stadium_id_foreign` (`stadium_id`);

--
-- Indexes for table `book_requests`
--
ALTER TABLE `book_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_requests_client_id_foreign` (`client_id`),
  ADD KEY `book_requests_stadium_id_foreign` (`stadium_id`);

--
-- Indexes for table `book_times`
--
ALTER TABLE `book_times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_times_book_id_foreign` (`book_id`),
  ADD KEY `book_times_time_id_foreign` (`time_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_phone_unique` (`phone`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regions_city_id_foreign` (`city_id`);

--
-- Indexes for table `stadiums`
--
ALTER TABLE `stadiums`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stadiums_phone_unique` (`phone`),
  ADD KEY `stadiums_region_id_foreign` (`region_id`),
  ADD KEY `stadiums_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `stadium_images`
--
ALTER TABLE `stadium_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stadium_images_stadium_id_foreign` (`stadium_id`);

--
-- Indexes for table `times`
--
ALTER TABLE `times`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blocked_users`
--
ALTER TABLE `blocked_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- AUTO_INCREMENT for table `book_requests`
--
ALTER TABLE `book_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_times`
--
ALTER TABLE `book_times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=372;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stadiums`
--
ALTER TABLE `stadiums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `stadium_images`
--
ALTER TABLE `stadium_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `times`
--
ALTER TABLE `times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocked_users`
--
ALTER TABLE `blocked_users`
  ADD CONSTRAINT `blocked_users_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blocked_users_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_stadium_id_foreign` FOREIGN KEY (`stadium_id`) REFERENCES `stadiums` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `book_requests`
--
ALTER TABLE `book_requests`
  ADD CONSTRAINT `book_requests_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_requests_stadium_id_foreign` FOREIGN KEY (`stadium_id`) REFERENCES `stadiums` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `book_times`
--
ALTER TABLE `book_times`
  ADD CONSTRAINT `book_times_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_times_time_id_foreign` FOREIGN KEY (`time_id`) REFERENCES `times` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stadiums`
--
ALTER TABLE `stadiums`
  ADD CONSTRAINT `stadiums_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stadiums_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stadium_images`
--
ALTER TABLE `stadium_images`
  ADD CONSTRAINT `stadium_images_stadium_id_foreign` FOREIGN KEY (`stadium_id`) REFERENCES `stadiums` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
