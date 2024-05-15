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
    <link rel="stylesheet" href="<?= base_url('styles/css/icons-1.css') ?>">
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
                    <i class=" icon-clients"></i>
                    <p>Partenariat</p>
                </div>
                <ul class="cpn-pg-menu">

                    <li class="cpn-pg-menu__item">
                        <a href="<?= base_url('/partner') ?>" class="cpn-pg-menu__item-link "> <span>Présentation</span></a>
                    </li>
                    <li class="cpn-pg-menu__item">
                        <a href="<?= base_url('/partner/list') ?>" class="cpn-pg-menu__item-link ">
                            <span>Liste des partenaires</span>
                        </a>
                    </li>
                    <li class="cpn-pg-menu__item">
                        <a href="<?= base_url('/partner/demande') ?>" class="cpn-pg-menu__item-link ">
                            <span>Demandes de partenariats</span>
                        </a>
                    </li>
                </ul>
                <div class="dashboard__main__box">
                    <?= view('sections/error') ?>
                    <form class="fnb-form idform" method="post" id="" enctype="multipart/form-data" action="<?= base_url('partner') ?>">
                        <div class="fnb-form__item">
                            <label for="title">Titre</label>
                            <input type="text" id="title" value="<?= isset($data['title']) ? $data['title'] : '' ?>" name="title" required>
                        </div>
                        <div class="fnb-form__item">
                            <label for="subtitle">Sous-titre</label>
                            <input type="text" id="subtitle" value="<?= isset($data['subtitle']) ? $data['subtitle'] : '' ?>" name="subtitle" required>
                        </div>
                        <div class="fnb-form__item">
                            <label for="mini_text">Text (optionnel)</label>
                            <textarea id="mini_text" name="mini_text" required class="summernote"><?= isset($data['mini_text']) ? $data['mini_text'] : '' ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image actuelle</label><br>
                            <?php if (isset($data['principal_img'])) : ?>
                                <img src="<?= base_url($data['principal_img']) ?>" alt="Image actuelle"><br>
                            <?php endif; ?>
                            <div class="cpn-form__row">
                                <input type="file" class="cpn-field" name="principal_img" id="productImgFiled" data-preview-file="true" accept="image/*">
                                <label for="productImgFiled" class="cpn-form__label"></label>
                            </div>
                        </div>
                        <!--  Youtube link  -->
                        <div class="form-group">
                            <div id="links-container">
                                <!-- Les champs d'entrée pour les liens seront ajoutés ici -->
                                <?php
                                if(isset($data['links'])):
                                    $id=1;
                                foreach($data['links'] as $link): ?>
                                    <input type="text" name="lien<?=$id ?>" value="<?= $link['link'] ?>" required><br>
                                <?php $id++; endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                        <!-- Aditionnal image -->
                        <!--
                        <div id="fileInputs" class="fnb-form__item" style="display:flex;align-items:center;gap:10px;">
                            <div style="display: flex;">
                                <input type="file" name="photos[]" multiple class="galery-img-input">
                                <div id="addMore" style="display:flex; align-items: center; justify-content: center; margin-left: 10px; padding:5px; background-color:#FF8800; border-radius: 4px; cursor: pointer;">
                                    <i class="icon icon-plus" style="background-color:#fff;"></i>
                                    <p style="color:#fff;margin-left:5px;">Ajouter d'autres images (facultatif)</p>
                                </div>
                            </div>
                            <div id="loader" style="display: none;">
                                <img src="https://i.gifer.com/ZZ5H.gif" alt="Loading..." style="width: 30px;height:30px;">
                            </div>
                        </div>
                        <div style="display:grid;grid-template-columns:repeat(4,1fr);grid-gap:10px;" id="img-upload-container" <?php if (!empty($data['images'])) {
                                                                                                                                    echo 'data-galleries=\'' . json_encode($data['images']) . '\'';
                                                                                                                                } ?>>
                        </div>
                                                                                                                            -->                                                                                                     
                </div>
                <input type="hidden" name="removedImg" id="removedImagesInput" value="">
                <div class="fnb-form__item fnb-form__item-action">
                    <button type="submit" class="submit-button">Sauvergarder</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Le reste du contenu reste inchangé -->
    </div>
    <script src="<?= base_url('js/admin.js') ?>"></script>
    <script type="module" src="<?= base_url('js/new_article.js') ?>"></script>
    <script src="<?= base_url('js/sponsoring-partenariat.js') ?>"></script>
</body>

</html>