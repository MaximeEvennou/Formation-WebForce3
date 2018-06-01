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

    debug($_SESSION);
}

require_once 'inc/header.php';
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
                <td><a href=""><i class="fas fa-trash-alt text-info"></i></a></td>
            
            </tr>

        <?php endfor; ?>
            <tr><th>Total</th><td></td><td></td><td><strong><?= montantTotal()  ?>€</strong></td><td></td></tr>

    <?php endif; ?>

</table>

<?php
require_once 'inc/footer.php';
?>