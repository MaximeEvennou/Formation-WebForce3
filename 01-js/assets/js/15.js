/*---------------------------------------------
             ~ LES EVENEMENTS ~ 😈 😧

Les évènements vont me permettre de déclencher une fonction,
c'est-à-dire une série d'instructions ; suite à une action de mon utilisateur...

OBJECTIF : Etre en mesure de capturer ces évènements afin d'exécuter une fonction.

Les Evènements : MOUSE (Souris)

    click      : au clic sur un élément ;
    mouseenter : la souris passe au-dessus de la zone d'un élément ;
    mouseleave : la souris sort de cette zone.

Les Evènements : KEYBOARD (Clavier)

    keydown    : une touche du clavier est enfoncée ;
    keyup      : une touche du clavier a été relâchée.

Les Evènements : WINDOW (Fenêtre)

    scroll     : défilement de la fenêtre ;
    resize     : redimensionnement de la fenêtre.

Les Evènements : FORM (Formulaire)

    change     : pour les éléments <input>, <select> et <textarea> ;
    submit     : à l'envoi (soumission) du formulaire ;
    input      : pour capter la saisie d'un utilisateur sur un champ <input>.


############# LES ECOUTEURS D'EVENEMENTS #############

Pour attacher un évènement à un élément, ou autrement dit, pour déclarer
un écouteur d'évènements qui se chargera de déclencher une fonction , je
vais utiliser la syntaxe suivante :

--------------------------------------------------------*/

var p = document.getElementById('MonParagraphe');

// -- Je souhaite que mon paragraphe soit rouge au clic de la souris.

function changerLaCouleurEnRouge() {
    p.style.color = "red";
}

p.addEventListener('click', changerLaCouleurEnRouge);

/* -------------------------------------------------------------\
|                       EXERCICE PRATIQUE                       |
| A l'aide de javascript, créez un champ "input" type text avec |
| un ID unique. Affichez ensuite dans une alerte, la saisie de  |
| l'utilisateur.                                                |
|______________________________________________________________*/


// -- Création d'un champ input
var input = document.createElement('input');

// -- Attribution d'un Attribut
input.setAttribute('type', 'text');
input.setAttribute('placeholder', 'saisissez du contenu...');

// -- Attribution d'un ID
input.id = "MonId";

// -- Ajout dans la page
document.body.appendChild(input);

function VoirLaSaisieDeMonImput() {
    console.log(input.value);
    alert(input.value);
}

input.addEventListener('change', VoirLaSaisieDeMonImput);

