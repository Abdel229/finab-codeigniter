
import Dropdown from "./ui/dropdown.js";
import MODAL from "./ui/modal.js";
import PAGINATION from "./ui/pagination.js";


const baseUrl = window.location.origin;
function actions(button){
    const yesButton = document.querySelector('#confirmYes');
    console.log(yesButton);
    if(yesButton) {
        yesButton.addEventListener('click', function() {
            window.location.href = button.getAttribute('href');
            modal.close();
        });
    }
    
    const noButton = document.querySelector('#confirmNo');
    console.log(noButton);
    if(noButton){
        noButton.addEventListener('click', function() {
            modal.close();
        });
    }
    }
function createTableFragment() {
    fetch(`${baseUrl}/messages/get-messages`) 
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error status: ${response.status}`);
        }
        return response.json();
    })
    .then(messages => {
       const messagesData = messages;
        const thead = [
            { title: "Nom", },{ title: "Objet", },{ title: "Email", },{ title: "Status", },{ title: "Date de réception", }, { title: "Actions", },
        ];
    
        const schema = (item) => {
            const id = item.id;
            const name = item.name;
            const object = item.object;
            const email = item.email;
            const message = item.message;
            const status = item.read_statut;
            const created_at = item.created_at;
            const schema = document.createDocumentFragment();
    
            const TR = document.createElement("tr");
            TR.setAttribute("data-id", id);
            TR.innerHTML = `
                <td>${name}</td>
                <td>${object}</td>
                <td>${email}</td>
                <td><p style="display:flex;justify-content:center;align-items:center;padding: 3px 7px;border-radius: 20px;color:#fff;${status==1?'background-color: #e53a18;':'background-color: #2ce518'}">${status==1?'Non lu':'Lu'}</p></td>
                <td>${created_at}</td>
                <td>
                    <div class="fnb-table__actions-btns">
                        <button class="menu-fnb-btn" data-dropdown="product-menu-actions" data-action="open-product-menu"><i class="icon-menu-actions-vertical"></i></button>
                    </div> 
                </td>
            `;
    
            const menuBtn = TR.querySelector('button[data-action="open-product-menu"]');
            if (menuBtn) {
                const FinabMenuContent = `
                    <ul class="ui-dropdown__list">
                        <li class="ui-dropdown__list-item">
                            <button class="ui-dropdown__list-item-btn" >
                                <i class="icon-edit"></i>
                                <a href="${baseUrl}/messages/${status==1?'read':'unread'}/${id}" class="" title="${status==1?'Lu':'Non lu'}">
                                ${status==1?'Marquer comme lu':'Marquer comme non lu'}
                                </a>
                            </button>
                        </li>
                        <li class="ui-dropdown__list-item">
                            <button class="ui-dropdown__list-item-btn" data-action="barcode-control">
                                <i class="icon-delete"></i>
                                
                                <a href="${baseUrl}/messages/delete/${id}" class="btn-delete" title="Supprimer">
                                    Supprimer
                                </a>
                            </button>
                        </li>
                    </ul>
                `;
                const dropdown = new Dropdown({
                    autoCreate: false,
                    content: FinabMenuContent,
                    idName: "product-menu--click",
                    callBack: (element) => {
                        //===> Edit Product
                        const btnDelete = element.querySelector('.btn-delete')
                        const modalContent = () => {
                            const modalContent = document.createDocumentFragment()
                            const modalBody = document.createElement('div')
                            modalBody.className = 'wdg-modal_body wdg-modal_body--full'
                            modalBody.innerHTML = `<div style="padding:5px;">
                        <p style="text-align:center;">Voulez vous vraiment supprimer?</p>
                        <div>
                        </div style="display:flex;gap:10px; justify-content:center;">
                            <button id="confirmYes">Oui</button>
                            <button id="confirmNo">Non</button>
                        </div>`
                            modalContent.appendChild(modalBody)
                            return modalContent
                        }
                        let modal
                            btnDelete.addEventListener('click', function (event) {
                                event.preventDefault();
                                modal = new MODAL({
                                    id: '',
                                    className: 'wdg-modal--default',
                                    modalContent: modalContent(),
                                    width: '500px',
                                    callBack: (context) => {
                                        console.log(context)
                                    }
                                })
                                actions(btnDelete)
                            });
                    },
                });
    
                menuBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    dropdown.create(e);
                });
            }
    
            schema.appendChild(TR); 
            return schema;
        };
        new PAGINATION({
            targetId: 'message__list',
            className: "pg--product-list",
            data: messages,
            thead,
            bodyListSchema: schema,
            limit: 15,
            navTopSelector: null,
        });
    })
    .catch(error => {
        console.error('Erreur lors de la récupération des données depuis l\'API :', error);
    });
    
}
createTableFragment();