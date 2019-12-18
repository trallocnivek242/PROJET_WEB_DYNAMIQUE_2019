-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 18 déc. 2019 à 14:15
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
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `idAdresse` int(11) NOT NULL AUTO_INCREMENT,
  `rue` char(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `idVille` int(11) NOT NULL,
  PRIMARY KEY (`idAdresse`),
  KEY `fkIdx_208` (`idVille`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chanti-interv`
--

DROP TABLE IF EXISTS `chanti-interv`;
CREATE TABLE IF NOT EXISTS `chanti-interv` (
  `idChantier` int(11) NOT NULL,
  `idInt` int(11) NOT NULL,
  KEY `fkIdx_184` (`idChantier`),
  KEY `fkIdx_187` (`idInt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chantier`
--

DROP TABLE IF EXISTS `chantier`;
CREATE TABLE IF NOT EXISTS `chantier` (
  `idChantier` int(11) NOT NULL AUTO_INCREMENT,
  `idAdresse` int(11) NOT NULL,
  `Description` char(50) NOT NULL,
  PRIMARY KEY (`idChantier`),
  KEY `fkIdx_128` (`idAdresse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chanti_contrat`
--

DROP TABLE IF EXISTS `chanti_contrat`;
CREATE TABLE IF NOT EXISTS `chanti_contrat` (
  `idChantier` int(11) NOT NULL,
  `idContrat` int(11) NOT NULL,
  PRIMARY KEY (`idChantier`,`idContrat`),
  KEY `fkIdx_149` (`idChantier`),
  KEY `fkIdx_152` (`idContrat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chanti_pv`
--

DROP TABLE IF EXISTS `chanti_pv`;
CREATE TABLE IF NOT EXISTS `chanti_pv` (
  `idChantier` int(11) NOT NULL,
  `idPV` int(11) NOT NULL,
  PRIMARY KEY (`idChantier`,`idPV`),
  KEY `fkIdx_135` (`idChantier`),
  KEY `fkIdx_138` (`idPV`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idCli` int(11) NOT NULL AUTO_INCREMENT,
  `AdrMail` char(50) NOT NULL,
  `idAdresse` int(11) NOT NULL,
  `Nom` char(50) NOT NULL,
  `Prenom` char(50) NOT NULL,
  `tel` int(11) NOT NULL,
  `sexe` char(50) NOT NULL,
  PRIMARY KEY (`idCli`),
  KEY `fkIdx_74` (`idAdresse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client_mail`
--

DROP TABLE IF EXISTS `client_mail`;
CREATE TABLE IF NOT EXISTS `client_mail` (
  `idCli` int(11) NOT NULL,
  `idMail` int(11) NOT NULL,
  PRIMARY KEY (`idCli`,`idMail`),
  KEY `fkIdx_113` (`idMail`),
  KEY `fkIdx_95` (`idCli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

DROP TABLE IF EXISTS `contrat`;
CREATE TABLE IF NOT EXISTS `contrat` (
  `idContrat` int(11) NOT NULL AUTO_INCREMENT,
  `contrat` char(50) NOT NULL,
  PRIMARY KEY (`idContrat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contrat_client`
--

DROP TABLE IF EXISTS `contrat_client`;
CREATE TABLE IF NOT EXISTS `contrat_client` (
  `idContrat` int(11) NOT NULL,
  `idCli` int(11) NOT NULL,
  PRIMARY KEY (`idContrat`,`idCli`),
  KEY `fkIdx_156` (`idContrat`),
  KEY `fkIdx_159` (`idCli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `corps_metier`
--

DROP TABLE IF EXISTS `corps_metier`;
CREATE TABLE IF NOT EXISTS `corps_metier` (
  `idCM` int(11) NOT NULL AUTO_INCREMENT,
  `nom` char(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`idCM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `intervenant`
--

DROP TABLE IF EXISTS `intervenant`;
CREATE TABLE IF NOT EXISTS `intervenant` (
  `idInt` int(11) NOT NULL AUTO_INCREMENT,
  `AdrMail` char(50) NOT NULL,
  `idAdresse_int_fk` int(11) NOT NULL,
  `idCM` int(11) NOT NULL,
  PRIMARY KEY (`idInt`),
  KEY `fkIdx_180` (`idCM`),
  KEY `fkIdx_86` (`idAdresse_int_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `interv_mail`
--

DROP TABLE IF EXISTS `interv_mail`;
CREATE TABLE IF NOT EXISTS `interv_mail` (
  `idInt_fk` int(11) NOT NULL,
  `idMail_fk` int(11) NOT NULL,
  KEY `fkIdx_117` (`idInt_fk`),
  KEY `fkIdx_120` (`idMail_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mail`
--

DROP TABLE IF EXISTS `mail`;
CREATE TABLE IF NOT EXISTS `mail` (
  `idMail` int(11) NOT NULL AUTO_INCREMENT,
  `mail` char(50) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`idMail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Structure de la table `metre`
--

DROP TABLE IF EXISTS `metre`;
CREATE TABLE IF NOT EXISTS `metre` (
  `idMetre` int(11) NOT NULL AUTO_INCREMENT,
  `metre` char(50) NOT NULL,
  PRIMARY KEY (`idMetre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `metre_contrat`
--

DROP TABLE IF EXISTS `metre_contrat`;
CREATE TABLE IF NOT EXISTS `metre_contrat` (
  `idMetre` int(11) NOT NULL,
  `idContrat` int(11) NOT NULL,
  PRIMARY KEY (`idMetre`,`idContrat`),
  KEY `fkIdx_195` (`idMetre`),
  KEY `fkIdx_198` (`idContrat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `prestations`
--

DROP TABLE IF EXISTS `prestations`;
CREATE TABLE IF NOT EXISTS `prestations` (
  `idPrest` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `durée` int(11) NOT NULL,
  `idUser_fk` int(11) NOT NULL,
  `idContrat_prest_fk` int(11) NOT NULL,
  PRIMARY KEY (`idPrest`),
  KEY `fkIdx_165` (`idUser_fk`),
  KEY `fkIdx_168` (`idContrat_prest_fk`)
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
-- Structure de la table `pv`
--

DROP TABLE IF EXISTS `pv`;
CREATE TABLE IF NOT EXISTS `pv` (
  `idPV` int(11) NOT NULL AUTO_INCREMENT,
  `pv` char(50) NOT NULL,
  PRIMARY KEY (`idPV`)
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

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `idVille` int(11) NOT NULL AUTO_INCREMENT,
  `cp` int(11) NOT NULL,
  `nom` char(50) NOT NULL,
  PRIMARY KEY (`idVille`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `FK_208` FOREIGN KEY (`idVille`) REFERENCES `ville` (`idVille`);

--
-- Contraintes pour la table `chanti-interv`
--
ALTER TABLE `chanti-interv`
  ADD CONSTRAINT `FK_184` FOREIGN KEY (`idChantier`) REFERENCES `chantier` (`idChantier`),
  ADD CONSTRAINT `FK_187` FOREIGN KEY (`idInt`) REFERENCES `intervenant` (`idInt`);

--
-- Contraintes pour la table `chantier`
--
ALTER TABLE `chantier`
  ADD CONSTRAINT `FK_128` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`idAdresse`);

--
-- Contraintes pour la table `chanti_contrat`
--
ALTER TABLE `chanti_contrat`
  ADD CONSTRAINT `FK_149` FOREIGN KEY (`idChantier`) REFERENCES `chantier` (`idChantier`),
  ADD CONSTRAINT `FK_152` FOREIGN KEY (`idContrat`) REFERENCES `contrat` (`idContrat`);

--
-- Contraintes pour la table `chanti_pv`
--
ALTER TABLE `chanti_pv`
  ADD CONSTRAINT `FK_135` FOREIGN KEY (`idChantier`) REFERENCES `chantier` (`idChantier`),
  ADD CONSTRAINT `FK_138` FOREIGN KEY (`idPV`) REFERENCES `pv` (`idPV`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_74` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`idAdresse`);

--
-- Contraintes pour la table `client_mail`
--
ALTER TABLE `client_mail`
  ADD CONSTRAINT `FK_113` FOREIGN KEY (`idMail`) REFERENCES `mail` (`idMail`),
  ADD CONSTRAINT `FK_95` FOREIGN KEY (`idCli`) REFERENCES `client` (`idCli`);

--
-- Contraintes pour la table `contrat_client`
--
ALTER TABLE `contrat_client`
  ADD CONSTRAINT `FK_156` FOREIGN KEY (`idContrat`) REFERENCES `contrat` (`idContrat`),
  ADD CONSTRAINT `FK_159` FOREIGN KEY (`idCli`) REFERENCES `client` (`idCli`);

--
-- Contraintes pour la table `intervenant`
--
ALTER TABLE `intervenant`
  ADD CONSTRAINT `FK_180` FOREIGN KEY (`idCM`) REFERENCES `corps_metier` (`idCM`),
  ADD CONSTRAINT `FK_86` FOREIGN KEY (`idAdresse_int_fk`) REFERENCES `adresse` (`idAdresse`);

--
-- Contraintes pour la table `interv_mail`
--
ALTER TABLE `interv_mail`
  ADD CONSTRAINT `FK_117` FOREIGN KEY (`idInt_fk`) REFERENCES `intervenant` (`idInt`),
  ADD CONSTRAINT `FK_120` FOREIGN KEY (`idMail_fk`) REFERENCES `mail` (`idMail`);

--
-- Contraintes pour la table `membre_de`
--
ALTER TABLE `membre_de`
  ADD CONSTRAINT `FK_24` FOREIGN KEY (`idProfil`) REFERENCES `profil` (`idProfil`),
  ADD CONSTRAINT `FK_81` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Contraintes pour la table `metre_contrat`
--
ALTER TABLE `metre_contrat`
  ADD CONSTRAINT `FK_195` FOREIGN KEY (`idMetre`) REFERENCES `metre` (`idMetre`),
  ADD CONSTRAINT `FK_198` FOREIGN KEY (`idContrat`) REFERENCES `contrat` (`idContrat`);

--
-- Contraintes pour la table `prestations`
--
ALTER TABLE `prestations`
  ADD CONSTRAINT `FK_165` FOREIGN KEY (`idUser_fk`) REFERENCES `user` (`idUser`),
  ADD CONSTRAINT `FK_168` FOREIGN KEY (`idContrat_prest_fk`) REFERENCES `contrat` (`idContrat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
