<?php
require_once("include/header.php");

echo '<pre>'; print_r($_POST); echo '</pre>';

if(isset($_POST['formulaire1'])) // Si je valide le formulaire alors on entre dans les accolades
{
    echo 'Email : ' . $_POST['email'] . '<br>';
    echo 'MDP : ' . $_POST['mdp'] . '<hr>';
    // Exo : Afficher les données saisies du formulaire à l'aide d'une boucle
    // Faites en sorte d'exclure l'indice du bouton submit à l'affichage
    foreach($_POST as $indice => $info)
    {
        if($indice != 'formulaire1') // On exclu l'indice 'formulaire1' du tableau ARRAY
        {
            echo $indice . ' => ' . $info . '<br>'; // affiche tout sauf ce qui se trouve à l'indice 'formulaire1'
        }
    }
}

/*
La toute première fois, quand on clic sur l'URL et qu'on fait 'Entrer', nous ne rentrons pas dans le IF
Toutes les fois suivante, si nous cliquons sur le bouton 'Connexion', le code se réexécute et nous rentrons le IF
Cliquer sur l'URL et faire 'Entrer' = Nous venons pour la 1ère fois
Faire F5 ou ctrl+r = Nous répétons la dernière action

Dans le cas où nous avons plusieurs formulaires sur la même page, nous déclarons un attribut 'name' pour chaque bouton de validation et nous ajoutons
aux conditions IF : isset($_POST[valeur_attribut_name_submit])
*/
?>

<!-- Réaliser un formulaire HTML avec les champs suivants : Email, mot de passe et un bouton de validation -->
<h1 class="col-md-6 offset-md-3">Formulaire de connexion</h1>

<form method="post" action"" class="col-md-6 offset-md-3"><!-- method : Comment vont circuler les données ? - action : URL de destination-->
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email"><!-- Ne surtout pas oublier les attributs name dans le formulaire HTML -->
  </div>
  <div class="form-group">
    <label for="mdp">Password</label>
    <input type="text" class="form-control" id="mdp" name="mdp" placeholder="Password">
  </div>
  <button type="submit" name="formulaire1" value="valid_form" class="btn btn-dark col-md-12">Connexion</button>
</form>

<?php
require_once("include/footer.php");
?>

