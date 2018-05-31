<?php
require_once 'inc/init.php';
require_once 'inc/header.php';
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion') // On ne rentre ici que lorsque l'on clique sur le lien déconnexion
{
  session_destroy(); // On détruit la session
}

if(internauteEstConnecte()) // Si l'internaute est connecté, il n'a rien à faire sur la page 'connexion', on le redirige vers sa page profil
{
  header("location:profil.php");
}

if(isset($_POST['form_connexion']))
{
    $resultat = $bdd->prepare("SELECT * FROM membre WHERE PSEUDO = :pseudo OR email = :email"); // On sélectionne en BDD tous les membres qui possèdent le même pseudo ou email que l'internaute a saisi
    $resultat->bindValue(':pseudo', $_POST['pseudo_email'], PDO::PARAM_STR); // On associe des valeurs au marqueur
    $resultat->bindValue(':email', $_POST['pseudo_email'], PDO::PARAM_STR);
    $resultat->execute();

    if($resultat->rowCount() > 0) // Si le résultat est supérieur à 0, c'est que le pseudo ou l'email est bien connu dans la BDD
    {
      $membre = $resultat->fetch(PDO::FETCH_ASSOC); // On associe la méthode fetch() au résultat afin de le rendre exploitable et de récupérer les données de l'internaute ayant saisi le bon pseudo ou email.
      // debug($membre);
      // password_verify($_POST['mdp'], $membre['mdp']) // password_verify() permet de comparer une clé de hachage avec un mot de passe
      if($membre['mdp'] == $_POST['mdp']) // On contrôle que le mot de passe de la BDD correspond au mot de passe saisi par dans le formulaire par l'internaute
      {
          foreach($membre as $indice => $valeur) // On passe en revue les données du membre qui a le bon pseudo/email et mdp
          {
            if($indice != 'mdp') // On exclu le mdp qui n'est pas conservé dans la session
            {
              $_SESSION['membre'][$indice] = $valeur; // On créé dans le fichier SESSIOn un tableau membre et on enregistre les données de l'internaute qui pourra dès à présent naviguer sur le site sans ^tre déconnecté
            }
          }
          // debug($_SESSION);
          header("location:profil.php"); // Ayant les bons identifiants, on le redirige vers sa page profil
      }
      else // Sinon l'internaute a saisi un mauvais MDP
      {
        $content .= '<div class="col-md-6 offset-md-3 alert alert-warning text-center">Pseudo ou Email erroné! <a href="inscription.php">Inscrivez-vous</a> afin de pouvoir vous connecter ou veuillez vérifier vos identifiants.</div>';
      }
    }
    else // Sinon l'internaute a saisi un mauvais pseudo ou email
    {
      $content .= '<div class="col-md-6 offset-md-3 alert alert-warning text-center">Pseudo ou Email erroné! <a href="inscription.php">Inscrivez-vous</a> afin de pouvoir vous connecter ou veuillez vérifier vos identifiants.</div>';
    }
      
}

// debug($_POST);
?>

<!-- Réaliser un formulaire HTML de connection (champs pseudo/email, mot de passe, bouton de validation)-->

<h1 class="col-md-6 offset-md-3 mt-5 text-center text-info">Formulaire de connexion</h1>
<hr>
<?= $content ?>
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