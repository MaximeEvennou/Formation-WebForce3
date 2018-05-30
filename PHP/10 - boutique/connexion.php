<?php
require_once 'inc/init.php';
require_once 'inc/header.php';

if(isset($_POST['form_connexion']))
{
    $resultat = $bdd->prepare("SELECT * FROM membre WHERE PSEUDO = :pseudo OR email = :email");
    $resultat->bindValue(':pseudo', $_POST['pseudo_email']);
    $resultat->bindValue(':email', $_POST['pseudo_email']);
    $resultat->execute();

    if($resultat->rowCount() > 0)
    {
        $membre = $resultat->fetch(PDO::FETCH_ASSOC);
        debug($membre);
    }
    else
    {
        echo 'pseudo ou email erroné';
    }
}

// debug($_POST);
?>

<!-- Réaliser un formulaire HTML de connection (champs pseudo/email, mot de passe, bouton de validation)-->

<h1 class="col-md-6 offset-md-3 mt-5">Formulaire de connexion</h1>

<form method="post" action"" class="col-md-6 offset-md-3">
  <div class="form-group">
    <label for="email">Pseudo ou Email</label>
    <input type="text" class="form-control" id="pseudo_email" name="pseudo_email" placeholder="Enter pseudo or email">
  </div>
  <div class="form-group">
    <label for="mdp">Password</label>
    <input type="text" class="form-control" id="mdp" name="mdp" placeholder="Password">
  </div>
  <button type="submit" name="form_connexion" value="valid_form" class="btn btn-info col-md-4 offset-md-4 mt-4">Valider</button>
</form>

<?php
require_once 'inc/footer.php';
?>