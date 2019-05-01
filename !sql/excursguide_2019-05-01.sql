# ************************************************************
# Sequel Pro SQL dump
# Version 5438
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 8.0.15)
# Database: excursguide
# Generation Time: 2019-05-01 10:14:08 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table articles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `avatar` json DEFAULT NULL,
  `country_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `active` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;

INSERT INTO `articles` (`id`, `title`, `text`, `avatar`, `country_id`, `city_id`, `category_id`, `active`, `properties`, `created_at`, `updated_at`)
VALUES
	(1,'test','<p>123</p>',NULL,'RW',202061,NULL,NULL,NULL,'2019-04-30 14:24:44','2019-04-30 14:24:51');

/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `title`, `active`, `properties`, `created_at`, `updated_at`)
VALUES
	(1,'Групповые экскурсии/тур',1,NULL,NULL,'2019-04-26 12:35:35'),
	(2,'Обзорные экскурсии/туры',1,NULL,NULL,'2019-04-26 12:35:40'),
	(3,'Авторские экскурсии/туры',1,NULL,NULL,'2019-04-26 12:35:44'),
	(4,'Гастрономические экскурсии/туры',1,NULL,NULL,'2019-04-26 12:35:49'),
	(5,'Экскурсии на автомобиле',1,NULL,NULL,'2019-04-26 12:35:53'),
	(6,'Пешеходные экскурсии',1,NULL,NULL,'2019-04-26 12:37:54'),
	(7,'Велотур/ велопоход',1,NULL,NULL,'2019-04-26 12:35:56'),
	(8,'Шопинг /шопинг тур',1,NULL,NULL,'2019-04-26 12:35:59'),
	(9,'Фотосессия',1,NULL,NULL,'2019-04-26 12:36:04'),
	(10,'Экскурсии по крышам',1,NULL,NULL,'2019-04-26 12:36:08'),
	(11,'Детские экскурсии/туры',1,NULL,NULL,'2019-04-26 12:36:12'),
	(12,'Паломничество',1,NULL,NULL,'2019-04-26 12:36:17'),
	(13,'Трансфер',1,NULL,NULL,'2019-04-26 12:36:21'),
	(14,'Круиз',1,NULL,NULL,'2019-04-26 12:36:29'),
	(15,'Квест',1,NULL,NULL,'2019-04-26 12:36:37'),
	(16,'Оздоровительный тур',1,NULL,NULL,'2019-04-26 12:36:40'),
	(17,'Восхождение в горы',1,NULL,NULL,'2019-04-26 12:36:44'),
	(18,'Дайвинг',1,NULL,NULL,'2019-04-26 12:36:48'),
	(19,'Джиппинг',1,NULL,NULL,'2019-04-26 12:37:01'),
	(20,'Йога тур',1,NULL,NULL,'2019-04-26 12:37:43'),
	(21,'Свадебная церемония',1,NULL,NULL,'2019-04-26 12:37:40'),
	(22,'Сноркелинг / снорклинг',1,NULL,NULL,'2019-04-26 12:37:37'),
	(23,'Экстрим',1,NULL,NULL,'2019-04-26 12:37:33'),
	(24,'Ночные экскурсии',1,NULL,NULL,'2019-04-26 12:37:29'),
	(25,'Полеты',1,NULL,NULL,'2019-04-26 12:37:26'),
	(26,'Музеи',1,NULL,NULL,'2019-04-26 12:37:22'),
	(27,'Достопримечательности',1,NULL,NULL,'2019-04-26 12:37:19'),
	(28,'Рыбалка',1,NULL,NULL,'2019-04-26 12:37:15'),
	(29,'Природа',1,NULL,NULL,'2019-04-26 12:37:11'),
	(31,'Морские/речные туры/экскурсии',1,NULL,'2019-04-27 13:10:11','2019-04-27 13:10:20');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `active` int(11) NOT NULL DEFAULT '0',
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;

INSERT INTO `languages` (`id`, `name`, `iso_code`, `active`, `properties`, `created_at`, `updated_at`)
VALUES
	(1,'Русский','ru','1',NULL,'2019-04-25 15:19:10','2019-04-25 15:20:55'),
	(2,'Английский','en','1',NULL,'2019-04-25 15:20:42','2019-04-25 15:20:42'),
	(11,'Немецкий','ger','1',NULL,'2019-04-27 13:14:34','2019-04-27 13:14:38');

/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2019_03_25_123846_create_user_data_table',1),
	(4,'2019_04_01_143348_create_tours_table',1),
	(5,'2019_04_05_050438_create_categories_table',1),
	(12,'2019_04_06_124536_create_services_table',2),
	(13,'2019_04_06_124633_create_service_user_table',2),
	(14,'2019_04_06_184935_create_comments_table',2),
	(16,'2019_04_24_114033_create_languages_table',3),
	(23,'2019_04_26_160945_create_articles_table',4);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table service_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `service_user`;

CREATE TABLE `service_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;

INSERT INTO `services` (`id`, `title`, `active`, `properties`, `created_at`, `updated_at`)
VALUES
	(9,'Туризм',1,NULL,'2019-04-27 13:12:52','2019-04-27 13:12:58');

/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tours
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tours`;

CREATE TABLE `tours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `languages` json DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `people_category` int(11) DEFAULT NULL,
  `people_count` int(11) DEFAULT NULL,
  `timing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `currency` int(11) NOT NULL DEFAULT '643',
  `price_type` int(11) NOT NULL DEFAULT '1',
  `services` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_item` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `photo` json DEFAULT NULL,
  `active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `tours` WRITE;
/*!40000 ALTER TABLE `tours` DISABLE KEYS */;

INSERT INTO `tours` (`id`, `user_id`, `avatar`, `name`, `location`, `route`, `languages`, `category`, `people_category`, `people_count`, `timing`, `price`, `currency`, `price_type`, `services`, `other_rate`, `other_item`, `about`, `photo`, `active`, `status`, `properties`, `created_at`, `updated_at`)
VALUES
	(1,'1','/storage/users/1/tour/1/avatar.jpg','Экскурсия по питербургу','554840','Питер','[\"es\"]',1,2,10,'3',1000,643,1,'Фомин','Фомин','Фомин','ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы ывсвысывсвы','[{\"crop\": \"/storage/users/1/tour/1/2419ea439e91a6613e9983a68ad92f33_crop.jpg\", \"path\": \"/storage/users/1/tour/1/2419ea439e91a6613e9983a68ad92f33.jpg\", \"filename\": \"2419ea439e91a6613e9983a68ad92f33.jpg\", \"filename_crop\": \"2419ea439e91a6613e9983a68ad92f33_crop.jpg\"}, {\"crop\": \"/storage/users/1/tour/1/ead3516650337d3328634cb101db353a_crop.jpg\", \"path\": \"/storage/users/1/tour/1/ead3516650337d3328634cb101db353a.jpg\", \"filename\": \"ead3516650337d3328634cb101db353a.jpg\", \"filename_crop\": \"ead3516650337d3328634cb101db353a_crop.jpg\"}]','2','0',NULL,'2019-04-06 12:35:04','2019-04-14 14:41:43'),
	(2,'1','/storage/users/1/tour/2/avatar.jpg','Прогулки по Петергофу. Часть II.','554840','Петергоф','[\"ru\"]',2,2,10,'2',1000,643,1,'Руслан Сафин','Вход','Воду','Петергоф — символ России. И не «один из», а узнаваемый во всем мире, мечта любого иностранного туриста, сбывшаяся или все еще лелеемая. Пресловутые «балалайка, водка, медведь» давно уступили место Петергофу, настоящей жемчужине, самому красивому дворцовому ансамблю в мире. И не надо каждый раз вспоминать Версаль, беря его за образец для подражания — Петр Первый сумел заткнуть за пояс заносчивых французов, оставив после себя совершенное творение, достойное могущественной страны, которой к тому времени стала Россия.','[{\"crop\": \"/storage/users/1/tour/2/e2da9502c6b3fbf3a1145f12a808a590_crop.jpg\", \"path\": \"/storage/users/1/tour/2/e2da9502c6b3fbf3a1145f12a808a590.jpg\", \"filename\": \"e2da9502c6b3fbf3a1145f12a808a590.jpg\", \"filename_crop\": \"e2da9502c6b3fbf3a1145f12a808a590_crop.jpg\"}, {\"crop\": \"/storage/users/1/tour/2/0142e2ba63c3fcb47cc0fb9562b59cdc_crop.jpg\", \"path\": \"/storage/users/1/tour/2/0142e2ba63c3fcb47cc0fb9562b59cdc.jpg\", \"filename\": \"0142e2ba63c3fcb47cc0fb9562b59cdc.jpg\", \"filename_crop\": \"0142e2ba63c3fcb47cc0fb9562b59cdc_crop.jpg\"}, {\"crop\": \"/storage/users/1/tour/2/5ac6b5ba9cbcefb14b6f15a40b0c83b1_crop.jpg\", \"path\": \"/storage/users/1/tour/2/5ac6b5ba9cbcefb14b6f15a40b0c83b1.jpg\", \"filename\": \"5ac6b5ba9cbcefb14b6f15a40b0c83b1.jpg\", \"filename_crop\": \"5ac6b5ba9cbcefb14b6f15a40b0c83b1_crop.jpg\"}, {\"crop\": \"/storage/users/1/tour/2/0347da436d36b4d44ccba5b3931052bf_crop.jpg\", \"path\": \"/storage/users/1/tour/2/0347da436d36b4d44ccba5b3931052bf.jpg\", \"filename\": \"0347da436d36b4d44ccba5b3931052bf.jpg\", \"filename_crop\": \"0347da436d36b4d44ccba5b3931052bf_crop.jpg\"}]','2','0',NULL,'2019-04-06 14:29:19','2019-04-14 14:35:55'),
	(4,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,643,1,NULL,NULL,NULL,NULL,NULL,'0','0',NULL,'2019-04-19 09:51:42','2019-04-19 09:51:42');

/*!40000 ALTER TABLE `tours` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_data`;

CREATE TABLE `user_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `languages` json DEFAULT NULL,
  `locations` json DEFAULT NULL,
  `contacts` json DEFAULT NULL,
  `services` json DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `user_files` json DEFAULT NULL,
  `active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_data` WRITE;
/*!40000 ALTER TABLE `user_data` DISABLE KEYS */;

INSERT INTO `user_data` (`id`, `user_id`, `avatar`, `languages`, `locations`, `contacts`, `services`, `about`, `user_files`, `active`, `status`, `properties`, `created_at`, `updated_at`)
VALUES
	(1,'1','/storage/users/1/avatar.jpg','[\"en\"]','[554840, 3169070]','[{\"value\": \"+7 (495) 999 99 99\", \"type_id\": 2}]','[1, 2]','Приветствую! Меня зовут Сергей и я, не побоюсь этих слов, влюблен в Италию, влюблен в Рим. Более 15 лет прошло с того момента, как я приехал в Рим, а монументальные площади, удивительной красоты соборы и фантастические строения не перестают меня удивлять. Вечный город представляет огромный интерес абсолютно для каждого вне зависимости от возраста, рода деятельности и увлечений. Находясь здесь, я проживаю каждую минуту и каждую секунду так, как чувствую, и постараюсь поделиться этим ощущенеим с вами, сделаю вашу встречу с Римом теплой и комфортной, помогу с заселением в отель, с выбором гида, интересных экскурссий и оптимальных маршрутов по Италии.','[]','1','999',NULL,'2019-04-06 12:35:01','2019-04-18 08:49:21'),
	(2,'2','/storage/users/2/avatar.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'1','0',NULL,'2019-04-06 21:31:22','2019-04-06 21:31:47'),
	(3,'3','/storage/users/3/avatar.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'1','0',NULL,'2019-04-06 21:33:30','2019-04-06 21:33:38'),
	(4,'4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0',NULL,'2019-04-22 09:22:56','2019-04-22 09:22:56'),
	(5,'5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0',NULL,'2019-04-22 09:31:28','2019-04-22 09:31:28'),
	(6,'6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0',NULL,'2019-04-22 09:31:51','2019-04-22 09:31:51'),
	(7,'7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0',NULL,'2019-04-22 11:01:25','2019-04-22 11:01:25');

/*!40000 ALTER TABLE `user_data` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'Ruslan Safin','rusel91@idz.ru',NULL,'$2y$10$hDAHVVxmGpP/ygt9ZDl.9.ZawzF9C0M.jwK5KdDaJH1BFVz6qFjQe','QBCi7mxXkeeentGoWZBCw2Cl79keMpcfpQNCevMC6FYUINWUKsABXe06fVTW','2019-04-06 12:35:01','2019-04-06 21:37:14'),
	(2,'Клен Мебель','test@test.ru',NULL,'$2y$10$hDAHVVxmGpP/ygt9ZDl.9.ZawzF9C0M.jwK5KdDaJH1BFVz6qFjQe',NULL,'2019-04-06 21:31:22','2019-04-06 21:31:22'),
	(3,'test2','test2@mail.ru',NULL,'$2y$10$DmX8kGTNpk5RHu5IMKqAt.Ur9PbyrjjyoCeElhHEgH2vr.O0IaGdC',NULL,'2019-04-06 21:33:30','2019-04-06 21:33:30'),
	(4,'rusel','rusel@rusel.ru',NULL,'$2y$10$rAQ6Ygu/iAPiOcy65as57eQWqp40daOj1xAAcsRlvOLeLDrPRX31.',NULL,'2019-04-22 09:22:56','2019-04-22 09:22:56'),
	(5,'ruslan','ruslan@rusascac.ru',NULL,'$2y$10$d/Jfn9YfN1yHtMauRQrxbutZVGXFiAM5TQkIv7vlUvoaZ5djUDjsO',NULL,'2019-04-22 09:31:28','2019-04-22 09:31:28'),
	(6,'ruslan','ruslan@ruslan',NULL,'$2y$10$BrnvJ3w239zEu0h/G.A3ze8FP1/5PjVTOa5igcfYE8GwfSL80KOAK',NULL,'2019-04-22 09:31:51','2019-04-22 09:31:51'),
	(7,'rusddc','rueek@wded.ru',NULL,'$2y$10$Wf.mtDgpmj9LnbrpbRGnnO8.bxhu4D0qe3.TBXfM4OSCn5Cp1E5p2',NULL,'2019-04-22 11:01:25','2019-04-22 11:01:25');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
