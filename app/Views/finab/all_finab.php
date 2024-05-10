<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="<?=base_url('styles/css/icons-1.css')?>">
    <link rel="stylesheet" href="<?=base_url('styles/css/icons.css')?>">
    <link rel="stylesheet" href="<?=base_url('styles/css/admin/dashboard.css')?>">
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
                            <a href="<?=base_url('/auth/logout')?>">
                                <i class="icon icon-logout"></i>
                                <span>Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="dashboard__main">
                <div class="dashboard__main__title">
                    <i class="icon icon-finab"></i>
                    <p>Finab</p>
                </div>

                <div class="new_event_finab modal">
                    <button type="submit" class="btn_new_event_finab">
                        <i class="icon icon-plus"></i>
                        Nouveau évènement Finab
                    </button>
                </div>
                <div class="dashboard__main__box">
                    <table class="fnb-table" id="fnb-table">
                        <thead>
                            <th>Editions</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <!-- <tr >
                                <td >Finab 2024</td>
                                <td>
                                    <div class="fnb-actions">
                                        <a href="<?=base_url('/api/get_data')?>" class="fnb-actions__edit" title="MOdifier">
                                            <i class="icon icon-plus"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr> -->
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
    <script src="<?=base_url('js/ui/dropdown.js')?>" type="module"></script>
    <script src="<?=base_url('js/ui/modal.js')?>" type="module"></script>
    <script src="<?=base_url('js/ui/pagination.js')?>" type="module"></script>
    <script src="<?=base_url('js/admin.js')?>"></script>
    <script src="<?=base_url('js/finab.js')?>" type="module"></script>
</body>
</html>
