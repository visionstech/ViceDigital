-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2016 at 06:13 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `status`, `publisher_id`, `slotname`, `container`, `positioning`, `mobile_sizes`, `tablet_sizes`, `desktop_sizes`, `lazyload`, `page_type`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(9, 'Paused', 31, 'slotss', 'slot container', 'After', 'default', '250', 'default', 1, 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}', 2, '127.0.0.1', '2016-12-05 06:45:18', '2016-12-05 01:15:18'),
(10, 'Live', 32, 'PositionS', 'ContainerS', 'After', '4343', 'default', '234234', 1, 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}', NULL, NULL, '2016-12-05 09:23:57', '2016-12-05 03:53:44'),
(11, 'Suspended', 33, 'adminslot', 'adminContainer', 'Prepend', '899', 'default', 'default', 1, 'a:2:{i:0;s:1:"2";i:1;s:1:"3";}', 3, '127.0.0.1', '2016-12-05 06:07:28', '2016-12-05 00:37:28'),
(12, 'Live', 36, 'developerSlot', 'developer container', 'Prepend', 'default', '', 'default', 1, 'a:1:{i:0;s:1:"2";}', NULL, NULL, NULL, NULL),
(13, 'Deleted', 46, 'newslot', 'newcontainer', 'Append', '456', 'default', 'default', 1, 'a:2:{i:0;s:1:"2";i:1;s:1:"3";}', NULL, NULL, '2016-12-07 06:23:43', '2016-12-07 00:53:43'),
(14, 'Live', 33, 'SecondSlot', 'SecContainer', 'Prepend', 'default', 'default', 'default', 1, 'a:1:{i:0;s:1:"2";}', NULL, NULL, NULL, NULL),
(15, 'Live', 57, 'retestSlot', 'retestContainer', 'Prepend', 'default', '220', 'default', 1, 'a:1:{i:0;s:1:"2";}', NULL, NULL, NULL, NULL),
(16, 'Live', 57, 'retestSlots', 'developer containers', 'Append', 'default', 'default', 'default', 1, 'a:1:{i:0;s:1:"2";}', NULL, NULL, NULL, NULL),
(17, 'Live', 58, 'newtable', 'newtable', 'Append', 'default', '220', 'default', 1, 'a:2:{i:0;s:1:"2";i:1;s:1:"3";}', NULL, NULL, NULL, NULL),
(18, 'Live', 58, 'developer Slots', 'developer containers', 'After', 'default', 'default', 'default', 0, 'a:1:{i:0;s:1:"1";}', NULL, NULL, NULL, NULL),
(19, 'Live', 58, 'developer Slots', 'developer containers', 'After', 'default', 'default', 'default', 0, 'a:1:{i:0;s:1:"1";}', 3, '127.0.0.1', '2016-12-09 12:10:44', '2016-12-09 06:40:44');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `adsposition_targetings`
--

INSERT INTO `adsposition_targetings` (`id`, `publisher_id`, `ads_id`, `key`, `value`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(70, 58, 19, 'ss', 'ss', 3, '127.0.0.1', NULL, '2016-12-09 06:40:44'),
(73, 58, 19, 'e', 'e', 3, '127.0.0.1', NULL, '2016-12-09 06:40:44');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=60 ;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `user_id`, `website`, `status`, `email`, `name`, `adunit_id`, `comscore_id`, `krux_id`, `overlays`, `infusion`, `dynamic_ads`, `programmatic`, `custom_scripting`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(38, 3, 'geetika', 'Live', 'geetika@test.com', 'geetikas', '3', '4', '3', 0, 0, 0, 0, NULL, 3, '127.0.0.1', NULL, '2016-12-06 23:40:01'),
(53, 3, 'gfgfgfgf', 'Live', 'fgfgfg@fg.oo', 'fgfgfgfg', 'd', 'e', 'e', 0, 1, 0, 1, NULL, 0, NULL, NULL, NULL),
(52, 3, 'sssssss', 'Live', 'rajeevddd@test.com', 'sdfsdfss', '3', '5', '4', 0, 1, 1, 0, NULL, 0, NULL, NULL, NULL),
(49, 3, 'dsfsdf', 'Live', 'sdfsd@sdf.oo', 'sdfsdf', NULL, NULL, NULL, 1, 0, 0, 0, NULL, 0, NULL, '2016-12-07 06:17:23', '2016-12-07 06:17:23'),
(33, 3, 'geetikas', 'Live', 'admin@test.com', 'Admin', '25', '88', '6', 0, 0, 1, 0, 'Admin Scripting 2\r\n\r\n\r\n', 3, '127.0.0.1', NULL, '2016-12-06 05:29:23'),
(51, 21, 'sdfsd', 'Live', 'sdfdfsd@sdfsdf.pp', 'fsdfsd', NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, '2016-12-08 01:26:45', '2016-12-08 01:26:45'),
(50, 3, 'sdfsdf', 'Live', 'sdfsdff@dfgdfg.oo', 'sdfsdfsd', NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, '2016-12-08 00:51:16', '2016-12-08 00:51:16'),
(31, 2, 'rajeevDomain', 'Live', 'rajeev@test.com', 'rajeev', '24', '46', '43', 1, 1, 1, 0, 'This is custom code\r\nYou can write custom code here\r\n', 2, '127.0.0.1', NULL, '2016-12-05 01:15:29'),
(46, 13, 'ChildDomainNew', 'Live', 'new@gmail.com', 'childcontentnew', '3', '5', '4', 1, 0, 1, 0, 'This is new custom scripting\r\n', 13, '127.0.0.1', NULL, '2016-12-09 03:34:11'),
(45, 3, 'AdminChildDomain', 'Live', 'child@gmail.com', 'child', NULL, NULL, NULL, 1, 0, 0, 0, NULL, 3, '127.0.0.1', '2016-12-06 04:14:46', '2016-12-09 03:34:11'),
(54, 2, 'ssssssssssss', 'Live', 'sssss@dfg.oo', 'sssssssss', NULL, NULL, NULL, 1, 0, 1, 0, NULL, 0, NULL, NULL, NULL),
(55, 2, 'ssssssssssss', 'Live', 'sssss@dfg.oo', 'sssssssss', NULL, NULL, NULL, 1, 0, 1, 0, NULL, 0, NULL, NULL, NULL),
(56, 2, 'sfdfsfs', 'Live', 'dfsdfs@dfg.oop', 'dfsdf', NULL, NULL, NULL, 1, 0, 0, 0, NULL, 0, NULL, NULL, NULL),
(57, 3, 'This is retest unit', 'Live', 'retest@gmail.com', 'retest', '85', '77', '99', 1, 0, 0, 1, NULL, 0, NULL, NULL, NULL),
(58, 3, 'NewPublishernewtable', 'Live', 'newtable@gmail.com', 'newtable', '8', '77', '9', 1, 0, 1, 1, NULL, 0, NULL, NULL, NULL),
(59, 3, 'ssaaaaaaaaa', 'Live', 'aswsssssss@nhy.oo', 'ssssssaaaaaa', '2', '4', '3', 1, 0, 0, 0, NULL, 0, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `publisher_pagetypes`
--

INSERT INTO `publisher_pagetypes` (`id`, `publisher_id`, `title`, `selector`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(28, 31, 'testp', 'Homepage', 2, '127.0.0.1', NULL, '2016-12-05 01:15:30'),
(29, 31, 'testpe', 'Home15', 2, '127.0.0.1', NULL, '2016-12-05 01:15:30'),
(30, 31, 'Page12', 'Homepage1', 2, '127.0.0.1', NULL, '2016-12-05 01:15:30'),
(31, 32, 'Title34', 'Page6', 0, NULL, NULL, '2016-12-02 06:14:46'),
(32, 33, 'testp', 'Homepage', 3, '127.0.0.1', NULL, '2016-12-05 00:22:21'),
(33, 33, 'Title', 'Page', 3, '127.0.0.1', NULL, '2016-12-05 00:22:21'),
(40, 38, 'we', 'we', 3, '127.0.0.1', NULL, '2016-12-05 06:54:20'),
(41, 46, 'Title5', 'Homepage', 0, NULL, NULL, NULL),
(42, 52, 'r', 'r', 0, NULL, NULL, NULL),
(43, 53, 'c', 'v', 0, NULL, NULL, NULL),
(44, 57, '77', '88', 0, NULL, NULL, NULL),
(45, 57, '99', '66', 0, NULL, NULL, NULL),
(46, 58, '58', '88', 0, NULL, NULL, NULL),
(47, 59, '7', '8', 0, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `publisher_targetings`
--

INSERT INTO `publisher_targetings` (`id`, `publisher_id`, `key`, `value`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(37, 31, '45', '34', 2, '127.0.0.1', NULL, '2016-12-05 01:15:29'),
(38, 31, '346', '346', 2, '127.0.0.1', NULL, '2016-12-05 01:15:30'),
(39, 31, '345', '455', 2, '127.0.0.1', NULL, '2016-12-05 01:15:30'),
(43, 32, 'Target1', 'Value1', 0, NULL, NULL, '2016-12-02 06:14:46'),
(46, 32, 'target2', 'Value2', 0, NULL, NULL, '2016-12-02 06:14:46'),
(47, 33, 're', 're', 3, '127.0.0.1', NULL, '2016-12-05 00:22:21'),
(48, 33, '4', '5', 3, '127.0.0.1', NULL, '2016-12-05 00:22:21'),
(49, 33, '5', '6', 3, '127.0.0.1', NULL, '2016-12-05 00:22:21'),
(54, 36, '3', '34', 0, NULL, NULL, NULL),
(56, 38, 'dfe', 'ewe', 3, '127.0.0.1', NULL, '2016-12-05 06:54:20'),
(57, 38, 'wwe', 'wwe', 3, '127.0.0.1', NULL, '2016-12-05 06:54:20'),
(58, 46, '5', '65', 0, NULL, NULL, NULL),
(59, 46, '55', '655', 0, NULL, NULL, NULL),
(60, 52, 'd', 'd', 0, NULL, NULL, NULL),
(61, 52, 'f', 'f', 0, NULL, NULL, NULL),
(62, 53, 'd', 'd', 0, NULL, NULL, NULL),
(63, 53, 'c', 'c', 0, NULL, NULL, NULL),
(64, 57, '89', '96', 0, NULL, NULL, NULL),
(65, 57, '88', '55', 0, NULL, NULL, NULL),
(66, 57, 'ss', 'ss', 0, NULL, NULL, NULL),
(67, 57, 'dd', 'ddd', 0, NULL, NULL, NULL),
(68, 57, 'ff', 'fff', 0, NULL, NULL, NULL),
(69, 58, '8', '9', 0, NULL, NULL, NULL),
(70, 58, '7', '77', 0, NULL, NULL, NULL),
(71, 59, '5', '6', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`) VALUES
(1, 'Admin', '2016-12-05 05:07:12'),
(2, 'User', '2016-12-05 05:07:12'),
(3, 'Manager', '2016-12-06 06:12:19');

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
(1, 'geetikas', 'geetika@test.com', '$2y$10$4LH4pUICXqr8kd3drNsIZOd0kzOYouzExeas9rMmNA59QIyc37MDq', 2, 'Live', 'nTYx16JyWQY6Wth1N7EbqKXCkaLwMhgfn1EdnEuPPs8T8b8PmzKbKPpgLxAu', 3, '127.0.0.1', '2016-11-29 04:02:42', '2016-12-06 23:39:15'),
(2, 'Rajeev', 'rajeev@test.com', '$2y$10$XDFtZWWu5TDQWjrd5qgfsul01g7xygeVolTnuUYfPaNq6yUsoN.PW', 2, 'Live', 'YrkNSEN3Wq2wvWDRr5KYAoxMMD3HrzJDeXrgjN1sINIf5y29m7fvgTygjYlm', 0, NULL, '2016-11-29 08:21:29', '2016-12-12 01:01:43'),
(3, 'Admin', 'admin@test.com', '$2y$10$XDFtZWWu5TDQWjrd5qgfsul01g7xygeVolTnuUYfPaNq6yUsoN.PW', 1, 'Live', 'LZkBZqlvGCStOV9VhpQa4mIdvdhPBAvZCr9ZYUsPlYAYFeDS2rm76MIVAM2t', 3, '127.0.0.1', '2016-11-29 08:21:29', '2016-12-12 02:14:10'),
(13, 'child', 'child@gmail.com', '$2y$10$XDFtZWWu5TDQWjrd5qgfsul01g7xygeVolTnuUYfPaNq6yUsoN.PW', 3, 'Live', 'kH0if125330yKcoUqj31EkbBUComAC375VBWZEDBZmBRtJCgjhTtcw0gPr9k', 3, '127.0.0.1', '2016-12-06 04:14:46', '2016-12-11 23:46:50'),
(19, 'sdfsdf', 'sdfsdf@dfgg.oo', '$2y$10$bnTc.yWVFHvb9E23GG/H5O2qOXEVW56EaRvE1AKLrxO6P5c.kXMoy', 2, 'Live', NULL, 0, NULL, '2016-12-08 00:49:59', '2016-12-08 00:49:59'),
(18, 'sdfsdff', 'sdfsdf@dfg.oo', '$2y$10$1zsWcCTDBVLGvMFWkAEMKueZg0CITHR8Enr/Zyi2pYQmgtm2F7GBG', 1, 'Live', NULL, 0, NULL, '2016-12-07 06:19:36', '2016-12-07 06:19:36'),
(17, 'sdfsdf', 'sdfsd@sdf.oo', '$2y$10$ql5KIUeEtvZtaqGZMOYvXu8f8zbfQA8yLPk49qiN8yqEeQ4CN9WSa', 3, 'Live', NULL, 0, NULL, '2016-12-07 06:17:23', '2016-12-07 06:17:23'),
(20, 'sdfsdfsd', 'sdfsdff@dfgdfg.oo', '$2y$10$p5NhGF3x1P1xKdkWO88vpu1HfCg3JIgr7kNMi8YY80wxZKARW/OkK', 2, 'Live', NULL, 0, NULL, '2016-12-08 00:51:16', '2016-12-08 00:51:16'),
(21, 'fsdfsd', 'sdfdfsd@sdfsdf.pp', '$2y$10$st8Twe6Cpo14wnp.fa9gI.TuxzMaxxNMtNUt8Ge668A/OyOIFeTq6', 2, 'Live', 'NKCHPuEt39KjUiyuuZwyBO2C5X9V83TWp2MMsLkTcfecmZfawbPAbaFkEb6I', 0, NULL, '2016-12-08 01:26:45', '2016-12-08 01:26:50');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
