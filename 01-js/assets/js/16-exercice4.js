var membres = [
    {'pseudo':'Hugo','age':26,'email':'wf3@hl-media.fr','mdp':'wf3'},
    {'pseudo':'Rodrigue','age':56,'email':'rodrigue@hl-media.fr','mdp':'roro'},
    {'pseudo':'James','age':78,'email':'james@hl-media.fr','mdp':'james8862'},
    {'pseudo':'Emilio','age':18,'email':'milio@hl-media.fr','mdp':'milioDu62'}
  ];    

// -- ETAPE 1

var pseudo = document.getElementById('pseudo');
var submit =document.getElementById('submit');
console.log(pseudo);
console.log(submit);
var IsPseudoInArray = false;

function VoirLaSaisieDuPseudo() {
    console.log(pseudo.value);
    // alert(pseudo.value);
    for(let i = 0 ; i < membres.length ; i++) {
        if(pseudo.value === membres[i].pseudo) {
            IsPseudoInArray = true;
            alert('pseudoError');
            break;
        }
    }
}
pseudo.addEventListener('change' /* changer en 'input' */, VoirLaSaisieDuPseudo);

// -- ETAPE 2