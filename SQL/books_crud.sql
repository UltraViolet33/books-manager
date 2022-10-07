-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour books-crud
CREATE DATABASE IF NOT EXISTS `books-crud` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `books-crud`;

-- Listage de la structure de la table books-crud. books
CREATE TABLE IF NOT EXISTS `books` (
  `books_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `books_cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`books_id`),
  KEY `FK_books_categories` (`books_cat_id`),
  CONSTRAINT `FK_books_categories` FOREIGN KEY (`books_cat_id`) REFERENCES `categories` (`categories_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Listage des données de la table books-crud.books : ~0 rows (environ)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`books_id`, `title`, `author`, `status`, `books_cat_id`) VALUES
	(13, 'test', 'test', 0, 54),
	(14, 'test', 'test', 0, 55);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Listage de la structure de la table books-crud. categories
CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

-- Listage des données de la table books-crud.categories : ~0 rows (environ)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`categories_id`, `name`) VALUES
	(54, 'roman'),
	(55, 'informatique');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
