import MODAL from "./libs/modal.js"

/**
 * Confirmation avant suppression
 */

let deleteButtons = document.querySelectorAll('.btn-delete');

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
deleteButtons.forEach(function (button) {
    button.addEventListener('click', function (event) {
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
        actions(button)
    });
});

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



/**
 * Gestion d'erreur
 */

let alerts = document.querySelectorAll('.alert-corner');
for (let i = 0; i < alerts.length; i++) {
    setTimeout(function () {
        var element = alerts[i];
        element.classList.add('alert-corner--hide');
    }, 2500 + i * 250);
}

/**
 * Create and update gallery
 * Manage image
 */
document.addEventListener('DOMContentLoaded', () => {
    const imgContainer = document.querySelector('#img-upload-container');
    let existingImages
    if(imgContainer){
         existingImages = JSON.parse(imgContainer.getAttribute('data-galleries'));
    }
    const addBtn = document.querySelector('#addMore');
    const inputImg = document.querySelector('.galery-img-input');
    const loader = document.querySelector('#loader');
    const host = window.location.origin;
    let timeout;
    let removedImages = [];
    if (existingImages) {
        for (let i = 0; i < existingImages.length; i++) {
            let img = document.createElement('a');
            let div = document.createElement('div');
            let imgEl = document.createElement('img');
            img.setAttribute('href', '#');
            img.setAttribute('style', 'position:relative;');
            div.setAttribute('data-index', existingImages[i].id);
            div.setAttribute('style', 'display: flex; align-items: center; justify-content: center;width:fit-content;position:absolute;z-index:20;top:5px;right:10px; margin-left: 10px; padding: 5px; background-color: red; border-radius: 4px; cursor: pointer;');
            imgEl.setAttribute('src', host + '/' + existingImages[i].img);
            imgEl.setAttribute('style', 'width:100px;height:100px;');
            let removeBtn = document.createElement('i');
            removeBtn.setAttribute('class', 'icon icon-delete remove-existing-field');
            removeBtn.setAttribute('data-index', existingImages[i].id);
            removeBtn.setAttribute('style', 'background-color: rgb(255, 255, 255);');

            div.appendChild(removeBtn);
            img.appendChild(div);
            img.appendChild(imgEl);
            imgContainer.appendChild(img);
        }
    }
    if(addBtn){
        addBtn.addEventListener('click', (e) => {
            inputImg.click();
        });
    }


    inputImg.addEventListener('change', (e) => {
        if (inputImg.files.length > 0) {
            showLoader();

            const imagesLoaded = new Promise((resolve) => {
                const images = Array.from(inputImg.files).map((file) => {
                    return new Promise((resolve, reject) => {
                        const img = new Image();
                        img.onload = () => resolve(img);
                        img.onerror = () => reject(new Error('Image failed to load'));
                        img.src = URL.createObjectURL(file);
                    });
                });

                Promise.all(images)
                    .then(() => {
                        resolve();
                    })
                    .catch(() => {
                        resolve();
                    });
            });
            imagesLoaded.then(() => {
                for (let i = 0; i < inputImg.files.length; i++) {
                    let img = document.createElement('a');
                    let index = i + 1;
                    let div = document.createElement('div');
                    let imgEl = document.createElement('img');

                    img.setAttribute('href', '#');
                    img.setAttribute('style', 'position:relative;');
                    div.setAttribute('data-index', index);
                    div.setAttribute('style', 'display: flex; align-items: center; justify-content: center;width:fit-content;position:absolute;z-index:20;top:5px;right:10px; margin-left: 10px; padding: 5px; background-color: red; border-radius: 4px; cursor: pointer;');
                    imgEl.setAttribute('src', URL.createObjectURL(inputImg.files[i]));
                    imgEl.setAttribute('style', 'width:100px;height:100px;');

                    let removeBtn = document.createElement('i');
                    removeBtn.setAttribute('class', 'icon icon-delete remove-field');
                    removeBtn.setAttribute('data-index', index);
                    removeBtn.setAttribute('style', 'background-color: rgb(255, 255, 255);');

                    div.appendChild(removeBtn);
                    img.appendChild(div);
                    img.appendChild(imgEl);
                    imgContainer.appendChild(img);
                }
                hideLoader();
            });
        } else {
            hideLoader();
        }
    });

    imgContainer.addEventListener('click', (e) => {
        e.preventDefault()
        if (e.target.classList.contains('remove-field')) {
            let imgParent = e.target.parentElement.parentElement;
            let index = e.target.getAttribute('data-index');
            imgContainer.removeChild(imgParent);
            inputImg.deleteFile(index - 1);
            // Ajouter l'image supprimée au tableau
            removedImages.push(existingImages[index - 1].img);
            // Mettre à jour l'élément d'entrée caché
            updateRemovedImagesInput();
        }
        else if (e.target.classList.contains('remove-existing-field')) {
            let imgParent = e.target.parentElement.parentElement;
            let indexImg = e.target.getAttribute('data-index');
            imgContainer.removeChild(imgParent);
            existingImages.filter(element => element.id !== indexImg);
            // Ajouter l'image supprimée au tableau
            removedImages.push(indexImg);
            // Mettre à jour l'élément d'entrée caché
            updateRemovedImagesInput();
        }
    });
    function updateRemovedImagesInput() {
        const removedImagesInput = document.querySelector('#removedImagesInput');
        removedImagesInput.value = JSON.stringify(removedImages);
    }
    function showLoader() {
        loader.style.display = 'block';
    }

    function hideLoader() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            loader.style.display = 'none';
        }, 250);
    }
});



/**
 * Gestion de gallerie
 */
// $(document).ready(function(){
//     const container = document.querySelector('.gallerie__list');
//     console.log(container)
//     const principalesImg = document.querySelectorAll('.principal_gallery_img');
//     let fancyName;
//     let imagesData
//     principalesImg.forEach((principale, index) => {
//         principale.addEventListener('click', (e) => {
//             e.preventDefault();
//             console.log(principale.getAttribute('data-galleries'))
//             imagesData = JSON.parse(principale.getAttribute('data-galleries'));
//             fancyName = principale.getAttribute('data-fancybox');
//             console.log('====================================');
//             console.log(typeof(imagesData));
//             console.log('====================================');
//             displayImgs(imagesData, fancyName);
//         });
//     });

//     function displayImgs(galleriesData, fancyName) {
//         for (const key in galleriesData) {
//             if (galleriesData.hasOwnProperty(key)) { // Vérifie que la propriété appartient à l'objet et non à sa chaîne prototype
//                 const gallery = galleriesData[key];
//                 const link = document.createElement('a');
//                 link.href = gallery.image;
//                 link.classList.add('distinction__item');
//                 link.setAttribute('data-fancybox', fancyName);
//                 link.style.display ='none';
//                 const img = document.createElement('img');
//                 img.src = gallery.image;
//                 img.alt = 'distinction_img';
//                 link.appendChild(img);
//                 container.appendChild(link);
//             }
//         }
//     }
//     $(`[data-fancybox=${fancyName}]`).fancybox({});

// });


/**
 * Gallerie filter
 */
document.addEventListener('DOMContentLoaded', function() {
    let select = document.querySelector('#programmeSearch');
    select.addEventListener('change', function(event) {
        // Vérifie si l'événement provient d'un changement d'option
        if (event.target.tagName.toLowerCase() === 'select') {
            // Obtient l'option sélectionnée
            let selectedOption = event.target.options[event.target.selectedIndex];
            // Vérifie si l'option a un attribut 'data-href'
            if (selectedOption.hasAttribute('data-href')) {
                window.location.href = selectedOption.getAttribute('data-href');
            }
        }
    });
});

/**
 * Article link
 */
