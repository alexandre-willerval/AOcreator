-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 05 Septembre 2018 à 23:38
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `AOcreator`
--

-- --------------------------------------------------------

--
-- Structure de la table `bricks`
--

CREATE TABLE `bricks` (
  `id` smallint(6) NOT NULL,
  `title` tinytext,
  `category` tinytext,
  `file` tinytext NOT NULL,
  `firstUser` tinytext NOT NULL,
  `lastUser` tinytext,
  `firstCreated` datetime NOT NULL,
  `lastModified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `bricks`
--

INSERT INTO `bricks` (`id`, `title`, `category`, `file`, `firstUser`, `lastUser`, `firstCreated`, `lastModified`, `deleted`) VALUES
(1, 'Page de présentation', 'Présentation', 'bricks/1.docx', 'alexandre.willerval@orange.com', 'alexandre.willerval@orange.com', '2017-09-19 13:37:12', '2017-11-15 10:52:25', 0),
(2, 'Introduction', 'Général', 'bricks/2.docx', 'alexandre.willerval@orange.com', 'alexandre.willerval@orange.com', '2017-11-02 17:10:43', '2017-11-15 15:02:48', 0),
(3, 'Test', 'Général', 'bricks/3.docx', 'alexandre.willerval@orange.com', 'alexandre.willerval@orange.com', '2017-11-15 15:03:27', '2017-11-15 15:16:13', 0);

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id` tinyint(4) NOT NULL,
  `name` tinytext NOT NULL,
  `place` tinyint(4) NOT NULL,
  `visibility` tinyint(4) NOT NULL,
  `display` tinyint(4) NOT NULL,
  `title` tinytext NOT NULL,
  `content` tinytext NOT NULL,
  `icon` tinytext NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`id`, `name`, `place`, `visibility`, `display`, `title`, `content`, `icon`, `description`) VALUES
(1, 'accueil', 1, 3, 1, 'Accueil', 'html/accueil.php', 'glyphicon-home', 'Page d\'accueil de l\'application AOcreator'),
(2, 'AOcreator', 2, 0, 1, 'AOcreator', 'html/AOcreator.php', 'glyphicon-compressed', 'Un appel d\'offre ? Pas de problème ! AOcreator te permet de générer de manière automatique un mémoire technique complet.'),
(3, 'AOexpress', 3, 0, 1, 'AOexpress', 'html/AOexpress.php', 'glyphicon-flash', 'Pas le temps de générer un mémoire technique complet ? Qu\'à cela ne tienne, AOexpress te permet, en 2 clics, d\'obtenir une base de rédaction sur laquelle retravailler plus tard.'),
(4, 'AOhistory', 4, 0, 1, 'AOhistory', 'html/AOhistory.php', 'glyphicon-folder-open', 'Tu veux retrouver un ancien appel d\'offre traité avec AOcreator ? C\'est AOhistory qu\'il te faut !'),
(5, 'AOlibrary', 5, 0, 1, 'AOlibrary', 'html/AOlibrary.php', 'glyphicon-book', 'Ton appel d\'offre réclame un produit ou un service qui ne figure pas dans la base documentaire ? Avec AOlibrary, tu peux l\'ajouter toi-même !'),
(6, 'AOadmin', 6, 2, 2, 'AOadmin', 'html/AOadmin.php', 'glyphicon-th-list', 'Grâce à AOadmin, tu peux gérer les droits de tous les utilisateurs de l\'application.'),
(7, 'AOstats', 7, 2, 2, 'AOstats', 'html/AOstats.php', 'glyphicon-dashboard', 'Avec AOstats, retrouve différentes métriques d\'utilisation de l\'application.'),
(8, 'connexion', 10, 3, 0, 'Connexion', 'html/connexion.php', 'glyphicon-log-in', 'Page de connexion à l\'application AOcreator'),
(9, 'moncompte', 11, 3, 1, 'Mon compte', 'html/moncompte.php', 'glyphicon-user', 'Tu souhaites voir tes informations privées ? C\'est par ici !');

-- --------------------------------------------------------

--
-- Structure de la table `proposals`
--

CREATE TABLE `proposals` (
  `id` smallint(6) NOT NULL,
  `title` tinytext NOT NULL,
  `clientName` tinytext NOT NULL,
  `user` tinytext NOT NULL,
  `firstCreated` datetime NOT NULL,
  `lastModified` datetime DEFAULT NULL,
  `file` tinytext,
  `step` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `proposals`
--

INSERT INTO `proposals` (`id`, `title`, `clientName`, `user`, `firstCreated`, `lastModified`, `file`, `step`) VALUES
(1, 'Lot 4 : Accès internet haut débit', 'Mairie de Villeneuve d\\\'Ascq', 'alexandre.willerval@orange.com', '2017-11-27 17:01:32', '2017-11-27 17:03:17', NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` smallint(6) NOT NULL,
  `forename` tinytext NOT NULL,
  `surname` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `thumbnailUrl` tinytext NOT NULL,
  `thumbnail` tinytext NOT NULL,
  `job` tinytext NOT NULL,
  `team` tinytext NOT NULL,
  `phone` tinytext NOT NULL,
  `address` text NOT NULL,
  `firstConnection` datetime NOT NULL,
  `lastConnection` datetime NOT NULL,
  `cookie` tinytext NOT NULL,
  `rights` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `forename`, `surname`, `email`, `thumbnailUrl`, `thumbnail`, `job`, `team`, `phone`, `address`, `firstConnection`, `lastConnection`, `cookie`, `rights`) VALUES
(1, 'Alexandre', 'Willerval', 'alexandre.willerval@orange.com', 'https://plazza.orange.com/api/core/v3/people/140067/avatar?a=16087', 'users/1.png', 'Ingénieur Technico Commercial', 'Orange/OF/DEF/AENF/DAV/DAV2', '+33 328391611', 'Orange<br />\nAgence Entreprises Nord de France<br />\n6 rue des Techniques<br />\nBP 60316<br />\n59666 Villeneuve-d\'Ascq Cedex<br />\nFrance', '2017-09-06 16:26:15', '2017-11-29 15:50:50', '098f6bcd4621d373cade4e832627b4f6', 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `bricks`
--
ALTER TABLE `bricks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `bricks`
--
ALTER TABLE `bricks`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
