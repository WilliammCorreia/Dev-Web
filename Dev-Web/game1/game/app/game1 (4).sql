-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 24 mai 2023 à 14:35
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `game1`
--

-- --------------------------------------------------------

--
-- Structure de la table `donjons`
--

DROP TABLE IF EXISTS `donjons`;
CREATE TABLE IF NOT EXISTS `donjons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `difficulty` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `donjons`
--

INSERT INTO `donjons` (`id`, `name`, `difficulty`) VALUES
(1, 'Donjons de la mort qui tue', 1),
(2, 'Colline de la rédemption', 2);

-- --------------------------------------------------------

--
-- Structure de la table `persos`
--

DROP TABLE IF EXISTS `persos`;
CREATE TABLE IF NOT EXISTS `persos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `for` int NOT NULL,
  `dex` int NOT NULL,
  `int` int NOT NULL,
  `char` int NOT NULL,
  `vit` int NOT NULL,
  `pdv` int NOT NULL,
  `gold` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `xp` int NOT NULL,
  `level` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `persos`
--

INSERT INTO `persos` (`id`, `name`, `for`, `dex`, `int`, `char`, `vit`, `pdv`, `gold`, `user_id`, `created_at`, `updated_at`, `xp`, `level`) VALUES
(4, 'Willix', 38, 10, 12, 12, 14, 51, 1979, 19, '2023-05-24 07:30:36', '2023-05-24 07:30:36', 0, 21),
(5, 'Squid Game', 20, 10, 10, 10, 10, 27, 207, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 6),
(6, 'SIUUUUUUUUUUUU', 12, 10, 10, 10, 10, 4, 36, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` enum('vide','treasur','combat','test') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `donjon_id` int NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `donjon_id` (`donjon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `description`, `type`, `donjon_id`, `picture`) VALUES
(1, 'Couloir', 'C\'est un long couloir très sombre.', 'vide', 1, 'couloir.jpg'),
(2, 'Salle du trésor', 'Il y a un coffre qui contient un gros magot !', 'treasur', 1, 'tresor.webp'),
(6, 'Salles des gardes', 'Vous entrez dans la salle, il y a un ennemi présent !', 'combat', 1, 'garde.jpg'),
(12, 'Pont des damnés', 'Un vieux pont en pierre, qui semble être habité par une ombre spectrale.', 'combat', 2, 'pont.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(19, 'test2@test.com', '$2y$10$IFpPWT.lJrB2w9yZtQLsI.cICNgUylan0TEmKLtOPaauOTKoouGJW', '2023-05-05 11:37:16', '2023-05-05 11:37:16');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`donjon_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
