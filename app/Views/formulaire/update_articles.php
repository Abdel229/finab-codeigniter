<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'articles</title>
</head>
<body>
    <form action="<?php echo base_url('/articles/store'); ?>" method="post" enctype="multipart/form-data">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title"><br>

        <!-- Champs de liens -->
        <?php for ($i = 1; $i <= 7; $i++) : ?>
            <label for="lien<?= $i ?>">Lien <?= $i ?></label>
            <input type="text" name="lien<?= $i ?>" id="lien<?= $i ?>"><br>
        <?php endfor; ?>

        <label for="img">Image</label>
        <input type="file" name="img" id="img"><br>

        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea><br>

        <label for="date_pub">Date de publication</label>
        <input type="date" name="date_pub" id="date_pub"><br>

        <label for="category">Catégorie</label>
        <select name="category" id="category">
            <option value="">Sélectionnez une catégorie</option>
            <?php foreach ($articlescategory as $category) : ?>
                <option value="<?= $category['name'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
