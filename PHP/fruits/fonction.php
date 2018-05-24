<?php
function calcul($fruit, $poids)
{
    switch($fruit)
    {
        case 'cerises' : $prix_kg = 5.76; break;
        case 'pommes' : $prix_kg = 2.85; break;
        case 'bananes' : $prix_kg = 3.12; break;
        case 'peches' : $prix_kg = 4.65; break;
        default: return 'fruit inexistant'; break;
    }
    $resultat = round($poids*$prix_kg/1000, 2);
    return "Les " . $fruit . " coûtent " . $resultat . "€ pour " . $poids . " grammes<br>";
}

// echo calcul('cerises', 500);
// echo calcul ('kiwi', 500);