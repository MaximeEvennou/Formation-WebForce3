-- Qui conduit la voiture 503?
SELECT c.prenom, v.modele, asso.vehicule_id
FROM conducteur c, vehicule v, association_vehicule_conducteur asso
WHERE c.id_conducteur = asso.conducteur_id
AND v.id_vehicule = asso.vehicule_id
AND asso.vehicule_id = 503;

-- Qui conduit quoi?
SELECT c.prenom, v.modele, asso.vehicule_id
FROM conducteur c, vehicule v, association_vehicule_conducteur asso
WHERE c.id_conducteur = asso.conducteur_id
AND v.id_vehicule = asso.vehicule_id;