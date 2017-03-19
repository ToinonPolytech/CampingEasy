-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 18 Mars 2017 à 23:31
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
-- Structure de la table `etat_lieux`
--

CREATE TABLE `etat_lieux` (
  `id` int(255) NOT NULL,
  `idUser` int(255) NOT NULL,
  `debutTime` int(255) NOT NULL,
  `finTime` int(255) NOT NULL,
  `duree_moyenne` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `etat_lieux`
--
ALTER TABLE `etat_lieux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `etat_lieux`
--
ALTER TABLE `etat_lieux`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `userinfos` ADD `comptesMax` INT(255) NOT NULL DEFAULT '1' AFTER `clef`;
  
 --
-- Structure de la table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `capacite` int(255) NOT NULL,
  `heureOuverture` varchar(4) NOT NULL,
  `heureFermeture` varchar(4) NOT NULL,
  `photos` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
  
 ALTER TABLE `equipe_membres` ADD `peutModifier` BOOLEAN NOT NULL DEFAULT FALSE AFTER `idUser`;
 ALTER TABLE `activities` ADD `idRecurrente` INT(255) NOT NULL DEFAULT '-1' AFTER `photos`;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
