/**
 * Confirmation avant suppression
 */
let deleteButtons = document.querySelectorAll('.btn-delete');

// pour chaque bouton de suppression, bloquer sa action par défaut
deleteButtons.forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();

        // récupérer le lien dans l'attribut href
        var link = this.getAttribute('href');

        // afficher une modale de confirmation de suppression
        var modal = confirm('Voulez-vous vraiment supprimer ?');
        if (modal) {
            // si oui, lancer le lien
            window.location.href = link;
        }
    });
});


/**
 * Gestion d'erreur
 */

let alerts = document.querySelectorAll('.alert-corner');
for (let i = 0; i < alerts.length; i++) {
    setTimeout(function() {
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
    const galleries = JSON.parse(imgContainer.getAttribute('data-galleries'));
    const addBtn = document.querySelector('#addMore');
    const inputImg = document.querySelector('.galery-img-input');
    const loader = document.querySelector('#loader');
    const host=window.location.hostname
    let timeout;

    if (galleries) {

        galleries.forEach((file) => {
            let img = document.createElement('img');
            img.src = host + file.img;
            img.style.width = '100px';
            img.style.height = '100px';
            imgContainer.appendChild(img);
        });
    }
    
    addBtn.addEventListener('click', (e) => {
        inputImg.click();
    });

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
        if (e.target.classList.contains('remove-field')) {
            let imgParent = e.target.parentElement.parentElement;
            let index = e.target.getAttribute('data-index');
            imgContainer.removeChild(imgParent);
            inputImg.deleteFile(index - 1);
        }
    });

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