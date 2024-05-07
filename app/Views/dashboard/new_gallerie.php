<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="<?= base_url('styles/css/admin/dashboard.css') ?>">
</head>

<body>
    <div class="container">
        <?= view('sections/sidebar') ?>

        <div class="content">
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

                <button type="button" id="addMore" class="btn btn-add">Ajouter plus de photos</button>
                <button type="button" id="removeMore" class="btn btn-add">Diminuer plus de photos</button>

                <button type="submit" class="btn btn-submit">Ajouter la galerie</button>
            </form>

            <script src="<?= base_url('js/admin.js') ?>"></script>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const wrapper = document.querySelector('#fileInputs');
                    const addBtn = document.querySelector('#addMore');
                    const removeBtn = document.querySelector('#removeMore');

                    addBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        wrapper.innerHTML += '<div class="fileInput"><input type="file" name="photos[]" required></div>';
                    });

                    removeBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        if (wrapper.children.length > 1) { // Assure qu'il y a au moins une entrée
                            wrapper.removeChild(wrapper.lastElementChild); // Supprime la dernière entrée
                        }
                    });

                    wrapper.addEventListener('click', (e) => {
                        if (e.target.classList.contains('remove_field')) {
                            e.preventDefault();
                            e.target.parentElement.remove();
                        }
                    });
                });
            </script>

</body>

</html>