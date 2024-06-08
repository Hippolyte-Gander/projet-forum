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

-- Listage de la structure de table forum_hippo. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forum_hippo.category : ~0 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'Vacation'),
	(2, 'Sport'),
	(3, 'Politics');

-- Listage de la structure de table forum_hippo. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_message` int NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_bin NOT NULL,
  `postDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forum_hippo.post : ~1 rows (environ)
INSERT INTO `post` (`id_message`, `content`, `postDate`, `topic_id`, `user_id`) VALUES
	(1, 'No, hawai is more beautiful', '2024-06-08 21:13:43', 1, 1);

-- Listage de la structure de table forum_hippo. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `topicDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `closed` tinyint DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forum_hippo.topic : ~0 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `topicDate`, `category_id`, `user_id`, `closed`) VALUES
	(1, 'Island best country', '2024-06-08 21:12:29', 1, 1, NULL),
	(2, 'Zidane never beaten ?', '2024-06-08 21:12:29', 2, 1, NULL);

-- Listage de la structure de table forum_hippo. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `accountDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) COLLATE utf8mb4_bin NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forum_hippo.user : ~0 rows (environ)
INSERT INTO `user` (`id_user`, `nickname`, `mail`, `password`, `accountDate`, `role`) VALUES
	(1, 'John', 'john@exemple.com', 'PASSWORD1', '2024-06-07 21:01:22', 'user'),
	(2, 'Doe', 'doe@exemple.com', 'PASSWORD2', '2024-06-08 21:01:22', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
