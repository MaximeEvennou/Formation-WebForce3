-- Tester un champ NULL
-- Affichage des ID des livres qui n'ont pas été rendu
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL;
-- Un champ NULL se teste toujours avec IS

-- REQUETE IMBRIQUEE
---------------------------------------------------------------------
-- Titre des livres dans la nature
SELECT titre FROM livre WHERE id_livre IN
    (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL);

-- Requête détaillée :
SELECT titre FROM livre WHERE id_livre IN(100, 105);

-- Afin de réaliser une requête imbriquée (ou jointure), il faut obligatoirement un champ commun entre les 2 tables.

---------------------------------------------------------------------
-- Liste des abonnés n'ayant pas rendu les livres
SELECT prenom FROM abonne WHERE id_abonne IN
    (SELECT id_abonne FROM emprunt WHERE date_rendu IS NULL);

-- Requête détaillée :
SELECT prenom FROM abonne WHERE id_abonne IN(3, 2);

---------------------------------------------------------------------
-- Exo : Nous aimerions connaitre le numéro (id_livre) des livre(s) que Chloé a emprunté à la bibliothèque ?
SELECT id_livre FROM emprunt WHERE id_abonne IN
    (SELECT id_abonne FROM abonne WHERE prenom = 'Chloe'); -- Affiche 100 et 105
--OU
SELECT id_livre FROM emprunt WHERE id_abonne =
    (SELECT id_abonne FROM abonne WHERE prenom = 'Chloe'); -- Affiche 100 et 105

---------------------------------------------------------------------
-- Exo : Afficher les prénoms des abonnés ayant emprunté un livre le 19/12/2014
SELECT prenom FROM abonne WHERE id_abonne IN
    (SELECT id_abonne FROM emprunt WHERE date_sortie = '2014-12-19');

---------------------------------------------------------------------
-- Exo : Combien de livres Guillaume a emprunté à la bibliothèque ?
SELECT COUNT(*) FROM emprunt WHERE id_abonne IN
    (SELECT id_abonne FROM abonne WHERE prenom = 'Guillaume');

---------------------------------------------------------------------
-- Exo : Afficher la liste des abonnes ayant déjà emprunté un livre d'ALPHONSE DAUDET
SELECT id_abonne FROM emprunt WHERE id_livre = 103;
SELECT id_livre FROM livre WHERE auteur = 'ALPHONSE DAUDET';
SELECT prenom FROM abonne WHERE id_abonne = 4;

SELECT prenom FROM abonne WHERE id_abonne IN
    (SELECT id_abonne FROM emprunt WHERE id_livre IN
        (SELECT id_livre FROM livre WHERE auteur = 'ALPHONSE DAUDET'));

---------------------------------------------------------------------
-- Exo : Nous aimerions connaître le titre des livres que Chloé a emprunté à la bibliothèque.
SELECT id_abonne FROM abonne WHERE prenom = 'Chloe'; -- Affiche 3
SELECT id_livre FROM emprunt WHERE id_abonne = 3; -- Affiche 100 et 105
SELECT titre FROM livre WHERE id_livre IN(100, 105);

SELECT titre FROM livre WHERE id_livre IN
    (SELECT id_livre FROM emprunt WHERE id_abonne IN
        (SELECT id_abonne FROM abonne WHERE prenom = 'Chloe'));

---------------------------------------------------------------------
-- Exo : Nous aimerions connaître le titre des livres que Chloé n'a pas encore emprunté.
SELECT titre FROM livre WHERE id_livre NOT IN
    (SELECT id_livre FROM emprunt WHERE id_abonne IN
        (SELECT id_abonne FROM abonne WHERE prenom = 'Chloe'));

---------------------------------------------------------------------
-- Exo : Nous aimerions connaître le titre des livres que Chloé n'a pas encore rendu.
SELECT titre FROM livre WHERE id_livre IN
    (SELECT id_livre FROM emprunt WHERE id_abonne IN
        (SELECT id_abonne FROM abonne WHERE prenom = 'Chloe') AND date_rendu IS NULL);

---------------------------------------------------------------------
-- Exo : Qui a emprunté le plus de livres ?
SELECT prenom FROM abonne WHERE id_abonne =
    (SELECT id_abonne FROM emprunt GROUP BY id_abonne ORDER BY COUNT(*) DESC LIMIT 0,1);

---------------------------------------------------------------------
-- JOINTURE
-- Nous aimerions connaître les date sortie et date rendu pour l'abonné Guillaume (quand est-il passé à la bibliothèque)

-- JOINTURE
-- 'a.prenom' correspond au champ prenom de la table 'abonne' portant le préfixe 'a'
SELECT a.prenom, e.date_sortie, e.date_rendu
FROM emprunt e, abonne a
WHERE a.id_abonne = e.id_abonne
AND a.prenom = 'Guillaume';
-- 1ère ligne : Ce que je souhaite afficher
-- 2ème ligne : De quelle table cela provient, et de quelle table je vais avoir besoin ?
-- 3ème ligne : Quel est le champ commun dans les 2 tables qui me permet d'effectuer la jointure
-- 4ème ligne : Condition complémentaire

-- IMBRIQUEE
SELECT date_sortie, date_rendu FROM emprunt WHERE id_abonne =
    (SELECT id_abonne FROM abonne WHERE prenom = 'Guillaume');

-- Une jointure et une requête imbriquée permettent de faire des relations entre les différentes tables afin d'avoir des colonnes associées pour ne former qu'un seul résultat.
-- Une jointure est possible dans tous les cas
-- Une requête imbriquée est possible seulement dans le cas où le résultat est issu de la même table.
-- Les requêtes imbriquéées auront quand même l'avantage de s'exécuter plus rapidement.

---------------------------------------------------------------------
-- Exo : Nous aimerions connaître les mouvements des livres (date_sortie, date_rendu) écrit par ALPHONSE DAUDET.

-- JOINTURE
SELECT l.titre, e.date_sortie, e.date_rendu
FROM livre l, emprunt e
WHERE e.id_livre = l.id_livre
AND l.auteur = 'ALPHONSE DAUDET';

-- IMBRIQUÉE
SELECT date_sortie, date_rendu FROM emprunt WHERE id_livre =
    (SELECT id_livre FROM livre WHERE auteur = 'ALPHONSE DAUDET');

---------------------------------------------------------------------
-- Exo : Qui a emprunté le livre "Une vie" sur l'année 2014

-- JOINTURE
SELECT a.prenom
FROM abonne a, emprunt e, livre l
WHERE l.id_livre = e.id_livre
AND e.id_abonne = a.id_abonne
AND l.titre = 'Une vie'
AND e.date_sortie LIKE '2014%';

-- IMBRIQUÉE
SELECT prenom FROM abonne WHERE id_abonne IN
    (SELECT id_abonne FROM emprunt WHERE id_livre IN
        (SELECT id_livre FROM livre WHERE titre = 'Une vie') AND date_sortie LIKE '2014%');

---------------------------------------------------------------------
-- Exo : Nous aimerions connaître le nombre de livre(s) emprunté(s) par chaque abonné

-- JOINTURE
SELECT a.prenom, COUNT(e.id_livre) AS 'nb livres empruntés'
FROM abonne a, emprunt e
WHERE a.id_abonne = e.id_abonne
GROUP BY e.id_abonne;

-- IMBRIQUÉE
SELECT COUNT(id_livre) AS 'nb livres empruntés' FROM emprunt GROUP BY id_abonne;

---------------------------------------------------------------------
-- Exo : Nous aimerions connaitre le nombre de livre(s) à rendre pour chaque abonné

-- JOINTURE
SELECT a.prenom, COUNT(e.id_livre) AS 'nb de livres à rendre'
FROM abonne a, emprunt e
WHERE a.id_abonne = e.id_abonne
AND e.date_rendu IS NULL
GROUP BY e.id_abonne;

---------------------------------------------------------------------
-- Exo : Qui a emprunté quoi et quand ?
SELECT a.prenom, l.titre, e.date_sortie
FROM abonne a, livre l, emprunt e
WHERE a.id_abonne = e.id_abonne
AND e.id_livre = l.id_livre;

---------------------------------------------------------------------
-- Exo : Afficher les prénoms des abonnés avec le n° des livres qu'ils ont emprunté.
SELECT a.prenom, e.id_livre
FROM abonne a, emprunt e
WHERE a.id_abonne = e.id_abonne;

---------------------------------------------------------------------
-- Exo : Insérez vous dans la table abonné
INSERT INTO abonne (prenom) VALUES ('Maxime');
-- OU 
INSERT INTO abonne VALUES (NULL, 'Maxime');
INSERT INTO abonne VALUES (DEFAULT, 'Maxime');
INSERT INTO abonne VALUES ('', 'Maxime');



-- JOINTURE EXTERNE
-- La clause LEFT JOIN permet de rapatrier toutes les données dans la table considérée comme étant à gauche (donc abonne dans notre cas) sans correspondance exigée dans l'autre table (emprunt).
-- La jointure EXTERNE est donc plus intéressante, pensez au cas suivant : 
-- Je suis membre de votre site, je fais 2 achats (commande 765 et 785)
-- En 2018 je je me désinscris, que faites vous des commandes que j'ai passées ?
SELECT abonne.prenom, emprunt.id_livre
FROM abonne LEFT JOIN emprunt
ON abonne.id_abonne = emprunt.id_abonne;
-- OU
SELECT abonne.prenom, emprunt.id_livre
FROM abonne INNER JOIN emprunt
ON abonne.id_abonne = emprunt.id_abonne;
-- OU
SELECT abonne.prenom, emprunt.id_livre
FROM emprunt RIGHT JOIN abonne
ON abonne.id_abonne = emprunt.id_abonne;