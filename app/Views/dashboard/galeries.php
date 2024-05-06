<?php
$session = \Config\Services::session();
if (!$session->get('user_id')) {
    header("Location:auth/login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="<?=base_url('styles/css/admin/dashboard.css')?>">
</head>
<body>
    <div class="container">
       <?=view('sections/sidebar')?>
        <div class="content">
            <div class="content__header">
            <h1 class="content__title">Tableau de Bord des galeries</h1>
                <a href="<?=base_url('galleries/store')?>" class="content__button content__button--add">Ajouter une nouvelle gallerie</a>
            </div>
            <div class="article-list">
                <!-- Exemple d'article -->
                <?php foreach($galeriesCategory as $galerieCategory): ?>
                <div class="article">
                    <a href="<?=base_url('article_categorie/edit/'.$galerieCategory['id'])?>" class="article__title"><?=$galerieCategory['name']?></a>
                    <div class="article__actions">
                        <a href="<?=base_url('galleries_category/update/'.$galerieCategory['id'])?>" class="article__action article__action--edit">Modifier</a>
                        <a href="<?=base_url('galleries_category/delete/'.$galerieCategory['id'])?>" class="article__action article__action--delete">Supprimer</a>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- Plus d'articles peuvent être ajoutés ici -->
            </div>
            <!-- Le reste du contenu reste inchangé -->
        </div>
    </div>
    <script src="<?=base_url('js/admin.js')?>"></script>
</body>
</html>
