<?php
require_once 'inc/init.php';
require_once 'inc/header.php';

if(isset($_GET['id_produit'])):

    $resultat = $bdd->prepare("SELECT * FROM produit WHERE id_produit = :id_produit");
    $resultat->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_INT);
    $resultat->execute();

    if($resultat->rowCount() == 0) // Si le résultat est égal à 0, c'est qu'il n'y a aucun produit correspondant dans la BDD
    {
        header("location:boutique.php"); // Redirection vers la boutique
        exit(); // On stop l'exécution du script
    }

    $produit = $resultat->fetch(PDO::FETCH_ASSOC);
    // debug($produit);
?>

<div class="col-md-8 offset-md-2 mt-4">
        <div class="card h-100">
          <img class="card-img-top" src="<?= $produit['photo'] ?>" alt="">
          <div class="card-body text-center">
            <h4 class="card-title text-info">
            <strong>
              <?= $produit['titre'] ?>
              </strong>
            </h4>
            <h5><?= $produit['prix'] ?>€</h5>
            <p class="card-text"><strong>Taille</strong> : <?= $produit['taille'] ?></p>
            <p class="card-text"><strong>Public</strong> : <?= $produit['public'] ?></p>
            <p class="card-text"><strong>Couleur</strong> : <?= $produit['couleur'] ?></p>
            <p class="card-text"><?= $produit['description'] ?></p>
          </div>
          <div class="card-footer">
            <?php if($produit['stock'] > 0): ?>

                <form method="post" action="panier.php">
                    <div class="form-group">
                        <input type="hidden" id="id_produit" name="id_produit" value="<?= $produit['id_produit'] ?>">
                        <label for="quantite">Quantité</label>
                        <select class="form-control" name="quantite" id="quantite">
                            <?php
                            for($i = 1; $i <= $produit['stock'] && $i <= 20; $i++)
                            {
                                echo "<option>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="ajout_panier" value="valid_form" class="btn btn-info col-md-4 offset-md-4 mb-3 mt-3">Ajouter au panier</button>
                </form>
                <p class="text-center"><a href="boutique.php?categorie=<?= $produit['categorie'] ?>" class="alert-link text-info">Retour vers la catégorie de <?= $produit['categorie'] ?></a></p>

            <?php else: ?>
                <p class="text-danger text-center"><strong>RUPTURE DE STOCK</strong></p>
                <p class="text-center"><a href="boutique.php?categorie=<?= $produit['categorie'] ?>" class="alert-link text-info">Retour vers la catégorie de <?= $produit['categorie'] ?></a></p>
            <?php endif; ?>
          </div>
        </div>
</div>


<?php
endif;
require_once 'inc/footer.php';
?>