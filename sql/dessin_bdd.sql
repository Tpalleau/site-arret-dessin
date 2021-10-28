-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 28 oct. 2021 à 23:28
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.11

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
  `nom` int(11) DEFAULT NULL,
  `nb_place` int(11) NOT NULL,
  `jour_heur` datetime NOT NULL,
  `salle` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `cours_bloque`
--

CREATE TABLE `cours_bloque` (
  `id_bloquage` int(11) NOT NULL,
  `horaire` datetime NOT NULL,
  `id_cour` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `nom_cours`
--

CREATE TABLE `nom_cours` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `nom_cours`
--

INSERT INTO `nom_cours` (`id`, `nom`) VALUES
(1, 'stickman'),
(2, '3D stickman'),
(3, 'bases solides'),
(4, 'presqu\'artiste'),
(5, 'artiste');

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
  `id_utilisateur` int(11) DEFAULT NULL,
  `titre` varchar(30) DEFAULT NULL,
  `dessin` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `utilisateur` int(11) NOT NULL,
  `cours` int(11) DEFAULT NULL
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
(14, 'root@gmail.com', 'root', 'root', 'root', 1, 0, '*9CFBBC772F3F6C106020035386DA5BBBF1249A11', '0001-11-11');

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
-- Index pour la table `cours_bloque`
--
ALTER TABLE `cours_bloque`
  ADD PRIMARY KEY (`id_bloquage`),
  ADD KEY `id_cour` (`id_cour`);

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
  ADD PRIMARY KEY (`utilisateur`),
  ADD KEY `cours` (`cours`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cours_bloque`
--
ALTER TABLE `cours_bloque`
  MODIFY `id_bloquage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `nom_cours`
--
ALTER TABLE `nom_cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `nom_niv`
--
ALTER TABLE `nom_niv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `numero_post` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`nom`) REFERENCES `nom_cours` (`id`);

--
-- Contraintes pour la table `cours_bloque`
--
ALTER TABLE `cours_bloque`
  ADD CONSTRAINT `cours_bloque_ibfk_1` FOREIGN KEY (`id_cour`) REFERENCES `cours` (`id`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`cours`) REFERENCES `cours` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`niv_dessin`) REFERENCES `nom_niv` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
