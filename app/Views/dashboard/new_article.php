<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New article</title>
    <link rel="stylesheet" href="<?=base_url('styles/css/icons.css')?>">
    <link rel="stylesheet" href="<?=base_url('styles/css/admin/dashboard.css')?>">
</head>
<body>
    <div class="dashboard">
        <?=view('sections/sidebar')?>

        <div class="dashboard__right">
            <nav class="dashboard__nav">
                <a href="#"><i class="icon icon-menu"></i></a>
                <div class="dashboard__nav__profil">
                    <a href="#" class="dashboard__nav__profilBtn" id="profilBtn">
                        <span><i class="icon icon-user"></i></span>
                    </a>
                    <ul class="dashboard__nav__dropdown" id="dropdownProfil">
                        <li>
                            <a href="<?=base_url('/auth/logout')?>">
                                <i class="icon icon-logout"></i>
                                <span>Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="dashboard__main">
                <div class="dashboard__main__title">
                    <i class="icon icon-plus"></i>
                    <p>Nouveau article</p>
                </div>
                <div class="dashboard__main__box">
                    <?=view('sections/error')?>
                    <form class="fnb-form" method="post" enctype="multipart/form-data" action="<?=base_url('articles/store')?>">
                        <div class="fnb-form__item">
                            <label for="title">Titre de l'article</label>
                            <input type="text" id="title" name="title" required>
                        </div>
                        <div class="fnb-form__item">
                            <label for="description">Description de l'article</label>
                            <textarea id="description" name="description" required></textarea>
                        </div>
                        <div class="fnb-form__item">
                            <label for="publication-date">Date de publication</label>
                            <input type="date" id="publication-date" name="date_pub" required>
                        </div>
                        <div class="fnb-form__item">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="img">
                        </div>
                        <div class="fnb-form__item">
                            <label for="category">Catégorie</label>
                            <select id="category" name="category" required>
                                <option value="">Sélectionnez une catégorie</option>
                                <?php foreach($categories as $category): ?>
                                <option value="<?=$category['name']?>"><?=$category['name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="fnb-form__item">
                            <div id="links-container">
                                <!-- Les champs d'entrée pour les liens seront ajoutés ici -->
                            </div>

                        </div>
                        <div class="fnb-form__item fnb-form__item-action">
                            <button type="submit" class="submit-button">Créer l'article</button>
                        </div>
                    </form>
                </div>
            <!-- Le reste du contenu reste inchangé -->
        </div>
    </div>
    <script src="<?=base_url('js/admin.js')?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const linksContainer = document.getElementById('links-container');

            let linkCounter = 1;

            function addLink() {
                const newInput = document.createElement('input');
                newInput.type = 'text';
                newInput.name = 'lien' + linkCounter;
                newInput.id = 'lien' + linkCounter;
                const newLabel = document.createElement('label');
                newLabel.htmlFor = 'lien' + linkCounter;
                newLabel.textContent = 'Lien ' + linkCounter;

                const removeLinkButton = document.createElement('button');
                removeLinkButton.type = 'button';
                removeLinkButton.textContent = 'Supprimer ce lien';
                removeLinkButton.addEventListener('click', function() {
                    linksContainer.removeChild(newInput);
                    linksContainer.removeChild(newLabel);
                    linksContainer.removeChild(removeLinkButton);
                });

                linksContainer.appendChild(newLabel);
                linksContainer.appendChild(newInput);
                linksContainer.appendChild(removeLinkButton);

                linkCounter++;
            }
            const addLinkButton = document.createElement('button');
            addLinkButton.type = 'button';
            addLinkButton.textContent = 'Ajouter un lien';
            addLinkButton.addEventListener('click', addLink);
            linksContainer.appendChild(addLinkButton);
        });
    </script>
</body>
</html>