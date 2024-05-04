//subcriptionBtn
import MODAL from "./libs/modal.js"

//=============> in header
const subcriptionBtn = document.getElementById('subcriptionBtn')
const modalContent = () => {
    const modalContent = document.createDocumentFragment()
    const modalBody = document.createElement('div')
    modalBody.className = 'wdg-modal_body wdg-modal_body--full'
    modalBody.innerHTML = '<p style="text-align:center;padding:10px;">Bientôt disponible</p>'
    modalContent.appendChild(modalBody)
    return modalContent
}
  
subcriptionBtn.addEventListener('click', (e) =>{
    e.preventDefault()
    const modal = new MODAL({
        id: '',
        className: 'wdg-modal--default',
        modalContent: modalContent(),
        width: '500px',
        callBack: (context) => {
            console.log(context)
        }
    })
})

//=========> in footer
const form_footer = document.getElementById('newsletterForm');
const emailInputFooter = document.getElementById('email_footer');
const emailErrorFooter = document.getElementById('error_email_footer');
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if(form_footer&&emailInputFooter){
    emailInputFooter.addEventListener('input', function() {
        const inputValueFooter = this.value.trim();

        if (inputValueFooter === '' || !emailRegex.test(inputValueFooter)) {
            emailErrorFooter.textContent = 'Veuillez saisir une adresse email valide.';
            emailErrorFooter.classList.add('error_active');
        } else {
            emailErrorFooter.textContent = '';
            emailErrorFooter.classList.remove('error_active');
        }
    });
    form_footer.addEventListener('submit', function(event) {
        event.preventDefault(); 
        const emailValue = emailInputFooter.value.trim();

        if (emailValue === '' || !emailRegex.test(emailValue)) {
            emailErrorFooter.textContent = 'Veuillez saisir une adresse email valide.';
            emailErrorFooter.classList.add('error_active');
        } else {
            form_footer.submit();
        }
    });
}

