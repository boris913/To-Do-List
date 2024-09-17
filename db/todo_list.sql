-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 17 sep. 2024 à 13:45
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
-- Base de données : `todo_list`
--

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `completed` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(100) DEFAULT 'Général',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `completed`, `created_at`, `category`) VALUES
(44, 'Planifier la réunion de projet - Organiser une réunion pour discuter des prochaines étapes du projet avec l\'équipe.', 1, '2024-09-14 14:24:14', 'Général'),
(43, 'Répondre aux emails importants - Traiter les messages électroniques urgents et répondre à ceux qui nécessitent une attention particulière.', 0, '2024-09-14 14:24:05', 'Général'),
(45, 'Mettre à jour le site web - Ajouter ou modifier du contenu sur le site web de l\'entreprise ou du projet personnel.', 0, '2024-09-14 14:24:49', 'Général'),
(42, 'Préparer le rapport mensuel - Rassembler toutes les données nécessaires et rédiger le rapport pour le mois écoulé.', 0, '2024-09-14 14:23:55', 'Général'),
(40, 'Développer une application de gestion de portefeuille électronique', 0, '2024-09-11 17:02:55', 'Général'),
(46, 'Faire les courses hebdomadaires - Acheter les provisions nécessaires pour la semaine', 1, '2024-09-14 14:25:14', 'Général'),
(47, 'Faire le ménage de la maison - Nettoyer les différentes pièces et organiser l’espace de vie.', 1, '2024-09-14 14:25:27', 'Général'),
(48, 'Réviser le budget mensuel - Vérifier les dépenses et les recettes pour le mois en cours.', 1, '2024-09-14 14:25:36', 'Général'),
(49, 'Créer un nouveau poste de blog - Rédiger et publier un nouvel article sur le blog.', 1, '2024-09-14 14:25:45', 'Général'),
(50, 'Envoyer des invitations pour l\'événement - Préparer et envoyer les invitations pour une prochaine réunion ou un événement.', 1, '2024-09-14 14:25:54', 'Général'),
(51, 'Préparer les documents pour la réunion - Rassembler tous les documents nécessaires pour une réunion importante.', 1, '2024-09-14 14:26:05', 'Général'),
(52, 'Réviser les objectifs de la semaine - Évaluer les progrès réalisés et ajuster les objectifs pour la semaine suivante.', 0, '2024-09-14 14:26:16', 'Général'),
(53, 'Prendre rendez-vous chez le médecin - Planifier un examen de routine ou une consultation médicale.', 0, '2024-09-14 14:26:26', 'Général'),
(54, 'Faire une promenade - Se détendre et se ressourcer avec une promenade en plein air.', 0, '2024-09-14 14:26:37', 'Général'),
(55, 'Lire un chapitre d\'un livre - Avancer dans la lecture d\'un livre en cours', 0, '2024-09-14 14:26:57', 'Général'),
(56, 'Organiser le bureau - Ranger et organiser l’espace de travail pour améliorer la productivité.', 0, '2024-09-14 14:27:08', 'Général'),
(57, 'Mettre a jour les plugins', 0, '2024-09-16 09:53:50', 'Général'),
(58, 'Développer une application de gestion de portefeuille électronique', 0, '2024-09-16 09:54:54', 'Général'),
(59, 'je mange le soja', 1, '2024-09-16 09:58:25', 'Général'),
(60, 'Développer une application de gestion de portefeuille électronique', 0, '2024-09-16 09:59:18', 'Général'),
(61, 'Mettre a jour les plugins', 0, '2024-09-16 10:02:53', 'Général'),
(62, 'Développer une application de gestion de portefeuille électronique', 1, '2024-09-16 10:07:05', NULL),
(63, 'Développer une application de gestion de portefeuille électronique', 1, '2024-09-16 10:07:18', NULL),
(64, 'Mettre a jour les plugins', 1, '2024-09-16 11:35:38', 'Général'),
(65, 'Développer une application de gestion de portefeuille électronique', 1, '2024-09-16 11:35:56', 'Travail'),
(66, 'Développer une application de gestion de portefeuille électronique', 1, '2024-09-16 12:01:32', 'Travail'),
(67, 'Mettre a jour les plugins', 0, '2024-09-16 12:03:10', 'Personnel'),
(68, 'je suis', 0, '2024-09-16 12:04:25', 'Général'),
(69, 'faire des pates', 0, '2024-09-16 12:57:39', 'Personnel'),
(70, 'faire le diner', 0, '2024-09-16 12:57:51', 'Urgent'),
(71, 'faire l\'appel', 1, '2024-09-16 12:57:59', 'Urgent'),
(72, 'repassage des habits', 1, '2024-09-16 13:19:29', 'Travail'),
(73, 'faire la vaisselle', 1, '2024-09-17 13:29:31', 'Personnel'),
(74, 'faire du sport', 1, '2024-09-17 13:29:45', 'Personnel'),
(75, '100 pompes.', 1, '2024-09-17 13:30:03', 'Personnel'),
(76, 'Mettre a jour les plugins', 0, '2024-09-17 13:35:33', 'Urgent'),
(77, 'Développer une application de gestion de portefeuille électronique', 0, '2024-09-17 13:35:41', 'Urgent'),
(78, 'Développer une application de gestion de portefeuille électronique', 0, '2024-09-17 13:35:47', 'Travail');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
