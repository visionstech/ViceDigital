-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2016 at 05:52 PM
-- Server version: 5.5.35-1ubuntu1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vice_digital`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('Live','Suspended','Paused','Deleted') DEFAULT 'Live',
  `publisher_id` int(11) NOT NULL,
  `slotname` varchar(255) NOT NULL,
  `container` varchar(255) NOT NULL,
  `positioning` varchar(255) NOT NULL,
  `mobile_sizes` varchar(255) NOT NULL,
  `tablet_sizes` varchar(255) NOT NULL,
  `desktop_sizes` varchar(255) NOT NULL,
  `lazyload` int(11) NOT NULL,
  `page_type` varchar(255) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `adsposition_targetings`
--

CREATE TABLE IF NOT EXISTS `adsposition_targetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_id` int(11) NOT NULL,
  `ads_id` int(11) NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_products_table', 1),
('2014_10_12_000000_create_publishers_table', 1),
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positionings`
--

CREATE TABLE IF NOT EXISTS `positionings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `positionings`
--

INSERT INTO `positionings` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Append', '2016-12-01 04:43:28', '2016-12-01 10:12:57'),
(2, 'Prepend', '2016-12-01 04:43:33', '2016-12-01 10:12:57'),
(3, 'After', '2016-12-01 04:43:37', '2016-12-01 10:13:10'),
(4, 'Before', '2016-12-01 04:43:41', '2016-12-01 10:13:10'),
(5, 'Replace', '2016-12-01 04:43:46', '2016-12-01 10:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'overlays', 1, '2016-11-26 22:40:19', '2016-11-26 22:40:19'),
(2, 'infusion', 1, '2016-11-26 22:40:19', '2016-11-26 22:40:19'),
(3, 'dynamic_ads', 1, '2016-11-26 22:40:19', '2016-11-26 22:40:19'),
(4, 'programmatic', 1, '2016-11-26 22:40:19', '2016-11-26 22:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Live','Suspended','Paused','Deleted') COLLATE utf8_unicode_ci DEFAULT 'Live',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adunit_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comscore_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `krux_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `overlays` tinyint(4) NOT NULL,
  `infusion` tinyint(4) NOT NULL,
  `dynamic_ads` tinyint(4) NOT NULL,
  `programmatic` tinyint(4) NOT NULL,
  `custom_scripting` text COLLATE utf8_unicode_ci,
  `updated_by` int(11) NOT NULL,
  `updated_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `publisher_pagetypes`
--

CREATE TABLE IF NOT EXISTS `publisher_pagetypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `selector` varchar(255) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `publisher_targetings`
--

CREATE TABLE IF NOT EXISTS `publisher_targetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_id` int(11) NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2016-12-05 05:07:12', NULL),
(2, 'User', '2016-12-05 05:07:12', NULL),
(3, 'Manager', '2016-12-06 06:12:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(2) NOT NULL,
  `status` enum('Live','Suspended','Paused','Deleted') COLLATE utf8_unicode_ci DEFAULT 'Live',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `remember_token`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(2, 'Rajeev', 'rajeev@test.com', '$2y$10$XDFtZWWu5TDQWjrd5qgfsul01g7xygeVolTnuUYfPaNq6yUsoN.PW', 2, 'Live', 'tdtK57j0v6TKZh6CTeg6pR3C2c6nySsGt48JIUiEc9hUgvILcfqkNxeprRUG', 0, NULL, '2016-11-29 08:21:29', '2016-12-13 06:53:58'),
(3, 'Admin', 'admin@test.com', '$2y$10$XDFtZWWu5TDQWjrd5qgfsul01g7xygeVolTnuUYfPaNq6yUsoN.PW', 1, 'Live', 'LZkBZqlvGCStOV9VhpQa4mIdvdhPBAvZCr9ZYUsPlYAYFeDS2rm76MIVAM2t', 3, '127.0.0.1', '2016-11-29 08:21:29', '2016-12-12 02:14:10'),
(13, 'child', 'child@gmail.com', '$2y$10$XDFtZWWu5TDQWjrd5qgfsul01g7xygeVolTnuUYfPaNq6yUsoN.PW', 3, 'Live', 'kH0if125330yKcoUqj31EkbBUComAC375VBWZEDBZmBRtJCgjhTtcw0gPr9k', 3, '127.0.0.1', '2016-12-06 04:14:46', '2016-12-11 23:46:50');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
