<?php
/*
    1. Réaliser un formulaire HTML correspondant à la table 'employes de la BDD entreprise (sauf le champs id_employes)
    2. Contrôler en PHP que l'on récupère toutes les données saisies dans le formulaire
    3. Connexion BDD
    4. Réaliser le traitement PHP permettant d'insérer un employé dans la table 'employes' lorsqu'on valide le formulaire
*/

// echo '<pre>'; print_r($_POST); echo '</pre>';

require_once("../post/include/header.php");

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$content = '';
if(isset($_POST['formulaire1']) && !empty($_POST))
{
    // Faites en sorte d'informer l'internaute si le nom de famille est déjà existant dans la BDD
    
    $resultat = $pdo->exec("INSERT INTO employes VALUES (NULL, '$_POST[prenom]', '$_POST[nom]', '$_POST[sexe]', '$_POST[service]', '$_POST[date_embauche]', '$_POST[salaire]')");

    // echo "Nombre d'enregistrement(s) affecté(s) par l'INSERT : " . $resultat . '<br>';
}
?>

<h1 class="col-md-6 offset-md-3">Formulaire d'enregistrement</h1><hr>

<form method="post" action"" class="col-md-6 offset-md-3">

    <div class="form-group">
        <label for="prenom">Prenom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prenom">
    </div>
    
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom">
    </div>

    <select class="form-control" id="sexe" name="sexe">
    <option value="m">Homme</option>
    <option value="f">Femme</option>
    </select>
    
    <div class="form-group">
        <label for="service">Service</label>
        <input type="text" class="form-control" id="service" name="service" placeholder="Votre service">
    </div>

    <div class="form-group">
        <label for="date_embauche">Date d'embauche</label>
        <input type="text" class="form-control" id="date_embauche" name="date_embauche" placeholder="Date d'embauche">
    </div>

    <div class="form-group">
        <label for="salaire">Salaire</label>
        <input type="text" class="form-control" id="salaire" name="salaire" placeholder="Votre salaire">
    </div>

    <button type="submit" name="formulaire1" value="valid_form" class="btn btn-dark col-md-12">Enregistrez vous</button>
</form>


<?php
require_once("../post/include/footer.php");
?>