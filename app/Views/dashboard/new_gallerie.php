<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="<?= base_url('styles/css/icons.css') ?>">
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
                <div class="dashboard__main__title">
                    <i class="icon icon-gallery"></i>
                    <p>Nouvelle gallerie</p>
                </div>
                <div class="dashboard__main__box">
                    <form class="fnb-form" action="<?= base_url('galleries/store') ?>" method="post" enctype="multipart/form-data" class="form">
                        <div class="fnb-form__item">
                            <label for="category_id">Catégorie :</label>
                            <select name="category_id" id="category_id" class="form-input">
                                <option value="">Choisir une catégorie</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div id="fileInputs" class="file-inputs">
                            <div class="fileInput">
                                <input type="file" name="photos[]" required class="form-input">
                            </div>
                        </div>
                        <div class="fnb-form__item fnb-form__item-action">
                            <button type="button" id="addMore" class="submit-button">Plus</button>

                            <button type="submit" class="submit-button">Mettre à jour</button>
                        </div>

                    </form>
                </div>

            </div>

        </div>

        <script src="<?= base_url('js/admin.js') ?>"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const wrapper = document.querySelector('#fileInputs');
                const addBtn = document.querySelector('#addMore');
                let x = 1;

                addBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    wrapper.innerHTML += `
                        <div class="fileInput">
                            <input type="file" name="photos[]" required>
                            <button class="remove_field" data-index="${x}">Supprimer</button>
                        </div>`;
                    x++;
                });

                // Gérez l'événement click pour le wrapper
                wrapper.addEventListener('click', (e) => {
                    if (e.target.classList.contains('remove_field')) {
                        e.preventDefault();
                        e.target.parentElement.remove();
                        x--;
                    }
                });
            });
        </script>

</body>

</html>