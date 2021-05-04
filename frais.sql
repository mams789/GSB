-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 04 mai 2021 à 04:08
-- Version du serveur :  10.4.15-MariaDB
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `u423822106_frais`
--

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id` char(2) NOT NULL,
  `libelle` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
('CL', 'Saisie clôturée'),
('CR', 'Fiche créée, saisie en cours'),
('MP', 'Mise en paiement'),
('RB', 'Remboursée'),
('VA', 'Validée');

-- --------------------------------------------------------

--
-- Structure de la table `fichefrais`
--

CREATE TABLE `fichefrais` (
  `idvisiteur` char(4) NOT NULL,
  `mois` char(6) NOT NULL,
  `nbjustificatifs` int(11) DEFAULT NULL,
  `montantvalide` decimal(10,2) DEFAULT NULL,
  `datemodif` date DEFAULT NULL,
  `idetat` char(2) DEFAULT 'CR'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fichefrais`
--

INSERT INTO `fichefrais` (`idvisiteur`, `mois`, `nbjustificatifs`, `montantvalide`, `datemodif`, `idetat`) VALUES
('a131', '202102', 0, '170.00', '2021-05-04', 'MP'),
('a131', '202103', 0, '139.00', '2021-04-07', 'RB'),
('a131', '202104', 3, '0.00', '2021-04-05', 'CL'),
('a131', '202105', 0, '0.00', '2021-04-04', 'CR'),
('a17', '202104', 2, '921.00', '2021-04-07', 'CL'),
('a17', '202105', 0, '0.00', '2021-04-03', 'CR'),
('a55', '202101', 0, '142.00', '2021-04-07', 'RB'),
('a55', '202104', 0, '0.00', '2021-04-05', 'CL'),
('a93', '202103', 1, '0.00', '2021-02-28', 'CL'),
('a93', '202104', 0, '0.00', '2021-04-05', 'CL'),
('b13', '202104', 0, '0.00', '2021-04-07', 'CL'),
('b16', '202101', 0, '113.00', '2021-04-07', 'RB'),
('b16', '202102', 0, '92.00', '2021-04-07', 'RB'),
('b19', '202104', 0, '0.00', '2021-04-05', 'CL'),
('b25', '202104', 0, '0.00', '2021-04-07', 'CL'),
('b28', '202104', 0, '0.00', '2021-04-07', 'CL'),
('b34', '202101', 0, '130.00', '2021-04-07', 'RB'),
('b34', '202102', 0, '771.00', '2021-04-07', 'RB'),
('b34', '202104', 0, '0.00', '2021-04-07', 'CL'),
('b4', '202104', 0, '0.00', '2021-04-07', 'CL'),
('b50', '202104', 0, '0.00', '2021-04-07', 'CL'),
('b59', '202104', 0, '0.00', '2021-04-07', 'CL'),
('c14', '202104', 0, '0.00', '2021-04-07', 'CL'),
('c3', '202104', 0, '0.00', '2021-04-07', 'CL'),
('c54', '202104', 0, '5500.00', '2021-05-04', 'VA'),
('d13', '202104', 0, '0.00', '2021-04-07', 'CL'),
('d51', '202104', 0, '0.00', '2021-04-07', 'CL'),
('e22', '202104', 0, '0.00', '2021-04-07', 'CL'),
('e24', '202104', 0, '0.00', '2021-04-07', 'CL'),
('e39', '202104', 0, '0.00', '2021-04-07', 'CL'),
('e49', '202104', 0, '0.00', '2021-04-07', 'CL'),
('e5', '202104', 0, '0.00', '2021-04-07', 'CL'),
('e52', '202104', 0, '0.00', '2021-04-07', 'CL'),
('f21', '202104', 0, '0.00', '2021-04-07', 'CL'),
('f319', '202104', 0, '0.00', '2021-04-07', 'CL'),
('f4', '202104', 0, '0.00', '2021-04-07', 'CL');

-- --------------------------------------------------------

--
-- Structure de la table `fraisforfait`
--

CREATE TABLE `fraisforfait` (
  `id` char(3) NOT NULL,
  `libelle` char(20) DEFAULT NULL,
  `montant` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fraisforfait`
--

INSERT INTO `fraisforfait` (`id`, `libelle`, `montant`) VALUES
('ETP', 'Forfait Etape', '110.00'),
('KM', 'Frais Kilométrique', '0.62'),
('NUI', 'Nuitée Hôtel', '80.00'),
('REP', 'Repas Restaurant', '25.00');

-- --------------------------------------------------------

--
-- Structure de la table `lignefraisforfait`
--

CREATE TABLE `lignefraisforfait` (
  `idvisiteur` char(4) NOT NULL,
  `mois` char(6) NOT NULL,
  `idfraisforfait` char(3) NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lignefraisforfait`
--

INSERT INTO `lignefraisforfait` (`idvisiteur`, `mois`, `idfraisforfait`, `quantite`) VALUES
('a131', '202102', 'ETP', 13),
('a131', '202102', 'KM', 66),
('a131', '202102', 'NUI', 65),
('a131', '202102', 'REP', 26),
('a131', '202103', 'ETP', 7),
('a131', '202103', 'KM', 7),
('a131', '202103', 'NUI', 77),
('a131', '202103', 'REP', 48),
('a131', '202104', 'ETP', 1),
('a131', '202104', 'KM', 20),
('a131', '202104', 'NUI', 3),
('a131', '202104', 'REP', 4),
('a131', '202105', 'ETP', 0),
('a131', '202105', 'KM', 0),
('a131', '202105', 'NUI', 0),
('a131', '202105', 'REP', 0),
('a17', '202104', 'ETP', 892),
('a17', '202104', 'KM', 3),
('a17', '202104', 'NUI', 2),
('a17', '202104', 'REP', 4),
('a17', '202105', 'ETP', 0),
('a17', '202105', 'KM', 0),
('a17', '202105', 'NUI', 0),
('a17', '202105', 'REP', 0),
('a55', '202101', 'ETP', 13),
('a55', '202101', 'KM', 62),
('a55', '202101', 'NUI', 65),
('a55', '202101', 'REP', 2),
('a55', '202104', 'ETP', 12),
('a55', '202104', 'KM', 300),
('a55', '202104', 'NUI', 27),
('a55', '202104', 'REP', 9),
('a93', '202103', 'ETP', 6),
('a93', '202103', 'KM', 81),
('a93', '202103', 'NUI', 77),
('a93', '202103', 'REP', 332),
('a93', '202104', 'ETP', 2),
('a93', '202104', 'KM', 20),
('a93', '202104', 'NUI', 30),
('a93', '202104', 'REP', 25),
('b13', '202104', 'ETP', 30),
('b13', '202104', 'KM', 50),
('b13', '202104', 'NUI', 60),
('b13', '202104', 'REP', 40),
('b16', '202101', 'ETP', 45),
('b16', '202101', 'KM', 23),
('b16', '202101', 'NUI', 30),
('b16', '202101', 'REP', 15),
('b16', '202102', 'ETP', 27),
('b16', '202102', 'KM', 30),
('b16', '202102', 'NUI', 15),
('b16', '202102', 'REP', 20),
('b19', '202104', 'ETP', 78),
('b19', '202104', 'KM', 89),
('b19', '202104', 'NUI', 6),
('b19', '202104', 'REP', 8),
('b25', '202104', 'ETP', 50),
('b25', '202104', 'KM', 30),
('b25', '202104', 'NUI', 20),
('b25', '202104', 'REP', 15),
('b28', '202104', 'ETP', 50),
('b28', '202104', 'KM', 30),
('b28', '202104', 'NUI', 40),
('b28', '202104', 'REP', 35),
('b34', '202101', 'ETP', 20),
('b34', '202101', 'KM', 30),
('b34', '202101', 'NUI', 50),
('b34', '202101', 'REP', 30),
('b34', '202102', 'ETP', 678),
('b34', '202102', 'KM', 78),
('b34', '202102', 'NUI', 5),
('b34', '202102', 'REP', 10),
('b34', '202104', 'ETP', 50),
('b34', '202104', 'KM', 40),
('b34', '202104', 'NUI', 50),
('b34', '202104', 'REP', 29),
('b4', '202104', 'ETP', 89),
('b4', '202104', 'KM', 50),
('b4', '202104', 'NUI', 50),
('b4', '202104', 'REP', 45),
('b50', '202104', 'ETP', 80),
('b50', '202104', 'KM', 60),
('b50', '202104', 'NUI', 50),
('b50', '202104', 'REP', 40),
('b59', '202104', 'ETP', 70),
('b59', '202104', 'KM', 60),
('b59', '202104', 'NUI', 50),
('b59', '202104', 'REP', 40),
('c14', '202104', 'ETP', 80),
('c14', '202104', 'KM', 120),
('c14', '202104', 'NUI', 70),
('c14', '202104', 'REP', 40),
('c3', '202104', 'ETP', 80),
('c3', '202104', 'KM', 40),
('c3', '202104', 'NUI', 30),
('c3', '202104', 'REP', 15),
('c54', '202104', 'ETP', 50),
('c54', '202104', 'KM', 40),
('c54', '202104', 'NUI', 0),
('c54', '202104', 'REP', 0),
('d13', '202104', 'ETP', 100),
('d13', '202104', 'KM', 80),
('d13', '202104', 'NUI', 80),
('d13', '202104', 'REP', 50),
('d51', '202104', 'ETP', 60),
('d51', '202104', 'KM', 49),
('d51', '202104', 'NUI', 60),
('d51', '202104', 'REP', 40),
('e22', '202104', 'ETP', 60),
('e22', '202104', 'KM', 50),
('e22', '202104', 'NUI', 40),
('e22', '202104', 'REP', 15),
('e24', '202104', 'ETP', 60),
('e24', '202104', 'KM', 50),
('e24', '202104', 'NUI', 50),
('e24', '202104', 'REP', 35),
('e39', '202104', 'ETP', 80),
('e39', '202104', 'KM', 60),
('e39', '202104', 'NUI', 50),
('e39', '202104', 'REP', 39),
('e49', '202104', 'ETP', 40),
('e49', '202104', 'KM', 68),
('e49', '202104', 'NUI', 70),
('e49', '202104', 'REP', 50),
('e5', '202104', 'ETP', 12),
('e5', '202104', 'KM', 562),
('e5', '202104', 'NUI', 6),
('e5', '202104', 'REP', 27),
('e52', '202104', 'ETP', 8),
('e52', '202104', 'KM', 678),
('e52', '202104', 'NUI', 60),
('e52', '202104', 'REP', 40),
('f21', '202104', 'ETP', 9),
('f21', '202104', 'KM', 60),
('f21', '202104', 'NUI', 59),
('f21', '202104', 'REP', 40),
('f319', '202104', 'ETP', 100),
('f319', '202104', 'KM', 120),
('f319', '202104', 'NUI', 60),
('f319', '202104', 'REP', 50),
('f4', '202104', 'ETP', 80),
('f4', '202104', 'KM', 120),
('f4', '202104', 'NUI', 60),
('f4', '202104', 'REP', 40);

-- --------------------------------------------------------

--
-- Structure de la table `lignefraishorsforfait`
--

CREATE TABLE `lignefraishorsforfait` (
  `id` int(11) NOT NULL,
  `idvisiteur` char(4) NOT NULL,
  `mois` char(6) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lignefraishorsforfait`
--

INSERT INTO `lignefraishorsforfait` (`id`, `idvisiteur`, `mois`, `libelle`, `date`, `montant`) VALUES
(101, 'a93', '202103', 'veriff', '2021-02-24', '678.00'),
(117, 'a17', '202105', 'Taxi_Gare', '2021-04-02', '30.00'),
(121, 'a17', '202105', '0', '2021-04-01', '40.00'),
(123, 'a17', '202105', '0', '2021-04-01', '50.00'),
(124, 'a17', '202105', '0', '2021-04-02', '67.00'),
(128, 'a131', '202105', '9', '2021-02-04', '55.00'),
(129, 'b19', '202104', 'Taxi', '2021-04-03', '40.00'),
(130, 'a131', '202105', 'REFUSERTaxi', '2021-04-01', '50.00'),
(131, 'a131', '202104', 'Taxi', '2021-04-01', '67.00'),
(133, 'a131', '202104', 'SNCF_TGV', '2021-04-02', '78.00'),
(134, 'a17', '202104', 'REFUSERtaxi', '2021-04-02', '67.00'),
(135, 'a17', '202104', 'Parking', '2021-04-03', '20.00'),
(136, 'a93', '202104', 'Parking', '2021-04-03', '23.00'),
(137, 'a55', '202104', 'Restaurant', '2021-04-01', '40.00'),
(138, 'a55', '202104', 'medecin', '2021-04-03', '60.00'),
(139, 'b13', '202104', 'Ticket_metro', '2021-04-04', '5.00'),
(140, 'b25', '202104', 'Taxi_gare', '2021-03-29', '40.00'),
(141, 'b28', '202104', 'Repas_Gare', '2021-03-27', '15.00'),
(142, 'b34', '202104', 'Taxi', '2021-03-26', '50.00'),
(143, 'b4', '202104', 'Uber', '2021-03-29', '56.00'),
(144, 'b50', '202104', 'Taxi', '2021-03-27', '60.00'),
(145, 'b59', '202104', 'Ticket_metro', '2021-04-03', '10.00'),
(146, 'c14', '202104', 'Parking', '2021-03-27', '30.00'),
(147, 'd13', '202104', 'SNCF_TGV', '2021-03-31', '70.00'),
(148, 'd51', '202104', 'Ticket_metro', '2021-04-02', '4.00'),
(149, 'e22', '202104', 'Repas_matin', '2021-04-02', '5.00'),
(150, 'e24', '202104', 'Parking', '2021-03-28', '23.00'),
(151, 'e39', '202104', 'Achat', '2021-04-01', '30.00'),
(152, 'e49', '202104', 'Uber_Location', '2021-04-03', '30.00'),
(153, 'e5', '202104', 'Achat de fleurs', '2021-04-03', '27.00'),
(154, 'e52', '202104', 'TAXI', '2021-04-07', '40.00'),
(155, 'f21', '202104', 'Parking', '2021-04-03', '30.00'),
(156, 'f319', '202104', 'Ticket_metro', '2021-03-29', '4.00'),
(157, 'f4', '202104', 'TGV', '2021-04-02', '67.00');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nom` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `nom`) VALUES
(1, 'visiteur'),
(2, 'comptable');

-- --------------------------------------------------------

--
-- Structure de la table `visiteurs`
--

CREATE TABLE `visiteurs` (
  `id` char(4) NOT NULL,
  `nom` char(30) DEFAULT NULL,
  `prenom` char(30) DEFAULT NULL,
  `login` char(20) DEFAULT NULL,
  `mdp` char(20) DEFAULT NULL,
  `adresse` char(30) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL,
  `ville` char(30) DEFAULT NULL,
  `dateembauche` date DEFAULT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `visiteurs`
--

INSERT INTO `visiteurs` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateembauche`, `id_role`) VALUES
('a131', 'Villechalane', 'Louis', 'lvillachane', 'jux7g', '8 rue des Charmes', '46000', 'Cahors', '2005-12-21', 1),
('a17', 'Andre', 'David', 'dandre', 'oppg5', '1 rue Petit', '46200', 'Lalbenque', '1998-11-23', 2),
('a55', 'Bedos', 'Christian', 'cbedos', 'gmhxd', '1 rue Peranud', '46250', 'Montcuq', '1995-01-12', 1),
('a93', 'Tusseau', 'Louis', 'ltusseau', 'ktp3s', '22 rue des Ternes', '46123', 'Gramat', '2000-05-01', 1),
('b13', 'Bentot', 'Pascal', 'pbentot', 'doyw1', '11 allée des Cerises', '46512', 'Bessines', '1992-07-09', 1),
('b16', 'Bioret', 'Luc', 'lbioret', 'hrjfs', '1 Avenue gambetta', '46000', 'Cahors', '1998-05-11', 1),
('b19', 'Bunisset', 'Francis', 'fbunisset', '4vbnd', '10 rue des Perles', '93100', 'Montreuil', '1987-10-21', 1),
('b25', 'Bunisset', 'Denise', 'dbunisset', 's1y1r', '23 rue Manin', '75019', 'paris', '2010-12-05', 1),
('b28', 'Cacheux', 'Bernard', 'bcacheux', 'uf7r3', '114 rue Blanche', '75017', 'Paris', '2009-11-12', 1),
('b34', 'Cadic', 'Eric', 'ecadic', '6u8dc', '123 avenue de la République', '75011', 'Paris', '2008-09-23', 1),
('b4', 'Charoze', 'Catherine', 'ccharoze', 'u817o', '100 rue Petit', '75019', 'Paris', '2005-11-12', 1),
('b50', 'Clepkens', 'Christophe', 'cclepkens', 'bw1us', '12 allée des Anges', '93230', 'Romainville', '2003-08-11', 1),
('b59', 'Cottin', 'Vincenne', 'vcottin', '2hoh9', '36 rue Des Roches', '93100', 'Monteuil', '2001-11-18', 1),
('c14', 'Daburon', 'François', 'fdaburon', '7oqpv', '13 rue de Chanzy', '94000', 'Créteil', '2002-02-11', 1),
('c3', 'De', 'Philippe', 'pde', 'gk9kx', '13 rue Barthes', '94000', 'Créteil', '2010-12-14', 1),
('c54', 'Debelle', 'Michel', 'mdebelle', 'od5rt', '181 avenue Barbusse', '93210', 'Rosny', '2006-11-23', 1),
('d13', 'Debelle', 'Jeanne', 'jdebelle', 'nvwqq', '134 allée des Joncs', '44000', 'Nantes', '2000-05-11', 1),
('d51', 'Debroise', 'Michel', 'mdebroise', 'sghkb', '2 Bld Jourdain', '44000', 'Nantes', '2001-04-17', 1),
('e22', 'Desmarquest', 'Nathalie', 'ndesmarquest', 'f1fob', '14 Place d Arc', '45000', 'Orléans', '2005-11-12', 1),
('e24', 'Desnost', 'Pierre', 'pdesnost', '4k2o5', '16 avenue des Cèdres', '23200', 'Guéret', '2001-02-05', 1),
('e39', 'Dudouit', 'Frédéric', 'fdudouit', '44im8', '18 rue de l église', '23120', 'GrandBourg', '2000-08-01', 1),
('e49', 'Duncombe', 'Claude', 'cduncombe', 'qf77j', '19 rue de la tour', '23100', 'La souteraine', '1987-10-10', 1),
('e5', 'Enault-Pascreau', 'Céline', 'cenault', 'y2qdu', '25 place de la gare', '23200', 'Gueret', '1995-09-01', 1),
('e52', 'Eynde', 'Valérie', 'veynde', 'i7sn3', '3 Grand Place', '13015', 'Marseille', '1999-11-01', 1),
('f21', 'Finck', 'Jacques', 'jfinck', 'mpb3t', '10 avenue du Prado', '13002', 'Marseille', '2001-11-10', 1),
('f319', 'Claude', 'Bayle', 'bclaude', 'cb5tq', '14 route de la mer', '13012', 'Allauh', '1998-12-01', 1),
('f39', 'Frémont', 'Fernande', 'ffremont', 'xs5tq', '4 route de la mer', '13012', 'Allauh', '1998-10-01', 1),
('f4', 'Gest', 'Alain', 'agest', 'dywvt', '30 avenue de la mer', '13025', 'Berre', '1985-11-01', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD PRIMARY KEY (`idvisiteur`,`mois`),
  ADD KEY `idetat` (`idetat`);

--
-- Index pour la table `fraisforfait`
--
ALTER TABLE `fraisforfait`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD PRIMARY KEY (`idvisiteur`,`mois`,`idfraisforfait`),
  ADD KEY `idfraisforfait` (`idfraisforfait`);

--
-- Index pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idvisiteur` (`idvisiteur`,`mois`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visiteurs`
--
ALTER TABLE `visiteurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD CONSTRAINT `fichefrais_ibfk_1` FOREIGN KEY (`idetat`) REFERENCES `etat` (`id`),
  ADD CONSTRAINT `fichefrais_ibfk_2` FOREIGN KEY (`idvisiteur`) REFERENCES `visiteurs` (`id`);

--
-- Contraintes pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD CONSTRAINT `lignefraisforfait_ibfk_1` FOREIGN KEY (`idvisiteur`,`mois`) REFERENCES `fichefrais` (`idvisiteur`, `mois`),
  ADD CONSTRAINT `lignefraisforfait_ibfk_2` FOREIGN KEY (`idfraisforfait`) REFERENCES `fraisforfait` (`id`);

--
-- Contraintes pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD CONSTRAINT `lignefraishorsforfait_ibfk_1` FOREIGN KEY (`idvisiteur`,`mois`) REFERENCES `fichefrais` (`idvisiteur`, `mois`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
