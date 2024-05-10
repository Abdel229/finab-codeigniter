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
                <div class="dashboard__main__title">
                    <i class="icon icon-edit"></i>
                    <p>Mise à jour d'image</p>
                </div>
                <div class="dashboard__main__box">
                    <form id="idform" action="<?= base_url('galleries/update/' . $category_single['id']) ?>" method="post" enctype="multipart/form-data" class="fnb-form idform">
                        <div class="fnb-form__item">
                            <label for="category_id">Catégorie :</label>
                            <select name="category" id="category_id" class="form-input">
                                <option value="">Choisir une catégorie</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['name'] ?>" <?= $category['id'] == $category_single['id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div id="fileInputs" class="fnb-form__item">
                            <div class="cpn-form__row">
                                <input type="file" class="cpn-field" name="img" id="productImgFiled" data-preview-file="true"  accept="image/*">
                                <label for="productImgFiled" class="cpn-form__label"></label>
                            </div>
                        </div>
                        <div style="display:grid;grid-template-columns:repeat(4,1fr);grid-gap:10px;">
                            <?php foreach ($galleries as $gallery) : ?>
                                <a href="<?= base_url('galleries/delete_image/' . $gallery['id']) ?>" style="position:relative;">
                                    <div data-index="1" class="remove_field" style="display: flex; align-items: center; justify-content: center;width:fit-content;position:absolute;z-index:20;top:5px;right:10px; margin-left: 10px; padding: 5px; background-color: red; border-radius: 4px; cursor: pointer;"><i class="icon icon-delete remove-field" data-index="1" style="background-color: rgb(255, 255, 255);"></i></div>
                                    <img src="<?= base_url($gallery['img']) ?>" alt="" style="width:100px;height:100px;" />
                                </a>
                            <?php endforeach; ?>
                        </div>

                        <div class="fnb-form__item fnb-form__item-action">
                            <button type="submit" class="btn btn-submit">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=base_url('js/ui/dropdown.js')?>" type="module"></script>
    <script src="<?=base_url('js/ui/modal.js')?>" type="module"></script>
    <script src="<?=base_url('js/ui/pagination.js')?>" type="module"></script>
    <script src="<?=base_url('js/ui/file_preview.js')?>" type="module"></script>
    <script src="<?=base_url('js/new_article.js')?>" type="module"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const wrapper = document.querySelector('#fileInputs');
            const addBtn = document.querySelector('#addMore');
            let x = 1;

            addBtn.addEventListener('click', (e) => {
                console.log(x);
                const div = document.createElement('div');
                div.classList.add('fileInput');
                div.style.display = 'flex';
                div.style.marginTop = '10px';

                const input = document.createElement('input');
                input.type = 'file';
                input.required = true;
                input.name = 'photos[]';

                const removeBtn = document.createElement('div');
                removeBtn.style.display = 'flex';
                removeBtn.style.alignItems = 'center';
                removeBtn.style.justifyContent = 'center';
                removeBtn.style.marginLeft = '10px';
                removeBtn.style.padding = '5px';
                removeBtn.style.backgroundColor = 'red';
                removeBtn.style.borderRadius = '4px';
                removeBtn.style.cursor = 'pointer';
                removeBtn.dataset.index = x;
                removeBtn.classList.add('remove_field');

                const removeBtnIcon = document.createElement('i');
                removeBtnIcon.classList.add('icon', 'icon-delete', 'remove-field');
                removeBtnIcon.dataset.index = x;
                removeBtnIcon.style.backgroundColor = '#fff';

                removeBtn.appendChild(removeBtnIcon);
                div.appendChild(input);
                div.appendChild(removeBtn);
                wrapper.appendChild(div);
                x++;
            });
            wrapper.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove_field')) {
                    e.preventDefault();
                    e.target.parentElement.remove();
                    x--;
                }
            });
        });
    </script>

</body>

</html>