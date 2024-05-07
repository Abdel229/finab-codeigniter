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
            <h2>Mise à jour de la galerie</h2>
                
            <form action="<?= base_url('galleries/update/'.$category_single['id']) ?>" method="POST" enctype="multipart/form-data" class="form">
                <div class="form-group">
                    <label for="category_id">Catégorie :</label>
                    <select name="category" id="category_id" class="form-input">
                        <option value="">Choisir une catégorie</option>
                        <?php foreach ($categories as $category): ?>
                            <?php foreach ($galleries as $gallery): ?>
                                <option value="<?= $category['name'] ?>" <?= ($category['id'] == $gallery['category_id']) ? 'selected' : '' ?>><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div id="fileInputs" class="file-inputs">
                    <?php foreach ($galleries as $gallery): ?>
                        <div class="fileInput gallery-input"> <!-- Ajoutez la classe 'gallery-input' -->
                            <img src="<?= base_url($gallery['img']) ?>" alt="Image de la galerie" width='200'>
                            <div class="fileInput"><input type="file" name="photos[]" ></div>
                        </div>
                    <?php endforeach; ?>
                    <div class="fileInput">
                        
                    </div>
                </div>

                <button type="button" id="addMore" class="btn btn-add">Ajouter plus de photos</button>
                <button type="button" id="removeMore" class="btn btn-add">Diminuer plus de photos</button>

                <button type="submit" class="btn btn-submit">Mettre à jour la galerie</button>
            </form>
        </div>
    </div>
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
                const inputs = wrapper.querySelectorAll('.fileInput');
                if (inputs.length > 1) { 
                    const lastInput = inputs[inputs.length - 1];
                    if (!lastInput.classList.contains('gallery-input')) { // Vérifie si ce n'est pas un input généré par PHP
                        lastInput.remove(); // Supprime la dernière entrée
                    }
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