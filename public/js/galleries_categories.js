import Dropdown from "./ui/dropdown.js";
import MODAL from "./ui/modal.js";
import PAGINATION from "./ui/pagination.js";


const baseUrl = window.location.origin;
function createTableFragment() {
    fetch(`${baseUrl}/fetGalleriesCategories`) 
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error status: ${response.status}`);
        }
        return response.json();
    })
    .then(categories => {
       const articlesCategoriesData = categories;
        const thead = [
            { title: "Noms", }, { title: "Actions", },
        ];
    
        const schema = (item) => {
            const id = item.id;
            const name = item.name;
    
            const schema = document.createDocumentFragment();
    
            const TR = document.createElement("tr");
            TR.setAttribute("data-id", id);
            TR.innerHTML = `
                <td>${name}</td>
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
                            <button class="ui-dropdown__list-item-btn" data-action="edit">
                                <i class="icon-edit"></i>
                                <a href="${baseUrl}/galleries_category/update/${id}" class="" title="Modifier">
                                    Modifier
                                </a>
                            </button>
                        </li>
                        <li class="ui-dropdown__list-item">
                            <button class="ui-dropdown__list-item-btn" data-action="barcode-control">
                                <i class="icon-delete"></i>
                                
                                <a href="${baseUrl}/categories/delete/${id}" class="" title="Supprimer">
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
                    callBack: (dropdown) => {
                        //===> Edit Product
                        
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
            data: articlesCategoriesData,
            thead,
            bodyListSchema: schema,
            limit: 3,
            navTopSelector: null,
        });
    })
    .catch(error => {
        console.error('Erreur lors de la récupération des données depuis l\'API :', error);
    });
    
}
createTableFragment();