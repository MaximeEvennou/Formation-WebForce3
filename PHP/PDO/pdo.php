<?php
require_once("../post/include/header.php");
// PDO est une classe prédéfinie en PHP permettant de se connecter à une base de données et de pouvoir formuler et exécuter des requêtes SQL
// PDO possède ses propres propriétés et méthodes
echo '<h2 class="text-center mt-3 bg-primary"> 01. PDO: CONNEXION </h2><hr>';

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// $pdo est un objet issu de la classe PDO, c'est grâce à cet objet qu'on va pouvoir interagir avec la base de données
// arguments PDO : 1 (serveur + BDD), 2 (identifiant), 3 (mdp), 4 (options)

echo '<pre>'; var_dump($pdo); echo '</pre>';
echo '<pre>'; print_r(get_class_methods($pdo)); echo '</pre>';

echo '<hr>';

echo '<h2 class="text-center bg-primary"> 02. PDO: EXEC - INSERT - UPDATE - DELETE </h2><hr>';

// INSERT
// formuler la requête SQL permettant de vous insérer dans la BDD entreprise
// $resultat = $pdo->exec("INSERT INTO employes VALUES (NULL, 'Maxime', 'Evennou', 'm', 'informatique', '2018-05-25', 3000)");

echo "Nombre d'enregistrement(s) affecté(s) par l'INSERT : " . $resultat . '<br>';

// EXEC() est une méthode issue de la classe PDO permettant de formuler et d'exécuter des requêtes SQL.
// EXEC() est utilisée pour la formulation de requêtes ne retournant pas de résultat. (INSERT, UPDATE, DELETE).
// EXEC() retourne un INT qui correspond au nombre d'enregistrement affecté par la requête
// Succès : INT
// Echec : Boolean FALSE

// UPDATE
// Formuler la requête SQL permettant de modifier le salaire de l'employer id 350 par 1150
$resultat =  $pdo->exec("UPDATE employes SET salaire = 1150 WHERE id_employes = 350");

echo "Nombre d'enregistrement(s) affecté(s) par l'UPDATE : " . $resultat . '<br>';

// DELETE
// Formuler la requête SQL permettant de supprimer l'employer id 350
$resultat = $pdo->exec("DELETE FROM employes WHERE id_employes = 350");

echo "Nombre d'enregistrement(s) affecté(s) par le DELETE : " . $resultat . '<br>';

echo '<hr>';

echo '<h2 class="text-center bg-primary"> 03. PDO: QUERY - SELECT + FETCH_ASSOC (1 seul résultat) </h2><hr>';

// Formuler la requête permettant de sélectionner les informations n° 417
$resultat = $pdo->query("SELECT * FROM employes WHERE id_employes = 417");

echo '<pre>'; var_dump($resultat); echo '</pre>';
echo '<pre>'; print_r(get_class_methods($resultat)); echo '</pre>';

$employe = $resultat->fetch(PDO::FETCH_ASSOC); // Pour un tableau indexé avec le nom des champs
// $employe = $resultat->fetch(PDO::FETCH_BOTH); // Indexé à la fois numériquement et avec le nom des champs
// $emplye = $resultat-fetch(); // Par défaut, sans arguments fetch() retourne un fetch(PDO::FETCH_BOTH)
// $employe = $resultat->fetch(PDO::FETCH_NUM); // Indexé numériquement
// $employe = $resultat->fetch(PDO::FETCH_OBJ); // Retourne un objet avec le nom des champs comme propriété public
// echo $employe->id_employes . '<br>';

/*
    - $pdo représente un objet issu de la classe prédéfinie PDO
    - Quand on exécute une requête de sélection via la méthode query() sur l'objet PDO :
    - Succès : On obtient un autre objet[2] issu d'une autre classe PDOStatement. Cet objet a donc des méthodes et des propriétés différentes!
    - Echec : On obtient un boolean FALSE

- $resultat est le résultat inexploitable - $employe est le résultat exploitable (grâce au FETCH_ASSOC)
- La méthode FETCH permet de rendre le résultat exploitable sous forme de tableau ARRAY
*/

echo '<pre>'; print_r($employe); echo '</pre>';

// Afficher les informations avec un affichage conventionnel
echo "<div class='alert alert-success text-center col-md-6 offset-md-3'>";
foreach($employe as $key => $value)
{
    echo $key . ' => ' . $value . '<br>';
}
echo '</div>';

echo '<hr>';

echo '<h2 class="text-center bg-primary"> 04. PDO: QUERY - WHILE + FETCH_ASSOC (plusieurs résultats) </h2><hr>';

$resultat = $pdo->query("SELECT * FROM employes");

echo '<pre>'; var_dump($resultat); echo '</pre>';
//--------------------------------------------------------------
// A chaque tour de boucle, êmployes contient un tableau ARRAY avec les données d'un employé, tant qu'il y a des employés, la boucle tourne
while($employes = $resultat->fetch(PDO::FETCH_ASSOC))
    {
        //echo '<pre>'; print_r($employes); echo '</pre>';
        echo "<div class='alert alert-secondary text-center col-md-6 offset-md-3'>";
        echo 'Nom : ' . $employes['nom'] . '<br>';
        echo 'Prenom : ' . $employes['prenom'] . '<br>';
        echo 'Service : ' . $employes['service'] . '<br>';
        echo 'Salaire : ' . $employes['salaire'] . '<br>';
        echo '</div>';
    }

echo '<hr>';
// /!\ On ne peut pas associer 2 fois la même méthode sur le même résultat, nous sommes donc obligé de formuler et d'exécuter à nouveau une requête SQL

$resultat2 = $pdo->query("SELECT * FROM employes");

while($employes = $resultat2->fetch(PDO::FETCH_ASSOC))
    {
    echo "<div class='alert alert-primary text-center col-md-6 offset-md-3'>";
    foreach($employes as $key => $value)
    {
        if($key != 'id_employes')
            {
                echo $key . ' => ' . $value . '<br>';
            }
        }
        echo '</div>';
    }

    echo '<hr>';

    echo '<h2 class="text-center bg-primary"> 05. PDO: QUERY - FETCHALL + FETCH_ASSOC (plusieurs résultats) </h2><hr>';

    $resultat3 = $pdo->query("SELECT * FROM employes");

    $employes = $resultat3->fetchAll(PDO::FETCH_ASSOC);
    // fetchAll() est une méthode issue de la classe PDOStatement qui retourne un tableau multidimensionnel avec chaque tableau ARRAY indexé numériquement

    echo '<pre>'; print_r($employes); echo '</pre>';

    // Exo : Afficher successivement les informations de chaque employé à l'aide de boucles
    // $tableau contient un tableau ARRAY pour chaque tour de boucle foreach
    foreach($employes as $indice => $tableau) 
    {
        // La 2ème boucle foreach permet de passer en revue chaque tableau ARRAY de chaque employé
        echo "<div class='alert alert-danger text-center col-md-6 offset-md-3'>";
        foreach($tableau as $key => $value) 
        {
            if($key != 'id_employes')
            {
            echo $key . ' => ' . $value . '<br>'; 
            }
        }
        
        echo '</div>';
    }

    echo '<hr>';

    echo '<h2 class="text-center bg-primary"> 06. PDO: QUERY - FETCH + BDD (plusieurs résultats) </h2><hr>';
    // Exo : Afficher la liste des bases de données puis la mettre dans une liste ul li

    $resultat4 = $pdo->query("SHOW DATABASES");

    // echo '<pre>'; print_r($resultat4); echo '</pre>';

    echo '<div class="alert alert-warning col-md-4 offset-md-4"><ul>';
    while($bdd = $resultat4->fetch(PDO::FETCH_ASSOC))
    {
        echo "<li>$bdd[Database]</li>";
    }
    echo '</ul></div>';

    //--------------------------------------------------------------
    // Autre méthode
    $resultat5 = $pdo->query("SHOW DATABASES");

    $bdd = $resultat5->fetchAll(PDO::FETCH_ASSOC);

    // echo '<pre>'; print_r($bdd); echo '</pre>';

    echo "<p class='tect-center'>Nombre de BDD : " . $resultat5->rowCount() . '</p><br>'; // rowCount() est une méthode issue de la classe PDOStatement qui permet de compter le nombre de lignes retournées de la requête de sélection

    echo "<div class='alert alert-warning col-md-4 offset-md-4'><ul>";
    foreach($bdd as $tableau) 
    {
        foreach($tableau as $value) 
        {
            echo "<li>$value</li>";
        }  
    }
    echo '</ul></div>';

    echo '<h2 class="text-center bg-primary"> 07. PDO: QUERY - FETCH + TABLE</h2><hr>';

    $resultat6 = $pdo->query("SELECT * FROM employes");

    // $test = $resultat6->columnCount();
    // echo $test;
    // columnCount() est une méthode issue de la classe PDOStatement qui retourne le nombre de colonne de la table dans la BDD
    // getColumnMeta() est une méthode issue de la classe PDOStatement qui récolte les informations des champs/colonnes
    echo '<table class="table"><tr>';
    for($i = 0; $i < $resultat6->columnCount(); $i++)
    {
        $colonne = $resultat6->getColumnMeta($i); // get ColumnMeta nous donnes les infos d'une colonne
        // echo '<pre>'; print_r($colonne); echo '</pre>';
        echo "<th>$colonne[name]</th>"; // vient du print_r au dessus qui nous donne un indice "name" avec l'id_employes
    }
    echo '</tr>';
    while($employes = $resultat6->fetch(PDO::FETCH_ASSOC))
    {
        // echo '<pre>'; print_r($employes); echo '</pre>';
        echo '<tr>';
        foreach($pro as $value)
        {
            echo "<td>$value</td>";
        }
        echo '</tr>';
    }
    echo '</table>';
    


require_once("../post/include/footer.php");