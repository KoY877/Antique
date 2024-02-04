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
            error.innerHTML = `Il ne reste que ${placeRestante} places` ;          
            error.style.color = "#b02a37";
            error.style.fontSize = 0.875  + "em";
            error.style.marginTop = -12 + "px";
            nombre.classList.add("is-invalid");

        } else {
            
            error.innerHTML = `` ;
            error.style.display="none"
            nombre.classList.remove("is-invalid");
            
        }
    });
  
}

nombre.addEventListener("change", handleChange);