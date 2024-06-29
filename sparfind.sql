-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 27 juin 2024 à 09:43
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sparfind`
--

-- --------------------------------------------------------

--
-- Structure de la table `meet`
--

CREATE TABLE `meet` (
  `id` int(11) NOT NULL,
  `sport` varchar(255) DEFAULT NULL,
  `coordonnees` varchar(255) DEFAULT NULL,
  `niveau` varchar(50) DEFAULT NULL,
  `capacite` int(6) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `meet`
--

INSERT INTO `meet` (`id`, `sport`, `coordonnees`, `niveau`, `capacite`, `description`, `date`, `user_id`) VALUES
(63, 'Mma', '43.53058177214107, 5.442309379577638', 'Avancé', 2, 'Bonjour,\r\n\r\nJe cherche à renforcer mes compétences en m\'entraînant avec des athlètes variés, mais aussi jouer un rôle de mentor pour les débutants, en les guidant dans leur progression.\r\n\r\nEn espérant trouver rapidement !', '2024-08-01 11:11:00', 27);

-- --------------------------------------------------------

--
-- Structure de la table `meet_user`
--

CREATE TABLE `meet_user` (
  `user_id` int(11) DEFAULT NULL,
  `meet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `meet_user`
--

INSERT INTO `meet_user` (`user_id`, `meet_id`) VALUES
(28, 63);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `texte` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `meet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `texte`, `date`, `user_id`, `meet_id`) VALUES
(44, 'Bonjour Lucie !', '2024-06-26 13:54:12', 28, 63),
(45, 'Salut Damien, tu serais disponible ?', '2024-06-26 13:54:45', 27, 63),
(46, 'Oui t&#039;as description est ce que je recherche en tant que débutant.', '2024-06-26 13:55:56', 28, 63),
(47, 'Cool ! On se rejoint un peu avant 16h00 ?', '2024-06-26 13:56:44', 27, 63),
(48, 'Yes, ça marche !', '2024-06-26 13:56:58', 28, 63);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `age` int(99) NOT NULL,
  `cp` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `sport` varchar(50) DEFAULT NULL,
  `niveau` varchar(50) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`, `age`, `cp`, `city`, `address`, `email`, `password`, `sport`, `niveau`, `bio`) VALUES
(7, 'Benjamin', 'Darmon', 23, '13430', 'Eyguières', 'Hameau', 'ben@gmail.com', '$2y$10$KF5vf9L1hICyJs6IQ2.pt.Zs3g5d6kq4wNgAU36Ypuevd92Eq726C', 'MMA', 'Débutant', 'Admin Sparfind'),
(8, 'Elisa', 'Panfili', 20, '13100', 'Aix', '615 Av', 'elisa@gmail.com', '$2y$10$9Eg.QrBnHfpyuihwvOfwD.gsQhd3eatJ8bQnw8VzCW7EgGlOa/JbG', 'Muay-Thaï', 'Débutant', 'User Sparfind'),
(27, 'Lucie', 'Cielu', 35, '13090', 'Aix-En-Provence', '18 Rue du général Carrefour', 'lucie@gmail.com', '$2y$10$Xa6axNQ3ITagGi/7aJHZ8Oupa.YyFwflnYfIAuianlEHLuY2wxmf.', 'Mma', 'Avancé', 'Grâce à Sparfind, je vais pouvoir renforcer mes compétences en mentraînant avec des athlètes variés, mais aussi jouer un rôle de mentor pour les débutants, en les guidant dans leur progression'),
(28, 'Damien', 'Miendu', 27, '13090', 'Aix-En-Provence', '18 Rue du colonel Moutarde', 'damien@gmail.com', '$2y$10$vCrNPKqGIcMO3y51io6YT.ySehIjb0UydITX5aq8cCzV19NaMdexi', 'Boxe', 'Amateur', 'Grâce à Sparfind, je vais pouvoir trouver des partenaires, tout en me permettant de bénéficier de conseils et de soutien pour atteindre mes objectifs sportifs.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `meet`
--
ALTER TABLE `meet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `meet_user`
--
ALTER TABLE `meet_user`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meet_id` (`meet_id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_user` (`user_id`),
  ADD KEY `fk_meet_id` (`meet_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `meet`
--
ALTER TABLE `meet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `meet`
--
ALTER TABLE `meet`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `meet_user`
--
ALTER TABLE `meet_user`
  ADD CONSTRAINT `meet_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meet_user_ibfk_2` FOREIGN KEY (`meet_id`) REFERENCES `meet` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_meet_id` FOREIGN KEY (`meet_id`) REFERENCES `meet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_message_meet` FOREIGN KEY (`meet_id`) REFERENCES `meet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_message_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
