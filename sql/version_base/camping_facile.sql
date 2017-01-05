-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Jeu 05 Janvier 2017 à 04:08
-- Version du serveur :  5.7.13-log
-- Version de PHP :  7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camping_facile`
--

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `time_start` int(255) NOT NULL,
  `duree` int(4) NOT NULL COMMENT 'durée en minutes',
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('RESERVABLE','PAYANT','RESERVABLE_PAYANT','NORMAL') NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `points` int(10) NOT NULL,
  `prix` int(3) NOT NULL,
  `capaciteMax` int(3) NOT NULL,
  `idDirigeant` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `id` int(255) NOT NULL,
  `nom` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipe_membres`
--

CREATE TABLE `equipe_membres` (
  `idEquipe` int(255) NOT NULL,
  `idUser` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `problemes_technique`
--

CREATE TABLE `problemes_technique` (
  `id` int(255) NOT NULL,
  `idUsers` int(255) NOT NULL,
  `time_start` int(255) NOT NULL,
  `time_estimated` int(255) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `isBungalow` tinyint(1) NOT NULL,
  `solved` int(255) NOT NULL DEFAULT '0' COMMENT '0 pour non résolu, sinon ID de l''utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idActivite` int(255) NOT NULL,
  `idUser` int(255) NOT NULL,
  `idEquipe` int(255) NOT NULL,
  `nbrPersonne` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `userinfos`
--

CREATE TABLE `userinfos` (
  `id` int(255) NOT NULL,
  `emplacement` int(4) NOT NULL,
  `email` varchar(75) NOT NULL,
  `solde` int(5) NOT NULL DEFAULT '0',
  `time_depart` int(255) NOT NULL,
  `clef` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `clef` varchar(25) NOT NULL,
  `id` int(255) NOT NULL,
  `infoId` int(255) NOT NULL,
  `access_level` enum('CLIENT','ANIMATEUR','TECHNICIEN','PATRON') NOT NULL DEFAULT 'CLIENT',
  `droits` bigint(255) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `code` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idDirigeant` (`idDirigeant`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipe_membres`
--
ALTER TABLE `equipe_membres`
  ADD PRIMARY KEY (`idEquipe`,`idUser`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `problemes_technique`
--
ALTER TABLE `problemes_technique`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idUsers` (`idUsers`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idActivite`,`idUser`),
  ADD KEY `idEquipe` (`idEquipe`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `userinfos`
--
ALTER TABLE `userinfos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clef` (`clef`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clef_unique` (`clef`),
  ADD KEY `infoId` (`infoId`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `problemes_technique`
--
ALTER TABLE `problemes_technique`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `userinfos`
--
ALTER TABLE `userinfos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`idDirigeant`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `equipe_membres`
--
ALTER TABLE `equipe_membres`
  ADD CONSTRAINT `equipe_membres_ibfk_1` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `equipe_membres_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `problemes_technique`
--
ALTER TABLE `problemes_technique`
  ADD CONSTRAINT `problemes_technique_ibfk_1` FOREIGN KEY (`idUsers`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idActivite`) REFERENCES `activities` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`id`);

--
-- Contraintes pour la table `userinfos`
--
ALTER TABLE `userinfos`
  ADD CONSTRAINT `userinfos_ibfk_1` FOREIGN KEY (`clef`) REFERENCES `users` (`clef`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`infoId`) REFERENCES `userinfos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
