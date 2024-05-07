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
                <div class="category-container talent">
                    <?php foreach ($galleries as $gallery) : ?>
                        <h2><?= $gallery['category']['name'] ?></h2>
                        <div class="distinction__list talent__list js-distinction">
                            <?php foreach ($gallery['images'] as $image) : ?>
                                <a href="<?= $image['img'] ?>" class="distinction__item" data-fancybox="<?= $gallery['category']['name'] ?>">
                                <img src="<?= $image['img'] ?>" alt="distinction_img">
                            </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
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