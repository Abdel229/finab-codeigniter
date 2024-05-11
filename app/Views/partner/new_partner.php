<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New partner</title>
    <link rel="stylesheet" href="<?=base_url('styles/css/icons.css')?>">
    <link rel="stylesheet" href="<?=base_url('styles/css/admin/dashboard.css')?>">
</head>
<body>
    <div class="dashboard">
        <?=view('sections/sidebar')?>

        <div class="dashboard__right">
            <nav class="dashboard__nav">
                <a href="#"><i class="icon icon-menu"></i></a>
                <div class="dashboard__nav__profil">
                    <a href="#" class="dashboard__nav__profilBtn" id="profilBtn">
                        <span><i class="icon icon-user"></i></span>
                    </a>
                    <ul class="dashboard__nav__dropdown" id="dropdownProfil">
                        <li>
                            <a href="<?=base_url('/auth/logout')?>">
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
                    <p>Nouveau patenaire</p>
                </div>
                <div class="dashboard__main__box">
                    <?=view('sections/error')?>
                    <form class="fnb-form idform" id="idform" method="post" enctype="multipart/form-data" action="<?=base_url('partner/store')?>" >
                        <div class="fnb-form__item">
                            <label for="name">Nom</label>
                            <input type="text" id="name" name="titre" required>
                        </div>
                        <div class="fnb-form__item">
                            <label for="lien">Lien (optionnel)</label>
                            <input type="link" id="lien" name="lien" required>
                        </div>
                        <div class="fnb-form__item cpn-form__row">
                            <label for="image">Image</label>
                            
                            <div class="cpn-form__row">
                                <input type="file" class="cpn-field" name="img" id="productImgFiled" data-preview-file="true"  accept="image/*">
                                <label for="productImgFiled" class="cpn-form__label"></label>
                            </div>
                        </div>
                        <div class="fnb-form__item fnb-form__item-action">
                            <button type="submit" class="submit-button">Ajouter</button>
                        </div>
                    </form>
                </div>
            <!-- Le reste du contenu reste inchangé -->
        </div>
    </div>
    <?= view('partials/doc_admin_footer'); ?>
    <script src="<?=base_url('js/ui/dropdown.js')?>" type="module"></script>
    <script src="<?=base_url('js/ui/modal.js')?>" type="module"></script>
    <script src="<?=base_url('js/ui/pagination.js')?>" type="module"></script>
    <script src="<?=base_url('js/ui/file_preview.js')?>" type="module"></script>
    <script src="<?=base_url('js/new_article.js')?>" type="module"></script>
    <script src="<?=base_url('js/admin.js')?>"></script>
</body>
</html>