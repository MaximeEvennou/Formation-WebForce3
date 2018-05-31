<?php
require_once 'inc/init.php';
require_once 'inc/header.php';

// debug($_SESSION);
if(!internauteEstConnecte()) // Si l'internaute n'est pas connecté, il n'a rien à faire sur la page profil, on le redirige vers la page connexion.
{
    header("location:connexion.php");
}
?>

<!-- Exo : Tenter d'afficher bonjour suivi du pseudo de l'internaute connecté -->
<h2 class="text-center mt-3">Bonjour <strong class="text-info"><?= $_SESSION['membre']['pseudo'] ?></strong></h2>

<!-- Réaliser une page profil à l'aide de Bootstrap 4, avec un template ou non -->
<div class="container">
 <div class="col-md-6 offset-md-3 border border-info rounded p-5 mt-5">
        <div class="row-fluid user-row">
            
            <div class="span10 text-center">
                <span class="text-muted"><strong class="text-info"><?= $_SESSION['membre']['pseudo'] ?></strong></span>
            </div>
            <div class="span1 dropdown-user" data-for=".cyruxx">
                <i class="icon-chevron-down text-muted"></i>
            </div>
        </div>
        <div class="row-fluid user-infos cyruxx">
            <div class="span10 offset1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title mb-3 text-center">Profil</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row-fluid">
                            <div class="span3">
                                <img class="img-circle mt-3 mb-3 mx-auto d-block"
                                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100"
                                     alt="User Pic">
                            </div>
                            <div class="span6"><br>
                                <table class="table table-condensed table-responsive table-user-information text-center mb-3">
                                    <tbody>
                                    <tr>
                                        <td><strong class="text-info">Nom :</strong></td>
                                        <td><?= $_SESSION['membre']['nom'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-info">Prenom :</strong></td>
                                        <td><?= $_SESSION['membre']['prenom'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-info">Email :</strong></td>
                                        <td><?= $_SESSION['membre']['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-info">Civilité :</strong></td>
                                        <td><?= $_SESSION['membre']['civilite'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-info">Ville :</strong></td>
                                        <td><?= $_SESSION['membre']['ville'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-info">Code postal :</strong></td>
                                        <td><?= $_SESSION['membre']['code_postal'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-info">Adresse :</strong></td>
                                        <td><?= $_SESSION['membre']['adresse'] ?></td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                                <button class="text-center rounded mx-auto d-block"><a href="#" class= "alert-link text-info">Modifier votre compte</a></button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


<?php
require_once 'inc/footer.php';
?>