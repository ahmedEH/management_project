-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 13 mars 2021 à 01:43
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

drop database if exists entreprise_db;
create database if not exists entreprise_db;


--
-- Base de données : `entreprise_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `nom`, `prenom`, `login`, `passwd`, `tel`) VALUES
(1, 'الشيخ ابراهيم', 'أحمد لمرابط', 'mrabottc@gmail.com', 'c2c0b6537a7cc130306c23475b2cf8aa', '+22227804921');

-- --------------------------------------------------------

--
-- Structure de la table `client_compte`
--

CREATE TABLE `client_compte` (
  `id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `montant` double DEFAULT NULL,
  `date_v` date DEFAULT NULL,
  `verseur` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client_compte`
--

INSERT INTO `client_compte` (`id`, `client`, `montant`, `date_v`, `verseur`, `description`) VALUES
(3, 16, 480000, '2021-03-13', 'مول البتيك', 'اسنتابسنش');

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

CREATE TABLE `depenses` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `montant_unitaire` double NOT NULL,
  `description` text NOT NULL,
  `quantite` float NOT NULL,
  `projet` int(11) NOT NULL,
  `fournisseur` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `depenses`
--

INSERT INTO `depenses` (`id`, `date`, `montant_unitaire`, `description`, `quantite`, `projet`, `fournisseur`, `nom`) VALUES
(4, '2021-03-13', 45000, '30 طن من سموه', 30, 7, 17, 'اسمنت');

-- --------------------------------------------------------

--
-- Structure de la table `ouvriers_projets`
--

CREATE TABLE `ouvriers_projets` (
  `ouvrier` int(11) NOT NULL,
  `projet` int(11) NOT NULL,
  `montant` double NOT NULL,
  `date` date NOT NULL,
  `description` text DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ouvriers_projets`
--

INSERT INTO `ouvriers_projets` (`ouvrier`, `projet`, `montant`, `date`, `description`, `id`) VALUES
(18, 7, 20000, '2021-03-13', 'عدل اسلوك الظو كانو خاسرين', 4);

-- --------------------------------------------------------

--
-- Structure de la table `personnes`
--

CREATE TABLE `personnes` (
  `id` int(11) NOT NULL,
  `nom_prenom` varchar(100) NOT NULL,
  `tel` varchar(45) NOT NULL,
  `wtsp` varchar(45) NOT NULL,
  `adresse` varchar(500) NOT NULL,
  `fonction` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personnes`
--

INSERT INTO `personnes` (`id`, `nom_prenom`, `tel`, `wtsp`, `adresse`, `fonction`) VALUES
(16, 'أحمد', '22432506', '27804921', 'تنسويلم انواكشوط', 'زبون'),
(17, 'مول سموه', '27804921', '27804921', 'تللتنالتا', 'مورد'),
(18, 'مول الظو', '22219217', '22219217', 'تفرغ زينة', 'عامل');

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `date_debut` date NOT NULL,
  `client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id`, `nom`, `description`, `date_debut`, `client`) VALUES
(7, 'دار تفرغ زينة', 'اسشابسشنبنسىؤشسصث', '2021-03-13', 16);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `tel` (`tel`);

--
-- Index pour la table `client_compte`
--
ALTER TABLE `client_compte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client` (`client`);

--
-- Index pour la table `depenses`
--
ALTER TABLE `depenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Depenses_Projets1` (`projet`),
  ADD KEY `fk_Depenses_Personnes1` (`fournisseur`);

--
-- Index pour la table `ouvriers_projets`
--
ALTER TABLE `ouvriers_projets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Personnes_has_Projets_Personnes1` (`ouvrier`),
  ADD KEY `fk_Personnes_has_Projets_Projets1` (`projet`);

--
-- Index pour la table `personnes`
--
ALTER TABLE `personnes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Projets_Personnes1` (`client`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `client_compte`
--
ALTER TABLE `client_compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `depenses`
--
ALTER TABLE `depenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `ouvriers_projets`
--
ALTER TABLE `ouvriers_projets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `personnes`
--
ALTER TABLE `personnes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client_compte`
--
ALTER TABLE `client_compte`
  ADD CONSTRAINT `client_compte_ibfk_1` FOREIGN KEY (`client`) REFERENCES `personnes` (`id`);

--
-- Contraintes pour la table `depenses`
--
ALTER TABLE `depenses`
  ADD CONSTRAINT `fk_Depenses_Personnes1` FOREIGN KEY (`fournisseur`) REFERENCES `personnes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Depenses_Projets1` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ouvriers_projets`
--
ALTER TABLE `ouvriers_projets`
  ADD CONSTRAINT `fk_Personnes_has_Projets_Personnes1` FOREIGN KEY (`ouvrier`) REFERENCES `personnes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Personnes_has_Projets_Projets1` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `fk_Projets_Personnes1` FOREIGN KEY (`client`) REFERENCES `personnes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
