-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 19 mars 2024 à 07:29
-- Version du serveur : 8.0.31
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

DROP TABLE IF EXISTS `activites`;
CREATE TABLE IF NOT EXISTS `activites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `date_heure` datetime DEFAULT NULL,
  `nombre_places` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id`, `nom`, `description`, `date_heure`, `nombre_places`) VALUES
(1, 'Conférence sur les avancées en oncologie', 'Présentation des dernières avancées en oncologie par des experts renommés. Cette conférence abordera les nouveaux traitements, les thérapies ciblées et les défis à venir dans le domaine de l\'oncologie.', '2024-04-15 09:00:00', 50),
(2, 'Atelier sur la gestion de la douleur chronique', 'Formation sur les approches modernes de gestion de la douleur chronique. Cet atelier inclura des discussions sur les techniques pharmacologiques, non pharmacologiques et multidisciplinaires pour gérer la douleur chronique.', '2024-04-20 14:00:00', 50),
(3, 'Séminaire sur les thérapies géniques', 'Discussion sur les implications et les développements récents dans le domaine des thérapies géniques. Les sujets abordés incluront la technologie CRISPR, les vecteurs viraux et les applications cliniques des thérapies géniques.', '2024-05-10 10:30:00', 50),
(4, 'Formation sur les nouvelles normes de sécurité des médicaments', 'Formation sur les dernières normes et réglementations de sécurité des médicaments. Cette formation fournira des informations sur les essais cliniques, la surveillance post-commercialisation et les bonnes pratiques de fabrication.', '2024-05-15 13:00:00', 50),
(5, 'Table ronde sur les maladies cardiovasculaires', 'Échange d\'idées entre experts sur les traitements et les préventions des maladies cardiovasculaires. Cette table ronde discutera des avancées en matière de médicaments, de la modification du mode de vie et des défis dans la prise en charge des maladies cardiovasculaires.', '2024-06-05 11:00:00', 50);

-- --------------------------------------------------------

--
-- Structure de la table `effet_secondaire`
--

DROP TABLE IF EXISTS `effet_secondaire`;
CREATE TABLE IF NOT EXISTS `effet_secondaire` (
  `id_medicament` int NOT NULL,
  `id_effet` int NOT NULL,
  PRIMARY KEY (`id_medicament`,`id_effet`),
  KEY `id_effet` (`id_effet`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `effet_secondaire`
--

INSERT INTO `effet_secondaire` (`id_medicament`, `id_effet`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(3, 3),
(3, 4),
(4, 4),
(4, 5),
(5, 5),
(5, 6),
(6, 6),
(6, 7),
(7, 7),
(7, 8),
(8, 8),
(8, 9),
(9, 9),
(9, 10),
(10, 10),
(10, 11),
(11, 11),
(11, 12),
(12, 12),
(12, 13),
(13, 13),
(13, 14),
(14, 14),
(14, 15),
(15, 15),
(15, 16),
(16, 16),
(16, 17),
(17, 17),
(17, 18),
(18, 18),
(18, 19),
(19, 19),
(19, 20),
(20, 20),
(20, 21),
(21, 21),
(21, 22),
(22, 22),
(22, 23);

-- --------------------------------------------------------

--
-- Structure de la table `effet_therapeutique`
--

DROP TABLE IF EXISTS `effet_therapeutique`;
CREATE TABLE IF NOT EXISTS `effet_therapeutique` (
  `id_medicament` int NOT NULL,
  `id_effet` int NOT NULL,
  PRIMARY KEY (`id_medicament`,`id_effet`),
  KEY `id_effet` (`id_effet`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `effet_therapeutique`
--

INSERT INTO `effet_therapeutique` (`id_medicament`, `id_effet`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(3, 3),
(3, 4),
(4, 4),
(4, 5),
(5, 5),
(5, 6),
(6, 6),
(6, 7),
(7, 7),
(7, 8),
(8, 8),
(8, 9),
(9, 9),
(9, 10),
(10, 10),
(10, 11),
(11, 11),
(11, 12),
(12, 12),
(12, 13),
(13, 13),
(13, 14),
(14, 14),
(14, 15),
(15, 15),
(15, 16),
(16, 16),
(16, 17),
(17, 17),
(17, 18),
(18, 18),
(18, 19),
(19, 19),
(19, 20),
(20, 20),
(20, 21),
(21, 21),
(21, 22),
(22, 22),
(22, 23);

-- --------------------------------------------------------

--
-- Structure de la table `est_inscrit`
--

DROP TABLE IF EXISTS `est_inscrit`;
CREATE TABLE IF NOT EXISTS `est_inscrit` (
  `id_activite` int NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_activite`,`email`),
  KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déclencheurs `est_inscrit`
--
DROP TRIGGER IF EXISTS `desinscription_activite`;
DELIMITER $$
CREATE TRIGGER `desinscription_activite` AFTER DELETE ON `est_inscrit` FOR EACH ROW BEGIN
    UPDATE Activites 
    SET nombre_places = nombre_places + 1
    WHERE id = OLD.id_activite;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `inscription_activite`;
DELIMITER $$
CREATE TRIGGER `inscription_activite` AFTER INSERT ON `est_inscrit` FOR EACH ROW BEGIN
    UPDATE Activites 
    SET nombre_places = nombre_places - 1
    WHERE id = NEW.id_activite;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `liste_effets_secondaires`
--

DROP TABLE IF EXISTS `liste_effets_secondaires`;
CREATE TABLE IF NOT EXISTS `liste_effets_secondaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `effet` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `liste_effets_secondaires`
--

INSERT INTO `liste_effets_secondaires` (`id`, `effet`) VALUES
(1, 'Nausées'),
(2, 'Maux de tête'),
(3, 'Troubles gastro-intestinaux'),
(4, 'Allergies cutanées'),
(5, 'Insomnie'),
(6, 'Vertiges'),
(7, 'Fatigue'),
(8, 'Perte d\'appétit'),
(9, 'Diarrhée'),
(10, 'Constipation'),
(11, 'Rétention hydrique'),
(12, 'Hypertension'),
(13, 'Hypotension'),
(14, 'Tachycardie'),
(15, 'Palpitations'),
(16, 'Sécheresse buccale'),
(17, 'Vision floue'),
(18, 'Troubles de la mémoire'),
(19, 'Anxiété'),
(20, 'Dépression'),
(21, 'Somnolence'),
(22, 'Troubles du foie'),
(23, 'Troubles rénaux'),
(24, 'Risque accru d\'infections'),
(25, 'Hémorragies'),
(26, 'Prise de poids'),
(27, 'Problèmes respiratoires'),
(28, 'Irritation cutanée'),
(29, 'Crampes musculaires'),
(30, 'Étourdissements');

-- --------------------------------------------------------

--
-- Structure de la table `liste_effets_therapeutiques`
--

DROP TABLE IF EXISTS `liste_effets_therapeutiques`;
CREATE TABLE IF NOT EXISTS `liste_effets_therapeutiques` (
  `id` int NOT NULL AUTO_INCREMENT,
  `effet` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `liste_effets_therapeutiques`
--

INSERT INTO `liste_effets_therapeutiques` (`id`, `effet`) VALUES
(1, 'Antalgique'),
(2, 'Anti-inflammatoire'),
(3, 'Antipyrétique'),
(4, 'Antibiotique'),
(5, 'Antihistaminique'),
(6, 'Antiulcéreux'),
(7, 'Hypolipidémiant'),
(8, 'Hormones thyroïdiennes'),
(9, 'Sédatif'),
(10, 'Anxiolytique'),
(11, 'Antiémétique'),
(12, 'Antihypertenseur'),
(13, 'Anticoagulant'),
(14, 'Diurétique'),
(15, 'Antidiabétique'),
(16, 'Immunosuppresseur'),
(17, 'Corticostéroïde'),
(18, 'Antidépresseur'),
(19, 'Analgésique'),
(20, 'Antifongique'),
(21, 'Antiviral'),
(22, 'Antiparasitaire'),
(23, 'Antispasmodique'),
(24, 'Antitussif'),
(25, 'Antidiarrhéique'),
(26, 'Antiseptique'),
(27, 'Antifatigue'),
(28, 'Antioxydant'),
(29, 'Antirhumatismal'),
(30, 'Antibactérien');

-- --------------------------------------------------------

--
-- Structure de la table `medicaments`
--

DROP TABLE IF EXISTS `medicaments`;
CREATE TABLE IF NOT EXISTS `medicaments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `laboratoire_createur` varchar(255) DEFAULT NULL,
  `dose_max_journaliere` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `medicaments`
--

INSERT INTO `medicaments` (`id`, `nom`, `date_creation`, `laboratoire_createur`, `dose_max_journaliere`) VALUES
(1, 'Paracétamol', '2024-03-12', 'Sanofi', '500mg'),
(2, 'Ibuprofène', '2024-03-11', 'Pfizer', '400mg'),
(3, 'Aspirine', '2024-03-10', 'Novartis', '100mg'),
(4, 'Amoxicilline', '2024-03-09', 'Roche', '1000mg'),
(5, 'Loratadine', '2024-03-08', 'GlaxoSmithKline', '10mg'),
(6, 'Omeprazole', '2024-03-07', 'Merck', '20mg'),
(7, 'Simvastatine', '2024-03-06', 'AstraZeneca', '40mg'),
(8, 'Levothyroxine', '2024-03-05', 'Johnson & Johnson', '100mcg'),
(9, 'Mélatonine', '2024-03-04', 'Bayer', '3mg'),
(10, 'Diazépam', '2024-03-03', 'Abbott', '10mg'),
(11, 'Ranitidine', '2024-03-02', 'Boehringer Ingelheim', '150mg'),
(12, 'Atorvastatine', '2024-03-01', 'Eli Lilly', '20mg'),
(13, 'Acétaminophène', '2024-02-29', 'Mylan', '650mg'),
(14, 'Ciprofloxacine', '2024-02-28', 'Teva', '500mg'),
(15, 'Furosemide', '2024-02-27', 'Sandoz', '40mg'),
(16, 'Metformine', '2024-02-26', 'Sun Pharma', '1000mg'),
(17, 'Prednisone', '2024-02-25', 'Cipla', '10mg'),
(18, 'Citalopram', '2024-02-24', 'Dr. Reddy\'s', '20mg'),
(19, 'Venlafaxine', '2024-02-23', 'Wockhardt', '75mg'),
(20, 'Mirtazapine', '2024-02-22', 'Torrent', '30mg'),
(21, 'Warfarine', '2024-02-21', 'Ranbaxy', '5mg'),
(22, 'Céfalexine', '2024-02-20', 'Merck', '500mg');

-- --------------------------------------------------------

--
-- Structure de la table `reagit_avec`
--

DROP TABLE IF EXISTS `reagit_avec`;
CREATE TABLE IF NOT EXISTS `reagit_avec` (
  `id_medicament_1` int NOT NULL,
  `id_medicament_2` int NOT NULL,
  `reaction` text,
  PRIMARY KEY (`id_medicament_1`,`id_medicament_2`),
  KEY `id_medicament_2` (`id_medicament_2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reagit_avec`
--

INSERT INTO `reagit_avec` (`id_medicament_1`, `id_medicament_2`, `reaction`) VALUES
(1, 2, 'Peut causer des vertiges et une somnolence accrue'),
(1, 3, 'Interaction déconseillée chez les personnes souffrant de troubles gastro-intestinaux'),
(2, 3, 'Peut augmenter le risque de maux de tête et de nausées'),
(2, 4, 'Risque accru de saignements, éviter l\'utilisation conjointe'),
(3, 5, 'Peut provoquer une augmentation de la pression artérielle'),
(3, 6, 'Interaction potentielle avec des effets anticoagulants'),
(4, 7, 'Risque de réactions allergiques, à surveiller'),
(4, 8, 'Peut causer des troubles de la vision chez certaines personnes'),
(5, 9, 'Interaction possible avec des effets sur le métabolisme hépatique'),
(5, 10, 'Risque de somnolence accrue lorsqu\'il est combiné avec ce médicament'),
(6, 11, 'Peut augmenter le risque d\'irritation cutanée'),
(6, 12, 'Interaction à surveiller chez les personnes ayant des antécédents de troubles cardiaques'),
(7, 13, 'Risque accru de troubles rénaux'),
(7, 14, 'Peut interagir avec des médicaments antidiabétiques'),
(8, 15, 'Interaction possible avec des effets sur la fonction thyroïdienne'),
(8, 16, 'Peut augmenter le risque d\'hypotension chez certains patients'),
(9, 17, 'Peut causer une augmentation de la fréquence cardiaque'),
(9, 18, 'Interaction potentielle avec des médicaments sédatifs'),
(10, 19, 'Risque de réactions allergiques cutanées'),
(10, 20, 'Peut interagir avec des médicaments anti-anxiété'),
(11, 21, 'Risque accru de maux de tête et de vertiges'),
(11, 22, 'Peut augmenter le risque de troubles gastro-intestinaux');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `email` varchar(100) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

--
-- Déclencheurs `utilisateurs`
--
DROP TRIGGER IF EXISTS `suppression_utilisateur`;
DELIMITER $$
CREATE TRIGGER `suppression_utilisateur` AFTER DELETE ON `utilisateurs` FOR EACH ROW BEGIN
    DELETE FROM est_inscrit WHERE email = OLD.email;
END
$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;