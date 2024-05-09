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
                    <p>Evènements</p>
                </div>
                <ul class="cpn-pg-menu">
                    
                    <li class="cpn-pg-menu__item">
                        <a href="<?=base_url('/events')?>" class="cpn-pg-menu__item-link "> <span>Sous menu 1</span></a>
                    </li>
                    <li class="cpn-pg-menu__item">
                        <a href="#" class="cpn-pg-menu__item-link ">
                            <span>Sous menu 1</span> 
                        </a>
                    </li>
                    <li class="cpn-pg-menu__item">
                        <a href="#" class="cpn-pg-menu__item-link ">
                            <span>Sous menu 1</span> 
                        </a>
                    </li>
                </ul>
                <div class="dashboard__main__box">
                    <table class="fnb-table">
                        <tbody>
                            <tr>
                                Bientôt disponible
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Le reste du contenu reste inchangé -->
    </div>
    <script src="<?= base_url('js/admin.js') ?>"></script>
</body>

</html>