<?php
  echo view('partials/doc_header');
  echo view('partials/header');
?>

<main>
        <div class="row_banner">
            <div class="container">
                <div class="name_page_logo">
                    <div class="logo_finab">
                        <img src="assets/images/svg/masque 1.svg" alt="">
                    </div>
                    <div class="name_page">
                        <h1>Demande de partenariats</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row_contact partners">
            <div class="mask_finab1">
                <div class="mask_finab_content">
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                </div>
                <div class="mask_finab_content">
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                </div>
                <div class="mask_finab_content">
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                </div>
            </div>
            <div class="container_main">
                <div class="container_main_content_">
                    <?php 
                    
                        echo view('sections/error');
                    ?>
                    <div class="form_become_partner container_main">
                        <div class="form_become_partner_content container_main_content">
                            <form id="contactForm" method='post' action='<?=base_url('/partner/become_partner')?>' class="partners_form" enctype="multipart/form-data">
                                <div class="form_control_partner__double">
                                    <div class="form_control_left">
                                        <label for="nom_prenom">Nom du partenaire</label>
                                        <input type="text" name="nom" id="nom_prenom">
                                        <div class="error_message" id="nom_prenom_error" required></div>
                                    </div>
                                    <div class="form_control_left">
                                        <label for="nom_prenom">Email</label>
                                        <input type="email" name="email" id="email" required>
                                        <div class="error_message" id="nom_prenom_error"></div>
                                    </div>
                                </div>
                                <div class="form_control_partner__double">
                                    <div class="form_control_left">
                                        <label for="nom_prenom">Téléphone du partenaire</label>
                                        <input type="tel" name="tel" id="tel"  required>
                                        <div class="error_message" id="tel_error"></div>
                                    </div>
                                    <div class="form_control_left">
                                        <label for="nom_prenom">Nom de l'utilisateur</label>
                                        <input type="text" name="user_name" id="user_name" required>
                                        <div class="error_message" id="user_name_error"></div>
                                    </div>
                                </div>
                                <div class="form_control_partner">
                                    <label for="">Logo</label>
                                    <div class="cpn-form__row">
                                        <input type="file" class="cpn-field" name="img_partner" id="productImgFiled" data-preview-file="true"  accept="image/*">
                                        <label for="productImgFiled" class="cpn-form__label"></label>
                                    </div>
                                </div>
                                <div class="form_control_partner">
                                    <label for="lien">Lien (Optionnel)</label>
                                    <input type="text" name="lien" id="lien" >
                                    <div class="error_message" id="lien_error"></div>
                                </div>
                                <div class="form_control_partner">
                                    <label for="objet">Objet</label>
                                    <input type="text" name="object" id="objet" required>
                                    <div class="error_message" id="objet_error"></div>
                                </div>
                                <div class="form_control_partner">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message"></textarea>
                                    <div class="error_message" id="message_error"></div>
                                </div>
                                <button type="submit">SOUMETTRE</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="mask_finab2">
                <div class="mask_finab_content">
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                </div>
                <div class="mask_finab_content">
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                </div>
                <div class="mask_finab_content">
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                    <img src="<?=base_url('images/svg/Mask group.svg') ?>" alt="" class='Mask_group'>
                </div>
            </div>
        </div>
    </main>

<?php
  echo view('partials/footer');
  echo view('partials/doc_footer');
?>