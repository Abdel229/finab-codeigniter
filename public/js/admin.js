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
   
   
    // var mainMenuLinks = document.querySelectorAll('.aside__bottom__item__link');
    // mainMenuLinks.forEach(function(link) {
    //     link.addEventListener('click', function(e) {
    //         e.preventDefault();
    //         var menuItem = this.parentNode;
    //         toggleSubMenu(menuItem);
    //     });
    // });

    // var submenuLinks = document.querySelectorAll('.submenu-item-link');
    // submenuLinks.forEach(function(link) {
    //     link.addEventListener('click', function(e) {
    //         e.preventDefault();
    //         var submenuItem = this.closest('.submenu-item'); // Utilisation de closest pour trouver le parent .submenu-item
    //         toggleSubSubMenu(submenuItem);
    //     });
    // });

    // function toggleSubMenu(menuItem) {
    //     var isActive = menuItem.classList.contains('active');
    //     closeAllSubMenus();
    //     if (!isActive) {
    //         menuItem.classList.add('active');
    //     } else {
    //         menuItem.classList.remove('active');
    //     }
    // }

    // function toggleSubSubMenu(submenuItem) {
    //     var isActive = submenuItem.querySelector('.sub-submenu').classList.contains('active');
    //     closeAllSubMenus();
    //     if (!isActive) {
    //         submenuItem.querySelector('.sub-submenu').classList.add('active');
    //     } else {
    //         submenuItem.querySelector('.sub-submenu').classList.remove('active');
    //     }
    // }

    // function closeAllSubMenus() {
    //     var menuItems = document.querySelectorAll('.aside__bottom__item, .submenu-item');
    //     menuItems.forEach(function(item) {
    //         item.classList.remove('active');
    //     });
    //     var subSubMenus = document.querySelectorAll('.sub-submenu');
    //     subSubMenus.forEach(function(submenu) {
    //         submenu.classList.remove('active');
    //     });
    // }

        
    const menuLinks = document.querySelectorAll('.cpn-pg-menu__item-link');

    // Retirez la classe "active" de tous les liens
    menuLinks.forEach(function(link) {
        link.classList.remove('active');
    });

    // Parcourez chaque lien et ajoutez un gestionnaire d'événements de clic
    menuLinks.forEach(function(link) {
        // Obtenez l'URL du lien
        const linkURL = link.getAttribute('href');

        // Comparez l'URL du lien avec l'URL actuelle
        if (window.location.href.includes(linkURL)) {
            // Si l'URL actuelle contient l'URL du lien, ajoutez la classe active
            link.classList.add('active');

            // Laissez le comportement par défaut s'appliquer uniquement aux liens actifs
        } else {
            // Empêchez le comportement par défaut des liens inactifs
            link.addEventListener('click', function(event) {
                event.preventDefault();
                
                // Redirigez vers l'URL du lien
                window.location.href = linkURL;
            });
        }
    });
        
        
   // Obtenez tous les éléments avec la classe btn_new_event_finab
// const openModalBtns = document.querySelectorAll('.modal');

// // Obtenez l'élément modal
// const modal = document.getElementById("myModal");

// // Obtenez l'élément de la croix pour fermer le modal
// const closeModalSpan = document.querySelector(".close");

// // Ajoutez un gestionnaire d'événements à chaque bouton pour ouvrir le modal
// openModalBtns.forEach(function(btn) {
//     btn.addEventListener("click", function() {
//         modal.style.zIndex = 5;
//     });
// });

// // Lorsque l'utilisateur clique sur la croix, fermez le modal
// closeModalSpan.addEventListener("click", function() {
//     modal.style.zIndex = 1;
// });

// // Lorsque l'utilisateur clique en dehors du modal, fermez-le
// window.addEventListener("click", function(event) {
//     if (event.target === modal) {
//         modal.style.zIndex = 1;
//     }
// });


// Sélectionnez tous les éléments de la liste des détails Finab
const finabDetailsItems = document.querySelectorAll('.finab_details_list_item');

// Parcourez chaque élément de la liste
finabDetailsItems.forEach(function(item) {
    // Ajoutez un gestionnaire d'événements 'click' à chaque élément
    item.addEventListener('click', function(event) {
        // Empêchez le comportement de lien par défaut
        event.preventDefault();

        // Supprimez la classe 'active' de tous les éléments de la liste
        finabDetailsItems.forEach(function(item) {
            item.classList.remove('active');
        });

        // Ajoutez la classe 'active' à l'élément cliqué
        item.classList.add('active');
    });
});

    
    const thead = [{ title: "Editions", }, { title: "Actions", },];
    
    
    
});
