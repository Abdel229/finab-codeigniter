<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord des Articles</title>
    <link rel="stylesheet" href="<?=base_url('styles/css/admin/dashboard.css')?>">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2 class="sidebar__title">Navigation</h2>
            <div class="sidebar__menu">
                <button class="sidebar__button sidebar__button--articles">Gestion des articles</button>
                <button class="sidebar__button sidebar__button--actualites">Gestion des actualités</button>
                <button class="sidebar__button sidebar__button--galeries">Gestion des galeries</button>
                <button class="sidebar__button sidebar__button--categories">Gestion des catégories</button>
            </div>
        </div>
        <div class="content">
            <h1 class="content__title">Tableau de Bord des Articles</h1>
            <div class="article-list">
                <!-- Exemple d'article -->
                <div class="article">
                    <h2 class="article__title">Titre de l'article</h2>
                    <p class="article__description">Description de l'article...</p>
                    <div class="article__actions">
                        <button class="article__action article__action--edit">Modifier</button>
                        <button class="article__action article__action--delete">Supprimer</button>
                    </div>
                </div>
                <div class="article">
                    <h2 class="article__title">Titre de l'article</h2>
                    <p class="article__description">Description de l'article...</p>
                    <div class="article__actions">
                        <button class="article__action article__action--edit">Modifier</button>
                        <button class="article__action article__action--delete">Supprimer</button>
                    </div>
                </div>
                <div class="article">
                    <h2 class="article__title">Titre de l'article</h2>
                    <p class="article__description">Description de l'article...</p>
                    <div class="article__actions">
                        <button class="article__action article__action--edit">Modifier</button>
                        <button class="article__action article__action--delete">Supprimer</button>
                    </div>
                </div>
                <!-- Plus d'articles peuvent être ajoutés ici -->
            </div>
            <!-- Le reste du contenu reste inchangé -->
        </div>
    </div>
    <script src="<?=base_url('js/admin.js')?>"></script>
</body>
</html>
