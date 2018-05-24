<?php
/*
1. Effectuer 4 liens HTML pointant sur la même page avec le nom des fruits
2. Faites en sorte d'envoyer "cerises" dans l'URL si l'on clique sur le lien "cerises", faites la même chose pour tous les fruits
3. Tenter d'afficher "cerises" sur la page WEB si l'on clique dessus (si "cerises est passé dans l'URL par conséquent)
4. Envoyer l'information à la fonction déclarée "calcul()" afin d'afficher le prix pour 1kg de tous les fruits.
*/
require 'fonction.php';

$content = '';
if(isset($_GET['fruit'])) 
{
    $content .= "Vous avez sélectionné les $_GET[fruit]<br>";
    $content .= calcul($_GET['fruit'], 1000); // On transmet à la fonction le fruit récupéré via l'URL, grâce à la superglobale $_GET
}


?>
<h1>Bienvenue dans notre boutique de fruits!</h1>
<?= $content ?>
<a href="?fruit=cerises">Cerises</a><br><!-- Si les liens pointent sur la même page, il n'est pas nécessaire d'appeler le fichier avant le ? -->
<a href="?fruit=pommes">Pommes</a><br>
<a href="?fruit=bananes">Bananes</a><br>
<a href="?fruit=peches">Peches</a><br>