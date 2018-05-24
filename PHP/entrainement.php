<style>
    body{background: #202020; color: white;}
    h2{margin: 0 100 0 100px; background: silver; padding: 10px; text-align: center; color: black;}
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

$prenom = 'Maxime';

echo bonjour('Greg'); // Si la fonction reçoit un argument, il faut lui envoyer  un argument 
echo bonjour($prenom); // Quand il y a un "return" dans la fonction, il faut faire un 'echo' avant, l'argument peut être une variable
echo bonjour(); // Si l'argument a une valeur par défaut, il n'est pas nécessaire d'en envoyer à l'exécution
echo bonjour('Julien'); // On écrase la valeur par défaut de la variable de réception $qui

// ---------------------------------------------------------------------------
function appliqueTva($nombre)
{
    return $nombre*1.2; // 1.2 est le coefficient du taux de TVA de 20%
}

echo "500 euros avec TVA de 20% : " . appliqueTva(500) . '<br>';

// Exo : Pourriez-vous améliorer cette fonction afin que l'on puisse calculer un nombre avec les taux de notre choix ? Si oui, faites le.

function appliqueTva2($nombre, $taux)
{
    return $nombre*(1+$taux/100);
}

echo "500 € avec TVA de 10%  : " . appliqueTva2(500, 10) . '<br>';
echo "500 € avec TVA de 19.6%  : " . appliqueTva2(500, 19.6) . '<br>';
echo "500 € avec TVA de 5.5%  : " . appliqueTva2(500, 5.5) . '<br>';
echo "500 € avec TVA de 7%  : " . appliqueTva2(500, 7) . '<br>';
// /!\ Une fonction ne peut pas être déclarée deux fois avec le même nom !

// ---------------------------------------------------------------------------
meteo('printemps', 19); // Il est possible d'exécuter une fonction avant de l'avoir déclarée
function meteo($saison, $temperature)
{
    echo "Nous sommes au $saison et il fait $temperature degré(s) <br>";
}

// Exo : Gérer le S de degréS avec des if/else
function exoMeteo($saison, $temperature)
{   
    // gérer la phrase en fonction de la saison ex : au printemps, en hiver
    if($saison == 'printemps')
    {
        $texte = 'au';
    }
    else{
        $texte = 'en';
    }

    echo "Nous sommes $texte $saison et il fait $temperature ";
    
    if($temperature > 1 || $temperature < -1)
    {
        echo 'degrés <br>';
    }
    else 
    {
        echo 'degré <br>'; 
    }
}

exoMeteo('printemps', 0);
exoMeteo('hiver', 1);
exoMeteo('été', -1);
exoMeteo('printemps', 2);
exoMeteo('printemps', -2);
echo '<hr>';

// ---------------------------------------------------------------------------
// Lorsqu'on travaille à l'intérieur d'une fonction, on se trouve dans l'espace local, tout le reste, c'est-à-dire en dehors d'une foction, s'appele l'espace global (espace par défaut)
function jourSemaine()
{
    $jour = 'mardi'; // variable déclarée en local
    return $jour; // une fonction peut retourner quelque chose, on retourne le résultat de la fonction (à ce moment là on quitte la fonction)
    echo 'ALLO!!'; // cette ligne ne sortira pas car il y a un return avant
}

echo jourSemaine() . '<br>'; // exécution de la fonction

echo $jour; // /!\ génère une erreur, ne fonctionne pas car cette variable n'est connu qu'à l'intérieur de la fonction

$recup = jourSemaine(); // on récupère 
echo $recup . '<br>'; // on affiche
echo '<hr>';

// ---------------------------------------------------------------------------
$pays = 'France'; // Variable déclarrée dans l'espace global

function affichagePays()
{
    global $pays; // Le echo qui suit ne fonctionnerait pas si nous n'avions pas mit le mot-clé 'global' pour importer tout ce qui est déclaré de l'espace global dans l'espace local.
    echo $pays;
}

affichagePays();
echo '<br>';

// ---------------------------------------------------------------------------
// /!\ php 7    On précise en amont le type obligatoire des valeurs entrantes dans les arguments
function identite(string $nom, int $age)
{
    return $nom . ' a ' . $age . ' ans<br>';
}

echo identite('Evennou', 25);

echo '<h2>Structure itérative : boucles</h2>';

// Boucle WHILE
$i = 0;
while($i < 3)
{
    echo "$i---";
    $i++; // incrémentation, équivaut à $i = $i + 1
}
// affiche : 0---1---2---

echo '<br>';
// Exo : Faites en sorte de ne pas avoir les tirets à la fin
$i = 0;
while($i < 3)
{
    if($i == 2) // On ne rentre qu'une seule fois ici
    {
        echo $i;
    }
    else{
        echo "$i---";
    }
    $i++;
}
echo '<br>';

// ---------------------------------------------------------------------------
// Boucle FOR
for($i = 0; $i < 16; $i++) // Valeur de départ; condition d'entrée, sens (incrémentation)
{
    echo $i . ' ';
}

echo '<br>';
// Exo : Afficher 30 options via une boucle
echo '<select>';
    for($i = 1; $i <= 30; $i++)
    {
        echo "<option>$i</option>";
     // echo '<option>' . $i . '</option>';
    }
echo '<select><br>';

// ---------------------------------------------------------------------------
// Exo : Faites une boucle qui affiche de 0 à 9 sur la même ligne (soit 10 tours) dans un tableau HTML

echo '<table border = 1>'; // déclaration du tableau
    echo '<tr>'; // déclaration d'une ligne
    for($i = 0; $i <= 9; $i++)
    {
    echo "<td>$i</td>"; // déclaration d'une cellule
    }
    echo '</tr>';
echo '</table><br>';

// ---------------------------------------------------------------------------
// Exo : Faire la même chose en allant de 0 à 99 sur plusieurs sans faire 10 boucles.

$z = 0;

echo '<table border = 1>'; 
    for($ligne = 0; $ligne < 10; $ligne++)
    {
    echo '<tr>';
    for($cellule = 0; $cellule < 10; $cellule++) // Tant que ligne est à 0, cellule s'incrémente 10 fois, ligne est à 1, cellule s'incrémente 10 fois, etc...
        {
            echo "<td>$z</td>"; // compteur qui s'incrémente à chaque tour de boucle et ne revient pas à 0
            $z++;
        }
    echo '</tr>';
    }
echo '</table><br>';
// Un tour de boucle for() entraîne 10 tours de la 2ème

// OU

echo '<table border = 1>'; 
    for($ligne = 0; $ligne < 10; $ligne++)
    {
    echo '<tr>';
    for($cellule = 0; $cellule< 10; $cellule++)
        {
            echo '<td>' . (10 * $ligne + $cellule) . '</td>';
        }
    echo '</tr>';
    }
echo '</table><br>';

echo '<h2>Tableau de données ARRAY</h2>';
// Un tableau est déclarée un peu à la manière d'une variable améliorée, car on ne conserve pas une valeur mais un ensemble de valeur.

$liste = array("Maxime", "Grégory", "Julien", "Jean-Christophe");

echo $liste; // /!\ Attention erreur, il est impossible d'afficher un tableau ARRAY avec une instruction d'affichage

// Les instructions d'affichage améliorées permettent de debuger et de contrôler les données, ce n'est pas un affichage conventionnel, l'internaute n'est pas censé voir le rendu du print_r ou du var_dump
echo '<pre>';var_dump($liste); echo '</pre>';

echo '<pre>';print_r($liste); echo '</pre>'; // La balise <pre> permet de formater le texte, cela nous permet de mettre en forme la sortie du print_r ou du var_dump

echo '<h2>Boucle FOREACH pour les tableaux de données ARRAY</h2>';

$tab[] = "France"; // Autre moyen de créer et d'affecter une valeur à un tableau ARRAY, nous ne mettons pas le mot ARRAY mais les crochets [] qui permettent de générer des indices numériques
$tab[] = "Brésil";
$tab[] = "Espagne";
$tab[] = "Allemagne";
$tab[] = "Argentine";
echo '<pre>';print_r($tab); echo '</pre>';

// Exo : Tenter de sortir "Argentine" en passant par le tableau ARRAY sans faire un 'echo Argentine'
echo $tab[4] . '<hr>';

// foreach est un moyen simple de passer en revue un tableau. Foreach fonctionne uniquement avec les tableaux et les objets.

// 1er argument : le tableau à parcourir
foreach($tab as $info) // Le mot AS fait parti du langage et est obligatoire. $info est une variable de réception qui vient parcourir la colonne des valeurs du tableau de données ARRAY
{
    echo $info . '<br>';
}

echo '<hr>';

foreach($tab as $indice => $info) // Quand il y a 2 variables, la première parcoure la colonne des indices et la seconde, la colonne des valeurs.
{
    echo $indice . ' => ' . $info . '<br>'; // On affiche successivement les éléments du tableau
}

echo '<hr>';

// Il est possible de délimiter foreach, ou même if avec un double point ':' et "endforeach" ou "endif"
foreach($tab as $indice => $info):
    echo $indice . ' => ' . $info . '<br>';
endforeach;

// Nous pouvons définir les indices :
$couleur = array("j" => "jaune", "v" => "vert", "b" => "bleu", "o" => "orange");
echo '<pre>';print_r($couleur); echo '</pre>';

// count et sizeof retournent le nombre d'éléments présents dans le tableau de données, il n'y a pas de différences entre les deux.
echo 'Taille du tableau ' . count($couleur) . '<br>';
echo 'Taille du tableau ' . sizeof($couleur) . '<br>';

echo implode(" / ", $couleur) . '<br>'; // implode() est une fonction prédéfinie qui rassemble les éléments d'un tableau en une chaîne (séparée par un symbole)

echo '<h2>Tableau multidimensionnel</h2>';
// On parle de tableaux multidimensionnels quand un tableau est contenu dans un autre tableau
$tab_multi = array(

    0 => array("prenom" => "Grégory", "nom" => "Lacroix"),
    1 => array("prenom" => "Emmanuel", "nom" => "Macron")
);

echo '<pre>';print_r($tab_multi); echo '</pre>';

// Exo : Tenter de sortir "Macron" en passant par le tableau multi sans faire de 'echo Macron'
echo $tab_multi[1]['nom'] . '<br>';

// Exo : Afficher successivement les éléments du tableau avec des boucles foreach
foreach($tab_multi as $indice => $tableau) // Pour chaque tour de boucle, $tableau possède un tableau ARRAY
{
    foreach($tableau as $key => $value) // La 2ème boucle permet de passer en revue chaque tableau ARRAY
    {
    echo $key . ' => ' . $value . '<br>'; // On affiche successivement les données
    }
    echo '<hr>';   
}

echo '<h2>Les superglobales</h2>';
// Les superglobales sont des variables de type ARRAY qui sont prédéfinies dans le code PHP, elles sont accessibles partout, dans l'espace local et global.
// Elles s'écrivent toujours avec le signe '$' suivi d'un '_' et du nom de la superglobale en majuscule.
// Elles permettent de véhiculer un certain nombre de données.

echo '<pre>';print_r($_SERVER); echo '</pre>';

/*
$_SERVER : contient les informations liées au serveur
$_GET : contient les données envoyées dans l'URL
$_POST : contient les données saisies d'un formulaire
$_FILES : contient les données d'un fichier uploadé
$_COOKIE
$_SESSION
*/