<?php
require_once '../inc/init.php';

if(!internauteEstConnecteEtEstAdmin()) // Si l'internaute n'est pas admin, il n'a rien à faire ici, on le redirige vers la page connexion
{
    header("location:" . URL . "connexion.php");
}

//------ ENREGISTREMENT PRODUIT
if(isset($_POST['form_produit']))
{
    $photo_bdd ='';
    if(!empty($_FILES['photo']['name']))
    {
        $nom_photo = $_POST['reference'] . '-' . $_FILES['photo']['name']; // On concatène la référence saisie dans le formulaire avec le nom de la photo via la superglobale $_FILES
        // echo $nom_photo;

        $photo_bdd = URL . "photo/$nom_photo"; // On définit l'URL de la photo que l'on conservera dans la BDD
        // echo $photo_bdd;

        $photo_dossier = RACINE_SITE . "photo/$nom_photo"; // On définit le chemin physique de la photo sur le serveur
        // echo $photo_dossier;

        copy($_FILES['photo']['tmp_name'], $photo_dossier); // La fonction copy() permet de copier la photo directement dans le dossier photo - 2 arguments : 1 - Le nom temporaire de la photo -- 2 - Le chemin physique de la photo sur le serveur
    }
    // Exo : Réaliser le script permettant de contrôler la disponibilité de la référence, et si il n'y a pas d'erreur, réaliser le script permettant d'insérer un produit dans la BDD (requête préparée)
    $erreur = '';
    $verif_ref = $bdd->prepare("SELECT * FROM produit WHERE reference = :reference");
    $verif_ref->bindValue(':reference', $_POST['reference'], PDO::PARAM_STR);
    $verif_ref->execute();

    if($verif_ref->rowCount() > 0)
    {
        $erreur .= '<div class="col-md-6 offset-md-3 alert alert-warning text-center">Référence existante! Merci de saisir une référence valide.</div>';
    }

    if(empty($erreur))
    {
        $insert_produit = $bdd->prepare("INSERT INTO produit (reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES (:reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)");

        // $resultat->bindValue(":reference", $_POST["reference"], PDO::PARAM_STR);
        // $resultat->bindValue(":categorie", $_POST["categorie"], PDO::PARAM_STR);
        // $resultat->bindValue(":titre", $_POST["titre"], PDO::PARAM_STR);
        // $resultat->bindValue(":description", $_POST["description"], PDO::PARAM_STR);
        // $resultat->bindValue(":couleur", $_POST["couleur"], PDO::PARAM_STR);
        // $resultat->bindValue(":taille", $_POST["taille"], PDO::PARAM_STR);
        // $resultat->bindValue(":public", $_POST["public"], PDO::PARAM_STR);
        // $resultat->bindValue(":photo", $photo_bdd, PDO::PARAM_STR);
        // $resultat->bindValue(":prix", $_POST["prix"], PDO::PARAM_INT);
        // $resultat->bindValue(":stock", $_POST["stock"], PDO::PARAM_INT);

        // OU

        $resultat = $bdd->query("SELECT * FROM produit");

        for($i = 0; $i < $resultat->columnCOUNT(); $i++) // On boucle tant qu'il y a des colonnes dans le résultat
        {
            $colonne = $resultat->getColumnMeta($i); // Permet de récolter les informations des champs et des colonnes 
            // debug($colonne);
            if($colonne['name'] != 'id_produit') // On exclu 'id_produit' et 'statut'
            {
                if($colonne['native_type'] == 'LONG') // Si le marqueur est de type 'INT' on entre dans le IF et on modifie les arguments de bindValue()
                {
                    $insert_produit->bindValue(":$colonne[name]", $_POST["$colonne[name]"], PDO::PARAM_INT);
                }
                else // Sinon dans tous les autres cas, type 'STRING'
                {
                    if($colonne['name'] == 'photo')
                    {
                        $insert_produit->bindValue(":$colonne[name]", $photo_bdd, PDO::PARAM_STR);
                    }
                    else
                    {
                        $insert_produit->bindValue(":$colonne[name]", $_POST["$colonne[name]"], PDO::PARAM_STR);
                    }
                }
            }
        }

        $insert_produit->execute();

        $content .= "<div class='col-md-6 offset-md-3 alert alert-success text-center'>Le produit référence $_POST[reference] a bien été enregistré!</div>";
        
    $content .= $erreur;
    }
}
require_once '../inc/header.php';
debug($_POST);
debug($_FILES);
?>

<!-- Réaliser un formulaire HTML correspondant à la table 'produit' de la BDD 'ecommerce' (saud le champs 'id_produit') -->
<h1 class="col-md-6 offset-md-3 text-center text-info mt-5">Ajouter un produit</h1>
<hr>
<?= $content ?>
<form method="post" action"" enctype="multipart/form-data" class="col-md-6 offset-md-3 border border-info rounded mt-2 p-2">
    <div class="form-group">
        <label for="reference">Référence</label>
        <input type="text" class="form-control" id="reference" name="reference">
    </div>
    <div class="form-group">
        <label for="categorie">Catégorie</label>
        <input type="text" class="form-control" id="categorie" name="categorie">
    </div>
    <div class="form-group">
        <label for="titre">Titre</label>
        <input type="text" class="form-control" id="titre" name="titre">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea type="text" class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="form-group">
        <label for="couleur">Couleur</label>
        <input type="text" class="form-control" id="couleur" name="couleur">
    </div>
    <div class="form-group">
        <label for="taille">Taille</label>
        <select 
        type="text" class="form-control" id="taille" name="taille">
            <option value="s">S</option>
            <option value="m">M</option>
            <option value="l">L</option>
            <option value="xl">XL</option>
        </select>
    </div>
    <div class="form-group">
        <label for="public">Public</label>
        <select 
        type="text" class="form-control" id="public" name="public">
            <option value="m">Homme</option>
            <option value="f">Femme</option>
            <option value="mixte">Mixte</option>
        </select>
    </div>
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" class="form-control" id="photo" name="photo">
    </div>
    <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control" id="prix" name="prix">
    </div>
    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="text" class="form-control" id="stock" name="stock">
    </div>
   
    <button type="submit" name="form_produit" value="valid_produit" class="btn btn-info col-md-4 offset-md-4 mb-3 mt-3">Valider</button>
</form>
<?php
require_once '../inc/footer.php';
?>