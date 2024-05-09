<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New article</title>
    <link rel="stylesheet" href="<?=base_url('styles/css/icons.css')?>">
    <link rel="stylesheet" href="<?= base_url('styles/css/admin/dashboard.css') ?>">
</head>

<body>
    <div class="dashboard">
        <?= view('sections/sidebar') ?>
        <div class="dashboard__right">
            <nav class="dashboard__nav">
                <a href="#"><i class="icon icon-menu"></i></a>
                <div class="dashboard__nav__profil">
                    <a href="#" class="dashboard__nav__profilBtn" id="profilBtn">
                        <span><i class="icon icon-user"></i></span>
                    </a>
                    <ul class="dashboard__nav__dropdown" id="dropdownProfil">
                        <li>
                            <a href="<?= base_url('/auth/logout') ?>">
                                <i class="icon icon-logout"></i>
                                <span>Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="dashboard__main">
            <?= view('sections/error') ?>
                <div class="dashboard__main__title">
                    <i class="icon icon-plus"></i>
                    <p>Nouvelle catégorie</p>
                </div>

                <div class="dashboard__main__box">
                    <form class="fnb-form" method="post" enctype="multipart/form-data" action="<?= base_url('article_categorie/store/') ?>">
                        <div class="fnb-form__item">
                            <label for="title">Titre de la catégorie</label>
                            <input type="text" id="title" name="name" required>
                        </div>
                        <div class="fnb-form__item fnb-form__item-action">
                        <button type="submit" class="submit-button">Ajouter</button>

                        </div>
                    </form>
                    <!-- Le reste du contenu reste inchangé -->
                </div>
            </div>
        </div>
    </div>
    <?= view('partials/doc_admin_footer'); ?>

    <script src="<?= base_url('js/admin.js') ?>"></script>
    <script src="<?=base_url('js/ui/dropdown.js')?>"></script>
</body>

</html>