
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
    fetch(`${baseUrl}/admin/fetcharticles`) 
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error status: ${response.status}`);
        }
        return response.json();
    })
    .then(allarticles => {
       const articlesData = allarticles.allarticles;
        const thead = [
            { title: "Image articles", },{ title: "Titre", },{ title: "Date de publication", },{ title: "categorie", },{ title: "Status", }, { title: "Actions", },
        ];
    
        const schema = (item) => {
            const id = item.articles.id;
            const created_at = item.articles.created_at;
            const title = item.articles.title;
            const description = item.articles.description;
            const date_pub = item.articles.date_pub;
            const img = item.articles.img;
            const status = item.articles.status_id;
            const category = item.categories.name;
    
            const schema = document.createDocumentFragment();
    
            const TR = document.createElement("tr");
            TR.setAttribute("data-id", id);
            TR.innerHTML = `
                <td><img src="${baseUrl}/${img}" alt="" style='width: 50px;'></td>
                <td>${title}</td>
                <td>${date_pub}</td>
                <td>${category}</td>
                <td>${status == 2 ? `
                    <span class="partner__status">Publier</span>`
                    :`<span class="partner__status warning">Non publier</span>`}
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
                                <i class="icon-edit"></i>
                                <a href="${baseUrl}/articles/update/${id}" class="" title="Modifier">
                                    Modifier
                                </a>
                            </button>
                        </li>
                        <li class="ui-dropdown__list-item">
                            ${status == 2 ? `
                            
                            <button class="ui-dropdown__list-item-btn" data-action="barcode-control">
                                <i class="icon-disabled"></i>
                                
                                <a href="${baseUrl}/articles/delete/${id}" class="btn-delete" title="Retirer">
                                    Retirer de la publication
                                </a>
                            </button>
                            `
                            :`
                            
                            <button class="ui-dropdown__list-item-btn" data-action="barcode-control">
                                <i class="icon-activate"></i>
                                
                                <a href="${baseUrl}/articles/publish/${id}" class="btn-delete" title="Publier">
                                    Publier
                                </a>
                            </button>
                            `}
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
                        <p style="text-align:center;">Voulez vous vraiment ${status == 2 ? `<span class="confirm__disabled">Retirer</span>`:`<span class="confirm__disabled">Publier</span>`}?</p>
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
            data: articlesData,
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
                            label: "Publier",
                            color: "#00aa4d",
                            selected: false,
                        },
                        {
                            value: 3,
                            label: "Non publier",
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