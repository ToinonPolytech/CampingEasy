-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Ven 10 Février 2017 à 02:27
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
-- Structure de la table `problemes_technique_info`
--

CREATE TABLE `problemes_technique_info` (
  `id` int(255) NOT NULL,
  `idPbTech` int(255) NOT NULL,
  `idUser` int(255) NOT NULL,
  `time` int(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `problemes_technique_info`
--
ALTER TABLE `problemes_technique_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPbTech` (`idPbTech`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `problemes_technique_info`
--
ALTER TABLE `problemes_technique_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `problemes_technique_info`
--
ALTER TABLE `problemes_technique_info`
  ADD CONSTRAINT `problemes_technique_info_ibfk_1` FOREIGN KEY (`idPbTech`) REFERENCES `problemes_technique` (`id`),
  ADD CONSTRAINT `problemes_technique_info_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

  ALTER TABLE `problemes_technique` CHANGE `solved` `solved` ENUM('NON_RESOLU','EN_COURS','RESOLU','') NOT NULL;
  
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
