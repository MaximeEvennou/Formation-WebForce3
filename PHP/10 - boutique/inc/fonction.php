<?php
//------------------- FONCTION DEBUG -------------------//
function debug($var, $mode = 1)
{
    echo '<div class="col-md-10 offset-md-1 alert alert-info mt-2 mb-2">';
    $trace = debug_backtrace(); // fonction prédéfinie retournant un tableau ARRAy contenant des informations telles que la ligne et le fichier où est exécuté la fonction
    // echo '<pre>'; print_r($trace); echo '</pre>';

    $trace = array_shift($trace); // retire une dimension du tableau ARRAY multidimensionnel
    // echo '<pre>'; print_r($trace); echo '</pre>';

    echo "Debug demandé dans le fichier : $trace[file] à la ligne $trace[line]<hr>";

    if($mode === 1) // si le mode est à 1, on exécute un print_r
    {
        echo '<pre>'; print_r($var); echo '</pre>';
    }
    else // sinon, dans tous les autres cas, quelque soit la valeur de $mode, on exécute un var_dump
    {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }

    echo '</div>';
}

//---------------- FONCTION MEMBRE CONNECTE
function internauteEstConnecte() // Cette fonction indique si le membre est connecté
{
    if(isset($_SESSION['membre'])) // Si le tableau ARRAY 'membre' dans la session est défini, existe, c'est que l'internaute est bien passé parla page connexion/inscription
    {
        return true;
    }
    else // Dans tous les autres cas, l'internaute n'est soit pas inscrit, soit n'est pas connecté
    {
        return false;
    }
}

//---------------- FONCTION MEMBRE CONNECTE
function internauteEstConnecteEtEstAdmin() // Cette fonction nous permet de savoir si un membre est administrateur du site
{
    if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) // Si une session 'membre' est définie et que le statut du membre est = à 1, c'est un administrateur
    {
        return true;
    }
    else
    {
        return false;
    }
}

//------ PANIER
function creationDuPanier()
{
    if(!isset($_SESSION['panier'])) // Si l'indice panier dans la session n'est pas définie, c'est que l'internaute n'a pas ajouté de produit dans le panier, donc on créé le panier dans la session
    {
        // On créé un tableau ARRAY pour chaque indice, nous pouvons avoir plusieurs produits dans le panier
        $_SESSION['panier'] = array();
        $_SESSION['panier']['titre'] = array();
        $_SESSION['panier']['id_produit'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();
    }
}

//---------------------------------------------------------
function ajouterProduitDansPanier($titre, $id_produit, $quantite, $prix)
{
    creationDuPanier(); // On contrôle si le panier existe ou non dans la session

    $position_produit = array_search($id_produit, $_SESSION['panier']['id_produit']);
    //array_search() est une fonction prédéfinie qui retourne l'indice auquel se trouve l'id_produit dans la session 'panier'

    // echo $position_produit;
    if($position_produit !== false) // Si $position_produit est différent de false, cela veut dire que le produit a bien été trouvé dans la session 'panier'
    {
        $_SESSION['panier']['quantite'][$position_produit] += $quantite; // On ajoute la quantité à l'indice trouvé sans écraser la quantité précédente
    }
    else // Sinon l'id_produit n'est pas dans la session, on stock les données dans les différents tableaux
    {
    // On stock chaque donnée dans les différents tableaux de la session 'panier'
    $_SESSION['panier']['titre'][] = $titre; // Les crochets vides permettent de générer des indices numériques par défaut pour les données
    $_SESSION['panier']['id_produit'][] = $id_produit;
    $_SESSION['panier']['quantite'][] = $quantite;
    $_SESSION['panier']['prix'][] = $prix;
    }
}

//-------------------------------------------------------------------
function montantTotal()
{
    $total = 0;
    // La boucle tourne tant qu'il y a l'id_produit dans la session
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
    {
        $total += $_SESSION['panier']['quantite'][$i]*$_SESSION['panier']['prix'][$i]; // On multiplie la quantité par le prix pour chaque indice
    }
    return round($total, 2); // On retourne le total arrondi
}

//-------------------------------------------------------------------
function retirerProduitDuPanier($id_produit_a_supprimer)
{
    $position_produit = array_search($id_produit_a_supprimer, $_SESSION['panier']['id_produit']); // Grâce à la fonction array_search(), on va chercher à quel indice se trouve le produit à supprimer dans la session 'panier'

    // La fonction array_spilce() permet de supprimer une ligne dans le tableau session et elle remonte les indices inférieursdu tableau aux indices supérieurs, si je supprime un produit à l'indice 4, tous les produits après l'indice 4 remontront tous d'un indice.
    // Cela permet de réorganiser le tableau panier dans la session et de ne pas avoir d'indice vide.
    if($position_produit !== false) // Si position_produit retourne une valeur différente de false, cela veut dire que l'indice a bien été trouvé dans la session 'panier'
    {
    array_splice($_SESSION['panier']['titre'], $position_produit, 1);
    array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
    array_splice($_SESSION['panier']['id_produit'], $position_produit, 1);
    array_splice($_SESSION['panier']['prix'], $position_produit, 1);
    }
}

?>