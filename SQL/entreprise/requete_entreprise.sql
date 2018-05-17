-- Commentaire en SQL
-- Le langage SQL (Structured Query Language) nous permet d'interroger une bade de données.
-- MYSQL est le système de gestion de base de données (SGBD), c'est le plus utilisé, mais il en existe d'autres : postrgres, oracle, sqlserver...
-- Pour accéder à la console MYSQL sur XAMPP, il faut rentrer le log : mysql -uroot

CREATE DATABASE entreprise; -- Créer une nouvelle base de données

SHOW DATABASES; -- Voir toutes les bases de données
-- Toutes les requêtes et commandes se terminent toujours pas un point virgule ';', c'est ce que l'on appelle le délimiteur.

USE entreprise; -- Utiliser/sélectionner une base de données.

DROP DATABASE entreprise; -- Supprimer une base de données.

DROP TABLE employes; -- Supprimer une table.

TRUNCATE employes; -- Vider une table.

DESC employes; -- Observer la structure de la table, ainsi que les champs (desc pour describe).

------------------------------------------------------------------------------------------------

-- REQUETE DE SELECTION

-- Affichage complet
SELECT id_employes, prenom, nom, sexe, service, date_embauche, salaire FROM employes;
-- AFFICHE MOI [noms_des_colonnes] DE [nom_de_la_table]
SELECT * FROM employes;
-- étoile * : raccourci pour dire 'ALL'

------------------------------------------------------------------------------------------------

-- Affichage des noms et prénoms de l'entreprise
SELECT prenom, nom FROM employes;

------------------------------------------------------------------------------------------------

-- Exo : Quels sont les différents services occupés par les employés travaillant dans l'entreprise
SELECT service FROM employes;

SELECT DISTINCT service FROM employes;
-- DISTINCT permet d'éliminer les doublons

------------------------------------------------------------------------------------------------

-- Condition WHERE
-- Afficher des employés de service informatique
SELECT nom, prenom, service FROM employes WHERE service = 'informatique';
-- AFFICHE MOI les noms, prénoms, services DE LA TABLE, A CONDITION QUE le service soit informatique.
-- WHERE : à condition que...
-- WHERE [colonne = valeur]

------------------------------------------------------------------------------------------------

-- BETWEEN
-- Affichage des employés ayant été recruté entre 2010 et aujourd'hui
SELECT nom, prenom, date_embauche, sexe FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND '2018-05-15' AND sexe = 'm';
-- BETWEEN + AND : entre... et...

SELECT CURDATE(); -- Fonction prédéfinie qui retourne la date du jour.
SELECT nom, prenom, date_embauche FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND CURDATE();

-- Pas de différence entre les quotes '' et les guillemets "". Quand il y a une valeur (chaîne de caractères), il faut mettre les guillemets "" ou les quotes '', en revanche quand il s'agit d'un chiffre, on ne doit pas les mettre.

------------------------------------------------------------------------------------------------

-- LIKE : valeur approchante
-- Affichage des employes ayant un prénom commençant par la lettre s
SELECT prenom FROM employes WHERE prenom LIKE 's%';
-- % : Peu importe la suite
-- Affichage des employés ayant un prénom finissant par la lettre s
SELECT prenom FROM employes WHERE prenom LIKE '%s';
-- Affichage des employés ayant un prénom composé
SELECT prenom FROM employes WHERE prenom LIKE '%-%';

-- ID    nom      code_postal
-- 12  appart1      75015
-- 15  appart2      75008
-- 18  appart3      75011
-- 20  appart4      93000

-- SELECT nom FROM appartement WHERE code-postal = 75;
-- SELECT nom FROM apprtement WHERE code_postal LIKE '75%';

------------------------------------------------------------------------------------------------

-- OPERATEURS DE COMPARAISON

-- =   Egal à
-- <   Strictement inférieur
-- >   Strictement supérieur
-- <=  Inférieur ou égal à
-- >=  Supérieur ou égal à
-- !=  Différent
-- OR  OU
-- AND ET

------------------------------------------------------------------------------------------------

-- Affichage des employés (sauf les informaticiens)
SELECT nom, prenom, service FROM employes WHERE service != 'informatique';
-- != : permet d'exclure une valeur

------------------------------------------------------------------------------------------------

-- Exo : Affichage des employés gagnant un salaire supérieur à 3000€
SELECT * FROM employes WHERE salaire > 3000;

------------------------------------------------------------------------------------------------

-- ORDER BY
-- Affichage des employés dans l'ordre alphabétique
SELECT prenom FROM employes ORDER BY prenom ASC;
-- ORDER BY permet d'effectuer un classement
-- ASC : ascendant, croissant
SELECT prenom FROM employes ORDER BY prenom;
-- Par défaut, ORDER BY effectue un classement par ordre alphabétique
-- Ordre décroissant
SELECT prenom FROM employes ORDER BY prenom DESC;
-- DESC : descendant, décroissant

------------------------------------------------------------------------------------------------

-- LIMIT
-- Affichage des employés 3 par 3
SELECT prenom FROM employes ORDER BY prenom ASC LIMIT 0,3;
SELECT prenom FROM employes ORDER BY prenom ASC LIMIT 3,4;
-- LIMIT 0,3 : 0 est la position de départ, 3 le nombre d'affichage souhaité
-- LIMIT est utilisé sur un site pour de la pagination, soit la séparation en plusieurs pages d'une liste de données.

------------------------------------------------------------------------------------------------

-- Affichage des employés avec un salaire annuel
SELECT prenom, salaire*12 FROM employes;
SELECT prenom, salaire*12 AS 'salaire annuel' FROM employes ORDER BY salaire DESC;
-- AS : alias

------------------------------------------------------------------------------------------------

-- SUM : fonction prédéfinie en SQL
-- Affichage de la masse salariale sur 12 mois
SELECT SUM(salaire*12) AS 'masse salariale' FROM employes;
-- SUM : somme

------------------------------------------------------------------------------------------------

-- AVG : fonction prédéfinie en SQL
-- Affichage du salaire moyen
SELECT AVG(salaire) AS 'salaire moyen' FROM employes;
-- AVG : moyenne

-- ROUND : fonction prédéfinie permettant d'arrondir 
SELECT ROUND(AVG(salaire), 2) AS 'salaire moyen' FROM employes;
-- ROUND(AVG(salaire), 2) : 1er argument : le chiffre à arrondir, le 2ème argument : le nombre de chiffre après la virgule.

------------------------------------------------------------------------------------------------

-- COUNT
-- Affichage du nombre de femmes dans l'entreprise
SELECT COUNT(*) AS 'nb femmes' FROM employes WHERE sexe = 'f';
-- COUNT permet de compter

------------------------------------------------------------------------------------------------

-- MIN/MAX
-- Affichage du salaire minimum/maximum
SELECT MIN(salaire) AS 'salaire min' FROM employes;
SELECT MAX(salaire) AS 'salaire max' FROM employes;

-- Exo : afficher les informations de l'employé gagnant le moins dans l'entreprise

SELECT prenom, nom, MIN(salaire) FROM employes;
-- Requête détaillée : Pas d'erreur car la syntaxe est bonne, cependant le résultat est érroné, MIN réalise son travail mais la requête retourne la première ligne de la table, or ce n'est pas Jean-Pierre qui gagne le salaire minimum.

SELECT prenom, nom, salaire FROM employes WHERE salaire = (SELECT MIN(salaire) FROM employes);
-- Nous sommes obligé d'isoler la requête permettant de chercher le salaire minimum avant de récupérer toutes les données de l'employé.
--C'est la requête entre paranthèse qui est exécutée en premier.
SELECT prenom, nom, slaire FROM employes WHERE salaire = 1390;

------------------------------------------------------------------------------------------------

-- IN
-- Affichage des employés travaillant dans le service informatique et comptabilité
SELECT prenom, nom, service FROM employes WHERE service IN('comptabilite', 'informatique');
-- IN : permet d'inclure plusieurs valeurs
-- = : permet d'inclure une seule valeur

------------------------------------------------------------------------------------------------

-- NOT IN
-- Affichage des employés ne travaillant pas dans les services informatique et comptabilité.
SELECT prenom, nom, service FROM employes WHERE service NOT IN ('comptabilite', 'informatique');
-- NOT IN : permet d'exclure plusieurs valeurs
-- != : permet d'exclure une seule valeur

------------------------------------------------------------------------------------------------

-- Exo : Affichage des commerciaux gagnant un salaire inférieur ou égal à 2000€
SELECT * FROM employes WHERE salaire <= 2000 AND service = 'commercial';
-- AND : ET... (Condition complémentaire), on ne peut pas formuler deux fois la condition WHERE dans une requête, AND permet d'ajouter des conditions complémentaires.

------------------------------------------------------------------------------------------------

-- OR
-- Exo : Affichage des commerciaux travaillant pour un salaire de 2300€ ou 1900€.
SELECT * FROM employes WHERE service = 'commercial' AND salaire = 2300 OR salaire = 1900;
-- /!\ Résultat érroné, il faut respecter l'ordre des priorités des conditions avec les parenthèses. 
SELECT * FROM employes WHERE service = 'commercial' AND (salaire = 2300 OR salaire = 1900); 

------------------------------------------------------------------------------------------------

-- GROUP BY
-- Affichage du nombre d'employés par service
SELECT service, COUNT(*) AS 'nb employes/service' FROM employes GROUP BY service; 
-- GROUP BY va réassocier les nombres (+1) par service
-- GROUP BY permet d'effectuer des regroupements

------------------------------------------------------------------------------------------------

-- REQUETE INSERTION
INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES ('Maxime', 'EVENNOU', 'm', 'informatique', '2018-05-15', 15000);
-- Le champs id_employes est la clé auto incrémenté, donc il n'est pas nécessaire de l'appeler au moment de l'insertion, il sera généré automatiquement dans la base de données.
-- Lorqu'on appelle les champs, l'ordre n'a pas d'importance, par contre il faut respecter l'ordre au niveau des valeurs.

-- INSERTION avec choix de l'ID
INSERT INTO employes (id_employes,prenom, nom, sexe, service, date_embauche, salaire) VALUES (8059,'Maxime', 'EVENNOU', 'm', 'informatique', '2018-05-15', 15000);

-- Si nous inserons dans les champs de la table, il est n'est pas necessaire d'appeler les champs un par un, par contre il faut envoyer une valeur par défaut pour le champs id_employes
INSERT INTO employes VALUES(NULL, 'test', 'test', 'm', 'test', '2018-05-19', 150000);
INSERT INTO employes VALUES(DEFAULT, 'test', 'test', 'm', 'test', '2018-05-19', 150000);
INSERT INTO employes VALUES('', 'test', 'test', 'm', 'test', '2018-05-19', 150000);
INSERT INTO employes VALUES(8092, 'test', 'test', 'm', 'test', '2018-05-19', 150000);

------------------------------------------------------------------------------------------------

-- REQUETE DE MODIFICATION
-- modification du salaire de l'employé 350 par 1150
UPDATE employes SET salaire = 1150, service = 'technicien de surface' WHERE id_employes = 350;

-- REPLACE 
REPLACE INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES (NULL, 'greg','formateur', 'm', 'info', '2018-05-15', 200000);

REPLACE INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES (592, 'Laura','Blanchet', 'f', 'cuisine', '2018-05-15', 1500);
-- Si l'ID n'est pas trouvé dans la BDD, REPLACE se comporte comme un INSERT, il génère une ligne d'insertion
-- Si l'ID est trouvé dans la BDD, REPLACE se comporte comme un UPDATE, il supprime la ligne et réinsère avec les nouvelles à l'identifiant

------------------------------------------------------------------------------------------------

-- REQUETE DE SUPPRESSION
-- Suppression de l'employé n°350
DELETE FROM employes WHERE id_employes = 350;
-- DELETE FROM nom_de_la_table CONDITION...

------------------------------------------------------------------------------------------------

-- EXERCICE
-- 1. Afficher la profession de l'employé 547
-- 2. Afficher la date d'embauche d'Amandine
-- 3. Afficher le nom de famille de Guillaume
-- 4. Afficher le nombre de personne ayant un id_employes commençant par le chiffre 5
-- 5. Afficher le nombre de commerciaux
-- 6. Afficher le salaire moyen des informaticiens
-- 7. Afficher les 5 premiers employés aprés avoir classé leur nom de famille par ordre alphabétique
-- 8. Afficher le coût des commerciaux sur 1 année
-- 9. Afficher le salaire moyen par service (service + salaire moyen)
-- 10. Afficher le nombre de recrutement sur l'année 2010
-- 11. Afficher le salaire moyen appliqué lors des recrutements allant de 2005 à 2007
-- 12. Afficher le nombre de service différent
-- 13. Afficher tous les employés (sauf ceux du service production et secretariat)
-- 14. Afficher conjoitement le nombre d'hommes et de femmes dans l'entreprise
-- 15. Afficher les commerciaux ayant été recrutés avant 2005 de sexe masculin et gagnant un salaire supérieur à 2500€
-- 16. Qui a été embauché en dernier ?
-- 17. Afficher les informations sur l'employé du service commercial gagnant le salaire le plus élevé
-- 18. Afficher le prenom du comptable gagnant le meilleur salaire
-- 19. Afficher le prénom de l'informaticien ayant été recruté en premier
-- 20. Augmenter chaque employé de 100€
-- 21. Supprimer les employés du service secrétariat

SELECT service FROM employes WHERE id_employes = 547; -- 1
SELECT date_embauche FROM employes WHERE prenom = 'Amandine'; -- 2
SELECT nom FROM employes WHERE prenom = 'Guillaume'; -- 3
SELECT COUNT(*) AS 'nb employes' FROM employes WHERE id_employes LIKE '5%'; -- 4
SELECT COUNT(*) AS 'nb commerciaux' FROM employes WHERE service = 'commercial'; -- 5
SELECT AVG(salaire) AS 'salaire moyen informaticiens' FROM employes WHERE service = 'informatique'; -- 6
SELECT nom FROM employes ORDER BY nom ASC LIMIT 0,5; -- 7
SELECT SUM(salaire*12) AS 'masse salariale commerciaux' FROM employes WHERE service = 'commercial'; -- 8
SELECT service, ROUND(AVG(salaire),2) AS 'salaire moyen/service' FROM employes GROUP BY service; -- 9
SELECT COUNT(*) AS 'nb de recrutements en 2010' FROM employes WHERE date_embauche LIKE '2010%'; -- 10
SELECT ROUND(AVG(salaire),2) AS 'salaire moyen de 2005 à 2007' FROM employes WHERE date_embauche BETWEEN '2005-01-01' AND '2007-12-31'; -- 11
SELECT COUNT(DISTINCT service) AS 'nb service' FROM employes; -- 12
SELECT * FROM employes WHERE service NOT IN ('production', 'secretariat'); -- 13
SELECT sexe, COUNT(*) AS 'nb hommes/femmes' FROM employes GROUP BY sexe; -- 14
SELECT * FROM employes WHERE service = 'commercial' AND date_embauche < '2005-01-01' AND sexe = 'm' AND salaire > 2500; -- 15
SELECT * FROM employes WHERE date_embauche = (SELECT MAX(date_embauche) FROM employes); -- 16
SELECT * FROM employes WHERE service = 'commercial' AND salaire = (SELECT MAX(salaire) FROM employes WHERE service = 'commercial'); -- 17
SELECT prenom FROM employes WHERE service = 'comptabilité' AND salaire = (SELECT MAX(salaire) FROM employes WHERE service = 'comptabilité'); -- 18
SELECT prenom FROM employes WHERE service = 'informatique' AND date_embauche = (SELECT MIN(date_embauche) FROM employes WHERE service = 'informatique');-- 19
UPDATE employes SET salaire = salaire + 100; -- 20
DELETE FROM employes WHERE service = 'secretariat'; -- 21
