document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner le bouton de gestion des articles
    //var managementButton = document.querySelector('.sidebar__button--articles');
    // var managementMenuContainer = document.getElementById('management-menu-container');
    // var managementMenu = document.getElementById('management-menu');

    // Sélectionner les boutons de modification et de suppression
    // var editButtons = document.querySelectorAll('.article__action--edit');
    // var deleteButtons = document.querySelectorAll('.article__action--delete');

    // Ajouter un écouteur d'événements pour le clic sur le bouton de gestion des articles
    //managementButton.addEventListener('click', function() {
        // Afficher le conteneur du menu de gestion
        //managementMenuContainer.style.display = 'block';
    //});

    // Ajouter un écouteur d'événements pour cliquer en dehors du menu pour le cacher
    // window.addEventListener('click', function(event) {
    //     if (!managementButton.contains(event.target) &&!managementMenuContainer.contains(event.target)) {
    //         managementMenuContainer.style.display = 'none';
    //     }
    // });

    // Ajouter un écouteur d'événements pour les boutons de modification
    // editButtons.forEach(function(button) {
    //     button.addEventListener('click', function() {
    //         console.log('Modifier l\'article');
    //         // Ici, vous pouvez ajouter la logique pour modifier l'article
    //     });
    // });

    // Ajouter un écouteur d'événements pour les boutons de suppression
    // deleteButtons.forEach(function(button) {
    //     button.addEventListener('click', function() {
    //         console.log('Supprimer l\'article');
    //         // Ici, vous pouvez ajouter la logique pour supprimer l'article
    //     });
    // });

    //set profil dropdown
    const profilBtn = document.getElementById('profilBtn')
    const dropdownProfil = document.getElementById('dropdownProfil')
    if(profilBtn&&dropdownProfil){
        profilBtn.addEventListener('click', e=>{
            e.preventDefault()
            if(dropdownProfil.classList.contains('active')){
                dropdownProfil.classList.remove('active')
            }else{
                dropdownProfil.classList.add('active')
            }
        })
    }
});
