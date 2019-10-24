-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 24 oct. 2019 à 09:29
-- Version du serveur :  5.7.21
-- Version de PHP :  7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `memory`
--

-- --------------------------------------------------------

--
-- Structure de la table `accueil`
--

DROP TABLE IF EXISTS `accueil`;
CREATE TABLE IF NOT EXISTS `accueil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `connecter` tinyint(1) NOT NULL DEFAULT '0',
  `contenu` longtext NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `date_publication` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `accueil`
--

INSERT INTO `accueil` (`id`, `titre`, `connecter`, `contenu`, `auteur`, `date_publication`) VALUES
(1, 'Bienvenue sur le site de \"Memory\" !', 0, '<p>Vous trouverez la page des membres, les statistiques de la guilde, les métiers des joueurs, une boite à message, les sondages de la guilde, ...</p>\r\n        <p class=\"badge badge-pill badge-danger padding-rightandleft\">Pour avoir accès aux catégories, il faut avoir un compte utilisateur et être un membre de la guilde.</p>\r\n\r\n        <p>Site crée par <img src=\"icons/lampadaire.png\" alt=\"Lampadaire\" width=\"30px\"> <strong>Lampadaire</strong> de la guilde <strong>Memory</strong> ( <img src=\"icons/memory.png\" alt=\"Memory\" width=\"30px\"> ) !</p>\r\n\r\n        <br>\r\n        <div class=\"text-right\"><p class=\"badge badge-pill badge-info padding-rightandleft\">Si vous rencontrez des soucis, merci de contacter <img src=\"icons/discord.png\" alt=\"Discord\" width=\"20px\"> <strong>Lampadaire#2474</strong> sur discord.</p></div>', 'Lampadaire', '2019-02-01 00:45:10');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rang` int(11) NOT NULL DEFAULT '1',
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `classe_principale` varchar(255) NOT NULL,
  `bio` varchar(250) DEFAULT NULL,
  `prenom` varchar(50) NOT NULL,
  `etude` varchar(50) DEFAULT NULL,
  `travail` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `pseudo` (`pseudo`),
  KEY `id_rang` (`id_rang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `id_rang`, `pseudo`, `mdp`, `mail`, `classe_principale`, `bio`, `prenom`, `etude`, `travail`, `region`, `date_inscription`) VALUES
(1, 3, 'Lampadaire', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'icons/logo/sacrieur.png', 'Salut à tous :D', 'Julien', NULL, 'Développeur Web', 'Liège', '2019-06-09 21:41:35'),
(2, 2, 'Zetrox', '21232f297a57a5a743894a0e4a801fc3', 'Zetrox@gmail.com', 'icons/logo/sram.png', NULL, 'Samuel', NULL, NULL, NULL, '2019-06-09 21:55:33');

-- --------------------------------------------------------

--
-- Structure de la table `metiers`
--

DROP TABLE IF EXISTS `metiers`;
CREATE TABLE IF NOT EXISTS `metiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `alchimiste` int(11) DEFAULT NULL,
  `bijoutier` int(11) DEFAULT NULL,
  `bricoleur` int(11) DEFAULT NULL,
  `bucheron` int(11) DEFAULT NULL,
  `chasseur` int(11) DEFAULT NULL,
  `cordomage` int(11) DEFAULT NULL,
  `cordonnier` int(11) DEFAULT NULL,
  `costumage` int(11) DEFAULT NULL,
  `tailleur` int(11) DEFAULT NULL,
  `facomage` int(11) DEFAULT NULL,
  `faconneur` int(11) DEFAULT NULL,
  `forgemage` int(11) DEFAULT NULL,
  `forgeron` int(11) DEFAULT NULL,
  `joaillomage` int(11) DEFAULT NULL,
  `mineur` int(11) DEFAULT NULL,
  `paysan` int(11) DEFAULT NULL,
  `pecheur` int(11) DEFAULT NULL,
  `sculptemage` int(11) DEFAULT NULL,
  `sculpteur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_Metiers_Membres` (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `metiers`
--

INSERT INTO `metiers` (`id`, `id_membre`, `alchimiste`, `bijoutier`, `bricoleur`, `bucheron`, `chasseur`, `cordomage`, `cordonnier`, `costumage`, `tailleur`, `facomage`, `faconneur`, `forgemage`, `forgeron`, `joaillomage`, `mineur`, `paysan`, `pecheur`, `sculptemage`, `sculpteur`) VALUES
(1, 1, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 200, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 180, NULL, NULL, NULL, NULL, 200, NULL, 200, NULL, NULL, NULL, NULL, NULL, 200, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `paris`
--

DROP TABLE IF EXISTS `paris`;
CREATE TABLE IF NOT EXISTS `paris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `mise` int(11) NOT NULL,
  `choix1` varchar(255) NOT NULL,
  `choix2` varchar(255) NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `paris`
--

INSERT INTO `paris` (`id`, `titre`, `mise`, `choix1`, `choix2`, `date_fin`) VALUES
(1, 'Belgique VS France', 600000, 'Belgique', 'France', '2019-06-14 20:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `paris_participation`
--

DROP TABLE IF EXISTS `paris_participation`;
CREATE TABLE IF NOT EXISTS `paris_participation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_paris` int(11) NOT NULL,
  `id_membres` int(11) NOT NULL,
  `membre_choix` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_Paris_Membres` (`id_membres`),
  KEY `ID_Paris` (`id_paris`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `paris_participation`
--

INSERT INTO `paris_participation` (`id`, `id_paris`, `id_membres`, `membre_choix`) VALUES
(1, 1, 1, 'choix1'),
(2, 1, 2, 'choix1');

-- --------------------------------------------------------

--
-- Structure de la table `popcorn`
--

DROP TABLE IF EXISTS `popcorn`;
CREATE TABLE IF NOT EXISTS `popcorn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_film` datetime NOT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `film` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `popcorn`
--

INSERT INTO `popcorn` (`id`, `date_film`, `option1`, `option2`, `option3`, `film`) VALUES
(1, '2019-02-07 20:00:00', 'Hunter Killer', 'Creed II', NULL, NULL),
(2, '2019-02-14 21:30:00', 'Dragons 3 : Le monde caché', NULL, 'Green Book : Sur les routes du sud', 'https://uqload.com/8pn7d5rryy8z.html');

-- --------------------------------------------------------

--
-- Structure de la table `popcorn_reponse`
--

DROP TABLE IF EXISTS `popcorn_reponse`;
CREATE TABLE IF NOT EXISTS `popcorn_reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_popcorn` int(11) NOT NULL,
  `choix` varchar(50) NOT NULL,
  `id_membres` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_Popcorn` (`id_popcorn`),
  KEY `ID_Popcorn_Membres` (`id_membres`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rang`
--

DROP TABLE IF EXISTS `rang`;
CREATE TABLE IF NOT EXISTS `rang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rang`
--

INSERT INTO `rang` (`id`, `nom`) VALUES
(2, 'Bras Droit'),
(1, 'Membre'),
(3, 'Meneur');

-- --------------------------------------------------------

--
-- Structure de la table `sondage_questions`
--

DROP TABLE IF EXISTS `sondage_questions`;
CREATE TABLE IF NOT EXISTS `sondage_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `open` tinyint(1) NOT NULL DEFAULT '1',
  `option1` varchar(100) DEFAULT NULL,
  `option2` varchar(100) DEFAULT NULL,
  `option3` varchar(100) DEFAULT NULL,
  `date_publication` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sondage_questions`
--

INSERT INTO `sondage_questions` (`id`, `titre`, `open`, `option1`, `option2`, `option3`, `date_publication`) VALUES
(1, 'Quel event voulez-vous pour le 15/02 à 22H ?', 0, 'Donjon des familliers', 'Cache-Cache', 'Sortie xp zone bworks', '2019-02-27'),
(2, 'Voulez-vous rester dans l\'alliance [SYM] ?', 0, 'Oui', 'Non (Pourquoi, Mp Lampadaire)', 'Je laisse les autres choisir', '2018-01-03'),
(3, 'Quel event voulez-vous pour le 10/12 à 22H ?', 0, 'Cache-Cache (Sur un terrain prédéfini)', 'Mine de Sakai', 'Donjon des familliers', '2017-12-12'),
(4, 'Quel event voulez-vous pour le 3/12 ?', 1, 'Île d\'otomai (Donjon = Restat son personnage)', 'Donjon des familiers', 'Mine de Sakai', '2019-06-04'),
(5, 'Aimez-vous le site ?', 1, 'Oui', 'Non !', NULL, '2019-06-13');

-- --------------------------------------------------------

--
-- Structure de la table `sondage_reponse`
--

DROP TABLE IF EXISTS `sondage_reponse`;
CREATE TABLE IF NOT EXISTS `sondage_reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_questions` int(11) NOT NULL,
  `choix` varchar(100) NOT NULL,
  `id_membres` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_Question` (`id_questions`),
  KEY `ID_Sondage_Membres` (`id_membres`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sondage_reponse`
--

INSERT INTO `sondage_reponse` (`id`, `id_questions`, `choix`, `id_membres`) VALUES
(1, 5, 'option1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tchat`
--

DROP TABLE IF EXISTS `tchat`;
CREATE TABLE IF NOT EXISTS `tchat` (
  `idMsg` int(11) NOT NULL AUTO_INCREMENT,
  `timestampMsg` datetime NOT NULL,
  `contenu` varchar(250) NOT NULL,
  `lu` tinyint(1) NOT NULL,
  `idProfil_recepteur` int(11) NOT NULL,
  `idProfil_emetteur` int(11) NOT NULL,
  PRIMARY KEY (`idMsg`),
  KEY `idProfil_recepteur` (`idProfil_recepteur`),
  KEY `idProfil_emetteur` (`idProfil_emetteur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tchat`
--

INSERT INTO `tchat` (`idMsg`, `timestampMsg`, `contenu`, `lu`, `idProfil_recepteur`, `idProfil_emetteur`) VALUES
(1, '2019-06-10 18:16:15', 'Salut Z :D', 1, 2, 1),
(2, '2019-06-16 10:26:41', 'Bien ?', 1, 2, 1),
(3, '2019-06-16 10:27:19', 'Bien bien :)', 1, 1, 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `membres`
--
ALTER TABLE `membres`
  ADD CONSTRAINT `id_rang` FOREIGN KEY (`id_rang`) REFERENCES `rang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `metiers`
--
ALTER TABLE `metiers`
  ADD CONSTRAINT `ID_Metiers_Membres` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `paris_participation`
--
ALTER TABLE `paris_participation`
  ADD CONSTRAINT `ID_Paris` FOREIGN KEY (`id_paris`) REFERENCES `paris` (`id`),
  ADD CONSTRAINT `ID_Paris_Membres` FOREIGN KEY (`id_membres`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `popcorn_reponse`
--
ALTER TABLE `popcorn_reponse`
  ADD CONSTRAINT `ID_Popcorn` FOREIGN KEY (`id_popcorn`) REFERENCES `popcorn` (`id`),
  ADD CONSTRAINT `ID_Popcorn_Membres` FOREIGN KEY (`id_membres`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `sondage_reponse`
--
ALTER TABLE `sondage_reponse`
  ADD CONSTRAINT `ID_Question` FOREIGN KEY (`id_questions`) REFERENCES `sondage_questions` (`id`),
  ADD CONSTRAINT `ID_Sondage_Membres` FOREIGN KEY (`id_membres`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `tchat`
--
ALTER TABLE `tchat`
  ADD CONSTRAINT `tchat_ibfk_1` FOREIGN KEY (`idProfil_recepteur`) REFERENCES `membres` (`id`),
  ADD CONSTRAINT `tchat_ibfk_2` FOREIGN KEY (`idProfil_emetteur`) REFERENCES `membres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
