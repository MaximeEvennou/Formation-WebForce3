<?php
/*
    1. Réaliser un formulaire HTML permettant de sélectionner un fruit et saisir un poids
    2. Traitement permettant d'afficher le prix en passant par la fonction déclarée "calcul()"
    3. Faites en sorte de garder le dernier fruit sélectionné et le dernier poids saisi dans le formulaire lorsque celui-ci est validé
*/
require '../post/include/header.php';
require 'fonction.php';

$content = '';
if(isset($_POST['formulaire_fruit'])) 
{
    $content .= '<p class="text-center">' . calcul($_POST['fruits'], $_POST['poids']) . '</p><hr>';
}
?>

<h1 class="text-center col-md-6 offset-md-3">Boutique de fruits</h1>
<?= $content ?>
<form method="post" action"" class="col-md-6 offset-md-3">
  <div class="form-group">
    <label for="fruits">Fruits</label>
    <select class="form-control" id="fruits" name="fruits">
    <option value="cerises" <?php if(isset($_POST['fruits']) && $_POST ['fruits'] == 'cerises') echo "selected"; ?>>Cerises</option>

    <option value="pommes" <?php if(isset($_POST['fruits']) && $_POST ['fruits'] == 'pommes') echo "selected"; ?>>Pommes</option>

    <option value="bananes"> <?php if(isset($_POST['fruits']) && $_POST ['fruits'] == 'bananes') echo "selected"; ?>Bananes</option>

    <option value="peches" <?php if(isset($_POST['fruits']) && $_POST ['fruits'] == 'peches') echo "selected"; ?>>Pêches</option>
    </select>
    <!-- Si un fruit a bien été sélectionné et que ce fruit est = à 'bananes', affiche le moi selectionné -->
  </div>
  <div class="form-group">
    <label for="poids">Poids</label>
    <input type="text" class="form-control" id="poids" name="poids" placeholder="Entrer poids" value="<?php if(isset($_POST['poids'])) echo $_POST['poids']; ?>">
  </div>
  
  <button type="submit" name="formulaire_fruit" value="valid_calcul" class="btn btn-dark col-md-12">Calculer</button>
</form>

<?php
require '../post/include/footer.php';
?>