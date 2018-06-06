<?php
require_once("include/header.php");

$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Ajouter un film à la base de données créée
$erreur = '';
$content = '';
if(isset($_GET['action']) && $_GET['action'] == 'ajout')
{
    $verif_titre = $pdo->prepare("SELECT * FROM movies WHERE title = :title");
    $verif_titre->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
    $verif_titre->execute();
        if($verif_titre->rowCount() > 0)
        {
            $erreur .= '<div class="col-md-6 offset-md-3 alert alert-danger text-center">Titre existant! Merci de saisir un titre valide.</div>';
        }
    
    if(empty($erreur))
    {
        $insert_movie = $pdo->prepare("INSERT INTO movies (title, actors, director, producer, year_of_prod, language, category, storyline, video) VALUES (:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video");
        $erreur .= '<div class="col-md-6 offset-md-3 alert alert-success text-center">Votre film a bien été enregistré.</div>';
    }
    $content .= $erreur;
}
    

?>

<h1 class="col-md-6 offset-md-3 text-center text-dark mt-3">Ajout de film</h1>
<hr>
<?= $content ?>
<form method="post" action"" enctype="multipart/form-data" class="col-md-6 offset-md-3 border border-dark rounded p-2">

    <input type="hidden" id="id_movie" name="id_movie">

    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>

    <div class="form-group">
        <label for="actors">Acteurs</label>
        <input type="text" class="form-control" id="actors" name="actors">
    </div>

    <div class="form-group">
        <label for="director">Directeur</label>
        <input type="text" class="form-control" id="director" name="director">
    </div>

    <div class="form-group">
        <label for="producer">Producteur</label>
        <input type="text" class="form-control" id="producer" name="producer">
    </div>

    <div class="form-group">
        <label for="year_of_prod">Année de production</label>
        <select 
        type="text" class="form-control" id="year_of_prod" name="year_of_prod">
            <option value="1980">1980</option>
            <option value="1990">1990</option>
            <option value="2000">2000</option>
            <option value="2010">2010</option>
        </select>
    </div>

    <div class="form-group">
        <label for=language>Langue</label>
        <select 
        type="text" class="form-control" id="language" name="language">
            <option value="en">Anglais</option>
            <option value="fr">Français</option>
            <option value="gr">Allemand</option>
            <option value="sp">Espagnol</option>
        </select>
    </div>

    <div class="form-group">
        <label for="category">Catégorie</label>
        <select 
        type="text" class="form-control" id="category" name="category">
            <option value="action">Action</option>
            <option value="romance">Romance</option>
            <option value="comedie">Comédie</option>
            <option value="drame">Drame</option>
        </select>
    </div>

    <div class="form-group">
        <label for="storyline">Synopsis</label>
        <textarea type="file" class="form-control" id="storyline" name="storyline"></textarea>
    </div>

    <div class="form-group">
        <label for="video">Video</label>
        <input type="text" class="form-control" id="video" name="video">
    </div>

    
   
    <button type="submit" name="form_film" value="valid_film" class="btn btn-dark col-md-4 offset-md-4 mb-3 mt-3"><a href="?action=ajout" class="list-group-item list-group-item-action">Ajout film</a></button>
</form>

<?php
require_once("include/footer.php");
?>