<?php
// echo '<pre>'; print_r($_GET); echo '</pre>';
// Exo : Afficher les données envoyées dans l'URL à l'aide d'un affichage conventionnel

if(isset($_GET['id_produit'])) // On entre dans la condition IF seulement dans le cas où nous avons cliqué sur un lien 'produit', donc que nous avons envoyé l'indice 'id_produit' dans l'URL
{
echo "<h2>Voici le détail du produit n° $_GET[id_produit]</h2><hr>";

// La superglobal $_GET nous permet d'exploiter les données transmises dans l'URL, c'est une variable de type ARRAY, on peux donc la parcourir avec une boucle foreach
foreach($_GET as $indice => $info)
    {
        if($indice != 'id_produit')
        {
        echo $indice . ' => ' . $info . '<br>';
        }
    }
}
else
{
    echo "Tu n'as rien à faire ici!";
}

echo '<pre>'; print_r($_GET); echo '</pre>';

if(isset($_GET['id_produit']))
echo "<h2>Voici le détail du fruit n° $_GET[id_produit]</h2><hr>";
{
    foreach($_GET as $indice => $info)
    {
        if($indice != 'id_produit')
        {
        echo $indice . ' => ' . $info . '<br>';
        }
    }
}

?>