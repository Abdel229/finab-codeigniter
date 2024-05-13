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
    <link rel="stylesheet" href="<?=base_url('styles/css/icons-1.css')?>">
    <link rel="stylesheet" href="<?= base_url('styles/css/icons.css') ?>">
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
                    <i class="icon icon-category"></i>
                    <p>Article Gallery</p>
                </div>
                <ul class="cpn-pg-menu">
                    
                    <li class="cpn-pg-menu__item">
                        <a href="<?=base_url('/admin/galeries')?>" class="cpn-pg-menu__item-link "> <span>Liste des galeries</span></a>
                    </li>
                    <li class="cpn-pg-menu__item">
                        <a href="<?=base_url('/create_gallery_categories')?>" class="cpn-pg-menu__item-link ">
                            <span>Catégories</span> 
                        </a>
                    </li>
                </ul>
                <div class="dashboard__main__action">
                    <a href="<?= base_url('gallery_categorie/store') ?>" class="btn-action">
                        <i class="icon icon-plus"></i>
                        <span>Ajouter</span>
                    </a>
                </div>
                <div class="dashboard__main__box">
                    <div id="article__list">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Le reste du contenu reste inchangé -->
    </div>
    <script src="<?=base_url('js/ui/dropdown.js')?>" type="module"></script>
    <script src="<?=base_url('js/ui/modal.js')?>" type="module"></script>
    <script src="<?=base_url('js/ui/pagination.js')?>" type="module"></script>
    <script src="<?=base_url('js/admin.js')?>"></script>
    <script type="module" src="<?=base_url('js/rak.js')?>"></script>
    <script src="<?=base_url('js/galleries_categories.js')?>" type="module"></script>
</body>

</html>