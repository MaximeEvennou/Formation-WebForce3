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
    echo 'A est bien supérieur à B<br>';
}
else // Sinon... cas par défaut, dans tous les autres cas
{
    echo 'Non c\'est B qui est supérieur à A<br>';
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
XOR ||  ou exclusif
AND && ET
*/
$a = 10; $b = 5; $c = 2;

if($a == 8)
{
    echo '1 - A est égale à 8<br>';
}
elseif($a != 10)
{
    echo '2 - A est différent de 10<br>';
}
else
{
    echo '3 - Tout le monde a faux<br>';
}

// Grâce au ELSEIF, si la condition est respéctée, toutes les autres conditions ne seront pas évaluées.

// ---------------------------------------------------------------------------
if($a == 10 XOR $b == 6)
{
    echo 'ok condition exclusive<br>'; // Si les 2 conditions sont bonnes ou mauvaises, on ne rentre pas ici
}

// ---------------------------------------------------------------------------
// Forme contractée : 2ème possibilité d'écriture des if
echo ($a == 10) ? "a est égale à 10<br>" : "a n'est pas égale à 10<br>";
// Le ? remplace le IF
// Le ':' remplace le ELSE

// ---------------------------------------------------------------------------
// comparaison
$vara = 1;
$varb = '1';
if($vara == $varb)
{
    echo 'il s\'agit de la même chose';
}

// Avec le double == le test fonctionne puisque la valeur est la même
// Avec le triple === le test ne fonctionne pas puisque la valeur est la même mais le type est différent
// == comparaison de la valeur
// === comparaison de la valeur et du type

echo '<h2>Condition Switch</h2>';
// les 'case' représentent les cas différents dans lesquels nous pouvons potentiellement tomber

$couleur = 'jaune';

switch($couleur)
{
    case 'bleu':
    echo 'Vous aimez le bleu';
    break; // permet de stopper le script si nous entrons dans un des cas

    case 'vert':
    echo 'Vous aimez le vert';
    break;

    case 'rouge':
    echo 'Vous aimez le rouge';
    break;

    default: // Cas par défaut, si on entre pas dans les cas précédents
    echo 'Vous n\'aimez rien <br>';
}

// Exo : Pouvez-vous faire la même chose que le switch avec des if/else ? Si oui, faites le

$couleur = 'jaune';

if($couleur == 'bleu')
    echo 'Vous aimez le bleu';
elseif($couleur == 'vert')
    echo 'Vous aimez le vert';
elseif($couleur == 'rouge')
    echo 'Vous aimez le rouge';
else 
    echo 'Vous n\'aimez rien <br>';

// Si dans la condition IF, il n'y a qu'une seule instruction d'affichage, les accolades ne sont pas nécessaires.

echo '<h2>Fonctions prédéfinies</h2>';

// Une fonction prédéfinie permet de réaliser un traitement spécifique, il en existe une liste assez conséquente

echo 'Date : ' . date("d/m/Y") . '<br>';
// Lorsqu'on utilise une fonction prédéfinie, il faut se poser la question de savoir quels arguments on doit lui envoyer et surtout savoir ce qu'elle retourne, il est important de consulter la documentation (www.php.net)

echo '<h2>Fonctions prédéfinies : Traitement de chaînes (iconv_strlent, strpos, substr</h2>';

$email1 = 'maxime.evennou0406@gmail.com';
echo strpos($email1, '@') . '<br>'; // Indique la position 18 du caractère '@' dans la chaîne (18 et non pas pas 19 car cela commence à 0).

// strpos() est une fonction prédéfinie qui retourne la position d'un caractère dans une chaîne de caractères
// Contexte : Nous pourrions l'utiliser pour savoir si une adresse email a un format conforme.

$email2 = 'bonjour';
echo strpos($email2, '@') . '<br>'; // Cette ligne ne sort rien, pourtant il y a bien quelque chose à l'intérieur : FALSE !
var_dump(strpos($email2, '@')); // Grâce au var_dump(), on aperçoit le FALSE si le caractère '@' n'est pas trouvé. var_dump() est donc une instruction d'affichage améliorée que l'on utilise souvent en phase de développement.
print_r(strpos($email2, '@')); // print_r est une autre instruction d'affichage améliorée, qui retourne moins d'informations.

// ---------------------------------------------------------------------------
$phrase = "Nous sommes Mardi et j'ai faim!!";
echo iconv_strlen($phrase) . '<br>';
// Il existe aussi la fonction strlen() qui calcule la taille d'une chaîne en octet
var_dump(iconv_strlen($phrase));
// iconv_strlen() est une fonction prédéfinie qui retourne la taille d'une chaîne de caractères
// succès : INT
// echec : boolean FALSE
// Contexte : Nous pourrons l'utiliser pour savoir si le pseudo et le mdp lors d'une instruction ont des tailles conformes.
echo '<br>';

// ---------------------------------------------------------------------------
$texte = 'Tu autem, Fanni, quod mihi tantum tribui dicis quantum ego nec adgnosco nec postulo, facis amice; sed, ut mihi videris, non recte iudicas de Catone; aut enim nemo, quod quidem magis credo, aut si quisquam, ille sapiens fuit. Quo modo, ut alia omittam, mortem filii tulit! memineram Paulum, videram Galum, sed hi in pueris, Cato in perfecto et spectato viro.';

echo substr($texte, 0, 20) . "<a href='#'>...lire la suite</a><br>";

/* substr() est une fonction prédéfinie permettant de retourner une partie de la chaîne
- Succès : string
- Echec : boolean FALSE
Arguments :
1. La chaîne que l'on souhaite couper
2. La position de début
3.La position de fin, le nom de caractères souhaité

Contexte : substr() est souvent utilisé pour afficher des actualités avec une "accroche". 
*/

echo '<h2>Fonctions utilisateur</h2>';
// Les fonctions utilisateur ne sont pas prédéfinies dans le langage, elles sont déclarées puis exécutées par l'utilisateur.
// Une fonction se déclare toujours avec le mot clé 'function' suivi du nom de la fonction que nous définissons : pas d'accent, pas d'espace.

function separation() // déclaration d'une fonction prévue pour ne pas recevoir d'arguments
{
    echo '<hr><hr><hr>'; 
}

separation(); // exécution de la fonction

// ---------------------------------------------------------------------------
// fonction avec arguments :
// On peut définir une variable par défaut aux variables de réception
function bonjour($qui = 'Jean-Christophe') // $qui ne sort pas de nulle part. Cela permet de recevoir un argument, il s'agit d'une variable de réception
{
    return "Bonjour $qui <br>"; // return retourne le résultat de la fonction
}

$prenom = 'Greg';

echo bonjour('Maxime'); // Si la fonction reçoit un argument, il faut lui envoyer  un argument 
echo bonjour($prenom); // Quand il y a un "return" dans la fonction, il faut faire un 'echo' avant, l'argument peut être une variable
echo bonjour(); // Si l'argument a une valeur par défaut, il n'est pas nécessaire d'en envoyer à l'exécution
