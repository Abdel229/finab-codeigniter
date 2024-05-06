<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New article</title>
    <link rel="stylesheet" href="<?=base_url('styles/css/admin/dashboard.css')?>">
</head>
<body>
    <div class="container">
    <?=view('sections/sidebar')?>

<div class="content">
    <h1 class="content__title">Nouveau article</h1>
    <?=view('sections/error')?>
    <form class="article-form" method="post" enctype="multipart/form-data" action="<?=base_url('articles/store')?>">
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
        <button type="submit" class="submit-button">Créer l'article</button>
    </form>
    <!-- Le reste du contenu reste inchangé -->
</div>
</div>
    <script src="<?=base_url('js/admin.js')?>"></script>
</body>
</html>
