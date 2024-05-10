import Dropdown from "./ui/dropdown.js";
import MODAL from "./ui/modal.js";
import PAGINATION from "./ui/pagination.js";

// Fonction pour créer et retourner le fragment de document
function createTableFragment(data) {
    const fragment = document.createDocumentFragment();

    data.forEach(item => {
        const finabid = item.id;
        const name = item.name;

        const TR = document.createElement("tr");
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
                        <button class="ui-dropdown__list-item-btn" data-action="change-stock">
                            <i class="icon-plus-minus"></i>
                            <a href="/finab/edition" class="" title="Modifier">
                                Voir plus
                            </a>
                        </button>
                    </li>
                    <li class="ui-dropdown__list-item">
                        <button class="ui-dropdown__list-item-btn" data-action="edit">
                            <i class="icon-edit"></i>
                            Modifier
                        </button>
                    </li>
                    <li class="ui-dropdown__list-item">
                        <button class="ui-dropdown__list-item-btn" data-action="barcode-control">
                            <i class="icon-delete"></i>
                            Supprimer
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
                                    <form method="post" class="cpn-form" id="" enctype="multipart/form-data">
                                        Bientôt disponible
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

        TR.setAttribute("data-id", finabid);
        fragment.appendChild(TR); // Ajoutez la ligne de tableau au fragment de document
    });

    return fragment;
}

// Appel de la fonction pour créer le fragment de document et l'utiliser dans le PAGINATION
fetch('api/get_data') 
.then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error status: ${response.status}`);
    }
    return response.json();
})
.then(data => {
    if (Array.isArray(data)) {  
        const thead = [
            { title: "Editions", }, { title: "Actions", },
        ];

        const tableFragment = createTableFragment(data);

        // new PAGINATION({
        //     targetId: 'fnb-table',
        //     className: "pg--product-list",
        //     data: data.sort((a, b) => a.name.localeCompare(b.name)),
        //     thead,
        //     bodyListSchema: tableFragment,
        //     limit: 20,
        //     navTopSelector: null,
        //     filters: [
        //         {
        //             selector: "status",
        //             label: "Statut",
        //             data: [
        //                 { value: -1, label: "Tout", color: "#363740", selected: true },
        //                 { value: 1, label: "Désactivés", color: "#f0a61c", selected: false },
        //                 { value: 2, label: "activés", color: "#00aa4d", selected: false },
        //                 { value: 0, label: "Bloqués", color: "#ff0000", selected: false },
        //             ],
        //         },
        //     ],
        // });

        // Ajouter le fragment de document à tbody
        document.querySelector('tbody').appendChild(tableFragment);
    } else {
        console.error('Les données reçues ne sont pas un tableau:', data);
    }
})
.catch(error => {
    console.error('Erreur lors de la récupération des données depuis l\'API :', error);
});
