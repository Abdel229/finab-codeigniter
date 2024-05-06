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
    <link rel="stylesheet" href="<?= base_url('styles/css/admin/dashboard.css') ?>">
</head>

<body>
    <div class="container">
        <?= view('sections/sidebar') ?>
        <div class="content">
            <div class="content__header">
                <h1 class="content__title">Tableau de Bord des galeries</h1>
                <a href="<?= base_url('galleries/store') ?>" class="content__button content__button--add">Ajouter une nouvelle gallerie</a>
            </div>
            <table class="galleries__table">
    <thead>
        <tr>
            <th class="galleries__table-header">Nom</th>
            <th class="galleries__table-header">Image</th>
            <th class="galleries__table-header">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($galleries as $gallerie): ?>
        <tr class="galleries__table-row">
            <td class="galleries__table-cell"><?= $gallerie['category']['name'] ?></td>
            <td class="galleries__table-cell"><img src="<?=base_url($gallerie['image']['img'])?>" alt="Exemple" style="<?= $gallerie['category']['name'] ?>: 50px;"></td>
            <td class="galleries__table-actions">
                <a href="<?=base_url('galleries/update/'.$gallerie['category']['id'])?>" class="galleries__table-action galleries__table-action--update">Mettre à jour</a>
                <a href="<?=base_url('galleries/delete/'.$gallerie['category']['id'])?>" class="galleries__table-action galleries__table-action--delete">Supprimer</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
            <!-- Plus d'articles peuvent être ajoutés ici -->
        </div>
        <!-- Le reste du contenu reste inchangé -->
    </div>
    </div>
    <script src="<?= base_url('js/admin.js') ?>"></script>
</body>

</html>