import Dropdown from "./ui/dropdown.js";
import MODAL from "./ui/modal.js";
import PAGINATION from "./ui/pagination.js";

const baseUrl = window.location.origin;

// Fonction pour créer et retourner le fragment de document
function createTableFragment(data) {
    const fragment = document.createDocumentFragment();

    data.forEach(item => {
        const id = item.categories.id;
        const name = item.categories.name;
        const img = item.images.img;

        const TR = document.createElement("tr");
        TR.innerHTML = `
            <td>${name}</td>
            <td style=' width: 200px;'><img style=' width: 60px;height:60px;object-fit:cover' src="${baseUrl}/${img}" alt="Exemple" style="<?= $gallerie['category']['name'] ?>"></td>
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
                            <a href="${baseUrl}/galleries/update/${id}" class="fnb" title="MOdifier">
                                Modifier
                            </a>
                        </button>
                    </li>
                    <li class="ui-dropdown__list-item">
                        <button class="ui-dropdown__list-item-btn" data-action="barcode-control">
                            <i class="icon-delete"></i>
                            <a href="${baseUrl}/galleries/delete/${id}" class="" title="Supprimer">
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
                    // const editProduct = dropdown.querySelector('button[data-action="edit"]');
                    // if (editProduct) {
                    //     const modalContent = () => {
                    //         const modalContent = document.createDocumentFragment();
                    //         const className = "modal-add-new-prod";
                    //         const formId = "edit-product-form";
                    //         const modalInner = document.createElement("div");
                    //         modalInner.classList = className;
                    //         modalInner.innerHTML = `
                    //             <div class="ui-modal__head">
                    //                 <h2 class="ui-modal__title">Modification d'une Galerie</h2>
                    //             </div>
                    //             <div class="ui-modal__body">
                    //                 <form id="formId" class="article-form fnb-form" method="post" enctype="multipart/form-data">
                    //                     <div class="form-group">
                    //                         <label for="category_id">Catégorie :</label>
                    //                         <select name="category" id="category_id" class="form-input"></select>
                    //                     </div>
                    //                     <div class="form-group">
                    //                         <label for="new-image">Nouvelles images (optionnel)</label>
                    //                         <input type="file" id="new-image" name="new_img" value="">
                    //                     </div>
                    //                     <div style="display:grid;grid-template-columns:repeat(4,1fr);grid-gap:10px;" id="article-form_img">
                                            
                                            
                                            
                    //                     </div>
                    //                     <!-- Ajoutez d'autres champs du formulaire ici -->
                    //                     <div class="fnb-form__item fnb-form__item-action">
                    //                         <button type="submit" class="btn btn-submit">Mettre à jour</button>
                    //                     </div>
                    //                 </form>
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

                    //         // Remplissez les données dans le formulaire lorsque le modal est ouvert
                    //         fetch(`${baseUrl}galleries/update/${id}`)
                    //         .then(response => {
                    //             if (!response.ok) {
                    //                 throw new Error(`HTTP error status: ${response.status}`);
                    //             }
                    //             return response.json();
                    //         })
                    //         .then(formData => {
                    //             const form = document.getElementById('formId');
                    //             // Remplissez les champs du formulaire avec les données reçues
                    //             form.elements['category'].value = formData.category;
                    //             // Assurez-vous de charger les catégories dans le select
                    //             const categorySelect = form.elements['category'];
                    //             formData.categories.forEach(category => {
                    //                 const option = document.createElement('option');
                    //                 option.value = category.id; // Assurez-vous de définir la valeur sur l'ID de la catégorie
                    //                 option.textContent = category.name;
                    //                 // Vérifiez si la catégorie correspond à celle de la galerie actuelle et sélectionnez-la si nécessaire
                    //                 if (category.id === formData.category.id) {
                    //                     option.selected = true;
                    //                 }
                    //                 categorySelect.appendChild(option);
                    //             });
                                
                    //            // Récupérer la div où vous souhaitez afficher les images
                    //             const imageContainer = document.getElementById('article-form_img');

                    //             // Parcourir les galeries et ajouter les images à la div
                    //             formData.galleries.forEach(gallery => {
                    //                 // Créer un lien pour supprimer l'image (remplacez base_url avec la valeur appropriée)
                    //                 const deleteLink = document.createElement('a');
                    //                 deleteLink.href = `${baseUrl}galleries/delete_image/${gallery.id}`;
                    //                 deleteLink.style = "position:relative;";

                    //                 // Ajouter le bouton de suppression
                    //                 const deleteButton = document.createElement('div');
                    //                 deleteButton.dataset.index = "1";
                    //                 deleteButton.className = "remove_field";
                    //                 deleteButton.style = "display: flex; align-items: center; justify-content: center; width:fit-content; position:absolute; z-index:20; top:5px; right:10px; margin-left: 10px; padding: 5px; background-color: red; border-radius: 4px; cursor: pointer;";
                    //                 deleteButton.innerHTML = `<i class="icon icon-delete remove-field" data-index="1" style="background-color: rgb(255, 255, 255);"></i>`;

                    //                 // Ajouter l'image
                    //                 const image = document.createElement('img');
                    //                 image.src = `${baseUrl}${gallery.img}`;
                    //                 image.alt = "";
                    //                 image.style = "width:100px;height:100px;";

                    //                 // Ajouter le bouton de suppression et l'image au lien de suppression
                    //                 deleteLink.appendChild(deleteButton);
                    //                 deleteLink.appendChild(image);

                    //                 // Ajouter le lien de suppression à la div
                    //                 imageContainer.appendChild(deleteLink);
                    //             });

                    //         })
                    //         .catch(error => {
                    //             console.error('Erreur lors de la récupération des données du formulaire :', error);
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
fetch(`${baseUrl}/admin/galleries/fetchGalleriesAndCategories`) 
.then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error status: ${response.status}`);
    }
    return response.json();
})
.then(data => {
    if (Array.isArray(data.galleries)) {  
        const thead = [
            { title: "Nom", }, { title: "Images", },{ title: "Actions", },
        ];

        const tableFragment = createTableFragment(data.galleries);
        console.log(tableFragment);
        new PAGINATION({
            targetId: 'fnb-table',
            className: "pg--product-list",
            data: data.galleries,
            thead,
            bodyListSchema: tableFragment,
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
