<style>
    h2{margin: 0; background: grey; padding: 10px; text-align: center;}
</style>
<h2>Ecriture et affichage</h2> <!-- Nous pouvons écrire du HTML dans un fichier PHP, l'inverse n'est pas possible -->

<?php
echo 'Bonjour'; // echo est une instruction d'affichage que l'on peut traduire par 'affiche moi'
// Une instruction d'affichage se termine toujours pas un ';'
// Si on observe le code source, le code n'apparaît pas, puisqu'il est traduit pas l'interpreteur et renvoyé au format 100% HTML
echo '<br>'; // Nous pouvons également y mettre du HTML
echo 'Nous sommes vendredi';

echo '<h2>Commentaires</h2>';
?>

<strong>Bonjour</strong>
<?= 'ALLO!!';?> <!-- Le ? remplace le echo -->
<?php echo 'ALLO!!';?>

<?php
echo 'texte'; // Un commentaire sur une seule ligne
echo 'texte'; /*
Ceci est un commentaire sur plusieurs lignes
*/
echo 'texte'; # Ceci est un commentaire sur une seule ligne
print 'texte'; // print est une instruction d'affichage, pas de différence entre print et echo

echo '<h2>Variables : Types / déclaration / affectation</h2>';
// Une variable est un espace nommé permettant de conserver une valeur
// Une variable se déclare toujours avec le signe '$'
// $2a -> incorrect, $a2 -> correct, on ne peut pas placer un chiffre juste après le '$', pas d'accent, pas d'espace.

$a = 127; // Affectation de la valeur 127 dans la variable nommée "a"
echo gettype($a); // Il s'agit d'un entier : INTEGER
echo '<br>';

$b = 1.5;
echo gettype($b); // Un nombre à virgule : DOUBLE
echo '<br>';

$c = "une chaine"; // Une chaîne de caractère : STRING
echo gettype($c);
echo '<br>';

$d = "127"; // Une chaîne de caractère : STRING
echo gettype($d);
echo '<br>';

$e = true; // boolean
echo gettype($e);
echo '<br>';

$f = false; // boolean
echo gettype($f);
echo '<br>';

echo '<h2>Concaténation</h2>';

$x = 'Bonjour ';
$y = "tout le monde!!";
echo $x . $y . '<br>'; // Point de concaténation que l'on peut traduire par 'suivi de'
echo "$x $y <br>"; // Entre guillemets, les variables sont évaluées
echo '$x $y <br>'; // Entre simple quotes, c'est une chaîne de caractères
echo "Hey !" . ' ' . $x . $y . '<br>'; // Concaténation avec du texte et variables
echo "Hey !" , ' ' . $x , $y , '<br>'; // Concaténation avec une virgule (la virgule et le point de concaténation sont similaires)

echo '<h2>Concaténation lors de l\'affectation</h2>'; // L'antislash permet d'échapper les apostrophes dans les chaînes de caractères.

$prenom1 = 'Bruno';
$prenom1 = 'Claire';
echo $prenom1 . '<br>'; // Affiche 'Claire', cela remplace 'Bruno' par 'Claire'

$prenom2 = 'Nicolas';
$prenom2 .= ' Marie';
$prenom2 .= ' Maxime';
echo $prenom2 . '<br>'; // Affiche Nicolas Marie Maxime, cela ajoute sans remplacer les valeurs précédents grâce à l'opérateur '.="

echo '<h2>Constante et constante magique</h2>';
// Une constante tout comme une variable de conserver une valeur sauf, comme son nom l'indique, qu'elle est constante!! On ne pourra pas changer sa valeur durant l'exécution du script.
define("CAPITALE", "Paris"); // Par convention, une constante se déclare toujours en majuscules
echo CAPITALE . '<br>';

// Exemple :
// define("URL", "http://www.mon-site.fr");

// echo '<nav>';
//    echo '<a href="' . URL . '/boutique.php">BOUTIQUE</a>';
// echo '</nav>';

// define("CAPITALE", "Rome"); // /!\ Erreur !! Il n'est pas possible de redéfinir une constante durant l'exécution du script

// constante magique
echo __FILE__ .'<br>'; // Chemin complet vers le fichier
echo __LINE__ .'<br>'; // Ligne Affiche le numéro de la ligne 
// Il en existe d'autres : __FUNCTION__ , __CLASS__ , __METHODS__

echo '<h2>Exercice variable</h2>';
//  Exercice : Afficher vert-jaune-rouge (avec les tirets) en mettant chaque couleur dans une variable.
$g = 'vert-';
$g .= 'jaune-';
echo $g .= 'rouge';

echo '<h2>Opérateurs arithmétiques</h2>';
$a = 10; $b = 2;
echo $a + $b . '<br>'; // Affiche 12
echo $a - $b . '<br>'; // Affiche 8
echo $a * $b . '<br>'; // Affiche 20
echo $a / $b . '<br>'; // Affiche 5

// opération/affectation
$a = 10; $b = 2;

$a += $b; // Equivaut à $a = $a + $b , affiche 12
echo $a . '<br>';
$a -= $b; // Equivaut à $a = $a - $b , affiche 10
echo $a . '<br>';
$a *= $b; // Equivaut à $a = $a * $b , affiche 20
echo $a . '<br>';
$a /= $b; // Equivaut à $a = $a / $b ,affiche 10
echo $a . '<br>';

echo '<h2>Structures conditionnelles (if/else) - opérateur de comparaison</h2>';

// Isset & empty
$var1 = 0;
$var2 = '';

// empty permet de tester une variable , il teste si à 0, vide ou définie
// isset teste l'existence d'une variable et si elle est différente de NULL
// Si la condition est vérifiée, c'est le code entre accolades qui sera exécuté
if(empty($var2)) 
{
    echo '0, vide ou non définie<br>';
}

if(isset($var2))
{
    echo 'var2 existe et est définie par rien<br>';
}

// ---------------------------------------------------------------------------
$a = 10; $b = 5; $c = 2;
if($a > $b) // Si A est supérieur à B
{
    echo 'A est bien supérieur à B';
}
else // Sinon... cas par défaut, dans tous les autres cas
{
    echo 'Non c\'est B qui est supérieur à A';
}

// ---------------------------------------------------------------------------
/*
OPERATEUR DE COMPARAISON
=       affectation
==      comparaison de la valeur
===     comparaison de la valeur et du type
<       strictement inférieur
>       strictement supérieur
<=      inférieur ou égale à
>=      supérieur ou égale à
<!DOCTYPE html>
<html lang="en">
<head>
!       n'est pas
!=      différent de
OR  ||  OU
