-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 02 nov. 2021 à 14:33
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dessin_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `nom` int(11) NOT NULL,
  `nb_place` int(11) NOT NULL,
  `salle` varchar(10) NOT NULL,
  `jour` date NOT NULL,
  `heure` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `nom`, `nb_place`, `salle`, `jour`, `heure`) VALUES
(2, 6, 10, 'P108', '2021-10-31', '16:00:00'),
(4, 6, 4, 'p200', '2021-11-07', '18:00:00'),
(7, 7, 13, 'P100', '2021-11-01', '08:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `nom_cours`
--

CREATE TABLE `nom_cours` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `nom_cours`
--

INSERT INTO `nom_cours` (`id`, `nom`) VALUES
(6, 'blouse'),
(7, 'dessin');

-- --------------------------------------------------------

--
-- Structure de la table `nom_niv`
--

CREATE TABLE `nom_niv` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `nom_niv`
--

INSERT INTO `nom_niv` (`id`, `nom`) VALUES
(1, 'Stickman'),
(2, '3D-Stickman'),
(3, 'bases-solides'),
(4, 'presqu\'artiste'),
(5, 'artiste');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `numero_post` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `dessin` longblob NOT NULL,
  `titre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_cour` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `surnom` varchar(20) DEFAULT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `niv_dessin` int(11) DEFAULT NULL,
  `admin` int(11) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `naissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `surnom`, `nom`, `prenom`, `niv_dessin`, `admin`, `passwd`, `naissance`) VALUES
(16, 'root@gmail.com', 'root', 'root', 'root', 1, 1, '*9CFBBC772F3F6C106020035386DA5BBBF1249A11', '0001-11-11'),
(17, 'user@gmail.com', 'user', 'user', 'user', 1, 0, '*A1D2142CEE6124B304C4FBFC700E0990AD95C0F8', '0002-02-22'),
(18, 'Dorine@gmail.com', 'DODO', 'Dorine', 'Lasmartres', 5, 0, '*F72BD56153C85C4E7AF4E4F158D2332782B3F896', '2005-07-21');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nom` (`nom`);

--
-- Index pour la table `nom_cours`
--
ALTER TABLE `nom_cours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nom_niv`
--
ALTER TABLE `nom_niv`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`numero_post`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_cour`,`id_utilisateur`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `niv_dessin` (`niv_dessin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `nom_cours`
--
ALTER TABLE `nom_cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `nom_niv`
--
ALTER TABLE `nom_niv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`nom`) REFERENCES `nom_cours` (`id`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_cour`) REFERENCES `cours` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`niv_dessin`) REFERENCES `nom_niv` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
