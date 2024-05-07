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
                    <form class="article-form fnb-form" method="post" enctype="multipart/form-data" action="<?=base_url('articles/store')?>">
                        <div class="form-group">
                            <label for="title">Titre de l'article</label>
                            <input type="text" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description de l'article</label>
                            <textarea id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="publication-date">Date de publication</label>
                            <input type="date" id="publication-date" name="date_pub" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="img">
                        </div>
                        <div class="form-group">
                            <label for="category">Catégorie</label>
                            <select id="category" name="category" required>
                                <option value="">Sélectionnez une catégorie</option>
                                <?php foreach($categories as $category): ?>
                                <option value="<?=$category['name']?>"><?=$category['name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div id="links-container">
                                <!-- Les champs d'entrée pour les liens seront ajoutés ici -->
                            </div>
                            <button type="button" id="add-link">Ajouter un lien</button>
                            <button type="button" id="remove-link">Supprimer un lien</button>

                        </div>
                        <button type="submit" class="submit-button">Créer l'article</button>
                    </form>
                </div>
            <!-- Le reste du contenu reste inchangé -->
        </div>
    </div>
    <script src="<?=base_url('js/admin.js')?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const linksContainer = document.getElementById('links-container');
            const addLinkButton = document.getElementById('add-link');
            const removeLinkButton = document.getElementById('remove-link');

            let linkCounter = 1;

            addLinkButton.addEventListener('click', function() {
                const newInput = document.createElement('input');
                newInput.type = 'text';
                newInput.name = 'lien' + linkCounter;
                newInput.id = 'lien' + linkCounter;
                const newLabel = document.createElement('label');
                newLabel.htmlFor = 'lien' + linkCounter;
                newLabel.textContent = 'Lien ' + linkCounter;

                linksContainer.appendChild(newLabel);
                linksContainer.appendChild(newInput);
                linksContainer.appendChild(document.createElement('br'));

                linkCounter++;
            });

            removeLinkButton.addEventListener('click', function() {
                if (linkCounter > 1) {
                    linkCounter--;
                    const lastInput = document.getElementById('lien' + linkCounter);
                    const lastLabel = lastInput.previousSibling;
                    linksContainer.removeChild(lastInput);
                    linksContainer.removeChild(lastLabel);
                    linksContainer.removeChild(linksContainer.lastElementChild); // Remove <br>
                }
            });
        });

    </script>
</body>
</html>