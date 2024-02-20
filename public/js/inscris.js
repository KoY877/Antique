class GestionAllergieInscription {
    constructor() {
        this.allergieInscription = document.getElementById('mention_allergie_Inscription');
        this.mentionAllergieNonInscription = document.getElementById('client_inscription_allergie_0');
        this.mentionAllergieOuiInscription = document.getElementById('client_inscription_allergie_1');
        this.mentionAllergieInscription = document.getElementById('client_inscription_mentionDesAllergies');
        this.initialize();
    }

    initialize() {
        this.mentionAllergieNonInscription.addEventListener('change', this.handleAllergieNonInscription.bind(this));
        this.mentionAllergieOuiInscription.addEventListener('change', this.handleAllergieOuiInscription.bind(this));
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
const gestionAllergieInscription = new GestionAllergieInscription();