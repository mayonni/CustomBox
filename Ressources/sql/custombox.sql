-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 10 Mars 2022 à 10:43
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `atelier`
--

-- --------------------------------------------------------

--
-- Structure de la table `boite`
--

CREATE TABLE `boite` (
  `id` int(11) NOT NULL,
  `taille` text NOT NULL,
  `poidsmax` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `boite`
--

INSERT INTO `boite` (`id`, `taille`, `poidsmax`) VALUES
(1, 'petite', 0.7),
(2, 'moyenne', 1.5),
(3, 'grande', 3.2);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Beauté'),
(2, 'Bijoux'),
(3, 'Décoration'),
(4, 'Produit ménager'),
(5, 'Upcycling');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `titre` text NOT NULL,
  `description` text NOT NULL,
  `categorie` int(11) NOT NULL,
  `poids` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id`, `titre`, `description`, `categorie`, `poids`) VALUES
(1, 'Crème', 'Une crème hydratante et parfumée qui rend la peau douce', 1, 0.3),
(2, 'Savon', 'Un savon qui respecte la peau', 1, 0.2),
(3, 'Shampoing', 'Shampoing doux et démêlant', 1, 0.4),
(4, 'Bracelet', 'Un bracelet en tissu aux couleurs plaisantes', 2, 0.15),
(5, 'Tableau', 'Aquarelle ou peinture à l\'huile', 3, 0.6),
(6, 'Essuie-main', 'Utile au quotidien', 4, 0.45),
(7, 'Gel', 'Gel hydroalcoolique et Antibactérien', 4, 0.25),
(8, 'Masque', 'masque chirurgical jetable categorie 1', 4, 0.35),
(9, 'Gilet', 'Gilet décoré par nos couturières', 5, 0.55),
(10, 'Marque page', 'Joli marque page pour accompagner vos lectures favorites', 5, 0.1),
(11, 'Sac', 'Sac éco-responsable avec décorations variées', 5, 0.26),
(12, 'Surprise', 'Pochette surprise pour faire plaisir aux petits et grands', 5, 0.7),
(13, 'T-shirt', 'T-shirt peint à la main et avec pochoir', 5, 0.32);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(10) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `boite`
--
ALTER TABLE `boite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie` (`categorie`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `boite`
--
ALTER TABLE `boite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
