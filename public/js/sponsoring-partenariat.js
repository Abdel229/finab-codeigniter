document.addEventListener('DOMContentLoaded', function() {
    const linksContainer = document.getElementById('links-container');

    let linkCounter = 1;

    function addLink() {
        // conteneur du lien et du bouton delete
        const divContainer=document.createElement('div');
        divContainer.style="display:flex;"
        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'lien' + linkCounter;
        newInput.id = 'lien' + linkCounter;
        const newLabel = document.createElement('label');
        newLabel.htmlFor = 'lien' + linkCounter;
        newLabel.textContent = 'Lien ' + linkCounter;

        const removeLinkButton = document.createElement('i');
        removeLinkButton.classList.add('icon', 'icon-delete');
        removeLinkButton.style='margin-left:10px;cursor:pointer;background-color:red;'
        removeLinkButton.addEventListener('click', function() {
        linksContainer.removeChild(newLabel);
            linksContainer.removeChild(divContainer);
        });
        
        linksContainer.appendChild(newLabel);
        divContainer.appendChild(newInput);
        divContainer.appendChild(removeLinkButton);
        linksContainer.appendChild(divContainer);
        linkCounter++;
    }
    const addLinkButton = document.createElement('button');
    addLinkButton.type = 'button';
    addLinkButton.style='display:flex;align-items:center;justify-content:center;background-color:#D67608;border:none;padding:6px 20px;border-radius:8px;color:#fff;cursor:pointer;'

    const icon = document.createElement('i');
    icon.classList.add('icon');
    icon.classList.add('icon-plus');
    icon.style='margin-right:8px;background-color:#fff;'
    addLinkButton.appendChild(icon);

    const textNode = document.createTextNode('Ajouter un lien (facultatif)');
    addLinkButton.appendChild(textNode);

    addLinkButton.addEventListener('click', addLink);
    linksContainer.appendChild(addLinkButton);
});



/**
 * Add images
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
    console.log(existingImages)
    if (existingImages) {
        for (let i = 0; i < existingImages.length; i++) {
            let img = document.createElement('a');
            let div = document.createElement('div');
            let imgEl = document.createElement('img');
            img.setAttribute('href', '#');
            img.setAttribute('style', 'position:relative;');
            div.setAttribute('data-index', existingImages[i].id);
            div.setAttribute('style', 'display: flex; align-items: center; justify-content: center;width:fit-content;position:absolute;z-index:20;top:5px;right:10px; margin-left: 10px; padding: 5px; background-color: red; border-radius: 4px; cursor: pointer;');
            imgEl.setAttribute('src', host + '/' + existingImages[i].images);
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