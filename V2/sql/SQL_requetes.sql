//1
insert into `t_compte_cpt` values ('hatim',md5('12345'));
INSERT INTO `t_profil_pfl`(`pfl_nom`, `pfl_prenom`, `pfl_mail`, `pfl_statut`, `pfl_validite`, `cpt_pseudo`, `pfl_date`)
VALUES ('M''RABET EL KHOMSSI','Hatim','mrabet.hatim2018@gmail.com','G','A','hatim',CURRENT_DATE);

//2
select *
from `t_compte_cpt`
where `cpt_pseudo`= 'hatim'
and `cpt_psswd`= md5('12345')

//3
select *
from `t_profil_pfl`
where `cpt_pseudo` = 'Hatim'

//4
select pfl_statut
from `t_profil_pfl`
where `pfl_prenom` = 'Hatim'
and `pfl_nom`= 'M''RABET EL KHOMSSI'

//5
update `t_profil_pfl`
set `pfl_validite` = 'D'
where `cpt_pseudo` = 'ouma_ork'

//6
update `t_compte_cpt`
set `cpt_psswd` = md5('ouma123')
where `cpt_pseudo` = 'ouma_ork'

//7
select *
from `t_profil_pfl`
left join `t_compte_cpt` using(cpt_pseudo)

//8
update `t_profil_pfl`
set `pfl_validite` = 'A'
where `cpt_pseudo` = 'ouma_ork'

//9
update `t_profil_pfl`
set `pfl_validite` = 'D'
where `cpt_pseudo` = 'thomas_larue'

***********************************************************************
***********************************************************************

//10
INSERT INTO `t_visuel_vis`
VALUES (NULL,'photo de Tv','Tv_20157.jpg',sysdate(),'C','root')

//11
select *, 
from t_visuel_vis 
where vis_visibilite = 'L'

//12
select *
from t_visuel_vis
ORDER by vis_id DESC
limit 3

//13
update t_visuel_vis
set vis_nom_fichier = 'S10.jpg'
where vis_id = 1

//14
delete
from t_visuel_vis
where vis_id = 5

***********************************************************************
***********************************************************************

//15
INSERT INTO `t_news_new` (`new_titre`, `new_texte`, `new_date`, `new_etat`, `cpt_pseudo`) VALUES
('Fermeture exceptionnelle:', 'Notre Boutique va fermer aujourd''hui à midi ','2019-10-30', 'C', 'root')

//16
select *
from t_news_new
order by desc
limit 1

//17
SELECT new_titre,pfl_nom,pfl_prenom
from t_news_new
join t_compte_cpt USING(cpt_pseudo)
join t_profil_pfl using(cpt_pseudo)

//18
SELECT new_titre,pfl_nom,pfl_prenom
from t_news_new
join t_compte_cpt USING(cpt_pseudo)
join t_profil_pfl using(cpt_pseudo)
order by new_num DESC
limit 5

//19
update t_news_new
set new_texte = 'Notre Boutique va ouvrir ses portes le dimanche à partir de 12h '
where new_titre = 'Ouverture exceptionnelle:'   

//20
delete from t_news_new
where new_num = 1

//21
update t_news_new
set new_etat= 'C'
where new_date < '2019-11-1'

***********************************************************************
***********************************************************************

//22
INSERT INTO `t_categorie_cat` (`cat_intitule`, `cat_date`, `cat_autorisation`) VALUES
('NOUVEAUTÉS :', '2019-10-26', 'G'),

//23
select cat_intitule, count(inf_id) as nb
from t_information_inf
join t_categorie_cat using(cat_id)
group by cat_id

//24
select cat_intitule, inf_texte, url_chaine
from t_categorie_cat
LEFT join t_information_inf using(cat_id)
left join t_liste_lis using(cat_id)
left join t_url_url using(url_id)

//25
update t_categorie_cat
set cat_autorisation= 'G'
where cat_id=1

//26
delete from t_categorie_cat
where cat_id=1

//27
select *
from t_categorie_cat
where cat_id not in (	select cat_id 
			            from t_information_inf  )

//28
select *
from t_information_inf
where inf_id = 1

//29
select inf_texte
from t_information_inf
where cat_id=1

//30
INSERT INTO `t_information_inf` (`inf_texte`, `inf_date_ajout`, `inf_etat`, `cpt_pseudo`, `cat_id`) VALUES
('Galaxy Tab S5e', '2019-10-28', 'L', 'root', 3)

//31
delete from t_information_inf
where inf_id= 1 

//32
update t_information_inf
set inf_texte= 'QLED 8K/4K - Une qualité d’image exceptionnelle.'
where inf_id=12

//33
delete from t_information_inf
where cat_id=1

//34
delete from t_categorie_cat
where cat_id not in (	select cat_id
			            from t_information_inf	)

//35
update t_information_inf
set inf_etat='C'
where inf_id=10

//36
update t_information_inf
set inf_etat='C'
where cpt_pseudo = 'root'

//37
select *
from t_categorie_cat
left join t_information_inf using(cat_id)
left join t_liste_lis using(cat_id)
left join t_url_url using(url_id)
where cat_id = 2

//38
select DISTINCT url_chaine
from t_url_url

//39
select inf_texte, cat_intitule, url_chaine
from t_information_inf
left join t_categorie_cat using(cat_id)
left join t_liste_lis using(cat_id)
left join t_url_url using(url_id)

//40
select url_chaine
from t_url_url
join t_liste_lis using(url_id)
where cat_id = 6

//41
select cat_intitule
from t_categorie_cat
where cat_id not in (select cat_id
					from t_liste_lis)

//42
select url_chaine
from t_url_url
where url_chaine like '%Galaxy%'

//43
INSERT INTO `t_url_url` (`url_nom`, `url_chaine`) VALUES ('Réfrigérateur multi-portes', 'https://www.samsung.com/fr/refrigerators/multi-door-rfg23uebp1/');
INSERT INTO `t_liste_lis` (`cat_id`, `url_id`)
VALUES (4, 4);

//44
select count(DISTINCT cat_id) as nombre
from t_liste_lis
where url_id = 2

//45
delete from t_liste_lis
where url_id = (select url_id
				from t_url_url
				where url_chaine = 'https://www.samsung.com/fr/refrigerators/multi-door-rfg23uebp1/');

delete from t_url_url
where url_chaine = 'https://www.samsung.com/fr/refrigerators/multi-door-rfg23uebp1/';