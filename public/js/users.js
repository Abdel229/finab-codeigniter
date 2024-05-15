
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
    fetch(`${baseUrl}/users/fetchusers`) 
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error status: ${response.status}`);
        }
        return response.json();
    })
    .then(users => {
       const usersData =users;
       console.log(usersData);
        const thead = [
            { title: "Emails", },{ title: "Rôles", },{ title: "Status", }, { title: "Actions", },
        ];
    
        const schema = (item) => {
            const id = item.id;
            const email = item.email;
            const role = item.role;
            const status = item.status_id;
    
            const schema = document.createDocumentFragment();
    
            const TR = document.createElement("tr");
            TR.setAttribute("data-id", id);
            TR.innerHTML = `
                <td>${email}</td>
                <td>${role}</td>
                <td>${status == 2 ? `
                    <span class="partner__status">Activer</span>`
                    :`<span class="partner__status warning">Bloquer</span>`}
                </td>
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
                            ${status == 2 ? `
                            
                            <button class="ui-dropdown__list-item-btn" data-action="barcode-control">
                                <i class="icon-cancel"></i>
                                
                                <a href="${baseUrl}/users/block/${id}" class="btn-delete" title="Bloquer">
                                    Bloquer
                                </a>
                            </button>
                            `
                            :`
                            
                            <button class="ui-dropdown__list-item-btn" data-action="barcode-control">
                                <i class="icon-activate"></i>
                                
                                <a href="${baseUrl}/users/unblock/${id}" class="btn-delete" title="Débloquer">
                                    Débloquer
                                </a>
                            </button>
                            `}
                        </li>
                        <li class="ui-dropdown__list-item">
                            <button class="ui-dropdown__list-item-btn" >
                                <i class="icon-delete"></i>
                                <a href="${baseUrl}/users/delete/${id}" class="" title="Supprimer">
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
                        <p style="text-align:center;">Voulez vous vraiment ${status == 2 ? `<span class="confirm__disabled">Bloquer</span>`:`<span class="confirm__disabled">Débloquer</span>`}?</p>
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
            targetId: 'article__list',
            className: "pg--product-list",
            data: usersData,
            thead,
            bodyListSchema: schema,
            limit: 5,
            navTopSelector: null,
            filters: [
                {
                    selector: "status_id",
                    label: "Status",
                    data: [
                        
                        {
                            value: -1,
                            label: "Tout",
                            color: "#363740",
                            selected: true,
                        },
                        {
                            value: 2,
                            label: "Actifs",
                            color: "#00aa4d",
                            selected: false,
                        },
                        {
                            value: 1,
                            label: "Non actifs",
                            color: "#f0a61c",
                            selected: false,
                        },
                    ],
                },
            ],
        });
    })
    .catch(error => {
        console.error('Erreur lors de la récupération des données depuis l\'API :', error);
    });
    
}
createTableFragment();