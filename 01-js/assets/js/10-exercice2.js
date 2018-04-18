/*
 I. Créer un Tableau 3D "PremierTrimestre" contenant la moyenne d'un étudiant pour plusieurs matières.
    Nous auront donc pour un étudiant, sa moyenne à plusieurs matières.
    
    Par exemple : Hugo LIEGEARD : [ Francais : 12, Math : 19, Physique 4], ... etc
    
    **** Vous allez créer au minimum 5 étudiants ****
II. Afficher sur la page (à l'aide de document.write) pour chaque étudiant, la liste (ul et li) de sa moyenne à chaque matière, puis sa moyenne générale. 
*/

var Contacts = [

    {
        prenom      :   "Hugo",
        nom         :   "LIEGEARD",
        moyenne :   {
            francais : 12,
            math : 19,
            physique : 4,
        }
    },
    {
        prenom      :   "Maxime",
        nom         :   "EVENNOU",
        moyenne : {
            francais : 17,
            math : 8,
            physique : 14,
            anglais : 18,

        }
    },
    {
        prenom      :   "Rahma",
        nom         :   "SALIM",
        moyenne :   {
            francais : 17,
            math : 11,
            physique : 14,
            anglais : 19,
        }
    },
    {
        prenom      :   "Jean-Christophe",
        nom         :   "LEJEUNE",
        moyenne :   {
            francais : 15,
            math : 12,
            physique : 13,
            espagnol : 16,
        }
    },
    {
        prenom      :   "Julien",
        nom         :   "LEGOUX",
        moyenne :   {
            francais : 14,
            math : 18,
            physique : 12,
            svt : 15,
        }
    }
];
console.log(Contacts);

// -- Les Flemmards.js

function l(e) {
    console.log(e);
}

function w(e) {
    document.write(e);
}

// -- Je souhaite afficher la liste de mes étudiants
w("<ol>");
for(let i = 0 ; i < Contacts.length ; i++){

    let Etudiant = Contacts[i];
    l(Etudiant);
    var SommeDesNotes = 0, NombreDeMatiere = 0;

w("<li>");
    w(Etudiant.prenom + ' ' + Etudiant.nom);
    w("<ul>");
// -- Afficher les matières d'un étudiant
for(let matiere in Etudiant.moyenne){
        w("<li>")
            w(matiere + ' : ' + Etudiant.moyenne[matiere]);
        w("</li>");

        SommeDesNotes += Etudiant.moyenne[matiere];
        NombreDeMatiere++;

} // -- Fin de la boucle de matière

        w("<li>");
            w("<strong>Moyenne Générale : </strong>" + (SommeDesNotes / NombreDeMatiere).toFixed(2));
        w("</li>");

    w("</ul>");
w("</li><br>");
}
w("</ol>");