class GestionInscription {
    constructor() {
        this.password1 = document.getElementById('client_inscription_password_first');
        this.password2 = document.getElementById('client_inscription_password_second');
        this.error_inscription = document.getElementById('error');
        this.allergieInscription = document.getElementById('mention_allergie_Inscription');
        this.mentionAllergieNonInscription = document.getElementById('client_inscription_allergie_0');
        this.mentionAllergieOuiInscription = document.getElementById('client_inscription_allergie_1');
        this.mentionAllergieInscription = document.getElementById('client_inscription_mentionDesAllergies');
        this.initialize();
    }

    initialize() {
        this.mentionAllergieNonInscription.addEventListener('change', this.handleAllergieNonInscription.bind(this));
        this.mentionAllergieOuiInscription.addEventListener('change', this.handleAllergieOuiInscription.bind(this));
        this.password2.addEventListener('change', this.checkPassword.bind(this));
    }   
    
    checkPassword (event){
        event.preventDefault();
        let password1Value = this.password1.value;
        let password2Value = this.password2.value;

        
        // Si le champ est vide, on ne fait rien
        if (!password1Value || !password2Value ) return;
        
        // On vérifie que les mots de passe sont identiques
        if (password1Value !== password2Value) {

            // Sinon on affiche un message d'erreur et on retire la validation du formulaire            
            this.error_inscription.innerHTML = `Le mot de passe et la confirmation ne correspondent pas.`;
            this.error_inscription.style.color = "#b02a37";
            this.error_inscription.style.fontSize = 0.875 + "em";
            this.error_inscription.style.marginTop = -12 + "px";

            // Vider les champs
            this.password1.value = '';
            this.password2.value = '';
        } else{
            
            // Sinon on enlève l'erreur et on valide le formulaire
            this.error_inscription.innerHTML = ``;
        }
    }

    handleAllergieNonInscription(event) {
        event.preventDefault();
        if (event.target.checked) {
            this.allergieInscription.style.display = 'none';
            this.allergieInscription.required = false;
            this.mentionAllergieInscription.value = 'Pas d´allergie';
        }
    }

    handleAllergieOuiInscription(event) {
        event.preventDefault();
        if (event.target.checked) {
            this.allergieInscription.style.display = 'block';
            this.allergieInscription.required = true;
            this.mentionAllergieInscription.value  = '';
        }
    }

   
}

// Instanciation des classes pour gérer les fonctionnalités
const gestionInscription = new GestionInscription();