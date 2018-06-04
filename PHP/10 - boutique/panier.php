<?php
require_once 'inc/init.php';

//------ AJOUT PANIER ------//
if(isset($_POST['ajout_panier']))
{
    // debug($_POST);
    $resultat = $bdd->prepare("SELECT * FROM produit WHERE id_produit = :id_produit");
    $resultat->bindValue(':id_produit', $_POST['id_produit'], PDO::PARAM_INT);
    $resultat->execute();

    $produit = $resultat->fetch(PDO::FETCH_ASSOC);
    // debug($produit);

    ajouterProduitDansPanier($produit['titre'], $_POST['id_produit'], $_POST['quantite'], $produit['prix']);

    // debug($_SESSION);
}

//--------- PAIMENT ---------//
if(isset($_POST['payer'])) // Si on a cliqué sur le bouton 'valider le paiment', alors on entre dans la condition
{
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) // Tant qu'il y a l'id_produit dans la session, on passe en revue tous les produits dans la session
    {
        $resultat = $bdd->query("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]); // On sélectionne en BDD les informations des produits ajoutés au panier
        //debug($resultat);
        $produit = $resultat->fetch(PDO::FETCH_ASSOC); // On associe une méthode pour rendre le résultat exploitable
        // debug($produit);

        $erreur = '';
        if($produit['stock'] < $_SESSION['panier']['quantite'][$i]) // Si le stock en BDD est inférieur à la quantité ajouté au panier, on entre dans la condition IF
        {
            $erreur .= '<div class="alert alert-warning col-md-6 offset-md-3 mt-3 text-center">Stock restant du produit <strong>' . $_SESSION['panier']['titre'][$i] . ' : ' . $produit['stock'] . '</strong></div>'; // Affichage du stock restant en BDD

            $erreur .= '<div class="alert alert-warning col-md-6 offset-md-3 text-center">Stock demandé du produit <strong>' . $_SESSION['panier']['titre'][$i] . ' : ' . $_SESSION['panier']['quantite'][$i] . '</strong></div>'; // Affichage de la quantité demandée dans la session

            if($produit['stock'] > 0) // Si le stock de la BDD est supérieur à 0, cela veut dire qu'il reste des produits en BDD mais pas suffisamment par rapport à la quantité demandée
            {
                $erreur .= '<div class="alert alert-warning col-md-6 offset-md-3 text-center">La quantité du produit <strong>' . $_SESSION['panier']['titre'][$i] . ' a été réduite car notre stock est insuffisant, veuillez vérifier vos achats!</strong></div>';

                $_SESSION['panier']['quantite'][$i] = $produit['stock'];
            }
            else // Dans tous les autres cas, le stock est à 0, on supprime donc le produit dans la session et on actualise le panier
            {
                $erreur .= '<div class="alert alert-warning col-md-6 offset-md-3 text-center">Le produit <strong>' . $_SESSION['panier']['titre'][$i] . ' a été supprimé car nous sommes en rupture de stock, vérifiez vos achats!</strong></div>';

                retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]); // On supprime le produit dans la session
                $i--;
                // On fait une décrémentation de la boucle, parce que la fonction array_splice() supprime le produit mais réorganise la session, elle remonte les indices supérieurs, cela nous permet de ne pas oublier de contrôler un produit qui aurait changé d'indice
            }
        }
        $content .= $erreur;
    }

    if(empty($erreur))
    {
        $resultat = $bdd->exec("INSERT INTO commande (membre_id, montant, date_enregistrement) VALUES (" . $_SESSION['membre']['id_membre'] . " , " . montantTotal() . ", NOW())"); // On insert les données dans la table commande

        $id_commande = $bdd->lastInsertId(); // On récupère le dernier ID généré dans la table commande, nous en avons besoin pour l'insertion du détail de la commande
        // echo $id_commande;

        for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) // La boucle tourne tant qu'il y a des produits dans la session
        {
            $resultat = $bdd->exec("INSERT INTO details_commande (commande_id, produit_id, quantite, prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . " , " . $_SESSION['panier']['quantite'][$i] . " , " . $_SESSION['panier']['prix'][$i] . ")"); // Pour chaque tour de boucle, on insère le détail de la commande pour chaque produit

            $resultat = $bdd->exec("UPDATE produit SET stock = stock - " . $_SESSION['panier']['quantite'][$i] . " WHERE id_produit = " . $_SESSION['panier']['id_produit'][$i]); // Dépréciation des stocks
        }
        unset($_SESSION['panier']); // On vide le panier dans la session

    $content .= '<div class="alert alert-success col-md-6 offset-md-3 text-center mt-3">Votre commande a bien été validée. Voici votre n° de commande <strong>' . $id_commande . '</srong></div>';
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'supprimer')
    {
        retirerProduitDuPanier(end($_SESSION['panier']['id_produit']));
        $content .= '<div class="alert alert-success col-md-6 offset-md-3 text-center mt-3">Votre commande a bien été supprimée.'  . '</div>';
    }
if(isset($_GET['action']) && $_GET['action'] == 'vider')
{
    unset($_SESSION['panier']);
    $content .= '<div class="alert alert-success col-md-6 offset-md-3 text-center mt-3">Votre panier a bien été vidé.' . '</div>';
}


require_once 'inc/header.php';
echo $content;
?>

<table class="table text-center">
    <tr><th colspan="5" class="text-center">PANIER</th></tr>
    <tr><th>Titre</th><th>Quantité</th><th>Prix Unitaire</th><th>Prix Total</th><th>Supprimer</th></tr>

    <?php if(empty($_SESSION['panier']['id_produit'])): ?>

    <tr><td colspan="5"><p class="text-center text-danger"><strong>VOTRE PANIER EST VIDE</strong></p></td></tr>

    <?php else: ?>

        <?php for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++): ?>

            <tr>
                <td><?= $_SESSION['panier']['titre'][$i]?></td>
                <td><?= $_SESSION['panier']['quantite'][$i]?></td>
                <td><?= $_SESSION['panier']['prix'][$i]?></td>
                <td><?= $_SESSION['panier']['quantite'][$i]*$_SESSION['panier']['prix'][$i]?>€</td>
                <td><a href="?action=supprimer"><i class="fas fa-trash-alt text-info" name="supprimer"></i></a></td>
            
            </tr>

        <?php endfor; ?>
            <tr><th>Total</th><td></td><td></td><td><strong><?= montantTotal()  ?>€</strong></td><td></td></tr>

        <?php if(internauteEstConnecte()): ?>

            <form method="post" action="">
                <tr><td colspan="4"><button type="submit" name="payer" class="btn btn-info col-md-6 offset-md-3 mb-2" value="ajout_panier">Valider et déclarer le paiement</button></td></tr>
            </form>
        
        <?php else: ?>

            <tr><td colspan="5"><p>Veuillez vous <a href="inscription.php" class="alert-link">inscrire</a> ou vous <a href="connexion.php" class="alert-link">connecter</a> afin de valider vos achats!</p></td></tr>

        <?php endif; ?>

        <tr><td colspan="5"><a href="?action=vider" name="vider" class="text-info"><i class="fas fa-trash-alt text-info"></i> Vider mon panier</a></td></tr>

    <?php endif; ?>

</table>

<?php
require_once 'inc/footer.php';
?>