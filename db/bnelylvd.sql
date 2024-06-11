-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 25, 2023 at 06:55 AM
-- Server version: 10.4.28-MariaDB-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bnelylvd_bnbnelive`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `is_super`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$ShXyZTfZcu0NMjRAhHhAAO.gBHWZcYShLUFw7lGYVHnBcn1.67eaa', 0, NULL, '2023-01-26 06:19:58', '2023-01-26 06:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `bne_settings`
--

CREATE TABLE `bne_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `permission` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bne_settings`
--

INSERT INTO `bne_settings` (`id`, `title`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'create an event', 0, '2023-05-03 05:37:19', '2023-05-03 13:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `booking_histories`
--

CREATE TABLE `booking_histories` (
  `id` int(11) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `transaction_id` int(50) DEFAULT NULL,
  `coupon_id` int(50) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `event_id` int(50) DEFAULT NULL,
  `ticket_id` int(50) DEFAULT NULL,
  `qty` int(50) DEFAULT NULL,
  `ticket_booking_qr_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booking_histories`
--

INSERT INTO `booking_histories` (`id`, `user_id`, `transaction_id`, `coupon_id`, `amount`, `event_id`, `ticket_id`, `qty`, `ticket_booking_qr_code`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 903.98, 1, 1, 2, '1678103669.png', '2023-03-06 16:53:43', '2023-03-06 16:54:29'),
(2, 1, 2, 1, 56.99, 3, 5, 1, '1678104806.png', '2023-03-06 17:12:57', '2023-03-06 17:13:26'),
(3, 1, 3, 1, 1807.96, 1, 1, 4, '1678105177.png', '2023-03-06 17:18:57', '2023-03-06 17:19:37'),
(4, 1, 4, 1, 36.99, 3, 3, 1, '1678105319.png', '2023-03-06 17:21:18', '2023-03-06 17:21:59'),
(5, 6, 5, 1, 73.98, 3, 3, 2, '1678107769.png', '2023-03-06 18:00:55', '2023-03-06 18:02:49'),
(6, 4, 6, 1, 71.99, 5, 4, 1, NULL, '2023-03-06 19:09:31', '2023-03-06 19:09:31'),
(7, 4, 7, 1, 71.99, 5, 4, 1, '1678112017.png', '2023-03-06 19:11:14', '2023-03-06 19:13:37'),
(9, 4, 9, 1, 36.99, 3, 3, 1, '1678160760.png', '2023-03-07 08:45:24', '2023-03-07 08:46:00'),
(10, 1, 10, 1, 36.99, 3, 3, 1, '1678161795.png', '2023-03-07 09:02:13', '2023-03-07 09:03:15'),
(11, 1, 11, 1, 36.99, 3, 3, 1, '1678163118.png', '2023-03-07 09:23:29', '2023-03-07 09:25:18'),
(12, 1, 12, 1, 36.99, 3, 3, 1, NULL, '2023-03-07 09:28:48', '2023-03-07 09:28:48'),
(13, 1, 13, 1, 36.99, 3, 3, 1, NULL, '2023-03-07 09:32:48', '2023-03-07 09:32:48'),
(14, 1, 14, 1, 36.99, 3, 3, 1, NULL, '2023-03-07 09:41:00', '2023-03-07 09:41:00'),
(15, 1, 15, 1, 36.99, 3, 3, 1, NULL, '2023-03-07 09:50:11', '2023-03-07 09:50:11'),
(16, 1, 16, 1, 36.99, 3, 3, 1, NULL, '2023-03-07 09:55:59', '2023-03-07 09:55:59'),
(17, 1, 17, 1, 73.98, 3, 3, 2, NULL, '2023-03-07 10:07:27', '2023-03-07 10:07:27'),
(18, 1, 18, 1, 36.99, 3, 3, 1, NULL, '2023-03-07 10:18:11', '2023-03-07 10:18:11'),
(19, 1, 19, 1, 36.99, 3, 3, 1, NULL, '2023-03-07 10:28:40', '2023-03-07 10:28:40'),
(20, 1, 20, 1, 36.99, 3, 3, 1, NULL, '2023-03-07 10:35:32', '2023-03-07 10:35:32'),
(21, 1, 21, 1, 73.98, 3, 3, 2, NULL, '2023-03-07 10:37:58', '2023-03-07 10:37:58'),
(22, 1, 22, 1, 36.99, 3, 3, 1, NULL, '2023-03-07 10:40:40', '2023-03-07 10:40:40'),
(23, 1, 23, 1, 36.99, 3, 3, 1, NULL, '2023-03-07 10:43:44', '2023-03-07 10:43:44'),
(24, 1, 24, 1, 36.99, 3, 3, 1, NULL, '2023-03-07 10:53:36', '2023-03-07 10:53:36'),
(25, 1, 25, 1, 36.99, 3, 3, 1, '1678169923.png', '2023-03-07 11:18:13', '2023-03-07 11:18:43'),
(26, 4, 26, 1, 501.99, 3, 10, 1, '1678181869.png', '2023-03-07 14:34:34', '2023-03-07 14:37:50'),
(27, 13, 27, 1, 36.99, 3, 3, 1, '1678183925.png', '2023-03-07 15:10:54', '2023-03-07 15:12:05'),
(28, 11, 28, 1, 73.98, 3, 3, 2, '1678184205.png', '2023-03-07 15:15:13', '2023-03-07 15:16:45'),
(29, 13, 29, 1, 91.99, 1, 11, 1, NULL, '2023-03-07 16:16:28', '2023-03-07 16:16:28'),
(30, 1, 30, 1, 36.99, 3, 3, 1, '1678187845.png', '2023-03-07 16:16:55', '2023-03-07 16:17:25'),
(31, 1, 31, 1, 36.99, 3, 3, 1, '1678192253.png', '2023-03-07 17:30:16', '2023-03-07 17:30:53'),
(37, 15, 37, 1, 31.99, 16, 12, 1, '1679545878.png', '2023-03-23 08:30:22', '2023-03-23 08:31:18'),
(36, 14, 36, 1, 31.99, 16, 12, 1, NULL, '2023-03-23 08:23:59', '2023-03-23 08:23:59'),
(35, 14, 35, 1, 125.97, 16, 12, 3, NULL, '2023-03-23 08:19:37', '2023-03-23 08:19:37'),
(38, 15, 38, 1, 31.99, 16, 12, 1, '1679546119.png', '2023-03-23 08:34:37', '2023-03-23 08:35:20'),
(39, 15, 39, 1, 31.99, 16, 12, 1, NULL, '2023-03-23 08:39:02', '2023-03-23 08:39:02'),
(40, 15, 40, 1, 31.99, 16, 12, 1, NULL, '2023-03-23 08:41:22', '2023-03-23 08:41:22'),
(41, 1, 41, 1, NULL, 16, 12, 1, NULL, '2023-03-23 08:46:55', '2023-03-23 08:46:55'),
(42, 1, 42, 1, NULL, 16, 12, 1, NULL, '2023-03-23 08:47:44', '2023-03-23 08:47:44'),
(43, 1, 43, 1, NULL, 16, 12, 1, NULL, '2023-03-23 08:52:23', '2023-03-23 08:52:23'),
(44, 1, 44, 1, 46.99, 16, 12, 1, '1679547470.png', '2023-03-23 08:57:17', '2023-03-23 08:57:50'),
(45, 1, 45, 1, 31.99, 16, 12, 1, '1679547606.png', '2023-03-23 08:59:34', '2023-03-23 09:00:06'),
(46, 1, 46, 1, 110.18, 16, 13, 2, '1679548497.png', '2023-03-23 09:14:29', '2023-03-23 09:14:57'),
(47, 15, 47, 1, 275.45, 16, 13, 5, '1679549424.png', '2023-03-23 09:29:55', '2023-03-23 09:30:24'),
(48, 15, 48, 2, 246.46, 16, 13, 5, NULL, '2023-03-23 09:40:51', '2023-03-23 09:40:51'),
(49, 15, 49, NULL, 93.98, 16, 12, 2, '1679550287.png', '2023-03-23 09:44:17', '2023-03-23 09:44:47'),
(50, 6, 50, 1, 31.99, 16, 12, 1, NULL, '2023-03-23 13:54:23', '2023-03-23 13:54:23'),
(51, 6, 51, 2, 93.98, 16, 12, 2, NULL, '2023-03-23 13:59:56', '2023-03-23 13:59:56'),
(52, 6, 52, NULL, 46.99, 16, 12, 1, '1679565958.png', '2023-03-23 14:05:25', '2023-03-23 14:05:58'),
(53, 1, 53, NULL, 21.99, 6, 7, 1, '1679891346.png', '2023-03-27 08:28:34', '2023-03-27 08:29:06'),
(54, 14, 54, NULL, 215.97, 5, 4, 3, '1679891517.png', '2023-03-27 08:31:26', '2023-03-27 08:31:57'),
(55, 1, 55, 3, 46.99, 6, 8, 1, NULL, '2023-04-26 08:07:45', '2023-04-26 08:07:45'),
(56, 1, 56, NULL, 61.99, 6, 8, 1, NULL, '2023-04-26 08:10:00', '2023-04-26 08:10:00'),
(57, 1, 57, NULL, 61.99, 6, 8, 1, NULL, '2023-04-26 08:20:19', '2023-04-26 08:20:19'),
(58, 1, 58, NULL, 61.99, 17, 15, 1, '1683086104.png', '2023-05-03 07:52:59', '2023-05-03 07:55:05'),
(59, 4, 59, NULL, 61.99, 17, 15, 1, '1683086392.png', '2023-05-03 07:59:13', '2023-05-03 07:59:52'),
(60, 4, 60, NULL, 123.98, 17, 15, 2, '1683086506.png', '2023-05-03 08:01:06', '2023-05-03 08:01:46'),
(61, 4, 61, NULL, 61.99, 17, 15, 1, '1683086705.png', '2023-05-03 08:04:26', '2023-05-03 08:05:05'),
(62, 4, 62, NULL, 185.97, 17, 15, 3, '1683086847.png', '2023-05-03 08:06:50', '2023-05-03 08:07:27'),
(63, 4, 63, NULL, 61.99, 17, 15, 1, '1683087028.png', '2023-05-03 08:09:50', '2023-05-03 08:10:28'),
(64, 4, 64, NULL, 61.99, 17, 15, 1, '1683087331.png', '2023-05-03 08:15:00', '2023-05-03 08:15:31'),
(65, 4, 65, NULL, 61.99, 17, 15, 1, '1683087963.png', '2023-05-03 08:25:06', '2023-05-03 08:26:03'),
(66, 4, 66, NULL, 61.99, 17, 15, 1, '1683088084.png', '2023-05-03 08:27:29', '2023-05-03 08:28:04'),
(67, 4, 67, 5, 158.07, 17, 15, 3, '1683089090.png', '2023-05-03 08:44:03', '2023-05-03 08:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `cart_sessions`
--

CREATE TABLE `cart_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `coupon_id` int(20) NOT NULL,
  `total` float NOT NULL,
  `event_id` int(20) NOT NULL,
  `ticket_id` int(20) NOT NULL,
  `qty` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_value` varchar(255) DEFAULT NULL,
  `discount_flag` varchar(255) DEFAULT NULL,
  `no_of_coupon` int(11) DEFAULT NULL,
  `apply_discount` int(11) DEFAULT NULL,
  `event_id` int(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `coupon_value`, `discount_flag`, `no_of_coupon`, `apply_discount`, `event_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ASCOUPON', '15', '$', 10, 1, 16, 0, '2023-03-22 12:52:24', '2023-03-23 13:56:19'),
(2, 'ASCOUPON2', '10', '%', 17, 0, 16, 0, '2023-03-23 05:13:35', '2023-03-23 14:18:00'),
(3, 'EBCOUPON', '15', '$', 20, 0, 6, 0, '2023-03-27 07:05:30', '2023-03-29 09:45:43'),
(4, 'EBCOUPON1', '15', '%', 100, 0, 6, 0, '2023-04-26 04:05:26', '2023-04-26 08:06:47'),
(5, 'DEMOCOUPON', '15', '%', 99, 0, 17, 0, '2023-05-03 04:43:18', '2023-05-03 08:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `event_images` varchar(255) DEFAULT NULL,
  `event_host_by` varchar(1000) NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `event_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_location` varchar(255) DEFAULT NULL,
  `event_address` longtext DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_start_time` time DEFAULT NULL,
  `event_end_time` time DEFAULT NULL,
  `is_feature` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `is_approved` int(11) NOT NULL DEFAULT 0 COMMENT '0-approved 1-not approved	',
  `external_ticket_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `event_images`, `event_host_by`, `event_name`, `event_details`, `event_location`, `event_address`, `event_date`, `event_start_time`, `event_end_time`, `is_feature`, `status`, `is_approved`, `external_ticket_link`, `created_at`, `updated_at`) VALUES
(1, 0, 'event.jpg', 'tejasbhai', 'King Bartlett', 'xBk presents\nKing Bartlett\nw/ Neil Anders & Flash Floods\nSaturday, January 28th 2023\nDoors: 7pm\nTickets: $10 ADV // $15 DoS\nAll Ages\nShow: 8pm\n*All xBk shows are standing room with limited seating. If you require ADA accommodations please reach out\n\nKing Bartlett The Band pandemic. Because the lockdowns, they hunkered down and recorded impressive repertoire. Since 2020 they have full length albums and an EP and are currently recording their length album. Their music is a blend of indie rock, country/folk and indietronica. They will bringing all the work their pandemic rise from ashes to this debut\n\nKing Bartlett The Band pandemic. Because the lockdowns, they hunkered down and recorded impressive repertoire. Since 2020 they have full length albums and an EP and are currently recording their length album. Their music is a blend of indie rock, country/folk and indietronica. They will bringing all the work their pandemic rise from ashes to this debut\n\nKing Bartlett The Band pandemic. Because the lockdowns, they hunkered down and recorded impressive repertoire. Since 2020 they have full length albums and an EP and are currently recording their length album. Their music is a blend of indie rock, country/folk and indietronica. They will bringing all the work their pandemic rise from ashes to this debut\n\nKing Bartlett The Band pandemic. Because the lockdowns, they hunkered down and recorded impressive repertoire. Since 2020 they have full length albums and an EP and are currently recording their length album. Their music is a blend of indie rock, country/folk and indietronica. They will bringing all the work their pandemic rise from ashes to this debut', 'vr mall', 'vr mall near vesu', '2023-04-02', '10:00:00', '11:00:00', 0, 1, 0, NULL, '2023-01-27 04:53:34', '2023-04-25 11:03:30'),
(3, 0, 'event.jpg', 'jayeshbhai', 'Sanjay raval', 'King Bartlett The Band pandemic. Because the lockdowns, they hunkered down and recorded impressive repertoire. Since 2020 they have full length albums and an EP and are currently recording their length album. Their music is a blend of indie rock, country/folk and indietronica. They will bringing all the work their pandemic rise from ashes to this debut\r\n\r\nKing Bartlett The Band pandemic. Because the lockdowns, they hunkered down and recorded impressive repertoire. Since 2020 they have full length albums and an EP and are currently recording their length album. Their music is a blend of indie rock, country/folk and indietronica. They will bringing all the work their pandemic rise from ashes to this debut\r\n\r\nKing Bartlett The Band pandemic. Because the lockdowns, they hunkered down and recorded impressive repertoire. Since 2020 they have full length albums and an EP and are currently recording their length album. Their music is a blend of indie rock, country/folk and indietronica. They will bringing all the work their pandemic rise from ashes to this debut\r\n\r\nKing Bartlett The Band pandemic. Because the lockdowns, they hunkered down and recorded impressive repertoire. Since 2020 they have full length albums and an EP and are currently recording their length album. Their music is a blend of indie rock, country/folk and indietronica. They will bringing all the work their pandemic rise from ashes to this debut', 'katargam', 'ram katha road near ankur school ,aabatalavadi suart', '2023-04-20', '14:00:00', '17:00:00', 0, 0, 0, NULL, '2023-01-27 10:15:27', '2023-04-25 08:55:31'),
(5, 0, 'event_16759343790.png,event_16759343791.png', 'jayeshbhai', 'king', 'King Bartlett The Band pandemic. Because the lockdowns, they hunkered down and recorded impressive repertoire. Since 2020 they have full length albums and an EP and are currently recording their length album. Their music is a blend of indie rock, country/folk and indietronica. They will bringing all the work their pandemic rise from ashes to this debut\r\n\r\nKing Bartlett The Band pandemic. Because the lockdowns, they hunkered down and recorded impressive repertoire. Since 2020 they have full length albums and an EP and are currently recording their length album. Their music is a blend of indie rock, country/folk and indietronica. They will bringing all the work their pandemic rise from ashes to this debut\r\n\r\nKing Bartlett The Band pandemic. Because the lockdowns, they hunkered down and recorded impressive repertoire. Since 2020 they have full length albums and an EP and are currently recording their length album. Their music is a blend of indie rock, country/folk and indietronica. They will bringing all the work their pandemic rise from ashes to this debut\r\n\r\nKing Bartlett The Band pandemic. Because the lockdowns, they hunkered down and recorded impressive repertoire. Since 2020 they have full length albums and an EP and are currently recording their length album. Their music is a blend of indie rock, country/folk and indietronica. They will bringing all the work their pandemic rise from ashes to this debut', 'vr mall', '<p><a href=\"http://bne.live\">bne.live</a></p>', '2023-04-30', '21:00:00', '22:00:00', 0, 0, 0, NULL, '2023-02-01 04:13:19', '2023-04-25 09:19:37'),
(6, 0, 'event_16764903880.jpeg', 'Eric Benét', 'Eric Benét', 'Information and tickets for the concert Eric Benet, which is taking place on February 18, 2023 21:30 (Yoshi\'s, Oakland)', 'Yoshi\'s', '510 Embarcadero West, Oakland, CA 94607', '2023-04-29', '18:00:00', '21:00:00', 0, 0, 0, NULL, '2023-02-15 19:46:28', '2023-04-25 08:34:55'),
(14, 1, 'event_1679483006.jpg', 'ketan prajapati', 'Arijit Singh', 'Arijit Singh is an Indian singer and music composer. The recipient of several accolades including a National Film Award and six Filmfare Awards, he has recorded songs in several Indian languages and has established himself as one of the leading playback singers of Bollywood', 'Apple farm', 'VR mall vesu surat', '2023-03-26', '21:00:00', '23:00:00', 0, 1, 0, NULL, '2023-03-22 11:03:26', '2023-03-22 15:07:10'),
(15, 1, 'event_1679483070.jpg', 'ketan prajapati', 'Arijit Singh', 'Arijit Singh is an Indian singer and music composer. The recipient of several accolades including a National Film Award and six Filmfare Awards, he has recorded songs in several Indian languages and has established himself as one of the leading playback singers of Bollywood', 'Apple farm', 'VR mall vesu surat', '2023-03-26', '21:00:00', '23:00:00', 0, 1, 0, NULL, '2023-03-22 11:04:30', '2023-03-22 15:07:06'),
(16, 1, 'event_1679483202.jpg', 'Ketan prajapati', 'Arijit Singh', 'Arijit Singh is an Indian singer and music composer. The recipient of several accolades including a National Film Award and six Filmfare Awards, he has recorded songs in several Indian languages and has established himself as one of the leading playback singers of Bollywood', 'Apple farm', 'VR mall vesu surat', '2023-04-02', '21:00:00', '23:00:00', 0, 1, 0, NULL, '2023-03-22 11:06:42', '2023-05-03 10:05:22'),
(17, 1, 'event_1682400369.jpg', 'Ketan', 'demo', 'demo 😀 😃 😄', 'demo', '<p><a href=\"https://goo.gl/maps/MksUQLtw47vtHRj88\">https://goo.gl/maps/MksUQLtw47vtHRj88</a></p>', '2023-05-13', '10:55:00', '11:55:00', 0, 0, 0, NULL, '2023-04-25 05:26:09', '2023-05-12 13:01:13'),
(18, 1, 'event_1683262018.jpg', 'Ketan', 'demo', 'demo', 'demo', '<p>demo</p>', '2023-05-07', '10:16:00', '11:16:00', 0, 0, 0, NULL, '2023-05-05 04:46:58', '2023-05-18 13:25:57'),
(19, 0, 'event_1683883236.jpg', 'BNE live', 'test', '<p>test</p>', 'test', '<p>test</p>', '2023-05-21', '14:50:00', '15:50:00', 0, 0, 0, NULL, '2023-05-12 09:20:36', '2023-05-18 13:26:26'),
(20, 1, 'event_1683884068.png', 'Ketan', 'test test', '<p>test test2</p>', 'test test', '<p>test test</p>', '2023-05-28', '15:04:00', '16:04:00', 0, 0, 0, NULL, '2023-05-12 09:34:28', '2023-05-22 08:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `event_likes`
--

CREATE TABLE `event_likes` (
  `id` int(11) NOT NULL,
  `event_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `is_like` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `event_likes`
--

INSERT INTO `event_likes` (`id`, `event_id`, `user_id`, `is_like`, `created_at`, `updated_at`) VALUES
(14, 3, 1, 1, '2023-02-09 06:16:46', '2023-02-16 15:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `event_tickets`
--

CREATE TABLE `event_tickets` (
  `id` int(11) NOT NULL,
  `event_id` int(20) NOT NULL,
  `ticket_name` varchar(255) NOT NULL,
  `ticket_cost` float NOT NULL,
  `total_ticket` int(11) NOT NULL,
  `avail_seats` int(255) NOT NULL,
  `ticket_fee` float DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `event_tickets`
--

INSERT INTO `event_tickets` (`id`, `event_id`, `ticket_name`, `ticket_cost`, `total_ticket`, `avail_seats`, `ticket_fee`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'gold', 45, 70, 0, 1.99, NULL, 0, '2023-01-30 07:37:42', '2023-03-06 17:18:57'),
(3, 3, 'gold', 35, 100, 46, 4, NULL, 0, '2023-01-30 08:44:34', '2023-03-07 17:30:16'),
(4, 5, 'gold', 70, 200, 3, 1.99, NULL, 0, '2023-02-01 04:16:38', '2023-03-27 08:31:26'),
(5, 3, 'Platinum', 55, 200, 12, 2.99, NULL, 0, '2023-02-01 04:25:27', '2023-03-06 17:12:57'),
(6, 3, 'diamond', 65, 50, 0, 3.99, NULL, 0, '2023-02-01 04:26:12', '2023-02-01 00:24:34'),
(7, 6, 'Regular', 20, 100, 61, 1.99, NULL, 0, '2023-02-15 19:46:54', '2023-05-23 08:41:19'),
(8, 6, 'VIP', 60, 100, 28, 1.99, NULL, 0, '2023-02-15 19:47:08', '2023-04-26 08:20:19'),
(10, 8, 'Regular', 500, 100, 98, 1.99, NULL, 0, '2023-03-06 14:23:10', '2023-03-07 14:34:34'),
(11, 1, 'Platinum', 90, 100, 97, 1.99, NULL, 0, '2023-03-07 08:52:19', '2023-03-09 13:36:37'),
(12, 16, 'gold', 45, 100, 81, 1.99, NULL, 0, '2023-03-22 11:06:56', '2023-03-23 14:05:25'),
(13, 16, 'Platinum', 55, 150, 138, 2.99, NULL, 0, '2023-03-22 11:19:16', '2023-03-28 09:14:51'),
(15, 17, 'gold', 60, 95, 10, 2.99, 'demo', 0, '2023-04-25 05:26:32', '2023-05-04 13:50:14'),
(16, 18, 'gold', 60, 100, 100, NULL, 'demo1', 0, '2023-05-05 04:47:16', '2023-05-05 08:47:44'),
(17, 20, 'gold', 60, 100, 100, 1.2, 'test', 0, '2023-05-12 09:34:42', '2023-05-23 08:37:06');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_26_112049_create_admins_table', 2),
(6, '2016_06_01_000001_create_oauth_auth_codes_table', 3),
(7, '2016_06_01_000002_create_oauth_access_tokens_table', 3),
(8, '2016_06_01_000003_create_oauth_refresh_tokens_table', 3),
(9, '2016_06_01_000004_create_oauth_clients_table', 3),
(10, '2016_06_01_000005_create_oauth_personal_access_clients_table', 3),
(11, '2023_03_20_092224_create_use_coupons_table', 4),
(12, '2023_05_02_034831_create_bne_settings_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('78c7d8dc80fc3ccc8a134e5ca6d883d677bfffecc4810ebfb0a67ede38b39929faec9f9baefe395c', 5, 1, 'token', '[]', 0, '2023-01-30 23:47:06', '2023-01-30 23:47:06', '2024-01-31 05:17:06'),
('42086beb5651ffcf19f2a6dfc2d0fef6d74c598222be9dc6c6655c6438b398816872d414b07eb844', 1, 1, 'token', '[]', 0, '2023-01-31 00:05:38', '2023-01-31 00:05:38', '2024-01-31 05:35:38'),
('3cff90d55aac7648ed8c889f1e43bdbfe44bd2bce1366aa6bbe86e1879144505bc0de7c2e0fb541e', 1, 1, 'token', '[]', 0, '2023-01-31 00:42:34', '2023-01-31 00:42:34', '2024-01-31 06:12:34'),
('5f71407211f8a73aa07b2ca9d7a903c98cb27bc07bb5f34fda48a89b552f190d84f2bda3997c7e8b', 1, 1, 'token', '[]', 0, '2023-01-31 00:43:40', '2023-01-31 00:43:40', '2024-01-31 06:13:40'),
('02d86320f8460060aeb6f704b1001b20d80905c41d66ae34a596f34f7338070b389f42eec5cbd926', 1, 1, 'token', '[]', 0, '2023-01-31 02:07:23', '2023-01-31 02:07:23', '2024-01-31 07:37:23'),
('412c6b7eb6dc5c94bc268d18ce08ac2ef4bf9e941045d414e8f639671b58c28c3dde321ca477c260', 1, 1, 'token', '[]', 0, '2023-01-31 02:07:37', '2023-01-31 02:07:37', '2024-01-31 07:37:37'),
('46b05fd43ec65c5d5be363da58593c7346b16d978f69adf70e7247b7c12d42fdde53576f6b659b55', 1, 1, 'token', '[]', 0, '2023-01-31 02:08:09', '2023-01-31 02:08:09', '2024-01-31 07:38:09'),
('6696f24f0e2fb658df1bfde7848e838993890b7d1ade390e9c6b0c333ed8bd5bb167e5d734fee071', 1, 1, 'token', '[]', 0, '2023-01-31 02:09:16', '2023-01-31 02:09:16', '2024-01-31 07:39:16'),
('72b070e752284cf6cc874da71091c15cb188164aed77611267829e71ee40f4b7010a8c584f6e2355', 1, 1, 'token', '[]', 0, '2023-01-31 02:10:32', '2023-01-31 02:10:32', '2024-01-31 07:40:32'),
('cc684f9553ce82a8b34f5754eddf5fe00d7a5560b60284790487155495024e0e046e8cfefa11f6ca', 1, 1, 'token', '[]', 0, '2023-01-31 02:11:08', '2023-01-31 02:11:08', '2024-01-31 07:41:08'),
('5dd9d6970d8f1890392226911802e14bc3f559f2d890eb52d39f4d687556988d18bda4d38a1f04cd', 1, 1, 'token', '[]', 0, '2023-01-31 02:11:39', '2023-01-31 02:11:39', '2024-01-31 07:41:39'),
('a0aa33375475299ea0713e8b9ace9a266f91782e86bd1a53de272c89a8ab895846d99d86dd413596', 1, 1, 'token', '[]', 0, '2023-01-31 02:12:07', '2023-01-31 02:12:07', '2024-01-31 07:42:07'),
('7ee64e264b187afc473383e10cc637c0ffe914ba751038445b2335428ad32656d694ed412b704f02', 1, 1, 'token', '[]', 0, '2023-01-31 02:13:14', '2023-01-31 02:13:14', '2024-01-31 07:43:14'),
('ce9e592df6541f67baab537f2ae650f2d104f32bb5b94f27804e33a166c7b4c4b31aec5c8be2b8e4', 1, 1, 'token', '[]', 0, '2023-01-31 02:13:37', '2023-01-31 02:13:37', '2024-01-31 07:43:37'),
('9b02305257b9c5e42d329139091eca80020e9506abfde4163236e8b30601e35d567bdc3c08068ca4', 1, 1, 'token', '[]', 0, '2023-01-31 02:14:10', '2023-01-31 02:14:10', '2024-01-31 07:44:10'),
('b2e4d72fe3d6477f7a4e731923755c3fe4bcd90469fd77da625bfc32e782576bb0f785263ea8bad0', 1, 1, 'token', '[]', 0, '2023-01-31 02:14:28', '2023-01-31 02:14:28', '2024-01-31 07:44:28'),
('3175eccecc7aec35cbaf683b8237eb2594ba490b24f19a2ffe6157611ae52fbd44905d71a295b318', 1, 1, 'token', '[]', 0, '2023-01-31 02:17:29', '2023-01-31 02:17:29', '2024-01-31 07:47:29'),
('5976672fe7f9bb35ed970c4af7ec43cb25881d7858ed527830bf4ae2bc7ee3df965043e96a3272c1', 1, 1, 'token', '[]', 0, '2023-01-31 03:02:03', '2023-01-31 03:02:03', '2024-01-31 08:32:03'),
('f20e956adc89a2f34cd19ac7a4495b21ef53ed3cce76cc4df8a1087606990f5cf0dde2d2129b89c8', 1, 1, 'token', '[]', 0, '2023-01-31 03:03:13', '2023-01-31 03:03:13', '2024-01-31 08:33:13'),
('53e8dd368f152656e0a07f5c9d1e23a6afe72ac0c116d6f071d70944a0dcc888253e3473c2adb818', 1, 1, 'token', '[]', 0, '2023-01-31 03:03:49', '2023-01-31 03:03:49', '2024-01-31 08:33:49'),
('90e3bdd2abb717364970aaf50f532aefe587a44eec1bcfeccc021230e932b07f786a6144bba2fd37', 1, 1, 'token', '[]', 0, '2023-01-31 03:33:25', '2023-01-31 03:33:25', '2024-01-31 09:03:25'),
('66f480a4d308b92dff38377a86f24dccb1090f5e3004cc96bcc07c5cd835cfc4a3e0f8603542fcab', 1, 1, 'token', '[]', 0, '2023-01-31 03:37:32', '2023-01-31 03:37:32', '2024-01-31 09:07:32'),
('74eb6e35afef7e765c299681875160d6f85effc8c5dc68c5df711c6235462fb1ab65fb861ebddf8e', 1, 1, 'token', '[]', 0, '2023-01-31 03:38:50', '2023-01-31 03:38:50', '2024-01-31 09:08:50'),
('b9fa110288cfd9678b05d0c8f736736f745564a8d04ba668a9b305ad1305acc712789c54ebef195b', 1, 1, 'token', '[]', 0, '2023-01-31 03:39:13', '2023-01-31 03:39:13', '2024-01-31 09:09:13'),
('ea8a0cdcc3c5cc09c08c0566340dc0ea432f47ea28e611798fca51c53f78360fa2984b585c0650ac', 1, 1, 'token', '[]', 0, '2023-01-31 03:39:59', '2023-01-31 03:39:59', '2024-01-31 09:09:59'),
('24e970d68de089c2a8b96767c8edb3121cb402a63ce4f8908fa484d6fecdacfb946bb8ca9247e9c0', 1, 1, 'token', '[]', 0, '2023-01-31 03:42:48', '2023-01-31 03:42:48', '2024-01-31 09:12:48'),
('8ed9cdcee8f9343ec0db9bf09aa090841ff9ccebaa0a54965f0ad30d8ffeda2deb06585cbf131a60', 1, 1, 'token', '[]', 0, '2023-01-31 03:45:11', '2023-01-31 03:45:11', '2024-01-31 09:15:11'),
('3a8f1f35743cb44956291235aa94881f34ea78a2072c3098b6b0ce0dd6f155f9b65c8bf237568ee6', 1, 1, 'token', '[]', 0, '2023-01-31 03:45:41', '2023-01-31 03:45:41', '2024-01-31 09:15:41'),
('485c2c8f6dfd3f94619b6b08b4b4a4ae48f3aced08a32fbe98efef51add96f4f814a4a0e95ec8c15', 1, 1, 'token', '[]', 0, '2023-01-31 03:46:20', '2023-01-31 03:46:20', '2024-01-31 09:16:20'),
('9e3986f20e42b2dfd183d160f3f4d5f2ce589b05e3aae9716cad02e6826d1875579e4b00a247cf7b', 1, 1, 'token', '[]', 0, '2023-01-31 03:46:41', '2023-01-31 03:46:41', '2024-01-31 09:16:41'),
('da2c17c457d1e0f2151991710e09b84c6cf7fe14597b102e27596bef3af9564ec13a7ad000bf84dd', 1, 1, 'token', '[]', 0, '2023-01-31 03:47:05', '2023-01-31 03:47:05', '2024-01-31 09:17:05'),
('c647b8e4bffb8180acc4883dbdd626422c9751f5dba530d2b8ffed89eba4564651eec0af3d8721e3', 1, 1, 'token', '[]', 0, '2023-01-31 03:47:53', '2023-01-31 03:47:53', '2024-01-31 09:17:53'),
('bb71360596ceb8749aa38862e7d108fcfb5bbdd0aeabeb89958accaeb5384ac4ad5510ab53a71f23', 1, 1, 'token', '[]', 0, '2023-01-31 03:49:04', '2023-01-31 03:49:04', '2024-01-31 09:19:04'),
('d843022cb0c089438568ea65fb0ad05e214274854af10ba7357f811e4a762d77e6a34b7532b1e981', 1, 1, 'token', '[]', 0, '2023-01-31 03:50:23', '2023-01-31 03:50:23', '2024-01-31 09:20:23'),
('cb04da0626027ad8365fe946a2ff5ccbf619a96cf80e331911bf98e4eebece4fef00ce71b38a1341', 1, 1, 'token', '[]', 0, '2023-01-31 03:58:06', '2023-01-31 03:58:06', '2024-01-31 09:28:06'),
('dfbe3795ea11c9983d053a0f81c792974ccc7cc4f6ce1fc854d7768d0f3ebe150c43d4b4373409d2', 1, 1, 'token', '[]', 0, '2023-01-31 03:58:40', '2023-01-31 03:58:40', '2024-01-31 09:28:40'),
('10713de273711257612a39eb5cfb06d5e070e659e00d5c4d944c2126c93190a9a7b2e10ab8d23ed2', 1, 1, 'token', '[]', 0, '2023-01-31 03:59:47', '2023-01-31 03:59:47', '2024-01-31 09:29:47'),
('80a06b9a4c75db86ca2aa0b4e7a435b4b4589f40fdf2a37aeb5eed42293792dfa669dd572aeaf971', 1, 1, 'token', '[]', 0, '2023-01-31 04:03:05', '2023-01-31 04:03:05', '2024-01-31 09:33:05'),
('74a8a1623f5dd103982d721df662db20c01a94792e12c23b04ce6f9c048a864d05a1d0434d83c71c', 1, 1, 'token', '[]', 0, '2023-01-31 04:03:50', '2023-01-31 04:03:50', '2024-01-31 09:33:50'),
('7ac2420192f37dd55e2b24c29fb69596da8fee850c86a216dbbdbdf91cc236c7011c7f30434dc168', 1, 1, 'token', '[]', 0, '2023-01-31 04:04:11', '2023-01-31 04:04:11', '2024-01-31 09:34:11'),
('e47f2c644e3103849eab6982066e178dba83de9213ac7cfff208c8549b1bb75763bc63dc322913d2', 1, 1, 'token', '[]', 0, '2023-01-31 04:11:34', '2023-01-31 04:11:34', '2024-01-31 09:41:34'),
('17f33cecda6fb51cd91226d5ea84c138b0649393435d9df4314f3133ee024f887f878f51b26957a5', 1, 1, 'token', '[]', 0, '2023-01-31 07:10:54', '2023-01-31 07:10:54', '2024-01-31 12:40:54'),
('7ff88cce5e507bf1feddd5aac0e245a1b1cc5682911c27f836028fcc15da8ebe7d813595dcac62f4', 1, 1, 'token', '[]', 0, '2023-01-31 22:12:13', '2023-01-31 22:12:13', '2024-02-01 03:42:13'),
('65c9a8f0a88f957ec092bdbd972dd827a354af4428c9b6a4d7441545b259f8d1fd912a05607f40e7', 1, 1, 'token', '[]', 0, '2023-02-01 00:35:44', '2023-02-01 00:35:44', '2024-02-01 06:05:44'),
('4ca6ba7142c5e62f4a9a5b58c26e656a569a75e37dea9ab7bf3d01ee3adf91157d0bb45fc65e23ff', 1, 1, 'token', '[]', 0, '2023-02-01 05:13:36', '2023-02-01 05:13:36', '2024-02-01 10:43:36'),
('021f83fa3d14df2e3e1e387891a5f109de40541c4517eb918dbdff6afc9b1d89d352333d145d1829', 1, 1, 'token', '[]', 0, '2023-02-01 05:16:13', '2023-02-01 05:16:13', '2024-02-01 10:46:13'),
('66197a439b542ffd0836476d6cce9e28c1fd99ae59f807fc379672af4bddc360382ce1f9e9b3b0ee', 1, 1, 'token', '[]', 0, '2023-02-01 22:07:17', '2023-02-01 22:07:17', '2024-02-02 03:37:17'),
('356edf426dbe3bd1265b67bca7f44d264f7b46cb43f93d36b950245938c660ae53e57188cd9c1ae5', 1, 1, 'token', '[]', 0, '2023-02-01 23:49:15', '2023-02-01 23:49:15', '2024-02-02 05:19:15'),
('1700e9881e5070d50b3f1e99b81f6979e304523d558ee3f325c40d8a9e71f4d631605cc84a285c35', 2, 1, 'token', '[]', 0, '2023-02-01 23:55:17', '2023-02-01 23:55:17', '2024-02-02 05:25:17'),
('4dc36224342386509c7f1dad53915a85ce523cf9e4b42b97f05fdf9cc593af9570aae1702bf1f32f', 3, 1, 'token', '[]', 0, '2023-02-01 23:55:51', '2023-02-01 23:55:51', '2024-02-02 05:25:51'),
('5af2ee4a72f41b6a1ed9f40ecb04836aa683af96a087dd2970eeefbb81d8bf32adf33acd1d414794', 2, 1, 'token', '[]', 0, '2023-02-01 23:56:03', '2023-02-01 23:56:03', '2024-02-02 05:26:03'),
('e61f6ed7755ed8becc817650bc3b39c2aa0e054f6210b8d931b81dfed758c3b9490f3d3a3753d621', 1, 1, 'token', '[]', 0, '2023-02-02 00:01:56', '2023-02-02 00:01:56', '2024-02-02 05:31:56'),
('325218f07fdce00f2d9448b3b48306b225d8a5605f3d67c40933f55e86592de3ad502fbb85f66717', 1, 1, 'token', '[]', 0, '2023-02-02 03:54:23', '2023-02-02 03:54:23', '2024-02-02 09:24:23'),
('9bcbd3555ea0a4b8ecfb9ddb0b4eb58806ca6c5c37c287aeb9fac928d263854697c42ff5e40d29b3', 3, 1, 'token', '[]', 0, '2023-02-02 04:15:03', '2023-02-02 04:15:03', '2024-02-02 09:45:03'),
('903f292379834ef13915eb31d68ee0435987c37ddf0c373e7eb79048d128eda03a23210178584f1c', 1, 1, 'token', '[]', 0, '2023-02-02 05:09:39', '2023-02-02 05:09:39', '2024-02-02 10:39:39'),
('be557b86f28730477cd5900ac51df02eb176581c64f4d812d28e133797f791df73980ad3d6ebe571', 1, 1, 'token', '[]', 0, '2023-02-02 06:38:04', '2023-02-02 06:38:04', '2024-02-02 12:08:04'),
('5346f88a72ba06c06a1009d112e0bcd46e664770a13aab5f28aeaf93f3cfdf716d33d17354bb2db2', 1, 1, 'token', '[]', 0, '2023-02-02 06:39:10', '2023-02-02 06:39:10', '2024-02-02 12:09:10'),
('0718ed9694e78071905f8c381f45dc96a5716b50e375b18c8a739b87178b2bd19b533702862c1a38', 1, 1, 'token', '[]', 0, '2023-02-02 07:03:29', '2023-02-02 07:03:29', '2024-02-02 12:33:29'),
('eb79cb08d6e5c653b68e938df181c8166a75edaa477bb63c8e74161e45b7414ad1c5be39494e83d0', 1, 1, 'token', '[]', 0, '2023-02-02 22:36:33', '2023-02-02 22:36:33', '2024-02-03 04:06:33'),
('1673cea25c6677d8ace85419ccf3fd0b8a447f67a284915dfb6f2fa06c0d18163442454518ce2e6b', 1, 1, 'token', '[]', 0, '2023-02-02 22:37:24', '2023-02-02 22:37:24', '2024-02-03 04:07:24'),
('c05f750387ce3ed23c7e6959e84d075e01f350ca26659ee3ce2fab46ef2592a5463ec2f37d571fe4', 1, 1, 'token', '[]', 0, '2023-02-02 22:40:08', '2023-02-02 22:40:08', '2024-02-03 04:10:08'),
('b33354e8ba7403daa9496a4fad7584dc34b6a337d016d8bd5945d5ec3e0eb24c22fc003499f7b9d4', 1, 1, 'token', '[]', 0, '2023-02-05 22:48:32', '2023-02-05 22:48:32', '2024-02-06 04:18:32'),
('0ffa7769b93ace8de60e8ce4cd9983d6016b1312d775b585c10660ec3562ac0b604dc9f68fa5e981', 1, 1, 'token', '[]', 0, '2023-02-06 03:13:29', '2023-02-06 03:13:29', '2024-02-06 08:43:29'),
('57dfd2cf50496d2d8ad8b69ba3783882ee83241c4831c563a063e08d49ab3d6503de913602180d60', 1, 1, 'token', '[]', 0, '2023-02-06 03:17:59', '2023-02-06 03:17:59', '2024-02-06 08:47:59'),
('087e63bdef9b95cbf95048c7123db59a593f375e8af4f15ff482c0ce2c9f9dab35c723ca108a9c4c', 1, 1, 'token', '[]', 0, '2023-02-06 04:13:01', '2023-02-06 04:13:01', '2024-02-06 09:43:01'),
('5b95c3e003d9235fec83e9ec9b5495a50aab7b7da72ff54f17b904a0967bba3e07755f17db34de16', 1, 1, 'token', '[]', 0, '2023-02-06 04:14:31', '2023-02-06 04:14:31', '2024-02-06 09:44:31'),
('0cfe79456c99a9c8e598cbd46bdcab190ac41ed10d68495885cab2b58b466dae4d31dc5f0ae4ada6', 1, 1, 'token', '[]', 0, '2023-02-06 04:37:42', '2023-02-06 04:37:42', '2024-02-06 10:07:42'),
('e75e016fd15d9c9a210e65d962041602f5d8fb2f0a8ae9fa7c4411434ba5234fc6e6f5436cfa7f7e', 1, 1, 'token', '[]', 0, '2023-02-06 04:39:48', '2023-02-06 04:39:48', '2024-02-06 10:09:48'),
('c75570bfdf44ecd0f46fce608b8b0a66086fca52a6ac203d6337cc118f07bd1783a56598a13c7371', 1, 1, 'token', '[]', 0, '2023-02-06 05:00:57', '2023-02-06 05:00:57', '2024-02-06 10:30:57'),
('f1296773d98d6105decd8852d0a673b8baa13754b6ffa974a00bcc0f6e92032e9073e3ea75a598f8', 1, 1, 'token', '[]', 0, '2023-02-06 05:08:28', '2023-02-06 05:08:28', '2024-02-06 10:38:28'),
('bef56612ceebe9b80595c4a368869e642953d32c0e35f1dc9f87361ae006342979c44d230fb24f56', 1, 1, 'token', '[]', 0, '2023-02-06 05:34:02', '2023-02-06 05:34:02', '2024-02-06 11:04:02'),
('733b45bb4657b79f916492e3fd2a58123d29803b0c0aa6246ccd83bfa0f3182919f447aa172f4067', 1, 1, 'token', '[]', 0, '2023-02-06 22:12:30', '2023-02-06 22:12:30', '2024-02-07 03:42:30'),
('e31df86e1ba1ca2d0282650c6dcf510acd7685b241ccb2a33c0ae6e6d6292fe0b0530c2f99e288b3', 1, 1, 'token', '[]', 0, '2023-02-06 23:23:55', '2023-02-06 23:23:55', '2024-02-07 04:53:55'),
('32bf0a46046d972d35d974e3d4e3789f8b2fdb2787553eaf7a2b12b09b7d0cda73f3f978019faaeb', 1, 1, 'token', '[]', 0, '2023-02-06 23:25:51', '2023-02-06 23:25:51', '2024-02-07 04:55:51'),
('71bb6f2217a2e69ee1da61920e49b76078731a8057d253fbb45944abeca09ba45db07e803e1c92ac', 1, 1, 'token', '[]', 0, '2023-02-06 23:26:50', '2023-02-06 23:26:50', '2024-02-07 04:56:50'),
('e131de52dad941743d661d8bd4f84a063b18b7d3e476dde78f3ca95a4c36ada9abf8e2881f38be54', 1, 1, 'token', '[]', 0, '2023-02-07 00:18:45', '2023-02-07 00:18:45', '2024-02-07 05:48:45'),
('3cfa44ef63c44fa749778c077bf1d91f8100168498b3008f9165b65768e043d7204f4cdb1b07a106', 1, 1, 'token', '[]', 0, '2023-02-07 00:29:49', '2023-02-07 00:29:49', '2024-02-07 05:59:49'),
('43570df602b494f221f03ebb991b7ff37dde003e266c06e97166ab9772d57be783acab4f29daa9dd', 1, 1, 'token', '[]', 0, '2023-02-07 00:30:38', '2023-02-07 00:30:38', '2024-02-07 06:00:38'),
('f8b044f6a52c4feaedccbf64232ef1e7d934e2d297ebe839719d2ea70c6cc0e2f3d0dc24501d2c0b', 4, 1, 'token', '[]', 0, '2023-02-07 05:19:40', '2023-02-07 05:19:40', '2024-02-07 10:49:40'),
('0781208be28d9fe39654b911e63b751f5fa29c51640631e20d2f22672bc812d3f346afa4444bd271', 4, 1, 'token', '[]', 0, '2023-02-07 05:21:37', '2023-02-07 05:21:37', '2024-02-07 10:51:37'),
('573c47118bf7d4f66012877ee1594d0bea5d8bb0f44f79f8fa81105c9b41592aaf5f3cb5acbc1138', 4, 1, 'token', '[]', 0, '2023-02-07 05:21:53', '2023-02-07 05:21:53', '2024-02-07 10:51:53'),
('a101f949f904f8bb25a140e3730ba5d1678d552a7de7f9a1b2ee2e745cf1c64b5a4a124e0770d335', 5, 1, 'token', '[]', 0, '2023-02-07 05:22:37', '2023-02-07 05:22:37', '2024-02-07 10:52:37'),
('04e2b8b0500fbc8e6608fcc93f9b4d75fdf2c6e95d78557b0b4def607ca9802e956cf44788c41b0e', 1, 1, 'token', '[]', 0, '2023-02-07 05:26:38', '2023-02-07 05:26:38', '2024-02-07 10:56:38'),
('5106a47b2d328c5050e66df6e45e6ffe2024263e05600f29bc67d7f64d7355b28c6c11f697e46bc3', 1, 1, 'token', '[]', 0, '2023-02-07 05:46:34', '2023-02-07 05:46:34', '2024-02-07 11:16:34'),
('fd25671bd25ec0c0c0d60f57138951a16a12f0c740638e9f1a004d657c34ceb742e2555776f6d1d8', 1, 1, 'token', '[]', 0, '2023-02-07 05:49:51', '2023-02-07 05:49:51', '2024-02-07 11:19:51'),
('e4dc025b22135967681c7c8fca7cf7598ef8099f9896ecc05af0267e6322ddfd06ee8f29cd81eee1', 1, 1, 'token', '[]', 0, '2023-02-07 06:16:07', '2023-02-07 06:16:07', '2024-02-07 11:46:07'),
('0f567a823649b408a19eb797624bda844edc271af08e45a9e2fb59ad92fcd686008ac8aad0af0934', 1, 1, 'token', '[]', 0, '2023-02-07 07:12:22', '2023-02-07 07:12:22', '2024-02-07 12:42:22'),
('940aaaa4396e48e633da99c43b705df59514142d184cf01d85b68bbf2ddb5cbd7c837f0d554a8614', 1, 1, 'token', '[]', 0, '2023-02-07 22:54:47', '2023-02-07 22:54:47', '2024-02-08 04:24:47'),
('16b0c6f94e601106f5057690dd559315af56c08c757158d49cbe7f870f33538370bf484178bdca61', 1, 1, 'token', '[]', 0, '2023-02-07 22:55:34', '2023-02-07 22:55:34', '2024-02-08 04:25:34'),
('167ae1748eb30c2c205a4cb9e7dfb4c616606f8148d25958cf3c4b76c7b98a8d61c1339797c60275', 1, 1, 'token', '[]', 0, '2023-02-07 22:58:18', '2023-02-07 22:58:18', '2024-02-08 04:28:18'),
('5ebd23e231777c70103dc7ad541e6b0cfbbd6c26e321c623ff5e39a236c229f87bbea366d98496f8', 1, 1, 'token', '[]', 0, '2023-02-08 00:19:54', '2023-02-08 00:19:54', '2024-02-08 05:49:54'),
('945ccfa2d1054f1090b0f65449455d6842402e21ae3747b9ea19da69e7df7b833aa8fd7b4cbb55cc', 7, 1, 'token', '[]', 0, '2023-02-08 01:16:12', '2023-02-08 01:16:12', '2024-02-08 06:46:12'),
('b84ca16e6f985a07d59aa4639af08c7a1317cbadb4a2a3609e1cb39be539082c5e82681ad9993202', 8, 1, 'token', '[]', 0, '2023-02-08 01:47:45', '2023-02-08 01:47:45', '2024-02-08 07:17:45'),
('1dd469077c623baf04d7dd956ce2120b0a028072defd8df54aa615a517a53d8e7d835d5103c6ef24', 9, 1, 'token', '[]', 0, '2023-02-08 01:48:42', '2023-02-08 01:48:42', '2024-02-08 07:18:42'),
('65af1ddff6836aa85cb39ed1730e9316254382ba3ac105735ce255ae9ce0f7287c8ff560e97950bb', 10, 1, 'token', '[]', 0, '2023-02-08 01:54:23', '2023-02-08 01:54:23', '2024-02-08 07:24:23'),
('afc5529c19ec47507d46c482b256a00f6e1a7578c34c0a9a5f8f95ae131f2454a91c8f2902cfe8cb', 11, 1, 'token', '[]', 0, '2023-02-08 01:56:12', '2023-02-08 01:56:12', '2024-02-08 07:26:12'),
('436c693e71228a690c10ce80b2119478e4f6c3e18516e6769b76fc4e796db1d1fea20201d956e5e4', 1, 1, 'token', '[]', 0, '2023-02-08 01:59:57', '2023-02-08 01:59:57', '2024-02-08 07:29:57'),
('a07b8c5da6895611978999236e1c5db9b9a0b9998c40e13bd9fff479a723d4bb4c36828713eeaa15', 1, 1, 'token', '[]', 0, '2023-02-08 02:00:05', '2023-02-08 02:00:05', '2024-02-08 07:30:05'),
('1128e353db1a8fb598ac748fc5d9f3bdaa708870e9dd9efd885548a4b25789abe3cbd698a1967ae5', 1, 1, 'token', '[]', 0, '2023-02-08 02:02:47', '2023-02-08 02:02:47', '2024-02-08 07:32:47'),
('805e15d14d774da99b179e1955c5b6fca56d5f1f1e0e1da8cbe09000831ab144337a931206187770', 1, 1, 'token', '[]', 0, '2023-02-08 03:02:02', '2023-02-08 03:02:02', '2024-02-08 08:32:02'),
('91ff07d101746883886e7892cfe72a5a5a19d80b84e42777a31ddf34596de8067e9d877445c85e7a', 12, 1, 'token', '[]', 0, '2023-02-08 03:10:15', '2023-02-08 03:10:15', '2024-02-08 08:40:15'),
('e52249d6267d2df7181fc070258d38c967f84c143d5c841329aac3b4e580d4e86f5fedffcfa867ee', 13, 1, 'token', '[]', 0, '2023-02-08 03:11:11', '2023-02-08 03:11:11', '2024-02-08 08:41:11'),
('089f5aa2e7945005b4b5f3bab2cc06dbdd40e9d5d43c1fdbcfa82fcb20f3401e19bb0f44b3923318', 14, 1, 'token', '[]', 0, '2023-02-08 03:12:18', '2023-02-08 03:12:18', '2024-02-08 08:42:18'),
('0e7a11e96c0101115a921acbc14a4799315fc37dc12a79b8646a33723762264735a5c0ee64b9c761', 15, 1, 'token', '[]', 0, '2023-02-08 03:13:44', '2023-02-08 03:13:44', '2024-02-08 08:43:44'),
('2b419e87a59641da1b8ed9f2d24a3200403cb12af19f2db013e96d231163e207e4db368250bfc89e', 16, 1, 'token', '[]', 0, '2023-02-08 03:15:29', '2023-02-08 03:15:29', '2024-02-08 08:45:29'),
('90a20af3397d8c0e0e64eba8009b278aa48522266a259772df1c84467ccbb854e40ea026bc2467f4', 17, 1, 'token', '[]', 0, '2023-02-08 03:17:46', '2023-02-08 03:17:46', '2024-02-08 08:47:46'),
('7c83d9ae5772b968006d856656385d6cdf265666de0de7294b8ac296f71f9f36147c97b96a1663bd', 18, 1, 'token', '[]', 0, '2023-02-08 03:22:02', '2023-02-08 03:22:02', '2024-02-08 08:52:02'),
('548731c7b9e1e93b95d1dd8356bc95d104ee3a63c17e2f82baa0590b88c33db1d3e06acdcf94564b', 19, 1, 'token', '[]', 0, '2023-02-08 03:23:50', '2023-02-08 03:23:50', '2024-02-08 08:53:50'),
('d4e348e56998ff2848f2fa5146591e524826be181cba5337e34d4db45e2ae8771756c10b7a89e30b', 20, 1, 'token', '[]', 0, '2023-02-08 03:25:28', '2023-02-08 03:25:28', '2024-02-08 08:55:28'),
('c5bb0c8e3a7d49ee1c57e32b437c5ee9727b11cba08666dcc30e83fb1de9e71e0db939952e273db8', 21, 1, 'token', '[]', 0, '2023-02-08 03:40:59', '2023-02-08 03:40:59', '2024-02-08 09:10:59'),
('8cc957689f30d54e4f3dad7de1a93f95505103a8cd2213b3444b36a9342a6664df28ae2f1ac974c4', 22, 1, 'token', '[]', 0, '2023-02-08 03:43:05', '2023-02-08 03:43:05', '2024-02-08 09:13:05'),
('3145c9b3e8e5de183d138e0f9765f3441e440f1bd9ecbc16095b26adb5964b73922c99e82c824bd7', 23, 1, 'token', '[]', 0, '2023-02-08 03:44:06', '2023-02-08 03:44:06', '2024-02-08 09:14:06'),
('d023a71a85d7666467ccc24b4fc2769edbfccfd35b71dd089f10090e6ca6356420d1a48a3b8e5003', 24, 1, 'token', '[]', 0, '2023-02-08 03:49:01', '2023-02-08 03:49:01', '2024-02-08 09:19:01'),
('d0f5adbbbcf1d2c155c9cc2cbf3971b27fd6727fc25844bbc6bbe390a7aae3941e1e36466d0f9651', 7, 1, 'token', '[]', 0, '2023-02-08 03:50:11', '2023-02-08 03:50:11', '2024-02-08 09:20:11'),
('20e10a16faf9dd73413b45d682c7f20b86c35735b3a05df3aa050e0f48f050beddb56787aa8531ee', 8, 1, 'token', '[]', 0, '2023-02-08 03:51:21', '2023-02-08 03:51:21', '2024-02-08 09:21:21'),
('0ad3d1659f72e36e13bd7e1284393e39a086d6dc6cd5b5b8baabee0ded211f1dcfb2b68ff8f5cfa3', 9, 1, 'token', '[]', 0, '2023-02-08 03:52:44', '2023-02-08 03:52:44', '2024-02-08 09:22:44'),
('87688e067e02da4a9b4ece23f4d23fd55bea9f63734a7711ac90d285da425b125c50b6f0f7eed29c', 10, 1, 'token', '[]', 0, '2023-02-08 03:53:44', '2023-02-08 03:53:44', '2024-02-08 09:23:44'),
('088add63c16c6ad763e1fa792195f15cdcdccd863d14927dec6ddfb9f439e39d374a075f6e0dee29', 11, 1, 'token', '[]', 0, '2023-02-08 03:55:24', '2023-02-08 03:55:24', '2024-02-08 09:25:24'),
('0e3d626fb693fd72c94f673ec65660e174808a5a29fbe959a551ac55227d34ce17f23d75ff80d994', 12, 1, 'token', '[]', 0, '2023-02-08 03:56:08', '2023-02-08 03:56:08', '2024-02-08 09:26:08'),
('3d49556538242f6b02d8066a28bb7bc9a78fd68a240d15cb3b23c83b03e32aaeec71c8b11196b3d8', 13, 1, 'token', '[]', 0, '2023-02-08 03:57:14', '2023-02-08 03:57:14', '2024-02-08 09:27:14'),
('7975aadef1672046e7c64f36ff3173a23ff971b47ea0b5a1191a82c1fae80ecf78c63a41309c87b4', 14, 1, 'token', '[]', 0, '2023-02-08 03:58:10', '2023-02-08 03:58:10', '2024-02-08 09:28:10'),
('91eff98cd0b535be4799a57bca8917fd8878384285e99a0a021f65198120433e71b28eca57146019', 15, 1, 'token', '[]', 0, '2023-02-08 03:59:01', '2023-02-08 03:59:01', '2024-02-08 09:29:01'),
('e7f25311742c3ce4b4a4fe3f02f2030625653b2050aa314e5ef814f8b33440e80482b858bdd83a82', 16, 1, 'token', '[]', 0, '2023-02-08 04:01:19', '2023-02-08 04:01:19', '2024-02-08 09:31:19'),
('dbb2c01a898432ee435a110bd8010f6be9ab2c97d489d0434d4bc7393e87aa0b67abfd4cdd69e63d', 17, 1, 'token', '[]', 0, '2023-02-08 04:02:47', '2023-02-08 04:02:47', '2024-02-08 09:32:47'),
('9bc9ee0878b9c2d7d7926bb9690a1a42f7a4fb5cf6aacdf6ddc8c05a85ab6dc0ad68a23d8437101b', 18, 1, 'token', '[]', 0, '2023-02-08 04:03:31', '2023-02-08 04:03:31', '2024-02-08 09:33:31'),
('ef197340eef6097e353a332e03baba88689e810b0899b7d640d543761d056f9757933b472fc8ef5f', 7, 1, 'token', '[]', 0, '2023-02-08 04:04:48', '2023-02-08 04:04:48', '2024-02-08 09:34:48'),
('1a07e72354ea6da8e355e412630d2ecdedd6a99457dcc58e9c898389d50dc0f2241a4f961f5af6ac', 1, 1, 'token', '[]', 0, '2023-02-08 04:13:10', '2023-02-08 04:13:10', '2024-02-08 09:43:10'),
('2a797b63d3f5c7da05da17eb62dafd84bc2f8090acc8b5a1e4b62a333c5e7e5c666c15395c1afa9b', 1, 1, 'token', '[]', 0, '2023-02-08 04:14:35', '2023-02-08 04:14:35', '2024-02-08 09:44:35'),
('8ec685b0a59ba4b096c029e97c37269590f0868940bb16fa3554649797e1a22a30aaeed2aef82d37', 1, 1, 'token', '[]', 0, '2023-02-08 04:17:47', '2023-02-08 04:17:47', '2024-02-08 09:47:47'),
('b5cf56d9ed28a8fae261f16335d87cf3d7f76f85fe4ec7d63d88139a7eaf6ed9d0cbfb6902c06457', 1, 1, 'token', '[]', 0, '2023-02-08 04:20:02', '2023-02-08 04:20:02', '2024-02-08 09:50:02'),
('1af670bc319b91f0f022e6d6ac7945b15d1c0617ee7eaee325b936d60c58739d52c453dc16de8f23', 1, 1, 'token', '[]', 0, '2023-02-08 04:21:22', '2023-02-08 04:21:22', '2024-02-08 09:51:22'),
('acdb2d73350ac6324ef4b768790bf1c8fa02af75772b98813171908724e3be4f962a47b3ef3fc415', 1, 1, 'token', '[]', 0, '2023-02-08 04:22:37', '2023-02-08 04:22:37', '2024-02-08 09:52:37'),
('6a697483419588d8b8d2078325dbd41bd083a429afb538045e87d87c60bf358b63a1c4011344fd16', 1, 1, 'token', '[]', 0, '2023-02-08 04:25:30', '2023-02-08 04:25:30', '2024-02-08 09:55:30'),
('32ba98a009111c6c0beb659a0de2160717ebdd2d3962689603a0a4a6a50dff66e01913c72726122c', 1, 1, 'token', '[]', 0, '2023-02-08 04:45:41', '2023-02-08 04:45:41', '2024-02-08 10:15:41'),
('fe5540e5f8e13c961f7126e346fc5c8fe7cac9e75a7729776b04a88d117ffecb9d6a09866e296b8a', 1, 1, 'token', '[]', 0, '2023-02-08 04:48:36', '2023-02-08 04:48:36', '2024-02-08 10:18:36'),
('88029d32cf91c51dad4c9894b9a16de2dcf5243aa96452ba478feb0b957ffdcdc12ae63819c1b410', 1, 1, 'token', '[]', 0, '2023-02-08 04:49:20', '2023-02-08 04:49:20', '2024-02-08 10:19:20'),
('a8e21ee2bf7218f5232ae06e7155e7b40205c7f27c005c68f8b736aae868b0ef1d599a1024723089', 1, 1, 'token', '[]', 0, '2023-02-08 06:19:09', '2023-02-08 06:19:09', '2024-02-08 11:49:09'),
('fcce4caee3fa28ffb3038ff7780f084c44fa638daa4233b76f403f1e7d0ad74318a5ef2ba38e0de6', 1, 1, 'token', '[]', 0, '2023-02-08 06:21:03', '2023-02-08 06:21:03', '2024-02-08 11:51:03'),
('e714b548195b417b7c3406646bf8ab0357a229b7d3a4e6793cbc33cc43fb6fb0e895d3e2023078ac', 1, 1, 'token', '[]', 0, '2023-02-08 06:22:15', '2023-02-08 06:22:15', '2024-02-08 11:52:15'),
('b500dd58ebe73ddc76fd115e19883dbaa6142c7f7748b1d86993f48e779b9e225d7d845b3aecb994', 1, 1, 'token', '[]', 0, '2023-02-08 06:22:43', '2023-02-08 06:22:43', '2024-02-08 11:52:43'),
('0b84064e14ed28351fdcd440603c7cf5e1c179767fa4973ccc79ff5a13bc7a1c8be7c6de3d8a17d6', 1, 1, 'token', '[]', 0, '2023-02-08 06:25:25', '2023-02-08 06:25:25', '2024-02-08 11:55:25'),
('da5eb8310d9dc072e392317a71915acedd282789b8205edd62d438f9081116c00d78c9c2dbf78854', 8, 1, 'token', '[]', 0, '2023-02-08 06:53:54', '2023-02-08 06:53:54', '2024-02-08 12:23:54'),
('478cb039f3d8c9102bf3fd282c7e1bb320bdf07033353f7e5e13994573728586b88498cb55a3285c', 8, 1, 'token', '[]', 0, '2023-02-08 06:54:11', '2023-02-08 06:54:11', '2024-02-08 12:24:11'),
('0719a60c645b4fd4e4c79a682a56cca38066d8af419e6aa5b36185c34bf070c5b7fb91938141b9e4', 1, 1, 'token', '[]', 0, '2023-02-08 07:14:40', '2023-02-08 07:14:40', '2024-02-08 12:44:40'),
('6305f76bd0993aed66ba6a3382a14964f9f4ee484b94da951798e6b7f963d3053322979c2e66f199', 8, 1, 'token', '[]', 0, '2023-02-08 07:15:42', '2023-02-08 07:15:42', '2024-02-08 12:45:42'),
('b8b13dd3c79849fae3c4b08f681b54d926a1cdb45a5f2058eff9aff768e05860d2eb0f62aff5dcd8', 1, 1, 'token', '[]', 0, '2023-02-08 07:20:46', '2023-02-08 07:20:46', '2024-02-08 12:50:46'),
('b9db91647388c46d1f40c188bcb9193a0598c46dc9ed5a3327fa5368e1cb8c48cd98e8d0b2dd135c', 1, 1, 'token', '[]', 0, '2023-02-08 22:09:06', '2023-02-08 22:09:06', '2024-02-09 03:39:06'),
('bd620ed0b47b9ee87e5164465516a5aeee1d96e0a762991bcba4ec36d132139bcfdd92daf9cf99ba', 1, 1, 'token', '[]', 0, '2023-02-08 22:18:52', '2023-02-08 22:18:52', '2024-02-09 03:48:52'),
('529439ca980464948cda3980655fc4ecec9b831eef6ca34bf8ed194cfab435724e81dd3af7138513', 4, 1, 'token', '[]', 0, '2023-02-08 22:25:17', '2023-02-08 22:25:17', '2024-02-09 03:55:17'),
('201d581c8513892194b04c19404c1e15a4c3a26ab197f5befd26c1afdf6d9b57c29d8fda4ca390e7', 1, 1, 'token', '[]', 0, '2023-02-08 22:25:37', '2023-02-08 22:25:37', '2024-02-09 03:55:37'),
('f51f94026b5b8073a1e0d7451137c9a3270e08aeeccb6745ec30b6f1f93fb2dfa1e22a5ffe4cb652', 1, 1, 'token', '[]', 0, '2023-02-08 22:51:18', '2023-02-08 22:51:18', '2024-02-09 04:21:18'),
('ef1a176d2b0a797ee5f1466d54759ffc2f9edcae984e29e9cb1cf0621f2d72ff179e4cacba97941e', 1, 1, 'token', '[]', 0, '2023-02-08 22:52:55', '2023-02-08 22:52:55', '2024-02-09 04:22:55'),
('8f68412bb2c9b11d198daa0c83fcc786acfd876079d2d9f1b25eb6f97c6fa1940d2b18d355662586', 1, 1, 'token', '[]', 0, '2023-02-08 22:55:41', '2023-02-08 22:55:41', '2024-02-09 04:25:41'),
('0f8dc7f512e51e6c2c02b18f5612bec5f8e4cae11a0f600e4fbeca9034cedb732913c4f3543a8c47', 1, 1, 'token', '[]', 0, '2023-02-08 22:57:54', '2023-02-08 22:57:54', '2024-02-09 04:27:54'),
('71b66a7ef75531ab08d29b0136281c749d03cafc86a699bc7ac0cad8f63ae5e12af43bc0471aba2b', 1, 1, 'token', '[]', 0, '2023-02-08 22:59:07', '2023-02-08 22:59:07', '2024-02-09 04:29:07'),
('ec3bdf9c2fd4b1585617f6e3cd82c92efe92ee79c50ff505be1d7082026dce25dbb23f608476a264', 1, 1, 'token', '[]', 0, '2023-02-08 23:17:09', '2023-02-08 23:17:09', '2024-02-09 04:47:09'),
('f85020f8659871dc93f671e93252a85caa8d3ac47e21561e6662537b592390d7dfe2b7134590b03e', 1, 1, 'token', '[]', 0, '2023-02-08 23:17:38', '2023-02-08 23:17:38', '2024-02-09 04:47:38'),
('3d16b59b296bd34f668b3f71c6cc1937231c23c709c03665dd6e5936ae73142b1412f820bf0e159b', 1, 1, 'token', '[]', 0, '2023-02-08 23:29:06', '2023-02-08 23:29:06', '2024-02-09 04:59:06'),
('a73903b9e12b61b537a9141338cb0a4020c811df8126fcded7e70e1e7998f14806d0ce0b6e669d23', 1, 1, 'token', '[]', 0, '2023-02-08 23:33:30', '2023-02-08 23:33:30', '2024-02-09 05:03:30'),
('f7566b2331f65a2eff50f384f65ca02cf45850ec8bf62adb3a65d63d6ae7b7fbf0c3e03eba6e7ab5', 1, 1, 'token', '[]', 0, '2023-02-08 23:43:37', '2023-02-08 23:43:37', '2024-02-09 05:13:37'),
('42841c9712258cce1d980b754c7241ceffd2c864ca7b5999a4e91f0ba3b4764ff7ea06f4d67a40b5', 1, 1, 'token', '[]', 0, '2023-02-09 01:13:48', '2023-02-09 01:13:48', '2024-02-09 06:43:48'),
('412a83c5559a7ce2a86446d7785e332d6e77eb87014369f9d3a6b7bd543a4551906bce1317d502d6', 1, 1, 'token', '[]', 0, '2023-02-09 03:02:11', '2023-02-09 03:02:11', '2024-02-09 08:32:11'),
('e5f4fa77731c2b7673bee742e9cdf6e1bb1697c15a09856453dbe8a0b4d2a8678f67865408099d9e', 1, 1, 'token', '[]', 0, '2023-02-09 03:10:04', '2023-02-09 03:10:04', '2024-02-09 08:40:04'),
('f6659120802f908679da2147904bcd6c419756737a9337e2e08520bd24b5ecb68c52bd2a2d7b6e66', 9, 1, 'token', '[]', 0, '2023-02-09 03:11:45', '2023-02-09 03:11:45', '2024-02-09 08:41:45'),
('4fe5373ef91d63a5e53bcde29994b4aa5aa98c2c0a7a7167a83e4d14ef01bb0e258df53247dd4c7b', 1, 1, 'token', '[]', 0, '2023-02-09 03:12:22', '2023-02-09 03:12:22', '2024-02-09 08:42:22'),
('4577e6f1d2bcec1957563eef66462052275c5bc5e08ce178832ed41c984d7e693651f925f8c889eb', 1, 1, 'token', '[]', 0, '2023-02-09 22:11:47', '2023-02-09 22:11:47', '2024-02-10 03:41:47'),
('bf3c43ef34323aa57065111b70c09bce249ffcfd4cdea8ddb81348771e0475bf498137b0d9ba20ae', 1, 1, 'token', '[]', 0, '2023-02-09 22:39:09', '2023-02-09 22:39:09', '2024-02-10 04:09:09'),
('27b111ee97ff34d72d0ae92848928c5a646eb43a4983444b9281e29880e3bde7f490329ee742e182', 1, 1, 'token', '[]', 0, '2023-02-10 00:12:19', '2023-02-10 00:12:19', '2024-02-10 05:42:19'),
('f02f90212ac18837b069e6d5307169ddb3894e57b1cac9b15d946fbdb1138af74009eccf708754e0', 1, 1, 'token', '[]', 0, '2023-02-10 00:28:24', '2023-02-10 00:28:24', '2024-02-10 05:58:24'),
('c7b6bcf62161ad9af8e8d8ff19b0c96b2728eb1fc963539bfed04c1a6f36a2dd5415a7b4d07ac4e7', 1, 1, 'token', '[]', 0, '2023-02-10 00:51:30', '2023-02-10 00:51:30', '2024-02-10 06:21:30'),
('e6fc4865b6d75b12b15e2a5b7b569b71ad69278cc0da3539af7a7ab997419221faf6b44f08e3ab23', 1, 1, 'token', '[]', 0, '2023-02-12 23:36:52', '2023-02-12 23:36:52', '2024-02-13 05:06:52'),
('16d0a0c78d7925cc0fb841960172d4e02901321d9af7a76ef86986a2dfe912e0b75d549c8ad4793f', 1, 1, 'token', '[]', 0, '2023-02-13 00:22:41', '2023-02-13 00:22:41', '2024-02-13 05:52:41'),
('b3eef13118c756e2c0c7af011f377a29e5209e0b9f1f2aa338a324bd586e380c650529c9c1768650', 1, 1, 'token', '[]', 0, '2023-02-13 03:42:24', '2023-02-13 03:42:24', '2024-02-13 09:12:24'),
('7b786f0194b2a92e5c3621bb4354778e0abcb5e35446f36cb1ed4edc8c0f44f1da6bec60db552f3c', 1, 1, 'token', '[]', 0, '2023-02-13 03:59:56', '2023-02-13 03:59:56', '2024-02-13 09:29:56'),
('e6c98a4bb134a1ee4691e8db0ac684f659c1301ce29713fe9a4a007324035df1503316d7d6fd26b5', 1, 1, 'token', '[]', 0, '2023-02-14 18:36:14', '2023-02-14 18:36:14', '2024-02-14 13:36:14'),
('f7b32e63446fa5584cbd7602028b7ca336387681b0ff9225c12a5a473ee4f042c45acdf242ef1e75', 1, 1, 'token', '[]', 0, '2023-02-15 08:57:47', '2023-02-15 08:57:47', '2024-02-15 03:57:47'),
('b0dc48e7c98a869506d3a19ecc4df73499526211c1847d8b745b1806ff61a93d7531b1f4c75f6e02', 1, 1, 'token', '[]', 0, '2023-02-15 17:31:53', '2023-02-15 17:31:53', '2024-02-15 12:31:53'),
('cdb0145dc863c32e96cafbe7d59dda8ea38c35ab240ec8651944d2ae086bc6c0c6641d00fe3f6b8f', 10, 1, 'token', '[]', 0, '2023-02-15 17:56:32', '2023-02-15 17:56:32', '2024-02-15 12:56:32'),
('bd13d83ed5236b22d2ea1a29cd8674241b48fe0ba0513100f6b2ef3770c8e999ecbc6e80609ab2b6', 10, 1, 'token', '[]', 0, '2023-02-15 17:56:46', '2023-02-15 17:56:46', '2024-02-15 12:56:46'),
('969680b1091dfbb1ae20a4b62ece6816aca464ea2a59cd3c0cd04450994775fd729897a9a6b8c3c8', 1, 1, 'token', '[]', 0, '2023-02-16 08:57:06', '2023-02-16 08:57:06', '2024-02-16 03:57:06'),
('a698db480efb98ba88dfc74ace2f6f79231d50b62a1b92fd0d95b035ea7483299f2eaf38fcc17999', 10, 1, 'token', '[]', 0, '2023-02-16 09:37:05', '2023-02-16 09:37:05', '2024-02-16 04:37:05'),
('2409dc4f8b106ef2c3112f7b9e6fe6a855f0324643bb631e49efe96a5e0999732706ff2be5196701', 10, 1, 'token', '[]', 0, '2023-02-16 10:07:12', '2023-02-16 10:07:12', '2024-02-16 05:07:12'),
('ae9864ffd9d04306f9541b0fda374e0dcd36e6b63debd214479244fd1d43c2f41651ce70e043031d', 1, 1, 'token', '[]', 0, '2023-02-16 10:14:29', '2023-02-16 10:14:29', '2024-02-16 05:14:29'),
('e139978ba6c6b2cf33a6a6ac974d8f85b7cbc9839037cc628cc6cff3f3728b1d91f4ba0e85276be1', 1, 1, 'token', '[]', 0, '2023-02-16 10:27:31', '2023-02-16 10:27:31', '2024-02-16 05:27:31'),
('5b253019fcb918156d11bf521db0f2cdf39b5cbc1f7afe7ccc46d2f56aca51309604b746321f258c', 1, 1, 'token', '[]', 0, '2023-02-16 15:42:11', '2023-02-16 15:42:11', '2024-02-16 10:42:11'),
('4ec77e03a148c2c14372aebb435b1a509fe1c8aee0320e7def9dafa32af4612bef21019b219eb800', 1, 1, 'token', '[]', 0, '2023-02-16 15:50:05', '2023-02-16 15:50:05', '2024-02-16 10:50:05'),
('1304fb39dd0ae66ae8471bbe3e96867b66e558f829a07937694402a2f4ccd7316c3480654afda531', 12, 1, 'token', '[]', 0, '2023-02-16 17:54:12', '2023-02-16 17:54:12', '2024-02-16 12:54:12'),
('dbd253166a7485402a71896dda7431d2d68aa5e670d1106512dfc7cc526fbb67a647ecad96357bcd', 13, 1, 'token', '[]', 0, '2023-02-16 17:55:14', '2023-02-16 17:55:14', '2024-02-16 12:55:14'),
('054467173495bbc6099cd73985f0e26a660574b18e2784b3cb4505ecf56db33d179b1b6b706a8773', 10, 1, 'token', '[]', 0, '2023-02-16 17:59:58', '2023-02-16 17:59:58', '2024-02-16 12:59:58'),
('ec403e48018c6ba118c6b47e0c00d5587c9f332a9934a4d3ac47c47946a98a70698a27e8879be5bf', 15, 1, 'token', '[]', 0, '2023-02-17 16:30:22', '2023-02-17 16:30:22', '2024-02-17 11:30:22'),
('aaedfbe5b01bfc86a9bdf02382881c8e3f061aab872389cfe1d844be2324f48528a913deb6874137', 15, 1, 'token', '[]', 0, '2023-02-17 16:30:44', '2023-02-17 16:30:44', '2024-02-17 11:30:44'),
('942fbe80489bf1b9607c80cba85cb8bf20a34bb43d31f2d8114c85f872505f78284bd9730c8e1e66', 13, 1, 'token', '[]', 0, '2023-02-17 16:57:29', '2023-02-17 16:57:29', '2024-02-17 11:57:29'),
('1fdc678964554dff5fb987f0ca29a82237048d062c62c27029eecc4e51705efb426992eb153a8d2b', 16, 1, 'token', '[]', 0, '2023-02-17 17:09:45', '2023-02-17 17:09:45', '2024-02-17 12:09:45'),
('e01d808cb1662f4e6d6555f53cdc1d207a473e3691d99f38be356908a05de96be8aeb6266c75150c', 17, 1, 'token', '[]', 0, '2023-02-17 17:12:28', '2023-02-17 17:12:28', '2024-02-17 12:12:28'),
('d60ecd7b457bc215778e307a70007f30d9781c9b6e6a8f45620ccbb368de3acfe7fb90e9d6022110', 18, 1, 'token', '[]', 0, '2023-02-17 17:17:05', '2023-02-17 17:17:05', '2024-02-17 12:17:05'),
('c8a03ee9d7d194df0bb310030abe4937b7fb9e25b23b4fbb6926317dbdddbce200ce1c4dde6b7d4c', 19, 1, 'token', '[]', 0, '2023-02-17 17:18:40', '2023-02-17 17:18:40', '2024-02-17 12:18:40'),
('da2eec1367cd3cd294076a52ffac94a2c528d2940fea675e233ceafe6541110480c0457ed2df963d', 19, 1, 'token', '[]', 0, '2023-02-17 17:56:12', '2023-02-17 17:56:12', '2024-02-17 12:56:12'),
('d513a538eecd054acaf618e290558e586effbd67da46988f4a79ff6f4406890185959dcadc9a7c68', 1, 1, 'token', '[]', 0, '2023-02-20 12:26:10', '2023-02-20 12:26:10', '2024-02-20 07:26:10'),
('e22d5f1f866e4bfc28a0144e5e68545fa8412f5b48879ddb6196a84d5734b6ee36e07e2d18d11cc6', 19, 1, 'token', '[]', 0, '2023-02-20 12:26:42', '2023-02-20 12:26:42', '2024-02-20 07:26:42'),
('3e907712820f7bad5c351c0c00a85f78b1b74ecd4aaea946c3086a6d3b272ba66a629d68824d357f', 20, 1, 'token', '[]', 0, '2023-02-20 12:27:20', '2023-02-20 12:27:20', '2024-02-20 07:27:20'),
('f34719cebc011189ab6939faae90ca9281cd71ae8b429d17dac7ae522736497a8a3e439ff6d5c175', 11, 1, 'token', '[]', 0, '2023-02-21 06:05:45', '2023-02-21 06:05:45', '2024-02-21 01:05:45'),
('3fe94c57bffdc73a7092557333fd5a3f73e9ca0165f8f0dc31799aaa765942f7eb0e9f9b80496c71', 20, 1, 'token', '[]', 0, '2023-02-21 09:53:04', '2023-02-21 09:53:04', '2024-02-21 04:53:04'),
('4f1920e920800933e6c897b41bdc6fa3587740765a5b97a5cb10f6729046377545cdc8fcf33f95b5', 21, 1, 'token', '[]', 0, '2023-02-21 10:06:59', '2023-02-21 10:06:59', '2024-02-21 05:06:59'),
('5e208aad2fe0b0ff1589ef164470b76917560d728f988314551647d9be955cc19a2ef68f67e24e1a', 21, 1, 'token', '[]', 0, '2023-02-21 10:11:24', '2023-02-21 10:11:24', '2024-02-21 05:11:24'),
('2cf10be99961b0be9d330ec8e7e678c7254d849914c2d9fbb7bb46cb3e251efb76cab2ac78187d4e', 22, 1, 'token', '[]', 0, '2023-02-21 10:41:52', '2023-02-21 10:41:52', '2024-02-21 05:41:52'),
('b33e6ef6e9b2665f9902fa4f270b9e9c8f486a7a857c4adf192d1034d7127941c47c0bbc34b27c73', 22, 1, 'token', '[]', 0, '2023-02-21 10:42:15', '2023-02-21 10:42:15', '2024-02-21 05:42:15'),
('a3cc1b7bce941c699a3c31f80551e9e31f0b1ff82d2f5e0ad66bc2e110fc2f60d0d9e5d2d61a1985', 23, 1, 'token', '[]', 0, '2023-02-21 13:23:57', '2023-02-21 13:23:57', '2024-02-21 08:23:57'),
('5736db9f0a73508cf676cb5d7bb08db613dbacaad58288a21dced3639c80bfa393a9a3f2b66de00a', 24, 1, 'token', '[]', 0, '2023-02-21 13:29:08', '2023-02-21 13:29:08', '2024-02-21 08:29:08'),
('4d13c66ac6eb266d10e35da8a5b7ba482500fef2ec596892b6e68ab7b9d0d34f193699ad7791c483', 24, 1, 'token', '[]', 0, '2023-02-21 13:29:21', '2023-02-21 13:29:21', '2024-02-21 08:29:21'),
('4844a2cee0f162aa1575bbd5ac9941a74b6198b43330b0004cf3acdbf82116623667a7fac41ddf76', 10, 1, 'token', '[]', 0, '2023-02-21 13:30:36', '2023-02-21 13:30:36', '2024-02-21 08:30:36'),
('0c7e00f5c8a7e36eb8679b0cadadc27a92e7a0996917208cb7e0a9f0c9cdbcde4cf4804fc27ef4b0', 10, 1, 'token', '[]', 0, '2023-02-21 16:46:48', '2023-02-21 16:46:48', '2024-02-21 11:46:48'),
('d7e12a233714ed912190c74bf05db5bfe270c4b1c89acdb5c7bd92f137a276e3e99d1c32fa9fc74b', 1, 1, 'token', '[]', 0, '2023-02-21 16:51:44', '2023-02-21 16:51:44', '2024-02-21 11:51:44'),
('b8e2d5ef98749235b26328711a176cb36884a026ea2d36d962b5224e3d79019a4da7fbccfea2502e', 1, 1, 'token', '[]', 0, '2023-02-21 16:58:38', '2023-02-21 16:58:38', '2024-02-21 11:58:38'),
('5871244ecde5cb327b3e7accd82f9324348939f590773b11c8861cf1e32c1ec59b6e322b395f7f69', 1, 1, 'token', '[]', 0, '2023-02-21 17:32:18', '2023-02-21 17:32:18', '2024-02-21 12:32:18'),
('2db3aa8ea9fabfa1404658fd7ba6a173a63c464393baf0dc7944796d5c88a31bf757c9df19e3f65c', 1, 1, 'token', '[]', 0, '2023-02-21 17:33:06', '2023-02-21 17:33:06', '2024-02-21 12:33:06'),
('89a6d56bdfb4bc6f873b702dd87b44d4f2777d55c206393238b2bed546887ad97314dd691b44fbcb', 1, 1, 'token', '[]', 0, '2023-02-21 17:34:28', '2023-02-21 17:34:28', '2024-02-21 12:34:28'),
('a3699336bd330c5ed8fdaa2e2131f45c17b12e9a57b390242ab5ed7b02de2f38332387134e6d9f02', 10, 1, 'token', '[]', 0, '2023-02-21 17:35:47', '2023-02-21 17:35:47', '2024-02-21 12:35:47'),
('efc571a6de23b4534c85c612d151d6aafa04f92c5a6492eb209352f83e86edd36875d7dd67bb837e', 1, 1, 'token', '[]', 0, '2023-02-21 22:28:18', '2023-02-21 22:28:18', '2024-02-21 17:28:18'),
('fbf941cc3bbbbe21249a080cd099ddc98340f3f36b7e76e1cd25227f647279540a5db78a9bd12348', 1, 1, 'token', '[]', 0, '2023-02-22 09:05:40', '2023-02-22 09:05:40', '2024-02-22 04:05:40'),
('f58ab316468267d241bae473c465b416b91bab1c8874edfe0b744fed64c3f0e3114d8853dc28830d', 1, 1, 'token', '[]', 0, '2023-02-22 10:02:22', '2023-02-22 10:02:22', '2024-02-22 05:02:22'),
('1cbe2a52f8ccbbb9a0773586703744f41528a24278d9d34311ce8bfb34837e9e185135e3f5172945', 1, 1, 'token', '[]', 0, '2023-02-22 10:43:35', '2023-02-22 10:43:35', '2024-02-22 05:43:35'),
('2b7dbd4a569c76bb4f3b1d3352e1b9de6899143165e14156750eb92b3076e93c9b6b44314c28482d', 1, 1, 'token', '[]', 0, '2023-02-22 11:06:02', '2023-02-22 11:06:02', '2024-02-22 06:06:02'),
('b474173e0986e003ef68e1adde7afe88a9f9d820b1110c4afda285e30418593e9d66edb95dde3dc0', 1, 1, 'token', '[]', 0, '2023-02-22 11:06:51', '2023-02-22 11:06:51', '2024-02-22 06:06:51'),
('7441991384b09c1716a53f262902c1328ea42d48bf9d8cfbe474a9f9527b3535c854268c57c088da', 1, 1, 'token', '[]', 0, '2023-02-22 11:08:55', '2023-02-22 11:08:55', '2024-02-22 06:08:55'),
('c057fccf9f53c6004fb72d3936fca11b5ad811cdfdb3697b74b61e18927c742fb4218ece27004299', 11, 1, 'token', '[]', 0, '2023-02-23 07:51:12', '2023-02-23 07:51:12', '2024-02-23 02:51:12'),
('543bc56a1f09630b9e14fb56cac8d1ddc0d412b6ca683786d7aedb57697324378a0396efc73e3baa', 1, 1, 'token', '[]', 0, '2023-02-24 09:35:15', '2023-02-24 09:35:15', '2024-02-24 04:35:15'),
('03ee5f0933724b5b546cac4e6b99ea08ac0212a17145c7462da8423d8f9d2a166b71dab7b6959abb', 1, 1, 'token', '[]', 0, '2023-02-24 10:32:27', '2023-02-24 10:32:27', '2024-02-24 05:32:27'),
('abe487b3b548106133b6b1a6c1da925b81529fb86da9e130144c6f4b93368c4fd4aa796bf5999500', 1, 1, 'token', '[]', 0, '2023-02-24 17:15:46', '2023-02-24 17:15:46', '2024-02-24 12:15:46'),
('5501841bb027bb1c8aba28596eb4b1674a204c0b88c697b1e6350828fe20a0f32ed7282fd3b51038', 10, 1, 'token', '[]', 0, '2023-02-24 19:30:23', '2023-02-24 19:30:23', '2024-02-24 14:30:23'),
('5946742831859f8610fb3a26eab21d02a3735fb7061c4095bf45ce4893a65d6c8c5d9a7199ada560', 10, 1, 'token', '[]', 0, '2023-02-24 19:38:21', '2023-02-24 19:38:21', '2024-02-24 14:38:21'),
('86f5c480b6afe1cff893a2cac7cc380506c28917ca0e1bc3a7134d24843c0a71dde95b5a4fb37ce3', 10, 1, 'token', '[]', 0, '2023-02-24 19:49:51', '2023-02-24 19:49:51', '2024-02-24 14:49:51'),
('6a7e3fc56da472b5c132a9c7d35f7af53e6b38ee7fb4ecd7091f3c48e7e3c2a1dd755670bfa55637', 1, 1, 'token', '[]', 0, '2023-02-24 20:23:26', '2023-02-24 20:23:26', '2024-02-24 15:23:26'),
('55f522bb2665bf21e763208e55595c778ec53bb1efa1850f5873fc0a4812b42ec0aefb75ca6c9876', 1, 1, 'token', '[]', 0, '2023-02-24 20:43:49', '2023-02-24 20:43:49', '2024-02-24 15:43:49'),
('5cc98fd7e88c49eafc619c5955770585325c52555e2acb340ccb63855ef028d64e4c8759cdb1f370', 1, 1, 'token', '[]', 0, '2023-02-24 20:48:51', '2023-02-24 20:48:51', '2024-02-24 15:48:51'),
('4d217ebabe4a3007b0c44a8a6bfe5317bad305b617a6ca409c3966e6a1be759b9d6815879cabe0d7', 11, 1, 'token', '[]', 0, '2023-02-25 02:34:06', '2023-02-25 02:34:06', '2024-02-24 21:34:06'),
('323bbffdaa1a3e710702165adfedb3a3c3bbd16f22ea8325c5fbbcad730cb23af80c7de98c6f6f11', 1, 1, 'token', '[]', 0, '2023-02-25 10:22:23', '2023-02-25 10:22:23', '2024-02-25 05:22:23'),
('a9e52520368ee668c2f465672f63c6b568ce49bdc8306acc57544400d6dfc3910478ed124faabf55', 10, 1, 'token', '[]', 0, '2023-02-25 14:15:57', '2023-02-25 14:15:57', '2024-02-25 09:15:57'),
('7c8d81efe7ce76c200ce4d493d5d24154b0add88c966e6bd5f4bb49248d57db60cba1c27b22445f0', 1, 1, 'token', '[]', 0, '2023-02-27 08:40:46', '2023-02-27 08:40:46', '2024-02-27 03:40:46'),
('82762687750fa3424103e5bb6e7fb6e2bae9ff50c6c4272e603df4dab972076cec811c498fc2c682', 1, 1, 'token', '[]', 0, '2023-02-27 13:48:14', '2023-02-27 13:48:14', '2024-02-27 08:48:14'),
('ed4dce08ec0835d8b5fcc29a61a5ce97a65e0615ed62b49a93b21173141b66a8f96f8e6faa364d77', 1, 1, 'token', '[]', 0, '2023-02-27 13:51:03', '2023-02-27 13:51:03', '2024-02-27 08:51:03'),
('84daec3c1973501a37c2ed8d2bd81963ae1dc0e86d49d6ebdeec3e343af601cb8e48e7955ba570a7', 1, 1, 'token', '[]', 0, '2023-02-28 08:45:42', '2023-02-28 08:45:42', '2024-02-28 03:45:42'),
('afa3bc5cc2f6a2b34d7464e4cb114195dcca661831e94432593e3d0293e25d7ba8835cdcc25f843a', 1, 1, 'token', '[]', 0, '2023-02-28 11:14:25', '2023-02-28 11:14:25', '2024-02-28 06:14:25'),
('0b9b27231096c2ce376d0d8ca31f327d45de17acfa49f99e4b281c6ad3d3281e6860201045428df9', 1, 1, 'token', '[]', 0, '2023-02-28 11:16:37', '2023-02-28 11:16:37', '2024-02-28 06:16:37'),
('2e68f10fc117cbd5dd47e0e43c793e01192ea8d9a1de07b28fe61a5aa285fa03183b9c65073ca716', 1, 1, 'token', '[]', 0, '2023-03-02 14:48:26', '2023-03-02 14:48:26', '2024-03-02 09:48:26'),
('acec5a8565e886a412c9c2b041bfd845250e468000f52e55c738d62d6fe327e426e55f68989ced9e', 1, 1, 'token', '[]', 0, '2023-03-03 16:28:36', '2023-03-03 16:28:36', '2024-03-03 11:28:36'),
('a48ae28de4b199b8e67e943eb76d697714feee8fcc63db38fa4ba2ebaf37c6870de8027556a79ebd', 1, 1, 'token', '[]', 0, '2023-03-03 16:49:01', '2023-03-03 16:49:01', '2024-03-03 11:49:01'),
('2e398dd154d688bf8be008d9549301d3c8b731a59ff8289ca710edede5992183755ffd5df24e9fc1', 1, 1, 'token', '[]', 0, '2023-03-03 17:27:10', '2023-03-03 17:27:10', '2024-03-03 12:27:10'),
('4ba7c4312f53f20ac666b9c85bfd5308780060313f08b3a060253773e6befb4c25e7b80ba0a55e1d', 1, 1, 'token', '[]', 0, '2023-03-06 08:36:24', '2023-03-06 08:36:24', '2024-03-06 03:36:24'),
('6178bb614b873a2402d0409270e8683be1ecc1366baeebfc905c8b36d15cc5d1c4bfc20a0d0b3492', 1, 1, 'token', '[]', 0, '2023-03-06 10:08:09', '2023-03-06 10:08:09', '2024-03-06 05:08:09'),
('0425bab0dfe0a1c43b73a28c424758abcaa6dde9982035e3d7f519a8683203ed75d654b894732d2a', 1, 1, 'token', '[]', 0, '2023-03-06 10:13:24', '2023-03-06 10:13:24', '2024-03-06 05:13:24'),
('c98d6f39983b41bc045f059db3f7108a50b8e7d991b6e351e743963953fc9b0c2e43a2341231e5f1', 1, 1, 'token', '[]', 0, '2023-03-06 10:46:17', '2023-03-06 10:46:17', '2024-03-06 05:46:17'),
('eb5331593cd18f783da12cc84f0568d3c8255811483bcc86c8c4a6ecae8b296abefc01af19157a89', 1, 1, 'token', '[]', 0, '2023-03-06 11:49:02', '2023-03-06 11:49:02', '2024-03-06 06:49:02'),
('27972a4bac673e8afeb4d981386a2943cdfdbaf01dd52c83113893758e66ee1070893e1dac33c9a9', 1, 1, 'token', '[]', 0, '2023-03-06 12:09:21', '2023-03-06 12:09:21', '2024-03-06 07:09:21'),
('950615b3a5657fc9948eff16c5bb5516a8af6af74acd782e047eba3268e90012c864d7c836e4e5b6', 1, 1, 'token', '[]', 0, '2023-03-06 12:17:11', '2023-03-06 12:17:11', '2024-03-06 07:17:11'),
('25749cb5fc1ffb29b1de5a2025f92026456e44ae07c5555f4dce720823bc2e3e548a9d8bf094335a', 1, 1, 'token', '[]', 0, '2023-03-06 12:19:11', '2023-03-06 12:19:11', '2024-03-06 07:19:11'),
('9d9da41c1c8586f94ea1b5bd3727465d92b8defcf99e1b4ef462a9dd80228cc4435e71c201ad930a', 1, 1, 'token', '[]', 0, '2023-03-06 12:24:52', '2023-03-06 12:24:52', '2024-03-06 07:24:52'),
('e0628499ed21bf23ca1327db93d641ff8528e35a26adaa6b5dcb15eaf73844a3192b905b5a5eb3ed', 1, 1, 'token', '[]', 0, '2023-03-06 12:31:04', '2023-03-06 12:31:04', '2024-03-06 07:31:04'),
('209de5f6d4962482841cc5b3ece8b40ffc9cbf0de453e85693816c7733d3d321bc6d7765e4dd80f2', 1, 1, 'token', '[]', 0, '2023-03-06 14:10:40', '2023-03-06 14:10:40', '2024-03-06 09:10:40'),
('9556a214636c1205f3a398f068d56d496b07c287ceb4ceabbcc4756e944978205b53d3dcca999b8a', 1, 1, 'token', '[]', 0, '2023-03-06 14:18:22', '2023-03-06 14:18:22', '2024-03-06 09:18:22'),
('99e51052a18536ffd7c81888436dd07ed89dd91674b895c3c5756031ea4725db1456eaba989525f9', 1, 1, 'token', '[]', 0, '2023-03-06 14:35:46', '2023-03-06 14:35:46', '2024-03-06 09:35:46'),
('68693c83af01ee931ef1ac9c82bdc315f9157b9a2d8e2c6a2ffbe68cec5361d0cdb3417d82da5f90', 1, 1, 'token', '[]', 0, '2023-03-06 14:39:08', '2023-03-06 14:39:08', '2024-03-06 09:39:08'),
('dd571f9de763d9378d1af6620979c336d8a6ec2c8256464ba477c172b690f2481fcfb625b5ba2d57', 1, 1, 'token', '[]', 0, '2023-03-06 14:43:52', '2023-03-06 14:43:52', '2024-03-06 09:43:52'),
('2df6f219acc09ad9db182a4a516f458482e4670ea07309e471162688da452a5894cabf5f9cef75bb', 1, 1, 'token', '[]', 0, '2023-03-06 14:48:28', '2023-03-06 14:48:28', '2024-03-06 09:48:28'),
('6434da32c1ecda3031e48b9286416c356d21d087d2c402704aabcbe4d18c72b4cf17f1ea6453113f', 1, 1, 'token', '[]', 0, '2023-03-06 14:53:29', '2023-03-06 14:53:29', '2024-03-06 09:53:29'),
('bd6427d0579a529bea00844f8603f14ce33ed03210263b2af7d772034a598d682eae1cb7cc0735ca', 1, 1, 'token', '[]', 0, '2023-03-06 14:54:26', '2023-03-06 14:54:26', '2024-03-06 09:54:26'),
('02d7b9e718c66a3f0ce213137fca422db3a7528726a9eeb48d1ece91744b98facf35e3e3f2128357', 1, 1, 'token', '[]', 0, '2023-03-06 14:55:27', '2023-03-06 14:55:27', '2024-03-06 09:55:27'),
('9f8e5a97c4fa0c427d301331abe271cfe2bd0f59f18097da227b92696178459d66e39c2f329888fb', 1, 1, 'token', '[]', 0, '2023-03-06 14:59:35', '2023-03-06 14:59:35', '2024-03-06 09:59:35'),
('4e574cf0d0fe024d944342d9d74f91671e20d17a00b18d10bd068ac9201f83ec90840422cf60813f', 1, 1, 'token', '[]', 0, '2023-03-06 15:03:52', '2023-03-06 15:03:52', '2024-03-06 10:03:52'),
('d406821a2ac4cf01d5fd494db16e480e24a42f8d029047ea254cf08ae8b7934f89ea23d068489477', 1, 1, 'token', '[]', 0, '2023-03-06 15:28:18', '2023-03-06 15:28:18', '2024-03-06 10:28:18'),
('d71227b299dd20de20e4d6645bcd297cbd05561832006d322a77a0397c3854ebfa115752bfb02f28', 1, 1, 'token', '[]', 0, '2023-03-06 15:30:50', '2023-03-06 15:30:50', '2024-03-06 10:30:50'),
('453e61ab7a930f95be7f61cf7703fc7d352af7683fc85d0aa03e61c579e65377b9ee8e55d8c1f68f', 1, 1, 'token', '[]', 0, '2023-03-06 15:42:58', '2023-03-06 15:42:58', '2024-03-06 10:42:58'),
('9a255a7711d83d363dad8e32308b4191eb73a068998c82fde54ea8fd260ce3338d64e4ed3df3039a', 1, 1, 'token', '[]', 0, '2023-03-06 16:25:47', '2023-03-06 16:25:47', '2024-03-06 11:25:47'),
('8fa2eeaf9b74862d59d4c3ecd711a823415fd5c2d96941fdbbba8106704aca24da674364b44ef8fb', 1, 1, 'token', '[]', 0, '2023-03-06 16:28:27', '2023-03-06 16:28:27', '2024-03-06 11:28:27'),
('6fb17a1c076807c7935cd117afff0907d4d46271585d93ecad658133f14b5143024d1f56fd412fc7', 1, 1, 'token', '[]', 0, '2023-03-06 16:30:54', '2023-03-06 16:30:54', '2024-03-06 11:30:54'),
('4e438f46dcbafb8014b514b9b150e38b981a9b0c44089436527362211fedd638cf9ea9d880b4ec1e', 1, 1, 'token', '[]', 0, '2023-03-06 16:33:14', '2023-03-06 16:33:14', '2024-03-06 11:33:14'),
('a4b9aec3593c98937e3bb3fa178c3e9166dea6eb4f6c8bd773f9f85767daa3cac45ec65d43060484', 1, 1, 'token', '[]', 0, '2023-03-06 16:42:27', '2023-03-06 16:42:27', '2024-03-06 11:42:27'),
('3a6660f8069d51439173abf7c53301097af5081d863f95c61fb1ee8f035645779de23fe14614bac3', 1, 1, 'token', '[]', 0, '2023-03-06 16:53:43', '2023-03-06 16:53:43', '2024-03-06 11:53:43'),
('db44e9650c860f5530396d75362f74cd0892bf5819d84e2176ff45adb598ae33ba0c96b279adf56c', 1, 1, 'token', '[]', 0, '2023-03-06 17:12:57', '2023-03-06 17:12:57', '2024-03-06 12:12:57'),
('14562d2f67fb76975b1788279e828251cf5c4b8f820fe33b24c6d24067d977fc87bbcc071fb3eca0', 1, 1, 'token', '[]', 0, '2023-03-06 17:18:57', '2023-03-06 17:18:57', '2024-03-06 12:18:57'),
('d07142b8777f3f208af172e697c9536bcf4e1ba8a2f3ac112a62dab1ff9b91685c2b2ad3615b1f30', 1, 1, 'token', '[]', 0, '2023-03-06 17:21:18', '2023-03-06 17:21:18', '2024-03-06 12:21:18'),
('8db2470f2f71eecef2dacf90fd1a7bca61f9db8061e41f1c5adf24d69d22b3a34a100c98e17c3dc5', 1, 1, 'token', '[]', 0, '2023-03-06 17:22:21', '2023-03-06 17:22:21', '2024-03-06 12:22:21');
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('80616e8e9d5746a034aeb14885547a58c630148a28660d8593986c4cbfbb37203ffe5d59946028cf', 6, 1, 'token', '[]', 0, '2023-03-06 17:49:39', '2023-03-06 17:49:39', '2024-03-06 12:49:39'),
('6cd928d295049b8472ba3c179dd0adfa58fa20d4d3fbfd148538c375ef5ca8639180b3613f47f792', 6, 1, 'token', '[]', 0, '2023-03-06 18:00:26', '2023-03-06 18:00:26', '2024-03-06 13:00:26'),
('821a64547fa8de7fe75ed80bbce24bf77e89d58a1db1e159da2d0549d5d620f16a0a13e813bad51f', 4, 1, 'token', '[]', 0, '2023-03-06 18:50:04', '2023-03-06 18:50:04', '2024-03-06 13:50:04'),
('9255166e039eccaf00f923b91fac72721655c7dbee75d0a200a55cd195da297c20578fbec6ab31b6', 4, 1, 'token', '[]', 0, '2023-03-06 19:09:31', '2023-03-06 19:09:31', '2024-03-06 14:09:31'),
('93da5fdace92b5414985e508e102121a4505178833c403e1cf46e99f37396bbd05427a2a3cb8e311', 4, 1, 'token', '[]', 0, '2023-03-06 19:14:20', '2023-03-06 19:14:20', '2024-03-06 14:14:20'),
('f97320c60c8db67f593b6a57ba4107d03e4fc528b9f7a6ca958911c980f7eb9545da9f24dccb67d5', 4, 1, 'token', '[]', 0, '2023-03-06 19:37:30', '2023-03-06 19:37:30', '2024-03-06 14:37:30'),
('0343e2d61af5225d1db9902afadab7ecf9799320bbf02bde60ac5ed562ee299f4943511e30164620', 4, 1, 'token', '[]', 0, '2023-03-06 19:37:36', '2023-03-06 19:37:36', '2024-03-06 14:37:36'),
('9b828d01ed8bc00fa6a704f73a224e81d506df00e2ade2aa82a8ce0c6d8b75aaa50a4ecd8e3b2666', 1, 1, 'token', '[]', 0, '2023-03-07 09:01:08', '2023-03-07 09:01:08', '2024-03-07 04:01:08'),
('87376108ff0f42e8692d34651853df05d211d39109b8e189da3e686da9efaa1a50b2e7642705b324', 1, 1, 'token', '[]', 0, '2023-03-07 09:23:28', '2023-03-07 09:23:28', '2024-03-07 04:23:28'),
('ccca68120d686d34fe6e99820c687334d6a2b501f1b1c63496e2719a1a8961d0e1747061c15eea50', 1, 1, 'token', '[]', 0, '2023-03-07 09:28:47', '2023-03-07 09:28:47', '2024-03-07 04:28:47'),
('509b3941d121e9e475809e7091350af7641cb2d8448481b72649665eb625e9137734ea31a32dd351', 1, 1, 'token', '[]', 0, '2023-03-07 09:32:48', '2023-03-07 09:32:48', '2024-03-07 04:32:48'),
('d2f79139776130337db83f57020c838263e5eb4dfebd43b4d55b8be285505fbf8de391fde4466d38', 1, 1, 'token', '[]', 0, '2023-03-07 10:18:11', '2023-03-07 10:18:11', '2024-03-07 05:18:11'),
('2c92bafa5f6012cc7cf06f97b04c374363ec5ff498cfcee8f13e2987273b92ec0db4c22e2dba7986', 1, 1, 'token', '[]', 0, '2023-03-07 10:28:39', '2023-03-07 10:28:39', '2024-03-07 05:28:39'),
('099a5bff4adee6d8cb7b3ab18c74d4e3aee25c7a3bdca333c37b5073a64d4fdbd576d120787063fa', 1, 1, 'token', '[]', 0, '2023-03-07 10:35:32', '2023-03-07 10:35:32', '2024-03-07 05:35:32'),
('3af9001f4045a15206afdb1725323c7904eaa0bbf9c40c6dd2c39800776bbeda7c478bb3e555d6e1', 1, 1, 'token', '[]', 0, '2023-03-07 10:37:57', '2023-03-07 10:37:57', '2024-03-07 05:37:57'),
('66e6f397daa7c9ded09fcdce99d4bc0284e7389b843f463f051936c7fe402b4114031fc28d8cd631', 1, 1, 'token', '[]', 0, '2023-03-07 10:40:39', '2023-03-07 10:40:39', '2024-03-07 05:40:39'),
('64de4b07cd733c34a7e604d6b432a4ef29fc651f71817891f1c7da03a4f904d1a9a476c0232406b1', 1, 1, 'token', '[]', 0, '2023-03-07 10:43:43', '2023-03-07 10:43:43', '2024-03-07 05:43:43'),
('55ae9480b62726d97989e61a867520ececfbce66b952b0afce5da96391a80e28498530b3ef8c0abc', 1, 1, 'token', '[]', 0, '2023-03-07 10:53:24', '2023-03-07 10:53:24', '2024-03-07 05:53:24'),
('fb6ea06bf574167097d5f03a71616a96987c617a224e0d8dd91cc2bd891f0663198a8897148a991e', 1, 1, 'token', '[]', 0, '2023-03-07 11:18:13', '2023-03-07 11:18:13', '2024-03-07 06:18:13'),
('d4d2ed4ae098c1e20995677e1aef4c224cb625e63dee9197dd6ed0c288aecebb7b7e61137cde90f5', 5, 1, 'token', '[]', 0, '2023-03-07 11:26:59', '2023-03-07 11:26:59', '2024-03-07 06:26:59'),
('78bdbdfa755715b622aa53eede5538f4ef002041966e45475124b38813d83551ce2577011d7457ee', 7, 1, 'token', '[]', 0, '2023-03-07 11:33:30', '2023-03-07 11:33:30', '2024-03-07 06:33:30'),
('42e9a79452c70593829d66d3cf5ab9234b47b22f7750e640bb3485753d59d76f80cb85e6014f75a9', 4, 1, 'token', '[]', 0, '2023-03-07 14:34:34', '2023-03-07 14:34:34', '2024-03-07 09:34:34'),
('2098b6a27915a150307c94f337cf76e3a961307afdc9cd7196ac8797199a99e688127a42e402c31b', 13, 1, 'token', '[]', 0, '2023-03-07 15:13:02', '2023-03-07 15:13:02', '2024-03-07 10:13:02'),
('5a82ac2bd067a04373a987c09f29083d29e382e48ab24f6ec1c64a5d51901a11bd4a851726d1ca66', 13, 1, 'token', '[]', 0, '2023-03-07 15:13:20', '2023-03-07 15:13:20', '2024-03-07 10:13:20'),
('3c00d7b056e5147a0fa0eb3459d08a1248ea86d3b4d7a3525fd929b5f02573784c3463d05786470a', 11, 1, 'token', '[]', 0, '2023-03-07 15:18:00', '2023-03-07 15:18:00', '2024-03-07 10:18:00'),
('436fbb9481317bd817a401d5054031761dcc2692c35d13fe7294038020af98fc7972f9490cf1eed3', 11, 1, 'token', '[]', 0, '2023-03-07 15:18:18', '2023-03-07 15:18:18', '2024-03-07 10:18:18'),
('fd9592eb04b463f17f84781d680ef7fb5664b669cb515cc14d39ce6f3154e7451b37a93b65d0e459', 1, 1, 'token', '[]', 0, '2023-03-07 16:16:55', '2023-03-07 16:16:55', '2024-03-07 11:16:55'),
('1bda131a49d68c8ec43e5fc565b4ab634746b5311a2b054e9c8848c39f557ccc0db8507da216d424', 1, 1, 'token', '[]', 0, '2023-03-07 17:30:16', '2023-03-07 17:30:16', '2024-03-07 12:30:16'),
('8a1499e9a4995eb0fe638f8d68d7235a187749c3666dd3801285a0ef427c1385ae1dc61555a3071c', 1, 1, 'token', '[]', 0, '2023-03-07 17:31:15', '2023-03-07 17:31:15', '2024-03-07 12:31:15'),
('03a504dfba4477da8955ed60b9f0f03322f888f811ff46b08582aa22ca59d3e9eaeb584515c6f135', 1, 1, 'token', '[]', 0, '2023-03-09 09:57:31', '2023-03-09 09:57:31', '2024-03-09 04:57:31'),
('b498735e62cc8b27dd200b273b1f8151af6accf50705051eaf564dd432d5462b918c324e19d3bec4', 1, 1, 'token', '[]', 0, '2023-03-09 09:58:58', '2023-03-09 09:58:58', '2024-03-09 04:58:58'),
('0caa2670fe16f399cd0c6967170202f4972049d897b49a0593bc655e5b4c44c059ba02192093e23b', 1, 1, 'token', '[]', 0, '2023-03-09 10:04:24', '2023-03-09 10:04:24', '2024-03-09 05:04:24'),
('e2e15789fc932b271fab680698cbb76ae2c069b438346954207b8e15552fb712e403d158f2ee6f3e', 1, 1, 'token', '[]', 0, '2023-03-09 10:53:06', '2023-03-09 10:53:06', '2024-03-09 05:53:06'),
('33a01d6b71b8151d9e2e1f21f3bc38ae5ab84825f123e8a12a9452b2bd487f3dec093bd3b344dd1c', 1, 1, 'token', '[]', 0, '2023-03-09 11:35:40', '2023-03-09 11:35:40', '2024-03-09 06:35:40'),
('25d6ee1af437027fbd48d634ca6fa3d0bc0a3151df241c197bc141ca381fdb120e5487a44f76aa79', 1, 1, 'token', '[]', 0, '2023-03-09 11:51:17', '2023-03-09 11:51:17', '2024-03-09 06:51:17'),
('998b5e46a7588f0599b1c1b1d822d87daee6f81c24f45a93d532518c8237acb358e736ddce60fde3', 1, 1, 'token', '[]', 0, '2023-03-15 08:21:28', '2023-03-15 08:21:28', '2024-03-15 04:21:28'),
('4eac3fc32b0bd5f17b65b58be76874ddd3a5d571beeb4d35e3031c105fa75a6ef23b2e6a09e41294', 1, 1, 'token', '[]', 0, '2023-03-22 14:46:27', '2023-03-22 14:46:27', '2024-03-22 10:46:27'),
('08a4949ac37e777c14dbd490fa6ee26fcc215189e897656e5c14788d4608433d9e08a6b8d284a8d0', 1, 1, 'token', '[]', 0, '2023-03-23 08:43:06', '2023-03-23 08:43:06', '2024-03-23 04:43:06'),
('46907d3551eb1dbe656bd5b063ba49389537c91ff37efea8e4a47a5725f3fa39b354b2672e8bceff', 1, 1, 'token', '[]', 0, '2023-03-23 08:59:10', '2023-03-23 08:59:10', '2024-03-23 04:59:10'),
('70ec20d8124d388b4347a05660e3ce225492d966b4e623c80e131ad63b4819d3e98779029d6809d1', 1, 1, 'token', '[]', 0, '2023-03-23 09:01:02', '2023-03-23 09:01:02', '2024-03-23 05:01:02'),
('d34a791c1e70c6308f0a0f4fca94b0cdf9ca4cfe9a6ad152f3d3165b133c697ee20ee060bc4d005d', 1, 1, 'token', '[]', 0, '2023-03-23 09:16:39', '2023-03-23 09:16:39', '2024-03-23 05:16:39'),
('a842199fb5c0fbcc54fad6317ff039f8b583d2f2e16e6607293cd146af3503f4ec5310b2b5f0608d', 15, 1, 'token', '[]', 0, '2023-03-23 09:20:03', '2023-03-23 09:20:03', '2024-03-23 05:20:03'),
('8428e41bc90ffaee8f54277c99114e560fa497be0aca05ee6e10b1618f339f91eba6fa84579b0f60', 15, 1, 'token', '[]', 0, '2023-03-23 09:20:17', '2023-03-23 09:20:17', '2024-03-23 05:20:17'),
('64ea832094447a6bf09661c146ecc3225ebff1ffcaf598abe0241bf7003210bb8fba60b055a1f122', 15, 1, 'token', '[]', 0, '2023-03-23 09:32:59', '2023-03-23 09:32:59', '2024-03-23 05:32:59'),
('07805fa8d0437f2439242f2f728def2b7f8e213a775db2413be51ff038636fe8b7c95f2ac878d134', 15, 1, 'token', '[]', 0, '2023-03-23 09:42:07', '2023-03-23 09:42:07', '2024-03-23 05:42:07'),
('0b778e724b0865b953000e35bc46196b7bf2e9c2e7bcc02df24cf6f239e2312285e4492f44a8cf04', 15, 1, 'token', '[]', 0, '2023-03-23 09:45:37', '2023-03-23 09:45:37', '2024-03-23 05:45:37'),
('1c40adb1c93041e4184c4e57c9c338d3431e3088afa001da1cabd1909b6df2d465b7292b11022bad', 6, 1, 'token', '[]', 0, '2023-03-23 13:54:07', '2023-03-23 13:54:07', '2024-03-23 09:54:07'),
('466196ad3933a38eebb8c615216720f827b9c9667ae3d0174c10dba71964e5b22fdb58c9f6d19ded', 6, 1, 'token', '[]', 0, '2023-03-23 13:57:59', '2023-03-23 13:57:59', '2024-03-23 09:57:59'),
('c3a2c4a5061b6905fefd800c19dd0fc157a5c0ac6a84610a6f3b87d870657e0ea378ab060555344a', 6, 1, 'token', '[]', 0, '2023-03-23 14:01:33', '2023-03-23 14:01:33', '2024-03-23 10:01:33'),
('464a3f38476a4d874e832d04ced222dfb58c0697d029c44b2954f18f61f76614250bdedab3099d2b', 6, 1, 'token', '[]', 0, '2023-03-23 14:05:10', '2023-03-23 14:05:10', '2024-03-23 10:05:10'),
('c8df309d96317661cb2a6e561e1f0c8421c279efe1b364a01df7c9204bd16a18895767354630e1bf', 6, 1, 'token', '[]', 0, '2023-03-23 14:06:15', '2023-03-23 14:06:15', '2024-03-23 10:06:15'),
('8f308793752f64ceecc1cc9cf16b786ce30f43f2e4e8723119d7d01ef8d3c04abcd794a836a4a720', 1, 1, 'token', '[]', 0, '2023-03-27 08:27:11', '2023-03-27 08:27:11', '2024-03-27 04:27:11'),
('52ada7d4844a2e99f8bb9a3863d77176807072a2ec73226e447ca24c8c8ea2b5f1f6b0b449d96151', 1, 1, 'token', '[]', 0, '2023-03-27 11:04:16', '2023-03-27 11:04:16', '2024-03-27 07:04:16'),
('6c5965210781838c519a73a966d7160efe8a05999e7c8c1336b5dd4675d8f0844d2567ae2f185165', 1, 1, 'token', '[]', 0, '2023-03-27 15:37:25', '2023-03-27 15:37:25', '2024-03-27 11:37:25'),
('89c33dbe8f17889c0b0c5de1c0ffd07c51dc898325803588036f17a3dba223cc220fe3a8abc40891', 4, 1, 'token', '[]', 0, '2023-03-27 18:32:23', '2023-03-27 18:32:23', '2024-03-27 14:32:23'),
('268c2eecc2821b20e28d0d307292b324f5a46be5c2c00c80a176bd35da0da7b82752f99dfdb15698', 1, 1, 'token', '[]', 0, '2023-03-28 14:36:10', '2023-03-28 14:36:10', '2024-03-28 10:36:10'),
('39b6456b383b7eaaae5cb8a06ebf96769971cb1eda51e58a261a287af733e02b22d1ed3693c5a39a', 1, 1, 'token', '[]', 0, '2023-03-29 07:50:35', '2023-03-29 07:50:35', '2024-03-29 03:50:35'),
('185de12237d72071d5efef6356a5c958a826fb4ae0898957138251c01620bdb81a66d9fe42a6b095', 1, 1, 'token', '[]', 0, '2023-03-31 16:30:21', '2023-03-31 16:30:21', '2024-03-31 12:30:21'),
('304e016f7d828422f8bfbd5a2ab15d85e1d0aefe633f3af5a2ca8def7130b058bdfc0111f908111f', 1, 1, 'token', '[]', 0, '2023-03-31 16:53:46', '2023-03-31 16:53:46', '2024-03-31 12:53:46'),
('1596ed40193c987dae8f18cfe6871ad045123a1bf3f924aa344d4de09b02d88e0873543404e76905', 1, 1, 'token', '[]', 0, '2023-04-03 13:14:36', '2023-04-03 13:14:36', '2024-04-03 09:14:36'),
('74e20a0c51a61a5c706b1cb2ff132050d03a9f18d4604d304c0e8ebf178d593ed697024661dd0e01', 1, 1, 'token', '[]', 0, '2023-04-25 09:05:28', '2023-04-25 09:05:28', '2024-04-25 05:05:28'),
('28623e23d3bc9ecaedb28a2007e2f6ea0388dbbf450bc9d390b23a5d9b9abdc58012e2d1fd43a027', 2, 1, 'token', '[]', 0, '2023-04-25 16:36:31', '2023-04-25 16:36:31', '2024-04-25 12:36:31'),
('99936abce52c105ace063183eb860d97619e5cad38f2b08618e649eb5594f342780ab382e92b4a99', 1, 1, 'token', '[]', 0, '2023-04-26 08:04:24', '2023-04-26 08:04:24', '2024-04-26 04:04:24'),
('b633691107524f747c4685b03d6fbaa6d5bba2e220edbe7683686ec3cccac0af1db6dba975f2968b', 1, 1, 'token', '[]', 0, '2023-04-27 13:39:23', '2023-04-27 13:39:23', '2024-04-27 09:39:23'),
('d8367dd2060f8e490cb2fb4a8f9ff65ea67e435ce54a05716d27f358e242cfa0fe7eaa5f6660294a', 1, 1, 'token', '[]', 0, '2023-05-02 16:31:52', '2023-05-02 16:31:52', '2024-05-02 12:31:52'),
('36222cce607046fd2cfe514db98ad0566803302d3ef6b3ba64074faf24988a344df3a7fa51a34338', 1, 1, 'token', '[]', 0, '2023-05-03 07:44:54', '2023-05-03 07:44:54', '2024-05-03 03:44:54'),
('d466312b9dadfa421df441026681e4e3aa785007a110d22475207afc2e892432f51f436ffcceee08', 1, 1, 'token', '[]', 0, '2023-05-03 08:45:38', '2023-05-03 08:45:38', '2024-05-03 04:45:38'),
('de76685e6fe7eaa4039f297c44648cb1cb04944631e06bd6215ef9d8d20a5589b46eb8e8126c864c', 16, 1, 'token', '[]', 0, '2023-05-03 13:41:48', '2023-05-03 13:41:48', '2024-05-03 09:41:48'),
('669c7add9c4e04d8d18367ff58bc3b4075e591ec3005642876cf21af08fc320cce03a0d43f7fb3b5', 16, 1, 'token', '[]', 0, '2023-05-03 13:42:26', '2023-05-03 13:42:26', '2024-05-03 09:42:26'),
('634c0d4e9c10d0033705dba670596514e0d6c242e72455ca02962b241283fcdd8b62f8f233cc147b', 16, 1, 'token', '[]', 0, '2023-05-03 13:44:30', '2023-05-03 13:44:30', '2024-05-03 09:44:30'),
('f4f87c925e79d9cccd7e9c9ee3c637b128139b9d06f62d8fd214ffeb601d4b39548d3a0b94c0a2e2', 1, 1, 'token', '[]', 0, '2023-05-03 13:52:30', '2023-05-03 13:52:30', '2024-05-03 09:52:30'),
('b09c0014b76929053ec7450ef819547f491515bd8b355ddb40aaf008529c68e2ff5fe2904efed9f0', 16, 1, 'token', '[]', 0, '2023-05-03 13:52:55', '2023-05-03 13:52:55', '2024-05-03 09:52:55'),
('936c1f066986436c3631abaf47b7d7c631dee24e537ed66a6f54ae4f003fc1e9d40d6b4566f01105', 1, 1, 'token', '[]', 0, '2023-05-04 13:48:29', '2023-05-04 13:48:29', '2024-05-04 09:48:29'),
('c427827816c72b62933371cdd9014331dc02295ea12577f53b95d80076b52d5fedeb6ebf75899759', 1, 1, 'token', '[]', 0, '2023-05-05 08:38:50', '2023-05-05 08:38:50', '2024-05-05 04:38:50'),
('5d8cc4158e91b8f07571240ffb396762277f9745e602ff17c1ac68da4e496f40c059cdc25429aa56', 1, 1, 'token', '[]', 0, '2023-05-12 13:02:22', '2023-05-12 13:02:22', '2024-05-12 09:02:22'),
('3ee094c617d4fe8c6a41c78a55731d887ffe9257bcdd07d7881dcda104aed4d930b104429687c50c', 1, 1, 'token', '[]', 0, '2023-05-12 14:17:30', '2023-05-12 14:17:30', '2024-05-12 10:17:30'),
('e2336d0cee44a7ca28d8c42781aa0c2ad10c7eca2fe448606cf8acd659b2e95d938f4754edc6008a', 1, 1, 'token', '[]', 0, '2023-05-18 13:25:15', '2023-05-18 13:25:15', '2024-05-18 09:25:15'),
('08b14bc294560af6e426324ca522c9a36104fa9de192bc601f4ea047e4be64804db9c68a4566e59a', 1, 1, 'token', '[]', 0, '2023-05-22 08:34:12', '2023-05-22 08:34:12', '2024-05-22 04:34:12'),
('8dbe7bd4c036d0c775e0cfcc2c41d20b8050010326b8bc29bdb7f29d1d528050675bd1b7b3f84b15', 1, 1, 'token', '[]', 0, '2023-05-23 08:34:36', '2023-05-23 08:34:36', '2024-05-23 04:34:36'),
('1298d4a31aead376e7f72b51fad05ba804ed89106514130b6d46f9937e000960584dccdd32bf8687', 1, 1, 'token', '[]', 0, '2023-05-25 08:01:31', '2023-05-25 08:01:31', '2024-05-25 04:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Event Personal Access Client', 'eBTery4cgEz4eJDW4aiuG2WftgH6v4owTfo9UrhT', NULL, 'http://localhost', 1, 0, 0, '2023-01-30 23:41:30', '2023-01-30 23:41:30'),
(2, NULL, 'Event Password Grant Client', 'O1AcCoUtS3AChPtR5S6xCAGKurR8dkQCfPYBHxcx', 'users', 'http://localhost', 0, 1, 0, '2023-01-30 23:41:30', '2023-01-30 23:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-01-30 23:41:30', '2023-01-30 23:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'Npm', 'f3ac971a72a04eab66449ce0b0604fb2d9fb6b2972d3fd38c4fe44cb417ef521', '[\"*\"]', NULL, '2023-01-30 22:20:14', '2023-01-30 22:20:14'),
(2, 'App\\Models\\User', 2, 'token', 'dbc736b885d62a2502171e152c10071564adbcdd8efcaf445058b517cb32b49f', '[\"*\"]', NULL, '2023-01-30 23:30:34', '2023-01-30 23:30:34'),
(3, 'App\\Models\\User', 3, 'token', '0653906095c432b0004fc6a2a6a15c3cdbc46adfbb7255f8b347f3b37a394130', '[\"*\"]', NULL, '2023-01-30 23:35:49', '2023-01-30 23:35:49'),
(4, 'App\\Models\\User', 4, 'token', 'b6e5d34db7a6e4041819f8aad7a78b26eaa10371fa8c70239b98cc9ae99b8961', '[\"*\"]', NULL, '2023-01-30 23:44:22', '2023-01-30 23:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_oder_id` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `is_confirmed` int(50) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `ticket_scan_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_oder_id`, `amount`, `payment_mode`, `is_confirmed`, `provider`, `status`, `ticket_scan_status`, `created_at`, `updated_at`) VALUES
(1, '6405d447889fd', 903.98, 'stripe', 0, NULL, 'Complete', 1, '2023-03-06 16:53:43', '2023-03-06 16:56:25'),
(2, '6405d8c9b338f', 56.99, 'stripe', 0, NULL, 'Complete', 0, '2023-03-06 17:12:57', '2023-03-06 17:13:26'),
(3, '6405da31d0dc8', 1807.96, 'stripe', 0, NULL, 'Complete', 0, '2023-03-06 17:18:57', '2023-03-06 17:19:37'),
(4, '6405dabe5cac1', 36.99, 'stripe', 0, NULL, 'Complete', 0, '2023-03-06 17:21:18', '2023-03-06 17:21:59'),
(5, '6405e4071635a', 73.98, 'stripe', 0, NULL, 'Complete', 0, '2023-03-06 18:00:55', '2023-03-06 18:02:49'),
(6, '6405f41b4abf7', 71.99, 'stripe', 0, NULL, 'Pending', 0, '2023-03-06 19:09:31', '2023-03-06 19:09:31'),
(7, '6405f482567ea', 71.99, 'stripe', 0, NULL, 'Complete', 1, '2023-03-06 19:11:14', '2023-03-06 19:37:49'),
(8, '6405f7ba4096c', 501.99, 'stripe', 0, NULL, 'Pending', 0, '2023-03-06 19:24:58', '2023-03-06 19:24:58'),
(9, '6406b35490b31', 36.99, 'stripe', 0, NULL, 'Complete', 0, '2023-03-07 08:45:24', '2023-03-07 08:46:00'),
(10, '6406b745c97c8', 36.99, 'stripe', 0, NULL, 'Complete', 0, '2023-03-07 09:02:13', '2023-03-07 09:03:15'),
(11, '6406bc412b34a', 36.99, 'stripe', 0, NULL, 'Complete', 0, '2023-03-07 09:23:29', '2023-03-07 09:25:18'),
(12, '6406bd802a99f', 36.99, 'stripe', 0, NULL, 'Pending', 0, '2023-03-07 09:28:48', '2023-03-07 09:28:48'),
(13, '6406be709b244', 36.99, 'stripe', 0, NULL, 'Pending', 0, '2023-03-07 09:32:48', '2023-03-07 09:32:48'),
(14, '6406c05c3aa5b', 36.99, 'stripe', 0, NULL, 'Pending', 0, '2023-03-07 09:41:00', '2023-03-07 09:41:00'),
(15, '6406c2836ed44', 36.99, 'stripe', 0, NULL, 'Pending', 0, '2023-03-07 09:50:11', '2023-03-07 09:50:11'),
(16, '6406c3df08bbf', 36.99, 'stripe', 0, NULL, 'Pending', 0, '2023-03-07 09:55:59', '2023-03-07 09:55:59'),
(17, '6406c68fe926f', 73.98, 'stripe', 0, NULL, 'Failed', 0, '2023-03-07 10:07:27', '2023-03-07 10:07:56'),
(18, '6406c9136d73e', 36.99, 'stripe', 0, NULL, 'Failed', 0, '2023-03-07 10:18:11', '2023-03-07 10:19:20'),
(19, '6406cb884889f', 36.99, 'stripe', 0, NULL, 'Pending', 0, '2023-03-07 10:28:40', '2023-03-07 10:28:40'),
(20, '6406cd2487414', 36.99, 'stripe', 0, NULL, 'Pending', 0, '2023-03-07 10:35:32', '2023-03-07 10:35:32'),
(21, '6406cdb64b8ef', 73.98, 'stripe', 0, NULL, 'Failed', 0, '2023-03-07 10:37:58', '2023-03-07 10:38:55'),
(22, '6406ce5816fa0', 36.99, 'stripe', 0, NULL, 'Failed', 0, '2023-03-07 10:40:40', '2023-03-07 10:41:14'),
(23, '6406cf10053b8', 36.99, 'stripe', 0, NULL, 'Failed', 0, '2023-03-07 10:43:44', '2023-03-07 10:51:09'),
(24, '6406d16010ad7', 36.99, 'stripe', 0, NULL, 'Failed', 0, '2023-03-07 10:53:36', '2023-03-07 10:54:09'),
(25, '6406d7256da84', 36.99, 'SSLCommerz', 1, NULL, 'Complete', 1, '2023-03-07 11:18:13', '2023-03-07 11:24:46'),
(26, '6407052adfd6c', 501.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-07 14:34:34', '2023-03-07 14:37:49'),
(27, '64070dae6c719', 36.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-07 15:10:54', '2023-03-07 15:12:05'),
(28, '64070eb1c27f9', 73.98, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-07 15:15:13', '2023-03-07 15:16:45'),
(29, '64071d0c7c4ee', 91.99, 'SSLCommerz', 0, NULL, 'Pending', 0, '2023-03-07 16:16:28', '2023-03-07 16:16:28'),
(30, '64071d2798788', 36.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-07 16:16:55', '2023-03-07 16:17:25'),
(31, '64072e58c3d2a', 36.99, 'SSLCommerz', 1, NULL, 'Complete', 1, '2023-03-07 17:30:16', '2023-03-07 17:33:01'),
(32, '64096743d02fb', 91.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-09 09:57:39', '2023-03-09 09:58:18'),
(33, '64096858687be', 143.98, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-09 10:02:16', '2023-03-09 10:02:46'),
(34, '64097e3cb5b36', 91.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-09 11:35:40', '2023-03-09 11:36:26'),
(35, '641bd359835c0', 125.97, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 08:19:37', '2023-03-23 08:20:17'),
(36, '641bd45fba7a8', 31.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 08:23:59', '2023-03-23 08:24:47'),
(37, '641bd5de20668', 31.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 08:30:22', '2023-03-23 08:31:18'),
(38, '641bd6dd446cb', 31.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 08:34:37', '2023-03-23 08:35:19'),
(39, '641bd7e628567', 31.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 08:39:02', '2023-03-23 08:39:40'),
(40, '641bd87262b4d', 31.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 08:41:22', '2023-03-23 08:41:56'),
(41, '641bd9bfdcf4b', NULL, 'SSLCommerz', 0, NULL, 'Pending', 0, '2023-03-23 08:46:55', '2023-03-23 08:46:55'),
(42, '641bd9f073b8d', NULL, 'SSLCommerz', 0, NULL, 'Pending', 0, '2023-03-23 08:47:44', '2023-03-23 08:47:44'),
(43, '641bdb076fa11', NULL, 'SSLCommerz', 0, NULL, 'Pending', 0, '2023-03-23 08:52:23', '2023-03-23 08:52:23'),
(44, '641bdc2d1a821', 46.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 08:57:17', '2023-03-23 08:57:50'),
(45, '641bdcb6a199a', 31.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 08:59:34', '2023-03-23 09:00:06'),
(46, '641be0358903b', 110.18, 'SSLCommerz', 1, NULL, 'Complete', 1, '2023-03-23 09:14:29', '2023-03-27 11:36:17'),
(47, '641be3d36bf44', 275.45, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 09:29:55', '2023-03-23 09:30:24'),
(48, '641be663258a4', 246.46, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 09:40:51', '2023-03-23 09:41:23'),
(49, '641be731a3889', 93.98, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 09:44:17', '2023-03-23 09:44:47'),
(50, '641c21cf15bd2', 31.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 13:54:23', '2023-03-23 13:56:21'),
(51, '641c231c6c51f', 93.98, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 13:59:56', '2023-03-23 14:00:33'),
(52, '641c24652b5dc', 46.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-23 14:05:25', '2023-03-23 14:05:58'),
(53, '64211b7237899', 21.99, 'SSLCommerz', 1, NULL, 'Complete', 1, '2023-03-27 08:28:34', '2023-03-27 11:35:31'),
(54, '64211c1eedc64', 215.97, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-03-27 08:31:26', '2023-03-27 08:31:57'),
(55, '6448a39149266', 46.99, 'SSLCommerz', 0, NULL, 'Canceled', 0, '2023-04-26 08:07:45', '2023-04-26 08:08:52'),
(56, '6448a41858342', 61.99, 'SSLCommerz', 0, NULL, 'Canceled', 0, '2023-04-26 08:10:00', '2023-04-26 08:10:12'),
(57, '6448a683008db', 61.99, 'SSLCommerz', 0, NULL, 'Pending', 0, '2023-04-26 08:20:19', '2023-04-26 08:20:19'),
(58, '6451da9b91d5f', 61.99, 'SSLCommerz', 1, NULL, 'Complete', 1, '2023-05-03 07:52:59', '2023-05-03 07:55:04'),
(59, '6451dc1128c1b', 61.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-05-03 07:59:13', '2023-05-03 07:59:52'),
(60, '6451dc82efd6e', 123.98, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-05-03 08:01:06', '2023-05-03 08:01:46'),
(61, '6451dd4ab6ec3', 61.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-05-03 08:04:26', '2023-05-03 08:05:05'),
(62, '6451ddda27aa3', 185.97, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-05-03 08:06:50', '2023-05-03 08:07:27'),
(63, '6451de8e6fe76', 61.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-05-03 08:09:50', '2023-05-03 08:10:28'),
(64, '6451dfc460a36', 61.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-05-03 08:15:00', '2023-05-03 08:15:31'),
(65, '6451e22224a0b', 61.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-05-03 08:25:06', '2023-05-03 08:26:03'),
(66, '6451e2b1754e0', 61.99, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-05-03 08:27:29', '2023-05-03 08:28:04'),
(67, '6451e6932b656', 158.07, 'SSLCommerz', 1, NULL, 'Complete', 0, '2023-05-03 08:44:03', '2023-05-03 08:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_first_name` varchar(255) DEFAULT NULL,
  `user_last_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_number` varchar(255) DEFAULT NULL,
  `user_profile_photo` varchar(255) DEFAULT NULL,
  `user_verified` int(11) DEFAULT NULL,
  `is_guest_user` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `set_event_create` int(11) NOT NULL DEFAULT 0,
  `password` varchar(100) DEFAULT NULL,
  `token` longtext DEFAULT NULL,
  `forgot_token` varchar(255) DEFAULT NULL,
  `set_host_name` varchar(255) DEFAULT NULL,
  `events_plan` int(11) DEFAULT NULL,
  `access_request` int(11) NOT NULL DEFAULT 0,
  `is_admin` int(11) NOT NULL DEFAULT 0 COMMENT '1-yes  0-no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_first_name`, `user_last_name`, `user_email`, `user_number`, `user_profile_photo`, `user_verified`, `is_guest_user`, `status`, `set_event_create`, `password`, `token`, `forgot_token`, `set_host_name`, `events_plan`, `access_request`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'ketan', 'prajapati', 'ketan.tupple@gmail.com', '9874563257', 'user_profile1676465683.jpg', NULL, 0, 0, 1, '$2y$10$obL8fbmMPKAjHPeK.gTxKOuu0S8.h4G7BZeuQ3z2y0l0R2koEmYze', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMTI5OGQ0YTMxYWVhZDM3NmU3ZjcyYjUxZmFkMDViYTgwNGVkODkxMDY1MTQxMzBiNmQ0NmY5OTM3ZTAwMDk2MDU4NGRjY2RkMzJiZjg2ODciLCJpYXQiOjE2ODQ5ODcyOTEuNjE1MTk3LCJuYmYiOjE2ODQ5ODcyOTEuNjE1MjAxLCJleHAiOjE3MTY2MDk2OTEuNTk0Nzc5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.bJh03xC4O1Y0wdO7cibIFXm78-3pgfkWE0DDF0AyVvPveOC_cGbJiQTKdE-MGmGstwe86hPt2aLA8vwbBsfBEwOI6YuOlZtLHg3vLdt3ygKAwiPio4bclZe8scB8cSVK4cRxqK-TaE87cTbgVeHbTMQ0HiKEUiBmeEBjFB-0rxFiS9cdkqzj1O-l0E3xSDGIOxnDbV0mLpre46cV12hSTE6AfKwqZy1zEYEcyoOV3CoxFONCqMg2_3-mmdbcQM-uwFHJcMnI05xsoFNlZdBO7n_AZr0Agy8U0w7pmKJJuGrLjWuTh2LHuQO2jaI2TybhXtEyG2g8NlwGGO8ZBEAQdnaHPlgcgbMQPT-uC8kTZxMQeqcajZwBDf20u77PA-42GCvq2zEwhGt9e9I-xSVUeE1ehgwWm9BLwMD4JPbDRazSizVCooukY76VI_nNCrEg6W_7l34cBBJrAoC-SOyAtOky9ZKJUPp2mOKMtsmgjuBOPSUP13iaVOqrskRCvJcb4Ko2phNRZ0XFwbB1v0LJiBQiADdxR9Ez4sfjRX_rwk578o_AVY3l_qJ5Xj8DT0fjV8AiDj8vMnDhEp7FYGiyVzxhY3kjJ2vBUeEF_A7OdgC4_S5Z5ABQBxZirq1VxODqQnLPHZh4TcRTiyXxcFJpktV5GVdhtTZ6gxUGR1UsgJw', 'x8eBkHju', 'Ketan', 10, 0, 0, '2023-01-31 00:05:38', '2023-05-25 08:01:31'),
(2, 'jayeshbhai', NULL, 'jayesh@gmail.com', '9857458698', 'user_profile1675143338.png', NULL, 0, 0, 0, '$2y$10$6KYbfMjxtgyNqPojZlDhEukZEEvAQsPad3KvEEgwmM6X613/Sgf6C', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMjg2MjNlMjNkM2JjOWVjYWVkYjI4YTIwMDdlMmY2ZWEwMzg4ZGJiZjQ1MGJjOWQzOTBiMjNhNWQ5YjlhYmRjNTgwMTJlMmQxZmQ0M2EwMjciLCJpYXQiOjE2ODI0MjYxOTIuMDE3ODIzLCJuYmYiOjE2ODI0MjYxOTIuMDE3ODMyLCJleHAiOjE3MTQwNDg1OTEuOTg3Mzg5LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.siYxQAyrC2-_elXN3UJ-Ex-b7ME-e0RrWDLYyDohahzPTcQ0PZHe27X2GErCpV1rrsPSzw1ZSRQiMtYPlTI5hkspaM6c9DGwbEyjXT3_pgiXnsKz8Od_RLXU2Uc922kfVuvZN2R9-A7I6JDeyZXRR7jl7aJgCSYdndxbqQG8ic7kNvm1Ww7PsGIyaYeAcMmwJiict7S8WkLrIyj5tStlp73xB0TEbsh8q5-f0UioW6z9g7i37DzzKg-DNZNfKLvYUkRRsAHNsaRE3oHFA8uhJCQ5CJyx80L1OMj_tU1RXQ9wkVDsH7y3kYsUmrcVdmjspPnAVXzfy2ZBj-lfH2qa6worrADSSNS5o49ysctrLc1_GHqFZULtYCeWDeUo6r4Um__aPqsnSkoaDxuL0Me23rXJaYXIPMPLzOWRpa0EBpRhZLFV9w9td5tfxdn-e1HJU7bN5TyT5__wtZ-j02o4UriOnArD2TVa3O30OnsSjI5X4x5fskWOzPmDsQ4aurrcpsWYH6tTcM6YaCu0j4VpIEF1gj7XYlXfrLSfV1Lp3Q_z9m7Q4azM9_bu1Nvve_lDBvKOcfTfdYYbUIDJVIc4PCK32-XSZJ-hlQWJp1zbCnictp3_vkJO9WLE44oYy6TaO-F9asjpjrbZiPPs02XdrGMj2jL1jd_NqifZ94oTXEc', NULL, 'Jayeshbhai', NULL, 1, 0, '2023-02-01 23:55:17', '2023-04-25 16:37:00'),
(3, 'demo', NULL, 'demo@gmail.com', '9865325741', 'user_profile1675143338.png', NULL, 0, 0, 0, '$2y$10$kYGIgg1nU10vt46Flv1N.eLfJnu7pYggpv7yZiGwQLmj34qmjisSS', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOWJjYmQzNTU1ZWEwYTRiOGVjZmI5ZGRiMGI0ZWI1ODgwNmNhNmM1YzM3YzI4N2FlYjlmYWM5MjhkMjYzODU0Njk3YzQyZmY1ZTQwZDI5YjMiLCJpYXQiOjE2NzUzMzExMDMuNjQ2OTIzLCJuYmYiOjE2NzUzMzExMDMuNjQ2OTI5LCJleHAiOjE3MDY4NjcxMDMuNjQ0MDQ5LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.vBkzNeM-1S2TvgLjHuTLI-TpUtWv-CR1V2fgLBxOa0pJw6h4YRRxhIQr2o9fraEoYgw3-Yclg6kEnHTefdcQmga0TPhbP6onNWUZ3AZSMzSAfnaRuES4XWH4xB9deAmNUAzFWw2pdMpd8m03sqKZ5m_fDIrkr0YfpIqcla3mv2L5awaLtQkCRXOsnCP2RXtNdHiXqivXEkuLa-uOBSbYzEfCCkW65NWBja0Xi_ygtY8btJOujCQBXMi7SvxNQV-8t2S78cCAHbDA-GDdVOauBoJCKIEQoFdcYmtXknA6CJARK3_E_NPA2kBSc4qL9_88FfDisVmxWduyon3Rt0lDyKvox1msUfF8dLX65oLa-7sncSgLYf-fHZBhFTzJVL3NtYvhIod1kxWb-DgrzqfykdDIfJ9KyQb9NSXb1TgIl2LS0q1D9Eun0fTHOj75eiCFgut37EDtBp0QJZUFRQjFQRcpc7g75YEj1aD9hon9tLEZp07nXcc7IHTv3VrIp8CY9OdC9kOwEDlY9kSpupYDWEeeGGdLx18-YQYAcFnv1n8KcXIIKc8nBjPGUuQI9mIBF5VEKW7ECxWyJR2e0kNgCqwChNVgwaExO3G_6I02l-zk3uO_pJEXCyP8HQZZWfvMaahyOHUeV2uwLUt4U0dGYhtzjkv1EsIYgSHz9bgwj9M', NULL, NULL, NULL, 0, 0, '2023-02-01 23:55:51', '2023-02-02 04:15:03'),
(4, 'michaelphil029@gmail.com', NULL, 'michaelphil029@gmail.com', '1234567890', NULL, NULL, 0, 0, 0, '$2y$10$lK3tzagKQofDfvigGtireeLPZXbuOOqpK1V1nwgZkOhyNeDnM1Spe', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiODljMzNkYmU4ZjE3ODg5YzBiMGM1ZGUxYzBmZmQwN2M1MWRjODk4MzI1ODAzNTg4MDM2ZjE3YTNkYmEyMjNjYzIyMGZlM2E4YWJjNDA4OTEiLCJpYXQiOjE2Nzk5Mjc1NDMuNTI3MTc2LCJuYmYiOjE2Nzk5Mjc1NDMuNTI3MTgxLCJleHAiOjE3MTE1NDk5NDMuNTExMjE3LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.pxaP7t5tMjbGFmoU23Ltr3lSIuyFuNw213iYVohW-sckKbVABH6tpqrf0TUp2PEDyad3nb4ETER6XLPZrh2X3zbMT2HQX_UMKwMC0jc7k24Q_x_k86pLWPCb3mi21TYnHJIkoyf8GzMr2j9UfSTcbtn6-dpOz-0VZC3iSiYbM4iMKW3foEHXcfa_7esU65sFP1ltjMOVfbTv1Mvf-8TqLqcUzQd-HJ3RM0ISEiEwZ2zzpDrAlapjHYOTY2TyMbt3ON_KGzcyihhbyUmRypxXj72K7xJSYQM6K45Iwrqqp2x8r7HmO-ZacS9wZKWYBwFjIkBc7qMOeNbfT4O94kjOsZbugtPaZ8dv02ySZFpfoG9HRFlAmHQY9iCfleIsPNGAnYeufOT52qK037sJWCJy7p3aHkA_l4Wwaye4ZSwI4a4lIOUuzSlxMDGrh2J-baYkAHYiseslUb_jFJDWw6Y0izZADJPHOMcuacNBYwbM5BsVcRsgmH_tjDEAbnaleFBB083hMRmRUKTfujHezd-11ywAjtf3fAme89nFQ9SjfrxgOIwkRde1-rxTjBzv5OdnRkYqXTZk_yy4lZmgfRTw-wpHCfRahwd1LUXkXMUlElWck0igfGbppo5I4-p6UtLC_Bft4fbPiGj5-xHRbAbZakVmglYl-NnX179YDZVWe_s', NULL, NULL, NULL, 0, 0, NULL, '2023-03-27 18:32:23'),
(16, 'demo', 'prajapati', 'ketan.prajapati7046@gmail.com', '9874563215', 'user_profile1683106907.jpg', NULL, 0, 0, 1, '$2y$10$Gpdk5JVqF3rypj.yTOmMKe/v6AewI2pKen81u7cCFVQlJRBl3iilC', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYjA5YzAwMTRiNzY5MjkwNTNlYzc0NTBlZjgxOTU0N2Y0OTE1MTViZDhiMzU1ZGRiNDBhYWYwMDg1MjljNjhlMmZmNWZlMjkwNGVmZWQ5ZjAiLCJpYXQiOjE2ODMxMDc1NzUuNTU1MjA5LCJuYmYiOjE2ODMxMDc1NzUuNTU1MjEzLCJleHAiOjE3MTQ3Mjk5NzUuNTUxNzk3LCJzdWIiOiIxNiIsInNjb3BlcyI6W119.EdTD_7ZKBR1hccVaFxgZGNP8oI-v8cONmo1pXeCxNRU0AHaW8PndogNRrC4qQtJXE03fFOxPDoG95YHSub3nrrCdyyzjVXp9Ykq6XKmk8ait5oHaoh64MIQWRiSRHzGj0MZPrDQP4W_JRfto9nv91u3KtOoWqBmaWa3UXqXZUw6lfh-HiFI3Q-VHUkjpdQ04opgzojBtyy6haY8k8Wy6Os0LU50r7fn3uf-I2mprrVOyFp8ej_GzKQt7cHI3uC2jpPL2uAVT0UAdE4uOaI9vH_sty-FqyG81zdpKBe74rsTnIy2S-kwjGhv2UEb6-HJUx2fYaXWfi6A-tSIKv7Me_gJgdgsuu5breU2xhmog1QrfZlC-um7rKiPWG4IHVivDKOXjPVe6QIIeUWTwBRne_uBQiCtLCc8V9JRTsEnZ-1AJnSJGyZsle2n8axt9zW35ZQS5haub4Mhr6apLTMFx8wCSzw4Zu0h3xbCxJDwCE5PbGlAcQNgNePoR02dVLPKXuo-VERyBUBOst0VcRrokUrVL35QFaLLd1WNHh3h52TpemB6Iw3gtVYMrVo7TVIEOIsRlbtAfqaYa7CZeG5X2CCQV47NQhOyWGS3qUHw9X4vAULE16VynYEF7OYzSD8QOZCrJvngWV3pLg3BiO03KVzFe72H3n6lBT_V7ZjvIfpw', NULL, 'Ketanbhai', 15, 0, 0, '2023-05-03 13:41:47', '2023-05-12 13:58:24'),
(6, 'Suraj Ahir', NULL, 'srjahir32@gmail.com', '9904643000', NULL, NULL, 0, 0, 0, '$2y$10$B7Xj6KhKI6RJ/1gmMlodFubg3a9lVuwtQB9R2MNYQxOvT4JPwS40O', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzhkZjMwOWQ5NjMxNzY2MWNiMmE2ZTU2MWUxZjBjODQyMWMyNzllZmUxYjM2NGEwMWRmN2M5MjA0YmQxNmExODg5NTc2NzM1NDYzMGUxYmYiLCJpYXQiOjE2Nzk1NjU5NzUuOTE0MTE2LCJuYmYiOjE2Nzk1NjU5NzUuOTE0MTIsImV4cCI6MTcxMTE4ODM3NS45MTE1NzksInN1YiI6IjYiLCJzY29wZXMiOltdfQ.rR2li5-s9ec3mhI0A5nuXPmNSOBpnkdw9k3VUzKDB0a4aNnv4BeGnRqJKHfR8DwL28lfB7Ea-0E1jGZ4DyQjjfsff4eaUdVx-ksFmufwIptCUJpbmvUp8yiwJUgs31WmUl83VmD75L0EkUk3kker8lTcuL9OqMEH8APn4BgJsm6yoFh3EMxgtyyn9OHrTpS9kx99iLRvfmUa5BztZGf7W_PXFmcD6hfrr6fUQGNUMu8Ye4ysmGZv13GOOcJ79Vg3wmqGduPQQXmv4EyBCGV20pf4vk40xsmOTdooP9-4sBuV7u0khh_eBrlvQlurWLIfdkgWBQfOp_z6J-Eu2CBwLCH9lLtzEDRNiAwE4TwBeTzuYsq5TvQ5Ak5JMe2gv5ZVvJuUHJJAQR5FLdlwMJO_EhM8uVqslu0497qGOL1tOEeXaE0OWD7_YRbhbhghhMex7LU1YqR6o5udbJJr2tI6FqwjRxqbgeUY7Ns5Ufbo5dq5DDf5x7yv0ZUEHUjTuAmFN4FM9husXMghVxcXq2XwrVcmiU8eYS5hJI14rIpmgB9lM9Caj0W7ysw5LIu5h1AXlp20Jx6AySiiJ7lEwMhAobe6bNy6JCWuL3LsYC4lAWMMn26b8bvfryv5PGLNXzo1e7VrjtfIv5uMLuTXTrCIWtTWfHzks4UvFqnQkjYjjHY', 'LOMXAXEv', NULL, NULL, 0, 0, NULL, '2023-03-23 14:06:15'),
(11, 'Suraj Ahir', NULL, 'srjahir948@gmail.com', '9924532132', NULL, NULL, 0, 0, 0, '$2y$10$g3FKdstafJJl5e8eSav4BOKIdLf.sJysk54y2rWCGBkMGv0g6X5qC', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDM2ZmJiOTQ4MTMxN2JkODE3YTQwMWQ1MDU0MDMxNzYxZGNjMjY5MmMzNWQxM2ZlNzI5NDAzODAyMGFmOThmYzc5NzJmOTQ5MGNmMWVlZDMiLCJpYXQiOjE2NzgxODQyOTguMzY4MjM2LCJuYmYiOjE2NzgxODQyOTguMzY4MjQxLCJleHAiOjE3MDk4MDY2OTguMzY2MzI2LCJzdWIiOiIxMSIsInNjb3BlcyI6W119.kjTCCh8UoKcixpgEwvxQCW2Dbod6wDfP2gdSzs_rJHgUshLLbHoebDdR10iZ7xZLXeveRxLKrtPlEIFWvm90g3G3c1G5I3PVBfkZsZ-9JKBc63TeDOuxD7tJXYTiuqUOY6QEP_agDX4l8V_d66k7vkF6tTCaghix6U_1LTE-wsn56dED0or7lkkXGUS4xQS0Fyf7emjsz0i-Ele1tkHP2rjsUqwm5-H8dWrFxUx0X9mxhAckJ1KSk06-I7lXOKEPK3z7KxwGYbaObHqa_mZMSIZehE76XL9OcwqguRmSsnFYdAuvrKQx3OSk6g-nOSXlWW6iONeKjVssoGmjqMw-FMro7UjGVGP7ov91P8bXZsL1IP_BkHAWp0VqgAftxyk_Qks0ueMlfXdTMU2P3vb4s5mlcYpWXpeIi2S-8asWYed_vezTtMGUyflRF-i4uKfpYYhFptpsFmFsITnI87PxewjQSiueVhEfc304YV_1-924HGVJatg0tDAZcKnvPCNEZf0ENXh4GyHi-EB3Jf5jsvi20rfCA1fmJi14aUIkFVBFNIXEzYWo3AXUQ0S0sIB4PjlmBOu-S9JkaExeVWvVW2rLxUabKi2SNeA-aB_qHVpcKnL6wr9LubNRro-FNtnPPHHpfk-t9c5Yym4_s_NnlDErBdId5Ad7p2J6Hb_873Q', NULL, NULL, NULL, 0, 0, NULL, '2023-03-07 15:18:18'),
(14, 'ketan himmatbhai', 'prajapati', 'ketan.prajapati1901@gmail.com', '9874563241', 'user_profile1679481932.jpg', NULL, 1, 2, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2023-05-03 13:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `use_coupons`
--

CREATE TABLE `use_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `use_coupons`
--

INSERT INTO `use_coupons` (`id`, `user_id`, `event_id`, `coupon_id`, `created_at`, `updated_at`) VALUES
(1, 1, 16, 1, '2023-03-23 05:00:04', '2023-03-23 05:00:04'),
(2, 6, 16, 1, '2023-03-23 09:56:19', '2023-03-23 09:56:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `bne_settings`
--
ALTER TABLE `bne_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_histories`
--
ALTER TABLE `booking_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_sessions`
--
ALTER TABLE `cart_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_likes`
--
ALTER TABLE `event_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_tickets`
--
ALTER TABLE `event_tickets`
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
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`user_email`);

--
-- Indexes for table `use_coupons`
--
ALTER TABLE `use_coupons`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bne_settings`
--
ALTER TABLE `bne_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_histories`
--
ALTER TABLE `booking_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `cart_sessions`
--
ALTER TABLE `cart_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `event_likes`
--
ALTER TABLE `event_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `event_tickets`
--
ALTER TABLE `event_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `use_coupons`
--
ALTER TABLE `use_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
