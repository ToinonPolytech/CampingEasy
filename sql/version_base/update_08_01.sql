-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Dim 08 Janvier 2017 à 02:11
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
-- Structure de la table `lieu_commun`
--

CREATE TABLE `lieu_commun` (
  `id` int(255) NOT NULL,
  `nom` varchar(75) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `lieu_commun`
--
ALTER TABLE `lieu_commun`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `lieu_commun`
--
ALTER TABLE `lieu_commun`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
  
 ALTER TABLE `equipe` ADD `score` INT(255) NOT NULL DEFAULT '0' AFTER `nom`;
 
 --
-- Base de données :  `camping_facile`
--

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

CREATE TABLE `partenaire` (
  `id` int(255) NOT NULL,
  `nom` varchar(75) NOT NULL,
  `description` text NOT NULL,
  `mail` varchar(75) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `telephone` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `partenaire`
--
ALTER TABLE `partenaire`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `partenaire`
--
ALTER TABLE `partenaire`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
  
 ALTER TABLE `activities` ADD `ageMin` INT(3) NOT NULL AFTER `prix`;
 ALTER TABLE `activities` ADD `ageMax` INT(3) NOT NULL AFTER `ageMin`;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;