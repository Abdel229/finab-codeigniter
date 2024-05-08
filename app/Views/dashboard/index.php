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
    <title>Tableau de Bord des Articles</title>
    <link rel="stylesheet" href="<?=base_url('styles/css/icons.css')?>">
    <link rel="stylesheet" href="<?=base_url('styles/css/admin/dashboard.css')?>">
</head>
<body>
    <div class="dashboard">
        <?=view('sections/sidebar')?>
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
                    <i class="icon icon-article"></i>
                    <p>Articles</p>
                </div>
                <ul class="cpn-pg-menu">
                    
                    <li class="cpn-pg-menu__item">
                        <a href="" class="cpn-pg-menu__item-link "> <span>Liste des Articles</span></a>
                    </li>
                    <li class="cpn-pg-menu__item">
                        <a href="<?=base_url('/create_article_categories')?>" class="cpn-pg-menu__item-link ">
                            <span>Catégories</span> 
                        </a>
                    </li>
                </ul>
                <div class="dashboard__main__action">
                    <a href="<?=base_url('articles/store')?>" class="btn-action">
                        <i class="icon icon-plus"></i>
                        <span>Ajouter</span>
                    </a>
                </div>
                <div class="dashboard__main__box">
                    <table class="fnb-table">
                        <thead>
                            <th>Date de création</th>
                            <th>Titre</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php if(count($articles) > 0):?>
                                <?php foreach($articles as $article): ?>
                                <tr data-article="article_<?=$article['id']?>">
                                    <td><?=$article['created_at']?></td>
                                    <td><?=$article['title']?></td>
                                    <td>
                                        <div class="fnb-actions">
                                            <a href="<?=base_url('articles/update/'.$article['id'])?>" class="fnb-actions__edit" title="MOdifier">
                                                <i class="icon icon-edit"></i>
                                            </a>
                                            <a href="<?=base_url('articles/delete/'.$article['id'])?>" class="fnb-actions__delete" title="Supprimer">
                                                <i class="icon icon-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" style="text-align:center;">Aucune information disponible</td>
                                </tr>
                           <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=base_url('js/admin.js')?>"></script>
    <script src="<?=base_url('js/ui/dropdown.js')?>"></script>
</body>
</html>
