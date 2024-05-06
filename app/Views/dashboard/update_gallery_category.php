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
    <form class="article-form" method="post" enctype="multipart/form-data" action="<?=base_url('galleries_category/update/'.$category['id'])?>">
        <div class="form-group">
            <label for="title">Titre de l'article</label>
            <input type="text" id="title" name="name" value="<?=$category['name']?>" required>
        </div>
        <button type="submit" class="submit-button">Mettre à jour la catégorie</button>
    </form>
    <!-- Le reste du contenu reste inchangé -->
</div>
</div>
    <script src="<?=base_url('js/admin.js')?>"></script>
</body>
</html>
