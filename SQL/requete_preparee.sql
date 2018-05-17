---------------------- REQUETE PREPAREE ----------------------
-- Cycle : Analyse / Interprétation / Exécution
-- Avec les requêtes préparées, on les analyse, interprète et ensuite on effectue la dernière action.

PREPARE req FROM 'SELECT * FROM employes WHERE service = "informatique"';

EXECUTE req;

----------------------------------------------------------------------------
PREPARE req2 FROM 'SELECT * FROM abonne WHERE prenom = ?'; -- ? correspond à un marqueur anonyme | ANALYSE / INTERPRETATION

SET @prenom = 'Laura'; -- Déclaration d'une variable

EXECUTE req2 USING @prenom; -- / EXECUTION
EXECUTE req2 USING @prenom; -- / EXECUTION
EXECUTE req2 USING @prenom; -- / EXECUTION
EXECUTE req2 USING @prenom; -- / EXECUTION

SET @prenom = 'Guillaume'; -- On redéclare la variable en affectant une valeur différente

EXECUTE req2 USING @prenom; -- / EXECUTION
EXECUTE req2 USING @prenom; -- / EXECUTION
EXECUTE req2 USING @prenom; -- / EXECUTION
EXECUTE req2 USING @prenom; -- / EXECUTION

DROP PREPARE req2; -- Permet de supprimer la requête préparée

PREPARE req3 FROM 'SELECT * FROM employes WHERE prenom = ? AND service = ?';
-- On peut définir plusieurs marqueurs à la requête

SET @prenom = 'Amandine', @service = 'communication'; -- Déclaration de plusieurs variables

EXECUTE req3 USING @prenom, @service; -- Exécution de la requête préparée