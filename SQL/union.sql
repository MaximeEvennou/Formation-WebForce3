-- UNION permet de fusionner 2 résultats dans une même liste de résultats

-- Permet d'afficher les prénoms des abonnés dans la même liste que les noms des auteurs.
SELECT auteur AS 'liste personne physique' FROM livre UNION SELECT prenom FROM abonne;

-- UNION est un UNION DISTINCT (évite les doublons) par défaut. Sinon il faut utiliser UNION ALL
SELECT auteur AS 'liste personne physique' FROM livre UNION ALL SELECT prenom FROM abonne;
