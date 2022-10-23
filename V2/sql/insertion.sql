
INSERT INTO `t_categorie_cat` (`cat_id`, `cat_intitule`, `cat_date`, `cat_autorisation`) VALUES
(1, 'NOUVEAUTÉS :', '2019-10-26', 'G'),
(2, 'PROMOTIONS :', '2019-10-26', 'G'),
(3, 'TABLETTES :', '2019-10-26', 'R'),
(4, 'ÉLECTROMÉNAGER :', '2019-10-26', 'R'),
(5, 'TÉLÉVISEURS :', '2019-10-26', 'R'),
(6, 'SMARTPHONES :', '2019-10-26', 'R');


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


INSERT INTO `t_information_inf` (`inf_id`, `inf_texte`, `inf_date_ajout`, `inf_etat`, `cpt_pseudo`, `cat_id`) VALUES
(1, 'Galaxy Note10 et Galaxy S10 : Le pouvoir de créer.\r\nCapturez comme un pro, éditez et prenez des notes, le tout à votre façon.', '2019-10-26', 'L', 'hatim', 1),
(2, 'Réfrigérateur multi-portes 520L - RFG23UEBP', '2019-10-28', 'C', 'hatim', 4),
(3, 'Galaxy S10e, S10 et S10+. La nouvelle génération de Galaxy est arrivée.', '2019-10-28', 'C', 'hatim', 6),
(4, 'TV QLED - Jusqu’à 1000€ remboursés sur une sélection de téléviseurs Samsung', '2019-10-28', 'C', 'root', 2),
(5, 'Barre de son Sound+ 3.0, Wi-Fi, Bluetooth - HW-MS650', '2019-10-28', 'C', 'root', 1),
(7, 'Galaxy Tab S6\r\nLa meilleure des tablettes', '2019-10-28', 'L', 'root', 3),
(8, 'Galaxy Tab S5e\r\n', '2019-10-28', 'L', 'root', 3),
(9, 'Découvrez la nouvelle Galaxy Tab A', '2019-10-28', 'L', 'root', 3),
(10, 'Galaxy Book (12’’, Windows 10 Famille, 128 Go, Wi-Fi)', '2019-10-28', 'L', 'root', 3),
(11, 'Galaxy Book (10,6’’, Windows 10 Famille, 64 Go, Wi-Fi)', '2019-10-28', 'L', 'root', 3),
(12, 'QLED 8K/4K - Une qualité d’image exceptionnelle', '2019-10-28', 'L', 'root', 5),
(13, 'TV Lifestyle - Un design unique', '2019-10-28', 'L', 'root', 5),
(14, 'TV UHD 4K - L\'excellence jusque dans les moindres détails', '2019-10-28', 'C', 'root', 5),
(15, 'TV Full HD/HD - Le meilleur de la Full HD', '2019-10-28', 'C', 'root', 5),
(16, 'Famille Galaxy S10 et Galaxy Buds\r\nValable du 04/10/2019 au 03/11/2019', '2019-10-28', 'C', 'gestionnaire1', 2),
(17, 'Micro-ondes Solo, 23L - MS23K3555EW', '2019-10-28', 'C', 'gestionnaire1', 4),
(18, 'Micro-ondes MS23K3614AS Solo 23L', '2019-10-28', 'C', 'gestionnaire1', 4),
(19, 'Linear Wash 39 dBA Dishwasher in Stainless Steel', '2019-10-28', 'C', 'gestionnaire1', 4),
(20, 'Aspirateur VCF500G à fort pouvoir aspirant, 700 W, Bleu Vital', '2019-10-28', 'C', 'gestionnaire1', 4),
(21, 'Aspirateur VR9000H à aspiration puissante, 40 W', '2019-10-28', 'C', 'gestionnaire1', 4),
(23, 'Galaxy S8 ', '2019-10-28', 'C', 'gestionnaire1', 6),
(24, 'Galaxy S10 ', '2019-10-28', 'C', 'gestionnaire1', 6),
(25, 'Galaxy S9\r\n', '2019-10-28', 'C', 'gestionnaire1', 6),
(26, 'Galaxy A80 \r\n\r\n', '2019-10-28', 'C', 'gestionnaire1', 6),
(27, 'Galaxy A80 ', '2019-10-28', 'C', 'gestionnaire1', 6),
(28, 'Galaxy Note10 | Note10+', '2019-10-28', 'C', 'hatim', 1),
(29, 'Galaxy Watch Active', '2019-10-28', 'C', 'root', 1);


INSERT INTO `t_liste_lis` (`cat_id`, `url_id`) VALUES
(6, 1),
(1, 2),
(6, 2),
(6, 3);


INSERT INTO `t_news_new` (`new_num`, `new_titre`, `new_texte`, `new_date`, `new_etat`, `cpt_pseudo`) VALUES
(1, 'Fermeture exceptionnelle:', 'Notre Boutique va fermer aujourd\'hui à midi ', '2019-10-30', 'C', 'root'),
(2, 'Ouverture exceptionnelle:', 'Notre Boutique va ouvrir ses portes le dimanche à partir de 10h ', '2019-11-30', 'C', 'root'),
(3, 'Recherche agents :', 'Notre Boutique recherche des agents de remplacement, Deposez vos CV à l\'accueil ', '2019-12-15', 'C', 'root');


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



INSERT INTO `t_url_url` (`url_id`, `url_nom`, `url_chaine`) VALUES
(1, 'Samsung S10', 'https://www.samsung.com/fr/smartphones/galaxy-s10/'),
(2, 'Galaxy S10+', 'https://www.samsung.com/fr/smartphones/galaxy-s10/'),
(3, 'Galaxy S8+', 'https://www.samsung.com/fr/smartphones/galaxy-s8/');


INSERT INTO `t_visuel_vis` (`vis_id`, `vis_descriptif`, `vis_nom_fichier`, `vis_date_ajout`, `vis_visibilite`, `cpt_pseudo`) VALUES
(1, 'Photo de S10+', 's10.jpg', '2019-10-28', 'L', 'hatim'),
(2, 'Photo de S8', 's8.jpg', '2019-10-28', 'L', 'hatim'),
(3, 'Photo de NOTE 9', 'note9.jpg', '2019-10-28', 'L', 'hatim'),
(4, 'Photo de NOTE 10', 'note10.jpg', '2019-10-28', 'L', 'hatim');

