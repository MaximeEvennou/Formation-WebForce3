<?php
require_once("include/header.php");
?>


   
   <h2 class="col-md-6 offset-md-3 text-center mt-3">Tableau en PHP</h2><hr>

<?php
// Créer un tableau en PHP
$donnees = array('prenom' => 'Maxime', 'nom' => 'Evennou', 'adresse' => '10 rue du temple', 'code_postal' => '75007', 'ville' => 'Paris', 'email' => 'Max@gmail.com', 'date_naissance' => '1992-06-04');
// echo '<pre>'; print_r($donnees); echo '</pre>';

// Afficher le contenu de ce tableau (clés + valeurs) dans une liste HTML
echo '<ul>';
foreach($donnees as $indice => $info):
    echo '<li><strong>' . $indice . '</strong>' . ' : ' . $info . '<br></li>';
endforeach;

// Gérer l’affichage de la date de naissance à l’aide de la classe DateTime

?>



<?php
require_once("include/footer.php");
?>