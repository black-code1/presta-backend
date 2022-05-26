-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 26 mai 2022 à 16:56
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `service`
--

-- --------------------------------------------------------

--
-- Structure de la table `ACHEIVMENT`
--

CREATE TABLE `ACHEIVMENT` (
  `ACH_ID` bigint(4) NOT NULL,
  `USER_ID` bigint(4) NOT NULL,
  `SERV_ID` bigint(4) NOT NULL,
  `ACH_NAME` varchar(255) DEFAULT NULL,
  `ACH_DESC` varchar(25550) DEFAULT NULL,
  `ACH_DATE` bigint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `IMAGES`
--

CREATE TABLE `IMAGES` (
  `IMG_ID` int(11) NOT NULL,
  `IMG_ORIGIN_ID` bigint(20) NOT NULL,
  `IMG_NAME` varchar(500) NOT NULL,
  `IMG_FORMAT` varchar(30) NOT NULL,
  `IMG_DATE` date NOT NULL,
  `IMG_ORIGIN_NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `MESSAGE`
--

CREATE TABLE `MESSAGE` (
  `MESS_ID` bigint(4) NOT NULL,
  `USER_ID_SENDER` bigint(4) NOT NULL,
  `USER_ID_RECEIVER` bigint(20) NOT NULL,
  `MESS_CONTENT` varchar(25550) DEFAULT NULL,
  `MESS_DATE` datetime DEFAULT NULL,
  `MESS_TYPE` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `PROVIDE`
--

CREATE TABLE `PROVIDE` (
  `USER_ID` bigint(4) NOT NULL,
  `SERV_ID` bigint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `SERVICE`
--

CREATE TABLE `SERVICE` (
  `SERV_ID` bigint(4) NOT NULL,
  `SERV_NAME` varchar(255) DEFAULT NULL,
  `SERV_DESC` varchar(25550) DEFAULT NULL,
  `SERV_ADD_DATE` datetime DEFAULT NULL,
  `SERV_TYPE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `USER`
--

CREATE TABLE `USER` (
  `USER_ID` bigint(4) NOT NULL,
  `UG_ID` bigint(4) NOT NULL,
  `USER_ID_CREATE` bigint(4) NOT NULL,
  `USERNAME` char(32) DEFAULT NULL,
  `PASSWORD` char(32) DEFAULT NULL,
  `NAME` char(32) DEFAULT NULL,
  `SURNAME` char(32) DEFAULT NULL,
  `GENDER` char(32) DEFAULT NULL,
  `PHONE_NUMBER` char(32) DEFAULT NULL,
  `EMAIL` char(32) DEFAULT NULL,
  `ADDRESS` char(32) DEFAULT NULL,
  `LONGITUDE` double(13,2) DEFAULT NULL,
  `LATITUDE` double(13,2) DEFAULT NULL,
  `STATE` char(32) DEFAULT NULL,
  `STATUS` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `USERGROUP`
--

CREATE TABLE `USERGROUP` (
  `UG_ID` bigint(4) NOT NULL,
  `UG_NAME` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `VOTE`
--

CREATE TABLE `VOTE` (
  `VOTE_ID` bigint(4) NOT NULL,
  `USER_ID` bigint(4) NOT NULL,
  `USER_ID_CONCERNED` bigint(4) NOT NULL,
  `VOTE_NOTE` bigint(4) DEFAULT NULL,
  `VOTE_DATE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ACHEIVMENT`
--
ALTER TABLE `ACHEIVMENT`
  ADD PRIMARY KEY (`ACH_ID`),
  ADD KEY `I_FK_ACHEIVMENT_USER` (`USER_ID`),
  ADD KEY `I_FK_ACHEIVMENT_SERVICE` (`SERV_ID`);

--
-- Index pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD PRIMARY KEY (`MESS_ID`),
  ADD KEY `I_FK_MESSAGE_USER` (`USER_ID_SENDER`);

--
-- Index pour la table `PROVIDE`
--
ALTER TABLE `PROVIDE`
  ADD PRIMARY KEY (`USER_ID`,`SERV_ID`),
  ADD KEY `I_FK_PROVIDE_USER` (`USER_ID`),
  ADD KEY `I_FK_PROVIDE_SERVICE` (`SERV_ID`);

--
-- Index pour la table `SERVICE`
--
ALTER TABLE `SERVICE`
  ADD PRIMARY KEY (`SERV_ID`);

--
-- Index pour la table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`USER_ID`),
  ADD KEY `I_FK_USER_USERGROUP` (`UG_ID`),
  ADD KEY `I_FK_USER_USER` (`USER_ID_CREATE`);

--
-- Index pour la table `USERGROUP`
--
ALTER TABLE `USERGROUP`
  ADD PRIMARY KEY (`UG_ID`);

--
-- Index pour la table `VOTE`
--
ALTER TABLE `VOTE`
  ADD PRIMARY KEY (`VOTE_ID`),
  ADD KEY `I_FK_VOTE_USER` (`USER_ID`),
  ADD KEY `I_FK_VOTE_USER1` (`USER_ID_CONCERNED`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ACHEIVMENT`
--
ALTER TABLE `ACHEIVMENT`
  MODIFY `ACH_ID` bigint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  MODIFY `MESS_ID` bigint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `SERVICE`
--
ALTER TABLE `SERVICE`
  MODIFY `SERV_ID` bigint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `USER`
--
ALTER TABLE `USER`
  MODIFY `USER_ID` bigint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `USERGROUP`
--
ALTER TABLE `USERGROUP`
  MODIFY `UG_ID` bigint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `VOTE`
--
ALTER TABLE `VOTE`
  MODIFY `VOTE_ID` bigint(4) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ACHEIVMENT`
--
ALTER TABLE `ACHEIVMENT`
  ADD CONSTRAINT `FK_ACHEIVMENT_SERVICE` FOREIGN KEY (`SERV_ID`) REFERENCES `SERVICE` (`SERV_ID`),
  ADD CONSTRAINT `FK_ACHEIVMENT_USER` FOREIGN KEY (`USER_ID`) REFERENCES `USER` (`USER_ID`);

--
-- Contraintes pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD CONSTRAINT `FK_MESSAGE_USER` FOREIGN KEY (`USER_ID_SENDER`) REFERENCES `USER` (`USER_ID`);

--
-- Contraintes pour la table `PROVIDE`
--
ALTER TABLE `PROVIDE`
  ADD CONSTRAINT `FK_PROVIDE_SERVICE` FOREIGN KEY (`SERV_ID`) REFERENCES `SERVICE` (`SERV_ID`),
  ADD CONSTRAINT `FK_PROVIDE_USER` FOREIGN KEY (`USER_ID`) REFERENCES `USER` (`USER_ID`);

--
-- Contraintes pour la table `USER`
--
ALTER TABLE `USER`
  ADD CONSTRAINT `FK_USER_USER` FOREIGN KEY (`USER_ID_CREATE`) REFERENCES `USER` (`USER_ID`),
  ADD CONSTRAINT `FK_USER_USERGROUP` FOREIGN KEY (`UG_ID`) REFERENCES `USERGROUP` (`UG_ID`);

--
-- Contraintes pour la table `VOTE`
--
ALTER TABLE `VOTE`
  ADD CONSTRAINT `FK_VOTE_USER` FOREIGN KEY (`USER_ID`) REFERENCES `USER` (`USER_ID`),
  ADD CONSTRAINT `FK_VOTE_USER1` FOREIGN KEY (`USER_ID_CONCERNED`) REFERENCES `USER` (`USER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
