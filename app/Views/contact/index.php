<?php
use Faker\Provider\de_DE\PhoneNumber;
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
                <div class="dashboard__main__box">
                    <form class="fnb-form" id="phone_number" method="post" enctype="multipart/form-data" action="<?= base_url('contacts/phone_number') ?>" style="margin-top:20px;">
                    <?php foreach(json_decode($contact['phone_number'],true) as $element): ?>
                        <div class="fnb-form__item phoneDiv" id="phone<?=$element['id']?>" data-index="<?=$element['id']?>" style="display:flex; align-items:center;gap:10px;">
                            <div style="width:100%;">
                                <label for="phone">Numéro de téléphone <?=$element['id']?></label>
                                <div>
                                    <input type="tel" id="phone" class="phoneInput" name="phoneNumber[]" value="<?=$element['number']?>">
                                </div>
                            </div>
                            <div class="toggle-button <?= $element['state']==='on'?'active':''?>" data-toggle-state="<?= $element['state']==='on'?'on':'off'?>" data-index="<?=$element['id']?>">
                                <div class="inner-circle">
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <div id="additionnal-phone">

                        </div>
                        <div class="fnb-form__item fnb-form__item-action" style="display:flex;align-items:center; justify-content:center;gap:15px;">
                            <div id="addMore" class="submit-button" style="display:flex; align-items: center; justify-content: center; margin-left: 10px; background-color:#FF8800; border-radius: 4px; cursor: pointer;">
                                Ajouter
                            </div>
                            <div>
                                <button type="submit" class="submit-button">Sauvegarder</button>
                            </div>
                        </div>
                    </form>

                    <form class="fnb-form" id="email" method="post" enctype="multipart/form-data" action="<?= base_url('contacts/email') ?>" style="margin-top:20px;">
                        <div class="fnb-form__item">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?= isset($contact) ? $contact['email'] : '' ?>" required>
                        </div>
                        <div class="fnb-form__item fnb-form__item-action">
                            <button type="submit" class="submit-button">Sauvegarder</button>

                        </div>
                    </form>

                    <form class="fnb-form" id="adresse" method="post" enctype="multipart/form-data" action="<?= base_url('contacts/adresse') ?>" style="margin-top:20px;">
                        <div class="fnb-form__item">
                            <label for="title">Adresse</label>
                            <input type="input" id="adresse" name="adresse" value="<?= $contact ? $contact['adresse'] : '' ?>" required>
                        </div>
                        <div class="fnb-form__item fnb-form__item-action">
                            <button type="submit" class="submit-button">Sauvegarder</button>

                        </div>
                    </form>
                    <!-- Social link -->
                    <form class="fnb-form" id="link" method="post" enctype="multipart/form-data" action="<?= base_url('contacts/links') ?>" style="margin-top:20px;">
                    <?php if(isset($socialLinks)): ?>
                        <?php foreach($socialLinks as $element)
                        
                        if($element['name']=='facebook'){
                            $facebook=$element;
                        }else if($element['name']=='linkedin'){
                            $linkedin=$element;
                        }else if($element['name']=='twitter'){
                            $twitter=$element;
                        }else if($element['name']=='instagram'){
                            $instagram=$element;
                        }
                        
                        ?>
                            
                    <?php endif;?>
                        <div class="fnb-form__item social-block">
                            <label for="facebook"><i class="icon icon-facebook"></i>Facebook</label>
                            <input type="link" id="facebook" name="facebook" value="<?= isset($facebook) ? $facebook['link'] : '' ?>">
                        </div>

                        <div class="fnb-form__item social-block">
                            <label for="linkedin"><i class="icon icon-linkedin"></i>Linkedin</label>
                            <input type="link" id="linkedin" name="linkedin" value="<?= isset($linkedin) ? $linkedin['link'] : '' ?>">
                        </div>

                        <div class="fnb-form__item social-block">
                            <label for="twitter"><i class="icon icon-twitter"></i>Twitter</label>
                            <input type="link" id="twitter" name="twitter" value="<?= isset($twitter) ? $twitter['link'] : '' ?>">
                        </div>

                        <div class="fnb-form__item social-block">
                            <label for="instagram"><i class="icon icon-instagram"></i>Instagram</label>
                            <input type="link" id="instagram" name="instagram" value="<?= isset($instagram) ? $instagram['link'] : '' ?>">
                        </div>
                        <div class="fnb-form__item fnb-form__item-action">
                            <button type="submit" class="submit-button">Sauvegarder</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- Le reste du contenu reste inchangé -->
    </div>
    <script src="<?= base_url('js/admin.js') ?>"></script>
    <script type="module" src="<?= base_url('js/admin-contact.js') ?>"></script>

</body>

</html>