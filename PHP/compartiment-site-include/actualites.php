<?php
/*
require et include sont des fonctions prédéfinies en PHP permettant d'inclure des fichiers dans d'autres fichiers.

Différence entre require et include :
Il n'y a pas de différence entre les2... sauf en cas d'erreur sur le nom du fichier, il ne peut pas être
prit en compte :
    - inclure fait une erreur et continue l'exécution du script
    - require fait une erreur et stop l'exécution du script

le once vérifie si le fichier a déjà été inclus, si c'est le cas, il ne le ré-inclus pas.
*/
// include_once("include/header.php");
// include_once("include/nav.php");

require_once("include/header.php");
require_once("include/nav.php");
?>

<section>
        Voici le contenu de la page d'actualités<br>
        Voici le contenu de la page d'actualités<br>
        Voici le contenu de la page d'actualités<br>
        Voici le contenu de la page d'actualités<br>
        Voici le contenu de la page d'actualités<br>
</section>

<?php
include_once("include/footer.php");
?>