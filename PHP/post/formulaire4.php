<?php
require_once("include/header.php");

if($_POST)
{
foreach($_POST as $indice => $info)
    {
        echo  $indice . ' => ' . $info . '<br>'; 
    }

    // Exo : Enregistrer dynamiquement dans un fichier .txt, le pseudo et l'email du formulaire3.php grâce aux fonctions suivantes :
    /*
        fopen()
        fwrite()
        fclose()
    */

$fliste = fopen('liste.txt', 'a'); // fopen() en mode "a" permet de créer le fichier s'il n'est pas trouvé, sinon de l'ouvrir
    fwrite($fliste, $_POST['pseudo'] . ' - ' . $_POST['email'] . "\r\n"); // fwrite() permet d'écrire dans le fichier représenté par $liste
    fclose($fliste); // fclose() qui n'est pas indispensable, permet de fermer le fichier et de libérer de la ressource
    // Contexte : Si l'on souhaite enregistrer des membres à une newsletter et que l'on ne possède pas de BDD, il serait intéressant de le faire via un fichier texte
}
else
{
    echo "T'as rien à foutre là, dégage !";
}
?>


<?php
require_once("include/footer.php");
?>