-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for sg
CREATE DATABASE IF NOT EXISTS `sg` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `sg`;

-- Dumping structure for table sg.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `active` smallint(6) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table sg.admins: ~1 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `email`, `password`, `active`, `name`, `level`) VALUES
	(1, 'ivanovkbg@gmail.com', '6dcdc372c748e4dc90e0c8d653e387bc', 1, 'Красимир Петров', 9),
	(4, 'test@test.bg', '25d55ad283aa400af464c76d713c07ad', 1, 'Test Testov', 9);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table sg.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_price` float NOT NULL DEFAULT 0,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table sg.orders: ~13 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `total_price`, `date_created`) VALUES
	(1, 150, '2020-03-18 15:55:04'),
	(2, 100, '2020-03-18 15:55:55'),
	(3, 185, '2020-03-18 16:22:09'),
	(4, 0, '2020-03-18 16:25:41'),
	(5, 185, '2020-03-18 16:26:47'),
	(6, 185, '2020-03-18 16:27:08'),
	(7, 185, '2020-03-18 16:27:29'),
	(8, 185, '2020-03-18 16:27:54'),
	(9, 185, '2020-03-18 16:29:15'),
	(10, 185, '2020-03-18 16:38:16'),
	(11, 380, '2020-03-18 17:50:26'),
	(12, 285, '2020-03-18 18:15:55'),
	(13, 185, '2020-03-18 18:21:01');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table sg.orders_products
CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `promotion_id` int(11) DEFAULT NULL,
  `promotion_products` int(11) NOT NULL DEFAULT 0,
  `promotion_price` int(11) NOT NULL DEFAULT 0,
  `products_with_promotion` int(11) NOT NULL DEFAULT 0,
  `products_without_promotion` int(11) NOT NULL DEFAULT 0,
  `product_regular_price` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_orders_products_orders` (`order_id`),
  KEY `FK_orders_products_products` (`product_id`),
  KEY `FK_orders_products_promotions` (`promotion_id`),
  CONSTRAINT `FK_orders_products_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_orders_products_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_orders_products_promotions` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table sg.orders_products: ~17 rows (approximately)
/*!40000 ALTER TABLE `orders_products` DISABLE KEYS */;
INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `promotion_id`, `promotion_products`, `promotion_price`, `products_with_promotion`, `products_without_promotion`, `product_regular_price`) VALUES
	(1, 9, 11, NULL, 0, 0, 0, 1, 10),
	(2, 9, 8, 12, 3, 130, 3, 0, 0),
	(3, 9, 9, 13, 2, 45, 2, 0, 0),
	(4, 10, 11, NULL, 0, 0, 0, 1, 10),
	(5, 10, 8, 12, 3, 130, 3, 0, 0),
	(6, 10, 9, 13, 2, 45, 2, 0, 0),
	(7, 11, 8, 12, 3, 130, 6, 0, 0),
	(8, 11, 9, 13, 2, 45, 4, 0, 0),
	(9, 11, 10, NULL, 0, 0, 0, 1, 20),
	(10, 11, 11, NULL, 0, 0, 0, 1, 10),
	(11, 12, 8, 12, 3, 130, 3, 1, 50),
	(12, 12, 9, 13, 2, 45, 2, 1, 30),
	(13, 12, 10, NULL, 0, 0, 0, 1, 20),
	(14, 12, 11, NULL, 0, 0, 0, 1, 10),
	(15, 13, 11, NULL, 0, 0, 0, 1, 10),
	(16, 13, 8, 12, 3, 130, 3, 0, 0),
	(17, 13, 9, 13, 2, 45, 2, 0, 0);
/*!40000 ALTER TABLE `orders_products` ENABLE KEYS */;

-- Dumping structure for table sg.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) COLLATE utf8_bin NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `is_active` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sku` (`sku`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table sg.products: ~4 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `sku`, `title`, `description`, `price`, `is_active`) VALUES
	(8, 'A', 'Product A', 'bas', 50, 1),
	(9, 'B', 'Product B', 'Product B', 30, 1),
	(10, 'C', 'Product C', 'Product C', 20, 1),
	(11, 'D', 'Product D', 'Product D', 10, 1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table sg.promotions
CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `products` int(11) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `valid_from` date NOT NULL,
  `valid_to` date NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_promotions_products` (`product_id`),
  CONSTRAINT `FK_promotions_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table sg.promotions: ~2 rows (approximately)
/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
INSERT INTO `promotions` (`id`, `product_id`, `products`, `price`, `valid_from`, `valid_to`, `is_active`) VALUES
	(12, 8, 3, 130, '2020-03-01', '2020-03-31', 1),
	(13, 9, 2, 45, '2020-03-01', '2020-03-31', 1);
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
