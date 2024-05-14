
import InputPreviewFiles from "./ui/file_preview.js";
const forms = document.querySelectorAll('.partners_form');

forms.forEach(function (button) {
    new InputPreviewFiles({section: button,})
    
})

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    
    if (form) {
        form.addEventListener('submit', event => {
            event.preventDefault(); 

            const fields = ['nom_prenom', 'email', 'objet', 'message', 'tel', 'user_name'];
            const errorMessages = {};

            fields.forEach(field => {
                const input = document.getElementById(field);
                const value = input.value.trim();
                const minLength = field === 'tel' ? 8 : field === 'user_name' ? 6 : 3;

                if ((field === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) || value.length < minLength) {
                    errorMessages[field] = field === 'email' ? 'Veuillez saisir une adresse email valide.' : `Le ${field.replace('_', ' ')} doit comporter au moins ${minLength} caractères.`;
                }
            });

            const errorElements = Object.fromEntries(fields.map(field => [field + '_error', document.getElementById(field + '_error')]));

            Object.entries(errorMessages).forEach(([field, message]) => {
                errorElements[field].textContent = message;
                errorElements[field].className = message ? 'error_message error_active' : 'error_message';
            });

            if (!Object.values(errorMessages).some(msg => msg)) {
                form.submit();
            }
        });

        form.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', function() {
                const errorMessage = this.parentNode.querySelector('.error_message');
                errorMessage.textContent = ''; 
                
                const inputId = this.id;
                const inputValue = this.value.trim();
                const minLength = inputId === 'tel' ? 8 : inputId === 'user_name' ? 6 : 3;

                errorMessage.textContent = (inputId === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(inputValue)) || inputValue.length < minLength ? (inputId === 'email' ? 'Veuillez saisir une adresse email valide.' : `Le ${inputId.replace('_', ' ')} doit comporter au moins ${minLength} caractères.`) : '';
                errorMessage.className = errorMessage.textContent ? 'error_message error_active' : 'error_message';
            });
        });
    }
});
