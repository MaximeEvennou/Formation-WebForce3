<?php
$nom_fichier = 'liste.txt';

$fichier = file($nom_fichier); // La fonction file() fait tout le travail, elle retourne chaque ligne d'un fichier à des indices différents d'un tableau ARRAY

echo '<pre>', print_r($fichier); echo '</pre>';

foreach($fichier as $value) // Parcours du tableau ARRAY pour un affichage plus conventionnel
{
    echo $value . '<br>';
}

echo '<hr>';

echo implode($fichier, "<br>"); // Affichage du tableau ARRAY avec un passage à la ligne

unlink($fichier); // supprime un fichier