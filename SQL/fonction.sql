--------- FONCTIONS PREFEFINIES ---------
 SELECT DATABASE(); -- Indique qu'elle BDD est actuellement séléctionnée
 SELECT VERSION(); -- Affiche la version de MySQL
 INSERT INTO abonne (prenom) VALUES ('test');
 SELECT LAST_INSERT_ID(); -- Permet d'afficher le dernier identifiant inséré.
 SELECT DATE_ADD('2018-05-17', INTERVAL 31 DAY); -- Affiche 31 jours plus tard.
 SELECT DATE_ADD('2018-05-17', INTERVAL 2 MONTH); -- Affiche 2 mois plus tard.
 SELECT ADDDATE('2018-05-17' 31); -- Affiche 31 jours plus tard
 -- Pratique pour la durée de JEU ou d'enchère ouverte style EBAY
 SELECT CURDATE(); -- Retourne la date du jour au format 'YYYY-MM-DD', pratique pour afficher les billets de trains non réservés et pas les anciens d'hier.
 SELECT CURTIME(); -- Retourne l'heure courante au format 'HH:MM:SS'
 SELECT DATE_FORMAT('2018-05-17 11:26:00', '%d/%m/%Y - %H:%i:%s');
 -- Met les dates au format français
 -- Lorsqu'on utilise une fonction prédéfinie en SQL, il est toujours important de se poser la question, à savoir quels arguments on doit lui envoyer et surtout savoir savoir ce qu'elle retourne
 SELECT id_emprunt AS 'n°emprunt', id_livre AS 'n° livres', id_abonne AS 'n°abonne', DATE_FORMAT(date_sortie,'le %d/%m/%Y') AS 'Date sortie', DATE_FORMAT(date_rendu,'le %d/%m/%Y') AS 'Date rendu' FROM emprunt; -- met les dates au format français 
 SELECT DAYNAME('1992-06-04'); -- Affiche le jour d'une date en particulier
 SELECT DAYNAME(CURDATE());
 SELECT DAYOFYEAR('1992-06-04'); -- Affiche le numéro du jour de l'année
 SELECT WEEKOFYEAR('1992-06-04'); --Affiche le numéro de la semaine
 SELECT NOW(); -- Retourne la date et l'heure du jour
 SELECT PASSWORD('mypass');
 INSERT INTO abonne (prenom) VALUES (PASSWORD('mypass')); -- Permet de crypter le mdp en algorithme AES
 INSERT INTO abonne (prenom) VALUES (MD5('mypass')); -- Crypte le mdp
 SELECT CONCAT_WS(" ", id_abonne, prenom) AS 'liste' FROM abonne;

 SELECT CONCAT_WS(" - ", a.id_abonne, a.prenom, l.titre, l.auteur, e.date_sortie, e.date_rendu)
 FROM abonne a, emprunt e, livre l
 WHERE a.id_abonne = e.id_abonne
 AND e.id_livre = l.id_livre;
 -- CONCAT_WS() signifie CONCAT With Separator, c'est-à-dire concaténation avec séparateur

 SELECT CONCAT(id_abonne, ' ', prenom) FROM abonne; -- Pratique pour réunir une adresse (adresse, ville, code postal)

 SELECT LENGTH('moi'); -- Retourne la taille de la chaîne de caractères
 SELECT LOCATE('j', "aujourd'hui"); -- Retourne la position du caractère
 SELECT REPLACE('www.wf3.fr', 'w', 'W'); -- WWW.Wf3.fr
 SELECT SUBSTRING('Bonjour', 4); -- Retourne une partie de la chaîne -> jour
 SELECT TRIM(' bonsoir '); -- Supprime les espaces en début et en fin de chaîne de caractères