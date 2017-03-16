-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2017 at 04:58 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Partei', 'reception@example.com', '$2y$10$k52gwk/sdYHUXhLgBt00ee2Nx2d/LNbWLeB4wqYcTIshZ4YlX9Gtm', 'T41Rth42IbELqKcxBPKJOVkf0ERooDIqkY3m9jgUUvuw0Y4iUq2GBaTQCBOj', '2016-12-28 08:26:27', '2016-12-29 16:49:17'),
(2, 'Samuel', 'admin@example.com', '$2y$10$wcVFnYs5DqRANtvB.O5yHOU/duewm2BxPG7TVy0Fz5.nol7LuIs3i', '0lGostA0SMZXYXxWZoo06C2pJii9Ag6HRhcbqmaPvQocq776QLbmdVF4g51M', '2016-12-28 08:26:28', '2017-01-03 11:36:18'),
(3, 'Hmangaiha', 'hmangaiha@example.com', '$2y$10$0jIVYWr2Xl4PXCNFddTWseNZ.npY4mHlmSa5EoOFudQPoAMo2aiVO', 'EGjbR1unP07ib2ko8Vn3Qt7N8UFezAPefcF3B1XlGYYFWdpKMeajddNnn5ND', '2016-12-28 08:26:28', '2016-12-28 16:49:52'),
(4, 'Patea', 'patea@example.com', '$2y$10$6vHkjyqnEscZoMKG8xlG1O7uuFfMFQPOEAOPaMBSlDA9R6IDvOnGe', 'XRnKu5d5llDLhnXAgsouot9N9N6DbWIs9YJ03ADr2bKPgXDAkr6iYiI8EGOf', '2016-12-28 09:00:43', '2016-12-29 17:31:13'),
(5, 'Chhungpuia', 'chhungpuia@example.com', '$2y$10$KZcQ7G/Q3wtnupI2ZDI7oOHVsMCo6sShF/IYtFdYCZIpciQD42HJS', NULL, '2016-12-28 09:36:44', '2016-12-28 09:36:44'),
(6, 'Sawmi', 'sawmi@example.com', '$2y$10$N3KAapkO6iTjBQW3w.TsueKO9g614nO90e4os1NnmeXhw6S30TuYi', NULL, '2016-12-28 09:37:58', '2016-12-28 09:37:58'),
(7, 'Muanpuia', 'muanpuia@example.com', '$2y$10$8yZon9pgypxMBnUzxMtbD./9l2w44L5stXFRuwNB1uqpLNWMEfL9.', NULL, '2016-12-28 12:43:14', '2016-12-28 12:43:14'),
(8, 'Zorema', 'zorema@example.com', '$2y$10$wG6eE2cAEDmWhBVSN0Ua.uIu/zunKHijLViKvjliXPFEqibrgo.SK', NULL, '2017-02-08 15:25:45', '2017-02-08 15:25:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
