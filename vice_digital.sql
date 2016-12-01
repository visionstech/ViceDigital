-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('Active','Paused','Inactive') DEFAULT NULL,
  `publisher_id` int(11) NOT NULL,
  `slotname` varchar(255) NOT NULL,
  `container` varchar(255) NOT NULL,
  `positioning` varchar(255) NOT NULL,
  `mobile_sizes` varchar(255) NOT NULL,
  `tablet_sizes` varchar(255) NOT NULL,
  `desktop_sizes` varchar(255) NOT NULL,
  `lazyload` int(11) NOT NULL,
  `page_type` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ads` (`id`, `status`, `publisher_id`, `slotname`, `container`, `positioning`, `mobile_sizes`, `tablet_sizes`, `desktop_sizes`, `lazyload`, `page_type`, `date_created`, `created_at`, `updated_at`) VALUES
(4,	'Active',	16,	'Slot',	'COntainer',	'5',	'320*200',	'640*420',	'1200*420',	1,	'a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}',	'2016-11-30',	'2016-11-30 11:55:50',	'0000-00-00 00:00:00'),
(5,	'Inactive',	17,	'yhtruy',	'uyuy',	'9',	'320*200',	'640*420',	'1200*420',	0,	'a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}',	'2016-11-30',	'2016-11-30 12:07:53',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_products_table',	1),
('2014_10_12_000000_create_publishers_table',	1),
('2014_10_12_000000_create_users_table',	1),
('2014_10_12_100000_create_password_resets_table',	1);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `products` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1,	'overlays',	1,	'2016-11-26 22:40:19',	'2016-11-26 22:40:19'),
(2,	'infusion',	1,	'2016-11-26 22:40:19',	'2016-11-26 22:40:19'),
(3,	'dynamic_ads',	1,	'2016-11-26 22:40:19',	'2016-11-26 22:40:19'),
(4,	'programmatic',	1,	'2016-11-26 22:40:19',	'2016-11-26 22:40:19');

DROP TABLE IF EXISTS `publishers`;
CREATE TABLE `publishers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `publishers` (`id`, `user_id`, `website`, `status`, `email`, `name`, `adunit_id`, `comscore_id`, `krux_id`, `overlays`, `infusion`, `dynamic_ads`, `programmatic`, `custom_scripting`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(1,	1,	'geetika',	1,	'geetika@test.com',	'geetika',	NULL,	NULL,	NULL,	1,	1,	0,	1,	NULL,	0,	NULL,	'2016-11-29 04:02:42',	'2016-11-29 04:02:42'),
(17,	2,	'iiyuio',	1,	'testing@test.com',	'uiuyiu',	'r4t',	'tytyt',	'ytry',	0,	0,	1,	1,	'yhuytuy',	0,	NULL,	NULL,	'2016-11-30 06:39:19'),
(16,	2,	'test',	1,	'test@test.com',	'test',	'1234',	'1234',	'1234',	1,	1,	0,	0,	'gsrdgttrdyyt',	0,	NULL,	NULL,	'2016-11-30 06:28:58');

DROP TABLE IF EXISTS `publisher_pagetypes`;
CREATE TABLE `publisher_pagetypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `publisher_pagetypes` (`id`, `publisher_id`, `title`, `selector`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(9,	16,	'1234',	'1234',	0,	'',	NULL,	NULL),
(10,	17,	'yty',	'tyty',	0,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `publisher_targetings`;
CREATE TABLE `publisher_targetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `publisher_targetings` (`id`, `publisher_id`, `key`, `value`, `date_created`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(16,	16,	'1234',	'1234',	'2016-11-30',	0,	'',	NULL,	NULL),
(17,	17,	'ytryt',	'ytyt',	'2016-11-30',	0,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(2) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(1,	'geetika',	'geetika@test.com',	'$2y$10$4LH4pUICXqr8kd3drNsIZOd0kzOYouzExeas9rMmNA59QIyc37MDq',	2,	'nTYx16JyWQY6Wth1N7EbqKXCkaLwMhgfn1EdnEuPPs8T8b8PmzKbKPpgLxAu',	1,	'::1',	'2016-11-29 04:02:42',	'2016-11-29 08:05:21'),
(2,	'Rajeev',	'rajeev@test.com',	'$2y$10$XDFtZWWu5TDQWjrd5qgfsul01g7xygeVolTnuUYfPaNq6yUsoN.PW',	2,	NULL,	0,	NULL,	'2016-11-29 08:21:29',	'2016-11-29 08:21:29');

-- 2016-12-01 04:08:20
