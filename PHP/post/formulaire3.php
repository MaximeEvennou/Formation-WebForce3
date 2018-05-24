<?php
require_once("include/header.php");

// echo '<pre>'; print_r($_POST); echo '</pre>';
?>

<!-- 
    Réaliser un formulaire HTML avec les champs suivants : pseudo, email et un bouton submit en récupérant et en affichant les données sur la page formulaire4.php
 -->

<h1 class="col-md-6 offset-md-3">Formulaire de connexion</h1>

<form method="post" action="formulaire4.php" class="col-md-6 offset-md-3">
  <div class="form-group">
    <label for="mdp">Pseudo</label>
    <input type="text" class="form-control" id="pseudo" name="pseudo"  placeholder="Enter pseudo">
  </div>
  <div class="form-group">
    <label for="mdp">Email</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <button type="submit" name="formulaire1" value="valid_form" class="btn btn-dark col-md-12">Envoi</button>
</form>

<?php
require_once("include/footer.php");
?>