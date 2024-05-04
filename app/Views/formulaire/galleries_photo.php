<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="imageGallery">
        <!-- Les images seront affichées ici dynamiquement -->
        <?php foreach ($images as $image) : ?>
            <img src="<?= base_url($image['img']) ?>" alt="">
        <?php endforeach; ?>
    </div>
</body>
</html>