-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 16 avr. 2024 à 15:00
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cube5`
--

-- --------------------------------------------------------

--
-- Structure de la table `codes`
--

DROP TABLE IF EXISTS `codes`;
CREATE TABLE IF NOT EXISTS `codes` (
  `code_id` int NOT NULL AUTO_INCREMENT,
  `intervenant_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`code_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `codes`
--

INSERT INTO `codes` (`code_id`, `intervenant_code`) VALUES
(2, 'Keyboard');

-- --------------------------------------------------------

--
-- Structure de la table `competances`
--

DROP TABLE IF EXISTS `competances`;
CREATE TABLE IF NOT EXISTS `competances` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `competances`
--

INSERT INTO `competances` (`id`, `nom`) VALUES
(1, 'Système/Réseau'),
(2, 'Développement');

-- --------------------------------------------------------

--
-- Structure de la table `compet_intervenants`
--

DROP TABLE IF EXISTS `compet_intervenants`;
CREATE TABLE IF NOT EXISTS `compet_intervenants` (
  `id_compet_intervenant` int NOT NULL AUTO_INCREMENT,
  `id_intervenant` int NOT NULL,
  `id_competances` int NOT NULL,
  PRIMARY KEY (`id_compet_intervenant`),
  KEY `id_intervenant` (`id_intervenant`),
  KEY `id_competances` (`id_competances`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `compet_intervenants`
--

INSERT INTO `compet_intervenants` (`id_compet_intervenant`, `id_intervenant`, `id_competances`) VALUES
(36, 31, 1),
(37, 32, 1),
(38, 33, 2),
(39, 34, 1),
(40, 34, 2);

-- --------------------------------------------------------

--
-- Structure de la table `diplome_intervenants`
--

DROP TABLE IF EXISTS `diplome_intervenants`;
CREATE TABLE IF NOT EXISTS `diplome_intervenants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_intervenant` int NOT NULL,
  `nom_diplome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `diplome_intervenants`
--

INSERT INTO `diplome_intervenants` (`id`, `id_intervenant`, `nom_diplome`) VALUES
(5, 31, 'Bac L'),
(6, 31, 'Bac  S'),
(7, 32, 'Formation Dév Web'),
(8, 32, 'Bac S'),
(9, 33, 'Bac L'),
(10, 34, 'Formation GMSI');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formation` varchar(255) NOT NULL,
  `position_intervenant_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `formation`, `position_intervenant_id`) VALUES
(1, 'Gestionnaire en maintenance et support informatique', 0),
(2, 'Développeur·se informatique', 0);

-- --------------------------------------------------------

--
-- Structure de la table `inscription_intervenant`
--

DROP TABLE IF EXISTS `inscription_intervenant`;
CREATE TABLE IF NOT EXISTS `inscription_intervenant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `civilite` varchar(10) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_de_naissance` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` varchar(10) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `inscription_intervenant`
--

INSERT INTO `inscription_intervenant` (`id`, `civilite`, `nom`, `prenom`, `date_de_naissance`, `adresse`, `code_postal`, `ville`, `telephone`) VALUES
(77, 'Monsieur', 'Don', 'Joe', '2024-04-17', '7 Avenue de la paix', '51100', 'Reims', '0766455663'),
(78, 'Monsieur', 'Smith', 'Jane', '2024-04-18', '7 Avenue de la paix', '51100', 'Reims', '0766345563'),
(79, 'Mademoisel', 'Jhonson', 'Emily', '2024-04-17', '7 Avenue de la paix', '51100', 'Reims', '0966447567'),
(80, 'Monsieur', 'Rivera', 'Jasmine', '2024-04-17', '7 Avenue de la paix', '51100', 'Reims', '0877676346');

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_formation` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `duree` varchar(255) NOT NULL,
  `position_intervenant_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `test` (`id_formation`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `modules`
--

INSERT INTO `modules` (`id`, `id_formation`, `nom`, `description`, `duree`, `position_intervenant_id`) VALUES
(1, 2, 'Analyser et formaliser le besoin de l’entreprise en solutions logicielles', 'Spécifications fonctionnelles\r\nInterconnexion et communication du système d’information\r\nLOTJ : Analyser le besoin logiciel de l’entreprise\r\nValidation Analyser le besoin logiciel de l’entreprise', '10 jours', 0),
(2, 2, 'Concevoir une solution informatique logicielle sous la responsabilité de son hiérarchique', 'Bases de la programmation et algorithmique\r\nIntroduction à la modélisation des données\r\nLOTJ : Concevoir une application informatique\r\nValidation Concevoir une application informatique', '10 jours', 0),
(3, 2, 'Développer une application informatique sous la responsabilité de son hiérarchique', 'LOTJ : Développer un site web et son application mobile\r\nValidation Développer un site web et son application mobile', '10 jours', 0),
(4, 2, 'Favoriser l’utilisation de l’application informatique par les utilisateurs', 'Tests et recette des applications\r\nNormes et optimisation du code source\r\nDéploiement et mise en service d’applications\r\nLOTJ : Déployer et maintenir une application informatique\r\nValidation Déployer et maintenir une application informatique', '10 jours', 0),
(5, 1, 'Assurer le support utilisateur\n', 'Fonctionnement d\'un ordinateur et de ses composants\nFondamentaux du réseau\nMicrosoft : prise en main\nCommunication support utilisateur\nLinux : commandes de bases\nQualité service client et charte informatique\nInitiation Microsoft 365\nOutils du technicien et diagnostic technique\nProjet collaboratif support utilisateur', '2 semaines', 0),
(6, 1, 'Administrer un parc informatique\n', 'Installation et configuration de Windows server\nRéseaux locaux\nLinux : configuration des services\nTechniques de virtualisation\nProjet collaboratif administration du parc informatique', '2 semaines', 0),
(9, 1, 'Déployer un parc informatique\n', 'Masterisation\nMicrosoft : gestion des mises à jour\nSécurisation du parc\nOutils d\'automatisation et scripting\nRéseaux commutation\nGestion de flotte mobile\nProjet collaboratif déploiement du parc informatique', '2 semaines', 0),
(10, 1, 'Gérer un parc informatique\n', 'Analyse fonctionnelle\nITIL et outil de helpdesk\nContrat de service\nOutils de gestion de parc\nBases de données relationnelles\nProjet collaboratif gestion du parc informatique', '2 semaines', 0),
(11, 1, 'Développer ses pratiques professionnelles\r\n', 'Rendre compte efficacement\r\nTraitement de données avec excel\r\nEngagement citoyen\r\nPratique de l\'anglais métier\r\nProjet professionnel\r\nSensibilisation aux métiers de la Data\r\nActualités métier et/ou territoire\r\nRetour d\'expérience et projection', '2 semaines', 0),
(12, 1, 'Certifier ses compétences de Gestionnaire en maintenance et support informatique\r\n', 'Team building : cohésion d\'équipe\r\nMéthodologie de projet d\'entreprise\r\nMéthodologie des écrits professionnels\r\nArgumenter pour convaincre', '2 semaines', 0);

-- --------------------------------------------------------

--
-- Structure de la table `position_intervenant`
--

DROP TABLE IF EXISTS `position_intervenant`;
CREATE TABLE IF NOT EXISTS `position_intervenant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_intervenant` int NOT NULL,
  `id_formation` int NOT NULL,
  `id_module` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_formation` (`id_formation`),
  KEY `id_intervenant` (`id_intervenant`),
  KEY `id_module` (`id_module`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `position_intervenant`
--

INSERT INTO `position_intervenant` (`id`, `id_intervenant`, `id_formation`, `id_module`) VALUES
(89, 31, 1, 5),
(90, 31, 1, 6),
(91, 31, 2, 1),
(92, 31, 2, 2),
(95, 32, 2, 3),
(96, 32, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `preinscription_utilisateur`
--

DROP TABLE IF EXISTS `preinscription_utilisateur`;
CREATE TABLE IF NOT EXISTS `preinscription_utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `id_formation` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_formation` (`id_formation`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `preinscription_utilisateur`
--

INSERT INTO `preinscription_utilisateur` (`id`, `id_utilisateur`, `id_formation`, `status`) VALUES
(14, 18, 1, 0),
(15, 19, 1, 0),
(16, 19, 2, 0),
(17, 20, 1, 0),
(18, 20, 2, 0),
(19, 22, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_relation_id` int NOT NULL,
  `diplome_relation_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `user_relation_id`, `diplome_relation_id`) VALUES
(31, 'test@gmail.com', '[]', '$2y$13$kohY6qPpO9HaZZ7bZvH2d.9Tr59EvInQZS736u5M9zA/DjqvpHRam', 77, 0),
(32, 'testtest@gmail.com', '[]', '$2y$13$Eyz5gY0GcBxPnu0dRznvNuBF1/Dt9vHazx8/ymTY.dRKH3LG8wmNO', 78, 0),
(33, 'qsdqsd@gmail.com', '[]', '$2y$13$VGEo876LTz13wAkRW9y3PON5EF1a3Uk0LReTChIxagNC.hQR9xmgS', 79, 0),
(34, 'cesi@gmail.com', '[]', '$2y$13$9J6ikMa5FQg40iVHCgTQlORWawdndNEWtLv20b36LX5EDGdumevm.', 80, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `civilite` varchar(10) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_de_naissance` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` varchar(10) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `diplome` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `cv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `civilite`, `nom`, `prenom`, `date_de_naissance`, `adresse`, `code_postal`, `ville`, `diplome`, `telephone`, `pays`, `cv`) VALUES
(18, 'Monsieur', 'Nguyen', 'Sophia', '2024-04-18', '7 Avenue de la paix', '51100', 'Reims', 'Licence Diplôme universitaire', '0766344563', 'France', '661c19525c106.pdf'),
(19, 'Monsieur', 'Liam', 'Patel', '2024-04-11', '7 Avenue de la paix', '51100', 'Reims', 'Licence Diplôme universitaire', '0766344545', 'France', '661c196b318e6.pdf'),
(20, 'Monsieur', 'Sophia', 'Reynolds', '2024-04-30', '7 Avenue de la paix', '06000', 'Nice', 'Bac +5 Informatique', '07633466547', 'France', '661e9200654b4.pdf'),
(21, 'Madame', 'Olivia', 'Chang', '2024-04-10', '7 Avenue de la paix', '06000', 'Nice', 'Bac +5 réseaux', '0788347674', 'France', NULL),
(22, 'Madame', 'Olivia', 'Chang', '2024-04-09', '7 Avenue de la paix', '06000', 'Nice', 'Bac +5 réseaux', '087734656', 'France', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `test` FOREIGN KEY (`id_formation`) REFERENCES `formations` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `preinscription_utilisateur`
--
ALTER TABLE `preinscription_utilisateur`
  ADD CONSTRAINT `preinscription_utilisateur_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formations` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `preinscription_utilisateur_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
