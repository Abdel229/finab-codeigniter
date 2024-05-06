<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update article</title>
    <link rel="stylesheet" href="<?=base_url('styles/css/admin/dashboard.css')?>">
</head>
<body>
    <div class="container">
    <?=view('sections/sidebar')?>

<div class="content">
    <h1 class="content__title">Mise à jour de "<?=$article['title']?>"</h1>
    <?=view('sections/error')?>
    <form class="article-form" method="post" enctype="multipart/form-data" action="<?=base_url('articles/update/'.$article['id'])?>">
        <div class="form-group">
            <label for="title">Titre de l'article</label>
            <input type="text" id="title" name="title" value="<?=$article['title']?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description de l'article</label>
            <textarea id="description" name="description" required><?=$article['description']?></textarea>
        </div>
        <div class="form-group">
            <label for="publication-date">Date de publication</label>
            <input type="date" id="publication-date" value="<?=$article['date_pub']?>" name="date_pub" readonly>
        </div>
        <div class="form-group">
            <label for="image">Image actuelle</label><br>
            <img src="<?=base_url($article['img'])?>" alt="Image actuelle" ><br>
            <label for="new-image">Nouvelle image (optionnel)</label>
            <input type="file" id="new-image" name="new_img" value="">
        </div>
        <div class="form-group">
            <label for="category">Catégorie</label>
            <select id="category" name="category" required>
                <?php foreach($categories as $category): ?>
                <option value="<?=$category['name']?>" <?php echo ($category['id']===$article['category_id']) ? 'selected' : ''; ?>><?=$category['name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="submit-button">Metre à jour l'article</button>
    </form>

    <!-- Le reste du contenu reste inchangé -->
</div>
</div>
    <script src="<?=base_url('js/admin.js')?>"></script>
</body>
</html>