CREATE VIEW vue_homme AS SELECT prenom, nom, sexe, service FROM employes WHERE sexe = 'm';

-- Exo : Formuler une requête permettant de modifier le service de l'employé Gallet par informatique
UPDATE employes SET service = 'informatique' WHERE nom = 'Gallet';

UPDATE vue_homme SET service = 'cuisine' WHERE nom = 'Gallet';

-- Une table virtuelle est une table qui se construit par rapport à une autre.
-- Habituellement pour créer une table, on utilise CREATE TABLE, une table virtuelle se construit à partir de colonnes et tables déjà existantes.
-- Si nous modifions une donnée dans la vue virtuelle, cela modifie en conséquence dans la table d'origine et inversement, si je modifie des données dans la table d'origine, cela modifie également dans la vue virtuelle.

-- Si nous devons formuler des requêtes très longues, on isole une partie de la table dans une vue virtuelle, ce qui nous permet d'alléger les requêtes et la BDD.

-- La table virtuelle restera tant qu'on ne la supprimera pas.
DROP VIEW vue_homme;