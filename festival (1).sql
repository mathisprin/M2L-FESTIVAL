-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 30 sep. 2019 à 11:47
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
-- Base de données :  `festival`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `nom` varchar(250) NOT NULL,
  `id` varchar(8) NOT NULL,
  `motdepasse` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`nom`, `id`, `motdepasse`) VALUES
('admin', '11112222', '$2y$10$J7TncI0McaNwxtRi6u9GeePqvQ1KGSki4K/RxDd/AEj3eOBUl0HO.');

-- --------------------------------------------------------

--
-- Structure de la table `attribution`
--

DROP TABLE IF EXISTS `attribution`;
CREATE TABLE IF NOT EXISTS `attribution` (
  `idEtab` char(8) NOT NULL,
  `idGroupe` char(4) NOT NULL,
  `nombreChambres` int(11) NOT NULL,
  PRIMARY KEY (`idEtab`,`idGroupe`),
  KEY `fk2_Attribution` (`idGroupe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `attribution`
--

INSERT INTO `attribution` (`idEtab`, `idGroupe`, `nombreChambres`) VALUES
('0350123A', 'g001', 13),
('0350123A', 'g002', 17),
('0350123A', 'g004', 13),
('0350123A', 'g005', 8),
('0350123A', 'g006', 1),
('0350785N', 'g001', 1),
('0350785N', 'g002', 9),
('0350785N', 'g008', 10),
('0351234W', 'g001', 3),
('0351234W', 'g006', 10),
('0351234W', 'g007', 7);

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `id` char(8) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `adresseRue` varchar(45) NOT NULL,
  `codePostal` char(5) NOT NULL,
  `ville` varchar(35) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `adresseElectronique` varchar(70) DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `civiliteResponsable` varchar(12) NOT NULL,
  `nomResponsable` varchar(25) NOT NULL,
  `prenomResponsable` varchar(25) DEFAULT NULL,
  `nombreChambresOffertes` int(11) DEFAULT NULL,
  `infosP` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etablissement`
--

INSERT INTO `etablissement` (`id`, `nom`, `adresseRue`, `codePostal`, `ville`, `tel`, `adresseElectronique`, `type`, `civiliteResponsable`, `nomResponsable`, `prenomResponsable`, `nombreChambresOffertes`, `infosP`) VALUES
('0350123A', 'Ibis Hotel ', '3, avenue des corsaires', '77778', 'Paramé', '8445145484', '', 1, 'Mme', 'Lefort', 'Anne', 58, 'Cadre très chaleureux permettant le repos et le confort à petit prix'),
('0350785N', 'Collège de Moka', '2 avenue Aristide Briand BP 6', '35401', 'Saint-Malo', '0299206990', NULL, 1, 'M.', 'Dupont', 'Alain', 20, ''),
('0351234W', 'Collège Léonard de Vinci', '2 rue Rabelais', '35418', 'Saint-Malo', '0299117474', NULL, 1, 'M.', 'Durand', 'Pierre', 60, ''),
('44444444', 'test', 'test', '78770', 'test', '0130410513', 'vdepatureaux@gmail.com', 1, 'M', 'test', 'test', 80, 'knhcbhdvj');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id` char(4) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `identiteResponsable` varchar(40) DEFAULT NULL,
  `adressePostale` varchar(120) DEFAULT NULL,
  `nombrePersonnes` int(11) NOT NULL,
  `nomPays` varchar(40) NOT NULL,
  `hebergement` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom`, `identiteResponsable`, `adressePostale`, `nombrePersonnes`, `nomPays`, `hebergement`) VALUES
('g001', 'Groupe basket de Dijon', NULL, NULL, 40, 'Bachkirie', 'O'),
('g002', 'Groupe de football Lyonnais', NULL, NULL, 25, 'Bolivie', 'O'),
('g003', 'Rudby Club Nancy', NULL, NULL, 34, 'Brésil', 'O'),
('g004', 'Tennis de table Club', NULL, NULL, 38, 'Bulgarie', 'O'),
('g005', 'Volley ball Rennes', NULL, NULL, 22, 'Cameroun', 'O'),
('g006', 'Handball Club Paris', NULL, NULL, 29, 'Corée du Sud', 'O'),
('g007', 'Quidich Poudlard', NULL, NULL, 19, 'Ecosse', 'O'),
('g008', 'Fight Club', NULL, NULL, 5, 'Espagne', 'O'),
('g009', 'Club de danse de Orléans', NULL, NULL, 21, 'Jersey', 'O'),
('g010', 'Bras de Fer chinois', NULL, NULL, 30, 'Emirats arabes unis', 'O'),
('g011', 'Danse classique Paris', NULL, NULL, 38, 'Mexique', 'O'),
('g012', 'Groupe folklorique de Panama', NULL, NULL, 22, 'Panama', 'O'),
('g013', 'Atelier de Programmation', NULL, NULL, 13, 'Papouasie', 'O'),
('g014', 'Ligue Esport', NULL, NULL, 26, 'Paraguay', 'O'),
('g015', 'GRS athlétique Club', NULL, NULL, 8, 'Québec', 'O'),
('g016', 'Gymnastique ', NULL, NULL, 40, 'République de Bachkirie', 'O'),
('g017', 'Groupe folklorique turc', NULL, NULL, 40, 'Turquie', 'O'),
('g018', 'Groupe folklorique russe', NULL, NULL, 43, 'Russie', 'O'),
('g019', 'Football Américain', NULL, NULL, 27, 'Sri Lanka', 'O'),
('g020', 'Tennis Club Lille', NULL, NULL, 34, 'France - Provence', 'O'),
('g021', 'Club de natation ST Germain', NULL, NULL, 40, 'France - Provence', 'O'),
('g022', 'Hockey sur glace Cergy', NULL, NULL, 1, 'France - Bretagne', 'O'),
('g023', 'Haltérophilie en Salle ', NULL, NULL, 5, 'France - Bretagne', 'O'),
('g024', 'Equitation ', NULL, NULL, 5, 'France - Bretagne', 'O'),
('g025', 'SkateBoard Contest', NULL, NULL, 2, 'France - Bretagne', 'O'),
('g026', 'Cercle Gwik Alet', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g027', 'Bagad Quic En Groigne', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g028', 'Penn Treuz', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g029', 'Savidan Launay', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g030', 'Cercle Boked Er Lann', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g031', 'Bagad Montfortais', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g032', 'Vent de Noroise', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g033', 'Cercle Strollad', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g034', 'Bagad An Hanternoz', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g035', 'Cercle Ar Vro Melenig', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g036', 'Cercle An Abadenn Nevez', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g037', 'Kerc\'h Keltiek Roazhon', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g038', 'Bagad Plougastel', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g039', 'Bagad Nozeganed Bro Porh-Loeiz', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g040', 'Bagad Nozeganed Bro Porh-Loeiz', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g041', 'Jackie Molard Quartet', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g042', 'Deomp', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g043', 'Cercle Olivier de Clisson', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g044', 'Kan Tri', NULL, NULL, 0, 'France - Bretagne', 'N');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attribution`
--
ALTER TABLE `attribution`
  ADD CONSTRAINT `fk1_Attribution` FOREIGN KEY (`idEtab`) REFERENCES `etablissement` (`id`),
  ADD CONSTRAINT `fk2_Attribution` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
