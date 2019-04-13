-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 13 avr. 2019 à 09:09
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `v2`
--

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id_event` int(11) NOT NULL,
  `start` date NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_patient` int(11) NOT NULL,
  `hour` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id_event`, `start`, `id_type`, `id_patient`, `hour`) VALUES
(12, '2019-03-15', 1, 3, '12:12:00'),
(13, '2019-03-15', 6, 3, '14:00:00'),
(14, '2019-03-15', 4, 3, '08:15:00'),
(15, '2019-12-12', 2, 3, '12:12:00'),
(16, '2019-12-12', 3, 3, '12:12:00'),
(17, '2019-12-12', 7, 3, '12:12:00'),
(18, '2019-12-12', 5, 3, '12:12:00'),
(21, '2019-03-18', 4, 3, '11:15:00'),
(22, '2019-03-18', 4, 19, '14:15:00'),
(23, '2019-03-19', 6, 19, '08:30:00'),
(24, '2019-03-19', 7, 19, '09:00:00'),
(25, '2019-03-19', 5, 3, '09:15:00'),
(26, '2019-03-22', 5, 22, '08:45:00'),
(27, '2019-03-22', 1, 22, '10:00:00'),
(28, '2019-03-22', 3, 22, '10:00:00'),
(29, '2019-03-25', 7, 3, '12:15:00'),
(30, '2019-03-22', 5, 21, '10:30:00'),
(31, '2019-03-25', 2, 21, '13:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id_patient` int(11) NOT NULL,
  `patientPrenom` varchar(60) NOT NULL,
  `patientNom` varchar(60) NOT NULL,
  `patientDate` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_1` varchar(255) NOT NULL,
  `confirmationToken` varchar(255) NOT NULL,
  `confirmed` varchar(255) NOT NULL DEFAULT 'false',
  `id_praticien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `patientPrenom`, `patientNom`, `patientDate`, `email`, `password_1`, `confirmationToken`, `confirmed`, `id_praticien`) VALUES
(3, 'jean-claude', 'dusse', '1984-11-11', 'jc@dusse.com', '$2y$10$aVY0h4QQWF0hcI8Q7O59NuR6QszftqhhR8kAleeSrrs7O8kvDdlF.', '', '', 3),
(19, 'benoît', 'de beaugeoir', '1111-11-11', 'benoit@debeaugeoir.com', '$2y$10$EnTcezBWEoH4lR4yNa0rOuFWMQThvGp2du4aJ.ZZbytcmkU5nh8PO', '', '', 4),
(20, 'david', 'saoud', '1984-10-12', 'davidsaoud@gmail.com', '$2y$10$0/FqMvOOxZjFStekafup2OzMkGijLinJrl7/L93OTYnKe29RvOuoe', '', '', 4),
(21, 'david', 'david', '2222-02-22', 'frederic@grouplive.fr', '$2y$10$JaExk2XiqoaL.f90Rw6E/OLqwHpvybwM.WNGXOZrgN4U8/TDLK6NO', '', '', 3),
(22, 'théo', 'Martins', '2000-05-29', 'theo@martins.com', '$2y$10$PPj/cSWrXSZ8SEQpwDh4/OYr64Hpi4BStvOdSHdEIC/KsbPLlcPaC', '', '', 3),
(60, 'sdfsd', 'sdfds', '2019-03-21', 'sdsdsf@sdf.com', '$2y$10$ottcpmw4pDu8Czfz4BV3S.F8DzdKTJ8ED9IbUBxLxFs.AcfZ.Ccua', 'ab6eb540c103c207d1b41faa40da050370033b0b', 'true', 3),
(61, 'sdfsd', 'dsfsdf', '2019-03-14', 'sdfsd@sdf.com', '$2y$10$ljf/pCjgm/bIAfZl1IDou.9Y0eI0khqorWHuWbSX3EX7BtNSshuL2', '01734b0d47e6153502e36b37bd3db82b956f75ea', 'false', 3),
(62, 'aad', 'adzad', '2019-03-12', 'dadda@dad.dd', '$2y$10$SiedQL6lQlNzMrfmYrHlhuW4qp/2RE7bpFcfoX7XOZ6IC3QNtePiu', 'ab2b9331c17b0d04172991bd4f37e271f4efc455', 'false', 3),
(63, 'sfgfdg', 'sd', '1984-11-11', 'dsflsdmf@com.com', '$2y$10$yL2M2TKwDhZH4y2u7VVrtOzCHVTK.eqIumIprcLvAGDoa9wNnOSC.', 'b652fec74a7bbdbfc63093cb017b7a379ceba3f6', 'true', 3),
(64, 'david', 'saoud', '1984-10-12', 'pro.davidsaoud@gmail.com', '$2y$10$sEb4BqVrS9Qa01ndAjoAhu1KLeQyOKlsftEUdaRQ23xQCL5gxbhZC', 'b5de63e5fb7550f5c8b27b70e2f060a248383253', 'true', 3);

-- --------------------------------------------------------

--
-- Structure de la table `praticien`
--

CREATE TABLE `praticien` (
  `id_praticien` int(11) NOT NULL,
  `praticienPrenom` varchar(60) NOT NULL,
  `praticienNom` varchar(60) NOT NULL,
  `praticienDate` date NOT NULL,
  `praticienEmail` varchar(255) NOT NULL,
  `password_1` varchar(255) NOT NULL,
  `id_spe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `praticien`
--

INSERT INTO `praticien` (`id_praticien`, `praticienPrenom`, `praticienNom`, `praticienDate`, `praticienEmail`, `password_1`, `id_spe`) VALUES
(1, 'defaut', 'defaut', '1111-01-01', 'defaut@defaut.com', '$2y$10$PBdrIt0KdB1ljyULLZ82/OGfWomDSsDa8x69ZcFo.MKrOuO8ifTBW', 1),
(3, 'nicole', 'meunier', '1982-06-13', 'nicole@meunier.com', '$2y$10$QL6DsF7HP8AZZTzzsSCg0O4Z9bQMOiOModZKTm0a365sRTcbGNmyG', 5),
(4, 'emilie', 'le lan', '1990-07-25', 'emilie@gmail.com', '$2y$10$ROmc4EvTNtg9co3d4FEtfuu8g1crPLUK9wN6dGaFclHifFhptALfq', 8);

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `id_spe` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`id_spe`, `description`) VALUES
(1, 'Dentiste'),
(2, 'Dermatologue'),
(3, 'Gynécologue'),
(4, 'Médecin du travail'),
(5, 'Médecin généraliste'),
(6, 'Médecin du sport'),
(7, 'Ophtalmologue'),
(8, 'Pédiatre');

-- --------------------------------------------------------

--
-- Structure de la table `typeacte`
--

CREATE TABLE `typeacte` (
  `id_type` int(11) NOT NULL,
  `description` varchar(60) NOT NULL,
  `dureeConsultation` time NOT NULL,
  `couleur` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typeacte`
--

INSERT INTO `typeacte` (`id_type`, `description`, `dureeConsultation`, `couleur`) VALUES
(1, 'urgence', '00:15:00', '#ff0000'),
(2, 'consultation', '00:15:00', '#7c7c7c'),
(3, 'gynécologie', '00:30:00', '#ff72db'),
(4, 'pédiatrie', '00:30:00', '#6280ef'),
(5, 'certificats (sport, arrêt de travail...)', '00:15:00', '#f3ff59'),
(6, 'visite à domicile', '00:30:00', '#85ff59'),
(7, 'suivi psychologique', '00:30:00', '#bf49ff');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `events_typeActe_FK` (`id_type`),
  ADD KEY `events_patient0_FK` (`id_patient`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id_patient`),
  ADD KEY `patient_praticien_FK` (`id_praticien`);

--
-- Index pour la table `praticien`
--
ALTER TABLE `praticien`
  ADD PRIMARY KEY (`id_praticien`),
  ADD KEY `praticien_specialite_FK` (`id_spe`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`id_spe`);

--
-- Index pour la table `typeacte`
--
ALTER TABLE `typeacte`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id_patient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `praticien`
--
ALTER TABLE `praticien`
  MODIFY `id_praticien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id_spe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `typeacte`
--
ALTER TABLE `typeacte`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_patient0_FK` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id_patient`),
  ADD CONSTRAINT `events_typeActe_FK` FOREIGN KEY (`id_type`) REFERENCES `typeacte` (`id_type`);

--
-- Contraintes pour la table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_praticien_FK` FOREIGN KEY (`id_praticien`) REFERENCES `praticien` (`id_praticien`);

--
-- Contraintes pour la table `praticien`
--
ALTER TABLE `praticien`
  ADD CONSTRAINT `praticien_specialite_FK` FOREIGN KEY (`id_spe`) REFERENCES `specialite` (`id_spe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
