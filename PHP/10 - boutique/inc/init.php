<?php
//------------------- CONNEXION BDD -------------------//
$bdd = new PDO('mysql:host=sql108.epizy.com;dbname=epiz_22196306_maboutique', 'epiz_22196306', 'ezio9944', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//------------------- SESSION -------------------//
session_start();

//------------------- CHEMIN -------------------//
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/");
// echo RACINE_SITE;
// echo '<pre>'; print_r($_SERVER); echo '</pre>';
// Cette constante retourne le chemin physique du dossier boutique sur le serveur
// Lors de l'enregistrement d'images/photos, nous aurons besoin du chemin du dossier photo pour enrigistrer la photo

define("URL", 'http://maximeevennou.epizy.com/');
// Cette constante servira a enregistré l'URL d'une image/photo dans la BDD, on ne conserve jamais la phot elle-même dans la BDD
// echo URL;

//------------------- VARIABLES -------------------//
$content = '';

//------------------- INCLUSIONS -------------------//
require_once 'fonction.php';

?>