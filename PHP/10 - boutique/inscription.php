<?php
require_once 'inc/init.php';

if(internauteEstConnecte()) // Si l'internaute est connecté, il n'a rien à faire sur la page 'connexion', on le redirige vers sa page profil
{
  header("location:profil.php");
}


/*
    Contrôler les champs suivants :
    - Faites en sorte d'informer l'internaute si le pseudo et l'email sont déjà existants dans la BDD
    - Contrôler que les 2 mots de pass sont identiques
    - Contrôler la validité du champs email
    - Contrôler que le pseudo soit compris entre 2 et 20 caractères

*/
if(isset($_POST['formulaire1']))
{
    $erreur = '';
    // VERIF PSEUDO
    $verif_pseudo = $bdd->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
    $verif_pseudo->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $verif_pseudo->execute();
    if($verif_pseudo->rowCount() > 0)
    {
        $erreur .= '<div class="col-md-6 offset-md-3 alert alert-warning text-center">Pseudo existant! Merci de saisir à nouveau</div>';
    }
    else
    {
        if((strlen($_POST['pseudo']) < 2 || strlen($_POST['pseudo']) > 20) || !preg_match('#^[A-Za-z0-9._-]+$#', $_POST['pseudo']))
        {
            $erreur .= '<div class="col-md-6 offset-md-3 alert alert-warning text-center">Taille (Entre 2 et 20 caractères) ou format non valide (caractères autorisés : [A-Z a-z 0-9 . _ -]) !</div>';
        }

        /*
            preg_match() : Une expression régulière (regex) est toujours entouré de dieze afin de préciser des options :
            - ^ indique le début de la chaîne
            - $ indique la fin de la chaîne
            - + est là pour dire que les caractères autorisés peuvent apparaître plusieurs fois
        */
    }

    // VERIF EMAIL
    // Si le format email est erroné, on entre dans la condition IF
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $erreur .= '<div class="col-md-6 offset-md-3 alert alert-warning text-center">Format Email erroné!</div>';
    }
    else // Sinon le format est valide, in contrôle dans le else l'existence de l'email en BDD
    {
        $verif_email = $bdd->prepare("SELECT * FROM membre WHERE email = :email");
        $verif_email->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $verif_email->execute();
        if($verif_email->rowCount() > 0)
        {
            $erreur .= '<div class="col-md-6 offset-md-3 alert alert-warning text-center">Email existant! <a href="connexion.php" class="alert-link">Connectez-vous</a> ou vérifiez vos identifiants!</div>';
        }
    }

    // VERIF MDP
    if($_POST['mdp'] !== $_POST['mdp_confirm'])
    {
        $erreur .= '<div class="col-md-6 offset-md-3 alert alert-warning text-center">Vérifiez la confirmation du mot de passe!</div>';
    }
    
    $content .=$erreur;

    // Réaliser le traitement permettant d'insérer un membre dans la table 'membre' si 'il n'y a pas d'erreur (requête préparée) 
    if(empty($erreur))
    {
        // Contrôle faille XSS
        // trim() est une fonction prédéfinie qui supprime les espaces en début et fin de chaîne
        foreach($_POST as $indice => $valeur)
        {
            $_POST[$indice] = strip_tags(trim($valeur));
        }
        $insert = $bdd->prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse)");
    
        // $insert->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);

        // Les mots de passe ne sont jamais gardés en clair dans la BDD
        //password_hash() est une fonction préféfinie permettant de créer une clé de hachage
        // Pour comparer une clé de hachage avec une chaîne de caractères, au moment de la connexion, nous utiliserons password_verify()
        // $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        $resultat = $bdd->query("SELECT * FROM membre");

        for($i = 0; $i < $resultat->columnCOUNT(); $i++) // On boucle tant qu'il y a des colonnes dans le résultat
        {
            $colonne = $resultat->getColumnMeta($i); // Permet de récolter les informations des champs et des colonnes 
            // debug($colonne);
            if($colonne['name'] != 'id_membre' && $colonne['name'] != 'statut') // On exclu 'id_membre' et 'statut'
            {
                if($colonne['native_type'] == 'LONG') // Si le marqueur est de type 'INT' on entre dans le IF et on modifie les arguments de bindValue()
                {
                    $insert->bindValue(":$colonne[name]", $_POST["$colonne[name]"], PDO::PARAM_INT);
                }
                else // Sinon dans tous les autres cas, type 'STRING'
                {
                $insert->bindValue(":$colonne[name]", $_POST["$colonne[name]"], PDO::PARAM_STR);
                }
            }
        }

    $insert->execute();

    $content .= '<div class="col-md-6 offset-md-3 alert alert-success text-center">Vous êtes bien inscrit sur le site, vous pouvez dès à présent vous <a href="connexion.php" class="alert-link">connecter!!</a></div>';
    }
}

require_once 'inc/header.php';

// debug($_POST);
?>

<!-- Réaliser un formulaire HTML correspondant à la table 'membre' de la BDD 'ecommerce' (sauf les champs id_membre, statut) -->

<h1 class="col-md-6 offset-md-3 text-center text-info mt-5">Formulaire d'inscription</h1>
<hr>
<?= $content ?>
<form method="post" action"" class="col-md-6 offset-md-3 border border-info rounded mt-2">
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Votre pseudo" pattern="[A-Za-z0-9._-]{2,20}" title="caractères acceptés : A-Z a-z 0-9 . _ -">
    </div>
    <div class="form-group">
        <label for="mdp">Mot de passe</label>
        <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Votre mot de passe">
    </div>
    <div class="form-group">
        <label for="mdp_confirm">Confirmation du mot de passe</label>
        <input type="password" class="form-control" id="mdp_confirm" name="mdp_confirm" placeholder="Confirmez votre mot de passe">
    </div>
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom">
    </div>
    <div class="form-group">
        <label for="prenom">Prenom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prenom">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="civilite">Civilité</label>
        <select 
        type="text" class="form-control" id="civilite" name="civilite">
            <option value="m">Homme</option>
            <option value="f">Femme</option>
        </select>
    </div>
    <div class="form-group">
        <label for="ville">Ville</label>
        <input type="text" class="form-control" id="ville" name="ville" placeholder="Votre ville">
    </div>
    <div class="form-group">
        <label for="code_postal">Code Postal</label>
        <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="Votre Code Postal">
    </div>
    <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Votre adresse">
    </div>
   
    <button type="submit" name="formulaire1" value="valid_form" class="btn btn-info col-md-4 offset-md-4 mb-3 mt-3">Valider</button>
</form>

<?php
require_once 'inc/footer.php';