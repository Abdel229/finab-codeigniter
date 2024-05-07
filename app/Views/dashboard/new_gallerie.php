<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="<?= base_url('styles/css/admin/dashboard.css') ?>">
</head>

<body>
    <div class="dashboard">
        <?= view('sections/sidebar') ?>

        <div class="content">
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
            <h2>Nouvelle galerie</h2>

            <form action="<?=base_url('galleries/store')?>" method="post" enctype="multipart/form-data" class="form">
                <div class="form-group">
                    <label for="category_id">Catégorie :</label>
                    <select name="category_id" id="category_id" class="form-input">
                        <option value="">Choisir une catégorie</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div id="fileInputs" class="file-inputs">
                    <div class="fileInput">
                        <input type="file" name="photos[]" required class="form-input">
                    </div>
                </div>

                <button type="button" id="addMore" class="btn btn-add">Plus</button>

                <button type="submit" class="btn btn-submit">Mettre à jour</button>
            </form>

            <script src="<?= base_url('js/admin.js') ?>"></script>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const maxInputs = 10; // Maximum number of inputs
                    const wrapper = document.querySelector('#fileInputs');
                    const addBtn = document.querySelector('#addMore');
                    let x = 1;
                    let fieldCount = 1;

                    addBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        if (x < maxInputs) {
                            x++;
                            wrapper.innerHTML += '<div class="fileInput"><input type="file" name="photos[]" required></div>';
                        }
                    });

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