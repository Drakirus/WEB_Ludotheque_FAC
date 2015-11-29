-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 29 Novembre 2015 à 21:07
-- Version du serveur :  5.6.25-1~dotdeb+7.1
-- Version de PHP :  5.6.14-1~dotdeb+7.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Ludotheque_BD`
--

-- --------------------------------------------------------

--
-- Structure de la table `Jeux`
--

CREATE TABLE `Jeux` (
  `Nom` varchar(255) NOT NULL,
  `Ages` int(11) NOT NULL,
  `Type_jeux` varchar(255) NOT NULL,
  `date_ajout` datetime NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Jeux`
--

INSERT INTO `Jeux` (`Nom`, `Ages`, `Type_jeux`, `date_ajout`, `image`, `description`) VALUES
('Arbos géant', 6, 'hors normes', '2015-11-29 00:00:00', 'http://www.jeuxdesocietepascher.net/image?id=17837', 'Seul ou à plusieurs construisez un arbre en bois avec ses branches et ses feuilles et cerises sans que celles-ci ne tombent.'),
('Awele', 6, 'Tactiques', '2015-11-29 20:00:00', 'http://www.awechec.com/p-awele.jpg', 'L''awalé ou awélé est un jeu de société combinatoire abstrait créé en Afrique.\n\nC''est le plus répandu des jeux de la famille mancala, ensemble de jeux africains de type « compter et capturer » dans lesquels on distribue des cailloux, graines ou coquillages dans des coupelles ou des trous, parfois creusés à même le sol.'),
('Blokus', 8, 'Tactiques', '2015-11-29 19:32:27', 'http://ecx.images-amazon.com/images/I/71sV+KqaMJL._SY355_.jpg', 'Les joueurs disposent tous d un jeu de pièces identiques en début de partie. Chaque joueur à son tour place une de ses pièces sur le tablier en respectant les règles de pose. Lorsque plus aucun joueur ne peut poser de pièce, la partie s achève et on compte les points.');

-- --------------------------------------------------------

--
-- Structure de la table `Jeux_Ludotheque`
--

CREATE TABLE `Jeux_Ludotheque` (
  `Nom` varchar(255) NOT NULL,
  `NbJeux` int(11) NOT NULL,
  `NbJeuxDispos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Jeux_Ludotheque`
--

INSERT INTO `Jeux_Ludotheque` (`Nom`, `NbJeux`, `NbJeuxDispos`) VALUES
('Arbos géant', 2, 2),
('Awele', 5, 5),
('Blokus', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `users` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `members`
--

INSERT INTO `members` (`users`, `password`, `id`, `email`) VALUES
('admin', 'admin', 0, 'admin'),
('Pierre', 'root', 2, 'root'),
('Test_user', '123P123', 3, 'test@gmail.com'),
('SUPERUSER', 'Password1', 10, 'super@adresse@live.xyz'),
('9CHAMPIONqd', '9CHAMPIONqd', 11, 'Pie@gmail.com'),
('root', 'Pie1234', 13, 'Adresse_emai@gmail.com'),
('gdvdv', 'evPDD6vdv', 14, 'svsc@live.fr'),
('Sh', 'vsjivhsjDD14', 15, 'PIetre@live.fr'),
('pierre', '123P123', 16, 'vsbv@live.fr'),
('c', 'PIJVOJ56C', 17, 'ccsc@live.fr'),
('CHAMPION', '123P123', 18, 'pierrescalade@gmail.com'),
('test', 'Test15Test', 19, 'pierretest@gmail.com'),
('c', 'Pierre15', 20, 'cscscsc@live.fr'),
('c', 'Pierre15', 21, 'pierrechampion@live.fr'),
('toto', 'azerty72A', 22, 'dgfddf@lve.fr'),
('Pierre', 'Pierre15', 23, 'yo@live.fr'),
('c', 'Pierre15', 24, 'clknvze@live.fr');

-- --------------------------------------------------------

--
-- Structure de la table `Paniers`
--

CREATE TABLE `Paniers` (
  `id_reservation` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `creneau` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Jeux`
--
ALTER TABLE `Jeux`
  ADD PRIMARY KEY (`Nom`);

--
-- Index pour la table `Jeux_Ludotheque`
--
ALTER TABLE `Jeux_Ludotheque`
  ADD PRIMARY KEY (`Nom`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Paniers`
--
ALTER TABLE `Paniers`
  ADD PRIMARY KEY (`id_reservation`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `Paniers`
--
ALTER TABLE `Paniers`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
