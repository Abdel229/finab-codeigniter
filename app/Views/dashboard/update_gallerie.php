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
            <?= view('sections/error') ?>

                <div class="dashboard__main__title">
                    <i class="icon icon-edit"></i>
                    <p>Mise à jour d'image</p>
                </div>
                <div class="dashboard__main__box">
                    <form action="<?= base_url('galleries/update/' . $galleryInformation['id']) ?>" method="post" enctype="multipart/form-data" class="fnb-form">
                    <div class="fnb-form__item">
                            <label for="title">Titre de la galerie</label>
                            <input type="text" id="title" name="name" value="<?= $galleryInformation['name'] ?>" required>
                        </div>
                    <div class="fnb-form__item">
                            <label for="image">Image Principale</label>
                            <input type="file" id="image" name="img" value="<?=base_url($galleryInformation['img_principales'])?>">
                            <img src="<?= base_url($galleryInformation['img_principales']) ?>" alt="Image actuelle" style="width:300px;height:300px;"><br>
                        </div>
                        <div class="fnb-form__item">
                            <label for="category_id">Catégorie :</label>
                            <select name="category" id="category_id" class="form-input">
                                <option value="">Choisir une catégorie</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['name'] ?>" <?= $category['id'] === $galleryInformation['category_id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div id="fileInputs" class="fnb-form__item" style="display:flex;align-items:center;gap:10px;">
                        <div style="display: flex;">
                                <input type="file" name="photos[]" multiple class="galery-img-input">
                                <div id="addMore" style="display:flex; align-items: center; justify-content: center; margin-left: 10px; padding:5px; background-color:#FF8800; border-radius: 4px; cursor: pointer;">
                                    <i class="icon icon-plus" style="background-color:#fff;"></i>
                                    <p style="color:#fff;margin-left:5px;">Ajouter une image</p>
                                </div>
                            </div>
                            <div id="loader" style="display: none;">
                            <img src="https://i.gifer.com/ZZ5H.gif" alt="Loading..." style="width: 30px;height:30px;">
                        </div>
                        </div>
                        <div style="display:grid;grid-template-columns:repeat(4,1fr);grid-gap:10px;" id="img-upload-container" data-galleries='<?= json_encode($galleries) ?>' >
                        </div>

                        <div class="fnb-form__item fnb-form__item-action">
                            <button type="submit" class="btn btn-submit">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?= view('partials/doc_admin_footer'); ?>


</body>

</html>