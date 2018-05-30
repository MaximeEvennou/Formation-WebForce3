<?php
// Un cookie est un fichier conserver côté client/internaute qui regroupe des informations minime tel que : les derniers articles consultés ou achetés, suggestions de produits.

if(isset($_GET['pays'])) // Si un pays est passé dans l'URL c'est que nous avons cliqué sur un lien
{
    $pays = $_GET['pays']; // on stock les données transmises dans l'URL dans la variable $pays
}
elseif(isset($_COOKIE['pays'])) // on ne rentre que dans le elseif uniquement si la condition du if n'est pas passé et qu'un cookie existe
{
    $pays = $_COOKIE['pays'];
}
else // condition par défaut, à la première visite du site, si on a pas cliqué sur un lien et que le cookie n'a pas été crée 
{
    $pays = 'fr';
}

//--------------------------------------------
//echo time(); // permet de voir le nombre de seconde écoulées entre le 1rer janvier 1970 et maintenant, ce nombre évolue sans cesse

$un_an = 365*24*3600; // une année en seconde 
setCookie("pays",$pays,time()+$un_an); // setCookie('nom_du_cookie', valeur, durée de vie)

//--------------------------------------------
$content = '';
switch($pays)
{
    case 'fr':
    $content .= "Vous êtes sur un site en français";
    break;

    case 'es':
    $content .= "Vous êtes sur un site en espagnol";
    break;

    case 'en':
    $content .= "Vous êtes sur un site en anglais";
    break;

    case 'it':
    $content .= "Vous êtes sur un site en italien";
    break;
}

require_once '../3 - post/include/header.php'; 
?>

<!-- Exo : Effectuer 4 liens pointant sur la même page dans une liste ul li
    4 liens : France, Espagne, Angleterre, Italie
-->
<h2 class="text-center">Votre langue:</h2><hr>
<p class="text-center"><?= $content ?></p>
<hr><ul class="list-group col-md-4 offset-md-4">
    <li class="list-group-item text-center"><a href="?pays=fr">France</a></li>
    <li class="list-group-item text-center"><a href="?pays=es">Espagne</a></li>
    <li class="list-group-item text-center"><a href="?pays=en">Angleterre</a></li>
    <li class="list-group-item text-center"><a href="?pays=it">Italie</a></li>
</ul>

<?php
require_once '../3 - post/include/footer.php'; 
?>