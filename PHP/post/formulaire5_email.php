<?php
/*
    - Réaliser un formulaire HTML avec les champs suivants : Nom, prénom, société, email, sujet, message
    - contrôler en PHP que l'on récupère bien toutes les données saisies du formulaire
*/

if(isset($_POST['formulaire1']))
{
    $_POST['expediteur'] = "From: $_POST[expediteur] \r\n";
    $_POST['expediteur'] .= "Objet: $_POST[sujet] \r\n";
    $_POST['expediteur'] .= "MIME-Version: 1.0  \r\n"; // protocole d'envoi de mail permettant d'étendre les possibilités d'envoi (images, texte, sons)
    $_POST['expediteur'] .= "Content-type: text/html; charset=utf8 \r\n"; // Cette ligne permet d'envoyer du code HTML directement dans le corps du message, pratique pour l'envoi de newsletter
    $_POST['message'] = "Nom: " . $_POST['nom'] . '<br>Prénom: ' . $_POST['prenom'] . '<br>Société: ' . $_POST['societe'] . '<br>Sujet: ' . $_POST['sujet'] . '<br>Message: ' . $_POST['message'];

// echo '<pre>'; print_r($_POST); echo '</pre>';
$mail = 'maxime.evennou0406@gmail.com';
mail($mail, $_POST['sujet'], $_POST['message'], $_POST['expediteur']);
// La fonction mail reçoit toujours 4 ARGUMENTS et l'ordre est crucial. Comme dans la plupart des fonctions, il faut respecter le NOMBRE et l'ORDRE des arguments
}
require_once("include/header.php");
?>


<h1 class="col-md-6 offset-md-3">Formulaire de contact</h1><hr>

<form method="post" action"" class="col-md-6 offset-md-3">
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom">
    </div>
    
    <div class="form-group">
        <label for="prenom">Prenom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prenom">
    </div>

    <div class="form-group">
        <label for="societe">Societe</label>
        <input type="text" class="form-control" id="societe" name="societe" placeholder="Quelle société?">
    </div>

    
    <div class="form-group">
        <label for="expediteur">Email</label>
        <input type="text" class="form-control" id="expediteur" name="expediteur" placeholder="Votre email">
    </div>

    <div class="form-group">
        <label for="sujet">Sujet</label>
        <input type="text" class="form-control" id="sujet" name="sujet" placeholder="Sujet">
    </div>
    
    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" name="message" rows="10"></textarea>
    </div>
    
    <button type="submit" name="formulaire1" value="valid_form" class="btn btn-dark col-md-12">Connexion</button>
</form>

<?php
require_once("include/footer.php");
?>