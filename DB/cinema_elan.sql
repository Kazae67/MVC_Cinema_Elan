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


-- Listage de la structure de la base pour cinema_elan
CREATE DATABASE IF NOT EXISTS `cinema_elan` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema_elan`;

-- Listage de la structure de table cinema_elan. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `path_img_acteur` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `biographie` longtext,
  `id_personne` int DEFAULT NULL,
  PRIMARY KEY (`id_acteur`) USING BTREE,
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_acteur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_elan.acteur : ~0 rows (environ)
INSERT INTO `acteur` (`id_acteur`, `path_img_acteur`, `biographie`, `id_personne`) VALUES
	(100, '649e8d9bee035.webp', 'Ceci est la biographie de l&#39;acteur', 86),
	(101, '649e8e5728dac.jpg', '', 87);

-- Listage de la structure de table cinema_elan. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `film_id` int DEFAULT NULL,
  `acteur_id` int DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  KEY `FK3_casting_role` (`role_id`),
  KEY `FK1_casting_movie` (`film_id`) USING BTREE,
  KEY `FK2_casting_actor` (`acteur_id`) USING BTREE,
  CONSTRAINT `FK1_casting_movie` FOREIGN KEY (`film_id`) REFERENCES `film` (`id_film`) ON DELETE CASCADE,
  CONSTRAINT `FK2_casting_actor` FOREIGN KEY (`acteur_id`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `FK3_casting_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_elan.casting : ~3 rows (environ)
INSERT INTO `casting` (`film_id`, `acteur_id`, `role_id`) VALUES
	(91, 100, 63),
	(91, 101, 63),
	(91, 101, 64);

-- Listage de la structure de table cinema_elan. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `titre_film` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `date_sortie` year DEFAULT NULL,
  `duree` int DEFAULT NULL,
  `synopsis` longtext,
  `realisateur_id` int DEFAULT NULL,
  `note` int DEFAULT NULL,
  `path_img_film` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  PRIMARY KEY (`id_film`) USING BTREE,
  KEY `FK2_movie_director` (`realisateur_id`) USING BTREE,
  CONSTRAINT `FK2_film_realisateur` FOREIGN KEY (`realisateur_id`) REFERENCES `realisateur` (`id_realisateur`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_elan.film : ~1 rows (environ)
INSERT INTO `film` (`id_film`, `titre_film`, `date_sortie`, `duree`, `synopsis`, `realisateur_id`, `note`, `path_img_film`) VALUES
	(91, 'Titre', '1993', 120, 'Ceci est le synopsis du film', 40, 5, '649e8d10748e2.jpg');

-- Listage de la structure de table cinema_elan. film_genre
CREATE TABLE IF NOT EXISTS `film_genre` (
  `id_genre` int DEFAULT NULL,
  `id_film` int DEFAULT NULL,
  KEY `id_genre` (`id_genre`),
  KEY `id_film` (`id_film`),
  CONSTRAINT `FK_film_genre_cinema_elan.film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE,
  CONSTRAINT `FK_film_genre_cinema_elan.genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_elan.film_genre : ~1 rows (environ)
INSERT INTO `film_genre` (`id_genre`, `id_film`) VALUES
	(32, 91);

-- Listage de la structure de table cinema_elan. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `genre_name` varchar(50) DEFAULT NULL,
  `path_img_genre` longtext,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_elan.genre : ~0 rows (environ)
INSERT INTO `genre` (`id_genre`, `genre_name`, `path_img_genre`) VALUES
	(32, 'Fantasy', '649e8ceae1cfe.jpg');

-- Listage de la structure de table cinema_elan. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `sexe` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_elan.personne : ~68 rows (environ)
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `birthdate`, `sexe`) VALUES
	(1, 'Matthew', 'McConaughey', '2023-06-25', 'Homme'),
	(2, 'Daniel', 'Radcliffe', '2020-06-27', 'Homme'),
	(3, 'Rupert', 'Grint', '2018-06-25', 'Homme'),
	(4, 'Akira', 'Toriyama', '2023-06-25', 'Homme'),
	(5, 'Christopher', 'Nolan', '2023-06-25', 'Homme'),
	(6, 'Juan', 'Solanas', '2023-06-25', 'Homme'),
	(7, 'James', 'Cameron', '2023-06-25', 'Homme'),
	(8, 'Brad', 'Bird', '2023-06-25', 'Homme'),
	(9, 'JK', 'Rowling', '2023-06-25', 'Femme'),
	(10, 'Espen', 'Sandberg', '2023-06-25', 'Homme'),
	(11, 'Alain', 'Chabat', '2023-06-25', 'Homme'),
	(12, 'Fritz', 'Lang', '2023-06-25', 'Homme'),
	(13, 'Robert', 'Zemeckis', '2023-06-25', 'Homme'),
	(14, 'David', 'Fincher', '2023-06-25', 'Homme'),
	(15, 'Chris', 'Columbus', '2023-06-25', 'Homme'),
	(16, 'Rob', 'Minkoff', '2023-06-25', 'Homme'),
	(17, 'Darrell', 'Rooney', '2023-06-25', 'Homme'),
	(18, 'Brian', 'De Palma', '2023-06-25', 'Homme'),
	(19, 'Goku', 'San', '2023-06-25', 'Homme'),
	(20, 'Broly', 'Super', '2023-06-25', 'Homme'),
	(21, 'Emma', 'Watson', '2023-06-25', 'Femme'),
	(22, 'Jim', 'Sturgess', '2023-06-25', 'Homme'),
	(23, 'Christian', 'Clavier', '2023-06-25', 'Homme'),
	(24, 'Kristen', 'Dunst', '2023-06-25', 'Femme'),
	(25, 'Tom', 'Hanks', '2023-06-25', 'Homme'),
	(26, 'Sam', 'Worthington', '2023-06-25', 'Homme'),
	(27, 'Zoe', 'Saldana', '2023-06-25', 'Femme'),
	(28, 'Gérard', 'Depardieu', '2023-06-25', 'Homme'),
	(29, 'Johny', 'Depp', '2023-06-25', 'Homme'),
	(30, 'Orlando', 'Bloom', '2023-06-25', 'Homme'),
	(31, 'Jamel', 'Debbouze', '2023-06-25', 'Homme'),
	(32, 'Keira', 'Knightley', '2023-06-25', 'Femme'),
	(33, 'Brad', 'Pitt', '2023-06-25', 'Homme'),
	(34, 'Edward', 'Norton', '2023-06-25', 'Homme'),
	(35, 'Helena', 'Bonham', '2023-06-25', 'Femme'),
	(36, 'Lou', 'Romano', '2023-06-25', 'Homme'),
	(37, 'Patton', 'Oswalt', '2023-06-25', 'Homme'),
	(38, 'Robin', 'Williams', '2023-06-25', 'Homme'),
	(39, 'Embeth', 'Davidtz', '2023-06-25', 'Femme'),
	(40, 'Matthew', 'Broderick', '2023-06-25', 'Homme'),
	(41, 'James', 'Earl', '2023-06-25', 'Homme'),
	(42, 'Jeremy', 'Irons', '2023-06-25', 'Homme'),
	(43, 'Suzanne', 'Pleshette', '2023-06-25', 'Femme'),
	(44, 'Brigitte', 'Helm', '2023-06-25', 'Femme'),
	(45, 'Rudolf', 'Klein-Rogge', '2023-06-25', 'Homme'),
	(46, 'Al', 'Pacino', '2023-06-25', 'Homme'),
	(47, 'Michelle', 'Pfeiffer', '2023-06-25', 'Femme'),
	(48, 'Foy', 'Mackenzie', '2023-06-25', 'Femme'),
	(69, 'McConaughey', 'Matthew', '1993-08-03', 'Homme'),
	(70, 'Nolan', 'Christopher', '1993-08-03', 'Homme'),
	(71, 'Yasin', 'Akgedik', '1993-08-03', 'Homme'),
	(72, 'Le', 'R&eacute;alisateur', '2000-08-03', 'Homme'),
	(73, 'Je suis', 'L&#39;acteur', '1990-03-01', 'Homme'),
	(74, 'Le nom', 'd&#39;acteur', '1993-08-03', 'Homme'),
	(75, 'ezaeza', 'ezaza', '1993-08-03', 'Homme'),
	(76, 'eazeza', 'ezaeaz', '1993-08-03', 'Homme'),
	(77, 'ezaeza', 'ezaea', '1993-08-03', 'Homme'),
	(78, 'ezaeza', 'ezaea', '1993-08-03', 'Homme'),
	(79, 'azea', 'ezaeaz', '1993-08-03', 'Homme'),
	(80, 'azea', 'eazeza', '1993-08-03', 'Homme'),
	(81, 'Nom', 'Prenom', '1993-08-03', 'Homme'),
	(82, 'Nom', 'Prenom', '1993-08-03', 'Homme'),
	(83, 'Nom', 'Prenom', '1993-08-03', 'Homme'),
	(84, 'Nom', 'Prenom', '1993-08-03', 'Homme'),
	(85, 'Nom', 'Prenom', '1993-08-03', 'Homme'),
	(86, 'Nom', 'Prenom', '1993-08-03', 'Homme'),
	(87, 'Nom 1', 'Prenom 2', '1993-08-03', 'Homme'),
	(88, 'Nom 2', 'Prenom 2', '1993-08-03', 'Homme');

-- Listage de la structure de table cinema_elan. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL AUTO_INCREMENT,
  `biographie` longtext,
  `path_img_realisateur` longtext,
  `id_personne` int DEFAULT NULL,
  PRIMARY KEY (`id_realisateur`) USING BTREE,
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_realisateur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_elan.realisateur : ~1 rows (environ)
INSERT INTO `realisateur` (`id_realisateur`, `biographie`, `path_img_realisateur`, `id_personne`) VALUES
	(40, 'Ceci est la biographie du r&eacute;alisateur', '649e8c88d2c69.jpg', 83);

-- Listage de la structure de table cinema_elan. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `path_img_role` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_elan.role : ~2 rows (environ)
INSERT INTO `role` (`id_role`, `role_name`, `description`, `path_img_role`) VALUES
	(63, 'Role', 'Ceci est une description du r&ocirc;le', '649e8db3574f6.jpg'),
	(64, 'Role 1', '', '649e91074b928.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
