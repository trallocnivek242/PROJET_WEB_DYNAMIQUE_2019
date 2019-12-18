-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 18 déc. 2019 à 13:36
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `atelier_b4`
--

-- --------------------------------------------------------

--
-- Structure de la table `membre_de`
--

DROP TABLE IF EXISTS `membre_de`;
CREATE TABLE IF NOT EXISTS `membre_de` (
  `idProfil` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  KEY `fkIdx_25` (`idProfil`),
  KEY `fkIdx_81` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `idProfil` int(11) NOT NULL AUTO_INCREMENT,
  `nom` char(50) NOT NULL,
  `description` char(50) NOT NULL,
  `accesClient` int(11) NOT NULL,
  `accesProfil` int(11) NOT NULL,
  PRIMARY KEY (`idProfil`),
  KEY `Ind_31` (`idProfil`),
  KEY `idProfil` (`idProfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `login` char(25) NOT NULL,
  `pwd` char(25) NOT NULL,
  `mail` char(50) NOT NULL,
  `GoogleAuth` char(50) NOT NULL,
  PRIMARY KEY (`idUser`),
  KEY `idUser` (`idUser`),
  KEY `idUser_2` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `membre_de`
--
ALTER TABLE `membre_de`
  ADD CONSTRAINT `FK_24` FOREIGN KEY (`idProfil`) REFERENCES `profil` (`idProfil`),
  ADD CONSTRAINT `FK_81` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
