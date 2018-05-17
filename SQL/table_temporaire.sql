CREATE TEMPORARY TABLE commerciaux AS SELECT * FROM employes WHERE service = 'commercial';

-- Exo : Formuler la requête permettant de modifier le salaire de l'employé 415 par 1500.

-- A partir de la vue temporaire
UPDATE commerciaux SET salaire = 1500 WHERE id_employes = 415;

-- A partir de la table 'employes'
UPDATE employes SET salaire = 1800 WHERE id_employes = 415;

-- Une table temporaire est une table qui se construit par rapport à une autre.
-- Habituellement pour créer une table, on utilise CREATE TABLE, une table temporaire se construit à partir de colonnes et tables déjà existantes.
-- Si je modifie des données via la table temporaire, cela n'impact pas sur la table d'origine et inversement, si je modifie la table d'origine, cela n'affecte pas la table temporaire.