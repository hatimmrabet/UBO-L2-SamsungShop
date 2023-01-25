-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 07 nov. 2019 à 16:31
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `zfl2-zm_rabeha`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_categorie_cat`
--

DROP TABLE IF EXISTS `t_categorie_cat`;
CREATE TABLE IF NOT EXISTS `t_categorie_cat` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_intitule` varchar(100) NOT NULL,
  `cat_date` date DEFAULT NULL,
  `cat_autorisation` char(1) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_categorie_cat`
--

INSERT INTO `t_categorie_cat` (`cat_id`, `cat_intitule`, `cat_date`, `cat_autorisation`) VALUES
(1, 'NOUVEAUTÉS :', '2019-10-26', 'G'),
(2, 'PROMOTIONS :', '2019-10-26', 'G'),
(3, 'TABLETTES :', '2019-10-26', 'R'),
(4, 'ÉLECTROMÉNAGER :', '2019-10-26', 'R'),
(5, 'TÉLÉVISEURS :', '2019-10-26', 'R'),
(6, 'SMARTPHONES :', '2019-10-26', 'R');

-- --------------------------------------------------------

--
-- Structure de la table `t_compte_cpt`
--

DROP TABLE IF EXISTS `t_compte_cpt`;
CREATE TABLE IF NOT EXISTS `t_compte_cpt` (
  `cpt_pseudo` varchar(60) NOT NULL,
  `cpt_psswd` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cpt_pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_compte_cpt`
--

INSERT INTO `t_compte_cpt` (`cpt_pseudo`, `cpt_psswd`) VALUES
('fabrigas_cesc', 'bf36f6b59e1e3889c91daea616877924'),
('gestionnaire1', '21fdb730e736b3577ce0961a604e2b6b'),
('haitam_mrabet', '38bcec648a83b7c63eb515771a41ec2c'),
('hatim', '827ccb0eea8a706c4c34a16891f84e7b'),
('iheb_chemkhi', '1332427397e32f2888799456eb1cee34'),
('khalid_ahannach', '827ccb0eea8a706c4c34a16891f84e7b'),
('leo_messi', '2dafaffcd2f1f8e813834473e380080e'),
('ouma_ork', '8e7aef75dad24742365609c64928574c'),
('root', '63a9f0ea7bb98050796b649e85481845'),
('thomas_larue', '8766814f87d4790bd6c5f52d12b98da6');

-- --------------------------------------------------------

--
-- Structure de la table `t_information_inf`
--

DROP TABLE IF EXISTS `t_information_inf`;
CREATE TABLE IF NOT EXISTS `t_information_inf` (
  `inf_id` int(11) NOT NULL AUTO_INCREMENT,
  `inf_texte` varchar(200) DEFAULT NULL,
  `inf_date_ajout` date DEFAULT NULL,
  `inf_etat` char(1) DEFAULT 'C',
  `cpt_pseudo` varchar(60) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`inf_id`),
  KEY `cpt_pseudo` (`cpt_pseudo`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_information_inf`
--

INSERT INTO `t_information_inf` (`inf_id`, `inf_texte`, `inf_date_ajout`, `inf_etat`, `cpt_pseudo`, `cat_id`) VALUES
(1, 'Galaxy Note10 et Galaxy S10 : Le pouvoir de créer.\r\nCapturez comme un pro, éditez et prenez des notes, le tout à votre façon.', '2019-10-26', 'L', 'hatim', 1),
(2, 'Réfrigérateur multi-portes 520L - RFG23UEBP', '2019-10-28', 'C', 'hatim', 4),
(3, 'Galaxy S10e, S10 et S10+. La nouvelle génération de Galaxy est arrivée.', '2019-10-28', 'C', 'hatim', 6),
(4, 'TV QLED - Jusqu’à 1000€ remboursés sur une sélection de téléviseurs Samsung', '2019-10-28', 'L', 'root', 2),
(5, 'Barre de son Sound+ 3.0, Wi-Fi, Bluetooth - HW-MS650', '2019-10-28', 'L', 'root', 1),
(6, 'Galaxy Note10 | Note10+', '2019-10-28', 'C', 'hatim', 1),
(7, 'Galaxy Tab S6\r\nLa meilleure des tablettes', '2019-10-28', 'L', 'root', 3),
(8, 'Galaxy Tab S5e\r\n', '2019-10-28', 'L', 'root', 3),
(9, 'Découvrez la nouvelle Galaxy Tab A', '2019-10-28', 'L', 'root', 3),
(10, 'Galaxy Book (12’’, Windows 10 Famille, 128 Go, Wi-Fi)', '2019-10-28', 'L', 'root', 3),
(11, 'Galaxy Book (10,6’’, Windows 10 Famille, 64 Go, Wi-Fi)', '2019-10-28', 'L', 'root', 3),
(12, 'QLED 8K/4K - Une qualité d’image exceptionnelle', '2019-10-28', 'L', 'root', 5),
(13, 'TV Lifestyle - Un design unique', '2019-10-28', 'L', 'root', 5),
(14, 'TV UHD 4K - L\'excellence jusque dans les moindres détails', '2019-10-28', 'L', 'root', 5),
(15, 'TV Full HD/HD - Le meilleur de la Full HD', '2019-10-28', 'L', 'root', 5),
(16, 'Famille Galaxy S10 et Galaxy Buds\r\nValable du 04/10/2019 au 03/11/2019', '2019-10-28', 'C', 'gestionnaire1', 2),
(17, 'Micro-ondes Solo, 23L - MS23K3555EW', '2019-10-28', 'C', 'gestionnaire1', 4),
(18, 'Micro-ondes MS23K3614AS Solo 23L', '2019-10-28', 'C', 'gestionnaire1', 4),
(19, 'Linear Wash 39 dBA Dishwasher in Stainless Steel', '2019-10-28', 'C', 'gestionnaire1', 4),
(20, 'Aspirateur VCF500G à fort pouvoir aspirant, 700 W, Bleu Vital', '2019-10-28', 'C', 'gestionnaire1', 4),
(21, 'Aspirateur VR9000H à aspiration puissante, 40 W', '2019-10-28', 'C', 'gestionnaire1', 4),
(22, 'Galaxy S9\r\n', '2019-10-28', 'C', 'gestionnaire1', 6),
(23, 'Galaxy S8 ', '2019-10-28', 'C', 'gestionnaire1', 6),
(24, 'Galaxy S10 ', '2019-10-28', 'C', 'gestionnaire1', 6),
(25, 'Galaxy A80', '2019-10-28', 'C', 'gestionnaire1', 6),
(26, 'Galaxy Watch Active', '2019-10-28', 'L', 'root', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_liste_lis`
--

DROP TABLE IF EXISTS `t_liste_lis`;
CREATE TABLE IF NOT EXISTS `t_liste_lis` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `url_id` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`,`url_id`),
  KEY `url_id` (`url_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `t_liste_lis`
--

INSERT INTO `t_liste_lis` (`cat_id`, `url_id`) VALUES
(6, 1),
(1, 2),
(6, 2),
(6, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `t_news_new`
--

DROP TABLE IF EXISTS `t_news_new`;
CREATE TABLE IF NOT EXISTS `t_news_new` (
  `new_num` int(11) NOT NULL AUTO_INCREMENT,
  `new_titre` varchar(30) NOT NULL,
  `new_texte` varchar(200) NOT NULL,
  `new_date` date DEFAULT NULL,
  `new_etat` char(1) DEFAULT 'C',
  `cpt_pseudo` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`new_num`),
  KEY `cpt_pseudo` (`cpt_pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_news_new`
--

INSERT INTO `t_news_new` (`new_num`, `new_titre`, `new_texte`, `new_date`, `new_etat`, `cpt_pseudo`) VALUES
(1, 'Fermeture exceptionnelle:', 'Notre Boutique va fermer aujourd\'hui à midi ', '2019-10-30', 'C', 'root'),
(2, 'Ouverture exceptionnelle:', 'Notre Boutique va ouvrir ses portes le dimanche à partir de 12h ', '2019-11-30', 'C', 'root'),
(3, 'Recherche agents :', 'Notre Boutique recherche des agents de remplacement, Deposez vos CV à l\'accueil ', '2019-12-15', 'L', 'root');

-- --------------------------------------------------------

--
-- Structure de la table `t_profil_pfl`
--

DROP TABLE IF EXISTS `t_profil_pfl`;
CREATE TABLE IF NOT EXISTS `t_profil_pfl` (
  `pfl_nom` varchar(60) NOT NULL,
  `pfl_prenom` varchar(60) NOT NULL,
  `pfl_mail` varchar(60) NOT NULL,
  `pfl_statut` char(1) DEFAULT 'R',
  `pfl_validite` char(1) DEFAULT 'D',
  `cpt_pseudo` varchar(60) NOT NULL,
  `pfl_date` date NOT NULL,
  PRIMARY KEY (`cpt_pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_profil_pfl`
--

INSERT INTO `t_profil_pfl` (`pfl_nom`, `pfl_prenom`, `pfl_mail`, `pfl_statut`, `pfl_validite`, `cpt_pseudo`, `pfl_date`) VALUES
('FABRIGAS', 'Cesc', 'cesc@asmonaco.fr', 'R', 'D', 'fabrigas_cesc', '2019-10-25'),
('MARC', 'Valérie', 'vmarc@gmail.com', 'G', 'A', 'gestionnaire1', '2019-10-25'),
('M\'RABET', 'Haitam', 'haitam_mrabet@gmail.com', 'R', 'D', 'haitam_mrabet', '2019-10-25'),
('M\'RABET EL KHOMSSI', 'Hatim', 'mrabet.hatim2018@gmail.com', 'G', 'A', 'hatim', '2019-10-25'),
('CHEMKHI', 'Iheb', 'iheb_chemkhi@gmail.com', 'R', 'D', 'iheb_chemkhi', '2019-10-25'),
('AHANNACH', 'Khalid', 'khalid02@gmail.com', 'R', 'D', 'khalid_ahannach', '2019-10-25'),
('LIONNEL', 'Messi', 'messi@fcb.es', 'R', 'D', 'leo_messi', '2019-10-25'),
('OURKIA', 'Oumaima', 'ouma_ork@gmail.com', 'R', 'D', 'ouma_ork', '2019-10-25'),
('root', 'admin', 'admin@root.com', 'G', 'A', 'root', '2019-10-25'),
('LARUE', 'Thomas', 'thomas_larue@gmail.com', 'R', 'D', 'thomas_larue', '2019-10-25');

-- --------------------------------------------------------

--
-- Structure de la table `t_url_url`
--

DROP TABLE IF EXISTS `t_url_url`;
CREATE TABLE IF NOT EXISTS `t_url_url` (
  `url_id` int(11) NOT NULL AUTO_INCREMENT,
  `url_nom` varchar(90) NOT NULL,
  `url_chaine` varchar(350) DEFAULT NULL,
  PRIMARY KEY (`url_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_url_url`
--

INSERT INTO `t_url_url` (`url_id`, `url_nom`, `url_chaine`) VALUES
(1, 'Samsung S10', 'https://www.samsung.com/fr/smartphones/galaxy-s10/'),
(2, 'Galaxy S10+', 'https://www.samsung.com/fr/smartphones/galaxy-s10+/'),
(3, 'Galaxy S8+', 'https://www.samsung.com/fr/smartphones/galaxy-s8/'),
(4, 'Réfrigérateur multi-portes', 'https://www.samsung.com/fr/refrigerators/multi-door-rfg23uebp1/');

-- --------------------------------------------------------

--
-- Structure de la table `t_visuel_vis`
--

DROP TABLE IF EXISTS `t_visuel_vis`;
CREATE TABLE IF NOT EXISTS `t_visuel_vis` (
  `vis_id` int(11) NOT NULL AUTO_INCREMENT,
  `vis_descriptif` varchar(100) DEFAULT NULL,
  `vis_nom_fichier` varchar(20) NOT NULL,
  `vis_date_ajout` date DEFAULT NULL,
  `vis_visibilite` char(1) NOT NULL,
  `cpt_pseudo` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`vis_id`),
  KEY `cpt_pseudo` (`cpt_pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_visuel_vis`
--

INSERT INTO `t_visuel_vis` (`vis_id`, `vis_descriptif`, `vis_nom_fichier`, `vis_date_ajout`, `vis_visibilite`, `cpt_pseudo`) VALUES
(1, 'Photo de S10+', 's10.jpg', '2019-10-28', 'L', 'hatim'),
(2, 'Photo de S8', 's8.jpg', '2019-10-28', 'L', 'hatim'),
(3, 'Photo de NOTE 9', 'note9.jpg', '2019-10-28', 'L', 'hatim'),
(4, 'Photo de NOTE 10', 'note10.jpg', '2019-10-28', 'L', 'hatim');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_information_inf`
--
ALTER TABLE `t_information_inf`
  ADD CONSTRAINT `t_information_inf_ibfk_1` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`),
  ADD CONSTRAINT `t_information_inf_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `t_categorie_cat` (`cat_id`);

--
-- Contraintes pour la table `t_liste_lis`
--
ALTER TABLE `t_liste_lis`
  ADD CONSTRAINT `t_liste_lis_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `t_categorie_cat` (`cat_id`),
  ADD CONSTRAINT `t_liste_lis_ibfk_2` FOREIGN KEY (`url_id`) REFERENCES `t_url_url` (`url_id`);

--
-- Contraintes pour la table `t_news_new`
--
ALTER TABLE `t_news_new`
  ADD CONSTRAINT `t_news_new_ibfk_1` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);

--
-- Contraintes pour la table `t_profil_pfl`
--
ALTER TABLE `t_profil_pfl`
  ADD CONSTRAINT `t_profil_pfl_ibfk_1` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);

--
-- Contraintes pour la table `t_visuel_vis`
--
ALTER TABLE `t_visuel_vis`
  ADD CONSTRAINT `t_visuel_vis_ibfk_1` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
