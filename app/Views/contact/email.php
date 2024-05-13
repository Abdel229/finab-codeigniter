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
                    <i class="icon-receipt"></i>
                    <p>Contacts</p>
                </div>
                <ul class="cpn-pg-menu">
                    
                    <li class="cpn-pg-menu__item">
                        <a href="<?=base_url('/contacts')?>" class="cpn-pg-menu__item-link "> <span>Téléphone</span></a>
                    </li>
                    <li class="cpn-pg-menu__item">
                        <a href="<?=base_url('/contacts/email')?>" class="cpn-pg-menu__item-link ">
                            <span>Email</span> 
                        </a>
                    </li>
                    <li class="cpn-pg-menu__item">
                        <a href="<?=base_url('/contacts/adresse')?>" class="cpn-pg-menu__item-link ">
                            <span>Adresse</span> 
                        </a>
                    </li>
                    <li class="cpn-pg-menu__item">
                        <a href="#" class="cpn-pg-menu__item-link ">
                            <span>Réseaux Sociaux</span> 
                        </a>
                    </li>
                </ul>
                <div class="dashboard__main__box">
                <form class="fnb-form" method="post" enctype="multipart/form-data" action="<?= base_url('contacts/email') ?>">
                        <div class="fnb-form__item">
                            <label for="title">Email</label>
                            <input type="email" id="title" name="email" value="<?= isset($contact)? $contact['email']:''?>" required>
                        </div>
                        <div class="fnb-form__item fnb-form__item-action">
                        <button type="submit" class="submit-button">Ajouter</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Le reste du contenu reste inchangé -->
    </div>
    <script src="<?= base_url('js/admin.js') ?>"></script>
</body>

</html>