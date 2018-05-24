<!-- 
Réaliser un formulaire HTML avec les champs suivants :
- pseudo, nom, prenom, mdp, email, sexe, adresse, ville, code_postal, pays
-Contrôler en PHP que l'on récupère bien toutes les données saisies du formulaire
- Afficher les données saisies en haut du formulaire avec un affichage conventionnel (boucle)
 -->

 <?php
 /*
    1. Informer l'internaute si la taile du pseudo n'est pas comprise entre 2 et 20 caractères
    2. Faites en sorte d'informer l'internaute qu'il faut saisir un nom dans le cas où le champs est laissé vide
    3. Faites en sorte d'informer l'internaute si le code postal n'est pas de type numérique et que la taille n'est pas de 5 caractères
    4. Faites en sorte d'informer l'internaute si l'email saisi n'est pas valide (indice : fonction prédéfinie filtre)
    5. Faites en sorte d'informer l'internaute si le formulaire est bien rempli, donc qu'il n'y a pas d'erreurs

 */

$content = '';
$erreur = '';
$erreur2 = '';
$erreur3 = '';
$erreur4 = '';
$success = '';
if(isset($_POST['formulaire1']))
{
    foreach($_POST as $indice => $info)
    {
        if($indice != 'formulaire1')
        {
            $content .= $indice . ' => ' . $info . '<br>';
        }
    }
    // ----------------------------------------------------
    // Exo 1 :
    if(strlen($_POST['pseudo']) < 2 || strlen($_POST['pseudo']) > 20 ) 
        {
            $erreur .= '<div class="alert alert-danger col-md-6 offset-md-3">Taille du pseudo non conforme</div>';
        }
    // ----------------------------------------------------
    // Exo 2 :
    if(strlen($_POST['nom']) == 0)
        {
            $erreur2 .= '<div class="alert alert-danger col-md-6 offset-md-3">Veuillez saisir votre nom</div>';
        }
    // ----------------------------------------------------
    // Exo 3 :
    if(!is_numeric($_POST['code_postal']) || strlen($_POST['code_postal']) != 5 )
        {
            $erreur3 .= '<div class="alert alert-danger col-md-6 offset-md-3">Code postal non valide</div>';
        }
    // ----------------------------------------------------
    // Exo 4 :
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
         $erreur4 .= '<div class="alert alert-danger col-md-6 offset-md-3">Adresse email non valide</div>';
    }
    // ----------------------------------------------------
    // Exo 5 :
    if(!$erreur && !$erreur2 && !$erreur3 && !$erreur4)
    {
        $success .= '<div class="alert alert-success col-md-6 offset-md-3">Votre formulaire est valide</div>';
    }
}




require_once("include/header.php");




?>

<h1 class="col-md-6 offset-md-3">Formulaire de connexion</h1><hr>
<?= $content ?>
<?= $success ?>
<form method="post" action"" class="col-md-6 offset-md-3">
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Votre pseudo">
    </div>
    <?= $erreur ?>
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom">
    </div>
    <?= $erreur2 ?>
    <div class="form-group">
        <label for="prenom">Prenom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prenom">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <?= $erreur4 ?>
    <div class="form-group">
        <label for="mdp">Password</label>
        <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Password">
    </div>
    <br>
    Votre sexe :
    <div class="form-check"> 
  <label class="form-check-label"> 
    <input type="checkbox" class="form-check-input" name="sexe" value="homme">Homme
  </label>
</div>
<div class="form-check">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" name="sexe" value="femme">Femme
  </label>
</div>
<br>
    <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Votre adresse">
    </div>
    <div class="form-group">
        <label for="ville">Ville</label>
        <input type="text" class="form-control" id="ville" name="ville" placeholder="Votre ville">
    </div>
    <div class="form-group">
        <label for="code_postal">Code Postal</label>
        <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="Votre Code Postal">
    </div>
    <?= $erreur3 ?>
    <div class="form-group">
        <label for="pays">Pays</label>
        <input type="text" class="form-control" id="pays" name="pays" placeholder="Votre pays">
    </div>
    <button type="submit" name="formulaire1" value="valid_form" class="btn btn-dark col-md-12">Connexion</button>
</form>

<?php
require_once("include/footer.php");
?>
