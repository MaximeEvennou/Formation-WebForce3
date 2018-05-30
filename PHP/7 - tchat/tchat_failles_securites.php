<?php
/*
    Exo : TCHAT
    1. Modélisation et création de la BDD
        BDD : tchat
        Table : commentaire
                id_commentaire    // INT(3) PK -AI
                pseudo            // VARCHAR(20)
                message           // TEXT
                dateEnregistrement// DATETIME
    2. Connexion à la BDD
    3. Création d'un formulaire HTML (pour l'ajout de message)
    4. Récupération et affichage des saisies en PHP
    5. Requete SQL d'enregistrement (INSERT)
    6. Affichage des messages (SELECT)    
    
    //------------------------------------------------------------
    // FAILLES DE SECURITE 

    - INJECTIONS SQL : 
    Exemple d'injection : 
    -- ok'); DELETE FROM commentaire;(

    En préparant la requête, nous pouvons observer que le comportement de la requête INSERT n'est pas modifié, l'injection SQL est enregistré comme commentaire dans la BDD
    les marqueurs nominatifs peuvent être comparés à des tampons ou des boites qui permettent d'enfermer la valeur insérée
    
    - FAILLES XSS :
    <script>
    body{display: none;}
    </script>
    
    //---------------------------------

    <script>
    var point = true
    while(point == true)
    alert("je t'ai bien eu!!!")    
    </script>

    Moyen de contre : 
    - strip_tags() permet de supprimer les balises HTML
    - htmlspecialchars() permet de rendre inoffensives les balises HTML
    - htmlentities() permet de convertir les balises HTML en entités HTML
*/
        
// Exo 2:
$pdo = new PDO('mysql:host=localhost;dbname=tchat', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Exo 5:
if(isset($_POST['form_tchat']))
{
    // $req = "INSERT INTO commentaire (pseudo, dateEnregistrement, message) VALUES('$_POST[pseudo]', NOW(), '$_POST[message]')";

    // $resultat = $pdo->exec($req);

    // echo $req;

    foreach($_POST as $indice => $valeur) // en passe en revu le formumlaire en executant pour chaque donnée saisie la fonction prédéfinie strip_tags qui pemrmet de supprimer les balises HTML
    {
        $_POST[$indice] = strip_tags($valeur);
    }

    // Exo : préparée le requête d'insertion
    $req = "INSERT INTO commentaire (pseudo, dateEnregistrement, message) VALUES (:pseudo, NOW(), :message)";

    $resultat = $pdo->prepare($req);

    $resultat->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $resultat->bindValue(':message', $_POST['message'], PDO::PARAM_STR);
    
    $resultat->execute();

    echo $req;

    //echo 'Nombre d\'insertion message ' . $resultat . '<br>';
}

// Exo 6:
$content = '';

$resultat = $pdo->query("SELECT pseudo,message, DATE_FORMAT(dateEnregistrement, '%d/%m/%Y') AS datefr, DATE_FORMAT(dateEnregistrement, '%H:%i:%s') AS heurefr FROM commentaire ORDER BY dateEnregistrement DESC");

$content .= '<h3 class="text-center">' . $resultat->rowCount() . ' commentaire(s)</h3><hr>';

while($commentaire = $resultat->fetch(PDO::FETCH_ASSOC))
{
    //echo '<pre>'; print_r($commentaire); echo '</pre>';
    $content .= '<div class="col-md-6 offset-md-3 alert alert-info">';
        $content .= "<div class=''>Par: $commentaire[pseudo] le $commentaire[datefr] à $commentaire[heurefr]</div><hr>";
        $content .= "<div class='text-right'><i>$commentaire[message]</i></div>";
    $content .= '</div>
    ';
}

require_once '../3 - post/include/header.php';

//echo '<pre>'; print_r($_POST); echo '</pre>';
?>

<!-- Exo 3: -->
<h2 class="text-center">TCHAT</h2><hr>
<?= $content ?>
<form method="post" action="" class="col-md-6 offset-md-3">
  <div class="form-group">
    <label for="pseudo">Pseudo</label>
    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Enter pseudo">
  </div>
  <div class="form-group">
    <label for="message">Nom</label>
    <textarea type="text" class="form-control" id="message" name="message" placeholder="Enter message"></textarea>
  </div>
  
  <button type="submit" name="form_tchat" value="poster" class="btn btn-dark col-md-12">Poster</button>
</form>

<?php
require_once '../3 - post/include/footer.php';
?>