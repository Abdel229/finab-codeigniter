document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');

    if(form){
        form.addEventListener('submit', function(event) {
            event.preventDefault(); 
    
            const nomPrenomInput = document.getElementById('nom_prenom');
            const emailInput = document.getElementById('email');
            const objetInput = document.getElementById('objet');
            const messageTextarea = document.getElementById('message');
    
            const nomPrenomValue = nomPrenomInput.value.trim();
            const emailValue = emailInput.value.trim();
            const objetValue = objetInput.value.trim();
            const messageValue = messageTextarea.value.trim();
    
            const errorMessages = {
                nomPrenom: '',
                email: '',
                objet: '',
                message: ''
            };
    
            if (nomPrenomValue === '' || nomPrenomValue.length < 6) {
                errorMessages.nomPrenom = 'Le nom et prénom doivent comporter au moins 6 lettres.';
            }
    
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailValue === '' || !emailRegex.test(emailValue)) {
                errorMessages.email = 'Veuillez saisir une adresse email valide.';
            }
    
            if (objetValue === '' || objetValue.replace(/\s/g, '').length < 10) {
                errorMessages.objet = 'L\'objet doit comporter au moins 10 lettres.';
            }
    
            if (messageValue === '' || messageValue.replace(/\s/g, '').length < 10) {
                errorMessages.message = 'Le message doit comporter au moins 10 lettres.';
            }
    
            const nom_prenom_error = document.getElementById('nom_prenom_error');
            const email_error = document.getElementById('email_error');
            const objet_error = document.getElementById('objet_error');
            const message_error = document.getElementById('message_error');
    
            nom_prenom_error.textContent = errorMessages.nomPrenom;
            email_error.textContent = errorMessages.email;
            objet_error.textContent = errorMessages.objet;
            message_error.textContent = errorMessages.message;
    
            // Appliquer la classe error_active seulement si le message d'erreur correspondant n'est pas vide
            nom_prenom_error.className = errorMessages.nomPrenom ? 'error_message error_active' : 'error_message';
            email_error.className = errorMessages.email ? 'error_message error_active' : 'error_message';
            objet_error.className = errorMessages.objet ? 'error_message error_active' : 'error_message';
            message_error.className = errorMessages.message ? 'error_message error_active' : 'error_message';
    
            if (Object.values(errorMessages).every(msg => msg === '')) {
                form.submit();
            }
        });
    
        const inputs = form.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                const errorMessage = this.parentNode.querySelector('.error_message');
                errorMessage.textContent = ''; 
                
                // Vérification du champ dès que l'utilisateur finit de saisir et que le curseur n'est plus sur l'input
                const inputId = this.id;
                const inputValue = this.value.trim();
                let errorMessageText = '';
    
                if (inputId === 'nom_prenom') {
                    errorMessageText = inputValue === '' || inputValue.length < 6 ? 'Le nom et prénom doivent comporter au moins 6 lettres.' : '';
                } else if (inputId === 'email') {   
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    errorMessageText = inputValue === '' || !emailRegex.test(inputValue) ? 'Veuillez saisir une adresse email valide.' : '';
                } else if (inputId === 'objet') {
                    errorMessageText = inputValue === '' || inputValue.replace(/\s/g, '').length < 10 ? 'L\'objet doit comporter au moins 10 lettres.' : '';
                } else if (inputId === 'message') {
                    errorMessageText = inputValue === '' || inputValue.replace(/\s/g, '').length < 10 ? 'Le message doit comporter au moins 10 lettres.' : '';
                }
    
                errorMessage.textContent = errorMessageText;
                errorMessage.className = errorMessageText ? 'error_message error_active' : 'error_message';
            });
        });
    }
});
