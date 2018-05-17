------------------------- TRANSACTIONS -------------------------
-- Habituellement, lorsqu'une commande permettant de modifier les informations dans une table (INSERT, UPDATE, DELETE), il n'est plus possible de faire marche arrière. Nous ne sommes jamais à l'abri d'une erreur, c'est pour cela qu'il existe une notation d'annulation. En résumé, vous pouvez faire un ctrl + z dans votre BDD.

START TRANSACTION; -- Démarre la zone de mise en tampon 
SELECT * FROM employes;
UPDATE employes SET salaire = 1000;
SELECT * FROM employes;
ROLLBACK; -- Donne l'ordre à MySQL de tout annuler depuis START TRANSACTION
COMMIT; -- Au contraire, commit, valide et termine l'ensemble de la transaction

------------------------- TRANSACTIONS AVANCEE & SAVEPOINT -------------------------

START TRANSACTION;

SELECT * FROM employes;
SAVEPOINT point1;

UPDATE employes SET salaire = 2000 WHERE id_employes = 415;
SELECT * FROM employes;
SAVEPOINT point2;

UPDATE employes SET salaire = 2200 WHERE id_employes = 415;
SELECT * FROM employes;
SAVEPOINT point3;

UPDATE employes SET salaire = 1400 WHERE id_employes = 415;
SELECT * FROM employes;
SAVEPOINT point4;

ROLLBACK to point3; -- Je reviens à la modification du 415 car je considère que les lignes suivantes sont des erreurs.
ROLLBACK to point4; -- ERROR : SAVEPOINT 4 does not exists, il est possible de revenir à point de sauvetage antérieur, mais il n'est plus possible de revenir à un point de sauvetage déclaré après.
ROLLBACK to point1; -- Il est quand même possible de revenir au point1
-- Il est possible de refaire des points de sauvetage
SELECT * FROM employes;

ROLLBACK; -- Pour annuler et terminer la transaction
COMMIT; -- Permet de valider et terminer la transaction

------------------------- FIN DE TRANSACTIONS -------------------------