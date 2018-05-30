<?php
require_once '../3 - post/include/header.php'; 
?>

<!-- 
    Les informations d'une session sont enregistrées côté serveur, cela crée (dans le même temps) un cookie précisement à l'identifiant de la session, sur le pc du client  
    Les sessions permettent de garder un connexion constante à un site, sans les sessions, on serait deconnecté dès que l'on changerait de page
    La session est relié au cookie, par exemple sur Facebook il y a XXXXX sessions, il ne suffit pas d'en avoir une, il faut que vous soyez relié à la votre, c'est donc grace au cookie que le lien est établit. Si l'internaute supprime son cookie ou si le site décide de le supprimer : le lien est cassé.
-->

<h2>SESSIONS</h2>

<?php
session_start();

$_SESSION['pseudo'] = "Greg_formateur";
$_SESSION['nom'] = "LACROIX";

echo '<pre>'; print_r($_SESSION); echo '</pre>';

unset($_SESSION['nom']);

echo '<pre>'; print_r($_SESSION); echo '</pre>';

session_destroy();

require_once '../3 - post/include/footer.php'; 


