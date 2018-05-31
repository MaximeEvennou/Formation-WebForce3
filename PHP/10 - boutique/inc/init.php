<?php
//------------------- CONNEXION BDD -------------------//
$bdd = new PDO('mysql:host=localhost;dbname=ecommerce', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//------------------- SESSION -------------------//
session_start();

//------------------- CHEMIN -------------------//
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/Formation-WebForce3/PHP/10 - boutique/");
// echo RACINE_SITE;
// echo '<pre>'; print_r($_SERVER); echo '</pre>';
// Cette constante retourne le chemin physique du dossier boutique sur le serveur
// Lors de l'enregistrement d'images/photos, nous aurons besoin du chemin du dossier photo pour enrigistrer la photo

define("URL", 'http://localhost/Formation-WebForce3/PHP/10%20-%20boutique/');
// Cette constante servira a enregistré l'URL d'une image/photo dans la BDD, on ne conserve jamais la phot elle-même dans la BDD
// echo URL;

//------------------- VARIABLES -------------------//
$content = '';

//------------------- INCLUSIONS -------------------//
require_once 'fonction.php';

?>