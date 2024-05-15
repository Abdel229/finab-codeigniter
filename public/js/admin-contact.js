import MODAL from "./ui/modal.js";

/**
 * Phone number
 */

document.addEventListener('DOMContentLoaded', function () {

    // add input number 
    var maxPhoneFields = 4;
    var currentPhoneFields = 2;

    // Fonction pour ajouter un nouveau champ de téléphone
    function addPhoneField() {
        let parent = document.querySelector('#additionnal-phone');
        let currentPhoneFields = parent.children.length + 2;

        if (currentPhoneFields < maxPhoneFields) {
            let newField = document.createElement('div');
            newField.classList.add('fnb-form__item','phoneDiv');
            newField.style = 'display:flex;align-items:center;gap:10px;'
            newField.id = `phone${currentPhoneFields}`
            newField.setAttribute('data-index', currentPhoneFields);
            newField.innerHTML = `
            <div style="width:100%;">
                <label for="phone${currentPhoneFields}">Numéro de téléphone ${currentPhoneFields}</label>
                   <div>
                       <input type="tel" name="phoneNumber[]" value="" class="phoneInput">
                   </div>
            </div>
                <div class="toggle-button" data-toggle-state="off" data-index=${currentPhoneFields}>
                <div class="inner-circle">
                </div>
            </div>
            
           `;
            document.querySelector('#additionnal-phone').appendChild(newField);
            let btnToggle = newField.querySelector('.toggle-button');
            btnToggle.addEventListener('click', () => {
                btnToggle.classList.toggle('active');
                togglePhoneField(btnToggle);
            })
            formatNumber(newField.querySelector(`.phoneInput`));
            currentPhoneFields++;
        }
    }

    // Fonction pour gérer le clic sur le bouton toggle et lancer une requête fetch
    function togglePhoneField(btnToggle) {
        let toggleState = btnToggle.getAttribute('data-toggle-state');
        btnToggle.setAttribute('data-toggle-state', toggleState === 'on' ? 'off' : 'on');
        // if (toggleState === 'on') {
        //     // Lancer une requête fetch pour une action on
        //     fetch('url_de_votre_api', {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //         },
        //         body: JSON.stringify({ action: 'toggleOn', index: index }),
        //     })
        //         .then(response => response.json())
        //         .then(data => {
        //             console.log('Success:', data);
        //         })
        //         .catch((error) => {
        //             console.error('Error:', error);
        //         });
        // } else {
        //     // Lancer une requête fetch pour une autre action off
        //     fetch('url_de_votre_api', {
        //         method: 'POST', 
        //         headers: {
        //             'Content-Type': 'application/json',
        //         },
        //         body: JSON.stringify({ action: 'toggleOff', index: index }),
        //     })
        //         .then(response => response.json())
        //         .then(data => {
        //             console.log('Success:', data);
        //         })
        //         .catch((error) => {
        //             console.error('Error:', error);
        //         });
        // }
    }

    // Ajouter l'écouteur d'événements au bouton #addMore pour ajouter un nouveau champ de téléphone
    let addButton = document.querySelector('#addMore');
    addButton.addEventListener('click', addPhoneField);



    // Ajouter des écouteurs d'événements aux boutons toggle existants
    document.querySelectorAll('.toggle-phone').forEach(function (button) {
        button.addEventListener('click', function () {
            var index = this.getAttribute('data-index');
            togglePhoneField(index);
        });
    });


    // format input phone number
    const inputNumber = document.querySelector('#phone');
    formatNumber(inputNumber);
    function formatNumber(input) {
        input.addEventListener('input', (e) => {
            console.log('ok')
            let start = e.target.selectionStart;
            let end = e.target.selectionEnd;

            let num = e.target.value.replace(/\D/g, '');
            let formattedNum = `(+${num.substring(0, 3)}) ${num.substring(3, 5)} ${num.substring(5, 7)} ${num.substring(7, 9)} ${num.substring(9, 11)}`;

            e.target.value = formattedNum;

            // Restaurer la position du curseur
            let newStart = start + (formattedNum.length - num.length);
            let newEnd = end + (formattedNum.length - num.length);
            e.target.setSelectionRange(newStart, newEnd);
        });
    }



});

/**
 * Phone number form
 */
document.addEventListener('DOMContentLoaded', function(){
    const form = document.querySelector('form#phone_number');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        // Collecter les inputs et les associer aux toggleStates
        const inputs = document.querySelectorAll('.phoneInput');
        const toggleStates = document.querySelectorAll('[data-toggle-state]');
        const data = new FormData(form);
        let inputTogglePairs = [];

        inputs.forEach((input, index) => {
            const toggleState = toggleStates[index].dataset.toggleState;
            inputTogglePairs.push({ id:index+1,number: input.value, state: toggleState });
        });
        const inputToggleJson = JSON.stringify(inputTogglePairs);

        data.append('phone', inputToggleJson);
        const url = form.action;
        fetch(url, {
            method: 'POST',
            body: data
        }).then(response => response.json())
           .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    let results=JSON.parse(data.result);
                    results.forEach((element)=>{ 
                        //get element
                        let phoneDiv=document.querySelector(`#phone${element.id}`);
                        let input=phoneDiv.querySelector('.phoneInput');
                        let toggleBtn=phoneDiv.querySelector('.toggle-button');

                        //set data
                        input.value=element.number
                        toggleBtn.setAttribute('data-toggle-state',element.state);
                        if(element.state==='on'){
                            toggleBtn.classList.add('active')
                        }else if(element.state==='off'){
                            toggleBtn.classList.remove('active')
                        }
                        
                    })

                    modal(data.message);
                }
            })
    });
});

   
/**
* Adresse
*/

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form#adresse');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const data = new FormData(form);
        const url = form.action;
        fetch(url, {
            method: 'POST',
            body: data
        }).then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    console.log(data);
                    const inputTitle = document.querySelector('input#adresse');
                    inputTitle.value = data.result.adresse;
                    modal(data.message);

                }
            })
    });
});

/**
 * Email
 */
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form#email');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const data = new FormData(form);
        const url = form.action;

        fetch(url, {
            method: 'POST',
            body: data
        }).then(response => response.json())
            .then(data => {
                console.log(data)
                if (data.error) {
                    alert(data.error);
                } else {
                    const inputTitle = document.querySelector('input#email');
                    inputTitle.value = data.result.email;
                    modal(data.message);
                }
            })
    });
});

/**
 * Link form
 */
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form#link');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const data = new FormData(form);
        const url = form.action;

        fetch(url, {
            method: 'POST',
            body: data
        }).then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    console.log(data)
                    data.result.forEach(element => {
                        let input = document.querySelector(`input#${element.name}`);
                        input.value = element.link;
                    })

                    modal(data.message);
                }
            })
    });
});

/**
 * Modal
 */
const modal = (message) => {
    new MODAL({
        id: '',
        className: 'wdg-modal--default',
        modalContent: modalContent(message),
        width: '500px',
        callBack: (context) => {
            console.log(context)
        }
    })
}
const modalContent = (message) => {
    const modalContent = document.createDocumentFragment()
    const modalBody = document.createElement('div')
    modalBody.className = 'wdg-modal_body wdg-modal_body--full'
    modalBody.innerHTML = message
    modalContent.appendChild(modalBody)
    return modalContent
}

/**
 * Toggle button
 */
document.addEventListener('DOMContentLoaded', function () {
    const toggles = document.querySelectorAll('.toggle-button');
    toggles.forEach(function (toggle) {
        toggle.addEventListener('click', () => {
            toggle.classList.toggle('active');
            if(toggle.classList.contains('active')){
                toggle.setAttribute('data-toggle-state','on')
            }else{
                toggle.setAttribute('data-toggle-state','off')
            }
        })
    })

});
