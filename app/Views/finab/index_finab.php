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
                <div class="dashboard__main__title">
                    <i class="icon icon-category"></i>
                    <p> <a href="<?=base_url('/finab')?>">Finab</a>/ Finab 2024</p>
                </div>
                
                <div class="dashboard__main__action _finab_add modal">
                    <a href="#" class="btn-action">
                        <i class="icon icon-plus"></i>
                        <span>Ajouter</span>
                    </a>
                </div>
                <div class="dashboard__main__box">
                    <ul class="finab_details_list ">
                        <li class="finab_details_list_item active">
                            <a href="">Caractéristiques</a>
                        </li>
                        <li class="finab_details_list_item">
                            <a href="">Présentation</a>
                        </li>
                        <li class="finab_details_list_item">
                            <a href="">Statistiques</a>
                        </li>
                        <li class="finab_details_list_item">
                            <a href="">Hommages et Distinctions</a>
                        </li>
                        <li class="finab_details_list_item">
                            <a href="">Découvertes Talents</a>
                        </li>
                        <li class="finab_details_list_item">
                            <a href="">Partenaires</a>
                        </li>
                        <li class="finab_details_list_item">
                            <a href="">Evènements</a>
                        </li>
                        <li class="finab_details_list_item">
                            <a href="">Programmes</a>
                        </li>
                        <li class="finab_details_list_item">
                            <a href="">Sponsoring et Partenariat</a>
                        </li>
                    </ul>
                    <table class="fnb-table page_finab">
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Le reste du contenu reste inchangé -->
        <div id="myModal" class="modal-all">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Disponible bientôt</p>
            </div>
        </div>
    </div>
    <script src="<?= base_url('js/admin.js') ?>"></script>
</body>

</html>