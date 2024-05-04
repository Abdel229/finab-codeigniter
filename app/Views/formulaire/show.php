<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2><?= $article['title'] ?></h2>
    <p>Description: <?= $article['description'] ?></p>
    <p>Date de publication: <?= $article['date_pub'] ?></p>
    <img src="<?= base_url($article['img']) ?>" alt="Image de l'article">
    <!-- Afficher les liens -->
    <h3>Liens</h3>
    <ul>
        <?php foreach ($links as $link): ?>
            <li><?= $link['link'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>