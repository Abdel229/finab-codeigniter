<?php
echo view('partials/doc_header');
echo view('partials/header');
?>
<div class="wrapper">
    <main class="main pg-partners">
        <section class="pg-first-face">
            <div class="container">
                <div class="pg-first-face__inner">
                    <div class="pg-first-face__blackImg wow animate__animated animate__backInDown">
                        <img src="<?= base_url('images/svg/finab_head.svg') ?>" class="finab-head" alt="finab-head">
                    </div>
                    <h1 class="h1 pg-title">Galleries d'images</h1>
                </div>
            </div>
        </section>
        <section class="partner-section section-default-therm">
            <div class="container">
                <div class="category-container">
                    <div class="distinction__list gallerie__list">
                        <?php foreach ($data as $item) : ?>
                            <?php foreach ($item['galleries'] as $gallery) : ?>
                                <a href="<?= $gallery['img_principales'] ?>" data-fancybox="<?= $gallery['name'] ?>" class="column__gallerie__list" data-galleries="<?= htmlspecialchars(json_encode($item['images']), ENT_QUOTES, 'UTF-8') ?>" data-title="<?= $gallery['name'] ?>">
                                    <img src="<?= $gallery['img_principales'] ?>" alt="distinction_img">
                                </a>
                                <?php foreach ($item['images'] as $image) : ?>
                                    <a href="<?= $gallery['img_principales'] ?>" data-fancybox="<?= $gallery['name'] ?>" class="column__gallerie__list" data-galleries="<?= htmlspecialchars(json_encode($item['images']), ENT_QUOTES, 'UTF-8') ?>" data-title="<?= $gallery['name'] ?>">

                                        <img src="<?= $image['img'] ?>" alt="distinction_img">
                                    </a>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php echo view('sections/last-events'); ?>
    </main>
</div>
<?php
echo view('partials/footer');
echo view('partials/doc_footer');
?>