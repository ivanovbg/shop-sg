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

-- Dumping data for table sg.admins: ~2 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `email`, `password`, `active`, `name`, `level`) VALUES
	(1, 'ivanovkbg@gmail.com', '6dcdc372c748e4dc90e0c8d653e387bc', 1, 'Красимир Петров', 9),
	(4, 'test@test.bg', '25d55ad283aa400af464c76d713c07ad', 1, 'Test Testov', 9);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table sg.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_price` float NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table sg.orders: ~0 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table sg.orders_products
CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `promotion_id` int(11) DEFAULT NULL,
  `promotion_products` int(11) NOT NULL DEFAULT 0,
  `promotion_price` float NOT NULL DEFAULT 0,
  `products_with_promotion` int(11) NOT NULL DEFAULT 0,
  `products_without_promotion` int(11) NOT NULL DEFAULT 0,
  `product_regular_price` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_orders_products_orders` (`order_id`),
  KEY `FK_orders_products_products` (`product_id`),
  KEY `FK_orders_products_promotions` (`promotion_id`),
  CONSTRAINT `FK_orders_products_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_orders_products_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_orders_products_promotions` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table sg.orders_products: ~0 rows (approximately)
/*!40000 ALTER TABLE `orders_products` DISABLE KEYS */;
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
	(8, 'A', 'Product A', 'bas', 0.5, 1),
	(9, 'B', 'Product B', 'Product B', 0.3, 1),
	(10, 'C', 'Product C', 'Product C', 0.2, 1),
	(11, 'D', 'Product D', 'Product D', 0.1, 1);
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
	(12, 8, 3, 1.3, '2020-03-01', '2020-03-31', 1),
	(13, 9, 2, 0.45, '2020-03-01', '2020-03-31', 1);
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
