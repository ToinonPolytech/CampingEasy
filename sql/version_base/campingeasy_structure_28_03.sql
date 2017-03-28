-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 27 Mars 2017 à 22:28
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `campingeasy`
--

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `time_start` int(255) NOT NULL,
  `duree` int(4) NOT NULL COMMENT 'durée en minutes',
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` text NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `points` int(10) NOT NULL,
  `prix` int(3) NOT NULL,
  `mustBeReserved` tinyint(1) NOT NULL,
  `capaciteMax` int(3) NOT NULL,
  `debutReservation` int(255) NOT NULL,
  `finReservation` int(255) NOT NULL,
  `photos` text NOT NULL,
  `idRecurrente` int(255) NOT NULL DEFAULT '-1',
  `idDirigeant` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE `equipe` (
  `id` int(255) NOT NULL,
  `nom` varchar(75) NOT NULL,
  `score` int(255) NOT NULL DEFAULT '0',
  `dateCreation` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipe_membres`
--

DROP TABLE IF EXISTS `equipe_membres`;
CREATE TABLE `equipe_membres` (
  `idEquipe` int(255) NOT NULL,
  `idUser` int(255) NOT NULL,
  `peutModifier` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etat_lieux`
--

DROP TABLE IF EXISTS `etat_lieux`;
CREATE TABLE `etat_lieux` (
  `id` int(255) NOT NULL,
  `idUser` int(255) NOT NULL,
  `debutTime` int(255) NOT NULL,
  `finTime` int(255) NOT NULL,
  `duree_moyenne` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lieu_commun`
--

DROP TABLE IF EXISTS `lieu_commun`;
CREATE TABLE `lieu_commun` (
  `id` int(255) NOT NULL,
  `nom` varchar(75) NOT NULL,
  `description` text NOT NULL,
  `photos` text NOT NULL,
  `estReservable` tinyint(1) NOT NULL,
  `timeReservation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

DROP TABLE IF EXISTS `partenaire`;
CREATE TABLE `partenaire` (
  `id` int(255) NOT NULL,
  `idUser` int(255) NOT NULL,
  `nom` varchar(75) NOT NULL,
  `description` text NOT NULL,
  `mail` varchar(75) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `telephone` varchar(13) DEFAULT NULL,
  `photos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `partenaire_services`
--

DROP TABLE IF EXISTS `partenaire_services`;
CREATE TABLE `partenaire_services` (
  `id` int(255) NOT NULL,
  `idPartenaire` int(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `problemes_technique`
--

DROP TABLE IF EXISTS `problemes_technique`;
CREATE TABLE `problemes_technique` (
  `id` int(255) NOT NULL,
  `idUsers` int(255) NOT NULL,
  `time_start` int(255) NOT NULL,
  `time_estimated` int(255) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `isBungalow` tinyint(1) NOT NULL,
  `photos` text NOT NULL,
  `solved` enum('NON_RESOLU','EN_COURS','RESOLU','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `problemes_technique_info`
--

DROP TABLE IF EXISTS `problemes_technique_info`;
CREATE TABLE `problemes_technique_info` (
  `id` int(255) NOT NULL,
  `idPbTech` int(255) NOT NULL,
  `idUser` int(255) NOT NULL,
  `time` int(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `id` int(255) NOT NULL,
  `type` enum('ACTIVITE','RESTAURANT','ETAT_LIEUX','LIEU_COMMUN','') NOT NULL DEFAULT 'ACTIVITE',
  `idUser` int(255) NOT NULL,
  `time` int(255) NOT NULL DEFAULT '0',
  `idEquipe` int(255) DEFAULT '0',
  `nbrPersonne` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE `restaurant` (
  `id` int(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `capacite` int(255) NOT NULL,
  `heureOuverture` text NOT NULL,
  `photos` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `userinfos`
--

DROP TABLE IF EXISTS `userinfos`;
CREATE TABLE `userinfos` (
  `id` int(255) NOT NULL,
  `emplacement` int(4) NOT NULL,
  `email` varchar(75) NOT NULL,
  `solde` int(5) NOT NULL DEFAULT '0',
  `time_depart` int(255) NOT NULL,
  `clef` varchar(25) NOT NULL,
  `comptesMax` int(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `clef` varchar(25) NOT NULL,
  `id` int(255) NOT NULL,
  `infoId` int(255) NOT NULL,
  `access_level` enum('CLIENT','ANIMATEUR','TECHNICIEN','PATRON','PARTENAIRE') NOT NULL DEFAULT 'CLIENT',
  `droits` bigint(255) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `code` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDirigeant` (`idDirigeant`) USING BTREE;

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
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idEquipe` (`idEquipe`);

--
-- Index pour la table `etat_lieux`
--
ALTER TABLE `etat_lieux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `lieu_commun`
--
ALTER TABLE `lieu_commun`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partenaire`
--
ALTER TABLE `partenaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `partenaire_services`
--
ALTER TABLE `partenaire_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPartenaire` (`idPartenaire`);

--
-- Index pour la table `problemes_technique`
--
ALTER TABLE `problemes_technique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsers` (`idUsers`) USING BTREE;

--
-- Index pour la table `problemes_technique_info`
--
ALTER TABLE `problemes_technique_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPbTech` (`idPbTech`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`,`idUser`,`type`) USING BTREE,
  ADD KEY `idEquipe` (`idEquipe`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `etat_lieux`
--
ALTER TABLE `etat_lieux`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `lieu_commun`
--
ALTER TABLE `lieu_commun`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `partenaire`
--
ALTER TABLE `partenaire`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `partenaire_services`
--
ALTER TABLE `partenaire_services`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `problemes_technique`
--
ALTER TABLE `problemes_technique`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `problemes_technique_info`
--
ALTER TABLE `problemes_technique_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `userinfos`
--
ALTER TABLE `userinfos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  ADD CONSTRAINT `equipe_membres_ibfk_1` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `equipe_membres_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `partenaire`
--
ALTER TABLE `partenaire`
  ADD CONSTRAINT `partenaire_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `problemes_technique`
--
ALTER TABLE `problemes_technique`
  ADD CONSTRAINT `problemes_technique_ibfk_1` FOREIGN KEY (`idUsers`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `problemes_technique_info`
--
ALTER TABLE `problemes_technique_info`
  ADD CONSTRAINT `problemes_technique_info_ibfk_1` FOREIGN KEY (`idPbTech`) REFERENCES `problemes_technique` (`id`),
  ADD CONSTRAINT `problemes_technique_info_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`infoId`) REFERENCES `userinfos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
