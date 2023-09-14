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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum-foued.category : ~4 rows (environ)
INSERT INTO `category` (`id_category`, `categoryName`) VALUES
	(1, 'Sport'),
	(2, 'Musique'),
	(4, 'Voyage'),
	(6, 'Lecture');

-- Listage de la structure de table forum-foued. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `datePost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `topic_id` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `user.id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum-foued.post : ~13 rows (environ)
INSERT INTO `post` (`id_post`, `text`, `datePost`, `topic_id`, `user_id`) VALUES
	(1, 'fjdhurturhf bfjhurehftu hbfrehbj', '2023-08-31 16:14:10', 1, 1),
	(3, 'fgrytrytry', '2023-08-31 15:14:47', 3, 2),
	(4, 'hjggu uhuhuhu', '2023-09-04 05:19:38', 1, 3),
	(5, '11111111111111111111111111111111111111111111', '2023-09-13 15:07:56', 5, 5),
	(6, 'sss', '2023-09-13 15:08:05', 7, 5),
	(12, 'qqq', '2023-09-14 10:57:27', 1, 5),
	(13, 'qqq', '2023-09-14 11:09:11', 17, 4),
	(14, 'qqq', '2023-09-14 11:18:13', 18, 4),
	(15, 'qqq', '2023-09-14 11:18:20', 18, 4),
	(16, 'qqq', '2023-09-14 13:42:41', 18, 9),
	(17, 'qqq', '2023-09-14 13:46:10', 18, 9),
	(18, 'qqq', '2023-09-14 13:46:54', 18, 9),
	(19, 'qqq', '2023-09-14 13:47:10', 18, 9);

-- Listage de la structure de table forum-foued. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `topicName` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `topicDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum-foued.topic : ~13 rows (environ)
INSERT INTO `topic` (`id_topic`, `topicName`, `topicDate`, `locked`, `user_id`, `category_id`) VALUES
	(1, 'Foot', '2023-08-31 11:25:26', 1, 1, 1),
	(2, 'Natation', '2023-08-15 13:47:13', 0, 2, 1),
	(3, 'Tennis', '2023-08-10 13:56:49', 0, 2, 1),
	(5, 'Rock', '2023-09-04 04:35:19', 0, 1, 2),
	(7, 'Bon Plan', '2023-09-04 04:36:26', 0, 3, 4),
	(9, 'abc', '2023-09-13 11:05:38', 0, 4, 4),
	(10, 'Jazz', '2023-09-14 09:02:29', 0, 5, 2),
	(11, 'wwwwwwwwwwwwwww', '2023-09-14 09:07:33', 0, 5, 2),
	(12, 'wwwwwwwwwwwwwww', '2023-09-14 09:08:06', 0, 5, 2),
	(13, 'wwwwwwwwwwwwwww', '2023-09-14 09:12:35', 0, 5, 2),
	(14, 'wwwwwwwwwwwwwww', '2023-09-14 09:14:11', 0, 5, 1),
	(17, 'wwwwwwwwwwwwwww', '2023-09-14 11:08:34', 0, 4, 6),
	(18, 'wwwwwwwwwwwwwww', '2023-09-14 11:14:53', 0, 4, 6);

-- Listage de la structure de table forum-foued. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `registrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pseudo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ban` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum-foued.user : ~8 rows (environ)
INSERT INTO `user` (`id_user`, `registrationDate`, `pseudo`, `password`, `role`, `email`, `ban`) VALUES
	(1, '2023-08-20 11:26:40', 'John', '12345', 'user', 'john21@gmail.com', 0),
	(2, '2023-08-14 13:47:36', 'julie', '2548', 'user', 'julie22@gmail.com', 0),
	(3, '2023-08-10 13:57:24', 'paul', '123', 'user', 'paul07@gmail.com', 0),
	(4, '2023-09-13 11:03:37', 'aaaa', '$2y$10$UgUo0jTGXtO.3n72yoPF0uOPJYtrpOnkPD66kz/9xXs7ixg3csVlS', 'user', 'aaaa@gmail.com', 0),
	(5, '2023-09-13 14:36:13', 'fff', '$2y$10$OyLAiOKTNDfroQemAHS1EOaIN8D2OcXYybE.ZYPaTOzlyugK6zpOu', 'user', 'fff@gmail.com', 0),
	(9, '2023-09-14 13:36:08', 'azazel', '$2y$10$ry2IfsRiegw4S1VyQNKFYevjTUfVke11F8Nj1D3wQoJwEGH11sBYe', 'user', 'azazel@gmail.com', 0),
	(10, '2023-09-14 15:08:19', 'jason', '123', 'user', 'jason@gmail.com', 0),
	(11, '2023-09-14 15:10:27', 'jasson', '$2y$10$bVA/J7rQ5MJ/14mDXgA0MeueOtrMp5scw5FDEhfYuWu1e5Yg2ey0e', 'admin', 'jasson@gmail.com', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
