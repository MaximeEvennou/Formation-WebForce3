// alert('WOW Tu es toujours avec moi...');

// Deux slash pour faire un commentaire uniligne.

/*

    Ici, je peux faire un commentaire sur plusieurs lignes.

    RACCOURCI : CTRL + /
           ou : ALT + SHIFT + A

*/

// -- 1. Déclarer une variable en JS
var Prenom

//  -- 2. Affecter une valeur
Prenom = "Maxime";

// -- 3. Afficher la valeur de ma variable dans la console
console.log(Prenom);

/*-------------------------------------------------- 
| ~ ~ ~ ~ ~   LES TYPES DE VARIABLES   ~ ~ ~ ~ ~ ~ |
---------------------------------------------------*/

// -- Ici, typeof me permet de connaître le type de ma variable.
console.log(typeof Prenom);

// -- Déclaration d'un Nombre
var Age = 25;

// -- Afficher dans la console
console.log(Age);

// -- Connaître son type
console.log(typeof Age);

    /*--------------------------------------------------\ 
    | ~ ~ ~ ~ ~   La PORTEE DES VARIABLES   ~ ~ ~ ~ ~ ~ |
    | Les variables déclarées directement à la racine   |
    | du fichier JS sont appellées variables GLOBALES.  |
    |                                                   |
    | Elles sont disponibles dans l'ensemble de votre   |
    | document, y compris dans les fonctions.           |
    |                                                   | 
    | ###                                               |
    |                                                   |
    | Les variables déclarées à l'intérieur d'une       |
    | fonction son appellées variables LOCALES.         |
    |                                                   |
    | Elles sont disponibles uniquement dans le contexte|
    | de la fonction ou du bloc qui les contient.       |
    |                                                   |
    | ###                                               |
    |                                                   |
    | Depuis ECMA 6; vous pouvez déclarer une variable  |
    | avec le mot-clé "let".                            |
    |                                                   |
    | Votre variable sera accessible uniquement dans le |
    | bloc dans lequel elle est contenue.               |
    |                                                   |
    | Si elle est déclarée dans une condition, elle sera|
    | disponible uniquement dans le bloc de la          |
    | condition.                                        |
    |                                                   |
    |                                                   |
    \--------------------------------------------------*/

    // -- Les variable FLOAT
    var uneDecimale = -2.984;
    console.log(uneDecimale);
    console.log(typeof uneDecimale);

    // -- Les booléens (VRAI / FAUX)
    var unBooleen = false; // ou true;
    console.log(unBooleen);
    console.log(typeof unBooleen);

    // -- Les Constantes

    /* 
     * La déclaration CONST permet de créer une constante accessible uniquement en lecture. Sa valeur ne pourra pas être modifiée par des réaffectations ultérieures. Une constante ne peut pas être déclarée à nouveau.
     * 
     * Généralement, par convention, les constantes sont en majuscules.
     * 
     * Depuis ECMA 6, on recommande l'utilisation des constantes plutôt que var ou let s'il n'y aura pas de modifications de valeur à votre variable.
     * 
     */

    //  const HOST = "localhost";
    //  const USER = "root";
    //  const PASSWORD = "mysql";

    //  -- Je ne peux pas faire cela...
    // USER = "Maxime";
    // Uncaught TypeError: Assignement to constant variable.

    // const USER = "Maxime";
    // Uncaught SyntaxError: Identifier 'USER' has already been declared.

    /*---------------------------------------------------\ 
    | ~ ~ ~ ~ ~        LA MINUTE INFO        ~ ~ ~ ~ ~ ~ |
    |                                                    |
    | Au fur et à mesure que l'on affecte ou ré-affecte  |                                                   |
    | des valeurs à une variable, celle-ci prend la      |
    | nouvelle valeur et le nouveau type.                |
    |                                                    | 
    | En Javascript (ECMA Script); les variables sont    |
    | auto-typées.                                       |
    |                                                    |
    | Pour convertir une variable de type NUMBER en      |
    | STRING et STRING en NUMBER, je peux utiliser les   |
    | fonctions natives de Javascript.                   |
    |                                                    |
    \---------------------------------------------------*/

    var unNombre = "24";
    console.log(unNombre);
    console.log(typeof unNombre);

    /* 
     * La fonction parseInt() pour retourner un Entier à partir de mon string. 
     */

    unNombre = parseInt(unNombre);
    console.log(unNombre);
    console.log(typeof unNombre);

    // -- Je ré-affecte une valeur à ma variable.
    unNombre = "12.55";
    console.log(unNombre);
    console.log(typeof unNombre);

    unNombre = parseFloat(unNombre);
    console.log(unNombre);
    console.log(typeof unNombre);

    // -- Conversion d'un Nombre en String avec toString()
    unNombre = 10;
    var monNombreEnString = unNombre.toString();
    console.log(unNombre);
    console.log(typeof unNombre);

    console.log(monNombreEnString);
    console.log(typeof monNombreEnString);