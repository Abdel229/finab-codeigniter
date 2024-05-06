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
    <title>Tableau de Bord des Articles</title>
    <link rel="stylesheet" href="<?=base_url('styles/css/admin/dashboard.css')?>">
</head>
<body>
    <div class="container">z
       <?=view('sections/sidebar')?>
        <div class="content">
            <div class="content__header">
            <h1 class="content__title">Tableau de Bord des Articles</h1>
                <a href="<?=base_url('articles/store')?>" class="content__button content__button--add">Ajouter un nouvel article</a>
            </div>
            <div class="article-list">
                <!-- Exemple d'article -->
                <?php foreach($articles as $article): ?>
                <div class="article">
                    <a href="<?=base_url('articles/show/'.$article['id'])?>" class="article__title"><?=$article['title']?></a>
                    <p class="article__description"><?=$article['description']?></p>
                    <div class="article__actions">
                        <a href="<?=base_url('articles/update/'.$article['id'])?>" class="article__action article__action--edit">Modifier</a>
                        <a href="<?=base_url('articles/delete/'.$article['id'])?>" class="article__action article__action--delete">Supprimer</a>
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
