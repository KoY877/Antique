
/* ============================================================
* Gérer la mention de allergie dans le formulaire Reservation
* ============================================================*/

// Récupérer le champ mention des allergies   
let allergie = document.getElementById('mention_allergie');

//  Récupérer les données du champ choisie 
const mentionAllegieNon = document.getElementById('reservation_allergie_0');
const mentionAllegieOui = document.getElementById('reservation_allergie_1');

// Récupérer la valeur du champ mention des allergies
const mentionAllegie = document.getElementById('reservation_mentionDesAllergies');


const AllergieCheckedNon = (event) => {

    // Annule l´envoi des données
    event.preventDefault(); 

    if (event.target.checked) {
        // On cache le champs de saisie et on enlève la contrainte au formulaire
        allergie.style.display =  'none';
        allergie.required = false;
        mentionAllegie.value = 'Pas d´allergie' ;
    } 

}

mentionAllegieNon.addEventListener('change', AllergieCheckedNon);

const AllergieCheckedOui = (event) => {

    // Annule l´envoi des données
    event.preventDefault(); 

    if (event.target.checked) {
        // Si c'est coché, on affiche le champs de saisie 
        allergie.style.display =  "block";
        allergie.required = true;
        mentionAllegie.value = '';
    }
}

mentionAllegieOui.addEventListener('change', AllergieCheckedOui);



/* ============================================================
   * Gérer les nombre de convives dans le formulaire Reservation
   * ============================================================*/
 
// On va chercher le champ qui contient le nombre de convive
let nombre = document.getElementById('reservation_nombreDeConvive');
let error =  document.getElementById('error');

const handleChange = (event) => 
{
    // Annule l´envoi des données
    event.preventDefault(); 
  
    // Récupére le nombre de convive saisi
    let data = {nombre: event.target.value};
      
    fetch('/-traitement')
    .then(response => response.json())
    .then(result => {
        let nombreDeplaceOcupper = parseInt(result.nombre);
        let place =  parseInt(result.place);
        let placeRestante = (place - nombreDeplaceOcupper);
        let nombreSaisie = (data.nombre);
       
      
        if(nombreSaisie > placeRestante)
        {            
            nombre.classList.add("is-invalid");
            
            error.innerHTML = `Il ne reste que ${placeRestante} places` ;          
            error.style.color = "#b02a37";
            error.style.fontSize = 0.875  + "em";
            error.style.marginTop = -12 + "px";

        } else {            
            nombre.classList.remove("is-invalid");   
            error.innerHTML = `` ;
            error.style.display="none"         
        }
    });
  
}

nombre.addEventListener("change", handleChange);

