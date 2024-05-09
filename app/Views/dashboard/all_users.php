<?php
$session = \Config\Services::session();
$user_session=$session->get('user_id');
if (!$user_session) {
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
                                <i class="icon icon-user"></i>
                                <span>Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="dashboard__main">
            <?= view('sections/error') ?>

                <div class="dashboard__main__title">
                    <i class="icon icon-article"></i>
                    <p>Utilisateurs</p>
                </div>
                <div class="dashboard__main__action">
                    <a href="<?= base_url('users/store')?>" class="btn-action">
                        <i class="icon icon-plus"></i>
                        <span>Ajouter</span>
                    </a>
                </div>
                <div class="dashboard__main__box">
                    <table class="fnb-table">
                        <thead>
                            <th>Email</th>
                            <th>role</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php if(count($users) > 0):?>
                                <?php foreach($users as $user): ?>
                                <tr style="<?= $user->status_id == 1? 'background-color:red;color:#fff;':'' ?>">
                                    <td><?= $user->id === $user_session?'<b>Vous</b>':$user->email?></td>
                                    <td><?=$user->role?></td>
                                    <td>
                                        <div class="fnb-actions">
                                        <?php if($user->status_id == 2): ?>
                                            <a href="<?=base_url('users/block/'.$user->id)?>" class="fnb-actions__block" title="Bloqué">
                                                <i class="icon icon-block"></i>
                                            </a>
                                            <?php else:?>
                                                <a href="<?=base_url('users/unblock/'.$user->id)?>" class="fnb-actions__block" title="Débloqué">
                                                <i class="icon icon-block"></i>
                                            </a>
                                                <?php endif;?>
                                            <a href="<?=base_url('users/delete/'.$user->id)?>" class="fnb-actions__delete btn-delete" title="Supprimer">
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
    <?= view('partials/doc_admin_footer'); ?>

</body>
</html>
