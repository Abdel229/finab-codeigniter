<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<form id="galleryForm" action="<?= base_url('gallery/showImagesByCategory') ?>" method="post" enctype="multipart/form-data">
    <h1>Galerie d'images</h1>
    
    <!-- Sélection des catégories -->
    <label for="category">Sélectionnez une catégorie :</label>
    <select name="category" id="category">
        <option value="">Toutes les catégories</option>
        <?php foreach ($categories as $categoryItem) : ?>
            <option value="<?= $categoryItem['name'] ?>"><?= $categoryItem['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <!-- Bouton de soumission -->
    <button type="submit">Afficher</button>
</form>

<!-- <script>
    document.getElementById('galleryForm').addEventListener('submit', function(event) {
        var selectedCategory = document.getElementById('category').value;
        // Ajouter un champ caché pour envoyer le nom de la catégorie avec la méthode POST
        var hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'category';
        hiddenInput.value = selectedCategory;
        this.appendChild(hiddenInput);
    });
</script> -->


</body>
</html>