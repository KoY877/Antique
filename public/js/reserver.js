class GestionAllergie {
    constructor() {
        this.allergie = document.getElementById('mention_allergie');
        this.mentionAllergieNon = document.getElementById('reservation_allergie_0');
        this.mentionAllergieOui = document.getElementById('reservation_allergie_1');
        this.mentionAllergie = document.getElementById('reservation_mentionDesAllergies');
        this.mentionAllergieValue = document.getElementById('reservation_mentionDesAllergies').value;
        this.initialize();
    }

    initialize() {
        
        this.mentionAllergieNon.addEventListener('change', this.handleAllergieNon.bind(this));
        this.mentionAllergieOui.addEventListener('change', this.handleAllergieOui.bind(this));
        // Correction: Utilisation de 'DOMContentLoaded' pour écouter l'événement de chargement de la page
        document.addEventListener('DOMContentLoaded', this.handleMentionAllergie.bind(this));
    }

    handleMentionAllergie(event) {
        // Correction: Vérification de la valeur de mentionAllergieOui lors du chargement de la page
        if (this.mentionAllergieOui.checked) {
            this.allergie.style.display = 'block';
            this.allergie.required = true;
        
        } else if (this.mentionAllergieNon.checked){
            this.allergie.style.display = 'none';
            this.allergie.required = false;
            this.mentionAllergie.value = 'Pas d´allergie';
        }
    }

    handleAllergieNon(event) {
        event.preventDefault();
        if (event.target.checked) {
            this.allergie.style.display = 'none';
            this.allergie.required = false;
            this.mentionAllergie.value = 'Pas d´allergie';
        }
    }

    handleAllergieOui(event) {
        event.preventDefault();
        if (event.target.checked) {
            this.allergie.style.display = 'block';
            this.allergie.required = true;
            this.mentionAllergie.value = '';
        }
    }
}

class GestionNombreConvives {
    constructor() {
        this.nombre = document.getElementById('reservation_nombreDeConvive');
        this.error = document.getElementById('error');
        this.initialize();
    }

    initialize() {
        this.nombre.addEventListener('change', this.handleChange.bind(this));
    }

    handleChange(event) {
        event.preventDefault();
        let data = { nombre: event.target.value };

        fetch('/-traitement')
            .then(response => response.json())
            .then(result => {
                let nombreDeplaceOcupper = parseInt(result.nombre);
                let place = parseInt(result.place);
                let placeRestante = (place - nombreDeplaceOcupper);
                let nombreSaisie = parseInt(data.nombre);

                if (nombreSaisie > placeRestante) {
                    this.nombre.classList.add("is-invalid");
                    this.error.innerHTML = `Il ne reste que ${placeRestante} places`;
                    this.error.style.color = "#b02a37";
                    this.error.style.fontSize = 0.875 + "em";
                    this.error.style.marginTop = -12 + "px";
                } else {
                    this.nombre.classList.remove("is-invalid");
                    this.error.innerHTML = ``;
                    this.error.style.display = "none";
                }
            });
    }
}

// Instanciation des classes pour gérer les fonctionnalités
const gestionAllergie = new GestionAllergie();
const gestionNombreConvives = new GestionNombreConvives();

