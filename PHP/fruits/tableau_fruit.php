<?php
/*
    Exo : 
    1. Déclarer un tableau ARRAY avec tous les fruits
    2. Déclarer un tableau ARRAY avec tous les poids suivants : 100, 500, 1000, 1500, 2000, 3000, 5000, 10000
    3. Afficher les deux tableaux
    4. Sortir le fruit "cerises" et le poids 500 en passant par vos tableaux pour les transmettre à la fonction calcul() et obtenir le prix
    5. Sortir tous les prix pour les cerises avec tous les poids (indice : boucle)
    6. Sortir tous les prix pour tous les fruits avec tous les poids (indice : boucle imbriquée)
*/
require 'fonction.php';

// Exo 1 :
$liste = array("cerises", "pommes", "bananes", "peches");

// Exo 2 :
$poids = array(100, 500, 1000, 1500, 2000, 3000, 5000, 10000);

// Exo 3 :
echo '<pre>'; print_r($liste); echo '</pre>';
echo '<pre>'; print_r($poids); echo '</pre>';

// Exo 4 :
echo $liste[0] . '<br>';
echo $poids[1] . '<br>';

echo calcul($liste[0], $poids[1]) . '<hr>';

// Exo 5 :
foreach($poids as $poidscerises)
{
    echo calcul($liste[0], $poidscerises);
}
echo '<hr>';

for($i = 0; $i < count($poids); $i++)
{
    echo calcul ($liste[0], $poids[$i]);
}
echo '<hr><br><br><strong>Exercice 6.1</strong><br><hr>';

// Exo 6 :
foreach($liste as $fruit) 
{
    foreach($poids as $poidsfruits) 
    {
    echo calcul($fruit, $poidsfruits);
    }
    echo '<hr>';   
}

echo '<hr><br><br><strong>Exercice 6.2</strong><br><hr>';

for($i = 0; $i < count($liste); $i++)
{
    for($j = 0; $j < count($poids); $j++)
    {
        echo calcul($liste[$i], $poids[$j]);
    }
    echo '<hr>';
}
echo '<br>';
echo '<br>';
echo '<hr>';
// Faire un affichage sous forme de tableau HTML avec fruits en entête du tableau

echo "<table border='1'><tr><th>poids</th>";
    foreach($liste AS $indice_fruit => $fruit)
    {
        echo "<th> $fruit </th>";
    }
echo '</tr>';
    foreach($poids AS $poids_fruit)
    {
        echo '<tr>';
            echo "<th> $poids_fruit g </th>";
            foreach($liste AS $fruit)
            {
                echo"<td>" . calcul($fruit, $poids_fruit) . "</td>";
            }
            echo '</tr>';
    }
    echo "</table>";
?>
