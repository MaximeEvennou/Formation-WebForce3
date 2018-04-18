/*---------------------------------------------
       LA MANIPULATION DES CONTENUS 🚸
----------------------------------------------*/


// function l(e) {
//     console.log(e)
// }
// Nouvelle Syntaxe ECMA 6 avec les fonctions fléchées
// https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Fonctions/Fonctions_fl%C3%A9ch%C3%A9es

l = e => console.log(e);

// -- Je souhaite récupérer mon lien google ; comment procéder ?

var google = document.getElementById('google');
l(google);

// -- Maintenant, je souhaite accéder aux informations de ce lien...

    // -- A : Le lien vers lequel pointe la Balise
    l(google.href);

    // -- B : l'ID de la Balise
    l(google.id);

    // -- C : La Classe de la Balise
    l(google.className);

    // -- D : Le texte de la Balise
    l(google.textContent);

/**
 * Maintenant, je souhaite modifier le contenu de mon lien !
 * Comme une variable classique, je vais simplement venir
 * affecter une nouvelle valeur à mon "textContent".  
 */

google.textContent = "Mon lien vers GooOOoOoOOoogle !";

/*---------------------------------------------
       AJOUTER UN ELEMENT DANS MA PAGE
----------------------------------------------*/

/**
 * Nous allons utiliser 2 étapes :
 * 
 * 1. La fonction document.createElement() va permettre de générer
 * un nouvel élément dans le DOM ; que je pourrai modifier par la suite
 * avec les méthodes que nous venons de voir...
 * 
 * NB : Ce nouvel élément est placé en mémoire...
 */

//  -- Définition de l'élément
var span = document.createElement('span');

// -- Si je souhaite lui donner un ID
span.id = "MonSpan";

// -- Lui attribuer du contenu
span.textContent = " Mon Beau Texte en JS !"

// -- Comment ajouter l'élément dans la page ?
google.appendChild(span);

document.write("<hr>");

/* -------------------------------
            EXERCICE
En partant du travail déjà réalisé sur la page.
Créez directement dans la page une balise <h1></h1> ayant comme contenu : 
"Titre de mon Article".
Dans cette balise, vous créerez un lien vers une url de votre choix.
BONUS : Ce lien sera de couleur Rouge et non souligné.
<h1><a>TITRE</a></h1>
-------------------------------- */

var h1 = document.createElement('h1');
var a = document.createElement('a');
a.textContent = "Les Bûcherons";
a.href = "#";
h1.appendChild(a);
document.body.appendChild(h1);
a.style.color = "red";
a.style.textDecoration = "none";