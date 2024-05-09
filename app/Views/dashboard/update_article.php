<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update article</title>
    <link rel="stylesheet" href="<?=base_url('styles/css/icons.css')?>">
    <link rel="stylesheet" href="<?= base_url('styles/css/admin/dashboard.css') ?>">
</head>

<body>
    <div class="dashboard">
        <?= view('sections/sidebar') ?>

        <div class="dashboard__right">
            <nav class="dashboard__nav">
                <a href="#"><i class="icon icon-menu"></i></a>
                <div class="dashboard__nav__profil">
                    <a href="#" class="dashboard__nav__profilBtn" id="profilBtn">
                        <span><i class="icon icon-user"></i></span>
                    </a>
                    <ul class="dashboard__nav__dropdown" id="dropdownProfil">
                        <li>
                            <a href="<?= base_url('/auth/logout') ?>">
                                <i class="icon icon-logout"></i>
                                <span>Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="dashboard__main">
            <?= view('sections/error') ?>
       
            <div class="dashboard__main__title">
                    <i class="icon icon-plus"></i>
                    <p>Mise à jour de "<?= $article['title'] ?>"</p>
                </div>

                <div class="dashboard__main__box">
                    <?= view('sections/error') ?>
                    <form class="article-form fnb-form" method="post" enctype="multipart/form-data" action="<?= base_url('articles/update/' . $article['id']) ?>">
                        <div class="form-group">
                            <label for="title">Titre de l'article</label>
                            <input type="text" id="title" name="title" value="<?= $article['title'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description de l'article</label>
                            <textarea id="description" name="description" required><?= $article['description'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="publication-date">Date de publication</label>
                            <input type="date" id="publication-date" value="<?= $article['date_pub'] ?>" name="date_pub" readonly>
                        </div>
                        <div class="form-group">
                            <label for="image">Image actuelle</label><br>
                            <img src="<?= base_url($article['img']) ?>" alt="Image actuelle"><br>
                            <label for="new-image">Nouvelle image (optionnel)</label>
                            <input type="file" id="new-image" name="new_img" value="">
                        </div>
                        <div class="form-group">
                            <label for="category">Catégorie</label>
                            <select id="category" name="category" required>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['name'] ?>" <?php echo ($category['id'] === $article['category_id']) ? 'selected' : ''; ?>><?= $category['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div id="links-container">
                                <!-- Les champs d'entrée pour les liens seront ajoutés ici -->

                                <?php
                                    $id=1;
                                foreach($links as $link): ?>
                                    <input type="text" name="lien<?=$id ?>" value="<?= $link['link'] ?>" required><br>
                                    
                                <?php $id++; endforeach ?>
                            </div>
                        </div>
                        <div class="fnb-form__item fnb-form__item-action">
                            <button type="submit" class="submit-button">Mettre à jour</button>
                        </div>
                    </form>

                    <!-- Le reste du contenu reste inchangé -->
                </div>
            </div>
        </div>
    </div>    
    <?= view('partials/doc_admin_footer'); ?>

    <script src="<?= base_url('js/admin.js') ?>"></script>
    <script src="<?=base_url('js/ui/dropdown.js')?>"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const linksContainer = document.getElementById('links-container');

            let linkCounter =  <?= $id ?>;

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

            const textNode = document.createTextNode('Ajouter un lien');
            addLinkButton.appendChild(textNode);

            addLinkButton.addEventListener('click', addLink);
            linksContainer.appendChild(addLinkButton);
        });
    </script>
</body>

</html>