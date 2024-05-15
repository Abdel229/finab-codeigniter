
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
    fetch(`${baseUrl}/partner/fetchBecomePartners`) 
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error status: ${response.status}`);
        }
        return response.json();
    })
    .then(partenaires => {
       const partnersData = partenaires;
        const thead = [
            { title: "Date de la demande", },{ title: "Partenaires", },{ title: "objet", },{ title: "Description", },{ title: "Raison du rejet de la demande", },{ title: "Status", }, { title: "Actions", },
        ];
    
        const schema = (item) => {
            const id = item.id;
            const title = item.title;
            const img = item.img;
            const link = item.link;
            const email = item.email;
            const phone = item.phone;
            const object = item.object;
            const query = item.query;
            const observation = item.observation;
            const date_hours = new Date(item.created_at);
            const date = date_hours.toLocaleDateString(); 
            const heure = date_hours.getHours();
            const minutes = date_hours.getMinutes();
            const status = item.status_id ;
    
            const schema = document.createDocumentFragment();
    
            const TR = document.createElement("tr");
            TR.setAttribute("data-id", id);
            TR.innerHTML = `
                <td>Le ${date} à ${heure}:${minutes} </td>
                <td>
                    <div class="partner__profil">
                        <div class="partner__log">
                            <img src="${baseUrl}/${img}" alt="" style='width: 50px;'>
                        </div>
                        <div class="partner_infos">
                            <div class="partner__name">
                                ${title}
                            </div>
                            <div class="partner__infos_with_icon">
                                <div class="label"><i class="icon-phone"></i></div>
                                <div class="value">${phone}</div>
                            </div>
                            <div class="partner__infos_with_icon">
                                <div class="label"><i class="icon icon-email"></i></div>
                                <div class="value">${email}</div>
                            </div>
                            <a href="${link}" style="color:blue;">${link}</a>
                        </div>
                    </div>
                </td>
                <td style="max-width:400px; font-size:.875rem;">${object}</td>
                <td style="max-width:400px; font-size:.875rem;">${query}</td>
                ${status == 5 ?
                    ` <td style="max-width:400px; font-size:.875rem;">${observation}</td>`
                    :`<td style="max-width:400px; font-size:.875rem;"></td>`
                }
                <td>${status == 1 ? `
                    <span class="partner__status">En attente</span>`
                    :`<span class="partner__status warning">Rejeter</span>`}
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
                            <button class="ui-dropdown__list-item-btn" >
                                <i class="icon-activate"></i>
                                
                                <a href="${baseUrl}/partner/accepted/${id}" class="" title="Accepter">
                                    Accepter
                                </a>
                            </button>
                        </li>
                        ${status == 5 ?
                            ``:
                            `<li class="ui-dropdown__list-item">
                            <button class="ui-dropdown__list-item-btn" data-action="barcode-control">
                                <i class="icon-cancel"></i>
                                <a href="" class="btn-delete" title="Rejeter">
                                    Rejeter
                                </a>
                            </button>
                            </li>`
                        }
                        
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
                            modalBody.innerHTML = `<form class="fnb-form " method="post" id="" enctype="multipart/form-data" action="${baseUrl}/partner/refused/${id}">
                            
                            <div class="fnb-form__item">
                                <label for="description">Observation</label>
                                <textarea id="observation" name="observation" required ></textarea>
                            </div>
                            <div class="fnb-form__item fnb-form__item-action">
                                <button type="submit" class="submit-button">Envoyer</button>
                            </div>
                        </form>`
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
            data: partnersData.sort((a, b) => {
                // Compare les propriétés que vous souhaitez trier par ordre décroissant
                // Ici, nous comparons deux dates, mais vous pouvez remplacer cela par n'importe quelle propriété que vous souhaitez trier
                return new Date(b.created_at) - new Date(a.created_at);
            }),
            thead,
            bodyListSchema: schema,
            limit: 10,
            navTopSelector: null,
            filters: [
                {
                    selector: "status_id",
                    label: "Status",
                    data: [
                        {
                            value: 1,
                            label: "En attente",
                            color: "#00aa4d",
                            selected: true,
                        },
                        {
                            value: 5,
                            label: "Rejeter",
                            color: "#f0a61c",
                            selected: false,
                        },
                        {
                            value: -1,
                            label: "Tout",
                            color: "#363740",
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