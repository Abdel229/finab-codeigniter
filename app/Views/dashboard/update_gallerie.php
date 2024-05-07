<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
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
                <div class="dashboard__main__title">
                    <i class="icon icon-edit"></i>
                    <p>Mise à jour d'image</p>
                </div>
                <div class="dashboard__main__box">
                    <form action="<?=base_url('galleries/update'. $category_single['id'])?>" method="post" enctype="multipart/form-data" class="fnb-form">
                        <div class="fnb-form__item">
                            <label for="title">Titre :</label>
                            <input type="text" id="title" name="title" required class="form-input">
                        </div>

                        <div id="fileInputs" class="fnb-form__item">
                        <div style="display: flex;">
                                <input type="file" name="photos[]" required class="form-input">
                                <div id="addMore" style="display:flex; align-items: center; justify-content: center; margin-left: 10px; padding:5px; background-color:#FF8800; border-radius: 4px; cursor: pointer;">
                                    <i class="icon icon-plus" style="color:#fff;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="fnb-form__item fnb-form__item-action">
                        <button type="button" id="addMore" class="btn btn-add">Plus</button>
                        <button type="submit" class="btn btn-submit">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('js/admin.js') ?>"></script>
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
                    removeBtnIcon.style.color = '#fff';

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