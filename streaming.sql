-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 21 nov. 2024 à 07:46
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `streaming`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnements`
--

DROP TABLE IF EXISTS `abonnements`;
CREATE TABLE IF NOT EXISTS `abonnements` (
  `id_abonnements` int NOT NULL AUTO_INCREMENT,
  `nom_abonnements` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prix_abonnements` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description_abonnements` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `avantages1_abonnements` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `avantages2_abonnements` varchar(255) NOT NULL,
  `avantages3_abonnements` varchar(255) NOT NULL,
  `image_abonnements` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_abonnements`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `abonnements`
--

INSERT INTO `abonnements` (`id_abonnements`, `nom_abonnements`, `prix_abonnements`, `description_abonnements`, `avantages1_abonnements`, `avantages2_abonnements`, `avantages3_abonnements`, `image_abonnements`) VALUES
(1, 'Classique ', '10 € / mois', 'L\'abonnement Classique offre un accès de base à notre plateforme de streaming.', '- Accès à une sélection de contenu limitée mais diversifiée. ', '- Qualité de diffusion en haute définition (HD). ', '- Possibilité de visionner sur un seul appareil à la fois. Absence de publicités pendant la lecture du contenu. Options de recherche et de tri de base ', ''),
(2, 'Medium ', '15 € / mois', 'L\'abonnement Medium offre une expérience améliorée par rapport à l\'abonnement Classique.', '- Accès à une bibliothèque de contenu plus vaste et récente. ', '- Qualité de diffusion en haute définition (HD) voire en ultra haute définition (UHD/4K) selon la disponibilité du contenu. ', '- Possibilité de visionner sur plusieurs appareils simultanément (2 ou 3 app', ''),
(3, 'Premium ', '30 € / mois', 'L\'abonnement Premium offre une expérience complète et haut de gamme pour les utilisateurs les plus exigeants.', '- Accès à l\'intégralité de notre catalogue y compris les dernières sorties et les exclusivités. ', '- Qualité de diffusion maximale en ultra haute définition (UHD/4K) avec prise en charge du HDR (High Dynamic Range) pour une qualité d\'image exceptionnelle. Visio', '- Possibilité de visionner sur un nombre illimité d\'appareils simultanément', ''),
(4, 'Pas d\'abonnement', '0', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `abonnements_users`
--

DROP TABLE IF EXISTS `abonnements_users`;
CREATE TABLE IF NOT EXISTS `abonnements_users` (
  `id_abonnements_users` int NOT NULL AUTO_INCREMENT,
  `id_users` int NOT NULL,
  `id_abonnements` int NOT NULL,
  PRIMARY KEY (`id_abonnements_users`),
  KEY `users_id` (`id_users`),
  KEY `abonnements_id` (`id_abonnements`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `details`
--

DROP TABLE IF EXISTS `details`;
CREATE TABLE IF NOT EXISTS `details` (
  `id_details` int NOT NULL AUTO_INCREMENT,
  `id_abonnements` int NOT NULL,
  `qualite` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nb_users_simult` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `compatibilite` varchar(255) NOT NULL,
  `maj_reguliere` varchar(50) NOT NULL,
  `annulation` varchar(255) NOT NULL,
  `supp_client` varchar(10) NOT NULL,
  PRIMARY KEY (`id_details`),
  KEY `id_abonnements` (`id_abonnements`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `details`
--

INSERT INTO `details` (`id_details`, `id_abonnements`, `qualite`, `nb_users_simult`, `compatibilite`, `maj_reguliere`, `annulation`, `supp_client`) VALUES
(1, 1, 'HD', '1 personne', 'Téléphone portable, ordinateur, télévision', 'Chaque jour', 'À tout moment', 'week-end'),
(2, 2, 'HD, UHD, 4K', '3 personnes', 'Téléphone portable, ordinateur, télévision', 'Chaque jour', 'À tout moment', '24H/24H'),
(3, 3, 'HD, UHD, 4K, HDR (High Dynamic Range)', 'illimité', 'Tout type d\'appareils', 'Chaque jour', 'À tout moment', '24H/24H'),
(4, 4, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

DROP TABLE IF EXISTS `films`;
CREATE TABLE IF NOT EXISTS `films` (
  `id_films` int NOT NULL AUTO_INCREMENT,
  `titre_films` varchar(50) NOT NULL,
  `name_actor` varchar(100) NOT NULL,
  `description_films` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `durree_films` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image_films` varchar(255) NOT NULL,
  `video_films` varchar(255) NOT NULL,
  `id_abonnement` int DEFAULT NULL,
  PRIMARY KEY (`id_films`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id_films`, `titre_films`, `name_actor`, `description_films`, `durree_films`, `image_films`, `video_films`, `id_abonnement`) VALUES
(1, 'Arcane', 'Riot Games', 'Le scénario suit principalement Jinx et Vi, deux sœurs ayant vécu une enfance difficile à Zaun, mais qui, désormais adultes, mènent une vie très différente l\'une de l\'autre, ainsi que Jayce et Viktor, deux scientifiques ayant découvert et stabilisé une gemme permettant de grandes avancées technologiques.', '6H', '/site-streaming/img/arcane.png', '/site-streaming/video/arcane.mp4', 3),
(2, 'Breaking Bad', 'Vince Gilligan', 'Les médecins ne lui donnent pas plus de deux ans à vivre. Pour réunir rapidement beaucoup d\'argent afin de mettre sa famille à l\'abri, Walter ne voit plus qu\'une solution : mettre ses connaissances en chimie à profit pour fabriquer et vendre du crystal meth, une drogue de synthèse qui rapporte beaucoup.', '1 jour et 22 heures', '/site-streaming/img/breaking_bad.jpg', '/site-streaming/video/breaking.mp4', 3),
(3, 'Le Voyage de Chihiro', 'Hayao Miyazaki', 'Chihiro est une petite fille de dix ans, grincheuse et gâtée, recroquevillée à l\'arrière de la voiture de ses parents. Ils approchent de leur nouvelle maison, et elle est triste de quitter sa vie d\'avant. Par erreur, s\'étant engagés dans une « forêt obscure », ils se retrouvent dans un parc de loisirs abandonné.', '2h 5m', '/site-streaming/img/chihiro.png', '/site-streaming/video/chihiro.mp4', 3),
(4, 'Peaky Blinders', 'Steven Knight', 'À Birmingham, en 1919, les hommes sont rentrés de la guerre et ont repris leurs activités. Notamment les frères Shelby, à la tête d\'un gang redouté, les Peaky Blinders. Spécialisés dans les paris clandestins et les trafics en tous genres, ils tombent sur une cargaison d\'armes à feu volées.', '1 jour et six heures', '/site-streaming/img/peaky.png', '/site-streaming/video/peaky.mp4', 3),
(5, 'One Piece', 'Eiichirō Oda', 'One Piece raconte les aventures d\'une bande de pirates, menée par le capitaine Monkey D. Luffy (qui a pour ambition de devenir le roi des pirates) et lancée à la recherche du trésor, nommé One Piece, du légendaire roi des pirates Gold Roger, mort sans avoir révélé l\'emplacement de son butin.', 'près de quatorze jours complets', '/site-streaming/img/one_piece.jpe\n', '/site-streaming/video/one_piece.mp4', 3),
(6, 'The Boys', 'Eric Kripke', 'L\'histoire se déroule dans un monde où des super-héros, appelés les \"Sept\", sont vénérés comme des célébrités, mais en réalité, ils abusent de leurs pouvoirs et sont moralement corrompus. Un groupe de personnes ordinaires, connu sous le nom de \"The Boys\", décide de s\'opposer à ces super-héros corrompus. Menés par Billy Butcher, les membres de l\'équipe cherchent à exposer la vérité sur les actions des super-héros et à les tenir responsables de leurs crimes. La série aborde des thèmes sombres, mettant en lumière la nature dépravée de la célébrité et du pouvoir tout en offrant une satire sociale et politique. Elle combine action, humour noir et une critique cynique du genre des super-héros.', '25 H', '/site-streaming/img/boys', '/site-streaming/video/boys.mp4', NULL),
(7, 'Reacher', 'Thomas Vincent', 'Ancien officier de la police militaire désormais à la retraite, Jack Reacher mène une vie de nomade, voyageant à travers les Etats-Unis. Alors qu\'il se trouve dans la ville de Margrave, en Géorgie, il est arrêté pour un meurtre qu\'il n\'a pas commis.', '50 min', '/site-streaming/img/reacher.jpg', '/site-streaming/video/reacher.mp4', NULL),
(8, 'Rrrrrrr', 'Alain Chabat', 'Il y a 37.000 ans, deux tribus voisines sont rivales. Pendant que la tribu des Cheveux Propres coule des jours paisibles en gardant pour elle seule le secret de la formule du shampooing, la tribu des Cheveux Sales se lamente. Son chef décide d\'envoyer un espion pour voler la recette, mais un événement bien plus grave va bouleverser la vie des Cheveux Propres : pour la première fois dans l\'histoire de l\'humanité, un crime vient d\'être commis.', '98 min ', '/site-streaming/img/rrrr.jpg', '/site-streaming/video/rrrrrrr.mp4', NULL),
(9, 'Les Bronzés 3', 'Patrice Leconte', 'Depuis quelques années, ils se retrouvent chaque été, pour une semaine, au Prunus Resort, hôtel de luxe et de bord de mer, dont Popeye s\'occupe plus ou moins bien en tant que gérant, et qui appartient à sa femme, Graziella Lespinasse, héritière d\'une des plus grosses fortunes italiennes. Que sont devenus les Bronzés 27 ans après ? Réponse hâtive : les mêmes, en pire.', '1H', '/site-streaming/img/bronze.jpg', '/site-streaming/video/bronzes.mp4', NULL),
(10, 'La Casa de Papel', 'Álex Pina', 'Un homme mystérieux, surnommé le Professeur (El Profesor), planifie le meilleur braquage jamais organisé. Pour exécuter son plan, il recrute les meilleurs malfaiteurs du pays qui n\'ont rien à perdre : Tokyo, Nairobi, Río, Moscou, Berlin, Denver, Helsinki et Oslo.', '2H', '/site-streaming/img/casa.jpg', '/site-streaming/video/papel.mp4', NULL),
(11, 'Lucifer', 'Thomas Joseph Welling, dit Tom Welling', 'Lucifer Morningstar, fatigué de son rôle Seigneur des Enfers décide d\'abandonner son poste et s\'installe à Los Angeles où il dirige sa propre boîte de nuit, le Lux. Il est doté, outre sa force surhumaine et son invincibilité, d\'un pouvoir de persuasion qui pousse les gens à lui avouer leurs désirs les plus secrets.', '50 min ', '/site-streaming/img/lucifer.jpg', '/site-streaming/video/lucifer.mp4', NULL),
(12, 'Oggy et les Cafards', 'Olivier Jean-Marie Animateur français', 'Oggy est un chat bleu qui vit dans une grande maison avec trois cafards: Deedee, Joey et Marky. Et si Oggy est un fainéant, gentil mais un peu mou, les trois cafards sont tout le contraire ! L\'objectif des trois bestioles, c\'est d\'embêter Oggy autant qu\'ils peuvent, jusqu\'à lui pourrir la vie !', '20 min', '/site-streaming/img/oggy.jpg', '/site-streaming/video/oggy.mp4', NULL),
(13, 'Zig et Sharko', 'Olivier Jean-Marie', 'Synopsis. La série suit Zig, une hyène mâle anthropomorphe famélique vivant sur une île déserte. Durant toute la série, Zig tente de trouver des idées novatrices dans le but de dévorer Marina, une belle sirène vivant sur un rocher localisé au large. Elle est caractérielle, un peu naïve et égocentrique.', '800 H', '/site-streaming/img/zig.jpg', '/site-streaming/video/zig.mp4', NULL),
(19, 'Ready Player 0ne', 'Steven Spielberg', 'En 2045, la planète frôle le chaos et s\'effondre, mais les gens trouvent du réconfort dans l\'OASIS, un monde virtuel créé par James Halliday. Lorsque Halliday meurt, il promet son immense fortune à la première personne qui découvre un oeuf de Pâques numérique caché dans l\'OASIS. Quand le jeune Wade Watts se joint au concours, il devient un héros improbable dans une chasse au trésor qui traverse des mondes fantastiques pleins de mystères, de découvertes et de dangers.', '2h 20m', '/site-streaming/img/player.jpg\n', '/site-streaming/video/player.mp4\n', NULL),
(20, 'How to Sell Drugs Online', 'Arne Feldhusen', 'Pour reconquérir son ex, un ado fou d\'informatique se met à vendre de l\'ecstasy en ligne, et devient l\'un des plus gros dealers d\'Europe... sans quitter sa chambre. Regardez autant que vous voulez. Prix Adolf-Grimme du Meilleur programme pour enfants et jeunes.', '32 min', '/site-streaming/img/drugs.jpg', '/site-streaming/video/drugs.mp4', NULL),
(21, 'Ça', 'Andrés Muschietti', 'Sept enfants font face à une horreur inimaginable qui apparait sous plusieurs formes, et notamment “Grippe-sou”, un clown qui vit, chasse et tue dans les égouts de la ville. Des années plus tard, ces adultes qui ont survécu, sont assez courageux pour retourner à Derry et arrêter cette tuerie, et cette fois pour de bon.', '135 minutes', '/site-streaming/img/ça.jpg', '/site-streaming/video/ça.mp4', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id_langue` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id_langue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int NOT NULL AUTO_INCREMENT,
  `last_name_users` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `first_name_users` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ddn_users` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `adresse_post_users` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `adresse_mail_users` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `identifiant_users` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mdp_users` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnements_users`
--
ALTER TABLE `abonnements_users`
  ADD CONSTRAINT `relation_abonnements` FOREIGN KEY (`id_abonnements`) REFERENCES `abonnements` (`id_abonnements`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relation_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`id_abonnements`) REFERENCES `abonnements` (`id_abonnements`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
