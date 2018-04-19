/*---------------------------------------
        LES SELECTEURS jQUERY
----------------------------------------*/

// -- Format : $('selecteur')
// -- En jQuery, tous les sélecteurs CSS sont disponibles...

$(function(){

    l = e => console.log(e);

    // -- Sélectionner toutes les balises SPAN
    l(document.getElementsByTagName('span'));
    l($('span'));

    // -- Sélectionner mon menu grâce à mon ID
    l(document.getElementById('menu'));
    l($('menu'));

    // -- Sélectionner une élément par sa classe...
    l(document.getElementsByClassName('MaClasse'));
    l($('.MaClasse'));

    // -- Sélectionner un Attribut
    l($('[href="#"]'));
});