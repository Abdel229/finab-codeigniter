import Dropdown from "./ui/dropdown.js";
import MODAL from "./ui/modal.js";
import PAGINATION from "./ui/pagination.js";
import InputPreviewFiles from "./ui/file_preview.js";

// Fonction pour créer et retourner le fragment de document
const baseUrl = window.location.origin;
function createTableFragment(data) {
    const fragment = document.createDocumentFragment();

    data.forEach(item => {
        const id = item.id;
        const created_at = item.created_at;
        const title = item.title;
        const description = item.description;
        const date_pub = item.date_pub;
        const img = item.img;

        const TR = document.createElement("tr");
        TR.innerHTML = `
            <td>${created_at}</td>
            <td>${title}</td>
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
                                
                            <a href="articles/update/${id}" class="" title="Supprimer">
                                Modifier
                            </a>
                            
                        </button>
                    </li>
                    <li class="ui-dropdown__list-item">
                        <button class="ui-dropdown__list-item-btn" data-action="barcode-control">
                            <i class="icon-delete"></i>
                            
                            <a href="articles/delete/${id}" class="" title="Supprimer">
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
                    const editProduct = dropdown.querySelector('button[data-action="edit"]');
                    // if (editProduct) {
                    //     const modalContent = () => {
                    //         const modalContent = document.createDocumentFragment();
                    //         const className = "modal-add-new-prod";
                    //         const formId = "edit-product-form";
                    //         const modalInner = document.createElement("div");
                    //         modalInner.classList = className;
                    //         modalInner.innerHTML = `
                    //             <div class="ui-modal__head">
                    //                 <h2 class="ui-modal__title">Modification de l'évènement de finab</h2>
                    //             </div>
                    //             <div class="ui-modal__body">
                    //             <form class="article-form fnb-form" method="post" enctype="multipart/form-data" action="articles/update/${id}">
                    //                 <div class="form-group">
                    //                     <label for="title">Titre de l'article</label>
                    //                     <input type="text" id="title" name="title" value="${title}" required>
                    //                 </div>
                    //                 <div class="form-group">
                    //                     <label for="description">Description de l'article</label>
                    //                     <textarea id="description" name="description" required>${description}</textarea>
                    //                 </div>
                    //                 <div class="form-group">
                    //                     <label for="publication-date">Date de publication</label>
                    //                     <input type="date" id="publication-date" value="${date_pub}" name="date_pub" readonly>
                    //                 </div>
                    //                 <div class="form-group">
                    //                     <label for="image">Image actuelle</label><br>
                    //                     <img src="${baseUrl+img}" alt="Image actuelle"><br>
                    //                     <label for="new-image">Nouvelle image (optionnel)</label>
                    //                     <input type="file" id="new-image" name="new_img" value="">
                    //                 </div>
                    //                 <div class="form-group">
                                        
                    //                 </div>
                                    
                    //                 <div class="fnb-form__item fnb-form__item-action">
                    //                     <button type="submit" class="submit-button">Mettre à jour</button>
                    //                 </div>
                    //             </form>
                    //             </div>
                    //         `;

                    //         modalContent.appendChild(modalInner);
                    //         return modalContent;
                    //     };

                    //     editProduct.addEventListener("click", (e) => {
                    //         e.preventDefault();
                    //         const modal = new MODAL({
                    //             id: "modalNewProduct",
                    //             className: "wdg-modal--default",
                    //             modalContent: modalContent(),
                    //             width: "500px",
                    //         });
                    //     });
                    // }
                },
            });

            menuBtn.addEventListener("click", (e) => {
                e.preventDefault();
                dropdown.create(e);
            });
        }

        TR.setAttribute("data-id", id);
        fragment.appendChild(TR); // Ajoutez la ligne de tableau au fragment de document
    });

    return fragment;
}

// Appel de la fonction pour créer le fragment de document et l'utiliser dans le PAGINATION
fetch('admin/fetcharticles') 
.then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error status: ${response.status}`);
    }
    return response.json();
})
.then(articles => {
    if (Array.isArray(articles)) {  
        const thead = [
            { title: "Editions", }, { title: "Actions", },
        ];

        const tableFragment = createTableFragment(articles);

        new PAGINATION({
            targetId: 'fnb-table',
            className: "pg--product-list",
            data: articles.sort(),
            thead,
            bodyListSchema: articles,
            limit: 20,
            navTopSelector: null,
            filters: [
                {
                    selector: "status",
                    label: "Statut",
                    data: [
                        { value: -1, label: "Tout", color: "#363740", selected: true },
                        { value: 1, label: "Désactivés", color: "#f0a61c", selected: false },
                        { value: 2, label: "activés", color: "#00aa4d", selected: false },
                        { value: 0, label: "Bloqués", color: "#ff0000", selected: false },
                    ],
                },
            ],
        });

        // Ajouter le fragment de document à tbody
        document.querySelector('tbody').appendChild(tableFragment);
    } else {
        console.error('Les données reçues ne sont pas un tableau:', data);
    }
})
.catch(error => {
    console.error('Erreur lors de la récupération des données depuis l\'API :', error);
});



/* 

import Dropdown from "./ui/dropdown.js";
import MODAL from "./ui/modal.js";
import PAGINATION from "./ui/pagination.js";


const baseUrl = window.location.origin;
function createTableFragment(data) {
    fetch(`${baseUrl}/admin/fetcharticles`) 
.then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error status: ${response.status}`);
    }
    return response.json();
})
.then(articles => {
    if (Array.isArray(articles)) {  

        const tableFragment = createTableFragment(articles);

        

    } else {
        console.error('Les données reçues ne sont pas un tableau:', data);
    }
})
.catch(error => {
    console.error('Erreur lors de la récupération des données depuis l\'API :', error);
});
    const thead = [
        { title: "Date", }, { title: "Titre", },{ title: "Actions", },
    ];

    const schema = item => {
        const id = item.id;
        const created_at = item.created_at;
        const title = item.title;
        const description = item.description;
        const date_pub = item.date_pub;
        const img = item.img;

        const fragment = document.createDocumentFragment();

        const TR = document.createElement("tr");
        TR.innerHTML = `
            <td>${created_at}</td>
            <td>${title}</td>
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
                                Modifier
                            
                        </button>
                    </li>
                    <li class="ui-dropdown__list-item">
                        <button class="ui-dropdown__list-item-btn" data-action="barcode-control">
                            <i class="icon-delete"></i>
                            
                            <a href="articles/delete/${id}" class="" title="Supprimer">
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
                    const editProduct = dropdown.querySelector('button[data-action="edit"]');
                    if (editProduct) {
                        const modalContent = () => {
                            const modalContent = document.createDocumentFragment();
                            const className = "modal-add-new-prod";
                            const formId = "edit-product-form";
                            const modalInner = document.createElement("div");
                            modalInner.classList = className;
                            modalInner.innerHTML = `
                                <div class="ui-modal__head">
                                    <h2 class="ui-modal__title">Modification de l'évènement de finab</h2>
                                </div>
                                <div class="ui-modal__body">
                                <form class="article-form fnb-form" method="post" enctype="multipart/form-data" action="articles/update/${id}">
                                    <div class="form-group">
                                        <label for="title">Titre de l'article</label>
                                        <input type="text" id="title" name="title" value="${title}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description de l'article</label>
                                        <textarea id="description" name="description" required>${description}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="publication-date">Date de publication</label>
                                        <input type="date" id="publication-date" value="${date_pub}" name="date_pub" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image actuelle</label><br>
                                        <img src="${img}" alt="Image actuelle"><br>
                                        <label for="new-image">Nouvelle image (optionnel)</label>
                                        <input type="file" id="new-image" name="new_img" value="">
                                    </div>
                                    <div class="form-group">
                                        
                                    </div>
                                    
                                    <div class="fnb-form__item fnb-form__item-action">
                                        <button type="submit" class="submit-button">Mettre à jour</button>
                                    </div>
                                </form>
                                </div>
                            `;

                            modalContent.appendChild(modalInner);
                            return modalContent;
                        };

                        editProduct.addEventListener("click", (e) => {
                            e.preventDefault();
                            const modal = new MODAL({
                                id: "modalNewProduct",
                                className: "wdg-modal--default",
                                modalContent: modalContent(),
                                width: "500px",
                            });
                        });
                    }
                },
            });

            menuBtn.addEventListener("click", (e) => {
                e.preventDefault();
                dropdown.create(e);
            });
        }

        TR.setAttribute("data-id", id);
        fragment.appendChild(TR); 
        return schema;
    };
    new PAGINATION({
        targetId: 'fnb-table',
        className: "pg--product-list",
        data: data,
        thead,
        bodyListSchema: schema,
        limit: 20,
        navTopSelector: null,
        filters: [
            {
                selector: "status",
                label: "Statut",
                data: [
                    { value: -1, label: "Tout", color: "#363740", selected: true },
                    { value: 1, label: "Désactivés", color: "#f0a61c", selected: false },
                    { value: 2, label: "activés", color: "#00aa4d", selected: false },
                    { value: 0, label: "Bloqués", color: "#ff0000", selected: false },
                ],
            },
        ],
    });
}




*/