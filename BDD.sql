-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum-foued
CREATE DATABASE IF NOT EXISTS `forum-foued` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum-foued`;

-- Listage de la structure de table forum-foued. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(50) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum-foued.category : ~4 rows (environ)
INSERT INTO `category` (`id_category`, `categoryName`) VALUES
	(1, 'Sport'),
	(2, 'Musique'),
	(3, 'Lecture'),
	(4, 'Voyage');

-- Listage de la structure de table forum-foued. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `datePost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_post`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `topic_id` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `user.id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table forum-foued.post : ~3 rows (environ)
INSERT INTO `post` (`id_post`, `text`, `datePost`, `topic_id`, `user_id`) VALUES
	(1, 'fjdhurturhf bfjhurehftu hbfrehbj', '2023-08-31 16:14:10', 1, 1),
	(2, 'jhyuiouilk jybvrh', '2023-08-30 16:14:28', 2, 1),
	(3, 'fgrytrytry', '2023-08-31 15:14:47', 3, 2);

-- Listage de la structure de table forum-foued. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `topicName` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `topicDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locked` tinyint(1) DEFAULT '0',
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum-foued.topic : ~4 rows (environ)
INSERT INTO `topic` (`id_topic`, `topicName`, `topicDate`, `locked`, `user_id`, `category_id`) VALUES
	(1, 'Foot', '2023-08-31 11:25:26', 0, 1, 1),
	(2, 'Natation', '2023-08-15 13:47:13', 0, 2, 1),
	(3, 'Tennis', '2023-08-10 13:56:49', 0, 2, 1),
	(4, 'Musculation', '2023-08-11 13:58:14', 0, 3, 1);

-- Listage de la structure de table forum-foued. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `registrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pseudo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `role` varchar(50) DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum-foued.user : ~3 rows (environ)
INSERT INTO `user` (`id_user`, `registrationDate`, `pseudo`, `password`, `role`, `email`) VALUES
	(1, '2023-08-20 11:26:40', 'John', '12345', 'admin', 'john21@gmail.com'),
	(2, '2023-08-14 13:47:36', 'julie', '2548', 'admin', 'julie22@gmail.com'),
	(3, '2023-08-10 13:57:24', 'paul', '12545', 'admin', 'paul07@gmail.com');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
